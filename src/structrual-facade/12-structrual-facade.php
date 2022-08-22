<?php require_once dirname(__DIR__, 2) . '/vendor/autoload.php'; ?>
<?php 
class user {
    protected string $name;
    protected bool $emailVerified;
    protected bool $phoneVerified;
    public function __construct(string $name , bool $emailVerified , bool $phoneVerified) {
        $this->name = $name ;   
        $this->emailVerified = $emailVerified; 
        $this->phoneVerified = $phoneVerified;
    }
    public function getName():string {
        return $this->name;
    }
    public function setName(string $name):void {
        $this->name = $name ;
    }
    public function getEmailVerifiedAt():bool {
        return $this->emailVerified;
    }
    public function setEmailVerifiedAt(bool $verified):void {
        $this->emailVerified = $verified;
    }
    public function getPhoneVerified():bool {
        return $this->phoneVerified;
    }
    public function setPhoneVerified(bool $verified):void {
        $this->phoneVerified = $verified;
    }
}
?>
<?php 
class userFacade{
    protected user $user;
    public function __construct(user $user)
    {
        $this->user = $user;
    }
    public function getUser():user {
        return $this->user;
    }
    public function setUser(user $user):void {
        $this->user = $user ;
    }
    public function isVerified():bool {
        return $this->user->getEmailVerifiedAt() && $this->user->getPhoneVerified();
    }
}
?>
<?php 
 $nerdpanda = new user('nerd panda' , true , true );
/*$isVerifyEmail = $nerdpanda->getEmailVerifiedAt();
$isVerifyPhone = $nerdpanda->getPhoneVerified();
$userVerify = $isVerifyEmail && $isVerifyPhone ; */
$nerdpanda = new userFacade($nerdpanda);
?>
<?php 
/* if($userVerify) */
if($nerdpanda->isVerified())
    dump('welcome user !!!');
else 
    dump('403 access denied');
?>

