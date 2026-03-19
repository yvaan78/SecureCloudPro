<?php
session_start();
if (!isset($_SESSION['utilisateur_connecte'])) { header("Location: connexion.html"); exit(); }

$conn = new mysqli("localhost", "yvan", "123456", "SecureCloudPro");
$conn->set_charset("utf8");
$id_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 4; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Projets - SecureCloud Pro</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .projects-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; padding: 20px; }
        .project-card { background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-top: 5px solid #2c5aa0; transition: transform 0.2s; }
        .project-card:hover { transform: translateY(-5px); }
        .progress-bar { background: #eee; border-radius: 10px; height: 10px; margin: 15px 0; overflow: hidden; }
        .progress-fill { background: #2c5aa0; height: 100%; transition: width 0.5s; }
        .btn-add { background: #2c5aa0; color: white; padding: 10px 20px; border-radius: 20px; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body style="background: #f4f7f6;">

    <nav class="navbar">
        <div class="nav-left"><a href="dashboard.php" style="color:white; text-decoration:none;"><i class="fas fa-arrow-left"></i> Retour au Dashboard</a></div>
        <div class="nav-right">
            <a href="dashboard.php">accueil</a>
            <a href="projets.php" style="border-bottom: 2px solid white;">projets</a>
        </div>
    </nav>

    <div style="padding: 40px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h1 style="color: #2c5aa0;">📁 Gestion des Projets</h1>
          <a href="creer_projet.php" class="btn-add"><i class="fas fa-plus"></i> Nouveau Projet</a>
        </div>

        <div class="projects-grid">
            <?php
            // On récupère les projets (Ici on affiche tout, ou on filtre par utilisateur si tu as une table de liaison)
            $res = $conn->query("SELECT * FROM PROJET");
            if ($res->num_rows > 0) {
                while($p = $res->fetch_assoc()) {
                    $avancement = $p['AvancementProjet'] ?? 0;
                    echo '<div class="project-card">';
                    echo '<h3>' . htmlspecialchars($p['NomProjet']) . '</h3>';
                    echo '<p style="color:#666; font-size:0.9rem; height:40px; overflow:hidden;">' . htmlspecialchars($p['DescriptionProjet']) . '</p>';
                    
                    echo '<div class="progress-bar"><div class="progress-fill" style="width:'.$avancement.'%;"></div></div>';
                    echo '<span style="font-size:0.8rem; font-weight:bold;">' . $avancement . '% terminé</span>';
                    
                    echo '<div style="margin-top:20px; display:flex; justify-content:space-between; align-items:center;">';
                    echo '<span style="font-size:0.7rem; color:#888;">Échéance : ' . $p['DateFinProjet'] . '</span>';
                    echo '<a href="#" style="color:#2c5aa0;"><i class="fas fa-external-link-alt"></i> Voir</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>Aucun projet pour le moment. Commencez par en créer un !</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
