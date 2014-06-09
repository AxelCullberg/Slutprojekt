<?php
$dbhost = "localhost";
$dbname = "summary";
$dbuser = "root";
$dbpassword = "";
$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpassword, $attr);


$summary_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sammanfattning</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<h1>Axels Sammanfattningar</h1>
	<?php
	// skriv ut hela sammanfattningen
	$statement = $pdo->prepare('SELECT * FROM summaries WHERE id = :summary_id');
	$statement->bindParam(':summary_id', $summary_id, PDO::PARAM_INT);
	$statement->execute();
	$result = $statement->fetch();
	?>
	<h2><?php echo "{$result['title']} - {$result['date']} av {$result['author_name']}"; ?></h2>
	<p><?php echo $result['content']; ?></p>
</body>
</html>