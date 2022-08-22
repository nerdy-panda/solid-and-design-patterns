<?php require_once dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php
interface humanContract {
    public function getName():string;
    public function setName(string $name);
}
interface talkableContract {
    public function hello():void;
    public function present():void;
}
abstract class human implements humanContract , talkableContract {
    protected string $name;
    public function __construct(string $name)
    {
        $this->name = $name ;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = $name ;
    }
}
class persianHuman extends human {
    public function hello():void 
    {
        dump('salam');
    }
    public function present(): void
    {
        dump('man '.$this->name.' hastam ');
    }
}
class englishHuman extends human {
    public function hello():void 
    {
        dump('hey');
    }
    public function present(): void
    {
        dump('im '.$this->name);
    }
}
?>
<?php 
    $persian = new persianHuman('mohammad reza');
    $english = new englishHuman('nerdpanda');
    $persian->present();
    $english->present();
?>
<?php 
class chienseHuman extends human {
    public function hello():void 
    {
        dump('嘿');
    }
    public function present(): void
    {
        dump('我是'.$this->name);
    }
}
?>
<?php 
$chiens = new chienseHuman('dieyego');
$chiens->present();

?>