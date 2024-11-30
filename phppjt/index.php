<?php
session_start();
require_once 'database.php'; 

$message = "";


$db = new Database();
$conn = $db->connect();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $motdepasse = trim($_POST['motdepasse']);

    $utilisateur = new Utilisateur($conn);
    $user = $utilisateur->login($email, $motdepasse);

    if ($user) {
        $_SESSION['email'] = $email; 
        $_SESSION['role'] = $user['role']; 
        if ($user['role'] === 'admin') {
            header("Location: admin.php");
            exit();
        } elseif ($user['role'] === 'etudiant') {
            header("Location: etudiant.php");
            exit();
        } elseif ($user['role'] === 'professeur') {
            header("Location: page_prof.php");
            exit();
        }
    } else {
        $message = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion EMSI</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <img src="logo.png" alt="EMSI Logo">
        <h2>ECOLE MAROCAINE DES SCIENCES DE L'INGENIEUR</h2>

        <?php if ($message): ?>
            <p class="error"><?= $message ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <label for="motdepasse">Mot de passe :</label>
            <input type="password" name="motdepasse" required>
            <button type="submit">CONNEXION</button>
        </form>

        <div class="footer">©️ 2024 ÉCOLE MAROCAINE DES SCIENCES DE L'INGENIEUR. Tous droits réservés.</div>
    </div>
    <script src="validation.js"></script>
</body>
</html>
