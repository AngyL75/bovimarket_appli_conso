<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/08/2016
 * Time: 16:05
 */

namespace Ovs\SlimUtils;


use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Ovs\Bovimarket\Api\Api;
use Ovs\Bovimarket\Services\MorceauxFetcherService;
use Ovs\Bovimarket\Twig\MapMarkerExtension;
use Slim\Container;
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
                    __DIR__."/../Bovimarket/Resources/views",
                    'views/'
                ),
                [
                'cache' => 'cache/',
                'auto_reload'=>true
                ]
            );
            $view->addExtension(new TwigExtension(
                $container['router'],
                $container['request']->getUri()
            ));

            $view->addExtension(new MapMarkerExtension());

            return $view;
        };

        $container['logger'] =function($container) {
            $configLog = $container->settings["logger"];
            $logger = new Logger($configLog["name"]);
            $logPath=__DIR__."/../../../logs/".$configLog["path"];
            $file_handler = new StreamHandler($logPath);
            $logger->pushHandler($file_handler);
            $logger->pushHandler(new FirePHPHandler());
            $logger->addInfo('My logger is now ready');
            return $logger;
        };

        $container["api"]=new Api();
        $container["morceaux"]=new MorceauxFetcherService();
    }
}