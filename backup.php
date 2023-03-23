<?php

require_once('./Ifsnop/Mysqldump/Mysqldump.php');

$dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=WebDiP2020x080', 'WebDiP2020x080', 'admin_sQ6F');
$dump->start('backup.sql');

?>