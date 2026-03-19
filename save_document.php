<?php
session_start();

// 1. Connexion (Forcer l'UTF8 pour éviter les accents bizarres)
$conn = new mysqli("localhost", "yvan", "123456", "SecureCloudPro");
$conn->set_charset("utf8");

if ($conn->connect_error) { die("L'accès à la base a échoué"); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // On récupère le nom du document depuis le formulaire
    $nom = $conn->real_escape_string($_POST['nom_doc']);
    
    // On récupère l'ID utilisateur depuis la session
    // Si la session est vide, on cherche le premier utilisateur de la base pour éviter le crash
    if (!isset($_SESSION['user_id'])) {
        $result = $conn->query("SELECT NumUtilisateur FROM Utilisateur LIMIT 1");
        $user = $result->fetch_assoc();
        $id_user = $user['NumUtilisateur'];
    } else {
        $id_user = $_SESSION['user_id'];
    }

    // ÉTAPE 1 : Insertion dans la table DOCUMENT
    // On respecte les majuscules de tes colonnes : NomDocument, TypeDocument, TailleDocument
    $sql1 = "INSERT INTO DOCUMENT (NomDocument, TypeDocument, TailleDocument) 
             VALUES ('$nom', 'txt', 0)";

    if ($conn->query($sql1) === TRUE) {
        $num_doc = $conn->insert_id; // On récupère l'ID du document créé

        // ÉTAPE 2 : Insertion dans DOCUMENT_UPLOAD (Liaison)
        // On respecte : NumUtilisateur, NumDocument
        $sql2 = "INSERT INTO DOCUMENT_UPLOAD (NumUtilisateur, NumDocument) 
                 VALUES ($id_user, $num_doc)";
        
        if ($conn->query($sql2) === TRUE) {
            // Victoire ! On retourne au Dashboard
            header("Location: dashboard.php?notif=doc_cree");
            exit();
        } else {
            echo "Erreur Liaison (Clé étrangère) : " . $conn->error;
        }
    } else {
        echo "Erreur Table DOCUMENT : " . $conn->error;
    }
}
$conn->close();
?>
