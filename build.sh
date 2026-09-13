#!/usr/bin/env bash
set -euo pipefail
FLEXIA_BUILD_ROOT="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" && pwd)"
exec python3 "$FLEXIA_BUILD_ROOT/tools/build.py" "$@"
