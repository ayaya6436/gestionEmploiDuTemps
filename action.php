<?php

try {
    $bdd = new PDO("mysql:host=localhost;dbname=emploidutemps",'root','');
    $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('error').$e->getMessage();
    
}

$matricule ="";
$nom ="";
$contact ="";
$modifier = "";

if(isset($_GET['supprimer']) ){
    $matricule = $_GET['supprimer'];

    $req= $bdd->prepare(" DELETE FROM tb_enseignant WHERE matricule= ?");

    $req->execute(array($matricule));

    echo"Eseeignant supprimer avec suuuces";
    header("refresh:0.3 , url= index.php");

}

if(isset($_GET['modifier']) ){
    $matricule = $_GET['modifier'];

    $rows = $bdd->prepare("SELECT * FROM tb_enseignant WHERE matricule = ?");
    $rows->execute(array($matricule));

    foreach ($rows as $row) :
        ?>


                <?= $row['matricule']; ?>
                <?= $row['nom']; ?>
                <?= $row['contact']; ?> 
               <?php $modifier = true; ?>
                

        <?php
        endforeach;
       
    
    

}

if (isset($_POST['modifier'])) {
    if (!empty($_POST['matricule']) and !empty($_POST['nom']) and !empty($_POST['contact'])) {

        //les donnees de l'utilisateur
        $matricule = htmlspecialchars($_POST['matricule']);
        $nom = htmlspecialchars($_POST['nom']);
        $contact = htmlspecialchars($_POST['contact']);

        //Modification

        $modifier = $bdd->prepare("UPDATE tb_enseignant SET nom=?, contact=? WHERE matricule =?");
        $modifier->execute(array($nom,$contact,$matricule));

        echo"Eseeignant modifier avec suuuces";
    header("refresh:0.3 , url= index.php");

        


       

        }
    } else {
        $errorMsg = 'Veuillez completer tous les champs';
    }






