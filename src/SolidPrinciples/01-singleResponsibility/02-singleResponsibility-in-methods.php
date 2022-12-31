<?php
require_once __DIR__.'/Lib/Connector.php';
require_once __DIR__.'/Lib/Logger.php';
?>
<?php 
$connector = new Connector();
$logger = new Logger;
?>
<?php 
/* no single responsibility */
$connection = $connector->connect($logger);
?>
<br><br>
<?php
// with single responsibility : 
try{
    $connection = $connector->connect2();
}
catch(Exception $exception){
    $logger->error($exception->getMessage());
} 
?>