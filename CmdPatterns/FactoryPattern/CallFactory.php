<?php 

/**
*	instantiate and get the speed
*/
require_once('Car.php');

$car = new Car();

echo $car -> getSpeed(), "\n";