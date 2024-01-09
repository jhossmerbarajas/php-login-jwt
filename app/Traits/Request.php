<?php 

namespace App\Traits;

trait Request
{
	public $method;
	public $headers;
	public $body;
	public $query;
	public $params;

	function __construct() {
		$this->method = $_SERVER["REQUEST_METHOD"];
		$this->headers = getallheaders();
		$this->body = file_get_contents("php://input");
		$this->query = $_GET;
		$this->params = $_POST;
	}
}