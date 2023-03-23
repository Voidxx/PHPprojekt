<?php

$db_user = "root";
$db_pass = "";
$db_name = "WebDiP2020x080";

try{

$db = new PDO('mysql:host=localhost;dbname' . $db_name . ';charset=utf8', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOEXCEPTION $e){
    $e->getMessage();
}

    