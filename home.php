<?php
class User {
    public $name;
    public $role;

    public function __construct($name, $role) {
        $this->name = $name;
        $this->role = $role;
    }

    public function displayInfo() {
        echo "<div class='card'>";
        echo "<h3>" . $this->role . "</h3>";
        echo "<p>Informations: " . $this->name . "</p>";
        echo "</div>";
    }
}


$users = [
    new User("Ali", "Candidat"),
    new User("Dr. Fatima", "Président"),
    new User("Mohammed", "Rapporteur"),
    new User("Amina", "Responsable")
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Travaux Universitaires</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="navbar">
        <div class="logo">
            <a href="">ÉMSI</a>
        </div>
        <nav>
            <a href="#">Accueil</a>
            <a href="#">À propos</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
        </nav>
    </div>

  
    <div class="hero">
    <h1>École Marocaine des Sciences de l'Ingénieur</h1>
        <h2>Système de gestion des travaux universitaires</h2>
    </div>

   
    <main class="main-grid">
        <div class="card">
            <h3>Candidat</h3>
            <p>Informations du candidat</p>
        </div>
        <div class="card">
            <h3>Président</h3>
            <p>Informations sur le président</p>
        </div>
        <div class="card">
            <h3>Rapporteur</h3>
            <p>Informations sur le rapporteur</p>
        </div>
        <div class="card">
            <h3>Responsable</h3>
            <p>Informations du responsable</p>
        </div>
    </main>

  
    <footer>
        &copy; 2024 École Marocaine des Sciences de l'Ingénieur. Tous droits réservés. |
        <a href="#">Mentions légales</a>
    </footer>
</body>
</html>
