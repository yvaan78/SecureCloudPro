<?php
$conn = new mysqli("localhost", "yvan", "123456", "SecureCloudPro");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // 1. Supprimer la liaison utilisateur (Table DOCUMENT_UPLOAD)
    // On utilise NumDocument car c'est le nom dans ta table
    $conn->query("DELETE FROM DOCUMENT_UPLOAD WHERE NumDocument = $id");
    
    // 2. Supprimer le document (Table DOCUMENT)
    $conn->query("DELETE FROM DOCUMENT WHERE NumDocument = $id");
}

// Redirection forcée pour rafraîchir la liste
header("Location: dashboard.php");
exit();
?>
