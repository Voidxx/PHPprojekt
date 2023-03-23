<?php


require_once('../config.php');



          if(isset($_GET['id'])){
        $page = $_GET['id'];
           
 
                           $brisi = "UPDATE WebDiP2020x080.izlozba SET status = 'otvoreno glasovanje' WHERE status = 'Izlozba u tijeku' AND izlozba_id = :page";
                  $update = $db->prepare($brisi);
                       $update->execute(
                            
                            
                            
                            
                            array(
                                
                                'page' => $page
                                
                                
                                 
                            )
                            
                            );
          }