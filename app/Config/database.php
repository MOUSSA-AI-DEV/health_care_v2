<?php


$pdo= new PDO(  "mysql:host=localhost;dbname=unity_care_clinic_v2;charset=utf8",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    if ($pdo){

        return "good jop";
    }
?>