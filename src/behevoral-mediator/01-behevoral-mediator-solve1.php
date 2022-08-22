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
    protected static array $colleagues=[];
    public function __construct(string $name) {
        $this->name = $name ;
        $this->serial =  serialGenerator::serial() ;
        self::pushColleage($this);
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
            self::$colleagues[$serial]->receive($this->getSerial(),$file);
        else 
            dd(__METHOD__ ."-> no found any phone with $serial serial number");
    }
    public static function getColleagues():array {
        return self::$colleagues;
    }
    public static function setColleagues(array $colleagues):void {
        self::$colleagues = $colleagues ;
    }
    protected static function pushColleage(phone $phone):void{
        if(!self::existColleage($phone->getSerial()))
            self::$colleagues[$phone->getSerial()]=$phone;
    }
    public static function existColleage(string $serial):bool {
        return isset(self::$colleagues[$serial]);
    }
    public function receive(string $senderSerial, string $file):void {
        if($this->existColleage($senderSerial))
            dump(__METHOD__ ." -> from ".self::$colleagues[$senderSerial]->getName()." to {$this->name} recived $file ");
        else 
            dump(__METHOD__ . " -> no found any phone with {$senderSerial} serial number");
    }
}
?>

<?php 
$sony = new phone('sony');
$zenphone = new phone('zenphone');
$samsung = new phone('samsung');

$zenphone->sendFile($sony->getSerial() , 'index.php');
$samsung->sendFile($sony->getSerial() , 'note.txt');
dump(phone::getColleagues());
?>