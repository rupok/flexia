# Changelog

## 3.2.1 — 2026-09-10 (package corrected 2026-09-13)

Correct the stale Tested up to headers in style.css and readme.txt to WordPress 7.1, verified against the current official stable release and compatibility tests. Rebuild the same 3.2.1 release package and checksum; theme behavior is unchanged.

Package the security and modernization changes below for release review. Synchronize theme, runtime and translation metadata to 3.2.1. See the GitHub release for distribution status and installable ZIP.

## 3.2.0 — unreleased development baseline

Restore optional-plugin security defaults; remove automatic Pro deactivation and remote icon requests; guard pattern/include entry points. Keep the theme independent of retired Flexia Core functionality.

Repair blog/archive inheritance, single-post sidebar rendering, block JSON, WooCommerce catalog routing and related-product context. Replace demo chrome with native site identity/navigation. Add theme.json v3, local WOFF2 fonts, corrected font declarations, color contrast, focus/touch/reduced-motion behavior and shared editor styling.

Replace recursive packaging with a deterministic manifest-based ZIP builder. Add locked WPCS security checks, pinned CI actions, source/schema checks, packaging regression tests and isolated WordPress/commerce regressions. See docs/MIGRATION-3.2.md for behavior changes and per-site migration requirements.
