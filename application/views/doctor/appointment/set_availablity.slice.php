@extends('layout.master_doctor')
@section('title', 'Manage Availablity')
@section('bodyClass', ' ')
@section('content')

<style>
    
    .tab_accor .nav-tabs {
        display:none;
    }

    @media(min-width:992px) {
        .tab_accor .nav-tabs {
            display: flex;
        }
        
        .tab_accor .card {
            border: none;
        }

        .tab_accor .card .card-header {
            display:none;
        }  

        .tab_accor .card .collapse{
            display:block;
        }
    }

    @media(max-width:992px){
        .tab_accor .tab-content > .tab-pane {
            display: block !important;
            opacity: 1;
        }
        .dnone{
            display: none;
        }
    }

</style>

<?php require ("application/views/doctor/appointment/appointment_setting_sidebar.php")?>

<div class="content-wrapper">

    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">

                <h4>
                    <a href="#" class="d-md-inline d-none sidebar-secondary-toggle">
                        <i class="icon-arrow-left8 mr-2"></i>
                    </a>

                    <span class="font-weight-semibold">Manage Availability</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <!-- <button type="submit" class="btn btn-sm btn-outline-primary" name="Update" form="myform">Update
                    </button> -->
                </div>
            </div>

        </div>
    </div>

<section class="content">
  <div class="card" >
    <div class="card-body">  

        <div class=" tab_accor">
            
            <ul id="tabs" class="nav nav-tabs" role="tablist">
                
                <li class="nav-item">
                    <a id="tab_monday" href="#monday_tab" class="nav-link active" data-toggle="tab" role="tab">Monday</a>
                </li>
                <li class="nav-item">
                    <a id="tab_tuesday" href="#tuesday_tab" class="nav-link" data-toggle="tab" role="tab">Tuesday</a>
                </li>
                <li class="nav-item">
                    <a id="tab_wednesday" href="#wednesday_tab" class="nav-link" data-toggle="tab" role="tab">Wednesday</a>
                </li>
                <li class="nav-item">
                    <a id="tab_thursday" href="#thursday_tab" class="nav-link" data-toggle="tab" role="tab">Thursday</a>
                </li>
                <li class="nav-item">
                    <a id="tab_friday" href="#friday_tab" class="nav-link" data-toggle="tab" role="tab">Friday</a>
                </li>
                <li class="nav-item">
                    <a id="tab_saturday" href="#saturday_tab" class="nav-link" data-toggle="tab" role="tab">Saturday</a>
                </li>
                <li class="nav-item">
                    <a id="tab_sunday" href="#sunday_tab" class="nav-link" data-toggle="tab" role="tab">Sunday</a>
                </li>

            </ul>


            <div id="content" class="tab-content" role="tablist">
               
                <div id="monday_tab" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab_monday">
                    <div class="card-header px-1 py-3" role="tab" id="heading-A">
                        <h6 class="mb-0">
                            <!-- Note: `data-parent` removed from here -->
                            <a data-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A">
                                Monday
                            </a>
                            <a href="<?=base_url('doctor/appointment/add_availability/1/'); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                + Add
                            </a>
                            <button type="button"
                                    onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url()?>doctor/appointment/clear_time_slots/1');"
                                    class="btn btn-outline-primary btn-sm mr-1 pull-right"
                            >Clear All
                            </button>
                        </h6>
                    </div>

                <!-- Note: New place of `data-parent` -->
                <div id="collapse-A" class="collapse show" data-parent="#content" role="tabpanel" aria-labelledby="heading-A">
                    <div class="card-body">
                      
                        <div class="row">
                           <div class=" dnone col-md-12">
                                <a href="<?=base_url('doctor/appointment/add_availability/1/'); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                    + Add
                                </a>
                                <button type="button"
                                        onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url()?>doctor/appointment/clear_time_slots/1');"
                                        class="btn btn-outline-primary btn-sm mr-1 pull-right"
                                        >Clear All
                                </button>
                            </div> 
                                <?php

                                    if($monday){
                                    foreach ($monday as $monday){
                                
                                ?>
                                        <div id="hide_<?= $monday["pkslotid"] ?>" 
                                            class="col-md-12 mt-2 p-2 bg-light"
                                            style="border: 1px solid #DDD;">
                                            <span class="font-weight-bold">
                                                <?= date("h:i a", strtotime($monday["start_time"])) ?> - <?= date("h:i a", strtotime($monday["end_time"])) ?></span><a
                                                onclick="confirmdelete('Are you sure you want to delete this slot?','<?=base_url('doctor/appointment/delete_time_slot/'.$monday['pkslotid']); ?>')"
                                                class="text-danger pull-right cursor-pointer">
                                                X</a><br/>
                                            <span class="font-weight-semibold text-muted">
                                            <?= $monday["no_space"] ?> spaces available</span>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                       
                       </div>
                     </div>  
                  
                  </div>
                </div>

                <div id="tuesday_tab" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab_tuesday">
                    <div class="card-header px-1 py-3" role="tab" id="heading-B">
                        <h6 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
                               Tuesday
                            </a>
                            <a href="<?=base_url('doctor/appointment/add_availability/2/'); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                + Add
                            </a>
                            <button type="button"
                                    onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url()?>doctor/appointment/clear_time_slots/2');"
                                    class="btn btn-outline-primary btn-sm mr-1 pull-right"
                            >Clear All
                            </button>
                        </h6>
                    </div>
                    <div id="collapse-B" class="collapse" data-parent="#content" role="tabpanel" aria-labelledby="heading-B">
                    <div class="card-body">
                        <div class="row">
                             <div class="col-md-12 dnone">
                                <a href="<?=base_url('doctor/appointment/add_availability/2/'); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                        + Add
                                    </a>
                                    <button type="button"
                                            onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url()?>doctor/appointment/clear_time_slots/2');"
                                            class="btn btn-outline-primary btn-sm mr-1 pull-right"
                                            >Clear All
                                    </button>
                                </div> 
                                    <?php
                                        if ($tuesday) {
                                            foreach ($tuesday as $tuesday) {
                                                ?>
                                                <div id="hide_<?= $tuesday["pkslotid"] ?>"
                                                    class="col-md-12 mt-2 p-2 bg-light"
                                                    style="border: 1px solid #DDD;">
                                                    <span class="font-weight-bold"
                                                        ><?= date("h:i a", strtotime($tuesday["start_time"])) ?> - <?= date("h:i a", strtotime($tuesday["end_time"])) ?></span><a
                                                            onclick="confirmdelete('Are you sure you want to delete this slot?','<?=base_url('doctor/appointment/delete_time_slot/'.$tuesday['pkslotid']); ?>')"
                                                            class="text-danger pull-right cursor-pointer">
                                                        X</a><br/>
                                                    <span class="font-weight-semibold text-muted"
                                                        ><?= $tuesday["no_space"] ?> spaces available</span>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div> 
                            </div>
                      
                    </div>
                </div>

                <div id="wednesday_tab" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab_wednesday">
                    <div class="card-header px-1 py-3" role="tab" id="heading-C">
                        <h6 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-C" aria-expanded="false" aria-controls="collapse-C">
                               Wednesday
                            </a>
                            <a href="<?=base_url('doctor/appointment/add_availability/3/'); ?>" class="btn btn-primary btn-sm pull-right add_availability" >
                                + Add
                            </a>
                            <button type="button"
                                    onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url()?>doctor/appointment/clear_time_slots/3');"
                                    class="btn btn-outline-primary btn-sm mr-1 pull-right"
                            >Clear All
                            </button>
                        </h6>
                    </div>
                    <div id="collapse-C" class="collapse" role="tabpanel" data-parent="#content" aria-labelledby="heading-C">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12 dnone">
                            <a href="<?=base_url('doctor/appointment/add_availability/3/'); ?>" class="btn btn-primary btn-sm pull-right add_availability" >
                                + Add
                            </a>
                            <button type="button"
                                    onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url()?>doctor/appointment/clear_time_slots/3');"
                                    class="btn btn-outline-primary btn-sm mr-1 pull-right"
                                    >Clear All
                            </button>
                            </div> 
                            <?php
                                if ($wednesday) {
                                    foreach ($wednesday as $wednesday) {
                                        ?>
                                        <div id="hide_<?= $wednesday["pkslotid"] ?>"
                                            class="col-md-12 mt-2 p-2 bg-light"
                                            style="border: 1px solid #DDD;">
                                            <span class="font-weight-bold"
                                                ><?= date("h:i a", strtotime($wednesday["start_time"])) ?> - <?= date("h:i a", strtotime($wednesday["end_time"])) ?></span><a
                                                    onclick="confirmdelete('Are you sure you want to delete this slot?','<?=base_url('doctor/appointment/delete_time_slot/'.$wednesday['pkslotid']); ?>')"
                                                    class="text-danger pull-right cursor-pointer">
                                                X</a><br/>
                                            <span class="font-weight-semibold text-muted"
                                            ><?= $wednesday["no_space"] ?> spaces available</span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div> 	
                          </div>
                    
                    </div>
                </div>

                <div id="thursday_tab" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab_thursday">
                    <div class="card-header px-1 py-3" role="tab" id="heading-D">
                        <h6 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-D" aria-expanded="false" aria-controls="collapse-D">
                               Thursday
                            </a>
                            <a href="<?=base_url('doctor/appointment/add_availability/4/'); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                + Add
                            </a>
                            <button type="button"
                                    onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url()?>doctor/appointment/clear_time_slots/4');"
                                    class="btn btn-outline-primary btn-sm mr-1 pull-right"
                            >Clear All
                            </button>
                        </h6>
                    </div>
                    <div id="collapse-D" class="collapse" role="tabpanel" data-parent="#content" aria-labelledby="heading-D">
                       <div class="card-body">
                          <div class="row">
                              <div class="col-md-12 dnone">
                                <a href="<?=base_url('doctor/appointment/add_availability/4/'); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                    + Add
                                </a>
                                <button type="button"
                                        onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url()?>doctor/appointment/clear_time_slots/4');"
                                        class="btn btn-outline-primary btn-sm mr-1 pull-right"
                                        >Clear All
                                </button>
                                </div>
                                <?php
                                    if ($thursday) {
                                        foreach ($thursday as $thursday) {
                                            ?>
                                            <div id="hide_<?= $thursday["pkslotid"] ?>"
                                                class="col-md-12 mt-2 p-2 bg-light"
                                                style="border: 1px solid #DDD;">
                                                <span class="font-weight-bold"
                                                    ><?= date("h:i a", strtotime($thursday["start_time"])) ?> - <?= date("h:i a", strtotime($thursday["end_time"])) ?></span><a
                                                    onclick="confirmdelete('Are you sure you want to delete this slot?','<?=base_url('doctor/appointment/delete_time_slot/'.$thursday['pkslotid']); ?>')"
                                                        class="text-danger pull-right cursor-pointer">
                                                    X</a><br/>
                                                <span class="font-weight-semibold text-muted"
                                                ><?= $thursday["no_space"] ?> spaces available</span>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                            </div> 	 
                        </div>
                     
                    </div>
                </div>

                <div id="friday_tab" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab_friday">
                    <div class="card-header px-1 py-3" role="tab" id="heading-E">
                        <h6 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-E" aria-expanded="false" aria-controls="collapse-E">
                               Friday
                            </a>
                            <a href="<?=base_url('doctor/appointment/add_availability/5/'); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                + Add
                            </a>
                            <button type="button"
                                    onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url()?>doctor/appointment/clear_time_slots/5');"
                                    class="btn btn-outline-primary btn-sm mr-1 pull-right"
                            >Clear All
                            </button>
                        </h6>
                    </div>
                    <div id="collapse-E" class="collapse" role="tabpanel" data-parent="#content" aria-labelledby="heading-E">
                      <div class="card-body">
                        <div class="row">
                           <div class="col-md-12 dnone">
                                <a href="<?=base_url('doctor/appointment/add_availability/5/'); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                    + Add
                                </a>
                                <button type="button"
                                        onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url()?>doctor/appointment/clear_time_slots/5');"
                                        class="btn btn-outline-primary btn-sm mr-1 pull-right"
                                    >Clear All
                                </button>
                                </div>
                                <?php
                                    if ($friday) {
                                        foreach ($friday as $friday) {
                                            ?>
                                            <div id="hide_<?= $friday["pkslotid"] ?>"
                                                class="col-md-12 mt-2 p-2 bg-light"
                                                style="border: 1px solid #DDD;">
                                                <span class="font-weight-bold"
                                                    ><?= date("h:i a", strtotime($friday["start_time"])) ?> - <?= date("h:i a", strtotime($friday["end_time"])) ?></span><a
                                                        onclick="confirmdelete('Are you sure you want to delete this slot?','<?=base_url('doctor/appointment/delete_time_slot/'.$friday['pkslotid']); ?>')"
                                                        class="text-danger pull-right cursor-pointer">
                                                    X</a><br/>
                                                <span class="font-weight-semibold text-muted"
                                                    ><?= $friday["no_space"] ?> spaces available</span>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                              </div> 	 
                            </div>
                        
                    </div>
                </div>

                <div id="saturday_tab" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab_saturday">
                    <div class="card-header px-1 py-3" role="tab" id="heading-F">
                        <h6 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-F" aria-expanded="false" aria-controls="collapse-F">
                               Saturday
                            </a>
                            <a href="<?=base_url('doctor/appointment/add_availability/6/'); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                + Add
                            </a>
                            <button type="button"
                                    onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url()?>doctor/appointment/clear_time_slots/6');"
                                    class="btn btn-outline-primary btn-sm mr-1 pull-right"
                            >Clear All
                            </button>
                        </h6>
                    </div>
                    <div id="collapse-F" class="collapse" role="tabpanel" data-parent="#content" aria-labelledby="heading-F">
                      <div class="card-body">
                         <div class="row">
                            <div class="col-md-12 dnone">
                                    <a href="<?=base_url('doctor/appointment/add_availability/6/'); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                        + Add
                                    </a>
                                    <button type="button"
                                            onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url()?>doctor/appointment/clear_time_slots/6');"
                                            class="btn btn-outline-primary btn-sm mr-1 pull-right"
                                            >Clear All
                                    </button>
                                    </div>
                                    <?php
                                        if ($saturday) {
                                            foreach ($saturday as $saturday) {
                                                ?>
                                                <div id="hide_<?= $saturday["pkslotid"] ?>"
                                                    class="col-md-12 mt-2 p-2 bg-light"
                                                    style="border: 1px solid #DDD;">
                                                    <span class="font-weight-bold"
                                                        ><?= date("h:i a", strtotime($saturday["start_time"])) ?> - <?= date("h:i a", strtotime($saturday["end_time"])) ?></span><a
                                                            onclick="confirmdelete('Are you sure you want to delete this slot?','<?=base_url('doctor/appointment/delete_time_slot/'.$saturday['pkslotid']); ?>')"
                                                            class="text-danger pull-right cursor-pointer">
                                                        X</a><br/>
                                                    <span class="font-weight-semibold text-muted"
                                                        ><?= $saturday["no_space"] ?> spaces available</span>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                </div>
                            </div>
                      
                    </div>
                </div>

                <div id="sunday_tab" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab_sunday">
                    <div class="card-header px-1 py-3" role="tab" id="heading-G">
                        <h6 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-G" aria-expanded="false" aria-controls="collapse-G">
                               Sunday
                            </a>
                            <a href="<?=base_url('doctor/appointment/add_availability/7/'); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                + Add
                            </a>
                            <button type="button"
                                    onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url()?>doctor/appointment/clear_time_slots/7');"
                                    class="btn btn-outline-primary btn-sm mr-1 pull-right"
                            >Clear All
                            </button>
                        </h6>
                    </div>
                    <div id="collapse-G" class="collapse" role="tabpanel" data-parent="#content" aria-labelledby="heading-G">
                      <div class="card-body">
                         <div class="row">
                              <div class="col-md-12 dnone">
                                    <a href="<?=base_url('doctor/appointment/add_availability/7/'); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                        + Add
                                    </a>
                                    <button type="button"
                                            onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url()?>doctor/appointment/clear_time_slots/7');"
                                            class="btn btn-outline-primary btn-sm mr-1 pull-right"
                                            >Clear All
                                    </button>
                                    </div>
                                    <?php
                                        if ($sunday) {
                                            foreach ($sunday as $sunday) {
                                                ?>
                                                <div id="hide_<?= $sunday["pkslotid"] ?>" class="col-md-12 mt-2 p-2 bg-light"
                                                    style="border: 1px solid #DDD;">
                                                    <span class="font-weight-bold"
                                                        ><?= date("h:i a", strtotime($sunday["start_time"])) ?> - <?= date("h:i a", strtotime($sunday["end_time"])) ?></span><a
                                                            onclick="confirmdelete('Are you sure you want to delete this slot?','<?=base_url('doctor/appointment/delete_time_slot/'.$sunday['pkslotid']); ?>')"
                                                            class="text-danger pull-right cursor-pointer">
                                                        X</a><br/>
                                                    <span class="font-weight-semibold text-muted"
                                                        ><?= $sunday["no_space"] ?> spaces available</span>
                                                </div>
                                                <?php
                                            }  
                                        }
                                    ?>
                                </div> 	  	
                            </div>
                       
                    </div>
                </div>

            </div>
        </div>
    
    <!-- card-body-closed -->
    </div>
   <!-- card closed --> 
  </div>
</section>
</div>

<div id="add_availability" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content" style="display:block">
            <div class="modal-header">
                <h4 class="modal-title">Add Availability</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <iframe src="" id="add_availability_iframe" style="width: 100%; height: 500px; border: 0px">
                </iframe>
            </div>
        </div>
    </div
    >
</div>


@endsection


    @section('scripts')

    <link rel="stylesheet" type="text/css" href="<?= base_url('vendor/plugins/magnific-popup/magnific-popup.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/Year-Calendar/jquery.bootstrap.year.calendar.css'); ?>">
    <script src="<?= base_url('assets/plugins/Year-Calendar/jquery.bootstrap.year.calendar.js'); ?>"
    <script src="<?= base_url('vendor/plugins/magnific-popup/magnific-popup.js'); ?>"></script>

    <script type="text/javascript">

        $(document).on("click", ".add_availability", function (e) {
            e.preventDefault();
            var url = $(this).attr("href");
            $("#add_availability_iframe").attr("src", url);
            $('#add_availability').modal('show');

        });

        function confirmdelete(text, link) {
            var b = $.confirm({
                title: 'Confirm!',
                content: text,
                buttons:
                    {
                        Delete: {
                            btnClass: 'btn-red text-lowercase mr-2',
                            action: function () {
                                var event = $(this);
                                window.location = link
                                event.parent().remove();
                            }
                        },

                        Close: {
                            btnClass: 'btn-default',
                            action: function () {
                            }
                        },
                    }

            });
            return b;
        }

    </script>

    @endsection