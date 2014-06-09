<?php
$dbhost = "localhost";
$dbname = "summary";
$dbuser = "root";
$dbpassword = "";
$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword, $attr);

if (!empty($_POST)) {
	// nytt ämne, skriv till pdo
	$_POST = null;
	$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
	$statement = $pdo->prepare('INSERT INTO subjects (name) VALUES (:name)');
	$statement->bindParam(':name', $name, PDO::PARAM_STR);
	$statement->execute();

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Ämnen</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
	<div id="header">
		<h1>Sammanfattningar.nu</h1>
	</div>
	<h2>Lägg till ämne</h2>
	<a href="#" class="new">Lägg till ämne</a>
	<form id="form" action="subjects.php" method="post">
		Nytt ämne: <input type="text" name="name"><br>
		<input type="submit" />
	</form>
	<br />
	<?php
	// lista alla ämnen
	$statement = $pdo->prepare('SELECT * FROM subjects');
	$statement->execute();
	foreach($statement->fetchAll() as $row) { 
	 	echo "<a href=summaries.php?id={$row['id']}>{$row['name']}</a><br />";
	}
	?>
<script>
$(function(){
    $('a.new').click(function(){
        $('#form ').toggle();
    });

});
</script>
</body>
</html>