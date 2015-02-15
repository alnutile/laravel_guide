## Oauth Server with L5

See docs


## Install notes

Set the ADMIN_PASSWORD as seen in the .env.example

~~~
php artisan migrate
php artisan db:seed
php artisan db:seed --class=ClientsTableSeeder
~~~

