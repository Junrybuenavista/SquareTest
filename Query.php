<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "square_db";
$msg = "";
$msg.= "<style>
table, td, th {
  border: 1px solid black;
}

table {
  border-collapse: collapse;
  width: 100%;
}

td {
  text-align: center;
}
</style>";
echo str_replace("$","","$14.00");
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo $_GET['lastweek']."  ".$_GET['currentday'];
$msg.= "<center><h1>Square Report</h1></center>";


$array = array("Plaza Bistro","@theMarket");
foreach($array as $location){
		$sql = "SELECT DISTINCT Category FROM `square_data` where Location = '".$location."'";
		$result = $conn->query($sql);

		$msg.= "<center><h3>Location: ".$location."</h3></center>";

		if ($result->num_rows > 0) {
		  $msg.= "<table>
		  <tr>
			<th>Category</th>
			<th>Item Sold</th>
			<th>Gross Sales</th>
		  </tr>";
		  while($row = $result->fetch_assoc()) {
			
			$category = $row["Category"];
				
				$sql2 = "SELECT Qty, Gross_Sales FROM `square_data` where Location = '".$location."' AND Category = '".$category."'";
				$result2 = $conn->query($sql2);
				$Qty = 0;
				$Sales = 0;
				if ($result2->num_rows > 0) {
					while($row = $result2->fetch_assoc()){
					$Qty += $row["Qty"];
					$Sales += str_replace("$","",$row["Gross_Sales"]);
				
					}
				}
			
			
			$msg.= " 
					<tr>
					<td>".$category."</td>
					<td>".$Qty."</td>
					<td>".number_format((float)$Sales, 2, '.', '')."</td>
				  </tr>
				 ";
			
		  }
		} else {
		  $msg.= "<center><h3>No result</h3></center>";
		}
		$msg.= "</table>";
}		

echo $msg;

//$to = "michaelvinocur@htgrp.net";
//$to = "junrybuenavista@htgrp.net";
//$to = "junrybuenavista@yahoo.com";
$subject = "Amazon CSV Reports";

$message = $msg;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@example.com>' . "\r\n";


//mail($to,$subject,$message,$headers);

$conn->close();
?>