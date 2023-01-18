<!DOCTYPE html>
<html><body>
<?php

require_once 'protect-this.php';

/* Database Information */
$servername = "localhost";	// database server name
$dbname = "esp_data";		// name of database
$username = "root";		// username
$password = "YOUR PASSWORD";	// password

/* Creating Connection */
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {				// checking if there is an error in creating connection to database
    die("Connection failed: " . $conn->connect_error);	// echo if error
} 

$sql = "SELECT id, solar, temp, humid, reading_time FROM IoTdata ORDER BY id DESC";	// mySQL query to post database contents

/* Writing Column Titles */
echo '<table cellspacing="5" cellpadding="5">
      <tr> 
        <td>ID</td> 
        <td>Solar Panel Reading</td> 
	<td>Temperature Reading (C)</td> 
	<td>Humidity Reading (%)</td>
        <td>Timestamp</td> 
      </tr>';

/* Writing Column Values */
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["id"];				// looking up values from database
        $row_solar = $row["solar"];
        $row_temp = $row["temp"];
	$row_humid = $row["humid"];
        $row_reading_time = $row["reading_time"];
      
	/* Posting values from database */
        echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_solar . '</td> 
                <td>' . $row_temp . '</td> 
		<td>' . $row_humid . '</td> 
                <td>' . $row_reading_time . '</td> 
              </tr>';
    }
    $result->free();
}

$conn->close();
?> 
</table>
</body>
</html>
