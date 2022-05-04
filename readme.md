# guetbook
Application to add guest detail and detail will be approve/disapprove by Admin.

Step 1). get clone of repo.

Step 2). composer install

Step 3). sudo yarn encore dev (In production need to run prod)

Step 3). in .env file give your database detail.

Step 4). php bin/console doctrine:database:create

Step 5). php php bin/console doctrine:migrations:migrate

Step 6). php bin/console doctrine:fixtures:load

Step 7). php bin/console server:run

Step 8). Following is login for admin. when you run in local 127.0.0.1:8000/login
username:- admin
password:- admin