# PHP-MVC

An extremely simple and easy to understand MVC skeleton application, reduced to the max.
Everything is **as simple as possible**, as **manually as possible** and as readable as possible.
This project is - by intention - NOT a full framework, it's a bare-bone structure, written in
purely native PHP ! The php-mvc skeleton tries to be the extremely slimmed down opposite of big frameworks
like Zend2, Symfony or Laravel.

[![Donate by server affiliate sale](_tutorial/support-a2hosting.png)](https://affiliates.a2hosting.com/idevaffiliate.php?id=4471&url=579)


## Why does this project exist ?

One of the biggest question in the PHP world is "How do I build an application ?".
It's hard to find a good base, a good file structure and useful information on that, but at the same time
there are masses of frameworks that might be really good, but really hard to understand, hard to use and extremely
complex. This project tries to be some kind of naked skeleton bare-bone for quick application building,
especially for the not-so-advanced coder.


### Goals of this project:

- give people a clean base MVC structure to build a modern PHP application with
- teach people the basics of the Model-View-Controller architecture
- encourage people to code according to PSR 1/2 coding guidelines
- promote the usage of PDO
- promote the usage of external libraries via Composer
- promote development with max. error reporting
- promote to comment code
- promote the usage of OOP code
- using only native PHP code, so people don't have to learn a framework

## Support forum

If you are stuck with something even AFTER reading and following the install tutorials and the quick-manual, then feel free to ask in the [official forum](http://forum.php-mvc.net/). Note that this forum is fresh and new, more content will come over time.

## Installation

### On Windows 7 (with EasyPHP)

There's a tutorial on [How to install php-mvc on Windows 7, 8 and 8.1](http://www.dev-metal.com/install-php-mvc-windows-7/).

### On Ubuntu etc.

First, copy this repo into a public accessible folder on your server.
Common techniques are a) downloading and extracting the .zip / .tgz by hand, b) cloning the repo with git (into var/www)

```
git clone https://github.com/JoeFavara/php-mvc1.git /var/www
```

or c) getting the repo via Composer (here we copy into var/www)

```
composer create-project JoeFavara/php-mvc1 /var/www dev-master
```

1. Install mod_rewrite, for example by following this guideline:
[How to install mod_rewrite in Ubuntu](http://www.dev-metal.com/enable-mod_rewrite-ubuntu-12-04-lts/)

2. Run the SQL statements in the *application/_install* folder.

3. Change the .htaccess file from
```
RewriteBase /php-mvc/
```
to where you put this project, relative to the web root folder (usually /var/www). So when you put this project into
the web root, like directly in /var/www, then the line should look like or can be commented out:
```
RewriteBase /
```
If you have put the project into a sub-folder, then put the name of the sub-folder here:
```
RewriteBase /sub-folder/
```

4. Edit the *application/config/config.php*, change this line
```php
define('URL', 'http://127.0.0.1/php-mvc1/');
```
to where your project is. Real domain, IP or 127.0.0.1 when developing locally. Make sure you put the sub-folder
in here (when installing in a sub-folder) too, also don't forget the trailing slash !

5. Edit the *application/config/config.php*, change these lines
```php
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'php-mvc');
define('DB_USER', 'root');
define('DB_PASS', 'mysql');
```
to your database credentials. If you don't have an empty database, create one. Only change the type `mysql` if you
know what you are doing.

## A quickstart tutorial

You can also find these tutorial pictures in the *_tutorial* folder.

![php-mvc introduction tutorial - page 1](_tutorial/tutorial-part-01.png)
![php-mvc introduction tutorial - page 2](_tutorial/tutorial-part-02.png)
![php-mvc introduction tutorial - page 3](_tutorial/tutorial-part-03.png)
![php-mvc introduction tutorial - page 4](_tutorial/tutorial-part-04.png)
![php-mvc introduction tutorial - page 5](_tutorial/tutorial-part-05.png)

## You like what you see ?

Then please also have a look on ...

#### My other project

Some of my earlier PHP explorations with DAO:

https://github.com/JoeFavara/MyFirstPhpProject


## Useful information

1. SQLite does not have a rowCount() method (!). Keep that in mind in case you use SQLite.

2. Don't use the same name for class and method, as this might trigger an (unintended) *__construct* of the class.
   This is really weird behaviour, but documented here: [php.net - Constructors and Destructors](http://php.net/manual/en/language.oop5.decon.php).

## Add external libraries via Composer

To add external libraries/tools/whatever into your project in an extremely clean way, simply add a line with the
repo name and version to the composer.json! Take a look on these tutorials if you want to get into Composer:
[How to install (and update) Composer on Windows 7 or Ubuntu / Debian](http://www.dev-metal.com/install-update-composer-windows-7-ubuntu-debian-centos/)
and [Getting started with Composer](http://www.dev-metal.com/getting-started-composer/).

## License

This project is licensed under the MIT License.
This means you can use and modify it for free in private or commercial projects.

## Contribute

Please commit into the develop branch (which holds the in-development version), not into master branch
(which holds the tested and stable version).


## Linked music tracks in the demo application

The linked tracks in this naked application are just some of my personal favourites of the last few months.
I think it's always a good idea to fill boring nerd-code stuff with quality culture.
