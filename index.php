<?php 	
	error_reporting(E_ALL);
	require_once "config.php";
	require_once "sql.php";	
	
	$sql = "SHOW TABLES";	
	$index = "Tables_in_".DB_NAME;	
	$options = "";
	$tb_list = array();
	
	function editForm($tb_name, $tb_column) {
		return <<<HTML
<form action="edit.php" method="get">
	<select name="type">
		<option value="int">int</option>
		<option value="varchar">varchar</option>
		<option value="text">text</option>
	</select>
	<input type="hidden" name="tb_name" value="$tb_name">
	<input type="hidden" name="tb_column" value="$tb_column">
	<button>OK</button>
</form>	
HTML;
		
	}
	
	function delLink($tb_name, $tb_column) {
		return <<<HTML
			<a href="del.php?tb_name=$tb_name&tb_column=$tb_column">Удалить</a>
HTML;
		
	}
	
	
	foreach ($pdo->query($sql) as $row) {
		$tb_list[] = $row[$index];
	}
	
	foreach ($tb_list as $key=>$tb_name) {
		$options .= "<option value=\"".$tb_name."\">".$tb_name."</option>";
	}	
	
	if (isset($_GET['tb_name']) && in_array($_GET['tb_name'], $tb_list)) {
		$tb_name = $_GET['tb_name'];
		$sql = "DESCRIBE $tb_name";
		$rows = "";
		foreach ($pdo->query($sql) as $row) {
			$rows .= "<tr><td>".$row['Field']."</td><td>".$row['Type']."</td><td>".editForm($_GET['tb_name'], $row['Field'])."</td><td>".delLink($_GET['tb_name'], $row['Field'])."</td></tr>";
		}
		$table = "<h2>Табличка {$_GET['tb_name']}</h2><table><th>Поле</th><th>Тип</th><th>Изменить тип</th><th>Удалить</th>$rows</table>";
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
		<select name="tb_name">
			<?= $options ?>
		</select>	
		<button>OK</button>
	</form>	
<?= $table ?>	
</body> 	
</html>