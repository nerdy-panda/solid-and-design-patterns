<?php require_once dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php 
interface getNameable {
    public function getName():string ;
}
interface setNameable {
    public function setName(string $name):void;
}
interface userable extends getNameable , setNameable {
    
}
interface developerContract extends userable {};
interface gamerContract extends userable {};
class developer implements developerContract{
    protected string $name;
    public function __construct(string $name) {
        $this->name = $name ;
    }
    public function getName(): string {
        return $this->name;
    }
    public function setName(string $name):void {
        $this->name = $name ;
    }
}
class gamer implements gamerContract {
    protected string $name;
    public function __construct(string $name) {
        $this->name = $name ;
    }
    public function getName(): string {
        return $this->name;
    }
    public function setName(string $name):void {
        $this->name = $name ;
    }
}

class developerFactory {
    public static function create(string $name):developerContract {
        return new developer($name);
    }
} 
class gamerFactory {
    public static function create(string $name):gamerContract {
        return new gamer($name);
    }
} 
$userFactoryRepository = [
    'developer' => developerFactory::class ,
    'gamer'=> gamerFactory::class , 
];
class userFactory{
    public static function create(string $type ,string $name):userable {
        global $userFactoryRepository;
        if(isset($userFactoryRepository[$type]))
            return $userFactoryRepository[$type]::create($name);
        else 
            throw new Exception("no exist \$type=$type in [".implode(",",$userFactoryRepository)."]");
    }
}
$users = [
    'nerdPadnda' => userFactory::create('developer','nerdpanda') , 
    "tiredPanda" => userFactory::create('gamer','tiredPanda') ,
];
interface pushable{
    public function push(userable $userable);
}
interface getUsersable {
    public function getUsers():array;
}
interface setUsersable {
    public function setUsers(userable ...$userable):void;
}
interface usersRepositoryContract extends pushable , getUsersable , setUsersable{
    
}
class usersRepository implements usersRepositoryContract{
    protected array $items;
    public function __construct(userable ...$users) {
        $this->items = $users;
    }
    public function getUsers():array {
        return $this->items; 
    }
    public function setUsers(userable ...$users):void {
        $this->items = $users; 
    }
    public function push(userable $user):void {
        $this->items[]= $user;
    }
}
class usersRepositoryFactory{
    protected static usersRepositoryContract $instance;
    public static function create( bool $singleton = false , userable ...$users):usersRepositoryContract {
        if(!$singleton)
            return self::createInstance(...$users);
        else if($singleton and !isset(self::$instance))
            return self::$instance = self::createInstance(...$users);
        else 
            return self::$instance;
    }
    protected static function createInstance(userable ...$users){
        return new usersRepository(...$users);
    }
}

$usersRepository = usersRepositoryFactory::create(
    true ,
    userFactory::create('developer','nerdPanda') ,
    userFactory::create('gamer','tiredPanda')
);

interface userIteratorContract {
    public function hasNext():bool;
    public function next():userable;
    public function setRepository(usersRepositoryContract $repository):void;
    public function getRepository():usersRepositoryContract;
    public function getKey():string;
}
class userIterator implements userIteratorContract {
    protected usersRepositoryContract $repository;
    protected array $keys;
    protected int $keyPointer = 0 ;
    public function __construct(usersRepositoryContract $repository)
    {
        $this->repository = $repository ;
        $this->keys = array_keys($repository->getUsers());
    }
    public function getKey():string {
        return $this->keys[$this->keyPointer];
    }
    public function hasNext(): bool
    {
        return isset($this->keys[$this->keyPointer]);
    }
    public function next(): userable
    {
        $key = $this->keys[$this->keyPointer++];
        return $this->repository->getUsers()[$key];
    }
    protected function bootstrap():void {
        $this->keys = array_keys($this->repository->getUsers());
        $this->keyPointer = 0 ;
    }
    public function getRepository(): usersRepositoryContract
    {
        return $this->repository;
    }
    public function setRepository(usersRepositoryContract $repository):void
    {
        $this->repository = $repository;
        $this->bootstrap();
    }
}
class userIteratorFactory{
    protected static userIteratorContract $instance;
    public static function create(usersRepositoryContract $repository , bool $singleton = false ){
        if(!$singleton)
            return self::createInstance($repository);
        else if($singleton and isset(self::$instance))
            return self::$instance;
        else 
            return self::$instance = self::createInstance($repository);
    }
    protected static function createInstance(usersRepositoryContract $repository):userIteratorContract {
        return new userIterator($repository);
    }
}
$itrator = userIteratorFactory::create(repository:$usersRepository);
while($itrator->hasNext())
    dump($itrator->getKey()."=>".$itrator->next()->getName());
$usersRepository->push(developerFactory::create('abolfazl'));
$itrator->setRepository($usersRepository);

echo str_repeat(PHP_EOL,3);

while($itrator->hasNext())
    dump($itrator->getKey()."=>".$itrator->next()->getName());
echo str_repeat(PHP_EOL,3);

$usersRepository->push(
    gamerFactory::create('reza')
);
$itrator->setRepository($usersRepository);

function iterateToUser(userIteratorContract $itrator):void {
        if(!$itrator->hasNext())
            return;
        dump($itrator->getKey()."=>".$itrator->next()->getName());
        iterateToUser($itrator);
}
iterateToUser($itrator);
echo str_repeat(PHP_EOL,3);

function iterator(usersRepositoryContract $repository):Generator {
    foreach($repository->getUsers() as $user)
        yield $user;
}
$generator  = iterator($usersRepository) ;

?>