@extends('layout.master_doctor')
@section('title', 'Invoice Customization')
@section('bodyClass','sidebar-right-visible')
@section('content')

<?php require ("application/views/doctor/settings/branding/sidebar_secondary.php"); ?>

<div class="content-wrapper">

     <!-- Page header -->
     <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">Invoice Customization</span></h4>
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

                <form  method="POST" enctype="multipart/form-data" id="myform">
                  <div class="row">
                    
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        
                       <div class="text-uppercase">Select Invoice Color</div>
                         <hr class="solid">

                           <div class="form-check">
                                <label class="form-check-label">
                                    <span class="">
                                       <input type="radio" name="invoice-skin" value="bg-secondary" <?php if($settings['invoice-skin']  == "bg-secondary"){echo "checked"; } ?> class="form-check-input-styled-secondary" data-fouc="">
                                    </span>
                                    Grey
                                </label>
                            </div>
                       
                            <div class="form-check mt-3">
                                <label class="form-check-label">
                                    <span class="">
                                       <input type="radio" name="invoice-skin" value="bg-primary" <?php if($settings['invoice-skin']  == "bg-primary"){echo "checked"; } ?> class="form-check-input-styled-primary"  data-fouc="">
                                    </span>
                                    Blue
                                </label>
                            </div>

                            <div class="form-check mt-3">
                                <label class="form-check-label">
                                    <span class="">
                                      <input type="radio" name="invoice-skin" value="bg-danger" <?php if($settings['invoice-skin']  == "bg-danger"){echo "checked"; } ?> class="form-check-input-styled-danger" data-fouc="">
                                    </span>
                                    Red
                                </label>
                            </div>

                            <div class="form-check mt-3">
                                <label class="form-check-label">
                                   <span class="">
                                      <input type="radio" name="invoice-skin" value="bg-success" <?php if($settings['invoice-skin']  == "bg-success"){echo "checked"; } ?> class="form-check-input-styled-success" data-fouc="">
                                    </span>
                                    Green
                                </label>
                            </div>

                            <div class="form-check mt-3">
                                <label class="form-check-label">
                                    <span class="">
                                      <input type="radio" name="invoice-skin" value="bg-warning" <?php if($settings['invoice-skin']  == "bg-warning"){echo "checked"; } ?> class="form-check-input-styled-warning" data-fouc="">
                                    </span>
                                    Orange 
                                </label>
                            </div>

                            <div class="form-check mt-3">
                                <label class="form-check-label">
                                    <span class="">
                                       <input type="radio" name="invoice-skin" value="bg-info" <?php if($settings['invoice-skin']  == "bg-info"){echo "checked"; } ?> class="form-check-input-styled-info"  data-fouc="">
                                    </span>
                                    Sky 
                                </label>
                            </div>

                            <div class="form-check mt-3">
                                <label class="form-check-label">
                                    <span class="">
                                       <input type="radio" name="invoice-skin" value="bg-indigo-400" <?php if($settings['invoice-skin']  == "bg-indigo-400"){echo "checked"; } ?> class="form-check-input-styled-custom" data-fouc="">
                                    </span>
                                    Purple 
                                </label>
                            </div>
                        
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12">
                       <img id="style_img" src="<?=base_url('assets/img/inovice_img.png');?>" style="width: 400px;height: 500px; border: 2px solid #eee;"> 
                    </div>
                    
                  </div>
                   
                  <div class="row mt-2">
                     
                      <div class="col-md-6 col-lg-6 col-sm-12"> 
                          <div class="text-uppercase">Notes</div>
                          <hr class="solid">
                      </div>

                      <div class="col-md-6 col-lg-6 col-sm-12"> 
                          <div class="text-uppercase">Invoice Logo</div>
                          <hr class="solid">
                      </div>

                  </div>

                  <div class="row">
                      
                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <label>Add Note</label> 
                        <textarea name="inovice_note" class="form-control" rows="4"><?=$settings['inovice_note']; ?></textarea>
                      </div> 

                        <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                            
                            <div class="form-group">
                                
                                <div class="custom-control custom-control-inline custom-radio mr-5">
                                    <input type="radio" class="custom-control-input" name="invoice_logo" value="0" <?php if($settings['invoice_logo']  == "0"){echo "checked"; } ?> onclick="show_fields_l(this.value);" id="custom_radio_inline_current" checked="checked">
                                    <label class="custom-control-label" for="custom_radio_inline_current">Use Current Logo</label>
                                </div>
                                
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="invoice_logo" value="1" <?php if($settings['invoice_logo']  == "1"){echo "checked"; } ?> onclick="show_fields_l(this.value);" id="custom_radio_inline_upload" >
                                    <label class="custom-control-label" for="custom_radio_inline_upload">Upload a Logo</label>
                                </div>

                                <div class="custom-control custom-control-inline custom-radio mt-3">
                                    <input type="radio" class="custom-control-input" name="invoice_logo" value="2" <?php if($settings['invoice_logo']  == "2"){echo "checked"; } ?> onclick="show_fields_l(this.value);" id="custom_radio_inline_text" >
                                    <label class="custom-control-label" for="custom_radio_inline_text">Text Logo</label>
                                </div>

                             </div>

                             <div class="hidden" id="upload_logo">
                               <div class="form-group">
                                 <?php if($settings['invoice_logo_url'] != ""){ ?>
                                   <img src="<?=base_url($settings['invoice_logo_url']); ?>" width="100px" height="100px">
                                 <?php } ?>
                                 <br><label>Upload Logo</label>
                                 <input type="file" name="invoice_upload_logo" class="form-control">
                                 <input type="hidden" name="invoice_upload_logo_old" value="<?=$settings['invoice_logo_url']; ?>" class="form-control">
                               </div>
                             </div>

                             <div class="hidden" id="text_logo">
                               <div class="form-group">
                                 <label>Text Logo</label>
                                 <input type="text" name="invoice_text_logo" value="<?=$settings['invoice_text_logo']; ?>" placeholder="Text Logo ..." class="form-control">
                               </div>
                             </div>

                        </div>
                
                    </div> 



                    <div class="row mt-3">
                      <div class="col-md-12 col-lg-12 col-sm-12"> 
                          <div class="text-uppercase">Add a signature</div>
                      </div>
                    </div>
                    <hr class="solid">   
                     
                   
                    <div class="row">
                       <div class="col-md-6 col-lg-6 col-sm-12">
                           
                           <div class="form-group mb-3 mb-md-2">
                              
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="invoice_signature" value="1" <?php if($settings['invoice_signature']  == "1"){echo "checked"; } ?> onclick="show_fields(this.value);" id="custom_radio_inline_yes" checked="checked">
                                    <label class="custom-control-label" for="custom_radio_inline_yes">Yes</label>
                                </div>
                                 
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="invoice_signature" value="0" <?php if($settings['invoice_signature']  == "0"){echo "checked"; } ?> onclick="show_fields(this.value);" id="custom_radio_inline_no" >
                                    <label class="custom-control-label" for="custom_radio_inline_no">No</label>
                                </div>

                                <input type="hidden" name="signImage_url" id="signimage" value="">
                                <input type="hidden" name="signImage_url_old" id="signimage_old" value="">
                                <input type="hidden" name="signMade_url" id="signMade_url" value="12345">

                            </div>

                        </div> 
                    </div>  

                </form>    
                
                <div class="main_div">

                    <div class="row mt-2">
                       <div class="col-md-6 col-lg-6 col-sm-12">       
                            <div class="form-group">
                              <label>Signee Title <small>(Below Signature)</small></label>
                                  <input name="singee_title" value="<?=$settings['singee_title']; ?>" form="myform" class="form-control" placeholder="Signee Title">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                       
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                              <label>Option 1 : Upload signature image recommended</label>
                               <form action="#" enctype='multipart/form-data' class="dropzone" id="dropzone_single"></form>
                            </div>
                        </div>    

                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <form method="POST" class="sigPad">
                                    <label>Option 2 : Draw Signature with mouse or finger</label>
                                    <canvas class="pad" width="400px" height="250px"></canvas>
                                </form> 
                            </div>
                        </div>

                    </div>    


                </div>  
                
                <hr class="solid">
                <button type="submit" form="myform" class="btn btn-primary">Submit</button> 
            
            </div>
         </div>
       </section> 
    </div>   

  @endsection
  @section('scripts')

   <script type="text/javascript" src="<?= base_url('assets/global_assets/js/plugins/uploaders/dropzone.min.js'); ?>"></script>
   <script type="text/javascript" src="<?=base_url('assets/global_assets/js/plugins/loaders/blockui.min.js')?>"></script>
   <script type="text/javascript" src="<?=base_url('assets/global_assets/js/plugins/forms/styling/uniform.min.js'); ?>"></script>
   <link href="<?=base_url('assets/plugins/Signature-pad/assets/jquery.signaturepad.css');?>" rel="stylesheet" />
   <script src="<?=base_url('assets/plugins/Signature-pad/jquery.signaturepad.js'); ?>" type="text/javascript"></script>

   <script type="text/javascript">
   
   $(document).ready(function(){
        
        // Signature Pad Customization
        $('.sigPad').signaturePad({
            
            displayOnly:true,
            drawOnly :true,
            defaultAction :'typeIt',
            canvas :'canvas',
            clear :'.clearButton',

            bgColour :'#f5f5ef',
            penColour :'#333',
            lineColour :'#333',
      
        });
       
        // Default initialization
        $('.form-check-input-styled').uniform();

        // Primary
        $('.form-check-input-styled-primary').uniform({
            wrapperClass: 'border-primary text-primary'
        });
        // Danger
        $('.form-check-input-styled-danger').uniform({
            wrapperClass: 'border-danger text-danger'
        });
        // Success
        $('.form-check-input-styled-success').uniform({
            wrapperClass: 'border-success text-success'
        });
        // Warning
        $('.form-check-input-styled-warning').uniform({
            wrapperClass: 'border-warning text-warning'
        });
        // Info
        $('.form-check-input-styled-info').uniform({
            wrapperClass: 'border-info text-info'
        });
        // Secondary
        $(".form-check-input-styled-secondary").uniform({
            wrapperClass: 'border-secondary text-secondary'
        });
       // Purple
        $('.form-check-input-styled-custom').uniform({
            wrapperClass: 'border-indigo-400 text-indigo-400'
        });

         
   });

   
        var DropzoneUploader = function () {
            var _componentDropzone = function () {
                
                if (typeof Dropzone == 'undefined') 
                {
                    console.warn('Warning - dropzone.min.js is not loaded.');
                    return;
                }

                Dropzone.options.dropzoneSingle = {
                    paramName: "file", // The name that will be used to transfer the file
                    url: "<?=base_url("doctor/settings/uploadImage")?>",
                    dictDefaultMessage: 'Drop file to upload <sp    an>or CLICK</span>',
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

                    success:function (file,response)
                    {
                        if (file.previewElement) 
                        {
                            file.previewElement.classList.add("dz-success");
                        }
                        if(response.error == 0)
                        {
                            console.log("Added");
                            $("#signimage").val(response.upload_data.file_name);
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

  function show_fields_l(val)
  {
     if(val == 1)
    {
        $("#text_logo").addClass("hidden");
        $("#upload_logo").removeClass("hidden");
    }
    else if(val == 2)
    {
        $("#upload_logo").addClass("hidden");
        $("#text_logo").removeClass("hidden");
    }
    else if(val == 0)
    {
        $("#text_logo").addClass("hidden");
        $("#upload_logo").addClass("hidden");
    }
    
  }
  

</script>

@endsection


