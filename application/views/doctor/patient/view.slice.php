@extends('layout.master_doctor')
@section('title', 'View Patient')
@section('bodyClass', 'sidebar-right-visible sidebar-xs')
@section('content')

<style>

    .dropzone .dz-preview {
        width: 100%;
        font-size: 10px;
        margin: 0

    }

    .dropzone .dz-preview .dz-image {
        width: 40px;
        float: left;
    }

    .dropzone .dz-preview .dz-details {
        float: left;
        margin-left: 10px;
        width: calc(100% - 50px);
    }

    .dropzone .dz-preview .dz-details .dz-size,
    .dropzone .dz-preview .dz-details .dz-filename {
        margin-top: 0;
    }

    .dropzone .dz-preview.dz-error .dz-error-message {
        display: block !important;
        opacity: 1 !important;
        position: relative;
        top: auto;
        background: transparent;
        float: left;
        width: 100%;
        margin: 0;
    }

    #patient_files_datatable td,
    #patient_files_datatable th,
    #patient_appointment_datatable td,
    #patient_appointment_datatable th,
    #patient_invoices td,
    #patient_invoices th,
    #patient_notes_datatable td,
    #patient_notes_datatable th,
    #scheduled_custom_email td,
    #scheduled_custom_email th {
        padding: .45rem .45rem;
    }

</style>


<div class="content-wrapper">
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4><span class="font-weight-semibold">View Patient</span></h4>
                <a href="#" class="header-elements-toggle sidebar-mobile-right-toggle text-default d-md-none"><i
                            class="icon-more"></i></a>
            </div>


        </div>
    </div>
    <!-- /page header -->


    <!-- content -->
    <section class="content">
        <!-- Default Grid -->
        <div class="card" id="card1">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Patient Overview</h5>
            </div>

            <div class="card-body" id="patient_detail">
            </div>
            <!-- Default Grid -->
        </div>

        <!-- Default Grid -->
        <div class="card" id="card2">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Driving License OR ID</h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-6">

                        <div class="card br-a" style="margin:23px auto;">
                            <div class="br-n card-body">
                                <label>Drivers Lic OR State ID - Front</label>
                                <div class="card br-a" id="upload_panel1234">

                                    <div class="card-body">


                                        <div class="col-xs-12 <?php if ($patient['idcard_url_front'] == "") {
                                            echo 'hidden';
                                        } ?> " id="image_cont_stateid">
                                            <img src="<?php if ($patient['idcard_url_front'] != "") {
                                                echo base_url($patient['idcard_url_front']);
                                            } ?>" style="max-width: 100%;">
                                            <a id="delete_image_cont_stateid" class="fs12 delete_image "><i
                                                        class="fa fa-close"></i></a>
                                            <input type="hidden" name="idcard_url_front" id="image">
                                            <input type="hidden" name="idcard_url_front_old" id="idcard_url_front_old"
                                                   value="<?= $patient['idcard_url_front'] ?>">
                                        </div>
                                        <div class="col-xs-12 <?php if ($patient['idcard_url_front'] != "") {
                                            echo 'hidden';
                                        } ?>" id="control_cont_stateid">
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

                    <div class="col-md-6 col-lg-6">

                        <div class="card br-a" style="margin: 23px auto;">
                            <div class="br-n card-body">
                                <label>Drivers Lic Or State ID - Back</label>
                                <div class="card br-a" id="upload_panel1234">

                                    <div class="card-body">


                                        <div class="col-xs-12 <?php if ($patient['idcard_url_back'] == "") {
                                            echo 'hidden';
                                        } ?>" id="image_cont_stateid_back">
                                            <img src="<?php if ($patient['idcard_url_back'] != "") {
                                                echo base_url($patient['idcard_url_back']);
                                            } ?>" style="max-width: 100%;">
                                            <a id="delete_image_cont_back" class="fs12 delete_image "><i
                                                        class="fa fa-close"></i></a>
                                            <input type="hidden" name="idcard_url_back" id="image_back">
                                            <input type="hidden" name="idcard_url_back_old" id="idcard_url_back_old"
                                                   value="<?= $patient['idcard_url_back']; ?>">

                                        </div>

                                        <div class="col-xs-12 <?php if ($patient['idcard_url_back'] != "") {
                                            echo 'hidden';
                                        } ?>" id="control_cont_stateid_back">
                                            <button type="button" id="upload_button_1"
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

            </div>
            <!-- Default Grid -->
        </div>

        <!-- Default Grid -->
        <div class="card" id="card3">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Patient Files</h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <table class="table" id="patient_files_datatable">
                            <thead>
                            <tr class="text-semibold">
                                <td width="40%">Date</td>
                                <td width="">File Name</td>
                                <td width="3%">Actions</td>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 col-lg-6">


                        <form action="#" class="dropzone" id="dropzone_remove"></form>

                    </div>
                </div>

            </div>
            <!-- Default Grid -->
        </div>

        <!-- Default Grid -->
        <div class="card" id="card4">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Invoices</h5>
                <div class="header-elements">
                    <a href="<?= base_url('doctor/invoices/add_invoice/' . $patient_id); ?>"
                       class="btn btn-outline-primary btn-sm ">+ Add</a>
                </div>
            </div>

            <div class="card-body">

                <table class="table" id="patient_invoices" width="100%">
                    <thead>
                    <tr>
                        <th width="10%">Invoice</th>
                        <th width="20%">Name</th>
                        <th width="15%">Created Date</th>
                        <th width="15%">Due Date</th>
                        <th width="10%">Amount</th>
                        <th width="15">Status</th>
                        <th width="15%">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
            <!-- Default Grid -->
        </div>

        <!-- Default Grid -->
        <div class="card" id="card5">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Appointments</h5>
                <div class="header-elements">
                    <a href="<?= base_url('doctor/appointment/add_appointment/' . $patient_id); ?>"
                       class="btn btn-outline-primary btn-sm ">+ Add</a>
                </div>
            </div>

            <div class="card-body">
                <table class="table" id="patient_appointment_datatable" width="100%">

                    <thead>
                    <tr>
                        <th width="10%">Date</th>
                        <th width="10%">Time</th>

                        <th width="10%">Status</th>
                        <th width="">Category</th>
                        <th width="5%">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- Default Grid -->
        </div>

        <!-- Default Grid -->
        <div class="card" id="card6">
            <div class="card-header header-elements-inline pt-2">
                <h5 class="card-title">Contacts</h5>
                <div class="header-elements">
                    <ul class="nav nav-tabs nav-tabs-highlight justify-content-end">
                        <li class="nav-item"><a href="#sms-tab" class="nav-link sms-tab" data-toggle="tab">SMS</a></li>
                        <li class="nav-item"><a href="#email-tab" class="nav-link active" data-toggle="tab">Email</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body">

                <div class="tab-content">

                    <div class="tab-pane fade active show" id="email-tab">

                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Software Email</label>
                                    <select name="fk_default_emailID" id="default_email" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Custom Email</label>
                                    <select name="fk_custom_emailID" id="custom_email" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="email_div hidden">
                            <form method="POST" action="" enctype="multipart/form-data" id="sendEmailForm">
                                <div class="row">

                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <input type="text" name="subject" id="subject" class="form-control" value=""
                                                   placeholder="subject">
                                            <input type="hidden" name="patient_id" value="<?= $patient_id; ?>">
                                            <input type="hidden" name="type" value="1">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Body</label>
                                            <textarea name="body" id="Emailbody"
                                                      class="form-control ckeditor"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Add Attachment</label>
                                            <input type="file" name="patient_file" id="patientFile"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-sm" id="formSubmit">Submit</button>


                            </form>
                        </div>


                    </div>

                    <div class="tab-pane fade" id="sms-tab">

                        <div class="row">

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Software SMS</label>
                                    <select name="fk_default_smsID" id="default_sms" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Custom SMS</label>
                                    <select name="fk_custom_smsID" id="custom_sms" class="form-control">
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="sms_div hidden">
                            <form method="POST" action="" enctype="multipart/form-data" id="sendSMSForm">
                                <div class="row">

                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Body</label>
                                            <textarea name="body" id="SMSbody" rows="6" class="form-control"></textarea>
                                            <input type="hidden" name="patient_id" value="<?= $patient_id; ?>">
                                            <input type="hidden" name="type" value="0">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <hr class="solid">
                                            <button type="submit" class="btn btn-primary btn-sm" id="submitForm">
                                                Submit
                                            </button>
                                        </div>
                                    </div>


                                </div>

                            </form>
                        </div>

                    </div>

                </div>

            </div>
            <!-- Default Grid -->
        </div>

        <div class="card" id="card7">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Email Scheduler</h5>
                <div class="header-elements">
                    <div class="btn-group justify-content-center">
                        <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm dropdown-toggle"
                           data-toggle="dropdown" aria-expanded="false">Options</a>
                        <div class="dropdown-menu dropup" x-placement="top-start"
                             style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -183px, 0px);">
                            <a href="javascript:void(0)" class="dropdown-item custom_schedule_email ">Schedule A Custom
                                Email</a>
                            <a href="<?= base_url('doctor/notifications/custom_email'); ?>" class="dropdown-item">Manage
                                Custom Email</a>
                        </div>

                    </div>

                </div>
            </div>

            <div class="card-body">
                <table class="table" id="scheduled_custom_email" width="100%">
                    <thead>
                    <tr>
                        <th width="40%">Custom Email Title</th>
                        <th width="25%">Date Delivery</th>
                        <th width="20%">Time Delivery</th>
                        <th width="15%">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- Default Grid -->
        </div>
        <div class="card" id="card8">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">SMS Scheduler</h5>
                <div class="header-elements">
                    <div class="btn-group justify-content-center">
                        <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm dropdown-toggle"
                           data-toggle="dropdown" aria-expanded="false">Options</a>
                        <div class="dropdown-menu dropup" x-placement="top-start"
                             style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -183px, 0px);">
                            <a href="javascript:void(0)" class="dropdown-item custom_schedule_sms ">Schedule A Custom
                                SMS</a>
                            <a href="<?= base_url('doctor/notifications/custom_sms'); ?>" class="dropdown-item">Manage
                                Custom SMS</a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table" id="scheduled_custom_sms" width="100%">
                    <thead>
                    <tr>
                        <th width="40%">Custom SMS Title</th>
                        <th width="25%">Date Delivery</th>
                        <th width="20%">Time Delivery</th>
                        <th width="15%">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
            <!-- Default Grid -->
        </div>

        <div class="card card-comment" id="card9">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Notes</h5>
                <div class="header-elements">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                            data-target="#notesModal">+ Add Note
                    </button>
                </div>
            </div>


            <div class="card-body">
                <table class="table" id="patient_notes_datatable" width="100%">
                    <thead>
                    <tr>
                        <th width="20%">Date Added</th>
                        <th width="60%">Note</th>
                        <th width="15%">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <!-- Default Grid -->
        </div>
    </section>

    <!-- /content wraper closed -->
</div>

<!-- Models -->
<div class="ip-modal" id="avatarModal_stateid" style="display:none;">
    <div class="ip-modal-dialog">
        <div class="ip-modal-content border-top-0">
            <div class="ip-modal-header">
                <a class="ip-close" title="Close">&times;</a>
                <h4 class="ip-modal-title">Drivers Lic OR State ID - Front</h4>
            </div>
            <div class="ip-modal-body">
                <div class="btn btn-primary ip-upload">Upload <input type="file" name="file" class="ip-file"></div>

                <button type="button" class="btn btn-info ip-edit">Edit</button>
                <button type="button" class="btn btn-danger ip-delete">Delete</button>
                <div class="alert ip-alert"></div>

                <div class="ip-preview"></div>
                <div class="ip-rotate">
                    <button type="button" class="btn btn-default ip-rotate-ccw" title="Rotate counter-clockwise"><i
                                class="icon-ccw"></i></button>
                    <button type="button" class="btn btn-default ip-rotate-cw" title="Rotate clockwise"><i
                                class="icon-cw"></i></button>
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
                    <span class="fs15"
                          style="background-color:red; color:white; padding-left:102px; padding-right:102px; padding-bottom:2px; padding-bottom:2px"><b>IMPORTANT - PLEASE CROP IMAGE</b></span><br/><br/>
                    <span class="fs13"><b>Click and drag a region on the image, then click "Save Image"</b></span>
                    <hr/>
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
                <h4 class="ip-modal-title">Drivers Lic OR State ID - Back</h4>
            </div>
            <div class="ip-modal-body">
                <div class="btn btn-primary ip-upload">Upload <input type="file" name="file" class="ip-file"></div>

                <button type="button" class="btn btn-info ip-edit">Edit</button>
                <button type="button" class="btn btn-danger ip-delete">Delete</button>
                <div class="alert ip-alert"></div>

                <div class="ip-preview"></div>
                <div class="ip-rotate">
                    <button type="button" class="btn btn-default ip-rotate-ccw" title="Rotate counter-clockwise"><i
                                class="icon-ccw"></i></button>
                    <button type="button" class="btn btn-default ip-rotate-cw" title="Rotate clockwise"><i
                                class="icon-cw"></i></button>
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
                    <span class="fs15"
                          style="background-color:red; color:white; padding-left:102px; padding-right:102px; padding-bottom:2px; padding-bottom:2px"><b>IMPORTANT - PLEASE CROP IMAGE</b></span><br/><br/>
                    <span class="fs13"><b>Click and drag a region on the image, then click "Save Image"</b></span>
                    <hr/>
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

<div class="sidebar sidebar-light sidebar-right sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
        <span class="font-weight-semibold">Right sidebar</span>
        <a href="#" class="sidebar-mobile-right-toggle">
            <i class="icon-arrow-right8"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User info -->
        <div class="card card-body bg-blue text-center"
             style="background-image: url(<?= base_url('assets/global_assets/images/backgrounds/boxed_bg.png'); ?>); background-size: contain;">
            <div class="mb-3">
                <h5 class="mb-0 mt-1">
                    <?= $patient['patient_fname'] . '' . $patient['patient_lname']; ?>
                </h5>

                <span class="d-block"><?= $patient['patient_status']; ?></span>
            </div>

            <a href="<?= base_url('doctor/patients/edit/' . $patient_id); ?>" class="d-inline-block mb-3">
                <?php if ($patient['patient_photo'] && $patient['patient_photo'] != "") { ?>
                    <img src="<?= base_url() . $patient['patient_photo']; ?>" class="rounded-round" width="110"
                         height="110" alt="">
                <?php } else { ?>
                    <img src="<?= base_url('assets/img/placeholder.png'); ?>" class="rounded-round" width="110"
                         height="110" alt="">
                <?php } ?>
            </a>


        </div>
        <!-- /user info -->


        <!-- Date stamp -->
        <div class="card">
            <div class="card-body pb-0">
                <h4 class="font-weight-light mb-0">
                    <?= date("D"); ?>
                    <span class="d-block"><?= date("d") ?><sup>th   </sup> <?= date("M") ?></span>
                </h4>
            </div>
        </div>
        <!-- /date stamp -->


        <!-- Sub navigation -->
        <div class="card mb-2 mt-3">
            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">Sub Navigation</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <ul class="nav nav-sidebar" data-nav-type="accordion">
                    <li class="nav-item">
                        <a href="#card1" class="nav-link sub active"> Patient Overview</a>
                    </li>
                    <li class="nav-item">
                        <a href="#card2" class="nav-link sub"> Driving License OR ID</a>
                    </li>
                    <li class="nav-item">
                        <a href="#card3" class="nav-link sub"> Patient Files</a>
                    </li>
                    <li class="nav-item">
                        <a href="#card4" class="nav-link sub">Invoices
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#card5" class="nav-link sub"> Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a href="#card6" class="nav-link sub">Contacts </a>
                    </li>
                    <li class="nav-item">
                        <a href="#card7" class="nav-link sub">Email Scheduler
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#card8" class="nav-link sub"> SMS Scheduler</a>
                    </li>
                    <li class="nav-item">
                        <a href="#card9" class="nav-link sub">Notes
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sub navigation -->

    </div>
    <!-- /sidebar content -->

</div>

<div class="modal" id="notesModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('doctor/view/add_note'); ?>" id="NotesForm">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="date" class="form-control" value="<?= date("d-m-Y"); ?>">
                                <input type="hidden" name="patient_id" value="<?= $patient_id; ?>">
                                <input type="hidden" name="noteID" id="noteID" value="">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Notes</label>
                                <select name="note_id" id="notes_option" onchange="InsertNote(this.value);"
                                        class="form-control">
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="noteDesc" class="form-control" rows="6"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary submit_form" form="NotesForm">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="EmailSchedulerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal_header"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" action="<?= base_url('doctor/view/schedule_custom_email_sms'); ?>" id="SchedulerForm">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="labelNotifi">Custom notifications</label>
                                <select name="fk_custom_notificationID" id="custom_notification_name"
                                        class="form-control" required>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="date" id="datepicker" placeholder="Date" class="form-control"
                                       value="">
                                <input type="hidden" name="patient_id" value="<?= $patient_id; ?>">
                                <input type="hidden" name="pkSchedulerID" id="pkSchedulerID" value="">
                                <input type="hidden" name="type" id="notification_type" value="">
                                <input type="hidden" name="action" id="Formaction" value="">
                            </div>
                            <div class="form-group">
                                <label>Time</label>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <input type="text" name="time" placeholder="Select Time"
                                               class="form-control pickatime" value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="SchedulerForm">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<link rel="stylesheet" href="<?= base_url('vendor/plugins/imgpicker/css/imgpicker.css'); ?>">

<script type="text/javascript"
        src="<?= base_url('assets/global_assets/js/plugins/uploaders/dropzone.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('vendor/plugins/imgpicker/js/jquery.Jcrop.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('vendor/plugins/imgpicker/js/jquery.imgpicker.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/jquerymask/jquery.maskedinput.min.js') ?>"></script>
<script src="<?= base_url('assets/global_assets/js/plugins/tables/datatables/datatables.min.js'); ?>"></script>
<script src="<?= base_url('assets/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js'); ?>"></script>
<script src="<?= base_url('assets/global_assets/js/plugins/tables/datatables/extensions/responsive.min.js'); ?>"></script>
<script src="<?= base_url('assets/global_assets/js/plugins/pickers/pickadate/picker.js'); ?>"></script>
<script src="<?= base_url('assets/global_assets/js/plugins/pickers/pickadate/picker.time.js'); ?>"></script>

<script src="https://cdn.ckeditor.com/4.5.8/standard-all/ckeditor.js"></script>

<script type="text/javascript">

    var patient_files_datatable;
    var patient_appointment_datatable;
    var patient_invoices;
    var patient_notes_datatable
    var scheduled_custom_email_datatable;

    $(document).ready(function () {

        patient_files_datatable = $("#patient_files_datatable").DataTable({

            dom: '<"datatable-scroll-wrap"t><"datatable-footer"p>',
            language: {},

            "autoWidth": false,
            "iDisplayLength": 7,
            "processing": true,
            "serverSide": true,
            "order": [0, "desc"],
            "aoColumnDefs": [
                {"bSortable": true, "searchable": false, "aTargets": [0]},
                {"bSortable": false, "searchable": false, "aTargets": [1], "sClass": "file_name_td"},
                {"bSortable": false, "searchable": false, "aTargets": [2]}
            ],
            responsive: true,
            "ajax": {
                "url": "<?= base_url("doctor/view/list_patient_files/$patient_id")?>",
                "type": "POST",
                "data": function (d) {
                    d.custom_filter = '';
                }
            },


        });
        patient_appointment_datatable = $("#patient_appointment_datatable").DataTable({

            dom: '<"datatable-scroll-wrap"t><"datatable-footer"p>',
            language: {},

            "autoWidth": false,
            "iDisplayLength": 7,
            "processing": true,
            "serverSide": true,
            "order": [],
            "aoColumnDefs": [
                {"bSortable": false, "searchable": false, "aTargets": [0]},
                {"bSortable": false, "searchable": false, "aTargets": [1]},
                {"bSortable": false, "searchable": false, "aTargets": [2]},
                {"bSortable": false, "searchable": false, "aTargets": [3]},
                {"bSortable": false, "searchable": false, "aTargets": [4]}
            ],
            responsive: true,
            "ajax": {
                "url": "<?= base_url("doctor/view/list_patient_appointment/$patient_id")?>",
                "type": "POST",
                "data": function (d) {
                    d.custom_filter = '';
                }
            },


        });

        patient_invoices = $("#patient_invoices").DataTable({

            dom: '<"datatable-scroll-wrap"t><"datatable-footer"p>',
            language: {},

            "autoWidth": false,
            "iDisplayLength": 7,
            "processing": true,
            "serverSide": true,
            "order": [0, "desc"],
            "aoColumnDefs": [
                {"bSortable": true, "searchable": true, "aTargets": [0]},
                {"bSortable": true, "searchable": true, "aTargets": [1]},
                {"bSortable": true, "searchable": false, "aTargets": [2]},
                {"bSortable": true, "searchable": false, "aTargets": [3]},
                {"bSortable": true, "searchable": true, "aTargets": [4]},
                {"bSortable": true, "searchable": false, "aTargets": [5]},
                {"bSortable": false, "searchable": false, "aTargets": [6]}
            ],
            responsive: true,
            "ajax": {
                "url": "<?= base_url("doctor/view/list_patient_invoices/$patient_id")?>",
                "type": "POST",
                "data": function (d) {
                    d.custom_filter = '';
                }
            },


        });

        patient_notes_datatable = $("#patient_notes_datatable").DataTable({

            dom: '<"datatable-scroll-wrap"t><"datatable-footer"p>',
            language: {},

            "autoWidth": false,
            "iDisplayLength": 7,
            "processing": true,
            "serverSide": true,
            "order": [0, "desc"],
            "aoColumnDefs": [
                {"bSortable": true, "searchable": true, "aTargets": [0]},
                {"bSortable": true, "searchable": false, "aTargets": [1]},
                {"bSortable": false, "searchable": false, "aTargets": [2]}
            ],
            responsive: true,
            "ajax": {
                "url": "<?=base_url("doctor/view/list_patient_notes/")?>",
                "type": "POST",
                "data": function (d) {
                    d.custom_filter = '';
                    d.patientID = <?=$patient_id; ?>
                }
            },


        });

        scheduled_custom_email_datatable = $("#scheduled_custom_email").DataTable({

            dom: '<"datatable-scroll-wrap"t><"datatable-footer"p>',
            language: {},

            "autoWidth": false,
            "iDisplayLength": 7,
            "processing": true,
            "serverSide": true,
            "order": [0, "desc"],
            "aoColumnDefs": [
                {"bSortable": true, "searchable": true, "aTargets": [0]},
                {"bSortable": true, "searchable": false, "aTargets": [1]},
                {"bSortable": true, "searchable": false, "aTargets": [2]},
                {"bSortable": false, "searchable": false, "aTargets": [3]}
            ],
            responsive: true,
            "ajax": {
                "url": "<?=base_url("doctor/view/list_custom_scheduled_email/")?>",
                "type": "POST",
                "data": function (d) {
                    d.custom_filter = '';
                    d.patientID = <?=$patient_id; ?>
                }
            },


        });

        scheduled_custom_email_datatable = $("#scheduled_custom_sms").DataTable({

            dom: '<"datatable-scroll-wrap"t><"datatable-footer"p>',
            language: {},

            "autoWidth": false,
            "iDisplayLength": 7,
            "processing": true,
            "serverSide": true,
            "order": [0, "desc"],
            "aoColumnDefs": [
                {"bSortable": true, "searchable": true, "aTargets": [0]},
                {"bSortable": true, "searchable": false, "aTargets": [1]},
                {"bSortable": true, "searchable": false, "aTargets": [2]},
                {"bSortable": false, "searchable": false, "aTargets": [3]}
            ],
            responsive: true,
            "ajax": {
                "url": "<?=base_url("doctor/view/list_custom_scheduled_sms/")?>",
                "type": "POST",
                "data": function (d) {
                    d.custom_filter = '';
                    d.patientID = <?=$patient_id; ?>
                }
            },


        });


        //Functions callback

        load_patient_overview();

        $("a.sub").on("click", function () {
            $("a.active").removeClass("active");
            $(this).addClass("active");
        });

        // Default functionality
        $('.pickatime').pickatime();

        $('#avatarModal_stateid').imgPicker({
            url: '<?=base_url('general/imagecroperupload')?>',
            //aspectRatio: 1, // Crop aspect ratio
            deleteComplete: function () {
                $('#avatar').attr('src', '');
                this.modal('hide');
            },
            cropSuccess: function (image) {


                var fileName = image.versions.bg.filename;
                var modal_this = this

                $.post('<?=base_url('doctor/view/update_idCard_images/1');?>', {
                    fileName: image.versions.bg.filename,
                    patientId: <?=$patient_id?>
                }, function (data) {


                    $("#image_cont_stateid img").attr("src", data.image);
                    $("#image_cont_stateid").removeClass("hidden");
                    $("#control_cont_stateid").addClass("hidden");
                    modal_this.modal('hide');
                });


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
                var fileName = image.versions.bg.filename;
                var modal_this = this
                $.post('<?=base_url('doctor/view/update_idCard_images/0');?>', {
                    fileName: image.versions.bg.filename,
                    patientId: <?=$patient_id?>
                }, function (data) {
                    $("#image_cont_stateid_back img").attr("src", data.image);
                    $("#image_cont_stateid_back").removeClass("hidden");
                    $("#control_cont_stateid_back").addClass("hidden");
                    modal_this.modal('hide');
                });
            }
        });

        $(document).on("click", "#delete_image_cont_stateid", function () {

            confirmation(function (res) {

                if (res == true) {
                    $.post('<?=base_url('doctor/view/delete_image/1'); ?>', {
                        patientId: <?=$patient_id;?>
                    }, function () {

                    });
                } else {
                    return false;
                }

                $("#image_cont_stateid").addClass('hidden');
                $("#control_cont_stateid").removeClass("hidden")
                $(".ip-edit").css("display", "none");
                $(".ip-delete").css("display", "none");
                $("#image").val("");

            });

        });

        $(document).on("click", "#delete_image_cont_back", function () {

            confirmation(function (res) {

                if (res == true) {
                    $.post('<?=base_url('doctor/view/delete_image/0'); ?>', {
                        patientId: <?=$patient_id;?>
                    }, function () {
                    });
                } else {
                    return false;
                }

                $("#image_cont_stateid_back").addClass('hidden');
                $("#control_cont_stateid_back").removeClass("hidden")
                $(".ip-edit").css("display", "none");
                $(".ip-delete").css("display", "none");
                $("#image_back").val("");

            });

        });

        $(".custom_schedule_email").on("click", function () {

            $("#EmailSchedulerModal").modal('show');
            $("#notification_type").val(1);
            $(".modal_header").html("Schedule Custom Email");
            $(".labelNotifi").html("Custom Email");

            $.post('<?=base_url('doctor/view/get_custom_notifications');?>', {type: 1}, function (html) {
                $("#custom_notification_name").html(html);
            });

        });

        $(".custom_schedule_sms").on("click", function () {

            $("#EmailSchedulerModal").modal('show');
            $("#notification_type").val(0);
            $(".modal_header").html("Schedule Custom SMS");
            $(".labelNotifi").html("Custom SMS");

            $.post('<?=base_url('doctor/view/get_custom_notifications');?>', {type: 0}, function (html) {
                $("#custom_notification_name").html(html);
            });

        });

        $("#datepicker").datepicker();

        $.post('<?=base_url('doctor/view/get_custom_notifications');?>', {type: 1}, function (html) {
            $("#custom_email").html(html);
        });

        $.post('<?=base_url('doctor/view/get_default_email_notifications');?>', {type: 0}, function (html) {
            $("#default_email").html(html);
        });

        $(".sms-tab").on("click", function () {

            $.post('<?=base_url('doctor/view/get_custom_notifications');?>', {type: 0}, function (html) {
                $("#custom_sms").html(html);
            });
        });

        $(".sms-tab").on("click", function () {

            $.post('<?=base_url('doctor/view/get_default_email_notifications');?>', {type: 1}, function (html) {
                $("#default_sms").html(html);
            });
        });

        $(document).on("change", "#default_email", function (e) {

            var notificationID = $(this).val();
            if (notificationID != "") {
                $(".email_div").removeClass("hidden");
                $.post('<?=base_url('doctor/view/get_notification');?>', {
                    notificationId: notificationID,
                    type: 0,
                    table: "default_email",
                    pkid: "id"
                }, function (data) {
                    notification = JSON.parse(data);
                    $("#subject").val(notification.subject);
                    CKEDITOR.instances['Emailbody'].setData(notification.body);
                });
            } else {
                $(".email_div").addClass("hidden");
            }
        });

        $(document).on("change", "#custom_email", function () {


            var notificationID = $(this).val();
            if (notificationID != "") {
                $(".email_div").removeClass("hidden");
                $.post('<?=base_url('doctor/view/get_notification');?>', {
                    notificationId: notificationID,
                    type: 1,
                    table: "custom_email_sms",
                    pkid: "ID"
                }, function (data) {
                    notification = JSON.parse(data);
                    $("#subject").val(notification.subject);
                    CKEDITOR.instances['Emailbody'].setData(notification.body);
                });
            } else {
                $(".email_div").addClass("hidden");
            }
        });

        $(document).on("change", "#custom_sms", function () {

            var notificationID = $(this).val();
            if (notificationID != "") {
                $(".sms_div").removeClass("hidden");


                $.post('<?=base_url('doctor/view/get_notification');?>', {
                    notificationId: notificationID,
                    type: 0,
                    table: "custom_email_sms",
                    pkid: "ID"
                }, function (data) {
                    notification = JSON.parse(data);
                    $("#SMSbody").val(notification.body);
                });
            } else {
                $(".sms_div").addClass("hidden");
            }

        });

        $(document).on("change", "#default_sms", function (e) {

            var notificationID = $(this).val();
            if (notificationID != "") {
                $(".sms_div").removeClass("hidden");
                $.post('<?=base_url('doctor/view/get_notification');?>', {
                    notificationId: notificationID,
                    type: 1,
                    table: "default_email",
                    pkid: "id"
                }, function (data) {
                    notification = JSON.parse(data);
                    $("#SMSbody").val(notification.body);
                });
            } else {
                $(".sms_div").addClass("hidden");
            }
        });


        $("#sendEmailForm").submit(function (event) {

            event.preventDefault();
            var formData = $(this).serialize();

            $("#formSubmit").html("<i class='fa fa-circle-o-notch fa-spin'></i> Loading");

            $.post('<?=base_url('doctor/view/add_contact_notification'); ?>', formData, function () {
                $(".email_div").addClass("hidden");
                $("#formSubmit").html("Submit");
            });


        });

        $("#sendSMSForm").submit(function (event) {

            event.preventDefault();
            var formData = $(this).serialize();
            console.log(formData);

            $("#submitForm").html("<i class='fa fa-circle-o-notch fa-spin'></i> Loading");

            $.post('<?=base_url('doctor/view/add_contact_notification'); ?>', formData, function () {
                $(".sms_div").addClass("hidden");
                $("#submitForm").html("Submit");
            });

        });


    });

    var DropzoneUploader = function () {
        var _componentDropzone = function () {
            if (typeof Dropzone == 'undefined') {
                console.warn('Warning - dropzone.min.js is not loaded.');
                return;
            }


            Dropzone.options.dropzoneRemove = {
                paramName: "patient_files", // The name that will be used to transfer the file
                url: "<?=base_url("doctor/view/upload_patientfiles/" . $patient_id)?>",
                dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
                maxFilesize: 20, // MB
                autoProcessQueue: true,
                addRemoveLinks: false,
                parallelUploads: 1,
                uploadMultiple: false,
                init: function () {

                    var myDropzone = this;
                    this.on("successmultiple", function (files, response) {

                    });
                    this.on("queuecomplete", function (files, response) {
                        //myDropzone.removeFile(files);

                    });
                },
                complete: function (file) {
                    if (file.status == "success") {
                        //this.removeFile(file);
                    }
                },
                success: function (file, response) {
                    if (file.previewElement) {
                        file.previewElement.classList.add("dz-success");
                    }
                    if (response.error == 0) {
                        console.log("Added")
                        $('#patient_files_datatable').DataTable().ajax.reload();
                    }
                }

            };


        };

        return {
            init: function () {
                _componentDropzone();
            }
        }
    }();
    DropzoneUploader.init();

    function confirmation(callback) {
        $.confirm({
            title: 'Confirm!',
            content: "Are you sure you want to delete this image ?",
            buttons:
                {
                    Delete: function () {
                        callback(true)
                    },

                    Close: function () {
                        callback(false)
                    },
                }
        });
    }

    $(document).on("click", ".edit_file", function (e) {

        e.preventDefault()
        var url = $(this).attr("href");
        if ($(this).parents("tr").hasClass("child")) {
            edit_row = $(this).parents("tr").prev('tr.parent');
            edit_filename = edit_row.text();
        } else {
            edit_row = $(this).parents("tr").find(".file_name_td");
            edit_filename = edit_row.text();
        }

        patient_file_edit(edit_filename, function (res, name) {
            if (res == true) {
                edit_row.text(name);

                $.post(url, {fileName: name}, function (data) {

                });

            } else {

            }
        });
    });

    function load_patient_overview() {
        $.post("<?=base_url('doctor/view/patient/' . $patient_id);?>", function (html) {
            $("#patient_detail").html(html);
        });
        $.post('<?=base_url('doctor/view/load_notes/'); ?>',function(html){
            $("#notes_option").html(html);
        });
    }

    function patient_file_edit(name, callback) {

        $.confirm({
            title: 'Update Name',

            content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>File Name</label>' +
                '<input type="text" value="' + name + '" placeholder="File name" class="name form-control" required />' +
                '</div>' +
                '</form>',
            scrollToPreviousElement: false,
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-blue',
                    action: function () {
                        var name = this.$content.find('.name').val();
                        if (!name) {
                            $.alert('provide a valid name');
                            return false;
                        }

                        callback(true, name)
                    }
                },
                cancel: function () {
                    callback(false, '')
                },
            },
            onContentReady: function () {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    }

    function deleteconfirm(content, url, datatable) {
        $.confirm({
            title: 'Confirm!',
            content: content,
            buttons:
                {
                    Delete: function () {
                        $.post(url, function (data) {
                            $('#' + datatable).DataTable().ajax.reload();
                        });
                    },

                    Close: function () {
                    },
                }
        });

    }

    function InsertNote(note_id) {
        $.post('<?=base_url('doctor/view/get_note')?>', {NoteID: note_id}, function (html) {
            console.log(html);
            $("#noteDesc").val('');
            $("#noteDesc").val(html);
        });
    }

    function popupModal(noteID) {
        $("#notesModal").modal('show');
        $.post('<?=base_url('doctor/view/get_patient_note/');?>', {
            NoteID: noteID,
            patientID: <?=$patient_id;?>
        }, function (data) {
            note = JSON.parse(data);
            $("#noteDesc").val(note.note_description);
            $("#noteID").val(note.pk_noteID);
        });
    }

    function popupModalEmail(notificationID) {
        $("#EmailSchedulerModal").modal('show');
        $(".modal_header").html("Schedule Custom Email");
        $(".labelNotifi").html("Custom Email");

        $("#Formaction").val("Update");
        $("#notification_type").val(1);

        $.post('<?=base_url('doctor/view/get_custom_notifications');?>', {type: 1}, function (html) {
            $("#custom_notification_name").html(html);
        });

        $.post('<?=base_url('doctor/view/get_scheduled_notification');?>', {
            type: 1,
            notificationid: notificationID
        }, function (data) {
            notification = JSON.parse(data);

            var date = new Date(notification.sendDateTime);
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();

            var dateNew = month + '/' + day + '/' + year;

            var hours = date.getHours();
            var minutes = date.getMinutes();
            var seconds = date.getSeconds();

            var timeNew = hours + ':' + minutes;

            $("#datepicker").val(dateNew);
            $(".pickatime").val(timeNew);
            $("#pkSchedulerID").val(notification.pk_scheduler_ID);
            $("#custom_notification_name").val(notification.fk_notification_id);
        });

    }

    function popupModalSMS(notificationID) {
        $("#EmailSchedulerModal").modal('show');
        $(".modal_header").html("Schedule Custom SMS");
        $(".labelNotifi").html("Custom SMS");

        $("#Formaction").val("Update");
        $("#notification_type").val(0);

        $.post('<?=base_url('doctor/view/get_custom_notifications');?>', {type: 0}, function (html) {
            $("#custom_notification_name").html(html);
        });

        $.post('<?=base_url('doctor/view/get_scheduled_notification');?>', {
            type: 0,
            notificationid: notificationID
        }, function (data) {
            notification = JSON.parse(data);

            console.log(notification.sendDateTime);

            var date = new Date(notification.sendDateTime);
            day = date.getDate();
            month = date.getMonth();
            year = date.getFullYear();

            var dateNew = month + '/' + day + '/' + year;


            var hours = date.getHours();
            var minutes = date.getMinutes();
            var seconds = date.getSeconds();

            var timeNew = hours + ':' + minutes;

            $("#datepicker").val(dateNew);
            $(".pickatime").val(timeNew);
            $("#pkSchedulerID").val(notification.pk_scheduler_ID);
            $("#custom_notification_name").val(notification.fk_notification_id);
        });

    }

</script>

@endsection