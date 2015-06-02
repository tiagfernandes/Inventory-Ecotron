<?php
    require_once('fonctions.php');
    session_start ();

    if(isset($_GET['delete'])){ //Supprime utilisateur
        $id = $_GET['delete'];
        deleteUtilisateur($id);
    }
    $listeUtilisateur = getAllUtilisateur($pdo);
?>

<!doctype html>
<html lang="fr">

    <head>
    <title>Page Admin</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
        <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <?php require_once('entete.php'); ?>
        <?php if ($_SESSION['role']== "Administrateur") {?>
            <div id="contenu">
                <div id="banniere">
                      Utilisateurs
                </div>

                <table border=2>
                    <th>id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Identifiant</th>
                    <th>Mot de passe</th>
                    <th>Rôle</th>
                    <th>Supprimer</th>

                    <?php foreach ($listeUtilisateur as $cle=>$valeur): ?> <!--Affichage des utilisateur-->
                    <tr>
                        <?php foreach ($valeur as $val): ?>
                            <td><?= htmlentities($val) ?></td>
                        <?php endforeach; ?>

                        <td><a href=admin.php?delete=<?= htmlentities($valeur['idUtilisateur']) ?>
                            onClick="return(confirm('Supprimer <?= $valeur['prenomUtilisateur']  ?> ?'));">Supprimer</a></td>

                    </tr>

                     <?php endforeach; ?>
                </table>
            <input onclick="window.location='add_user.php';"  class="button1" type="submit" value="Ajouter">
        </div>
        <?php }
            else{
                $message='Accès interdit aux utilisateurs';
                echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
                header('refresh:0.01;url=index.php');
            }
        ?>
    </body>
</html>
