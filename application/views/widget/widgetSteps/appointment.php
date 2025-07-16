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
</style>

<div class="from-group row mt-1">
    <div class="col-lg-4 col-lg-4">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div>Select Date</div>
                <hr>
            </div>
        </div>
        
        <div id="datepicker1" style="border:1px solid #e2e2e2;"></div>
    </div>
    <div class="col-lg-8 col-lg-8">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div>Select Time</div>
                <hr>
            </div>
        </div>
        <div id="show_slots"></div>
        <input type ="hidden" name=""  class="step_name" value="Appointment">
        <input type ="hidden" name="fkslotid" id="pkslotid" required class="slotID" value="">
        <input type ="hidden" name="app_date" id="app_date" value="">
        <input type ="hidden" name="app_time" id="time" value="">
        <input type ="hidden" name=""  class="lastIndex" value="<?=$lastindex;?>">
        <input type="hidden" name="widgetID" id="widget_id" value="<?=md5($widgetID); ?>"> 
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-lg-4">
      <span class="text-danger" id="errorMsg"></span>
    </div>
</div>


<script type="text/javascript">
   $(function(){
       
    <?php
        
        $str_new_repeatHolidays = "";
        $str_blockdates_new_str = "";
        $str_blockdates = "";
       
        if($disable_day != "")
        {
           foreach($disable_day as $disable_day)
           {
               $str_blockdates .= '"'.date("j-n-Y",strtotime($disable_day['blockdate'])).'",'; 
           }
        }
       ?>
       
       <?php

       $str_repeatHolidays = "";
       if($holidays != "")
       {
           foreach($holidays as $holiday)
           {
           $str_repeatHolidays .= $holiday['repeat_year'] == 1 ? '"'.date("j-n",strtotime($holiday['holiday_date'])).'",' : "";
           $str_blockdates .= '"'.date("j-n-Y",strtotime($holiday['holiday_date'])).'",'; 
           }

           $str_repeatHolidays = substr($str_repeatHolidays,0,-1);
           $str_new_repeatHolidays = "[$str_repeatHolidays]";

           $str_blockdates = substr($str_blockdates,0,-1);
           $str_blockdates_new_str = "[$str_blockdates]";

       }
       ?>

       <?php if($str_blockdates_new_str != "") { ?>
       
       var unavailabledates = <?=$str_blockdates_new_str; ?>;

       <?php  }else{ ?>
       
       var unavailabledates = [];
       
       <?php  } ?>

       <?php if($str_new_repeatHolidays != "") { ?>

       var repeatholidays = <?=$str_new_repeatHolidays; ?>

       <?php }else{?>

       var repeatholidays = [];

       <?php } ?>

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
       dm = date.getDate() + "-" + (date.getMonth()+1);

       var day = date.getDay();
       
           if ($.inArray(dmy, unavailabledates) >= 0) {
               return [false,"","Booked Out"];
           } 
           else if($.inArray(dm, repeatholidays) >= 0) {
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
   
       var dateToday = new Date();
       $("#datepicker1").datepicker({

       beforeShowDay:unavailable, 
       minDate: dateToday,  
       onSelect: function (date, obj) {


           $("#app_date").val(date);
           $("#time").val('');
           $("#hours").val('');
           $("#minutes").val('');
           $("#daynight").val('');
           $("#pkslotid").val('');  
           
               var id = $("#widget_id").val();  
               $.post("<?=base_url('/widgets/get_time_slot/');?>", 
               { widgetID: id, date_start : ""+date+""},
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
           if (!smartpikr.hasClass(themeClass)){
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

   });
</script>