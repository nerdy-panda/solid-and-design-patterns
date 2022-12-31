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

class mustangWithTurbo extends mustang{
    public function build(): string
    {
        return parent::build(). ' with turbo , ';
    }
}
class mustangWithNitro extends mustang {
    public function build(): string
    {
        return parent::build(). ' with nitro , ';
    }
}

class dodgeWithTurbo extends dodge {
    public function build(): string
    {
        return parent::build(). ' with turbo , ';
    }
}
class dodgeWithNitro extends dodge {
    public function build(): string
    {
        return parent::build(). ' with nitro , ';
    }
}
?>
<?php 
$normalMustang = new mustang('gt500');
$nitroMustang = new mustangWithNitro('gt500');
$turboMustang = new mustangWithTurbo('gt500');

dump($normalMustang->build());
echo PHP_EOL;
dump($nitroMustang->build());
echo PHP_EOL;
dump($turboMustang->build());
echo PHP_EOL;

# wee need gt500 with nitro and turbo -> ???
?>
==============================================================================

<?php 
$normalDodge = new dodge('challenger2022');
$nitroDodge = new dodgeWithNitro('challenger2022');
$turboDodge = new dodgeWithTurbo('challenger2022');

dump($normalDodge->build());
echo PHP_EOL;
dump($nitroDodge->build());
echo PHP_EOL;
dump($turboDodge->build());
echo PHP_EOL;

# wee need challenger2022 with nitro and turbo -> ???
?>