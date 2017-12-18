<?php

session_start();

$_SESSION['sess_username'];


if(!isset($_SESSION['sess_username']))
{
	header('Location: index.php?err=2');
}

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Phone Jar Web Application" content="">
    <meta name="Joel Walczak" content="">

    <title>Phone Jar Final Project - Events</title>

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
    
    <!--Sign Up Modal-->
<div id="createEventModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
		 <div class="modal-body">
			<h4 align="center">Enter your credentials</h4>
			<form name="Create Event" action="create_event.php" method="POST" role="form" text-align="center">
				<p>Event ID: <input type="text" name="eventId" class="form-control" placeholder="Event ID" required autofocus/></p>

				<p>Event Name: <input type="text" name="eventName" class="form-control" placeholder="Event Name" required /></p>

				<p>Event Location: <input type="text" name="eventLocation" class="form-control" placeholder="Event Location" required /></p>

				<p>Event Start Time: <input type="text" name="eventStartTime" class="form-control" placeholder="Event Start Time" required /></p>

				<p>Event End Time: <input type="text" name="eventEndTime" class="form-control" placeholder="Event End Time" required /></p>
				
				<p align="center"><input type="reset" value="Clear Form" class="btn btn-danger"/> &nbsp;&nbsp;&nbsp;
				   <input type="submit" name="submit" value="Submit" class="btn btn-success"/>
				</p>
			</form>
    	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading -->
      <h1 class="my-2" align="center">EVENTS</br><h4 align="center">Welcome to events, you can join an existing event</br>below or you can create an event!</h4></h1>
		<div align="right">
			<button type="button" data-toggle="modal" data-target="#createEventModal" class="btn btn-basic btn-md pull-right">+ Create Event</button>
	  	</div>
	  	
		</br>
		<div class="row">
		<?php 
			include('database_config.php');
			$stmt = $db->prepare("SELECT * FROM event ORDER BY id DESC");
			$stmt->execute();
			for($i=0; $row = $stmt->fetch(); $i++){ ?>
			<div class="col-lg-4 col-sm-6 portfolio-item">
			  <div class="card h-100" style="background-color: gainsboro;">
				<div class="card-body">
				  <h4 align="center" class="card-title">
					  <a href="event.php?id=<?php echo $row['id']; ?>"><?php echo $row['event_name']; ?></a></br></br>
					  <a href="#<?php echo $row['id']; ?>" class="btn btn-info" data-toggle="collapse">Details</a>
				  		<div id="<?php echo $row['id']; ?>" class="collapse" align="left"></br>
					  	<p>Event ID: <?php echo $row['event_id']; ?></p>
						<p>Event Location: <?php echo $row['event_location']; ?></p>
						<p>Start Time: <?php echo $row['event_start']; ?></p>
						<p>End Time: <?php echo $row['event_end']; ?></p>
					  </div>
				  </h4>
				</div>
			  </div>
			</div>
		  
		  <?php } ?>
		</div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
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