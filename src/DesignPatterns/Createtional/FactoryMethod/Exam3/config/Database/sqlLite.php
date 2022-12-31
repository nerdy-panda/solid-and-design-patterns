<?php
define("SQLLITE_DATABASE",dirname(__DIR__,2).'/database.sqlite');
define("SQLLITE_USERNAME","");
define("SQLLITE_PASSWORD","");
define("SQLLITE_OPTIONS",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);