<?php # use cli for execute this !!!! ?>
<?php require dirname(__DIR__,5).'/vendor/autoload.php'; ?>
<?php
use Nerdpanda\DesignPatterns\Structrual\Composite\Solve\Services\Dir;
use Nerdpanda\DesignPatterns\Structrual\Composite\Solve\Services\File;
?>
<?php
$rootDriver = new Dir('/');
    $homeDir = new Dir('home');
        $nerdpanda = new Dir('nerdPanda');
            $desktop = new Dir('desktop');
                $welcome = new File('welcome.txt');
    $etcDir = new Dir('etc');
        $hostFile = new File('host.conf');
        $apacheDir = new Dir('apache2');
            $apacheConf = new File('apache2.conf');
            $portsConf = new File('ports.conf');
            $sitesEnableDir = new Dir('sites-enabled');
                $companyConf = new File('company.local.conf');
                $laravelConf = new File('laravel.local.conf');
    $tmpFile = new File('tmp.txt');

$rootDriver->put($homeDir);
    $homeDir->put($nerdpanda);
        $nerdpanda->put($desktop);
            $desktop->put($welcome);

$rootDriver->put($etcDir);
    $etcDir->put($hostFile);
    $etcDir->put($apacheDir);
        $apacheDir->put($apacheConf);
        $apacheDir->put($portsConf);
        $apacheDir->put($sitesEnableDir);
            $sitesEnableDir->put($companyConf);
            $sitesEnableDir->put($laravelConf);
$rootDriver->put($tmpFile);
$rootDriver->dump();
?>