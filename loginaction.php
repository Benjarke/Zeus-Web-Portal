<?php
  include_once ("config/init.php");

  $username = $_POST["username"];
  $password = md5($_POST["password"]);

  $query = "SELECT * FROM ZeusUsers WHERE username= '$username' AND  password = '$password' ";
  $result = mysqli_query($link,$query) or exit("Error in query: $query. " . mysqli_error());

  if ($row = mysqli_fetch_assoc($result)) //Then Successful Login
  {
	//Create a session variable to store the user name.
  	$_SESSION['username'] = $username;
  	$_SESSION['id'] = $row['id'];
	$_SESSION['notification_id'] = $row['notification_id'];

  header("Location: portal.php?reloaded=yes");
  } 
  else {
  $_SESSION["message"] = "Incorrect Username and/or Password";
  header("Location: index.php");
  }
?>