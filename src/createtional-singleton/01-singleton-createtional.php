<?php require_once dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php 
# singleton
interface directoryMaker {}
class  uniqueDirectoryMaker implements directoryMaker {
    public function __construct()
    {
        dump(__CLASS__, $this);
    }
}
class uniqueDirectoryMakerFactory{
    protected static directoryMaker $instance ;
    public static function create(bool $singleton = false ):directoryMaker {
        if(!$singleton)
            return new uniqueDirectoryMaker;
        else {
            if(isset(self::$instance))
                return self::$instance;
            else 
                return self::$instance = new uniqueDirectoryMaker;
        }
    }
}

$d1 = uniqueDirectoryMakerFactory::create(false);
$d2 = uniqueDirectoryMakerFactory::create(false);
$d3 = uniqueDirectoryMakerFactory::create(false);
?>