<?php 

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Traits\AuthJwt;
use App\Traits\Request;
use App\Traits\Response;


use App\Models\User;


class AuthController extends Controller
{
	use AuthJwt, Request, Response;


	function register () {
		$cnx = new User;
		
		$data = $this->body;

		$hash = $cnx->passwordHash($data->pass);
		$data->pass = $hash;

		$user_created = $cnx->create(get_object_vars($data));
		
		return $this->send($user_created);
	}

	function login() {
		$data = $this->body;

		$model = new User;
		$user = $model->where("email", $data->email)->first();

		if(!$user) return "Email not found";
		if(!$model->passwordVerify($data->pass, $user["pass"])) return "password incorred";

		
		// //JWT
		$token = $this->generateToker($user["id"], $user["email"], $user["role_id"]);
		header("Content-Type: application/json");
		$this->send($user, 200, ["auth-token" => $token]);
		return json_encode(["msg" => "user Logued"], true);
		
	}
}