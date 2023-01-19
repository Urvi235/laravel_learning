<?php 

//              Insert new record to DB   //
include 'connect.php';

//  Insert Single record : -------
/*
$sql = "INSERT INTO Users_DB(first_Name, last_Name, email)
    VALUES ('urvi', 'Solanki', 'urvi@gmail.com')";            */


//  Insert Multiple records : -------
$sql = "INSERT INTO Users_DB(first_Name, last_Name, email)
    VALUES ('urvi', 'Solanki', 'urvis112@gmail.com'),
    ('krish', 'Solanki', 'krish@gmail.com'),
    ('shruti', 'patel', 'shruti@gmail.com'),
    ('meet', 'patel', 'meet@gmail.com')";


if(mysqli_query($conn, $sql)) {
    echo "New record inserted successfully... <br>";
}
else{
    echo "Error in inserting record: ".mysqli_error($conn);
}
?> 


