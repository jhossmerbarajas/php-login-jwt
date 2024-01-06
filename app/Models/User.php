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

	/* Querys */
	function all () {
		$sql = "SELECT * FROM {$this->table}";
		return $this->query($sql)->get();
	}

	function findOne ( int|string $id ) {
		$sql = "SELECT * FROM {$this->table} WHERE id = ?";
		return $this->query($sql, [$id])->first();
	}
}