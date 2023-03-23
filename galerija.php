<?php


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
       <link rel="stylesheet" href="css/lsedlanic.css" type="text/css"/>
                      <script src="js/script_jquery.js"></script>
                      
                      


    </head>

        
        
        
    <header>
        <h1>Izložbe</h1>

                <?php

        if((isset($_SESSION["uloga"])) && ($_SESSION["uloga"] == (1 || 2 || 3)))
{
     echo '<br><br><a href="logout.php">Logout</a>';

}
?>
        
    </header>
       <body >     
    <nav>
        <ul>
            <li><a href="index.php">Početna stranica</a></li>
            <li><a href="autor.php">Autor</a> </li>
            <li><a href="galerija.php">Izložbe</a> </li>
            <li><a href="obrasci/Prijava_vlaka.php">Prijava vlaka</a></li>
            <li><a href="obrasci/prijava.php">Prijava</a> </li>
            <li><a href="obrasci/registracija.php">Registracija</a> </li>
        </ul>
    </nav>

    <section id="sadrzaj">
 
        <?php
        require_once('config.php');
        
        $sql = "SELECT * FROM WebDiP2020x080.izlozba";
        $statement = $db->prepare($sql);
        $statement->execute();
        $i=0;
        $broj = $statement->rowCount(); 

        while($row = $statement->fetch()){
            $id = $row['izlozba_id'];
            echo '<ul>';
            echo'<li><a href="Izlozbe/izlozba.php?page='.$id.'"   >'.$row['naziv_izlozbe'].' </a></li>';
            echo '</ul>';
            
            

                
            }
            
                        $query = "SELECT * FROM WebDiP2020x080.tip_izlozbe ";
                        $stmt = $db->prepare($query);
                        $stmt->execute();
                
                        
                        
                        $upit = "SELECT * FROM WebDiP2020x080.izlozba ";
                        $izjava = $db->prepare($upit);
                        $izjava->execute();

                        $upit2 = "SELECT * FROM WebDiP2020x080.korisnik WHERE uloga_id = 3 ";
                        $izjava2 = $db->prepare($upit2);
                        $izjava2->execute();
                        
                        
                        $upit3 = "SELECT * FROM WebDiP2020x080.tip_izlozbe ";
                        $izjava3 = $db->prepare($upit3);
                        $izjava3->execute();
                        
        
        ?>
        
     

        
        <?php
        
                            if(($_SESSION["uloga"] === 3) || ($_SESSION["uloga"] === 1)){
                        echo"<div>KREIRAJ IZLOŽBU</div>";
                echo "<form method='POST' action='kreiraj_izlozbu.php'>
                <label for='izlozi'>Naziv izložbe: </label>
                <input type='text' id='izlozi' name='izlozi' size='65' maxlength='65'><br>
                <label for='datum'>Datum izložbe: </label>
                <input type='date'  id='datum' name='datum'   ><br>
                <label for='korisnici'>Maksimalni broj korisnika: </label>
                <input type='number' id='korisnici' name='korisnici'><br>
                
                ";
                        echo"<select name='vrsta' id='vrsta'>";
                                while($row = $stmt->fetch()){
                            echo '<option  value='.$row['tip_izlozbe_id'].'>'.$row['naziv_tipa'].'</option>';
                        }
                echo"<select><br>";
                echo"<input id='submit' name='submit' type='submit' value='Prijavi'>";
        echo"</form>";
                    }
                    
                    
                    
                    
                    
                    
                    if($_SESSION["uloga"] === 1){
                        
                        echo"<div>DODAJ MODERATORA</div>";
                        echo "<form method='POST' action='Izlozbe/dodaj_moderatora.php'>";
                        echo"<select name='naziv' id='naziv'>";
                                while($red = $izjava->fetch()){
                            echo '<option  value='.$red['izlozba_id'].'>'.$red['naziv_izlozbe'].'</option>';
                        }
                echo"<select><br>";
                
                        echo"<select name='moderator' id='moderator'>";
                                while($red2 = $izjava2->fetch()){
                            echo '<option  value='.$red2['korisnik_id'].'>'.$red2['korisnicko_ime'].'</option>';
                        }
                echo"<select><br>";
                        echo"<input id='postavi' name='postavi' type='submit' value='Postavi'>";
                     echo"</form>";
                        
                     
                     
                     
                     
                                             echo"<div>DODAJ TEMATIKU IZLOŽBE</div>";
                        echo "<form method='POST' action='Izlozbe/dodaj_tematiku.php'>
                               <label for='tema'>Tema: </label>
                               <input type='text' id='tema' name='tema' size='65' maxlength='65'><br>";

 
                        echo"<input id='dodaj' name='dodaj' type='submit' value='Dodaj'>";
                     echo"</form>";
                     
                     
                     $count = $izjava3->rowCount();
                     
                     if($count > 0){
                         echo "<div> PREGLED TEMATIKA</div>";
                                                                                 echo "
            <table class='table'>
            <tr>
            <th>ID</th>
            <th>Tematika izložbe</th>
            </tr>";
                         while($red3 = $izjava3->fetch()){
 
                                                         
                             echo ' <tr>
                <td>'.$red3['tip_izlozbe_id'].'</td>
                <td>'.$red3['naziv_tipa'].'</td>
 

    
                </tr>'; 
                             
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
    <footer >
        <address>Kontakt: <a href="mailto:lsedlanic@foi.hr">Leon Sedlanić</a></address>
        <p>&copy; 2021. L. Sedlanić</p>

    </footer>
    </body>
</html>
