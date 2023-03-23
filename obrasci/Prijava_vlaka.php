<?php
require_once('../config.php');
require_once("../baza.class.php");

session_start();

if((!isset($_SESSION["uloga"])) || ($_SESSION["uloga"] != (1 || 2 || 3))) {
	header("Location: ../index.php");
	exit;
}





                if(isset($_POST['submit'])){
                $izlozba = $_POST['izlozba'];
                $naziv = $_POST['naziv'];
                $pogon = $_POST['pogon'];
                $brzina = $_POST['brzina'];
                $sjedala = $_POST['sjedala'];
                $opis = $_POST['opis'];
                $image = file_get_contents($_FILES['filename']['tmp_name']);
               
    
                
                        
                            if(isset($_SESSION["korisnik_id"])){
                                $korisnik_id = $_SESSION["korisnik_id"];
                            }
                
                
                
                     $sql = "INSERT INTO WebDiP2020x080.prijava_vlaka (izlozba_id, naziv_vlaka, pogon_vlaka, max_brzina, broj_sjedala, kratki_opis, korisnik_korisnik_id, img) VALUES(:id,:naziv,:pogon,:brzina,:sjedala,:opis,:korisnik,:blob) ";
                     $stmtinsert = $db->prepare($sql);
                     $stmtinsert->bindParam(':blob', $image, PDO::PARAM_LOB);
                     $stmtinsert->bindParam(':id', $izlozba);
                     $stmtinsert->bindParam(':naziv', $naziv);
                     $stmtinsert->bindParam(':pogon', $pogon);
                     $stmtinsert->bindParam(':brzina', $brzina);
                     $stmtinsert->bindParam(':sjedala', $sjedala);
                     $stmtinsert->bindParam(':opis', $opis);
                     $stmtinsert->bindParam(':korisnik', $korisnik_id);
                     $result = $stmtinsert->execute();
                if($result){
                    echo 'Success.';
                   
                    
                }else{
                    echo 'Error.';
                }
                }

                
                              
                            if(isset($_SESSION["korisnik_id"])){
            
            $sql = "SELECT * FROM WebDiP2020x080.prijava_vlaka WHERE korisnik_korisnik_id = :korisnik";
            $statement1 = $db->prepare($sql);
                    $statement1->execute(
                            
                            
                            
                            
                            array(
                                'korisnik' => $_SESSION["korisnik_id"]
                                
                                 
                            )
                            
                            );
            
                    
            
            
            $count = $statement1->rowCount();
            if($count>0){
                    	header("Location: postojeca.php");
            
            }
            
            }
                
                
?>




<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Prijava vlaka</title>
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
        <h1>Prijava vlaka</h1>
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
            <li><a href="Prijava_vlaka.php">Prijava vlaka</a></li>
            <li><a href="prijava.php">Prijava</a> </li>
            <li><a href="registracija.php">Registracija</a> </li>

        </ul>
    </nav>
    <section id="sadrzaj1" style="margin-top: 5vh;" >
        <form id="form1" name="form1" method="post"  action="Prijava_vlaka.php" enctype="multipart/form-data" >
            <p>
                
 
                
                <select name="izlozba" id="izlozba">
                    <?php
                        $query = "SELECT * FROM WebDiP2020x080.izlozba WHERE status = 'otvorene prijave'";
                        $statement = $db->prepare($query);
                        $statement->execute();
                        $i=0;
                        while($row = $statement->fetch()){
                            echo '<option  value='.$row['izlozba_id'].'>'.$row[naziv_izlozbe].'</option>';
                        }
                        
                    ?>
                    
                    
                    

                    
                    
                </select><br>
                <label for="naziv">Naziv vlaka: </label>
                <input type="text" id="naziv" name="naziv" size="65" maxlength="65"><br>
                <label for="pogon">Pogon vlaka</label>
                <select name="pogon" id="pogon">
                    <?php
                        $query = "SELECT * FROM WebDiP2020x080.tip_vlaka ";
                        $statement = $db->prepare($query);
                        $statement->execute();
                      
                        while($row = $statement->fetch()){
                            echo '<option  value='.$row['tip_vlaka_id'].'>'.$row['vrsta_pogona'].'</option>';
                        }
                        
                    ?>
                    
                    
                    

                    
                    
                </select><br>
                <label for="brzina">Maksimalna brzina: </label>
                <input type="text" id="brzina" name="brzina" size="65" maxlength="65"><br>
                <label for="sjedala">Broj sjedala: </label>
                <input type="number" id="sjedala" name="sjedala"><br>
                <label for="filename">Slika:</label>
                <input type="file" accept="image/*,.pdf" id="filename" name="filename"><br>
                <br>                
                Kratki opis: <br>
                <textarea name="opis" id="opis" rows="10" cols="60" maxlength="580" placeholder="Kratak opis vlaka"></textarea><br>
                <input id="submit" name="submit" type="submit" value="Prijavi">
                <input id="reset" type="reset" value=" Inicijaliziraj "> </p>
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
        
    <footer class="spojiSveStupcePodnozja">
        <address>Kontakt: <a href="mailto:lsedlanic@foi.hr">Leon Sedlanić</a></address>
        <p>&copy; 2021. L. Sedlanić</p>

    </footer>
    </body>
</html>
