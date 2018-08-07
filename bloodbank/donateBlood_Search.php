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
	$sOutput .= '<h2>Welcome!</h2>
		Hello, ' . $_SESSION['username'] .'<br/><br />';
		
			$sOutput .= "<b>Search Results</b>";
			
			//ASK Blood Request
			$sql = "SELECT * FROM AskBlood_Request JOIN users ON AskBlood_Request.username=users.username WHERE users.bloodtype = '" . $_SESSION['bloodtype'] . "' and users.city='".$_SESSION['city']."' and users.username != '".$_SESSION['username']."'";
			
			//echo "<br/>".$sql;
			
			// Note the use of trigger_error instead of or die.
			$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
			$response="<h5>List of People who need blood of your bloodtype <b>". $_SESSION['bloodtype']."</b> and your city <b>". $_SESSION['city']."</h5>";
				//
				if (mysql_num_rows($query)==0 ){
					$response .= "No record found!";
				}else if (mysql_num_rows($query)>0){
					$response .= "<table>";
					$response .= "<tr><td>Username</td><td>Join</td></tr>"; 
					while($row = mysql_fetch_array($query,MYSQL_BOTH) ){
						$response .= "<tr>"."<td>".$row['username']."</td>"."<td>"."<a href='join.php?to=".$row['username']."&typeOfMessage=donate'>Click To Join</a>"."</td>"."</tr>";
					}
					$response .= "</table>";
				}
				//
			$sOutput .= $response;
}else {
	$sOutput .= '<h2>Welcome to Blood Donation Website</h2><br />
		<h4>Would you like to <a href="login.php">login</a>?</h4>
		<h4>Create a new <a href="register.php">account</a>?</h4>';

}
$sOutput .= '</div>';

echo $sOutput;
?>