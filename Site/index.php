<!doctype html>
<html lang="fr">

   <head>
    <title>Index</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    
<?php include_once('connexion.php'); ?>
      
    <body>

       <div id="entete">

       </div>

        <div class="">
        <?php
<<<<<<< HEAD
             $req1 = 'SELECT * FROM utilisateur;';
             $result = mysql_query($req1) or die (mysql_error());
             $ligne=mysql_fetch_array($result1);
             echo "<p>Nom utilisateur : ".$ligne[0]."</p>";
=======
            $req1 = 'SELECT * FROM utilisateur';
            $result = $pdo->query(req1);
        while ($row = $result->fetch())
        { ?>

        <p>Nom : <?php>print($row[]);?></p>
>>>>>>> origin/master
        ?>

        <p>Bonjour</p>
        </div>
    </body>
</html>
