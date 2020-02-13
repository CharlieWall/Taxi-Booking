<?php
$dateToday = date('Y-m-d');
$start = date('H:i:s');
$end = date('H:i:s', strtotime('+ 120 minute'));

$bookingTime = " AND pickupDate = '$dateToday' AND pickupTime < '$end' AND pickupTime > '$start'";
$table = "Booking";
$conn = @mysqli_connect($host, $user, $password, $database);

require_once("settings.php");
//@ suppresses any error messages that may be thrown.
//mysqli_connect will return false if connection fails.

$SQLvariables = "SELECT bookingNumber, passengerName, passengerPhone,
unitNumber, streetNumber, streetName, suburb, destinationSuburb, pickupDate, pickupTime
FROM Booking WHERE bookingStatus = 'unassigned'".$bookingTime;

$query = @mysqli_query($conn, $SQLvariables)
or die ("<p>Cannot query $table table</p>")."</p>";

$row = mysqli_fetch_row($query);

if (count($row) > 0){
	echo "<table width = '100%' border = '1'>";
	echo "<th> Reference Number</th><th>Passenger Name</th><th>Phone Number</th>
	<th>Address</th><th>Destination</th><th>Pickup time</th>";
	
	while($row){
		echo "<tr><td>{$row[0]}</td>";
		echo "<td>{$row[1]}</td>";
		echo "<td>{$row[2]}</td>";
		if(empty($row[3])){
			$address = $row[4]." ".$row[5].", ".$row[6];
		}
		else{
			$address = $row[3]."/".$row[4]." ".$row[5].", ".$row[6];
		}
		echo "<td>$address</td>";
		echo "<td>{$row[7]}</td>";
		$dateTime = $row[8].":".$row[9];
		$dateTime = date_create_from_format('Y-m-d:H:i:s', $dateTime);
		$dateTime = date_format($dateTime, 'H:i M d');
		echo "<td>$dateTime</td></tr>";
		$row = mysqli_fetch_row($query);
	}
	echo "<table>";
	echo "<a href = admin.html>Hide</a><br>";
}
else{
	echo "<h2>There are no bookings in the next two hours</h2>
	<br><a href = admin.html>Refresh</a>";
}
mysqli_close($conn);
?>

