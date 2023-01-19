<?php 

include 'connect.php';

//  Update the record : ------
$sql = "UPDATE Users_DB SET first_Name = 'xyz' WHERE id = 5";

if(mysqli_query($conn, $sql)){
    echo "record updated successfully....";
}
else{
    echo "there might ome issue in updating record".mysqli_error($conn);
}

?> 