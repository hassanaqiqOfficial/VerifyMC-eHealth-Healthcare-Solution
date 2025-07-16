@extends('layout.master_doctor')
@section('title', 'Notifications')
@section('bodyClass', 'sidebar-right-visible sidebar-xs')
@section('content')


<?php require ("application/views/doctor/settings/notifications/notification_sidebar.php")?>


<div class="content-wrapper">


    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">
                <?php if(isset($fkid) && !empty($fkid)){ ?>
                    Edit Custom SMS
                <?php }else{ ?>
                    Add Custom SMS
                <?php } ?></span></h4>
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
                            <label>Title<span class="text-danger dark"> * </span></label>
                            <div class="">
                                <input type="text" name="template_title" value="<?=$custom_sms['title'];?>" class="form-control" required placeholder="Template Title"
                                       id="template_title">
                            </div>
                        </div>


                    </div>

                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                            <label>Body<span class="text-danger dark"> * </span></label>
                            <div class="">
                                <textarea name="body" class="form-control" required placeholder="Start typing here..." rows="6"><?=$custom_sms['body'];?></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="container mt-3">
                        <b>SMS Codes Available</b><hr style="mt-2 mb-2">
                        <b style="font-size: 12px;">You can use the codes located within the { } to include dynamic data in you email. To add copy and paste the codes below into your email above.</b><br><br>
                        <b>Patient Name:</b> {PatientName}<br>
                        <b>Patient First Name:</b> {PatientFirstName}<br>
                        <b>Patient Last Name:</b> {PatientLastName}<br>
                        <b>Patient Phone:</b> {PatientPhone}<br>
                        <b>Patient Email:</b> {PatientEmail}<br>
                        <b>Patient User Name:</b> {UserName}<br>
                        <b>Patient Password:</b> {Password}<br>
                        <b>Patient Login:</b> {LoginURL}<br>
                        <b>Patient Form:</b> {PatientForm}<br>
                        <b>Back to Website Link:</b> {BacktoWebsite}<br>
                        <b>Appointment Date:</b> {Date}<br>
                        <b>Appointment Time:</b> {Time}<br>
                        <b>DoctorName:</b> {DoctorName}<br>
                        <b>Email:</b> {DoctorEmail}<br>
                        <b>Phone:</b> {DoctorPhone}<br>
                        <b>Address:</b> {DoctorAddress}<br>
                        <b>Clinic Name:</b> {ClinicName}<br>
                        <b>License #:</b> {DoctorLicense}<br>
                        <b>Doctor Profile Image</b> {DoctorPhoto}<br>
                    </div>
                    <hr class="solid">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>

    </section>


</div>


@endsection
@section('scripts')

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

