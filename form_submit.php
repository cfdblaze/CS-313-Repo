
<html>
<body>
<style>
body {
background-image: url("http://cloud-4.steamusercontent.com/ugc/531761112933067572/151A5182D816D1E57927878B3103F9FBC3966F73/");
color: white;
}
</style>
<br>
<?php

$file = fopen("fnafvotes.txt", "r+"); 
if($file) {
$votestring = fgets($file);
$votesarray = explode(" ", $votestring);
if(!isset($_COOKIE["taken"])) {
$votesarray[$_POST["Original"]]++;
$votesarray[$_POST["Withered"]]++;
$votesarray[$_POST["Toys"]]++;
$votesarray[$_POST["Fright"]]++;
$votestring = implode(" ", $votesarray);
file_put_contents("fnafvotes.txt", $votestring);
setcookie("taken", TRUE, time() + (24*24), "/");
} else {
echo "You already took this survey! <br>";
}
$original = "Freddy";
$withered = "Withered Freddy";
$toy = "Toy Freddy";
$fright = "Phantom Freddy";
if ($votesarray[0] < $votesarray[1])
$original = "Bonnie";
if ($votesarray[1] < $votesarray[2])
$original = "Chica";
if ($votesarray[2] < $votesarray[3])
$original = "Foxy";
if ($votesarray[4] < $votesarray[5])
$withered = "Withered Bonnie";
if ($votesarray[5] < $votesarray[6])
$withered = "Withered Chica";
if ($votesarray[6] < $votesarray[7])
$withered = "Withered Foxy";
if ($votesarray[8] < $votesarray[9])
$toy = "Toy Bonnie";
if ($votesarray[9] < $votesarray[10])
$toy = "Toy Chica";
if ($votesarray[10] < $votesarray[11])
$toy = "Mangle";
if ($votesarray[12] < $votesarray[13])
$fright = "Springtrap";
if ($votesarray[13] < $votesarray[14])
$fright = "Phantom Chica";
if ($votesarray[14] < $votesarray[15])
$fright = "Phantom Foxy";
echo "Most popular original animatronic: $original <br>";
echo "Most popular withered animatronic: $withered <br>";
echo "Most popular toy animatronic: $toy <br>";
echo "Most popular ghost animatronic: $fright <br>";
} else {
echo "nope";
}
?>
</body>
</html>