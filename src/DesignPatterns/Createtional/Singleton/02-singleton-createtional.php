<?php require dirname(__DIR__,2).'/vendor/autoload.php';?>
<?php 
class LoggerService {
    private static self $logger;
    private function __construct() {
        
    }
    private static function createInstance():self {
        return new self();
    }
    public static function getInstance():self {
        if(!isset(self::$logger))
            self::$logger = self::createInstance();
        return self::$logger; 
    }
}
dd(
    LoggerService::getInstance() , 
    LoggerService::getInstance() , 
);
?>