<?php
session_start();
require_once('dbconfig.php');
$fail = 0;
if(isset($_POST['login'])){
    $aid = $_POST['adminid'];
    $apass = $_POST['adminpass'];

    $password = md5($apass);
    
    $result = mysqli_query($conn,"SELECT * FROM admin WHERE loginid = '$aid' AND pass = '$apass'");
    if(mysqli_num_rows($result) > 0){
            $_SESSION['adminsession'] = $aid;
            header("Location: adminmenu.php");
    }
    else{
        echo "error ".mysqli_error($conn);
        $fail = 1;
    }
}
if(isset($_SESSION['adminsession'])){
    header("Location: adminmenu.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Online Exam</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="main.css">
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans|Josefin+Sans" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="description" content="Online Exam">
        <meta name="author" content="Sukanya Ledalla, Akhil Regonda, Nishanth Kadapakonda">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            require_once('dbconfig.php');
        ?>
    </head>
    <body>
        <div class="oq-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class=""><a href="index.php"><img src="images/quiz.png" class="oq-logo"></a></div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </div>
        <div class="oq-adminloginBody">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="oq-adminlogin text-center">
                            <img src="images/quiz_1.png" class="oq-logo"><br><br>
                            <span class="oq-signupHead">Admin login</span><br><br>
                            <?php if($fail == 1){
                                    echo "<span class='oq-error'>*Invalid details</span><br><br>";
                                    }
                            ?>
                            <form class="form" action="" method="post">
                                <input type="text" class="form-control" placeholder="Enter you Login ID" name="adminid" required autofocus><br>
                                <input type="password" class="form-control" placeholder="Enter your Password" name="adminpass" required><br>
                                <input type="submit" class="form-control btn btn-primary" value="Login" name="login"><br><br>
                            </form> 
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