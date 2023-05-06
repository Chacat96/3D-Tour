<?php
$title = "Création de compte";
    require_once "../../header.php";
    require_once "config.php";

    session_start();

    //Détermine les variables
    if(isset($_POST["inscri"])){
        $nom = ($_POST['nom']);
        $prenom = ($_POST['prenom']);
        $abonnement = ($_POST['abonnement']);
        $adresse = ($_POST['adresse']);
        $ville = ($_POST['ville']);
        $cp = ($_POST['code_postal']);
        $siret = ($_POST['siret']);
        $tva = ($_POST['n_tva']);
        $date = ($_POST['date_inscription']);
    
        //Vérifie si les champs ne sont pas vide
        if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['abonnement']) AND !empty($_POST['adresse']) AND !empty($_POST['ville']) AND !empty($_POST['code_postal']) AND !empty($_POST['siret']) AND !empty($_POST['n_tva']) AND !empty($_POST['date_inscription'])) {
            // echo "Tous les champs sont remplis";

            //Connexion à la base de données
            $db = new PDO($dsn, $dbuser, $dbpassword);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Requête sql
            $sql = "INSERT INTO utilisateurs (`nom`, `prenom`, `abonnement`, `adresse`, `ville`, `code_postal`, `siret`, `n_tva`, `date_inscription`, `role`) VALUES ('$nom', '$prenom', '$abonnement', '$adresse', '$ville', '$cp', '$siret', '$tva', '$date', 'directeur')"; 

            //Prépare la requête sql
            try {
                $query = $db->prepare($sql);

                //Le compte à bien été crée, sinon il y a un problème
                if ($query->execute()) {
                    header("Location: connexion_admin.php");
                    exit();
                } else {
                    $message = "<p>Le compte n'a pas pu être créé</p>";
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
    <main>
        <div class="container_creation_client">
            <img src="../../IMG/logo_orange.png" alt="">
            <div class="infoClient">
            <form action="" method="post">
                <input type="text" name="nom" placeholder="Nom du client" required>
                <input type="text" name="prenom" placeholder="Prénom du client">
                <input type="text" name="abonnement" placeholder="Forfait">
                <input type="text" name="adresse" placeholder="Adresse">
                <input type="text" name="ville" placeholder="Ville">
                <input type="text" name="code_postal" placeholder="Code postale">
                <input type="text" name="siret" placeholder="Siret">
                <input type="text" name="n_tva" placeholder="N° de TVA">
                <input type="text" name="date_inscription" placeholder="Date d'inscription">
                <button class="inscri" id="btn_client" type="submit" name="inscri">VALIDER</button>
            </form>
            </div>
                
        </div>
    </main>
<?php
    require_once "../../footer.php";
?>