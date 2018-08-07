<?php


/***********
	bool createAccount (string $pUsername, string $pPassword)
		Attempt to create an account for the passed in 
		username and password.
************/
function createAccount(	$pUsername, $pPassword,
						$firstname,	$lastname,
						$bloodtype,	$address,
						$city,		$state,
						$zipcode,	$phone) {
	// First check we have data passed in.
	
	if (!empty($pUsername) && !empty($pPassword) ) {
		$uLen = strlen($pUsername);
		$pLen = strlen($pPassword);
		
		// escape the $pUsername to avoid SQL Injections
		$eUsername = mysql_real_escape_string($pUsername);
		$sql = "SELECT username FROM users WHERE username = '" . $eUsername . "' LIMIT 1";
		
		
		// Note the use of trigger_error instead of or die.
		$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
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
			}elseif (mysql_num_rows($query) == 1) {
				$_SESSION['error'] = "<font color='red'>Username already exists.</font>";
				return false;
			}else {
				// All errors passed lets
				// Create our insert SQL by hashing the password and using the escaped Username.
				$sql = "INSERT INTO users (	username, password,
											firstname,	lastname,
											bloodtype,	address,
											city,		state,
											zipcode,	phone) VALUES 
											('" . $eUsername . "', '" 
												. hashPassword($pPassword, SALT1, SALT2) ."','"
												. 	$firstname 	."','"
												.	$lastname	."','"
												.	$bloodtype	."','"	
												.	$address	."','"
												.	$city		."','"
												.	$state		."','"
												.	$zipcode	."','"
												.	$phone		."')";

				$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
			
				if ($query) {
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


/***********
	bool updateAccount (string $pUsername, string $pPassword)
		Attempt to create an account for the passed in 
		username and password.
************/
function updateAccount(	$pUsername, $pPassword,
						$firstname,	$lastname,
						$bloodtype,	$address,
						$city,		$state,
						$zipcode,	$phone) {
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
				$sql="UPDATE users SET username='".$eUsername."', password='".hashPassword($pPassword, SALT1, SALT2)."',
									firstname='". 	$firstname 	."',
									lastname='" .	$lastname	."',
									bloodtype='".	$bloodtype	."',
									address='"  .	$address	."',
									city='"		.	$city		."',
									state='"	.	$state		."',
									zipcode='"	.	$zipcode	."',
									phone='"	.	$phone		."' WHERE username='".$_SESSION['username']."'";
									
				

				$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
			
				if ($query) {
					$_SESSION['username']=$eUsername;
					$_SESSION['password']=$pPassword;
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

function decrementDonorCount($user){
	if (!empty($user)) {
		
		$sql = "select numberOfDonorsRequired FROM AskBlood_Request WHERE username ='".$user."' LIMIT 1";
		$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
		if (!$query) {
			echo 'Could not run query: ' . mysql_error();
			return false;
		}else{
			$row = mysql_fetch_assoc($query);

			$value= $row['numberOfDonorsRequired'];
			$newValue=$value-1;
			if ($value>0){
				$sql = "UPDATE AskBlood_Request SET numberOfDonorsRequired= '".$newValue."' WHERE username ='".$user."'";
				$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());

				if ($query) {
					return true;
				}
			}
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
	if (isset($_SESSION['loggedin']) && isset($_SESSION['username'])) {
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
	unset($_SESSION['username']);
	unset($_SESSION['loggedin']);
	unset($_SESSION['bloodtype']);
	unset($_SESSION['city']);
	
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
	$sql = "SELECT * FROM users 
		WHERE username = '" . mysql_real_escape_string($pUsername) . "' AND password = '" . hashPassword($pPassword, SALT1, SALT2) . "' LIMIT 1";
	$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
	
	// If one row was returned, the user was logged in!
	if (mysql_num_rows($query) == 1) {
		$row = mysql_fetch_assoc($query);
		$_SESSION['username'] = $row['username'];
		$_SESSION['bloodtype']=$row['bloodtype'];
		$_SESSION['password']=$pPassword;
		$_SESSION['city']=$row['city'];
		$_SESSION['loggedin'] = true;
		
		return true;
	}
	
	
	return false;
}

function createRequest_askBlood($numberOfDonors,$username ){
	if(!empty($numberOfDonors) ){
		if (is_numeric($numberOfDonors)){
			if (($numberOfDonors)>0){
			
				$sql = "SELECT username FROM AskBlood_Request WHERE username = '" . $username . "' LIMIT 1";
				// Note the use of trigger_error instead of or die.
				$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
				if (mysql_num_rows($query) == 1) {
					$_SESSION['error'] = "<font color='red'>Request already exists for this user. <br/> You can edit or delete request from 'My Request' section.<br/> </font>";
					return false;
				}else{
					// Create our insert SQL
					$sql = "INSERT INTO AskBlood_Request (	username, numberOfDonorsRequired) VALUES 
												('" . $username . "', '" 
													.	$numberOfDonors		."')";

					$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
			
					if ($query) {
						return true;
					}
				}
			}else{
				$_SESSION['error'] = "<font color='red'>Can't be less than zero.</font>  ";
				return false;
			}
		}else{
			$_SESSION['error'] = "<font color='red'>Should be numeric</font>  ";
			return false;
		}
	}
	else{
		$_SESSION['error'] = "<font color='red'>Can't be blank</font>  ";
		return false;
	}
}

function createRequest_donateBlood($username ){
			$sql = "SELECT username FROM DonateBlood_Request WHERE username = '" . $username . "' LIMIT 1";
				// Note the use of trigger_error instead of or die.
				$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
				if (mysql_num_rows($query) == 1) {
					$_SESSION['error'] = "<font color='red'>Request already exists for this user. <br/> You can edit or delete request from 'My Request' section.<br/> </font>";
					return false;
				}else{
					// Create our insert SQL
					$sql = "INSERT INTO DonateBlood_Request (	username) VALUES ('".$username."')";

					$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
			
					if ($query) {
						return true;
					}
				}
}
?>