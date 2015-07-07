<?php
    require_once('fonctions.php');

    $listeDocument = getAllDocument($pdo);

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
				<div id="banniere">Document</div>

					<!-- Barre de recherche nom -->
					<form action ="doc.php" method="get">
						<span>Recherche par nom de document :</span>
							<input type="text" id="search" name="searchNom" placeholder="Nom"/>
								<input type="submit" value="Envoyer">
					</form></p>

					<!-- Barre de recherche étiquette -->
					<form action ="doc.php" method="get">
						<span>Recherche document par archive :</span>
							<input type="text" id="search" name="searchPlateforme" placeholder="Plateforme"/> -
							<input type="text" id="searcha" name="searchPiece" placeholder="Pièce"/> -
							<input type="text" id="searcha" name="searchEmplacement" placeholder="Emplacement"/> -
							<input type="text" id="searcha" name="searchSousEmplacement" placeholder="Sous emplacement"/>
								<input type="submit" value="Envoyer">
								<input type="reset" value="Annuler">
					</form></p>

				<hr><!-- Trait de séparation -->

		<!-- Création du tableau-->
					<table class="tableau" border="0.5">
						<th>Id</th>
						<th>Nom document</th>
						<th>Etiquette</th>
						<th>Lieu d'archive</th>


			<?php
					if((isset($_GET['searchPlateforme'])) or (isset($_GET['searchPiece'])) or (isset($_GET['searchEmplacement'])) or (isset($_GET['searchSousEmplacement'])) ) {
						//Si les champs sont remplis, on affiche les équittes correspondantes au champ

						$chaineSearchPlateforme = addslashes($_GET['searchPlateforme']);
						$chaineSearchPiece = addslashes($_GET['searchPiece']);
						$chaineSearchEmplacement = addslashes($_GET['searchEmplacement']);
						$chaineSearchSousEmplacement = addslashes($_GET['searchSousEmplacement']);

							$requete = "SELECT `document`.`idDocument`,`nomDocument`, `valeurTypeDoc`,`valeurProcessus`,`valeurSousProcessus`,`valeurCategorie`,`valeurAcronime`,`document`.`idDocument`, `valeurPlateforme`, `valeurPiece`,`valeurEmplacement`, `valeurSousEmplacement`
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
										AND `lieux_document`.`idSous_Emplacement` = `sous_emplacement`.`idSous_Emplacement`
										AND `valeurPlateforme` LIKE '".$chaineSearchPlateforme."%'
										AND `valeurPiece` LIKE '".$chaineSearchPiece."%'
										AND `valeurEmplacement` LIKE '". $chaineSearchEmplacement."%'
										AND `valeurSousEmplacement` LIKE '". $chaineSearchSousEmplacement."%'
										ORDER BY `document`.`idDocument` DESC";

							// Exécution de la requête SQL
							$resultat = $pdo->query($requete) or die(print_r($pdo->errorInfo()));

							while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
								?>
							<tr style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')">
								<td><?php echo $donnees['idDocument']; ?></td>
								<td><?php echo $donnees['nomDocument']; ?></td>
								<td><?php echo $donnees['valeurTypeDoc'],'-',$donnees['valeurProcessus'],'-',$donnees['valeurSousProcessus'],'-',$donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idDocument'];?></td>
								<td><?php echo $donnees['valeurPlateforme'],'-',$donnees['valeurPiece'],'-',$donnees['valeurSousEmplacement'],'-',$donnees['valeurSousEmplacement'];?></td>

							</tr>
							<?php
							}

					}


					else if((isset($_GET['searchNom']))) {
						//Si les champs sont remplis, on affiche les équittes correspondantes au champ

						$chaineSearchNom = addslashes($_GET['searchNom']);

							$requete = "SELECT `document`.`idDocument`,`nomDocument`, `valeurTypeDoc`,`valeurProcessus`,`valeurSousProcessus`,`valeurCategorie`,`valeurAcronime`,`document`.`idDocument`, `valeurPlateforme`, `valeurPiece`,`valeurEmplacement`, `valeurSousEmplacement`
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
										AND `lieux_document`.`idSous_Emplacement` = `sous_emplacement`.`idSous_Emplacement`
										AND `nomDocument` LIKE '".$chaineSearchNom."%'
										ORDER BY `document`.`idDocument` DESC";

							// Exécution de la requête SQL
							$resultat = $pdo->query($requete) or die(print_r($pdo->errorInfo()));

							while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
								?>
							<tr style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')">
								<td><?php echo $donnees['idDocument']; ?></td>
								<td><?php echo $donnees['nomDocument']; ?></td>
								<td><?php echo $donnees['valeurTypeDoc'],'-',$donnees['valeurProcessus'],'-',$donnees['valeurSousProcessus'],'-',$donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idDocument'];?></td>
								<td><?php echo $donnees['valeurPlateforme'],'-',$donnees['valeurPiece'],'-',$donnees['valeurSousEmplacement'],'-',$donnees['valeurSousEmplacement'];?></td>

							</tr><?php
							}

					}
				else{	?>

						<?php foreach ($listeDocument as $cle=>$valeur): ?> <!--Affichage en tableau des equipement-->
							<tr>
								<form method="get" action="document.php?idDocument">
									<?php foreach ($valeur as $val): ?>
										<?php  $idDocument=$valeur['idDocument']; ?>
											<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $idDocument;?>')"><?= htmlentities($val) ?></td>
									<?php endforeach; ?>
								</form>
							</tr>

						 <?php endforeach; ?>

        			</table><br/>
				<?php
					}
				?>
        	</div>
   </body>
</html>