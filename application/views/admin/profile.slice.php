@extends('layout.master')
@section('title', 'Update Profile')
@section('content')

<div class="content-wrapper">

    	<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="d-flex page-title pb-2 pt-2">
						<h4> <span class="font-weight-semibold">Update Profile</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none">
						<div class="d-flex justify-content-center">
							<button class="btn btn-outline-primary btn-sm" form="myform"><span>Update</span></button>
						</div>
					</div>
            
                </div>
            </div>
			<!-- /page header -->

        <!-- Content area -->
        <section class="content">

            <!-- Default grid -->
           <div class="card">
             <div class="card-body">
               <?=__message(); ?>
                 <form action="<?php echo base_url('admin/profile/')?>" method="post" class="admin-form-validate" id="myform" enctype="multipart/form-data"> 
                    <div class="form-row">
                        <div class="col-lg-7 col-md-6">

                        <div class="form-group row">
                            <label class="col-form-label col-lg-2 col-md-2">User Name</label>
                            <div class="col-md-6 col-lg-6"> 
                            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name" value="<?=$admin['admin_user_name'];?>">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label class="form-label col-lg-2 col-md-2">Password</label>
                            <div class="col-md-6 col-lg-6">
                            <input type="password" name="password" class="form-control"  placeholder="Password" id="password">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label class="form-label" style="padding-left:110px;">
                            <input type="checkbox" id="passwrod" onclick="myFunction()"
                                    style="width:24px;height: 24px;position: relative;top: 6px;margin-right: 5px;">
                            Show Password</label>
                            
                        </div>
                        <hr>
                        <button type="submit" name="update1" id="admin-form" class="btn btn-submit btn-primary ml0">Update
                        </button>

                       </div>
                     </div>    
       
                 </form> 
                </div>

            </div>
            <!-- /Default grid -->

        </section>
        <!-- /Content area -->
</div>
@endsection

@section('scripts')
  
    <script type="text/javascript">
      
    function myFunction()
    {
        var a = document.getElementById("password");
        if(a.type === "password")
        {
        a.type = "text";
        }
        else
        {
        a.type = "password" 
        }
    } 

   </script>

@endsection