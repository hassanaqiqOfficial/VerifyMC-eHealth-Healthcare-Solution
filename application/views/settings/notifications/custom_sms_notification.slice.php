@extends('layout.master_clinic')
@section('title', 'Add Custom SMS')
@section('content')

 <div class="content-wrapper">
    
     <!-- Page header -->
     <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">
                <?php if(isset($fkid) && !empty($fkid)){ ?>
                Edit Custom SMS
                <?php }else{ ?>
                Add Custom SMS
                <?php } ?></span></h4>
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
          <form action="" method="post" class="admin-form-validate" enctype="mulipart/form-data" id="myform">
            <div class="card-body">

                <div class="form-row ">

                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                        <label>Title<span class="text-danger dark"> * </span></label>
                        <div class="">
                            <input type="text" name="template_title" value="<?=$custom_sms['title'];?>" class="form-control" required placeholder="Template Title"
                                    id="template_title">
                        </div>
                    </div>

                    
                </div>

               <div class="form-row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                        <label>Body<span class="text-danger dark"> * </span></label>
                        <div class="">
                            <textarea name="body" class="form-control" required placeholder="Start typing here..." rows="6"><?=$custom_sms['body'];?></textarea>
                        </div>
                    </div>
            
              </div>
              <hr class="solid">
             <button type="submit" name="submit" class="btn btn-primary">Submit</button>
           </div>

        </form>
      </div>

 </section>
</div> 



@endsection

@section('scripts')
@endsection
