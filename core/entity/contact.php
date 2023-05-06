<?php
    require_once "../../header.php";
    
if(!empty($_POST["mailform"])) {

    if(!empty($_POST["nom"]) AND !empty($_POST["email"]) AND !empty($_POST["message"])) {
        $header="MIME-Version: 1.0\r\n";
        $header.="From:<test.3tour@outlook.fr"."\n";
        $header.="Content-Type:text/html; charset='uft-8'"."\n";
        $header.='Content-Transfer-Encoding: 8bit';

        $message='
    <html>
         <body>
            <div align="center">
            <hr>
            <u>Nom de l\'expéditeur :</u>'.$_POST['nom'].'<br>
            <u>Email de l\'expéditeur :</u>'.$_POST['email'].'<br>
            </div>
            '.nl2br($_POST['message']).'
          </body>
    </html>
    ';

    mail("test.3tour@outlook.fr", "Contact - 3D Tour", $message, $header);
    $msg="Votre message à bien été envoyé";

    } else {
        $msg = "Tous les champs doivent être complété";
    }
} 

$title = "Formulaire de contact";
?>
    <main>
        <div class="contact">
            <img src="../../IMG/logo_orange.png" alt="" id="logo_form">
            <form action="" method="post" id="contact">
                <div class="un">
                    <label for="nom">VOTRE NOM :</label>
                    <input type="text" name="nom" value="<?php if(isset($_POST['nom'])) {echo $_POST['nom'];}  ?>">
                </div>
                <div class="un">
                    <label for="mail">VOTRE EMAIL :</label>
                    <input type="text" name="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];}  ?>">
                </div>
                <div class="un">
                    <label for="objet">OBJET :</label>
                    <input type="text" id="objet" name="message"><?php if(isset($_POST['message'])) {echo $_POST['message'];}  ?>
                </div>
                <div id="btn">
                    <input type="submit" value="Envoyer" class="bouton" name="mailform">
                </div>
            </form>
        </div>
    </main>
    <?php 
        if(isset($msg)) {
            echo $msg;
        }
        ?>
    
<?php
    require_once "../../footer.php";
?>