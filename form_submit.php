<html>
<body>
Thanks for voting!
<br>
You chose <?php echo $_POST["Original"]; ?>, <?php echo $_POST["Withered"]; ?>, <?php echo $_POST["Toys"]; ?>, and <?php echo $_POST["Fright"]; ?>
<br>
<?php
$file = fopen("fnafvotes.txt", "r"); 
if($file) {
$votestring = fgets($file);
echo $votestring;
$votesarray = explode(" ", $votestring);
$votesarray[$_POST["Original"]]++;
$votesarray[$_POST["Withered"]]++;
$votesarray[$_POST["Toys"]]++;
$votesarray[$_POST["Fright"]]++;
for ($i = 0; $i <= 15; $i++) {
echo $votesarray[$i] . " ";
}
} else {
echo "nope";
}
?>
</body>
</html>