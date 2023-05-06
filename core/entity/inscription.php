<?php
    if(
        isset($_POST["prenom"]) && $_POST["prenom"] != "" &&
        isset($_POST["nom"]) && $_POST["nom"] != "" &&
        isset($_POST["email"]) && $_POST["email"] != "" &&
        isset($_POST["confirmation-email"]) && $_POST["confirmation-email"] != "" &&
        isset($_POST["nom_agence"]) && $_POST["nom_egence"] != "" &&
        isset($_POST["n_telephone"]) && $_POST["n_telephone"] != "" &&
        isset($_POST["mdp"]) && $_POST["mdp"] != "" &&
        isset($_POST["confirmation-mdp"]) && $_POST["confirmation-mdp"] != "" 
    ){
        // Tous les champs obligatoires ont été soumis
        // echo "Le formulaire a été rempli";
        
        // on est sûr = champs obligatoires !
        $email = trim($_POST["email"]);
        $confirmation_email = trim($_POST["confirmation_email"]);
        $mdp = trim($_POST["mdp"]);
        $confirmation_mdp = trim($_POST["confirmation_mdp"]);
        
        // champs facultatifs
        $prenom = trim($_POST["prenom"]);
        $nom = trim($_POST["nom"]);
        $nom_agence = trim($_POST["nom_agence"]);
        $n_telephone = trim($_POST["n_telephone"]);
    
        if ($email == $confirmation_email) {
            if ($mdp == $confirmation_mdp) {
                // Tout est ok !
    
                $sql = "INSERT INTO `utilisateurs` (`nom`, `prenom`, `mdp`) VALUES ($email, $mdp, $confirmation_email, $mdp, $confirmation_mdp, $prenom, $nom, $nom_agence, $n_telephone);";
    
                require "core/entity/config.php";
                
                try {
                    $db = new PDO($dsn, $dbuser, $dbpassword);
                    $db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                    $query = $db-> prepare($sql);
                
                    if ($query-> execute()) {
                        $message = "<p>Votre compte à bien été crée </p>";
                    } else {
                        $message = "<p>Votre compte n'a pas pu être crée</p>";
                    }
                    } catch (PDOException $e) {
                        echo $e-> getMessage();
                        $message = "<p>Votre compte n'a pu etre crée</p>";
                    }
                } 
            } 
    }
    
    
    $tilte = "Creez votre compte";

    require_once "../../header.php";
?>
    <main>
        <div class="form_inscri">
            <img src="../../IMG/logo_orange.png" alt="">
            <form action="" method="get" id="form_inscri">
                <div class="inscriBlock1">
                    <input type="text" placeholder="Prénom :">
                    <input type="text" placeholder="Nom :">
                    <input type="email" placeholder="Email :">
                    <input type="email" placeholder="Comfirmation email :">
                </div>
                <div class="inscriBlock2">
                    <input type="text" placeholder="Nom de l'agence :">
                    <input type="number" placeholder="Numéro de téléphone :">
                    <input type="password" placeholder="Mot de passe :">
                    <input type="password" placeholder="Comfirmation du mot de passe :">
                </div>
            </form>
                <button class="inscri"><a href="">VALIDER</a></button>
        </div>
    </main>

<?php
    require_once "../../footer.php";
?>    