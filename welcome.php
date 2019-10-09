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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="heading">
        <h2>TODO LIST</h2>
    </div>

    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Start adding your tasks!</h1>
    
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    </div>

    <form method="POST" action="welcome.php">
        <?php if (isset($errors)) {  ?>
            <p><?php echo $errors; ?></p>
       <?php } ?>
        <input type="text" name="task" class="task_input">
        <button type="submit" class="add_btn" name="submit"> ADD TASK </button>

    </form>

    <table>
        <thead>
            <th>N</th>
            <th>Task</th>
            <th>Action</th>
        </thead>

        <tbody>
            <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td class="task"><?php echo $row['task']; ?></td>
                <td class="delete">
                    <a href="welcome.php?del_task=<?php echo $row['id']; ?>">x</a>
                </td>
            </tr> 
            <?php $i++; } ?>
        </tbody>
    </table>


</body>
</html>