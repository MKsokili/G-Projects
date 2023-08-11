<?php
require_once "config.php" ;

if (isset($_GET['project_id'])) {
    $projectId = $_GET['project_id'];

    $projectObj = new Project();
    $projectDetails = $projectObj->getProjectDetails($projectId);
    $projectFiles = $projectObj->getProjectFiles($projectId);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $title = $_POST['title'];
        $client = $_POST['client'];
        $description = $_POST['description'];
        $budget = $_POST['budget'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $state = $_POST['state'];
    
        // Save project to database
        $projectObj->updateproject($projectId , $title, $client, $description, $budget, $start_date, $end_date, $state);
      
        // Redirect to homepage or success page
        header("Location: homepage.php");
        exit();
    }

}

  
?>



<html>
<link rel="stylesheet" href="../styles/sidebar.css">
<link rel="stylesheet" href="../styles/newproject.css">
<script src="https://kit.fontawesome.com/83187e0fd0.js" crossorigin="anonymous"></script>
<title>G-Projects</title>

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


<div id="updateproject">

    <form  method="POST" enctype="multipart/form-data">
      <h2 style="text-align : center ; color :rgb(185, 56, 56) ; font-size : 30px ;">Udpate Project</h2>
      <div class="form-field">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $projectDetails['title']; ?>" required>
      </div>

      <div class="form-field">
        <label for="client">Client:</label>
        <input type="text" id="client" name="client" value="<?php echo $projectDetails['client']; ?>" required>
      </div>

      <div class="form-field">
        <label for="description">Description:</label>
        <textarea id="description" name="description" required> <?php echo $projectDetails['description']; ?> </textarea>
      </div>

      <div class="form-field">
        <label for="budget">Budget:</label>
        <input type="text" id="budget" name="budget" value="<?php echo $projectDetails['budget']; ?>" required>
      </div>

      <div class="form-field">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" value="<?php echo $projectDetails['start_date']; ?>" required>
      </div>

      <div class="form-field">
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date"  value="<?php echo $projectDetails['end_date']; ?>" required>
      </div>

      <div class="form-field">
        <label for="state">State:</label>
        <select id="state" name="state" required>
          <option value="In Progress">In Progress</option>
          <option value="Completed">Completed</option>
          <option value="Cancelled">Cancelled</option>
        </select>
      </div>

      <div class="form-field">
        <label for="files">Fichiers:</label>
        <div id="file-inputs-container">
            <p>Projects files</p>
            <input type="file" name="file[]" >
        </div>
        <button type="button" id="add-file-button">Add File</button>
      </div>

      <div class="form-field">
        <button type="submit" class="submit-button">Submit</button>
      </div>
    </form>

</div>

<script src="../js/eventhand.js"></script>
</body>
</html>
