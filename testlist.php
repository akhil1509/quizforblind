<?php
    session_start();
    require_once('dbconfig.php');
    $userid = $_SESSION['usersession'];
    if($userid == null){
        header('Location: index.php');
    }
    $subject = $_GET['subject'];
    $result=mysqli_query($conn,"SELECT * FROM user WHERE userid = '$userid'");
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) {
            $_SESSION['usersession'] = $userid;
            $_SESSION['lang'] = $subject;
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
                    <?php
                        $result1 = mysqli_query($conn,"SELECT * FROM `$subject`");
                        echo "<script>var words = [],k = 0;</script>";
                        if(mysqli_num_rows($result1) > 0){
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                echo "<script>words[k] = ".json_encode($row1['tests']).";
                                console.log('Words:'+words);
                                k++;
                                </script>";
                            }
                        }
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
                                        <span class="oq-username"> welcome <?php echo $row['username'];?> </span>
                                        <a class="btn btn-primary" href="logout.php">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="oq-menuBody">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="oq-menu">
                                            <script type="text/javascript">
                                                document.write('<span id="oq-subjectsList">List of tests for the subject <?php echo $subject?> are..<br><br>');
                                                for(i=0;i<k;i++){
                                                    
                                                    document.write("<span>"+words[i]+".</span><br>");
                                                    
                                                }
                                                document.write('Choose one by saying the test name or say repeat to repeat the list.</span>');
                                            </script>
                                        <p id="spresult" class="spresult"></p>
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
                    <script type="text/javascript">
                        for(i=0;i<k;i++){
                            console.log('words '+words[i]);
                        }
                        var syn = window.speechSynthesis;
                        var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
                        var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;
                        var SpeechRecognitionEvent = SpeechRecognitionEvent || webkitSpeechRecognitionEvent;
                        var lsub = document.getElementById("oq-subjectsList").textContent;
                        console.log(lsub);
                        var slsub = new SpeechSynthesisUtterance(lsub);
                        console.log(slsub);
                        syn.speak(slsub);
                        slsub.onend = function(event) {
                            console.log("end");
                            subjects();
                        }
                        var resultPara = document.querySelector('.spresult');
                        function subjects(){
                            var flag=0;
                            console.log("subjects");
                            var grammar = '#JSGF V1.0; grammar phrase; public <phrase> = ' + words +';';
                            var recognition = new SpeechRecognition();
                            var speechRecognitionList = new SpeechGrammarList();
                            speechRecognitionList.addFromString(grammar, 1);
                            recognition.grammars = speechRecognitionList;
                            recognition.lang = 'en-US';
                            recognition.interimResults = false;
                            recognition.maxAlternatives = 1;
                            recognition.start();
                            recognition.onresult = function(event) {
                                var speechResult = event.results[0][0].transcript;
                                console.log("speechResult:"+speechResult);
                                console.log("words:"+words);
                                for(var i=0;i<k;i++){
                                    if(speechResult.toLowerCase() === words[i].toLowerCase()) {
                                        flag = 1;
                                        console.log("speech result: "+speechResult);
                                        resultPara.textContent = 'Speech received: ' + speechResult + '.';
                                        var syn = window.speechSynthesis;
                                        var testhead = document.getElementById("spresult").textContent;
                                        var testThis = new SpeechSynthesisUtterance(testhead);
                                        syn.speak(testThis);
                                        console.log(testThis);
                                        testThis.onend = function(event) {
                                               window.location = "test.php?test="+speechResult;
                                        }
                                        break;
                                    }
                                    else if(speechResult === "repeat"){
                                        flag = 1;
                                        console.log("speech result: "+speechResult);
                                        resultPara.textContent = 'Speech received: ' + speechResult + '.';
                                        var syn = window.speechSynthesis;
                                        var testhead = document.getElementById("spresult").textContent;
                                        var testThis = new SpeechSynthesisUtterance(testhead);
                                        syn.speak(testThis);
                                        console.log(testThis);
                                        testThis.onend = function(event) {
                                               speakSub();
                                        }
                                        break;
                                    }
                                }
                                if(i == k) {
                                    flag = 2;
                                    resultPara.textContent = 'Speech received: ' + speechResult + '. No such operation.';
                                    var syn = window.speechSynthesis;
                                    var noOper = document.getElementById("spresult").textContent;
                                    var noOpr = new SpeechSynthesisUtterance(noOper);
                                    syn.speak(noOpr);
                                    console.log("-else");
                                    console.log(noOpr);
                                    noOpr.onend = function(event) {
                                        console.log('No such operation over. speak time:' + event.elapsedTime + ' milliseconds.');
                                        speakSub();
                                    }
                                }
                            }
                            recognition.onend = function() {
                                console.log("onend");
                                if(flag == 1 || flag == 2){
                                    console.log("onend if");
                                    console.log("flag :"+flag);
                                    recognition.stop();
                                }
                                else{
                                    if(flag == 4){
                                        console.log("flag :"+flag);
                                        recognition.stop();
                                    }
                                    else{
                                        console.log("onend else else");
                                        recognition.stop();
                                        console.log("flag :"+flag);
                                        speakSub();
                                    }
                                }
                            }
                            
                            recognition.onerror = function(event) {
                                flag = 4;
                                console.log("flag :"+flag);
                                speakSub();
                            }
                        }
                        function speakSub(){
                            console.log("in speakSub");
                            var lsub = document.getElementById("oq-subjectsList").textContent;
                            var slsub = new SpeechSynthesisUtterance(lsub);
                            syn.speak(slsub);
                            console.log("in speakSub");
                            slsub.onend = function(event) {
                                console.log("speekSubend");
                                subjects();
                            }
                        }
                    </script>         
                </body>
            </html>

        <?php
            }
        }
?>
