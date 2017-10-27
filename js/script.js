var count = document.getElementById("rowscount").value;
console.log(count);
var i=1;
var syn = window.speechSynthesis;
var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;
var SpeechRecognitionEvent = SpeechRecognitionEvent || webkitSpeechRecognitionEvent;
var testhead = document.getElementById("testHead").textContent;
var testThis = new SpeechSynthesisUtterance(testhead);
syn.speak(testThis);
testThis.onend = function(event) {
    //console.log('Test head over. speak time:' + event.elapsedTime + ' milliseconds.');
    instruct();
}

function instruct(){
    var instructHead = document.getElementById("instructHead").textContent;
    var instructThis = new SpeechSynthesisUtterance(instructHead);
    syn.speak(instructThis);
    console.log('instructions');
    instructThis.onend = function(event) {
        testSpeech();
    }
}

var phrases = "instructions | instruction";

var resultPara = document.querySelector('.spresult');
var resultPara7 = document.querySelector('.spresult7');
var resultPara8 = document.querySelector('.spresult8');

function testSpeech() {
    var flag=0;
    console.log("in testspeech");
    var grammar = '#JSGF V1.0; grammar phrase; public <phrase> = ' + phrases +';';
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
        if(speechResult == "instructions" || speechResult == "instruction") {
            flag = 1;
            console.log("speech result: "+speechResult);
            resultPara.textContent = 'Speech received: ' + speechResult + '.';
            var syn = window.speechSynthesis;
            var testhead = document.getElementById("spresult").textContent;
            var testThis = new SpeechSynthesisUtterance(testhead);
            syn.speak(testThis);
            testThis.onend = function(event) {
                console.log('Instructions over. speak time:' + event.elapsedTime + ' milliseconds.');
                startTimer();
            }
        } else {
            flag = 2;
            console.log("speech result: "+speechResult);
            resultPara.textContent = 'Speech received: ' + speechResult + '. No such operation.';
            var syn = window.speechSynthesis;
            var testhead = document.getElementById("spresult").textContent;
            var testThis = new SpeechSynthesisUtterance(testhead);
            syn.speak(testThis);
            testThis.onend = function(event) {
                console.log('No such operation over. speak time:' + event.elapsedTime + ' milliseconds.');
                instruct();
            }
        }
        console.log('Confidence: ' + event.results[0][0].confidence);
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
                instruct();
            }
        }
    }
    
    recognition.onerror = function(event) {
        flag = 4;
        console.log("flag :"+flag);
        instruct();
    }
}



//instructions and timer 



function startTimer(){
    var show = document.getElementById("instructions").textContent;
    var utterThis = new SpeechSynthesisUtterance(show);
    syn.speak(utterThis);
    utterThis.onend = function(event) {
        console.log('Instructions over. speak time:' + event.elapsedTime + ' milliseconds.');
        speech("start");
    }
}

var resultPara1 = document.querySelector('.spresult1');

function speech(testValue){
    var flag = 0;
  console.log("in speech");
  var grammar = '#JSGF V1.0; grammar phrase; public <phrase> = ' + testValue +';';
  console.log(SpeechRecognition);
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
    if(speechResult === testValue) {
        flag = 1;
        resultPara1.textContent = 'Speech received: ' + speechResult + '.';
        var syn = window.speechSynthesis;
        var testhead = document.getElementById("spresult1").textContent;
        var testThis = new SpeechSynthesisUtterance(testhead);
        syn.speak(testThis);
        testThis.onend = function(event) {
            console.log('speak time:' + event.elapsedTime + ' milliseconds.');
            timer();
            readTimerQuestion();
        }
    } else {
        flag = 2;
        resultPara1.textContent = 'Speech received: ' + speechResult + '. No such operation.';
        var syn = window.speechSynthesis;
        var testhead = document.getElementById("spresult1").textContent;
        var testThis = new SpeechSynthesisUtterance(testhead);
        syn.speak(testThis);
        testThis.onend = function(event) {
            console.log('speak time:' + event.elapsedTime + ' milliseconds.');
            startTimer();
        }
    }

    console.log('Confidence: ' + event.results[0][0].confidence);
  }

    recognition.onend = function() {
        console.log("onend");
        if(flag == 1 || flag == 2){
            console.log("onend if");
            recognition.stop();
        }
        else{
            if (flag == 4) {
                recognition.stop();
            }else{
                console.log("onend else");
                recognition.stop();
                startTimer();
            }
            flag = 3;
        }
    }
    
    recognition.onerror = function(event) {
        if(flag != 3){
            flag = 4;
            startTimer();
        }
    }
}





//timer and exam



function timer() {
        var expDate = new Date().getTime();
        var countDownDate = expDate + 2401100;
        var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("timer").innerHTML = minutes + "minutes " + seconds + "seconds ";
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("oqsubmit").click();
            }
        }, 1000);
}

var qNo = 1;

function readTimerQuestion(){
    var speakTimer = document.getElementById("speakTimer").textContent;
    var timeThis = new SpeechSynthesisUtterance(speakTimer);
    syn.speak(timeThis);
    var ques = document.getElementById("ques1").textContent;
    var quesThis = new SpeechSynthesisUtterance(ques);
    syn.speak(quesThis);
    quesThis.onend = function(event) {
        console.log('speak time:' + event.elapsedTime + ' milliseconds.');
        speechQuestion(qNo,0);
    }
}
function readQuestion(qNo){
    var ques = document.getElementById("ques"+qNo).textContent;
    var quesThis = new SpeechSynthesisUtterance(ques);
    syn.speak(quesThis);
    quesThis.onend = function(event) {
        console.log('speak time:' + event.elapsedTime + ' milliseconds.');
        speechQuestion(qNo,0);
    }
}


var resultPara2 = document.querySelector('.spresult2'); 
var navQus = 0;
function speechQuestion(qNo,navQus){
    var flag = 0;
    var l = 1;
    var qwords = "";
    var words = "repeat question | repeat options | option 1 | option one | option b | option c | option d | option e | next question";
    while(l <= count){
        qwords = qwords + "question "+l+" | question "+inWords(l)+" | ";
        console.log("qwords : "+qwords);
        l++;
    } 
    qwords = qwords + words;
    console.log("qwords "+ qwords);
    console.log("in testspeech");
    var grammar = '#JSGF V1.0; grammar phrase; public <phrase> = ' + qwords +';';
    console.log(SpeechRecognition);
    var recognition = new SpeechRecognition();
    var speechRecognitionList = new SpeechGrammarList();
    speechRecognitionList.addFromString(grammar, 1);
    recognition.grammars = speechRecognitionList;
    recognition.lang = 'en-US';
    recognition.interimResults = false;
    recognition.maxAlternatives = 1;
    recognition.start();
    console.log("qNo(speechQus:"+qNo);
    recognition.onresult = function(event) {
        var speechResult = event.results[0][0].transcript;
        console.log("speechResult:"+speechResult);
        var syn = window.speechSynthesis;
        var ans;
        var radios;
        console.log("no "+qNo);
        for(l=1;l<=count;l++){
            var temper = "question "+l;
            var temper1 = "question "+inWords(l); 
            console.log("temper:"+temper+" temper1:"+temper1)
            if(speechResult == temper || speechResult == temper1){
                qNo = l;
                flag = 1;
                readQuestion(qNo);
                break;
            }
        }
        if(l > count){
            if(speechResult == "repeat question") {
                flag = 1;
                speakQuestion(speechResult);
                readQuestion(qNo);
            }
            else if(speechResult == "option 1" || speechResult == "option one") {
                flag = 1;
                option(qNo,0,speechResult);
            }
            else if(speechResult == "option 2" || speechResult == "option two" || speechResult == "option to") {
                flag = 1;
                option(qNo,1,speechResult);
            }
            else if(speechResult == "option 3" || speechResult == "option three") {
                flag = 1;
                option(qNo,2,speechResult);
            }
            else if(speechResult == "option 4" || speechResult == "option four" || speechResult == "option for") {
                flag = 1;
                option(qNo,3,speechResult);
            }
            else if(speechResult == "option 5" || speechResult == "option five") {
                flag = 1;
                option(qNo,4,speechResult);
            }
            else if(speechResult == "next question"){
                flag = 1;
                qNo++;
                readQuestion(qNo);
            }
            else if(speechResult == "previous question"){
                flag = 1;
                qNo--;
                readQuestion(qNo);
            }
            else if(speechResult == "submit" || speechResult == "submit test"){
                flag = 1;
                document.getElementById("oqsubmit").click();
            }
            else{
                if(navQus == 0){
                    flag = 2;
                    console.log("ques if");
                    resultPara2.textContent = 'Speech received: ' + speechResult + '. No such operation.';
                    var testhead = document.getElementById("spresult2").textContent;
                    var navQustion = new SpeechSynthesisUtterance(testhead);
                    syn.speak(navQustion);
                    navQustion.onend = function(event){
                        readQuestion(qNo);
                    }
                }
                else{
                    flag = 4;
                    console.log("ques else");
                    if(navQus == 1){
                        var navQustions = new SpeechSynthesisUtterance("For next question say next question");
                    }
                    else if(navQus == 2){
                        var navQustions = new SpeechSynthesisUtterance("This is your final question. For previous question say previous question or to submit the test say submit");
                    }
                    else if(navQus == 3){
                        var navQustions = new SpeechSynthesisUtterance("For next question say next question and for previous question say previous question");               
                    }
                    syn.speak(navQustions);
                    navQustions.onend = function(event) {
                        console.log('speak time:' + event.elapsedTime + ' milliseconds.');
                        console.log("question no: "+qNo);
                        speechQuestion(qNo,navQus);
                    }
                }
            }
        }
        
        console.log('Confidence: ' + event.results[0][0].confidence);
    }


    recognition.onend = function() {
        console.log("onend");
        if(flag == 1 || flag == 2 || flag == 4 || flag == 6){
            console.log("onend if");
            recognition.stop();
        }
        else if(navQus > 0){
            var navQustions;
            console.log("next else"+navQus);
            recognition.stop();
            if(navQus == 1){
                console.log("next if");
                navQustions = new SpeechSynthesisUtterance("For next question say next question");
                speakNav(navQustions);
            }
            else if(navQus == 2){
                console.log("next else if");
                navQustions = new SpeechSynthesisUtterance("This is your final question. For previous question say previous question or to submit the test say submit");
                speakNav(navQustions);
            }
            else if(navQus == 3){
                console.log("next else");
                navQustions = new SpeechSynthesisUtterance("For next question say next question and for previous question say previous question");               
                speakNav(navQustions);   
            }
            console.log("next end");
        }
        else{
            if (flag == 5 || flag == 6) {
                recognition.stop();
            }
            else{
                console.log("onend else");
                recognition.stop();
                readQuestion(qNo);
            }
            flag = 3;
        }
    }
    
    recognition.onerror = function(event) {
        if(navQus > 0){
            flag = 6;
            recognition.stop();
            console.log("error next else");
            if(navQus == 1){
                var navQustion = new SpeechSynthesisUtterance("For next question say next question");
            }
            else if(navQus == 2){
                var navQustion = new SpeechSynthesisUtterance("This is your final question. For previous question say previous question or to submit the test say submit");
            }
            else if(navQus == 3){
                var navQustion = new SpeechSynthesisUtterance("For next question say next question and for previous question say previous question");               
            }
            syn.speak(navQustion);
            navQustion.onend = function(event) {
                console.log('speak time:' + event.elapsedTime + ' milliseconds.');
                console.log("question no: "+qNo);
                speechQuestion(qNo,navQus);
            }
        }
        else if(flag != 3){
            flag = 5;
            console.log("error next");
            recognition.stop();
            readQuestion(qNo);
        }
    }
}


var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

function inWords (num) {
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) : '';
    return str;
}


function speakNav(navQustions){
    console.log("navQustion:"+navQustions);
    syn.speak(navQustions);
    navQustions.onend = function(event) {
        console.log('speak time:' + event.elapsedTime + ' milliseconds.');
        console.log("question no: "+qNo);
        speechQuestion(qNo,navQus);
    }
}


function option(m,n,speechResult){
    var navQ;
    console.log("m "+m+" n "+n);
    console.log("qNo(option):"+qNo);
    speakOption(speechResult);
    radios = document.getElementsByName('qus'+m);
    radios[n].checked = "true";
    console.log("oq-options"+m+""+(n+1));
    ans = document.getElementById("oq-options"+m+""+(n+1)).innerHTML;
    var opt = new SpeechSynthesisUtterance(ans);
    syn.speak(opt);
    if(m == 1){
        navQ = new SpeechSynthesisUtterance("For next question say next question");
        syn.speak(navQ);
        navQ.onend = function(event) {
            console.log('speak time:' + event.elapsedTime + ' milliseconds.');
            speechQuestion(m,1);
        }
    }else if(m == count){
        navQ = new SpeechSynthesisUtterance("This is your final question. For previous question say previous question or to submit the test say submit.");
        syn.speak(navQ);
        navQ.onend = function(event) {
            console.log('speak time:' + event.elapsedTime + ' milliseconds.');
            speechQuestion(m,2);
        }
    }else{
        navQ = new SpeechSynthesisUtterance("For next question say next question and for previous question say previous question");
        syn.speak(navQ);
        navQ.onend = function(event) {
            console.log('speak time:' + event.elapsedTime + ' milliseconds.');
            speechQuestion(m,3);
        }
    }
}

function speakOption(speechResult){
    resultPara2.textContent = 'Speech received: ' + speechResult + '.';
    var syn = window.speechSynthesis;
    var testhead = document.getElementById("spresult2").textContent;
    var testThis = new SpeechSynthesisUtterance(testhead);
    syn.speak(testThis);
}