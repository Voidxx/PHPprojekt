<?php


    session_start();
require_once("../config.php");

if(isset($_POST['postavi'])){
    
   $izlozba = $_POST['naziv'];
   $moderator = $_POST['moderator'];
   
   
              $sql = "INSERT INTO WebDiP2020x080.moderira (izlozba_izlozba_id, korisnik_korisnik_id) VALUES(?,?) ";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([$izlozba, $moderator]);
                if($result){
                    echo 'Success.';
                    header('Location: ../galerija.php');
                    
                }
                else{
                    echo 'Error.';
                }
    
    
}
else{
    echo 'Error.';
}