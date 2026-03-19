<?php
$conn = new mysqli("localhost", "yvan", "123456", "SecureCloudPro");
$id = intval($_GET['id']);
$res = $conn->query("SELECT NomDocument FROM DOCUMENT WHERE NumDocument = $id");
$doc = $res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nouveauNom = $conn->real_escape_string($_POST['nouveau_nom']);
    $conn->query("UPDATE DOCUMENT SET NomDocument = '$nouveauNom' WHERE NumDocument = $id");
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="display:flex; justify-content:center; padding:50px;">
    <div class="card" style="width:400px; padding:20px; background:white; border-radius:10px; text-align:center;">
        <h3>Modifier le nom</h3>
        <form method="POST">
            <input type="text" name="nouveau_nom" value="<?php echo $doc['NomDocument']; ?>" 
                   style="width:100%; height:40px; background:#e0e0e0; border:none; border-radius:20px; padding:0 15px; margin-bottom:20px;">
            <button type="submit" style="background:#2c5aa0; color:white; border:none; padding:10px 20px; border-radius:10px; cursor:pointer;">Mettre à jour</button>
            <a href="dashboard.php" style="display:block; margin-top:10px; color:#888;">Annuler</a>
        </form>
    </div>
</body>
</html>

