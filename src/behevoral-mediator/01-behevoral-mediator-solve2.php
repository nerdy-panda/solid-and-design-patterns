<?php require_once dirname(__DIR__, 2) . '/vendor/autoload.php'; ?>
<?php
// solution 
class serialGenerator {
    public static function serial():string {
        return substr(sha1(microtime()),0,8);
    }
}
class phoneMediator {
    protected array $colleagues=[];
    public function getColleagues():array {
        return $this->colleagues;
    }
    public function setColleagues(array $colleagues):void {
        $this->colleagues = $colleagues ;
    }
    public function pushColleage(phone $phone):void{
        if(!$this->existColleage($phone->getSerial()))
            $this->colleagues[$phone->getSerial()]=$phone;
    }
    public function existColleage(string $serial):bool {
        return isset($this->colleagues[$serial]);
    }
    public function sendFile(string $senderSerial , string $receiverSerial , string $file):void {
            $this->colleagues[$receiverSerial]->receive($senderSerial,$file);
    }
    public function recive(string $senderSerial , string $reciverSerial , string $file):void{
        dump("recived {$file} from {$this->colleagues[$senderSerial]->getName()} to {$this->colleagues[$reciverSerial]->getName()}");
    }
    public function sendToAll(string $senderSerial , string $file):void {
        $phones = array_filter($this->colleagues,fn(phone $phone)=>$phone->getSerial()!=$senderSerial);
        foreach($phones as $phone)
            $phone->receive($senderSerial,$file);
    }
}
class phone {
    protected string $name ;
    protected string $serial ;
    protected phoneMediator $mediator;
    public function __construct(string $name , phoneMediator $mediator) {
        $this->serial =  serialGenerator::serial();
        $this->name = $name ;
        $this->mediator = $mediator;
        $this->mediator->pushColleage($this);

    }

    public function getName():string 
    {
        return $this->name;
    }

    public function setName(string $name):void
    {
        $this->name = $name;
    }

    public function getSerial():string 
    {
        return $this->serial;
    }

    public function setSerial(string $serial):void
    {
        $this->serial = $serial;
    }
    public function getMediator():phoneMediator {
        return $this->mediator;
    }
    public function setMediator(phoneMediator $mediator):void {
        $this->mediator = $mediator;
    }
    public function sendFile(string $serial , string $file):void {
        $this->mediator->sendFile($this->serial , $serial , $file);
    }

    public function receive(string $senderSerial, string $file):void {
        $this->mediator->recive($senderSerial , $this->serial , $file);
    }
    public function sendToAll(string $file):void {
        $this->mediator->sendToAll($this->serial,$file);
    }
}
?>

<?php 
$phoneMediator = new phoneMediator();
$sony = new phone('sony',$phoneMediator);
$zenphone = new phone('zenphone',$phoneMediator);
$samsung = new phone('samsung',$phoneMediator);

$zenphone->sendFile($sony->getSerial() , 'index.php');
$samsung->sendFile($sony->getSerial() , 'note.txt');
echo str_repeat(PHP_EOL,5);
$zenphone->sendToAll("Application.java");
?>