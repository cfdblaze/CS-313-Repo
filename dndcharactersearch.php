<?php
session_start();
?>
<!DOCTYPE html>

<html>
<head>
<title>D&D Character Search
</title>
</head>
<body>


<?php

echo '<form action="accessd.php" method="post">
        Character Search: <input type="text" name="searchtext"/> <br/>
		<input type="submit" value="Search!">
    </form> <br/>';

?>

</body>
</html>