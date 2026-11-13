seeded logins:
Lola Valeroso - lola.valeroso@bulletin.test / bulletin2026
Kagawad Franz Lorenz Valeroso - kagawad.valeroso@bulletin.test / bulletin2026
tags: 'Purok Valeroso', 'Urgent', 'Libre', 'Schedule', 'Other'

relationships:

user to author (hasone / belongsto): one account, one profile. the authors table holds the user_id. only the kagawad has a profile, residents have none. this is how the app checks who is allowed to write posts.

author to posts (hasmany / belongsto): one author can have many posts, but a post can only have one author. so posts.author_id points back to the author.

post to comments (hasmany / belongsto): a post has many comments, a comment belongs to a post (comments.post_id).

   author to comments (hasmanythrough via post): comments belong to posts, not directly to authors. this is used for me to count the comments an author has received without looping through their posts. it is shown on the author page as "(n) comments received".

user to comments (hasmany / belongsto): a user can write many comments, a comment can only be owned/created by one user (comments.user_id).

post and tag (belongstomany): a post can have many tags and a tag can be on many posts. tags are attached with sync().

per-page number and why: 9, fills up the whole grid  
custom category: Other  
birthday post date: 2024-11-24

## How to run

1. Install PHP dependencies:
   ```bash
   composer install
   ```
2. Create the environment file:
   ```bash
   cp .env.example .env
   ```
3. Generate the app key:
   ```bash
   php artisan key:generate
   ```
4. Make sure `database/database.sqlite` exists (create it if missing):
   ```bash
   touch database/database.sqlite
   ```
   On Windows PowerShell: `New-Item database/database.sqlite`
5. Run the migrations and seeders:
   ```bash
   php artisan migrate:fresh --seed
   ```
6. Install JavaScript dependencies:
   ```bash
   npm install
   ```
7. Start Vite in one terminal:
   ```bash
   npm run dev
   ```
8. Start the server in a second terminal:
   ```bash
   php artisan serve
   ```
9. Open http://127.0.0.1:8000

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
