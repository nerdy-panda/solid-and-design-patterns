<?php require dirname(__DIR__,2).'/vendor/autoload.php';?>
<?php 
class NerdString {
    protected string $result='';
    public function concat(string $value):self {
        $this->result .= $value ;
        return $this;
    }
    public function get():string {
        return $this->result;
    }
}
class HelloWorld {
    protected NerdString $builder;
    public function __construct(NerdString $builder ){
        $this->builder = $builder;
    }
    public function build():string {
        return $this->builder
                    ->concat('hello ')
                    ->concat('world')->get();
    }
}
$helloWorld = new HelloWorld(new NerdString);
dump($helloWorld->build());
?>