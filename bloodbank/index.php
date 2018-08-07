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
		Hello, ' . $_SESSION['username'] .' <br /><br /><br />';
			/*
			$sOutput .= "<a href='askBlood.php'>Ask Blood</a> &nbsp;&nbsp;";
			$sOutput .= "<a href='donateBlood.php'>Donate Blood</a> &nbsp;&nbsp;";
			$sOutput .= "<a href='inbox.php'>Inbox</a> &nbsp;&nbsp;";
			$sOutput .= "<a href='myRequest.php'>My Request</a> &nbsp;&nbsp;";
			*/
			
			$query  = "SELECT NOW() as `now`";
			$result = mysql_query($query);
			$row    = mysql_fetch_assoc($result);
			$now    = $row['now'];
			//echo "$now\n";
			
			$date2=$now;
			$ts2 = strtotime($date2);
			
			
			//echo "<br/>";
			$sql = "SELECT timestamp FROM AskBlood_Request";
			// Note the use of trigger_error instead of or die.
			$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());

			while($row = mysql_fetch_array($query,MYSQL_NUM) ){
        		//echo $row[0];
        		$date1=$row[0];
				$ts1 = strtotime($date1);
			
				$seconds_diff = $ts2 - $ts1;
				$day_diff=floor($seconds_diff/(60*60*24));
				//echo "<br/>seconds_diff = ".$seconds_diff;
				//echo "<br/>day_diff = ".$day_diff."<br/><br/>";
				if ($day_diff>=10){
					$delSql="DELETE FROM AskBlood_Request WHERE timestamp = '".$row[0]."'";
					$query = mysql_query($delSql) or trigger_error("Query Failed: " . mysql_error());
					echo "<br/> ask entry 10 days older deleted.<br/>";
				}
        	}
        
			$sql = "SELECT timestamp FROM DonateBlood_Request";
			// Note the use of trigger_error instead of or die.
			$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
			while($row = mysql_fetch_array($query,MYSQL_NUM)){
        		//echo $row[0];
        		$date1=$row[0];
				$ts1 = strtotime($date1);
			
				$seconds_diff = $ts2 - $ts1;
				$day_diff=floor($seconds_diff/(60*60*24));
				//echo "<br/>seconds_diff = ".$seconds_diff;
				//echo "<br/>day_diff = ".$day_diff."<br/><br/>";
				if ($day_diff>=10){
					$delSql="DELETE FROM DonateBlood_Request WHERE timestamp = '".$row[0]."'";
					$query = mysql_query($delSql) or trigger_error("Query Failed: " . mysql_error());
					echo "<br/>donate entry 10 days older deleted.<br/>";
				}
			
        	}
		

}else {
	$sOutput .= '<h2>Welcome to Blood Donation Website</h2><br />
		<h4>Would you like to <a href="login.php">login</a>?</h4>
		<h4>Create a new <a href="register.php">account</a>?</h4>';

}
$sOutput .= '</div>';

echo $sOutput;
?>