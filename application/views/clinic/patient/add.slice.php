@extends('layout.master_clinic')
@section('title', 'Add Patient')
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

    .state-error .form-control {
        background: #FEE9EA;
        border-color: #DE888A;
    }
    
</style>

<div class="content-wrapper">

     <!-- Page header -->
     <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">Add Patient</span></h4>
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

     <!-- Content area -->
    <section class="content">
       <!-- Default grid -->
        <div class="card">
           
            <form action="<?=base_url('clinic/patient/add/'); ?>" method="post" class="admin-form-validate" id="myform">
                <div class="card-body">
                    
                   <div class="form-row ">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                            <div class="mb30 p10"><b>GENERAL INFORMATION</b></div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="form-row ">

                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                         <div class="form-group">  
                           <label>Physician<span class="text-danger dark"> * </span></label>
                             <div class="mb10">
                                <select class="form-control" name="doctor_id" id="doctor_id" required>
                                    <option value="">Select Physician</option>
                                    <?php

                                    foreach($doctors as $doctor){

                                        ?>
                                        <option value="<?= $doctor['doctor_user_id']; ?>"><?= $doctor['doctor_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                          </div>
                        </div>

                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                        <div class="form-group">  
                          <label>First Name<span class="text-danger dark"> * </span></label>
                            <div class="mb10">
                                <input type="text" name="fname" class="form-control" required placeholder="First Name"
                                       id="fname">
                            </div>
                          </div>
                        </div>

                     <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                        <div class="form-group"> 
                          <label>Middle Name</label>
                            <div class="mb10">
                                <input type="text" name="mname" class="form-control" placeholder="Middle Name"
                                       id="mname">
                            </div>
                        </div>
                      </div> 
                       
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">  
                          <label>Last Name <span class="text-danger dark"> * </span></label>
                            <div class="mb10">
                                <input type="text" class="form-control " required name="lname" id="lname" value="">
                            </div>
                        </div>
                     </div>
                     
                     
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">  
                           <label>Address 1<span class="text-danger dark"> * </span></label>
                            <div class="mb10">
                                <input type="text" class="form-control" name="address1" required value="" id="address1">
                            </div>
                        </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">                           
                          <label>Address 2</label>
                            <div class="mb10">
                                <input type="text" class="form-control" name="address2" value="" id="address2">
                            </div>
                        </div>
                      </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">   
                           <label>Country<span class="text-danger dark"> * </span></label>
                            <div class="mb10">
                                <select class="form-control" name="country" id="country" required>
                                    <option value="">Select A Country</option>
                                    <?php

                                    foreach ($countries as $key => $val) {

                                        ?>
                                        <option value="<?= $val ?>"><?= $val ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">   
                          <label>State </label>
                            <div class="mb10">
                                <input type="text" class="form-control" name="state" value="" id="state">
                            </div>
                          </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">    
                          <label>City </label>
                            <div class="mb10">
                                <input type="text" class="form-control" name="city" value="" id="city">
                            </div>
                          </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">   
                           <label>Postal Code</label>
                            <div class="mb10">
                                <input type="text" class="form-control" name="zip" value="" id="zip">
                            </div>
                          </div> 
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">    
                          <label>Sex<span class="text-danger dark"> * </label>
                            <div class="mb10">
                                <select name="sex" id="sex" required class="form-control">
                                    <option value="" selected="selected">Select Your Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                          </div> 
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">   
                          <label>Social Security </label>
                            <div class="mb10">
                                <input type="text" class="form-control " name="social_security"
                                       id="social_security" value="">
                            </div>
                           </div> 
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">  
                          <label>Weight</label>
                            <div class="mb10">
                                <input type="text" class="form-control" name="weigth" value="" id="weight">
                            </div>
                           </div> 
                         </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">  
                           <label>Height</label>
                            <div class="mb10">
                                <input type="text" class="form-control" name="height" value="" id="height">
                            </div>
                          </div> 
                        </div>


                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">                             
                          <label>Parent/Guardian</label>
                            <div class="mb10">
                                <input type="text" class="form-control" name="guardian"
                                       placeholder="Parent/Guardian" value="" id="guardian">
                            </div>
                          </div> 
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group"> 
                          <label>Date Of Birth<span class="text-danger dark"> * </span></label>
                            <div class="">
                                <input type="text" class="form-control" autocomplete="off" name="date_of_birth" required
                                       value="" id="dob">
                            </div>
                         </div>
                        </div>
                    </div>

                    <div class="form-row ">
                    <div class="col-md-12">
                        <div class="form-group">   
                        <div class=""><b>OTHER INFORMATION</b></div>
                        </div>    
                    </div>
                    </div>

                    <div class="form-row ">

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">   
                          <label>Email<span class="text-danger dark"> * </span></label>
                            <div class="mb10">
                                <input type="email" class="form-control" name="email" required value="" id="email">
                            </div>
                          </div> 
                        </div>
                        
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">  
                          <label>Phone <span class="text-danger dark"> * </span></label>
                            <div class="mb10">
                                <input type="text" class="form-control phoneformate" name="phone" required value=""
                                       id="phone">
                            </div>
                          </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group"> 
                           <label>Contact Option</label>
                            <div class="mb10 checkbox">
                                <label><input type="checkbox" name="is_sms" id="is_sms" value="1"
                                              class="ml-3"> SMS </label>
                                &nbsp;&nbsp;&nbsp;

                                <label><input type="checkbox" class="" name="is_email" value="1"
                                              id="is_email"> Email </label>


                            </div>
                          </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">  
                          <label>Initial Visit <span
                                        class="text-danger dark"> * </span></label>
                            <div class="mb10">
                                <input type="text" class="form-control " required="" name="initial_visit"
                                       id="initial_visit" value="<?= date("d F,Y") ?>">
                            </div>
                         </div> 
                        </div>


                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">    
                          <label>Timezone </label>
                            <div class="mb10">
                                <select class="form-control" name="timezone" id="timezone">
                                    <option value="">Select Timezone</option>
                                    <?php

                                    foreach ($timezones as $key1 => $val1) {

                                        ?>
                                        <optgroup label="<?= $key1 ?>">
                                            <?php

                                            foreach ($val1 as $key2 => $val2) {

                                                ?>
                                                <option value="<?= $key2 ?>"><?= $val2 ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    <?php } ?>
                                </select>
                            </div>
                          </div> 
                        </div>
                        
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">     
                          <label>Approval Status </label>
                            <div class="mb10">
                                <select class="form-control" name="status" id="status">
                                    <option value="Approved">Approved</option>
                                    <option value="Unapproved">Unapproved</option>
                                    <option value="Pending">Pending</option>

                                </select>
                            </div>
                        </div>
                     </div>
                   </div>

                    <div class="form-row ">
                        <div class="col-md-12">
                            <div class="form-group">
                            <div class="mv30 p10"><b>Patient Portal</b></div>
                        </div>
                      </div>
                    </div>

                    <div class="form-row ">


                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">
                          <label>User Name<span class="text-danger dark"> * </span>
                            </label>
                            <div class="mb10">
                                <input type="text" class="form-control" name="user_name" required value=""
                                       id="user_name">
                            </div>
                          </div>
                        </div>


                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">  
                         <label>Password <span class="text-danger dark"> * </span></label>
                            <div class="mb10">
                                <input type="password" class="form-control" name="password" required value=""
                                       id="password" autocomplete="OFF">
                            </div>
                          </div> 
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">  
                          <label>Confirm Password <span
                                        class="text-danger dark"> * </span></label>
                            <div class="mb10">
                                <input type="password" class="form-control" name="confirm_password" required value=""
                                       id="confirm_password" autocomplete="OFF">
                            </div>
                          </div> 
                        </div>


                    </div>
                    <div class="form-row ">
                        <div class="col-md-12">
                        <div class="form-group"> 
                            <div class="mv30 p10"><b>DRIVERS LICENSE/STATE ID AND PHOTO
                                (Optional)</b>
                            </div>
                        </div>   
                        </div>
                    </div>

                    <div class="form-row ">
                        <div class="col-md-4">
                             
                        <div class="form-group"> 
                            <div class="card br-a" style="margin:23px auto;">
                                <div class="br-n card-body">
                                    <label>Drivers Lic Or State ID - Front</label>
                                    <div class="card br-a" id="upload_panel1234">

                                     <div class="card-body">


                                        <div class="col-xs-12 hidden" id="image_cont_stateid">
                                            <img src="" style="max-width: 100%;">
                                            <a id="delete_image_cont_stateid" class="fs12 delete_image "><i class="fa fa-close"></i></a>
                                            <input type="hidden" name="idcard_url_front" id="image">

                                        </div>
                                        <div class="col-xs-12 " id="control_cont_stateid">
                                            <button type="button" id="upload_button_1"
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

                        </div>

                        <div class="col-md-4">
                        <div class="form-group">
                            <div class="card br-a" style="margin: 23px auto;">
                                <div class="br-n card-body">
                                    <label>Drivers Lic Or State ID - Back</label>
                                    <div class="card br-a" id="upload_panel1234">

                                        <div class="card-body">


                                            <div class="col-xs-12 hidden" id="image_cont_stateid_back">
                                                <img src="" style="max-width: 100%;">
                                                <a id="delete_image_cont_back" class="fs12 delete_image "><i class="fa fa-close"></i></a>
                                                <input type="hidden" name="idcard_url_back" id="image_back">

                                            </div>

                                            <div class="col-xs-12 " id="control_cont_stateid_back">
                                                <button type="button" id="upload_button_2"
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

                        </div>

                        <div class="col-md-4">
                             
                        <div class="form-group">
                            <div class="card br-a" style="margin: 23px auto;">
                                <div class="br-n card-body">
                                    <label>Patient Photo (Required For ID Card)</label>
                                    <div class="card br-a" id="upload_panel1234">

                                        <div class="card-body">


                                            <div class="col-xs-12 hidden" id="image_cont_stateid_photo">
                                                <img src="" style="max-width: 100%;">

                                                <a id="delete_image_cont_photo" class="fs12 delete_image "><i class="fa fa-close"></i></a>
                                                <input type="hidden" name="patient_photo" id="patient_photo"
                                                       required="" aria-required="true">

                                            </div>
                                            <div class="col-xs-12 " id="control_cont_stateid_photo">
                                                <button type="button" id="upload_button_3"
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
                    </div>
                    
                    <hr>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                    <a href="<?= base_url("clinic/patient"); ?>" class="btn btn-primary">Back</a>
                </div>
            </form>
        </div>
    </section>
</div>


<div class="ip-modal" id="avatarModal_stateid" style="display:none">
    <div class="ip-modal-dialog">
        <div class="ip-modal-content" style='border-top:none;'>
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
<div class="ip-modal" id="avatarModal_stateid_back" style="display:none">
    <div class="ip-modal-dialog">
        <div class="ip-modal-content" style="border-top:none;">
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

<div class="ip-modal" id="avatarModal_stateid_photo" style="display:none">
    <div class="ip-modal-dialog">
        <div class="ip-modal-content" style="border-top:none;">
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
<script src="<?= base_url('vendor/plugins/imgpicker/js/jquery.Jcrop.min.js') ?>"></script>
<script src="<?= base_url('vendor/plugins/imgpicker/js/jquery.imgpicker.js') ?>"></script>
<script src="<?= base_url('assets/plugins/form-validate/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/form-validate/additional-methods.min.js') ?>"></script>

<script type="text/javascript">
      
       $(function(){
            $("#initial_visit").datepicker({
                dateFormat: 'd MM, yy'
            });
       });
    
        jQuery(document).ready(function (){
        
             $('.phoneformate').mask('999-999-9999');

        $("#dob").datepicker({
            dateFormat: 'd MM, yy',
            changeMonth: true,
            changeYear: true
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
               // console.log(image);
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
                //console.log(image);
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
                //console.log(image);
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
            $("#image").val("");
            alertbox('Image deleted successfully');
        });


        $(document).on("click","#delete_image_cont_back", function(){
            $("#image_cont_stateid_back").addClass('hidden');
            $("#control_cont_stateid_back").removeClass("hidden")
            $(".ip-edit").css("display", "none");
            $(".ip-delete").css("display", "none");
            $("#image_back").val("");
            alertbox('Image deleted successfully');
        });


        $(document).on("click","#delete_image_cont_photo", function(){
            $("#image_cont_stateid_photo").addClass('hidden');
            $("#control_cont_stateid_photo").removeClass("hidden")
            $(".ip-edit").css("display", "none");
            $(".ip-delete").css("   display", "none");
            $("#patient_photo").val("");
            alertbox('Image deleted successfully');
        });

    });
</script>

<script type="text/javascript">
        
        jQuery(document).ready(function () {
         $.validator.methods.smartCaptcha = function (value, element, param) {
            return value == param;
        };

        var validator = $(".admin-form-validate")

        validator.validate({

            /* @validation states + elements
             ------------------------------------------- */

            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",
            focusInvalid: true,

            /* @validation rules
             ------------------------------------------ */

            messages: {
                name: "Please specify your name",

                email: {
                    remote: "Email already exists."
                },

                phone: "Please specify your phone number",

                password: {
                    pwchecklowercase: "The password must have 1 lowercase character!",
                    pwcheckuppercase: "The password must have 1 upercase character!",
                    pwchecknumber: "The password must have 1 number!",
                    pwcheckspechars: "The password must have 1 special character!",

                },
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
                    required: true,
                    pwchecklowercase: true,
                    pwcheckuppercase: true,
                    pwchecknumber: true,
                    pwcheckspechars: true,
                    minlength: 10,
                    maxlength: 16
                },

                confirm_password: {
                    required: true,
                    minlength: 10,
                    maxlength: 16,
                    equalTo: '#password'
                },
                user_name: {
                    required: true,

                }


            },
            /* @validation highlighting + error placement
             ---------------------------------------------------- */
            highlight: function (element, errorClass, validClass) {
                $(element).closest('.form-group').addClass(errorClass).removeClass(validClass);

            },
            unhighlight: function (element, errorClass, validClass) {

                $(element).closest('.form-group').removeClass(errorClass).addClass(validClass);
            },
            errorPlacement: function (error, element) {

                if (element.is(":radio") || element.is(":checkbox")) {
                    element.closest('.option-group').after(error);
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                var loading_txt = $('#submit_main_form').data("loading");
                $('#submit_main_form').attr('disabled', true);
                $('#submit_main_form').html(loading_txt);
                form.submit();


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
            function (value, element) {
                if (value == '') {
                    return true;
                } else {
                    return /[!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]/.test(value);
                }
            });
    });

    
</script>
@endsection