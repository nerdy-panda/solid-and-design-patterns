<?php require_once dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php 
interface hashable {
    public function hash(string $value):string;
}
interface hashMethodContract extends hashable {
    
}
class md5 implements hashMethodContract {
    public function hash(string $value):string{
        dump(__CLASS__);
        return md5($value);
    }
}
class sha1 implements hashMethodContract {
    public function hash(string $value):string{
        dump(__CLASS__);
        return sha1($value);
    }
}
class hasher implements hashable{
    protected hashMethodContract $hashMethod;
    public function __construct(hashMethodContract $hashMethod)
    {
        $this->hashMethod = $hashMethod;
    }
    public function getHashMethod():hashMethodContract {
        return $this->hashMethod;
    }
    public function setHashMethod(hashMethodContract $hashMethod):void {
        $this->hashMethod = $hashMethod;
    }
    public function hash(string $value):string {
        return $this->hashMethod->hash($value);
    }
}
?>
<?php 
$hasher = new hasher(new md5);
dump($hasher->hash('panda'));
$hasher->setHashMethod(new sha1);
dump($hasher->hash('panda'));
?>