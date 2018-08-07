<?php

require($_SERVER['DOCUMENT_ROOT'] . '/bloodbank/includes/config.php');

include 'menu.php';

// If the user is logging in or out
// then lets execute the proper functions
if (isset($_GET['action'])) {
	switch (strtolower($_GET['action'])) {
		case 'request':
			// We have variables. Pass them to our validation function
			if (createRequest_donateBlood($_SESSION['username'] )) {
				$_SESSION['error'] = "<font color='green'>Request saved successfully.</font>";
			}else{
				$_SESSION['error'] .= "<font color='red'>Request not saved !</font>";
			}
		}
}

$sOutput .= '<div id="index-body">';
if (loggedIn()) {
			$sOutput .= '<h2>Welcome!</h2>
				Hello, ' . $_SESSION['username'] .' <br />';
			
			$sOutput .=  $_SESSION['error'] ;
			$sOutput .= "<h3> Create New Request Form</h3>";
			$sOutput.='
						<div id="donateBlood-form">
						<form name="donateBlood" method="post" action="donateBlood_Request.php?action=request">
							<p>willing to donate blood ? If Yes, click \'Create Request\' button </p>
							<label></label><input type="submit" name="submit" value="Create Request!"  />
						</form>
						</div>
						<br/>';
}else {
	$sOutput .= '<h2>Welcome to Blood Donation Website</h2><br />
		<h4>Would you like to <a href="login.php">login</a>?</h4>
		<h4>Create a new <a href="register.php">account</a>?</h4>';

}
$sOutput .= '</div>';

echo $sOutput;
?>