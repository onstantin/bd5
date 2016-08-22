<?php 	
	error_reporting(E_ALL);
	require_once "config.php";
	require_once "sql.php";	
	
	if (isset($_GET['type']) && isset($_GET['tb_name']) && isset($_GET['tb_column'])) {
		$tb_name = $_GET['tb_name'];
		$tb_column = $_GET['tb_column'];
		$type = $_GET['type'];
		
		if ($type == "int") {
			$sql = "ALTER TABLE $tb_name CHANGE $tb_column $tb_column int(11) NOT NULL;";
		} elseif ($type == "varchar") {
			$sql = "ALTER TABLE $tb_name CHANGE $tb_column $tb_column varchar(255) NOT NULL;";
		} else {
			$sql = "ALTER TABLE $tb_name CHANGE $tb_column $tb_column TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;";
		}
		$pdo->query($sql) or die("Error");
		header("Location: index.php?tb_name=".$tb_name);
		die();
	}
	
