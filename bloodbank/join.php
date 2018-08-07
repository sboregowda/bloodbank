<?php

require($_SERVER['DOCUMENT_ROOT'] . '/bloodbank/includes/config.php');

include 'menu.php';

 

$sOutput .= '<div id="index-body">';
if (loggedIn()) {
	$sOutput .= '
		' . $_SESSION['username'] .' <br /><br /><br />';
		
			$sOutput .= "<h4>Join </h4>";
			
		

			$response="<h5>Join</h5>";
			if (isset($_GET['typeOfMessage'])) {
			
				if (isset($_GET['to'])) {
					$to=$_GET['to'];
					$from=$_SESSION['username'];
					
				}
				
				
				if ($_GET['typeOfMessage']=='ask'){
					$msg=$_SESSION['username']." wants to donate to you - Ask request - if you need blood";
					decrementDonorCount($to);
				}elseif($_GET['typeOfMessage']=='donate'){
					$msg=$_SESSION['username']." wants your donation  - donate blood - if you want to donate";
				}
				
				
				if (sendMessage($from, $to,$msg)){
					$response .='From: '.$from."<br/>";
					$response .='To: '.$to."<br/>";
					$response .='Message: '.$msg."<br/>";
					$response .="<font color='green'>Message sent successfully !</font>";
				}else{
					$response .="<font color='red'>Message not Sent !</font>";
				}
			}
			
			
				$sOutput .=$response;
			
			 
}else {
	$sOutput .= '<h2>Welcome to Blood Donation Website</h2><br />
		<h4>Would you like to <a href="login.php">login</a>?</h4>
		<h4>Create a new <a href="register.php">account</a>?</h4>';

}
$sOutput .= '</div>';

echo $sOutput;
?>