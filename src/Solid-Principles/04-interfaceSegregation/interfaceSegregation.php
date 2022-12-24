<?php
//interface Bird{
//    public function run();
//    public function fly():void;
//}
//class Eagle implements Bird  {
//    public function fly(): void {
//        echo "Eagle fleeing <br>";
//    }
//    public function run():void {
//        echo 'Eagle -> ran <br>';
//    }
//}
//class Human implements Bird{
//    public function run(){
//        echo 'human ran <br>';
//    }
//    public function fly(): void {
//        echo "human cant fleeing <br>";
//    }
//}

interface Flyable{
    public function fly():void;
}
interface Runnable {
    public function run():void;
}

interface Bird extends Flyable ,Runnable {

}


///************************
class Eagle implements Bird  {
    public function fly(): void {
        echo "Eagle fleeing <br>";
    }
    public function run():void {
        echo 'Eagle -> ran <br>';
    }
}
class Human implements Runnable {
    public function run():void {
        echo 'human ran <br>';
    }
}