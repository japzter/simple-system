<?php
	session_start();
	session_destroy();
	setcookie("hash", "");
	header('location: login.php');