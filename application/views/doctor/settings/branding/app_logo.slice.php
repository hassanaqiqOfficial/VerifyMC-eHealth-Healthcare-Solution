@extends('layout.master_doctor')
@section('title', 'Logo')
@section('bodyClass','sidebar-right-visible')
@section('content')

<?php require ("application/views/doctor/settings/branding/sidebar_secondary.php")?>

<div class="content-wrapper">

     <!-- Page header -->
     <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">Logo Setting</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary btn-sm" form="dropzone_single"><span>Submit</span></button>
                </div>
            </div>

        </div>
    </div>
    <!-- /page header -->

    <section class="content">

            <div class="card">

                <div class="card-body">
                  <?=__message()?>
                    
                    <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="nav-item"><a href="#image_logo_tab" class="nav-link <?php if($logo_type == "" OR $logo_type == 'Image'){echo 'active';}?> " data-toggle="tab">Image Logo</a></li>
                        <li class="nav-item"><a href="#text_logo_tab" class="nav-link <?php if( $logo_type == 'text_logo'){echo 'active';}?> " data-toggle="tab">Text Logo</a></li>
                    </ul>

                    <div class="tab-content">
                       
                        <div class="tab-pane fade <?php if($logo_type == "" OR  $logo_type == 'Image'){echo 'active show';}?> " id="image_logo_tab">
                          <div class="row"> 
                            
                            <div class="col-md-6 col-lg-6 col-sm-6">
                              <form method="POST" action="#" id="dropzone_single" enctype='multipart/form-data' class="dropzone nodropzone">
                               <input type="hidden" name="logo_image" value="" id="logoimage">
                               <input type="hidden" name="logo_type" value="Image" >

                                  <img src="<?=base_url($logo_image)?>" width="250" />

                              </form>
                            </div>

                            <div class="col-md-6 col-lg-6 col-sm-6">
                               
                               <h3>Where is this logo used?</h3>
                               <br>
                               <p>The logo image is automatically added to the software, your invoices and patient recommendations.</p>
                               <br>
                               <b>Supported image type and maximum image size</b><br><br>
                               <span>
                                 <b>Supported image type</b> = PNG,JPEG and GIF (Transparent PNG file typically work best)<br>
                                 <b>Maximum width</b> = 380 pixels<br>
                                 <b>Maximum height</b> = 150 pixels
                               </span>

                            </div>

                            <div class="col-md-12 col-lg-12">
                              <hr class="solid">
                              <button type="submit" form="dropzone_single" class="btn btn-primary">Submit</button>
                            </div>

                          </div>  
                        </div>

                        <div class="tab-pane fade <?php if( $logo_type == 'text_logo'){echo 'active show';}?> " id="text_logo_tab">
                        
                          <div class="row">
                           
                            <div class="col-md-6 col-lg-6 col-sm-6">

                                <form method="POST" id="dropzone_single">  
                                  <h3>Text Logo</h3>
                                    <hr class="solid">
                                    
                                    <div class="form-group">
                                      <input type="text" name="text_logo" value="<?=$textLogo; ?>" placeholder="Text Logo" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="hidden" name="logo_type" value="Text Logo" >
                                      <button type="submit" class="btn btn-success btn-md">Update</button>
                                    </div>
                                </form>  

                            </div>

                            <div class="col-md-6 col-lg-6 col-sm-6">
                              <h3>Where is this logo used?</h3>
                               <br>
                               <p>The recommendation text is automatically added to all of your 1-click patient recommendation. MCI provide default recommendation text that you can update and personalize. To create a patient recommendation visit the patient page and click "Create Recommendation".</p>
                                <br>
                               <b>Supported image type and maximum image size</b><br><br>
                               <span>
                                 <b>Supported image type</b> = PNG,JPEG and GIF (Transparent PNG file typically work best)<br>
                                 <b>Maximum width</b> = 380 pixels<br>
                                 <b>Maximum height</b> = 150 pixels
                               </span>
                            </div>

                          </div>  

                        </div>

                    </div>

                   
                </div>

            </div>

  </section> 
</div>   

  @endsection
  @section('scripts')

  
  <script type="text/javascript" src="<?= base_url('assets/global_assets/js/plugins/uploaders/dropzone.min.js'); ?>"></script>
  <script type="text/javascript" src="<?=base_url('assets/global_assets/js/plugins/loaders/blockui.min.js')?>"></script>

  <script type="text/javascript">
   

   var DropzoneUploader = function () {
        var _componentDropzone = function () {
            if (typeof Dropzone == 'undefined') {
                console.warn('Warning - dropzone.min.js is not loaded.');
                return;
            }


            Dropzone.options.dropzoneSingle = {
                
                paramName: "file", // The name that will be used to transfer the file
                url: "<?=base_url("doctor/settings/uploadImage")?>",
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
                        console.log("Added")
                        $("#logoimage").val(response.upload_data.file_name);
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



  </script>

  @endsection


