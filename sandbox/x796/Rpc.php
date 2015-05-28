<?php

class X796_Rpc {
	private $_requestor;
	private $authentication;

	public function __construct($requestor, $authentication) {
		$this -> _requestor = $requestor;
		$this -> _authentication = $authentication;
	}

	public function request($method, $url, $params) {
		// $url = X796Base::API_BASE . $url;
		// Initialize CURL
		$ch = curl_init();
		// $curl = curl_init();
		$curlOpts = array();

		// Headers
		$headers = array('User-Agent: X796PHP/v1');

		//GET USER APIKEY
		$auth = $this -> _authentication -> getData();

		// Get the authentication class and parse its payload into the HTTP header.

		// HTTP method
		$method = strtolower($method);
		if ($method == 'get') {
			curl_setopt($ch, CURLOPT_HTTPGET, 1);
			if ($params != null) {
				$queryString = http_build_query($params);
				$url .= "?" . $queryString;
			}
		} else if ($method == 'post') {
			$authenticationClass = get_class($this -> _authentication);

			switch ($authenticationClass) {

				case 'X796_ApiKeyAuthentication' :
					//X796 POST
					ksort($params);
					$sig = "";
					while ($key = key($params)) {
						$sig .= $key . "=" . $params[$key] . "&";
						next($params);
					}
					$param_uri = http_build_query($params,'','&');
                    $sig = base64_encode(hash_hmac('sha1', $param_uri, $auth -> apiKeySecret));
					$params['sig'] = $sig;
					break;
				default :
					throw new X796_Exception("Invalid authentication mechanism");
					break;
			}

			curl_setopt($ch, CURLOPT_POST, 1);
			// $curlOpts[CURLOPT_POST] = 1;

			// Create query string
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

			// $curlOpts[CURLOPT_POSTFIELDS] = json_encode($params);
			//$params;
		}

		// CURL options
		curl_setopt($ch, CURLOPT_URL, substr(X796Base::WEB_BASE, 0, -1) . $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		// $curlOpts[CURLOPT_URL] = substr(X796Base::WEB_BASE, 0, -1) . $url;
		// $curlOpts[CURLOPT_HTTPHEADER] = $headers;
		// $curlOpts[CURLOPT_SSL_VERIFYHOST] = FALSE;
		// $curlOpts[CURLOPT_SSL_VERIFYPEER] = FALSE;

		// curl_setopt_array($curl, $curlOpts);

		// Do request
		$response = $this -> _requestor -> doCurlRequest($ch);
		// Decode response
		try {
			$body = $response['body'];
			$json = json_decode($body);
		} catch (Exception $e) {
			echo "Invalid response body" . $response['statusCode'] . $response['body'];
		}
		if ($json === null) {
			echo "Invalid response body" . $response['statusCode'] . $response['body'];
		}
		if (isset($json -> error)) {
			throw new X796_Exception($json -> error, $response['statusCode'], $response['body']);
		} else if (isset($json -> errors)) {
			throw new X796_Exception(implode($json -> errors, ', '), $response['statusCode'], $response['body']);
		}

		return $json;
	}

}
