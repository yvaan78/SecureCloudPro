<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau Document - SecureCloud Pro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page-container" style="display: flex; justify-content: center; padding: 20px;">
        <div class="card" style="width: 100%; max-width: 500px; background: white; padding: 30px; border-radius: 10px; text-align: center;">
            <img src="SecureCloudPro.png" alt="Logo" style="width: 80px;">
            <h2 style="color: #2c5aa0;">Nouveau Document</h2>

            <form action="save_document.php" method="POST" style="text-align: left; margin-top: 20px;">
                <div class="form-group">
                    <label style="font-weight: bold;">NOM DU DOCUMENT</label>
                    <input type="text" name="nom_doc" style="width: 100%; height: 40px; background-color: #e0e0e0; border: none; border-radius: 20px; padding: 0 15px;" required>
                </div>
                
                <div style="margin-top: 20px; text-align: center;">
                    <button type="submit" style="background: white; border: 2px solid #2c5aa0; padding: 10px 30px; border-radius: 10px; cursor: pointer; font-weight: bold;">
                        Enregistrer
                    </button>
                    <br><br>
                    <a href="dashboard.php" style="color: #888; text-decoration: none;">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
    
