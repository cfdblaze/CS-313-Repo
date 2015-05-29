<?php
session_start();
?>

<html>
<head>
<title> Character Sheet </title>
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

$char_id = $_POST["idsend"];
$code_of_passing = $_POST["passcode"];
try
{
 $db = new PDO("mysql:host=$dbHost;dbname=dnd_character_manager", $dbUser, $dbPassword);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 $query = "SELECT password FROM characters WHERE id = '$char_id';";
 foreach ($db->query($query) as $row)
 {
  $pw = $row['password'];
 }
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}

try
{
 if ($pw != $code_of_passing) {
  echo 'Invalid Password!';
 } else {
  $query = "SELECT id, name, level, race, size, speed, Strength, Dexterity, Constitution, Intelligence, Wisdom, Charisma, BAB, fort_save, reflex_save, will_save FROM characters WHERE id = '$char_id';";
  foreach ($db->query($query) as $row)
  {
   echo '<table><tr><td width="200">' . $row['name'] . '</td>';
   echo '<td width="200"> Level ' . $row['level'] . ' ' . $row['race'] . '</td>';
   echo '<td width="70"> Ability </td>';
   echo '<td width="70"> Scores </td></tr>';

   echo '<tr><td width="200"> (Levels)</td><td></td>';
   echo '<td width="70"> STR: ' . $row['Strength'] . '</td>';
   echo '<td width="70"> INT: ' . $row['Intelligence'] . '</td></tr>';

   echo '<tr><td width="200">' . 'Size: ' . $row['size'] . '&nbsp;&nbsp;&nbsp;Speed: ' . $row['speed'] . '</td>';
   echo '<td width="200"></td>';
   echo '<td width="70"> DEX: ' . $row['Dexterity'] . '</td>';
   echo '<td width="70"> WIS: ' . $row['Wisdom'] . '</td></tr>';

   echo '<tr><td width="200">' . 'BAB: ' . $row['BAB'] . '&nbsp;&nbsp;&nbsp;Fortitude save: ' . $row['fort_save'] . '</td>';
   echo '<td width="200"> Reflex save: ' . $row['reflex_save'] . '&nbsp;&nbsp;&nbsp;Will save: ' . $row['will_save'] . '</td>';
   echo '<td width="70"> CON: ' . $row['Constitution'] . '</td>';
   echo '<td width="70"> CHA: ' . $row['Charisma'] . '</td></tr></table>';
  }
 }
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}

?>

</body>
</html>