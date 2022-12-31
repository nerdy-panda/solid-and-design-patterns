<?php require dirname(__DIR__,1).'/vendor/autoload.php';?>
<?php 
class funny{}
class panda {
    public  funny $funny;
    public function __construct(funny $funny){
        $this->funny = $funny;
    }
    public function clone(){
        return new self($this->funny);
    }
}
$panda = new panda(new funny);
dd($panda , $panda->clone());


?>