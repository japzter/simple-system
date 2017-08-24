<?php
session_start();
if(isset($_COOKIE['hash'])){
	$hash = $_COOKIE['hash'];
	include 'database.php';
	$sql = "SELECT * FROM tbl_login WHERE hash = '$hash'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
	}
}
if(empty($_SESSION['username'])){
	header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>My awesome site</title>
	</head>
	<body>
		<a href="logout.php" style="float:right;">logout</a>
		<h1>Welcome <?php echo $_SESSION['username'] ?></h1>
	</body>
</html>