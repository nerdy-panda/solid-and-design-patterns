<?php require_once dirname(__DIR__,4).'/vendor/autoload.php'?>
<?php

use NerdPanda\DesignPatterns\Createional\FactoryMethod\Exam3\Services\MySqlConnectorFactory;
use NerdPanda\DesignPatterns\Createional\FactoryMethod\Exam3\Services\SqlLiteConnectorFactory;

?>
<?php require_once __DIR__.'/config/Database/mySql.php'; ?>
<?php require_once __DIR__.'/config/Database/sqlLite.php'; ?>
<?php
$mySqlConnector = MySqlConnectorFactory::create();
$sqlLiteConnector = SqlLiteConnectorFactory::create();
try {
    $sqlLiteConnection = $sqlLiteConnector->connect();
    $mysqlConnection = $mySqlConnector->connect();

    $mySqlStatement = $mysqlConnection->query('show databases');
    dump($mySqlStatement->fetchAll());

}catch (PDOException $exception){
    dump($exception);
}
?>