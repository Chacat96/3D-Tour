<?php
    $title = "Création de compte";
    require_once "../../header.php";
    require_once "config.php";

    session_start();

    //Détermine les variables
    if(isset($_POST["inscri"])){
        $prenom = ($_POST['prenom']);
        $nom = ($_POST['nom']);
        $societe = ($_POST['societe']);
        $ville = ($_POST['ville']);
        $email = ($_POST['email']);
        $mdp = ($_POST['mdp']);


    
        //Vérifie si les champs ne sont pas vide
        if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['societe']) AND !empty($_POST['ville']) AND !empty($_POST['email']) AND !empty($_POST['mdp'])) {
            // echo "Tous les champs sont remplis";

            //Connexion à la base de données
            $db = new PDO($dsn, $dbuser, $dbpassword);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Requête sql
            $sql = "INSERT INTO utilisateurs (`prenom`, `nom`, `societe`, `ville`, `email`, `mdp`, `role`) VALUES ('$prenom', '$nom', '$societe', '$ville', '$email', '$mdp', 'agent')"; 

            //Prépare la requête sql
            try {
                $query = $db->prepare($sql);

                //Le compte à bien été crée, sinon il y a un problème
                if ($query->execute()) {
                    $message = "<p>Le compte a été créé</p>";
                } else {
                    $message = "<p>Votre compte n'a pas pu être créé</p>";
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                $message = "<p>Votre compte n'a pas pu être créé</p>";
            }
        } else {
            echo "Tous les champs doivent être remplis";
        }
    }
?>
<div class="container_nouvel_editeur">
    <img src="../../IMG/logo_orange.png" alt="">
    <form action="" method="post">
        <div class="infoClient">
            <input type="text" placeholder="Prénom" name="prenom">
            <input type="text" placeholder="Nom" name="nom">
            <input type="text" placeholder="Société" name="societe">
            <input type="text" placeholder="Ville" name="ville">
            <input type="email" placeholder="Email" name="email">
            <input type="password" placeholder="Mot de passe" name="mdp">
        </div>
        <button class="inscri" id="btn_client" type="submit" name="inscri">VALIDER</button>
    </form>
</div>
<?php
    require_once "../../footer.php";
?>