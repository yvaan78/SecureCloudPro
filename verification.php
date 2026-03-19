<?php
// On démarre le système de session (le fameux "bracelet VIP")
session_start();

// 1. On récupère les données tapées dans le formulaire HTML
$login_id = $_POST['login_id'];
$password = $_POST['password'];

// 2. On se connecte à la base de données avec ton compte Yvan
$host = "localhost";
$dbname = "SecureCloudPro";
$username = "yvan"; 
$dbpass = "123456";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 3. On cherche l'utilisateur dans la table via son email
    $sql = "SELECT * FROM Utilisateur WHERE EmailUtilisateur = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $login_id]);
    
    // On récupère les infos de l'utilisateur (s'il existe)
    $user = $stmt->fetch(); 

    // 4. LE TEST ULTIME : On compare le mot de passe tapé avec le hachage de la base
    if ($user && password_verify($password, $user['MDPUtilisateur'])) {
        
        // C'est validé ! On lui donne son accès VIP
        $_SESSION['utilisateur_connecte'] = true;
        $_SESSION['email'] = $user['EmailUtilisateur']; // On garde son email en mémoire
        
        // On le téléporte vers son tableau de bord !
        header("Location: dashboard.php");
        exit();

    } else {
        // Mauvais email ou mauvais mot de passe
        echo "Erreur : Identifiants incorrects. <a href='connexion.html'>Réessayer</a>";
    }

} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
