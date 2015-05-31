<?php
session_start();
?>

<html>
<head>
<title> Adding gear... </title>
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
$equip_name = $_POST['equip_name'];
$equip_type = $_POST['equip_type'];
$description = $_POST['equip_desc'];
$quantity = $_POST['equip_num'];

try
{
 $db = new PDO("mysql:host=$dbHost;dbname=dnd_character_manager", $dbUser, $dbPassword);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $query = 'INSERT INTO equipment_owned (character_id, name, type, description, quantity) VALUES (:char_id, :name, :type, :description, :quantity);';
 $stmt = $db->prepare($query);
 $stmt->bindValue(':char_id', $char_id, PDO::PARAM_INT);
 $stmt->bindValue(':name', $equip_name, PDO::PARAM_STR);
 $stmt->bindValue(':type', $equip_type, PDO::PARAM_STR);
 $stmt->bindValue(':description', $description, PDO::PARAM_STR);
 $stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);
 $stmt->execute();

 echo 'Gear added!';
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}
?>
</body>
</html>