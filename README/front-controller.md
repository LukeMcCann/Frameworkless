# The Front Controller

The front controller is a central part of most (if not all frameworks). The confusion for most people occurs in the separate concept of the front controller. Most frameworks will have a front controller, but obscure the concept with that of the MVC architecutre on which they thrive. 

To put it simply, the front controller is the main entry point of your applcation, every application you build should have a single point of entry, easing centralised tasks (such as logging, database conectivity, session handling). This means only one location for changing centralised tasks. A single entry point also only leaves one end open to potential threats, please note there are circumstances in which you may want/need more than a single entrypoint. Overall, a front controller is about keeping your project [DRY](https://en.wikipedia.org/wiki/Don%27t_repeat_yourself) and maintainable.

## Setting up a Front Controller

To begin, create an empty directory for your project, within this directory you should have a <code>public</code> directory containing a <code>index.php</code> file. You should redirect your requests in your webserver to process all requests through this entrypoint, this varies between webservers and may require some research to get started.

For instance, in apache webservers you will configure various .htaccess files to redirect the requests, alternatively if you are using NGINX you will need to configure your server properties in the default.conf file. An example of an NGINX setup can be viewed here: https://github.com/PlanetDebug/LEMP-PHPMyAdmin-SQL-Scripts/tree/master/nginx

In doing this you prevent access to all subdirectories outside of the public folder. While the same can be achieved having your <code>index.php</code> in with the rest of your project files, but hosting all of your public files within their own directory decreases the chances of accidental access to your private directories and files, aswell as keeping your project folders organised. 

## PHP Strict Types

PHP 7 introduces the concept of scalar type declarations with strict type flags. Scalars are similar to primitive types, in that they are available in a language as a predefined data type. Scalars are a single value: integer, boolean, float, string, etc... whilst compound types are built of multiple scalars. Declaring strict mode in PHP applies strict mode to only that file, therefore must be done at the beginning of every file. Strict typing emplores the use of proper code practices, forcing you to use proper typing, strict typing forces you to write code that is readable, by disallowing the automatic conversion of data types, forcing you to correctly declare your injected dependencies. Using type hinting without strict typing can result in subtle bugs which are difficult to debug. The current scope is also treated strictly, improving tracability of the code. 

## The Front Controller

Inside your front controller you should first require your bootstrapping file:

<code>

    declare(strict_types = 1); 

    require_once dirname(__DIR__) . '/App/bootstrap.php';

</code>

Here we declare our strict mode, requiring our bootstrap.php from the <code>App</code> folder. The bootstrap folder will handle loading our dependencies and additional files, instantiate classes necessary for libraries which persist throughout the project etc... 

Finally, in your <code>bootstrap.php</code> enter the following:

<code>

    declare(strict_types = 1);

    echo 'Hello World!';

</code>

If you have written any form of code before you know what this does already. This is simply here to test our bootstrap is being required in correctly, head to your webserver URL in the browser (if you are using my Docker setup this will be [http://localhost:8080](http://localhost:8080)

Alternatively, you can use PHPs built in server: <code>php -S localhost:8080</code>

## Code

- <code>require_once</code> is identical to <code>require</code> except that PHP checks if the file has already been included. If it has, it wil not include it agian. 

- <code>dirname</code> returns the path of the parent directory

- <code>__DIR__</code> is a magic 
constant, this returns the directory of the file and is akin to running <code>dirname(__FILE__)</code>
## Afterthoughts

If you are still struggling to understand the concept of a front controller, you can think of it as the app entrypoint, akin to the <code>Main</code> class in other applcations (if you are coming from a non-web or Java background).

[<< prev](../READme.md) | [next >>](composer.md)