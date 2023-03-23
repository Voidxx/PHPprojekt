<?php


    session_start();
require_once("../config.php");

if(isset($_POST['dodaj'])){
    
   $izlozba = $_POST['tema'];

   
   
              $sql = "INSERT INTO WebDiP2020x080.tip_izlozbe (tip_izlozbe_id, naziv_tipa) VALUES(DEFAULT,?) ";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([ $izlozba]);
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