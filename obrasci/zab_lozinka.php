
<?php

require_once("../config.php");
require_once("../baza.class.php");
require_once("../PHPmailer/PHPMailerAutoload.php");


$password = rand(999, 99999);
$password_hash = hash('sha256', ($password));

                if(isset($_POST["submit"])){
                    if(empty($_POST["email"]))
                    {
                    $message ='<label> Potrebno ispuniti polje</label>';
                }
                
                else{
                    $mailbox = $_POST["email"];
                    $query = "UPDATE WebDiP2020x080.korisnik SET lozinka = :password WHERE email = :mail";
                    $statement = $db->prepare($query);
                    
                    $statement->execute(
                            
                            
                            
                            
                            array(
                                'password' => $password_hash,
                                 'mail'    => $_POST['email']
                            )
                            
                            );
                    
                         



$mail = new PHPMailer(true);

try {

    $mail->isSMTP();

    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'voidxxxxxxxxxx@gmail.com';                     
    $mail->Password   = 'Gh0s7s321123!"';                             
    $mail->SMTPSecure = 'tls1.3';        
    $mail->Port       = 587;                                  

    $mail->setFrom('voidxxxxxxxxxx@gmail.com', 'Nova lozinka');  
    $mail->addAddress(''.$mailbox.'');               




    $mail->isHTML(true);                                  
    $mail->Subject = 'Nova lozinkat';
    $mail->Body    = 'Lozinka: '.$password.'';
    $mail->AltBody = 'Lozinka: '.$password.'';

    $mail->send();
    echo 'Message has been sent';
    header('Location: prijava.php');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        
} 
 
 
 
 
 
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
        <title>Zaboravljena lozinka</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="title" content="Naslov" >
        <meta name="author" content="Leon Sedlanić">
        <meta name="keywords" content="login, authentication">
        <meta name="description" content="meta podatci">
        <link rel="stylesheet" href="../css/lsedlanic.css" type="text/css"/>
        

    <script src="../javascript/lsedlanic_jquery.js"></script>
        
    </head>
    <body>
    <header >
        <h1>Prijava</h1>
  
    </header>
    <nav >
        <ul>
            <li><a href="../index.php">Početna stranica</a></li>
            <li><a href="../autor.php">Autor</a> </li>
            <li><a href="../galerija.php">Galerija</a> </li>
            <li><a href="Prijava_vlaka.php">Prijava vlaka</a></li>
            <li><a href="prijava.php">Prijava</a> </li>
            <li><a href="registracija.php">Registracija</a> </li>
        </ul>
    </nav>
    <section id="sadrzaj3" class="spojiStupce" >
        <h2 >Prijava</h2>
        <form name="zab" id="zab" method="POST" action="zab_lozinka.php">
                <label for="email">E-mail adresa: </label>
                <input  type="email" id="email" name="email" size="30" maxlength="35" placeholder="ime.prezime@posluzitelj.xxx" required="required"><br>
            <input name="submit" type="submit" value="Pošalji poštu" />
        </form>
    </section>
    <footer class="spojiSveStupcePodnozja">
        <address>Kontakt: <a href="mailto:lsedlanic@foi.hr">Leon Sedlanić</a></address>
        <p>&copy; 2021. L. Sedlanić</p>

    </footer>
    </body>
</html>
