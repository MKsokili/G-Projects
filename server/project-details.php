<?php
require_once 'config.php';

if (isset($_GET['project_id'])) {
    $projectId = $_GET['project_id'];

    $projectObj = new Project();
    $projectDetails = $projectObj->getProjectDetails($projectId);
    $projectFiles = $projectObj->getProjectFiles($projectId);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/projectdetail.css">
    <script src="https://kit.fontawesome.com/83187e0fd0.js" crossorigin="anonymous"></script>
    
    <title>G-Projects</title>

</head>
<body>

<div class="sidebar">
       <div class="profil">
          <div class="profil-image">
            <img id="profilpic" src="../img/Gpr_logo.png" alt="">
          </div>
          <!-- <div class="loading"><input id="loadprofilimagep" type="file"></div> -->
          <h3>G-Project</h3>
       </div>

       <div class="page-parties">
          <ul>
            <li><a href="./homepage.php"><i class="fa-solid fa-book-open-reader"></i> Projects</a></li>
            <li id="nprojectform" ><a href="homepage.php"> <i class="fa-solid fa-plus"></i>New Project</a></li>
            <!-- <li><span id="nprojectform" > New Project</span></li> -->
            <li><a href="#"> <i class="fa-solid fa-eject"></i> About me</a></li>
            <li><a href="login.php"><i class="fa-solid fa-right-from-bracket"></i>Sign out</a></li>
          </ul>
       </div>
</div>



<!-- Affichez les détails du projet -->
<h4>Project Details</h4>
<div id="project-details-container">
    <h3>Project Name :  <?php echo $projectDetails['title']; ?></h3>
    <h4>Client: <?php echo $projectDetails['client']; ?></h4>
    <p>Budget: <?php echo $projectDetails['budget']; ?></p>
    <p>Description: <?php echo $projectDetails['description']; ?></p>
    <p>Start Date: <?php echo $projectDetails['start_date']; ?></p>
    <p>End Date: <?php echo $projectDetails['end_date']; ?></p>
    <p>State: <?php echo $projectDetails['state']; ?></p>

    <!-- Affichez les fichiers associés au projet -->
    <?php if (!empty($projectFiles)) : ?>
        <p>Project Files:</p>
        <ul>
            <?php foreach ($projectFiles as $file): ?>
                <li><a href="<?php echo $file['file_path']; ?>" download><?php echo $file['file_path']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>


</body>
</html>