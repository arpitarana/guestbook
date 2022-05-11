# guestbook
Application to add guest detail and detail will be approve/disapprove by Admin.
Spade
=====

Welcome to Guestbok - a fully-functional Symfony2 application.

This document contains information on how to download, install, and start
using Guestbook as a developer.

# Prerequisite to set up this project

    PHP 7.4.*
    git
    Symfony 4.4
    Composer 2.*
    Bootstrap 4
    Doctrine 2

1) Installing Guestbook
-------------------

When it comes to installing Guestbook, you need to follow the following steps.

### Install and configure git

As Guestbook is stored on github, you need to install git in order to be able
to fetch it.

Git can be installed on various ways, depending on the environment:

* On Mac OS: download and install git from [the git website][1]

### Fetch the project

Guestbook can be fetched using the following command:

    git clone https://github.com/arpitarana/guetbook.git
    git checkout master    

### Set up rights

Both your web and current user need to be able to write and read from your
`app/cache` and `app/logs` directories.

On OS X, you need to execute the following commands in your project's directory:

    rm -rf app/cache/*
    rm -rf app/logs/*
    sudo chmod +a "www-data allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs
    sudo chmod +a "yourname allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs

On Ubuntu or Debian, you need to execute the following commands:

    sudo setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs
    sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs

You may also need to [activate ACL file permissions][3]


### Install Composer

As Spade uses [Composer][2] to manage its dependencies, the tool is needed
to fetch its dependencies.

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    curl -s http://getcomposer.org/installer | php

Then, use the `install` command to generate a new Symfony application:

    php composer.phar install --dev

Composer will install all the project's dependencies under the `vendor`
directory.


2) Getting started with Symfony
-------------------------------

###
    Step 1). php bin/console fos:js-routing:dump --format=json --target=public/js/fos_js_routes.json
    
    Step 2). sudo yarn encore dev (In production need to run prod)
    
    Step 3). in .env file give your database detail.
    
    Step 4). php bin/console doctrine:database:create
    
    Step 5). php php bin/console doctrine:migrations:migrate
    
    Step 6). php bin/console doctrine:fixtures:load
    
    Step 7). php bin/console server:run
    
    Step 8). Following is login for admin. when you run in local 127.0.0.1:8000/login
    username:- admin
    password:- admin
    
    Step 9). to run unit test follow the steps 
    php bin/console doctrine:database:create --env=test
    php bin/console doctrine:migrations:migrate --env=test
    php bin/console doctrine:fixtures:load  --env=test
    php -dxdebug.mode=coverage bin/phpunit --coverage-html tests/coverage

This distribution is meant to be the starting point for your Symfony
applications, but it also contains some sample code that you can learn from
and play with.

A great way to start learning Symfony is via the [Quick Tour][4], which will
take you through all the basic features of Symfony2.

Once you're feeling good, you can move onto reading the official
[Symfony2 book][5].

What's inside?
---------------

Spade is configured with the following defaults:

  * Twig is the only configured template engine;

  * Doctrine ORM/DBAL is configured;

  * Swiftmailer is configured;

  * Annotations for everything are enabled.

It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

  * [**TwigBundle**][8] - Adds support for the Twig templating engine

  * [**SecurityBundle**][9] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][11] - Adds support for Monolog, a logging library

  * [**AsseticBundle**][12] - Adds support for Assetic, an asset processing
    library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev/test env) - Adds code generation
    capabilities

  * **AcmeDemoBundle** (in dev/test env) - A demo bundle with some example
    code

  * **DoctrineFixturesBundle** (in dev/test env) - A bundle which lets you set up
    initial data sets (fixtures), so you can start developing right away

All libraries and bundles included in Spade are released under the MIT
or BSD license.

Enjoy!

[1]:  http://git-scm.com/
[2]:  http://getcomposer.org/
[3]:  https://help.ubuntu.com/community/FilePermissionsACLs
[4]:  http://symfony.com/doc/2.3/quick_tour/the_big_picture.html
[5]:  http://symfony.com/doc/2.3/index.html
[6]:  http://symfony.com/doc/2.3/bundles/SensioFrameworkExtraBundle/index.html
[7]:  http://symfony.com/doc/2.3/book/doctrine.html
[8]:  http://symfony.com/doc/2.3/book/templating.html
[9]:  http://symfony.com/doc/2.3/book/security.html
[10]: http://symfony.com/doc/2.3/cookbook/email.html
[11]: http://symfony.com/doc/2.3/cookbook/logging/monolog.html
[12]: http://symfony.com/doc/2.3/cookbook/assetic/asset_management.html
[13]: http://symfony.com/doc/2.3/bundles/SensioGeneratorBundle/index.html


