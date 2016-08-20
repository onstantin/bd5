<?php 	
	error_reporting(E_ALL);
	require_once "config.php";
	require_once "sql.php";	
	
	$sql = "SHOW TABLES";	
	$index = "Tables_in_".DB_NAME;	
	$options = "";
	$tb_list = array();
	
	foreach ($pdo->query($sql) as $row) {
		$tb_list[] = $row[$index];
	}
	
	foreach ($tb_list as $key=>$tb_name) {
		$options .= "<option value=\"".$tb_name."\">".$tb_name."</option>";
	}	
	
	if (isset($_GET['tb_info']) && in_array($_GET['tb_info'], $tb_list)) {
		$tb_name = $_GET['tb_info'];
		$sql = "DESCRIBE $tb_name";
		$rows = "";
		foreach ($pdo->query($sql) as $row) {
			$rows .= "<tr><td>".$row['Field']."</td><td>".$row['Type']."</td></tr>" ;
		}
		$table = "<h2>Табличка {$_GET['tb_info']}</h2><table><th>Поле</th><th>Тип</th>$rows</table>";
	} else {
		$table = "";
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Инфо о БД</title>
	<meta charset="utf-8">
	<link type="text/css" href="style.css" rel="stylesheet" charset="utf-8"> 
</head>
<body> 
	<h1>Получить инфо о таблице БД</h1>		
	<form action="" method="get">
		<select name="tb_info">
			<?= $options ?>
		</select>	
		<button>OK</button>
	</form>	
<?= $table ?>	
</body> 	
</html>