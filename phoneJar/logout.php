<?php 
	session_start();
	session_destroy();
	header('Location: index.php');
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Logout</title>
</head>

<body>
<p>Logout page</p>
</body>
</html>