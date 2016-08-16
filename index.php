<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 11/08/2016
 * Time: 17:56
 */

use Ovs\SlimUtils\Router;
use Ovs\SlimUtils\ServicesManager;
use Slim\App;
use Slim\Container;
use Ovs\SlimUtils\Configuration;

require "vendor/autoload.php";

$config=new Configuration();
$configArray=$config->getConfig();
$container = new Container($configArray);
$container["configService"]=$config;
ServicesManager::registerServices($container);

$app = new App($container);
Router::registerRoutes($app);

$app->run();