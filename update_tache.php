<?php
session_start();
$conn = new mysqli("localhost", "yvan", "123456", "SecureCloudPro");

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action == 'progress') {
        // On augmente l'avancement de 10, sans dépasser 100
        $conn->query("UPDATE TÂCHE SET AvancementTache = LEAST(AvancementTache + 10, 100) WHERE NumTache = $id");
    } 
    elseif ($action == 'delete') {
        // On supprime la tâche
        $conn->query("DELETE FROM TÂCHE WHERE NumTache = $id");
    }
}

header("Location: dashboard.php");
exit();
?>
