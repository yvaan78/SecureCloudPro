<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau Projet - SecureCloud Pro</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body style="background: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">

    <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 450px;">
        <h2 style="color: #2c5aa0; text-align: center; margin-bottom: 30px;">Lancer un Nouveau Projet</h2>
        
        <form action="save_projet.php" method="POST">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Nom du projet</label>
            <input type="text" name="nom" placeholder="Ex: Audit de sécurité" required 
                   style="width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">

            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Description</label>
            <textarea name="description" rows="3" placeholder="Objectifs du projet..." 
                      style="width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;"></textarea>

            <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                <div style="flex: 1;">
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Date de début</label>
                    <input type="date" name="date_debut" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
                <div style="flex: 1;">
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Date de fin</label>
                    <input type="date" name="date_fin" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
            </div>

            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Priorité</label>
            <select name="priorite" style="width: 100%; padding: 12px; margin-bottom: 30px; border: 1px solid #ddd; border-radius: 8px;">
                <option value="Basse">Basse</option>
                <option value="Moyenne">Moyenne</option>
                <option value="Haute">Haute</option>
                <option value="Critique">Critique</option>
            </select>

            <button type="submit" style="width: 100%; background: #2c5aa0; color: white; border: none; padding: 15px; border-radius: 10px; font-weight: bold; cursor: pointer; font-size: 1rem;">
                Créer le projet
            </button>
            <a href="projets.php" style="display: block; text-align: center; margin-top: 15px; color: #888; text-decoration: none;">Annuler</a>
        </form>
    </div>

</body>
</html>
