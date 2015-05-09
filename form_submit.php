<html>
<body>

Thanks for voting!
<br>
You chose <?php echo $_POST["Original"]; ?>, <?php echo $_POST["Withered"]; ?>, <?php echo $_POST["Toys"]; ?>, and <?php echo $_POST["Fright"]; ?>
<br>
<? php
$file = fopen("fnafvotes.txt", "r");
echo "HI";
if($file) {
$votestring = fgets($file);
$votesarray = explode(" ", $votestring);
$votesarry[$_POST["Original"]]++;
$votesarry[$_POST["Withered"]]++;
$votesarry[$_POST["Toys"]]++;
$votesarry[$_POST["Fright"]]++;
for ($i = 0; $i <= 15; $i++) {
echo $votesarry[$i] . " ";
}
} else {

}
?>
</body>
</html>