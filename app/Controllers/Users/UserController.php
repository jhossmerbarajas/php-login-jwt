<?php 

namespace App\Controllers\Users;

use App\Models\User;

class UserController 
{

	function index () {
		$user  = new User;
		var_dump($user->all());
	}
}