<?php

$email_to = "ben@benjarke.com"; //email address form will be sent to. 
$email_subject = "New form message"; //Email subject line.
$name = $_POST['name']; 
$email = $_POST['email']; 
$message = $_POST['message'];
$captcha = $_POST['g-recaptcha-response']; 
$error_message = "";    
$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
$string_exp = "/^[A-Za-z .'-]+$/"; 
$email_message = "Form details below.\n\n";

if(isset($_POST['g-recaptcha-response']))
	{
    	$captcha=$_POST['g-recaptcha-response'];
    }
    
	if(!$captcha){
		$error_message .= '<h2>Please check the the captcha form.</h2>';
    }
	
    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfNKAATAAAAAKVt48j-QhTSxkrkpAnoDGs9CLMs&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
    if($response.success==false)
		{
			$error_message .= '<h2>You are spammer! Get the out</h2>';
        }
	else
        {
			if(isset($_POST['email'])) 
			{  
				function died($error) 
				{
    				echo "We are very sorry, but there were error(s) found with the form you submitted. ";
    				echo "These errors appear below.<br /><br />";
    				echo $error."<br /><br />";
    				echo "Please go back and fix these errors.<br /><br />";
    				die();
    			}    
 			if(
	   		!isset($_POST['name']) || // validation expected data exists
	   		!isset($_POST['email']) ||
	   		!isset($_POST['message'])) 
				{
					died('We are sorry, but there appears to be a problem with the form you submitted.');       
    			}
			if(!preg_match($email_exp,$email)) 
				{
    				$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    			}
			if(!preg_match($string_exp,$name)) 
				{
    				$error_message .= 'The Name you entered does not appear to be valid.<br />';
   				}
			if(strlen($message) < 2) 
				{
					$error_message .= 'The Message you entered does not appear to be valid.<br />';
  				}
			if(strlen($error_message) > 0) 
				{
    				died($error_message);
  				}
     		function clean_string($string) 
				{ 
      				$bad = array("content-type","bcc:","to:","cc:","href");
      				return str_replace($bad,"",$string);
    			}
 			$email_message .= "Name: ".clean_string($name)."\n";
    		$email_message .= "Email: ".clean_string($email)."\n";
    		$email_message .= "Message: ".clean_string($message)."\n";

			//create email headers
			$headers = 'From: '.$email . "\r\n";

			//send email
			mail($email_to, $email_subject, $email_message, $headers);  

			header('Location: http://zeus.benjarke.com/thanks.php#contact');
		} 
	}
?>