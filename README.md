# Laravel SSO

A helper package for ITS SSO authentication in laravel framework

## Requirements

1. PHP 7.4 or greater
2. Laravel version 8
3. myits/openid-connect-client

## Installation

Install using composer:

```shell
composer require dptsi/laravel-sso
```

## Usage

### Login

> @method static void login(\Dptsi\Sso\Requests\OidcLoginRequest $request)

- Create login request (provided credentials from ITS SSO)

    ```php
    use Dptsi\Sso\Requests\OidcLoginRequest;

    $request = new OidcLoginRequest(
        config('openid.provider'),
        config('openid.client_id'),
        config('openid.client_secret'),
        config('openid.redirect_uri'),
        config('openid.scope'),
        config('openid.allowed_roles')
    );
    ```

- Call static login method with `OidcLoginRequest` parameter

    ```php
    use Dptsi\Sso\Facade\Sso;

    Sso::login($request);
    ```

### Logout

> @method static void logout(\Dptsi\Sso\Requests\OidcLogoutRequest $request)

- Create logout request (provided credentials from ITS SSO)

    ```php
    use Dptsi\Sso\Requests\OidcLogoutRequest;

    $request = new OidcLogoutRequest(
        config('openid.provider'),
        config('openid.client_id'),
        config('openid.client_secret'),
        config('openid.post_logout_redirect_uri')
    );
    ```

- Call static logout method with `OidcLogoutRequest` parameter

    ```php
    use Dptsi\Sso\Facade\Sso;

    Sso::logout($request);
    ```

### Check if the user is authenticated

> @method static bool check()

```php
use Dptsi\Sso\Facade\Sso;

Sso::check();
```

### Get current authenticated user

> @method static \Dptsi\Sso\Models\User|null user()

```php
use Dptsi\Sso\Facade\Sso;

Sso::user();
```

### Set current authenticated user

> @method static void set(\Dptsi\Sso\Models\User $user)

```php
use Dptsi\Sso\Facade\Sso;
use Dptsi\Sso\Models\User;

$user = Sso::user();

$user->setActiveRole($role);

Sso::set($user);
```

For change role purpose

### Get token of current authenticated user

```php
use Dptsi\Sso\Facade\Sso;

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

### Claim support

Support any claim from ITS SSO, different claim determine `Dptsi\Sso\Models\User` model property (whether is null or not), more about [User Model](src/Models/User.php)