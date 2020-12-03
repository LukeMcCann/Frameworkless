# Composer

Composer is a package manager for PHP. If you have come from a front-end background you may think of this in the same way you think of NPM or yarn. Composer quickly rose to become an industry standard for managing PHP dependencies, allowing for easy and quick installation of libraries from a <code>composer.json</code> file. 

If you are using my containers composer is pre-installed in the PHP container. You simply need to <code>exec</code> into the container and run <code>composer init</code>:

<code>

    > docker exec -ti php sh

    # composer init

</code>

Upon initialising you will have a series of questions to fill out which will generate information for wihtin your project. Please note you can also manually create the <code>composer.json</code> and manually edit it, after any manual edits remmeber to run <code>composer update</code>.

<pre>
{
    "name": "planetdebug/frameworkless",
    "description": "A frameworkless template for PHP projects",
    "type": "project",
    "license": "MIT",
    "authors": [
        {
            "name": "Luke McCann",
            "email": "developer-lukemccann@outlook.com",
            "role": "Creator / Lead Developer"
        }
    ],
    "require": {
        "php": ">=7.0.0",
        "vlucas/phpdotenv": "^5.2"
    },
    "autoload": {
        "psr-4": {
            "App \\": "App/",
            "Core \\": "Core/"
        }
    }
}
</pre>

In composer our dependencies are under the <code>require</code> array. We can also specify <code>namespaces</code> to autolod under the <code>autoload</code> array. In this circumstance I have autoloaded the <code>App</code> and <code>Core</code> namespaces, composer will then autoload any classes under these namespaces.

When committing your project to version control it is generally considered good practice to commit the composer.lock as to allow continuous integratoin tools such as <code>CircleCi</code>, <code>TeamCity</code>, <code>Jenkins</code>, and <code>TravisCi</code> to run tests against your exact project build libraries and versions. This also allows contributors to ensure they are using the same versions of dependencies. All dependencies will be added under the <code>/vendor</code> folder, this folder should be included in your <code>.gitignore</code>

[<< prev](front-controller.md) | [next >>](error-handling.md)