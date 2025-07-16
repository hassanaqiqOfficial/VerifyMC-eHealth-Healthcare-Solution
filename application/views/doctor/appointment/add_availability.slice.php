@extends('layout.master_popup')
  @section('title', 'Add Availability')
  @section('content')
  
  
  <style type="text/css">
    .well .image  {
        width: 100%;
        height: 140px;
        overflow:hidden;
        text-align: center;
    }
    .image img {
        width: 100%;
    }
    #tab1{
        tab-size :4;
    }
    
  </style>
          
      <section class="content">
        <div class="card">
            <div class="card-body">
              <div class="tab-block">
                  
              <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#tab1" class="nav-link active" data-id="#submit_button1" data-toggle="tab">Add Signle</a></li>
                <li class="nav-item"><a href="#tab2" class="nav-link" data-id="#submit_button2" data-toggle="tab">Add Bulk</a></li>
              </ul>

                       
    <div class="tab-content" style="border-bottom:0px; border-left:0px; border-right:0px; border-radius:5px;">
       
       <div id="tab1" class="tab-pane fade active show" style="padding-left:20px; border-radius:5px;">
         <form action="<?php base_url('doctor/appointment/add_availability/');?>" method="post" accept-charset="utf-8" class="form-horizontal1 form-groups validate invoice-edit" enctype="multipart/form-data">
           <div class="form-row">
             <div class="col-md-12 col-sm-12">
                 
               <div class="form-group row" style="margin-top:20px;">
                <label for="field-1" class="col-form-label col-sm-3 col-md-3">Title (Optional)
                 </label>
                  <div class="col-sm-8 col-md-8 col-lg-8">
                  <input type="text" class="form-control mb-2" name="title" value="">
                 </div>
                </div>
              
               <div class="form-group row">
                <label for="field-1" class="col-form-label col-sm-3 col-md-3">Start Time</label>
    
                  <div class="col-md-8 col-sm-8 col-lg-8 admin-form">
    
                    <select name="start_time" class="form-control" id="start_time">
                      <option value="">Start Time...</option>
                        
                      <?php
                       
                       $time = mktime(0, 0, 0, 1, 1);
                       for($i = 0; $i < 86400; $i += 900)
                       {
                      
                      ?>
                      
                        <option value="<?= date('H:i', $time + $i); ?>"><?= date('g:i a', $time + $i); ?></option>
                      
                      <?php 
                      }
                      ?>                         
                       
                     </select>
                      <i class="arrow"></i>
                  </div>
                
              </div>
            
             <div class="form-group row">
              <label for="field-1" class="col-form-label col-sm-3 col-md-3">End Time</label>
  
              <div class="col-sm-8 col-md-8 col-lg-8 admin-form">
                  <select name="end_time" class="form-control" id="end_time">
                      <option value="">End Time...</option>
                                            
                      <?php
                      
                       $time = mktime(0, 0, 0, 1, 1);
                       for($i = 0; $i < 86400; $i += 900)
                       {
                      
                      ?>
                      
                        <option value="<?= date('H:i', $time + $i); ?>"><?= date('g:i a', $time + $i); ?></option>
                      
                      <?php 
                      }
                      ?>
                      
                                            
                    </select>
                    <i class="arrow"></i>
              </div>
            </div>
           
            
             <div class="form-group row">
              <label for="field-1" class="col-form-label col-sm-3 col-md-30">No Of Spaces</label>
  
               <div class="col-sm-8 col-md-8 col-lg-8 admin-form">
                    <select name="no_space" class="form-control" id="no_space">
                           <option value="1">1 space available</option>
                           <?php 
                                
                              for($i=2;$i<=100;$i++)   
                              {
  
                            ?>
                           <option value="<?=$i?>"><?=$i?> space available</option>  
                           <?php 
                             }
                           ?>               
                    </select>
                    <i class="arrow"></i>
               </div>
             </div>
            
               
             <input type="hidden" name="day_type" value="<?=$type?>">
            <input type="hidden" name="manage_type" value="0">
           <input type="hidden" name="app_type" id="app_type" value="0">
              
            <hr> 
              <div class="form-group row">
                  <button type="submit" class="btn btn-primary btn-sm pull-left mr-2 ml-2" id="submit_button1">Submit</button>
                  <span id="preloader-form"></span>
                  <button type="close" data-dismiss="form" class="btn btn-light pull-left close_btn">Close</button>
                 
                </div>
                
                
              </div>
            </div>
             
           </form>
          </div>


                       


             <div id="tab2" class="tab-pane" style="padding-left:17px;">
               
               <form action="<?php base_url('doctor/appointment/add_availability/');?>" method="post" accept-charset="utf-8" class="form-horizontal1 form-groups validate invoice-edit" enctype="multipart/form-data">
                   <div class="form-row"> 
                    <div class="col-lg-12 col-md-12 col-sm-12">                   
                      <div class="form-group row">
                      <label for="field-1" class="col-form-label col-sm-3 col-md-3">Title (Optional)</label>

                    <div class="col-sm-8 col-lg-8 col-md-8">
                        <input type="text" class="form-control" name="title" value="">
                    </div>
                 </div>
   
            <div class="form-group row">
              <label for="field-1" class="col-form-label col-sm-3 col-md-3">Start Time</label>
                <div class="col-sm-8 col-lg-8 col-md-8 admin-form">
                    <select name="start_time" class="form-control" id="start_time">
                        <option value="">Start Time...</option>
                        
                      <?php
                       
                       $time = mktime(0, 0, 0, 1, 1);
                       for($i = 0; $i < 86400; $i += 900)
                       {
                      
                      ?>
                      
                        <option value="<?= date('H:i', $time + $i); ?>"><?= date('g:i a', $time + $i); ?>
                          
                        </option>
                      
                      <?php } ?>

                     </select>
                  <i class="arrow"></i>
               </div>
            </div>
            
             <div class="form-group row">
              <label for="field-1" class="col-form-label col-sm-3 col-md-3">End Time</label>
  
                <div class="col-sm-8 col-md-8 col-lg-8 admin-form">
                      <select name="end_time" class="form-control" id="end_time">
                        <option value="">End Time...</option>
                     <?php
                      
                       $time = mktime(0, 0, 0, 1, 1);
                       for($i = 0; $i < 86400; $i += 900)
                       {
                      
                     ?>
                      
                        <option value="<?= date('H:i', $time + $i); ?>"><?= date('g:i a', $time + $i); ?></option>
                      
                      <?php } ?>
                                           
                    </select>
                    <i class="arrow"></i>
              </div>
            </div>
            
             <div class="form-group row">
              <label for="field-1" class="col-form-label col-sm-3 col-md-3">Time Between</label>
  
                <div class="col-sm-8 col-md-8 col-lg-8 admin-form">
                   <select name="time_between" class="form-control" id="time_between">
                      <option value="">Time Between Appointments...</option>
                      <option value="1">0 minutes</option>
                      <option value="300">5 minutes</option>
                      <option value="600">10 minutes</option>
                      <option value="900">15 minutes</option>
                      <option value="1200">20 minutes</option>
                      <option value="1800">30 minutes</option>
                      <option value="2700">45 minutes</option>
                      <option value="3600">1 hour</option>
                    </select>
                    <i class="arrow"></i>
              </div>
            </div>
            
            
             <div class="form-group row">
              <label for="field-1" class="col-form-label col-sm-3 col-md-3">Every Hour</label>
  
                <div class="col-sm-8 col-lg-8 col-md-8 admin-form">
                   <select name="every_hour" class="form-control" id="" every_hour="">
                      <option value="3600">Every 1 hour</option>
                      <option value="5400">Every 1 hour, 30 minutes</option>
                      <option value="7200">Every 2 hour</option>
                      <option value="2700">Every 45 minutes</option>
                      <option value="1800">Every 30 minutes</option>
                      <option value="1200">Every 20 minutes</option>
                      <option value="900">Every 15 minutes</option>
                      <option value="600">Every 10 minutes</option>
                      <option value="300">Every 5 minutes</option>
                    </select>
                    <i class="arrow"></i>
              </div>
            </div>
           
            
             <div class="form-group row">
              <label for="field-1" class="col-form-label col-sm-3 col-md-3">No Of Spaces</label>
  
                <div class="col-sm-8 col-md-8 col-lg-8 admin-form">
                       <select name="no_space" class="form-control" id="no_space">
                         <?php
                         
                         for($i = 1; $i<=100;$i++)
                         {
                         ?>
                          
                          <option value="<?=$i?>"><?=$i?> space available</option>
                       <?php } ?>
                                           
                    </select>
                    <i class="arrow"></i>
              </div>
             </div> 
               
               <input type="hidden" name="day_type" value="<?=$type?>">
                 <input type="hidden" name="manage_type" value="0">
                  <input type="hidden" name="app_type" id="app_type" value="1">
                   <hr>
                
                    <button type="submit" class="btn btn-primary btn-sm mr-2 pull-left" id="submit_button2">Submit</button>
                    <span id="preloader-form"></span>
               
                   <button type="close" data-dismiss="form" class="btn btn-sm btn-light pull-left">Close
                   </button>
                  
                 </div>
               
               </div>
              </div> 
                       
            </form>
           </div>
                
            </div>
           </div>
          </div>
         </div>
        </section>
      




@endsection
@section('scripts')
  
<link href="<?=base_url('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>" rel="stylesheet">
<script src="<?=base_url('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>" ></script>
                  
  <script type="text/javascript">

        function resetDatePickers(){
          var dateToday = new Date();
          $('.date-picker').each(function(index){
              $(this).datepicker('remove');
          });

          $('.daterange-single').datepicker({ 
             
              minDate: dateToday,

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

         
      }

      function resetDatePickers2(){
          var dateToday = new Date();
          $('.date-picker').each(function(index){
              $(this).datepicker('remove');
          });

          $(".daterange-single2").datepicker({
            
            minDate: dateToday,

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
      }




      var val2 = 1;
      var blank_entry = '';


      function add_entry()
      {

          var blank_entry="";
          blank_entry += "<div class=\"form-group row mt-3\">";
          blank_entry += "<label class=\"col-form-label col-sm-3\"><\/label>";
          blank_entry += "									<div class=\"col-sm-8\">";
          blank_entry += "										<input type=\"text\" class=\"form-control daterange-single\" name=\"month_date[]\" value=\"\" autocomplete=\"off\">";
          blank_entry += "									<\/div>";
          blank_entry += "                                    ";

          blank_entry += "									<div class=\"col-sm-1\">";
          blank_entry += "										<button type=\"button\" class=\"btn btn-danger remove_questions\">";
          blank_entry += "											<i class=\"fa fa-trash-o\"><\/i>";
          blank_entry += "										<\/button>";
          blank_entry += "									<\/div>";
          blank_entry += "";
          blank_entry += "								<\/div>";


          var length = $("#add_row .form-group").length;
          if(length < 15)
          {
              $("#add_row").append(blank_entry);
              val2++;
          }
          resetDatePickers();

      }





      var val = 101;
      var blank_entry_2 = '';


      function add_entry_2()
      {

          var blank_entry_2="";
          blank_entry_2 += "<div class=\"form-group row mt-3\">";
          blank_entry_2 += "<label class=\"col-form-label col-sm-3\"><\/label>";
          blank_entry_2 += "									<div class=\"col-sm-8\">";
          blank_entry_2 += "										<input type=\"text\" class=\"form-control daterange-single2\" name=\"month_date[]\" value=\"\" autocomplete=\"off\">";
          blank_entry_2 += "									<\/div>";
          blank_entry_2 += "                                    ";

          blank_entry_2 += "									<div class=\"col-sm-1\">";
          blank_entry_2 += "										<button type=\"button\" class=\"btn btn-danger remove_questions\">";
          blank_entry_2 += "											<i class=\"fa fa-trash-o\"><\/i>";
          blank_entry_2 += "										<\/button>";
          blank_entry_2 += "									<\/div>";
          blank_entry_2 += "";
          blank_entry_2 += "								<\/div>";


          var length = $("#add_row .form-group").length;
          if(length < 15)
          {
              $("#add_row_2").append(blank_entry_2);
              val++;
          }
          resetDatePickers2();

      }

      $(document).on("click", ".remove_questions" , function(){
          $(this).parent().parent().remove();
      });

      jQuery(document).ready(function () {
          var dateToday = new Date();

          $(".daterange-single").datepicker({
              minDate: dateToday,

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

          $(".daterange-single2").datepicker({
              minDate:   dateToday,

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

      });

          $(document).on("click",".add_availability",function(e){
           e.preventDefault();
           
           $('#submit_button2').on("click",function(){

           });

          });

     


      function show_fields()
      {
          $("#bulk").css("background-color" , "#56C477");
          $("#single").css("background-color" , "#213946");
          $("#show_field").removeClass("hidden");
          $("#app_type").val(1);
      }

      function hide_fields()
      {
          $("#single").css("background-color" , "#56C477");
          $("#bulk").css("background-color" , "#213946");
          $("#show_field").addClass("hidden");
          $("#app_type").val(0);
      }

      $(document).on("click",".close_btn",function(e){
           $("#add_availability_iframe").attr("src",'');
            $('#add_availability').modal('hide');
        });

  </script>



@endsection

