<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/08/2016
 * Time: 09:21
 */

namespace Ovs\SlimUtils;


use Symfony\Component\Yaml\Yaml;

class Configuration
{

    public $config;

    public function __construct()
    {
        $this->parseConfig();
    }

    public function getConfigDir()
    {
        return __DIR__."/../../../config/";
    }


    protected function getConfigFiles()
    {
        return array(
            $this->getConfigDir()."config.yml"
        );
    }

    public function parseConfig()
    {

        $config = array();
        $files = $this->getConfigFiles();

        foreach ($files as $file){
            $config = array_merge_recursive($config, Yaml::parse(file_get_contents($file)));
        }

        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }


}