<?php

$email2 = $_POST['email2'];
$upswd3 = $_POST['upswd3'];

if (!empty($email2) || !empty($upswd3)) {

  $host = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "myproject";

  // Create connection
  $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

  if (mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
      . mysqli_connect_error());
  } else {
    $SELECT = "SELECT * From signup Where email = ? and upswd1 = ? Limit 1";

    //Prepare statement
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("ss", $email2, $upswd3);
    $stmt->execute();
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    //checking username
    if ($rnum == 0) {
      echo "Invalid email or password";
    } else {
      echo "Welcome User";
    }
    $stmt->close();
    $conn->close();
  }
} else {
  echo "All field are required";
  die();
}
