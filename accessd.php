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
 
 $query = "SELECT * FROM characters WHERE name LIKE '%$searchterms%' LIMIT 1";
 foreach ($db->query($query) as $row)
 {
  echo $row['name'] . ' Level: ' . $row['level'] . ' HP: ' . $row['HP'] . ' AC: ' . $row['AC'] . '<br/>';
  echo 'STR ' . $row['Strength'] . ' DEX ' . $row['Dexterity'] . ' CON ' . $row['Constitution'] . ' INT ' . $row['Intelligence'] . ' WIS ' . $row['WISDOM'] . ' CHA ' . $row['Charisma'] . '<br/>';
  echo 'BAB ' . $row['BAB'] . ' FORT: ' . $row['fort_save'] . ' REF: ' . $row['reflex_save'] . ' WILL: ' . $row['will_save'] . '<br/>';
  echo 'Skills: ' . $row['skill_ranks'];
 }
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}

?>
</body>
</html>