@extends('layout.master_doctor_widget')
@section('title', 'Widget')
@section('content')


<div class="content-wrapper">


    <section class=" container  content">


        <div class="card">
            
            <div class="card-header bg-white header-elements-inline">
                <h5 class="card-title"><?=$title; ?></h5>
            </div>
            
            <form class="wizard-form steps-validation" method="POST" action="<?=base_url('widgets/widget_form_submit/'.$widget_id); ?>" data-fouc>
                <?php 
                if($steps != "")
                { 
                    foreach($steps as $key => $step)
                    { 
                ?>
                        
                        <h6><?=$step; ?></h6>
                        <fieldset>
                        <?php 
                        if($key == 0)
                        echo $content; 
                        ?>
                        </fieldset>
                <?php 
                    }
                } 
             ?>
                        <h6>Success</h6>
                        <fieldset>
                        </fieldset>
            </form>

        </div>

    </section>

</div>
</div>
@endsection
   
@section('scripts_top')

    <link rel="stylesheet" href="<?= base_url('vendor/plugins/imgpicker/css/imgpicker.css'); ?>">
    <script type="text/javascript" src="<?=base_url('assets/plugins/form-master-plugin/src/jquery.form.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('vendor/plugins/imgpicker/js/jquery.Jcrop.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('vendor/plugins/imgpicker/js/jquery.imgpicker.js') ?>"></script>

    <script type="text/javascript">
              
       $(function(){

        // Show form
        var form = $('.steps-validation').show();


        // Initialize wizard
        $('.steps-validation').steps({
            headerTag: 'h6',
            bodyTag: 'fieldset',
            titleTemplate: '<span class="number">#index#</span> #title#',
            labels: {
                previous: '<i class="icon-arrow-left13 mr-2" /> Previous',
                next: 'Next <i class="icon-arrow-right14 ml-2" />',
                finish: 'Submit form <i class="icon-arrow-right14 ml-2" />'
            },
            transitionEffect: 'fade',
            autoFocus: true,
            onStepChanging: function (event, currentIndex, newIndex) {

                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex) {
                    
                    var step_name = form.find('.body:eq(' + currentIndex + ') input.step_name').val();
                    if(step_name == "Success")
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }

                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex) {
                    //To remove error styles

                     form.find('.body:eq(' + newIndex + ') label.error').remove();
                     form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
                }

                var step_name = form.find('.body:eq(' + currentIndex + ') input.step_name').val();
                if(step_name == 'Appointment')
                {
                    form.validate().settings.ignore = '';
                    return form.valid();
                }
                if(step_name == 'Detail')
                {
                   
                    var user_type = form.find('.body:eq(' + currentIndex + ') input[name=usertype]:checked').val();            
                    if(user_type == 0)
                    {
                        form.validate().settings.ignore = '';                      
                        $( "#name" ).rules( "add", {required: true});
                        $( "#lname" ).rules( "add", {required: true});
                        $( "#phone" ).rules( "add", {required: true});
                        $( "#email" ).rules( "add", {required: true});
                         console.log(form.valid()); 
                        return form.valid();
                    }
                    else
                    {
                        
                        $( "#name" ).rules( "remove");
                        $( "#lname" ).rules( "remove");
                        $( "#phone" ).rules( "remove");
                        $( "#email" ).rules( "remove");

                        $( "#loginEmail" ).rules( "add", {required: true});
                        $( "#loginPass" ).rules( "add", {required: true});
                        
                         
                        return form.valid();
                    }
                    
                }
                else
                {
                    form.validate().settings.ignore = ':disabled';
                    return form.valid();
                }


                //form.validate().settings.ignore = ':disabled';
                //return form.valid();
            },
            onStepChanged:function(event, currentIndex, priorIndex){
                if (currentIndex > priorIndex) {

                    $.post('<?=base_url('widgets/load_widgets_wizardSteps/'.$widget_id); ?>',{Currstep : currentIndex},function(html){
                        $('fieldset.current').html(html);
                        var lastindex = $(".lastIndex").val();
                        if(currentIndex > lastindex)
                        {
                            $('.actions').remove();
                        }
                        if(currentIndex == lastindex)
                        {
                            //alert("Hello world");
                            var next = $(".wizard > .actions > ul > li").find("a[href='#next']");
                            $(next).parent().attr('style', 'display:none');

                            var next = $(".wizard > .actions > ul > li").find("a[href='#finish']");
                            $(next).parent().attr('style', '');
                        }

                    });

                    // // To remove error styles
                    // form.find('.body:eq(' + newIndex + ') label.error').remove();
                    // form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
                }

            },
            onFinishing: function (event, currentIndex) {
                form.validate().settings.ignore = ':disabled';
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
                
                // Ajax form submission
                $('.steps-validation').ajaxSubmit(function() {
                    $(".steps-validation").steps("next");
                });
                
                return false;
                
                // var widgetID = $("#widget_id").val();
                // var patienttype = $("input[name=usertype]:checked").val();
                // var patientID = $("#patientID").val();
               
                // var name = $("#name").val();
                // var lname = $("#lname").val();
                // var phone = $("#phone").val();
                // var email = $("#email").val();

                // var is_question = $("#is_question").val();

                // var textarea_question = $("#textarea_question").val();
                // var textarea_answer = $("#textarea_answer").val();
                
                // var select_question = $("#select_question").val();
                // var select_answer = $("#select_option_question").val();
                
                // var text_field_question = $("#text_field_question").val();
                // var text_field_answer = $("#text_field").val();
                
                // var checkbox_question = $("#checkbox_question").val();
                // var checkbox_answers;
                // $(".custom_question_checkbox :checked ").each(function(event){
                //     checkbox_answers = $(this).val();
                // });

                // var radio_question = $("#radio_question").val();
                // var radio_answer = $("input.custom_question_radio:radio :checked").val();
                
                // var phoneExist = $("#phone_exist").val();
                // var emailExist = $("#email_exist").val();
               
                // var pkslotid = $("#pkslotid").val();
                // var appDate = $("#app_date").val();
                // var time = $("#time").val();

                // $.post('<?=base_url('widgets/widget_form_submit'); ?>',
                // {  
                //     widgetID    : widgetID,
                //     usertype    : patienttype,
                //     patientID   : patientID,
                //     email_exist : emailExist,
                //     phone_exist : phoneExist,
                //     name  : name,
                //     lname : lname,
                //     phone : phone,
                //     email : email,
                //     is_question : is_question,
                //     textarea_question  : textarea_question,
                //     textarea_answer : textarea_answer,
                //     select_question : select_question,
                //     select_answer : select_answer,
                //     text_field_question : text_field_question,
                //     text_field_answer : text_field_answer,
                //     checkbox_question : checkbox_question,
                //     checkbox_answers : checkbox_answers,
                //     radio_question : radio_question,
                //     radio_answer : radio_answer,
                //     app_date : appDate,
                //     app_time : time,
                //     fkslotid : pkslotid,
                // },
                // function(){
                //     $(".steps-validation").steps("next");
                // });
            }
        });


        // Initialize validation
        $('.steps-validation').validate({
            //ignore: 'input[type=hidden]', // ignore hidden fields
            errorClass: 'validation-invalid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },

            // Different components require proper error label placement
            errorPlacement: function(error, element) {

                //console.log(element);

                // Unstyled checkboxes, radios
                if (element.parents().hasClass('form-check')) {
                    error.appendTo( element.parents('.form-check').parent() );
                }

                // Input with icons and Select2
                else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo( element.parent() );
                }

                // Input group, styled file input
                else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                    error.appendTo( element.parent().parent() );
                }

                //Custom Input error placement
                else if (element.hasClass("slotID")) {
                     error.appendTo( element.parent().parent() );
                }

                // Other elements
                else {
                    error.insertAfter(element);
                }
            },
            
            rules:{
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "<?= base_url("api/validateEmail/patient")?>",
                        type: "post",

                    }
                },
            },

            messages : {
                email: {
                    remote: "Email exists with same address."
                }
            }
        });

  
       });

    </script>

@endsection


