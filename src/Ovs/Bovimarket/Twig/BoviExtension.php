<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 10:28
 */

namespace Ovs\Bovimarket\Twig;


use Doctrine\ORM\EntityManager;
use Ovs\Bovimarket\Api\Api;
use Ovs\Bovimarket\Entities\Api\Creneau;
use Ovs\Bovimarket\Entities\Api\Produit;
use Ovs\Bovimarket\Entities\Morceaux;
use Ovs\Bovimarket\Entities\Panier;
use Ovs\Bovimarket\Entity\RecetteFavoris;
use Ovs\Bovimarket\Services\RecettesFetcherService;
use Ovs\Bovimarket\Utils\Session;
use Ovs\Bovimarket\Utils\Utils;

class BoviExtension extends \Twig_Extension
{
    protected $api;
	protected $session;
	/** @var  EntityManager */
	protected $em;

	/** @var  RecettesFetcherService */
	protected $recetteFetcher;

    /**
     * MapMarkerExtension constructor.
     */
    public function __construct(Api $api,$session,$em,$recetteFetcher)
    {
        $this->api = $api;
	    $this->session = $session;
	    $this->em = $em;
	    $this->recetteFetcher = $recetteFetcher;
    }


    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return "create_map_marker";
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction("createMarker", array($this, "createMarker"), array(
                "is_safe"           => array("html"),
                "needs_environment" => true
            )),
            new \Twig_SimpleFunction("mapDecoupe", array($this, "createDecoupe"), array(
                "is_safe"           => array("html"),
                "needs_environment" => true
            )),
            new \Twig_SimpleFunction("apiImagePath", array($this, "getApiImagePath"), array(
                "is_safe" => array("html")
            )),
            new \Twig_SimpleFunction("isInCart",array($this,"isInCart"),array(
                "is_safe"=>array("html")
            )),
            new \Twig_SimpleFunction("renderHoraire",array($this,"renderHoraire"),array(
                "is_safe"=>array("html")
            )),
	        new \Twig_SimpleFunction("isFavorite",array($this,"isFavorite"),array(
	        	"is_safe"=>array("html")
	        )),
	        new \Twig_SimpleFunction("getFavorites",array($this,"getFavoris"),array(
	        	"is_safe"=>array("html")
	        )),
	        new \Twig_SimpleFunction("getRecettesFav",array($this,"getRecetteFavoris"),array(
	        	"is_safe"=>array("html")
	        ))
        );
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter("total",array($this,"calculTotalPanier"),array(
                "is_safe"=>array("html")
            ))
        );
    }

    public function calculTotalPanier(Panier $panier)
    {
        $total = 0;
        foreach ($panier->getLignes() as $produit) {
            $total+=(intval($produit["qte"])*intval($produit["prix"]));
        }
        return $total;
    }


    public function createDecoupe(\Twig_Environment $env, Morceaux $morceaux)
    {
        return $env->render("QRCode/decoupes/map_" . $morceaux->getTypeViande() . ".html.twig", array("morceau" => $morceaux));
    }

    public function createMarker(\Twig_Environment $env, $entite)
    {
        return $env->render("Block/marker.html.twig", array("entite" => $entite));
    }

    public function getApiImagePath($path)
    {
        if($path) {
            return $this->api->getResourcesPath() . "/" . $path;
        }else{
            return Utils::getImage("nophoto.png");
        }
    }

    public function isInCart(Produit $produit, Panier $cart)
    {
        if(in_array($produit->getId(),array_keys($cart->getLignes()))){
            return "PanierSelect";
        }else{
            return "Panier";
        }
    }

    public function renderHoraire(Creneau $creneau)
    {
        $jours = array(
            1=>"Lundi",
            2=>"Mardi",
            3=>"Mercredi",
            4=>"Jeudi",
            5=>"Vendredi",
            6=>"Samedi",
            7=>"Dimanche"
            );

        $debut = $this->millsecsToHours($creneau->getDebut());
        $fin = $this->millsecsToHours($creneau->getFin());

        return $jours[$creneau->getJour()]." de ".$debut." à ".$fin;
    }

    protected function millsecsToHours($duree)
    {
        $secondes = $duree/1000;
        $heures = intval($secondes/3600);
        $minutes = intval($secondes%3600)/60;

        return sprintf("%02d:%02d",$heures,$minutes);
    }

	public function isFavorite($idEntite) {
		$favs = $this->session->get(Session::favoris,array());
		foreach ($favs as $fav){
			if($fav->id == $idEntite)
				return true;
		}
		return false;
    }

	public function getFavoris() {
		return $this->session->get(Session::favoris,array());
    }

	public function getRecetteFavoris() {
		$recettesFav = $this->em->getRepository(RecetteFavoris::class)->findForUser($this->session->get(Session::loggedUserSessionKey));
		$recettes = array();

		/** @var RecetteFavoris $rec */
		foreach ($recettesFav as $rec){
			$recs=$this->recetteFetcher->getRecettesForViande($rec->getRecetteType());
			$recette = $recs->find($rec->getRecetteId());
			if($recette) {
				$recettes[] = $recette;
			}
		}
		return $recettes;
    }


}