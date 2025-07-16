<style type="text/css">
   
        .info-msg,
        .success-msg,
        .warning-msg,
        .error-msg {
                margin: 10px 0;
                padding: 10px;
                border-radius: 3px 3px 3px 3px;
        }
        .success-msg {
                color: #270;
                background-color: #DFF2BF;
        }

</style>

<div class="row">
    <div class="col-md-12 col-lg-12">
        
        <div class="row">
        <div class="col-md-2 col-lg-2">&nbsp;</div>
        <input type ="hidden" name=""  class="step_name" value="Success">
        <input type ="hidden" name=""  class="lastIndex" value="<?=$lastindex;?>">
        
        <div class="col-md-8 col-lg-8">
            <div class="form-group">
                <div class="success-msg">
                    <i class="fa fa-check"></i>
                    Widget form  has been submitted successfully.
                </div>
            </div>
        </div>

        <div class="col-md-2 col-lg-2">&nbsp;</div>
        </div>  
 
    </div>
</div>