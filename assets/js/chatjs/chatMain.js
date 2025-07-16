/////////////////////SOCKET FUNCTIONS AND OTHER////////////////////

if(USERTYPE == 0 && USERTYPE != 1){
    var chat = _.template($("#chatListWrapper").html());
    var containter = _.template($("#MessageContainerWrapper").html());
}

var message = _.template($("#textMessageWrapper").html());

function sendMessage()
{
    var d = new Date();
    var createddatetime = formate_date(d);

    var messagetext = $("#textMessage").val();
    messagetext = messagetext.replace(/(?:\r\n|\r|\n)/g, '<br>')
    $("#textMessage").val('');
   
    if ($.trim(messagetext) == '' || PATIENTID == '' || DOCTORID == ''){
        return false;
    }

    data = {
        messagetype: 0,
        type: 1,
        mediatype: '',
        message: messagetext,
        createdDateTime: createddatetime,
    };

    appendMessage(data);

    socket.emit('messageSendIndividual', 
    {
        name: '',
        message: messagetext,
        type : USERTYPE,
        patientID: PATIENTID,
        doctorID : DOCTORID,
        sendername: 'HassanAqiq',
    });

}

function appendMessage(data){
    var html = message(data);
    $("#messageContainer").append(html);
    $("#messageContainer").animate({ scrollTop: $('#messageContainer').prop("scrollHeight")}, 1000);
}

function formate_date(d) {
    var month = (d.getMonth() + 1);
    month = ('0' + month).slice(-2);

    var day = d.getDate();
    day = ('0' + day).slice(-2);

    var year = d.getFullYear();

    var hour = d.getHours();
    hour = ('0' + hour).slice(-2);

    var min = d.getMinutes();
    min = ('0' + min).slice(-2);

    return month + '/' + day + '/' + year + ' ' + hour + ":" + min
}

function chatMessageTemplate(patientID){
   
    $('#dashboardContainer').addClass('hidden'); 
    $('#chatContainer').removeClass('hidden'); 

   html = containter({patientID : 152,name : 'HassanAqiq'});
   $('#chatContainer').html(html);

   $('#messageContainer').scrollPagination({
        'url': BASEURL+'doctor/chat/getChatMessages',
        'data': {
            'page':1,
            'doctorID': DOCTORID,
            'patientID' : patientID
        },

        'scroller': '#messageContainer',
        
        'before': function(){ // before load function, you can display a preloader div
            $('#messageContainer').addClass("loadingMessages");
        },
        
        'after': function(elementsLoaded){ // after loading content, you can use this function to animate your new elements
        
            $('#messageContainer').removeClass("loadingMessages");
            console.log(elementsLoaded);

            if(elementsLoaded.error === false && elementsLoaded.Messages.length)
            {
                var html = ""
                $.each(elementsLoaded.Messages,function(index,value){
                    html += message(value);
                });
                
                $("#messageContainer").prepend(html);
                if(elementsLoaded.page == 1)
                {
                    $("#messageContainer").scrollTop($("#messageContainer")[0].scrollHeight);
                }
            
            }
        }
    });
}

