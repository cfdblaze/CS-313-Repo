<?php
session_start();
?>

<html>
<head>
<title> Results </title>
</head>
<body>

<?php

$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');

if ($dbHost === null || $dbHost == "") {
 $dbUser = 'dnduser';
 $dbPass = 'rollinitiative';
 $dbHost = 'localhost';
 $dbName = 'dnd_character_manager';
} else {
 $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
 $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
 $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
}

$searchterms = $_POST["searchtext"];

try
{

 $db = new PDO("mysql:host=$dbHost;dbname=dnd_character_manager", $dbUser, $dbPassword);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 $query = "SELECT ch.id, ch.name, cl.name, cc.class_level, ch.HP, ch.AC, ch.Strength, ch.Dexterity, ch.Constitution, ch.Intelligence, ch.Wisdom, ch.Charisma, ch.BAB, ch.fort_save, ch.reflex_save, ch.will_save, ch.skill_ranks FROM characters ch JOIN character_classes cc ON ch.id = cc.character_id JOIN classes cl ON cc.class_id = cl.id WHERE ch.name LIKE '%$searchterms%' LIMIT 1";
 foreach ($db->query($query) as $row)
 {
  $charid = $row['ch.id'];
  echo $row['ch.name'];
 }
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}

?>
</body>
</html>