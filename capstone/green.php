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
$a = $_POST["email"];
echo $a;

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

$sql = "SELECT * FROM user_rider WHERE email='$a'";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
   
    while($row = $result->fetch_assoc()) {
        echo ": " . $row["name"]. " : " . $row["email"]. " : " . $row["fromplace"]. " : " . $row["toplace"]  . " : " . $row["dater"] .  " : " .$row["miles"];
    }
} else {
    echo "name:0 results";
}
$conn->close();
?>