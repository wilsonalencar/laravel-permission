Laravel Permission
==================
[![Laravel 5.3](https://img.shields.io/badge/Laravel-5.3-orange.svg?style=flat-square)](http://laravel.com)

At the moment the package is not unit tested, but is planned to be covered later down the road.

Quick Installation
------------------
Begin by installing the package through Composer. The best way to do this is through your terminal via Composer itself:

```
composer require leandreaci\laravel-permission:dev-master
```
 Or add to you composer.json and run composer install.
 
 ```
"require": {
    "Foo/Bar" : "*",
    "leandreaci/laravel-permission": "dev-master"
},
 ```
     
Once this operation is complete, simply add the service provider to your project's `config/app.php` file and run the provided migrations against your database.

### Service Provider
```php
Leandreaci\LaravelPermission\LaravelPermissionServiceProvider::class
```


### in the providers array and

```php
'Permission' => Leandreaci\LaravelPermission\Facade\LaravelPermission::class,
```

### Migrations
You'll need to run the provided migrations against your database. Publish the migration files using the `vendor:publish` Artisan command and run `migrate`:

```
php artisan vendor:publish
php artisan migrate
```


### Using
1 - Add permission slug to permissions table.
2 - Add user and permission equivalent to permission_user table.
3 - Add Authorizable Trait to your User Model( Example above: Laravel 5.3).

```php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Leandreaci\LaravelPermission\Traits\Authorizable;

class User extends Authenticatable
{
    use Notifiable;
    use Authorizable;
```

4 - Check any method of your controller

```php

    use Leandreaci\LaravelPermission\Facade\Permission;

    class FooController
    {
        public function index()
        {
            if(! Permission::can('view.foo'))
            {
                //do what you want ;)
            }
        }
    }
```