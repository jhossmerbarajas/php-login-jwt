<?php 

namespace App\Controllers\Users;

use App\Models\User;
use App\Traits\Request, App\Traits\Response;
use App\Traits\AuthJwt;

class UserController 
{
	use Request, AuthJwt, Response;

	function index () {
		$token = $this->headers["Auth-Token"];
		$validateToken = $this->validateToken($token);
		
		if($validateToken->data->role_id === 1) {
			$user = new User;
			return $this->json($user->all());
		}

		echo json_encode(["msg" => "no estás autorizado"]);
	}
}