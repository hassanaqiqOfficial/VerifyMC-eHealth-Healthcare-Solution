@extends('layout.master_user')
@section('title', 'View Patient')
@section('bodyClass','sidebar-right-visible sidebar-xs')
@section('content')




<div class="content-wrapper">
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            
            <div class="d-flex page-title pb-1 pt-1">
            
                <a href="javascript:void(0)" class="">
                    <img src="<?=base_url($doctor['doctor_image']);?>" width="38" height="38" class="rounded-circle" alt="">
                </a>
                <h4 class="m-1 ml-2">
                    <span class="font-weight-semibold">
                        <?=$doctor['doctor_name'];?>    
                    </span>
                </h4>
                <a href="#" class="header-elements-toggle sidebar-mobile-right-toggle text-default d-md-none">
                    <i class="icon-more"></i>
                </a>

            </div>

            <a href="#" class="d-inline-block sidebar-right-toggle">
                <i class="icon-arrow-right16 toggler"></i>
            </a>

        </div>
    </div>
    <!-- /page header -->


    <!-- content -->
    <div class="content">

        <div class="card h-100">

            <div class="card-body">
                
                <ul class="media-list media-chat media-chat-scrollable mb-3" id="messageContainer">

                </ul>

            </div>

            <div class="card-footer">
                <form method="POST" enctype= multipart/form-data>
                  <textarea name="messageText" id="textMessage" class="form-control mb-3" rows="1" cols="1" placeholder="Enter your message..."></textarea>

                    <div class="d-flex align-items-center">

                        <div class="list-icons list-icons-extended">
                            <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Send photo"><i class="icon-file-picture"></i></a>
                            <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Send video"><i class="icon-file-video"></i></a>
                            <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Send file"><i class="icon-file-plus"></i></a>
                        </div>

                        <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right submit ml-auto"><b><i class="icon-paperplane"></i></b>Send</button>
                
                    </div>
                </form>
            </div>

        </div>

    </div>

    <!-- /content wraper closed -->
</div>

<div class="sidebar sidebar-light sidebar-right sidebar-expand-md">

    <!-- Sidebar mobile toggler -->

    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
        <span class="font-weight-semibold">Doctor Profile</span>
    </div>

    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User info -->
        <div class="card card-body text-center"
             style="background-image: url(<?=base_url('assets/global_assets/images/backgrounds/panel_bg.png'); ?>); background-size: contain;">
           
            <a href="javascript:void(0)" class="d-inline-block mb-3">
                <?php if($doctor['doctor_image'] && $doctor['doctor_image'] != "") { ?>
                    <img src="<?=base_url($doctor['doctor_image']); ?>" class="rounded-round" width="110"
                         height="110" alt="">
                <?php } else { ?>
                    <img src="<?=base_url('assets/img/placeholder.png'); ?>" class="rounded-round" width="110"
                         height="110" alt="">
                <?php } ?>
            </a>

            <div class="mb-1">
                <h5 class="mb-0 mt-0">
                    <?=$doctor['doctor_name']; ?>
                </h5>
                <span class="d-block"><?=$doctor['doctor_email'];?></span>
            </div>

        </div>
        <!-- /user info -->

        
   
        <!-- Date stamp -->
        <div class="card">
            <div class="card-body pb-0 pt-0">
                <h4 class="font-weight-light mb-0">
                   <span class="d-block"><?=date("D"); ?>
                   <?= date("d") ?><sup>th   </sup> <?= date("M") ?></span> 
                </h4>
            </div>
        </div>
        <!-- /date stamp -->

        <!-- Sub navigation -->

        <div class="card mb-2 mt-3">
            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">Settings</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <center class="mt-2">
                    <strong>Upcomming Developments!</strong>
                    <p> Will add something @ Later stage. </p>
                </center>
            </div>
        </div>

        <!-- /sub navigation -->

    </div>
    <!-- /sidebar content -->

</div>




<div class="hidden">
    
   <script id='textMessageWrapper' type="text/html">

    <li class="media <% if(type == 1){ %> media-chat-item-reverse <% } %>">

    <% if(type == 0 ){ %>
        <div class="mr-3">
            <a href="http://localhost/applications/apptelehealth/assets/global_assets/images/demo/users/face1.jpg">
                <img src="http://localhost/applications/apptelehealth/assets/global_assets/images/demo/users/face1.jpg" class="rounded-circle" width="40" height="40" alt="">
            </a>
        </div>
    <% } %>

        <div class="media-body">
            <div class="media-chat-item"><%=message%></div>
            <div class="font-size-sm text-muted mt-2"><%=createdDateTime%><a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
        </div>

    <% if(type == 1 ){ %>
        <div class="ml-3">
            <a href="http://localhost/applications/apptelehealth/assets/global_assets/images/demo/users/face1.jpg">
                <img src="http://localhost/applications/apptelehealth/assets/global_assets/images/demo/users/face1.jpg" class="rounded-circle" width="40" height="40" alt="">
            </a>
        </div>
    <% } %>
    
    </li>
  
  </script>

</div>

@endsection

@section('scripts')

<script type="text/javascript">
    
    var BASEURL = '<?=base_url()?>';
    var SOCKETURL = '<?=SOCKETURL?>';
    var USERTYPE = 1;
    var PATIENTID = <?=$patient_id;?>;
    var DOCTORID = <?=$doctorID;?>
  
</script>

<script type="text/javascript" src="<?=base_url('assets/js/chatjs/scrollpagination.js')?>"></script>
<script src="https://cdn.jsdelivr.net/npm/underscore@1.13.1/underscore-umd-min.js"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/socket-io/socket.io.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/chatjs/socketEvent.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/chatjs/chatMain.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/chatjs/chatGeneralEvent.js')?>"></script>

@endsection