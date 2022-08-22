<?php require_once dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php 
interface strategy {
    public function play():void;
}
class attack implements strategy {
    public function play():void {
        dump('we should attack to enemy getway');
    }
}
class defend implements strategy {
    public function play():void {
        dump('we should defend from getway');
    }
}
interface teamContract {
    function play():void;
    function getPlayStyle():strategy;
    function setPlayStyle(strategy $playStyle):void;
}
class team implements teamContract {
    protected strategy $playStyle;

    public function __construct(strategy $playStyle)
    {
        $this->playStyle = $playStyle;
    }

    public function getPlayStyle():strategy {
        return $this->playStyle;
    }
    public function setPlayStyle(strategy $playStyle):void {
        $this->playStyle = $playStyle;
    }
    public function play():void {
        $this->playStyle->play();
    }
}
class sepahan extends team {
}
?>
<?php 
$sepahan = new sepahan(new attack);
$sepahan->play();

//////////
$sepahan->setPlayStyle(new defend);
$sepahan->play();
?>