<html>
<body>
<br>
<?php
ob_start();
$file = fopen("fnafvotes.txt", "r+"); 
if($file) {
$votestring = fgets($file);
$votesarray = explode(" ", $votestring);
$votesarray[$_POST["Original"]]++;
$votesarray[$_POST["Withered"]]++;
$votesarray[$_POST["Toys"]]++;
$votesarray[$_POST["Fright"]]++;
$votestring = implode(" ", $votesarray);
file_put_contents("fnafvotes.txt", $votestring);
} else {
echo "nope";
}
while (ob_get_status()) 
{
    ob_end_clean();
}
header( "Location: survey_results.html" );
?>
</body>
</html>