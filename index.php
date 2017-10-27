<?php
    session_start();
    require_once('dbconfig.php');
    $fail =0;
    if(isset($_POST['login'])){
        $uid = $_POST['userid'];
        $upass = $_POST['userpass'];
        $password = md5($upass);
        $result=mysqli_query($conn,"SELECT * FROM user WHERE userid = '$uid' AND password = '$password'");
        if(mysqli_num_rows($result) > 0){
            $_SESSION['usersession'] = $uid;
            header("Location: menu.php");
        }
        else{
            $fail = 1;
        }
    }
    if(isset($_SESSION['usersession'])){
        header("Location: menu.php");
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
                    <div class="col-md-2 pull-right">
                        <div class="oq-adminArea">
                            <a class="oq-admin" href="admin.php">Admin Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="oq-indexBody">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7">
                        <div class="oq-bodyContent">
                            <h1>Welcome to Online Quiz</h1>
                            <p>This Site will provide the quiz for various subject of interest. You need to login for online quiz.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="oq-login text-center">
                            <img src="images/quiz_1.png" class="oq-logo"><br><br>
                            <form class="form" action="" method="post">
                                <?php
                                    if($fail == 1){
                                        echo "<span class='oq-error'>*Incorrect details</span><br><br>";
                                    }
                                    if(isset($_GET['signup'])){
                                        echo "<span class='oq-success'>Signup successful please login</span><br><br>";
                                    }
                                ?>
                                <input type="text" class="form-control" placeholder="Enter your Login ID" name="userid"><br>
                                <input type="password" class="form-control" placeholder="Enter your Password" name="userpass"><br>
                                <input type="submit" class="form-control oq-btn" value="Login" name="login"><br><br>
                                New user? <a href="signup.php" class="">Signup for New Account</a><br><br>
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
                    <div class="col-md-6"><span class="oq-footerText pull-right">Developed by - <a href="http://akhil-regonda.azurewebsites.net/"><span class="oq-footerBy">A<span class="oq-footerSubName">khil</span> R<span class="oq-footerSubName">egonda</span></span></a></span></div>
                </div>
            </div>
        </div>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>