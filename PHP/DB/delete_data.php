<?php 

include 'connect.php';

//  Delete the record by id: ------
$sql = "DELETE FROM Users_DB WHERE id = 14";

if(mysqli_query($conn, $sql)){
    echo "record deleted successfully....";
}
else{
    echo "there might ome issue in deleting record".mysqli_error($conn);
}

?> 