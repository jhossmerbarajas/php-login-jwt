<?php 

namespace App;

class Router
{
	private static $routes = [];

	static function get($uri, $callback) {
		$uri = trim($uri, '/');
		self::$routes["GET"][$uri] = $callback;
	}

	static function post ($uri, $callback) {
		$uri = trim($uri, "/");
		self::$routes["POST"][$uri] = $callback;
	}

	static function dispatch() {
		$uri = $_SERVER["REQUEST_URI"];
		$uri = trim($uri, "/");

		$method = $_SERVER["REQUEST_METHOD"];

		foreach (self::$routes[$method] as $route => $callback) {
			
			if(strpos($route, ":") !== false) {
				$route = preg_replace("#:[a-zA-Z]+#", "([a-zA-Z0-9]+)", $route);
			}

			if(preg_match("#^$route$#", $uri, $matches)){
				$params = array_slice($matches, 1);

				if (is_callable($callback)) {
					$response = $callback(...$params);
				}

				if (is_array($callback)) {
					$controller = new $callback[0];
					$response = $controller->{$callback[1]}(...$params);
				}

				if(is_array($response) || is_object($response)) {
					header ("Content-Type: application/json");
					echo json_encode($response);
				} else {
					echo $response;
				}
				return;
			}
		}
		echo "404";
	}
}