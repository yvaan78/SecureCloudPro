<?php
session_start();
$conn = new mysqli("localhost", "yvan", "123456", "SecureCloudPro");
$conn->set_charset("utf8");
$id_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 4;

// On récupère les infos actuelles
$res = $conn->query("SELECT * FROM Utilisateur WHERE NumUtilisateur = $id_user");
$user = $res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $conn->real_escape_string($_POST['nom']);
    $email = $conn->real_escape_string($_POST['email']);
    
    $conn->query("UPDATE Utilisateur SET NomUtilisateur = '$nom', EmailUtilisateur = '$email' WHERE NumUtilisateur = $id_user");
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paramètres - SecureCloud Pro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="display:flex; justify-content:center; align-items:center; height:100vh; background:#f4f7f6;">
    <div style="background:white; padding:30px; border-radius:15px; box-shadow:0 10px 25px rgba(0,0,0,0.1); width:350px;">
        <h2 style="color:#2c5aa0; text-align:center;">⚙️ Paramètres</h2>
        <form method="POST">
            <label style="display:block; margin-top:15px; font-weight:bold;">Nom</label>
            <input type="text" name="nom" value="<?php echo $user['NomUtilisateur']; ?>" style="width:100%; padding:10px; margin-top:5px; border-radius:5px; border:1px solid #ddd;">
            
            <label style="display:block; margin-top:15px; font-weight:bold;">Email</label>
            <input type="email" name="email" value="<?php echo $user['EmailUtilisateur']; ?>" style="width:100%; padding:10px; margin-top:5px; border-radius:5px; border:1px solid #ddd;">
            
            <button type="submit" style="width:100%; background:#2c5aa0; color:white; border:none; padding:12px; margin-top:20px; border-radius:5px; cursor:pointer;">Enregistrer les modifications</button>
            <a href="dashboard.php" style="display:block; text-align:center; margin-top:15px; color:#888; text-decoration:none;">Retour</a>
        </form>
    </div>
</body>
</html>
