<?php require_once dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php
class buy {
    public function pay(string $method):void {
        $method=strtolower($method);
        if($method=='bitcoin')
            $this->bitCoin();
        elseif($method=='paypal') 
            $this->paypal();
        else 
            throw new Exception('method is not supported !!!! ');

    }
    public function bitCoin():void {
        dump('pay with bitcoin');
    }
    public function paypal():void {
        dump('pay with paypal');
    }
}
?>
<?php 
$buy = new buy();
$buy->pay('bitcoin');
?>