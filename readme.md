# Hesto AdminLTE

This package provides easy way to install latest version of AdminLTE in your Laravel 5 Project. AdminLTE files are not hardcoded in package, they are downloaded by `bower` during installation and compiled by `gulp`.

- `adminlte:install`
- `adminlte:layout`

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

If you want to override existing files use `-f` flag. This command will override for example your gulpfile, so if you made any changes be careful. If you didn't make any changes or you're not familiar with gulpfile, just override it.

```
php artisan adminlte:install -f
bower install
```

### Step 7: Compile AdminLTE using gulp

Compiled files you can find in `/public/all.css` and `/public/all.js`. You can include this files to your layout. Additional packages can be added in `gulpfile.js`.

```
cd path/to/laravel/project
gulp
```

### Updating to latest version of AdminLTE

```
cd path/to/laravel/project
bower update
gulp
```

### Example layout
If you want an example layout, you can use `adminlte:layout name_of_layout` command to generate it. It will create view files in `/resources/views/name_of_layout/`.

```
php artisan adminlte:layout admin
```

### AdminLTE Preview and Documentation

https://almsaeedstudio.com/