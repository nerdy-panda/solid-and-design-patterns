<?php require dirname(__DIR__,1).'/vendor/autoload.php';?>
<?php 
interface snapShotContract {
    public function getState():array;
    public function getCreatedAt():DateTime;
}
class snapShot implements snapShotContract{
    protected array $state;
    protected DateTime $createdAt;
    public function __construct(array $state)
    {
        $this->state = $state;
        $this->createdAt = new DateTime('now');
    }
    public function getState():array {
        return $this->state;
    }
    public function getCreatedAt():DateTime {
        return $this->createdAt;
    }
}
interface snapShotableContract {}
class user implements snapShotableContract {
    protected string $name;
    protected string $family;
    protected string $bio;
    public function __construct(string $name,string $family,string $bio)
    {
        $this->name = $name ;
        $this->family = $family ;
        $this->bio = $bio ;
    }
    public function getName():string {
        return $this->name;
    }
    public function setName(string $name):void {
        $this->name=$name;
    }
    public function getFamily():string {
        return $this->family;
    }
    public function setFamily(string $family):void {
        $this->family = $family ;
    }
    public function getBio():string {
        return $this->bio;
    }
    public function setBio(string $bio):void {
        $this->bio = $bio;
    }
}
?>
<?php 
class snapShotController {
    protected snapShotableContract $snapShotable ;
    protected array $snapShots = [];
    public function __construct(snapShotableContract $snapShotable)
    {
        $this->snapShotable = $snapShotable;
    }
    public function history():array {
        return $this->snapShots;
    }
    public function takeShot():void {
        $shot = new snapShot([
            'name'=> $this->snapShotable->getName() , 
            'family'=> $this->snapShotable->getFamily() , 
            'bio'=> $this->snapShotable->getBio()
        ]);
        $this->snapShots[] = $shot;
    }
    public function undo():void {
        $snapShotKey = sizeof($this->snapShots)-2;
        if(!isset($this->snapShots[$snapShotKey]))
            throw new Exception('no found any snapShot !!!');
        $snapShot = $this->snapShots[$snapShotKey];
        $states = $snapShot->getState();
        foreach($states as $stateKey=>$state)
            $this->snapShotable->{'set'.ucfirst($stateKey)}($state);
    }
}
$panda = new user('nerd','panda','im frontend developer');
$snapShotHandler = new snapShotController($panda);
$snapShotHandler->takeShot();

dump($snapShotHandler->history(),$panda,str_repeat('==',64));

$panda->setBio('im fullstack developer for Enterprise Applications !!!');
$snapShotHandler->takeShot();

dump($snapShotHandler->history(),$panda,str_repeat('==',64));

$snapShotHandler->undo();
$snapShotHandler->takeShot();

dump($snapShotHandler->history(),$panda);

?>