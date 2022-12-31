<?php require_once dirname(__DIR__, 3) . '/vendor/autoload.php'; ?>
<?php 
//author of this class is nerdpanda 
class user{
    protected string $name;
    protected string $family;
    public function __construct(string $name , string $family)
    {
        $this->name = $name ;
        $this->family = $family;
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
//author of this class is tiredpanda
class advanceUser {
    protected string $firstName;
    protected string $lastName;
    public function __construct(string $firstName , string $lastName)
    {
        $this->firstName = $firstName ;
        $this->lastName = $lastName;
    }
    public function someFeature(){
        dump('this is '.__CLASS__.'feature');
    }
    public function getFirstName():string {
        return $this->firstName;
    }
    public function getLastName():string {
        return $this->lastName;
    }
    public function setFirstName(string $firstName):void {
        $this->firstName = $firstName ;
    }
    public function setLastName(string $lastName):void {
        $this->lastName = $lastName ;
    }
    public function getFullName():string {
        return $this->firstName.' '.$this->lastName;
    }
}
?>
<?php
class userAdapter extends user {
    protected advanceUser $user;
    public function __construct(string $name , string $family , advanceUser $user)
    {
        parent::__construct($name,$family);
        $this->user = $user;
    }
    public function getUser():advanceUser {
        return $this->user;
    }
    public function setUser(advanceUser $user):void {
        $this->user = $user;
    }
    public function getFullName():string {
        return $this->user->getFullName();
    }
}
?>
<?php 
$name = 'nerd';
$family = 'panda';
/* $nerdpanda = new user($name , $family ); */
// replace with userAdvance without edit client codes !!!
$nerdpanda = new userAdapter($name , $family , new advanceUser($name,$family));
?>
<?php 
echo 'hello '.$nerdpanda->getName().' '.$nerdpanda->getFamily().PHP_EOL;
?>
<?php
// new feature from advance user !!!
echo 'welcome '.$nerdpanda->getFullName().PHP_EOL;
?>