<?php
    session_start();
    require_once('dbconfig.php');
    $adminid = $_SESSION['adminsession'];
    $_SESSION['adminsession'] = $adminid;
    if($adminid == null){
        header('Location: admin.php');
    }
    $result=mysqli_query($conn,"SELECT * FROM admin WHERE loginid = '$adminid'");
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) {
            $flag = 0;
            if(isset($_GET['createlang'])){
                $clang = strtolower($_GET['newlang']);
                $res1 = mysqli_query($conn,"SELECT * FROM lang WHERE subjects='$clang'");
                if(mysqli_num_rows($res1) > 0){
                    $flag = 1;
                }
                else{
                    if(mysqli_query($conn,"INSERT INTO lang(subjects) values('$clang')") && mysqli_query($conn, "CREATE TABLE `$clang` (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,t_id VARCHAR(50),tests TEXT,testtime VARCHAR(50))")){
                        $_SESSION['adminsession'] = $adminid;
                        header("Location: viewtests.php?testlang=$clang");
                    }
                    else{
                        echo "error ".mysqli_error($conn);
                    }
                }
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
                                        <span class="oq-username"> welcome <?php echo $row['loginid'];?> </span>
                                        <a class="oq-btn" href="logout.php?logout">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="oq-adminMenuBody">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4">
                                    <div class="oq-adminMenu">
                                        <div class="text-center">
                                            <img src="images/quiz_1.png" class="oq-logo"><br><br>
                                        </div>
                                        <a data-toggle="modal" data-target=".bs-example-modal-sm"><span class="flaticon-select-list"></span>&nbsp;&nbsp; Add/View Subjects</a><br><br>
                                        <a data-toggle="modal" data-target=".delete-sub"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp; Delete a Subject</a><br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    

        

                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="text-center">
                                        <img src="images/quiz_1.png" class="oq-logo"><br><br>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <div class="row">
                                             <form class="form" action="viewtests.php" method="get">
                                                <span class="oq-modalLangHead">Select the subject</span><br><br>
                                                <div class="col-md-2"></div>
                                                <div class="col-md-4">
                                                    <select class="form-control" name="testlang">
                                                        <?php
                                                            $res2 = mysqli_query($conn,"SELECT * FROM lang");
                                                            if(mysqli_num_rows($res2) > 0){
                                                                while($row2 = mysqli_fetch_assoc($res2)){
                                                                    echo "<option name='$row2[subjects]'>$row2[subjects]</option>";
                                                                }
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="submit" class="form-control oq-btn" value="view tests" name="viewtest">
                                                </div>
                                            </form>
                                        </div><br><br>
                                        <div class="text-center"><p>(or)</p></div><br>
                                        <div class="row">
                                            <?php
                                                if($flag == 1){
                                                    echo "<script>alert('language already exists');</script>";
                                                }
                                            ?>
                                            <form class="form" action="" method="get">
                                                <span class="oq-modalLangHead">Create new subject</span><br><br>
                                                <div class="col-md-2"></div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" placeholder="Enter the subject" name="newlang" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="submit" class="form-control oq-btn" value="Create" name="createlang">
                                                </div>
                                            </form>
                                        </div><br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="modal fade delete-sub" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="text-center">
                                        <img src="images/quiz_1.png" class="oq-logo"><br><br>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <div class="row">
                                             <form class="form" action="quesdel.php" method="get">
                                                <span class="oq-modalLangHead">Delete the subject</span><br><br>
                                                 <div class="col-md-2"></div>
                                                <div class="col-md-4">
                                                    <select class="form-control" name="testlang">
                                                        <option disabled>Select Subject</option>
                                                        <?php
                                                            $res2 = mysqli_query($conn,"SELECT * FROM lang");
                                                            if(mysqli_num_rows($res2) > 0){
                                                                while($row2 = mysqli_fetch_assoc($res2)){
                                                                    echo "<option name='$row2[subjects]'>$row2[subjects]</option>";
                                                                }
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                                 <div class="col-md-4">
                                                    <input type="submit" class="form-control oq-deletebtn" value="Delete subject" name="subjectdelete">
                                                 </div>
                                            </form>
                                        </div><br><br>
                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-8">
                                                <span class="oq-caution">*All the tests and questions of selected subject will be lost if delete subject is pressed</span>
                                            </div>
                                        </div>
                                        <br>
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

        <?php
            }
        }
?>
