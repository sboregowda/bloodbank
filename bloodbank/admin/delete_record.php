<?php

require($_SERVER['DOCUMENT_ROOT'] . '/bloodbank/admin/includes/config.php');

include 'menu.php';

// If the user is logging in or out
// then lets execute the proper functions
if (isset($_GET['action'])) {
	switch (strtolower($_GET['action'])) {
		
			
		
		}
}


$sOutput .= '<div id="index-body">';
if (loggedIn()) {
	$sOutput .= '<h2>Welcome!</h2>
		Hello, ' . $_SESSION['admin_username'] .'<br />';
	
		$sOutput .= "<h4>Delete Record</h4>";
			
			$response="";
		if (isset($_GET['username'])) {
		}

		if (isset($_GET['user_or_request'])) {
				if ($_GET['user_or_request']=='request'){
					if (isset($_GET['requestType'])) {
						if ($_GET['requestType']=='ask'){
							// sql to delete a record
							$sql = "DELETE FROM AskBlood_Request WHERE username='".$_GET['username']."'";
							$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
							if ($query === TRUE) {
								$response .= "<font color='green'>"."Username = ".$_GET['username']." Record deleted successfully"."</font>";
							} else {
								$response .= "<font color='red'>"."Error deleting record: "."</font>";
							}
						}elseif ($_GET['requestType']=='donate'){
							// sql to delete a record
							$sql = "DELETE FROM DonateBlood_Request WHERE username='".$_GET['username']."'";
							$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
							if ($query === TRUE) {
								$response .= "<font color='green'>"."Username = ".$_GET['username']." Record deleted successfully"."</font>";
							} else {
								$response .= "<font color='red'>"."Error deleting record: "."</font>";
							}
						}
					}
				}elseif($_GET['user_or_request']=='user'){
					// sql to delete a record
					$sql = "DELETE FROM users WHERE username='".$_GET['username']."'";
					$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
					$sql = "DELETE FROM DonateBlood_Request WHERE username='".$_GET['username']."'";
					$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
					$sql = "DELETE FROM AskBlood_Request WHERE username='".$_GET['username']."'";
					$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
					if ($query === TRUE) {
						$response .= "<font color='green'>"."Username = ".$_GET['username']." Records deleted successfully"."</font>";
					} else {
						$response .= "<font color='red'>"."Error deleting record: "."</font>";
					}
				}
		}
			
			
			
			
			$response .="<br/>";
			
			$sOutput .= $response;
	
}else {
	$sOutput .= '<h2>Welcome to Blood Donation Website</h2><br />
		<h4>Would you like to <a href="login.php">login</a>?</h4>
		<h4>Create a new <a href="register.php">account</a>?</h4>';

}
$sOutput .= '</div>';

echo $sOutput;
?>