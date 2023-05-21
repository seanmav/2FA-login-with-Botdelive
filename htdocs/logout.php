<?php
session_start();
// Destroying All Sessions
if(session_destroy())
{
// Redirecting To Home Page
header("Location: login.php");
}
?> 
<head>
<title>Login With 2FA</title>
<link rel="stylesheet" href="css/style.css" />
</head>
