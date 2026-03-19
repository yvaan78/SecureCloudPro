<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau Document - SecureCloud Pro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card" style="margin: 50px auto; max-width: 400px; padding: 20px; border: 1px solid #ccc; border-radius: 10px;">
        <h2>Nouveau Document</h2>
        <form action="sauvegarder_doc.php" method="POST">
            <label>Titre du document :</label><br>
            <input type="text" name="titre_doc" style="width: 100%; margin: 10px 0; padding: 10px;" required>
            <br>
            <button type="submit" style="background: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                Enregistrer sur le Cloud
            </button>
            <a href="dashboard.php" style="margin-left: 10px; color: #666;">Annuler</a>
        </form>
    </div>
</body>
</html>
