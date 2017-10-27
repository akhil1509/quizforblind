<?php
session_start();
    require_once('dbconfig.php');
    $lang = $_SESSION['lang'];
    $test = $_SESSION['test'];
    if(isset($_POST['update'])){
        $guide = $_POST['guide'];
        $id = $_POST['tid'];
        if(mysqli_query($conn,"UPDATE `$lang` SET guide = '$guide' WHERE t_id = '$id'")){
            header("Location: viewquestions.php?test=$test");
        }
        else{
            echo "error".mysqli_error($conn);
        }
    }
?>