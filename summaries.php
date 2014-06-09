<?php
$dbhost = "localhost";
$dbname = "summary";
$dbuser = "root";
$dbpassword = "";
$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword, $attr);


$subject_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!empty($_POST)) {
	$_POST = null;
	
	$new_title = filter_input(INPUT_POST, 'new_title', FILTER_SANITIZE_STRING);
	$new_text = filter_input(INPUT_POST, 'new_text', FILTER_SANITIZE_STRING);
	$new_author = filter_input(INPUT_POST, 'new_author', FILTER_SANITIZE_STRING);
	$date = date("Y-m-d h:i:s");
	if (isset($new_title) && isset($new_text) && isset($new_author)) {
		// nån har postat nytt inlägg, skriv det i pdo
		$statement = $pdo->prepare('INSERT INTO summaries (title, author_name, content, subject_id, date) VALUES (:title, :author_name, :content, :subject_id, :date)');
		$statement->bindParam(':title', $new_title, PDO::PARAM_STR);
		$statement->bindParam(':author_name', $new_author, PDO::PARAM_STR);
		$statement->bindParam(':content', $new_text, PDO::PARAM_STR);
		$statement->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
		$statement->bindParam(':date', $date, PDO::PARAM_STR);
		$statement->execute();
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sammanfattningar</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
	<h1>Axels sammanfattningar</h1>
	<a href="#" class="new">Lägg till sammanfattning</a>
	<?php echo "<form id=\"form\" class=\"summary\" action=\"summaries.php?id={$subject_id}\" method=\"post\">"; // Formulär för ny sammanfattning med dropdown-meny ?>
		Titel: <input type="text" name="new_title"><br>
		Text: <input type="text" name="new_text"><br>
		Namn: <input type="text" name="new_author"><br>
		Ämne: <select>
			<?php
			$statement = $pdo->prepare('SELECT * FROM subjects');
			$statement->execute();
			foreach ($statement->fetchAll() as $row) {
				echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
			}
			?>
		</select>
		<input type="submit" />
	</form>
	<?php
	// Hämta namnet på ämnet
	$statement = $pdo->prepare('SELECT * FROM subjects WHERE id = :subject_id');
	$statement->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
	$statement->execute();
	$result = $statement->fetch();
	echo "<h2>Sammanfattningar i {$result['name']}</h2>";
	?>

	<?php
	// Visa alla sammanfattningar i ämnet
	$statement = $pdo->prepare('SELECT * FROM summaries WHERE subject_id = :subject_id');
	$statement->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
	$statement->execute();
	foreach ($statement->fetchAll() as $row) {
		echo "<a href=summary.php?id={$row['id']}>{$row['title']}</a>, {$row['date']} av {$row['author_name']}<br />";
	}
	?>
	<br />
	<a href="subjects.php">Tillbaka till ämnen</a>
<script>
$(function(){
    $('a.new').click(function(){
        $('#form ').toggle();
    });

});
</script>
</body>
</html>