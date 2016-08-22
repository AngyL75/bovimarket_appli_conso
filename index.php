<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 11/08/2016
 * Time: 17:56
 */

ini_set("display_errors",1);
use Doctrine\Common\Annotations\AnnotationRegistry;
use Ovs\SlimUtils\Router;
use Ovs\SlimUtils\ServicesManager;
use Slim\App;
use Slim\Container;
use Ovs\SlimUtils\Configuration;

require "vendor/autoload.php";

AnnotationRegistry::registerLoader(function($class){
    $file = explode("\\",$class);
    $file = array_pop($file);
    require __DIR__. "/vendor/jms-serializer/serializer/src/Annotation/".$file.".php";
    return true;
});

$config=new Configuration();
$configArray=$config->getConfig();
$container = new Container($configArray);
$container["configService"]=$config;
ServicesManager::registerServices($container);

$app = new App($container);
ServicesManager::registerMiddlewares($app);
Router::registerRoutes($app);

$app->run();