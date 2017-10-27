<?php
session_start();
    require_once('dbconfig.php');
    $lang = $_SESSION['lang'];
    if(isset($_POST['newtest'])){
        $test = strtolower($_POST['title']);
        $guide = "";
        $addtest = $lang.'-'.$test;
        $timelimit = $_POST['testtime'];
        $time = time();
        $test_id = "test_".$time;
        $res = mysqli_query($conn,"SELECT * FROM `$lang` WHERE tests = '$test'");
        if(mysqli_num_rows($res) > 0){
            header("Location: viewtests.php?testlang=$lang&error");
        }
        else{
            if(mysqli_query($conn,"CREATE TABLE `$addtest` (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,q_id VARCHAR(50),guidelines TEXT,questions TEXT,option1 VARCHAR(100),option2 VARCHAR(100),option3 VARCHAR(100),option4 VARCHAR(100),option5 VARCHAR(100),answer VARCHAR(50),exp TEXT)") && mysqli_query($conn,"INSERT INTO `$lang`(t_id,tests,testtime) VALUES('$test_id','$test','$timelimit')")){
                header("Location: viewtests.php?testlang=$lang");
            }
            else{
                echo "error".mysqli_error($conn);
            }
        }
    }
?>