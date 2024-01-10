<?php 

namespace App\Interfaces;

interface IUserRepository {
	function passwordHash(string $pass): string;
	function passwordVerify (string $pass, string $passHash): string;
}