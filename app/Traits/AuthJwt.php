<?php 

namespace App\Traits;

// JWT
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

trait AuthJwt
{
	function encode(int $id) {
		// JWT
		$key = SECRET_JWT;
		$now = strtotime("now");
		$payload = [
			"data" => $id,
			"exp" => strtotime("+2 minutes") 
		];

		$jwt = JWT::encode($payload, $key, 'HS256');
		echo $jwt;
	}

	function getToken() {
		$headers = apache_request_headers();
		return $headers;
	}
}