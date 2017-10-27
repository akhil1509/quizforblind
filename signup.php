<?php

require_once('dbconfig.php');
$fail = 0;
if(isset($_POST['signup'])){
    $uid = $_POST['userid'];
    $upass = $_POST['userpass'];
    $urepass = $_POST['userrepass'];
    $uname = $_POST['username'];
    $uadd = $_POST['useraddress'];
    $ucity = $_POST['usercity'];
    $uphone = $_POST['userphone'];
    $uemail = $_POST['useremail'];
    $password = md5($upass);
    if($res = mysqli_query($conn,"SELECT * FROM user WHERE userid = '$uid'")){
        if(mysqli_num_rows($res) > 0){
            $fail = 1;
        } 
        else if(mysqli_query($conn,"INSERT INTO user(userid,password,username,address,city,phone,email) VALUES('$uid','$password','$uname','$uadd','$ucity','$uphone','$uemail')") && mysqli_query($conn,"CREATE TABLE `$uid`(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,userid VARCHAR(50),sub VARCHAR(50),test VARCHAR(50),score VARCHAR(50))")){
            if(mysqli_query($conn,"INSERT INTO `$uid`(userid) VALUES('$uid')")){
                header("Location: index.php?signup");   
            }
        }
        else{
            echo "error ".mysqli_error($conn);
            $fail = 2;
        }
    }
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
                    <div class="col-md-8">
                        <div class="oq-userArea pull-right">
                            <a href='menu.php'><span class='glyphicon glyphicon-home'></span>&nbsp;&nbsp;Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="oq-signupBody">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="oq-signup text-center">
                            <img src="images/quiz_1.png" class="oq-logo"><br><br>
                            <span class="oq-signupHead">New User Signup</span><br><br>
                            <?php 
                                if($fail == 1){
                                    echo "<span class='oq-error'>*User already exists</span><br><br>";
                                }
                                if($fail == 2){
                                    echo "<span class='oq-error'>*Something went wrong, please re-enter</span><br><br>";
                                }
                                
                            ?>
                            <form class="form" action="" method="post" name="create">
                                <span id="iderror" class="oq-error"></span>
                                <input type="text" class="form-control" placeholder="Enter you Login ID" name="userid"  autofocus required><br>
                                <span id="passerror" class="oq-error"></span>
                                <input type="password" class="form-control" placeholder="Enter your Password" name="userpass" required><br>
                                <span id="repasserror" class="oq-error"></span>
                                <input type="password" class="form-control" placeholder="Re-enter your password" name="userrepass" required><br>
                                <span id="nameerror" class="oq-error"></span>
                                <input type="text" class="form-control" placeholder="Enter your name" name="username" required><br>
                                <span id="adderror" class="oq-error"></span>
                                <input type="text" class="form-control" placeholder="Enter your Address" name="useraddress" required><br>
                                <span id="cityerror" class="oq-error"></span>
                                <input type="text" class="form-control" placeholder="Enter your City" name="usercity" required><br>
                                <span id="phoneerror" class="oq-error"></span>
                                <input type="text" class="form-control" placeholder="Enter your Phone" name="userphone" required><br>
                                <span id="mailerror" class="oq-error"></span>
                                <input type="text" class="form-control" placeholder="Enter your Email" name="useremail" required><br><br>
                                <input type="submit" class="form-control btn btn-primary" value="Create Account" name="signup" onClick="return validate()"><br><br>
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
        <script type="text/javascript">
        console.log("working");
            function validate(){
                console.log("hello");
                var flag = 0;
                var id = document.forms['create']['userid'].value;
                console.log("id:"+id);
                var pass = document.forms['create']['userpass'].value;
                var repass = document.forms['create']['userrepass'].value;
                var name = document.forms['create']['username'].value;
                var addr = document.forms['create']['useraddress'].value;
                var city = document.forms['create']['usercity'].value;
                var phone = document.forms['create']['userphone'].value;
                var mail = document.forms['create']['useremail'].value;
                var result1 = id.match(/^([a-zA-Z])\w{4,12}$/);
                console.log("result 1"+result1);
                var result2 = pass.match(/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/);
                var result4 = name.match(/^[A-Za-z]{3,16}$/);
                var result5 = addr.match(/^[a-zA-Z0-9\-\,\ ]*/);
                var result6 = city.match(/^[A-Za-z]{8,16}$/);
                var result7 = phone.match(/^(7|8|9)\d{9}/);
                var result8 = mail.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
                console.log('flag '+flag);
                if(id == ""){
                    document.getElementById("iderror").innerHTML = "Enter User ID";
                }
                else if(!result1){
                    document.getElementById("iderror").innerHTML = "Invalid userid";
                    flag = 1;
                }else{
                    document.getElementById("iderror").innerHTML = "";
                }
                if(pass == ""){
                    document.getElementById("passerror").innerHTML = "Enter password";
                }
                else if(!result2){
                    document.getElementById("passerror").innerHTML = "Enter a valid password";
                    flag = 1;
                }else{
                    document.getElementById("passerror").innerHTML = "";
                }
                if(repass != pass){
                    document.getElementById("repasserror").innerHTML = "Password didn't match";
                    flag = 1;
                }else{
                    document.getElementById("repasserror").innerHTML = "";
                }
                console.log('name '+name);
                if(name == ""){
                    document.getElementById("nameerror").innerHTML = "Enter user name";
                }
                else if(!result4){
                    document.getElementById("nameerror").innerHTML = "Enter a valid user name";
                    flag = 1;
                }else{
                    document.getElementById("repasserror").innerHTML = "";
                }
                if(addr == ""){
                    document.getElementById("adderror").innerHTML = "Enter address";
                }
                else if(!result5){
                    document.getElementById("adderror").innerHTML = "Enter a valid address";
                    flag = 1;
                }else{
                    document.getElementById("repasserror").innerHTML = "";
                }
                if(city == ""){
                    document.getElementById("cityerror").innerHTML = "Enter city";
                }
                else if(!result6){
                    document.getElementById("cityerror").innerHTML = "Enter a valid city";
                    flag = 1;
                }else{
                    document.getElementById("repasserror").innerHTML = "";
                }
                if(phone == ""){
                    document.getElementById("phoneerror").innerHTML = "Enter Phone number";
                }
                else if(!result7){
                    document.getElementById("phoneerror").innerHTML = "Enter a valid Phone number";
                    flag = 1;
                }else{
                    document.getElementById("repasserror").innerHTML = "";
                }
                if(mail == ""){
                    document.getElementById("mailerror").innerHTML = "Enter Email";
                }
                else if(!result8){
                    document.getElementById("mailerror").innerHTML = "Enter a valid Email";
                    flag = 1;
                }
                else{
                    document.getElementById("repasserror").innerHTML = "";
                }
                if(flag == 1){
                    return false;
                }
                
            }
        </script>
    </body>
</html>