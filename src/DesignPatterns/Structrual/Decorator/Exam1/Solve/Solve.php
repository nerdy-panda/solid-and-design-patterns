<?php require dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php 
interface carContract {
    public function build():string ;
}
abstract class car implements carContract {
    protected string $name;
    public function __construct(string $name) {
        $this->name = $name;
    }
}
class mustang extends car {
    public function build():string {
        return 'build mustang -> '.$this->name;
    }
}
class dodge extends car {
    public function build():string {
        return 'build dodge -> '.$this->name;
    }
}
?>

<?php 
class nitroOption {
    protected car $car ;
    public function __construct(car $car)
    {
        $this->car = $car;
    }
    public function build():string {
        return $this->car->build().' with nitro';
    }
}
class turboOption {
    protected car $car ;
    public function __construct(car $car)
    {
        $this->car = $car;
    }
    public function build():string {
        return $this->car->build().' with turbo';
    }
}
?>
<?php 
$mustang = new mustang('gt500');
$mustangWithNitro = new nitroOption($mustang);
$mustangWithTurbo = new turboOption($mustang);
dump($mustang->build());
echo PHP_EOL;
dump($mustangWithNitro->build());
echo PHP_EOL;
dump($mustangWithTurbo->build());

?>


==============================================================================

<?php 
$dodge = new dodge('challenger2022');
$dodgeWithNitro = new nitroOption($dodge);
$dodgeWithTurbo = new turboOption($dodge);

dump($dodge->build());
echo PHP_EOL;
dump($dodgeWithNitro->build());
echo PHP_EOL;
dump($dodgeWithTurbo->build());

# wee need dodge with nitro , turbo and mustang with nitro , turbo !!!
?>

