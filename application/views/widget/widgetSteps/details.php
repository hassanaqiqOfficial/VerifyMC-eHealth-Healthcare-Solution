            <div class="row mb-2">
                <div class="col-md-12 col-lg-12">
                    <span class="text-center text-danger errormsg"></span>
                </div>
            </div>
            
            <?php if($settings['patient_type'] == 0){?>
            
            <div class="row mb-2 patientType">
                <input type="hidden" name="widgetID" id="widget_id" value="<?=md5($widgetID); ?>"> 
                <input type ="hidden" name=""  class="step_name" value="Detail">
                <input type ="hidden" name=""  class="lastIndex" value="<?=$lastindex;?>">
                <input type="hidden" name="patientID" id="patientID" value="">

                <div class="col-md-6 col-lg-6">
                    <div class="form-group mb-3 mb-md-2">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input new_patient" name="usertype" value="0" checked="" onclick="show_fields(this.value);" id="custom_radio_inline_new">
                            <label class="custom-control-label" for="custom_radio_inline_new">New Patient</label>
                        </div>
                            
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input existing_patient" name="usertype" value="1" onclick="show_fields(this.value);" id="custom_radio_inline_existing">
                            <label class="custom-control-label" for="custom_radio_inline_existing">Existing Patient</label>
                        </div>
                    </div> 
                </div>    

            </div>

            <?php } ?>

            <!--Existing-patient Details here....  -->
                                                
            <div class="row mt-3 mb-2 hidden patientDetails">
                
                <div class="col-md-6 col-lg-6">
                    <div class="title text-uppercase">Patient Details</div>
                    
                    <div class="media p-4" style="border:2px solid #e2e2e2;">
                        <div class="mr-3">
                                <img src="" class="rounded-circle mainimg mr-4" width="100px" height="100px" alt="Patient Photo">
                                <img src="<?=base_url('assets/img/placeholder.png'); ?>" class="rounded-circle mr-4 dummyimg hidden" width="100px" height="100px" alt="Patient Photo">
                        </div>
        
                        <div class="media-body" style="line-height:2.0;">
                        <h6 class="mb-0 pname"><b></b></h6>
                        <span class="pemail"><b></b></span><br>
                        <span class="pphone"><b></b></span><br>
                        <span class="pdob"><b></b> </span>
                    </div>

                    </div> 
                </div>    

            </div>  

            <!--/Existing-patient Details here....  -->


                             
            <div id="new_patient" class="mb-2">
                    
                    <div class="from-group row mt-2">
                        
                        <div class="col-md-12 col-lg-12 mt-3 mb-2">
                            <div class="text-uppercase">Patient Details</div>
                            <hr class="solid">
                        </div>

                        <div class="col-md-4 col-lg-3 col-sm-12 col-xs-12">
                            <div class="from-group">
                                <label>First Name <span class="text-danger dark"> * </span></label>
                                <div class="section">
                                <input type="text" name='name' id="name" class="form-control"  placeholder="name"> 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-3 col-sm-12 col-xs-12">
                            <div class="from-group">                                 
                                <label>Last Name <span class="text-danger dark"> * </span></label>
                                <div class="section">
                                <input type="text" name='lname' id='lname' class="form-control"  placeholder="Last Name" id="lname" > 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-3 col-sm-12 col-xs-12">
                            <div class="from-group">
                                <label>Phone <span class="text-danger dark"> * </span></label>
                                <input type="text" name='phone' id='phone' class="form-control"  placeholder="Phone"  > 
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-3 col-sm-12 col-xs-12">
                            <div class="from-group"> 
                                <label>Email <span class="text-danger dark"> * </span></label>
                                <div class="section">
                                <input type="email" name='email' id='email' class="form-control"  placeholder="Email" > 
                                </div>
                            </div>
                        </div>
                        <?php   if($settings['patient_address'] == 0)
                                {
                                   ?>
                                   
                                   <div class="col-md-4 col-lg-3 col-sm-12 col-xs-12 mt-2">
                                        <div class="from-group"> 
                                            <label>Pateint Address</label>
                                            <input type="text" name="address1" id="address1" class="form-control" required placeholder="Patient Address">                     
                                        </div>
                                    </div>
                                   <?php  
                                } 
                        ?>
                        

                        <?php   if($settings['social_security'] == 0)
                                {
                                   ?>
                                    <div class="col-md-4 col-lg-3 col-sm-12 col-xs-12 mt-2">
                                        <div class="from-group"> 
                                            <label>Social Security</label>                          
                                            <input type="text" name="social_security" id="social_security" class="form-control" required placeholder="Social Security">                     
                                        </div>
                                    </div>
                                   
                                   <?php  
                                } 
                        ?>
                        

                        <?php   if($settings['date_of_birth'] == 0)
                                {
                                   ?>
                                   
                                   <div class="col-md-4 col-lg-3 col-sm-12 col-xs-12 mt-2">
                                        <div class="from-group"> 
                                            <label>Date Of Birth</label>                          
                                            <input type="text" name="date_of_birth" id="dob" class="form-control"
                                                    value="" required placeholder="Date of birth" autocomplete="off">                     
                                        </div>
                                    </div>
                                   <?php    
                                } 
                        ?>
                        

                        <?php   if($settings['height'] == 0)
                                {
                                   ?>
                                    <div class="col-md-4 col-lg-3 col-sm-12 col-xs-12 mt-2">
                                        <div class="from-group"> 
                                            <label>Height</label>                          
                                            <input type="text" name="height" value="" id="height" class="form-control" required placeholder="Height">                 
                                        </div>
                                    </div>
                                   
                                   <?php  
                                } 
                        ?>
                        

                        <?php   if($settings['weight'] == 0)
                                {
                                   ?>
                                   
                                    <div class="col-md-4 col-lg-3 col-sm-12 col-xs-12 mt-2">
                                        <div class="from-group"> 
                                            <label>Weight</label>                          
                                            <input type="text" name="weigth" value="" id="weight" class="form-control" required placeholder="Weight">                   
                                        </div>
                                    </div>
                                   <?php  
                                } 
                        ?>
                       

                        <?php   if($settings['notify_by'] == 0)
                                {
                                   ?>
                                   
                                   <div class="col-md-4 col-lg-3 col-sm-12 col-xs-12 mt-2">
                                        <div class="from-group"> 
                                            <label>Contact Option</label>                          
                                            <div class="mb-2 checkbox">
                                                <label><input type="checkbox" name="is_sms" value="1" id="is_sms" class="ml-3"> SMS </label>
                                                &nbsp;&nbsp;&nbsp;
                                                <label><input type="checkbox" name="is_email" value="1" id="is_email" class=""> Email </label>
                                            </div>                    
                                        </div>
                                    </div>
                                   <?php  
                                } 
                        ?>
                        

                    </div>


                    <div class="form-group row mt-4">
                        <div class="col-md-12">
                            <div class="text-uppercase">DRIVERS LICENSE OR STATE ID / Medical record / proof residency And Patient Photo
                                (Optional)
                            </div>
                            <hr class="solid">
                        </div>
                    </div>

                    <div class="form-group row">
                        
                        <?php   
                                if($settings['patient_id_card'] == 0 && $settings['driving_license'] == 0)
                                {
                                   ?>
                                   
                                    <div class="col-md-4">

                                        <div class="card br-a" >
                                            <div class="br-n card-body">
                                                <label>Drivers Lic Or State ID - Front</label>
                                                <div class="card br-a" id="upload_panel1234">

                                                <div class="card-body">

                                                    <div class="col-xs-12 hidden" id="image_cont_stateid">
                                                        <img src="" style="max-width: 100%;">
                                                        <a id="delete_image_cont_stateid" class="fs12 delete_image "><i class="fa fa-close"></i></a>
                                                        <input type="hidden" name="idcard_url_front"  <?php if($settings['required_field_id'] == 0){ echo "required"; } ?> id="image">

                                                    </div>

                                                    <div class="col-xs-12 " id="control_cont_stateid">
                                                        <button type="button" id="upload_button_stateid_front"
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

                                        <div class="card br-a">
                                            <div class="br-n card-body">
                                                <label>Drivers Lic Or State ID - Back</label>
                                                <div class="card br-a" id="upload_panel1234">

                                                    <div class="card-body">


                                                        <div class="col-xs-12 hidden" id="image_cont_stateid_back">
                                                            <img src="" style="max-width: 100%;">
                                                            <a id="delete_image_cont_back" class="fs12 delete_image "><i class="fa fa-close"></i></a>
                                                            <input type="hidden" name="idcard_url_back" <?php if($settings['required_field_id'] == 0){ echo "required"; } ?> id="image_back">

                                                        </div>

                                                        <div class="col-xs-12 " id="control_cont_stateid_back">
                                                            <button type="button" id="upload_button_stateid_back"
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

                                   <?php  
                                } 
                        ?>
                       

                        <?php   
                                if($settings['patient_photo'] == 0 )
                                {
                                   ?>
                                   
                                    <div class="col-md-4">

                                        <div class="card br-a">
                                            <div class="br-n card-body">
                                                <label>Patient Photo (Required For ID Card)</label>
                                                <div class="card br-a" id="upload_panel1234">

                                                    <div class="card-body">


                                                        <div class="col-xs-12 hidden" id="image_cont_stateid_photo">
                                                            <img src="" style="max-width: 100%;">

                                                            <a id="delete_image_cont_photo" class="fs12 delete_image "><i class="fa fa-close"></i></a>
                                                            <input type="hidden" name="patient_photo" <?php if($settings['patient_photo_required'] == 0){ echo "required"; } ?> id="patient_photo"
                                                                 aria-required="true">

                                                        </div>
                                                        <div class="col-xs-12 " id="control_cont_stateid_photo">
                                                            <button type="button" id="upload_button_patient_photo"
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

                                   <?php  
                                } 
                            ?>

                            <?php   
                                if($settings['upload_medical_record'] == 0)
                                {
                            ?>
                                   <div class="col-md-4">

                                        <div class="card br-a" >
                                            <div class="br-n card-body">
                                                <label>Medical Record</label>
                                                <div class="card br-a" id="upload_panel12345">

                                                <div class="card-body">


                                                    <div class="col-xs-12 hidden" id="image_cont_medical_record">
                                                        <img src="" style="max-width: 100%;">
                                                        <a id="delete_image_cont_medical_record" class="fs12 delete_image "><i class="fa fa-close"></i></a>
                                                        <input type="hidden" name="medical_record"  id="medical_record">

                                                    </div>
                                                    <div class="col-xs-12 " id="control_cont_medical_record">
                                                        <button type="button" id="upload_button_medical_record"
                                                                data-ip-modal="#avatarModal_medical_record" class="btn btn-md mv10"
                                                                style="background-color: white;border-radius: 5px !important;border-color: rgba(0, 0, 0, 0.1);">
                                                            Upload
                                                        </button>
                                                    </div>

                                                </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                   
                                   <?php  
                                } 
                        ?>
                        

                        <?php   
                                if($settings['patient_proof_residency'] == 0)
                                {
                                   ?>
                                   <div class="col-md-4">

                                    <div class="card br-a">
                                        <div class="br-n card-body">
                                            <label>Proof Residency</label>
                                            <div class="card br-a" id="upload_panel123456">

                                                <div class="card-body">


                                                    <div class="col-xs-12 hidden" id="image_cont_proof_residency">
                                                        <img src="" style="max-width: 100%;">
                                                        <a id="delete_image_proof_residency" class="fs12 delete_image "><i class="fa fa-close"></i></a>
                                                        <input type="hidden" name="patient_proof_residency" id="proof_residency">

                                                    </div>

                                                    <div class="col-xs-12 " id="control_cont_proof_residency">
                                                        <button type="button" id="upload_button_proof_residency"
                                                                data-ip-modal="#avatarModal_proof_residency"
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
                                   
                            <?php } ?>
                        

                    </div>

                    <?php 
                    
                        if($settings['custom_question_option'] == 0){
                        
                    ?>

                    <div class="form-group row"> 
                        
                        <div class="col-md-12 col-lg-12 mt-4">
                            <div class="text-uppercase"><?=$settings['custom_form_title'];?></div>
                            <hr class="solid">
                        </div>

                        <?php 
                            
                            if($questions != "")
                            { 
                                $counterMain = 0;
                                $counter = 0;
                               
                                foreach($questions as $question)
                                {
                                    $options = isset($question['options']) ? explode(" ",$question['options']) : " " ;

                        ?>
                       
                        <div class="col-md-6 col-lg-6 col-sm-6 mt-2">
                    
                            <div class="from-group mb-3 mb-md-2"> 
                                
                              <label><?=$question['title'];?>
                                <?php if($question['required'] == 0){ ?>
                                  <span class="text-danger dark"> * </span>
                                <?php } ?>  
                              </label>

                                <?php if($question['recommendation_type'] == 0){  ?>
                                    <input type="text" name='questions[<?=$counterMain; ?>][answer]' class="form-control"  placeholder="<?=$question['title']."..."; ?>" <?php if($question['required'] == 0){echo "required"; }?> > 
                                    <input type="hidden" name="questions[<?=$counterMain; ?>][question]" value="<?=$question['title']; ?>"> 
                                    <input type="hidden" name='questions[<?=$counterMain; ?>][type]' value="0" > 
                                <?php 
                                  }
                                  if($question['recommendation_type'] == 1)
                                  {
                                      
                                    if($options != ""){ ?>
                                        
                                    <input type="hidden" name="questions[<?=$counterMain; ?>][question]" value="<?=$question['title']; ?>"> 
                                    <input type="hidden" name='questions[<?=$counterMain; ?>][type]' value="1" > 
                                      <?php
                                          foreach($options as $option){
                                          
                                     ?>
                                      
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input custom_question_radio" name="questions[<?=$counterMain; ?>][answer]" value="<?=$option ; ?>" <?php if($question['required'] == 0){echo "required"; }?>  id="custom_question_radio_<?=$counter;?>">
                                        <label class="custom-control-label" for="custom_question_radio_<?=$counter;?>"><?=$option ; ?></label>
                                    </div>
                                   
                                     
                                <?php $counter++; }  } }
                                  if($question['recommendation_type'] == 2)
                                  {
                                  
                                    if($options != ""){
                                        ?>
                                    <input type="hidden" name="questions[<?=$counterMain; ?>][question]" value="<?=$question['title']; ?>"> 
                                    <input type="hidden" name='questions[<?=$counterMain; ?>][type]' value="2" >
                                    <?php
                                        foreach($options as $option){
                                ?>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input custom_question_checkbox" name="questions[<?=$counterMain; ?>][answer][]" value="<?=$option ; ?>" <?php if($question['required'] == 0){echo "required"; }?> id="custom_question_checkbox_<?=$counter;?> ">
                                        <label class="custom-control-label" for="custom_question_checkbox_<?=$counter;?> "><?=$option ; ?></label>
                                    </div>
                                 
                                <?php
                                 $counter++; } } }
                                  if($question['recommendation_type'] == 3)
                                  {
                                ?>
                                
                                <input type="hidden" name="questions[<?=$counterMain; ?>][question]" value="<?=$question['title']; ?>"> 
                                <input type="hidden" name='questions[<?=$counterMain; ?>][type]' value="3" >
                                <select name="questions[<?=$counterMain; ?>][answer]" class="form-control" <?php if($question['required'] == 0){echo "required"; }?> >
                                   <option value="">Select</option> 
                                   <?php 
                                          if($options != ""){
                                             foreach($options as $options_sels){
                                   ?>
                                   <option value="<?=$options_sels; ?> "><?=$options_sels; ?></option>
                                       
                                    <?php } } ?>   
                                </select> 
                                <?php 
                                    } 
                                    if($question['recommendation_type'] == 4)
                                    { 
                                ?>
                                <input type="hidden" name="questions[<?=$counterMain; ?>][question]" value="<?=$question['title']; ?>"> 
                                <input type="hidden" name='questions[<?=$counterMain; ?>][type]' value="4" >
                                <textarea name="questions[<?=$counterMain; ?>][answer]" rows="6" class="form-control" placeholder="<?=$question['title'];?>" <?php if($question['required'] == 0){echo "required"; }?> ></textarea>
                                <?php } ?>  
                            </div>

                        </div>
                       
                       <?php $counterMain++; } } ?>

                    </div>

                    <?php } ?>

            </div>
                         
            <div id="existing_patient" class="hidden">
                
                <div class="row mt-2">
                    
                    <div class="col-md-6 col-lg-6">
                        <div class="from-group">
                            <label class="">Login Email</label>
                            <input type="text" name="user_email" id="loginEmail"  class="form-control" placeholder="Enter your login email address" />
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-6">
                        <div class="from-group">
                            <label class="">Login Password</label>
                            <input type="password" name="user_pass" id="loginPass" value="" class="form-control" placeholder="Enter your login password" />
                        </div>
                    </div>

                </div>

                <div class="row mt-2">
                    <div class="col-md-6 col-lg-6">
                        <button type="button" class="btn btn-primary btn-sm loginUser">Login</button>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <a href="javascript:void(0)" class="forgotPass">Forgot Password</a>
                        <label for="showPass" class="pull-right">Show Password</label>
                        <input type="checkbox" name="" id="showPass" class="pull-right mr-2 mt-1">
                    </div>
                </div>

            </div>

            
            <div id="patient_emailPhone">
                
                <div class="row mt-2 mb-2">
                
                    <div class="hidden col-md-6 col-lg-6" id="phone_exists">
                        <div class="from-group"> 
                            <label class="">Phone</label>
                            <input type="text" name="phone_exist" value="" placeholder="Phone" class="gui-input form-control" id="phone_exist" aria-required="true">
                        </div>  
                    </div>
                    
                    <div class="hidden col-md-6 col-lg-6" id="email_exists">                  
                        <label class="">Email</label>
                        <input type="text" name="email_exist" value="" placeholder="Email" class="gui-input form-control" id="email_exist" aria-required="true">
                    </div>
                    
                </div>

            </div>

        
            <div class="row mt-2 hidden" id="forgotPass">
                
                <div class="col-md-12 col-lg-12" >
                <h3 class="text-center">Forgot password</h3>
                <p class="text-center">Resetting your password is just easy to reset.<br/> Enter your email in below text field.</p>
                </div>

                <div class="col-md-12 col-lg-12">
                    <div class="row mt-2" >

                    <div class="col-md-4 col-lg-4"></div>

                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label>User Email</label>
                                <input type="email" name="forPass" class="form-control" placeholder="Enter your login email...">
                            </div>
                        </div>

                    <div class="col-md-4 col-lg-4"></div>

                    </div>  
                </div>

                <div class="col-md-12 col-lg-12">
                    <div class="row mt-2" >

                    <div class="col-md-4 col-lg-4"></div>

                        <div class="col-md-4 col-lg-4">
                            <button type="button" class="btn btn-primary btn-sm sendMail pull-right">Send Email</button>
                            <a href="javascript:void(0)" class="pull-right mr-2 mt-2 backtologin">Back to login</a>
                        </div>

                    <div class="col-md-4 col-lg-4"></div>

                    </div>  
                </div>  

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

            <div class="ip-modal" id="avatarModal_medical_record" style="display:none;">
                <div class="ip-modal-dialog">
                    <div class="ip-modal-content border-top-0">
                        <div class="ip-modal-header">
                            <a class="ip-close" title="Close">&times;</a>
                            <h4 class="ip-modal-title">Patient Medical Record</h4>
                        </div>
                        <div class="ip-modal-body">
                            <div class="">Upload <input type="file" name="medical_record" <?php if($settings['field_required'] == 0){ echo "required"; } ?> class=""></div>

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

            <div class="ip-modal" id="avatarModal_proof_residency" style="display:none;">
                <div class="ip-modal-dialog">
                    <div class="ip-modal-content border-top-0">
                        <div class="ip-modal-header">
                            <a class="ip-close" title="Close">&times;</a>
                            <h4 class="ip-modal-title">Patient Proof Residency</h4>
                        </div>
                        <div class="ip-modal-body">
                            <div class="">Upload <input type="file" name="proof_residency" <?php if($settings['patient_proof_required'] == 0){ echo "required"; } ?> class="ip-file"></div>

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
            
        

        <script type="text/javascript">

            function show_fields(val)
            {   
                if(val == 1)
                {
                    $("#new_patient").addClass("hidden");
                    $("#existing_patient").removeClass("hidden");  
                }
                else
                {
                    $("#existing_patient").addClass("hidden");
                    $("#patient_emailPhone").addClass("hidden");
                    $(".patientDetails").addClass("hidden");
                    $("#new_patient").removeClass("hidden");
                    $(".errormsg").html("");
                }
            }
            
            $(function(){

                $("#dob").datepicker();
              
                $(".loginUser").on("click",function(){
                  
                   var email = $("#loginEmail").val();
                   var pass = $("#loginPass").val(); 
                   
                   $("#loginUser").html("<i class='fa fa-refresh-o'></i> loading ...");
                   $("#loginUser").attr("disabled");

                   $.post('<?=base_url('widgets/user_authentication/');?>',{UserName : email,Pass : pass},function(data){
                        
                        dataArray = JSON.parse(data); 
                        //console.log(dataArray);
                        if(dataArray.error == true)
                        {
                            $("#loginUser").html("Login");
                            $("#loginUser").removeAttr("disabled");

                            $("#loginEmail").val('');
                            $("#loginPass").val('');
                            $(".errormsg").html("<i class='fa fa-times mr-2' id='removerror' aria-hidden='true'></i>Invalid username or password.Please try with valid credential.");
                        }
                        else
                        {
                            $("#existing_patient").addClass("hidden");
                            $(".patientDetails").removeClass("hidden");
                            $(".new_patient").attr("disabled");
                            $(".errormsg").html('');

                          if(dataArray.patientPhoto != null)
                          {
                              $("img.mainimg").attr("src","<?=base_url();?>"+dataArray.patientPhoto);
                          }
                          else
                          {
                              $("img.mainimg").addClass("hidden");
                              $("img.dummyimg").removeClass("hidden");
                          }
                          $(".pname").html("Patient Name : "+dataArray.patientName);
                          $(".pemail").html("Patient Email : "+dataArray.patientEmail);
                          $(".pphone").html("Patient Phone : "+dataArray.patientPhone);
                          $(".pdob").html("Patient DOB : "+dataArray.patientDob);

                          if (dataArray.patientID) {

                            $("#patientID").val(dataArray.patientID);
                            if(dataArray.patientEmail == "" && dataArray.patientPhone != "")
                            {
                                $("#email_exists").removeClass('hidden');
                                $("#phone_exists").addClass('hidden');
                                $("#email_exist").val('');
                            }
                            else if(dataArray.patientPhone == "" && dataArray.patientEmail != "")
                            {   $("#phone_exists").removeClass('hidden');
                                $("#email_exists").addClass('hidden');
                                $("#phone_exist").val('');
                            }
                            else if(dataArray.patientPhone == "" && dataArray.patientEmail == "")
                            {
                                $("#email_exists").removeClass('hidden');
                                $("#phone_exists").removeClass('hidden');
                                $("#email_exist").val('');
                                $("#phone_exist").val('');
                            } 
                            else if(dataArray.patientPhone != "" && dataArray.patientEmail != "")
                            {
                                $("#email_exists").addClass('hidden');
                                $("#phone_exists").addClass('hidden');
                            }
                            
                          } 
                        }
                        
                   });
                });

                $("#removerror").on("click",function(e){
                    alert("Hello world");
                    $(".errormsg").html("");
                });

                $("#showPass").on("change",function(e){
                  
                    var type = $("#loginPass").attr('type');
                    var pass = $(this).val();
                   
                    if(type === "password")
                    {
                        $("#loginPass").attr('type',"text");
                    }
                    else
                    {
                        $("#loginPass").attr('type',"password");
                    }
                });


                $(".forgotPass").on("click",function(){
                    $("#existing_patient").addClass("hidden");
                    $(".patientType").addClass("hidden");
                    $("#forgotPass").removeClass("hidden");
                });
                
                $(".backtologin").on("click",function(){
                   $("#forgotPass").addClass("hidden");
                   $(".patientType").removeClass("hidden");
                   $("#existing_patient").removeClass("hidden");
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

                $('#upload_button_medical_record').on("click",function(){
                    
                    $("#avatarModal_medical_record").modal('show');

                });

                $('#upload_button_proof_residency').on("click",function(){
                    
                    $("#avatarModal_proof_residency").modal('show');

                });

                
                $(".ip-close").on("click",function(){
                    $("#avatarModal_medical_record").modal('hide');
                    $("#avatarModal_proof_residency").modal('hide');
                });
                
                $(document).on("click","#delete_image_cont_stateid", function(){
                    $("#image_cont_stateid").addClass('hidden');
                    $("#control_cont_stateid").removeClass("hidden")
                    $(".ip-edit").css("display", "none");
                    $(".ip-delete").css("display", "none");
                    $("#image").val("");
                    alert('Image deleted successfully');
                });


                $(document).on("click","#delete_image_cont_back", function(){
                    $("#image_cont_stateid_back").addClass('hidden');
                    $("#control_cont_stateid_back").removeClass("hidden")
                    $(".ip-edit").css("display", "none");
                    $(".ip-delete").css("display", "none");
                    $("#image_back").val("");
                    alert('Image deleted successfully');
                });


                $(document).on("click","#delete_image_cont_photo", function(){
                    $("#image_cont_stateid_photo").addClass('hidden');
                    $("#control_cont_stateid_photo").removeClass("hidden")
                    $(".ip-edit").css("display", "none");
                    $(".ip-delete").css("   display", "none");
                    $("#patient_photo").val("");
                    alert('Image deleted successfully');
                });
             
            });


        </script>