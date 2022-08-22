<?php require_once dirname(__DIR__, 2) . '/vendor/autoload.php'; ?>
<?php
// solution 
class serialGenerator {
    public static function serial():string {
        return substr(sha1(microtime()),0,8);
    }
}
class phone {
    protected string $name ;
    protected string $serial ;
    protected array $colleagues=[];
    public function __construct(string $name) {
        $this->name = $name ;
        $this->serial =  serialGenerator::serial() ;
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
    public function sendFile(string $serial , string $file):void {
        if($this->existColleage($serial))
            $this->colleagues[$serial]->receive($this->getSerial(),$file);
        else 
            dd(__METHOD__ ."-> no found any phone with $serial serial number");
    }
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
    public function receive(string $senderSerial, string $file):void {
        if($this->existColleage($senderSerial))
            dump(__METHOD__ ." -> from {$this->colleagues[$senderSerial]->getName()} to {$this->name} recived $file ");
        else 
            dump(__METHOD__ . " -> no found any phone with {$senderSerial} serial number");
    }
}
?>

<?php 
$sony = new phone('sony');
$zenphone = new phone('zenphone');
$samsung = new phone('samsung');

//sony 
$sony->pushColleage($zenphone);
$sony->pushColleage($samsung);

//zenphone 
$zenphone->pushColleage($sony);
$zenphone->pushColleage($samsung);

//sumsung 
$samsung->pushColleage($zenphone);

//sending 

$zenphone->sendFile($sony->getSerial() , 'index.php');
$samsung->sendFile($sony->getSerial() , 'note.txt');
?>