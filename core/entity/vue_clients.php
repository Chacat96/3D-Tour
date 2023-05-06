<?php
    require_once "../../header.php";
    require_once "config.php";

    try {
        $db = new PDO($dsn, $dbuser, $dbpassword);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Déterminer le rôle de l'utilisateur actuel
        $role = "directeur";

        // Effectuer une requête SQL pour récupérer les champs en fonction du rôle
        $query = $db->prepare('SELECT societe, ville, abonnement FROM utilisateurs WHERE role=:role');
        $query->bindParam(':role', $role);
        $query-> execute();
        ?>
        
        <main>
        <div class="container_vue_clients">
          <img src="../../IMG/logo_orange.png" alt="">
          <div class="list_clients">
            <table>
              <thead>
                <tr>
                  <th>Société</th>
                  <th>Ville</th>
                  <th>Abonnement</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $societe = $row['societe'];
                    $ville = $row['ville'];
                    $abonnement = $row['abonnement'];
                    echo "<tr>";
                    echo "<td><a href='selection_client.php'>$societe</a></td>";
                    echo "<td><a href='selection_client.php'>$ville</a></td>";
                    echo "<td><a href='selection_client.php'>$abonnement</a></td>";
                    echo "</tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </main>
<?php
    } catch(PDOException $e) {
        echo "Erreur : ".$e->getMessage();
        $error = $query->errorInfo();
        var_dump($error);
    }
    
    require_once "../../footer.php";
?>
