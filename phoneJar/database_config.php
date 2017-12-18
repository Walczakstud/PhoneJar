<?php
//define database related variables
	$db_host = 's970.tmd.cloud';
	$db_user = 'joelwalc_phoneJarAdmin';
	$db_pass = 'dunwoody2017';
$db_database = 'joelwalc_PhoneJar';

// try to connect to database

$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>