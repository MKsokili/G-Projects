<?php
// if (isset($_FILES['file'])) {
//     // Informations de connexion à la base de données
//     $host = 'localhost';
//     $username = 'your_username';
//     $password = 'your_password';
//     $database = 'your_database';

//     // Connexion à la base de données
//     $connection = new mysqli($host, $username, $password, $database);
//     if ($connection->connect_error) {
//         die('Connection failed: ' . $connection->connect_error);
//     }

//     // Récupération de l'ID principal de la table principale
//     $principalID = 1; // Remplacez par la valeur réelle de l'ID principal

//     // Parcours des fichiers
//     foreach ($_FILES['file']['tmp_name'] as $key => $tmpName) {
//         $fileName = $_FILES['file']['name'][$key];
//         $filePath = 'uploads/' . $fileName;

//         // Déplacement du fichier vers un dossier de stockage (facultatif)
//         move_uploaded_file($tmpName, $filePath);

//         // Insertion des informations du fichier dans la table de fichiers
//         $sql = "INSERT INTO fichiers (id_principal, nom_fichier, chemin_fichier) VALUES (?, ?, ?)";
//         $statement = $connection->prepare($sql);
//         $statement->bind_param('iss', $principalID, $fileName, $filePath);
//         $statement->execute();
//         $statement->close();
//     }

//     // Fermeture de la connexion à la base de données
//     $connection->close();
// }


class Database {
  private $servername;
  private $username;
  private $password;
  private $dbname;
  private $conn;

  public function __construct($servername, $username, $password, $dbname) {
    $this->servername = $servername;
    $this->username = $username;
    $this->password = $password;
    $this->dbname = $dbname;
  }

  public function connect() {
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function getConnection() {
    return $this->conn;
  }
}

class Project {
  private $title;
  private $client;
  private $description;
  private $budget;
  private $start_date;
  private $end_date;
  private $state;
  private $conn;

  public function __construct($title, $client, $description, $budget, $start_date, $end_date, $state, $conn) {
    $this->title = $title;
    $this->client = $client;
    $this->description = $description;
    $this->budget = $budget;
    $this->start_date = $start_date;
    $this->end_date = $end_date;
    $this->state = $state;
    $this->conn = $conn;
  }

  public function saveToDatabase() {
    $stmt = $this->conn->prepare("INSERT INTO projects (title, client, description, budget, start_date, end_date, state) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdsss", $this->title, $this->client, $this->description, $this->budget, $this->start_date, $this->end_date, $this->state);
    $stmt->execute();
    $stmt->close();

    $projectId = $this->conn->insert_id;

    if ($projectId) {
        $fileInputs = $_FILES['file'];
      
        foreach ($fileInputs['name'] as $index => $fileName) {
          $fileTmp = $fileInputs['tmp_name'][$index];
          $fileDestination = '../uploads/' . $fileName;
      
          move_uploaded_file($fileTmp, $fileDestination);
      
          $stmt = $this->conn->prepare("INSERT INTO projects_files (project_id, file_path) VALUES (?, ?)");
          $stmt->bind_param("is", $projectId, $fileDestination);
          $stmt->execute();
          $stmt->close();
        }
      }
  }
}

// Database connection
$database = new Database("localhost", "root", "", "g-projects");
$database->connect();
$conn = $database->getConnection();

var_dump($_POST);
// die();
// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title = $_POST['title'];
  $client = $_POST['client'];
  $description = $_POST['description'];
  $budget = $_POST['budget'];
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $state = $_POST['state'];

  // Create Project object
  $project = new Project($title, $client, $description, $budget, $start_date, $end_date, $state, $conn);

  // Save project to database
  $project->saveToDatabase();

  // Redirect to homepage or success page
  header("Location: homepage.php");
  exit();
}


?>