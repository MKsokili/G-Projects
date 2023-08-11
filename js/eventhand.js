let viewdetail = document.querySelectorAll(".view-detail");
let projectDetails = document.querySelector("#ProjectDetails");
let projectlist = document.querySelectorAll(".project");


for(let i=0 ; i<viewdetail.length ; i++){

    viewdetail[i].addEventListener("click" , () => {
    console.log("done");
    const projectId = viewdetail[i].dataset.projectId;
    for(let j=0 ; j<projectlist.length ; j++){
        projectlist[j].style.display = "none" ;
    }
    projectDetails.style.display = "block" ;
    });

}


// ----------- Creaate a New Project --------
var nprojectform = document.getElementById("nprojectform");
var container = document.querySelector(".container");
var newproject = document.querySelector(".newproject");

nprojectform.addEventListener("click", function() {
    console.log("dzdza");
    container.style.display = "none";
    newproject.style.display = "block";
});

//------------- Add input file -----------------
// function addInputFile() {
//     // Create a new input file element
//     console.log("ezd")
//     var inputFile = document.createElement('input');
//     inputFile.type = 'file';
  
//     // Add the input file to the container
//     // var container = document.getElementById('file-container');
//     projectDetails.appendChild(inputFile);
// }
  
//   // Attach the function to the click event of the "Add" icon
//   var addIcon = document.getElementById('add-icon');
//   addIcon.addEventListener('click', addInputFile);


var addFileButton = document.getElementById("add-file-button");
var fileInputsContainer = document.getElementById("file-inputs-container");

addFileButton.addEventListener("click", function() {
  var newFileInput = document.createElement("input");
  newFileInput.type = "file";
  newFileInput.name = "file[]";
  fileInputsContainer.appendChild(newFileInput);
});