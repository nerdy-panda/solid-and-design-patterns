<?php require dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php 
interface stateContract {
    public function state():bool;    
    public function toogleBluetooth(phoneContract $phone):void;
}
class offBluetooth implements stateContract{
    public function state():bool {
        return false;
    }
    public function toogleBluetooth(phoneContract $phone):void {
        $onBluetooth = new onBluetooth;
        $phone->setBluetoothState($onBluetooth);
    }
}
class onBluetooth implements stateContract {
    public function state():bool {
        return true;
    }
    public function toogleBluetooth(phoneContract $phone):void {
        $offBluetooth = new offBluetooth;
        $phone->setBluetoothState($offBluetooth);
    }
}
interface phoneContract {}
class phone implements phoneContract{
    protected stateContract $bluetoothState;
    protected string $name;
    public function __construct(string $name , stateContract $bluetoothState)
    {
        $this->name = $name ; 
        $this->bluetoothState = $bluetoothState;
    }
    public function getName():string {
        return $this->name;
    }
    public function setName(string $name):void{
        $this->name = $name;
    }
    public function getBluetoothState():stateContract
    {
        return $this->bluetoothState;
    }
    public function setBluetoothState(stateContract $bluetoothState):void
    {
        $this->bluetoothState = $bluetoothState;
    }
    public function toggleBluetooth():void {
        $this->getBluetoothState()->toogleBluetooth($this);
    }
}
?>
<?php 
$zenPhone = new phone('rog zenphone',new offBluetooth);
dump($zenPhone);
$zenPhone->toggleBluetooth();
dump($zenPhone);
$zenPhone->toggleBluetooth();
dump($zenPhone);
?>