
<?php
	require 'Employee.php';
	$con = mysql_connect("localhost", "reservation", "54Xiaolan");
	if(!$con){
		die("Could not connect: " . mysql_error());
	}
	mysql_select_db("reservation", $con);
	mysql_query("set names utf8");
	$sql = "select e.employment_id, y.employee_id, y.stage_name " .
		   "from employment e " .
		   "inner join employee y on y.employee_id=e.employee_id ";
	if($_POST['shelf_id'] != -1){
		$sql .=  "inner join skill s on s.employment_id=e.employment_id ";
	}
	$sql .= "where merchant_id=" . $_POST['merchant_id'];
	if($_POST['shelf_id'] != -1){
		$sql .= " and s.shelf_id=" . $_POST['shelf_id'];
	}
	$result = mysql_query($sql);
	$employees = array();
	$i = 0;
	while($e = mysql_fetch_array($result)){
		$employee = new Employee;
		$employee->employment_id = $e['employment_id'];
		$employee->employee_id = $e['employee_id'];
		$employee->stage_name = $e['stage_name'];
		$employees[$i] = $employee;
		$i ++;
	}
	echo json_encode($employees);
	mysql_close($con);
?>
