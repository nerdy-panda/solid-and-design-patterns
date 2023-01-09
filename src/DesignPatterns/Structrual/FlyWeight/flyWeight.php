<?php require dirname(__DIR__,4).'/vendor/autoload.php';?>
<?php
$persons = [
    1=> ['name'=>'nerd','family'=>'panda' ] , 
    2=> ['name'=>'ahmed','family'=>'rezaee' ] , 
    3=> ['name'=>'john','family'=>'doe' ] , 
    4=> ['name'=>'nikolas','family'=>'hiko' ] , 
];
class person {
    protected int $id;
    protected string $name;
    protected string $family;
    public function __construct(int $id)
    {
        global $persons;
        dump("select * from persons where `id`={$id}");
        if(!key_exists($id,$persons))
            throw new Exception("not found person with id={$id}");
        $person = $persons[$id];
        $this->id = $id ;
        $this->name = $person['name'];
        $this->family = $person['family'];
    }
    public function getId():int
    {
        return $this->id;
    }
 
    public function setId(int $id):void
    {
        $this->id = $id;
    }
    public function getName():string
    {
        return $this->name;
    }
    public function setName(string $name):void
    {
        $this->name = $name;
    }
    public function getFamily():string
    {
        return $this->family;
    }

    public function setFamily(string $family):void
    {
        $this->family = $family;
    }
}
?>
<?php 
// in some code 
$panda = new person(1);
// in some other code
$nerd = new person(1);
dump($nerd,$panda,str_repeat("=",100));
////////////////////// duplicated object !!! ///////////////////////
class personFactory {
    protected static array $personRepository = [];
    public static function make(int $id):person {
        if(self::isExist($id))
            return self::$personRepository[$id];
        return self::$personRepository[$id] = new person($id);
    }
    private static function isExist(int $id):bool {
        return array_key_exists($id,self::$personRepository);
    }
}

///////////////////// create with factory ///////////////////
$person1 = personFactory::make(3);
$person2 = personFactory::make(3);
dd($person1,$person2);
?>