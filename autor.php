<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <title>Autor</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="title" content="biografija" >
        <meta name="author" content="Leon Sedlanić">
        <meta name="keywords" content="autor, biografija">
        <meta name="description" content="meta podatci">
        <link rel="stylesheet" href="css/lsedlanic.css" type="text/css"/>

        
        <style>
            .wide-spacing{
                letter-spacing: 0.17em;
                word-spacing: 0.39em;
            }
            @font-face {
  font-family: 'opendyslexic';
	src: url('http://dyslexicfonts.com/fonts/OpenDyslexic-Regular.otf');
	font-style: normal;
	font-weight: normal;
} 

@font-face {
	font-family: 'opendyslexic';
	src: url('http://dyslexicfonts.com/fonts/OpenDyslexic-Italic.ttf');
	font-style: italic;
	font-weight: normal;
}

@font-face {
	font-family: 'opendyslexic';
	src: url('http://dyslexicfonts.com/fonts/OpenDyslexic-Bold.ttf');
	font-weight: bold;
	font-style: normal;
} 


@font-face {
	font-family: eulexia;
	src: url('http://dyslexicfonts.com/fonts/eulexia.ttf');
} 

* {
	font-size:1.01em;


	font-family:opendyslexic !important;
}
        </style>
            
        
        
        
    </head>
    <body  class = "resetka">
    <header class="spojiSveStupceZaglavlje">
        <h1 style="color: red">Autor</h1>
        <img alt="multimedija/ja.png" src="multimedija/ja.png" style="width: 10vw; height: 10vh;" />
        <?php
        session_start();
        if((isset($_SESSION["uloga"])) && ($_SESSION["uloga"] == (1 || 2 || 3)))
{
     echo '<br><br><a href="logout.php">Logout</a>';

}
?>
    </header>
    <nav id = "navigacija" class="navigacija">
        <ul>
            <li><a href="index.php">Početna stranica</a></li>
            <li><a href="autor.php">Autor</a> </li>
            <li><a href="galerija.php">Izložbe</a> </li>
            <li><a href="obrasci/Prijava_vlaka.php">Prijava vlaka</a></li>
            <li><a href="obrasci/prijava.php">Prijava</a> </li>
            <li><a href="obrasci/registracija.php">Registracija</a> </li>

        </ul>
    </nav>

    <section id="autor" class="stupacAutor">
        <h1>Osobni podaci</h1>
        <p>Ime: Leon</p>
        <p>Prezime: Sedlanić</p>
        <p>E-mail: lsedlanic@foi.hr</p>
        <p> Indeks : 0016136119</p>
<address style="font-weight: bold;">>Kontakt: <a href="mailto:lsedlanic@foi.hr">Leon Sedlanić</a></address>
        
        <section id="biografija" class="stupacAutor2">
            <h1 >
                Biografija
            </h1>
            <p style="text-align:center;">
                Trivium is an American heavy metal band from Orlando, Florida, formed in 1999. The band comprises vocalist and guitarist Matt Heafy, guitarist Corey Beaulieu, bassist Paolo Gregoletto, and drummer Alex Bent.

                The band's debut album Ember to Inferno was their only album released through Lifeforce Records in 2003. After getting signed to Roadrunner Records in 2004, the band has released eight studio albums and over twenty singles.
                Their ninth studio album, What the Dead Men Say, was released on April 24, 2020. The band has sold over one million albums worldwide and was nominated for a Grammy for the song "Betrayer" at the 61st Annual Grammy Awards in 2019 for Best Metal Performance.
                Trivium has been described as a heavy metal band, and more specifically as metalcore, thrash metal, progressive metal, melodic death metal, death metal, alternative metal[ and groove metal.
                Trivium's music mixes "soaring" and "crushing" riffs, dual guitar harmonies, double bass drum patterns and occasional blast beats and breakdowns that one can expect from the metalcore genre. Vocally Trivium combines both singing along with heavy screaming and growls. 
                Trivium is one of the notable New wave of American heavy metal acts.
                Their style has evolved over the years: from their earliest work on Ember to Inferno right through to In Waves, there is a clear thrash influence from Metallica and Machine Head, as well as a melodic death metal influence from early In Flames.
                Upon the release of their second album Ascendancy, Trivium were identified as melodic metalcore with strong elements of thrash metal, with the third track on the album "Pull Harder on the Strings of Your Martyr" becoming a permanent fixture in the band's set lists and the rest of the album selling itself to gold status.
                Ascendancy was even featured as one of Metal Hammer's Albums of the Decade. Later releases have marked changes in the band. The Crusade was seen as a major shift in musical direction due to the change in vocal style, namely the absence of screaming, and some of the melodies featured.
                The Crusade is a much more thrash-oriented album and lyrical content was also different in direction, citing current affairs, such as famous killings. In Autumn 2008, Trivium released Shogun, which has a heavy Japanese influence on its title track as well as the first single release "Kirisute Gomen", which translates to "authorization to cut and leave".
                Acknowledging Matt Heafy's Japanese heritage, the album also was described more favorably as more their own style, as previous references to Trivium sounding like Metallica had been made on the back of The Crusade.[96] The Crusade made sparing use of seven-string guitars, which were featured heavily on Shogun. Seven-string guitars once again returned on Silence in the Snow, The Sin and the Sentence and What the Dead Men Say.
                On In Waves, the band featured a sound closer to Ascendancy than The Crusade and Shogun. The guitar tuning instead of being in drop D, they went half a step lower to drop C#. The album has several songs, such as 'Built to Fall' or 'Dusk Dismantled', featuring solely clean vocals or screamed vocals from Matt Heafy.
                
            </p>
    
        </section>
    <footer class="spojiAutor">
        <address>Kontakt: <a href="mailto:lsedlanic@foi.hr">Leon Sedlanić</a></address>
        <p>&copy; 2021. L. Sedlanić</p>
    </footer>
    </body>
</html>
