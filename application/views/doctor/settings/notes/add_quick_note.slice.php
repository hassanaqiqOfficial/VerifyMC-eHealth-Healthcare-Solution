@extends('layout.master_doctor')
@section('title', 'Quick Note')
@section('content')

<div class="content-wrapper">


    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">
                <?php if(isset($fkid) && !empty($fkid)){ ?>
                    Edit Quick Note
                <?php }else{ ?>
                    Add Quick Note
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

    <section class="content">

        <div class="card">
            <form action="" method="post" class="admin-form-validate" enctype="mulipart/form-data" id="myform">
                <div class="card-body">

                    <div class="form-row ">

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                            <label>Title<span class="text-danger dark"> * </span></label>
                            <div class="">
                                <input type="text" name="note_title" value="<?=$note['title'];?>" class="form-control" placeholder="Quick Note Title" required
                                       id="template_title">
                            </div>
                        </div>


                    </div>

                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-2">
                            <label>Description<span class="text-danger dark"> * </span></label>
                            <div class="">
                                <textarea name="note_description" class="form-control" placeholder="Start typing here..." required rows="5"><?=$note['description'];?></textarea>
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

<script type="text/javascript" src="<?=base_url('assets/global_assets/js/plugins/forms/validation/validate.min.js'); ?>"></script>

<script type="text/javascript">
  $(document).ready(function(){

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
     
                note_title : {

                    required : "Please enter the title."
                }
                
            }

        });

  });

</script>
@endsection

