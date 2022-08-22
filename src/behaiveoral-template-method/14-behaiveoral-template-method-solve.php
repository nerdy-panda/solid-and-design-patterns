<?php require_once dirname(__DIR__,2) . '/vendor/autoload.php'; ?>
<?php 
abstract class employee {
    protected string $name;
    public function __construct(string $name)
    {
        $this->name = $name ;
    }
    public function getName():string {
        return $this->name;
    }
    public function setName(string $name):void {
        $this->name = $name ;
    }
    public function work():void {
        dump(' im '.$this->name.' starting work....');
    }
    public abstract function takeTool():void;
}
class driverEmployee extends employee {
    public function takeTool(): void
    {
        $this->takeCar();
    }
    public function takeCar():void {
        dump(' im  '.$this->name.' taking car');
    }
}
class developerEmployee extends employee {
    public function takeTool(): void
    {
        $this->takeLapTop();
    }
    public function takeLapTop():void {
        dump(' im '.$this->name.' taking laptop');
    }
}

$employees = [
    new driverEmployee('john') , new developerEmployee('hushang') , 
    new developerEmployee('mohnsen') 
];
foreach($employees as $employee){
    $employee->takeTool();
    $employee->work();
    echo str_repeat(PHP_EOL,2);
}
?>