<?php require_once dirname(__DIR__,3).'/vendor/autoload.php'; ?>
<?php 
interface airTransformerContract {
    public function ticket():float ;
}
interface iranAirContract extends airTransformerContract{

}
interface skyAirContract extends airTransformerContract{

}
interface mahanAirContract extends airTransformerContract{

}

class iranAir implements iranAirContract {
    public function ticket(): float
    {
        return 45.32;
    }
}
class skyAir implements skyAirContract {
    public function ticket(): float
    {
        return 60.65;
    }
}
class mahanAir implements mahanAirContract {
    public function ticket(): float
    {
        return 75.99;
    }
}
?>
<?php 
class iranAirFactory {
    protected static iranAirContract $transformer;
    public static function create(bool $singleton=false):iranAirContract {
        if(!$singleton)
            return self::instance();
        else if ($singleton and !isset(self::$transformer))
            return self::$transformer = self::instance();
        else 
            return self::$transformer;
    }
    protected static function instance():iranAirContract {
        return new iranAir;
    }
    public static function getInstance():iranAirContract {
        return self::$transformer;
    }
    
}
class skyAirFactory {
    protected static skyAirContract $transformer;
    public static function create(bool $singleton=false):skyAirContract {
        if(!$singleton)
            return self::instance();
        else if ($singleton and !isset(self::$transformer))
            return self::$transformer = self::instance();
        else 
            return self::$transformer;
    }
    protected static function instance():skyAirContract {
        return new skyAir;
    }
    public static function getInstance():skyAirContract {
        return self::$transformer;
    }
}

class mahanAirFactory {
    protected static mahanAirContract $transformer;
    public static function create(bool $singleton=false):mahanAirContract {
        if(!$singleton)
            return self::instance();
        else if ($singleton and !isset(self::$transformer))
            return self::$transformer = self::instance();
        else 
            return self::$transformer;
    }
    protected static function instance():mahanAirContract {
        return new mahanAir;
    }
    public static function getInstance():mahanAirContract {
        return self::$transformer;
    }
}
$transformersRepository = [
    'mahanAir' => mahanAirFactory::class , 
    'iranAir' => iranAirFactory::class ,
    'skyAir' => skyAirFactory::class , 
];
class transformersFactory{
    public static function create(string $type , bool $singleton = false ):airTransformerContract {
        global $transformersRepository;
        if(isset($transformersRepository[$type]))      
            return $transformersRepository[$type]::create($singleton);
        else 
            throw new Exception("\$type parameter should be mahanAir|skyAir|iranAir");
    }
}
?>
<?php 
interface passanger{}

class airPassenger implements passanger {
    protected airTransformerContract $transformer;
    public function __construct(airTransformerContract $transformer)
    {
        $this->transformer = $transformer; 
    }
    public function setTransformer(airTransformerContract $transformer):void{
        $this->transformer = $transformer ;
    }
    public function getTransformer():airTransformerContract {
        return $this->transformer;
    }
}
class airPassengerFactory {
    protected static airPassenger $transformer;
    public static function create(airTransformerContract $transformer,bool $singleton=false):airPassenger {
        if(!$singleton)
            return self::instance($transformer);
        else if ($singleton and !isset(self::$transformer))
            return self::$transformer = self::instance($transformer);
        else 
            return self::$transformer;
    }
    protected static function instance(airTransformerContract $transformer):airPassenger {
        return new airPassenger($transformer);
    }
    public static function getInstance():airPassenger {
        return self::$transformer;
    }
}
class calculator{
    protected passanger $user;
    public function __construct(passanger $user)
    {
        $this->user = $user;
    }
    public function getUser():passanger {
        return $this->user;
    }
    public function setUser(passanger $user):void {
        $this->user = $user ;
    }
    public function ticketFactor():float {
        $purePrice = $this->user->getTransformer()->ticket();
        $tax = 12 ;
        return (($purePrice * 12 ) / 100 ) + $purePrice ;
    }
}
class calculatorFactory {
    protected static calculator $transformer;
    public static function create(passanger $user, bool $singleton=false):calculator {
        if(!$singleton)
            return self::instance($user);
        else if ($singleton and !isset(self::$transformer))
            return self::$transformer = self::instance($user);
        else 
            return self::$transformer;
    }
    protected static function instance(passanger $user):calculator {
        return new calculator($user);
    }
    public static function getInstance():calculator {
        return self::$transformer;
    }
}
?>
<?php 
    $mahanAir = transformersFactory::create("mahanAir",true);
    $skyAir = skyAirFactory::create(true);
    $iranAir = iranAirFactory::create(true);
    
    $nerdPanda = airPassengerFactory::create($mahanAir,true);
    $calculator = calculatorFactory::create($nerdPanda,true);

    dump($calculator->ticketFactor());

    echo PHP_EOL;
    $nerdPanda->setTransformer($skyAir);
    dump($calculator->ticketFactor());
    echo PHP_EOL;
    $nerdPanda->setTransformer($iranAir);
    dump($calculator->ticketFactor());
?>