<?php 
session_start(); 

// Check if we have already created a authenticated session 

if (isset($_SESSION["username"])) { 

$_SESSION["message"] = "Already logged in as: ". $_SESSION['username']; 

} 

?>