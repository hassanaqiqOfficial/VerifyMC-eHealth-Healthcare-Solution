@extends('layout.master_clinic')
@section('title', 'Dashboard')
@section('content')

<div class="content-wrapper">
    <!-- Page header -->
    <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="d-flex page-title pb-2 pt-2">
                    <h4> <span class="font-weight-semibold">Clinic Dashboard</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
                <!-- <div class="header-elements d-none">
                    <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-sm btn-outline-primary" name="Update" form="myform">Update
                    </button>
                    </div>
                </div> -->

            </div>
        </div>
      <!-- /page header -->
     
     <!--Default Grid --> 
   <!-- Content area -->
   <section class="content">

        <!-- Default grid -->
            <div class="card">
                <div class="card-body">
                    <form action="#">
                        <div class="row">
                            <div class="col-md-2">
                                <label>First Name</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="col-md-2">
                                </div>
                            </div>

                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="col-md-10">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="col-md-3">
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="col-md-9">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="col-md-4">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="col-md-8">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="col-md-5">
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="col-md-7">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="col-md-6">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="col-md-6">
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
             </div>
          </div>
      </section>
    <!-- /content area -->
    <!--/Default Grid -->
</div>

@endsection
@section('scripts')
@endsection