# Error Handling

Error handling is essential to modern applications. Not only do we need clear errors for debugging, we also want our applications to fail elegantly in the case of something unexpected occurring (and it will).

We want a nice clear, concise error page, containing all of the necessary information for development, but just enough information for when we release to production. In this project <code>filp/whoops</code> is used. Other handlers also exist such as <code>PHP-error</code>.

To install this package, you can either edit the <code>composer.json</code> directly and then run <code>composer update</code>, or alternatively, and the way I would do it, you can simply run <code>composer require filp/whoops</code>.

First step complete, however, Simply requiring this package in composer is not enough. PHP must be told where to find our files, this is done through the use of the composer autoloader, much like how we require our custom files through namespaces, we must also include our vendor folders autoloader early on in the project. I conduct this within the <code>bootstrap.php</code> registering the error handler based upon whether or not we are working in a production or dev environment

<pre>
    declare(strict_types=1);

    namespace App;

    require dirname(__DIR__) . '/vendor/autoload.php';

    $environment = $_ENV['APP_ENV'];

    /**
    * Register the error handler
    */
    $whoops = new \Whoops\Run;
    if ($environment !== 'production') {
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    } else {
        $whoops->pushHandler(function($e){
            // TODO: Prod friendly error page
        });
    }
    $whoops->register();

    throw new \Exception;
</pre>

If this loads correctly you should receive a pretty error page upon refreshing your browser. This is however, still incomplete. Whilst we have required and registered our error handler, we are currently retrieving our <code>APP_ENV</code> from the <code>.env</code> file. However, we have not yet populated our <code>$_ENV[]</code> array, so our variable will not be accessible.

Here we need to install another dependency: <code>vlucas/phpdotenv</code> After requring this library in via <code>composer</code> it must be instantiated early on within the project before it can be used.

<pre>
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
</pre>

Up to this point you should have something like this in your <code>bootstrap.php</code>:

<pre>
    declare(strict_types=1);

    namespace App;

    require dirname(__DIR__) . '/vendor/autoload.php';

    /**
    * Initialise PHPDotEnv
    */
    $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();

    $environment = $_ENV['APP_ENV'];

    /**
    * Register the error handler
    */
    $whoops = new \Whoops\Run;
    if ($environment !== 'production') {
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    } else {
        $whoops->pushHandler(function($e){
            // TODO: Prod friendly error page
        });
    }
    $whoops->register();

    throw new \Exception;
</pre>

# DotEnv

Why do we use DotEnv? why not just hard code the values? security. By defining our variables in our <code>Config.php</code> as such:

<pre>
    // DB Params
    define('DB_HOST', $_ENV['DB_HOST']);
    define('DB_PORT', $_ENV['DB_PORT']);

    define('DB_NAME', $_ENV['DB_NAME']);
    define('DB_ROOT_USER', $_ENV['DB_ROOT_USER']);
    define('DB_ROOT_PWD', $_ENV['DB_ROOT_PWD']);

    define('DB_USER', $_ENV['DB_USER']);
    define('DB_PWD', $_ENV['DB_PWD']);

    // App Root
    define('APPROOT', dirname(dirname(__FILE__)));

    // URL Root
    define('URLROOT', $_ENV['URLROOT']);

    // Site Name
    define('SITENAME', $_ENV['APPNAME']);

    // Show errors for development
    define('SHOW_ERRORS', false);
</pre>

We add our environment files to our <code>$_ENV</code> global. This allows us to have a single file containing all of our configurations, which can then be accessed from wihtin our application without the need to give concrete values. By specifying our environment variables in our <code>.env</code> we can add our <code>.env</code> file to our <code>.gitignore</code> preventing our concrete values (such as database passwords) being committed into version control. 

[<< prev](composer.md) | [next >>](http.md)