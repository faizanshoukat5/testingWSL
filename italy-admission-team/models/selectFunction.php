<?php 

function select($db_table_name,$con){
	$select_query = "SELECT * from ".$db_table_name." WHERE status = '1' AND close='1'";
	$select_query_ex = mysqli_query($con,$select_query)or die( mysqli_error($con));
	return $select_query_ex;
}

?>