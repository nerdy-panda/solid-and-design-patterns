<?php require_once dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php 
interface platformContract {
    public function play():void;
}
interface xboxPlatformContract extends platformContract {}
interface ps4PlatformContract extends platformContract {} 

class xboxPlatform implements xboxPlatformContract {
    public function play(): void {
        dump(__METHOD__);
    }
}
class ps4Platform implements ps4PlatformContract {
    public function play(): void {
        dump(__METHOD__);
    }
}
class gamer {
    protected string $name;
    protected platformContract $platform;
    public function __construct(
        string $name , platformContract $platform 
    )
    {
        $this->name = $name ; 
        $this->platform = $platform ;
    }
    public function getPlatform():platformContract {
        return $this->platform;
    }
    public function setPlatform(platformContract $platform):void {
        $this->platform =  $platform ; 
    }
    public function play():void {
        dump($this->name . ' start playing');
        $this->getPlatform()->play();
    }
}
?>
<?php 
/*
$tiredPanda = new gamer('tired panda', new xboxPlatform());
$john = new gamer('john', new ps4Platform());
$tiredPanda->play();
echo PHP_EOL;
$john->play();
*/
?>
<?php 
//after : 
/* class factoryPlatforms{
    public static function create(string $type):platformContract {
        switch($type){
            case "xbox" :
                return new xboxPlatform();
            case "ps4"  : 
                return new ps4Platform();
        }
    }
}

$tiredPanda = new gamer('tired panda', factoryPlatforms::create('ps4'));
$john = new gamer('john', factoryPlatforms::create('xbox'));
$tiredPanda->play();
echo PHP_EOL;
$john->play(); */
?>
<?php 
/* $platformRepository = [
    'xbox' => xboxPlatform::class , 
    'ps4' => ps4Platform::class , 
];

class factoryPlatforms{
    public static function create(string $name):platformContract {
        global $platformRepository;
        return new $platformRepository[$name];
    }
}
$tiredPanda = new gamer('tired panda', factoryPlatforms::create('ps4'));
$john = new gamer('john', factoryPlatforms::create('xbox'));

$tiredPanda->play();
echo PHP_EOL;
$john->play(); */
?>
<?php 
class xboxFactory{
    public static function create():xboxPlatformContract {
        return new xboxPlatform();
    }
}
class ps4Factory{
    public static function create():ps4Platform {
        return new ps4Platform();
    }
}


$tiredPanda = new gamer('tired panda', ps4Factory::create());
$john = new gamer('john', xboxFactory::create());

$tiredPanda->play();
echo PHP_EOL;
$john->play();
?>