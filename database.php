<?php
$host = 'localhost';
$username = 'root';
$password = 'password';
$database_name = 'users';

$conn = mysqli_connect($host,$username,$password,$database_name);
if(!$conn)
	die('Cannot connect to the database');