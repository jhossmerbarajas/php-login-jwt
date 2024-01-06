<?php 

use App\Router;

use App\Controllers\Users\UserController;

Router::get("/", [UserController::class, 'index']);

Router::dispatch();