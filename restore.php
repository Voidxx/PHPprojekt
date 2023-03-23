<?php

require_once('config.php');
require_once('Import.php');

use Daveismyname\SqlImport\Import;



$baci = "DROP DATABASE WebDiP2020x080";
$stmt = $db->prepare($baci);
$stmt->execute();


$postavi = "CREATE DATABASE WebDiP2020x080";
$statement = $db->prepare($postavi);
$statement->execute();


$filename = 'backup.sql';
$username = 'WebDiP2020x080';
$password = 'admin_sQ6F';
$database = 'WebDiP2020x080';
$host = 'localhost';
$dropTables = true;
new Import($filename, $username, $password, $database, $host, $dropTables);

header('Location: index.php');



?>
