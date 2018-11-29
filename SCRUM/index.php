<?php
include("config.php");
include('userClass.php');
$userClass = new userClass();

$errorMsgReg='';
$errorMsgLogin='';
/* Login Form */
if (!empty($_POST['loginSubmit'])) 
{
$usernameEmail=$_POST['usernameEmail'];
$password=$_POST['password'];
if(strlen(trim($usernameEmail))>1 && strlen(trim($password))>1 )
{
$uid=$userClass->userLogin($usernameEmail,$password);
if($uid)
{
$url=BASE_URL.'home.php';
header("Location: $url"); // Page redirecting to home.php 
}
else
{
$errorMsgLogin="Please check login details.";
}
}
}

/* Signup Form */
if (!empty($_POST['signupSubmit'])) 
{
$username=$_POST['usernameReg'];
$email=$_POST['emailReg'];

$password=$_POST['passwordReg'];
$name=$_POST['nameReg'];
/* Regular expression check */
$username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
$email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.([a-zA-Z]{2,4})$~i', $email);
$password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);// ha de ser entre 6 y 20 caracteres

if($username_check && $email_check && $password_check && strlen(trim($name))>0) 
{ 
$uid=$userClass->userRegistration($username,$password,$email,$name);
if($uid)
{
$url=BASE_URL.'home.php';
header("Location: $url"); // Page redirecting to home.php 
}
else
{
$errorMsgReg="Username or Email already exists.";
}
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/codigo.css">
	<title></title>

</head>
<body>

<div id="login">
<h3>Login</h3>
<form method="post" action="" name="login">
<label>Username or Email</label>
<input type="text" name="usernameEmail" autocomplete="off" />
<label>Password</label>
<input type="password" name="password" autocomplete="off"/>
<div class="errorMsg"><?php echo $errorMsgLogin; ?></div>
<input type="submit" class="button" name="loginSubmit" value="Login">
</form>
</div>


<div id="signup">
<h3>Registration</h3>
<form method="post" action="" name="signup">
<label>Name</label>
<input type="text" name="nameReg" autocomplete="off" />
<label>Email</label>
<input type="text" name="emailReg" autocomplete="off" />
<label>Username</label>
<input type="text" name="usernameReg" autocomplete="off" />
<label>Password</label>
<input type="password" name="passwordReg" autocomplete="off"/>
<div class="errorMsg"><?php echo $errorMsgReg; ?></div>
<input type="submit" class="button" name="signupSubmit" value="Signup">
</form>
</div>


</body>
</html>