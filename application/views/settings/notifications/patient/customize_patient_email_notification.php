     
     <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold"><?php if($email_template['title'] != "" ){echo $email_template['title'];}else{echo "Email Notification"; }?></span></h4>
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
                            <input type="text" name="template_title" value="<?=$email_template['title'];?>" class="form-control" required placeholder="Template Title"
                                    id="template_title">
                        </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                       <div class="form-group">
                        <label>Subject<span class="text-danger dark"> * </span></label>
                        <div class="mb10">
                            <input type="text" name="subject" value="<?=$email_template['subject'];?>" class="form-control" required placeholder="Subject"
                                    id="subject">
                        </div>
                        </div>
                    </div>

                </div>


                 <div class="form-row "> 

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                      <div class="form-group">
                        <label>Body<span class="text-danger dark"> * </span></label>
                        <div class="mb10">
                            <textarea name="body" class="ckeditor" required 
                                    id="body"><?=$email_template['body'];?></textarea>
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

