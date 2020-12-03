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

throw new \Exception;
 