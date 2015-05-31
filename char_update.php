<?php
session_start();
?>

<html>
<head>
<title> Update Character Sheet </title>
<style>
    input[type="number"] {
        width:50px;
    }
</style>

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

try 
{
 $db = new PDO("mysql:host=$dbHost;dbname=dnd_character_manager", $dbUser, $dbPassword);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $query = "SELECT * FROM characters WHERE id = $char_id;";
 foreach($db->query($query) as $row)
 {
  echo 'Update ' . $row['name'] . ': <br/>';
  echo '<form action="update_character.php" method="post">';
  echo 'STR: <input type="number" name="strscore" size="4" value="' . $row['Strength'] . '"/>';
  echo 'DEX: <input type="number" name="dexscore" size="4" value="' . $row['Dexterity'] . '"/>';
  echo 'CON: <input type="number" name="conscore" size="4" value="' . $row['Constitution'] . '"/>';
  echo 'INT: <input type="number" name="intscore" size="4" value="' . $row['Intelligence'] . '"/>';
  echo 'WIS: <input type="number" name="wisscore" size="4" value="' . $row['Wisdom'] . '"/>';
  echo 'CHA: <input type="number" name="chascore" size="4" value="' . $row['Charisma'] . '"/><br/><br/>';

  echo 'HP: <input type="number" name="hp" size="2" value="' . $row['HP'] . '"/>';
  echo 'AC: <input type="number" name="ac" size="2" value="' . $row['AC'] . '"/>';
  echo 'Touch: <input type="number" name="touch" size="2" value="' . $row['touch_AC'] . '"/>';
  echo 'FF: <input type="number" name="ff" size="2" value="' . $row['flat_footed_AC'] . '"/><br/><br/>';

  echo 'BAB: <input type="number" name="bab" size="2" value="' . $row['BAB'] . '"/>';
  echo 'FORT: <input type="number" name="fort" size="2" value="' . $row['fort_save'] . '"/>';
  echo 'REFLEX: <input type="number" name="reflex" size="2" value="' . $row['reflex_save'] . '"/>';
  echo 'WILL: <input type="number" name="will" size="2" value="' . $row['will_save'] . '"/>';

  echo 'Skill Ranks:<br/> <input type="text" name="skills" size="2" value="' . $row['skill_ranks'] . '"/><br/>';
  echo 'Qualities:<br/> <input type="text" name="qualities" size="2" value="' . $row['qualities'] . '"/><br/>';

  echo 'Spells: <br/>';
  echo '0th: <input type="number" name="0spells" size="4" value="' . $row['0_spells'] . '"/>';
  echo '1st: <input type="number" name="1spells" size="4" value="' . $row['1_spells'] . '"/>';
  echo '2nd: <input type="number" name="2spells" size="4" value="' . $row['2_spells'] . '"/>';
  echo '3rd: <input type="number" name="3spells" size="4" value="' . $row['3_spells'] . '"/>';
  echo '4th: <input type="number" name="4spells" size="4" value="' . $row['4_spells'] . '"/>';
  echo '5th: <input type="number" name="5spells" size="4" value="' . $row['5_spells'] . '"/>';
  echo '6th: <input type="number" name="6spells" size="4" value="' . $row['6_spells'] . '"/>';
  echo '7th: <input type="number" name="7spells" size="4" value="' . $row['7_spells'] . '"/>';
  echo '8th: <input type="number" name="8spells" size="4" value="' . $row['8_spells'] . '"/>';
  echo '9th: <input type="number" name="9spells" size="4" value="' . $row['9_spells'] . '"/>';
  
  echo '<input type="submit" value="Update"/>';
  echo '</form><br/>';
 }

 echo '<form action="spelladd.php" method="post">';
 echo '<select name="spellchoice">';
 $query = "SELECT * FROM spells;";
 foreach($db->query($query) as $row)
 {
  echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
 }
 echo '</select>';
 echo '<input type="submit" value="Add this spell" />';
 echo '</form><br/>';
 
 echo '<form action="featadd.php" method="post">';
 echo '<select name="featchoice">';
 $query = "SELECT * FROM feats;";
 foreach($db->query($query) as $row)
 {
  echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
 }
 echo '</select>';
 echo '<input type="submit" value="Add this feat" />';
 echo '</form><br/>';
 
 echo 'Add gear:<br/>';
 echo '<form action="equipadd.php" method="post">';
 echo 'Name: <input type="text" name="equip_name">';
 echo ' Type: <select name="equip_type">
        <option value="Weapon">Weapon</option>
        <option value="Armor">Armor</option>
        <option value="Shield">Shield</option>
        <option value="Potion">Potion</option>
        <option value="Ring">Ring</option>
        <option value="Rod">Rod</option>
        <option value="Scroll">Scroll</option>
        <option value="Staff">Staff</option>
        <option value="Wand">Wand</option>
        <option value="Wondrous Item">Wondrous Item</option>
        <option value="Artifact">Artifact</option>
        <option value="Other">Other</option>
    </select>';
 echo ' Description: <input type="text" name="equip_desc">';
 echo ' #: <input type="number" name="equip_num">';
 echo '<input type="submit" value="Add this item" />';
 echo '</form><br/><br/>';
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}

?>

</body>
</html>