<?php
    require_once "Lib/Car.php";
    require_once "Lib/Pride.php";
    require_once "Lib/DateDiff.php";
?>
<?php
$carCreated = new DateTime("2012-08-14");
$car = new Pride(
    "pride",
     $carCreated,
    new DateDiff($carCreated,new DateTime("now"))
);
var_dump($car->getAge());

