<?php


require_once('../config.php');

session_start();

if((!isset($_SESSION["uloga"])) || ($_SESSION["uloga"] != (1 || 2 || 3))) {
	header("Location: index.php");
	exit;
}
?>



<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <title>Izlozbe</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="title" content="popis slika" >
        <meta name="author" content="Leon Sedlanić">
        <meta name="keywords" content="slike">
        <meta name="description" content="meta podatci">
       <link rel="stylesheet" href="../css/lsedlanic.css" type="text/css"/>
       
       

    </head>
    <body >
    <header >
        <h1>Galerija</h1>
                      <?php

if((isset($_SESSION["uloga"])) && ($_SESSION["uloga"] == (1 || 2 || 3)))
{
     echo '<br><br><a href="../logout.php">Logout</a>';

}




?>
    </header>
    <nav>
        <ul>
            <li><a href="../index.php">Početna stranica</a></li>
            <li><a href="../autor.php">Autor</a> </li>
            <li><a href="../galerija.php">Izložbe</a> </li>
            <li><a href="../obrasci/Prijava_vlaka.php">Prijava vlaka</a></li>
            <li><a href="../obrasci/prijava.php">Prijava</a> </li>
            <li><a href="../obrasci/registracija.php">Registracija</a> </li>
        </ul>
    </nav>

    <section id="izlozba">
 
        
        
<?php

require_once('../config.php');

if(isset($_GET['page'])){
        $page = $_GET['page'];
    
    
        if(($_SESSION["uloga"] === 3) || ($_SESSION["uloga"] === 1)) {
	
                                                  echo"    <form action='prijave.php?id=".$page."' method='post' enctype='multipart/form-data'>
    <label for='file'><span>Pregled prijava:</span></label>
    <input type='submit' name='submit' value='Pregled' />
    </form>";
                      
	
}
           
        if(($_SESSION["uloga"] === 3) || ($_SESSION["uloga"] === 1)) {
	
                                                  echo"    <form action='otvori_glasovanje.php?id=".$page."' method='post' enctype='multipart/form-data'>
    <label><span>Otvori glasovanje</span></label>
    <input type='submit' name='submit' value='Otvori' />
    </form>";
                      
	
}

        if(($_SESSION["uloga"] === 3) || ($_SESSION["uloga"] === 1)) {
	
                                                  echo"    <form action='zatvori_glasovanje.php?id=".$page."' method='post' enctype='multipart/form-data'>
    <label><span>Zatvori glasovanje</span></label>
    <input type='submit' name='submit' value='Zatvori' />
    </form>";
                      
	
}
            
                            
            $upit = "SELECT DISTINCT * FROM WebDiP2020x080.prijava_vlaka a JOIN WebDiP2020x080.izlozba b ON b.izlozba_id = :stranica WHERE a.status = 1 AND CURDATE() > b.datum_izlozbe AND a.izlozba_id = b.izlozba_id";
            $izjava = $db->prepare($upit);
                    $izjava->execute(
                            
                            
                            
                            
                            array(
                                'stranica' => $page
                                
                                 
                            )
                            
                            );

                          $count1 = $izjava->rowCount();
           
                          
              if($count1 > 0){
                  while($row = $izjava->fetch()){
                      if($row['dodan'] === "Ne"){
                $vlak = "INSERT INTO WebDiP2020x080.vlak (vlak_id, naziv_vlaka, max_broj_putnika, max_brzina, tip_vlaka_tip_vlaka_id, kratki_opis, Img) VALUES(DEFAULT,?,?,?,?,?,?) ";
                $stmtinsert = $db->prepare($vlak);
                    $result = $stmtinsert->execute([$row['naziv_vlaka'], $row['broj_sjedala'], $row['max_brzina'], $row['pogon_vlaka'], $row['kratki_opis'], $row['img']]);
                      
                if($result){
                    $naziv = $row['naziv_vlaka'];
                    
                    $alter = "UPDATE WebDiP2020x080.prijava_vlaka SET dodan = 'Da' WHERE naziv_vlaka = :naziv ";
                    $stat = $db->prepare($alter);
                    
                    $stat->execute(
                            
                            
                            
                            
                            array(
                                'naziv' => $naziv
                            )
                            
                            );
                    
                 echo 'Vlakovi postavljeni.';
                           
                 
                 
                 
                 
}
                    
                else{
                    echo 'Error.';
                }
              }
             }
            
         }
              
              
                 
                    
              
         $izlozba = "SELECT * FROM WebDiP2020x080.vlak a JOIN WebDiP2020x080.prijava_vlaka c   WHERE a.izlozen = 'Ne' AND c.izlozba_id = :stranica AND a.naziv_vlaka = c.naziv_vlaka" ;
         $izlozi = $db->prepare($izlozba);
         $izlozi->execute(
                   array(
                                'stranica' => $page
                            ));
         
         
         $brojcano = $izlozi->rowCount();
         
         if($brojcano > 0){
             while($red = $izlozi->fetch()){
                    if($red['izlozen'] === "Ne"){
                        
                $a = "INSERT INTO WebDiP2020x080.izlozen (Vlak_vlak_id, izlozba_izlozba_id, korisnik_id, Pobjednik) VALUES(?,?,?,?) ";
                $b = $db->prepare($a);
                    $result2 = $b->execute([$red['vlak_id'], $red['izlozba_id'], $red['korisnik_korisnik_id'], "Ne"]);
                        if($result2){
                            $naziv = $red['vlak_id'];
                     $alter = "UPDATE WebDiP2020x080.vlak SET izlozen = 'Da' WHERE vlak_id = :naziv ";
                    $stat = $db->prepare($alter);
                    
                    $stat->execute(
                            array(
                                'naziv' => $naziv
                            )
                            
                            );
                    
                    $zapocelo = "UPDATE WebDiP2020x080.izlozba SET status = 'Izlozba u tijeku' WHERE izlozba_id = :page";
                        $zapocni = $db->prepare($zapocelo);
                        
                        $zapocni->execute(
                                   array(
                                'page' => $page
                            )
                                );
                        
                    
                    
                      echo 'Vlakovi izlozeni, izlozba zapoceta.';
                                
                      $redak = $izlozi->fetch();
                      $makni = "DELETE FROM WebDiP2020x080.prijava_vlaka WHERE prijava_vlaka_id = :id";
                      $maknito = $db->prepare($makni);
                      $maknito->execute(
                              array(
                                  
                                  'id'  => $redak['prijava_vlaka_id']
                              )
                              );
}
                    
                else{
                    echo 'Error.';
                }
              }
             }
            
         }
              
         

   
        if(isset($_POST['submit'])){
                    $pogon = $_POST['filter'];
        
        
                $sql = "SELECT * FROM WebDiP2020x080.vlak a JOIN WebDiP2020x080.izlozen b ON a.vlak_id = b.vlak_vlak_id JOIN WebDiP2020x080.tip_vlaka c ON a.tip_vlaka_tip_vlaka_id = c.tip_vlaka_id   WHERE b.izlozba_izlozba_id = :izlozba AND c.vrsta_pogona = :pogon";
            $statement = $db->prepare($sql);
                    $statement->execute(
                            

                            array(
                                'izlozba' => $page,
                                'pogon'   => $pogon
                                
                                 
                            )
                            
                            );
                            
              $count = $statement->rowCount();
              
        }
        
        
        
        else if(empty($_POST['submit'])){
            $sql = "SELECT * FROM WebDiP2020x080.vlak a JOIN WebDiP2020x080.izlozen b ON a.vlak_id = b.vlak_vlak_id JOIN WebDiP2020x080.tip_vlaka c ON a.tip_vlaka_tip_vlaka_id = c.tip_vlaka_id   WHERE b.izlozba_izlozba_id = :izlozba";
            $statement = $db->prepare($sql);
                    $statement->execute(
                            

                            array(
                                'izlozba' => $page
                                
                                 
                            )
                            
                            );
                            
              $count = $statement->rowCount();
        }
        
        
        
        else{
            
                            $sql = "SELECT * FROM WebDiP2020x080.vlak a JOIN WebDiP2020x080.izlozen b ON a.vlak_id = b.vlak_vlak_id JOIN WebDiP2020x080.tip_vlaka c ON a.tip_vlaka_tip_vlaka_id = c.tip_vlaka_id   WHERE b.izlozba_izlozba_id = :izlozba";
            $statement = $db->prepare($sql);
                    $statement->execute(
                            

                            array(
                                'izlozba' => $page
                                
                                 
                            )
                            
                            );
                            
              $count = $statement->rowCount();
        }
              
              
              
              
              
              
              if($count > 0){
                  while($row = $statement->fetch())
        {        
                            echo "
            <table class='table'>
            <tr>
            <th>ID vlaka</th>
            <th>Naziv vlaka</th>
            <th>Max.broj putnika</th>
            <th>Max. brzina</th>
            <th>Tip vlaka</th>
            <th>Kratki opis</th>
            </tr>";

            $image_data = $row['Img'];
            $encoded_image = base64_encode($image_data);
            $Hinh = "<a href='vlak.php?vlak=".$row['vlak_id']."'><img src='data:image/jpeg;base64,{$encoded_image}'></a>";
            
            echo ' <tr>
                <td>'.$row['vlak_id'].'</td>
                <td>'.$row['naziv_vlaka'].'</td>
                <td>'.$row['max_broj_putnika'].'</td>
                <td>'.$row['max_brzina'].'</td>
                <td>'.$row['vrsta_pogona'].'</td>
                <td>'.$row['kratki_opis'].'</td>    

    
                </tr>'; 
            echo $Hinh;
            $_SESSION["vlak".$row['vlak_id'].""] = $row['vlak_id']; 

                               
        $sql2 = "SELECT * FROM WebDiP2020x080.izlozba a JOIN WebDiP2020x080.glas b ON a.izlozba_id = b.izlozba_id WHERE a.izlozba_id = :izlozba AND b.korisnik_korisnik_id = :korisnik";
            $statement2 = $db->prepare($sql2);
                    $statement2->execute(
                            
     
                            array(
                                'izlozba' => $page,
                                'korisnik' => $_SESSION["korisnik_id"]
                                
                                 
                            )
                            
                            );
                    

                            $sql3 = "SELECT * FROM WebDiP2020x080.izlozba WHERE izlozba_id = :izlozba";
            $statement3 = $db->prepare($sql3);
                    $statement3->execute(
                            
   
                            
                            array(
                                'izlozba' => $page
             
                                
                                 
                            )
                            
                            );
                    

                
                      $count2 = $statement2->rowCount();
                      $red = $statement3->fetch();
                      if(($count2 < 1)&& ($red['status'] === 'otvoreno glasovanje')){
                          echo "<form method='POST' action='dodaj_glas.php?vlak=".$row['vlak_id']."'>
                             <input id='submit'  name='submit' type='submit' value='Glas' />
                          . </form>";
                          $_SESSION["izlozba"] = $page;
                      } 
            

        
              }
              echo "</table>";

 
         }
  }






?>
   
        <section id="aa">


               <form  name="filter" id="filter" method="post" action="<?php echo" izlozba.php?page=".$page." "?>">

                <label for="filter">Pogon: </label>
                <input  type="text" id="filter" name="filter" autofocus size="20" maxlength="20" ><br>

                <input id="submit"  name="submit" type="submit" value="Filtriraj" />
                <input  name="reset" type="submit" value="Očisti filter" /><br>
            </form>
        
        </section>
        
    <section style=" right:0; top:0; position:absolute;">
        <button style="width:10vw; height:5vh; font-size:2em;">Toggle Font</button>
    </section>
  
        <script type="text/javascript">
        document.querySelector('button').addEventListener("click", e=>{
  document.body.classList.toggle("od");
});
        </script>


    </section>

    <footer class="spojiSveStupcePodnozja" >
        <address>Kontakt: <a href="mailto:lsedlanic@foi.hr">Leon Sedlanić</a></address>
        <p>&copy; 2021. L. Sedlanić</p>

    </footer>
    </body>
</html>
