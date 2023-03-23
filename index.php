<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="hr">
    <head>
        

        
        <title>Index</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="title" content="Naslov" >
        <meta name="author" content="Leon Sedlanić">
        <meta name="keywords" content="FOI, WebDiP">
        <meta name="description" content="meta podatci">
        <link rel="stylesheet" href="css/lsedlanic.css" type="text/css"/>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="js/script_jquery.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        
    </head>
 
   <header  >
        <h1 >Vlakovi</h1>
                       <?php
session_start();
if((isset($_SESSION["uloga"])) && ($_SESSION["uloga"] == (1 || 2 || 3)))
{
     echo '<br><br><a href="logout.php">Logout</a>';

}




?>
    </header>


    <body >
            <nav >
        <ul >
            <li><a style="font-size: 1.5em;   " href="index.php">Početna stranica</a></li>
            <li><a style="font-size: 1.5em;   " href="autor.php">Autor</a> </li>
            <li><a style="font-size: 1.5em;   " href="galerija.php">Izložbe</a> </li>
            <li><a style="font-size: 1.5em;   " href="obrasci/Prijava_vlaka.php">Prijava vlaka</a></li>
            <li><a style="font-size: 1.5em;   " href="obrasci/prijava.php">Prijava</a> </li>
            <li><a style="font-size: 1.5em;   " href="obrasci/registracija.php">Registracija</a> </li>
        </ul>
    </nav>

        <div id="pravokutnik"
                 style="position: absolute; top: 2.5vh; border: 2px solid red; width: 10vw; height: calc(5vh);
                 text-align: center; background: white; color: red;" autofocus>
                Pomoć
            </div>
 
        <?php
        if(isset($_SESSION["uloga"])){        
if($_SESSION["uloga"] === 1){
    echo "<form method='POST' action='backup.php' style='border: none;'>";
    echo"<input style='color: black;' id='backup' name='backup' type='submit' value='Stvori backup baze podataka'>";
                     echo"</form>";
    
}
        ?>
        
        <?php
                
if($_SESSION["uloga"] === 1){
    echo "<form method='POST' action='restore.php' style='border: none;'>";
    echo"<input style='color: black;' id='restore' name='restore' type='submit' value='Vrati backup baze podataka'>";
                     echo"</form>";
    
}
        }
        ?>

        

    <section id="statistika" >
        <h1 style="font-size:2.5vh;">Statistika izložbi</h1>
        
        <?php
        require './baza.class.php';
        require_once('config.php');
        

        
        
        
        
        
        
        $i= 1;
        $upit = "SELECT * FROM WebDiP2020x080.izlozba";
        $rezult = $db->prepare($upit);
        $rezult->execute();
        $brojred = $rezult->rowCount();

        
        
        for($i; $i<$brojred;$i++){  
        $upit2 = "SELECT a.naziv_izlozbe, COUNT(DISTINCT b.vlak_vlak_id) as broj_vlakova FROM WebDiP2020x080.izlozba a INNER JOIN WebDiP2020x080.izlozen b ON a.izlozba_id = b.izlozba_izlozba_id WHERE izlozba_izlozba_id = $i";
        $izjava = $db->prepare($upit2);

        
        $izjava->execute();
        
    
        
        while($row = $izjava->fetch()){
        
            if($i==1){
                        echo "
            <table class='table'>
            <tr>
            <th>Naziv_izlozbe</th>
            <th>broj_vlakova</th>
            </tr>";
        
            }
            
            echo ' <tr>
                <td>'.$row['naziv_izlozbe'].'</td>
                <td>'.$row['broj_vlakova'].'</td>
                </tr>';
            
            
        }
        
        }
        echo "</table>";
        
      
  
        
        ?>
        

             <h1 id="asd" style="font-size:2vh;">Trenutno prijavljeni korisnici</h1>
        
        <?php



        $upitkorisnik = "SELECT DISTINCT i.izlozba_id, i.naziv_izlozbe, k.korisnicko_ime, a.Pobjednik, a.vlak_vlak_id FROM WebDiP2020x080.izlozba i, WebDiP2020x080.korisnik k JOIN WebDiP2020x080.izlozen a ON a.korisnik_id = k.korisnik_id WHERE i.izlozba_id = a.izlozba_izlozba_id GROUP BY 1,2,3";

        $rez = $db->prepare($upitkorisnik); 
        $rez->execute();


        
        echo "
            <table class='table'>
            <tr>
            <th>Naziv_izlozbe</th>
            <th>Korisnici</th>
            <th>Pobjednik?</th>
            </tr>";
        while($row = $rez->fetch())
        {
            echo " <tr>
                <td>".$row["naziv_izlozbe"]."</td>
                <td>".$row["korisnicko_ime"]."</td>
                <td><a id='pobjednik' href='Izlozbe/vlak.php?vlak=".$row["vlak_vlak_id"]."'>".$row['Pobjednik']."</a></td>
                </tr>";
                    
           
            
        }
        echo "</table>";
        
  
        
        


        
        
                          require_once 'config.php';
                  if(isset($_SESSION["uloga"])){
                  if($_SESSION["uloga"] === 1){
                      
                      
                        $upit3 = "SELECT * FROM WebDiP2020x080.korisnik ";
                        $izjava3 = $db->prepare($upit3);
                        $izjava3->execute();
                      
                      $count = $izjava3->rowCount();
                                           if($count > 0){
                         echo "<div> PREGLED KORISNIKA</div>";
            echo "
            <table class='table'>
            <tr>
            <th>Korisnicko ime</th>
            <th>email</th>
            <th>status</th>
            <th>Zakljucan</th>
            <th>Otkljucaj korisnika</th>
            <th>Zakljucaj korisnika</th>
            </tr>";
                         while($red3 = $izjava3->fetch()){
 
                                                         
                             echo ' <tr>
                <td>'.$red3['korisnicko_ime'].'</td>
                <td>'.$red3['email'].'</td>
                <td>'.$red3['status'].'</td>
                <td>'.$red3['zakljucan'].'</td>
                <td><form action="otkljucaj_korisnika.php?otkljucaj='.$red3['korisnik_id'].'" method="post"> <label for="otkljucaj"> </label> <input type="submit" name="otkljucaj" value="otkljucaj" /> </form></td>
                <td><form action="zakljucaj_korisnika.php?zakljucaj='.$red3['korisnik_id'].'" method="post"> <label for="zakljucaj"> </label> <input type="submit" name="zakljucaj" value="zakljucaj" /> </form></td>
    
                </tr>'; 
                             
                         }
                         echo "</table>";
                     }
                      
                  }
                  }
        
        
        ?>   
        
               <a href="dokumentacija.html" style="font-size: 1.5em;">DOKUMENTACIJA</a>
    
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
        <address style="font-weight: bold;">>Kontakt: <a href="mailto:lsedlanic@foi.hr">Leon Sedlanić</a></address>
        <p>&copy; 2021. L. Sedlanić</p>

    </footer>
    </body>
</html>

