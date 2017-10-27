<?php
    session_start();
    require_once('dbconfig.php');
    $userid = $_SESSION['usersession'];   
    if($userid == null){
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome Online Exam</title>
        <link rel='stylesheet' type='text/css' href='css/bootstrap.css'>
        <link rel='stylesheet' type='text/css' href='main.css'>
        <link rel='stylesheet' type='text/css' href='css/font/flaticon.css'>
        <link href='https://fonts.googleapis.com/css?family=Fira+Sans|Josefin+Sans' rel='stylesheet'>
        <meta charset='UTF-8'>
        <meta name='description' content='Online Exam'>
        <meta name='author' content='Sukanya Ledalla, Akhil Regonda, Nishanth Kadapakonda'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    </head>
    <body>
        <div class='oq-header'>
            <div class='container-fluid'>
                <div class='row'>
                    <div class='col-md-4'>
                        <div class=''><a href='index.php'><img src='images/quiz.png' class='oq-logo'></a></div>
                    </div>
                    <div class='col-md-8'>
                        <div class='oq-userArea pull-right'>
                            <a href="langlist.php<?php $_SESSION['usersession'] = $userid;?>"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href='menu.php'><span class='glyphicon glyphicon-home'></span>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a class='oq-btn' href='logout.php?logout'>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='oq-viewTestsqueBody'>
            <div class='container-fluid'>
                <div class='row'>
                    <div class='col-md-10 col-md-offset-1'>
                        <div class="oq-viewQues text-center">
                            <table class="table oq-table">
                                <tbody>
                                    <?php
                                    
                                           if(isset($_GET['test'])){
                                            $quest=$_GET['test'];
                                            $i=$_GET['i'];
                                            $tem1 = $i+1;
                                            $tem2 = $i-1;
                                            if($tem2 < 0){
                                                $tem2 = 0;
                                            }
                                            
                                            echo $i;
                                             $question=mysqli_query($conn,"SELECT * FROM `$quest` LIMIT $i,1");
                                             $numofques=mysqli_num_rows($question);
                                             while($testques = mysqli_fetch_row($question)){

                                             echo '<tr class="oq-testques"><td colspan="2">'.$count.')'.$testques[2].'</td></tr>';
                                             echo '<form action="" method=""><tr><td><input type="radio" name="answer" value="1"/>'.$testques[3].'</td><td><input type="radio" name="answer" value="2"/>'.$testques[4].'</td></tr>';
                                             echo '<tr><td><input type="radio" name="answer" value="3"/>'.$testques[5].'</td><td><input type="radio" name="answer" value="4"/>&nbsp&nbsp'.$testques[6].'</td></tr>';
                                             echo "<tr><td><a href='test.php?test=".$quest."&i=".$tem2."' class='oq-btn'><span class='glyphicon glyphicon-backward'></span> &nbsp;BACK</a></td>";
                                            echo "<td><a href='test.php?test=".$quest."&i=".$tem1."' class='oq-btn'><span class='glyphicon glyphicon-forward'></span> &nbsp;NEXT</a></td></tr>";
                                             }
                                           }
                                     ?>
                                      
                                    
                                         
                                    
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        
        <div class='oq-footer'>
            <div class='container-fluid'>
                <div class='row'>
                    <div class='col-md-6'><span class='oq-footerText'>ONLINE QUIZ 2017</span></div>
                    <div class='col-md-6'></div>
                </div>
            </div>
        </div>