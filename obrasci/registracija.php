
<?php
session_start();
if((isset($_SESSION["uloga"]))) {
	header("Location: ../index.php");
	exit;
}

require_once('../config.php');
require_once("../baza.class.php");
require_once("../PHPmailer/PHPMailerAutoload.php");


?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Registracija</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="title" content="Naslov" >
        <meta name="author" content="Leon Sedlanić">
        <meta name="keywords" content="Register, user">
        <meta name="description" content="meta podatci">
        <link rel="stylesheet" href="../css/lsedlanic.css" type="text/css"/>
                <script src ="../js/script.js"></script>
                
                <script src = "https://code.jquery.com/jquery-3.6.0.min.js"></script>


                

                
    </head>
    <body >

        
        
        <div>
            
            <?php
            if(isset($_POST['submit'])){
                $ime = $_POST['ime'];
                $prezime = $_POST['prez'];
                $email = $_POST['email'];
                $korime = $_POST['korime'];
                $pass1 = $_POST['password'];
                $lozinka2 = $_POST['lozinka2'];
                $pass_hash = hash('sha256', $pass1);
                $i = 2;
                
  $emp_name=trim($_POST["ime"]);

  $emp_email=trim($_POST["email"]);






                
                $db_handle = new Baza();
                $db_handle->spojiDB();

                
                $upit = "SELECT * FROM WebDiP2020x080.korisnik WHERE email = :email";
                $stmt = $db->prepare($upit);
                $stmt->execute(
                            
                        array(
                            
                            'email'    => $email
                        )
                        );
                
                $count = $stmt->rowCount();
                
                
                
     
                
    if($emp_email == ""){
    echo "<span class='status-not-available'> Email not entered.</span>";

}
elseif($count > 0){
    echo "<span class='status-not-available'> Email already in use</span>";
}

 elseif(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $emp_email)){
      echo "<span class='status-not-available'> Email not valid.</span>";

} 
 else if($emp_name =="") {
          echo "<span class='status-not-available'> Name not entered</span>";

  }
 
 else if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["lozinka2"])) {

    if (strlen($_POST["password"]) <= '8') {
       echo "<span class='status-not-available'> Your Password Must Contain At Least 8 Characters!</span>";
    }
    elseif(!preg_match("#[0-9]+#",$pass1)) {
       echo "<span class='status-not-available'>Your Password Must Contain At Least 1 Number!</span>";
        
    }
    elseif(!preg_match("#[A-Z]+#",$pass1)) {
       echo "<span class='status-not-available'>Your Password Must Contain At Least 1 Capital Letter!</span>";
    }
    elseif(!preg_match("#[a-z]+#",$pass1)) {
       echo "<span class='status-not-available'>Your Password Must Contain At Least 1 Lowercase Letter!</span>";
        
    }
    
      else if ($count == 0){
       $sql = "INSERT INTO WebDiP2020x080.korisnik (uloga_id, ime, prezime, korisnicko_ime, lozinka, email) VALUES(?,?,?,?,?,?) ";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([$i, $ime, $prezime, $korime, $pass_hash, $email]);
                if($result){
                    
                    $upit2 = "SELECT * FROM WebDiP2020x080.korisnik WHERE korisnicko_ime = :korime";
                    $izjava = $db->prepare($upit2);
                    $izjava->execute(
                            array(
                                'korime' => $korime
                            )
                            );
                    
                    $red = $izjava->fetch();
                    $current_id = $red['korisnik_id'];
                    $mailbox = $red['email'];
                    
                    
                    $posta = new PHPMailer(true);
                    $actual_link = "http://$_SERVER[HTTP_HOST]/WebDiP/2020_projekti/WebDiP2020x080/obrasci/"."activate.php?id=" . $current_id;
                    
                    try {
                     
    $posta->isSMTP();

    $posta->Host       = 'smtp.gmail.com';                    
    $posta->SMTPAuth   = true;                                  
    $posta->Username   = 'voidxxxxxxxxxx@gmail.com';                    
    $posta->Password   = 'Gh0s7s321123!"';                               
    $posta->SMTPSecure = 'tls1.3';         
    $posta->Port       = 587;                                   

    //Recipients
    $posta->setFrom('voidxxxxxxxxxx@gmail.com', 'Aktivacija računa');   
    $posta->addAddress(''.$mailbox.'');             




    //Content
    $posta->isHTML(true);                                 
    $posta->Subject = 'Aktivacija računa';
    $posta->Body    = 'Click this link to activate your account. <a href=' . $actual_link . '> actual_link </a>';
    $posta->AltBody = 'Click this link to activate your account. <a href=' . $actual_link . '>" . $actual_link . "</a>';

    $posta->send();
    echo 'Korisnik registriran. Email za aktivaciju je poslan.';
    header('Location: prijava.php');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$posta->ErrorInfo}";
        
} 
                    
                 
                   
                    
                }else{
                    echo 'Error.';
                }
  }
    
}   
elseif(!empty($_POST["lozinka2"])) {
    echo "<span class='status-not-available'>Please Check You've Entered Or Confirmed Your Password!</span>";
}




$db_handle->zatvoriDB();
                
     
                
          
            }
            ?>
        </div>
        
   
        <header>
        </header>
    <nav>
        <ul>
            <li><a href="../index.php">Početna stranica</a></li>
            <li><a href="../autor.php">Autor</a> </li>
            <li><a href="../galerija.php">Izložbe</a> </li>
            <li><a href="Prijava_vlaka.php">Prijava vlaka</a></li>
            <li><a href="prijava.php">Prijava</a> </li>
            <li><a href="registracija.php">Registracija</a> </li>
        </ul>
    </nav>

    <section id="sadrzaj3" >
        <h1>Registracija</h1>

        <form name="prijava" id="prijava" method="post" action="registracija.php">

                <label for="ime">Ime: </label>
                <input  type="text" id="ime" name="ime" autofocus size="20" maxlength="20" ><span id="showerror" style="color:red"></span><br>
                <label for="prez">Prezime: </label>
                <input  type="text" id="prez" name="prez" size="20" maxlength="20" ><span id="showerror2" style="color:red"></span><br>
                <label for="korime">Korisničko ime: </label>
                <input name="korime" id="korime" type="text" required="required" maxlength="20" size="20"><div id="uname_response" ></div>
                <label for="email">E-mail adresa: </label>
                <input  type="email" id="email" name="email" size="30" maxlength="35" placeholder="ime.prezime@posluzitelj.xxx" required="required"><span id="showerror3" style="color:red"></span><br>
                <label for="password">Lozinka: </label>
                <input  name ="password" id="password" type="password"  required="required" /><span id="showerror4" style="color:red"></span><br>
                <label for="lozinka2">Potvrdi lozinku: </label>
                <input  name="lozinka2" type="password" id="lozinka2" required="required" /><span id="showerror5" style="color:red"></span><br>
   

                <input id="submit"  name="submit" type="submit" value="Registriraj se" />
                <input  name="reset" type="reset" value="Očisti sve" /><br>
            </form>
        
    </section>
        
                        <script type="text/javascript">
                $(document).ready(function(){

   $("#korime").keyup(function(){

     var username = $(this).val().trim();

     if(username != ''){

        $.ajax({
           url: 'ajaxfile.php',
           type: 'post',
           data: {username:username},
           success: function(response){

              // Show response
              $("#uname_response").html(response);

           }
        });
     }else{
        $("#uname_response").html("");
     }

  });

});
                </script>
                
                
                                                <script type="text/javascript">
                $("#ime").on("keyup", function() {
  realTimeValidateIme();
});
                $("#prez").on("keyup", function() {
  realTimeValidatePrez();
});

                $("#email").on("keyup", function() {
  realTimeValidateEmail();
});
                $("#password").on("keyup", function() {
  realTimeValidatePassword();

});
                  $("#lozinka2").on("keyup", function() {
  realTimeValidateConfirm();
});


function isAlphaOrParen(str) {
  return /^[a-zA-Z()]+$/.test(str);
}


function isEmail(str) {
    return str.match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9_-]+)/gi);
}


function PassIsStrong(str){
    return str.match (/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})/);
}

function PassIsMedium(str){
    return str.match (/((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))/);
}

function confirm(){
    var lozinka = document.getElementById("password").value;
    var inputField = document.getElementById("lozinka2").value;
    return (lozinka == inputField);
}


function realTimeValidateIme() { 
    var inputField = document.getElementById("ime").value;
  
    if(!isAlphaOrParen(inputField))
      document.getElementById("showerror").innerHTML = "Molimo upišite samo slova";
    else 
      document.getElementById("showerror").innerHTML = "";
}
      
function realTimeValidatePrez() { 
    var inputField = document.getElementById("prez").value;
  
    if(!isAlphaOrParen(inputField))
      document.getElementById("showerror2").innerHTML = "Molimo upišite samo slova";
    else 
      document.getElementById("showerror2").innerHTML = "";
}

function realTimeValidateEmail() { 
    var inputField = document.getElementById("email").value;
  
    if(!isEmail(inputField))
      document.getElementById("showerror3").innerHTML = "Molimo upišite pravilnu e-poštu";
    else 
      document.getElementById("showerror3").innerHTML = "";
}


function realTimeValidatePassword() { 
    var inputField = document.getElementById("password").value;
  
    if(PassIsStrong(inputField)){
      document.getElementById("showerror4").innerHTML = "Sigurnost lozinke: jaka";
          document.getElementById("showerror4").style.color = "green";
      }
    else if(PassIsMedium(inputField)){
        document.getElementById("showerror4").innerHTML = "Sigurnost lozinke: srednja";
          document.getElementById("showerror4").style.color = "blue";
    }
    else{
      document.getElementById("showerror4").innerHTML = " Sigurnost lozinke: slaba";
          document.getElementById("showerror4").style.color = "orange";
          }
}

function realTimeValidateConfirm() { 
    
  
    if(!confirm())
      document.getElementById("showerror5").innerHTML = "Lozinke moraju biti iste";
    else 
      document.getElementById("showerror5").innerHTML = "";
}


                </script>

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
