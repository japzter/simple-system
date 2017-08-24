<?php
session_start();
include 'database.php';
if(isset($_SESSION['username'])){
	header('location: index.php');
}
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	
	$sql = "SELECT * FROM tbl_login WHERE username = '$username' AND password = '$password'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_assoc($result);
		if(isset($_POST['remember'])){
			setcookie("hash", $row['hash'], time() + 60 * 60 * 24 * 30);
		}
		$_SESSION['username'] = $row['username'];
		header('location: index.php');
	} else {
		echo 'Username and/or password incorrect';
	}
}
if(isset($_POST['register'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$email = $_POST['email'];
	$hash = md5(time());
	
	if($password != $password2)
		die('Password do not match');
	
	$password = md5($password);
	
	$sql = "INSERT INTO tbl_login (username, password, email, hash) VALUES ('$username','$password','$email','$hash')";
	if(mysqli_query($conn,$sql)){
		echo 'Registration Success! Please login';
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<h1>Login</h1>
		<form method="POST" action="">
			Username: <input type="text" name="username"><br>
			Password: <input type="password" name="password"><br>
			<input type="checkbox" name="remember"> Remember me<br>
			<input type="submit" name="login" value="Login">
		</form>
		<h1>Register</h1>
		<form method="POST" action="">
			Username: <input type="text" name="username"><br>
			Password: <input type="password" name="password"><br>
			Retype Password: <input type="password" name="password2"><br>
			Email: <input type="email" name="email"><br>
			<input type="submit" name="register" value="Register">
		</form>
	</body>
</html>