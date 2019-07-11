<?php


namespace App\Classes;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Middleware;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\Log;

/**
 * Class RESTServices
 * @package App\Classes
 */
class RESTServices {

    /**
     * @var Client
     */
    private $HTTP_CLIENT = null;


    /**
     * RESTGed constructor.
     */
    public function __construct() {
        
        // Essa instanciação é necessária para todos os métodos POST
        $this->HTTP_CLIENT = new Client([
            'headers' => [
                'Cookie: ' => 'CXSSID=' . env('GED_USER_TOKEN')
            ]
        ]);

    }



    /**
     * Do a GET request
     * @param string $_url                      Resource to fetch
     * @param array $_tokenHeader               The header needed to make requests
     * @param array $_parameters                Ordered array with additional parameters (e.g. ['João', 'Desenvolvedor'])
     * @return JSON with a response object and the http code
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $_url, array $_tokenHeader, array $_parameters = array()) {
        $cont = 0;
        $params = "?";
        foreach ($_parameters as $key => $prm) {
            if($cont === 0) $params .= $key . "=". $prm;
            else $params .= "&" . $key . "=". $prm;

            $cont++;
        }

        try {
            $response = $this->HTTP_CLIENT->get($_url . $params, $_tokenHeader);
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            }
            return $e->getMessage();
        }
    }


    public function post(string $_url, array $_body) {
        try {
            $response = $this->HTTP_CLIENT->post($_url, [
                RequestOptions::JSON =>  $_body
            ]);

            Log::debug("Status: " . $response->getStatusCode());
            Log::debug("Resposta para requisição [$_url]: " . $response->getReasonPhrase());
            
            return (string) $response->getBody();;
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                dd($e);
                return $e->getResponse();
            }
            return $e->getMessage();
        }
    }


    public function put(string $_url, array $_body) {
        try {
            $response = $this->HTTP_CLIENT->put($_url, [
                RequestOptions::JSON =>  $_body
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            }
            return $e->getMessage();
        }
    }


    public function delete(string $_url, array $_tokenHeader) {
        try {
            $response = $this->HTTP_CLIENT->delete($_url, $_tokenHeader);
            return $response;
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            }
            return $e->getMessage();
        }
    }

}