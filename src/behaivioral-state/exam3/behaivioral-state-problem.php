<?php require dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php 
class phone {
    protected bool $bluetoothState;
    protected string $name;
    public function __construct(string $name , bool $bluetoothState)
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
    public function getBluetoothState():bool
    {
        return $this->bluetoothState;
    }
    public function setBluetoothState(bool $bluetoothState):void
    {
        $this->bluetoothState = $bluetoothState;
    }
    public function toggleBluetooth():void {
        if($this->bluetoothState)
            $this->bluetoothState = false;
        else 
            $this->bluetoothState = true;
    }
}
?>
<?php 
$zenPhone = new phone('rog zenphone',true);
dump($zenPhone);
$zenPhone->toggleBluetooth();
dump($zenPhone);
?>