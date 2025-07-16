    <section class="content">
      <div class="card">
        <div class="card-body">
            <div id="calendar" class="container">
            </div>
        </div>
      </div>
    </section>
     

    <link rel="stylesheet" href="<?=base_url('assets/plugins/fullcalendar-new/lib/main.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/jAlert-master/jAlert.css');?>">
    <script type="text/javascript" src="<?=base_url('assets/plugins/jAlert-master/jAlert.min.js'); ?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/fullcalendar-new/lib/main.min.js'); ?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/fullcalendar-new/lib/locales-all.min.js'); ?>"></script> 


    <script type="text/javascript" language="javascript" class="init">

      document.addEventListener('DOMContentLoaded', function(){
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl,{
            
           initialView: 'dayGridMonth',
           editable: true,
           eventSources:  "<?=base_url("clinic/appointment/calendar_appointment/".$doctor_id)?>",
           headerToolbar: {
           left: 'prev,next today',
           center: 'title',
           right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
          
        eventDidMount: function(info,event,el) 
        {
            if(info.event.extendedProps.background) 
            {
              info.el.style.background = info.event.extendedProps.background;
              info.el.style.color = info.textColor;
              
            }
        },

        eventContent: function(arg)
        {  
            console.log(arg);
            return {
                     html: '<div class="container cursor-pointer text-dark pt-2 mt-0" style="border-top:8px solid '+arg.event._def.extendedProps.app_cat_color+'">'
                            +'<span class="uncategorized_css" style=""></span>'
                            +'<span class"collapsable"><h5><b>'+arg.event.title+'</b></h5>'
                            +'<p>'+arg.event._def.extendedProps.patient_email+'</p><hr>'+
                            '<p><b>'+arg.event._def.extendedProps.patient_name+'</b></p>'+
                            '<p>Age: 15 Yrs</p>'+
                            '</span>'+
                            '<span style="padding-top:0px"></span></div>'
                   }
                
        },

        eventResize: function(info){
           
             
            
        },

        eventClick: function(info){
              
              //console.log(info);   
              var desc = info.event._def.extendedProps.description; 
              var app_id = info.event._def.extendedProps.pk_appointment_id;
              var app_categoryid = info.event._def.extendedProps.fk_app_category_id;
              var link = info.event._def.extendedProps.link; 
              var link_patient = info.event._def.extendedProps.link_patient;
              var doctor_id =  info.event._def.extendedProps.doctor_id;
                
                
              $("#mymodal").modal('show');
              $('#patient_detail').html(desc);
              $("#appointment_links").html(link);
              $("#patient_links").html(link_patient);
              $("#app_cat").val(app_categoryid);
             
              $("#app_cat").change(function(){
              var id = $(this).val();
              
              if(id != 0)
              {
                confirmationbox(function(res){
                if(!res)
                {
                  $("#app_cat").val(app_categoryid);
                  return false;
                }
                else
                {
                  $.post("<?=base_url('clinic/appointment/update_appointment_category');?>",{category_id : id,appointment_id : app_id},function(data){
                  location.reload();
                  }); 
                }
              });
            }

            
           });

          } 
       });
  
      calendar.render();
  
   });   


 function confirmationbox(callback){
   
  var b =   $.jAlert({
            'title':   'Confirm!',
            'content': "Are you sure you want to change this category ?",
            'theme': 'blue',
            'btns': 
            [
              {
                'text': 'Yes',
                'theme': 'green',
                'onClick': function(e,btn){
                    callback(true);
                 }
              },
              {
                'text': 'No',
                'theme': 'default',
                'onClick': function(e,btn){
                    callback(false);
                 }
              }
            ]
         });

  }  

</script>

     
    
