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


//to

$email = $_POST["email"];

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





echo "3";
$sql = "DELETE from user_rider order by id desc limit 1";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) 
{
      echo "bye";
    
} else {
    echo "error";
}
$conn->close();


?>