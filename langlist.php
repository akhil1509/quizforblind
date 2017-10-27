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
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="main.css">
        <link rel="stylesheet" type="text/css" href="css/font/flaticon.css">
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans|Josefin+Sans" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="description" content="Online Exam">
        <meta name="author" content="Sukanya Ledalla, Akhil Regonda, Nishanth Kadapakonda">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="oq-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class=""><a href="index.php"><img src="images/quiz.png" class="oq-logo"></a></div>
                    </div>
                    <div class="col-md-8">
                        <div class="oq-userArea pull-right">
                            <a href="menu.php"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="oq-btn" href="logout.php?logout">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="oq-viewTestsBody">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="oq-viewTests">
                            <div class="oq-testsHead">                        
                                <span>List of tests are shown below:</span>
                            </div>
                            <table class="table oq-table">
                                <tbody>
                                     
                                    <?php
                                        $result=mysqli_query($conn,"SELECT * FROM lang");
                                        if($result){
                                            if(mysqli_num_rows($result) > 0){
                                                $_SESSION['usersession'] = $userid;
                                                $i=1;
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $l = $row['languages'];
                                                    $res = mysqli_query($conn,"SELECT * FROM `$l`");
                                                    if($res){
                                                        $count = mysqli_num_rows($res);
                                                    }
                                                    else{
                                                        $count = 0;
                                                    }
                                                    echo "<tr class='usertable'><td>".$i++."</td><td>".$row['languages']."</td><td>".$count." tests</td><td class='oq-user-tab'><a href='testslist.php?lang=".$row['languages']."' class='oq-btn'><span class='glyphicon glyphicon-eye-open'></span> &nbsp;View Tests</a></td><tr>";
                                                }
                                            }   
                                        }
                                        else{
                                            echo "<span class='oq-news'>No. subjects available</span>";
                                        }
                                    ?>
                                </tbody>
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