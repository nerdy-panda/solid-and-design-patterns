<?php require_once dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php 
class developer {
    public function __construct() {
        dump(__CLASS__);
    }
}
class tester {
    public function __construct() {
        dump(__CLASS__);
    }
}

class employeeFactory {
    public static function create(string $type)
    {
        if($type=="developer")
            return new developer();
        elseif($type=="tester")
            return new tester();
    }
}

$employee1 = employeeFactory::create('developer');
$employee2 = employeeFactory::create('tester');
?>