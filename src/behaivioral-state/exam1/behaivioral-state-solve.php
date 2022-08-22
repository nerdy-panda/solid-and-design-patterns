<?php require dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php 
interface stateContract {
    public function getState():string;
    public function setState(string $state):void;
    public function getCode():int;
    public function setCode(int $code):void;
}
class state implements stateContract{
    protected string $state;
    protected int $code;
    public function getState():string {
        return $this->state;
    }
    public function setState(string $state):void {
        $this->state = $state;
    }
    public function getCode():int {
        return $this->code;
    }
    public function setCode(int $code):void {
        $this->code = $code;
    }
}
class adminState extends state {
    public function __construct()
    {
        $this->state = 'admin';
        $this->code = 0;
    }
}
class writerState {
    public function __construct()
    {
        $this->state = 'writer';
        $this->code = 1;
    }
}
class user {
    protected state $role;
    protected string $name;
    public function __construct(string $name,state $role)
    {
        $this->name = $name;
        $this->role = $role;
    }
    public function getName():string {
        return $this->name;
    }
    public function setName(string $name):void{
        $this->name = $name;
    }
    public function getRole():state {
        return $this->role;
    }
    public function setRole(state $role){
        $this->role = $role;
    }
}
?>
<?php 
$panda = new user('nerd panda', new adminState);
dump('welcome ' . $panda->getRole()->getState());