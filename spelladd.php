<?php
session_start();
?>

<html>
<head>
<title> Adding spells... </title>
</head>
<body>

<?php

$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');

if ($dbHost === null || $dbHost == "") {
 $dbUser = 'dnduser';
 $dbPassword = 'rollinitiative';
 $dbHost = '127.0.0.1';
 $dbName = 'dnd_character_manager';
} else {
 $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
 $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
 $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
}

$char_id = $_SESSION['character_id'];
$spell_choice = $_POST['spellchoice'];

try
{
 $db = new PDO("mysql:host=$dbHost;dbname=dnd_character_manager", $dbUser, $dbPassword);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $query = 'INSERT INTO character_spells (character_id, spell_id) VALUES (:char_id, :spell_id);';
 $stmt = $db->prepare($query);
 $stmt->bindValue(':char_id', $char_id, PDO::PARAM_INT);
 $stmt->bindValue(':spell_id', $spell_choice, PDO::PARAM_INT);
 $stmt->execute();

 echo 'Spell added!';
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}
?>
</body>
</html>