<?php
    session_start();
    require_once('dbconfig.php');
    $adminid = $_SESSION['adminsession']; 
    if($adminid == null){
        header('Location: admin.php');
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
                            <a href="adminresults.php"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href='menu.php'><span class='glyphicon glyphicon-home'></span>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a class='oq-btn' href='logout.php?logout'>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='oq-userResultBody'>
            <div class='container-fluid'>
                <div class='row'>
                    <div class='col-md-8 col-md-offset-2'>
                        <div class="oq-userResult">
                            <h5>Student results:</h5><br>
                           <table class='table oq-table'>
                               <tr class="usertable">
                                    <th>Sno.</th>
                                    <th>Student ID</th>
                                    <th>Subject Name</th>
                                    <th>Test Name</th>
                                    <th>Score</th>
                               </tr>
                               <?php
                                    if(isset($_GET['user'])){
                                        $user = $_GET['user'];
                                        if($res = mysqli_query($conn,"SELECT * FROM `$user`")){
                                            if(mysqli_num_rows($res) > 0){
                                                $i = 1;
                                                while($row = mysqli_fetch_assoc($res)){
                                                    echo "<tr class='usertable'><td>".$i."</td><td>".$row['userid']."</td><td>".$row['sub']."</td><td>".$row['test']."</td><td>".$row['score']."</td></tr>";
                                                    $i++;
                                                }
                                            }
                                        }
                                    }  
                               ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="oq-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6"><span class="oq-footerText">ONLINE QUIZ 2017</span></div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </div>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>