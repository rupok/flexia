#!/usr/bin/env python3
"""Validate release inputs without executing PHP. Runtime checks are separate."""
import argparse
import json
from pathlib import Path
import re
import sys


def check(root):
    errors = []
    patterns = {}
    for p in root.glob('patterns/*.php'):
        m = re.search(r'Slug:\s*(\S+)', p.read_text())
        if not m:
            errors.append(f'{p.relative_to(root)}: missing pattern slug')
        elif m[1] in patterns:
            errors.append(f'duplicate pattern slug: {m[1]}')
        else:
            patterns[m[1]] = p
    total = 0
    for p in sorted([*root.glob('patterns/*.php'), *root.glob('templates/*.html'), *root.glob('parts/*.html')]):
        source = p.read_text()
        def placeholder(m):
            php = m[0]
            value = '"CHECK"' if 'wp_json_encode(' in php else 'CHECK' if 'echo ' in php or 'esc_html_e' in php else ''
            return value + '\n' * php.count('\n')
        source = re.sub(r'<\?php.*?\?>', placeholder, source, flags=re.S)
        stack = []
        for m in re.finditer(r'<!--\s*(/?)wp:([\w/-]+)\s*(.*?)-->', source, re.S):
            closing, name, rest = m.groups()
            line = source[:m.start()].count('\n') + 1
            at = f'{p.relative_to(root)}:{line}'
            if closing:
                if not stack or stack.pop() != name:
                    errors.append(f'{at}: mismatched closing block {name}')
                continue
            total += 1
            single = rest.rstrip().endswith('/')
            attrs = rest.rstrip()[:-1].strip() if single else rest.strip()
            try:
                data = json.loads(attrs) if attrs else {}
                if name == 'pattern' and data.get('slug') not in patterns:
                    errors.append(f'{at}: unknown pattern {data.get("slug")}')
                if name == 'template-part' and not (root / 'parts' / (data['slug'] + '.html')).is_file():
                    errors.append(f'{at}: missing template part')
            except (ValueError, KeyError) as e:
                errors.append(f'{at}: invalid block attributes: {e}')
            if not single:
                stack.append(name)
        if stack:
            errors.append(f'{p.relative_to(root)}: unclosed blocks: {stack}')
    for p in [root / 'theme.json', *root.glob('styles/*.json')]:
        try:
            data = json.loads(p.read_text())
            if data.get('version') != 3:
                errors.append(f'{p.name}: expected theme.json v3')
            for asset in re.findall(r'file:\./([^"\s]+)', p.read_text()):
                if not (root / asset).is_file():
                    errors.append(f'{p.name}: missing font {asset}')
        except ValueError as e:
            errors.append(f'{p.name}: invalid JSON: {e}')
    for p in [*root.glob('*.php'), *root.glob('includes/*.php'), *root.glob('patterns/*.php')]:
        if "defined( 'ABSPATH' )" not in p.read_text():
            errors.append(f'{p.relative_to(root)}: missing direct-entry guard')
    for p in root.glob('assets/css/*.css'):
        if re.search(r'(?:url\(|@import\s)[^;\n]*https?://', p.read_text()):
            errors.append(f'{p.name}: remote CSS asset')
    for p in [root / 'functions.php', *root.glob('includes/*.php')]:
        if re.search(r"deactivate_plugins\s*\(|acf/shortcode/allow_in_block_themes_outside_content|add_shortcode\s*\(", p.read_text()):
            errors.append(f'{p.name}: retired integration or plugin side effect reintroduced')
    versions = []
    for file, pattern in [('style.css', r'^Version:\s*(\S+)'), ('readme.txt', r'^Stable tag:\s*(\S+)'), ('functions.php', r"define\( 'FLEXIA_VERSION', '([^']+)' \)")]:
        m = re.search(pattern, (root / file).read_text(), re.M)
        versions.append(m[1] if m else None)
    if None in versions or len(set(versions)) != 1:
        errors.append('theme header, readme and runtime versions differ')
    return errors, total


if __name__ == '__main__':
    parser = argparse.ArgumentParser()
    parser.add_argument('root', nargs='?', default=str(Path(__file__).resolve().parent.parent))
    args = parser.parse_args()
    errors, total = check(Path(args.root).resolve())
    for error in errors:
        print(error, file=sys.stderr)
    print(f'Checked {total} block declarations; {len(errors)} error(s).')
    sys.exit(bool(errors))
