<?php


require_once('../config.php');

$najveci = 0;
$vlakic = 0;

          if(isset($_GET['id'])){
        $page = $_GET['id'];
           
 
        
        $upit = "SELECT * FROM WebDiP2020x080.izlozba a JOIN WebDiP2020x080.izlozen b ON a.izlozba_id = b.izlozba_izlozba_id  WHERE a.izlozba_id = :page";
                          $update1 = $db->prepare($upit);
                       $update1->execute(
                            
                            
                            
                            
                            array(
                                
                                'page' => $page
                                
                                
                                 
                            )
                            
                            );
                       while($red = $update1->fetch()){
                           $zatvori = "SELECT COUNT(*) as Cnt FROM WebDiP2020x080.glas WHERE izlozba_id = :page AND vlak_id = :vlak";
                  $update = $db->prepare($zatvori);
                       $update->execute(
                            
                            
                            
                            
                            array(
                                
                                'page' => $page,
                                'vlak' => $red['Vlak_vlak_id']
                                
                                
                                 
                            )
                            
                            );
                       
                       $row = $update->fetch();
                       if($row['Cnt'] > $najveci){
                           
                            $najveci = $row['Cnt'];
                            $vlakic = $red['Vlak_vlak_id'];
                           
                       }
                       
                       
                       }
                       
                  $pobjednik = "UPDATE WebDiP2020x080.izlozen SET Pobjednik = 'Da' WHERE Vlak_vlak_id = :vlak AND izlozba_izlozba_id = :page";
                  $postavi = $db->prepare($pobjednik);
                       $postavi->execute(
                            
                            
                            
                            
                            array(
                                'vlak' => $vlakic,
                                'page' => $page
                                
                                
                                 
                            )
                            
                            );
                       
                       
                  $pobjednik = "UPDATE WebDiP2020x080.izlozba SET status = 'zatvoreno glasovanje' WHERE izlozba_id = :page";
                  $postavi2 = $db->prepare($pobjednik);
                       $postavi2->execute(
                            
                            
                            
                            
                            array(
                                'page' => $page
                                
                                
                                 
                            )
                            
                            );
                       
          }