




<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Nepotvrđena prijava</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="title" content="Naslov" >
        <meta name="author" content="Leon Sedlanić">
        <meta name="keywords" content="obrazac">
        <meta name="description" content="obrazac">
        <link rel="stylesheet" href="../css/lsedlanic.css" type="text/css"/>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="../js/script_jquery.js"></script>
                        <script src="../js/script.js"></script>



        
    </head>
    <body>
        
    <header >
        <h1>PRIJAVE</h1>
                      <?php
session_start();
if((isset($_SESSION["uloga"])) && ($_SESSION["uloga"] == (1 || 2 || 3)))
{
     echo '<br><br><a href="../logout.php">Logout</a>';

}




?>
    </header>
    <nav >
        <ul>
            <li><a href="../index.php">Početna stranica</a></li>
            <li><a href="../autor.php">Autor</a> </li>
            <li><a href="../galerija.php">Izložbe</a> </li>
            <li><a href="../obrasci/Prijava_vlaka.php">Prijava vlaka</a></li>
            <li><a href="../obrasci/prijava.php">Prijava</a> </li>
            <li><a href="../obrasci/registracija.php">Registracija</a> </li>

        </ul>
    </nav>
    <section id="sadrzaj1">



<?php
require_once('../config.php');

           if(isset($_GET['id'])){
        $page = $_GET['id'];
           
                
                
            $sql = "SELECT a.prijava_vlaka_id, b.naziv_izlozbe, a.naziv_vlaka, a.pogon_vlaka, a.max_brzina, a.broj_sjedala, a.kratki_opis, a.status, a.img FROM WebDiP2020x080.prijava_vlaka a JOIN WebDiP2020x080.izlozba b ON a.izlozba_id = b.izlozba_id WHERE a.izlozba_id = :stranica";
            $statement = $db->prepare($sql);
                    $statement->execute(
                            
                            
                            
                            
                            array(
                                'stranica' => $page
                                
                                 
                            )
                            
                            );
                            
              $count = $statement->rowCount();
              
              if($count > 0){
                  
      
               while($row = $statement->fetch())
        {   
                   
                   if($row['status'] == 0){
                   
                            echo "
            <table class='table'>
            <tr>
            <th>ID prijave</th>
            <th>Izlozba</th>
            <th>Naziv vlaka</th>
            <th>Pogon vlaka</th>
            <th>Max brzina</th>
            <th>Broj sjedala</th>
            <th>Kratki opis</th>
            <th>Slika</th>
            <th>Potvrdi prijavu</th>         
            <th>Odbij prijavu</th>
            </tr>";
                            
  
            
            $image_data = $row['img'];
            $encoded_image = base64_encode($image_data);
            $Hinh = "<img style='width: 100%;' src='data:image/jpeg;base64,{$encoded_image}'>";
            
            
            
            echo ' <tr>
                <td>'.$row['prijava_vlaka_id'].'</td>
                <td>'.$row['naziv_izlozbe'].'</td>
                <td>'.$row['naziv_vlaka'].'</td>
                <td>'.$row['pogon_vlaka'].'</td>
                <td>'.$row['max_brzina'].'</td>
                <td>'.$row['broj_sjedala'].'</td>
                <td>'.$row['kratki_opis'].'</td>
                <td>'.$Hinh.'</td>
                <td><form action="potvrdi.php?potvrdi='.$row['prijava_vlaka_id'].'" method="post"> <label for="potvrdi"> </label> <input type="submit" name="potvrdi" value="potvrdi" /> </form></td>
                <td><form action="obrisi.php?brisi='.$row['prijava_vlaka_id'].'" method="post"> <label for="obrisi"> </label> <input type="submit" name="obrisi" value="obrisi" /> </form></td>
                
                </tr>';
                   }
                   
                   else{
            echo "
            <table class='table'>
            <tr>
            <th>ID prijave</th>
            <th>Izlozba</th>
            <th>Naziv vlaka</th>
            <th>Pogon vlaka</th>
            <th>Max brzina</th>
            <th>Broj sjedala</th>
            <th>Kratki opis</th>
            <th>Slika</th>
            <th></th>        
            <th>Odbij prijavu</th>
            </tr>";
                            
  
            
            $image_data = $row['img'];
            $encoded_image = base64_encode($image_data);
            $Hinh = "<img style='width: 100%;' src='data:image/jpeg;base64,{$encoded_image}'>";
            
            
            
            echo ' <tr>
                <td>'.$row['prijava_vlaka_id'].'</td>
                <td>'.$row['naziv_izlozbe'].'</td>
                <td>'.$row['naziv_vlaka'].'</td>
                <td>'.$row['pogon_vlaka'].'</td>
                <td>'.$row['max_brzina'].'</td>
                <td>'.$row['broj_sjedala'].'</td>
                <td>'.$row['kratki_opis'].'</td>
                <td>'.$Hinh.'</td>
                <td>PRIJAVA POTVRĐENA</td>
                <td><form action="obrisi.php?brisi='.$row['prijava_vlaka_id'].'" method="post"> <label for="obrisi"> </label> <input type="submit" name="obrisi" value="obrisi" /> </form></td>
                
                </tr>';
                       
                       
                   }
 

        echo "</table>";
        
        

        
        
              }
              
              }
           }
              ?>
</section>
        
           <section style=" right:0; top:0; position:absolute;">
        <button style="width:10vw; height:5vh; font-size:2em;">Toggle Font</button>
    </section>
  
        <script type="text/javascript">
        document.querySelector('button').addEventListener("click", e=>{
  document.body.classList.toggle("od");
});
        </script> 

        
    <footer >
        <address>Kontakt: <a href="mailto:lsedlanic@foi.hr">Leon Sedlanić</a></address>
        <p>&copy; 2021. L. Sedlanić</p>

    </footer>
    </body>
</html>

    