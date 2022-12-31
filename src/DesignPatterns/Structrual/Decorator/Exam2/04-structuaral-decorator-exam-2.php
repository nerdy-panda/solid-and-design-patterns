<?php require dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php 
class user {
    protected string $name;
    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function getName():string
    {
        return $this->name;
    }
    public function setName(string $name):void
    {
        $this->name = $name;
    }
}
class userDecorator extends user {
    protected string $family;
    protected user $user;
    public function __construct(user $user , string $family)
    {
        parent::__construct($user->name);
        $this->user = $user ; 
        $this->family = $family ;
    }
    public function getFamily():string
    {
        return $this->family;
    }
    public function setFamily(string $family):void
    {
        $this->family = $family;
    }
    public function getName(): string
    {
        return '::'.$this->user->getName().'::';
    }
    public function getFullName():string {
        return $this->name.' '.$this->family;
    }
}

$user = new user('nerd');
dump($user->getName());
dump('====================================');
$user  = new userDecorator($user,'panda');
dump($user->getName());
echo $user->getFullName().PHP_EOL;
?>