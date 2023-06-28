<?php
    session_start();
    include('config/database.php');
    include('config/tasks.php');
    $obj = new Tasks;
    
    if(isset($_POST['submit'])) {
        // Insert Data in the Table
        $task = $_POST['task'];
        $id = $_POST['id'];
        $created_at = $updated_at = date("Y-m-d H:i:s");

        //Update
        if(!empty($id)) {
            $sql = "UPDATE todolists set task = '".$task."', updated_at = '".$updated_at."' where id = ".$id;
            $res = $obj->executeQuery($sql);
            if($res) {
                $_SESSION['success'] = "Task has been update successfully";
            }
            else {
                $_SESSION['error'] = "Something went wrong, please try again later";
            }
        }   
        else {
            $sql = "INSERT INTO todolists (task, created_at, updated_at) VALUES ('".$task."', '".$created_at."', '".$updated_at."')";
            $res = $obj->executeQuery($sql);

            if($res) {
                $_SESSION['success'] = "Task has been created successfully";
            }
            else {
                $_SESSION['error'] = "Something went wrong, please try again later";
            }
        }
        
        session_write_close();
        header("LOCATION:index.php");
    }

    //Get all Tasks
    $tasks = $obj->getAllTasks();

    //Get Task
    $editing = false;
    if(isset($_GET['action']) && $_GET['action']  === 'edit') {
        $taskData = $obj->getTask($_GET['id']);
        $editing = true;
    }

    //Delete Task
    if(isset($_GET['action']) && $_GET['action']  === 'delete') {
        $sql = "DELETE FROM todolists WHERE id = ".$_GET['id'];
        $res = $obj->executeQuery($sql);
        if($res) {
            $_SESSION['success'] = "Task has been deleted successfully";
        }
        else {
            $_SESSION['error'] = "Something went wrong, please try again later";
        }

        session_write_close();
        header("LOCATION:index.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./css/assets/fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="./css/style.css" rel="stylesheet" />
    <title>Todo List Project</title>
    <style>
      *,
      *:before,
      *:after {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
      }
      body {
        height: 100vh;
        background: #012d42;
      }
      .container {
        width: 40%;
        top: 50%;
        left: 50%;
        background: white;
        border-radius: 10px;
        min-width: 450px;
        position: absolute;
        min-height: 100px;
        transform: translate(-50%, -50%);
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      }

      #newtask {
        position: relative;
        padding: 30px 20px;
      }
      #newtask h3 {
        margin-bottom: 20px;
      }
      #newtask input {
        width: 75%;
        height: 45px;
        padding: 12px;
        color: #111111;
        font-weight: 500;
        position: relative;
        border-radius: 5px;
        font-size: 15px;
        border: 2px solid #d1d3d4;
      }

      #newtask input:focus {
        outline: none;
        border-color: #0d75ec;
      }
      #newtask button {
        position: relative;
        float: right;
        font-weight: 500;
        font-size: 16px;
        background-color: #0d75ec;
        border: none;
        color: #ffffff;
        cursor: pointer;
        outline: none;
        width: 20%;
        height: 45px;
        border-radius: 5px;
      }
      #tasks {
        border-radius: 10px;
        width: 100%;
        position: relative;
        background-color: #ffffff;
        padding: 30px 20px;
        margin-top: 10px;
      }

      .task {
        border-radius: 5px;
        align-items: center;
        justify-content: space-between;
        border: 1px solid #939697;
        cursor: pointer;
        background-color: #dadbdf;
        height: 50px;
        margin-bottom: 8px;
        padding: 5px 10px;
        display: flex;
      }
      .task span {
        font-size: 15px;
        font-weight: 400;
      }
      .task button {
        background-color: #db2525;
        color: #ffffff;
        border: none;
        cursor: pointer;
        outline: none;
        height: 100%;
        width: 40px;
        border-radius: 5px;
      }
    </style>
    <script src="https://kit.fontawesome.com/5f80e78a4d.js" crossorigin="anonymous"></script>
</head>
<body>
    <!--Step 1: Basic structure of Todo List-->
    <div class="container">
      <!--Step 2: Create input place and button-->
      <div id="newtask">
        <?php include('include/alert.php') ?>


        <h3>Todo List Project</h3>
        <form action="index.php" method="post" id="taskform">
            <input type="hidden" name="id" value="<?php if($editing) { echo $taskData['id']; } ?>"  >
            <input type="text" name="task" id="task" placeholder="Task to be done..." value="<?php if($editing) { echo $taskData['task']; } ?>" />
            <button type="submit" name="submit" id="add"><?php if($editing) { echo "Update"; } else { echo "Add" ; } ?></button>
        </form>
      </div>

      <div id="tasks">
        <?php
            if(!empty($tasks)) {
                foreach($tasks as $t) {
        ?>
        <div class="task">
            <span><?php echo $t['task'] ?></span>
            <a href="index.php?action=edit&id=<?php echo $t['id'] ?>" class="edit button"><i class="fa fa-edit"></i></a>
            <a onclick="return confirm('Do you want to delete this record?')" href="index.php?action=delete&id=<?php echo $t['id'] ?>" class="delete button"><i class="fa fa-trash-alt"></i></a>
        </div>
        <?php }} ?>
      </div>
    </div>

    <script src="todo.ja"></script>
</body>
</html>