<?php

require_once('../config.php');


session_start();

if((!isset($_SESSION["uloga"])) || ($_SESSION["uloga"] != (1 || 2 || 3))) {
	header("Location: index.php");
	exit;
}


if(isset($_GET['vlak'])){
        $page = $_GET['vlak'];
}

                $izlozba = $_SESSION['izlozba'];
                $korisnik = $_SESSION['korisnik_id'];
 
                
                


       $sql = "INSERT INTO WebDiP2020x080.glas (izlozba_id, datum_glasanja, korisnik_korisnik_id, vlak_id) VALUES(?,CURDATE(),?,?) ";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([$izlozba, $korisnik, $page]);
                if($result){
                    echo 'Success.';
                    header('Location: ../index.php');
                    
                }
                else{
                    echo 'Error.';
                }
                
