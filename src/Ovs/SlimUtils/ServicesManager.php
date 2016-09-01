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
use Ovs\Bovimarket\Entities\Api\OauthToken;
use Ovs\Bovimarket\Entities\Api\Utilisateur;
use Ovs\Bovimarket\Services\API\CanauxFetcherService;
use Ovs\Bovimarket\Services\API\CertificationFetcherService;
use Ovs\Bovimarket\Services\API\CommandeFetcherService;
use Ovs\Bovimarket\Services\Api\EntiteFetcherService;
use Ovs\Bovimarket\Services\API\MenuFetcherService;
use Ovs\Bovimarket\Services\API\ProduitFetcherService;
use Ovs\Bovimarket\Services\API\UtilisateurFetcherService;
use Ovs\Bovimarket\Services\CuissonsFetcherService;
use Ovs\Bovimarket\Services\MorceauxFetcherService;
use Ovs\Bovimarket\Services\RecettesFetcherService;
use Ovs\Bovimarket\Twig\BoviExtension;
use Ovs\Bovimarket\Twig\FlashExtension;
use Ovs\Bovimarket\Utils\Session;
use Ovs\Bovimarket\Utils\UserManager;
use Psr7Middlewares\Middleware;
use Slim\App;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
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
        $container["config"] = $container->settings;
        $configApi = $container->settings["api"];
        $configLog = $container->settings["logger"];


        $logger = new Logger($configLog["name"]);
        $logPath = realpath(__DIR__) . "/../../../logs/" . $configLog["path"];
        $file_handler = new StreamHandler($logPath);
        $logger->pushHandler($file_handler);
        $container['logger'] = $logger;

        $container["oauth"] = new UserManager(
            $container,
            new Api(
                array(
                    "base_uri" => $configApi["baseURI"]
                ),
                $logger
            ),
            $configApi["oauthLogin"],
            $configApi["oauthSecret"]
        );


        $container["morceaux"] = new MorceauxFetcherService();
        $container["recettes"] = new RecettesFetcherService();
        $container["cuissons"] = new CuissonsFetcherService();

        $container['view'] = function ($container) {
            $view = new Twig(
                array(
                    realpath(__DIR__ . "/../Bovimarket/Resources/views"),
                    'views/'
                ),
                [
                    'debug'       => true,
                    'cache'       => 'cache/',
                    'auto_reload' => $container->settings["debug"]
                ]
            );
            $view->addExtension(new TwigExtension(
                $container['router'],
                $container['request']->getUri()
            ));

            $view->addExtension(new \Twig_Extension_Debug());

            $view->addExtension(new \Twig_Extensions_Extension_Intl());

            return $view;
        };
    }


    public static function registerMiddlewares(App $app)
    {

        Middleware::setStreamFactory(function ($file, $mode) {
            return new Stream(fopen($file, $mode));
        });


        $middlewares = array(
            Middleware::FormatNegotiator(),
            Middleware::AuraSession()->name('boviSession'),
            function (Request $request, Response $response, $next) use ($app) {

                /** @var UserManager $oauth */
                $oauth = $app->getContainer()["oauth"];

                $session = Middleware\AuraSession::getSession($request)->getSegment("overscan");

                if ($session->get(Session::oauthToken, false)) {
                    /** @var OauthToken $token */
                    $token = $session->get(Session::oauthToken);
                    $tokenValue = $token->getToken();
                    $oauth->refreshApiToken($tokenValue);
                } else {
                    if (!$session->get(Session::loggedSessionKey, false) || !$session->get(Session::loggedUserSessionKey, null)) {
                        //TODO: Changer nroux/nroux par mobile et le bon mdp quand l'api sera en place
                        $oauth->logUser($session,"nroux","nroux");
                    } else {
                        /** @var Utilisateur $loggedUser */
                        $loggedUser = $session->get(Session::loggedUserSessionKey);
                        $oauth->logUser($session,$loggedUser->getEmail(),$loggedUser->getPassword());
                    }
                }
                $api = $app->getContainer()->get("api");
                $app->getContainer()->get("view")->addExtension(new BoviExtension($api));
                return $next($request, $response);
            },
            function (Request $request, Response $response, $next) use ($app) {

                /** @var Twig $view */
                $view = $app->getContainer()->get("view");

                $session = Middleware\AuraSession::getSession($request);
                $segment = $session->getSegment("overscan");

                $view->getEnvironment()->addGlobal("isLogged", $segment->get(Session::loggedSessionKey, false));
                $app->getContainer()["myRequest"] = $request;
                $resp = $next($request, $response);


                return $resp;
            }
        );

        /**
         * On tourne le tableau parce qu'à priori, les middlewares sont ajoutés de manière à ce que le dernier ajouté soit le premier lancé
         */
        foreach (array_reverse($middlewares) as $middleware) {
            $app->add($middleware);
        }

        if ($app->getContainer()->settings["debug"]) {
            $app->add(
                Middleware::DebugBar()->captureAjax(true)
            );
        }

    }

}