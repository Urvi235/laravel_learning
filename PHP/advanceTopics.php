<h4>-->  Cookies ...  </h4>

<?php

//                                                  : COOKIES [Peace of information which is stored in user in pc] : 
// Used to know users prefrences and the behaviour of user ... So if user visite again we can share things with their prefrences ... 
// [used for store non sensitive informations]

// setcookie("name", "value","time for expire","domain to use")
setcookie("language","PHP" , time() + 86400 , "/");

// get cookie 
$cookies = $_COOKIE['language'];
echo "  - available cookies : ".$cookies."<br>";



?>
<h4>-->  Check variable in range or not ...</h4>

<?php
$int = 122;
$min = 1;
$max = 200;


if (filter_var($int, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max))) === false) {
  echo("  - Variable value is not within the legal range");
} else {
  echo("  - Variable value is within the legal range");
}
?>

