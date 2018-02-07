<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html"></meta>
  <meta charset="UTF-8"></meta>
 </head>
 <body>
<?php
	$con = mysql_connect("localhost", "reservation", "54Xiaolan");
	if(!$con){
		die("Could not connect: " . mysql_error());
	}
	mysql_select_db("reservation", $con);
	mysql_query("insert into reservation(customer_id, merchant_id, start_time, end_time, reservation_status_id, entry_id) values(1,1,'2018-08-08 9:30:00', '2018-08-08 10:30:00', 1, 1);");
	mysql_close($con);
?>
 </body>
</html> 