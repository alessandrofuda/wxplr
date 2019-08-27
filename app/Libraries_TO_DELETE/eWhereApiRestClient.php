<?php

namespace App\Libraries;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class eWhereApiRestClient {

	private $baseRequestUrl;
    private $accessToken;

	public function __construct($access_token) {
        $this->baseRequestUrl = config('services.ewhere.base_url_api');
        $this->accessToken = $access_token;
    }
    

    // TO DO !!
    public function getGotProResults($user_id) {
    	$parameters = null;
    	return $this->sendRequest('GET', '/api/..url..', $parameters);
    }

    public function getVicResults($user_id) {
    	$parameters = null;
    	return $this->sendRequest('GET', '/api/..url..', $parameters);
    }


	private function sendRequest($method, $uri, $payload = null) {
        $client = new Client(['base_uri' => $this->baseRequestUrl]);
        $request_options = [];
        $headers = [
            'Authorization' => 'Bearer '.$this->accessToken,
            'Accept' => 'application/json'
        ];
        $request_options['headers'] = $headers;

        if ($payload) {
            switch ($method) {
                case 'GET':
                    $request_options['query'] = $payload;
                    break;
                default:
                    $request_options['form_params'] = $payload;
                    break;
            }
        }
        
        try {
            $response = $client->request($method, $uri, $request_options);

            if ($response->getStatusCode() == 200) {
                if ($response->hasHeader("Content-Type") && ($response->getHeader("Content-Type")[0] == 'application/json')) {
                    $return = json_decode($response->getBody());
                } else {
                    $return = $response->getBody()->getContents();
                    // $return = $return->getContents();
                }
            } else {
                throw new Exception('Error executing query: '.$response->getReasonPhrase(), $response->getStatusCode()); // sistemare
            }
        } catch(RequestException $e) {
            throw new Exception('Network error: '.$e->getMessage(), $e->getCode(), $e); // sistemare
        }

        return $return;
    }

}