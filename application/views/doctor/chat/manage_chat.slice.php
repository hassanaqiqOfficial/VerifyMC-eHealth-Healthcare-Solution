@extends('layout.master_doctor')
@section('title', 'Messaging')
@section('bodyClass','sidebar-xs')
@section('content')


<!-- Secondary sidebar -->
<div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-secondary-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">Contacts</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">


        <!-- Contacts -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">Contacts</span>
                <div class="header-elements">
                    <!-- <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div> -->
                </div>
            </div>

            <div class="card-body">
                <ul class="media-list" id='chatListContainer'>
              
                </ul>
            </div>
        </div>
        <!-- /contacts -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /secondary sidebar -->

   <!-- Content wraper -->
   <div class="content-wrapper">
        
        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="d-flex page-title pb-1 pt-1">
                

                <a href="javascript void:(0)" class="sidebar-right-toggle">
                    <img src="" width="38" height="38" class="rounded-circle hidden" alt="">
                </a>
                <h4 class="m-1 ml-2">
                    <span class="font-weight-semibold">
                    Select Patient      
                    </span>
                </h4>
                <a href="#" class="header-elements-toggle sidebar-mobile-right-toggle text-default d-md-none">
                    <i class="icon-more"></i>
                </a>

                </div>


            </div>
        </div>
        <!-- /page header -->


        <!-- content -->
        <div class="content">

            <div class="card h-100" id='dashboardContainer'>

                <div class="card-body" id="">
                     Welcome to the world of conversation
                </div>

            </div>



            <div class="card hidden h-100" id='chatContainer'>

               

            </div>

        </div>
        <!-- /content closed  -->
    
   </div>
   <!-- /Content wraper closed-->

   <!-- Right sidebar -->
   <div class="sidebar sidebar-light sidebar-right sidebar-expand-md">

        <!-- Sidebar mobile toggler -->

        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
            <span class="font-weight-semibold">Doctor Profile</span>
            <a href="#" class="sidebar-mobile-right-toggle">
                <i class="icon-arrow-right8"></i>
            </a>
        </div>

        <!-- /sidebar mobile toggler -->


        <!-- Sidebar content -->
        <div class="sidebar-content">

            <!-- User info -->
            <div class="card card-body text-center"
                style="background-image: url(<?=base_url('assets/global_assets/images/backgrounds/panel_bg.png'); ?>); background-size: contain;">
            
                <a href="#" class="d-inline-block mr-auto sidebar-right-toggle">
                    <i class="icon-arrow-right16 mr-2"></i>
                </a>

                <a href="javascript void:(0)" class="d-inline-block mb-3">
                    <!-- <?php if($doctor['doctor_image'] && $doctor['doctor_image'] != "") { ?>
                        <img src="<?=base_url($doctor['doctor_image']); ?>" class="rounded-round" width="110"
                            height="110" alt="">
                    <?php } else { ?>
                        <img src="<?=base_url('assets/img/placeholder.png'); ?>" class="rounded-round" width="110"
                            height="110" alt="">
                    <?php } ?> -->
                </a>

                <div class="mb-1">
                    <h5 class="mb-0 mt-0">
                        
                    </h5>
                    <span class="d-block"></span>
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
   <!-- /Right sidebar -->

   <!-- Chat List Template -->
   <div class="hidden">
        <script type="text/html" id='chatListWrapper'>
            <li class="media contactlist" >
                <%=patientData%>
                <a href="#" class="mr-3 position-relative"> 
                    <% if(patient_photo && patient_photo != '') { %>
                        <img src="<%=patient_photo%>" class="rounded-round" width="36"
                                height="36" alt="">
                    <% } else { %>
                        <img src="<?=base_url('assets/img/placeholder.png'); ?>" class="rounded-round" width="36"
                                height="36" alt="">
                    <% } %>
                    <span class="badge badge-info badge-pill badge-float border-2 border-white">6</span>
                </a>

                <div class="media-body">
                    <div class="font-weight-semibold"><%=patient_fname+' '+patient_lname %></div>
                    <div class="font-size-sm text-muted" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width: 138px;" ><%=message %></div>
                </div>

                <div class="ml-3 align-self-center">
                    <div class="dropdown">
                        <a href="#" class="text-default dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false"><i class="icon-more2"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-164px, 17px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Start chat</a>
                            <a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a call</a>
                            <a href="#" class="dropdown-item"><i class="icon-mail5"></i> Send mail</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Statistics</a>
                        </div>
                    </div>
                </div>
            </li>
        </script>
   </div>
   <!-- /Chat List Template -->

   <!-- Message containter Template -->
   <div class="hidden">
        <script type="text/html" id='MessageContainerWrapper'>
            <div class="card-body ">

                <ul class="media-list media-chat media-chat-scrollable mb-3" id='messageContainer'>
                    
                </ul>

                
               
            </div>
            <div class="card-footer">
            <textarea name="enter-message" class="form-control mb-3 " rows="3" cols="1" placeholder="Enter your message..."></textarea>

<div class="d-flex align-items-center ">
                <div class="list-icons list-icons-extended">
                    <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Send photo"><i class="icon-file-picture"></i></a>
                    <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Send video"><i class="icon-file-video"></i></a>
                    <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Send file"><i class="icon-file-plus"></i></a>
                </div>

    <button type="button" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-auto"><b><i class="icon-paperplane"></i></b> Send</button>

    </div>
    </div>
        </script>
   </div>
   <!-- /Message containter Template -->

   <!-- Message wraper Template -->
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
   <!-- /Message wraper Template -->

@endsection
@section('scripts')

<script type="text/javascript">
    
    var BASEURL = '<?=BASEURL?>';
    var SOCKETURL = '<?=SOCKETURL?>';
    var USERTYPE = 0;
    var PATIENTID = 0;
    var DOCTORID = <?=$doctorID;?>
  
</script>

<script type="text/javascript" src="<?=base_url('assets/js/chatjs/scrollpagination.js')?>"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/underscore@1.13.1/underscore-umd-min.js"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/socket-io/socket.io.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/chatjs/socketEvent.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/chatjs/chatMain.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/chatjs/chatGeneralEvent.js')?>"></script>

@endsection