<?php 

namespace App\Traits;

// JWT
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

trait AuthJwt
{
	private $key = SECRET_JWT;

	function generateToker(int $id, string $email, int $role_id) {
		// JWT
		$now = strtotime("now");
		$payload = [
			"data" => [
						"id" => $id,
						"email" => $email,
						"role_id" => $role_id 
					],
			"exp" => strtotime("+30 minutes") 
		];

		$jwt = JWT::encode($payload, $this->key, 'HS256');
		return $jwt;
	}

	function validateToken ($token) {
		try {
			$validate = JWT::decode($token, new Key($this->key, "HS256"));
			return $validate;

		} catch (\Exception $e) {
			echo "Error: " . $e->getMessage();
			echo "Line: " . $e->getLine();
			return false;
		}
	}
}