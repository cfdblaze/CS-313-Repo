<?php
session_start();
?>
<!DOCTYPE html>

<html>
<head>
<title>PHP Database Access
</title>
</head>
<body background="http://pic1.duowan.com/ddo/0709/53780706098/53780757581.jpg">


<?php

echo '<form action="accessd.php" method="post">
        Character Search: <input type="text" name="searchtext"/> <br/>
		<input type="submit" value="Search!">
    </form> <br/>
	<a href="character_create.html">Or create a new character</a>';

?>

</body>
</html>