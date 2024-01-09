<?php 

namespace App\Traits;

use \PDO;

trait Conexion
{

	protected $db_host 		= DB_HOST;
	protected $db_user 		= DB_USER;
	protected $db_pass 		= DB_PASS;
	protected $db_dbname 	= DB_DBNAME;
	protected $db_port 		= DB_PORT;

	protected $connection;
	protected $query;

	function connect() {
		try {

			$pdo = "sqlsrv:Server=$this->db_host,$this->db_port;Database=$this->db_dbname";

			$options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $this->connection = new PDO($pdo, $this->db_user, $this->db_pass, $options);

            return $this->connection;
		} catch(PDOException $e) {
			print_r("error de conexion: $e->getMessage()");
		}
	}

	function query ($sql, $data = [], $params = null) {
		
		if($data) {

			/* substr_count = cuenta cuando ? hay en la consulta */
			$numSignos = substr_count ($sql, '?');

			$this->query = $this->connection->prepare($sql);
			foreach ($data as $key => $value) {
				$type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
				$this->query->bindParam($key + 1, $data[$key], $type);
			}

			$this->query->bindParam(1, $data[0], PDO::PARAM_STR);
			$this->query->execute();

		} else {
			$this->query = $this->connection->prepare($sql);
			$this->query->execute();
		}
		
		return $this;
	}

	function first (){
		return $this->query->fetch(PDO::FETCH_ASSOC);
	}

	function get (){
		return $this->query->fetchAll(PDO::FETCH_ASSOC);
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

	function create ($data) {
		$columns = array_keys($data);
		$columns = implode(', ', $columns);

		$values = array_values($data);

		$sql = "INSERT INTO {$this->table} ({$columns}) VALUES (" . str_repeat('?, ', count($values) -1) . "?)";

		$this->query($sql, $values);

		$user_id = $this->connection->lastInsertId();
		return $this->findOne($user_id);
	}

	function where ($column, $operator, $value = null) {
		if($value == null) {
			$value = $operator;
			$operator = "=";
		}

		$sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} ?";
		$this->query($sql, [$value]);

		return $this;
	}
}