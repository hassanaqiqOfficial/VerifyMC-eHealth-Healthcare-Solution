@extends('layout.master')
@section('title', 'Add Clinic')
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
						<h4> <span class="font-weight-semibold">Add Clinic</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>
                    <div class="header-elements d-none">
						<div class="d-flex justify-content-center">
							<button class="btn btn-outline-primary btn-sm" form="myform"><span>Submit</span></button>
						</div>
					</div>

				</div>
            </div>
			<!-- /page header -->


<!-- Content area -->
<div class="content">

    <!-- Default grid -->
        <div class="card">
            <div class="card-body">
               <form action="" method="post" class="admin-form-validate" id="myform">
                     <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Clinic Name <span class="text-danger dark"> * </span></label>
                                <input type="text" class="form-control " required="" name="name" id="name" value="">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Email<span class="text-danger dark"> * </span> </label>
                                <input type="text" class="form-control" name="email" required value="" id="email">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Phone <span class="text-danger dark"> * </span></label>
                                <input type="text" class="form-control phoneformate" name="phone" required value=""
                                       id="phone">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Website </label>
                                <input type="text" class="form-control" name="website" value="" id="website">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Country </label>
                                <select class="form-control" name="country" id="country">
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

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>State </label>
                                <input type="text" class="form-control" name="state" value="" id="state">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>City </label>
                                <input type="text" class="form-control" name="city" value="" id="city">
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" value="" id="address">
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Timezone </label>
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
                    </div>


                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Postal Code</label>
                                <input type="text" class="form-control" name="zip" value="" id="zip">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>EIN</label>
                                <input type="text" class="form-control" name="controlled_license" value=""
                                       id="controlled_license">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Business Lic</label>
                                <input type="text" class="form-control" name="reg_no" value="" id="reg_no">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Password <span class="text-danger dark"> * </span></label>
                                <input type="password" class="form-control" name="password" required value="" id="password"
                                       autocomplete="OFF">
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Confirm Password <span class="text-danger dark"> * </span></label>
                                <input type="password" class="form-control" name="confirm_password" required value=""
                                       id="confirm_password" autocomplete="OFF">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Approval Status </label>
                                <select class="form-control" name="status" id="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Profile </label>
                                <textarea class="ckeditor" name="profile_info" id="profile_info"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <label>Upload Image</label>
                            <div id="fileuploader">Upload</div>
                            <div id="data"></div>
                        </div>
                    </div>
                    
                    <hr>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?=base_url("admin/clinics/"); ?>" class="btn btn-primary">Back</a>
                </div>
               </form>
             </div>
           </div>
         </div>
        <!-- /content area -->
       </div>


@endsection

@section('scripts')

<link rel="stylesheet" href="<?= base_url('vendor/plugins/uploadfile/uploadfile.css') ?>"/>
<script src="<?= base_url('vendor/plugins/uploadfile/jquery.uploadfile.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquerymask/jquery.maskedinput.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/form-validate/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/form-validate/additional-methods.min.js') ?>"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<script type="text/javascript">
    
    jQuery(document).ready(function () {
        $('.phoneformate').mask('999-999-9999');
    });
    
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
                        url: "<?= base_url("api/validateEmail")?>",
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

    $(document).ready(function(){
        $("#fileuploader").uploadFile({
            url:"<?=base_url("general/upload_files")?>",
            fileName:"uploadFile",
            showDelete:true,
            showDone:true,
            doneStr:'Successful',
            dragDrop:true,

            onSuccess:function(files,data,xhr,pd)
            {
                data = jQuery.parseJSON( data )
                $("#data").append('<div><input type="hidden" name="patient_files" value="'+data[0]+'" /><input type="hidden" name="patient_files_names" value="'+data[1]+'" /></div>')/**/
            },

            deleteCallback: function(data,pd)
            {
                data = jQuery.parseJSON( data )
                $('input[value="'+data[0]+'"]').parent().remove();


            }




        });
    });


</script>

@endsection