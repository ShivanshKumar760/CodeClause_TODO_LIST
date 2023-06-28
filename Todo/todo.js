// //get the task from input feild
// const add = document.getElementById('add');
// add.addEventListener("click", () =>{
//     let value=document.querySelector("#newtask input").value;
//     if(value.lenght==0)
//     {
//         alert("Please Enter a task in the todo input ");
//         return false;

//     }
//     addTodoItem(value);
// })
// //add item to the list
// function addTodoItem(value)
// {
//     let randomNumber = Math.floor(Math.random()*9999);
//     let id ="taskid-"+randomNumber;
//     let addedDIV='<div class="task" id="'+id+'"><span id = "taskname">'+
//     value
//     +'</span><button class="delete" onclick="deleteItem('+randomNumber+')"><i class ="fa fa-trash-alt"></i></button></div>'
//     document.querySelector('#tasks').innerHTML+= addedDIV;
//     document.querySelector("#newtask input").value="";
// }
// //delete the task 
// function deleteItem(randomNumber)
// {
//     alert("pressed");
//     let id="taskid-"+randomNumber;
//     alert(id);
//     document.getElementById(id).remove();
// }


// Step 1 - Get the task from input field
const form = document.getElementById("taskform");
form.addEventListener("submit", e => {
  let value = document.getElementById("task").value;
  if (value.length == 0) {
    alert("Please enter a task");
    e.preventDefault();
  }
});

// Hide alerts
var close = document.getElementsByClassName("close");

function hide() {
  this.parentElement.remove();
  return false;
}

for (var i = 0; i < close.length; i++) {
  close[i].addEventListener("click", hide, false);
}