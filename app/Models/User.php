<?php 

namespace App\Models;

use App\Interfaces\IUserRepository;
use App\Traits\Conexion;

class User implements IUserRepository
{
	use Conexion;

	protected $table = "users";

	function __construct() {
		/* Este método proviene del trait Conexion */
		return $this->connect();
	}

	function passwordHash (string $pass): string {
		return password_hash($pass, PASSWORD_DEFAULT);
	}

	function passwordVerify (string $pass, string $passHash): string {
		return password_verify($pass, $passHash);
	}
}