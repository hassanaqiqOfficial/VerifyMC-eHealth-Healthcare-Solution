@extends('layout.master_doctor')
@section('title','Invoice Payment')
@section('content')


<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4><span class="font-weight-semibold">Invoice Payment</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary btn-sm" form="myform"><span>Submit</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!-- /page header -->

    <section class="content">
        <form method="POST" class="admin-form-validate" id="myform">
            <div class="card">
                <div class="card-body">
                 <?=__message()?>
                   <!--Existing-patient Details here....  -->
                      
                     <div class="row mb-2">
                     
                        <div class="col-md-6 col-lg-6">

                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="text-uppercase mb-0 font-size-lg">Patient Details</div>
                                </div>
                            </div>

                            <hr class="solid">

                            <div class="col-md-12 col-lg-12">
                                <div class="media">
                                  <div class="mr-3">
                                        <?php if($patient['patient_photo'] != ""){ ?>
                                            <img src="<?=base_url().$patient['patient_photo']; ?>" class="rounded-circle" width="48" height="48" alt="Patient Photo">
                                        <?php }else{ ?>
                                            <img src="<?=base_url('assets/img/placeholder.png'); ?>" class="rounded-circle" width="48" height="48" alt="Patient Photo">
                                        <?php } ?>

                                          <input type="hidden" name="total_amount" value="<?=$invoice['total_amount']; ?>">
                                          <input type="hidden" name="patient_id" value="<?=$invoice['patient_id']; ?>">
                                  </div>
  
                                  <div class="media-body">
                                      <h6 class="mb-0"><b>Name : </b><?=$patient['patient_fname'].''.$patient['patient_lname']; ?></h6>
                                      <span class=""><b>Email : </b> <?=$patient['patient_email']; ?></span><br>
                                      <span class=""><b>Phone : </b> <?=$patient['patient_phone']; ?></span><br>
                                      <span class=""><b>DOB : </b> <?=date("M d,Y",strtotime($patient['patient_dob'])); ?></span>
                                  </div>
                                </div> 
                            </div>

                        </div>




                        <div class="col-md-6 col-lg-6">
                            
                            <div class="row">
                              <div class="col-md-12 col-lg-12">
                                <div class="text-uppercase mb-0 font-size-lg">Invoice Details</div>
                              </div>  
                            </div>
                       
                            <hr class="solid">
                            <div class="row">

                                <div class="col-md-12 col-lg-12">

                                    <span class=""><b>Invoice No : </b><?="INV00".$invoice['pk_invoice_id']; ?></span><br/>
                                    <span class=""><b>Created Date : </b> <?=date("M d,Y",strtotime($invoice['invoiceDate'])); ?></span><br/>
                                    <span class=""><b>Discount Amount : </b> $<?=$invoice['discount_amount'];?></span><br/>
                                    <span class=""><b>Deposit Amount : </b> $<?=$invoice['deposit_amount'];?></span><br/>
                                    <span class=""><b>Total Amount : </b> $<?=$invoice['total_amount'];?></span>
                                    
                                </div>    
                                    
                            </div>
                           </div>    
  
                        </div>  

                    <!--/Existing-patient Details here....  -->

                   

                   

                    <div class="row mt-3">
                        <div class="col-md-12 col-lg-12">
                            <div class="text-uppercase mt-3 font-size-lg">Payment Option</div>
                        </div>
                    </div>

                    <hr class="solid mb-2">

                    <div class="row">
                        <div class="col-md-6 col-lg-6">

                            <div class="form-group">
                                <label>Select Payment Option</label>
                                <select name="payment_option" onchange="show_div(this.value);" class="form-control">
                                    <option value="" >Select Option</option>
                                    <option value="1" <?php if($invoice['payment_mode'] == 1){echo "selected";}?> >Process Credit / Debit Card Payment</option>
                                    <option value="2" <?php if($invoice['payment_mode'] == 2){echo "selected";}?> >Paid by Cash</option>
                                    <option value="3" <?php if($invoice['payment_mode'] == 3){echo "selected";}?> >Paid by Check</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="row hidden" id="paybycheck">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Check Number</label>
                            <input type="text" name="checknumber" class="form-control" placeholder="Check Number...">
                        </div>
                        </div>
                    </div>

                    <div class="row hidden" id="paybycard">
                        <div class="col-md-6 col-lg-6">
                        </div>
                    </div>  

                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="<?= base_url('doctor/invoices/'); ?>" class="btn btn-primary">back</a>
                    </div>

               </div>
            </div>
        </form>


    </section>
</div>

@endsection
@section('scripts')

<script type="text/javascript" src="<?= base_url('assets/global_assets/js/plugins/forms/validation/jquery.validate.js') ?>"></script>

<script type="text/javascript">

   $(function(){

      $("#creation_date").datepicker({
        dateFormat: 'd MM, yy'
      });
     
      $("#due_date").datepicker({
        dateFormat: 'd MM, yy',
        changeYear: true,
        changeMonth: true
      });

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
               
            },

            messages: {

            }

        });

    });

    function show_div(paymentMode)
    { 
       if(paymentMode == 3)
       {
           $("#paybycheck").removeClass("hidden");
           $("#paybycard").addClass("hidden");
       }
       else if(paymentMode == 2)
       {
           $("#paybycheck").addClass("hidden");
           $("#paybycard").addClass("hidden");
       }
       else
       {    
        $("#paybycheck").addClass("hidden");
        $("#paybycard").removeClass("hidden");
       }
    }

   
</script>

@endsection