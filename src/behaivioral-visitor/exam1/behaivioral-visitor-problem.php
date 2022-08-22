<?php require_once dirname(__DIR__,3).'/vendor/autoload.php'?>
<?php 
class product {
    protected int $price;
    protected string $name;
    public function __construct(string $name,int $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
    public function getName():string
    {
        return $this->name;
    }
    public function setName(string $name):void
    {
        $this->name = $name;
    }
    public function getPrice():int
    {
        return $this->price;
    }
    public function setPrice(int $price):void
    {
        $this->price = $price;
    }
}
class product2 extends product {
    public function calcPriceWithOff():void {
        $tax = 25;
        $this->price = (($this->price - ($this->price * $tax) / 100));
    }
}
?>
<?php 
$headset = new product2('logitec',15000000);
$headset->calcPriceWithOff();
dd($headset->getPrice());
?>