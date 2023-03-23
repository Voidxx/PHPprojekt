<?php
require_once('config.php');
session_start();


                        $i=1;
                        $query = "UPDATE WebDiP2020x080.korisnik SET status = :state WHERE korisnik_id = :korisnik";
                        $statement = $db->prepare($query);
                        $statement->execute(
                            
                            
                            
                            
                            array(
                                'state' => $i,
                                 'korisnik'    => $_SESSION["korisnik_id"]
                            )
                            
                            );
                        
                        
                        
                        header("location:index.php");
                            

?>
