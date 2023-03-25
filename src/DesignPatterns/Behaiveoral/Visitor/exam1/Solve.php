<?php require_once dirname(__DIR__,3).'/vendor/autoload.php'?>
<?php 
interface visitor {
    public function visit(pricable $pricable):void;
}
interface visitable {
    public function accept(visitor $visitor):void;
}
interface pricable {
    public function getPrice():int;
}
interface productContract extends pricable , visitable {}
class product implements productContract {
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
    public function accept(visitor $visitor):void {
        $visitor->visit($this);
    }
}
class summerOffCalculator implements visitor{
    public function visit(pricable $pricable):void {
        $tax = 25;
        $pricable->setPrice(
            ($pricable->getPrice() - (($tax * $pricable->getPrice() ) / 100))
        );
    }
}
?>
<?php 
$headset = new product('logitec',22000000);
dump($headset->getPrice());
$headset->accept(new summerOffCalculator);
dump($headset->getPrice());

?>