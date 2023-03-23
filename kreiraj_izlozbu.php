<?php
session_start();
require_once("config.php");

if(isset($_POST['submit'])){
    

    
    
    $naziv = $_POST['izlozi'];
    $broj = $_POST['korisnici'];
    $date = $_POST['datum'];
    $datum = date("Y/m/d", strtotime($date));
    $korisnik = $_SESSION["korisnik_id"];
    $vrsta = $_POST['vrsta'];
    
    
    
    
           $sql = "INSERT INTO WebDiP2020x080.izlozba (izlozba_id, naziv_izlozbe, datum_izlozbe, max_broj_korisnika, tip_izlozbe, status) VALUES(DEFAULT,?,?,?,?,DEFAULT) ";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([$naziv, $datum, $broj, $vrsta]);
                $ID = $db->lastInsertId();

                

                
                
                if($result){
                    
                                    $sql2 = "INSERT INTO WebDiP2020x080.moderira (izlozba_izlozba_id, korisnik_korisnik_id) VALUES(:id, :korisnik) ";
                $stmtinsert2 = $db->prepare($sql2);
                $result2 = $stmtinsert2->execute(
                        
                               array(
                                'id'         => $ID,
                                'korisnik'   => $korisnik  
                                   )
                        );
                    
                    
                    echo 'Success.';
                   
                    
                }else{
                    echo 'Error.';
                }
    
    
                
                
                
                
                
                
    
    
}