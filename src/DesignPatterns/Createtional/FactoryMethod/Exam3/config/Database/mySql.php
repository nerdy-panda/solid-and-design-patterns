<?php
define("MYSQL_HOST","localhost");
define("MYSQL_DBNAME",null);
define("MYSQL_USERNAME","root");
define("MYSQL_PASSWORD","root");
define("MYSQL_OPTIONS",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);