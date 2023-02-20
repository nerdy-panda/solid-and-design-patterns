<?php require_once dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php 
interface observerRepositoryContract {
    public function getObservers():array;
    public function setObservers(callable ...$observers):void;
    public function add(callable $observer):void;
    public function remove(callable $observer):void;
}
class observerRepository implements observerRepositoryContract{
    protected array $observers = [];
    public function __construct(callable ...$observers) {
        $this->observers = $observers;
    }
    public function getObservers():array {
        return $this->observers;
    }
    public function setObservers(callable ...$observers):void {
        $this->observers = $observers;
    }
    public function add(callable $observer):void {
        $this->observers[] = $observer ;
    }
    public function remove(callable $observer):void {
        $this->observers = array_filter($this->observers,fn($item)=> $item!=$observer);
    }
}
class observerRepositoryFactory{
    protected static observerRepositoryContract $instance; 
    protected static string $class=observerRepository::class;
    public static function create(bool $singleton = true ,callable ...$observers):observerRepositoryContract{
        if(!$singleton)
            return self::createInstance(...$observers);
        else if($singleton and isset(self::$instance))
            return self::$instance;
        else 
            return self::$instance = self::createInstance(...$observers);
    }
    protected static function createInstance(callable ...$observers):observerRepositoryContract{
        return new self::$class(...$observers);
    }
}
interface observerIteratorContract {
    public function getRepository():observerRepositoryContract;
    public function setRepository(observerRepositoryContract $repository):void;
    public function hasNext():bool; 
    public function next():callable;
    public function getKey();
}
class observerIterator implements observerIteratorContract {
    protected observerRepositoryContract $repository;
    protected array $keys = [];
    protected int $keyPointer = 0 ;
    public function __construct(observerRepositoryContract $repository)
    {
        $this->repository = $repository ; 
        $this->bootstrapKeys();
    }
    public function getRepository():observerRepositoryContract{
        return $this->repository;
    }
    public function setRepository(observerRepositoryContract $repository):void {
        $this->repository = $repository;
        $this->bootstrap();
    }

    public function hasNext():bool {
        return isset($this->keys[$this->keyPointer]);
    }
    public function next():callable{
        $key = $this->keys[$this->keyPointer++];
        return $this->repository->getObservers()[$key];
    }
    public function getKey()
    {
        return $this->keys[$this->keyPointer];
    }
    protected function bootstrapKeys():void {
        $this->keys = array_keys($this->repository->getObservers());
    }
    protected function bootstrapKeyPointer():void {
        $this->keyPointer = 0 ;
    }
    protected function bootstrap(): void
    {
        $this->bootstrapKeys();
        $this->bootstrapKeyPointer();
    }
}
class observerIteratorFactory{
    protected static observerIteratorContract $instance; 
    protected static string $class=observerIterator::class;
    public static function create(bool $singleton = true , observerRepositoryContract $repository):observerIteratorContract{
        if(!$singleton)
            return self::createInstance($repository);
        else if($singleton and isset(self::$instance))
            return self::$instance;
        else 
            return self::$instance = self::createInstance($repository);
    }
    protected static function createInstance(observerRepositoryContract $repository):observerIteratorContract{
        return new self::$class($repository);
    }
}
interface observerDispatcherContract {
    public function getIterator():observerIteratorContract;
    public function setIterator(observerIteratorContract $iterator);
    public function dispatch():array;
}
class observerDispatcher implements observerDispatcherContract{
    protected observerIteratorContract $iterator;
    public function __construct(observerIteratorContract $iterator)
    {
        $this->iterator = $iterator ;
    }
    public function getIterator():observerIteratorContract {
        return $this->iterator;
    }
    public function setIterator(observerIteratorContract $iterator) {
        $this->iterator = $iterator ;
    }
    public function dispatch(array $arguments = []):array {
        $results = [];
        while($this->iterator->hasNext()) {
            $argument = [];
            $iteratorKey = $this->iterator->getKey();
            if(isset($arguments[$iteratorKey]))
                $argument = $arguments[$iteratorKey];
            $callResult = call_user_func_array($this->iterator->next(),$argument);
            $results[$iteratorKey] = $callResult;
        }
        return $results;
    }
}
class observerDispatcherFactory {
    protected static observerDispatcherContract $instance; 
    protected static string $class=observerDispatcher::class;
    public static function create(bool $singleton = true , observerIteratorContract $iterator):observerDispatcherContract{
        if(!$singleton)
            return self::createInstance($iterator);
        else if($singleton and isset(self::$instance))
            return self::$instance;
        else 
            return self::$instance = self::createInstance($iterator);
    }
    protected static function createInstance(observerIteratorContract $iterator):observerDispatcherContract{
        return new self::$class($iterator);
    }
}
function user_loggin():bool {
    return true;
}
if(!user_loggin())
    dd('user cant loggin');
else {
    dump('user successfully loggin');
    $listenerRepository = observerRepositoryFactory::create(
        true ,
        fn()=> dump('listener 0') ,
        fn(string $name)=> file_put_contents('log.log',"user $name loggin "), 
        fn(int $id)=> new class {public $name = 'nerdpanda' , $email = 'nerdy@gmail.com';}
    );
    $iterator = observerIteratorFactory::create(true,$listenerRepository);
    $observerDispatcher = observerDispatcherFactory::create(true,$iterator);
    $dispatchResults = $observerDispatcher->dispatch([
                            1 => ['abol'.rand(0,10)],  
                            2 => [1]
                        ]);
    dd($dispatchResults);
}
?>