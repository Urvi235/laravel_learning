<?php 

include 'connect.php';

//                  fetch all data ------
echo "fetch all data  :--<br>";

$sql = "SELECT id, first_Name, last_Name, email FROM Users_DB";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)) {
        echo "id:". $row["id"]."  ,first_name:". $row["first_Name"]."  ,last_name:". $row["last_Name"]."  ,email:". $row["email"]."<br>";
    }
}
else {
    echo "0 results";
  }
echo "<br>";


//                  get data by id/name/mail -------

echo "get data by mail :--<br>";
$sql = "SELECT id, first_Name, last_Name FROM Users_DB WHERE email = 'urvi@gmail.com' ";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)) {
        echo "id:". $row["id"]."  ,first_name:". $row["first_Name"]."  ,last_name:". $row["last_Name"]."<br>";
    }
}
else {
    echo "0 results";
  }

?> 

