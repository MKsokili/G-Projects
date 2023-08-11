<link rel="stylesheet" href="../styles/sidebar.css">
<link rel="stylesheet" href="../styles/navbar.css">
<link rel="stylesheet" href="../styles/content.css">
<link rel="stylesheet" href="../styles/newproject.css">
<title>G-Project</title>
<script src="https://kit.fontawesome.com/83187e0fd0.js" crossorigin="anonymous"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- ----------------------------------- -->
<?php 
require_once "config.php" ;
// class Database {
//   private $host;
//   private $dbname;
//   private $username;
//   private $password;
//   private $mysqli;

//   public function __construct($host, $dbname, $username, $password) {
//     $this->host = $host;
//     $this->dbname = $dbname;
//     $this->username = $username;
//     $this->password = $password;
//   }

//   public function connect() {
//     $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->dbname);

//     if ($this->mysqli->connect_errno) {
//       die("Connection error: " . $this->mysqli->connect_error);
//     }
//   }

//   public function getConnection() {
//     return $this->mysqli;
//   }
// }
// $database = new Database("localhost", "g-projects", "root", "");
// $database->connect();

// Récupérer les données de la table projects
$database = new Config();
$stmt = $database->getConnection()->query("SELECT * FROM projects");
$projects = $stmt->fetch_all(MYSQLI_ASSOC);
?>
<!-- ---------------------------------- -->



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
            <li id="nprojectform" ><a href="#"> <i class="fa-solid fa-plus"></i>New Project</a></li>
            <!-- <li><span id="nprojectform" > New Project</span></li> -->
            <li><a href="#"> <i class="fa-solid fa-eject"></i> About me</a></li>
            <li><a href="login.php"><i class="fa-solid fa-right-from-bracket"></i>Sign out</a></li>
          </ul>
       </div>
</div>

<div id="navbar">

        <form id="Searchbar" method="GET">
                    <input class="search" id="searchInput" type="text" name="q" placeholder="Search by Title...">  
                    <button onclick="searchJobs()" class="searchIcon"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <button onclick="searchJobs()" class="view-all">View All</button>
        </form>

</div>

<div class="container">

  <div>
        <h2>Projects List</h2>
  </div>

  <div id="parent">
    
    <?php foreach ($projects as $project) : ?>

      <div class="project">
        <h3 class="project-title"><?php echo $project['title']; ?></h3>
        <h4 class="project-client">Client : <?php echo $project['client']; ?></h4>
        <form action="project-details.php" method="get">
          <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
          <button type="submit" class="view-detail"><i class="fa-solid fa-circle-info"></i>View Details</button>
        <!-- <button class="view-detail" data-project-id=""><i class="fa-solid fa-circle-info"></i>View Details</button> -->
        </form>

        <form action="deleteproject.php" method="get">
          <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
          <button type="submit" class="delete-project"><i class="fa-solid fa-trash"></i></button>
        </form>

        <form action="updateproject.php" method="get">
          <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
          <button type="submit" class="update-project"><i class="fa-solid fa-pen-to-square"></i></button>
        </form>

      </div>

    <?php endforeach; ?>
  
              <!-- -------------- Project details Div ------------- -->
      
  </div>

      <!-- <div class="project">
        <h3 class="project-title">title</h3>
        <h4 class="project-client">Client</h4>
        <button class="view-detail"><i class="fa-solid fa-circle-info"></i>View Details</button>      
      </div>

      <div class="project">
        <h3 class="project-title">title</h3>
        <h4 class="project-client">Client</h4>
        <button class="view-detail"><i class="fa-solid fa-circle-info"></i>View Details</button>      
      </div>

      <div class="project" >
        <h3 class="project-title">title</h3>
        <h4 class="project-client">Client</h4>
        <button class="view-detail"><i class="fa-solid fa-circle-info"></i>View Details</button>      
      </div>

      <div class="project" >
        <h3 class="project-title">title</h3>
        <h4 class="project-client">Client</h4>
        <button class="view-detail"><i class="fa-solid fa-circle-info"></i>View Details</button>      
      </div>

      <div class="project" >
        <h3 class="project-title">title</h3>
        <h4 class="project-client">Client</h4>
        <button class="view-detail"><i class="fa-solid fa-circle-info"></i>View Details</button>      
      </div>

      <div class="project" >
        <h3 class="project-title">title</h3>
        <h4 class="project-client">Client</h4>
        <button class="view-detail"><i class="fa-solid fa-circle-info"></i>View Details</button>      
      </div>

      <div class="project" >
        <h3 class="project-title">title</h3>
        <h4 class="project-client">Client</h4>
        <button class="view-detail"><i class="fa-solid fa-circle-info"></i>View Details</button>      
      </div> -->



  </div>


</div>

<div class="newproject">

<form action="./createproject.php" method="POST" enctype="multipart/form-data">
      <h2 style="text-align : center ; color :rgb(185, 56, 56) ; font-size : 30px ;">New Project</h2>
      <div class="form-field">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
      </div>

      <div class="form-field">
        <label for="client">Client:</label>
        <input type="text" id="client" name="client" required>
      </div>

      <div class="form-field">
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
      </div>

      <div class="form-field">
        <label for="budget">Budget:</label>
        <input type="text" id="budget" name="budget" required>
      </div>

      <div class="form-field">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>
      </div>

      <div class="form-field">
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>
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
          <input type="file" name="file[]" required>
        </div>
        <button type="button" id="add-file-button">Add File</button>
      </div>

      <div class="form-field">
        <button type="submit" class="submit-button">Submit</button>
      </div>
    </form>

</div>



<script src="../js/eventhand.js"></script>
