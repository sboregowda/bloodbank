<?php

?>

<style>
ul {
    list-style-type: none;
    margin-top: 20;
    padding: 15;
    background-color:yellow;
    width:90%;
}
body{
margin:20;
}
li {
    display: inline;
    padding:20;
}
input{
margin:2px;
}

body, body table {
	font-family: "Times New Roman", Times, serif;
	font-size: small;
}
.xsmall {
	font-size: x-small;
}

label{
float: left;
width: 120px;
font-weight: bold;
}

#submitbutton{
margin-left: 120px;
margin-top: 5px;
width: 90px;
}


input, textarea{
width: 180px;
margin-bottom: 5px;
}

textarea{
width: 250px;
height: 150px;
}

br{
clear: left;
}

table{
color:#000000;
border:2px solid black;
}
th{
font-weight: bold;
width:200px;
border:2px solid black;
text-align:center
}
tr{
width:200px;
 
}
td{
border:2px solid black;
text-align:center
}
</style>
</head>
<body>

<ul>
<b>Blood Donation Website</b>
<?php


if (loggedIn()) {
?>
  	<!--<li><a href="index.php">Home</a></li>
  	-->
  	
  	<li><a href='askBlood.php'>Ask Blood</a></li>
	<li><a href='donateBlood.php'>Donate Blood</a></li>
	<li><a href='inbox.php'>Inbox</a></li>
	<li><a href='myRequest.php'>My Request</a></li>
	<li><a href='myInfo.php'>My Info</a></li>
  	<li><a href="login.php?action=logout">Logout</a></li>
<?php  
}else{
?>
<li><a href="login.php">Login</a></li>
<li><a href="register.php">Register</a></li>
<?php
}
?>
</ul>


