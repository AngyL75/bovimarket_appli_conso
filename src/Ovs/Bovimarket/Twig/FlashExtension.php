<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 31/08/2016
 * Time: 15:17
 */

namespace Ovs\Bovimarket\Twig;


class FlashExtension extends \Twig_Extension
{

    protected $flashes;

    /**
     * FlashExtension constructor.
     */
    public function __construct($session)
    {
        $flashes = $session->getFlash("flashes");
        $this->flashes = $flashes;
    }


    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return "flash_extension";
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction("hasFlashes",array($this,"hasFlash")),
            new \Twig_SimpleFunction("getFlash",array($this,"getFlash")),
            new \Twig_SimpleFunction("getFlashes",array($this,"getFlashes")),
        );
    }

    public function getFlashes()
    {
        return $this->flashes;
    }

    public function getFlash($type)
    {
        return $this->flashes[$type];
    }

    public function hasFlash()
    {
        return count($this->flashes)>0;
    }


}