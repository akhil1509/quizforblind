<?php
    session_start();
    require_once('dbconfig.php');
    $id = $_SESSION['adminsession'];
    $lang = $_SESSION['lang'];
    $test = $_SESSION['test'];
    if($id == null){
        header('Location: admin.php');
    }
    $testtitle = $lang.'-'.$test;
    $_SESSION['adminsession'] = $id;
    $_SESSION['test'] = $test;
    if($result = mysqli_query($conn,"SELECT answer FROM `$testtitle`")){
        $quscount = mysqli_num_rows($result);
        $answer = array();
        $i=1;
        while($row1 = mysqli_fetch_assoc($result)){
            $answer[$i] = $row1['answer'];
            $i++;
        }
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
	    <meta name='author' content='Akhil Regonda'>
	    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
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
                                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="oq-scoreBoardBody">
        	<div class="oq-scoreBoard">
        		<div id="scoreboard">
        		<?php
        			if(isset($_POST['submit'])){
				        $radio = array();
						$tQus = $_POST['totalQus'];
						for($i=1;$i<=$tQus;$i++){
				            if(!isset($_POST['qus'.$i])){
				                $radio[$i]=" ";
				            }
				            else{
				                $radio[$i]=$_POST['qus'.$i];   
				            }
				        }
				        $score = 0;
				        $wrong = 0;
				        $uans = 0;
				        $correctAns = "";
				        $wrongAns = "";
				        $qUnAns = "";
				        for($i=1;$i<=$tQus;$i++){
				            if($radio[$i] == " "){
				                $uans++;
				                $qUnAns = $qUnAns.", Question ".$i." ";
				            }
				            else if($answer[$i] == $radio[$i]){
				                $score++;
				                $correctAns = $correctAns." Question ".$i." ";
				            }
				            else{
				                $wrong++;
				                $wrongAns = $wrongAns." Question ".$i." ";
				            }
				        }
				        if($wrongAns == "")
				        	$wrongAns = "none";
				        if($qUnAns == "")
				        	$qUnAns = "none";
				        if($correctAns == "")
				        	$correctAns = "none";
				        echo "<p id='scoreboard1'>Your score : ".$score."</p>";
				        echo "<p id='scoreboard2'>Number of wrong answers are: ".$wrong."</p>";
				        echo "<p id='scoreboard3'>Number of unanswered questions: ".$uans."</p>";
				        echo "<p id='scoreboard4'>Correct answered questions are: ".$correctAns."</p>";
				        echo "<p id='scoreboard5'>Unanswered questions are: ".$qUnAns."</p>";
				        echo "<p id='scoreboard6'>Wrong answered questions are: ".$wrongAns."</p>";
					}
					?>
        		</div>
        		<div>
        			<p id="retake">To take another test say the word "Menu" or say the word "STOP" to stop.</p>
        			<p id="spresult"></p>
        		</div>
        	</div>
        </div>
		<div class="oq-footer">
        	<div class="container-fluid">
                <div class="row">
                	<div class="col-md-6"><span class="oq-footerText">ONLINE QUIZ 2017</span></div>
                    <div class="col-md-6">
                    	<!--<span class="oq-footerText pull-right">Developed by - <a href="http://akhil-regonda.azurewebsites.net/"><span class="oq-footerBy">A<span class="oq-footerSubName">khil</span> R<span class="oq-footerSubName">egonda</span></span></a></span>-->
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script type="text/javascript">
        	var resultPara = document.querySelector('#spresult');
        	var syn = window.speechSynthesis;
			var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
			var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;
			var SpeechRecognitionEvent = SpeechRecognitionEvent || webkitSpeechRecognitionEvent;
			var test;
			var testThis;
			speakScore(1);
			function speakScore(i){
				console.log("i"+i);
				test = document.getElementById("scoreboard"+i).textContent;
				testThis = new SpeechSynthesisUtterance(test);
				syn.speak(testThis);
				testThis.onend = function(event) {
					i++;
					if(i<=6){
						speakScore(i);
					}
					if(i>6){
						retest();
					}
				}
			}
			function retest(){
				test = document.getElementById("retake").textContent;
				testThis = new SpeechSynthesisUtterance(test);
				syn.speak(testThis);
				testThis.onend = function(event) {
					speakTest();
				}
			}
			function speakTest(){
				var words = "menu | stop";
				var flag=0;
				var grammar = '#JSGF V1.0; grammar phrase; public <phrase> = ' + words +';';
			    var recognition = new SpeechRecognition();
			    var speechRecognitionList = new SpeechGrammarList();
			    speechRecognitionList.addFromString(grammar, 1);
			    recognition.grammars = speechRecognitionList;
			    recognition.lang = 'en-US';
			    recognition.interimResults = false;
			    recognition.maxAlternatives = 1;
			    recognition.start();
			    console.log(SpeechRecognition);
			    recognition.onresult = function(event) {
			        var speechResult = event.results[0][0].transcript;
			        if(speechResult == "menu") {
			        	flag = 1;
			        	window.location = 'menu.php';
			        }
			        else if(speechResult == "stop"){
			        	flag = 2;
			        	console.log("Stop");
			        }else {
				        flag = 3;
				        resultPara.textContent = 'Speech received: ' + speechResult + '. No such operation.';
				        var syn = window.speechSynthesis;
				        var testhead = document.getElementById("spresult").textContent;
				        var testThis = new SpeechSynthesisUtterance(testhead);
				        syn.speak(testThis);
				        testThis.onend = function(event) {
				            console.log('speak time:' + event.elapsedTime + ' milliseconds.');
				            retest();
				        }
				    }
			    }
			    recognition.onend = function() {
			        console.log("onend");
			        if(flag == 1 || flag == 2 || flag == 3){
			        	console.log("onend if");
            			recognition.stop();
			        }else{
            			if(flag == 4){
            				recognition.stop();
            			}else{
            				console.log("onend else");
			                recognition.stop();
			                retest();
            			}
            		}
			    }
			    recognition.onerror = function(event) {
			        flag = 4;
			        console.log("flag :"+flag);
			        retest();
			    }
			}
        </script>
	</body>
</html>