<!DOCTYPE html>
<html>
<head>
<script>
var name= "Ayomikun";
var date = 2;
document.write(name);
if (name = "Ayomikun" && date = 2) {
    document.write("Your name is Ayomikun");
}
elseif(name= "Ayomiposi" && date = 1) {
    document.write("Wow your name is Ayomiposi and your birthay is today");
}
</script>
</head>
<body>
<noscript>
Javascript is not enabled
</noscript>
</body>


<?php
$name = "WilAy";
echo "The name $name sound really nice. You just ate $name's food.. We have {$name}s in the house";
echo <<<BALLS
MY NAME IS WilAy
BALLS;


$age = 18;
if ($age < 13) {
    echo "You are getting old";
}
elseif ($age < 13) {
    echo "You are not old at all";
}
elseif ($age > 13 && $age <= 60 ){
    echo "cool headed bro";
}
for ($i = 1; $i < 3; $i = $i + 1) {
    for ($j = 1; $j < 3; $j = $j + 1) {
    for ($k = 1; $k < 3; $k = $k + 1) {
    print "I: $i, J: $j, K: $k<br>";
    }
    }
    }
?>
