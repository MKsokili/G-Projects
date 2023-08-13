<?php
require_once "config.php" ;

if (isset($_GET['project_id'])) {
    $projectId = $_GET['project_id'];

    $projectObj = new Project();
    $projectObj->deleteProject($projectId);
    header("Location: homepage.php");
}

?>