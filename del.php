<?php 	
	error_reporting(E_ALL);
	require_once "config.php";
	require_once "sql.php";	
	
	if (isset($_GET['tb_name']) && isset($_GET['tb_column'])) {
		$tb_name = $_GET['tb_name'];
		$tb_column = $_GET['tb_column'];
		$sql = "ALTER TABLE $tb_name DROP $tb_column;";
		$pdo->query($sql);
		header("Location: index.php?tb_name=".$tb_name);
		die();
	}
	
