<?php
session_start();
?>
<!DOCTYPE html>

<html>
<head>
<title>Login
</title>
</head>
<body background="http://pic1.duowan.com/ddo/0709/53780706098/53780757581.jpg">

<?php

echo '<form action="charlist.php" method="post">
        Username: <input type="text" name="uname"/> <br/>
		Password: <input type="password" name="pword"/> <br/>
		<input type="submit" value="Login">
    </form> <br/>
	<a href="register.html">Register</a>';

?>


</body>
</html>