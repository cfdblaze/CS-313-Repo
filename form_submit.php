<html>
<body>
Thanks for voting!
<br>
You chose <?php echo $_POST["Original"]; ?>, <?php echo $_POST["Withered"]; ?>, <?php echo $_POST["Toys"]; ?>, and <?php echo $_POST["Fright"]; ?>
<br>
<?php
$file = fopen("fnafvotes.txt", "r+"); 
if($file) {
$votestring = fgets($file);
$votesarray = explode(" ", $votestring);
$votesarray[$_POST["Original"]]++;
$votesarray[$_POST["Withered"]]++;
$votesarray[$_POST["Toys"]]++;
$votesarray[$_POST["Fright"]]++;
$votestring = implode(" ", $votesarray);
echo $votestring;
file_put_contents("fnafvotes.txt", $votestring);
} else {
echo "nope";
}
?>
</body>
</html>