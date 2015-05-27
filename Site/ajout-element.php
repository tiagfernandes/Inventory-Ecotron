<?php
    require_once('fonctions.php');

    session_start ();
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Index</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


   <body>

    <?php require_once('entete.php'); ?>
        <div id="contenu">
         <div id="banniere">
              Ajout d'un équipement
          </div>
          <div id="form-ajout"><fieldset>
               <legend>Fiche équipement</legend>

        <form method="post" action="ajout.php">

            <label id="ajout_element">Nom équipement : *</label><input type="text" name="nom_equipement" placeholder="Nom"></p>

            <label id="ajout_element">Etiquette : *</label></p>


                <!-- 1ere listview -->
                <select name="plateforme">
                    <option value=NULL>-- Catégorie --</option>
                    <?php
                    $reponse = $pdo->query('SELECT * FROM categorie_etiquette');
                    while ($donnees = $reponse->fetch()){
                    ?>
                        <option value="<?php echo $donnees['valeur_categorie']; ?>"><?php echo $donnees['valeur_categorie']; ?> - <?php echo $donnees['categorieEtiquette']; ?></option>
                    <?php
                    }
                    ?>
                </select> -


                <!-- 2eme listview -->
                <select name="piece">
                   <option value=NULL>-- Acronime --</option>
                    <?php
                    $reponse = $pdo->query('SELECT * FROM acronime_etiquette');
                    while ($donnees = $reponse->fetch()){
                    ?>
                        <option value="<?php echo $donnees['valeur_acronime']; ?>"><?php echo $donnees['valeur_acronime']; ?> - <?php echo $donnees['acronimeEtiquette']; ?></option>
                    <?php
                    }
                    ?>
                 </select> -
                <input type="text" name="nEquipement" placeholder="Numéro équiepement"></p>



            <label id="ajout_element">Prix : </label><input type="text" name="prix" placeholder="Prix"></p>
            <label id="ajout_element">Marque : </label><input type="text" name="marque" placeholder="Marque"></p>
            <label id="ajout_element">Année de fabrication : </label><input type="text" name="anneefb" placeholder="Année Fabrication"></p>
            <label id="ajout_element">Date mise en service : </label><input type="text" name="datemes" placeholder="Date Mise en service"></p>
            <label id="ajout_element">Durée garantie : </label><input type="text" name="garantie" placeholder="Durée garantie"></p>
            <label id="ajout_element">Type : </label><input type="text" name="type" placeholder="Type">
<<<<<<< HEAD
            </p><div id ="msg">
             <?php
=======

            <div id ="msg">
                </p><?php
>>>>>>> origin/master
                $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                if ($monUrl == "http://localhost/BDD/Site/ajout-element.php?erreur"){
                    echo ("Veuilliez saisir tous les champs ");
                }
            ?>
            </div>
            </p><input class="button" type="submit" value="Ajouter">
          </form>
          </div>
        </fieldset>
        </div>
    </body>
</html>
