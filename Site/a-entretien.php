<?php
    require_once('fonctions.php');

	$idEquipement = $_GET['idEquipement'];

    $description = $_POST['description'];
    $dateentretien = $_POST['dateentretien'];
    $nom="Entretien";

    if (!empty($description) && !empty($dateentretien)){

        $sql = "INSERT INTO `entretien` (nomEntretien,dateEntretien, description,idUtilisateur) VALUES ('$nom','$dateentretien','$description','".$_SESSION['idUtilisateur']."')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        $idEntretien =$pdo->lastInsertId();

         $sql2 = "INSERT INTO `fiche_de_vie_has_entretien` (idEntretien) VALUES ('$idEntretien')";
         $prep2 = $pdo->prepare($sql2);
         $prep2->execute();

        header('Location: fiche-vie.php?idEquipement='.$idEquipement.'&?entretien=succes');
    }

    else
        header('Location: fiche-vie.php?idEquipement='.$idEquipement.'&?entretien=erreur');

?>