<?php
require_once('config.php');
session_start();

if(isset($_SESSION["korisnik_id"])){
    
}


                        $i=0;
                        $query = "UPDATE WebDiP2020x080.korisnik SET status = :state WHERE korisnik_id = :korisnik";
                        $statement = $db->prepare($query);
                        $statement->execute(
                            
                            
                            
                            
                            array(
                                'state' => $i,
                                 'korisnik'    => $_SESSION["korisnik_id"]
                            )
                            
                            );



session_destroy();





header("location:index.php");
