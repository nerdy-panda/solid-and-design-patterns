<?php require dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php 
interface carContract {
    public function build():string ;
    public function getName():string;
}
abstract class car implements carContract {
    protected string $name;
    public function __construct(string $name) {
        $this->name = $name;
    }
    public function getName():string {
        return $this->name;
    }
}
class mustang extends car {
    public function build():string {
        return 'build mustang';
    }
}
class dodge extends car {
    public function build():string {
        return 'build dodge';
    }
}
?>

<?php 
abstract class carOption extends car {
    protected car $car ;
    public function __construct(car $car) {
        $this->car = $car;
    }
}
class niceBuildOption extends carOption {
    public function build():string {
        return $this->car->build()." {$this->car->getName()} ";
    }
}
class nitroOption extends carOption {
    public function build():string {
        return $this->car->build().' with nitro';
    }
}
class turboOption extends carOption {
    public function build():string {
        return $this->car->build().' with turbo';
    }
}
?>
<?php 
$mustang = new mustang('gt500');
$mustang = new niceBuildOption($mustang);
$mustangWithNitro = new nitroOption($mustang);
$mustangWithTurbo = new turboOption($mustang);
$mustangWithTurboAndNitro = new turboOption( new nitroOption($mustang) );
dump($mustang->build());
echo PHP_EOL;
dump($mustangWithNitro->build());
echo PHP_EOL;
dump($mustangWithTurbo->build());
echo PHP_EOL;
dump($mustangWithTurboAndNitro->build());
?>


==============================================================================

<?php 
$dodge = new dodge('challenger2022');
$dodge = new niceBuildOption($dodge);
$dodgeWithNitro = new nitroOption($dodge);
$dodgeWithTurbo = new turboOption($dodge);
$dodgeWithTurboAndNitro = new turboOption( new nitroOption($dodge) );

dump($dodge->build());
echo PHP_EOL;
dump($dodgeWithNitro->build());
echo PHP_EOL;
dump($dodgeWithTurbo->build());
echo PHP_EOL;
dump($dodgeWithTurboAndNitro->build());

?>

