# Changelog

## 3.2.2 — 2026-11-19

WPML compatibility fixes (#57), an Elementor Theme Builder fix and lighter front-end assets.

- WPML compatibility (#57): the blog posts index (`home.html` and `index.html`) now loads a hidden `flexia/template-blog-home` pattern, so its "Read More" link text is translatable like the archive and search templates. Sites that saved a customized Blog Home or Index template in the Site Editor keep their saved copy.
- WPML compatibility (#57): the 404 page's "Go Home" button links to `home_url()` instead of a fixed `/`, so multilingual plugins send visitors to the current language's home page.
- Open Elementor Pro Theme Builder header and footer templates in the Elementor editor again. Flexia's block templates never call `get_header()`/`get_footer()`, where Elementor Pro prints those documents, so the editor preview stopped on "the content area was not found". Flexia now lets Elementor render header/footer templates with its own Header & Footer page template when Elementor registered the location on the theme's behalf.
- Serve each bundled font as a Latin subset and an extended subset declared with `unicodeRange` in theme.json, so Latin pages download Inter at 24.6 KB instead of 97 KB and Sora at about 16 KB instead of 23 KB per weight. The full WOFF2/TTF files stay available for direct references.
- Stop requesting the parent `style.css` (which only holds the theme header) on every page. The `flexia-style` handle stays registered so inline styles and dependants keep working, and a child theme's stylesheet still loads through it.

## 3.2.1 — 2026-09-13

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
