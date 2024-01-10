<?php 

namespace App\Traits;

trait Response
{
	function send($data, $status = 200, $headers = []) {
		http_response_code($status);
		foreach ($headers as $key => $value) {
			
			header("$key: $value");
		}

		echo json_encode($data);
	}

	function json(array $data) {
		header("Content-Type: application/json");
		echo json_encode($data, true);
	}
}