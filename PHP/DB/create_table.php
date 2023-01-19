<?php 

include 'connect.php';

//              Create Table --------
$data = "CREATE TABLE Users_DB (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    first_Name VARCHAR(30) NOT NULL,
    last_Name VARCHAR(30) NOT NULL,
    email VARCHAR(30)
    -- reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $data)) {
    echo "Table created successfully";
  } else {
    echo "Error creating table: " . mysqli_error($conn);
  }

?> 
