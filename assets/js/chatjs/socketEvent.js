///////////////////////SOCKET CONNECTION AND EVENT HANDLER//////////////////////

var socket = io.connect(SOCKETURL);

socket.on('connect', () => {
    socket.emit('patientSocketConnected', { 'PATIENTID': PATIENTID ,'DOCTORID' : DOCTORID});
});

socket.on('chatExist',(data)=>{
    console.log(data.Message); 
    console.log(data.Chat); 
});

socket.on('messageRecievedEvent',function(msg){
    console.log(msg);
});

$(document).on("click",".submit", function (event) {
    event.preventDefault();
    $("#textMessage").focus();
    
    sendMessage();
});

$(document).on("keypress","#textMessage", function (event) {
   
    if (event.keyCode == 13 && event.shiftKey) {

    }else if(event.keyCode == 13) {
        
        event.preventDefault();
        $("#textMessage").focus();
        $(".submit").focus();

        sendMessage();
    }
});


