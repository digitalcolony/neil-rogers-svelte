<?php
	$servername = "ns2.m46.siteground.biz";
	$username = "ineedcof_neil6";
	$password = "playanything610!";
	$dbname = "ineedcof_neil610";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
      //  echo "connected!";
    }
?>