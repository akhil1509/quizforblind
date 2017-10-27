<?php
    session_start();
    require_once('dbconfig.php');
    $lang = $_SESSION['lang'];
    $id = $_SESSION['adminsession'];   
    if($id == null){
        header('Location: admin.php');
    }
    if(isset($_POST['qusdelete'])){
        $test = $_SESSION['test'];
        $testtitle = $lang.'-'.$test;
        $qid = $_POST['delval'];
        if(mysqli_query($conn,"DELETE FROM `$testtitle` WHERE q_id = '$qid'")){
            header("Location: viewquestions.php?test=$test");
        }
        
    }
    if(isset($_POST['testdelete'])){
        $test = $_POST['dropval'];
        $testtitle = $lang.'-'.$test;
        if(mysqli_query($conn,"DROP TABLE `$testtitle`") && mysqli_query($conn,"DELETE FROM `$lang` WHERE tests = '$test'")){
            header("Location: viewtests.php?testlang=$lang");
        }
        else{
            echo "error ".mysqli_error($conn);
        }
    }
    if(isset($_GET['subjectdelete'])){
        $sub = $_GET['testlang'];
        $res=mysqli_query($conn,"SELECT tests FROM `$sub`");
        if(mysqli_num_rows($res)>0){
            while($row = mysqli_fetch_assoc($res)){
                $testtitle = $sub.'-'.$row['tests'];
                if(mysqli_query($conn,"DROP TABLE `$testtitle`")){
                    
                }
                else{
                    echo "error ".mysqli_error($conn);
                }
                
            }
        }
        if(mysqli_query($conn,"DROP TABLE `$sub`") && mysqli_query($conn,"DELETE FROM lang WHERE subjects = '$sub'")){
            header("Location: index.php");
        }
        else{
            echo "error ".mysqli_error($conn);
        }
        
    }
?>