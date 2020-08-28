<b>Installation</b>

Clone Repository
```
git clone git@github.com:vladimirovpyu/bigland.git
```
Change Branch
```
git checkout --track origin/bigland
```
Composer Install
```
composer install
composer update
```
Generate Key
```
php artisan key:generate
```

DB Settings
<blockquote>
Rename .env.example to .env

Set your settings in section DB_CONNECTION= 
</blockquote> 

Migration
```
php artisan migration up
```

<b>Using</b>

Unit Test
```
php artisan test
```

Console
```
php artisan bigland:search 69:27:0000022:1306,69:27:0000022:1307
```

Web API
```
php artisan serve
```
Open http://localhost:8000/bigland


REST API
```
php artisan serve
curl -X POST http://localhost:8000/api/bigland -H "Accept: application/json" -H "Content-Type: application/json" -d '{"numbers": ["69:27:0000022:1306","69:27:0000022:1307"] }'
```

<b>Documentation</b>
README.md

<b>Screens</b>


WEB: http://localhost:8000/screen/web.png

REST: http://localhost:8000/screen/rest.png

PhpUnit: http://localhost:8000/screen/phpunit.png

Console: http://localhost:8000/screen/console.png

OR on github in branch "bigland"

https://github.com/vladimirovpyu/bigland/tree/bigland/public/screen/
