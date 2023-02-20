<?php require dirname(__DIR__,2).'/vendor/autoload.php';?>
<?php 
interface listenerContract {
    public function execute():void;
}
class sendWelcomeEmail implements listenerContract {
    public function execute(): void
    {
        dump('sending welcome email ');
    }
}
class sendEmailConfirmEmail implements listenerContract{
    public function execute(): void
    {
        dump(__CLASS__);
    }
}
class LogRegisteredUser implements listenerContract {
    public function execute(): void
    {
        dump('loging -> user registered in system with ip : 192.168.36.5');
    }
    
}
interface eventContract {
    public function addListener(listenerContract $listener):void;
    public function removeListener(listenerContract $listener):void;
    public function getListeners():array;
    public function dispatch():void;
}
class UserRegisterEvent implements eventContract {
    protected array $listeners;
    public function __construct(listenerContract ...$listeners)
    {
        $this->listeners = $listeners;
    }
    public function addListener(listenerContract $listener):void {
        $this->listeners[] = $listener;
    }
    public function removeListener(listenerContract $listener):void {
        $this->listeners = array_filter($this->listeners , fn($listenerItem)=> $listenerItem!=$listener);
    }
    public function getListeners():array {
        return $this->listeners;
    }
    public function dispatch():void {
        foreach($this->listeners as $listener)
            $listener->execute();
    }
}
?>
<?php 
$registerEvent = new UserRegisterEvent(
    new LogRegisteredUser , 
    new sendWelcomeEmail
);
$sendEmailConfirmEmailListener = new sendEmailConfirmEmail;
$registerEvent->addListener($sendEmailConfirmEmailListener);

// ============================
    //$registerEvent->removeListener($sendEmailConfirmEmailListener);
    //dd($registerEvent->getListeners());
// ============================

$registerEvent->dispatch();
?>