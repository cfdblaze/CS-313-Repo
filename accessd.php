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

echo 'woooork';

try
{

 $db = new PDO("mysql:host=$dbHost;dbname=dnd_character_manager", $dbUser, $dbPassword);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 $query = "SELECT * FROM characters WHERE name LIKE '%$searchterms%'";
 foreach ($db->query($query) as $row)
 {
  echo $row['name'];
 }
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}

?>
</body>
</html>