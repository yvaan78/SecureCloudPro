<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle Tâche</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="display:flex; justify-content:center; padding:50px; background:#f0f0f0;">
    <div class="card" style="width:400px; padding:30px; background:white; border-radius:15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
       <form action="save_tache.php" method="POST">
    <label>Nom de la tâche</label>
    <input type="text" name="nom_tache" class="form-input" required style="width:100%; margin-bottom:10px;">
    
    <label>Description</label>
    <textarea name="description" style="width:100%; height:80px; border-radius:10px; border:1px solid #ccc; padding:10px;"></textarea>
    
    <label>Priorité</label>
    <select name="priorite" style="width:100%; height:40px; border-radius:10px; margin-bottom:10px;">
        <option value="Basse">Basse</option>
        <option value="Moyenne">Moyenne</option>
        <option value="Haute">Haute</option>
    </select>

    <label>Échéance</label>
    <input type="date" name="date_fin" style="width:100%; height:40px; border-radius:10px; border:1px solid #ccc; margin-bottom:20px;">

    <button type="submit" style="width:100%; background:#6a0dad; color:white; border:none; padding:12px; border-radius:10px; cursor:pointer;">Ajouter</button>
</form>
