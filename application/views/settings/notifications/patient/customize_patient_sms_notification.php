        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="d-flex page-title pb-2 pt-2">
                    <h4> <span class="font-weight-semibold"><?php if($sms_template['title'] != "" ){echo $sms_template['title']; }else{echo "SMS Notification"; }?></span></h4>
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
                      <div class="form-group"> 
                        <label>Title<span class="text-danger dark"> * </span></label>
                        <div class="mb10">
                            <input type="text" name="template_title" value="<?=$sms_template['title'];?>" class="form-control" required placeholder="Template Title"
                                    id="template_title">
                        </div>
                    </div>
                    </div>

                </div>


                 <div class="form-row "> 

                    <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12 ">
                      <div class="form-gorup">
                        <label>Body<span class="text-danger dark"> * </span></label>
                        <div class="mb10">
                            <textarea name="body" class="form-control" rows="6" required 
                                    id="body" placeholder="Start typing here..."><?=$sms_template['body'];?></textarea>
                        </div>
                    </div>
                  </div> 
                </div>
              <hr class="solid">
             <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </div>

        </form>
      </div>
      </section>
