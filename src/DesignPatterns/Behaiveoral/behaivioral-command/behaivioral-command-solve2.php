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
interface commandContract {
    public function execute():void;
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
abstract class command implements commandContract{
    protected carContract $car;
    public function __construct(carContract $car) {
        $this->car = $car;
    }
}

class mustang extends car{

}
class moveForwardCommand extends command {
    public function execute(): void
    {
        echo "\t";
        $this->car->start();
        echo "\t";
        $this->car->engineOn();
        echo "\t";
        $this->car->handBrakeUp();
        echo "\t";
        $this->car->clutch();
        echo "\t";
        $this->car->gear1();
        echo "\t";
        $this->car->accelerator();
    }
}
class park extends command {
    public function execute(): void
    {
        dump("park");
        echo "\t";
        $this->car->brake();
        echo "\t";
        $this->car->clutch();
        echo "\t";
        $this->car->reverseGear();
        echo "\t";
        $this->car->accelerator();
        echo "\t";
        $this->car->brake();
        echo "\t";
        $this->car->engineOff();
        echo "\t";
        $this->car->handBrakeDown();        
    }
}
?>
<?php 
$mustang = new mustang();
$forwardCommand = new moveForwardCommand($mustang);
$parkCommand = new moveForwardCommand($mustang);
class commandRunner {
    public static function Run(CommandContract $command):void {
        $command->execute();
    }
}
    //////////////////////////////////////////////////
        dump("moveForward");
        commandRunner::Run($forwardCommand);
        dump(str_repeat("==",40));
    //////////////////////////////////////////////////
        dump("park");
        commandRunner::Run($parkCommand);
        dump(str_repeat("==",40));
        dump('after 45 minute');
        dump(str_repeat("==",40));

    //////////////////////////////////////////////////
        dump("moveForward");
        commandRunner::Run($forwardCommand);
    //////////////////////////////////////////////////
?>