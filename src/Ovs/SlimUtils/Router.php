<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 08:54
 */

namespace Ovs\SlimUtils;


use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Symfony\Component\Yaml\Yaml;

class Router
{
    public static function registerRoutes(App $app)
    {

        /** @var Configuration $config */
        $config = $app->getContainer()->get("configService");

        $routes = Yaml::parse(file_get_contents($config->getConfigDir()."/routes.yml"));


        foreach ($routes as $name=>$route) {
            $methods=array("GET");
            if(!isset($route["path"]) || !isset($route["action"])){
                continue;
            }

            $path = $route["path"];
            $action = $route["action"]."Action";

            if(isset($route["methods"])){
                $methods = $route["methods"];
            }
            $app->map($methods,$path,$action)->setName($name);
        }
    }
}