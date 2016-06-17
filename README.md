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
