<?php

require_once 'config.php';


    
               if(isset($_GET['zakljucaj'])){
        $korisnik = $_GET['zakljucaj'];
    
            
                $sql = "UPDATE WebDiP2020x080.korisnik SET zakljucan = 'Da' WHERE korisnik_id = :kljuc";
                $stmt = $db->prepare($sql);
                $stmt->execute(
                         array(
                                'kljuc' => $korisnik
                                 
                            )
                            
                        );
    
               }
                header('Location: index.php');
               ?>
