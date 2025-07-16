<style type="text/css">
    .sidebar-secondary{
        width: 12rem;
    }
</style>
<div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md" >

    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-secondary-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">Appointment Settings</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>

    <div class="sidebar-content">


        <!-- Notifications -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">Appointment Settings</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <!-- <a class="list-icons-item" data-action="collapse"></a> -->
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <ul class="nav nav-sidebar" data-nav-type="accordion">

                    <li class="nav-item">
                        <a href="<?=base_url('doctor/appointment/availability/'); ?>" class="nav-link sub <?php if($active_mini_sidebar == "manage_availability"){echo "active"; }?>">Set Availability</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url('doctor/appointment/manage_holidays/'); ?>" class="nav-link sub <?php if($active_mini_sidebar == "manage_holidays"){echo "active"; }?>">Set Holidays</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url('doctor/appointment/services/'); ?>" class="nav-link sub <?php if($active_mini_sidebar == "services"){echo "active"; }?>">Manage Services</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url('doctor/appointment/extra_services/'); ?>" class="nav-link sub <?php if($active_mini_sidebar == "extra_services"){echo "active"; }?>">Manage Extra Services</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url('doctor/appointment/manage_appointment_category/'); ?>" class="nav-link sub <?php if($active_mini_sidebar == "appointment_cat"){echo "active"; }?>">Appointment Categories</a>
                    </li>

                </ul>
            </div>

        </div>
        <!-- /Notifications -->

    </div>

</div>