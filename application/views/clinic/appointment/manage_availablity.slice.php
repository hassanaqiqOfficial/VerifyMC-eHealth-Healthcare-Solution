@extends('layout.master_clinic')
@section('title', 'Manage Availablity')
@section('content')

<style>
    em.state-error {
        display: block;
        margin-top: 6px;
        padding: 0 3px;
        font-family: Arial, Helvetica, sans-serif;
        font-style: normal;
        line-height: normal;
        font-size: 0.85em;
        color: #DE888A;
    }

    .state-error .form-control{
        background: #FEE9EA;
        border-color: #DE888A;
    }
    element.style {
    background: darkgrey;
    color: #fff;
    }
    .popup-basic {
    position: relative;
    background: #FFF;
    width: auto;
    max-width: 450px;
    margin: 40px auto;
   }
    label.option.option-primary {
    cursor:pointer;
    }

</style>
<div class="content-wrapper">

     <!-- Page header -->
     <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">Manage Availability</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary btn-sm" form="myform"><span>Update</span></button>
                    
                </div>
            </div>

        </div>
    </div>
    <!-- /page header -->

    <!-- Content -->
    <section class="content">

        <div class="card">
            <div class="card-header">
              <h2 class="card-title">Time Slot Settings</h2>
            </div>
               <form action="<?=base_url('clinic/appointment/manage_availability/'.$doctor_id);?>" method="post" id="myform">
                        <!-- Default Grid -->   
                        <div class="card-body">
                              <div class="form-row">
                                 <div class="col-md-12 col-lg-12">
                                           
                                            <div class='form-group'>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="time_slot_manage" value="1" <?php if($availability == "1"){echo "checked";} ?>>
                                                       <b> Manage Each Day</b>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline" style="padding-left: 75px;">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="time_slot_manage" value="0" <?php if($availability == "0"){echo "checked";} ?>>
                                                        <b>Manage By Week</b>
                                                    </label>
                                                </div>
                                            </div> 
                                     </div>
                                  </div> 
                              </div>
                             
                              <div class="card-footer pb-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="section">
                                            <label class="field">
                                                <button type="submit" class="btn btn-primary mt-15" name="Update" id="availability_type">Update
                                                </button>
                                            </label>
 
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </form>
                      </div>
                 <?=$slots_view?>
               </section>
            </div>


       <div id="add_availability" class="modal fade" role="dialog">
         <div class="modal-dialog modal-lg">

            <!-- Modal content-->
             <div class="modal-content">
                <div class="modal-header" style="display:block">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Availability</h4>
                </div>
                <div class="modal-body">
                   <iframe src="" id="add_availability_iframe" style="width: 100%; height: 500px; border: 0px" >
                   </iframe>
                </div>  
             </div>
          </div>
       </div>

                        
      <div id="appointment_modal" style="border-radius: 5px" class=" popup-basic popup-md mfp-with-anim mfp-hide">
          <div id="appointment_detail" style="padding:60px;">
         </div>
       </div>






@endsection
@section('scripts')

    <link rel="stylesheet" href="<?=base_url('vendor/plugins/magnific-popup/magnific-popup.css'); ?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/fullcalendar-new/lib/main.min.css');?>">
    <script src="<?=base_url('assets/plugins/fullcalendar-new/lib/main.min.js'); ?>"></script>
    <script src="<?=base_url('assets/plugins/fullcalendar-new/lib/locales-all.min.js'); ?>"></script> 
    <script src="<?=base_url('vendor/plugins/magnific-popup/magnific-popup.js'); ?>"></script>
  
   <script type="text/javascript">
     
      <?php
      
      if($availability == "1"){ ?>

      document.addEventListener('DOMContentLoaded',function() 
      {
        var calendarEl = document.getElementById('calendar');
        var calendar   = new FullCalendar.Calendar(calendarEl, 
        {
          initialView:   'dayGridMonth',
          eventSources:  "<?=base_url("clinic/appointment/time_slots_data/".$doctor_id)?>",
          
            eventDidMount: function(info)
            {
                if(info.event.extendedProps.background) 
                {
                    info.el.style.background = info.event.extendedProps.background;
                    info.el.style.color = info.textColor;
                    
                }
            },
            eventContent: function(arg)
            {   
                return {
                          html: '<span class="cursor-pointer text-dark mt-1">'+ arg.event.title + '</span><i class="fa fa-trash-o ml-2 cursor-pointer" style="color:red;" id="Delete" data-id="'+arg.event._def.extendedProps.pkslotid+'" ></i>'
                       }
            },
            eventClick: function(info){
             
             var event_desc = info.event._def.extendedProps.description ;
             $("#appointment_detail").html(event_desc);
           
                $.magnificPopup.open({
                removalDelay: 500,  //Auto animation is allowed by x removal delay,
                items: {
                src: "#appointment_modal"
                },
                midClick: true     //Enabled middle click on event
            });


            }

          });

        calendar.render();
         
        $(document).on("click",".removeEvent",function(e){
        $.ajax({
            method : "POST",
            url : '<?=base_url("clinic/appointment/delete_time_slot/".$doctor_id)?>/'+$(this).data("id"),
            success: function(){
                    calendar.refetchEvents();
                    $.magnificPopup.close({
                            items: {
                                    src: "#appointment_modal"
                                    }
                        });
                        }      
                    });
                });
            
            }); 

         <?php }else{ ?>
         
         <?php } ?> 

        $(document).on("click",".add_availability",function(e){
           e.preventDefault();
           var url = $(this).attr("href");
           $("#add_availability_iframe").attr("src",url);
           $('#add_availability').modal('show');

        })

        $(document).on("click",".close_btn",function(e){
            $("#add_availability_iframe").attr("src",'');
            $('#add_availability').modal('hide');
        });

   </script>
   
   <script type="text/javascript">

      function confirmdelete(text,link)
      { 
        var b = $.confirm({
            title: 'Confirm!',
            content: text,
            buttons: 
            {
                Delete: {
                    btnClass: 'btn-red text-lowercase mr-2',
                    action: function(){
                    var event = $(this);
                    window.location = link
                    event.parent().remove(); 
                   }
                 },
               
                Close: {
                    btnClass: 'btn-default',
                    action: function(){}
                  },
            }

         });
        return b;
      }
   
</script>
@endsection