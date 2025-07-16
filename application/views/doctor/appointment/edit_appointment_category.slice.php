@extends('layout.master_doctor')
@section('title','Add Appointment Category')
@section('bodyClass', 'sidebar-right-visible')
@section('content')

 <style>
     .custom-control-label::before {
         top: .55002rem;
     }
     .custom-control-label::after {
         top: .55002rem;
     }
 </style>
    
   <?php require ("application/views/doctor/appointment/appointment_setting_sidebar.php")?>

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
                          <button type="submit" class="btn btn-outline-primary btn-sm" form="myform"><span>Save</span></button>
                      </div>
                  </div>

              </div>
          </div>
          <!-- /page header -->

	    <section class="content">
          <div class="card">
           
            <div class="card-body">
             
              <form id="myform" class="form-groups-bordered admin-form-validate" action="" method="post" enctype="multipart/form-data" id="form">
               
                  <div class="row">
	                  <div class="col-md-12 col-lg-12">
	              	 
		              	  <div class="form-group row">
		                    <label class="col-form-label col-md-2 col-lg-2" style="font-size:14px;">Enter Category Name</label>
	                       	 <div class="col-lg-6 col-md-6">
	                          <input type="text" name="app_category_name" placeholder="Category Name" value="<?php echo $category['name']; ?>" class="form-control">
		                       </div>
		                   </div>

		                 </div>
		               </div>
	                    
                      


                  <div class="form-row ">
                      <div class="col-md-12 col-lg-12">
                          <h5 class="title">Select Category Color</h5>
                          <hr class="solid">
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" name="app_cat_color" id="light_red" value="#FFEDED_#736A6B_Light Red" <?php if($category['app_cat_color'] == '#FFEDED_#736A6B_Light Red'){echo "checked";} ?>>
                                  <label class="custom-control-label min p-2 rounded" for="light_red" style="background-color: #FFEDED;color: #736A6B;min-width: 180px;">Light Red</label>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" name="app_cat_color" id="light_orange" value="#FFEEDA_#736A6B_Light Orange" <?php if($category['app_cat_color'] == '#FFEEDA_#736A6B_Light Orange'){echo "checked";} ?>>
                                  <label class="custom-control-label min p-2 rounded" for="light_orange" style="background-color: #FFEEDA;color: #736A6B;min-width: 180px;">Light Orange</label>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" name="app_cat_color" id="light_blue" value="#E8F2FE_#736A6B_Light Blue" <?php if($category['app_cat_color'] == '#E8F2FE_#736A6B_Light Blue'){echo "checked";} ?>>
                                  <label class="custom-control-label min p-2 rounded" for="light_blue" style="background-color: #E8F2FE;color: #736A6B;min-width: 180px;">Light Blue</label>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" name="app_cat_color" id="light_purple" value="#F6EDFF_#736A6B_Light Purple" <?php if($category['app_cat_color'] == '#F6EDFF_#736A6B_Light Purple'){echo "checked";} ?>>
                                  <label class="custom-control-label min p-2 rounded" for="light_purple" style="background-color: #F6EDFF;color: #736A6B;min-width: 180px;">Light Purple</label>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" name="app_cat_color" id="light_green" value="#EFF9EE_#736A6B_Light Green" <?php if($category['app_cat_color'] == '#EFF9EE_#736A6B_Light Green'){echo "checked";} ?>>
                                  <label class="custom-control-label min p-2 rounded" for="light_green" style="background-color: #EFF9EE;color: #736A6B;min-width: 180px;">Light Green</label>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" name="app_cat_color" id="light_yellow" value="#FEFFDB_#736A6B_Light Yellow" <?php if($category['app_cat_color'] == '#FEFFDB_#736A6B_Light Yellow'){echo "checked";} ?>>
                                  <label class="custom-control-label min p-2 rounded" for="light_yellow" style="background-color: #FEFFDB;color: #736A6B;min-width: 180px;">Light Yellow</label>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                              <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" name="app_cat_color" id="red" value="-" disabled>
                                  <label class="custom-control-label min p-2 rounded" for="red" style="background-color: #EC5657;color: #fff;min-width: 180px;">Red (Reserved for Cancelled)</label>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" name="app_cat_color" id="orange" value="#FFA952_white_Orange" <?php if($category['app_cat_color'] == '#FFA952_white_Orange'){echo "checked";} ?>>
                                  <label class="custom-control-label min p-2 rounded" for="orange" style="background-color: #FFA952;color: #fff;min-width: 180px;">Orange</label>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" name="app_cat_color" id="blue" value="#47AEF0_white_Blue" <?php if($category['app_cat_color'] == '#47AEF0_white_Blue'){echo "checked";} ?>>
                                  <label class="custom-control-label min p-2 rounded" for="blue" style="background-color: #47AEF0;color: #fff;min-width: 180px;">Blue</label>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" name="app_cat_color" id="purple" value="#AC7ADD_white_Purple" <?php if($category['app_cat_color'] == '#AC7ADD_white_Purple'){echo "checked";} ?>>
                                  <label class="custom-control-label min p-2 rounded" for="purple" style="background-color: #AC7ADD;color: #fff;min-width: 180px;">Purple</label>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" name="app_cat_color" id="green" value="#7EB476_white_Green" <?php if($category['app_cat_color'] == '#7EB476_white_Green'){echo "checked";} ?>>
                                  <label class="custom-control-label min p-2 rounded" for="green" style="background-color: #7EB476;color: #fff;min-width: 180px;">Green</label>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" name="app_cat_color" id="yellow" value="#F5EA7E_#736A6B_Yellow" <?php if($category['app_cat_color'] == '#F5EA7E_#736A6B_Yellow'){echo "checked";} ?>>
                                  <label class="custom-control-label min p-2 rounded" for="yellow" style="background-color: #F5EA7E;color: #736A6B;min-width: 180px;">Yellow</label>
                              </div>
                          </div>
                      </div>
                  </div>


                            <hr class="solid">
	                      <button type="submit" class="btn btn-sm btn-primary">Save</button>
                      <a href="<?=base_url('doctor/appointment/manage_appointment_category/')?>" class="btn btn-sm btn-primary">Back</a>

	            </form>
              </div>
          
          </div>
       </section>
     </div> 

@endsection 
@section('scripts')
<script type="text/javascript" src="<?=base_url('assets/global_assets/js/plugins/forms/validation/validate.min.js'); ?>"></script>

<script type="text/javascript">
  
  $(document).ready(function(){

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
        app_category_name: {
            required: true,
        },
        app_cat_color :{
            required: true,
        }     
    },

    messages: {
          
        app_category_name:{
               required : "Please enter the category name." 
           },
        app_cat_color :{
            required: "Please select a color for this category.",
          }  
        },


    });

    // Initialize with tags
    $('.select-multiple-drag').select2({
            
    });


});

</script>
@endsection      