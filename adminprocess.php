<?php
require_once("settings.php");

$refNum = $_POST['ref'];

$conn = @mysqli_connect($host, $user, $password, $database)
or die ("<p>Failed to connect to database server</p>")."</p>";

$SQLvariables = "SELECT COUNT(*) FROM Booking WHERE bookingNumber = '".$refNum."'";
$query = @mysqli_query($conn, $SQLvariables)
or die ("<p>Failed to query the Booking table</p>")."</p>";

$row = mysqli_fetch_row($query);
if ($row[0] > 0){
	$SQLvariables = "UPDATE Booking SET bookingStatus = 'assigned' WHERE bookingNumber = ".$refNum;
	$query = @mysqli_query($conn, $SQLvariables)
	or die ("<p>Failed to update the Booking table</p>")."</p>";
	
	echo "Reference number: <b>".$refNum."</b> is booked!";
	echo "<br><br><a href = admin.html>Refresh</a>";
}
else{
	echo "This reference number does not exist. Please enter another<br>";
	echo "<a href = admin.html>Refresh</a><br>";
	exit();
}
?>