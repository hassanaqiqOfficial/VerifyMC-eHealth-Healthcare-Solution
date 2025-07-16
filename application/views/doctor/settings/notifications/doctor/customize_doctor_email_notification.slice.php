@extends('layout.master_doctor')
@section('title', 'Notifications')
@section('bodyClass', 'sidebar-right-visible sidebar-xs')
@section('content')

<?php require ("application/views/doctor/settings/notifications/notification_sidebar.php")?>

<style type="text/css">
    /* The switch - the box around the slider */
    .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
    opacity: 0;
    width: 0;
    height: 0;
    }

    /* The slider */
    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    }

    .slider:before {
    position: absolute;
    content: "";
    height: 25px;
    width: 22px;
    left: 6px;
    bottom: -2px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    }

    input:checked + .slider {
    background-color: #2196F3;
    }

    input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }

    .slider.round:before {
    border-radius: 50%;
    }

    span.slider.round{
        height: 21px !important;
    }

</style>

<div class="content-wrapper">

    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold"><?php if($email_template['title'] != "" ){echo $email_template['title'];}else{echo "Email Notification"; }?></span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary btn-sm" form="myform"><span>Submit</span></button>


                </div>
            </div>

        </div>
    </div>

    <section class="content">
        <div class="card">
            <form action="" method="post" class="admin-form-validate" enctype="mulipart/form-data" id="myform">
                <div class="card-body">
                    <div class="form-row ">



                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                            
                            <div class="form-group">
                                <label>Switch Notification</label>
                                 <!-- Rounded switch -->
                                 <div class="">
                                    <label class="switch">   
                                        <input type="checkbox" name="is_notify_email" value="1" <?php if($email_template['is_notification'] == 1){ echo "checked"; } ?> >
                                        <span class="slider round"></span>
                                    </label>
                                    <label>ON/OFF</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Subject<span class="text-danger dark"> * </span></label>
                                <div class="mb10">
                                    <input type="text" name="subject" value="<?=$email_template['subject'];?>" class="form-control" required placeholder="Subject"
                                           id="subject">
                                </div>
                            </div>
                            
                        </div>

                    </div>


                    <div class="form-row ">

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                            <div class="form-group">
                                <label>Body<span class="text-danger dark"> * </span></label>
                                <div class="mb10">
                            <textarea name="body" class="ckeditor" required
                                      id="body"><?=$email_template['body'];?></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="container">
                        <b>Email Codes Available</b>
                        <hr style="mt-2 mb-2">
                        <b style="font-size: 12px;">You can use the codes located within the { } to include dynamic data in you email. To add copy and paste the codes below into your email above.</b><br><br>
                        <b>Patient Name:</b> {PatientName}<br>
                        <b>Patient First Name:</b> {PatientFirstName}<br>
                        <b>Patient Last Name:</b> {PatientLastName}<br>
                        <b>Patient Phone:</b> {PatientPhone}<br>
                        <b>Patient Email:</b> {PatientEmail}<br>
                        <b>Patient User Name:</b> {UserName}<br>
                        <b>Patient Password:</b> {Password}<br>
                        <b>Patient State User Name:</b> {StateLoginUserName}<br>
                        <b>Patient State Password:</b> {StateLoginPassword}<br>
                        <b>Patient Login:</b> {LoginURL}<br>
                        <b>Patient Form:</b> {PatientForm}<br>
                        <b>Back to Website Link:</b> {BacktoWebsite}<br>
                        <b>Appointment Date:</b> {Date}<br>
                        <b>Appointment Time:</b> {Time}<br>
                        <b>Appointment Category:</b> {AppointmentCategory}<br>
                        <b>DoctorName:</b> {DoctorName}<br>
                        <b>Email:</b> {DoctorEmail}<br>
                        <b>Phone:</b> {DoctorPhone}<br>
                        <b>Fax Phone:</b> {FaxNumber}<br>
                        <b>Address:</b> {DoctorAddress}<br>
                        <b>Clinic Name:</b> {ClinicName}<br>
                        <b>License #:</b> {DoctorLicense}<br>
                        <b>Doctor Profile Image</b> {DoctorPhoto}<br>
                    </div>
                    <hr class="solid">
                    <button type="submit" name="submit_form" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </section>

</div>

@endsection

@section('scripts')

<script src="https://cdn.ckeditor.com/4.5.8/standard-all/ckeditor.js"></script>
<script type="text/javascript" src="<?=base_url('assets/global_assets/js/plugins/forms/validation/validate.min.js'); ?>"></script>

<script type="text/javascript">
  $(document).ready(function(){

     // Initialize
    var validator = $('.admin-form-validate').validate({
            
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-invalid-label',
            successClass: 'validation-valid-label',
            validClass: 'validation-valid-label',
            
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            
            // success: function(label) {
            //     label.addClass('validation-valid-label').text('Success.'); // remove to hide Success message
            // },

            // Different components require proper error label placement
            errorPlacement: function(error, element) {

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

                // Other elements
                else {
                    error.insertAfter(element);
                }

            },


            rules: {               
              
            },

            messages: {
                   
            }

        });

  });

</script>
@endsection


