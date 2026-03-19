<?php
session_start();
$conn = new mysqli("localhost", "yvan", "123456", "SecureCloudPro");
$conn->set_charset("utf8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $conn->real_escape_string($_POST['nom_tache']);
    $desc = $conn->real_escape_string($_POST['description']);
    $date_fin = $_POST['date_fin'];
    $priorite = $_POST['priorite'];
    
    // On récupère l'utilisateur (on garde l'ID 4 pour tes tests)
    $id_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 4; 

    // Requête SQL (Note l'accent sur TÂCHE)
    $sql = "INSERT INTO TÂCHE (NomTache, DescriptionTache, DateDebutTache, DateFinTache, AvancementTache, PrioriteTache, NumUtilisateur) 
            VALUES ('$nom', '$desc', NOW(), '$date_fin', 0, '$priorite', $id_user)";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php?notif=tache_creee");
    } else {
        echo "Erreur : " . $conn->error;
    }
}
$conn->close();
?>
