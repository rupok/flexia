"""Release-boundary regressions operate on disposable copies of the checkout."""
import hashlib
from pathlib import Path
import shutil
import subprocess
import sys
import tempfile
import unittest
import zipfile

ROOT = Path(__file__).resolve().parent.parent


class ReleaseTests(unittest.TestCase):
    def setUp(self):
        self.temp = tempfile.TemporaryDirectory(prefix='flexia release tests ')
        self.root = Path(self.temp.name) / 'theme with spaces'
        shutil.copytree(ROOT, self.root, ignore=shutil.ignore_patterns('.git', 'vendor', 'build', '__pycache__'))
        self.output = Path(self.temp.name) / 'artifacts'

    def tearDown(self):
        self.temp.cleanup()

    def run_build(self):
        return subprocess.run([sys.executable, str(self.root / 'tools/build.py'), '--output-dir', str(self.output)], cwd=self.temp.name, capture_output=True, text=True)

    def test_deterministic_runtime_only_archive(self):
        (self.root / '.env').write_text('INERT_RELEASE_CANARY=must_not_ship')
        (self.root / 'assets/debug.log').write_text('INERT_RELEASE_CANARY')
        (self.root / 'assets/images/unreviewed.png').write_bytes(b'not an image')
        first = self.run_build()
        self.assertEqual(first.returncode, 0, first.stderr)
        artifact = next(self.output.glob('*.zip'))
        digest = hashlib.sha256(artifact.read_bytes()).hexdigest()
        second = self.run_build()
        self.assertEqual(second.returncode, 0, second.stderr)
        self.assertEqual(digest, hashlib.sha256(artifact.read_bytes()).hexdigest())
        with zipfile.ZipFile(artifact) as archive:
            names = archive.namelist()
            self.assertIn('flexia/templates/archive-product.html', names)
            self.assertFalse(any(x.endswith(('.env', '.log', 'unreviewed.png')) or '/tools/' in x or '/tests/' in x for x in names))
            self.assertTrue(all(x.startswith('flexia/') for x in names))

    def test_missing_declared_font_fails(self):
        next((self.root / 'assets/fonts').glob('*.woff2')).unlink()
        result = self.run_build()
        self.assertNotEqual(result.returncode, 0)
        self.assertFalse(list(self.output.glob('*.zip')))

    def test_symlink_release_input_fails(self):
        logo = self.root / 'assets/images/logo.svg'
        logo.unlink()
        logo.symlink_to(self.root / 'assets/images/arrow-right.svg')
        self.assertNotEqual(self.run_build().returncode, 0)

    def test_traversal_manifest_fails(self):
        with (self.root / 'tools/release-files.txt').open('a') as manifest:
            manifest.write('../outside.php\n')
        self.assertNotEqual(self.run_build().returncode, 0)


if __name__ == '__main__':
    unittest.main()
