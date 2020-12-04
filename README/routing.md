# Routing

Routing dispatches different handlers dependent on the rules set up. Taking [Bjornstad2](https://github.com/Kodriboh/Bjornstad2) for example, the routing methodology applied here parses the URL using regex matching to retrieve the <code>controller/method/params</code> passed via the querystring. Alternatively, the original [Bjornstad](https://github.com/Kodriboh/Bjornstad-MVC-Bootstrap) uses a different method of routing wherein the URL is parsed and split using the explode method to retrieve the <code>controller/method/params</code>

Routing directs requests coming into our application via our front controller to the correct controller/handler designed for handling that specific request. This is conducted via the use of a routing table in advanced systems such as those used in frameworks like [Laravel](https://github.com/laravel/laravel).

Setting up routing can be a complex and time-consuming task (possibly the most complex part of building your own framework), therefore it is much faster to set up a project, and better, to outsource our routing to a well tested, well respected library. Here we will use [FastRoute](https://github.com/nikic/FastRoute).

Alternatively you may choose to use: [symfony/Routing](https://github.com/symfony/Routing), [Aura.Router](https://github.com/auraphp/Aura.Router), [fuelphp/routing](https://github.com/fuelphp/routing), [Klein](https://github.com/chriso/klein.php)

After installing this dependency, replace the hello world from the last chapter with the following snippet:

<pre>
    $dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
        $r->addRoute('GET', '/hello-world', function () {
            echo 'Hello World';
        });
        $r->addRoute('GET', '/another-route', function () {
            echo 'This works too';
        });
    });

    $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());
    switch ($routeInfo[0]) {
        case \FastRoute\Dispatcher::NOT_FOUND:
            $response->setContent('404 - Page not found');
            $response->setStatusCode(404);
            break;
        case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $response->setContent('405 - Method not allowed');
            $response->setStatusCode(405);
            break;
        case \FastRoute\Dispatcher::FOUND:
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];
            call_user_func($handler, $vars);
            break;
    }
</pre>

Firstly, we register our available routes to the routing table. Then the dispatcher is called, with the corresponding switch statement being executed. If a matching route is discovered the handler callable is executed. 

Since our <code>bootstrap.php</code> will become very quickly cluttered. We should therefore move our routes into their own file <code>web.php</code>. This will simply return the available routes:

<pre>
    return [

        ['GET', '/hello-world', function () {
            echo 'Hello World';
        }],

        ['GET', '/another-route', function () {
            echo 'This works too';
        }],
        
    ];
</pre>

# Dispatching

According to [Anthony Farrara](https://www.linkedin.com/in/ircmaxell/) & [Patrick Louys](https://patricklouys.com/about/) while MVC is a useful concept, it is not possible to truly implement in it's pure form with PHP. Anthony Ferrara explains this in detail in his article [A Beginners Guide to MVC For The Web](https://blog.ircmaxell.com/2014/11/a-beginners-guide-to-mvc-for-web.html) in which he explains the underlying issues with MVC and the fundamental communication difficulties of rendering with the view, the wasted resources from continuous state management of a stateful system. Anthony Ferrara concludes that what we should take from MVC is the general communciation and separation of responsibilities to split applications into different sections following SOLID's single responsibility principle, latching onto abstraction rather than MVC itself. 

For dispatching we should first define a <code>HomeController</code>:

<pre>
    declare(strict_types = 1);

    namespace Example\Controllers;

    class Homepage
    {
        public function show()
        {
            echo 'Hello World';
        }
    }
</pre>

We can then change our routing to call this method instead of the callback function defined in <code>bootstrap.php</code>:

<pre>
    return [
        ['GET', '/', ['App/Controllers/HomeController.php', 'show']],
    ];
</pre>

This then requires a further refactor to our switch statement, specificlaly our actions of when a corresponding class/method are found; 

<pre>
    switch ($routeInfo[0]) {
        case \FastRoute\Dispatcher::NOT_FOUND:
            $response->setContent('404 - Page not found');
            $response->setStatusCode(404);
            break;
        case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $response->setContent('405 - Method not allowed');
            $response->setStatusCode(405);
            break;
        case \FastRoute\Dispatcher::FOUND:
            $className = $routeInfo[1][0];
            $method = $routeInfo[1][1];
            $vars = $routeInfo[2];
                
            $class = new $className;
            $class->$method($vars);
            break;
    }
</pre>