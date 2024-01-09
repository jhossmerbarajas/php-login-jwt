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

	function signup() {
		return $this->view('auth.signup');
	}

	function register () {
		$cnx = new User;
		
		$data = $_POST;
		$hash = $cnx->passwordHash($data["pass"]);
		$data["pass"] = $hash;

		$user_created = $cnx->create($data);

		return $this->redirect('auth.signin');
	}

	function signin() {
		return $this->view('auth.signin');
	}

	function login() {
		$data = json_decode($this->body, false);

		$model = new User;
		$user = $model->where("email", $data->email)->first();

		if(!$user) return "Email not found";
		if(!$model->passwordVerify($data->pass, $user["pass"])) return "password incorred";

		echo $this->send($user);
		// //JWT
		print_r( $this->getToken());
		
	}
}