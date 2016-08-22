<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/08/2016
 * Time: 16:05
 */

namespace Ovs\SlimUtils;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Ovs\Bovimarket\Api\Api;
use Ovs\Bovimarket\Services\Api\EntiteFetcherService;
use Ovs\Bovimarket\Services\CuissonsFetcherService;
use Ovs\Bovimarket\Services\MorceauxFetcherService;
use Ovs\Bovimarket\Services\RecettesFetcherService;
use Ovs\Bovimarket\Twig\MapMarkerExtension;
use Psr7Middlewares\Middleware;
use Slim\App;
use Slim\Container;
use Slim\Http\Stream;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

class ServicesManager
{
    /**
     * @param Container $container
     */
    public static function registerServices(&$container)
    {
        $container['view'] = function ($container) {
            $view = new Twig(
                array(
                    __DIR__ . "/../Bovimarket/Resources/views",
                    'views/'
                ),
                [
                    'cache'       => 'cache/',
                    'auto_reload' => true
                ]
            );
            $view->addExtension(new TwigExtension(
                $container['router'],
                $container['request']->getUri()
            ));

            $view->addExtension(new MapMarkerExtension());

            return $view;
        };

        $configLog = $container->settings["logger"];
        $logger = new Logger($configLog["name"]);
        $logPath = __DIR__ . "/../../../logs/" . $configLog["path"];
        $file_handler = new StreamHandler($logPath);
        $logger->pushHandler($file_handler);
        $container['logger'] = $logger;


        $configApi = $container->settings["api"];
        $container["api"] = new Api(
            [
                "base_uri" => $configApi["baseURI"],
                "headers"  => [
                    "Authorization" => "Bearer ".$configApi["token"]
                ]
            ],
            $container["logger"]
        );

        $container["morceaux"] = new MorceauxFetcherService();
        $container["recettes"] = new RecettesFetcherService();
        $container["cuissons"] = new CuissonsFetcherService();

        $container["entites"] = new EntiteFetcherService($container["api"]);
    }


    public static function registerMiddlewares(App $app)
    {

        Middleware::setStreamFactory(function ($file, $mode) {
            return new Stream(fopen($file,$mode));
        });


        $middlewares=array(
            Middleware::FormatNegotiator(),
            Middleware::AuraSession()->name('boviSession'),
            function ($request, $response, $next) {
                //Get the session instance
                $session = Middleware\AuraSession::getSession($request);
                $request->withAttribute("session",$session);

                return $next($request,$response);
            }
        );

        foreach ($middlewares as $middleware) {
            $app->add($middleware);
        }

        if($app->getContainer()->settings["debug"]){
            $app->add(
                Middleware::DebugBar()->captureAjax(true)
            );
        }

    }
    
}