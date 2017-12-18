<?php

session_start();

if (isset($_POST['submit']))
{
	global $ErrCount;
	$ErrCount = 0;
	$userId = validuserId($_POST['userId'] , "User ID");
	$password = validpassWord($_POST['pass'] , "Password");
	$email = validEmail($_POST['email'] , "Email ID");
	$phone = validPhone($_POST['phone'] , "Phone Number");
	if ($ErrCount == 0) {
		try
		{
			include('database_config.php');

			$stmt = $db->prepare("INSERT INTO users(first_name , last_name , user_id , user_password , email_id , phone_number ) VALUES (:firstName, :lastName , :userId , :password , :email , :phone)"); //Make sure your DB 

			$stmt->execute(array("firstName" => $_POST['fname'],
							 "lastName" => $_POST['lname'],
							 "userId" => $userId,
							 "password" => $password,
							 "email" => $email,
							 "phone" => $phone
							 ));
			$_SESSION['sess_username'] = $_POST['userId'];
			
			$_SESSION['sess_user_id'] = $db->lastInsertId();
			$_SESSION['sess_username'] = $_POST['userId'];
			header('Location: events.php');
		}
		catch(PDOException $e)
		{
			echo 'ERROR: ' . $e->getMessage();
		}
	}
	else {
		header('Location: index.php');		
	}
}
?>


<?php 
function validate($data, $field)
{
	global $ErrCount;
	if (empty($data))
	{
		$ErrCount++;
		echo "$field is required.<br/>";
	}
	else{
		return $data;
	}
}

echo $ErrCount ," errors found!!<br/>";
if ($ErrCount>0){echo "Please re-fill the form"; ?>
<form name="Sign Up" action="signup_process.php" method="POST">
			
			<p>First Name: <input type="text" name="fname" /></p>

			<p>Last Name: <input type="text" name="lname" /></p>
			
			<p>User ID: <input type="text" name="userId" /></p>
			
			<p>Password: <input type="text" name="pass" /></p>
			
			<p>Email ID: <input type="text" name="email" /></p>
			
			<p>Ph. Number: <input type="text" name="phone" /></p>
			
			<p><input type="reset" value="Clear Form" /> &nbsp;&nbsp;&nbsp;
			<input type="submit" name="submit" value="Send" /></p>
		</form>
		
<?php
				}
else {
	echo "Registration Successful. <br/>
	Thank you $userId !!";
	echo "<br/> Please check your email $email
	for confirmation."; }?> 

<?php
function validuserId($data , $field)
	{
		global $ErrCount;
		if (empty($data))
		{
			$ErrCount++;
			echo "$field is required.<br/>";
		}
		else //Clean up input if it isn't empty
		{
			$data = trim($data);
			$data = stripslashes($data);
			$pattern = "/^(?=.{5,20}$)[a-zA-Z0-9_]*$/";
			if (preg_match($pattern, $data))
			{
				return $data;
			}
			else
			{
				echo "Invalid User Name<br/>";
				$ErrCount++;
			}
		}
	}
?>

<?php
function validpassWord($data , $field)
	{
		global $ErrCount;
		if (empty($data))
		{
			$ErrCount++;
			echo "$field is required.<br/>";
		}
		else //Clean up input if it isn't empty
		{
			$data = trim($data);
			$data = stripslashes($data);
			$pattern = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/";
			if (preg_match($pattern, $data))
			{
				return $data;
			}
			else
			{
				echo "Enter a valid Password.<br/>";
				$ErrCount++;
			}
		}
	}
?>

<?php
function validEmail($data , $field)
	{
		global $ErrCount;
		if (empty($data))
		{
			$ErrCount++;
			echo "$field is required.<br/>";
		}
		else //Clean up input if it isn't empty
		{
			$data = trim($data);
			$data = stripslashes($data);
			$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[_a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/i";
			if (preg_match($pattern, $data))
			{
				return $data;
			}
			else
			{
				echo "Enter a valid Email.<br/>";
				$ErrCount++;
			}
		}
	}
?>

<?php
function validPhone($data , $field)
	{
		global $ErrCount;
		if (empty($data))
		{
			$ErrCount++;
			echo "$field is required.<br/>";
		}
		else //Clean up input if it isn't empty
		{
			$data = trim($data);
			$data = stripslashes($data);
			$pattern = "/\d{3}-\d{3}-\d{4}/";
			if (preg_match($pattern, $data))
			{
				return $data;
			}
			else
			{
				echo "Enter the $field of format: ###-###-####<br/>";
				$ErrCount++;
			}
		}
	}
?>
