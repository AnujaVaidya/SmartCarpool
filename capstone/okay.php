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
$toplace = $_POST["to"];
$fromplace = $_POST["from"];
$count = $_POST["count"];
$driver = $_POST["driver"];
$miles = $_POST["miles"];


$cnt = intval($count);



date_default_timezone_set('America/Los_Angeles');
$curr_date =  date('Y-m-d'); 
$curr_time =  date("h:i:s:A");

echo "\n".$curr_time;

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
$sql = "INSERT INTO user_rider (email, toplace, fromplace, dater, timer, miles) VALUES ('$email', '$toplace' , 
    '$fromplace' , '$curr_date','$curr_time', '$miles' )";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) 
{
      echo "!ok";
    
} else {
    echo "name:0 results";
}
$conn->close();

if(strlen($driver) != 0)
    {
        echo "infi";

                $con1 = new mysqli($host, $user, $password, $dbname);
                // Check connection
                if ($con1->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $count = $count +1;

                $sql = "UPDATE  user_driver SET avail = '$cnt' WHERE email='$driver' ";
                $result = $con1->query($sql);

                if ($con1->query($sql) === TRUE) 
                {   echo "::ok";
                    
                } else {
                    echo "error";
                }
                $con1->close();

    }


?>
