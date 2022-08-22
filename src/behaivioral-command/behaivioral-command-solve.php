<?php require_once dirname(__DIR__,2).'/vendor/autoload.php'?>
<?php
interface carContract {
    public function start():void;
    public function engineOn():void;
    public function engineOff():void;
    public function handBrakeDown():void;
    public function handBrakeUp():void;
    public function reverseGear():void;
    public function gear0():void;
    public function gear1():void;
    public function clutch():void;
    public function brake():void;
    public function accelerator():void;
}
abstract class car implements carContract {
    public function start():void {
        dump($this::class.'::'.__FUNCTION__);
    }
    public function engineOn():void {
        dump($this::class.'::'.__FUNCTION__);
    }
    public function engineOff():void {
        dump($this::class.'::'.__FUNCTION__);
    }
    public function handBrakeDown():void {
        dump($this::class.'::'.__FUNCTION__);
    }
    public function handBrakeUp():void {
        dump($this::class.'::'.__FUNCTION__);
    }
    public function reverseGear():void {
        dump($this::class.'::'.__FUNCTION__);
    }
    public function gear0():void {
        dump($this::class.'::'.__FUNCTION__);
    }
    public function gear1():void {
        dump($this::class.'::'.__FUNCTION__);
    }
    public function clutch():void {
        dump($this::class.'::'.__FUNCTION__);
    }
    public function brake():void {
        dump($this::class.'::'.__FUNCTION__);
    }
    public function accelerator():void {
        dump($this::class.'::'.__FUNCTION__);
    }
}
class mustang extends car{

}
?>
<?php 
$mustang = new mustang();
// create seperate method or function for park , move forward 
function moveForward(carContract $car):void {
    echo "\t";
    $car->start();
    echo "\t";
    $car->engineOn();
    echo "\t";
    $car->handBrakeUp();
    echo "\t";
    $car->clutch();
    echo "\t";
    $car->gear1();
    echo "\t";
    $car->accelerator();
}
function park(carContract $car):void {
    dump("park");
        echo "\t";
        $car->brake();
        echo "\t";
        $car->clutch();
        echo "\t";
        $car->reverseGear();
        echo "\t";
        $car->accelerator();
        echo "\t";
        $car->brake();
        echo "\t";
        $car->engineOff();
        echo "\t";
        $car->handBrakeDown();
}

    //////////////////////////////////////////////////
        dump("moveForward");
        moveForward($mustang);
        dump(str_repeat("==",40));
    //////////////////////////////////////////////////
        park($mustang);
        dump(str_repeat("==",40));
        dump('after 45 minute');
        dump(str_repeat("==",40));

    //////////////////////////////////////////////////
        dump("moveForward");
        moveForward($mustang);
    //////////////////////////////////////////////////


?>