<html>
<style>
body
{
background-image:url("http://cloud-4.steamusercontent.com/ugc/531761112933067572/151A5182D816D1E57927878B3103F9FBC3966F73/");
color:white;
}
</style>
<body>
Thanks for voting!
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
file_put_contents("fnafvotes.txt", $votestring);
$original = "Freddy";
$withered = "Withered Freddy";
$toy = "Toy Freddy";
$fright = "Phantom Freddy";
if ($votesarray[1] > $votesarray[0])
$original = "Bonnie";
if ($votesarray[2] > $votesarray[1])
$original = "Chica";
if ($votesarray[3] > $votesarray[2])
$original = "Foxy";
if ($votesarray[5] > $votesarray[4])
$withered = "Withered Bonnie";
if ($votesarray[6] > $votesarray[5])
$withered = "Withered Chica";
if ($votesarray[7] > $votesarray[6])
$withered = "Withered Foxy";
if ($votesarray[9] > $votesarray[8])
$toy = "Toy Bonnie";
if ($votesarray[10] > $votesarray[9])
$toy = "Toy Chica";
if ($votesarray[11] > $votesarray[10])
$toy = "Mangle";
if ($votesarray[13] > $votesarray[12])
$fright = "Springtrap";
if ($votesarray[14] > $votesarray[13])
$fright = "Phantom Chica";
if ($votesarray[15] > $votesarray[14])
$fright = "Phantom Foxy";
echo "The most popular original animatronic is: $original";
echo "The most popular withered animatronic is: $withered";
echo "The most popular withered animatronic is: $toy";
echo "The most popular withered animatronic is: $fright";
} else {
echo "nope";
}
?>
</body>
</html>