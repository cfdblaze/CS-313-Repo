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
$_SESSION['character_id'] = $char_id;
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
  $query = "SELECT id, name, level, HP, AC, flat_footed_AC, touch_AC, race, size, speed, Strength, Dexterity, Constitution, Intelligence, Wisdom, Charisma, BAB, fort_save, reflex_save, will_save FROM characters WHERE id = '$char_id';";
  foreach ($db->query($query) as $row)
  {
   echo '<table><tr><td width="200">' . $row['name'] . '</td>';
   echo '<td width="200"> Level ' . $row['level'] . ' ' . $row['race'] . '</td>';
   echo '<td width="70"> Ability </td>';
   echo '<td width="70"> Scores </td></tr>';

   echo '<tr><td width="200"> <a href="char_details.php" target="_blank">(Character Details)</a></td><td><a href="char_update.php" target="_blank">Update Character</a></td>';
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

   echo '<table><tr><td width="200"> HP: <input type="text" size="5"> / ' . $row['HP'] . '</td>';
   echo '<td> AC: ' . $row['AC'] . ' Flat-footed: ' . $row['flat_footed_AC'] . ' Touch: ' . $row['touch_AC'] . '</td></tr>';
  }
  $query = "SELECT * FROM equipment_owned WHERE character_id = $char_id AND type = 'Weapon';";
  foreach ($db->query($query) as $row)
  {
   echo '<tr><td width="150">' . $row['name'] . '</td><td>' . $row['description'] . '</td></tr>';
  }
  echo '</table>';
  $query = "SELECT skill_ranks, qualities, 0_spells, 1_spells, 2_spells, 3_spells, 4_spells, 5_spells, 6_spells, 7_spells, 8_spells, 9_spells FROM characters WHERE id = $char_id;";
  foreach ($db->query($query) as $row)
  {
   echo '<br/>Skills: <br/> ' . $row['skill_ranks'] . '<br/>';
   echo '<br/>Qualities: <br/> '. $row['qualities'] . '<br/>';
   echo '<br/>Spells Per Day: <br/>';
   echo '0th: ' . $row['0_spells'] . '&nbsp;&nbsp;&nbsp;';
   echo '1st: ' . $row['1_spells'] . '&nbsp;&nbsp;&nbsp;';
   echo '2nd: ' . $row['2_spells'] . '&nbsp;&nbsp;&nbsp;';
   echo '3rd: ' . $row['3_spells'] . '&nbsp;&nbsp;&nbsp;';
   echo '4th: ' . $row['4_spells'] . '&nbsp;&nbsp;&nbsp;';
   echo '5th: ' . $row['5_spells'] . '&nbsp;&nbsp;&nbsp;';
   echo '6th: ' . $row['6_spells'] . '&nbsp;&nbsp;&nbsp;';
   echo '7th: ' . $row['7_spells'] . '&nbsp;&nbsp;&nbsp;';
   echo '8th: ' . $row['8_spells'] . '&nbsp;&nbsp;&nbsp;';
   echo '9th: ' . $row['9_spells'] . '&nbsp;&nbsp;&nbsp;';
   echo '<br/> <br/> Spells Known: <br/>';
  }
  $query = "SELECT sp.name FROM spells sp JOIN character_spells cs ON cs.spell_id = sp.id WHERE cs.character_id = $char_id;";
  foreach ($db->query($query) as $row)
  {
   echo $row['name'] . ' ';
  }
  echo '<br/> <br/> Feats: <br/> ';
  $query = "SELECT f.name FROM feats f JOIN character_feats cf ON cf.feat_id = f.id WHERE cf.character_id = $char_id;";
  foreach ($db->query($query) as $row)
  {
   echo $row['name'] . ' ';
  }
  echo '<br/> <br/> Equipment: <br/> <table>';
  $query = "SELECT name, type, description, quantity FROM equipment_owned WHERE character_id = $char_id;";
  foreach ($db->query($query) as $row)
  {
   echo '<tr><td>' . $row['name'] . '</td><td>' . $row['type'] . '</td><td>' . $row['quantity'] . '</td><td>' . $row['description'] . '</td></tr>';
  }
  echo '</table>';
 }
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}

?>

</body>
</html>