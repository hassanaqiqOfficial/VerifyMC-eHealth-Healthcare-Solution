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
    label.switch {
    margin-right: 35px;
    }
    span.slider.round{
        height: 21px !important;
    }

</style>

<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4>
                    <a href="#" class="d-md-inline d-none sidebar-secondary-toggle">
                        <i class="icon-arrow-left8 mr-2"></i>
                    </a> 
                    <span class="font-weight-semibold">Doctor Emails & SMS's Settings</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

        </div>
    </div>
    <!-- /page header -->
    <section class="content">

        <div class="card">
            <div class="card-body">
                <?=__message(); ?>

                <?php
                if($default_templates)
                {
                foreach($default_templates as $default_template)
                {
                ?>
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <table class="table table-bordered" id="">
                            <thead class="">
                            <tr>
                                <td colspan="2">
                                    <b><?=$default_template["title"]?></b>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td width="80%">Email</td>
                                <td width="20%" class="text-center">
                                  <!-- Rounded switch -->
                                    <span>ON/OFF</span>
                                    <label class="switch">   
                                        <input type="checkbox" name="is_notify_email" data-type="0" data-task="<?=$default_template["task"]; ?>" data-user_type="1" class="check_notify">
                                        <span class="slider round"></span>
                                    </label>
                                    <a href="<?=base_url('doctor/notifications/customize_doctor_notification/'.$default_template["task"].'/0'); ?>" ><i class="icon-compose "></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td width="80%">SMS</td>
                                <td width="20%" class="text-center">
                                  <!-- Rounded switch -->
                                    <span>ON/OFF</span>
                                    <label class="switch">   
                                        <input type="checkbox" name="is_notify_sms" data-type="1" data-task="<?=$default_template["task"]; ?>" data-user_type="1" class="check_notify">
                                        <span class="slider round"></span>
                                    </label>
                                  <a href="<?=base_url('doctor/notifications/customize_doctor_notification/'.$default_template["task"].'/1'); ?>"  ><i class="icon-compose "></i></a>
                                </td>
                            </tr>
                            <tbody>
                        </table>
                    </div>
                </div>
                    <?php
                }
                }
                ?>



                <!-- card-body-closed-here  -->
            </div>
        </div>
    </section>

</div>


@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.5.8/standard-all/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).on("change",".check_notify",function(e){

            var checkStatus = this.checked ? 1 : 0;
            var type = $(this).data("type");
            var task = $(this).data("task");
            var user_type = $(this).data("user_type");
            

            $.post('<?=base_url('doctor/notifications/update_notification_status/'); ?>',
            {
                type : type,
                task : task,
                user_type : user_type,
                checkStatus : checkStatus
            },
            function(){
            
            });
        });
    </script>
@endsection


