# Toolbox

Package for Laravel with common helpers, traits, views, and middleware.

## Installation

Add the following to composer.json
```json
{
    "require": {
            "artifishall/toolbox": "dev-master"
        },
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:artifishall/toolbox.git"
        }
    ]
}
```

Run
```
composer update
```

## Force SSL
To force ssl add to the web middleware group in App\Http\Kernel.php
```php
protected $middlewareGroups = [
        'web' => [
            \Webfitters\Toolbox\Middleware\ForceSSL::class
        ]
]
```

then add to .env file
```
FORCE_SSL=true
```

## Google Analytics

```php
@include('toolbox::google.tags')
</body>
</html>
```

then add to .env file
```
GOOGLE_TRACKING=UA-XXXXXXXXX-1
```

## Artisan Commands

#### artisan db:backup
backup database based on database config

`--table=table1 --table=table2` to specify tables

`--ignore=table1 --ignore=table2` to ignore tables

`--clean` removes old backups

`--connection=` to specify connection in config

#### artisan db:import
import backup made by `artisan db:backup`

`--skipbackup` skip automatic backup of entire database before import
