<?php
session_start();
?>

<html>
<head>
<title> Character_Select </title>
</head>
<body background="http://pic1.duowan.com/ddo/0709/53780706098/53780757581.jpg">

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

$username = $_POST["uname"];
$pw = $_POST["pword"];
$userid = "";

try
{

 $db = new PDO("mysql:host=$dbHost;dbname=dnd_character_manager", $dbUser, $dbPassword);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $userpw = "";
 $userid = "";
 if (!isset($_SESSION['user_id']))
 {
  $query = "SELECT id, username, password FROM users WHERE username = '$username';";
  foreach ($db->query($query) as $row)
  {
   $userpw = $row['password'];
   $userid = $row['id'];
   $_SESSION['user_id'] = $userid;
  }
 }
 else 
 {
  $userid = $_SESSION['user_id'];
  $query = "SELECT username, password FROM users WHERE id = '$userid';";
  foreach ($db->query($query) as $row)
  {
   $userpw = $row['password'];
   $username = $row['username'];
  }
 }
 
 if (password_verify($pw, $userpw))
 {
  $query = "SELECT id, name, level, race FROM characters WHERE user_id = $userid";
  foreach ($db->query($query)as $row)
  {
   echo '<a href="char_sheet.php?id=' . $row['id'] . '">' . $row['name'] . ': Level ' . $row['level'] . ', ' . $row['race'] . '</a><br/>'; 
  }
  echo '<br/><br/><br/><a href="character_create.html">Or create a new character</a>';
 }
 else
 {
  echo 'Sorry, login failed.';
 }
} catch (PDOEXCEPTION $ex)
{
 echo "bad thing was " . $ex;
}

?>

</body>
</html>