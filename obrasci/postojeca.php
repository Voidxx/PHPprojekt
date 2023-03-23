




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
        
    <header>
        <h1>Nepotvrđena prijava</h1>
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
            <li><a href="Prijava_vlaka.php">Prijava vlaka</a></li>
            <li><a href="prijava.php">Prijava</a> </li>
            <li><a href="registracija.php">Registracija</a> </li>

        </ul>
    </nav>
    <section id="sadrzaj2">

        <?php
require_once('../config.php');
require_once("../baza.class.php");







if((!isset($_SESSION["uloga"])) || ($_SESSION["uloga"] != (1 || 2 || 3))) {
	header("Location: ../index.php");
	exit;
}

                if(isset($_SESSION["korisnik_id"])){
                                $korisnik_id = $_SESSION["korisnik_id"];
                            }
                
                
            $sql = "SELECT * FROM WebDiP2020x080.prijava_vlaka a JOIN WebDiP2020x080.izlozba b ON a.izlozba_id = b.izlozba_id WHERE a.korisnik_korisnik_id = :korisnik";
            $statement = $db->prepare($sql);
                    $statement->execute(
                            
                            
                            
                            
                            array(
                                'korisnik' => $_SESSION["korisnik_id"]
                                
                                 
                            )
                            
                            );
                            
              $count = $statement->rowCount();
              
              if($count > 0){
                  
      
                  
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
            </tr>";
                            
        while($row = $statement->fetch())
        {
            
            $image_data = $row['img'];
            $encoded_image = base64_encode($image_data);
            $Hinh = "<img src='data:image/jpeg;base64,{$encoded_image}'>";
            
            echo ' <tr>
                <td>'.$row['prijava_vlaka_id'].'</td>
                <td>'.$row['naziv_izlozbe'].'</td>
                <td>'.$row['naziv_vlaka'].'</td>
                <td>'.$row['pogon_vlaka'].'</td>
                <td>'.$row['max_brzina'].'</td>
                <td>'.$row['broj_sjedala'].'</td>
                <td>'.$row['kratki_opis'].'</td>
                <td>'.$Hinh.'</td>

                </tr>';

            $datum = "SELECT * FROM WebDiP2020x080.prijava_vlaka a JOIN WebDiP2020x080.izlozba b ON a.izlozba_id = b.izlozba_id WHERE a.korisnik_korisnik_id = :korisnik AND b.datum_izlozbe > CURDATE()";
            $ovo = $db->prepare($datum);
                    $ovo->execute(
                            
                            
                            
                            
                            array(
                                'korisnik' => $_SESSION["korisnik_id"]
                                
                                 
                            )
                            
                            ); 
            
            $broj = $ovo->rowCount();
            
            if($broj > 0){
            echo "<form action='Deleteprijava.php'>
    <input type='submit' value='Obriši prijavu' />
</form>";
        
            
        }

        echo "</table>";
        
        

        
        
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
        
    <footer class="spojiSveStupcePodnozja">
        <address>Kontakt: <a href="mailto:lsedlanic@foi.hr">Leon Sedlanić</a></address>
        <p>&copy; 2021. L. Sedlanić</p>

    </footer>
    </body>
</html>

