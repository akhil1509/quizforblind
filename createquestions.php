<?php
session_start();
    require_once('dbconfig.php');
    $test = $_SESSION['test'];
    $lang = $_SESSION['lang'];
    if(isset($_POST['newques'])){
        $guide = $_POST['guidelines'];
        $ques = $_POST['title'];
        $time = time();
        $ques_id = "question_".$time;
        $o1 = $_POST['option1'];
        $o2 = $_POST['option2'];
        $o3 = $_POST['option3'];
        $o4 = $_POST['option4'];
        $o5 = $_POST['option5'];
        $ans = $_POST['answer'];
        $explain = $_POST['explain'];
        $addtest = $lang.'-'.$test;
        $res = mysqli_query($conn,"SELECT * FROM `$test` WHERE questions = '$ques'");
        if(mysqli_num_rows($res) > 0){
            header("Location: viewquestions.php?test=$test&error");
        }
        else{
            if(mysqli_query($conn,"INSERT INTO `$addtest`(q_id,guidelines,questions,option1,option2,option3,option4,option5,answer,exp) VALUES('$ques_id','$guide','$ques','$o1','$o2','$o3','$o4','$o5','$ans','$explain')")){
                header("Location: viewquestions.php?test=$test");
            }
            else{
                echo "error".mysqli_error($conn);
            }
        }
    }
?>