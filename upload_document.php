<?php
session_start();
$conn = new mysqli("localhost", "yvan", "123456", "SecureCloudPro");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['mon_fichier'])) {
    $dossier_destination = "uploads/";
    
    // Créer le dossier s'il n'existe pas
    if (!is_dir($dossier_destination)) {
        mkdir($dossier_destination, 0777, true);
    }

    $nom_fichier = basename($_FILES["mon_fichier"]["name"]);
    $chemin_complet = $dossier_destination . $nom_fichier;
    $type_fichier = pathinfo($chemin_complet, PATHINFO_EXTENSION);
    $taille_fichier = $_FILES["mon_fichier"]["size"];

    // 1. On déplace le fichier du dossier temporaire vers notre dossier uploads
    if (move_uploaded_file($_FILES["mon_fichier"]["tmp_name"], $chemin_complet)) {
        
        // 2. On l'enregistre dans la base de données
        $sql_doc = "INSERT INTO DOCUMENT (NomDocument, TypeDocument, TailleDocument) 
                    VALUES ('$nom_fichier', '$type_fichier', $taille_fichier)";
        
        if ($conn->query($sql_doc)) {
            $last_id = $conn->insert_id;
            $id_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 4;

            // 3. On fait la liaison dans DOCUMENT_UPLOAD
            $conn->query("INSERT INTO DOCUMENT_UPLOAD (NumUtilisateur, NumDocument) VALUES ($id_user, $last_id)");
            
            header("Location: dashboard.php?upload=success");
        }
    } else {
        echo "Erreur lors du transfert du fichier.";
    }
}
?>
