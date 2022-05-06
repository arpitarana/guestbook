# guetbook
Application to add guest detail and detail will be approve/disapprove by Admin.

Step 1). get clone of repo.

Step 2). composer install

Step 3). php bin/console fos:js-routing:dump --format=json --target=public/js/fos_js_routes.json

Step 4). sudo yarn encore dev (In production need to run prod)

Step 5). in .env file give your database detail.

Step 6). php bin/console doctrine:database:create

Step 7). php php bin/console doctrine:migrations:migrate

Step 8). php bin/console doctrine:fixtures:load

Step 9). php bin/console server:run

Step 10). Following is login for admin. when you run in local 127.0.0.1:8000/login
username:- admin
password:- admin

Step 11). to run unit test follow the steps 
php bin/console doctrine:database:create --env=test
php bin/console doctrine:migrations:migrate --env=test
php bin/console doctrine:fixtures:load  --env=test
php -dxdebug.mode=coverage bin/phpunit --coverage-html tests/coverage