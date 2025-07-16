@extends('layout.master_doctor')
@section('title', 'Calendar')
@section('bodyClass','sidebar-right-visible')
@section('content')

<?php require ("application/views/doctor/settings/branding/sidebar_secondary.php")?>

<style type="text/css">
  
  .ui-datepicker .ui-datepicker-calendar td.ui-datepicker-current-day .ui-state-active{
     background: <?=@$settings['date_selected_color'];?> !important;
     color:  <?=$class = @$settings['date_selected_text_color'] == "custom" ? @$settings['date_selected_custom_text'] : @$settings['date_selected_text_color'] ;?> !important; 
  }
  .ui-datepicker-inline.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all{
    background : <?=$settings['calendar_color_all'];?> !important;
    color: <?=$class = $settings['calendar_text_color_all'] == "custom" ? $settings['calendar_text_custom_all'] : $settings['calendar_text_color_all'] ;?> !important;
  }
  a.ui-state-default {
    background:<?=$settings['date_available_color'];?> !important;
    color : <?=$class = $settings['date_available_text_color'] == "custom" ? $settings['date_available_custom_text'] : $settings['date_available_text_color'] ;?> !important;
  }
  .sp-dd {
    display: none;
  }
  .input-group-text{
    padding:0px !important;
  }
  .sp-replacer {
    padding:0px !important;
  }
  
</style>
<div class="content-wrapper">

     <!-- Page header -->
     <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">Calendar Customization</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary btn-sm" form="myform"><span>Submit</span></button>
                </div>
            </div>

        </div>
    </div>
    <!-- /page header -->

  <section class="content">

    <form method="POST" id="myform" class="admin-form">  
      <div class="card">
        <div class="card-body">
            <?=__message()?>
                    
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12"> 
                    <div class="text-uppercase">Options</div>
                    <hr class="solid">
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12"> 
                    <div class="text-uppercase">Preview Calendar</div>
                    <hr class="solid">
                </div>
            </div>

            <div class="row">
                       
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12"> 
                         
                        <span> 
                          <b>For Quick Customization</b> - Enter a medium to dark color for<br> "Date Selected Color"
                        </span>
                       
                        <div class="row mt-2">
                          
                            <div class='col-md-6 col-lg-6'>
                             <div class='form-group'>
                              
                              <label>Date Selected</label>
                              <div class="input-group">
                                  <span class="input-group-prepend">
                                    <span class="input-group-text colorPicker_A">
                                      <input type="text" class="form-control colorpicker-date-selected hidden" value="" data-fouc="">
                                    </span>
                                  </span>
                                  <input type="text" name="date_selected_color" value="<?=$settings['date_selected_color'];?>" id="colorPicker_dateSelected" class="form-control">
                              </div>
                               
                             </div>
                            </div>   

                            <div class='col-md-6 col-lg-6'>  
                             
                             <div class='form-group'>
                               <label>Date Selected Text</label>
                               <select name="date_selected_text_color" class="form-control show_fields">
                                    <option value="#FFFFFF" data-value="calendar_selected_date_text_color_all" <?php if($settings['date_selected_text_color'] == "#FFFFFF"){echo "selected"; } ?> >Light</option>
                                    <option value="#4d5055" data-value="calendar_selected_date_text_color_all" <?php if($settings['date_selected_text_color'] == "#4d5055"){echo "selected"; } ?> >Dark</option>
                                    <option value="custom" data-value="calendar_selected_date_text_color_all" <?php if($settings['date_selected_text_color'] == "custom"){echo "selected"; } ?> >Custom Color</option>
                                </select>
                             </div>

                             <div class="form-group <?php if($settings['date_selected_text_color'] == "custom" && @$settings['date_selected_custom_text'] != ""){echo ""; }else{echo "hidden";}?>" id="calendar_selected_date_text_color_all">
                                
                                <label>Date Selected Custom Text</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                      <span class="input-group-text">
                                        <input type="text" class="form-control colorpicker-date-CustomText  hidden" value="" data-fouc="">
                                      </span>
                                    </span>
                                    <input type="text" name="date_selected_custom_text" value="<?=@$settings['date_selected_custom_text'];?>" id="colorPicker_CustomText" class="form-control">
                                </div>
                              
                             </div>

                            </div> 

                        </div>

                        <div class="row mt-2">
                          
                          <div class='col-md-6 col-lg-6'>
                           <div class='form-group'>
                             
                              <label>Date Available</label>
                              <div class="input-group">
                                  <span class="input-group-prepend">
                                    <span class="input-group-text">
                                      <input type="text" class="form-control colorpicker-date-available hidden" value="" data-fouc="">
                                    </span>
                                  </span>
                                  <input type="text" name="date_available_color" value="<?=$settings['date_available_color'];?>" id="colorPicker_availableDate" class="form-control">
                              </div>

                           </div>
                          </div>   

                          <div class='col-md-6 col-lg-6'>  
                            
                            <div class='form-group'>
                             
                             <label>Date Available Text</label>
                             <select name="date_available_text_color" class="form-control show_fields">
                                  <option value="#FFFFFF" data-value="calendar_available_date_text_color_all" <?php if($settings['date_available_text_color'] == "#FFFFFF"){echo "selected"; } ?> >Light</option>
                                  <option value="#4d5055" data-value="calendar_available_date_text_color_all" <?php if($settings['date_available_text_color'] == "#4d5055"){echo "selected"; } ?> >Dark</option>
                                  <option value="custom" data-value="calendar_available_date_text_color_all" <?php if($settings['date_available_text_color'] == "custom"){echo "selected"; } ?> >Custom Color</option>
                              </select>
                            </div>
                         
                            <div class="form-group <?php if($settings['date_available_text_color'] == "custom" && @$settings['date_available_custom_text'] != ""){echo ""; }else{echo "hidden";}?>" id="calendar_available_date_text_color_all">
                              
                              <label>Date Available Custom Text</label>
                              <div class="input-group">
                                  <span class="input-group-prepend">
                                    <span class="input-group-text">
                                      <input type="text" class="form-control colorpicker-date-availableCustomText hidden" value="" data-fouc="">
                                    </span>
                                  </span>
                                  <input type="text" name="date_available_custom_text" value="<?=@$settings['date_available_custom_text'];?>" id="colorPicker_availableDateCustomText" class="form-control">
                              </div>

                            </div>

                          </div> 

                        </div>

                        <div class="row mt-2">
                          
                          <div class='col-md-6 col-lg-6'>
                           <div class='form-group'>
                              
                              <label>Background</label>
                              <div class="input-group">
                                  <span class="input-group-prepend">
                                    <span class="input-group-text">
                                      <input type="text" class="form-control colorpicker-background hidden" value="" data-fouc="">
                                    </span>
                                  </span>
                                  <input type="text" name="calendar_color_all" value="<?=$settings['calendar_color_all'];?>" id="colorPicker_background" class="form-control">
                              </div>

                           </div>
                          </div>   

                          <div class='col-md-6 col-lg-6'>  
                            
                            <div class='form-group'>
                             <label>Text</label>
                             <select name="calendar_text_color_all" class="form-control show_fields">
                                  <option value="#FFFFFF" data-value ="calendar_text_color_all" <?php if($settings['calendar_text_color_all'] == "#FFFFFF"){echo "selected"; } ?>>Light</option>
                                  <option value="#4d5055" data-value ="calendar_text_color_all" <?php if($settings['calendar_text_color_all'] == "#4d5055"){echo "selected"; } ?> >Dark</option>
                                  <option value="custom"  data-value ="calendar_text_color_all" <?php if($settings['calendar_text_color_all'] == "custom"){echo "selected"; } ?> >Custom Color</option>
                              </select>
                            </div>

                            <div class="form-group <?php if($settings['calendar_text_color_all'] == "custom" && @$settings['calendar_text_custom_all'] != ""){echo ""; }else{echo "hidden";}?>" id="calendar_text_color_all">
                              
                              <label>Text Custom</label>
                              <div class="input-group">
                                  <span class="input-group-prepend">
                                    <span class="input-group-text">
                                      <input type="text" class="form-control colorpicker-calendarCustomText hidden" value="" data-fouc="">
                                    </span>
                                  </span>
                                  <input type="text" name="calendar_text_custom_all" value="<?=@$settings['calendar_text_custom_all'];?>" id="colorPicker_CustomTextAll" class="form-control">
                              </div>

                            </div>

                          </div> 

                        </div>

                </div>  

                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12"> 
                    <div id="datepicker" class=""></div>
                </div>

                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12"> 
                  <hr class="solid"> 
                  <div class="">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>    
                </div> 

            </div> 
                   
        </div>
      </div>
    </form>
  </section> 
</div>   

  @endsection
  @section('scripts')

  <script type="text/javascript" src="<?=base_url('assets/global_assets/js/plugins/pickers/color/spectrum.js'); ?>"></script>
  
  <script type="text/javascript">
  
    $(document).ready(function(data){

        $("span.colorPicker_A.sp-preview-inner").css('background-color','#ffffff');
        
        // Color Picker Date Selected
        $('.colorpicker-date-selected').spectrum({
            
            showInput: true,

              move: function(c) {
                var label = $('#colorPicker_dateSelected');
                label.val(c.toHexString());
            }
        });

        // Color Picker Date Available
        $('.colorpicker-date-available').spectrum({
          
          showInput: true,

            move: function(c) {
              var label = $('#colorPicker_availableDate');
              label.val(c.toHexString());
          }
        });

        // Color Picker Background
        $('.colorpicker-background').spectrum({
          
          showInput: true,

            move: function(c) {
              var label = $('#colorPicker_background');
              label.val(c.toHexString());
          }
        });

        // Color Picker CustomTextAll
        $('.calendarCustomText').spectrum({
            
            showInput: true,

              move: function(c) {
                var label = $('#colorPicker_CustomTextAll');
                label.val(c.toHexString());
            }
        });

        // Color Picker DateSelectedCustomText
        $('.colorpicker-date-CustomText').spectrum({
            
            showInput: true,

              move: function(c) {
                var label = $('#colorPicker_CustomText');
                label.val(c.toHexString());
            }
        });

        // Color Picker dateAvailableCustomText
        $('.colorpicker-date-availableCustomText').spectrum({
            
            showInput: true,

              move: function(c) {
                var label = $('#colorPicker_availableDateCustomText');
                label.val(c.toHexString());
            }
        });

        // Color Picker calendarCustomText
        $('.colorpicker-calendarCustomText').spectrum({
          
          showInput: true,

            move: function(c) {
              var label = $('#colorPicker_CustomTextAll');
              label.val(c.toHexString());
          }
        });

        

        
        var dateToday = new Date();
        $("#datepicker").datepicker({

            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            showButtonPanel: false,
            beforeShow: function(input, inst) {
            var newclass = 'admin-form';
            var themeClass = $(this).parents('.admin-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
                if (!smartpikr.hasClass(themeClass)){
                    inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
                }
            }
        });
      
      $(document).on("change",".show_fields",function(){
          
        var val = $(this).val();
        var val_div = $(this).find(':selected').attr('data-value');

        if(val == "custom")
        {
          $('#'+val_div+'').removeClass("hidden");
        }
        else
        {
          $('#'+val_div+'').addClass("hidden")
        }

      });

    });

        
  </script>
 
  @endsection


