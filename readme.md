# Hesto AdminLTE

- `adminlte:install`

## Usage

### Step 1: Install Through Composer

```
composer require hesto/adminlte
```

### Step 2: Add the Service Provider

You'll only want to use these generators for local development, so you don't want to update the production  `providers` array in `config/app.php`. Instead, add the provider in `app/Providers/AppServiceProvider.php`, like so:

```php
public function register()
{
	if ($this->app->environment() == 'local') {
		$this->app->register('Hesto\Adminlte\AdminlteServiceProvider');
	}
}
```

### Step 3: Install Node.js

https://nodejs.org/en/download/

### Step 4: Install bower and gulp globally

```
npm install -g bower gulp
```

### Step 5: Install npm packages in your project

```
cd path/to/laravel/project
npm install
```

### Step 6: Install AdminLTE in your project

```
php artisan adminlte:install
bower install
bower update
gulp
```