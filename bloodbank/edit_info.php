<?php

require($_SERVER['DOCUMENT_ROOT'] . '/bloodbank/includes/config.php');

include 'menu.php';

$sOutput .= '<div id="register-body">';

if (isset($_GET['action'])) {
	switch (strtolower($_GET['action'])) {
		case 'update':
			// If the form was submitted lets try to create the account.
			if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] != "" && $_POST['password'] != "" ) {
				if (updateAccount(	$_POST['username'], $_POST['password'],
									$_POST['firstname'],$_POST['lastname'],
									$_POST['bloodtype'],$_POST['address'],
									$_POST['city'],$_POST['state'],
									$_POST['zipcode'],$_POST['phone'])) {
					$sOutput .= "<font color='green'><h1>Account Updated</h1><br />".$_SESSION['username']." account has been updated.'</font>";
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
				

	// incase there was an error 
	// see if we have a previous username
	$sUsername = "";
	/*
	if (isset($_POST['username'])) {
		$sUsername = $_POST['username'];
	}
	*/

	$sError = "";
	if (isset($_SESSION['error'])) {
		$sError = '<span id="error">' . $_SESSION['error'] . '</span><br />';
	}

	$sql = "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "' ";
	// Note the use of trigger_error instead of or die.
	$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());

	if (mysql_num_rows($query) == 1) {
		$row = mysql_fetch_assoc($query);
	}
	
	$sOutput .= '<h2>Blood Donation Website</h2>';
	$sOutput .= '<h2>Edit Info </h2>';
	$sOutput .='
		' . $sError . '
		<form name="update" method="post" action="' . $_SERVER['PHP_SELF'] . '?action=update">
			
			<label>First Name: </label><input type="text" name="firstname" value='.$row['firstname'].' /><br /> 
			<label>Last Name: </label><input type="text" name="lastname" value='.$row['lastname'].' /><br /> 
			<label>Blood Type: </label><input type="text" name="bloodtype" value='.$row['bloodtype'].' /><br /> 
			<label>Address: </label><input type="text" name="address" value='.$row['address'].' /><br /> 
			<label>City: </label><input type="text" name="city" value='.$row['city'].' /><br /> 
			<label>State: </label><input type="text" name="state" value='.$row['state'].' /><br /> 
			<label>Zipcode: </label><input type="text" name="zipcode" value='.$row['zipcode'].' /><br /> 
			<label>Phone:</label><input type="text" name="phone" value='.$row['phone'].' /><br /> 
			<label>E-Mail: </label><input type="text" name="username" value='.$row['username'].' /><br />
			<label>Password: </label><input type="password" name="password" value="" /><br /> 
			 
			<label></label><input type="submit" name="submit" value="Update!" />
		</form>
		<br />';
		
}

$sOutput .= '</div>';

// display our output.
echo $sOutput;
?>