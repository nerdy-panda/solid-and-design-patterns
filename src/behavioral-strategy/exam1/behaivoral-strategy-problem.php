<?php require_once dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php 
interface teamContract {
    function play():void;
    function getPlayStyle():string;
    function setPlayStyle(string $playStyle):void;
}
class team implements teamContract {
    protected string $playStyle;

    public function __construct(string $playStyle)
    {
        $this->playStyle = $playStyle;
    }

    public function getPlayStyle():string {
        return $this->playStyle;
    }
    public function setPlayStyle(string $playStyle):void {
        $this->playStyle = $playStyle;
    }
    public function play():void {
        $playStyle = strtolower($this->playStyle);
        if($playStyle=='defend')
            dump('we should defend from getway');
        elseif ($playStyle=='attack')
            dump('we should attack to enemy getway');
        else 
            throw  new Exception('strategy is not supported ');
    }
}
class sepahan extends team {
}
?>
<?php 
$sepahan = new sepahan('defend');
$sepahan->play();

//////////
$sepahan->setPlayStyle('attack');
$sepahan->play();
?>