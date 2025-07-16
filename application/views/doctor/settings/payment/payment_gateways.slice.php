@extends('layout.master_doctor')
@section('title', 'Payment Gateways')
@section('content')


<div class="content-wrapper">

     <!-- Page header -->
     <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">Payment Gateways</span></h4>
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
        <form action="" method="post" class="admin-form-validate" id="myform">
            <div class="card">

                <div class="card-body">
                  <?=__message()?>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="mb-2 text-uppercase">Select Payment Gateway</div>
                        </div>
                    </div>

                    <div class="form-group mb-3 mb-md-2">
                       
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input gateway" name="payment_gateways" value="square_payment" onchange="load_fields('square_payment',this)" id="custom_radio_inline_square">
                            <label class="custom-control-label" for="custom_radio_inline_square">Square</label>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input gateway" name="payment_gateways" value="strip_payment" onchange="load_fields('strip_payment',this)" id="custom_radio_inline_strip">
                            <label class="custom-control-label" for="custom_radio_inline_strip">Strip</label>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input gateway" name="payment_gateways" value="authorize_payment" onchange="load_fields('authorize_payment',this)" id="custom_radio_inline_authorize">
                            <label class="custom-control-label" for="custom_radio_inline_authorize">Authorize</label>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input gateway" name="payment_gateways" value="paypal_payment" onchange="load_fields('paypal_payment',this)" id="custom_radio_inline_paypal"  checked="">
                            <label class="custom-control-label" for="custom_radio_inline_paypal">Paypal Pro</label>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input gateway" name="payment_gateways" value="nmi_payment" onchange="load_fields('nmi_payment',this)" id="custom_radio_inline_nmi">
                            <label class="custom-control-label" for="custom_radio_inline_nmi">NMI</label>
                        </div>

                    </div>

                   
                </div>

            </div>
            <div class="card">

                <div class="card-body">

                    <div class="form-group hidden " id="paymeny_square">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                              <div class="mb-2 text-uppercase">Enter Square Payment Gateway Details</div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-8 col-lg-8">

                                <div class="form-group">
                                    <label>Application ID</label>
                                        <input type="text" name="application_id" value="" placeholder="APPLICATION ID" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Access Token</label>
                                        <input type="text" name="access_token" value="" placeholder="ACCESS TOKEN" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Location ID</label>
                                        <input type="text" name="location_id" value="" placeholder="LOCATION ID" class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="form-group hidden " id="paymeny_strip">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                              <div class="mb-2 text-uppercase">Enter Strip Payment Gateway Details</div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-8 col-lg-8">

                                <div class="form-group">
                                    <label>API Secret Key</label>
                                        <input type="text" name="api_secret_key" value="" placeholder="API SECRET KEY" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>API Public Key</label>
                                        <input type="text" name="api_public_key" value="" placeholder="API PUBLIC KEY" class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="form-group hidden  " id="paymeny_authorize">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                              <div class="mb-2 text-uppercase">Enter Authorize Payment Gateway Details</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-lg-8">

                                <div class="form-group">
                                    <label>Payment Mode</label>
                                        <select name="payment_environment_authorize" class="form-control">
                                            <option value="">Select Option</option>
                                            <option value="sandbox">Sand Box</option>
                                            <option value="production">Production</option>
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label>Authorize.net Login ID</label>
                                        <input type="text" name="authorizenet_login_id" value="" placeholder="AUTHORIZE.NET LOGIN ID" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Authorize.net Transaction Key</label>
                                        <input type="text" name="authorizenet_transaction_key" value="" placeholder="AUTHORIZE.NET TRANSACTION KEY" class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="form-group " id="paymeny_paypal">
                     <div class="row">
                            <div class="col-md-12 col-lg-12">
                              <div class="mb-2 text-uppercase">Enter Paypal Pro Payment Gateway Details</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-lg-8">

                                <div class="form-group">
                                    <label>Payment Mode</label>
                                        <select name="payment_environment_paypal" class="form-control">
                                            <option value="">Select Option</option>
                                            <option value="sandbox">Sand Box</option>
                                            <option value="production">Production</option>
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label>API Username</label>
                                        <input type="text" name="api_username" value="" placeholder="API USERNAME" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>API Password </label>
                                        <input type="text" name="api_password" value="" placeholder="API PASSWORD" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>API Signature </label>
                                        <input type="text" name="api_signature" value="" placeholder="API SIGNATURE" class="form-control">
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="form-group hidden  " id="paymeny_nmi">
                      <div class="row">
                            <div class="col-md-12 col-lg-12">
                              <div class="mb-2 text-uppercase">Enter NMI Payment Gateway Details</div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-8 col-lg-8">

                                <div class="form-group">
                                    <label>Username</label>
                                        <input type="text" name="nmi_username" value="" placeholder="NMI USERNAME" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Password </label>
                                        <input type="text" name="nmi_password" value="" placeholder="NMI PASSWORD" class="form-control">
                                </div>

                            </div>
                        </div>
                     </div>

                 <div class="form-group mb-0">
                   <button type="submit" class="btn btn-primary">Submit</button>
                 </div>

                </div>

            </div>
        </form>
    <section> 
  </div>   

  @endsection
  @section('scripts')
   
    <script type="text/javascript">
     
      function load_fields(gateway,t)
      {
         if(gateway == "square_payment")
         {
             $("#paymeny_square").removeClass("hidden");
             $("#paymeny_strip").addClass("hidden");
             $("#paymeny_authorize").addClass("hidden");
             $("#paymeny_paypal").addClass("hidden");
             $("#paymeny_nmi").addClass("hidden");
         }
         else if(gateway == "strip_payment")
         {
             $("#paymeny_strip").removeClass("hidden");
             $("#paymeny_square").addClass("hidden");
             $("#paymeny_authorize").addClass("hidden");
             $("#paymeny_paypal").addClass("hidden");
             $("#paymeny_nmi").addClass("hidden");
         }
         else if(gateway == "authorize_payment")
         {
             $("#paymeny_authorize").removeClass("hidden");
             $("#paymeny_square").addClass("hidden");
             $("#paymeny_strip").addClass("hidden");
             $("#paymeny_paypal").addClass("hidden");
             $("#paymeny_nmi").addClass("hidden");
         }
         else if(gateway == "paypal_payment")
         {
             $("#paymeny_paypal").removeClass("hidden");
             $("#paymeny_square").addClass("hidden");
             $("#paymeny_authorize").addClass("hidden");
             $("#paymeny_strip").addClass("hidden");
             $("#paymeny_nmi").addClass("hidden");
         }
         else if(gateway == "nmi_payment")
         {
             $("#paymeny_nmi").removeClass("hidden");
             $("#paymeny_square").addClass("hidden");
             $("#paymeny_authorize").addClass("hidden");
             $("#paymeny_strip").addClass("hidden");
             $("#paymeny_paypal").addClass("hidden");
         }
      }
    </script>
  @endsection


