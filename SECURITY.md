# Security

Report security concerns privately through the WPDeveloper support channel linked from https://wpdeveloper.com/support/. Include the theme version, affected file/feature, minimum actor and a minimal reproduction without customer data. Do not publish an unpatched exploit or include credentials in a public issue.

Flexia 3.x is an independent block theme. Keep WordPress, PHP and optional plugins maintained. Compatibility with an old PHP runtime is not a recommendation to deploy it. Theme code must not alter plugin activation or override another plugin's security defaults on ordinary requests.

Release gates validate source, focused WPCS security rules, schema/block structure, package contents and isolated WordPress behavior. Passing checks does not certify a website's database-saved content, other plugins, hosting configuration or access controls.
