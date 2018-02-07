
<?php
	require 'Service.php';
	$con = mysql_connect("localhost", "reservation", "54Xiaolan");
	if(!$con){
		die("Could not connect: " . mysql_error());
	}
	mysql_select_db("reservation", $con);
	mysql_query("set names utf8");
	$sql = "select s.shelf_id, c.service_id, service_name, service_minutes " .
		   "from shelf s " .
		   "inner join service c on c.service_id=s.service_id ";
	if($_POST['employment_id'] != -1){
		$sql .=  "inner join skill s on s.shelf_id=s.shelf_id ";
	}
	$sql .= "where merchant_id=" . $_POST['merchant_id'];
	if($_POST['employment_id'] != -1){
		$sql .= " and s.employment_id=" . $_POST['employment_id'];
	}
	
	$result = mysql_query($sql);
	$services = array();
	$i = 0;
	while($s = mysql_fetch_array($result)){
		$service = new Service;
		$service->shelf_id = $s['shelf_id'];
		$service->service_id = $s['service_id'];
		$service->service_name = $s['service_name'];
		$service->service_minutes = $s['service_minutes'];
		$services[$i] = $service;
		$i ++;
	}
	echo json_encode($services);
	mysql_close($con);
?>
