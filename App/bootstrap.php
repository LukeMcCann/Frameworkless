<?php declare(strict_types=1);

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

/**
 * Create HTTP Request and Response Objects
 */
$request = new \Http\HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
$response = new \Http\HttpResponse;

foreach ($response->getHeaders() as $header) {
    header($header, false);
}

$content = '<h1>Hello World</h1>';
$response->setContent($content);

echo $response->getContent();
 