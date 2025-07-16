@extends('layout.master_doctor')
@section('title','Add Invoice')
@section('content')


<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4><span class="font-weight-semibold">Add Invoice</span></h4>
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

                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="text-uppercase mb-3 font-size-lg">Patient Details</div>
                        </div>
                    </div>

                    <?php if($patientID == ""){ ?>

                    <div class="form-group mb-3 mb-md-2">

                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input gateway" name="patient" value="new_patient"
                                   onchange="load_fields('new_patient')" id="custom_radio_inline_square">
                            <label class="custom-control-label" for="custom_radio_inline_square">New Patient</label>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input gateway" name="patient"
                                   value="existing_patient" onchange="load_fields('existing_patient')"
                                   id="custom_radio_inline_strip" checked="checked">
                            <label class="custom-control-label" for="custom_radio_inline_strip">Existing Patient</label>
                        </div>


                    </div>

                    <?php } ?>

                    <!--Existing-patient Details here....  -->
                      
                    <div class="row mb-2 <?php if($patientID == ""){ echo "hidden"; } ?>">
                         
                       <div class="col-md-6 col-lg-6">
                            <div class="media">
								<div class="mr-3">
										<?php if($patient['patient_photo'] != ""){ ?>
                                            <img src="<?=base_url().$patient['patient_photo']; ?>" class="rounded-circle" width="48" height="48" alt="Patient Photo">
                                        <?php }else{ ?>
                                            <img src="<?=base_url('assets/img/placeholder.png'); ?>" class="rounded-circle" width="48" height="48" alt="Patient Photo">
                                        <?php } ?>
                                        <input type="hidden" name="patient_id" value="<?=$patientID; ?>">
                                </div>

								<div class="media-body">
									<h6 class="mb-0"><b>Name : </b><?=$patient['patient_fname'].''.$patient['patient_lname']; ?></h6>
                                    <span class=""><b>Email : </b> <?=$patient['patient_email']; ?></span><br>
                                    <span class=""><b>Phone : </b> <?=$patient['patient_phone']; ?></span><br>
                                    <span class=""><b>DOB : </b> <?=$patient['patient_dob']; ?></span>
								</div>
                            </div> 
                       </div>    

                    </div>  
                    <!--/Existing-patient Details here....  -->


                    <!--Existing-patient...  -->
                    <div class="<?php if($patientID != ""){echo "hidden";} ?>" id="existing_patient">

                        <div class="row mt-3">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Existing Patient</label>
                                    <input type="text" class="form-control" id="select_patient"
                                           placeholder="Start typing patient name here......." required value=""
                                           autocomplete="off"/>
                                    <input type="hidden" name="patient_id" value="" id="patient_id">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 hidden" id="phone_exists">
                                <div class="from-group">
                                    <label class="">Phone <span class="text-danger dark"> *</span></label>
                                    <div class="section mt-1">
                                        <label class="field">
                                            <input type="text" placeholder="Phone" class="gui-input form-control"
                                                   id="phone_exist" name="phone_exist" value="" aria-required="true">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 hidden" id="email_exists">
                                <label class="">Email <span class="text-danger dark"> *</span></label>
                                <div class="section mt-1">
                                    <label class="field">
                                        <input type="text" name="email_exist" value="" placeholder="Email" class="gui-input form-control"
                                               id="email_exist" aria-required="true">
                                    </label>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /Existing-patient-closed-here...  -->


                    <!-- New-patient...  -->
                    <div class="row mt-3 hidden" id="new_patient">
                        <div class="col-md-12 col-lg-12 col-sm-12">


                            <div class="form-row">

                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger dark"> *</span></label>
                                        <input type="text" name="name" value="" required id="name" placeholder="First Name"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger dark"> *</span></label>
                                        <input type="text" name="lname" value="" required id="lname" placeholder="Last Name"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger dark"> *</span></label>
                                        <input type="text" name="email" required id="optional_email" value=""
                                               placeholder="Email"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger dark"> *</span></label>
                                        <input type="text" name="phone" value="" required id="phone" placeholder="Phone"
                                               class="form-control">
                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                    <div class="form-group">
                                        <label>Date Of Birth <span class="text-danger dark"> *</span></label>
                                        <input type="text" name="dob" id="dob" value="" required placeholder="Date of Birth"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">

                                    <div class="form-group mb-3 mb-md-2">
                                        <label class="d-block font-weight-semibold">Contact Method</label>

                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" name="is_email" value="1"
                                                   class="custom-control-input" id="email-notification" data-fouc="">
                                            <label class="custom-control-label" for="email-notification">
                                                Email
                                            </label>
                                        </div>

                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" name="is_sms" value="1" class="custom-control-input"
                                                   id="sms-notification" data-fouc="">
                                            <label class="custom-control-label" for="sms-notification">
                                                SMS
                                            </label>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- /New-patient-closed-here...  -->


                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="text-uppercase mt-2 mb-1 font-size-lg">Invoice Details</div>
                        </div>
                    </div>

                    <hr class="solid">
                    <div class="row">

                        <div class="col-md-4 col-lg-2">
                            <div class="form-group">    
                                <label>Invoice Number</label>
                                <input type="text" name="invoice_no" placeholder="Inovice Number" value="INV00<?=$nextIncrementID->AUTO_INCREMENT; ?>" class="form-control"
                                       readonly="">
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-2">
                            <div class="form-group">
                                <label>Creation Date <span class="text-danger dark"> *</span></label>
                                <input type="text" name="created_date" required id="creation_date" placeholder="Creation Date"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-2">
                            <div class="form-group">
                                <label>Due Date <span class="text-danger dark"> *</span></label>
                                <input type="text" name="due_date" required id="due_date" placeholder="Due Date"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-2">
                            <div class="form-group">
                                <label>Discount Amount</label>
                                <input type="text" name="discount_amount" id="discount_amount"
                                       placeholder="Discount Amount" onblur="ServiceEntriesCalc()"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-2">
                            <div class="form-group">
                                <label>Deposit Credit</label>
                                <input type="text" name="deposit_credit" id="deposit_credit"
                                       onblur="ServiceEntriesCalc()"
                                       placeholder="Deposit Credit" class="form-control">
                            </div>
                        </div>

                    </div>

                    <hr class="solid">
                    <div class="">


                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Add Service Entries</label>
                                    <select name="entry_type" id="entry_type" class="form-control">
                                        <option value="" selected>Select an option</option>
                                        <option value="0">Add Custom Entry</option>
                                        <?php
                                        if ($services) {
                                            foreach ($services as $service) {
                                                ?>
                                                <option value="<?= $service['pk_service_id']; ?>"
                                                        data-price="<?= $service['price']; ?>"
                                                        data-service_name="<?= $service['title']; ?>"><?= $service['title']; ?> - $<?= $service['price']; ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="d-block">&nbsp;</label>
                                    <button type="button" id="add_entry" class="btn btn-light">+ Add Entry</button>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row mt-3">
                        <div class="col-md-12 col-lg-12">
                            <div class="text-uppercase font-size-lg">Invoice Summary</div>
                        </div>
                    </div>

                    <hr class="solid mb-3">

                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <table class="table" id="invoicetable" width="100%">
                                <thead>
                                <tr>
                                    <th width="80%">Description</th>
                                    <th width="20%" class="" colspan="2">Amount</th>
                                </tr>
                                </thead>
                                <tbody class="entry_desc">


                                </tbody>
                                <tfoot>
                                <tr>
                                    <td width="80%" class="text-right">
                                        <input type="hidden" name="sub_total" id="sub_total" value="0">Sub Total
                                    </td>
                                    <td width="20%" class="" colspan="2">$<span id="sub_total_text">0</span></td>
                                </tr>
                                <tr>
                                    <td width="80%" class="text-right">Discount</td>
                                    <td width="20%" class="" colspan="2">$<span id="discount_text">0</span></td>
                                </tr>
                                <tr>
                                    <td width="80%" class="text-right">Deposit Credit</td>
                                    <td width="20%" class="" colspan="2">$<span id="credit_text">0</span></td>
                                </tr>
                                <tr>
                                    <td width="80%" class="text-right">
                                        <input type="hidden" name="total" id="total" value="0">Total
                                    </td>
                                    <td width="20%" class="" colspan="2">$<span id="total_text">0</span></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12 col-lg-12">
                            <div class="text-uppercase font-size-lg">Payment Option</div>
                        </div>
                    </div>

                    <hr class="solid mb-2">

                    <div class="row">
                        <div class="col-md-6 col-lg-6">

                            <div class="form-group">
                                <label>Select Payment Option</label>
                                <select name="payment_option" onchange="show_div(this.value);" class="form-control">
                                    <option value="" selected>Select Option</option>
                                    <option value="1">Process Credit / Debit Card Payment</option>
                                    <option value="2">Paid by Cash</option>
                                    <option value="3">Paid by Check</option>
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
                        <a href="<?= base_url('doctor/invoices/'); ?>" class="btn btn-primary">Back</a>
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

    $(function () {

        $("#creation_date").datepicker({
            dateFormat: 'd MM, yy'
        });

        $("#dob").datepicker({
            dateFormat: 'd MM, yy'
        });

        $("#due_date").datepicker({
            dateFormat: 'd MM, yy',
            changeYear: true,
            changeMonth: true
        });

        // Initialize
        var validator = $('.admin-form-validate').validate({

            /*ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields*/
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

    function load_fields(patient_type) {

        if (patient_type == "new_patient") {
            $("#existing_patient").addClass("hidden");
            $("#new_patient").removeClass("hidden");
        } else if (patient_type == "existing_patient") {
            $("#new_patient").addClass("hidden");
            $("#existing_patient").removeClass("hidden");
        }
    }

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
        if(entry_type == '')
        {
            alert("Select service entry");
            return false;
        }


        if (entry_type != 0) 
        {
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
            $("#entry_type").val("");
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
                    $("#entry_type").val("");
                    ServiceEntriesCalc()

                } else {

                }
            });

        }


    });

    $(document).on("click", ".delete_btn", function () {
        $(this).parent().parent().remove();
        ServiceEntriesCalc()
    })

    $(function () {

        var widgetInst = $("#select_patient").autocomplete({

            source: function (request, response) {
                $.ajax({
                    url: "<?=base_url('doctor/patients/search_patient/');?>",
                    dataType: "json",
                    method: "post",
                    data: {
                        p: request.term,
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function (event, ui) {

                if (ui.item.patient_user_id > 0) {

                    $("#patient_id").val(ui.item.patient_user_id)
                    if (ui.item.patient_email == "" && ui.item.patient_phone != "") {
                        $("#email_exists").removeClass('hidden');
                        $("#phone_exists").addClass('hidden');
                        $("#email_exist").val('');
                    } else if (ui.item.patient_phone == "" && ui.item.patient_email != "") {
                        $("#phone_exists").removeClass('hidden');
                        $("#email_exists").addClass('hidden');
                        $("#phone_exist").val('');
                    } else if (ui.item.patient_phone == "" && ui.item.patient_email == "") {
                        $("#email_exists").removeClass('hidden');
                        $("#phone_exists").removeClass('hidden');
                        $("#email_exist").val('');
                        $("#phone_exist").val('');
                    } else if (ui.item.patient_phone != "" && ui.item.patient_email != "") {
                        $("#email_exists").addClass('hidden');
                        $("#phone_exists").addClass('hidden');
                    }

                }


            }


        }).data('ui-autocomplete');

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