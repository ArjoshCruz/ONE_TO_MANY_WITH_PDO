<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "ABC_Tutoring_School";
$dsn = "mysql:host={$host};dbname={$dbname}";

$pdo = new PDO($dsn, $user, password: $password);

?>