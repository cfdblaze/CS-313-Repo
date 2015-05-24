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
$searchtable = $_POST["searchwhat"];

try
{

 $db = new PDO("mysql:host=$dbHost;dbname=dnd_character_manager", $dbUser, $dbPassword);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 $query = "SELECT * FROM $searchtable WHERE name LIKE '%$searchterms%'";
 if ($searchtable == 'characters') {
  foreach ($db->query($query) as $row)
  {
   echo $row['name'] . ' Level: ' . $row['level'] . '  ' . ' HP: ' . $row['HP'] . '<br />';
  }
 } else {
  foreach ($db->query($query) as $row)
  {
   echo $row['name'] . '  ' . $row['school'] . ' Level: ' . $row['spell_level'] . ' Saving Throw: ' . $row['saving_throw'] . '<br />';
  }
 }
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}

?>
</body>
</html>