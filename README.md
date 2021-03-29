<p align="center"><a href="https://dumask.id" target="_blank"><img src="https://dumask.id/img/logo_navbar.svg" width="400"></a></p>

## Dumask.id

Dumask.id menyediakan tempat pembuangan khusus masker dan sarung tangan bekas pakai. Website ini merupakan bagian dari Program Penelitian Kolaborasi Indonesia 2021.

## Development

- PHP Framework: Laravel 8
- VueJs
- MySQL 5.7
- Bootstrap 4
- laravel/socialite

## Instalation
- Clone this repository
- run `composer install`
- copy `.env.example` to `.env`
- Fill `.env`
- run `php artisan key:generate`
- run `php artisan migrate`
- run `npm install`
- run `php artisan serve`
- run `npm run watch` to compile development frontend assets

## Testing
- Create a dedicated MySQL testing database `testing_dumask`
- run `php artisan test`
