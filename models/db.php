<?php
global $pdo;
if (isset($pdo)) {
    return $pdo;
}

$pdo = new PDO("mysql:host=localhost;dbname=dw_projet_freedom", "root", "root");
