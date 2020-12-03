# HTTP

PHP provides some quality of life integrations to make working with HTTP requests simpler. Using superglobals providing access to query strings etc...

These are fine for writing small scripts, however, to write clean maintainable code for larger applications we need something with a more object oriented interface, and further abstractions. 

Alternative HTTP Solutions: [Symfony HttpFoundation](https://github.com/symfony/HttpFoundation), [Nette HTTP Component](https://github.com/nette/http), [Aura Web](https://github.com/auraphp/Aura.Web), [sabre/http](https://github.com/fruux/sabre-http)

For this project I will use [Patrick Louis](https://github.com/PatrickLouys/http) HTTP component. As such, following the documentation provided, I will instantiate a new HttpRequest object within my <code>bootstrap.php</code>:

<pre>
    $request = new \Http\HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
    $response = new \Http\HttpResponse;
</pre>

This sets up a <code>Request</code> and <code>Response</code> object which can be used in other classes to get requests and return responses. This will seem familiar if you have experience working with frameworks such as [Laravel](https://github.com/laravel/laravel).

At the end of your <code>bootstrap.php</code> you will also need to include the following in order to send responses:

<pre>
    
    foreach ($response->getHeaders() as $header) {
        header($header, false);
    }
    echo $response->getContent();
</pre>

This will send a response directly to the browser, since the response object only stores data. Alternative HTTP dependencies send this automatically, therefore this may not be required when using alternative HTTP dependencies. The false flag prevents the original headers being overwritten. 

To test this is working you may place this within (or between) the for loop:

<pre>
    $content = 'Hello World';
    $response->setContent($content);

                 or

    $response->setContent('404 - Page not found');
    $response->setStatusCode(404);
</pre>

[<< prev](error-handling.md) | [next >>](.md)