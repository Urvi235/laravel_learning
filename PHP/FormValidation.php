<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php
$nameErr = $emailErr = "";
$name = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["name"])){
        $nameErr = "Name is Essential.";
    } else {
        $name = test_input($_POST['name']);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
          }
    }

    if(empty($_POST["email"])){
        $emailErr = "email is Essential.";
    } else {
        $email = test_input($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
          }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>PHP Form validation </h2>
<p><span class="error">* required Field </span></p>

<form method="post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    name: <input type="text" name="name">
    <span class="error">* <?php echo $nameErr; ?></span>
    <br><br>

    Email: <input type="text" name="email">
    <span class="error">* <?php echo $emailErr; ?></span>
    <br><br>

    <input type="submit">
    
</form>

<?php
echo "<h2>Your Input:</h2>";
if($nameErr && $emailErr ){
    echo "sorry you have got some Errors ...";
}else{
    if($name && $email){
        echo $name. "<br>";
        echo $email."<br>";
        echo "data submitted date ".date("d/m/Y")."<br>";
    }
}

?>

</body>
</html>
