<style>
      .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xl-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xl-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xl-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xl-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xl-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xl-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xl-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xl-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xl-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xl-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xl-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12, .col-xl-12 
     {
        position: relative;
        min-height: 1px;
        padding-left: 11px;
        padding-right: 11px;
     }
     div {
     display: block;
     }
         </style>
        
         <!--Default Grid--> 
        <div class="card" id="bulk_manage">
            
            <div class="card-header header-element-inline">
              <h3 class="card-title">Manage Availablity</h3>
             </div> 
              
            <div class="card-body">
             
                <div class="form-row">
                                         
                    <div class="col-md-3 col-lg-3 mt-2 mb-1 text-left" style='border-right:2px solid #E5E5E5;'>
                        <div class="row">
                           <div class="col-md-12">
                             <div class="mb-3">
                              <span class="font-weight-bold font-size-14">Monday</span>
                                <a href="<?=base_url('clinic/appointment/add_availability/1/'.$doctor_id); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                    + Add
                                </a>
                                <button type="button"
                                        onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url('clinic/appointment/clear_time_slots/1/'.$doctor_id)?>');"
                                        class="btn btn-outline-primary btn-sm mr-1 pull-right"
                                        >Clear All
                                </button>
                               </div> 
                                <?php

                                    if ($monday) {

                                    foreach ($monday as $monday) {
                                ?>
                                        <div id="hide_<?= $monday["pkslotid"] ?>" 
                                            class="col-md-12 mt-2 p-2 bg-light"
                                            style="border:1px solid #DDD;">
                                            <span class="font-weight-bold">
                                              <?= date("h:i a", strtotime($monday["start_time"])) ?> - <?= date("h:i a", strtotime($monday["end_time"])) ?>
                                            </span>
                                            <a
                                                onclick="confirmdelete('Are you sure you want to delete this time slot?','<?=base_url('clinic/appointment/delete_time_slot/'.$doctor_id.'/'.$monday['pkslotid']); ?>')"
                                                class="text-danger pull-right cursor-pointer">
                                                X</a><br/>
                                            <span class="font-weight-semibold text-muted"
                                               ><?= $monday["no_space"] ?> spaces available</span>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div> 
                      </div> 
                    </div>	

                    <div class="col-md-3 col-lg-3 mt-2 mb-1 text-left" style="border-right:2px solid #E5E5E5;">
                        <div class="row">
                          <div class="col-md-12">
                              <div class="mb-3">
                                <span class="font-weight-bold font-size-md">Tuesday</span>
                                <a href="<?=base_url('clinic/appointment/add_availability/2/'.$doctor_id); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                    + Add
                                </a>
                                <button type="button"
                                        onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url('clinic/appointment/clear_time_slots/2/'.$doctor_id)?>');"
                                        class="btn btn-outline-primary btn-sm mr-1 pull-right">
                                        Clear All
                                </button>
                              </div> 
                                <?php
                                    if ($tuesday) {
                                    foreach ($tuesday as $tuesday) {
                                ?>
                                        <div id="hide_<?= $tuesday["pkslotid"] ?>"
                                            class="col-md-12 mt-2 p-2 bg-light"
                                            style="border: 1px solid #DDD;">
                                            <span class="font-weight-bold">
                                                <?= date("h:i a", strtotime($tuesday["start_time"])) ?> - <?= date("h:i a", strtotime($tuesday["end_time"])) ?></span><a
                                                    onclick="confirmdelete('Are you sure you want to delete this time slot?','<?=base_url('clinic/appointment/delete_time_slot/'.$doctor_id.'/'.$tuesday['pkslotid']); ?>')"
                                                    class="text-danger pull-right cursor-pointer">
                                                X</a><br/>
                                            <span class="font-weight-semibold text-muted">
                                            <?= $tuesday["no_space"] ?> spaces available</span>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div> 
                      </div> 
                    </div>	

                    <div class="col-md-3 col-lg-3 mt-2 mb-1 text-left" style="border-right:2px solid #E5E5E5;">
                        <div class="row">
                          <div class="col-md-12">
                             <div class="mb-3"> 
                                <span class="font-weight-bold font-size-md">Wednesday</span>
                                <a href="<?=base_url('clinic/appointment/add_availability/3/'.$doctor_id); ?>" class="btn btn-primary btn-sm pull-right add_availability" >
                                    + Add
                                </a>
                                <button type="button"
                                        onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url('clinic/appointment/clear_time_slots/3/'.$doctor_id)?>');"
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
                                                    onclick="confirmdelete('Are you sure you want to delete this time slot?','<?=base_url('clinic/appointment/delete_time_slot/'.$wednesday['pkslotid'].'/'.$doctor_id); ?>')"
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

                    <div class="col-md-3 col-lg-3 mt-2 mb-1 text-left">
                        <div class="row">
                          <div class="col-md-12">
                           <div class='mb-3'>
                            <span class="font-weight-bold font-size-md">Thursday</span>
                                <a href="<?=base_url('clinic/appointment/add_availability/4/'.$doctor_id); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                    + Add
                                </a>
                                <button type="button"
                                        onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url('clinic/appointment/clear_time_slots/4/'.$doctor_id)?>');"
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
                                                onclick="confirmdelete('Are you sure you want to delete this time slot?','<?=base_url('clinic/appointment/delete_time_slot/'.$doctor_id.'/'.$thursday['pkslotid']); ?>')"
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
                 <!-- row-closed -->  
                </div>
               
                <div class="form-row"> 
                                         
                    <div class="col-md-3 col-lg-3 mt-2 mb-1 text-left" style="border-right:2px solid #E5E5E5;">
                        <div class="row">
                          <div class="col-md-12">
                              <div class="mb-3">
                                <span class="font-weight-bold font-size-md">Friday</span>
                                <a href="<?=base_url('clinic/appointment/add_availability/5/'.$doctor_id); ?>" class="btn btn-primary btn-sm pull-right add_availability" >
                                    + Add
                                </a>
                                <button type="button"
                                        onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url('clinic/appointment/clear_time_slots/5/'.$doctor_id)?>');"
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
                                                    onclick="confirmdelete('Are you sure you want to delete this time slot?','<?=base_url('clinic/appointment/delete_time_slot/'.$doctor_id.'/'.$friday['pkslotid']); ?>')"
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

                    <div class="col-md-3 col-lg-3 mt-2 mb-1 text-left" style="border-right:2px solid #E5E5E5;">
                        <div class="row">
                          <div class='col-md-12'>
                             <div class="mb-3">
                                <span class="font-weight-bold font-size-md">Saturday</span>
                                <a href="<?=base_url('clinic/appointment/add_availability/6/'.$doctor_id); ?>" class="btn btn-primary btn-sm pull-right add_availability">
                                    + Add
                                </a>
                                <button type="button"
                                        onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url('clinic/appointment/clear_time_slots/6/'.$doctor_id)?>');"
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
                                               ><?= date("h:i a", strtotime($saturday["start_time"])) ?> - <?= date("h:i a", strtotime($saturday["end_time"])) ?></span>
                                                <a
                                                    onclick="confirmdelete('Are you sure you want to delete this time slot?','<?=base_url('clinic/appointment/delete_time_slot/'.$doctor_id.'/'.$saturday['pkslotid']); ?>')"
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

                    <div class="col-md-3 col-lg-3 mt-2 mb-1 text-left">
                        <div class="row">
                          <div class="col-md-12">
                           <div class="mb-3">
                            <span class="font-weight-bold font-size-md">Sunday</span>
                            <a href="<?=base_url('clinic/appointment/add_availability/7/'.$doctor_id); ?>" class="btn btn-primary btn-sm pull-right add_availability" >
                                + Add
                            </a>
                            <button type="button"
                                    onclick="confirmdelete('Are you sure you want delete all Entries?','<?=base_url('clinic/appointment/clear_time_slots/7/'.$doctor_id)?>');"
                                    class="btn btn-outline-primary btn-sm mr-1 pull-right"
                                    >Clear All
                            </button>
                           </div>
                            <?php
                                if ($sunday) {
                                    foreach ($sunday as $sunday) {
                                        ?>
                                        <div id="hide_<?= $sunday["pkslotid"] ?>"
                                         class="col-md-12 mt-2 p-2 bg-light"
                                            style="border: 1px solid #DDD;">
                                            <span class="font-weight-bold"
                                                ><?= date("h:i a", strtotime($sunday["start_time"])) ?> - <?= date("h:i a", strtotime($sunday["end_time"])) ?></span><a
                                                    onclick="confirmdelete('Are you sure you want to delete this time slot?','<?=base_url('clinic/appointment/delete_time_slot/'.$doctor_id.'/'.$sunday['pkslotid']); ?>')"
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
                <!-- row-closed -->
                </div> 

          <!-- card closed --> 
        </div>

