<?php
    session_start();
?> 

<!DOCTYPE html>
<html lang="de-DE">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>stranded.legends</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="banner">
                <h1>stranded.legends</h1>
                <!-- <p class="subtitle">Destiny is Just the Beginning</p> -->
            </div>
            <div class="symbol">
                <a class="btn facebook" target="_blank"  href="https://www.facebook.com/groups/1156055711233112/?ref=bookmarks">
                    <i class="fab fa-facebook-square"></i>
                </a>
                <a class="btn twitch" target="_blank"  href="https://www.twitch.tv/strandedlegends">
                    <i class="fab fa-twitch"></i>
                </a>
                <a class="btn steam" target="_blank"  href="https://steamcommunity.com/groups/strandedlegends">
                    <i class="fab fa-steam"></i>
                </a>
                <a class="btn twitter" target="_blank"  href="">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="btn youtube" target="_blank"  href="https://www.youtube.com/channel/UCKGrsbJ5jTTwFk_iZm2EOlQ?">
                    <i class="fab fa-youtube"></i>
                </a>
                <a class="btn instagram" target="_blank"  href="">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </header>

    <nav class="nav-bar">
        <ul class="nav-list">
            <li class="nav-item btn-home"><a href="index.html">Home</a></li>
            <li class="nav-item btn-team current"><a href="contact.php">Contact</a></li>
            <li class="nav-item btn-extra"><a href="extra.html">Extra</a></li>
            <li class="nav-item btn-facebook"><a href="galerie.html">Galerie</a></li>
            <li class="nav-item btn-twitch"><a href="ts3.html">TS<sup>3</sup></a></li>
        </ul>
    </nav>

    <div class="formular">
            <h4>Kontaktformular</h4>
            <form class="cf" method="post">
                <div class="half left cf">
                    <input type="text" id="input-name" placeholder="Name">
                    <input type="email" id="input-email" placeholder="Email address">
                    <input type="text" id="input-subject" placeholder="Subject">
                </div>
                <div class="half right cf">
                    <textarea name="message" type="text" id="input-message" placeholder="Message"></textarea>
                </div>
                <div class="captcha-group">
                    <img src="captcha.php" alt="CAPTCHA" class="captcha-image"><i class="fas fa-redo refresh-captcha"></i>
                    <br>
                    <input type="text" id="captcha" name="captcha-challenge" pattern="[A-Z]{6}" placeholder="Bitte CAPTCHA eingeben">
                </div>  
                <input type="submit" value="Submit" id="input-submit">
            </form>
    </div>

    <div id="lueckenfueller"></div>

    <?php

    if($_POST) {
        $input_name = "";
        $input_email = "";
        $input_subject = "";
        $input_message = "";
        $recipient = "clan@strandedlegends.com";

        if(isset($_POST['captcha-challenge']) && $_POST['captcha-challenge'] == $_SESSION['captcha_text']) {

            if(isset($_POST['input-name'])) {
                $input_name = filter_var($_POST['input-name'], FILTER_SANITIZE_STRING);
            }

            if(isset($_POST['input-email'])) {
                $input_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['input-email']);
                $input_email = filter_var($input_email, FILTER_VALIDATE_EMAIL);
            }

            if(isset($_POST['input-subject'])) {
                $input_subject = filter_var($_POST['input-subject'], FILTER_SANITIZE_STRING);
            }

            if(isset($_POST['input-message'])) {
                $input_message = htmlspecialchars($_POST['input-message']);
            }

            $headers  = 'MIME-Version: 1.0' . "\r\n"
            .'Content-type: text/html; charset=utf-8' . "\r\n"
            .'From: ' . $input_email . "\r\n";

            if(mail($recipient, $input_subject, $input_message, $headers)) {
                echo '<p>Thank you for contacting us. You will get a reply within 24 hours.</p>';
            } else {
                echo '<p>We are sorry but the email did not go through.</p>';
            }
        } else {
            echo '<p>You entered an incorrect Captcha.</p>';
        }

    } /* else {
        echo '<p>Something went wrong</p>';
    }
    */

    ?>

    <footer>
        <li class="impressum">
        <a href="impressum.html">Impressum</a></li>
        <p>stranded.legends, Copyright &copy 2019</p>
    </footer>

    <script>
        var refreshButton = document.querySelector(".refresh-captcha");
        refreshButton.onclick = function(){
            document.querySelector(".captcha-image").src = 'captcha.php?' + Date.now();
        }
    </script>
</body>
</html>