#!/usr/bin/env python3
"""Build a deterministic theme ZIP from an explicit reviewed manifest."""
import argparse
import hashlib
import importlib.util
import json
import os
from pathlib import Path, PurePosixPath
import re
import subprocess
import tempfile
import zipfile

ROOT = Path(__file__).resolve().parent.parent
spec = importlib.util.spec_from_file_location('theme_check', ROOT / 'tools/check-theme.py')
checker = importlib.util.module_from_spec(spec)
spec.loader.exec_module(checker)


def build(destination):
    errors, _ = checker.check(ROOT)
    if errors:
        raise ValueError('\n'.join(errors))
    names = [line.strip() for line in (ROOT / 'tools/release-files.txt').read_text().splitlines() if line.strip() and not line.startswith('#')]
    if len(names) != len(set(names)):
        raise ValueError('duplicate release entry')
    version = re.search(r'^Version:\s*(\S+)', (ROOT / 'style.css').read_text(), re.M)[1]
    files = []
    for name in sorted(names):
        path = PurePosixPath(name)
        if path.is_absolute() or '..' in path.parts or any(part.startswith('.') for part in path.parts):
            raise ValueError(f'unsafe release path: {name}')
        if re.search(r'(?i)(?:^|/)(?:vendor|node_modules|tests|tools|build|docs)(?:/|$)|\.(?:env|log|sql|zip|bak|old|backup|pem|key)$', name):
            raise ValueError(f'development/sensitive path in release: {name}')
        file = ROOT / name
        if not file.is_file() or any((ROOT.joinpath(*path.parts[:i])).is_symlink() for i in range(1, len(path.parts) + 1)):
            raise ValueError(f'missing file or symlink in release: {name}')
        if file.resolve().is_relative_to(ROOT) is False:
            raise ValueError(f'path escapes theme: {name}')
        files.append((name, file.read_bytes()))
    required = {'style.css', 'readme.txt', 'functions.php', 'index.php', 'theme.json', 'templates/index.html', 'templates/archive-product.html'}
    if not required.issubset(names):
        raise ValueError('required theme files missing from manifest')
    # Every currently declared font must also ship, not merely exist in checkout.
    for config in [ROOT / 'theme.json', *ROOT.glob('styles/*.json')]:
        for asset in re.findall(r'file:\./([^"\s]+)', config.read_text()):
            if asset not in names:
                raise ValueError(f'font excluded from release: {asset}')
    for directory in ('patterns', 'templates', 'parts', 'includes', 'styles'):
        for file in (ROOT / directory).rglob('*'):
            if file.is_file() and file.suffix in ('.php', '.html', '.json') and str(file.relative_to(ROOT)) not in names:
                raise ValueError(f'runtime source missing from manifest: {file.relative_to(ROOT)}')
    destination.mkdir(parents=True, exist_ok=True)
    artifact = destination / f'flexia-{version}.zip'
    fd, stage = tempfile.mkstemp(prefix='flexia-release-', suffix='.zip')
    os.close(fd)
    final_stage = None
    try:
        with zipfile.ZipFile(stage, 'w', compression=zipfile.ZIP_DEFLATED, compresslevel=9) as archive:
            for name, data in files:
                info = zipfile.ZipInfo('flexia/' + name, date_time=(2020, 1, 1, 0, 0, 0))
                info.compress_type = zipfile.ZIP_DEFLATED
                info.external_attr = 0o100644 << 16
                archive.writestr(info, data)
        with zipfile.ZipFile(stage) as archive:
            if archive.testzip() is not None or set(archive.namelist()) != {'flexia/' + x for x in names}:
                raise ValueError('ZIP integrity check failed')
        # Copy through a same-directory temporary file for an atomic replacement.
        with tempfile.NamedTemporaryFile(dir=destination, delete=False) as output:
            final_stage = Path(output.name)
            output.write(Path(stage).read_bytes())
        os.replace(final_stage, artifact)
    finally:
        Path(stage).unlink(missing_ok=True)
        if final_stage is not None:
            final_stage.unlink(missing_ok=True)
    digest = hashlib.sha256(artifact.read_bytes()).hexdigest()
    artifact.with_suffix('.zip.sha256').write_text(f'{digest}  {artifact.name}\n')
    revision = subprocess.run(['git', '-C', str(ROOT), 'rev-parse', 'HEAD'], capture_output=True, text=True)
    dirty = subprocess.run(['git', '-C', str(ROOT), 'status', '--porcelain'], capture_output=True, text=True)
    artifact.with_suffix('.manifest.json').write_text(json.dumps({'version': version, 'revision': revision.stdout.strip() or None, 'dirty': bool(dirty.stdout.strip()), 'sha256': digest, 'files': [{'path': name, 'sha256': hashlib.sha256(data).hexdigest()} for name, data in files]}, indent=2) + '\n')
    print(f'Built {artifact} ({len(files)} files)\nSHA-256 {digest}')
    return artifact


if __name__ == '__main__':
    parser = argparse.ArgumentParser()
    parser.add_argument('--output-dir', type=Path, default=ROOT / 'build')
    args = parser.parse_args()
    try:
        build(args.output_dir.resolve())
    except (ValueError, OSError) as error:
        parser.exit(1, f'Build failed: {error}\n')
