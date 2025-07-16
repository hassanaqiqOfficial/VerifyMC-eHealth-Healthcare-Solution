@extends('layout.master_clinic')
@section('title','Edit Appointment Category')
@section('content')
 <style>
 	span.radio{
			float: left;
		    margin-top: 10px !important;
		}
	.col-md-6 {
             width: 50%;
           }	
 </style>
   <div class="content-wrapper">

      <!-- Page header -->
      <div class="page-header page-header-light">
         <div class="page-header-content header-elements-md-inline">
               <div class="d-flex page-title pb-2 pt-2">
                  <h4> <span class="font-weight-semibold"><?=$page_title?></span></h4>
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

    <!-- Content --> 
	    <section class="content">
         
          <div class="card">
            
            <div class="card-body">
             
              <form role="form" class="form-groups-bordered" action="<?php base_url('clinic/appointment/edit_appointment_category/'.$category['pk_app_categoryid']);?>" method="post" enctype="multipart/form-data" id="myform">
               
                <div class="form-row">
	              <div class="col-md-12 col-lg-12">
	              	  
                        <div class="form-group row">
		                     <label class="col-form-label col-md-2 col-lg-2" style="font-size:14px;">Select Physician</label>
	                       	  <div class="col-lg-4 col-md-4">
	                          <select name="doctor_id" class="form-control">
                             <?php if($doctors){
                                  foreach($doctors as $doctor){

                            ?>
                             <option value="<?=$doctor['doctor_user_id'];?>" <?php if($category['doctor_id'] == $doctor['doctor_user_id']){echo "selected"; }?>><?=$doctor['doctor_name'];?></option>
                            <?php } } ?>
                            </select>
                           </div>
                         
                           <label class="col-form-label col-md-2 col-lg-2" style="font-size:14px;">Enter Category Name</label>
	                       	  <div class="col-lg-4 col-md-4">
	                          <input type="text" name="app_category_name" value="<?php echo $category['name']; ?>" placeholder="Category Name" class="form-control">
		                     </div>
                          </div>

		                 </div>
		               </div>
	                  
                     
	                   <div class="row pl-2">
                        <div class="col-md-12 col-lg-12"> 
                          <h5 class="title">Select Category Color</h5>
                          <hr style="margin-top:0px;margin-bottom: 20px;">
                         </div>
                       </div>

                        <div class="row mt-2"> 
                          <div class="col-md-6 col-lg-6">
                          	<div class="option-group field">
                            <label class="option option-primary col-md-10">
                             <label class="label btn btn-xs update_status" for="light_red" style="background-color: #FFEDED;
                              color: #736A6B;">
                              <span class="radio"></span>
                              <input type="radio" name="app_cat_color" id="light_red" value="#FFEDED _#736A6B_Light Red" <?php if($category['app_cat_color'] == '#FFEDED _#736A6B_Light Red'){echo "checked";} ?> >
                              Light Red</label>
                            </label>
                           </div>
                          </div> 

                      <div class="col-md-6 col-lg-6">
                         <div class="option-group field">
                            <label class="option option-primary col-md-10" for="red_input_label">
                              <label class="label btn btn-xs update_status" for="red" style="background-color: #EC5657;
                              color: white;">
                              <input type="radio" name="app_cat_color" value="#EC5657_red Red" id="red" <?php if($category['app_cat_color'] == '#EC5657_red Red'){echo "checked";} ?> id="red_input_label">
                              <span class="radio"></span>
                              Red (Cancel)</label>
                            </label>
                         </div>
                       </div>	
                    </div>

                               <div class="row ">
                                  <div class="col-md-6 col-lg-6">
                                     <div class="option-group field">
                                       <label class="option option-primary col-md-10">
                                              <label class="label btn btn-xs update_status" for="light_orange" style="background-color: #FFEEDA;
                                              color: #736A6B;">
                                              <input type="radio" name="app_cat_color" id="light_orange" value="#FFEEDA_#736A6B_Light Orange" <?php if($category['app_cat_color'] == '#FFEEDA_#736A6B_Light Orange'){echo "checked";} ?> >
                                              <span class="radio"></span>
                                              Light Orange</label>
                                          </label>
                                     </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                     <div class="option-group field">
                                       <label class="option option-primary col-md-10">
                                              <label class="label btn btn-xs update_status" for="orange" style="background-color: #FFA952;
                                              color: white;">
                                              <input type="radio" name="app_cat_color" id="orange" value="#FFA952_white_Orange" <?php if($category['app_cat_color'] == '#FFA952_white_Orange'){echo "checked";} ?> >
                                              <span class="radio"></span>
                                              Orange</label>
                                          </label>
                                     </div>
                                  </div>
                                  
                              </div>
                              
                              <div class="row ">
                                  <div class="col-md-6 col-lg-6">
                                     <div class="option-group field">
                                       <label class="option option-primary col-md-10">
                                       <label class="label btn btn-xs update_status" for="light_blue" style="background-color: #E8F2FE;
                                         color: #736A6B;">
                                              <input type="radio" name="app_cat_color" id="light_blue" value="#E8F2FE_#736A6B_Light Blue" <?php if($category['app_cat_color'] == '#E8F2FE_#736A6B_Light Blue'){echo "checked";} ?> >
                                              <span class="radio"></span>
                                              Light Blue</label>
                                       </label>
                                     </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                     <div class="option-group field">
                                       <label class="option option-primary col-md-10">
                                       <label class="label btn btn-xs update_status" for="blue" style="background-color: #47AEF0;
                                          color: white;">
                                              <input type="radio" name="app_cat_color" id="blue" value="#47AEF0_white_Blue" <?php if($category['app_cat_color'] == '#47AEF0_white_Blue'){echo "checked";} ?> >
                                              <span class="radio"></span>
                                              Blue</label>
                                       </label>
                                     </div>
                                  </div>
                                  
                              </div>
                              
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                     <div class="option-group field">
                                       <label class="option option-primary col-md-10">
                                       <label class="label btn btn-xs update_status" for="light_purple" style="background-color: #F6EDFF;
                                         color: #736A6B;">
                                              <input type="radio" name="app_cat_color" id="light_purple" value="#F6EDFF_#736A6B_Light Purple" <?php if($category['app_cat_color'] == '#F6EDFF_#736A6B_Light Purple'){echo "checked";} ?> >
                                              <span class="radio"></span>
                                              Light Purple</label>
                                          </label>
                                     </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                     <div class="option-group field">
                                       <label class="option option-primary col-md-10">
                                       <label class="label btn btn-xs update_status" for="purple" style="background-color: #AC7ADD;
                                          color: white;">
                                              <input type="radio" name="app_cat_color" id="purple" value="#AC7ADD_white_Purple" <?php if($category['app_cat_color'] == '#AC7ADD_white_Purple'){echo "checked";} ?> >
                                              <span class="radio"></span>
                                              Purple</label>
                                          </label>
                                     </div>
                                  </div>
                                  
                              </div>
                              
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                     <div class="option-group field">
                                       <label class="option option-primary col-md-10">
                                       <label class="label btn btn-xs update_status" for="light_green" style="background-color: #EFF9EE;
                                         color: #736A6B;">
                                              <input type="radio" name="app_cat_color" id="light_green" value="#EFF9EE_#736A6B_Light Green"  <?php if($category['app_cat_color'] == '#EFF9EE_#736A6B_Light Green'){echo "checked";} ?> >
                                              <span class="radio"></span>
                                              Light Green</label>
                                          </label>
                                     </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                     <div class="option-group field">
                                       <label class="option option-primary col-md-10">
                                       <label class="label btn btn-xs update_status" for="green" style="background-color: #7EB476;
                                          color: white;">
                                              <input type="radio" name="app_cat_color" id="green" value="#7EB476_white_Green" <?php if($category['app_cat_color'] == '#7EB476_white_Green'){echo "checked";} ?> > 
                                              <span class="radio"></span>
                                              Green</label>
                                          </label>
                                     </div>
                                  </div>
                                  
                              </div>
                              
                              <div class="row ">
                                  <div class="col-md-6 col-lg-6">
                                     <div class="option-group field">
                                       <label class="option option-primary col-md-10">
                                       <label class="label btn btn-xs update_status" for="light_yellow" style="background-color: #FEFFDB;
                                         color: #736A6B;">
                                              <input type="radio" name="app_cat_color" id="light_yellow" value="#FEFFDB_#736A6B_Light Yellow" <?php if($category['app_cat_color'] == '#FEFFDB_#736A6B_Light Yellow'){echo "checked";} ?> >
                                              <span class="radio"></span>
                                             Light Yellow</label>
                                          </label>
                                     </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                     <div class="option-group field">
                                       <label class="option option-primary col-md-10">
                                       <label class="label btn btn-xs update_status" for="yellow" style="background-color: #F5EA7E;
                                          color: #736A6B;">
                                              <input type="radio" name="app_cat_color" id="yellow" value="#F5EA7E_#736A6B_Yellow" <?php if($category['app_cat_color'] == '#F5EA7E_#736A6B_Yellow'){echo "checked";} ?> >
                                              <span class="radio"></span>
                                             Yellow</label>
                                          </label>
                                     </div>
                                  </div>
                              </div>    
	                      <button type="submit" class="btn btn-sm btn-primary">Save</button>
                      <a href="<?=base_url('clinic/appointment/manage_appointment_category/')?>" class="btn btn-sm btn-primary">Back</a>

	            </form>
              </div>
          
          </div>
       </section>
     </div> 

@endsection 
@section('scripts')
@endsection      