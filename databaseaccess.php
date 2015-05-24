<?php
session_start();
?>
<!DOCTYPE html>

<html>
<head>
<title>PHP Database Access
</title>
</head>
<body>


<?php

echo '<form action="accessd.php" method="post">
        Includes: <input type="text" name="searchtext"/> <br/> Character <input type="radio" name="searchwhat" value="characters"/> 
		Spell <input type="radio" name="searchwhat" value="spells"/><br/>
		<input type="submit" value="Search!">
    </form> <br/>';

?>

</body>
</html>