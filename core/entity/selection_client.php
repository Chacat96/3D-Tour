<?php
require_once "../../header.php";
require_once "config.php";

try {
    $db = new PDO($dsn, $dbuser, $dbpassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Déterminer le rôle de l'utilisateur actuel
    $role = "agent";

    // Effectuer une requête SQL pour récupérer les champs en fonction du rôle
    $query = $db->prepare('SELECT societe, nom, prenom, adresse, code_postal, ville, numero_telephone, siret, n_tva, date_inscription, abonnement FROM utilisateurs WHERE role=:role');
    $query->bindParam(':role', $role);
    $query->execute();

    // Afficher tous les résultats
    echo "<main>";
    echo "<div class='container_creation_client'>";
    echo "<img src='../../IMG/logo_orange.png' alt='logo_selection_client'>";
    echo "<table>";
    echo "<thead><tr><th>Société</th><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Code postal</th><th>Ville</th><th>Numéro de téléphone</th><th>SIRET</th><th>N° TVA</th><th>Date d'inscription</th><th>Abonnement</th></tr></thead>";
    echo "<tbody>";

    if($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $societe = $row['societe'];
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $adresse = $row['adresse'];
        $code_postal = $row['code_postal'];
        $ville = $row['ville'];
        $numero_telephone = $row['numero_telephone'];
        $siret = $row['siret'];
        $date_inscription = $row['date_inscription'];
        $n_tva = $row['n_tva'];
        $abonnement = $row['abonnement'];
        echo "<tr>";
        echo "<td><div>$societe</div></td>";
        echo "<td><div>$nom</div></td>";
        echo "<td><div>$prenom</div></td>";
        echo "<td><div>$adresse</div></td>";
        echo "<td><div>$code_postal</div></td>";
        echo "<td><div>$ville</div></td>";
        echo "<td><div>$numero_telephone</div></td>";
        echo "<td><div>$siret</div></td>";
        echo "<td><div>$n_tva</div></td>";
        echo "<td><div>$date_inscription</div></td>";
        echo "<td><div>$abonnement</div></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "</main>";

} catch(PDOException $e) {
    echo "Erreur : ".$e->getMessage();
    $error = $query->errorInfo();
    var_dump($error);
}

require_once "../../footer.php";
?>
