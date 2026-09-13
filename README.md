# Flexia

Flexia is an independent WordPress block theme with Site Editor templates, reusable patterns, style variations and optional WooCommerce support. **Flexia Core and Flexia Pro are not required.** There is no theme-owned tracking, installer, login system or payment handler.

## Requirements

- WordPress 6.6 or later (theme.json v3).
- PHP 7.4 minimum compatibility; use an upstream-supported PHP version for deployment. The configured CI matrix covers PHP 7.4 with WordPress 6.6 and PHP 8.3 with current WordPress.
- WooCommerce is optional. The commerce regression target is WooCommerce 11.0.1, which requires WordPress 6.9 or later. Installations without WooCommerce use native WordPress templates and blocks.

Install the theme ZIP via Appearance → Themes. Edit site identity and navigation in the Site Editor. The posts page uses the blog template; the agency landing page is an optional page pattern. Templates saved in the database override theme files: review those customizations when upgrading.

## Upgrading to 3.2

Read [the migration notes](docs/MIGRATION-3.2.md) before upgrading existing websites. The theme no longer enables ACF shortcodes outside post content or deactivates Pro automatically. The blog, archive, sidebar and commerce templates have corrected behavior. A native Site Logo/Site Title and Navigation replace the demo header, and the footer no longer contains sample commercial links.

## Development

```sh
composer install
composer audit --locked
composer lint
python3 tools/check-theme.py
python3 -m venv .venv
.venv/bin/pip install jsonschema==4.25.1
.venv/bin/python tools/check-schema.py
python3 -m unittest discover -s tests -p 'test_*.py' -v
./build.sh
```

Composer tools are development-only and locked; WPCS checks focus on output escaping, request validation and nonce verification. Release builds use **tools/release-files.txt**, an explicit reviewed manifest, not the current directory contents. Add new runtime files to the manifest deliberately. The build works from any directory, stages outside the theme, fails on invalid/missing/symlinked inputs, and writes a deterministic ZIP plus SHA-256 and source manifest under build/. No ZIP is uploaded automatically.

The complete runtime checks require a disposable WordPress database. Set `FLEXIA_TEST_ENVIRONMENT` to true, activate Flexia, block external requests/mail, and run `wp eval-file tests/wordpress.php`. Run `tests/woocommerce.php` with WooCommerce active. These commands create and remove fixture posts/products; never run them against a customer site. CI builds its own database and also checks the declared WordPress minimum.

Shared styling lives in assets/css/custom.css and block-styles.css. editor-style.css holds editor-only adjustments. Commerce block CSS loads through WordPress block-style hooks. Fonts are local WOFF2; original TTF files remain available for saved legacy font definitions. The old DM Sans preset retains a system fallback instead of requesting files that never shipped.

## Security and retirement

[Security policy](SECURITY.md) · [Core retirement guide](docs/CORE-RETIREMENT.md) · [Release notes](CHANGELOG.md) · [Implementation and validation](docs/IMPLEMENTATION-3.2.md).

Avoid adding plugin features to the theme. Optional integrations must keep their own authorization and security defaults. Use native blocks for layout; do not reintroduce Core's generic layout shortcodes. The compatibility helper is retained temporarily for existing child themes and returns an empty value; it does not provide classic-theme settings.

## License and assets

Theme code is GPL-3.0-or-later. See font license files under assets/fonts. Existing demo raster assets are retained for compatibility; maintainers must retain their original provenance and distribution rights. Do not treat this source update as a new license grant for third-party artwork.
