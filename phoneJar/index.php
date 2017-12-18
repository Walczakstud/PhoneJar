<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Phone Jar Web Application" content="">
    <meta name="Joel Walczak" content="">

    <title>Phone Jar Final Project</title>

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
              <a class="nav-link" data-toggle="modal" data-target="#LoginModal" href="#">Login
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" data-target="#signUpModal" href="#">Sign Up</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<!-- Login Modal -->
<div id="LoginModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
			<h4 align="center">Enter your credentials</h4><br/>
			<div class="block-margin-top">
				<?php 
				//Associative array to display 2 types of error message
				$errors = array (1=>"Invalid username or password, Try again.", 2=>"Please login to access this area");
				//get the error_id from URL
				if (isset ($_GET['err']))
				{
				$error_id = $_GET['err'];
				if ($error_id == 1)
				{
					echo '<p class="text-danger">'.$errors[$error_id].'</p>';
				} elseif ($error_id == 2)
				{
					echo '<p class="text-danger">'.$errors[$error_id].'</p>';
				}
				}
				?>
				<form action="authenticate.php" method="POST" role="form">
					<p>User ID:<input type="text" name="userId" class="form-control" placeholder="User ID" required autofocus></p>
					<p>Password:<input type="password" name="pass" class="form-control" placeholder="Password" required></p><br/>
					<button class="btn btn-lg btn-basic btn-block" type="submit">Login</button>
				</form>
			</div>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--Sign Up Modal-->
<div id="signUpModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
		 <div class="modal-body">
			<h4 align="center">Enter your credentials</h4>
			<p align="center" style="color:red">*Credentials must match placeholders or you will have to re-enter</p>
			<form name="Registration" action="signup_process.php" method="POST" role="form" text-align="center">
				<p>First Name: <input type="text" name="fname" class="form-control" placeholder="First Name" required autofocus/></p>

				<p>Last Name: <input type="text" name="lname" class="form-control" placeholder="Last Name" required /></p>

				<p>Username: <input type="text" name="userId" class="form-control" placeholder="Username (5-20 characters)" required /></p>

				<p>Password: <input type="text" name="pass" class="form-control" placeholder="Password(1 capital letter and 1 number)" required /></p>

				<p>Email: <input type="text" name="email" class="form-control" placeholder="example@example.com" required /></p>
				
				<p>Ph. Number: <input type="text" name="phone" class="form-control" placeholder="###-###-####" required /></p>
				
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
		<h3 class="my-4" align="center">Welcome to Phone Jar</br>login or sign up to begin</h3>
		
        <div class="text-center">
         <img src="images/slategreyplainjar.png" alt="Phone Jar Logo" class="img-responsive"></br></br>
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
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
