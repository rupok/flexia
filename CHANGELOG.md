# Changelog

## 3.2.0 — 2026-09-13

Update from the public 3.1.0 release. Requires WordPress 6.6 or later; tested up to WordPress 7.1.

Restore optional-plugin security defaults; remove automatic Pro deactivation and remote icon requests; guard pattern/include entry points. Keep the theme independent of retired Flexia Core functionality.

Repair blog/archive inheritance, single-post sidebar rendering, block JSON, WooCommerce catalog routing and related-product context. Replace demo chrome with native site identity/navigation. Add theme.json v3, local WOFF2 fonts, corrected font declarations, color contrast, focus/touch/reduced-motion behavior and shared editor styling.

Replace recursive packaging with a deterministic manifest-based ZIP builder. Add locked WPCS security checks, pinned CI actions, source/schema checks, packaging regression tests and isolated WordPress/commerce regressions. See docs/MIGRATION-3.2.md for behavior changes and per-site migration requirements.
