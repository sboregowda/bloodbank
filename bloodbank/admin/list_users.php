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
	
		$sOutput .= "<h4>Users List</h4>";
			//ASK Blood Request
			$sql = "SELECT * FROM users";
			// Note the use of trigger_error instead of or die.
			$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
			$response="";
			
			if (mysql_num_rows($query)>0) {
				$response .= "<table>";
						$response .=  	"<tr><th>Delete</th><th>UserName</th>".
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
						
						$str="delete_record.php?username=".$row['username']."&user_or_request=user";
						$response .="<tr>".
									"<td>"."<a href='$str'"." onclick=\"return confirm('Are you sure you want to delete this item?');\">"."click to delete"."</a>".
									"</td><td>".$row['username'].
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
				
			}
			elseif (mysql_num_rows($query) == 0) {
				$response .=  "No 'user'  Found !";
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