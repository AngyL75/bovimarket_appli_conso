<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 11/08/2016
 * Time: 17:56
 */

use Doctrine\Common\Annotations\AnnotationRegistry;
use Ovs\SlimUtils\Router;
use Ovs\SlimUtils\ServicesManager;
use Slim\App;
use Slim\Container;
use Ovs\SlimUtils\Configuration;

require "vendor/autoload.php";

setlocale( LC_ALL, "fr_FR" );

$config      = new Configuration();
$configArray = $config->getConfig();

if ( $configArray["settings"]["debug"] ) {
	ini_set( "display_errors", 1 );
} else {
	ini_set( "display_errors", 0 );
}


$container = new Container( $configArray );
$container["configService"] = $config;


AnnotationRegistry::registerLoader(function($class){
	$file     = explode( "\\", $class );
	$file     = array_pop( $file );
	$filePath = __DIR__ . "/vendor/doctrine/orm/lib/Doctrine/Common/" . $file . ".php";
	if ( file_exists( $filePath ) ) {
		require_once $filePath;
		return true;
	}
	return false;
});
AnnotationRegistry::registerLoader( function ( $class ) {
	$file     = explode( "\\", $class );
	$file     = array_pop( $file );
	$filePath = __DIR__ . "/vendor/jms-serializer/serializer/src/Annotation/" . $file . ".php";
	if ( file_exists( $filePath ) ) {
		require_once $filePath;
		return true;
	}
	return false;
} );

ServicesManager::registerServices( $container );

$app = new App( $container );
ServicesManager::registerMiddlewares( $app );
Router::registerRoutes( $app );

$app->run();