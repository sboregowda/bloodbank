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
		Hello, ' . $_SESSION['admin_username'] .' <br />';
	
		
			$sOutput .= "<h4>My Request List</h4>";
			//ASK Blood Request
			$sql = "SELECT * FROM AskBlood_Request ";
			// Note the use of trigger_error instead of or die.
			$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
			$response="<h5>Ask Blood Request </h5>";
				if (mysql_num_rows($query) > 0) {
					$response .= "<table>";
					$response .=  "<tr><th>Delete</th><th>Username</th><th>Number Of Donors Requested </th>"."<th> Date & Time </th>"."</tr>";

					while($row = mysql_fetch_array($query)){
						$str="delete_record.php?username=".$row['username']."&user_or_request=request&requestType=ask";
						$response .=  "<tr>"."<td><a href='$str'"." onclick=\"return confirm('Are you sure you want to delete this item?');\">"."click to delete</a></td>"."<td>".$row['username']."</td>"."<td>".$row['numberOfDonorsRequired']."</td><td>".$row['timestamp']."</td></tr>";
					}
					$response .=  "</table>";

				}elseif (mysql_num_rows($query) == 0) {
					$response .=  "No 'Ask Blood' Request Found !";
				}
				
				$response .="<br/>";
			//DONATE Blood Request
			$sql = "SELECT * FROM DonateBlood_Request ";
			// Note the use of trigger_error instead of or die.
			$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
			$response .="<h5>Donate Blood Request </h5>";
				if (mysql_num_rows($query) > 0) {
					$response .= "<table>";
					$response .=  "<tr><th>Delete</th>"."<th>Username</th>"."<th> Date & Time </th>"."</tr>";
					while($row = mysql_fetch_array($query)){
						$str="delete_record.php?username=".$row['username']."&user_or_request=request&requestType=donate";
						$response .=  "<tr>"."<td><a href='$str'"." onclick=\"return confirm('Are you sure you want to delete this item?');\">"."click to delete</a></td>"."<td>".$row["username"]."</td>"."<td>".$row['timestamp']."</td></tr>";
					}
					
					$response .=  "</table>";
				}elseif (mysql_num_rows($query) == 0) {
					$response .=  "No 'Donate Blood' Request Found !";
				}
			$response .="<br/>";
			$sOutput .=$response;
		
}else {
	$sOutput .= '<h2>Welcome to Blood Donation Website</h2><br />
		<h4>Would you like to <a href="login.php">login</a>?</h4>
		<h4>Create a new <a href="register.php">account</a>?</h4>';

}
$sOutput .= '</div>';

echo $sOutput;
?>