@extends('layout.master_doctor')
@section('title', 'Edit Patient')
@section('content')

<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">Edit Patient</span></h4>
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
     
        <div class="card">
            <form action="" method="post" class="admin-form-validate" id="myform">
                <div class="card-body">
                  <?=__message()?>
                    <div class="form-group row ">
                        <div class="col-md-12">
                            <div class="mb-1"><b>GENERAL INFORMATION</b></div>
                        </div>
                    </div>
                    <div class="form-group row ">

                         <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                            <label>First Name<span class="text-danger dark"> * </span></label>
                            <div class="mb-2">
                                <input type="text" name="fname" value="<?=$patient['patient_fname'];?>" class="form-control" required placeholder="First Name"
                                       id="fname">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                            <label>Middle Name</label>
                            <div class="mb-2">
                                <input type="text" name="mname" value="<?=$patient['patient_mname'];?>" class="form-control" placeholder="Middle Name"
                                       id="mname">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Last Name <span class="text-danger dark"> * </span></label>
                            <div class="mb-2">
                                <input type="text" class="form-control " required name="lname" value="<?=$patient['patient_lname'];?>" id="lname" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Date Of Birth<span class="text-danger dark"> * </span></label>
                            <div class="mb-2">
                                <input type="text" class="form-control" autocomplete="off" name="date_of_birth" value="<?=$patient['patient_dob'];?>" required
                                       value="" id="dob">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Address 1<span class="text-danger dark"> * </span></label>
                            <div class="mb-2">
                                <input type="text" class="form-control" name="address1" value="<?=$patient['patient_address1'];?>" required value="" id="address1">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Address 2</label>
                            <div class="mb-2">
                                <input type="text" class="form-control" name="address2" value="<?=$patient['patient_address2'];?>" value="" id="address2">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Country<span class="text-danger dark"> * </span></label>
                            <div class="mb-2">
                                <select class="form-control" name="country" id="country" required>
                                    <option value="">Select A Country</option>
                                    <?php

                                    foreach ($countries as $key => $val) {

                                        ?>
                                        <option value="<?= $val ?>" <?php if($patient['patient_country'] == $val){echo "selected"; }?> ><?= $val ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>State </label>
                            <div class="mb-2">
                                <input type="text" class="form-control" name="state" value="<?=$patient['patient_state'];?>" id="state">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>City </label>
                            <div class="mb-2">
                                <input type="text" class="form-control" name="city" value="<?=$patient['patient_city'];?>" id="city">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Postal Code</label>
                            <div class="mb-2">
                                <input type="text" class="form-control" name="zip" value="<?=$patient['patient_zip'];?>" id="zip">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Sex<span class="text-danger dark"> * </label>
                            <div class="mb-2">
                                <select name="sex" id="sex" required class="form-control">
                                    <option value="" selected="selected">Select Your Gender</option>
                                    <option value="Male" <?php if($patient['patient_sex'] == "Male"){echo "selected"; }?> >Male</option>
                                    <option value="Female" <?php if($patient['patient_sex'] == "Female"){echo "selected"; }?>>Female</option>
                                    <option value="Other" <?php if($patient['patient_sex'] == "Other"){echo "selected"; }?> >Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Social Security </label>
                            <div class="mb-2">
                                <input type="text" class="form-control " name="social_security"
                                       id="social_security" value="<?=$patient['patient_social_sec'];?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Weight</label>
                            <div class="mb-2">
                                <input type="text" class="form-control" name="weigth" value="<?=$patient['patient_weigth'];?>" id="weight">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Height</label>
                            <div class="mb-2">
                                <input type="text" class="form-control" name="height" value="<?=$patient['patient_height'];?>" id="height">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Parent/Guardian</label>
                            <div class="mb-2">
                                <input type="text" class="form-control" name="guardian"
                                       placeholder="Parent/Guardian" value="<?=$patient['patient_guardian'];?>" id="guardian">
                            </div>
                        </div>


                    </div>
                    <div class="form-group row ">
                        <div class="col-md-12">
                            <div class="mb-1"><b>OTHER INFORMATION</b></div>
                        </div>
                    </div>
                    <div class="form-group row ">

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Email<span class="text-danger dark"> * </span></label>
                            <div class="mb-2">
                                <input type="email" class="form-control" name="email" value="<?=$patient['patient_email'];?>" required id="email" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Phone <span class="text-danger dark"> * </span></label>
                            <div class="mb-2">
                                <input type="text" class="form-control phoneformate" name="phone" value="<?=$patient['patient_phone'];?>" required
                                       id="phone">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Contact Option</label>
                            <div class="mb-2 checkbox">
                                <label>
                                 
                                <input type="checkbox" name="is_sms" id="is_sms" value="1"
                                             class="ml-3" <?php if($patient['is_sms'] == 1){echo "checked"; }?> >SMS </label>
                                &nbsp;&nbsp;&nbsp;

                                <label><input type="checkbox" class="" name="is_email" value="1" <?php if($patient['is_email'] == 1){echo "checked";}?>
                                              id="is_email"> Email </label>


                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Initial Visit <span
                                        class="text-danger dark"> * </span></label>
                            <div class="mb-2">
                                <input type="text" class="form-control " required="" name="initial_visit"
                                       id="initial_visit" value="<?=$patient['patient_init_visit'];?>">
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Timezone </label>
                            <div class="mb-2">
                                <select class="form-control" name="timezone" id="timezone">
                                    <option value="">Select Timezone</option>
                                    <?php

                                    foreach ($timezones as $key1 => $val1) {

                                        ?>
                                        <optgroup label="<?= $key1 ?>">
                                            <?php

                                            foreach ($val1 as $key2 => $val2) {

                                                ?>
                                                <option value="<?= $key2 ?>" <?php if($patient['patient_timezone'] == $key2){echo "selected"; }?> ><?= $val2 ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Approval Status </label>
                            <div class="mb-2">
                                <select class="form-control" name="status" id="status">
                                    <option value="0" <?php if($patient['patient_status'] == "0"){echo "selected"; }?>>Approved</option>
                                    <option value="1" <?php if($patient['patient_status'] == "1"){echo "selected"; }?>>Unapproved</option>
                                    <option value="2" <?php if($patient['patient_status'] == "2"){echo "selected"; }?>>Pending</option>

                                </select>
                            </div>
                        </div>


                    </div>

                    <div class="form-group row ">
                        <div class="col-md-12">
                            <div class="mb-1"><b>Patient Portal</b></div>
                        </div>
                    </div>
                    <div class="form-group row ">


                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>User Name<span
                                        class="text-danger dark"> * </span>
                            </label>
                            <div class="mb-2">
                                <input type="text" class="form-control" name="user_name" value="<?=$patient['patient_user_name'];?>" required
                                       id="user_name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Password <span class="text-danger dark"> * </span></label>
                            <div class="mb-2">
                                <input type="password" class="form-control" name="password"
                                       id="password" autocomplete="OFF">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <label>Confirm Password <span
                                        class="text-danger dark"> * </span></label>
                            <div class="mb-2">
                                <input type="password" class="form-control" name="confirm_password" 
                                       id="confirm_password" autocomplete="OFF">
                            </div>
                        </div>


                    </div>
                    <div class="form-group row ">
                        <div class="col-md-12">
                            <div class="mb-1"><b>DRIVERS LICENSE/STATE ID AND PHOTO</b>
                                (Optional)
                            </div>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <div class="col-md-4">
                            <div class="card br-a" style="margin: 23px auto;">
                                <div class="br-n card-body ph20">
                                    <label>Drivers Lic Or State ID - Front</label>
                                    <div class="card br-a" id="upload_panel1234">

                                     <div class="card-body">



                                        <div class="col-xs-12  <?php if($patient['idcard_url_front'] == ""){echo 'hidden';}?> " id="image_cont_stateid">
                                            <img src="<?php if($patient['idcard_url_front'] != ""){echo base_url($patient['idcard_url_front']);}?>" style="max-width: 100%;">
                                            <a id="delete_image_cont_stateid" class="fs12 delete_image "><i class="fa fa-close"></i></a>
                                            <input type="hidden" name="idcard_url_front" id="image">
                                            <input type="hidden" name="idcard_url_front_old" value="<?=$patient['idcard_url_front']?>" >

                                        </div>
                                        <div class="col-xs-12 <?php if($patient['idcard_url_front'] != ""){echo 'hidden';}?>" id="control_cont_stateid">
                                            <button type="button" id="upload_button"
                                                    data-ip-modal="#avatarModal_stateid" class="btn btn-md mv10"
                                                    style="background-color: white;border-radius: 5px !important;border-color: rgba(0, 0, 0, 0.1);">
                                                Upload
                                            </button>
                                        </div>

                                     </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="card br-a" style="margin: 23px auto;">
                                <div class="br-n card-body ph20">
                                    <label>Drivers Lic Or State ID - Back</label>
                                    <div class="card br-a" id="upload_panel1234">

                                        <div class="card-body">

                                            <div class="col-xs-12  <?php if($patient['idcard_url_back'] == ""){echo 'hidden';}?>" id="image_cont_stateid_back">
                                                <img src="<?php if($patient['idcard_url_back'] != ""){echo base_url($patient['idcard_url_back']);}?>" style="max-width: 100%;">
                                                <a id="delete_image_cont_back" class="fs12 delete_image "><i class="fa fa-close"></i></a>
                                                <input type="hidden" name="idcard_url_back" id="image_back">
                                                <input type="hidden" name="idcard_url_back_old" value="<?=$patient['idcard_url_back'];?>">

                                            </div>

                                            <div class="col-xs-12 <?php if($patient['idcard_url_back'] != ""){echo 'hidden';}?>" id="control_cont_stateid_back">
                                                <button type="button" id="upload_button"
                                                        data-ip-modal="#avatarModal_stateid_back"
                                                        class="btn btn-md mv10"
                                                        style="background-color: white;border-radius: 5px !important;border-color: rgba(0, 0, 0, 0.1);">
                                                    Upload
                                                </button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                           
                            <div class="card br-a" style="margin: 23px auto;">
                                <div class="br-n card-body ph20">
                                    <label>Patient Photo (Required For ID Card)</label>
                                    <div class="card br-a" id="upload_panel1234">

                                        <div class="card-body">


                                            <div class="col-xs-12  <?php if($patient['patient_photo'] == ""){echo 'hidden';}?>" id="image_cont_stateid_photo">
                                                <img src="<?php if($patient['patient_photo'] != ""){echo base_url($patient['patient_photo']);}?>" style="max-width: 100%;">

                                                <a id="delete_image_cont_photo" class="fs12 delete_image "><i class="fa fa-close"></i></a>
                                                <input type="hidden" name="patient_photo" id="patient_photo">
                                                <input type="hidden" name="patient_photo_old" value="<?=$patient['patient_photo'];?>">
                                            </div>
                                            <div class="col-xs-12 <?php if($patient['patient_photo'] != ""){echo 'hidden';}?>" id="control_cont_stateid_photo">
                                                <button type="button" id="upload_button"
                                                        data-ip-modal="#avatarModal_stateid_photo"
                                                        class="btn btn-md mv10"
                                                        style="background-color: white;border-radius: 5px !important;border-color: rgba(0, 0, 0, 0.1);">
                                                    Upload
                                                </button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <hr class="solid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?= base_url("doctor/patients/manage/3"); ?>" class="btn btn-primary">Back</a>
                </div>
            </form>
        </div>
     </section>
   </div>

<div class="ip-modal" id="avatarModal_stateid" style="display:none;">
    <div class="ip-modal-dialog">
        <div class="ip-modal-content border-top-0">
            <div class="ip-modal-header">
                <a class="ip-close" title="Close">&times;</a>
                <h4 class="ip-modal-title">Drivers Lic Or State ID - Front</h4>
            </div>
            <div class="ip-modal-body">
                <div class="btn btn-primary ip-upload">Upload <input type="file" name="file" class="ip-file"></div>

                <button type="button" class="btn btn-info ip-edit">Edit</button>
                <button type="button" class="btn btn-danger ip-delete">Delete</button>
                <div class="alert ip-alert"></div>

                <div class="ip-preview"></div>
                <div class="ip-rotate">
                    <button type="button" class="btn btn-default ip-rotate-ccw" title="Rotate counter-clockwise"><i class="icon-ccw"></i></button>
                    <button type="button" class="btn btn-default ip-rotate-cw" title="Rotate clockwise"><i class="icon-cw"></i></button>
                </div>
                <div class="ip-progress">
                    <div class="text">Uploading</div>
                    <div class="progress progress-striped active">
                        <div class="progress-bar"></div>
                    </div>
                </div>
            </div>
            <div class="ip-modal-footer">
                <div class="ip-info" style="text-align:center">
                    <span class="fs15" style="background-color:red; color:white; padding-left:102px; padding-right:102px; padding-bottom:2px; padding-bottom:2px"><b>IMPORTANT - PLEASE CROP IMAGE</b></span><br /><br />
                    <span class="fs13"><b>Click and drag a region on the image, then click "Save Image"</b></span>
                    <hr />
                </div>
                <div class="ip-actions">
                    <button type="button" class="btn btn-success ip-save">Save Image</button>
                    <button type="button" class="btn btn-primary ip-capture">Capture</button>
                    <button type="button" class="btn btn-light ip-cancel">Cancel</button>
                </div>
                <button type="button" class="btn btn-light ip-close">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="ip-modal" id="avatarModal_stateid_back" style="display:none;">
    <div class="ip-modal-dialog">
        <div class="ip-modal-content border-top-0">
            <div class="ip-modal-header">
                <a class="ip-close" title="Close">&times;</a>
                <h4 class="ip-modal-title">Drivers Lic Or State ID - Back</h4>
            </div>
            <div class="ip-modal-body">
                <div class="btn btn-primary ip-upload">Upload <input type="file" name="file" class="ip-file"></div>

                <button type="button" class="btn btn-info ip-edit">Edit</button>
                <button type="button" class="btn btn-danger ip-delete">Delete</button>
                <div class="alert ip-alert"></div>

                <div class="ip-preview"></div>
                <div class="ip-rotate">
                    <button type="button" class="btn btn-default ip-rotate-ccw" title="Rotate counter-clockwise"><i class="icon-ccw"></i></button>
                    <button type="button" class="btn btn-default ip-rotate-cw" title="Rotate clockwise"><i class="icon-cw"></i></button>
                </div>
                <div class="ip-progress">
                    <div class="text">Uploading</div>
                    <div class="progress progress-striped active">
                        <div class="progress-bar"></div>
                    </div>
                </div>
            </div>
            <div class="ip-modal-footer">
                <div class="ip-info" style="text-align:center">
                    <span class="fs15" style="background-color:red; color:white; padding-left:102px; padding-right:102px; padding-bottom:2px; padding-bottom:2px"><b>IMPORTANT - PLEASE CROP IMAGE</b></span><br /><br />
                    <span class="fs13"><b>Click and drag a region on the image, then click "Save Image"</b></span>
                    <hr />
                </div>
                <div class="ip-actions">
                    <button type="button" class="btn btn-success ip-save">Save Image</button>
                    <button type="button" class="btn btn-primary ip-capture">Capture</button>
                    <button type="button" class="btn btn-light ip-cancel">Cancel</button>
                </div>
                <button type="button" class="btn btn-light ip-close">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="ip-modal" id="avatarModal_stateid_photo" style="display:none;">
    <div class="ip-modal-dialog">
        <div class="ip-modal-content border-top-0">
            <div class="ip-modal-header">
                <a class="ip-close" title="Close">&times;</a>
                <h4 class="ip-modal-title">Photo For Patient ID Card</h4>
            </div>
            <div class="ip-modal-body">
                <div class="btn btn-primary ip-upload">Upload <input type="file" name="file" class="ip-file"></div>

                <button type="button" class="btn btn-info ip-edit">Edit</button>
                <button type="button" class="btn btn-danger ip-delete">Delete</button>
                <div class="alert ip-alert"></div>

                <div class="ip-preview"></div>
                <div class="ip-rotate">
                    <button type="button" class="btn btn-default ip-rotate-ccw" title="Rotate counter-clockwise"><i class="icon-ccw"></i></button>
                    <button type="button" class="btn btn-default ip-rotate-cw" title="Rotate clockwise"><i class="icon-cw"></i></button>
                </div>
                <div class="ip-progress">
                    <div class="text">Uploading</div>
                    <div class="progress progress-striped active">
                        <div class="progress-bar"></div>
                    </div>
                </div>
            </div>
            <div class="ip-modal-footer">
                <div class="ip-info" style="text-align:center">
                    <span class="fs15" style="background-color:red; color:white; padding-left:102px; padding-right:102px; padding-bottom:2px; padding-bottom:2px"><b>IMPORTANT - PLEASE CROP IMAGE</b></span><br /><br />
                    <span class="fs13"><b>Click and drag a region on the image, then click "Save Image"</b></span>
                    <hr />
                </div>
                <div class="ip-actions">
                    <button type="button" class="btn btn-success ip-save">Save Image</button>
                    <button type="button" class="btn btn-primary ip-capture">Capture</button>
                    <button type="button" class="btn btn-light ip-cancel">Cancel</button>
                </div>
                <button type="button" class="btn btn-light ip-close">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<link rel="stylesheet" href="<?= base_url('vendor/plugins/imgpicker/css/imgpicker.css'); ?>">
<link href="<?=base_url('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>" rel="stylesheet">
<script src="<?=base_url('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>" ></script>
<script src="<?= base_url('assets/plugins/jquerymask/jquery.maskedinput.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/global_assets/js/plugins/forms/validation/validate.min.js'); ?>"></script>
<script src="<?= base_url('vendor/plugins/imgpicker/js/jquery.Jcrop.min.js') ?>"></script>
<script src="<?= base_url('vendor/plugins/imgpicker/js/jquery.imgpicker.js') ?>"></script>

<script type="text/javascript">
    
    jQuery(document).ready(function () {
        
        $('.phoneformate').mask('999-999-9999');

         $("#dob").datepicker({
            dateFormat: 'd MM, yy',
            changeMonth: true,
            changeYear: true
        })

        $("#initial_visit").datepicker({
            dateFormat: 'd MM, yy'
        })

         $('#myModal').imgPicker({
            url: '<?=base_url('general/imagecroperupload')?>',
            //aspectRatio: 1,
            /*loadComplete: function(image) {
                // Set #avatar image src
                $('#avatar').attr('src', image.versions.bg.url);
                // Set the image for re-crop
                this.setImage(image);
            },*/
            deleteComplete: function () {
                // Restore default avatar
                $('#avatar').attr('src', 'http://www.gravatar.com/avatar/0?d=mm&s=150');
                // Hide modal
                this.modal('hide');
            },
            cropSuccess: function (image) {
                // Set #avatar src
                $('#avatar').attr('src', image.versions.bg.url);
                // Hide modal
                this.modal('hide');
            }
        });
        $('#avatarModal_stateid').imgPicker({
            url: '<?=base_url('general/imagecroperupload')?>',
            //aspectRatio: 1, // Crop aspect ratio
            deleteComplete: function () {
                $('#avatar').attr('src', '');
                this.modal('hide');
            },
            cropSuccess: function (image) {
                console.log(image);
                $('#avatar').attr('src', image.versions.bg.url);
                $("#profile_image").val(image.versions.bg.filename)

                $("#image_cont_stateid img").attr("src",image.versions.bg.url);
                $("#image_cont_stateid").removeClass("hidden");
                $("#control_cont_stateid").addClass("hidden")
                $("#image").val(image.versions.bg.filename);

                this.modal('hide');

            }

        });
        $('#avatarModal_stateid_back').imgPicker({
            url: '<?=base_url('general/imagecroperupload')?>',
            //aspectRatio: 1, // Crop aspect ratio
            deleteComplete: function () {
                $('#avatar').attr('src', '');
                this.modal('hide');
            },
            cropSuccess: function (image) {
                console.log(image);
                $('#avatar').attr('src', image.versions.bg.url);
                $("#profile_image").val(image.versions.bg.filename)

                $("#image_cont_stateid_back img").attr("src",image.versions.bg.url);
                $("#image_cont_stateid_back").removeClass("hidden");
                $("#control_cont_stateid_back").addClass("hidden")
                $("#image_back").val(image.versions.bg.filename);

                this.modal('hide');

            }
        });
        $('#avatarModal_stateid_photo').imgPicker({
            url: '<?=base_url('general/imagecroperupload')?>',
            aspectRatio: 1, // Crop aspect ratio
            deleteComplete: function () {
                $('#avatar').attr('src', '');
                this.modal('hide');
            },
            cropSuccess: function (image) {
                console.log(image);
                $('#avatar').attr('src', image.versions.bg.url);
                $("#profile_image").val(image.versions.bg.filename)

                $("#image_cont_stateid_photo img").attr("src",image.versions.bg.url);
                $("#image_cont_stateid_photo").removeClass("hidden");
                $("#control_cont_stateid_photo").addClass("hidden")
                $("#patient_photo").val(image.versions.bg.filename);

                this.modal('hide');
            }
        });

        $(document).on("click","#delete_image_cont_stateid", function(){
            $("#image_cont_stateid").addClass('hidden');
            $("#control_cont_stateid").removeClass("hidden")
            $(".ip-edit").css("display", "none");
            $(".ip-delete").css("display", "none");
            $("#image").val("delete");
            alertbox('Image deleted successfully');
        });


        $(document).on("click","#delete_image_cont_back", function(){
            $("#image_cont_stateid_back").addClass('hidden');
            $("#control_cont_stateid_back").removeClass("hidden")
            $(".ip-edit").css("display", "none");
            $(".ip-delete").css("display", "none");
            $("#image_back").val("delete");
            alertbox('Image deleted successfully');
        });


        $(document).on("click","#delete_image_cont_photo", function(){
            $("#image_cont_stateid_photo").addClass('hidden');
            $("#control_cont_stateid_photo").removeClass("hidden")
            $(".ip-edit").css("display", "none");
            $(".ip-delete").css("   display", "none");
            $("#patient_photo").val("delete");
            alertbox('Image deleted successfully');
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

                    }
                },


                password: {
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
                },
                
                user_name: {
                    required: true,
                }

            },

            messages: {

                user_name: {
                    required : "Please specify your username."
                },  

                email: {
                    remote: "Email exists with same address."
                },

                phone:{
                    required : "Please specify your phone number."
                }, 

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