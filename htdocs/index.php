<?php
session_start();

if(!isset($_SESSION["username"])){
header("Location: login.php");
exit(); }
if(!isset($_SESSION["2FaLoggedIn"])){
    header("Location: login.php");
    exit(); }
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel=”stylesheet” href=”https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css”rel=”nofollow” integrity=”sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm” crossorigin=”anonymous”>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Login With 2FA</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <?php
    if (isset($_POST["submit"])){
        session_destroy();
        // Redirecting To Home Page
        header("Location: login.php");
    }else{
    ?>
    <body>
         <div class="form">
         <form action="" method="post" name="logout">
              <p>Congratulations <?php echo($_SESSION["username"]); ?> you have logged in.</p>

            
        <input name="submit" type="submit" value="Logout" />
         </form>
        </div>
    </body>
    <?php } ?>
</html>
