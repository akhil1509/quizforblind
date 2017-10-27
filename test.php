<!DOCTYPE html>
<html>
<?php
    session_start();
    require_once('dbconfig.php');
    $id = $_SESSION['usersession'];
    $lang = $_SESSION['lang'];
    if($id == null){
        header('Location: admin.php');
    }
    if(isset($_GET['test'])){
        $test = $_GET['test'];
        $testtitle = $lang.'-'.$test;
        $_SESSION['adminsession'] = $id;
        $_SESSION['test'] = $test;
        $_SESSION['lang'] = $lang;
        echo "<head>
                <title>Welcome Online Exam</title>
                <link rel='stylesheet' type='text/css' href='css/bootstrap.css'>
                <link rel='stylesheet' type='text/css' href='main.css'>
                <link rel='stylesheet' type='text/css' href='css/font/flaticon.css'>
                <!--<link href='https://fonts.googleapis.com/css?family=Fira+Sans|Josefin+Sans' rel='stylesheet'>-->
                <meta charset='UTF-8'>
                <meta name='description' content='Online Exam'>
                <meta name='author' content='Akhil Regonda'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>";  
            if($result1 = mysqli_query($conn,"SELECT * FROM `$lang` WHERE tests = '$test'")){
                if(mysqli_num_rows($result1) > 0){
                    while($row2 = mysqli_fetch_assoc($result1)){
                        $ttime = $row2['testtime'];
                        echo "<script>
                                function timer(){
                                    console.log(".json_encode($row2['testtime']).");
                                    var expDate = new Date().getTime();
                                    var countDown = ".json_encode($row2['testtime']).";
                                    console.log('countDown'+countDown);
                                    var countDownDate = expDate+(countDown*60000);
                                    var x = setInterval(function() {
                                    var now = new Date().getTime();
                                    var distance = countDownDate - now;
                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                    document.getElementById('timer').innerHTML = minutes + 'm ' + seconds + 's ';
                                    if (distance < 0) {
                                        clearInterval(x);
                                        alert('time up!! click enter see you score');
                                        getScore(quiz);
                                    }
                                    }, 1000);
                                }
                            </script>
                            </head>";
                    }
                }
            }
            else{
                echo "error ".mysqli_error($conn);
            }
    }
    else{
        echo "error ".mysqli_error($conn);
    }
?>
            
                        
        
                    <body>
                        <div class="oq-header">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class=""><a href="index.php"><img src="images/quiz.png" class="oq-logo"></a></div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="oq-userArea pull-right">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="oq-viewTestsBody">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="oq-viewTests" id="test">
                                            <div class="oq-instruct">
                                                <h3 id="testHead">Online Mock Exam - Test of <?php echo $lang;?></h3><br>
                                                <h3 id="instructHead">Say the word "instructions" to listen instructions</h3><br><br>
                                                <p id="spresult7" class="spresult7"></p>
                                                <p id="spresult8" class="spresult8"></p>
                                                <p id="spresult" class="spresult"></p>
                                                <p id="instructions">Instructions are..<br>1. To select an option say option with number example "option 3".<br>2. To repeat question say the word "repeat question".<br>3. To navigate between questions say the word question and number example "question 3".<br>4. To submit the test say the word "submit".<br><br>Say start to start your exam with timer<br></p><br>
                                                <p id="spresult1" class="spresult1"></p>
                                                <h4 id="speakTimer">Time remaining : <span id="timer">40 Minutes 0 seconds</span></h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <form action="result.php" method="post" name="oqform">
                                                    <?php
                                                        $i = 1;
                                                        if($res = mysqli_query($conn,"SELECT * FROM `$testtitle`")){
                                                            if(mysqli_num_rows($res)>0){
                                                                $rowscount = mysqli_num_rows($res);
                                                                echo "<input type='hidden' id='rowscount' name='totalQus' value='".$rowscount."'><p id='spresult2' class='spresult2'></p>";
                                                                while($row = mysqli_fetch_assoc($res)){
                                                                    $j = 0;
                                                                    echo "
                                                                        <div id='ques".$i."'>";
                                                                        if($row['guidelines']){
                                                                            echo "<span>".nl2br($row['guidelines'])."</span><br><br>";
                                                                        }
                                                                        echo "<button class='oq-aLeft oq-questions oq-form-control' disabled>Question ".$i.") ".nl2br($row['questions'])."</button><br>";
                                                                       echo "<input type='hidden' value='".$i."' id='quesNo'>";
                                                                        echo "<span class='oq-options'><input type='radio' name='qus".$i."' value='A' id='temp".$i."'> &nbsp;1) <span id='oq-options".$i.++$j."'>".nl2br($row['option1'])."</span></span><br><br>";
                                                                        echo "<span class='oq-options'><input type='radio' name='qus".$i."' value='B'> &nbsp;2) <span id='oq-options".$i.++$j."'>".nl2br($row['option2'])."</span></span><br><br>
                                                                       <span class='oq-options'><input type='radio' name='qus".$i."' value='C'> &nbsp;3) <span id='oq-options".$i.++$j."'>".nl2br($row['option3'])."</span></span><br><br>
                                                                       <span class='oq-options'><input type='radio' name='qus".$i."' value='D'> &nbsp;4) <span id='oq-options".$i.++$j."'>".nl2br($row['option4'])."</span></span><br><br>
                                                                       ".($row['option5'] != null?"<span class='oq-options'><input type='radio' name='qus".$i."' value='E'> &nbsp;5) <span id='oq-options".$i.++$j."'>".nl2br($row['option5'])."</span></span>":"")."<br><br><br>
                                                                       </div>
                                                                    ";
                                                                    $i++;
                                                                }
                                                                echo "<input type='submit' class='oq-btn' name='submit' id='oqsubmit' value='submit test'>";
                                                            }
                                                        }
                                                        else{
                                                            echo "error ".mysqli_error($conn);
                                                        }
                                                    ?>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script src="js/jquery-3.1.1.min.js"></script>
                        <script src="js/bootstrap.js"></script>
                        <script src="js/script.js"></script>
                        <script>
                           
                           
                        </script>
                        <div class="oq-footer">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6"><span class="oq-footerText">ONLINE QUIZ 2017</span></div>
                                    <div class="col-md-6"><span class="oq-footerText pull-right">Developed by - <a href="http://akhil-regonda.azurewebsites.net/"><span class="oq-footerBy">A<span class="oq-footerSubName">khil</span> R<span class="oq-footerSubName">egonda</span></span></a></span></div>
                                </div>
                            </div>
                        </div>
                    </body>
                </html>