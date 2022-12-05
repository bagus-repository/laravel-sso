# Laravel SSO

A helper package for Forisa SSO authentication in laravel framework

## Requirements

1. PHP 7.2.5 or greater
2. Laravel version 6
3. Guzzle 7.5 or greater

## Installation

Install using composer:
place this code in `composer.json`

```shell
"require": {
    "forisa/sso" : "dev-master"
},
"repositories": [
    {
        "url": "https://github.com/bagus-repository/laravel-sso",
        "type": "git"
    }
]
```
## Usage

### Login

> Use provided button
```php
use Forisa\Sso\Facade\Sso;
```
then in blade
```php
{!! Sso::SsoLoginButton() !!}
```
or use your own button with link 

```php
route('sso.redirect')
```

### Logout

> @method static void logout()

- Call static logout method (run this method after all client session destroyed)

    ```php
    use Forisa\Sso\Facade\Sso;

    Sso::logout($request);
    ```

### Check if the user is authenticated

> @method static bool check()

```php
use Forisa\Sso\Facade\Sso;

Sso::check();
```
or

> @method static bool checkBySession()

```php
use Forisa\Sso\Facade\Sso;

Sso::checkBySession();
```

### Get current authenticated user by Session

> @method static \Forisa\Sso\Models\User|null user()

```php
use Forisa\Sso\Facade\Sso;

Sso::user();
```

### Set current authenticated user

> @method static void setUser(\Forisa\Sso\Models\User $user)

```php
use Forisa\Sso\Facade\Sso;
use Forisa\Sso\Models\User;

$user = Sso::user();

Sso::set($user);
```

### Get token of current authenticated user

```php
use Forisa\Sso\Facade\Sso;

Sso::token();
```

## Additional Information

### Middleware

Call middleware `sso` from route or controller to check if user is authenticated or not

```php
Route::middleware(['web', 'sso'])
```

### SSO Helpers

`sso()->` same as `Sso::`, it can be called from controller, route, view, etc.

```php
sso()->check()
sso()->user()
...
```

### config needed

```php
return [
    'check_token_type'          => env('FORISASSO_CHECK_TOKEN_TYPE', 'session'),
    'app_code'                  => env('FORISASSO_APP_CODE'),
    'base_url'                  => env('FORISASSO_BASE_URL'),
    'base_ip'                  => env('FORISASSO_BASE_IP'),
    'api_url'                   => env('FORISASSO_API_URL'),
    'api_ip'                   => env('FORISASSO_API_IP'),
    'post_login_redirect_uri'   => env('FORISASSO_POST_LOGIN_REDIRECT_URI'),
    'post_logout_redirect_uri'  => env('FORISASSO_POST_LOGOUT_REDIRECT_URI'),
    'scope'                     => env('FORISASSO_SCOPE'),
    'allowed_roles'             => [
        'Role1',
        'Role2',
        'Role3'
    ],
];
```
also client must be registered in auth server and provide valid host
> Example: career.forisa.co.id / 192.168.50.111