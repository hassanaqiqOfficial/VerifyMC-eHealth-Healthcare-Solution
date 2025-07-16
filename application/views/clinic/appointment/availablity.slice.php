@extends('layout.master_clinic')
@section('title', 'Manage Availablity')
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
                <h4> <span class="font-weight-semibold">Manage Availability</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <!-- <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-light btn-sm head_btn" form="myform" style="border-radius:8px !important;"><span>Submit</span></button>
                    
                    
                </div>
            </div> -->

        </div>
    </div>
    <!-- /page header -->

    <!-- Content -->
    <section class="content">

       <!-- Default Grid -->
           <div class="card">
           
                   <form action="" method="post">
                           <div class="card-body" style="padding:55px;">
                              <div class="row">
                                 <div class="col-md-12 col-lg-12 col-sm-12">
                                      <div class="section">
                                          <br>

                                            <div class="col-md-4 col-lg-4">
                                                <label class="option option-primary"><b>Select Physician</b>
                                                </label>
                                                  <select name="doctor_id" class="form-control" id="doctors">
                                                    <?php 
                                                      if($doctors){
                                                          foreach($doctors as $doctor)
                                                          {
                                                           ?>
                                                           <option value="<?=$doctor['doctor_user_id'];?>"><?=$doctor['doctor_name'];?></option>
                                                           <?php   
                                                          }
                                                        }
                                                      ?>
                                                  </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><br><br>

                            </div>
                         </form>
                      </div>
               </section>
              </div>







@endsection
@section('scripts')
 
 <script type="text/javascript">
 
   $(document).ready(function(){
     $("#doctors").on('change',function(e){
     var doctor_id = $(this).val();
      window.location = "manage_availability/"+doctor_id;
     });
   });

 </script>
  
 @endsection