<?php
session_start();
?>

<html>
<head>
<title> Character Details </title>
</head>
<body background="http://img12.deviantart.net/6e6e/i/2006/235/e/0/parchment_by_empty_dreams.jpg">

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

try
{
 $db = new PDO("mysql:host=$dbHost;dbname=dnd_character_manager", $dbUser, $dbPassword);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 echo 'Class Levels: <br/>';
 $query = "SELECT cl.name, cc.class_level FROM character_classes cc JOIN classes cl ON cc.class_id = cl.id WHERE cc.character_id = $char_id;";
 foreach ($db->query($query) as $row)
 {
  echo 'Level ' . $row['class_level'] . ' ' . $row['name'] . '<br/>';
 }
 echo '<br/><br/>Spells:<br/>';
 echo '<table><tr><td>Spell Name</td><td>School</td><td>Spell Level</td><td>Casting Time</td><td>Spell Range</td><td>Area</td><td>Duration</td><td>Saving Throw</td><td>Spell Resistance</td><td>Description</td><td>Special Notes</td></tr>';
 $query = "SELECT s.name, s.school, s.spell_level, s.cast_time, s.spell_range, s.area, s.duration, s.saving_throw, s.spell_resistance, s.description, s.special FROM character_spells cs JOIN spells s ON cs.spell_id = s.id WHERE cs.character_id = '$char_id';";
 foreach ($db->query($query) as $row)
 {
  echo '<tr><td>' . $row['name'] . '</td><td>' . $row['school'] . '</td><td>' . $row['spell_level'] . '</td><td>' . $row['cast_time'] . '</td><td>' . $row['spell_range'] . '</td><td>' . $row['area'] . '</td><td>' . $row['duration'] . '</td><td>' . $row['saving_throw'] . '</td><td>';
  if ($row['spell_resistance'])
   echo 'Yes';
  else
   echo 'No';
  echo '</td><td>' . $row['description'] . '</td><td>' . $row['special'] . '</td></tr>';
 }
 echo '</table><br/><br/>Feats:<br/>';
 echo '<table><tr><td>Name</td><td>Benefit</td><td>Special Notes</td></tr>';
 $query = "SELECT f.name, f.benefit, f.special FROM character_feats cf JOIN feats f ON cf.feat_id = f.id WHERE cf.character_id = $char_id;";
 foreach ($db->query($query) as $row)
 {
  echo '<tr><td>' . $row['name'] . '</td><td>' . $row['benefit'] . '</td><td>' . $row['special'] . '</td></tr>';
 }
 echo '</table>';
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}

?>
</body>
</html>