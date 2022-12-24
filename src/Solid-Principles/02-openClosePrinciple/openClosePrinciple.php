<?php
require_once "Lib/SalaryCalc.php";
require_once "Lib/Employee.php";
require_once "Lib/Admin.php";
require_once "Lib/Author.php";
require_once "Lib/SeoMeen.php";
require_once "Lib/SuperAdmin.php";
$employees = [];
array_push(
    $employees,
    new Admin(),
    new Author(),
    new Author() ,
    new Admin() ,
    new SeoMeen() ,
    new SuperAdmin()
);
$calc = new SalaryCalc($employees);
$sum = $calc->calc();
var_dump($sum);