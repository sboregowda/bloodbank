<?php

require($_SERVER['DOCUMENT_ROOT'] . '/bloodbank/includes/config.php');

include 'menu.php';



$sOutput .= '<div id="index-body">';
if (loggedIn()) {
	$sOutput .= '
		' . $_SESSION['username'] .' <br />';
		
			$sOutput .= "<h4>My Messages List</h4>";
			//ASK Blood Request
			$sql = "SELECT * FROM message WHERE _to = '" . $_SESSION['username'] . "' ";
			// Note the use of trigger_error instead of or die.
			$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		
			$response = "<h5>Inbox </h5>";
			$response .="";
			
			if (mysql_num_rows($query)>0) {
				$response .= "<table>";
						$response .=  	"<tr><th>Messge Time</th>".
										"<th> From </th>".
										"<th> To </th>".
										"<th> Message </th>".
										"</tr>";
						
				while($row = mysql_fetch_array($query)){
						//var_dump($row)	;
						
						$response .="<tr>".
									"<td>".$row['timestamp'].
									"</td><td>".$row['_from'].
									"</td><td>".$row['_to'].
									"</td><td>".$row['msg'].
									"</td></tr>";
									
				}
				$response .=  "</table>";
				
			}
			elseif (mysql_num_rows($query) == 0) {
				$response .=  "No Messages  Found !";
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