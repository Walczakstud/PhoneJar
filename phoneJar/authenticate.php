<?php
require 'database_config.php'; //Database Connection
session_start(); //Start the session

if(isset($_POST['userId']))
{
	$userId = $_POST['userId'];
}

if(isset($_POST['pass']))
{
	$password = $_POST['pass'];
	//$md5_pass = md5($password); //md5 of entered password
}

//Check whether the entered username and md5 encrypted password pair exist in the Database
$q = 'SELECT * FROM users WHERE user_id=:userId AND user_password=:pass';
$query = $db->prepare($q);
$query->execute(array(':userId' => $userId, ':pass' => $password));

if($query->rowCount() == 0)
{
	header('Location: index.php?err=1');
}

else{
	//fetch the result as associative array
	$row = $query->fetch(PDO::FETCH_ASSOC);
	
	//Store the fetched details into $_SESSION
	$_SESSION['sess_user_id'] = $row['id'];
	$_SESSION['sess_username'] = $row['user_id'];
	
	{
		header('Location: events.php');
	}
}
?>