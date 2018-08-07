<?php


/***********
	bool createAccount (string $pUsername, string $pPassword)
		Attempt to create an account for the passed in 
		username and password.
************/
function createAccount($pUsername, $pPassword) {
	
	// First check we have data passed in.
	if (!empty($pUsername) && !empty($pPassword) ) {
		$uLen = strlen($pUsername);
		$pLen = strlen($pPassword);
		
		// escape the $pUsername to avoid SQL Injections
		$eUsername = mysql_real_escape_string($pUsername);
		$sql = "SELECT username FROM adminUsers WHERE username = '" . $eUsername . "' LIMIT 1";

		// Note the use of trigger_error instead of or die.
		$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());

		// Error checks (Should be explained with the error)
		
		//regular expression for email validation
	    if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",
            $eUsername)) {
			if ($uLen <= 1) {
				$_SESSION['error'] = "E-Mail must not be blank.";
				echo $_SESSION['error'];
				return false;
			}elseif ($pLen < 6) {
				$_SESSION['error'] = "Password must be longer then 6 characters.";
				echo $_SESSION['error'];
				return false;
			}elseif (mysql_num_rows($query) == 1) {
				$_SESSION['error'] = "Username already exists.";
				echo $_SESSION['error'];
				return false;
			}else {
				// All errors passed lets
				// Create our insert SQL by hashing the password and using the escaped Username.
				$sql = "INSERT INTO adminUsers (username, password) VALUES ('" . $eUsername . "', '" . hashPassword($pPassword, SALT1, SALT2) ."')";
				$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
			
				if ($query) {
					return true;
				}	
			}
		
        
        } else {
            $_SESSION['error'] = "<font color='red'>Your EMail Address is invalid</font>  ";
        }
	}
	
	return false;
}


/***********
	bool updateAccount (string $pUsername, string $pPassword)
		Attempt to create an account for the passed in 
		username and password.
************/
function updateAccount(	$pUsername, $pPassword) {
	// First check we have data passed in.
	
	if (!empty($pUsername) && !empty($pPassword) ) {
		$uLen = strlen($pUsername);
		$pLen = strlen($pPassword);
		
		// escape the $pUsername to avoid SQL Injections
		$eUsername = mysql_real_escape_string($pUsername);
		
		// Error checks (Should be explained with the error)
		
		//regular expression for email validation
	    if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",
            $eUsername)) {
			if ($uLen <= 1) {
				$_SESSION['error'] = "<font color='red'>E-Mail must not be blank.</font>";
				return false;
			}elseif ($pLen < 6) {
				$_SESSION['error'] = "<font color='red'>Password must be longer then 6 characters.</font>";
				return false;
			}else {
				// All errors passed lets
				// Create our insert SQL by hashing the password and using the escaped Username.
				$sql="UPDATE adminUsers SET username='".$eUsername."', password='".hashPassword($pPassword, SALT1, SALT2)."' 
							 WHERE username='".$_SESSION['admin_username']."'";
									
				

				$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
			
				if ($query) {
					$_SESSION['admin_username']=$eUsername;
					$_SESSION['admin_password']=$pPassword;
					return true;
				}
			}
        } else {
            $_SESSION['error'] = "<font color='red'>Your EMail Address is invalid</font>  ";
        	return false;
        }
	}
	//echo "firstName = ".$firstname.", lastName=".$lastname.",bloodType=".$bloodtype.",address=".$address.",city=".$city.",state=".$state.",zipcode=".$zipcode.",phone=".$phone;
	$_SESSION['error'] = "<font color='red'>Can't be blank</font>  ";
	return false;
}


function sendMessage($from, $to,$msg) {
	
	// First check we have data passed in.
	if (!empty($from) && !empty($to) && !empty($msg) ) {
		
		// Create our insert SQL by hashing the password and using the escaped Username.
		$sql = "INSERT INTO message (_from, _to,msg) VALUES ('" . $from . "', '" . $to ."', '".$msg."')";
		$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());

		if ($query) {
			return true;
		}
	}
	
	return false;
}
/***********
	string hashPassword (string $pPassword, string $pSalt1, string $pSalt2)
		This will create a SHA1 hash of the password
		using 2 salts that the user specifies.
************/
function hashPassword($pPassword, $pSalt1="2345#$%@3e", $pSalt2="taesa%#@2%^#") {
	return sha1(md5($pSalt2 . $pPassword . $pSalt1));
}

/***********
	bool loggedIn
		verifies that session data is in tack
		and the user is valid for this session.
************/
function loggedIn() {
	// check both loggedin and username to verify user.
	if (isset($_SESSION['loggedin']) && isset($_SESSION['admin_username'])) {
		return true;
	}
	
	return false;
}

/***********
	bool logoutUser 
		Log out a user by unsetting the session variable.
************/
function logoutUser() {
	// using unset will remove the variable
	// and thus logging off the user.
	unset($_SESSION['admin_username']);
	unset($_SESSION['admin_password']);
	unset($_SESSION['loggedin']);
	
	return true;
}

/***********
	bool validateUser
		Attempt to verify that a username / password
		combination are valid. If they are it will set
		cookies and session data then return true. 
		If they are not valid it simply returns false. 
************/
function validateUser($pUsername, $pPassword) {
	// See if the username and password are valid.
	$sql = "SELECT username FROM adminUsers 
		WHERE username = '" . mysql_real_escape_string($pUsername) . "' AND password = '" . hashPassword($pPassword, SALT1, SALT2) . "' LIMIT 1";
	$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
	
	// If one row was returned, the user was logged in!
	if (mysql_num_rows($query) == 1) {
		$row = mysql_fetch_assoc($query);
		$_SESSION['admin_username'] = $row['username'];
		$_SESSION['admin_password'] = $pPassword;
		$_SESSION['loggedin'] = true;
		
		return true;
	}
	
	
	return false;
}
?>