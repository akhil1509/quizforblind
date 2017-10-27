<?php
    session_start();
    require_once('dbconfig.php');
    $id = $_SESSION['adminsession'];
    $lang = $_SESSION['lang'];
    if($id == null){
        header('Location: admin.php');
    }
    if(isset($_GET['test'])){
        $test = $_GET['test'];
        $_SESSION['adminsession'] = $id;
        $_SESSION['test'] = $test;
        $_SESSION['lang'] = $lang;
        $testtitle = $lang.'-'.$test;
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
                                            <a href="viewtests.php?testlang=<?php echo $lang;?>"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="adminmenu.php"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a class="oq-btn" href="logout.php?logout">Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="oq-viewTestsBody">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="oq-viewTests">
                                            <div class="oq-testsHead">
                                                <?php
                                                    if(isset($_GET['error'])){
                                                        echo "<div class='row'><div class='col-md-12'><div class='pull-right'><span class='oq-error'>*Question already exists!</span></div></div></div><br>";
                                                    }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span class="oq-testsHeadText"><?php echo strtoupper($test);?></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="text-center">
                                                            <a href="savetest.php?test=<?php echo $test;?>" class="oq-btn">View the quiz</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="pull-right">
                                                            <a class="oq-addbtn" data-toggle="modal" data-target=".newtest">Add New Question</a>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <span>List of questions are shown below:</span>
                                            </div>
                                            
                                            
                                            
                                            <div class="modal fade newtest" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="oq-questionModal">
                                                            <form class="form" action="createquestions.php" method="post">
                                                                <span>Guidelines</span><br><br>
                                                                <textarea class="form-control" placeholder="Enter guidelines" name="guidelines"></textarea><br>
                                                                <span>Question</span><br><br>
                                                                <textarea class="form-control" placeholder="Enter the question" name="title" required></textarea><br>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-inline"><input type="radio" name="answer" value="A" required> &nbsp;A) &nbsp;<textarea class="form-control" placeholder="Enter option A" name="option1" required></textarea></div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-inline"><input type="radio" name="answer" value="B" required> &nbsp;B) &nbsp;<textarea class="form-control" placeholder="Enter option B" name="option2" required></textarea></div>
                                                                    </div>
                                                                </div><br>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-inline"><input type="radio" name="answer" value="C" required> &nbsp;C) &nbsp;<textarea class="form-control" placeholder="Enter option C" name="option3" required></textarea></div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-inline"><input type="radio" name="answer" value="D" required> &nbsp;D) &nbsp;<textarea class="form-control" placeholder="Enter option D" name="option4" required></textarea></div>
                                                                    </div>
                                                                </div><br>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-md-offset-3">
                                                                        <div class="form-inline"><input type="radio" name="answer" value="E" required> &nbsp;E) &nbsp;<textarea class="form-control" placeholder="Enter option E" name="option5" required></textarea></div>
                                                                    </div>
                                                                </div><br><br>
                                                                <div class="row">
                                                                    <div class="col-md-8 col-md-offset-2">
                                                                        <div class=""><textarea rows="5" class="form-control" placeholder="Enter explanation here" name="explain"></textarea></div>
                                                                    </div>
                                                                </div><br>
                                                                <input type="submit" class="form-control oq-btn" value="Create question" name="newques">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                                            </div>
                                            
                                            
                                            <table class="table oq-table">
                                                <tbody>
                                                    <?php
                                                        $res = mysqli_query($conn,"SELECT * FROM `$testtitle`");
                                                        if($res){
                                                            
                                                            if(mysqli_num_rows($res) > 0){
                                                            $i=1;
                                                            while($row1 = mysqli_fetch_assoc($res)) {
                                                                if($row1['guidelines']){
                                                                    echo "<tr><td colspan='3'>".nl2br(ucfirst($row1['guidelines']))."</td></tr>";
                                                                }
                                                                echo "<tr><td>Question ".$i."</td><td>".nl2br(ucfirst($row1['questions']))."<br><br><div class='row'><div class='col-md-6'>A) ".nl2br(ucfirst($row1['option1']))."</div><div class='col-md-6'>B)  ".nl2br(ucfirst($row1['option2']))."</div></div><br><div class='row'><div class='col-md-6'>C) ".nl2br(ucfirst($row1['option3']))."</div><div class='col-md-6'>D) ".nl2br(ucfirst($row1['option4']))."</div></div><br>".($row1['option5'] != null?"<div class='row'><div class='col-md-6 col-md-offset-3'>E) ".nl2br(ucfirst($row1['option5']))."</div></div><br>":" ")."<div class='row'><div class='col-md-6 col-md-offset-3'>Answer : ".nl2br(ucfirst($row1['answer']))."</div></div><br>
                                                                <div class='row'><div class='col-md-10 col-md-offset-1'><span class='oq-news'>Explaination:</span><br><br>".nl2br(ucfirst($row1['exp']))."</div></div></td><td class='oq-operations'><a data-toggle='modal' data-target='.".$row1['q_id']."' class='oq-btn'><span class='glyphicon glyphicon-pencil'></span> Edit Question</a> <br><br><a data-toggle='modal' data-target='.del".$row1['q_id']."' class='oq-deletebtn'><span class='glyphicon glyphicon-remove'></span> Delete</a></td></tr>";
                                                                $i++;
                                                                
                                                                
                                                                
                                                                echo "<div class='modal fade ".$row1['q_id']."' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel'>
                                                                  <div class='modal-dialog' role='document'>
                                                                    <div class='modal-content'>
                                                                        <div class='modal-body'>
                                                                            <div class='oq-questionModal'>
                                                                                <form class='form' action='upquestions.php' method='post'>
                                                                                    <span>Guidelines</span><br><br>
                                                                                    <textarea class='form-control' name='guidelines'>".$row1['guidelines']."</textarea><br>
                                                                                    <span>Question</span><br><br>
                                                                                    <input type='hidden' class='form-control' value='".$row1['q_id']."' name='qid'>
                                                                                    <textarea class='form-control' name='title'>".$row1['questions']."</textarea><br>
                                                                                    <div class='row'>
                                                                                        <div class='col-md-6'>
                                                                                            <div class='form-inline'><input type='radio' name='answer' value='A' ".($row1['answer']=='A'?'checked':'')."> &nbsp;A) &nbsp;<input type='text' class='form-control'  name='option1' value='".$row1['option1']."' required></div>
                                                                                        </div>
                                                                                        <div class='col-md-6'>
                                                                                            <div class='form-inline'><input type='radio' name='answer' value='B' ".($row1['answer']=='B'?'checked':'')."> &nbsp;B) &nbsp;<input type='text' class='form-control'  name='option2' value='".$row1['option2']."' required></div>
                                                                                        </div>
                                                                                    </div><br>
                                                                                    <div class='row'>
                                                                                        <div class='col-md-6'>
                                                                                            <div class='form-inline'><input type='radio' name='answer' value='C' ".($row1['answer']=='C'?'checked':'')."> &nbsp;C) &nbsp;<input type='text' class='form-control'  name='option3' value='".$row1['option3']."' required></div>
                                                                                        </div>
                                                                                        <div class='col-md-6'>
                                                                                            <div class='form-inline'><input type='radio' name='answer' value='D' ".($row1['answer']=='D'?'checked':'')."> &nbsp;D) &nbsp;<input type='text' class='form-control'  name='option4' value='".$row1['option4']."' required></div>
                                                                                        </div>
                                                                                    </div><br>
                                                                                    <div class='row'>
                                                                                        <div class='col-md-6 col-md-offset-3'>
                                                                                            <div class='form-inline'><input type='radio' name='answer' value='E' ".($row1['answer']=='E'?'checked':'')."> &nbsp;E) &nbsp;<input type='text' class='form-control'  name='option5' value='".$row1['option5']."'></div>
                                                                                        </div>
                                                                                    </div><br><br>
                                                                                    <div class='row'>
                                                                                        <div class='col-md-8 col-md-offset-2'>
                                                                                            <div>
                                                                                                <textarea rows='5' name='explain' class='form-control'>".$row1['exp']."</textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div><br>
                                                                                    <input type='submit' class='form-control oq-btn' value='Update question'  name='upques'>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                  </div>
                                                                </div>";
                                                                
                                                                echo "<div class='modal fade del".$row1['q_id']."' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel'>
                                                                  <div class='modal-dialog modal-sm' role='document'>
                                                                    <div class='modal-content'>
                                                                        <div class='modal-body'>
                                                                            <div class='oq-questionModal'>
                                                                                <span>Are you sure you want to delete?</span><br><br>
                                                                                <form class='form' action='quesdel.php' method='post'>
                                                                                    <input type='hidden' name='delval' value='".$row1['q_id']."'>
                                                                                    <input type='submit' name='qusdelete' value='Yes' class='oq-deletebtn form-control'><br>
                                                                                    <input type='button' value='No' class='oq-btn form-control' data-dismiss='modal'> 
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                  </div>
                                                                </div>";
                                                                
                                                                
                                                                
                                                            }
                                                        }  
                                                        else{
                                                            echo "<span class='oq-news'>No questions available</span>";
                                                        }
                                                    }
                                                    else{
                                                        echo "<span class='oq-news'>No questions available</span>";
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
                                    <div class="col-md-6">
                                    <!--<span class="oq-footerText pull-right">Developed by - <a href="http://akhil-regonda.azurewebsites.net/"><span class="oq-footerBy">A<span class="oq-footerSubName">khil</span> R<span class="oq-footerSubName">egonda</span></span></a></span>--></div>
                                </div>
                            </div>
                        </div>
                        <script src="js/jquery-3.1.1.min.js"></script>
                        <script src="js/bootstrap.js"></script>
                    </body>
                </html>

            <?php
        }
?>
