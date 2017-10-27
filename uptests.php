<?php
session_start();
    require_once('dbconfig.php');
    $lang = $_SESSION['lang'];
    if(isset($_GET['update'])){
        $testOld = $_GET['test'];
        $testNew = strtolower($_GET['title']);
        $oldTest = $lang.'-'.$testOld;
        $newTest = $lang.'-'.$testNew;
        $id = $_GET['tid'];
        $testtime = $_GET['testtime'];
        if($oldTest == $newTest){
            if(mysqli_query($conn,"UPDATE `$lang` SET tests = '$testNew',testtime = '$testtime' WHERE t_id = '$id'")){
                header("Location: viewtests.php?testlang=$lang");
            }
            else{
                echo "error".mysqli_error($conn);
            }
        }
        else{
            if(mysqli_query($conn,"UPDATE `$lang` SET tests = '$testNew', testtime = '$testtime' WHERE t_id = '$id'") && mysqli_query($conn,"RENAME TABLE `$oldTest` TO `$newTest`")){
                header("Location: viewtests.php?testlang=$lang");
            }
            else{
                echo "error".mysqli_error($conn);
            }
        }
    }
    else{
        echo "error ".mysqli_error($conn);
    }
?>