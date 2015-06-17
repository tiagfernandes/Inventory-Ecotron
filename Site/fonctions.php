<?php
require_once('connexion.php');
session_start ();
header('Content-Type: text/html; charset=UTF-8');

function getAuthentification($login, $pass){
    global $pdo;
        $query = "SELECT * FROM utilisateur WHERE login=:login and password=:pass";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':login', $login);
        $prep->bindValue(':pass', $pass);
        $prep->execute();

        if($prep->rowCount() == 1){
            $result = $prep->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        else{
            return false;
        }
}

function getAllEquipement(){
    global $pdo;
    $query = "SELECT `equipement`.`idEquipement`, CONCAT(`valeurCategorie`,'-',`valeurAcronime`,'-',`equipement`.`idEquipement`), `nomEquipement`,`marque`,`responsable`
              FROM `equipement`, `categorie_etiquette`,  `etiquette_equipement`, `acronime_etiquette`
              WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
              AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
              AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
              AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
              GROUP BY `idEquipement` DESC";

    try {
      $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch ( Exception $e ) {
      die ("Erreur dans la requete ".$e->getMessage());
    }

}

function getAllUtilisateur(){
    global $pdo;
    $query = 'SELECT `idUtilisateur`,`nomUtilisateur`,`prenomUtilisateur`,`email`,`login`,`role` FROM utilisateur';

    try {
      $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch ( Exception $e ) {
      die ("Erreur dans la requete ".$e->getMessage());
    }
}


function deleteUtilisateur($id){
      global $pdo;
      $query = "delete from utilisateur where idUtilisateur = :idUtilisateur ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idUtilisateur', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("erreur dans la requete ".$e->getMessage());
      }
}

function getEtiquetteEquipement(){
    global $pdo;

        $query = "  SELECT CONCAT(`valeurCategorie`,'-',`valeurAcronime`,'-',`equipement`.`idEquipement`)
                    FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`
                    WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
                    AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
                    AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
                    AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
                    ;";

        try {
            $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        catch ( Exception $e ) {
            die ("erreur dans la requete ".$e->getMessage());
        }
}


function getEquipement($idEquipement){
    global $pdo;
        $query = "SELECT * FROM equipement WHERE idEquipement=$idEquipement";

        try {
          $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
          return($result);
        }
        catch ( Exception $e ) {
          die ("Erreur dans la requete ".$e->getMessage());
        }
}

function getNomEquipement($idEquipement){
    global $pdo;
        $query = "SELECT nomEquipement FROM equipement WHERE idEquipement=$idEquipement";

        try {
          $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
          return($result);
        }
        catch ( Exception $e ) {
          die ("Erreur dans la requete ".$e->getMessage());
        }
}

function getEquipementDoc(){
	global $pdo;
        $query = "SELECT CONCAT(`valeurCategorie`,'-',`valeurAcronime`,'-',`equipement`.`idEquipement`), nomEquipement
				  FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`
                  WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
                  AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
                  AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`";

        try {
          $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
          return($result);
        }
        catch ( Exception $e ) {
          die ("Erreur dans la requete ".$e->getMessage());
        }
}

function getDocumentEquipement($idEquipement){
	global $pdo;
        $query = "SELECT `document`.`idDocument`,`nomDocument`, CONCAT(`valeurTypeDoc`,'-',`valeurProcessus`,'-',`valeurSousProcessus`,'-',`valeurCategorie`,'-',`valeurAcronime`,'-',`document`.`idDocument`)
				FROM `equipement`, `equipement_has_document`, `document`, `etiquette_document`, `type_document`, `processus`, `sous_processus`, `etiquette_equipement`, `categorie_etiquette`, `acronime_etiquette`
				WHERE `equipement`.`idEquipement` = `equipement_has_document`.`idEquipement`
				AND `equipement_has_document`.`idDocument` = `document`.`idDocument`
				AND `document`.`idEtiquette_Document` = `etiquette_document`.`idEtiquette_Document`
				AND `etiquette_document`.`idType_Document` = `type_document`.`idType_Document`
				AND `etiquette_document`.`idProcessus` = `processus`.`idProcessus`
				AND `etiquette_document`.`idSous_Processus` = `sous_processus`.`idSous_Processus`
				AND `etiquette_document`.`idEtiquette_Equipement` = `etiquette_equipement`.`idEtiquette_Equipement`
				AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
				AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
				AND `equipement`.`idEquipement`=$idEquipement";

        try {
        	$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        	return($result);
        }
        catch ( Exception $e ) {
        	die ("Erreur dans la requete ".$e->getMessage());
        }
}

function getCategorie() {
	global $pdo;
		$query = "SELECT * FROM categorie_etiquette ORDER BY categorieEtiquette";

		try{
			$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
			return($result);
		}
		catch (Exception $e){
			die ("Erreur dans la requete ".$e->getMessage());
		}
}

function deleteCategorie($id){
      global $pdo;
      $query = "delete from categorie_etiquette where idCategorieEtiquette = :idCategorieEtiquette ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idCategorieEtiquette', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}

function updateCategorie($id){
      global $pdo;
      $query = "update from categorie_etiquette where idCategorieEtiquette = :idCategorieEtiquette ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idCategorieEtiquette', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}


function getEquipementEtiquette($chaineSearchCat, $chaineSearchAcr, $chaineSearchId) {
	global $pdo;
	$query = "SELECT *
				FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`
				WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
				AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
				AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
				AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
				AND valeurCategorie LIKE :chaineSearchCat
				AND valeurAcronime LIKE :chaineSearchAcr
				AND equipement.idEquipement LIKE :chaineSearchId";

	try{
		$prep = $pdo->prepare($query);
		$prep->bindValue(':chaineSearchCat', $chaineSearchCat);
		$prep->bindValue(':chaineSearchAcr', $chaineSearchAcr);
		$prep->bindValue(':chaineSearchId', $chaineSearchId);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}

function getAcronime() {
	global $pdo;
		$query = "SELECT * FROM acronime_etiquette ORDER BY acronimeEtiquette";

		try{
			$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
			return($result);
		}
		catch (Exception $e){
			die ("Erreur dans la requete ".$e->getMessage());
		}
}

function deleteAcronime($id){
      global $pdo;
      $query = "delete from acronime_etiquette where idAcronimeEtiquette = :idAcronimeEtiquette ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idAcronimeEtiquette', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}

function updateAcronime($id){
      global $pdo;
      $query = "update from acronime_etiquette where idAcronimeEtiquette = :idAcronimeEtiquette ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idAcronimeEtiquette', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}

function getAllDocument(){
	global $pdo;
		$query = "SELECT `document`.`idDocument`,`nomDocument`, CONCAT(`valeurTypeDoc`,'-',`valeurProcessus`,'-',`valeurSousProcessus`,'-',`valeurCategorie`,'-',`valeurAcronime`,'-',`document`.`idDocument`), CONCAT(`valeurPlateforme`,'-', `valeurPiece`,'-', `valeurEmplacement`,'-', `valeurSousEmplacement`)
				FROM `document`, `etiquette_document`,`type_document`,`processus`, `sous_processus`, `etiquette_equipement`, `categorie_etiquette`, `acronime_etiquette`,`lieux_document`,`plateforme_archive`, `piece_document`, `emplacement_archive`, `sous_emplacement`
				WHERE `document`.`idEtiquette_Document` = `etiquette_document`.`idEtiquette_Document`
				AND `etiquette_document`.`idType_Document` = `type_document`.`idType_Document`
				AND `etiquette_document`.`idProcessus` = `processus`.`idProcessus`
				AND `etiquette_document`.`idSous_Processus` = `sous_processus`.`idSous_Processus`
				AND `etiquette_document`.`idEtiquette_Equipement` = `etiquette_equipement`.`idEtiquette_Equipement`
				AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
				AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
				AND `document`.`idLieux_Document` = `lieux_document`.`idLieux_Document`
				AND `lieux_document`.`idPlateforme_Archive` = `plateforme_archive`.`idPlateforme_Archive`
				AND `lieux_document`.`idPiece_Document` = `piece_document`.`idPiece_Document`
				AND `lieux_document`.`idEmplacement_Archive` = `emplacement_archive`.`idEmplacement_Archive`
				AND `lieux_document`.`idSous_Emplacement` = `sous_emplacement`.`idSous_Emplacement`";

		try {
		  $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
		  return $result;
		}
		catch ( Exception $e ) {
		  die ("Erreur dans la requete ".$e->getMessage());
		}
}

function getPlanning(){
    global $pdo;
        $query="
            SELECT `idEntretient` as ID , `nomEntretien` as NOM, `dateEntretient` as DATE,
            CONCAT(`utilisateur`.`nomUtilisateur`,'-',`utilisateur`.`prenomUtilisateur`) as CREATEUR
            FROM `entretient`,`utilisateur`
            WHERE `entretient`.`idUtilisateur` = 1
            AND `entretient`.`idUtilisateur`= `utilisateur`.`idUtilisateur`

            UNION

            SELECT `idAnomalie` as ID, `nomAnomalie`as NOM , `dateAnomalie` as DATE ,
            CONCAT(`utilisateur`.`nomUtilisateur`,'-',`utilisateur`.`prenomUtilisateur`) as CREATEUR
            FROM `anomalie`,`utilisateur`
            WHERE `anomalie`.`idUtilisateur` = 1
            AND `anomalie`.`idUtilisateur`= `utilisateur`.`idUtilisateur`

            UNION

            SELECT `idCalibration` as ID, `nomCalibration`as NOM , `dateCalibration` as DATE ,
            CONCAT(`utilisateur`.`nomUtilisateur`,'-',`utilisateur`.`prenomUtilisateur`) as CREATEUR
            FROM `calibration`,`utilisateur`
            WHERE `calibration`.`idUtilisateur` = 1
            AND `calibration`.`idUtilisateur`= `utilisateur`.`idUtilisateur`
            ORDER BY DATE DESC";

		try {
		  $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
		  return $result;
		}
		catch ( Exception $e ) {
		  die ("Erreur dans la requete ".$e->getMessage());
		}
}
