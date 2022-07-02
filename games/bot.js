window.onload=function(){
    document.getElementsByClassName('sbatype')[0].innerHTML 
    =  '<div class="sgp"'+
     'onclick="startBot()" style="margin-left: auto; width: 20%; margin-right: auto">Start Bot</div>';
}
function startBot(){
    document.getElementsByClassName('sbatype')[0].innerHTML
     = '<div class="tintbt" style="padding-bottom: 15px; display: flex;margin-left: auto; margin-right: auto; width: 100%;"><input type="text" style="width: 99%; border:0px; border-bottom: 1px solid;'+
     '" placeholder="Message Bot" id="smtbot" onkeyup="setSend(this.value)"><div id="sendtobot"></div></div>';
     botSendMessage();
}
function setSend(value){
    if(value == "" || value == " " || value == "  "){
        document.getElementById('smtbot').style.width = '99%';
        document.getElementById('sendtobot').innerHTML = '';    
            
    }
    else {
        document.getElementById('smtbot').style.width = '80%';
        document.getElementById('sendtobot').innerHTML = '<div class="sbtn" onclick="sndmtbt(document.getElementById(\'smtbot\').value)">Send</div>'; 
    }
}
function botSendMessage(){
    var dbe = document.getElementById('gamebotbody');
    for(i = 0; i< 20; ++i){
        dbe.innerHTML += '<div class="ayo"></div>';
    }
    document.getElementsByClassName('sbatype')[0].innerHTML
     = '<div class="tintbt" style="padding-bottom: 15px; display: flex;margin-left: auto; margin-right: auto; width: 100%;"><input type="text" style="width: 99%; border:0px; border-bottom: 1px solid;'+
     '" placeholder="Message Bot" id="smtbot" onkeyup="setSend(this.value)"><div id="sendtobot" '+ 
     'onclick="sndmtbt(document.getElementById(\'smtbot\').value)"></div></div>'; 
    document.getElementsByClassName('ayo')[0].innerHTML = 'Hey!, Game Bot at your service';
}
var date = new Date();
var botstuffs = {
    hello:"Hi",
    hi:"Hey, there!",
    name:"I am !GaME bOT.",
    game:"Which game do you want to play today? 1. Tic Tac Toe",
    time: "The time is "+date.getHours() + ":" + date.getMinutes(),
    date: "Today's date is "+date.getFullYear() + "/" + date.getMonth() + "/" + date.getDay(),
    datetime: "Today's date is "+ date.getFullYear() + "/" + date.getMonth() + "/" + date.getDay() +" and time is "+ date.getHours() + ":" + date.getMinutes(),
}
function sndmtbt(av){
        var greetings = ["hi", "hey", "hello", 'greetings', 'wassup', 'what\'s up'];
        var responses = ['hey there', 'how are you', 'hello'];
        var d = new Date();
        var questions = ["What's the date, What's today's date, What's the date today"]
        var dresponses = [d.getFullYear()+"/"+d.getMonth()+"/"+d.getDay()];
        for(word in av.split(" ")){
        if(word in greetings){
            document.getElementById('test').innerHTML = responses[parseInt(Math.random()* 3)];
        }
            else if(word in questions){
                document.getElementById('test').innerHTML = dresponses[0];
            }
    }
}