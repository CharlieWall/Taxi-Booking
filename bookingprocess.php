<?php
$custName = $_POST['customerName'];
$custPhone = $_POST['customerNumber'];
$unitNum = $_POST['unitNumber'];
$streetNum = $_POST['streetNumber'];
$streetNme = $_POST['streetName'];
$suburb = $_POST['suburb'];
$dest = $_POST['destination'];
$puDate = $_POST['pickupDate'];
$puTime = $_POST['pickupTime'];

if (empty($custName) || empty($custPhone) || empty($streetNum) ||
empty($streetNme) || empty($suburb) || empty($dest) || empty($puDate) || empty($puTime)){
	echo "Please complete all required fields (*) in the form";
}
else{
	if (valid($puDate, $puTime)){
		makeBooking($custName, $custPhone, $unitNum, $streetNum, $streetNme, $suburb, $dest, $puDate, $puTime);
	}
	else{
		//echo"A booking can only be placed an hour after the current time";
		exit();
	}
}
	
	function makeBooking($custName, $custPhone, $unitNum, $streetNum, $streetNme, $suburb, $dest, $puDate, $puTime){
	$table = Booking;
	require_once ("settings.php");
	
	$conn = @mysqli_connect($host, $user, $password, $database);
	
	$bookingDate = $puDate;
	
	//$puDate = date_create_from_format('Y-m-d',$puDate);
	//$puDate = date_format($puDate, 'Y-m-d');
	$status = "unassigned";
	$currentDate = date('Y-m-j H:i:s');
	
	$SQLinsert = "INSERT INTO $table"
				."(passengerName,passengerPhone,unitNumber,streetNumber,streetName,suburb,destinationSuburb,pickupDate,pickupTime,bookingDatetime,bookingStatus)"
				."VALUES"
				."('$custName', '$custPhone', '$unitNum', '$streetNum', '$streetNme', '$suburb', '$dest', '$puDate', '$puTime', '$currentDate', '$status')";
	
	$query = @mysqli_query($conn, $SQLinsert)
	or die ("<p>Failed to insert essential data into $table table</p>")."</p>";
	
	$SQLinsert = "SELECT MAX(bookingNumber) FROM Booking";
	$query = mysqli_query($conn, $SQLinsert)
	or die ("<p>Failed to insert max data into Booking table</p>")."</p>";
	
	$row = mysqli_fetch_row($query);
	$puDate = date_create_from_format('Y-m-d', $puDate);
	$puDate = date_format($puDate, 'Y-m-d');
	
	$address = $unitNum."/".$streetNum." ".$streetNme.", ".$suburb;
	
	echo "<p>Order placed!</p>";
	echo "<p>Your booking reference is: ".$row[0]."<br>";
	echo "<p>You'll be picked up from ".$address." at ".$puTime." on ".$bookingDate."</p>";
	echo "<p>Thank you for booking!</p>";
	echo "<p><a href = admin.html>Admin</p><br>";
	exit();
	}
	
	function valid($date, $time){
		$dateToday = date("Y-m-d H:i:s");
		$userDate = date('Y-m-d H:i:s', strtotime ("$date $time"));
	
		if($userDate < $dateToday){
		echo "You cannot book a taxi on the ".$userDate." as the date is invalid<br>";
		echo "Please try a different time";
		return false;
		}
		else{
		return true;
		}
	}
?>