@extends('layout.master_doctor')
@section('title', 'Favicon')
@section('bodyClass','sidebar-right-visible')
@section('content')

<?php require ("application/views/doctor/settings/branding/sidebar_secondary.php")?>

<div class="content-wrapper">

     <!-- Page header -->
     <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">Favicon</span></h4>
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
                          <div class="text-uppercase">Favicon Image</div>
                      </div>
                    </div>
                   
                    <hr class="solid">
                    
                    <form method="POST" enctype="multipart/form-data" id="myform">
                     
                     <div class="row">
                       <div class="col-md-6 col-lg-6 col-sm-12"> 
                       
                        <?php if($favicon != ""){ ?>
                        <div class="form-group">
                          <img src="<?=base_url($favicon); ?>" width="300px" height="400px">
                        </div>
                        <?php } ?> 
                        <div class="form-group">
                          <input type="file" name="favicon" class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <span>Supported image type = PNG , JPEG and GIF</span>
                            <br>
                            <span>Recommended width = 16 pixels</span>
                            <br>
                            <span>Recommended height = 16 pixels</span>
                        </div>
  
                       </div>

                        
                        <div class="col-md-12 col-lg-12 col-sm-12"> 
                         <hr class="solid"> 
                            <button type="submit" class="btn btn-primary btn-md">Submit</button>
                        </div>

                    </div> 
                    
                    </form>
                    

                   
                </div>

            </div>

  </section> 
  </div>   

  @endsection
  @section('scripts')

  @endsection


