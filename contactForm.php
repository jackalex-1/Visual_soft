<?php
if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$mail = $_POST['mail'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	if(isset($_POST['g-recaptcha-response'])){
		$captcha=$_POST['g-recaptcha-response'];
	  }
	  if(!$captcha)
		echo 'Please Fill Captcha';
		$secretKey = "Put your secret key here";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        // should return JSON with success as true
        if($responseKeys["success"]) {
               
	
	$mailTo="info@visualsoft-inc.com";
	$headers = "From: ".$mail;
	$txt = "You have recived and email from ".$name.".\n\n".$message;
	mail($mailTo,$subject,$txt,$headers);
	header("Location: index.html?mailsend");
	echo 'You Message has been sent!';
		}
		else
		echo 'Your message has not sent Please fill form correctly or check Captcha!';
		
}
?>