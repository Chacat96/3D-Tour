<?php
$title = "Connexion";
require_once "../../header.php";

session_start();
if(isset($_SESSION["utilisateurs"])) {
    // var_dump($_SESSION["utilisateurs"]);
  } else {
    echo "La variable de session 'utilisateurs' n'est pas définie";
  }

  //On détermine si email et password existe
if (
    isset($_POST["email"]) && $_POST["email"] != "" &&
    isset($_POST["password"]) && $_POST["password"] != ""
) {

    //On crée les variables
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    //On appel le fichier config
    require_once "../../core/entity/config.php";

    //On se connecte à la base de données
    try {
        $db = new PDO($dsn, $dbuser, $dbpassword);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

   // Requête sql
$sql = "SELECT * FROM `utilisateurs` WHERE email = :email";

// Prépare la requête sql
$query = $db->prepare($sql);
$query->bindParam(":email", $email, PDO::PARAM_STR);

// Exécute la requête sql
$query->execute();

// Récupération de l'utilisateur correspondant à l'email fourni
$user = $query->fetch();

// Vérification du rôle de l'utilisateur et redirection vers la page appropriée
if ($user && $user['role'] == 'admin') {
    header('Location: connexion_admin.php');
    exit();
} elseif ($user && $user['role'] == 'directeur') {
    header('Location: connexion_directeur.php');
    exit();
} elseif ($user && $user['role'] == 'agent') {
    header('Location: ajout_bien_vue_editeur.php');
    exit();
} else {
    // Les informations d'identification sont incorrectes, affichage d'un message d'erreur
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}

// Vérification des informations d'identification de l'utilisateur
if ($user && password_verify($password, $user['password'])) {
    // Les informations d'identification sont valides, redirection vers la page d'accueil
    header("Location: /3D_TOUR_VERS3/index.php");
    exit();
    } else {
        $message = "<p>Identifiants incorrects</p>";
    }
}
?>
 <main>
    <form action="" method="post" class="connect">
        <div class="connect">
            <img src="../../IMG/logo_orange.png" alt="">
            <input type="email" placeholder="Nom d'utilisateur" name="email">
            <input type="password" placeholder="Mot de passe" name="password">
            <button type="submit" class="connexion">CONNEXION</button>
        </div>
    </form>
</main> 

<?php require_once "../../footer.php"; ?>
