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
	$sOutput .= 'ADMIN: ' . $_SESSION['admin_username'] .' <br /><br /><br />';
		
			$sOutput .= "<h4>My Info </h4>";
			
					$response="<h5>My Info</h5>";
					$response .= "<table>";
					$response .=  "<tr><th>Edit</th><th>email </th>"."<th> password </th>"."</tr>";
					$str="edit_info.php?username=".$_SESSION['admin_username'];						
					$response .=  "<tr>"."<td><a href='$str'"." onclick=\"return confirm('Are you sure you want to edit this item?');\">"."click to edit</a></td>"."<td>".$_SESSION['admin_username']."</td><td>".$_SESSION['admin_password']."</td></tr>";
					$response .=  "</table>";
				
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