@extends('layout.master_user')
@section('title', 'Update Profile')
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
</style>

 <div class="content-wrapper">
     <!-- Page header -->
     <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">Update Profile</span></h4>
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
    
    <section class="content">
        <div class="card">
           <div class="card-body">
              <?= __message();?>
                <form action="<?php echo base_url('users/profile/')?>" method="post" class="admin-form-validate form-horizontal" id="myform" enctype="multipart/form-data"> 
                    <div class="form-row">
                        <div class="col-lg-7 col-md-6">
                        
                         <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-md-3">First Name <span class="text-danger dark"> * </span></label>
                            <div class="col-lg-8 col-md-8">
                            <input type="text" class="form-control " required="" name="fname" id="name" value="<?=$patient['patient_fname'];?>">
                            </div>
                         </div>
                         <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-md-3">Last Name <span class="text-danger dark"> * </span></label>
                            <div class="col-lg-8 col-md-8">
                            <input type="text" class="form-control " required="" name="mname" id="name" value="<?=$patient['patient_mname'];?>">
                            </div>
                         </div>

                         <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-md-3">Last Name <span class="text-danger dark"> * </span></label>
                            <div class="col-lg-8 col-md-8">
                            <input type="text" class="form-control " required="" name="lname" id="name" value="<?=$patient['patient_lname'];?>">
                            </div>
                         </div>
                         
                         <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-md-3">Email<span class="text-danger dark"> * </span> </label>
                               <div class="col-lg-8 col-md-8"> 
                                <input type="text" class="form-control" name="email" required value="<?=$patient['patient_email'];?>" id="email">
                               </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-form-label col-lg-3 col-md-3">Phone <span class="text-danger dark"> * </span></label>
                                <div class="col-lg-8 col-md-8">
                                <input type="text" class="form-control phoneformate" name="phone" required value="<?=$patient['patient_phone'];?>" id="phone">
                            </div>
                           </div>
                            <div class="form-group row">
                               <label class="col-form-label col-lg-3 col-md-3">Patient DOB </label>
                                <div class="col-lg-8 col-md-8">
                                 <input type="text" class="form-control" name="date_of_birth" value="<?=$patient['patient_dob'];?>" id="website">
                             </div>
                            </div>
                           
                             <div class="form-group row">
                               <label class="col-form-label col-lg-3 col-md-3">Country </label>
                                 <div class="col-lg-8 col-md-8">  
                                  <select class="form-control" name="country" id="country">
                                    <option value="">Select A Country</option>
                                    <?php
                                      foreach ($countries as $key => $val) {
                                      ?>
                                      <option value="<?= $val?>" <?php if($patient['patient_country'] == $val){ echo "selected"; } ?> ><?= $val?></option>
                                      <?php
                                  }
                                  ?>
                                </select>
                             </div>
                           </div>
                         
                          <div class="form-group row">
                             <label class="col-form-label col-lg-3 col-md-3">State </label>
                               <div class="col-lg-8 col-md-8">
                                <input type="text" class="form-control" name="state" value="<?=$patient['patient_state'];?>" id="state">
                            </div>
                         </div>
                         
                           <div class="form-group row">
                              <label class="col-form-label col-lg-3 col-md-3">City </label>
                                <div class="col-lg-8 col-md-8">
                                <input type="text" class="form-control" name="city" value="<?=$patient['patient_city'];?>" id="city">
                            </div>
                        </div>
                     
                        <div class="form-group row">
                          <label class="col-form-label col-lg-3 col-md-3">Address 1</label>
                              <div class="col-lg-8 col-md-8">
                                 <input type="text" class="form-control" name="address" value="<?=$patient['patient_address1'];?>" id="address">
                            </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-form-label col-lg-3 col-md-3">Address 2</label>
                              <div class="col-lg-8 col-md-8">
                                 <input type="text" class="form-control" name="address2" value="<?=$patient['patient_address2'];?>" id="address">
                            </div>
                        </div>
                       
                          <div class="form-group row">
                              <label class="col-form-label col-lg-3 col-md-3">Timezone </label>
                                <div class="col-lg-8 col-md-8">
                                  <select class="form-control" name="timezone" id="timezone">
                                    <option value="">Select Timezone</option>
                                    <?php
                                    foreach($timezones as $key1 => $val1)
                                    {
                                    ?>
                                    <optgroup label="<?= $key1?>">
                                    <?php
                                    foreach ($val1 as $key2 => $val2) {
                                        ?>
                                        <option value="<?= $key2?>" <?php if($patient['timezone'] == $key2){echo "selected";} ?> ><?= $val2?></option>
                                        <?php
                                    }
                                    ?>
                                    </optgroup>
                                    <?php
                                    }
                                    ?>
                                </select>
                             </div>
                           </div>
                        
                           <div class="form-group row">
                             <label class="col-form-label col-lg-3 col-md-3">Postal Code</label>
                                <div class="col-lg-8 col-md-8">
                                <input type="text" class="form-control" name="zip" value="<?=$patient['patient_zip'];?>" id="zip">
                            </div>
                        </div> 
                         
                           <div class="form-group row">
                             <label class="col-form-label col-lg-3 col-md-3">Social Security</label>
                               <div class="col-lg-8 col-md-8">
                                <input type="text" class="form-control" name="social_security" value="<?=$patient['patient_social_sec'];?>" id="controlled_license">
                            </div>
                         </div>
                        
                          <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-md-3">Initial Visit</label>
                              <div class="col-lg-8 col-md-8">
                                <input type="text" class="form-control" name="initial_visit" value="<?=$patient['patient_init_visit'];?>" id="reg_no">
                            </div>
                         </div>

                         <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-md-3">Weight</label>
                              <div class="col-lg-8 col-md-8">
                                <input type="text" class="form-control" name="weigth" value="<?=$patient['patient_weigth'];?>" id="reg_no">
                            </div>
                         </div>

                         <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-md-3">Height</label>
                              <div class="col-lg-8 col-md-8">
                                <input type="text" class="form-control" name="height" value="<?=$patient['patient_height'];?>" id="reg_no">
                            </div>
                         </div>

                          
                          <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-md-3">Approval Status </label>
                              <div class="col-lg-8 col-md-8"> 
                                <select class="form-control" name="status" id="status">
                                    <option value="Active" <?php if($patient['patient_status'] == "Active"){echo "selected";} ?> >Active</option>
                                    <option value="Inactive" <?php if($patient['patient_status'] == "Inactive"){echo "selected";} ?> >Inactive</option>
                                </select>
                             </div>
                          </div>
                        
                       </div>
                      </div>
                        
                        <div class="form-row">
                          <div class="col-lg-12 col-md-12">
                            
                            <!-- <div class="form-group row"> 
                             <label class="col-form-label col-lg-1 col-md-1">Profile </label>
                               <div class="col-lg-10 col-md-10 ml-5">
                                <textarea class="ckeditor" name="profile_info" id="profile_info"></textarea>
                               </div>
                             </div>
                             -->
                            <div class="form-group row">
                              <label class="col-form-label col-lg-1 col-md-1">Upload Image</label>
                                <div class="col-md-10 col-lg-10 ml-5">
                                 <div id="fileuploader">Upload</div>
                                 <div id="data"></div>
                               </div>
                             </div>
                           <?php 

                            if($patient['patient_photo'])
                            {
                                $url = $patient['patient_photo'];
                                
                           ?>  
                           <div class="form-group">
                              <div class="col-md-3">
                                  <img src="<?=base_url($url);?>" class="rounded-sm" width="130px" height="150px">
                              </div>
                            </div>
                           <?php } ?> 
                         </div>
                        </div>
                    <hr>   
                    <button type="submit" name="profile" class="btn btn-primary">Save Changes</button>
                    <a href="<?=base_url("user");?>" class="btn btn-primary ml-2">Back</a>
                 </div>
                </form>
               </div>
             </section>
           
           <section class="content">
              <div class="card">
                  <div class="card-header header-element-inline">
                      <h3 class="card-title">Change Password</h3>
                  </div>

                     <div class="card-body">
                       <?= __message();?>
                          <form method="post" class="form-horizontal admin-form-validate_pass" action="<?php echo base_url('users/profile/update_password/'); ?>" id="myform2" enctype="multipart/form-data">
                               <div class="row">
                                    <div class="col-md-12 col-lg-12" style="padding-left: 21px; padding-right: 21px;">
                                        <div class="row" style="background-color: #F8F8F8;padding: 10px 10px 30px 20px;">
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <h3>Your password must meet the following requirements:</h3>

                                            </div>
                                            <div class="col-md-8 col-lg-8 col-sm-12 mt-1" style="color: #33AE8A">
                                        
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label class="pull-left mr-1">
                                                <i class="fa fa-check font_css" style="border-color: #229A71;"></i>
                                            </label>
                                            <div class="mt-2">Minimum 10 characters</div>
                                        </div>
                                       
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label class="pull-left mr-1"">
                                                <i class="fa fa-check font_css" style="border-color: #229A71;"></i>
                                            </label>
                                            <div class="mt-2">Must include a number</div>
                                        </div>
                                        
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label class="pull-left mr-1">
                                                <i class="fa fa-check font_css" style="border-color: #229A71;"></i>
                                            </label>
                                            <div class="mt-2">Must include mixed case</div>
                                        </div>
                                       
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label class="pull-left mr-1" >
                                                <i class="fa fa-check font_css" style="border-color: #229A71;"></i>
                                            </label>
                                            <div class="mt-2">Must include a special character</div>
                                        </div>

                                    </div>
                                 </div>
                               </div>
                            </div>


                         <div class="row mt-2">
                          <div class="col-md-6 col-lg-6">
                           <div class="form-group">
                             <label class="control-label">Password</label>
                                <input type="password" class="form-control" name="password"  value="" id="password" autocomplete="OFF">
                           </div> 

                          <div class="form-group">
                             <label class="control-label">Confirm Password</label>
                               <input type="password" class="form-control" name="confirm_password"  value="" id="confirm_password" autocomplete="OFF">
                            
                          </div> 

                            <div class="form-group">
                                    <label for="show-password">
                                    <input type="checkbox" id="show-password" onclick="myFunction()"
                                           style="width: 24px;height: 24px;position: relative;top: 6px;margin-right: 5px;">
                                    Show Password</label>
                            </div>
 
                            <hr>       
                            <button type="submit" name="update1" id="admin-form" form="myform2" class="btn btn-submit btn-primary ml0" style="width: 80px;border-radius: 5px;">Update
                            </button>
                             </div>
                           </div>

                        </form>
                      
                      </div>
                    </div>
            
             </section>
             </div>
            </div>
@endsection

@section('scripts')

<link rel="stylesheet" type="text/css" href="<?= base_url('vendor/plugins/uploadfile/uploadfile.css') ?>"/>
<script type="text/javascript" src="<?= base_url('assets/plugins/jquerymask/jquery.maskedinput.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('vendor/plugins/uploadfile/jquery.uploadfile.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/global_assets/js/plugins/forms/validation/validate.min.js'); ?>"></script>
<script type="text/javascript" src="https://cdn.ckeditor.com/4.5.8/standard-all/ckeditor.js"></script>

<script type="text/javascript">
    
    function myFunction()
    {
        var a = document.getElementById("password");
        var b = document.getElementById("confirm_password");

        if(a.type === "password")
        {
            a.type = "text";
        }
        else
        {
            a.type = "password" 
        }
        if(b.type === "password")
        {
            b.type = "text";
        }else
        {
            b.type = "password";
        }
    
    }

    $(document).ready(function(){
        
        $('.phoneformate').mask('999-999-9999');

        $("#fileuploader").uploadFile({
            url:"<?=base_url("general/upload_files")?>",
            fileName:"uploadFile",
            showDelete:true,
            showDone:true,
            doneStr:'Successful',
            dragDrop:true,

            onSuccess:function(files,data,xhr,pd)
            {
                data = jQuery.parseJSON(data)
                $("#data").append('<div><input type="hidden" name="patient_files" value="'+data[0]+'" /><input type="hidden" name="patient_files_names" value="'+data[1]+'" /></div>')/**/
            },

            deleteCallback: function(data,pd)
            {
                data = jQuery.parseJSON( data )
                $('input[value="'+data[0]+'"]').parent().remove();


            }

        });


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

                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "<?= base_url("api/validateEmail/patient")?>",
                        type: "post",
                        data :
                        {
                            user_id: <?=$patient["patient_user_id"]?>
                        }

                    }
                }

            },

            messages: {

                name: {
                    required : "Please specify your name."
                },  

                email: {
                    remote: "Email exists with same address."
                },

                phone:{
                    required : "Please specify your phone number."
                }, 

            }

        });

         // Initialize
         var validator = $('.admin-form-validate_pass').validate({
            
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

                
                password: {
                    required: true,
                    pwchecklowercase: true,
                    pwcheckuppercase: true,
                    pwchecknumber: true,
                    pwcheckspechars: true,
                    minlength: 10,
                    maxlength: 16
                },

                confirm_password: {
                
                    minlength: 10,
                    maxlength: 16,
                    equalTo: '#password'
                }
               
            },

            messages: {

                password: {
                    pwchecklowercase: "The password must have 1 lowercase character!",
                    pwcheckuppercase: "The password must have 1 upercase character!",
                    pwchecknumber: "The password must have 1 number!",
                    pwcheckspechars: "The password must have 1 special character!",
                },
            }

        });

        $.validator.addMethod("pwchecklowercase",
            function (value, element) {
                if (value == '') {
                    return true;
                } else {
                    return /[a-z]/.test(value);
                }
        });

        $.validator.addMethod("pwcheckuppercase",
            function (value, element) {
                if (value == '') {
                    return true;
                } else {
                    return /[A-Z]/.test(value);
                }
        });

        $.validator.addMethod("pwchecknumber",
            function (value, element) {
                if (value == '') {
                    return true;
                } else {
                    return /\d/.test(value);
                }
        });

        $.validator.addMethod("pwcheckspechars",
            function (value, element){
            if (value == '')  {
                return true;
            }else{
                return /[!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]/.test(value);
            }
        });

    });

</script>
@endsection