# Retiring Flexia Core

Flexia 3.2 requires no Core plugin functions, classes, shortcodes, assets or settings. Do not bundle or recommend Core for new block-theme installations. Its legacy layout shortcodes are not migrated into the theme. Retiring the product does not automatically migrate an existing website's content.

## Per-site preflight

1. Back up files and the database. Record active theme/child theme, site and network plugin activation, WordPress/PHP versions and rollback location.
2. Search all post types/statuses, revisions, reusable patterns, templates, template parts, widgets, options and builder metadata for actual uses of `[container]`, `[container-fluid]`, `[row]` and `[column]`. Check child themes, snippets and custom plugins for Core classes, functions, asset handles and CSS assumptions. Generic shortcode names may belong to another plugin; resolve the active implementation.
3. Inventory saved Site Editor templates/global styles. Convert effective legacy layouts to native Group, Columns and other blocks on a clone. Preserve original data and an ID-based conversion record; review nesting, spacing and custom attributes.
4. Inventory shared WPDeveloper tracker settings and scheduled events before changing plugin state.

## Handle deactivation side effects

The legacy Core tracker can send final telemetry over HTTP during deactivation when opted in. Block that specific tracker destination during the controlled retirement operation and verify no request is sent. Preserve site versus network activation scope. An opted-out callback can return before clearing its scheduled event; an opted-in callback clears the shared `put_do_weekly_action` hook. Inventory other listeners and preserve or restore events still needed by other plugins.

The notices deactivation callback also deletes the shared `wpdeveloper_plugins_data` option. Preserve and restore other plugins' entries. Do not bulk-delete `wpdeveloper_*`, `wpins_*` or `wisdom_*` options: some store shared arrays. Remove only reviewed Core-owned state after backup.

## Remove after validation

Deactivate on staging after migrations and side-effect controls are ready. Verify no raw shortcodes, missing layouts, Core asset requests or PHP errors; check the editor and existing customized pages. Confirm other WPDeveloper settings and schedules remain intact. Apply the reviewed migration to one backed-up canary site, then expand rollout. Remove plugin files from deployed sites only after validation and retain an offline rollback copy.

This theme update does not deactivate plugins, delete content, modify shared options or archive the Core repository. Distribution retirement and every website's content migration require their own release/operations steps.
