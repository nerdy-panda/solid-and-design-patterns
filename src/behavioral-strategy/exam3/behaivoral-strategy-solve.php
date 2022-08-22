<?php require_once dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php
interface payMethod {
    public function pay():void;
}
class bitCoin implements payMethod {
    public function pay():void {
        dump(__METHOD__);
    }
}
class paypal implements payMethod {
    public function pay():void {
        dump(__METHOD__);
    }
}
class CardToCard implements payMethod {
    public function pay():void {
        dump(__METHOD__);
    }
}
class buy {
    public function pay(payMethod $method):void {
        $method->pay();   
    }
}
?>
<?php 
$buy = new buy();
$buy->pay(new bitCoin);
$buy->pay(new CardToCard);
?>