@extends('layout.master_doctor')
@section('title','Edit Service')
@section('bodyClass', 'sidebar-right-visible')
@section('content')


   <?php require ("application/views/doctor/appointment/appointment_setting_sidebar.php")?>

   <div class="content-wrapper">

       <!-- Page header -->
       <div class="page-header page-header-light">
              <div class="page-header-content header-elements-md-inline">
                  <div class="d-flex page-title pb-2 pt-2">
                      <h4> <span class="font-weight-semibold">Edit Service</span></h4>
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
            
            <div class="card-body">
             
                    <form role="form" class="form-groups-bordered admin-form-validate" action="" method="post" enctype="multipart/form-data" id="myform">
                    
                        <div class="form-row">
                            <div class="col-md-12 col-lg-12">
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2 col-lg-2" style="font-size:14px;">Title</label>
                                    <div class="col-lg-6 col-md-6">
                                    <input type="text" name="title" value="<?=$service['title'];?>"  placeholder="Service Title" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2 col-lg-2" style="font-size:14px;">Category</label>
                                    <div class="col-lg-6 col-md-6">
                                    <select name="category" class="form-control">
                                     <option  value="" selected="selected">Select category</option>
                                     <?php 
                                     
                                        if($categories){
                                           
                                            foreach($categories as $category){

                                               ?>
                                                
                                                <option value="<?=$category['pk_app_categoryid']; ?>" <?php if($category['pk_app_categoryid'] == $service['fk_category_id']){echo "selected"; }?> ><?=$category['name']; ?></option>
                                               <?php  
                                            } 
                                         
                                     } ?>
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2 col-lg-2" style="font-size:14px;">Color</label>
                                    <div class="col-lg-6 col-md-6">
                                    <input type="color" name="color"  placeholder="Select a color" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2 col-lg-2" style="font-size:14px;">Price</label>
                                    <div class="col-lg-6 col-md-6">
                                    <input type="text" name="price" value="<?=$service['price'];?>"  placeholder="Service price" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2 col-lg-2" style="font-size:14px;">Service Info</label>
                                    <div class="col-lg-6 col-md-6">
                                    <textarea type="text" name="info"  placeholder="Start Typing here..." rows="7" class="form-control"><?=$service['info'];?></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                       <hr class="solid">    
                       <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                       <a href="<?=base_url('doctor/appointment/services/')?>" class="btn btn-sm btn-primary">Back</a>

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
        title:{
            required:true
        }, 
        color:{
            required:true
        },
        category:{
            required:true
        }, 
        price: {
            required:true
        }
    },

    messages: {
          
           title:{
               required : "Please enter the title." 
           }, 
           category:{
                required : "Please select a category from dropdown." 
            } 
        },

    });

});

</script>
@endsection      