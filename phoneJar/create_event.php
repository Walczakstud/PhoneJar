<?php

session_start();

if (isset($_POST['submit']))
{
	try
	{
		include('database_config.php');
		
		$stmt = $db->prepare("INSERT INTO event(event_id , event_name , event_location , event_start , event_end  ) VALUES (:eventId, :eventName , :eventLocation , :eventStartTime , :eventEndTime )"); //Make sure your DB 
		
		$stmt->execute(array("eventId" => $_POST['eventId'],
						 "eventName" => $_POST['eventName'],
						 "eventLocation" => $_POST['eventLocation'],
						 "eventStartTime" => $_POST['eventStartTime'],
						 "eventEndTime" => $_POST['eventEndTime']
						 ));
		
		header('Location: events.php');
		//if (!isset($_SESSION)) 
		  //{
			//session_start();
		  //}
	}
	catch(PDOException $e)
	{
		echo 'ERROR: ' . $e->getMessage();
	}
}
?>