# Test fixtures

Run only against a disposable WordPress installation, with outbound requests and mail blocked. Runtime tests require FLEXIA_TEST_ENVIRONMENT=true and create/remove fixture content. See the repository README and CI workflow for setup.

The pinned theme.json schema was retrieved from https://schemas.wp.org/wp/6.6/theme.json on 2026-09-10.
SHA-256: 319f62af563d623f77439801e8684decd3cff002cd8121144a6fc6f1533654fc

Packaging tests need Python 3.9+ and use temporary copies, including paths containing spaces. Schema checks use jsonschema 4.25.1.
