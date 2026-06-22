# FlagHive

**FlagHive** is a CTF (*Capture The Flag*) writeup sharing platform where security enthusiasts can document, share, and discover solutions to CTF challenges. Built with Laravel.

## Features

- **Writeup Management** — Create, edit, and share detailed writeups with full Markdown support powered by League/CommonMark
- **Syntax Highlighting** — Code snippets are beautifully highlighted with Highlight.js, supporting 190+ languages
- **User Profiles** — Every user gets a public profile showcasing their writeup portfolio
- **Search** — Find writeups instantly by title across the entire platform
- **Admin Dashboard** — Manage users, review activity logs, and moderate content
- **Terminal-Inspired UI** — Dark theme with a clean, terminal aesthetic for a hacker-friendly experience

## Tech Stack

- **Backend:** Laravel 13, PHP 8.5
- **Database:** MariaDB
- **Frontend:** Blade templating, Vite, inline CSS
- **Markdown:** League/CommonMark 2.8
- **Highlighting:** Highlight.js 11.11.1

## Quick Start

```bash
git clone <repo-url>
cd flaghive
composer install
cp .env.example .env
php artisan key:generate
# configure your database in .env
php artisan migrate --force
php artisan serve
```

Visit `http://localhost:8000` and start sharing your writeups.

## License

Academic project.
