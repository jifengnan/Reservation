<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html;charset=uft-8"></meta>
  <meta name="description" content="预约管理系统"></meta>
  <meta name="author" content="纪凤楠"></meta>
  <title>预约管理系统</title>
  <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
  <script type="text/javascript">
	var service_minutes = new Array();
    function merchantChanged(_this){
		$("#service").html('<option value="-1">----查询中----</option>');
		$("#service").val(-1);
		$("#employee").html('<option value="-1">----查询中----</option>');
		$("#employee").val(-1);
		$("#service_minutes").text("");

		var selected_merchant_id = $(_this).val();
		if(selected_merchant_id == -1){
			$("#service").html('<option value="-1">----请选择----</option>');
			$("#service").val(-1);
			$("#employee").html('<option value="-1">----请选择----</option>');
			$("#employee").val(-1);
			return;
		}

		$.post("queryServiceByMerchant.php", {
			merchant_id : selected_merchant_id,
			employment_id : -1
		}, function(services){
			$("#service").html('<option value="-1">----请选择----</option>');
			var serviceElement = document.getElementById("service");
			if(!services){
				alert("没有发现该商家的服务项目");
				return;
			}

			for(var i=0; i < services.length; i++){
				serviceElement[serviceElement.length] = new Option(services[i].service_name, services[i].shelf_id);
				service_minutes[services[i].shelf_id] = services[i].service_minutes;
			}
		}, "json");

		$.post("queryEmployeeByMerchant.php", {
			merchant_id : selected_merchant_id,
			shelf_id : -1
		}, function(employees){
			$("#employee").html('<option value="-1">----请选择----</option>');
			var employeeElement = document.getElementById("employee");

			if(!employees){
				alert("没有发现该商家的员工");
				return;
			}

			for(var i=0; i < employees.length; i++){
				employeeElement[employeeElement.length] = new Option(employees[i].stage_name, employees[i].employment_id);
			}
		}, "json");
	}

    function serviceChanged(_this){
		selected_shelf_id = $(_this).val();
		if(selected_shelf_id == -1){
			$("#service_minutes").text("");
			return;
		}
		$("#service_minutes").text(service_minutes[selected_shelf_id]);

		$.post("queryEmployeeByMerchant.php", {
			merchant_id : $("#merchant").val(),
			shelf_id : selected_shelf_id
		}, function(employees){
			$("#employee").html('<option value="-1">----请选择----</option>');
			var employeeElement = document.getElementById("employee");

			if(!employees){
				alert("没有发现该商家的员工");
				return;
			}

			for(var i=0; i < employees.length; i++){
				employeeElement[employeeElement.length] = new Option(employees[i].stage_name, employees[i].employment_id);
			}
		}, "json");
	}

    function employeeChanged(_this){
		selected_employment_id = $(_this).val();
		if(selected_employment_id == -1){
			return;
		}

		$.post("queryServiceByMerchant.php", {
			merchant_id : $("#merchant").val(),
			employment_id : selected_employment_id
		}, function(services){
			$("#service").html('<option value="-1">----请选择----</option>');
			var serviceElement = document.getElementById("service");
			if(!services){
				alert("没有发现该商家的服务项目");
				return;
			}

			for(var i=0; i < services.length; i++){
				serviceElement[serviceElement.length] = new Option(services[i].service_name, services[i].shelf_id);
				service_minutes[services[i].shelf_id] = services[i].service_minutes;
			}
		}, "json");
	}
  </script>
 </head>
 <body>
<?php
$conn = mysql_connect("localhost:3306", "reservation", "54Xiaolan");
mysql_select_db("reservation", $conn);
mysql_query("set names utf8");
?>
<form action="saveReservation.php" method="post">
商家： 
<select name="merchant" id="merchant" onchange="merchantChanged(this)">
<option value="-1">----请选择----</option>
<?php
$merchants = mysql_query("select merchant_id, merchant_name from merchant");
while($merchant = mysql_fetch_array($merchants)){
	echo "<option value='$merchant[merchant_id]'>" . $merchant['merchant_name']. "</option>";
}
?>
</select>
<br/>
服务项目： 
<select name="service" id="service" onchange="serviceChanged(this)">
<option value="-1">----请选择----</option>
</select>
服务时长：<label id="service_minutes"></label>
<br/>
服务人员：
<select name="employee" id="employee">
<option id="-1">----随机----</option>
</select>
<br/>
日期：
<br/>
开始时间：结束时间
<?php
mysql_close($conn);
?>
<input type="submit"/>
</form>
 </body>
</html> 