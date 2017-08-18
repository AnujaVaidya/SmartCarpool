<?php header('Access-Control-Allow-Origin: *'); ?>

<?php
$host="127.0.0.1";
$user="root";
$password="";
$dbname = "smartcarpool";


echo "hi";
// Create connection
$conn = new mysqli($host, $user, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM user_rider";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
   
    while($row = $result->fetch_assoc()) {
        echo "name: " . $row["name"]. " - from: " . $row["fromplace"]. " " . $row["toplace"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>