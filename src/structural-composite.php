<?php require dirname(__DIR__,1).'/vendor/autoload.php'; ?>
<?php
abstract class fileSystem {
    protected string $name;
    public function __construct(string $name)
    {
        $this->name = $name ;
    }
    public function getName():string {
        return $this->name;
    }
    public function dump(int $indent = 0):void {
        echo str_repeat("\t",$indent).$this->getName().PHP_EOL;
    }
}
class file extends fileSystem {
}
class dir extends fileSystem {
    protected array $content;
    public function __construct(string $name , fileSystem ...$fileSystem)
    {
        parent::__construct($name);
        $this->content = $fileSystem;
    }
    public function getContent():array {
        return $this->content;
    }
    public function put(fileSystem $fileSystem):void {
        $this->content[] = $fileSystem;
    }
    public function pull(fileSystem $fileSystem):void {
        $filtered = array_filter($this->content,fn(fileSystem $item)=> $fileSystem!=$item);
        $this->content = $filtered;
    }
    public function dump(int $indent = 0):void {
        parent::dump($indent++);
        foreach($this->getContent() as $content){
            $content->dump($indent);
        }
    }
}
$rootDriver = new dir('/');
    $homeDir = new dir('home');
        $nerdpanda = new dir('nerdPanda');
            $desktop = new dir('desktop');
                $welcome = new file('welcome.txt');
    $etcDir = new dir('etc');
        $hostFile = new file('host.conf');
        $apacheDir = new dir('apache2');
            $apacheConf = new file('apache2.conf');
            $portsConf = new file('ports.conf');
            $sitesEnableDir = new dir('sites-enabled');
                $companyConf = new file('company.local.conf');
                $laravelConf = new file('laravel.local.conf');

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
$rootDriver->dump();
?>