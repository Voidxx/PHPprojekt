<?php
require_once('../config.php');


session_start();

if((!isset($_SESSION["uloga"])) || ($_SESSION["uloga"] != (1 || 2 || 3))) {
	header("Location: index.php");
	exit;
}


          if(isset($_GET['brisi'])){
        $page = $_GET['brisi'];
           

                           $brisi = "DELETE FROM WebDiP2020x080.prijava_vlaka WHERE prijava_vlaka_id = :vlak";
                  $delete = $db->prepare($brisi);
                       $delete->execute(
                            
                            
                            
                            
                            array(
                                'vlak' => $page
                                
                                 
                            )
                            
                            );
                       
                       header('Location: ../galerija.php');

        
          }
        