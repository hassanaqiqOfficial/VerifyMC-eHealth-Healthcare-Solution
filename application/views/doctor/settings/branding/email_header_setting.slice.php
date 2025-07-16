@extends('layout.master_doctor')
@section('title', 'Email Header')
@section('bodyClass','sidebar-right-visible')
@section('content')

<?php require ("application/views/doctor/settings/branding/sidebar_secondary.php"); ?>

<div class="content-wrapper">

     <!-- Page header -->
     <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">Email Header Customization</span></h4>
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
                  <?=__message()?>
                   
                  <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12"> 
                          <div class="text-uppercase">Email Header Setting</div>
                      </div>
                  </div>

                  <hr class="solid">
                  <div class="row">
                      
                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <form action="#" enctype="multipart/form-data" class="dropzone" id="dropzone_single">
                        </form>
                      </div> 

                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <h3>Image Size and File Formats</h3>
                            <br>
                            <span>
                                <b>Supported image file formats</b> = PNG,JPEG and GIF<br>
                                <br><b>width</b> = 600 pixels<br>
                                <b>height</b> = 110 pixels
                            </span>
                            <h4 class="mt-4">Send Test Email</h4>
                            <div class="form-group">
                              <label>Test Email</label>
                                  <input type="text" name="test_email" form="myform" value="<?=$settings['test_email']; ?>" class="form-control" placeholder="Test Email...">
                                  <input type="hidden" form="myform" name="email_header_setting" id="header_setting" value="">
                            </div>

                        </div>
                
                    </div>  

                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12"> 
                          <div class="text-uppercase mt-2">Email Footer Setting</div>
                      </div>
                    </div>
                    <hr class="solid">   
                     
                    <form method="POST" action="#" id="myform">
                    <div class="row">
                       <div class="col-md-6 col-lg-6 col-sm-12">
                           
                           <div class="form-group mb-3 mb-md-2">
                              
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input footer_visible" name="footer_setting" value="1" <?php if($settings['footer_setting'] == 1){echo "checked";}?> onclick="show_fields(this.value);" id="custom_radio_inline_yes" checked="checked">
                                    <label class="custom-control-label" for="custom_radio_inline_yes">Yes</label>
                                </div>
                                 
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input footer_invisible" name="footer_setting" value="0" <?php if($settings['footer_setting'] == 0){echo "checked";}?> onclick="show_fields(this.value);" id="custom_radio_inline_no" >
                                    <label class="custom-control-label" for="custom_radio_inline_no">No</label>
                                </div>

                            </div>

                        </div> 
                    </div>  
                
                <div class="main_div">

                    <div class="row mt-2">
                       <div class="col-md-6 col-lg-6 col-sm-12">
                            
                            <div class="form-group">
                              <label>Select Email Footer Color</label>
                                  <input type="color" value="<?=$settings['email_footer_color'];?>" name="email_footer_color" class="form-control">
                            </div>

                            <div class="form-group">
                              <label>Select Email Text Color</label>
                                  <input type="color" value="<?=$settings['email_text_color'];?>" name="email_text_color" class="form-control">
                            </div>
                        </div>
                    </div>    



                    <div class="row">
                       <div class="col-md-12 col-lg-12 col-sm-12">       

                            <div class="form-group">
                              <label>Email Footer Text</label>
                                  <textarea name="email_footer_text" class="form-control ckeditor" placeholder="Email Footer Text here..."><?=$settings['email_footer_text'];?></textarea>
                            </div>
                        </div>
                    </div>

                </div>  
                
              <hr class="solid">
              
            <button type="submit" class="btn btn-primary">Submit</button> 
                 
        </form> 
                   
      </div>
    </div>
       
</section> 
</div>   

  @endsection
  @section('scripts')
  
   <script type="text/javascript" src="<?= base_url('assets/global_assets/js/plugins/uploaders/dropzone.min.js'); ?>"></script>
   <script type="text/javascript" src="<?=base_url('assets/global_assets/js/plugins/loaders/blockui.min.js')?>"></script>
   <script src="https://cdn.ckeditor.com/4.5.8/standard-all/ckeditor.js"></script>

   <script type="text/javascript">
   
        var DropzoneUploader = function () {
            var _componentDropzone = function () {
                
                if (typeof Dropzone == 'undefined') 
                {
                    console.warn('Warning - dropzone.min.js is not loaded.');
                    return;
                }

                Dropzone.options.dropzoneSingle = {
                    
                    paramName: "file", // The name that will be used to transfer the file
                    url: "<?=base_url("doctor/settings/uploadImage/")?>",
                    dictDefaultMessage: 'Drop file to upload <span>or CLICK</span>',
                    maxFilesize: 5, // MB
                    maxFiles : 1,
                    autoProcessQueue: true,
                    addRemoveLinks: true,
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

                    success:function (file,response){

                        if (file.previewElement) {
                            file.previewElement.classList.add("dz-success");
                        }

                        if(response.error == 0)
                        {
                            console.log("Added");
                            $("#header_setting").val(response.upload_data.file_name);
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
          

  function show_fields(val)
  {   
      if(val == 1)
      {
          $(".main_div").removeClass('hidden');
      }
      else
      {
        $(".main_div").addClass('hidden');
      }
  }
  

</script>

@endsection


