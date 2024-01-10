<?php 

use App\Router;

use App\Controllers\Users\UserController;
use App\Controllers\Auth\AuthController;

Router::get("/signup", [AuthController::class, 'signup']);
Router::post("/register", [AuthController::class, 'register']);

Router::get("/signin", [AuthController::class, 'signin']);
Router::post("/signin", [AuthController::class, 'login']);


Router::get("/users", [UserController::class, 'index']);

Router::dispatch();