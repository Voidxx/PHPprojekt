<?php


session_start();


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
    <header class="spojiGalerija">
        <h1>Vlak</h1>
                      <?php

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

    <section id="sadrzaj">
 
<?php

require_once('../config.php');

if(isset($_GET['vlak'])){
        $page = $_GET['vlak'];
    
 
}


                $sql = "SELECT * FROM WebDiP2020x080.vlak a JOIN WebDiP2020x080.tip_vlaka b ON a.tip_vlaka_tip_vlaka_id = b.tip_vlaka_id WHERE vlak_id = :vlak";
            $statement = $db->prepare($sql);
                    $statement->execute(
                            
                            
                            
                            
                            array(
                                'vlak' => $page
                                
                                 
                            )
                            
                            );
                            
              $count = $statement->rowCount();
              
              if($count > 0){
                  while($row = $statement->fetch())
        {        
                            echo "
            <table class='table'>
            <tr>
            <th>ID vlaka</th>
            <th>Naziv vlaka</th>
            <th>Pogon vlaka</th>
            <th>Max.broj putnika</th>
            <th>Max.brzina</th>
            <th>Kratki opis</th>
            </tr>";

            $image_data = $row['Img'];
            $encoded_image = base64_encode($image_data);
            $Hinh = "<a href='vlak.php?vlak=".$row['vlak_id']."'><img src='data:image/jpeg;base64,{$encoded_image}'></a>";
            
            echo ' <tr>
                <td>'.$row['vlak_id'].'</td>
                <td>'.$row['naziv_vlaka'].'</td>
                <td>'.$row['vrsta_pogona'].'</td>
                <td>'.$row['max_broj_putnika'].'</td>
                <td>'.$row['max_brzina'].'</td>
                <td>'.$row['kratki_opis'].'</td>

    
                </tr>'; 
            echo $Hinh;

        
              }
                       echo "</table>";

                        
                       
                       


                       
              
                       
                       
                       
                       
                          
                      }
              
                      if(isset($_SESSION["korisnik_id"])){
                      
                $sql2 = "SELECT * FROM WebDiP2020x080.vlak a JOIN WebDiP2020x080.izlozen b ON a.vlak_id = b.Vlak_vlak_id WHERE a.vlak_id = :vlak AND b.korisnik_id = :korisnik";
            $statement2 = $db->prepare($sql2);
                    $statement2->execute(
                            
                            
                            
                            
                            array(
                                'vlak' => $page,
                                'korisnik' => $_SESSION["korisnik_id"]
                                
                                 
                            )
                            
                      );
                    
                      }
                      
      define('IMAGEPATH', 'slike'.$page.'/');              
                    
foreach(glob(IMAGEPATH.'*') as $filename){
    
            if(strpos($filename, '.jpg') !== false){
    echo"<img src=".$filename."></img>";
            }
            
                        if(strpos($filename, '.jpeg') !== false){
    echo"<img src=".$filename."></img>";
            }
            
                        if(strpos($filename, '.png') !== false){
    echo"<img src=".$filename."></img>";
            }
            
                        if(strpos($filename, '.gif') !== false){
    echo"<img src=".$filename."></img>";
            }
            
        if(strpos($filename, '.mp4') !== false){
    echo"<video width='320' height='240' controls>
  <source src='".$filename."' type='video/mp4'>
</video>";
        }
        
                if(strpos($filename, '.mp3') !== false){
    echo"<audio controls>
  <source src='".$filename."' type='audio/mp3'>
</audio>";
        }
        
                       if(strpos($filename, '.wav') !== false){
    echo"<audio controls>
  <source src='".$filename."' type='audio/wav'>
</audio>";
        }
        
        
                       if(strpos($filename, '.wma') !== false){
    echo"<audio controls>
  <source src='".$filename."' type='audiow/wma'>
</audio>";
        }
        
}
                    
                    if(isset($_SESSION["korisnik_id"])){
                 $count2 = $statement2->rowCount();
                      if($count2 > 0){
                          echo"    <form action='upload.php?broj=".$page."' method='post' enctype='multipart/form-data'>
    <label for='file'><span>Datoteka:</span></label>
    <input type='file' name='file' id='file' /> 
    <br />
    <input type='submit' name='submit' value='Submit' />
    </form>";
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
    <footer class="spojiSveStupcePodnozja" >
        <address>Kontakt: <a href="mailto:lsedlanic@foi.hr">Leon Sedlanić</a></address>
        <p>&copy; 2021. L. Sedlanić</p>

    </footer>
    </body>
</html>
