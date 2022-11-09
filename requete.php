<?php
include_once './action.php';

try {
    $bdd = new PDO("mysql:host=localhost;dbname=emploidutemps", 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('error') . $e->getMessage();
}

$classe = $_POST['classe'];
$matiere = $_POST['matiere'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <title>Requetes</title>
</head>

<body>
    <br><br>

    <div class="container" align="center">
        <div>
            <a href="index.php"> <strong style="font-size:30px;"> <b>Acceuil</b> </strong> </a>
        </div>


        <div>

            <strong style="font-size:30px; "> <b>LES SEANCES DE COURS DE LA SEMAINE PAR MATIERE ET PAR CLASSE </b> </strong>


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
                    <input type="number" class="form-control" name="classe" placeholder=" choisissez entre 1 et 5" >
                </div>

                <div class="mb-3">
                    <label for="matiere" class="control-label">matiere</label>
                    <input type="text" class="form-control" placeholder="bio,dessin,math,lecture,histoire"  name="matiere">
                </div>




                <div class="d-grid gap-2 col-6 mx-auto mb-3">

                    <button class="btn btn-primary  bg-success text-white" type="submit" name="afficher">AFFICHER</button>

                </div>


                <div align="center">

                    <table class="table p-2 bg-light border table table-striped table-hover">
                        <thead class=" bg-success text-white">
                            <tr>
                                <th>Id</th>
                                <th>Classe</th>
                                <th>Matiere</th>
                                <th>Jour</th>
                                <th>Heure</th>
                                <th>Nom</th>
                                <th>Contact</th>
                                <th>Actions</th>



                            </tr>
                        </thead>
                        <tbody>

                            <?php



                            $rows = $bdd->query("SELECT * FROM  enseignant_cours WHERE classe = '$classe'AND matiere ='$matiere'  ORDER BY jour DESC LIMIT 0,10");

                            foreach ($rows as $row) :
                            ?>


                                <tr>

                                    <td><?= $row['id']; ?> </td>
                                    <td><?= $row['classe']; ?></td>
                                    <td><?= $row['matiere']; ?> </td>
                                    <td><?= $row['jour']; ?> </td>
                                    <td><?= $row['heure']; ?> </td>
                                    <td><?= $row['nom']; ?> </td>
                                    <td><?= $row['contact']; ?> </td>
                                    <td>

                                        <button class="btn btn-danger"><a href="action.php?supprimer=<?= $row['matricule'] ?>" class="text-light"><i class="bi bi-trash-fill"></i></a></button>
                                    </td>



                                </tr>

                            <?php
                            endforeach;

                            ?>
                        </tbody>

                    </table>


                </div>
            </form>



        </div>


        <br><br>

        <div class="container" align="center">

            <div>

                <strong style="font-size:30px; "> <b>EMPLOI DU TEMPS DE LA SEMAINE PAR CLASSE </b> </strong>


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
                        <input type="number" class="form-control" placeholder=" choisissez entre 1 et 5" name="classe">
                    </div>






                    <div class="d-grid gap-2 col-6 mx-auto mb-3">

                        <button class="btn btn-primary  bg-success text-white" type="submit" name="afficher">AFFICHER</button>

                    </div>


                    <div align="center">

                        <table class="table p-2 bg-light border table table-striped table-hover">
                            <thead class=" bg-success text-white">
                                <tr>
                                    <th>Id</th>
                                    <th>Classe</th>
                                    <th>Matiere</th>
                                    <th>Jour</th>
                                    <th>Heure</th>
                                    <th>Nom</th>
                                    <th>Contact</th>
                                    <th>Actions</th>



                                </tr>
                            </thead>
                            <tbody>

                                <?php



                                $rows = $bdd->query("SELECT * FROM  enseignant_cours WHERE classe = '$classe'  ORDER BY jour ,heure ");

                                foreach ($rows as $row) :
                                ?>


                                    <tr>

                                        <td><?= $row['id']; ?> </td>
                                        <td><?= $row['classe']; ?></td>
                                        <td><?= $row['matiere']; ?> </td>
                                        <td><?= $row['jour']; ?> </td>
                                        <td><?= $row['heure']; ?> </td>
                                        <td><?= $row['nom']; ?> </td>
                                        <td><?= $row['contact']; ?> </td>
                                        <td>

                                            <button class="btn btn-danger"><a href="action.php?supprimer=<?= $row['matricule'] ?>" class="text-light"><i class="bi bi-trash-fill"></i></a></button>
                                        </td>



                                    </tr>

                                <?php
                                endforeach;

                                ?>
                            </tbody>

                        </table>


                    </div>
                </form>



            </div>







</body>

</html>