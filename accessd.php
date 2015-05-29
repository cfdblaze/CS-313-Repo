<?php
session_start();
?>

<html>
<head>
<title> Character_Select </title>
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

$searchterms = $_POST["searchtext"];
try
{

 $db = new PDO("mysql:host=$dbHost;dbname=dnd_character_manager", $dbUser, $dbPassword);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 $query = "SELECT id, name, level, race FROM characters WHERE name LIKE '%$searchterms%';";
 foreach ($db->query($query) as $row)
 {
  echo $row['id'] . ' - ' . $row['name'] . ': Level ' . $row['level'] . ', ' . $row['race'];
  echo '<br/>';
 }
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}

echo '<br/><br/><br/>';
echo '<form action="char_sheet.php" method="POST">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ID: <input type="text" name="idsend" /><br />Password: <input type="text" name="passcode" /><br/><input type="submit" value="Select Character" /></form>';
?>
</body>
</html>