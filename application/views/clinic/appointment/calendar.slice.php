@extends('layout.master_clinic')
@section('title', 'Manage Appointment')
@section('content')

<style>
    em.state-error {
        display: block;
        margin-top: 6px;
        padding: 0 3px;
        font-family: Arial, Helvetica, sans-serif;
        font-style: normal;
        line-height: normal;
        font-size: 0.85em;
        color: #DE888A;
    }

    .state-error .form-control{
        background: #FEE9EA;
        border-color: #DE888A;
    }
    element.style {
    background: darkgrey;
    color: #fff;
    }
    .popup-basic {
    position: relative;
    background: #FFF;
    width: auto;
    max-width: 450px;
    margin: 40px auto;
   }
    label.option.option-primary {
    cursor:pointer;
    }

</style>

<div class="content-wrapper">
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">Manage Appointment</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <?php if(isset($doctor_id) && $doctor_id != ""){ ?>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <a href="<?=base_url('clinic/appointment/add_appointment/'.$doctor_id); ?>" class="btn btn-outline-primary btn-sm" form="myform"><span>Add Appointment</span></a>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>
    <!-- /page header -->
    <?=$calender_view; ?> 
</div>


  <div class="modal" id="mymodal" style="border-radius: 5px" tabindex="-1" role="dialog"> 
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header pt5 pb5" style="display:block;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4>Appointment Detail</h4>
          </div>
          <div class="modal-body">
            <div id="patient_detail"></div>
            <h4 class="mb5" style="margin-top:10px;">Options</h4>
            <hr>
            <div class="row">
              <span class="col-md-6 col-sm-6 col-lg-6" id="appointment_links" style="line-height:2;"></span>
              <span class="col-md-6 col-sm-6 col-lg-6" id="patient_links" style="line-height:2;"></span>
            </div>
            <hr>
           <h4 class="mt20 mb5">Appointment Category</h4>
            <div class="form-row">
            <?php  if($categories){ ?>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                 <label>Click here to change appointment category</label>
                  <select name="appointment_category" id="app_cat" class="form-control pull-left">
                    <?php 
                    
                      foreach($categories as $category){
                    
                    ?>
                    <option value="<?=$category['pk_app_categoryid']?>" ><?=$category['name'];?></option>
                    <?php } ?>
                  </select>
                </div>
                </div>
                <?php } ?>
            
            </div>     
          </div>
       </div>
      </div>
    </div> 

@endsection
