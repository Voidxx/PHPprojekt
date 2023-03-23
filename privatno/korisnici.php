<?php



?>



<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <title>Korisnici</title>    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="title" content="popis slika" >
        <meta name="author" content="Leon Sedlanić">
        <meta name="keywords" content="slike">
        <meta name="description" content="meta podatci">
       <link rel="stylesheet" href="../css/lsedlanic.css" type="text/css"/>
                      <script src="../js/script_jquery.js"></script>
                      
                      


    </head>

        
        
        
    <header>
        <h1>Korisnici</h1>


        
    </header>
       <body >     
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

    <section id="sadrzaj1">
 
        
        <?php
        require_once ('../config.php');
        
        
        $korisnici = "SELECT korisnicko_ime, ime, prezime, email, lozinka FROM WebDiP2020x080.korisnik";
        $ispisi = $db->prepare($korisnici);
        $ispisi->execute();
        
                                echo "
            <table class='table'>
            <tr>
            <th>Korisnicko ime</th>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Email</th>
            <th>Lozinka</th>
            </tr>";
        
        while($ima = $ispisi->fetch()){
            
                       

            
            
            echo ' <tr>
                <td>'.$ima['korisnicko_ime'].'</td>
                <td>'.$ima['ime'].'</td>
                <td>'.$ima['prezime'].'</td>4
                <td>'.$ima['email'].'</td>
                <td>'.$ima['lozinka'].'</td>
                </tr>';
            
            
        }
        
        
        echo "</table>";
            
        

        ?>
 
    </section>
  
    <footer >
        <address>Kontakt: <a href="mailto:lsedlanic@foi.hr">Leon Sedlanić</a></address>
        <p>&copy; 2021. L. Sedlanić</p>

    </footer>
    </body>
</html>
