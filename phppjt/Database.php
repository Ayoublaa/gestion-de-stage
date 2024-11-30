<?php
class Database {
    private $host = "localhost";
    private $dbName = "emsi";
    private $username = "root";
    private $password = "";
    public $conn;

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host={$this->host}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function setupDatabase() {
        try {
            $this->connect();
            $this->conn->exec("CREATE DATABASE IF NOT EXISTS {$this->dbName}");
            $this->conn->exec("USE {$this->dbName}");
            $this->conn->exec("
                CREATE TABLE IF NOT EXISTS utilisateurs (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(255) UNIQUE NOT NULL,
                    motdepasse VARCHAR(255) NOT NULL,
                    role ENUM('etudiant', 'professeur', 'admin') NOT NULL
                )
            ");
            $this->seedData();
        } catch (PDOException $e) {
            die("Erreur lors de la configuration de la base de données : " . $e->getMessage());
        }
    }

    private function seedData() {
        $utilisateurs = [
            ['email' => 'ayoub@emsi-edu.ma', 'motdepasse' => password_hash('ayoub123', PASSWORD_BCRYPT), 'role' => 'etudiant'],
            ['email' => 'kaoutar@emsi-edu.ma', 'motdepasse' => password_hash('kaoutar123', PASSWORD_BCRYPT), 'role' => 'etudiant'],
            ['email' => 'yassmine@emsi-edu.ma', 'motdepasse' => password_hash('yassmine123', PASSWORD_BCRYPT), 'role' => 'etudiant'],
            ['email' => 'prof1@emsi-prof.ma', 'motdepasse' => password_hash('prof123', PASSWORD_BCRYPT), 'role' => 'professeur'],
            ['email' => 'prof2@emsi-prof.ma', 'motdepasse' => password_hash('prof456', PASSWORD_BCRYPT), 'role' => 'professeur'],
            ['email' => 'prof3@emsi-prof.ma', 'motdepasse' => password_hash('prof789', PASSWORD_BCRYPT), 'role' => 'professeur'],
            ['email' => 'prof4@emsi-prof.ma', 'motdepasse' => password_hash('prof012', PASSWORD_BCRYPT), 'role' => 'professeur'],
            ['email' => 'admin@emsi.ma', 'motdepasse' => password_hash('admin123', PASSWORD_BCRYPT), 'role' => 'admin']
        ];

        $stmt = $this->conn->prepare("INSERT IGNORE INTO utilisateurs (email, motdepasse, role) VALUES (:email, :motdepasse, :role)");
        foreach ($utilisateurs as $user) {
            $stmt->execute($user);
        }
    }
}
?>
