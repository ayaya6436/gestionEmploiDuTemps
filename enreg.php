<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=emploidutemps", 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('error') . $e->getMessage();
}


if (isset($_POST['enregistrer'])) {
    if (!empty($_POST['classe']) and !empty($_POST['matiere']) and !empty($_POST['jour']) and !empty($_POST['heure']) and !empty($_POST['matriculeEns'])) {

        //les donnees de l'utilisateur
        $classe = htmlspecialchars($_POST['classe']);
        $matiere = htmlspecialchars($_POST['matiere']);
        $jour = htmlspecialchars($_POST['jour']);
        $heure = htmlspecialchars($_POST['heure']);
        $matriculeEns = htmlspecialchars($_POST['matriculeEns']);

        //inserer l'enseignant dans la base de donnees
        $enreg = $bdd->prepare("INSERT INTO tb_cours ( classe,matiere,jour,heure,matriculeEns) VALUES(?,?,?,?,?)");
        $enreg->execute(array($classe, $matiere, $jour, $heure, $matriculeEns));

        //recuperer les informations de l'enseigant
        $recup = $bdd->prepare("SELECT id,classe,matiere,jour,heure,matriculeEns FROM tb_cours WHERE   classe = ?  AND matiere = ? AND jour = ? AND heure = ? AND matriculeEns = ?  ");
        $recup->execute(array($classe, $matiere, $jour, $heure, $matriculeEns));
        $recup->fetch();
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
    <title>Enregistrenent des seances de cours</title>
</head>

<body>
    <br><br>

    <div class="container" align="center">


        <div>
            <strong style="font-size:30px;"> <b> ENREGISTREMENT DES SEANCES DE COURS</b> </strong>
        </div>




        <div>
            <form method="POST" class=" well col-md-6" autocomplete="off">

                <?php
                if (isset($errorMsg)) {
                    echo '<p>' . $errorMsg . '</p>';
                }
                ?>


                <div class="mb-3"> 
                    <label for="classe" class="control-label">classe</label>
                    <input type="text" class="form-control" placeholder=" choisissez entre 1 et 5" name="classe">
                </div>

                <div class="mb-3">
                    <label for="matiere" class="control-label">Matiere</label>
                    <input type="text" class="form-control" id="matiere" placeholder="bio,dessin,math,lecture,histoire"  name="matiere" required="required">
                </div>


                <div class="mb-3">
                    <label for="jour" class="form-label">jour</label>
                    <input type="text" class="form-control" name="jour"  placeholder="lundi,mardi,mercredi,jeudi,vendredi" required="required">

                </div>



                <div class="mb-3">
                    <label for="heure" class="form-label">heure</label>
                    <input type="text" class="form-control" id="matiere" placeholder="Heure-minute"  name="heure" required="required">

                </div>

                <div class="mb-3">
                    <label for="matriculeEns" class="form-label">matriculeEns</label>
                    <input type="text" id="matriculeEns" class="form-control" name="matriculeEns">
                </div>




                <div class="d-grid gap-2 col-6 mx-auto mb-3">

                    <button class="btn btn-primary  bg-success text-white" type="submit" name="enregistrer">ENREGISTRER</button>

                </div>
                <div>
                    <a href="index.php"> <strong style="font-size:30px;"> <b>Acceuil</b> </strong> </a>
                </div>



            </form>

        </div>

        <div>

            <table class="table p-2 bg-light border table table-striped table-hover">
                <thead class=" bg-success text-white">
                    <tr>
                        <th>Id</th>
                        <th>Classe</th>
                        <th>Matiere</th>
                        <th>Jour</th>
                        <th>heure</th>
                        <th>matriculeEns</th>


                    </tr>
                </thead>
                <tbody>

                    <?php
                    $rows = $bdd->query('SELECT * FROM tb_cours ORDER BY matriculeEns DESC LIMIT 0,100');

                    foreach ($rows as $row) :
                    ?>


                        <tr>

                            <td><?= $row['id']; ?></td>
                            <td><?= $row['classe']; ?></td>
                            <td><?= $row['matiere']; ?> </td>
                            <td><?= $row['jour']; ?> </td>
                            <td><?= $row['heure']; ?> </td>
                            <td><?= $row['matriculeEns']; ?> </td>


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