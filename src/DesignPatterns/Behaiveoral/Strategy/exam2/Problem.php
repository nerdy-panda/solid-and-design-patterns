<?php require_once dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php 

class hasher {
    public function sha1(string $value):string {
        return sha1($value);
    }
    public function md5(string $value):string {
        return md5($value);
    }
}
?>
<?php 
$hasher = new hasher;
dump('md5 -> '.$hasher->md5('panda'));
dump('sha1 -> '.$hasher->sha1('panda'));
?>