<?php
session_start();

if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

if((isset($_SESSION["uloga"]))) {
	header("Location: ../index.php");
	exit;
}

require_once('../config.php');
require_once("../baza.class.php");
 
                $db_handle = new Baza();
                $db_handle->spojiDB();

                
                if(isset($_POST["submit"])){
                    if(empty($_POST["korime"]) || empty($_POST["lozinka"]))
                    {
                    $message ='<label> Potrebno ispuniti polja</label>';
                }
                else
                {
                    $samozaprovjeru2 = "SELECT * FROM WebDiP2020x080.korisnik WHERE korisnicko_ime = :username";
                    $provjera2 = $db->prepare($samozaprovjeru2);
                    $provjera2->execute(
                    
                            
                            
                            
                            array(
                                'username' => $_POST["korime"],
                                 
                            )
                            
                            );
                    
                    
                    
                    $query = "SELECT * FROM WebDiP2020x080.korisnik WHERE korisnicko_ime = :username AND lozinka = :password";
                    $statement = $db->prepare($query);
                    
                    $statement->execute(
                            
                            
                            
                            
                            array(
                                'username' => $_POST["korime"],
                                'password' => hash('sha256', $_POST["lozinka"])
                                 
                            )
                            
                            );
                    
      
                    
                            $row = $statement->fetch();
                            $korisnik_id = $row['korisnik_id'];
        
                               if($row['uloga_id'] == 1){
                            $_SESSION["uloga"] = 1;
                        
                            }
                            else if($row['uloga_id'] == 2){
                                $_SESSION["uloga"] = 2;
                            }
                            else if($row['uloga_id'] == 3){
                                $_SESSION["uloga"] = 3;
                            }
                    
            
                          
                    $red2 = $provjera2->fetch();
 
                    
                    $count = $statement->rowCount();
                    if($count > 0 && $row['zakljucan'] === 'Ne' && $row['aktiviran'] === 'Da'){
                        $_SESSION["korisnik_id"] = $korisnik_id;
                        $query4 = "UPDATE WebDiP2020x080.korisnik SET broj_pokusaja = 0 WHERE korisnicko_ime = :username";
                        $statement4 = $db->prepare($query4);
                        $statement4->execute(
                            
                            
                            
                            
                            array(
                                
                                'username' => $_POST["korime"]
                                
                                 
                            )
                            );
                        header("location:../login_success.php");
                    }
                    elseif($row['aktiviran'] === 'Ne'){
                        echo "Račun nije aktiviran";
                    }
                    
                    else if ($red2['broj_pokusaja'] < 3){
                        $message = '<label>Krivo kor. ime ili lozinka</label>';
                        
                        $query2 = "UPDATE WebDiP2020x080.korisnik SET broj_pokusaja = broj_pokusaja + 1 WHERE korisnicko_ime = :username";
                        $statement2 = $db->prepare($query2);
                        $statement2->execute(
                            
                            
                            
                            
                            array(
                                
                                'username' => $_POST["korime"]
                                
                                 
                            )
                            
                            );
                        
                    $samozaprovjeru = "SELECT * FROM WebDiP2020x080.korisnik WHERE korisnicko_ime = :username";
                    $provjera = $db->prepare($samozaprovjeru);
                    $provjera->execute(
                    
                            
                            
                            
                            array(
                                'username' => $_POST["korime"],
                                 
                            )
                            
                            );
                        
                        $red = $provjera->fetch();
                        
                        if($red['broj_pokusaja'] == 3){
                            
                            $query3 = "UPDATE WebDiP2020x080.korisnik SET zakljucan = 'Da' WHERE korisnicko_ime = :username";
                        $statement3 = $db->prepare($query3);
                        $statement3->execute(
                                
                                array(
                               
                                'username' => $_POST["korime"]
                                
                                 
                            )
                                );
                            
                        }
                        
                    }
                    
                    
                    else{
                        echo '<label>Korisnik zaključan.</label>';
                    }
                }
                }
    $db_handle->zatvoriDB();
                            

?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<html>
    <head>
        <title>Prijava</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="title" content="Naslov" >
        <meta name="author" content="Leon Sedlanić">
        <meta name="keywords" content="login, authentication">
        <meta name="description" content="meta podatci">
        <link rel="stylesheet" href="../css/lsedlanic.css" type="text/css"/>

        
        
    </head>
    <body onload="ReadCookie();">
 


        
        <header></header>
        
        
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
        
        

        
        
        
    <section id="sadrzaj4"  >
        <h1 >Prijava</h1>
  
        
        <?php
            if(isset($message)){
                echo '<label class="text-danger>">'.$message.'</label>';
            }
        ?>

        
        <form name="prijava" id="prijava" method="POST" action="prijava.php" >
            <label for="korime">Korsiničko ime: </label>
            <input name="korime" id="korime" type="text" placeholder="Unesite korisničko ime" autofocus required="required" maxlength="15" size="15" autofocus /><br>
            <label for="lozinka">Lozinka: </label>
            <input name="lozinka" id="lozinka" type="password" required="required" /><br>
            <label for="remember">Zapamti me: </label>
            <input name="remember" id="remember" type="checkbox" /><br>
            <a href="zab_lozinka.php">Zaboravljena lozinka?</a>
            <input name="submit" id="submit" type="submit" value="Prijavi se" onclick="putCookie(prijava)"/>
            <input name="reset" type="reset" value="Inicijaliziraj" />
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
        
        
                <script src="../js/script.js"></script>
        <script type="text/javascript" src="../js/script_jquery.js"></script>  
    <footer class="spojiSveStupcePodnozja">
        <address>Kontakt: <a href="mailto:lsedlanic@foi.hr">Leon Sedlanić</a></address>
        <p>&copy; 2021. L. Sedlanić</p>

    </footer>
    </body>
</html>
