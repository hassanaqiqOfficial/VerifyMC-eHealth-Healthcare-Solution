@extends('layout.master_doctor')
@section('title', 'Add widget')
@section('content')

<style>
    #sortable1,
    #sortable2 {
        list-style-type: none;
        margin: 0;
        float: left;
        margin-right: 10px;
        padding: 5px;
        width: 100%;
        border: 1px solid #e2e2e2;
    }

    #sortable1 li,
    #sortable2 li {
        margin: 5px;
        margin-left: 0px !important;
        padding: 5px;
        font-size: 1.2em;
        width: 100%;
        background: #e2e2e2;
        border: 1px solid #c3c3a2;
        border-radius: 2px;
    }
</style>


<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">Add widget</span></h4>
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

                    <!-- Tab starts here -->
                    <div class="d-lg-flex">

                        <ul class="nav nav-tabs nav-tabs-vertical flex-column mr-lg-3 wmin-lg-200 mb-lg-0 border-bottom-0">
                            <li class="nav-item"><a href="#widget_tab" class="nav-link active" data-toggle="tab"></i>Widget Details</a></li>
                            <li class="nav-item"><a href="#widget_embedUrl_tab" class="nav-link" data-toggle="tab"></i> Widget embed code</a></li>
                            <li class="nav-item"><a href="#patient_details_tab" class="nav-link" data-toggle="tab"></i> General Settings</a></li>
                            <li class="nav-item"><a href="#upload_options_tab" class="nav-link" data-toggle="tab"></i> Upload Options</a></li>
                            <li class="nav-item"><a href="#custom_question_tab" class="nav-link" data-toggle="tab"></i> Custom Questions</a></li>
                        </ul>

                        <div class="tab-content flex-lg-fill">

                            <div class="tab-pane fade active show" id="widget_tab">

                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="text-uppercase">Widget Details</div>
                                        <hr class="solid">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                        <label>Widget Title<span class="text-danger dark"> * </span></label>
                                        <div class="mb-2">
                                            <input type="text" name="title" class="form-control" required placeholder="Widget Title ..." id="title">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 ">
                                        <label>Selected Steps</label>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">

                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 ">
                                        <label>Default Steps</label>
                                    </div> 
                                </div>

                                <div class="form-group row">
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                        <ul id="sortable2" class="sortable2">
                                            <li class="ui-state-default s2" id="Details_step"><i class="fa fa-arrows mr-2" aria-hidden="true"></i>Details</li>
                                        </ul>
                                        <input type="hidden" name="steps_str" class="steps_str" value="Details[]=step" id="stepsStr">
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                        <i class="icon-move m-5 mt-5 icon-2x" aria-hidden="true"></i>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 ">
                                        <ul id="sortable1" class="sortable1">
                                            <li class="ui-state-default" id="Appointment_step"><i class="fa fa-arrows mr-2" aria-hidden="true"></i></i>Appointment</li>
                                            <li class="ui-state-default" id="Payment_step"><i class="fa fa-arrows mr-2" aria-hidden="true"></i>Payment</li>
                                            <li class="ui-state-default" id="Video_step"><i class="fa fa-arrows mr-2" aria-hidden="true"></i>Video</li>
                                        </ul>
                                    </div>
                                    
                                </div>

                            </div>

                            <div class="tab-pane fade" id="widget_embedUrl_tab">

                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="text-uppercase">Widget URL & Embed Code</div>
                                        <hr class="solid">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Widget Url</label>
                                            <textarea name="widget_url" id="widget_url" class="form-control" readonly rows="5" placeholder="Widget Url...."><?= base_url('widgets/index/'.md5($next_widget_id)); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <!-- <a href="" target="blank" class="btn btn-light view btn-sm">View</a> -->
                                            <a href="javascript:void(0)" data-clipboard-target="#widget_url" data-clipboard-action="copy" class="btn btn-light copy btn-sm">Copy</a>
                                        </div>
                                        <div class="form-group">
                                            <label>Widget Embed Code</label>
                                            <textarea name="widget_embed_code" id="widget_embed_code" class="form-control" readonly rows="5" placeholder="Widget Embed Code...."><?= base_url('widgets/index/'.md5($next_widget_id)); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <a href="javascript:void(0)" data-clipboard-target="#widget_embed_code" data-clipboard-action="copy" class="btn btn-light copy btn-sm">Copy</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="patient_details_tab">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="text-uppercase">Patient Details</div>
                                        <hr class="solid">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-lg-6">

                                        <div class="form-group mt-3 mb-2">
                                            <label class="font-weight-bolder">Patient Type <small class="text-mute">(New or Existing)</small><label>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_type_show" name="patient_type" value="0" id="patient_type_show">
                                                <label class="custom-control-label" for="patient_type_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_type_hide" name="patient_type" value="1" checked="checked" id="patient_type_hide">
                                                <label class="custom-control-label" for="patient_type_hide">Hide</label>
                                            </div>
                                        </div>     

                                        <div class="form-group mb-md-2">
                                            <label class="font-weight-bolder">Patient Address<label>
                                        </div>
                                        <div class="form-group mb-3 mb-md-2">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_address_show" name="patient_address" value="0" id="custom_radio_inline_show">
                                                <label class="custom-control-label" for="custom_radio_inline_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_address_hide" name="patient_address" value="1" checked="checked" id="custom_radio_inline_hide">
                                                <label class="custom-control-label" for="custom_radio_inline_hide">Hide</label>
                                            </div>
                                        </div>

                                        <div class="form-group mt-3 mb-2">
                                            <label class="font-weight-bolder">Social Security Number<label>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input social_security_show" name="social_security" value="0" id="social_security_show">
                                                <label class="custom-control-label" for="social_security_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input social_security_hide" name="social_security" value="1" checked="checked" id="social_security_hide">
                                                <label class="custom-control-label" for="social_security_hide">Hide</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input social_security_all" name="social_security_numbers" value="0" id="social_security_all">
                                                <label class="custom-control-label" for="social_security_all">All Numbers</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input social_security_last_4" name="social_security_numbers" value="1" checked="checked" id="social_security_last_4">
                                                <label class="custom-control-label" for="social_security_last_4">Last 4 Numbers</label>
                                            </div>
                                        </div>

                                        <div class="form-group mt-3 mb-2">
                                            <label class="font-weight-bolder">Date of Birth<label>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input dob_show" name="date_of_birth" value="0" id="dob_show">
                                                <label class="custom-control-label" for="dob_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input dob_hide" name="date_of_birth" value="1" checked="checked" id="dob_hide">
                                                <label class="custom-control-label" for="dob_hide">Hide</label>
                                            </div>
                                        </div>

                                        <div class="form-group mt-3 mb-2">
                                            <label class="font-weight-bolder">Contact By Email & SMS<label>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input notify_by_show" name="notify_by" value="0" id="notify_by_show">
                                                <label class="custom-control-label" for="notify_by_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input notify_by_hide" name="notify_by" value="1" checked="checked" id="notify_by_hide">
                                                <label class="custom-control-label" for="notify_by_hide">Hide</label>
                                            </div>
                                        </div>

                                        <div class="form-group mt-3 mb-2">
                                            <label class="font-weight-bolder">Height<label>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_height_show" name="height" value="0" id="patient_height_show">
                                                <label class="custom-control-label" for="patient_height_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_height_hide" name="height" value="1" checked="checked" id="patient_height_hide">
                                                <label class="custom-control-label" for="patient_height_hide">Hide</label>
                                            </div>
                                        </div>

                                        <div class="form-group mt-3 mb-2">
                                            <label class="font-weight-bolder">Weight<label>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_weight_show" name="weight" value="0" id="patient_weight_show">
                                                <label class="custom-control-label" for="patient_weight_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_weight_hide" name="weight" value="1" checked="checked" id="patient_weight_hide">
                                                <label class="custom-control-label" for="patient_weight_hide">Hide</label>
                                            </div>
                                        </div>

                                        <div class="form-group mt-3 mb-2">
                                            <label class="font-weight-bolder">Drivers Lic. / ID #<label>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input driving_license_show" name="driving_license" value="0" id="driving_license_show">
                                                <label class="custom-control-label" for="driving_license_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input driving_license_hide" name="driving_license" value="1" checked="checked" id="driving_license_hide">
                                                <label class="custom-control-label" for="driving_license_hide">Hide</label>
                                            </div>
                                        </div>

                                        <div class="form-group mt-3 mb-2">
                                            <label class="font-weight-bolder">Payment Page Additional Text<label>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input payment_addi_test_show" name="payment_additionalText" value="0" id="payment_addi_test_show">
                                                <label class="custom-control-label" for="payment_addi_test_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input payment_addi_test_hide" name="payment_additionalText" value="1" checked="checked" id="payment_addi_test_hide">
                                                <label class="custom-control-label" for="payment_addi_test_hide">Hide</label>
                                            </div>
                                        </div>

                                        <div class="additional_pageText hidden">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="page_title" class="form-control" placeholder="Page Title...">
                                            </div>

                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="page_description" rows="6" class="form-control" placeholder="Start typing description here..."></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>

                            <div class="tab-pane fade" id="upload_options_tab">

                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="text-uppercase">Upload Options</div>
                                        <hr class="solid">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-lg-12">

                                        <div class="form-group">
                                            <label class="font-weight-bolder">Show or Hide Upload Options Below</label></br>
                                            <span class="text-danger">Important : </span>If you add upload options, we recommend using the widget's URL option for optimal performance across all devices
                                        </div>

                                        <div class="form-group mb-md-2">
                                            <label class="font-weight-bolder">Upload Medical Records<label>
                                        </div>
                                        <div class="form-group mb-3 mb-md-2">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input medicalRecord_show" name="upload_medical_record" value="0" id="medicalRecord_show">
                                                <label class="custom-control-label" for="medicalRecord_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input medicalRecord_hide" name="upload_medical_record" value="1" checked="checked" id="medicalRecord_hide">
                                                <label class="custom-control-label" for="medicalRecord_hide">Hide</label>
                                            </div>
                                        </div>

                                        <div class="form-group mb-md-2">
                                            <label class="">Required Field<label>
                                        </div>
                                        <div class="form-group mb-3 mb-md-2">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input field_required_show" name="field_required" value="0" id="field_required_show">
                                                <label class="custom-control-label" for="field_required_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input field_required_hide" name="field_required" value="1" checked="checked" id="field_required_hide">
                                                <label class="custom-control-label" for="field_required_hide">Hide</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="">Add Text to this section <small class="text-mute">(Optional)</small></label></br>
                                            <textarea name="add_text_medical_record" rows="5" class="form-control"></textarea>
                                        </div>

                                        <div class="form-group mb-md-2">
                                            <label class="font-weight-bolder">Upload Driving License / ID<label>
                                        </div>

                                        <div class="form-group mb-3 mb-md-2">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input driving_license_show_2" name="patient_id_card" value="0" id="driving_license_show_2">
                                                <label class="custom-control-label" for="driving_license_show_2">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input driving_license_hide_2" name="patient_id_card" value="1" checked="checked" id="driving_license_hide_2">
                                                <label class="custom-control-label" for="driving_license_hide_2">Hide</label>
                                            </div>
                                        </div>

                                        <div class="form-group mb-md-2">
                                            <label class="">Required Field<label>
                                        </div>
                                        <div class="form-group mb-3 mb-md-2">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input required_field_id_show" name="required_field_id" value="0" id="required_field_id_show">
                                                <label class="custom-control-label" for="required_field_id_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input required_field_id_hide" name="required_field_id" value="1" checked="checked" id="required_field_id_hide">
                                                <label class="custom-control-label" for="required_field_id_hide">Hide</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="">Add Text to this section <small class="text-mute">(Optional)</small></label></br>
                                            <textarea name="add_text_id_card" rows="5" class="form-control"></textarea>
                                        </div>

                                        <div class="form-group mb-md-2">
                                            <label class="font-weight-bolder">Upload Patient Photo<label>
                                        </div>
                                        <div class="form-group mb-3 mb-md-2">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_photo_show" name="patient_photo" value="0" id="patient_photo_show">
                                                <label class="custom-control-label" for="patient_photo_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_photo_hide" name="patient_photo" value="1" checked="checked" id="patient_photo_hide">
                                                <label class="custom-control-label" for="patient_photo_hide">Hide</label>
                                            </div>
                                        </div>

                                        <div class="form-group mb-md-2">
                                            <label class="">Required Field<label>
                                        </div>
                                        <div class="form-group mb-3 mb-md-2">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_photo_required_show" name="patient_photo_required" value="0" id="patient_photo_required_show">
                                                <label class="custom-control-label" for="patient_photo_required_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_photo_required_hide" name="patient_photo_required" value="1" checked="checked" id="patient_photo_required_hide">
                                                <label class="custom-control-label" for="patient_photo_required_hide">Hide</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="">Add Text to this section <small class="text-mute">(Optional)</small></label></br>
                                            <textarea name="add_text_patient_photo" rows="5" class="form-control"></textarea>
                                        </div>

                                        <div class="form-group mb-md-2">
                                            <label class="font-weight-bolder">Upload Proof Residency<label>
                                        </div>
                                        <div class="form-group mb-3 mb-md-2">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_proof_residency_show" name="patient_proof_residency" value="0" id="patient_proof_residency_show">
                                                <label class="custom-control-label" for="patient_proof_residency_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_proof_residency_hide" name="patient_proof_residency" value="1" checked="checked" id="patient_proof_residency_hide">
                                                <label class="custom-control-label" for="patient_proof_residency_hide">Hide</label>
                                            </div>
                                        </div>

                                        <div class="form-group mb-md-2">
                                            <label class="">Required Field<label>
                                        </div>
                                        <div class="form-group mb-3 mb-md-2">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_proof_required_show" name="patient_proof_required" value="0" id="patient_proof_required_show">
                                                <label class="custom-control-label" for="patient_proof_required_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input patient_proof_required_hide" name="patient_proof_required" value="1" checked="checked" id="patient_proof_required_hide">
                                                <label class="custom-control-label" for="patient_proof_required_hide">Hide</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="">Add Text to this section <small class="text-mute">(Optional)</small></label></br>
                                            <textarea name="add_text_proof_residency" rows="5" class="form-control"></textarea>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="custom_question_tab">

                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="text-uppercase">Custom Questions</div>
                                        <hr class="solid">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-lg-12">

                                        <div class="form-group mb-md-2">
                                            <label class="font-weight-bolder">Select Option<label>
                                        </div>
                                        <div class="form-group mb-3 mb-md-2">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input option_show" name="custom_question_option" value="0" id="option_show">
                                                <label class="custom-control-label" for="option_show">Show</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input option_hide" name="custom_question_option" value="1" checked="checked" id="option_hide">
                                                <label class="custom-control-label" for="option_hide">Hide</label>
                                            </div>
                                        </div>

                                        <div class="form-group mb-2 mt-3">
                                            <label class="font-weight-bolder">Add Unlimited Custom Questions to Your Form<label>
                                        </div>

                                        <div class="form-group mb-2 mt-3">
                                            <b>Question Types</b><br>
                                            <b>Text:</b> Single row input field for entering text<br>
                                            <b>Text Area:</b> Multiple row input field for entering text<br>
                                            <b>Radio Buttons:</b> Fields that allow only one option to be selected<br>
                                            <b>Check Boxes:</b> Fields that allow one or more options to be selected<br>
                                            <b>Drop Down Menu:</b> Drop down menu that will allow only one option to be selected
                                        </div>

                                        <div class="form-group">
                                            <hr class="solid">
                                        </div>

                                        <div class="form-group mb-2 mt-3">
                                            <label class="font-weight-bolder">Custom Form Title <small class="text-mute">(Optional)</small></label></br>
                                            Add a custom title to this section below or leave blank to use “Additional Information”
                                        </div>

                                        <div class="form-group row mt-2">
                                            <div class="col-md-6 col-lg-6">
                                                <input type="text" name="custom_form_title" class="form-control" plcaeholder="Additional Information" value="Additional Information">
                                            </div>
                                        </div>

                                        <div class="form-group mb-4 mt-3">
                                            <label class="font-weight-bolder">Custom Form Questions</label><br>
                                            <div class="bg-light border mt-2 pb-3 pl-2 pr-2 pt-3">
                                                <b>Drag and Drop Order: </b>Customize the order of your questions by dragging and dropping from the icon on the left side of the container.
                                            </div>
                                        </div>

                                        <div id="add_row_custom"></div>

                                        <div class="form-group mt-3">
                                            <button type="button" class="btn btn-light" onclick="add_entry_custom()">+Add Question</button>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <hr class="solid">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= base_url("doctor/widgets"); ?>" class="btn btn-primary">Back</a>

                        </div>
                    </div>
                    <!-- /Tab ends here -->

                </div>
            </form>
        </div>
    </section>
</div>

@endsection

@section('scripts')

<script type="text/javascript" src="<?= base_url('assets/global_assets/js/plugins/forms/validation/validate.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/clipboard.js/dist/clipboard.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/notifyjs/dist/notify.js'); ?>"></script>

<script type="text/javascript">
    $(function() {

        $("body").addClass("sidebar-xs");

        $("input[name='payment_additionalText']").on("change", function() {

            if ($(this).val() == 1) {
                $(".additional_pageText").addClass("hidden");
            } else {
                $(".additional_pageText").removeClass("hidden");
            }
        });

        $("ul.sortable1").sortable({
            connectWith: "ul",
            cancel: ".s2",
        });

        $("ul.sortable2").sortable({
            connectWith: "ul",
            cancel: ".s2",
            update: function(event, ui) {
                var data = $(this).sortable('serialize');
                $('#stepsStr').val(data);
            }
        });

       
        $( "#add_row_custom" ).sortable({
            update: function( event, ui ) {
                var ordering = $(this).sortable('toArray').toString();
                var a =0;
                $('.order_input').each(function(){
                    $(this).val(a);
                    a++;
                });
            }
        });
        $( "#add_row_custom" ).disableSelection();
        

        // Initialize
        var validator = $('.admin-form-validate').validate({

            ignore: '', // ignore hidden fields
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
                    error.appendTo(element.parents('.form-check').parent());
                }

                // Input with icons and Select2
                else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }

                // Input group, styled file input
                else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
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

        var clipboard = new ClipboardJS('a.copy ');

        clipboard.on('success', function(e) {
            //console.info('Text:', e.text);
            $.notify("Successfully text has been copied.","success");
            e.clearSelection();
        });

        clipboard.on('error', function(e) {
            //console.error('Trigger:', e.trigger);
            $.notify("Error while copying text.","error");
            
        });


        $(document).on("click", ".remove_questions" , function(){
            $(this).parent().parent().parent().remove();
        });



    });


    var val3 = 5;
    var blank_entry_custom = '';
    $(document).ready(function() {
        blank_entry_custom = $('#add_row_custom').html();
    });

    function add_entry_custom() {

        var blank_entry_custom = "";
        blank_entry_custom          +=       "<div class='border mt-4'>";
        blank_entry_custom          +=       "<div class=\"form-group row mt-3 mb-3\">";

        blank_entry_custom          +=       "<div class=\"col-sm-1 col-md-1 mt-2 text-center\">";
        blank_entry_custom          +=       "<i class=\"fa fa-arrows fa-trash-o\"><\/i>";
        blank_entry_custom          +=       "<\/div>";
        blank_entry_custom          +=       "<div class=\"col-sm-6 col-md-6\">";
        blank_entry_custom          +=       "<input type=\"text\" class=\"form-control\" name=\"additional_information[" + val3 + "][title]\" value=\"\" placeholder=\"Enter Question Here\">";
        blank_entry_custom          +=       "<\/div>";
        blank_entry_custom          +=       "   ";
        blank_entry_custom          +=       "<div class=\"col-sm-2 col-md-2\">";
        blank_entry_custom          +=       "<select name=\"additional_information[" + val3 + "][recommendation_type]\" class=\"form-control\" required onclick=\"show_textarea_1(value , " + val3 + ")\"><option value=\"\">Select Type</option><option value=\"0\">Text</option><option value=\"1\">Radio Buttons</option><option value=\"2\">Check Boxes</option><option value=\"3\">Drop Down Menu</option><option value=\"4\">Text Area</option><\/select>";
        blank_entry_custom          +=       "<\/div>";
        blank_entry_custom          +=       "<div class=\"col-sm-2 col-md-2\">";
        blank_entry_custom          +=       "<select name=\"additional_information[" + val3 + "][required]\" class=\"form-control\" required><option value=\"0\">Required</option><option value=\"1\">Not Required</option><\/select>";
        blank_entry_custom          +=       "<\/div>";
        blank_entry_custom          +=       "<div class=\"col-sm-1 col-md-1\">";
        blank_entry_custom          +=       "	<button type=\"button\" class=\"btn btn-danger remove_questions\">";
        blank_entry_custom          +=       "		<i class=\"fa fa-trash-o\"><\/i>";
        blank_entry_custom          +=       "	<\/button>";
        blank_entry_custom          +=       "<\/div>";
        blank_entry_custom          +=       "";
        blank_entry_custom          +=       "<input type=\"hidden\" class=\"order_input\" name=\"additional_information[" + val3 + "][order_input]\" value=\"" + val3 + "\">";
        blank_entry_custom          +=       "<\/div>";
        blank_entry_custom          +=       "<div class=\"form-group hidden\" style=\"padding-left: 22px; padding-right: 22px;\" id=\"quest_option_" + val3 + "\">";
        blank_entry_custom          +=       "<div class=\"col-sm-12 col-md-12\">";
        blank_entry_custom          +=       "		<textarea  name=\"additional_information[" + val3 + "][options]\" rows=\"5\" style=\"width: 100%;  font-size: 13px; padding: 15px;\" placeholder=\"Add your answers here on their own line (Hit enter on your keyboard after each entry)\"><\/textarea>";
        blank_entry_custom          +=       "<\/div>";
        blank_entry_custom          +=       "<\/div>";
        blank_entry_custom          +=       "<\/div>";

        var length = $("#add_row_custom .form-group").length;
        $("#add_row_custom").append(blank_entry_custom);
        val3++;

    }

    function show_textarea_1(val, id) 
    {
        if (val == 1 || val == 2 || val == 3) 
        {
            $("#quest_option_" + id + "").removeClass("hidden");
        } 
        else 
        {
            $("#quest_option_" + id + "").addClass("hidden");
        }
    }
</script>
@endsection