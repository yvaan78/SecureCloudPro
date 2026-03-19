<?php
session_start();
$conn = new mysqli("localhost", "yvan", "123456", "SecureCloudPro");
$conn->set_charset("utf8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $conn->real_escape_string($_POST['nom']);
    $desc = $conn->real_escape_string($_POST['description']);
    $debut = $_POST['date_debut'];
    $fin = $_POST['date_fin'];
    $priorite = $_POST['priorite'];

    // On insère avec un avancement de 0% par défaut
    $sql = "INSERT INTO PROJET (NomProjet, DescriptionProjet, DateDebutProjet, DateFinProjet, AvancementProjet, PrioriteProjet) 
            VALUES ('$nom', '$desc', '$debut', '$fin', 0, '$priorite')";

    if ($conn->query($sql)) {
        header("Location: projets.php");
        exit();
    } else {
        echo "Erreur lors de la création : " . $conn->error;
    }
}
?>
