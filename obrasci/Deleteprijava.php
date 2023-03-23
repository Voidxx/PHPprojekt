<?php
require_once('../config.php');


session_start();

if((!isset($_SESSION["uloga"])) || ($_SESSION["uloga"] != (1 || 2 || 3))) {
	header("Location: ../index.php");
	exit;
}

                if(isset($_SESSION["korisnik_id"])){
                                $korisnik_id = $_SESSION["korisnik_id"];
                            }
                
                            
            $sql = "SELECT * FROM WebDiP2020x080.prijava_vlaka WHERE korisnik_korisnik_id = :korisnik";
            $statement = $db->prepare($sql);
                    $statement->execute(
                            
                            
                            
                            
                            array(
                                'korisnik' => $_SESSION["korisnik_id"]
                                
                                 
                            )
                            
                            );
                            
              $count = $statement->rowCount();
              
              if($count > 0){
                  
                  $brisi = "DELETE FROM WebDiP2020x080.prijava_vlaka WHERE korisnik_korisnik_id = :korisnik";
                  $delete = $db->prepare($brisi);
                       $delete->execute(
                            
                            
                            
                            
                            array(
                                'korisnik' => $_SESSION["korisnik_id"]
                                
                                 
                            )
                            
                            );
                       
                       header("location:Prijava_vlaka.php");
              }