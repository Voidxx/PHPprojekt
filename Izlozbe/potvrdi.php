<?php





require_once('../config.php');


session_start();

if((!isset($_SESSION["uloga"])) || ($_SESSION["uloga"] != (1 || 3))) {
	header("Location: index.php");
	exit;
}


          if(isset($_GET['potvrdi'])){
        $page = $_GET['potvrdi'];
           
 
                           $brisi = "UPDATE WebDiP2020x080.prijava_vlaka SET status = 1 WHERE status = 0 AND prijava_vlaka_id = :vlak";
                  $update = $db->prepare($brisi);
                       $update->execute(
                            
                            
                            
                            
                            array(
                                
                                'vlak' => $page
                                
                                
                                 
                            )
                            
                            );
                     
                       header('Location: ../galerija.php');
                

        
          }
        