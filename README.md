# laravel-basic-authentication
laravel basic authentication package for both admin and front-end authentication. We are providing authentication for both frontend and admin sites. Because most of the sites we need to create admin site for content editing. Where super admin manage his site contents. 

This package is compatible with Laravel 5.2 and package will not work below 5.2.

# Requirements
PHP >= 5.5.9

Installation
------------------------
Require this package in your composer.json and update composer. 
```php
"lucky-saini/laravel-basic-authentication": "~1.0.0"
```

After updating composer, add the ServiceProvider to the providers array in config/app.php
```php
Luckys\BasicAithentication\BasiAuthenticationServiceProvider::class,
```

After setup all the above things a command will be added in `php artisan`. This command copy all the files in appropriate folders. In this command we provided user to create only required scaffolding feature. You can set specific argument according to requirement. It has following arguments `admin`, `frontend` and `both`. `both` is selected by default if this argument is empty.
```php
php artisan luckys:auth [scaffold_for]
```

To publish the config settings in Laravel 5.2 use:

```php
php artisan vendor:publish --provider="Luckys\BasicAithentication\BasiAuthenticationServiceProvider"
```

This will add an `admin-auth.php` config file to your config folder.

Set admin password related setting in `config/auth.php` file. Like
```php
  'admin_users' => [
    'provider' => 'users',
    'email' => 'admin.auth.emails.password',
    'table' => 'password_resets',
    'expire' => 60,
  ],
```
After this code will look like this:
```php
  'passwords' => [
    'users' => [......],

    'admin_users' => [
        'provider' => 'users',
        'email' => 'admin.auth.emails.password',
        'table' => 'password_resets',
        'expire' => 60,
    ],
  ],
```

Documentation
-------------------------
This plugin is an enhancement of Laravel make:auth functionality. Laravel provide us only single authentication. But in this plugin we can create two authentications. As most of the sites we have two sections one is Frontend (for public) site and second is Admin (for site owner). This package provide you to create both types of authentications.
