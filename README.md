# laravel-basic-authentication
laravel basic authentication package for both admin and front-end authentication. We are providing authentication for both frontend and admin sites. Because most of the sites we need to create admin site for content editing. Where super admin manage his site contents. 

This package is compatible with Laravel 5.2 and package will not work below 5.2.

# Requirements
PHP >= 5.5.9

Installation
------------------------
Require this package in your composer.json and update composer. 
```php
"lucky-saini/laravel-basic-authentication": "~0.1.0"
```

After updating composer, add the ServiceProvider to the providers array in config/app.php
```php
Luckys\BasicAithentication\BasiAuthenticationServiceProvider::class,
```

After setup all the above things a command will be added in `php artisan`. This command copy all the files in appropriate folders. In this command we provided user to create only required scaffolding feature. You can set specific argument according to requirement. It has following arguments `admin`, `frontend` and `both`. `both` is selected by default if this argument is empty.
```php
php artisan luckys:auth [scaffold_for]
```

Documentation
-------------------------
This plugin is an enhancement of Laravel make:auth functionality. Laravel provide us only single authentication. But in this plugin we can create two authentications. As most of the sites we have two sections one is Frontend (for public) site and second is Admin (for site owner). This package provide you to create both types of authentications.
