<?php
session_start();
?>

<html>
<head>
<title> Updating character... </title>
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
$char_str = $_POST["strscore"];
$char_dex = $_POST["dexscore"];
$char_con = $_POST["conscore"];
$char_int = $_POST["intscore"];
$char_wis = $_POST["wisscore"];
$char_cha = $_POST["chascore"];
$hp = $_POST["hp"];
$ac = $_POST["ac"];
$touch_ac = $_POST["touch"];
$ff_ac = $_POST["ff"];
$bab = $_POST["bab"];
$fort_save = $_POST["fort"];
$ref_save = $_POST["reflex"];
$will_save = $_POST["will"];
$skills = $_POST["skills"];
$qualities = $_POST["qualities"];
$spell0 = $_POST["0spells"];
$spell1 = $_POST["1spells"];
$spell2 = $_POST["2spells"];
$spell3 = $_POST["3spells"];
$spell4 = $_POST["4spells"];
$spell5 = $_POST["5spells"];
$spell6 = $_POST["6spells"];
$spell7 = $_POST["7spells"];
$spell8 = $_POST["8spells"];
$spell9 = $_POST["9spells"];

try
{
 $db = new PDO("mysql:host=$dbHost;dbname=dnd_character_manager", $dbUser, $dbPassword);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $query = 'UPDATE characters SET Strength=:str, Dexterity=:dex, Constitution=:con, Intelligence=:int, Wisdom=:wis, Charisma=:cha, HP=:hp, AC=:ac, touch_AC=:touch, flat_footed_AC=:ffac, BAB=:bab, fort_save=:fort, reflex_save=:ref, will_save=:will, skill_ranks=:skills, qualities=:qualities, 0_spells=:spell0, 1_spells=:spell1, 2_spells=:spell2, 3_spells=:spell3, 4_spells=:spell4, 5_spells=:spell5, 6_spells=:spell6, 7_spells=:spell7, 8_spells=:spell8, 9_spells=:spell9 WHERE id=:id;';
 $stmt = $db->prepare($query);
 $stmt->bindValue(':str', $char_str, PDO::PARAM_INT);
 $stmt->bindValue(':dex', $char_dex, PDO::PARAM_INT);
 $stmt->bindValue(':con', $char_con, PDO::PARAM_INT);
 $stmt->bindValue(':int', $char_int, PDO::PARAM_INT);
 $stmt->bindValue(':wis', $char_wis, PDO::PARAM_INT);
 $stmt->bindValue(':cha', $char_cha, PDO::PARAM_INT);
 $stmt->bindValue(':hp', $hp, PDO::PARAM_INT);
 $stmt->bindValue(':ac', $ac, PDO::PARAM_INT);
 $stmt->bindValue(':touch', $touch_ac, PDO::PARAM_INT);
 $stmt->bindValue(':ffac', $ff_ac, PDO::PARAM_INT);
 $stmt->bindValue(':bab', $bab, PDO::PARAM_INT);
 $stmt->bindValue(':fort', $fort_save, PDO::PARAM_INT);
 $stmt->bindValue(':ref', $ref_save, PDO::PARAM_INT);
 $stmt->bindValue(':will', $will_save, PDO::PARAM_INT);
 $stmt->bindValue(':skills', $skills, PDO::PARAM_STR);
 $stmt->bindValue(':qualities', $char_id, PDO::PARAM_STR);
 $stmt->bindValue(':spell0', $spell0, PDO::PARAM_INT);
 $stmt->bindValue(':spell1', $spell1, PDO::PARAM_INT);
 $stmt->bindValue(':spell2', $spell2, PDO::PARAM_INT);
 $stmt->bindValue(':spell3', $spell3, PDO::PARAM_INT);
 $stmt->bindValue(':spell4', $spell4, PDO::PARAM_INT);
 $stmt->bindValue(':spell5', $spell5, PDO::PARAM_INT);
 $stmt->bindValue(':spell6', $spell6, PDO::PARAM_INT);
 $stmt->bindValue(':spell7', $spell7, PDO::PARAM_INT);
 $stmt->bindValue(':spell8', $spell8, PDO::PARAM_INT);
 $stmt->bindValue(':spell9', $spell9, PDO::PARAM_INT);
 $stmt->bindValue(':id', $char_id, PDO::PARAM_INT);
 $stmt->execute();
 echo 'All finished, please close and refresh.';
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}
?>

</body>
</html>