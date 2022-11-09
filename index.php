<?php
require './action.php';
try {
    $bdd = new PDO("mysql:host=localhost;dbname=emploidutemps", 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('error') . $e->getMessage();
}



if (isset($_POST['enregistrer'])) {
    if (!empty($_POST['matricule']) and !empty($_POST['nom']) and !empty($_POST['contact'])) {

        //les donnees de l'utilisateur
        $matricule = htmlspecialchars($_POST['matricule']);
        $nom = htmlspecialchars($_POST['nom']);
        $contact = htmlspecialchars($_POST['contact']);


        //verification si l'enseignant existe 
        $verif = $bdd->prepare('SELECT matricule FROM  tb_enseignant WHERE matricule=?');
        $verif->execute(array($matricule));

        if ($verif->rowCount() == 0) {

            //inserer l'enseignant dans la base de donnees
            $enreg = $bdd->prepare('INSERT INTO tb_enseignant (matricule,nom,contact) VALUES(?,?,?)');
            $enreg->execute(array($matricule, $nom, $contact));

            //recuperer les informations de l'enseigant
            $recup = $bdd->prepare('SELECT matricule,nom,contact FROM tb_enseignant WHERE matricule = ?  AND nom = ? AND contact = ?  ');
            $recup->execute(array($matricule, $nom, $contact));
            $recup->fetch();
        } else {
            $errorMsg = 'l\'enseignant existe deja ';
        }
    } else {
        $errorMsg = 'Veuillez completer tous les champs';
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <title>Acceuil</title>
</head>

<body>
    <br><br>

    <div class="container"  align="center">

        <div >
            <a href="enreg.php" > <strong style="font-size:30px;" > <b>ENREGISTREMENT DES SEANCES DE COURS</b> </strong>  </a>
        </div>


        <div>
            <a href="requete.php"> <strong style="font-size:30px;" > <b>REQUETE</b> </strong>  </a>
        </div>

        <div>
            <form method="POST" class=" well col-md-6" autocomplete="off">

                <?php
                if (isset($errorMsg)) {
                    echo '<p>' . $errorMsg . '</p>';
                }
                ?>



                <div class="mb-3" class="well col-md-6">
                <label for="matricule" class="contro-label">Matricule:</label>
                <input type="text" id="matricule" name="matricule" class="form-control" value ="<?= $matricule;?>" required="required">
            
                </div>

                <div class="mb-3">
                    <label for="nom" class="control-label">Nom:</label>
                    <input type="text" class="form-control" id="nom" name="nom" value ="<?= $nom;?>"   required="required">
                    
                </div>

    

                <div class="mb-3">
                    <label for="contact" class="control-label">Contact:</label>
                    <input type="text" class="form-control" id="contact"  name="contact" value ="<?= $contact;?>"  required="required">
                </div>

                <div class="d-grid gap-2 col-6 mx-auto mb-3">

                   <?php
                   if($modifier==true){?>
                    <button onclick=" return confirm('Voulez vous modifier un enseignant')" class="btn btn-primary  bg-success text-white" type="submit" name="modifier">MODIFIER</button>


                  <?php }else{?>
                    <button class="btn btn-primary  bg-success text-white" type="submit" name="enregistrer">ENREGISTRER</button>

                    <?php } 
                    ?>


                </div>


            </form>

        </div>

<div >
<table class="table p-2 bg-light border table table-striped table-hover">
    <thead class=" bg-success text-white">
        <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Contact</th>
            <th>Actions</th>
        


        </tr>
    </thead>
    <tbody >

        <?php
        $rows = $bdd->query('SELECT * FROM tb_enseignant  ORDER BY matricule DESC LIMIT 0,10');

        foreach ($rows as $row) :
        ?>


            <tr>

                <td ><?= $row['matricule']; ?></td>
                <td><?= $row['nom']; ?></td>
                <td><?= $row['contact']; ?> </td>
                <td > 
                    <button class="btn btn-primary "><a  href="index.php?modifier=<?= $row['matricule'] ?>"class="text-light" ><i class="bi bi-pencil"></i></a></button>
                    <button class="btn btn-danger"><a onclick=" return confirm('Voulez vous supprimer un enseignant')"  href="action.php?supprimer=<?= $row['matricule'] ?>"class="text-light"><i class="bi bi-trash-fill"></i></a></button>
                </td>

            </tr>

        <?php
        endforeach;

        ?>
    </tbody>
</table>

</div>



    </div>

</body>

</html>
