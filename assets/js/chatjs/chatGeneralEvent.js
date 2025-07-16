/////////////////////////////CHAT OTHER EVENTS////////////////////////////////


$(function(){

    $('#chatListContainer').scrollPagination({
        'url': BASEURL+'doctor/chat/getDoctorChats',
        'data': {
            'page':1,
            'doctorID':DOCTORID,
        },

        'scroller': '#chatListContainer',
        
        'before': function(){ // before load function, you can display a preloader div
            $('#chatListContainer').addClass("loadingMessages");
        },
        
        'after': function(elementsLoaded){ // after loading content, you can use this function to animate your new elements
           
            $('#chatListContainer').removeClass("loadingMessages");
            
           
            if(elementsLoaded.error === false && elementsLoaded.Chats.length)
            {
                var html = ""
                $.each(elementsLoaded.Chats,function(index,value){

                    

                    var PatientPhoto = BASEURL + value.patient_photo;
                    value.patient_photo = PatientPhoto;

                    value.patientData = '<script class="data" type="application/json">'+JSON.stringify(value)+ '</script>';
                    console.log(value);
                    html += chat(value);
                });
                
                $("#chatListContainer").prepend(html);
                $("#chatListContainer").scrollTop($("#chatListContainer")[0].scrollHeight);
               
            }
        }
    });
    
    // $('#messageContainer').scrollPagination({
    //     'url': BASEURL+'users/chat/getChatMessages',
    //     'data': {
    //         'page':1,
    //         'doctorID':DOCTORID,
    //         'patientID' : PATIENTID,
    //     },

    //     'scroller': '#messageContainer',
        
    //     'before': function(){ // before load function, you can display a preloader div
    //         $('#messageContainer').addClass("loadingMessages");
    //     },
        
    //     'after': function(elementsLoaded){ // after loading content, you can use this function to animate your new elements
           
    //         $('#messageContainer').removeClass("loadingMessages");
    //         console.log(elementsLoaded);

    //         if(elementsLoaded.error === false && elementsLoaded.Messages.length)
    //         {
    //             var html = ""
    //             $.each(elementsLoaded.Messages,function(index,value){
    //                 html += message(value);
    //             });
                
    //             $("#messageContainer").prepend(html);
    //             if(elementsLoaded.page == 1)
    //             {
    //                  $("#messageContainer").scrollTop($("#messageContainer")[0].scrollHeight);
    //             }
               
    //         }
    //     }
    // });

    $(".toggler").on('click',function(e){
        if($(this).hasClass('icon-arrow-right16')){
            $(this).toggleClass('icon-arrow-left16').removeClass('icon-arrow-right16');  
        }else{
            $(this).toggleClass('icon-arrow-right16').removeClass('icon-arrow-left16');
        }
    });

});

$(document).on("click",".contactlist",function(){
    var data = JSON.parse($(".data", this).html());


    $('#dashboardContainer').addClass('hidden'); 
    $('#chatContainer').removeClass('hidden'); 

   html = containter(data);
   $('#chatContainer').html(html);

   $('#messageContainer').scrollPagination({
        'url': BASEURL+'doctor/chat/getChatMessages',
        'data': {
            'page':1,
            'doctorID': DOCTORID,
            'patientID' : data.patientID
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




})

