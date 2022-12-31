<?php require dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php 
interface mode {
    public function mode():string;
    public function switch(car $car):void;
}
class normal implements mode {
    public function mode():string{
        return 'normal';
    }
    public function switch(car $car):void {
        $car->setMode(new sport);
    }
}
class sport implements mode {
    public function mode():string{
        return 'sport';
    }
    public function switch(car $car):void {
        $car->setMode(new track);
    }
}
class track implements mode {
    public function mode():string{
        return 'track';
    }
    public function switch(car $car):void {
        $car->setMode(new snow);
    }
}
class snow implements mode {
    public function mode():string{
        return 'snow';
    }
    public function switch(car $car):void {
        $car->setMode(new normal);
    }
}

interface car {}
class mustang implements car {
    protected mode $mode;
    public function __construct(mode $mode)
    {
        $this->mode = $mode;
    }
    public function getMode():mode {
        return $this->mode;
    }
    public function setMode(mode $mode):void {
        $this->mode = $mode;
    }
    public function switchMode():void {
        $this->mode->switch($this);
    }
}
?>
<?php 
$mustang = new mustang(new track);
dump($mustang);
$mustang->switchMode();
dump($mustang);
$mustang->switchMode();
dump($mustang);
?>