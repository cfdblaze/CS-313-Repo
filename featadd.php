<?php
session_start();
?>

<html>
<head>
<title> Adding feat... </title>
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
$spell_choice = $_POST['featchoice'];

try
{
 $db = new PDO("mysql:host=$dbHost;dbname=dnd_character_manager", $dbUser, $dbPassword);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $query = 'INSERT INTO character_feats (character_id, feat_id) VALUES (:char_id, :feat_id);';
 $stmt = $db->prepare($query);
 $stmt->bindValue(':char_id', $char_id, PDO::PARAM_INT);
 $stmt->bindValue(':feat_id', $feat_choice, PDO::PARAM_INT);
 $stmt->execute();

 echo 'Feat added!';
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}
?>
</body>
</html>