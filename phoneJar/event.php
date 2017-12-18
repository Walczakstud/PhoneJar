<?php

$url=$_SERVER['REQUEST_URI'];
header("Refresh: 10; URL=$url");

include('database_config.php');
session_start();

$_SESSION['sess_username'];


if(!isset($_SESSION['sess_username']))
{
	header('Location: index.php?err=2');
}
$id = $_GET['id'];
$query = $db->prepare("SELECT * FROM event WHERE id = $id;");
$query->execute();
$event = $query->fetch(PDO::FETCH_ASSOC);

$_SESSION['sess_user_id'];
if(isset($_SESSION['sess_user_id']))
{
	$query = $db->prepare("SELECT COUNT(*) AS COUNTUSER FROM user_event_list WHERE userId = :userId AND eventId = :eventId;");
	$query->bindParam(':userId' , $_SESSION['sess_user_id']);
	$query->bindParam(':eventId' , $id);
	$query->execute();
	$intable = $query->fetch(PDO::FETCH_ASSOC);
	$countintable = $intable['COUNTUSER'];
	if ($countintable == 0) {
		$addUserQuery = $db->prepare("INSERT INTO user_event_list(`userId`, `eventId`) VALUES (:userId, :eventId);");
		$addUserQuery->bindParam(':userId' , $_SESSION['sess_user_id']);
		$addUserQuery->bindParam(':eventId' , $id);
		$addUserQuery->execute();
	}
}

$_SESSION['sess_user_id'];
if(isset($_SESSION['sess_user_id']))
{  
    $query = $db->prepare("UPDATE user_event_list SET last_access=now() WHERE userId = :userId AND eventId = :eventId;");  
    $query->bindParam(':userId' , $_SESSION['sess_user_id']);
	$query->bindParam(':eventId' , $id);
	$query->execute();
} 

//echo $id;
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Phone Jar Web Application" content="">
    <meta name="Joel Walczak" content="">

    <title>Phone Jar Final Project - Event</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/3-col-portfolio.css" rel="stylesheet">
    
    <!--Imported Google Font-->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
    <style>
	 body{
			font-family: 'PT Sans Narrow', sans-serif;
		 }  
	</style>
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #778899;">
      <div class="container">
        <a class="navbar-brand" href="index.php">Phone Jar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="#"><?php echo $_SESSION['sess_username'];?>
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
  
    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading -->
      <h1 class="my-2" align="center">Event Name: <?php echo $event['event_name'];?></br></h1>
		<div align="left">
		<button class="btn btn-basic btn-md"><a href="events.php">Back to Events</a></button>
			<!--<button type="button" class="btn btn-success btn-md pull-right">Back to Events</button>-->
	  	</div>
	  	
		</br>
		<?php  
			$dispUsers=20;
			include('database_config.php');
	
			try
			{		
				$users = $db->prepare("SELECT * FROM user_event_list WHERE userId = :userId AND eventId = :eventId;");
				$users->bindParam(':userId' , $_SESSION['sess_user_id']);
				$users->bindParam(':eventId' , $id);
				$users->execute();
				$users->fetch(PDO::FETCH_ASSOC);
				$useractivecount = $users->fetch();
			}
	
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
	
			if ($users->rowCount()>0) 
			{  
				$stmt = $db->prepare("SELECT * FROM users JOIN user_event_list ON users.id = user_event_list.userId WHERE userId = :userId AND eventId = :eventId AND last_access > SUBTIME(NOW(), 1000);");
				$query->bindParam(':userId' , $_SESSION['sess_user_id']);
				$query->bindParam(':eventId' , $id);
				$query->execute(); 
			}  
			else
			{ 
				echo "Error";
			}
	
		?>  
		<div class="table table-bordered table-responsive"> 
		  <table class="table">
			<thead>
			  <tr>
				<td align="center">User ID</td>
			  </tr>
			</thead>
			<?php 
			include('database_config.php');
			//$stmt = $db->prepare("SELECT * FROM users JOIN user_event_list ON users.id = user_event_list.userId WHERE eventId = $id;");
			$query = $db->prepare("SELECT * FROM users JOIN user_event_list ON users.id = user_event_list.userId WHERE eventId = :eventId AND last_access > SUBTIME(NOW(), 100);");
			$query->bindParam(':eventId' , $id);
			$query->execute();
			for($i=0; $event = $query->fetch();) { ?>
			<tbody>
			  <tr>
				<td align="center"><?php echo $event['user_id']; ?></td>
			  </tr>
			  <?php } ?>
			</tbody>
		  </table>
		</div>
      <!-- /.row -->
    </div>
    
    <!-- Footer -->
    <footer>
        <p class="m-0 text-center text-black">Copyright &copy; Phone Jar 2017</p>
      <!-- /.container -->
    </footer>
    
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
</html>