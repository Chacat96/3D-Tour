<?php
$title = "Ajouter un bien";
    require_once "../../header.php";
    require_once "config.php";

    session_start();

    //Determine les variables
    if(isset($_POST["button_editeur"])) {
        $type_bien = ($_POST["type_bien"]);
        $nombre_chambre = ($_POST["nombre_chambre"]);
        $surface = ($_POST["surface"]);
        $budget = ($_POST["budget"]);
        $etages = ($_POST["etages"]);
        $surface_terrain = ($_POST["surface_terrain"]);
        $adresse = ($_POST["adresse"]);
        $ville = ($_POST["ville"]);

        //Vérifie que les champs ne sont pas vide
        if(!empty($_POST["type_bien"]) AND !empty($_POST["nombre_chambre"]) AND !empty($_POST["surface"]) AND !empty($_POST["budget"]) AND !empty($_POST["etages"])AND !empty($_POST["surface_terrain"])AND !empty($_POST["adresse"]) AND !empty($_POST["ville"])) {

            $db = new PDO($dsn, $dbuser, $dbpassword);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Requête sql
            $sql = "INSERT INTO bien (`type`, `nombre_chambre`, `surface`, `budget`, `etages`, `surface_terrain`, `adresse`, `ville`) VALUES ('$type_bien', '$nombre_chambre', '$surface', '$budget', '$etages', '$surface_terrain', '$adresse', '$ville')"; 
        
            //Préparer la requête à la BDD
            try {
                $query = $db->prepare($sql);

                if($query->execute()) {
                    $message = "<p>Le bien à été crée</p>";
                } else {
                    $message = "<p>Le bien n'a pas pu être crée<p/>";
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
        <div class="ajout_bien">
        <div class="ajout_img">
            <img src="../../IMG/logo_orange.png" alt="">
            <h1>Ajout d'un nouveau bien</h1>
        </div>
        <form action="" method="post">
        <div class="block_ajout_bien">
        <div class="block1_ajout_bien">
        <div class="bien_select">
        <label>Type de bien :</label>
        <select name="type_bien" id="nouveau-bien">
            <option value="appart">Appartement</option>
            <option value="maison">Maison</option>
            <option value="autre">Autre</option>
        </select>
        </div>
        <div class="bien_select">
        <label>Nombre de chambre :</label>
        <select name="nombre_chambre" id="nouveau-bien">
            <option value="appart">1</option>
            <option value="maison">2</option>
            <option value="autre">3</option>
            <option value="autre">4 et +</option>
        </select>
        </div>
        <div class="bien_select">
            <label>Surface :</label>
            <select name="surface" id="nouveau-bien">
                <option value="appart">30 à 60m2</option>
                <option value="maison">70 à 100m2</option>
                <option value="autre">100m2 et +</option>
            </select>
        </div>
        <div class="bien_select">
            <label>Budget :</label>
            <select name="budget" id="nouveau-bien">
                <option value="appart">50 000 à 100 000€</option>
                <option value="maison">100 000 à 150 000€</option>
                <option value="autre">150 000€ et +</option>
            </select>
        </div>
        </div>
        <div class="block2_ajout_bien">
        <div class="bien_select">
            <label>Etages :</label>
            <select name="etages" id="nouveau-bien">
                <option value="appart">1</option>
                <option value="maison">2</option>
                <option value="autre">3 et +</option>
            </select>
        </div>
        <div class="bien_select">
            <label>Surface du terrain :</label>
            <select name="surface_terrain" id="nouveau-bien">
                <option value="appart">60 à 100m2</option>
                <option value="maison">100 à 200m2</option>
                <option value="autre">200m2 et +</option>
            </select>
        </div>
        <div class="bien_select">
            <label>Adresse :</label>
            <input type="text" id="adresse" name="adresse">
        </div>
        <div class="bien_select">
            <label>Ville :</label>
            <input type="text" id="ville" name="ville">
        </div>
        </div>
        </div>
        <button type="submit" class="button_editeur" name="button_editeur">VALIDER</button>
        </form>
        </div>
        
    </main>
<?php
    require_once "../../footer.php";
?>