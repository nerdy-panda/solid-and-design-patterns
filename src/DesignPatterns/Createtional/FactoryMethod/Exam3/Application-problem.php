<?php require_once dirname(__DIR__,4).'/vendor/autoload.php'?>
<?php

use NerdPanda\DesignPatterns\Createional\FactoryMethod\Exam3\Services\MySqlConnector;
use NerdPanda\DesignPatterns\Createional\FactoryMethod\Exam3\Services\SqlLiteConnector;

?>
<?php require_once __DIR__.'/config/Database/mySql.php'; ?>
<?php require_once __DIR__.'/config/Database/sqlLite.php'; ?>
<?php
$mySqlConnector = new MySqlConnector(
    MYSQL_HOST,MYSQL_USERNAME,
    MYSQL_PASSWORD,MYSQL_DBNAME,MYSQL_OPTIONS
);
$sqlLiteConnector = new SqlLiteConnector(
    SQLLITE_DATABASE , SQLLITE_USERNAME ,
    SQLLITE_PASSWORD , SQLLITE_OPTIONS
);
try {
    $sqlLiteConnection = $sqlLiteConnector->connect();
    $mysqlConnection = $mySqlConnector->connect();

    $mySqlStatement = $mysqlConnection->query('show databases');
    dump($mySqlStatement->fetchAll());

}catch (PDOException $exception){
    dump($exception);
}
?>