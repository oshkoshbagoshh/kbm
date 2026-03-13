# AGENTS.md

## Cursor Cloud specific instructions

### Project overview

Klutch Products (KBM) is a vanilla PHP application for automating affiliate link and blog post generation for Amazon products. See `README.md` for full details.

### Running the dev server

```sh
php -S 0.0.0.0:8000 -t KBM/public/
```

The main entry point is `KBM/public/index.php`, which reads JSON article data from `KBM/klutch_articles_json/` and renders Bootstrap-styled product cards.

### Lint

There is no dedicated linter configured. Use `php -l <file>` for syntax checking PHP files. Example:

```sh
find . -name '*.php' -not -path './vendor/*' -exec php -l {} \;
```

### Tests

No automated test suite exists in this project. Validate manually by running the dev server and loading the page.

### Key caveats

- **No PostgreSQL required for the web frontend.** The main entry point (`KBM/public/index.php`) reads directly from JSON files and does not require a database. The CLI script `process_articles_cli.php` does require PostgreSQL and `.env` configuration (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).
- **`Views/api.php` uses `getallheaders()`** which is only available in web server context (Apache/CGI/PHP built-in server), not CLI. This file cannot be tested via `php Views/api.php`.
- **`B0899YYSXV.json` contains invalid JSON** (`NaN` value in the `"Added to Website?"` field). PHP's `json_decode` will silently fail on this file and it will be skipped by the article processor.
- **Composer vendor directory:** `.gitignore` excludes `/vendor/` but the lockfile is committed. Always run `composer install` after pulling.
