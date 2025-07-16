@extends('layout.master_clinic')
@section('title','Add Appointment')
@section('content')

     <div class="content-wrapper">

         <!-- Page header -->
        <div class="page-header page-header-light">
                <div class="page-header-content header-elements-md-inline">
                    <div class="d-flex page-title pb-2 pt-2">
                        <h4> <span class="font-weight-semibold"><?=$title?></span></h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>
                    <div class="header-elements d-none">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-primary btn-sm" form="myform" ><span>submit</span></a>
                            <input type="hidden" name="doctor_id" id="doctor_id" value="<?=$doctor_id; ?>">
                        </div>
                    </div>

                </div>
            </div>
            <!-- /page header --> 
         <section class="content">
	          <div class="card">
              <?=__message()?>
	             <div class="card-body">
                 <form class="form-groups-bordered" action="<?=base_url('clinic/appointment/add_appointment/'.$doctor_id);?>" method="post" enctype="multipart/form-data" id="myform">
	             	   <div class="row mt25">
                        
                        <div class="col-md-6 col-lg-6"> 
                          <h4 class="title ml5" style="font-weight:bold;">Appointment Details</h4>
                           <hr style="margin-top:0px;margin-bottom: 20px;">
                           <div class="form-group"> 
                           <label class="form-input-label">Patient Type</label>
		                       <select name ="patient_type" class="form-control" onchange="show_form(this.value);">
				                    <option value="0" selected="selected">New Patient</option>
				                    <option value="1">Existing Patient</option>
		                       </select>
                          </div>

                            <div id="new_patient" class="">
                              
                             <div class="row mt25">
                               <div class="col-md-6 col-lg-6 col-sm-6">
                               <div class="form-group">
                                  <label>First Name</label>
                                  <div class="section">
                                   <input type="text" name='name' class="form-control" placeholder="name" id="name"> 
                                 </div>
                               </div>
                               </div>

                               <div class="col-md-6 col-lg-6 col-sm-6">
                               <div class="form-group">
                                 <label>Last Name</label>
                                 <div class="section">
                                   <input type="text" name='lname' class="form-control" placeholder="Last Name" id="lname"> 
                                 </div>
                               </div>
                               </div>

                                <div class="col-md-6 col-lg-6 col-sm-6 mt10">
                                <div class="form-group">
                                 <label>Phone</label>
                                 <div class="section">
                                   <input type="text" name='phone' class="form-control" placeholder="Phone" id="phone"> 
                                 </div>
                               </div>
                               </div>

                               <div class="col-md-6 col-lg-6 col-sm-6 mt10">
                               <div class="form-group">
                                <label>Email</label>
                                 <div class="section">
                                   <input type="email" name='optional_email' class="form-control" placeholder="Email" id="optional_email"> 
                                 </div>
                               </div>
                             </div>
                             </div>
                             
                           <div class="row mt30"> 
                           	<div class="col-sm-6 col-md-6 col-lg-6">
                              <label>Communicate By</label>
                               
                               <div class="form-group mt15">
                                <div class="checkbox">
                                 <label for="email_option"> 
                                  <input type="checkbox" name="is_email" id="email_option" value="1">
                                  Email </label>
                                </div> 
                                <div class="checkbox">
                                 <label for="sms_option">
                                  <input type="checkbox" name="is_sms" id="sms_option" value="1">
                                  SMS </label>
                                </div> 
                               </div>

                           	</div>
                           </div>
                          </div>
                         
          <div id="existing_patient" class="hidden">
            <div class="row mt30">
							<div class="col-md-12">
              <div class="form-group">
              	<label class="">Patient</label>
								 <input type="text" class="form-control" id="select_patient" placeholder="Start typing patient name here......." value="" autocomplete="off" />
                 <input type="hidden" name="patient_id" value="" id="patient_id">
								</div>
						   </div>
               </div>

			<div class="row mt25">
             <div class="hidden col-md-6" id="phone_exists">
             <div class="form-group">
                     <label class="">Phone</label>
                         <div class="section mt5">
                            <label class="field">
                                <input type="text" placeholder="Phone" class="gui-input form-control" id="phone_exist" name="phone_exist" value="" aria-required="true">
                            </label>
                        </div>
                  </div>
                 </div> 
                 
                <div class="hidden col-md-6 pl-5" id="email_exists">                  
                <div class="form-group">
                   <label class="">Email</label>
			                 <div class="section mt5">
			                    <label class="field">
			                        <input type="text" placeholder="Email" class="gui-input form-control" id="email_exist" name="email_exist" value="" aria-required="true">
			                    </label>
			                 </div>
			               </div>
                   </div>
                  </div> 
                 </div>

              <div class="row mt25">
                <div class="col-md-12 col-lg-12">
                 <h4 class="title ml5" style="font-weight:bold;">Select Date</h4>
                 <hr style="margin-top:0px;margin-bottom: 20px;">
                </div>
              </div>

              <div class="row mt5">
               <div class="col-lg-12 col-lg-12">
               <div class="form-group">
                <label>Date</label>
                <input type="text" id="datepicker1" placeholder="Select A Date" class="form-control">
               </div>
               </div> 
              </div>
                    <input type ="hidden" name="fkslotid" id="pkslotid" value="">
                    <input type ="hidden" name="app_date" id="app_date" value="">
                    <input type ="hidden" name="app_time" id="time" value="">
              <div class="row hidden mt25" id="show_slots">
                <hr style="margin-top: 15px;margin-bottom: 15px;">
              </div>

              <div class="row mt25">
                <div class="col-md-12 col-lg-12">
                 <h4 class="title ml5" style="font-weight:bold;">Optional</h4>
                 <hr style="margin-top:0px;margin-bottom: 20px;">
                </div>
              </div> 
               <div class="row mb15">
                <div class="col-lg-12 col-md-12">
                <div class="form-group">
                 <label class="input-label">Appointment Category</label>
                 <select name="app_category" class="form-control" id="">
                  <option value="">Select Category</option>
                  <?php 
                    
                     foreach ($categories as $category) {
                      
                  ?> 
                   <option value="<?=$category['pk_app_categoryid'];?>"><?=$category['name'];?></option> 
                  <?php } ?>
                 </select>
                </div>
                </div>
               <div class="col-lg-12 col-md-12 mt5">
                  <div class="form-group"> 
                   <label class="input-label">Appointment Status</label>
                   <select name="app_status" class="form-control" id="">
                       <option value="0" selected>Pending</option>
                       <option value="1">Active</option>
                   </select>
                   </div>
               </div>

               </div> 

             </div>  
      <!-- first_column_closed -->
                   

              <!-- Second_column_Opened -->     
                      
                       <div class="col-md-6 col-lg-6"> 
                         <h4 class="title" style="font-weight:bold;">Select Appointment Reminder<small class="text-muted">(Optional)</small></h4>
                          <hr style="margin-top:9px;margin-bottom: 16px;">
                           Select notification options for patient and physician below. (Leave blank to not send any notifications).
		                 
	                      <div class="row mt-2">
                          <div class="col-lg-6 col-md-6">
                             
                            <div class="row">
                              <div class="col-md-12 col-lg-12">
                                <label>
                                <i class="fa fa-user mr-1"></i>Patient
                                </label>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12 col-lg-12">
	                          	 <div class="form-group">
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="patient_notify_email" value="1">
                                      Email
                                    </label>
                                  </div>

                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="patient_notify_sms" value="0">
                                      SMS
                                    </label>
                                  </div>

                                 
                              </div>  
	                          </div>
                         
                          </div>	
                         </div>
		                  
                           <div class="col-lg-6 col-md-6">
                             
                             <div class="row">
                              <div class="col-md-12 col-lg-12">
                                <label>
                                <i class="fa fa-user mr-1"></i>Physician
                                </label>
                              </div>
                             </div>

                             <div class="row">
                              <div class="col-md-12 col-lg-12">
                              	<div class="form-group">
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="physician_notify_email" value="1">
                                      Email
                                    </label>
                                  </div>

                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="physician_notify_sms" value="0">
                                      SMS
                                    </label>
                                  </div>

                                 
                                </div>	
                              </div>		

                            </div>
  		                     </div> 
                          </div>
                       
                         <div class="row mt25">
                          <div class="col-lg-12 col-md-12">
                            <h4 class="title ml5" style="font-weight:bold;">Select Reminder Date/Time<small class="text-muted">(Optional)</small></h4>
                           <hr style="margin-top:9px;margin-bottom: 16px;">
                           * Note. You must have a notification option selected above to schedule appointment notifications.
                         </div> 
                        </div>

                         <div class="row mt-2">
                          <div class="col-lg-6 col-md-6">
                             
                            <div class="row">
                              <div class="col-md-12 col-lg-12">
                                <label>
                                <i class="fa fa-user mr-1"></i>Patient
                                </label>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12 col-lg-12">
                               <div class="form-group">
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="patient_schedule_prior[]" value="Now">
                                      Now
                                    </label>
                                  </div>

                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="patient_schedule_prior[]" value="24 Hour Prior">
                                      24 Hour Prior
                                    </label>
                                  </div>
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="patient_schedule_prior[]" value="4 Hour Prior">
                                      4 Hour Prior
                                    </label>
                                  </div>

                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="patient_schedule_prior[]" id="addcustom_time" value="patient custom schedule">
                                      Add Custom Time
                                    </label>
                                  </div>

                                 
                              </div>  
                            </div>
                         
                          </div>

                         <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6" id="patient_schedule" style="display:none;">

                              <div class="row">

                                  <div class="col-lg-5 col-md-5 col-sm-10">
                                   <input type="number" name="patient_custom_schedule_hour" id="" placeholder="Hour">
                                  </div>

                                  <div class="col-lg-5 col-md-5 col-sm-10">
                                        <input type="number" name="patient_custom_schedule_min" id="" placeholder="Minute">
                                  </div>

                              </div>

                            </div>
                         </div>

                         </div>
                      
                           <div class="col-lg-6 col-md-6">
                             
                             <div class="row">
                              <div class="col-md-12 col-lg-12">
                                <label>
                                <i class="fa fa-user mr-1"></i>Physician
                                </label>
                              </div>
                             </div>

                             <div class="row">
                              <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="physician_schedule_prior[]" value="Now">
                                      Now
                                    </label>
                                  </div>

                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="physician_schedule_prior[]" value="24 Hour Prior">
                                      24 Hour Prior
                                    </label>
                                  </div>
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="physician_schedule_prior[]" value="4 Hour Prior">
                                      4 Hour Prior
                                    </label>
                                  </div>

                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="physician_schedule_prior[]" id="addcustom_time_2" value="physician custom schedule">
                                      Add Custom Time
                                    </label>
                                  </div>

                                 
                                </div>  
                              </div>    

                            </div>

                           <div class="row">
                             <div class="col-sm-6 col-md-6 col-lg-6" id="physician_schedule" style="display:none;">

                               <div class="row">

                                   <div class="col-lg-5 col-md-5 col-sm-10">
                                       <input type="number" name="physician_custom_schedule_hour" id="" placeholder="Hour">
                                   </div>

                                   <div class="col-lg-5 col-md-5 col-sm-10">
                                       <input type="number" name="physician_custom_schedule_min" id="" placeholder="Minute">
                                   </div>

                               </div>

                           </div>

                           </div> 
                          </div> 
                       
                     </div> 
	                 

                </div>
	            </form>
	          
           <button type="submit" class="btn btn-primary" form="myform" style="margin-left:9px;">Submit</button>
          <a href="<?=base_url('clinic/appointment/appointment/'.$doctor_id);?>" class="btn btn-primary ml-1">Back</a>
         </div> 
      

       </div>
     </section>
   </div>

 @endsection 
 
 @section('scripts')



  <script>

    function show_form(sel){
      
      if(sel == "1")
      {
        $("#new_patient").addClass("hidden");
        $("#existing_patient").removeClass("hidden");   
      }
      else
      {
        $("#existing_patient").addClass("hidden");
        $("#new_patient").removeClass("hidden");
      } 
    }

     $("input[type= checkbox][id = addcustom_time]").click(function(){

        if($(this).is(':checked'))
        {
           $("#patient_schedule").slideDown();
        }
        else
            {
                $("#patient_schedule").slideUp();
            }

     });

    $("input[type= checkbox][id = addcustom_time_2]").click(function(){

        if($(this).is(':checked'))
        {
            $("#physician_schedule").slideDown();
        }
        else
        {
            $("#physician_schedule").slideUp();
        }

    });


     $(function() {

          var widgetInst = $("#select_patient").autocomplete({
              source: function (request, response){
                  $.ajax({
                      url: "<?=base_url('clinic/patient/search_patient/');?>",
                      dataType: "json",
                      method: "post",
                      data: {
                          p: request.term,
                          doctor_id : <?=$doctor_id; ?>
                           },
                      success: function (data) {

                          response(data);
                      }
                  });
              },
              minLength: 2,
              select: function (event, ui) {
                 
                 if (ui.item.patient_user_id > 0) {

                     $("#patient_id").val(ui.item.patient_user_id)
                     if(ui.item.patient_email == "" && ui.item.patient_phone != "")
                      {
                          $("#email_exists").removeClass('hidden');
                          $("#phone_exists").addClass('hidden');
                          $("#email_exist").val('');
                      }
                      else if(ui.item.patient_phone == "" && ui.item.patient_email != "")
                      {   $("#phone_exists").removeClass('hidden');
                          $("#email_exists").addClass('hidden');
                          $("#phone_exist").val('');
                      }
                      else if(ui.item.patient_phone == "" && ui.item.patient_email == "")
                      {
                          $("#email_exists").removeClass('hidden');
                          $("#phone_exists").removeClass('hidden');
                          $("#email_exist").val('');
                          $("#phone_exist").val('');
                      } 
                      else if(ui.item.patient_phone != "" && ui.item.patient_email != "")
                      {
                          $("#email_exists").addClass('hidden');
                          $("#phone_exists").addClass('hidden');
                      }
                      
                   }


                }
              
                       
               }).data('ui-autocomplete');

             }); 

       <?php

         $str_new = "";
         if($disable_day)
         {

         $str = "";
         foreach($disable_day as $disable_day)
         {
         $str .= '"'.date("j-n-Y",strtotime($disable_day['blockdate'])).'",'; 
         }
         $str = substr($str,0,-1);
         $str_new = "[$str]";
         
         } 
       ?>
       <?php
        if($str_new != "")
        {

       ?>
       
       var unavailabledates = <?=$str_new ?>;
       
       <?php
        }
        else
        {
           
       ?>
       var unavailabledates = [];
       <?php 
        }
       ?>
       <?php 

        $str_new_enable = "";
        if($enable_day)
        {
         $str_enable = "";
         foreach($enable_day as $enable_day)
         {
          $str_enable .= '"'.date("j-n-Y",strtotime($enable_day["month_date"])).'",';
         }

         $str_enable = substr($str_enable,0,-1);
         $str_new_enable = "[$str_enable]";
        } 
         
        if($str_new_enable != "")
        {

       ?>

        var availabledates = <?=$str_new_enable?>;
         
       <?php 
        }
        else
        {

       ?>   
        var availabledates = [];

      <?php 
        }
      ?>
      <?php
    if($disable_days)
    {
      
      
      $str_days = "";
      
      if(!in_array('1' , $disable_days))
      {
        $str_days .= '1,';  
      }
      if(!in_array('2' , $disable_days))
      {
        $str_days .= '2,';  
      }
      if(!in_array('3' , $disable_days))
      {
        $str_days .= '3,';  
      }
      if(!in_array('4' , $disable_days))
      {
        $str_days .= '4,';  
      }
      if(!in_array('5' , $disable_days))
      {
        $str_days .= '5,';  
      }
      if(!in_array('6', $disable_days))
      {
        $str_days .= '6,';  
      }
      if(!in_array('7', $disable_days))
      {
        $str_days .= '0,';  
      }
    $str_days = substr($str_days, 0, -1);
    }
    else
    {
      $str_days = '0,1,2,3,4,5,6';    
    }
  ?>

  var arr = [<?= $str_days?>];
  function unavailable(date) {
    
    dmy = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();
    var day = date.getDay();
    if ($.inArray(dmy, unavailabledates) >= 0) {
    return [false,"","Booked Out"];
    } 
    else if(arr.indexOf(day) >= 0) {
    return [false,"","Booked Out"];
    }
    else
    {
    return [true,"","Book Now"];
    }
  }
  
  function available(date) {

    dmy = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();
    var day = date.getDay();
    if ($.inArray(dmy,unavailabledates) >= 0) {
    return [false,"","Booked Out"];
    } 
    else if ($.inArray(dmy, availabledates) >= 0) {
    return [true,"","Book Now"];
    } 
    else {
    return [false,"","Booked Out"];
    }
  }
  
  var dateToday = new Date();
    $("#datepicker1").datepicker({

      beforeShowDay: <?php if($time_slot_manage['value'] == 1 ){echo "available"; }else{echo "unavailable"; } ?>,  
       minDate: dateToday,  
       onSelect: function (date, obj) {


          $("#app_date").val(date);
          $("#time").val('');
          $("#hours").val('');
          $("#minutes").val('');
          $("#daynight").val('');
          $("#pkslotid").val('');  
        
             var id = $("#doctor_id").val();  
             $.post("<?=base_url('clinic/appointment/get_time_slot/');?>", 
             { doctor_id: id, date_start : ""+date+""},
             function(data){
             $("#show_slots").removeClass('hidden');
             $("#show_slots").html(data);
                 
                 
       
          })  
        },  
  
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        showButtonPanel: false,
        beforeShow: function(input, inst) {
        var newclass = 'admin-form';
        var themeClass = $(this).parents('.admin-form').attr('class');
        var smartpikr = inst.dpDiv.parent();
        if (!smartpikr.hasClass(themeClass)) {
          inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
        }
        }
      });

    $(document).on("click",'.book', function(e) {
     $('.book').addClass('btn-info book');
     $('.book').removeClass('btn-success selected');
     $('.book').html("Book Now");
     $('.book').css({"padding-left": "", "padding-right": ""});
     
     $(this).removeClass('btn-info');
     $(this).addClass('btn-success selected');
     $(this).html("Selected");
     $(this).css({"padding-left": "18px", "padding-right": "18px"});
     
     var time = $(this).data("time");
     var hours = $(this).data("hours");
     var minutes = $(this).data("minutes");
     var daynight = $(this).data("daynight");
     var pkslotid = $(this).data("pkslotid");

     var c_time = hours+':'+minutes+' '+daynight;
     //console.log(c_time);

     $("#time").val(c_time);
     $("#hours").val(hours);
     $("#minutes").val(minutes);
     $("#daynight").val(daynight);
     $("#pkslotid").val(pkslotid);
    });
  
    $(document).on("click",'.selected', function(){
         
         $(this).removeClass('btn-success selected');
         $(this).addClass('btn-info book');
         $(this).html("Book Now");
         $(this).css({"padding-left": "", "padding-right": ""});
         
         $("#time").val('');
         $("#hours").val('');
         $("#minutes").val('');
         $("#daynight").val('');
         $("#pkslotid").val(''); 
      
      });

    $(document).on("click",'.remove_selected',function(){
      $('.selected').removeClass('btn-success');
      $('.selected').addClass('btn-info book');
        $('.selected').html("Book Now");
        $('.selected').css({"padding-left": "", "padding-right": ""});
      $('.selected').removeClass('selected');
       
        $("#time").val('');
        $("#hours").val('');
        $("#minutes").val('');
        $("#daynight").val('');
        $("#pkslotid").val('');
      
      });


 </script>
 @endsection  
