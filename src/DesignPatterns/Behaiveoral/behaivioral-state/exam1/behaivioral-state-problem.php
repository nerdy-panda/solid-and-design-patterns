<?php require dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php 
class user {
    protected int $role;
    protected string $name;
    public function __construct(string $name,int $role)
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
    public function getRole():int {
        return $this->role;
    }
    public function setRole(int $role){
        $this->role = $role;
    }
}
?>
<?php 
$panda = new user('nerd panda',1);
switch($panda->getRole()){
    case 0 : 
        dump('welcome admin');
    break;
    case 1 : 
        dump('welcome writer');
    break;
    default :
        dump('welcome unknow');
}
?>