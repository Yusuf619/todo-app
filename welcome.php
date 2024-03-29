<!-- PHP START -->
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 

    <?php

    $errors = ""; 

// connecting to the db
    // $db = mysqli_connect('167.71.74.228', 'yusuf', 'sterns94Sex87murre', 'todo-app');
    $db = mysqli_connect('localhost', 'root', 'root', 'todo-app');

    if (isset($_POST['submit'])) {
        $task = $_POST['task'];
        if(empty($task)) {
            $errors = "You must fill in a task";
            }else{
                mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
                header('location: welcome.php');
            }
        }

        if (isset($_GET['del_task'])) {
            $id = $_GET['del_task'];
            mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
            header('location: welcome.php');
        }

    $tasks = mysqli_query($db, "SELECT * FROM tasks");
?>
<!-- PHP END -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ac87d8aca0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">

    <script src="main.js"></script>
    <title>Todo App</title>
</head>
<body>
    <div class="heading">
        <!-- <h2>TODO LIST</h2> -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"> <i class="fas fa-list-ol"></i> TODO APP</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">


    <li class="nav-item">
        <a class="nav-link" href="#"><i class="far fa-user"></i></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        
        </a>
       
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" >
        <h1> Signed in as <b class="username"><?php  echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
        <hr>
          <a class="dropdown-item" href="reset-password.php">Reset Your Password</a>
          <a class="dropdown-item" href="logout.php">Logout of your Account</a>
        </div>
      </li>
 

    </ul>
  </div>
</nav>
    </div>

    <!-- <div class="page-header">
        <h1>Hi, <b class="username"><?php  echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
    
  
    </div>
     -->




<div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div>
</div>




    <form method="POST" action="welcome.php" >
        <?php if (isset($errors)) {  ?>
            <p><?php echo $errors; ?></p>
       <?php } ?>
        <input type="text" name="task" class="task_input">
        <button type="submit" class="add_btn" name="submit"> ADD TASK </button>

    </form>

    <table>
        <thead>
            <th>No</th>
            <th>Task</th>
            <th>Delete</th>
        </thead>

        <tbody>
            <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td class="task"><?php echo $row['task']; ?></td>
                <td class="delete">
                    <a  href="welcome.php?del_task=<?php  echo $row['id']; ?>"> x</a>
                </td>
            </tr> 
            <?php $i++; } ?>
        </tbody>
    </table>

<!-- AJAX STRIKETHROUGH START -->
    <script>
$(function(){
  var $curParent, Content;
  $(document).delegate("td","click", function(){
    if($(this).closest("s").length) {
      Content = $(this).parent("s").html();
      $curParent = $(this).closest("s");
      $(Content).insertAfter($curParent);
      $(this).closest("s").remove();
    }
    else {
      $(this).wrapAll("<s />");
    }
  });
});
</script>
<!-- AJAX STRIKETHROUGH END -->

<!-- SCRIPT TAGS START -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- SCRIPT TAGS END -->

   



</body>
</html>