<?php

require_once 'config.php';


    
               if(isset($_GET['otkljucaj'])){
        $korisnik = $_GET['otkljucaj'];
    
            
                $sql = "UPDATE WebDiP2020x080.korisnik SET zakljucan = 'Ne' WHERE korisnik_id = :kljuc";
                $stmt = $db->prepare($sql);
                $stmt->execute(
                         array(
                                'kljuc' => $korisnik
                                 
                            )
                            
                        );
                
                
                $query = "UPDATE WebDiP2020x080.korisnik SET broj_pokusaja = 0 WHERE korisnik_id= :korisnik";
                $statement = $db->prepare($query);
                $statement->execute(
                            
                            
                            
                            
                            array(
                                
                                'korisnik' => $korisnik
                                
                                 
                            )
                            );
                
    
               }
               header('Location: index.php');
               ?>
