<?php

//                            Mysqli[Mysql improve] Procedural :         //

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userDB";

//              Create connection -----
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
else {
    echo "connected successfully... <br>";
}



//              Create database ------
/*
$sql = "CREATE DATABASE userDB";
if (mysqli_query($conn, $sql)) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}
*/


?>

