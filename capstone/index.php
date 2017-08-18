<?php

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']) && $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'POST') {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: X-Requested-With, content-type');
    }
    exit;
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8'); 


$email = $_POST["email"];
$pass = $_POST["password"];



$host="127.0.0.1";
$user="root";
$password="";
$dbname = "smartcarpool";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$sql = "SELECT * FROM riderlogin WHERE email='$email' AND password = '$pass'";
$result = $conn->query($sql);


if ($result->num_rows >= 1) 
{
	while($row = $result->fetch_assoc()) {
    echo "!".$row['email']."!".$row['name'];
}
} else {
    echo "!Error! " . $sql . "<br>" . $conn->error;
}

$conn->close();




?>