<?php 

// 1. RÉCUPÉRATION DES DONNÉES DU FORMULAIRE
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$identifiant = $_POST['identifiant'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation']; // On récupère la confirmation !

// 2. VÉRIFICATION DES MOTS DE PASSE
if ($password !== $password_confirmation) {
    // Si les deux mots de passe sont différents, on arrête tout et on affiche un message
    die("Erreur : Les mots de passe ne correspondent pas. Veuillez revenir en arrière et réessayer.");
}

// 3. SÉCURITÉ : On crypte le mot de passe avant de le sauvegarder
$password_crypte = password_hash($password, PASSWORD_DEFAULT);

// 4. CONNEXION À TA BASE DE DONNÉES MYSQL
$host = "localhost"; 
$dbname = "SecureCloudPro"; // ⚠️ À remplacer
$username = "yvan";         // ⚠️ À remplacer
$dbpass = "123456"; // ⚠️ À remplacer

try {
    // Tentative de connexion
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 5. INSERTION DANS LA TABLE
    // Regarde bien : on n'utilise QUE les 4 colonnes qui existent dans ta base !
    $sql = "INSERT INTO Utilisateur (NomUtilisateur, PrénomUtilisateur, EmailUtilisateur, MDPUtilisateur) 
            VALUES (:nom, :prenom, :email, :password)";
    
    $stmt = $pdo->prepare($sql);
    
    // Exécution de la requête avec les 4 bonnes données
    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':password' => $password_crypte // Le mot de passe crypté
    ]);

    echo "Félicitations, ton compte a bien été créé !";

} catch(PDOException $e) {
    echo "Erreur de connexion ou d'insertion : " . $e->getMessage();
}
?>
