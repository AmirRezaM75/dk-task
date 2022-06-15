# Requirement

- ext-json
- MySql user must have the ``FILE`` privilege 
- This project uses mysql infile command, 
and you need to grant access to local files using  ``set global local_infile=true;`` command

# Installation

1. Clone the project
``git clone git@github.com:AmirRezaM75/dk-task.git && cd dk-task``

2. Install dependencies using ``composer install``
3. ``php artisan key:generate``
4. Fill MySql credentials in ``.env``

# Commands

## Import articles

```php artisan import:articles <absolute-path-to-json>```

## Import products

```php artisan import:products <absolute-path-to-json>```

# Test

``php artisan test``
