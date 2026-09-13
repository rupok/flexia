# Flexia 3.2 development implementation

Implemented on the existing `dev` branch, based on fb30cc769b22ec978e38c96fb8ffcb1186a272f0. Changes are grouped into security, templates, styles, build/test and documentation commits for review. Production deployment and plugin repository deletion are outside this change.

## Implemented

- Removed the blanket ACF shortcode override and automatic Pro deactivation. Theme setup now only registers supports, styles, patterns and literal WooCommerce wrappers. Added direct-entry guards and context-correct JSON encoding for translated block attributes. Flexia Core/Pro remain optional and are not installed, loaded or managed by the theme.
- Corrected the posts index, inherited archive query and pagination, selected-post sidebar content, single main/title landmarks and malformed block JSON. Preserved existing pattern slugs and the optional agency landing page.
- Added the WooCommerce catalog override, product search/categories, proper related-product context and shared product patterns. Kept the old shop-template alias for saved assignments. WooCommerce owns payment, cart and account logic.
- Replaced default demo branding/navigation/footer/sidebar links with site identity and native navigation. Repaired banner contrast, palette/link/button contrast tokens, keyboard/touch behavior, reduced motion and logical CSS properties. Shared frontend/editor styles and separated commerce CSS. No theme-owned remote icon requests or global Dashicons dependency remain.
- Migrated theme.json and both variations to v3, with WordPress 6.6 minimum. Fixed missing font references and supplied local WOFF2 conversions and font licenses. Original TTF URLs and the DM Sans preset slug remain for compatibility. Regenerated the translation catalog and rewrote documentation.
- Added an explicit 129-file release manifest, deterministic ZIP builder, checksum/source manifests, schema and block/reference validation, focused WPCS security checks, negative packaging tests and isolated WordPress/WooCommerce regressions. CI action revisions are pinned, token permissions are read-only and dependency auditing is required. Development tools never ship in the ZIP.

## Validation performed

| Check | Result |
|---|---|
| WordPress 6.6 / PHP 8.2.29 / Core, Pro, ACF and WooCommerce absent | 585 assertions passed |
| Local WordPress reporting 7.1 / PHP 8.2.29 / WooCommerce 11.0.1 | 585 theme assertions passed |
| WooCommerce 11.0.1 | Catalog template resolution, related/unrelated product isolation, one main landmark, simple/variable/grouped/external product forms passed |
| Exact built ZIP installed into both disposable test roots | The same WordPress and commerce regressions passed |
| Original 3.1.0 negative control | Failed for ACF override, obsolete mutation, unsafe translated JSON, category scope, missing selected sidebar post/landmarks and anonymous/admin plugin-state mutation |
| Source and schema | 757 block declarations and all three minimum-version theme schemas passed; declared fonts present |
| PHP syntax and WPCS 3.4.1 security rules | Passed |
| Locked Composer dependency audit | No reported advisories or abandoned packages |
| Release boundary | Four tests passed: deterministic clean contents, missing font rejection, symlink rejection, traversal rejection; paths with spaces covered |
| Touchstone locator on extracted release | 33 PHP discovered = 33 scanned + 0 excluded; no locator hits. This is a surface check, not a security certificate |
| Browser smoke review | Posts, single/comments, catalog, product, add-to-cart, loaded cart and checkout form reviewed; default/dark/orange previewed. At 320 px, posts page had no horizontal overflow and mobile menu opened/closed with Escape and restored focus |

The browser logged one WooCommerce warning about `wc.wcBlocksData` dependency declaration on the cart page; the theme registers no JavaScript. Cart data loaded and add-to-cart worked. No order, payment or external message was submitted. This warning remains an integration QA observation, not a confirmed theme defect.

WPCS was updated to 3.4.1 after the dependency audit flagged the initially selected development version. The focused security rules did not enable the affected EnqueuedResourceParameters sniff. [Upstream advisory](https://github.com/WordPress/WordPress-Coding-Standards/security/advisories/GHSA-3pwp-g2mj-5p3v).

## Before website rollout

1. Run the configured hosted CI matrix before each release. Hosted tests passed on PHP 7.4 / WordPress 6.6 and PHP 8.3 / WordPress 7.1; local tests used PHP 8.2.29. WordPress.org confirms 7.1 as the current stable release as of 2026-09-13, and both Tested up to headers are corrected to 7.1 in Flexia 3.2.0.
2. Back up and reconcile saved templates, global styles, child themes and ACF field-display integrations. Test real multisite/network activation and site-specific supported plugins. The child-version regression is a controlled simulation, not a complete child-theme/editor or multisite audit.
3. Complete Core retirement per website using CORE-RETIREMENT.md. Source independence does not prove every historical website has no shortcode/customization dependency. Protect shared WPDeveloper settings/schedules and suppress final tracking during controlled deactivation.
4. Finish representative keyboard/screen-reader, long-translation/RTL, zoom and editor insert/save/reopen acceptance. The checks above validate raw block JSON and rendering; they do not certify every legacy pattern's editor serialization or WCAG conformance.
5. Review demo-image provenance and optimize responsive raster assets, then measure Core Web Vitals on representative real content. The WOFF2 conversion reduced the four font files from 483,444 to 171,076 bytes; no image or performance-score guarantee is made.
6. Use a payment sandbox for actual checkout/gateway/tax/shipping/store-stock-policy acceptance and test database-saved WooCommerce overrides. Browser checkout verification stopped before submission.

Read MIGRATION-3.2.md for visible behavior changes and rollback requirements. No code audit can make an entire deployed website “entirely secured”; remaining risks include stored content, plugins and infrastructure outside this theme's control.
