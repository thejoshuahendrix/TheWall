<?php
session_start();
$servername = "acad-classweb01";
$username = "cit1200A";
$password = "cit1200";
//Use your own Semester, Year, userID
$dbname = "Fall2020_CIT1200_hendrixj6183";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname );

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// echo "Connected successfully";
?>