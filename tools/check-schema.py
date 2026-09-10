#!/usr/bin/env python3
"""Validate theme configuration against the pinned minimum-WordPress schema."""
import json
from pathlib import Path
import sys
import jsonschema
root = Path(__file__).resolve().parent.parent
schema = json.loads((root / 'tests/theme-schema-6.6.json').read_text())
errors = []
for path in [root / 'theme.json', *root.glob('styles/*.json')]:
    for error in jsonschema.Draft7Validator(schema).iter_errors(json.loads(path.read_text())):
        errors.append(f'{path.name}: {list(error.path)}: {error.message}')
for error in errors:
    print(error, file=sys.stderr)
print(f'Theme schema: {len(errors)} error(s).')
sys.exit(bool(errors))
