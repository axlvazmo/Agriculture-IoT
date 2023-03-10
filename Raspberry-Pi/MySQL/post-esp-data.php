<?php

$servername = "localhost";
$dbname = "esp_data";
$username = "root";
$password = "YOUR PASSWORD";

$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $solar = $temp = $humid = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $solar = test_input($_POST["solar"]);
        $temp = test_input($_POST["temp"]);
	$humid = test_input($_POST["humid"]);
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO IoTdata (solar, temp, humid)
        VALUES ('" . $solar . "', '" . $temp . "', '" . $humid . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
