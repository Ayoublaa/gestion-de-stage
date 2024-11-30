<?php
session_start();
require_once 'database.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}


$db = new Database();
$conn = $db->connect();


if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM utilisateurs WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}

$stmt = $conn->query("SELECT id, email, role FROM utilisateurs");
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tableau de bord Admin</h1>
    <a href="logout.php">Déconnexion</a>
    <h2>Utilisateurs</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td><?= $utilisateur['id'] ?></td>
                    <td><?= $utilisateur['email'] ?></td>
                    <td><?= $utilisateur['role'] ?></td>
                    <td>
                        <a href="admin.php?delete=<?= $utilisateur['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
