<?php
session_start();
if (!isset($_SESSION['utilisateur_connecte']) || $_SESSION['utilisateur_connecte'] !== true) {
    header("Location: connexion.html");
    exit();
}

$conn = new mysqli("localhost", "yvan", "123456", "SecureCloudPro");
$conn->set_charset("utf8");
$id_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 4; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureCloud Pro - Tableau de bord</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <?php
    // On compte les tâches qui ne sont pas à 100%
    $res_count = $conn->query("SELECT COUNT(*) as total FROM `TÂCHE` WHERE NumUtilisateur = $id_user AND AvancementTache < 100");
    $data_count = $res_count->fetch_assoc();
    $nb_taches = $data_count['total'];
    ?>

    <nav class="navbar">
        <div class="nav-left">
            <a href="parametres.php" style="text-decoration: none; color: inherit;">
                <i class="fas fa-cog icon-gear" style="color: #2c5aa0; cursor: pointer;"></i>
            </a>
            
            <div style="position: relative; display: inline-block; margin-left: 15px;">
                <i class="fas fa-bell icon-bell" style="color: #ffcc00;"></i>
                <?php if($nb_taches > 0): ?>
                    <span style="position: absolute; top: -5px; right: -10px; background: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 10px; font-weight: bold;">
                        <?php echo $nb_taches; ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="nav-right">
            <a href="#">messagerie</a>
            <a href="projets.php">projets</a>
            <a href="offres.html">offres</a>
        </div>
    </nav>

    <div class="dashboard-container">

        <div class="dash-col col-pink" style="display: flex; flex-direction: column; align-items: center; gap: 10px; padding-top: 20px;">
            <i class="fas fa-clipboard-list bg-icon" style="color: #6a0dad; opacity: 0.1;"></i> 
            
            <a href="creer_tache.php" style="text-decoration:none; width: 80%;">
                <button class="dash-btn" style="width: 100%;">Créer une tâche</button>
            </a>

            <div style="width: 80%;">
                <button class="dash-btn" style="width: 100%;">Importer une tâche</button>
            </div>

            <a href="#liste-taches" style="text-decoration:none; width: 80%;">
                <button class="dash-btn" style="width: 100%;">Modifier une tâche</button>
            </a>

            <div id="liste-taches" style="margin-top:20px; text-align:left; width:90%; z-index: 5; position: relative;">
                <h4 style="color: #6a0dad; border-bottom:1px solid #6a0dad; margin-bottom:10px;">Mes Tâches</h4>
                <?php
                $res_taches = $conn->query("SELECT * FROM `TÂCHE` WHERE NumUtilisateur = $id_user ORDER BY DateFinTache ASC");
                if ($res_taches) {
                    while($tache = $res_taches->fetch_assoc()) {
                        $id_t = $tache['NumTache'];
                        $color = ($tache['PrioriteTache'] == 'Haute') ? '#ff4d4d' : '#6a0dad';
                        echo "<div style='background:white; padding:10px; border-radius:8px; margin-bottom:8px; border-left: 5px solid $color; box-shadow: 0 2px 4px rgba(0,0,0,0.05);'>";
                        echo "<strong style='font-size:0.85rem; display:block;'>".htmlspecialchars($tache['NomTache'])."</strong>";
                        echo "<span style='font-size:0.75rem; color:#888;'>Progrès: ".$tache['AvancementTache']."%</span>";
                        echo "<div style='margin-top:5px; display:flex; gap:5px;'>";
                        echo "<a href='update_tache.php?id=$id_t&action=progress' style='background:#6a0dad; color:white; padding:2px 6px; border-radius:4px; text-decoration:none; font-size:9px;'>+10%</a>";
                        echo "<a href='update_tache.php?id=$id_t&action=delete' onclick='return confirm(\"Supprimer la tâche ?\");' style='background:#ccc; color:#333; padding:2px 6px; border-radius:4px; text-decoration:none; font-size:9px;'>Suppr.</a>";
                        echo "</div></div>";
                    }
                }
                ?>
            </div>
        </div>

        <div class="dash-col col-white">
            <div class="logo-container">
                <img src="SecureCloudPro.png" alt="Logo Nuage" class="logo-img" style="width: 300px;">
            </div>
        </div>

        <div class="dash-col col-blue">
            <i class="fas fa-folder-open bg-icon" style="color: #ffcc00; opacity: 0.1;"></i>

            <div class="action-card" style="position: relative; z-index: 2; width: 90%;">
                <a href="creer_document.php" style="text-decoration: none;">
                    <button class="dash-btn" style="background: black; color: white;">Créer un document</button>
                </a>
                
                <form action="upload_document.php" method="POST" enctype="multipart/form-data" style="margin-top: 10px;">
                    <label for="file-upload" class="dash-btn" style="background: black; color: white; display: inline-block; cursor: pointer; text-align: center; width: 100%; box-sizing: border-box; padding: 12px 0;">
                        <i class="fas fa-upload"></i> Importer un document
                    </label>
                    <input id="file-upload" type="file" name="mon_fichier" style="display: none;" onchange="this.form.submit()">
                </form>
                
                <hr style="border: 0; border-top: 1px solid rgba(0,0,0,0.1); margin: 20px 0;">

                <div id="liste-docs">
                    <h4 style="color: #2c5aa0; margin-bottom: 10px; font-family: sans-serif;">Mes Documents</h4>
                    <?php
                    $res = $conn->query("SELECT d.NumDocument, d.NomDocument FROM DOCUMENT d 
                                         INNER JOIN DOCUMENT_UPLOAD du ON d.NumDocument = du.NumDocument 
                                         WHERE du.NumUtilisateur = $id_user");
                    if ($res && $res->num_rows > 0) {
                        while($row = $res->fetch_assoc()): 
                        ?>
                            <div style="background: white; padding: 8px; margin-bottom: 8px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                <span style="font-size: 0.8rem; color: #333; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 60%;">
                                    📄 <?php echo htmlspecialchars($row['NomDocument']); ?>
                                </span>
                                <div style="display: flex; gap: 3px;">
                                    <a href="modifier_document.php?id=<?php echo $row['NumDocument']; ?>" style="background: #333; color: white; padding: 4px 6px; border-radius: 4px; text-decoration: none; font-size: 9px;">Modif</a>
                                    <a href="supprimer_document.php?id=<?php echo $row['NumDocument']; ?>" onclick="return confirm('Supprimer ?');" style="background: #ff4d4d; color: white; padding: 4px 6px; border-radius: 4px; text-decoration: none; font-size: 9px;">Suppr</a>
                                </div>
                            </div>
                        <?php endwhile; 
                    } else { echo "<p style='color: #666; font-size: 0.8rem;'>Aucun document.</p>"; } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="user-avatar">
        <i class="fas fa-user"></i>
    </div>

</body>
</html>
