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

error_reporting(0);
//to
$a = $_POST["lati1"];
$b = $_POST["longi1"];
//from
$c  = $_POST["lati2"];
$d  = $_POST["longi2"];

$top  = $_POST["to"];
$fromp  = $_POST["from"];
$email = $_POST["email"];



$host="127.0.0.1";
$user="root";
$password="";
$dbname = "smartcarpool";

date_default_timezone_set('America/Los_Angeles');
$curr_date =  date('Y-m-d'); 
$curr_time =  date("h:i:s:A");
echo "!";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM user_driver where avail != '5'";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
    // output data of each row
    $i=0;
    while($row = $result->fetch_assoc()) {
        $i = $i +1;
        $address1 = urlencode($row['fromplace']);
        $address2 = urlencode($row['toplace']);

    //from
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address1}";
    $resp_json = file_get_contents($url);
    $resp = json_decode($resp_json, true);
    if($resp['status']=='OK'){
 
        $lati1 = $resp['results'][0]['geometry']['location']['lat'];
        $longi1 = $resp['results'][0]['geometry']['location']['lng'];
        $formatted_address = $resp['results'][0]['formatted_address'];        
        }  


    //toplace
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address2}";
    $resp_json = file_get_contents($url);
    $resp = json_decode($resp_json, true);
    if($resp['status']=='OK'){
 
        $lati2 = $resp['results'][0]['geometry']['location']['lat'];
        $longi2 = $resp['results'][0]['geometry']['location']['lng'];
        $formatted_address = $resp['results'][0]['formatted_address'];        
        }  




        $degrees1 = rad2deg(acos((sin(deg2rad($c))*sin(deg2rad($lati1))) + (cos(deg2rad($c))*cos(deg2rad($lati1))*cos(deg2rad($d-$longi1)))));
        $distance1 = $degrees1 * 69.05482; 
        $degrees2 = rad2deg(acos((sin(deg2rad($a))*sin(deg2rad($lati2))) + (cos(deg2rad($a))*cos(deg2rad($lati2))*cos(deg2rad($b-$longi2)))));
        $distance2 = $degrees2 * 69.05482;


        if(($distance1 <= 2)&&($distance2 <= 2))
           {
         
           
            $str = $row["dated"]." ".$row["timed"];
            $datearr = explode("-", $row["dated"]);
            $timearr = explode(":", $row["timed"]);
            $datearr2 = explode("-", $curr_date);
            $timearr2 = explode(":", $curr_time);
            $counter1 = 1;
            $counter2 = 1;
            $i = 0;
            foreach ($datearr as $key) 
                {
               if(intval($key) != intval($datearr2[$i]))
                        $counter1 = 0;
                $i++;
                }
              

            if((intval($timearr[0]) != intval($timearr2[0])) || (intval($timearr[1]) != intval($timearr2[1])))
            {
               $counter2 = 0;
            }
              echo $counter2."".$counter1;  
            if(($counter2 == 1)&&($counter1 == 1))
            {
                     echo "!".$row["name"]."!".$row["avail"]."!".$row["email"];
            }
            
            
           } 
           
        

    }
} 
else
{
    echo "We will get back to you soon!";
}




$conn->close();





?>