<?php

namespace Ovs\Bovimarket\Api;

//define("DEBUG",false);
//define("API_URL","http://185.30.92.167:8081/");
//if(strpos($_SERVER["SERVER_NAME"],"bovi.dav") !== false) {
//    /** Config POUR Overscan */
//
//    if(DEBUG){
//        define("API_URL", "http://172.22.33.2:8080/bovimarket/");
//        define("TOKEN", 'Authorization: Bearer d8d22d3e-342a-4910-abe4-cce0eee6f7e8');
//    }else{
//        define("API_URL","http://51.254.44.168:8080/bovimarket/");
//        define("TOKEN",'Authorization: Bearer 52a453ac-70e0-43ee-a59d-9af10eed4a9f');
//    }
//}else {
//    /** Config POUR SHUTTLE */
//    define("API_URL", "http://172.22.33.2:8080/bovimarket/");
//    define("TOKEN", 'Authorization: Bearer d8d22d3e-342a-4910-abe4-cce0eee6f7e8');
//}
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use Monolog\Logger;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 15/03/2016
 * Time: 09:09
 */
class Api extends Client {

	protected $logger;

	protected $coolCodes = array( 201, 200 );

	protected $debugBar;

	public function __construct( array $config, Logger $logger, $debugBar = null ) {
		parent::__construct( $config );
		$this->logger   = $logger;
		$this->debugBar = $debugBar;
	}

	public function request( $method, $uri = '', array $options = [] ) {

		$baseURI = $this->getConfig( "base_uri" );
		$headers = $this->getConfig( "headers" );
		$headers = $output = implode( ', ', array_map(
			function ( $v, $k ) {
				return sprintf( "%s='%s'", $k, $v );
			},
			$headers,
			array_keys( $headers )
		) );

		if ( $this->debugBar ) {
			$this->debugBar["messages"]->debug( "REQ : [" . $method . "] " . $baseURI . $uri . " - " . json_encode( $options ) );
			$this->debugBar["messages"]->debug( "Headers : " . $headers );
		}

		$this->logger->addDebug( "REQ : [" . $method . "] " . $baseURI . $uri . " - " . json_encode( $options ) );
		$this->logger->addDebug( "Headers : " . $headers );
		$res = null ;
		try {
			$res = parent::request( $method, $uri, $options );
		} catch ( RequestException $ex ) {

			if ( $this->debugBar ) {
				if ( $ex->hasResponse() ) {
					$this->debugBar["messages"]->warning( (string) $ex->getResponse()->getBody() );
				}
				$this->debugBar["messages"]->error( "Error : " . $ex->getMessage() . "\r\n" . $ex->getTraceAsString() );
			}

			if ( $ex->hasResponse() ) {
				$this->logger->addDebug( (string) $ex->getResponse()->getBody() );
			}
			$this->logger->addError( "Error : " . $ex->getMessage() . "\r\n" . $ex->getTraceAsString() );
			//throw $ex;
		}

		return $res;
	}

	public function getResourcesPath() {
		$baseUri = $this->getConfig( "base_uri" );
		$baseUri = str_replace( "/api/", "", $baseUri );

		return $baseUri . "/resources";
	}

}