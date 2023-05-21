<!DOCTYPE html>

<html>
<meta charset="utf-8">
<head>
<title>Login With 2FA</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php


require('BotDelive.php');
require('Constants.php');
require('BotDeliveException.php');

$secretKey = 'Nfjjy4GPqPmR6fzhUo9QUR4CklUtHOg5kvLQ91gL';
$appId = 'rk6JnHh49';
$accessCode = 'Sk6BwdoNq';
$userId = 'fSAeFoyU9reqxgRI9p1jBntpOqMqxzZeoD2ADSG-';
use BotDelive\Constants;
use BotDelive\BotDelive;

$bd = new BotDelive($appId,$secretKey);
$bd->verify($accessCode);
$bd->push($userId,'Hello World');

require('db.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['submit'])){
		if (isset($_POST['username'])){
				// removes backslashes
			$username = stripslashes($_REQUEST['username']);
				//escapes special characters in a string
			$username = mysqli_real_escape_string($con,$username);
			$password = stripslashes($_REQUEST['password']);
			$uppercase = preg_match('@[A-Z]@', $password);
			$lowercase = preg_match('@[a-z]@', $password);
			$number    = preg_match('@[0-9]@', $password);
			$specialChars = preg_match('@[^\w]@', $password);

			if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
				echo "<div class='form'>
                        <h3>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.</h3>
                        <br/>";
			}else{
			}
			$password = mysqli_real_escape_string($con,$password);
			//Checking is user existing in the database or not
				$query = "SELECT * FROM `users` WHERE username='$username'
							and password='".md5($password)."'";
			$result = mysqli_query($con,$query) or die(mysql_error());
			$rows = mysqli_num_rows($result);
				if($rows==1){
				$_SESSION['username'] = $username;
				
					// Redirect user to index.php
				
				try {
		
					$a = $bd->auth($userId);
					$array = (array)$a;
					$res = false;
				
					foreach($array as $key => $value){
						var_dump($value);
						var_dump($value ->respond);
						if($value -> respond == "bool(false"){
				
							var_dump($value ->respond);
						echo "end";
						$_SESSION["2FaLoggedIn"] = "true";
						header("Location: index.php");
						}
						else{
							echo"failure";
						}
						
					}
					header("Location: index.php");
				} catch(Exception $e) {
					
					echo ("You have not responded ");
				}

				header("Location: index.php");
				}else{
			echo "<div class='form'>
		<h3>Username/password is incorrect.</h3>
		<br/>Click here to <a href='login.php'>Login</a></div>";
			}
		}
    }else{
?>
<div class="form">
<h1>Log In</h1>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="password" placeholder="Password" required />
<br>
<input name="submit" type="submit" value="Login" />
</form>
<p>Not registered yet? <a href='registration.php'>Register Here</a></p>
</div>
<?php } ?>
</body>
</html>
