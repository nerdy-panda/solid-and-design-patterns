<?php require_once dirname(__DIR__, 1) . '/vendor/autoload.php'; ?>
<?php 
class user {
    protected string $name;
    protected bool $emailVerified;
    protected bool $phoneVerified;
    protected bool $active;
    public function __construct(
        string $name ,
        bool $emailVerified ,
        bool $phoneVerified , 
        bool $active ,
        ) {
        $this->name = $name ;   
        $this->emailVerified = $emailVerified; 
        $this->phoneVerified = $phoneVerified;
        $this->active = $active;
    }
    public function getName():string {
        return $this->name;
    }
    public function setName(string $name):void {
        $this->name = $name ;
    }
    public function getEmailVerified():bool {
        return $this->emailVerified;
    }
    public function setEmailVerified(bool $verified):void {
        $this->emailVerified = $verified;
    }
    public function getPhoneVerified():bool {
        return $this->phoneVerified;
    }
    public function setPhoneVerified(bool $verified):void {
        $this->phoneVerified = $verified;
    }
    public function getActive():bool {
        return $this->active;
    }
    public function setActive(bool $active):void {
        $this->active = $active ;
    }
}
interface checkerContract {
    public function check(user $user):void;
}
abstract class checker implements checkerContract {
    protected checkerContract $next;
    public function next(user $user):void {
        if(isset($this->next))
            $this->next->check($user);
    }
    public function setNext(checkerContract $next):void {
        $this->next = $next;
    }
}
class emailVerifyCheck extends checker {
    public function check(user $user): void
    {
        if(!$user->getEmailVerified())
            dump('you should verify email');
        else 
            $this->next($user);
    }
}
class phoneVerifyCheck extends checker{
    public function check(user $user): void
    {
        if(!$user->getPhoneVerified())
            dump($user->getName().' you should verify phone ');
        else 
            $this->next($user);
    }
}

class activeCheck extends checker{
    public function check(user $user): void
    {
        if(!$user->getActive())
            dump($user->getName().' your not active !!! ');
        else 
            $this->next($user);
    }
}
?>
<?php 
$nerdpadna = new user('nerdpanda', true , true , true  );
$emailChecker = new emailVerifyCheck();
$phoneChecker = new phoneVerifyCheck();
$activeChecker = new activeCheck();
$emailChecker->setNext($phoneChecker);
$phoneChecker->setNext($activeChecker);

$emailChecker->check($nerdpadna);
?>