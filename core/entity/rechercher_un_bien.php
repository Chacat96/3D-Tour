<?php
    require_once "../../header.php";
?>
    <main>
        <div class="formulaire">
            <form action="critere de bien" method="post" id="form">
                    <div class="checkbox">
                    <label for="bien">Type de bien :</label>
                    
                        <input type="radio" name="select" id="maison" checked>
                        <input type="radio" name="select" id="appart">
                          <label for="maison" class="check option-1">
                             <span>MAISON</span>
                             </label>
                          <label for="appart" class="check option-2">
                             <span class="span_appart">APPARTEMENT</span>
                          </label>
                          </div>
                
                <div id="surface">
                    <label for="surface">Surface :</label>
                    <input type="text"></input>
                </div>
                <div id="pieces">
                    <label for="pieces">Nombre de chambre :</label>
                    <input type="text"></input>
                </div>
                <div id="lieu">
                    <label for="lieu">Lieu :</label>
                    <input type="text"></input>
                </div>
                <div id="prix">
                    <label for="prix">Prix :</label>
                    <input type="text"></input>
                </div>
                <button><a href="biens_dispos.php">RECHERCHER</a></button>
            </form>
        </div>
</div>
    </main>

<?php
    require_once "../../footer.php";
?>