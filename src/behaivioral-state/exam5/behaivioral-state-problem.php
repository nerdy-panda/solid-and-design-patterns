<?php require dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php 
interface car {}
class mustang {
    protected string $mode;
    public function __construct(string $mode)
    {
        $this->mode = $mode;
    }
    public function getMode():string {
        return $this->mode;
    }
    public function setMode(string $mode):void {
        $this->mode = $mode;
    }
    public function switchMode():void {
        $mode = strtolower($this->mode);
        if($mode=='normal')
            $this->mode = 'sport';
        elseif($mode=='sport')
            $this->mode = 'track';
        elseif($mode=='track')
            $this->mode = 'snow';
        elseif($mode=='snow')
            $this->mode = 'normal';
        else 
            throw new Exception("{$mode} is not supported");
    }
}
?>
<?php 
$mustang = new mustang('track');
dump($mustang);
$mustang->switchMode();
dump($mustang);
?>