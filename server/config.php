<?php
class Config {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "g-projects";

    protected $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}


class Project extends Config {
    public function getProjectDetails($projectId) {
        $sql = "SELECT * FROM projects WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $projectId);
        $stmt->execute();
        $result = $stmt->get_result();
        $projectDetails = $result->fetch_assoc();
        $stmt->close();
        return $projectDetails;
    }

    public function getProjectFiles($projectId) {
        $sql = "SELECT * FROM projects_files WHERE project_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $projectId);
        $stmt->execute();
        $result = $stmt->get_result();
        $projectFiles = array();
        while ($file = $result->fetch_assoc()) {
            $projectFiles[] = $file;
        }
        $stmt->close();
        return $projectFiles;
    }

    public function deleteProject($projectId){
        $sql = "DELETE FROM projects WHERE id= $projectId";
        $stmt = $this->conn->query($sql);
        $sql = "DELETE FROM projects_files WHERE project_id= $projectId ";
        $stmt = $this->conn->query($sql);
    }

    public function updateproject($projectId , $title, $client, $description, $budget, $start_date, $end_date, $state){

        $sql = "UPDATE projects SET title=?, client=?, description=?, budget=?, start_date=?, end_date=?, state=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssdsssi", $title, $client, $description, $budget, $start_date, $end_date, $state, $projectId);
        $stmt->execute();
        $stmt->close();

        $fileInputs = $_FILES['file'];
        
        if(!empty($fileInputs['name'][0])){

            $sql = "DELETE FROM projects_files WHERE project_id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $projectId);
            $stmt->execute();
            $stmt->close();

            foreach ($fileInputs['name'] as $index => $fileName) {
              $fileTmp = $fileInputs['tmp_name'][$index];
              $fileDestination = '../uploads/' . $fileName;
          
              move_uploaded_file($fileTmp, $fileDestination);
              
                $sql = "INSERT INTO projects_files (project_id, file_path) VALUES (?, ?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("is", $projectId, $fileDestination);
                $stmt->execute();
                $stmt->close();
              

                // ------------------
                //   $sql = "UPDATE projects_files SET file_path=? WHERE project_id=?";
                //   $stmt = $this->conn->prepare($sql);
                //   $stmt->bind_param("si", $fileDestination, $projectId);
                //   $stmt->execute();
                //   $stmt->close();


                // ------------ Vérifier si le fichier existe déjà dans la table-----------
                // $sql = "SELECT id FROM projects_files WHERE project_id=? AND file_path=?";
                // $stmt = $this->conn->prepare($sql);
                // $stmt->bind_param("is", $projectId, $fileDestination);
                // $stmt->execute();
                // $result = $stmt->get_result();
                // $existingFile = $result->fetch_assoc();
                // $stmt->close();
                            
                // if ($existingFile) {
                //     // Le fichier existe déjà, mettons à jour le chemin d'accès
                //     $sql = "UPDATE projects_files SET file_path=? WHERE id=?";
                //     $stmt = $this->conn->prepare($sql);
                //     $stmt->bind_param("si", $fileDestination, $existingFile['id']);
                //     $stmt->execute();
                //     $stmt->close();
                // } else {
                //     // Le fichier n'existe pas, insérons-le
                //     $sql = "INSERT INTO projects_files (project_id, file_path) VALUES (?, ?)";
                //     $stmt = $this->conn->prepare($sql);
                //     $stmt->bind_param("is", $projectId, $fileDestination);
                //     $stmt->execute();
                //     $stmt->close();
                // }

            }
        }

    }
}
?>