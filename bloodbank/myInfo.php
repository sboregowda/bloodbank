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
		
			$sOutput .= "<h4>My Info </h4>";
			
			$response="<h5>My Info</h5>";
			$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
			// Note the use of trigger_error instead of or die.
			$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
			$response="";
			
				
				$response .= "<table>";
						$response .=  	"<tr><th>Edit</th><th>UserName</th>".
										"<th> Password </th>".
										"<th> First Name </th>".
										"<th> Last Name </th>".
										"<th> BloodType </th>".
										"<th> Address </th>".
										"<th> City </th>".
										"<th> State </th>".
										"<th> Zipcode </th>".
										"<th> Phone </th>".
										"</tr>";
						
				while($row = mysql_fetch_array($query)){
						//var_dump($row)	;
						
						$str="edit_info.php?username=".$row['username']."&user_or_request=user";
						$response .="<tr>".
									"<td>"."<a href='$str'"." onclick=\"return confirm('Are you sure you want to edit this item?');\">"."click to edit"."</a>".
									"</td><td>".$row['username'].
									"<td>".$_SESSION['password'].
									"</td><td>".$row['firstname'].
									"</td><td>".$row['lastname'].
									"</td><td>".$row['bloodtype'].
									"</td><td>".$row['address'].
									"</td><td>".$row['city'].
									"</td><td>".$row['state'].
									"</td><td>".$row['zipcode'].
									"</td><td>".$row['phone'].
									"</td></tr>";
									
				}
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