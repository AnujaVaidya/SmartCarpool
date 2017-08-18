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
$to = $_POST["to"];
$from = $_POST["from"];

date_default_timezone_set('America/Los_Angeles');
$curr_date =  date('Y-m-d'); 
$curr_time =  date("h:i:s A");



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



$sql = "UPDATE  user_driver SET toplace='$to' , fromplace = '$from' , avail ='1' , timed = '$curr_time' , dated = '$curr_date'   WHERE email='$email' ";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    echo "Information submitted successfully. Please check your email for further details";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();




?>