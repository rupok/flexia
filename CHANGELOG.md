# Changelog

## 3.2.1 — unreleased

Upgrade QA follow-up to 3.2.0. Updating an existing site no longer replaces its header and footer layout.

- Restore the 3.1.0 header and footer under the `flexia/header` and `flexia/footer` slugs, so existing sites keep their chrome on update. The 3.2 native-identity chrome remains available as the new `flexia/header-minimal` and `flexia/footer-minimal` patterns.
- Give the minimal header's navigation an explicit page-list fallback so it no longer resolves to an unrelated saved menu.
- Lay the minimal header out without wrapping, keeping WooCommerce's account and mini-cart icons on the logo and menu row.
- Stop underlining button-shaped links inside post content, including WooCommerce's "Proceed to Checkout" button.
- Correct the 3.2 migration note: a database-saved header/footer part that only references a pattern still follows the theme's current pattern.

## 3.2.0 — 2026-09-13

Update from the public 3.1.0 release. Requires WordPress 6.6 or later; tested up to WordPress 7.1.

Restore optional-plugin security defaults; remove automatic Pro deactivation and remote icon requests; guard pattern/include entry points. Keep the theme independent of retired Flexia Core functionality.

Repair blog/archive inheritance, single-post sidebar rendering, block JSON, WooCommerce catalog routing and related-product context. Replace demo chrome with native site identity/navigation. Add theme.json v3, local WOFF2 fonts, corrected font declarations, color contrast, focus/touch/reduced-motion behavior and shared editor styling.

Replace recursive packaging with a deterministic manifest-based ZIP builder. Add locked WPCS security checks, pinned CI actions, source/schema checks, packaging regression tests and isolated WordPress/commerce regressions. See docs/MIGRATION-3.2.md for behavior changes and per-site migration requirements.
