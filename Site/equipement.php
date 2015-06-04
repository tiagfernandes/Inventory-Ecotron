<?php
    require_once('fonctions.php');

    session_start ();

    $idEquipement=$_GET['idEquipement']
?>
<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Base de donnée ECOTRON</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
        <?php require_once('entete.php'); ?>
            <div id ="contenu">
                <div id="banniere">Fiche équipement</div>

                    <?php
                        $resultats=$pdo->query("SELECT nomEquipement FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Nom : '.$resultat->nomEquipement.'<br>';
                        }
                        $resultats->closeCursor();
                    ?>

                    <?php
                        $resultats=$pdo->query("SELECT marque FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Marque : '.$resultat->marque.'<br>';
                        }
                        $resultats->closeCursor();
                    ?>

                    <?php
                        $resultats=$pdo->query("SELECT dateAjout FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo "Date d'ajout : ".$resultat->dateAjout."<br>";
                        }
                        $resultats->closeCursor();
                    ?>
                    <?php
                        $resultats=$pdo->query("SELECT prix FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Prix : '.$resultat->prix.' €<br>';
                        }
                        $resultats->closeCursor();
                    ?>
                    <?php
                        $resultats=$pdo->query("SELECT dateFabrication FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Date de fabrication : '.$resultat->dateFabrication.'<br>';
                        }
                        $resultats->closeCursor();
                    ?>
                    <?php
                        $resultats=$pdo->query("SELECT dateReception FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Date de réception : '.$resultat->dateReception.'<br>';
                        }
                        $resultats->closeCursor();
                    ?>
                    <?php
                        $resultats=$pdo->query("SELECT dateMiseService FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Date de mise en service : '.$resultat->dateMiseService.'<br>';
                        }
                        $resultats->closeCursor();
                    ?>
                    <?php
                        $resultats=$pdo->query("SELECT garantie FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Garentie (mois) : '.$resultat->garantie.'<br>';
                        }
                        $resultats->closeCursor();
                    ?>
                    <?php
                        $resultats=$pdo->query("SELECT `nomFournisseur` FROM `equipement`, `fournisseur` WHERE `equipement`.`idFournisseur`=`fournisseur`.`idFournisseur` AND `idEquipement`='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Founisseur : '.$resultat->nomFournisseur.'<br>';
                        }
                        $resultats->closeCursor();
                    ?>
                    <?php
                        $resultats=$pdo->query("SELECT `valeurCategorie`,`valeurAcronime`,`equipement`.`idEquipement` FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`
                    WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
                    AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
                    AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
                    AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette` AND `equipement`.`idEquipement`='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Etiquette : '.$resultat->valeurCategorie.'-';
							echo ''.$resultat->valeurAcronime.'-';
							echo ''.$resultat->idEquipement.'<br/>';
                        }
                        $resultats->closeCursor();
                    ?>

				<a href="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=http://localhost/BDD/Site/equipement.php?idEquipement=<?= $idEquipement ?>"><img src="http://chart.apis.google.com/chart?cht=qr&chs=200x200&chl=http://localhost/BDD/Site/equipement.php?idEquipement=<?= $idEquipement ?>" id="QRCode" title="QR Code"></a>
            </div>
    </body>
</html>