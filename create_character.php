<?php
session_start();
?>

<html>
<head>
<title> Creating character... </title>
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

$char_name = $_POST["charname"];
$char_str = $_POST["strscore"];
$char_dex = $_POST["dexscore"];
$char_con = $_POST["conscore"];
$char_int = $_POST["intscore"];
$char_wis = $_POST["wisscore"];
$char_cha = $_POST["chascore"];

$class_1 = $_POST["class1"];
$class_2 = $_POST["class2"];
$class_3 = $_POST["class3"];
$class_4 = $_POST["class4"];
$class_5 = $_POST["class5"];
$level_1 = $_POST["level1"];
$level_2 = $_POST["level2"];
$level_3 = $_POST["level3"];
$level_4 = $_POST["level4"];
$level_5 = $_POST["level5"];
$total_level = $level_1 + $level_2 + $level_3 + $level_4 + $level_5;

$race = $_POST["race"];
$size = $_POST["charsize"];
$speed = $_POST["charspeed"];

$BAB = $_POST["charBAB"];
$HP = $_POST["charHP"];
$AC = $_POST["charAC"];
$touch = $_POST["chartouch"];
$FF = $_POST["charFF"];

$fort = $_POST["charfort"];
$ref = $_POST["charref"];
$will = $_POST["charwill"];

$skills = $_POST["charskills"];
$qualities = $_POST["charqualities"];

$spell0 = $_POST["0spellnum"];
$spell1 = $_POST["1spellnum"];
$spell2 = $_POST["2spellnum"];
$spell3 = $_POST["3spellnum"];
$spell4 = $_POST["4spellnum"];
$spell5 = $_POST["5spellnum"];
$spell6 = $_POST["6spellnum"];
$spell7 = $_POST["7spellnum"];
$spell8 = $_POST["8spellnum"];
$spell9 = $_POST["9spellnum"];
$Xspell = $_POST["Xspellnum"];

$passcode = $_POST["charpass"];

try
{
 $db = new PDO("mysql:host=$dbHost;dbname=dnd_character_manager", $dbUser, $dbPassword);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $query = 'INSERT INTO characters (name, level, race, size, speed, Strength, Dexterity, Constitution, Intelligence, Wisdom, Charisma, HP, AC, touch_AC, flat_footed_AC, BAB, fort_save, reflex_save, will_save, skill_ranks, qualities, 0_spells, 1_spells, 2_spells, 3_spells, 4_spells, 5_spells, 6_spells, 7_spells, 8_spells, 9_spells, extra_spells, password)
 VALUES (:name, :level, :race, :size, :speed, :str, :dex, :con, :int, :wis, :cha, :hp, :ac, :touch, :flat, :bab, :fort, :ref, :will, :skills, :qualities, :0sp, :1sp, :2sp, :3sp, :4sp, :5sp, :6sp, :7sp, :8sp, :9sp, :xsp, :pass);';
 $stmt = $db->prepare($query);
 $stmt->bindValue(':name', $char_name, PDO::PARAM_STR);
 $stmt->bindValue(':level', $total_level, PDO::PARAM_INT);
 $stmt->bindValue(':race', $race, PDO::PARAM_STR);
 $stmt->bindValue(':size', $size, PDO::PARAM_STR);
 $stmt->bindValue(':speed', $speed, PDO::PARAM_INT);
 $stmt->bindValue(':str', $char_str, PDO::PARAM_INT);
 $stmt->bindValue(':dex', $char_dex, PDO::PARAM_INT);
 $stmt->bindValue(':con', $char_con, PDO::PARAM_INT);
 $stmt->bindValue(':int', $char_int, PDO::PARAM_INT);
 $stmt->bindValue(':wis', $char_wis, PDO::PARAM_INT);
 $stmt->bindValue(':cha', $char_cha, PDO::PARAM_INT);
 $stmt->bindValue(':hp', $HP, PDO::PARAM_INT);
 $stmt->bindValue(':ac', $AC, PDO::PARAM_INT);
 $stmt->bindValue(':touch', $touch, PDO::PARAM_INT);
 $stmt->bindValue(':flat', $FF, PDO::PARAM_INT);
 $stmt->bindValue(':bab', $BAB, PDO::PARAM_INT);
 $stmt->bindValue(':fort', $fort, PDO::PARAM_INT);
 $stmt->bindValue(':ref', $ref, PDO::PARAM_INT);
 $stmt->bindValue(':will', $will, PDO::PARAM_INT);
 $stmt->bindValue(':skills', $skills, PDO::PARAM_STR);
 $stmt->bindValue(':qualities', $qualities, PDO::PARAM_STR);
 $stmt->bindValue(':0sp', $spell0, PDO::PARAM_INT);
 $stmt->bindValue(':1sp', $spell1, PDO::PARAM_INT);
 $stmt->bindValue(':2sp', $spell2, PDO::PARAM_INT);
 $stmt->bindValue(':3sp', $spell3, PDO::PARAM_INT);
 $stmt->bindValue(':4sp', $spell4, PDO::PARAM_INT);
 $stmt->bindValue(':5sp', $spell5, PDO::PARAM_INT);
 $stmt->bindValue(':6sp', $spell6, PDO::PARAM_INT);
 $stmt->bindValue(':7sp', $spell7, PDO::PARAM_INT);
 $stmt->bindValue(':8sp', $spell8, PDO::PARAM_INT);
 $stmt->bindValue(':9sp', $spell9, PDO::PARAM_INT);
 $stmt->bindValue(':xsp', $Xspell, PDO::PARAM_INT);
 $stmt->bindValue(':pass', $passcode, PDO::PARAM_STR);
 $stmt->execute();

 $new_id = 0;
 $query = 'SELECT id FROM characters ORDER BY id DESC LIMIT 1;';
 foreach ($db->query($query) as $row)
 {
  $new_id = $row['id'];
 }

 if($level_1 > 0)
 {
  $query = 'INSERT INTO character_classes (character_id, class_id, class_level) VALUES (:char_id, :class_id, :class_level);';
  $stmt = $db->prepare($query);
  $stmt->bindValue(':char_id', $new_id, PDO::PARAM_INT);
  $stmt->bindValue(':class_id', $class_1, PDO::PARAM_INT);
  $stmt->bindValue(':class_level', $level_1, PDO::PARAM_INT);
  $stmt->execute();
 }
 if($level_2 > 0)
 {
  $query = 'INSERT INTO character_classes (character_id, class_id, class_level) VALUES (:char_id, :class_id, :class_level);';
  $stmt = $db->prepare($query);
  $stmt->bindValue(':char_id', $new_id, PDO::PARAM_INT);
  $stmt->bindValue(':class_id', $class_2, PDO::PARAM_INT);
  $stmt->bindValue(':class_level', $level_2, PDO::PARAM_INT);
  $stmt->execute();
 }
 if($level_3 > 0)
 {
  $query = 'INSERT INTO character_classes (character_id, class_id, class_level) VALUES (:char_id, :class_id, :class_level);';
  $stmt = $db->prepare($query);
  $stmt->bindValue(':char_id', $new_id, PDO::PARAM_INT);
  $stmt->bindValue(':class_id', $class_3, PDO::PARAM_INT);
  $stmt->bindValue(':class_level', $level_3, PDO::PARAM_INT);
  $stmt->execute();
 }
 if($level_4 > 0)
 {
  $query = 'INSERT INTO character_classes (character_id, class_id, class_level) VALUES (:char_id, :class_id, :class_level);';
  $stmt = $db->prepare($query);
  $stmt->bindValue(':char_id', $new_id, PDO::PARAM_INT);
  $stmt->bindValue(':class_id', $class_4, PDO::PARAM_INT);
  $stmt->bindValue(':class_level', $level_4, PDO::PARAM_INT);
  $stmt->execute();
 }
 if($level_5 > 0)
 {
  $query = 'INSERT INTO character_classes (character_id, class_id, class_level) VALUES (:char_id, :class_id, :class_level);';
  $stmt = $db->prepare($query);
  $stmt->bindValue(':char_id', $new_id, PDO::PARAM_INT);
  $stmt->bindValue(':class_id', $class_5, PDO::PARAM_INT);
  $stmt->bindValue(':class_level', $level_5, PDO::PARAM_INT);
  $stmt->execute();
 }

 echo '<a href="databaseaccess.php">All done, back to the start!</a>';
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}
?>

</body>
</html>