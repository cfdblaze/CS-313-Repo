<?php
session_start();
?>
<!DOCTYPE html>

<html>
<head>
<title>Login
</title>
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

$uname = $_POST["uname"];
$pword = $_POST["pword1"];
$passwordHash = password_hash($pword, PASSWORD_DEFAULT);
try
{

 $db = new PDO("mysql:host=$dbHost;dbname=dnd_character_manager", $dbUser, $dbPassword);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 $query = "INSERT INTO users (username, password) VALUES (:uname, :pword);";
 $stmt = $db->prepare($query);
 $stmt->bindValue(':uname', $uname, PDO::PARAM_STR);
 $stmt->bindValue(':pword', $passwordHash, PDO::PARAM_STR);
 $stmt->execute();
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}

header('Location: login.php');

?>

</body>
</html>
