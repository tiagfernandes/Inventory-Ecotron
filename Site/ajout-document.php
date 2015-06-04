<?php
    require_once('fonctions.php');

    session_start ();
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Ajout document</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


   <body>

    <?php require_once('entete.php'); ?>
        <div id="contenu">
            <div id="banniere">Ajout d'un document</div>
                <div id="form-ajout">
                    <fieldset><legend>Fiche document</legend>

                        <form method="post" action="ajout_doc.php">
                            <label id="ajout_element">Nom document : *</label><input type="text" name="nom_equipement" placeholder="Nom"></p>
                            <label id="ajout_element">Etiquette document : *</label></p>
                                <!-- 1ere listview -->
                                <select name="">
                                    <option value=NULL>-- Type --</option>
                                    <?php

                                    $reponse = $pdo->query('SELECT * FROM type_document');
                                    while ($donnees = $reponse->fetch()){
                                    ?>
                                        <option value="<?php echo $donnees['idType_Document']; ?>"><?php echo $donnees['valeurTypeDoc']; ?> - <?php echo $donnees['typeDocument']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select> -
                                <select name="">
                                    <option value=NULL>-- Processus --</option>
                                        <?php

                                        $reponse = $pdo->query('SELECT * FROM processus');
                                        while ($donnees = $reponse->fetch()){
                                        ?>
                                            <option value="<?php echo $donnees['idProcessus']; ?>"><?php echo $donnees['valeurProcessus']; ?> - <?php echo $donnees['Processus']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </option>
                                </select> -
                                <select name="">
                                    <option value=NULL>-- Sous-Processus --</option>
                                        <?php

                                        $reponse = $pdo->query('SELECT * FROM processus');
                                        while ($donnees = $reponse->fetch()){
                                        ?>
                                            <option value="<?php echo $donnees['idProcessus']; ?>"><?php echo $donnees['valeurProcessus']; ?> - <?php echo $donnees['Processus']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </option>
                               </select><br/>

                        </form>

                    </fieldset>
                </div>
    </body>
</html>