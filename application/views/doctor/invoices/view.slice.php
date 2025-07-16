@extends('layout.master_doctor')
@section('title','View Invoice')
@section('content')


<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4><span class="font-weight-semibold">View Invoice</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <button type="print" class="btn btn-outline-dark btn-sm" form="myform"><span>Print</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!-- /page header -->

        <section class="content">
            <div class="card">
                <div class="card-body">
                  
                  <div class="container">
                       
                   <div class="row">
                     <div class="col-md-12 col-lg-12">
                        
                        <span class="pull-left">
                        
                           <?php if($settings['invoice_logo'] == 0){ ?>
                             <img src="<?=base_url().$settings['logo_image']; ?>" height="45" width="100">
                           <?php }elseif($settings['invoice_logo'] == 1){ ?>
                             <img src="<?=base_url().$settings['invoice_logo_url']; ?>" height="45" width="100">
                           <?php }else{ echo $settings['invoice_text_logo']; } ?>
                        
                        </span>

                        <span class="pull-right">
                           <b>Invoice No : </b>INV00<?=$invoice['pk_invoice_id']; ?> <br/>
                           <b>Amount : </b> $<?=$invoice['total_amount']; ?> <br/>
                        </span>
                     
                     </div>
                   </div>

                  <div class="row">
                   <div class="col-md-12 col-lg-12">
                    <hr class="solid mt-2 mb-3" style="border-top:6px solid #009999;"> 
                   </div> 
                  </div>

                  <div class="row">
                  
                   <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <div class="text-uppercase font-size-lg mb-1"><b>INVOICE DETAILS</b></div>
                     <b>Invoice No: </b> INV00<?=$invoice['pk_invoice_id'];?><br/>
                     <b>Total Amount: </b> $<?=$invoice['total_amount'];?><br/>
                     <b>Issue Date: </b><?=date("M d,Y",strtotime($invoice['date_created'])); ?><br/>
                     <b>Due Date: </b><?=date("M d,Y",strtotime($invoice['date_due'])); ?><br/>
                     <b>Invoice Status: <?=$status = $invoice['status'] == 0 ? "Unpaid" : "Paid"; ?> </b> 
                   </div>

                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                        <div class="text-uppercase font-size-lg mb-1"><b>INVOICE TO</b></div>
                          <?=$patient['patient_fname'].''.$patient['patient_lname'];?><br/>
                          <?=$patient['patient_address1'];?><br/>
                          <?=$patient['patient_email'];?><br/>
                          <?=$patient['patient_phone'];?>
                   </div>

                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                       <div class="text-uppercase font-size-lg mb-1"><b>INVOICE FROM</b></div>
                        <?=$doctor['doctor_name']; ?><br/>
                        <?=$doctor['doctor_address']; ?><br/>
                        <?=$doctor['doctor_email']; ?><br/>
                        <?=$doctor['doctor_phone']; ?>
                   </div>

                  </div>

                    <div class="row mt-4">
                        <div class="col-md-12 col-lg-12">
                            <table class="table" id="invoicetable" width="100%">
                                <thead class="" style="color:#fff;background-color:#009999;">
                                <tr>
                                    <th width="80%" colspan="11">Description</th>
                                    <th width="20%" class="text-right" colspan="1">Amount</th>
                                </tr>
                                </thead>
                                <tbody class="entry_desc">
                                    <?php
                                         if($invoiceServices){ 
                                            foreach($invoiceServices as $service){    
                                        ?>
                                        <tr>
                                            <td width="80%" colspan="11">
                                                <?=$service['service_text']; ?>
                                            </td>
                                            <td width="20%" class="text-right" colspan="1">
                                                $<span id="service_price"><?=$service['service_price']; ?></span>
                                            </td>
                                        </tr>
                                    <?php } } ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td width="80%" colspan="11" class="text-right" >
                                       <b>Sub Total</b>
                                    </td>
                                    <td width="20%" class="text-right" colspan="1">
                                        $<span id="sub_total_text"><?=$invoice['sub_total']; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="80%" colspan="11" class="text-right">
                                       <b>Discount</b>
                                    </td>
                                    <td width="20%" class="text-right" colspan="1">
                                        $<span id="discount_text"><?=$invoice['discount_amount']; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="80%" colspan="11" class="text-right">
                                        <b>Deposit Credit</b>
                                    </td>
                                    <td width="20%" class="text-right" colspan="1">
                                        $<span id="credit_text"><?=$invoice['deposit_amount']; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="80%" colspan="11" class="text-right">
                                       <b>Total Amount</b>
                                    </td>
                                    <td width="20%" class="text-right" colspan="1">
                                        $<span id="total_text"><?=$invoice['total_amount']; ?></span>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-6 col-lg-6 col-sm-12">
                           <span class="text-uppercase font-size-lg"><b>Notes</b></span>
                             <hr class="solid mt-2">
                           <?=$settings['inovice_note']; ?>   
                        </div>

                        <div class="col-md-8 col-lg-8 col-sm-12 mt-5">
                          <?php if($settings['invoice_signature'] == 1 && $settings['invoice_signature'] != ""){ ?>
                             <img src="<?=base_url().$settings['signImage_url']; ?>" width="100%" height="100px">
                          <?php } ?>
                          <span class="text-uppercase mt-2">Mike Smith - Office Manager</span>
                          <hr class="solid mt-0">
                        </div>

                    </div>

                  </div>
               
                </div>
            </div>
      
        </section>
</div>

@endsection
@section('scripts')

<script type="text/javascript">

    function custom_invoice_entry(name, callback) {

        $.confirm({
            title: 'Custom Entry',

            content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>Description</label>' +
                '<input type="text" value="' + name + '" placeholder="" class="Description form-control" required />' +
                '</div>' +
                '<div class="form-group">' +
                '<label>Amount</label>' +
                '<input type="text" value="' + name + '" placeholder="" class="amount form-control" required />' +
                '</div>' +
                '</form>',
            scrollToPreviousElement: false,
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-blue',
                    action: function () {
                        var Description = this.$content.find('.Description').val();
                        var amount = this.$content.find('.amount').val();
                        if (!Description) {
                            $.alert('Provide Description');
                            return false;
                        }
                        if (!amount) {
                            $.alert('Provide amount');
                            return false;
                        }

                        callback(true, Description, amount)
                    }
                },
                cancel: function () {
                    callback(false, '', '')
                },
            },
            onContentReady: function () {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    }

    var row = ''

    $(document).on("click", "#add_entry", function (e) {

        entry_type = $("#entry_type").val();
        if (entry_type == '') {
            alert("Select service entry");
            return false;
        }


        if (entry_type != 0) {
            var servicedetail_price = $("#entry_type option:selected").attr("data-price")
            var servicedetail_detail = $("#entry_type option:selected").attr("data-service_name")


            row = '<tr>' +
                '<td width="75%">' +
                '<span class="service_description_text">' + servicedetail_detail + '</span>' +
                '<input type="hidden" name="service_description[]" class="form-control service_description" value="' + servicedetail_detail + '" >' +
                '</td>' +
                '<td width="20%" class="">' +
                '<span class="service_amount_text">$' + servicedetail_price + '</span>' +
                '<input type="hidden" name="service_amount[]"  class="form-control service_amount" value="' + servicedetail_price + '">' +
                '<input type="hidden" name="service_id[]" class="form-control service_id" value="' + entry_type + '">' +
                '</td>' +
                '<td width="5%" class="text-center">' +
                '<button type="button" class="btn btn-default btn-sm delete_btn" ><i class="fa fa-trash-o"></i></button>' +
                '</td>' +
                '</tr>';

            $(".entry_desc").append(row);
            ServiceEntriesCalc()

        } else {

            custom_invoice_entry('', function (res, servicedetail_detail, servicedetail_price) {
                if (res == true) {
                    row = '<tr>' +
                        '<td width="75%">' +
                        '<span class="service_description_text">' + servicedetail_detail + '</span>' +
                        '<input type="hidden" name="service_description[]" class="form-control service_description" value="' + servicedetail_detail + '" >' +
                        '</td>' +
                        '<td width="20%" class="">' +
                        '<span class="service_amount_text">$' + servicedetail_price + '</span>' +
                        '<input type="hidden" name="service_amount[]"  class="form-control service_amount" value="' + servicedetail_price + '">' +
                        '<input type="hidden" name="service_id[]" class="form-control service_id" value="0">' +
                        '</td>' +
                        '<td width="5%" class="text-center">' +
                        '<button type="button" class="btn btn-default btn-sm delete_btn" ><i class="fa fa-trash-o"></i></button>' +
                        '</td>' +
                        '</tr>';

                    $(".entry_desc").append(row);
                    ServiceEntriesCalc()

                } else {

                }
            });

        }


    });

   
    function ServiceEntriesCalc() {

        var total = 0;
        var sub_total = 0;
        var discount_amount = $("#discount_amount").val();
        var deposit_credit = $("#deposit_credit").val();


        if (discount_amount == null || discount_amount == "") {
            var discount_amount = 0;
        }
        if (deposit_credit == null || deposit_credit == "") {
            var deposit_credit = 0;
        }

        discount_amount = parseFloat(discount_amount)
        deposit_credit = parseFloat(deposit_credit)


        $(".service_amount").each(function (index) {

            var service_price = $(this).val();
            service_price = parseFloat(service_price)

            sub_total = sub_total + service_price

        });

        total = sub_total;

        total = total - discount_amount;


        $("#sub_total").val(sub_total);
        $("#sub_total_text").text(sub_total);

        $("#discount_text").text(discount_amount);
        $("#credit_text").text(deposit_credit);

        $("#total").val(total);
        $("#total_text").text(total);


    }


</script>
@endsection