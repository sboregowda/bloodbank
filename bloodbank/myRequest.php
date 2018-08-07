<?php

require($_SERVER['DOCUMENT_ROOT'] . '/bloodbank/includes/config.php');

include 'menu.php';

// If the user is logging in or out
// then lets execute the proper functions
if (isset($_GET['action'])) {
	switch (strtolower($_GET['action'])) {
		case 'issue':
			
			
			if (isset($_POST['issueTopic']) ) {
				// We have variables. Pass them to our validation function
				if (createTopic($_POST['issueTopic'],$_SESSION['username'] )) {
					echo "issue saved.";
				}else{
					echo "issue not saved !";
				}
			}
		}
}

$sOutput .= '<div id="index-body">';
if (loggedIn()) {
	$sOutput .= '
		' . $_SESSION['username'] .' <br /><br /><br />';
		
			$sOutput .= "<h4>My Request List</h4>";
			//ASK Blood Request
			$sql = "SELECT * FROM AskBlood_Request WHERE username = '" . $_SESSION['username'] . "' LIMIT 1";
			// Note the use of trigger_error instead of or die.
			$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
			$response="<h5>Ask Blood Request </h5>";
				if (mysql_num_rows($query) == 1) {
					$row = mysql_fetch_assoc($query);
					$response .= "<table>";
					$response .=  "<tr><th>Delete</th><th>Number Of Donors Requested </th>"."<th> Date & Time </th>"."</tr>";
					$str="delete_record.php?username=".$_SESSION['username']."&user_or_request=request&requestType=ask";						
					$response .=  "<tr>"."<td><a href='$str'"." onclick=\"return confirm('Are you sure you want to delete this item?');\">"."click to delete</a></td>"."<td>".$row['numberOfDonorsRequired']."</td><td>".$row['timestamp']."</td></tr>";
					$response .=  "</table>";
				}elseif (mysql_num_rows($query) == 0) {
					$response .=  "No 'Ask Blood' Request Found !";
				}
				
				$response .="<br/>";
			//DONATE Blood Request
			$sql = "SELECT * FROM DonateBlood_Request WHERE username = '" . $_SESSION['username'] . "' LIMIT 1";
			// Note the use of trigger_error instead of or die.
			$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
			$response .="<h5>Donate Blood Request </h5>";
				if (mysql_num_rows($query) == 1) {
					$row = mysql_fetch_assoc($query);
					$response .= "<table>";
					$response .=  "<tr>"."<th>Delete</th><th> Date & Time </th>"."</tr>";
					$str="delete_record.php?username=".$_SESSION['username']."&user_or_request=request&requestType=donate";
					$response .=  "<tr>"."<td><a href='$str'"." onclick=\"return confirm('Are you sure you want to delete this item?');\">"."click to delete</a></td>"."<td>".$row['timestamp']."</td></tr>";
					$response .=  "</table>";
				}elseif (mysql_num_rows($query) == 0) {
					$response .=  "No 'Donate Blood' Request Found !";
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