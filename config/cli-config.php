<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require __DIR__.'/../vendor/autoload.php';

$config=new \Ovs\SlimUtils\Configuration();
$configArray=$config->getConfig();

$settings = $configArray;
$settings = $settings['settings']['doctrine'];

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
	$settings['meta']['entity_path'],
	$settings['meta']['auto_generate_proxies'],
	__DIR__."/../".$settings['meta']['proxy_dir'],
	$settings['meta']['cache'],
	false
);

$em = \Doctrine\ORM\EntityManager::create($settings['connection'], $config);

return ConsoleRunner::createHelperSet($em);