<?php

require($_SERVER['DOCUMENT_ROOT'] . '/bloodbank/admin/includes/config.php');

include 'menu.php';

$sOutput .= '<div id="register-body">';

if (isset($_GET['action'])) {
	switch (strtolower($_GET['action'])) {
		case 'register':
			// If the form was submitted lets try to create the account.
			if (isset($_POST['username']) && isset($_POST['password']) ) {
				if (createAccount($_POST['username'], $_POST['password'])) {
					$sOutput .= '<h1>Account Created</h1><br />Your account has been created. 
								You can now login <a href="login.php">here</a>.';
				}else {
					// unset the action to display the registration form.
					unset($_GET['action']);
				}
			}else {
				$_SESSION['error'] = "<font color='red'>Username and or Password was not supplied.</font>";
				unset($_GET['action']);
			}
		break;
	}
}

// If the user is logged in display them a message.
if (loggedIn()) {
	$sOutput .= '<h2>Already Registered</h2>
				You have already registered and are currently logged in as: ' . $_SESSION['username'] . '.
				<h4>Would you like to <a href="login.php?action=logout">logout</a>?</h4>
				<h4>Would you like to go to <a href="index.php">site index</a>?</h4>';
				
// If the action is not set, we want to display the registration form
}elseif (!isset($_GET['action'])) {
	// incase there was an error 
	// see if we have a previous username
	$sUsername = "";
	if (isset($_POST['username'])) {
		$sUsername = $_POST['username'];
	}
	
	$sError = "";
	if (isset($_SESSION['error'])) {
		$sError = '<span id="error">' . $_SESSION['error'] . '</span><br />';
	}
	$sOutput .= '<h2>Blood Donation Website</h2>';
	$sOutput .= '<h2>Register </h2>';
	$sOutput .='' . $sError . '
		<form name="register" method="post" action="' . $_SERVER['PHP_SELF'] . '?action=register">
			<label>E-Mail:</label><input type="text" name="username" value="' . $sUsername . '" /><br />
			<label>Password:</label><input type="password" name="password" value="" /><br /> 
			<label></label><input type="submit" name="submit" value="Register!" />
		</form>
		
		<h4>Would you like to <a href="login.php">login</a>?</h4>';
}

$sOutput .= '</div>';

// display our output.
echo $sOutput;
?>