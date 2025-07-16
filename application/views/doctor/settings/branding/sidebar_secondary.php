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
        <span class="font-weight-semibold">Branding</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>

    <div class="sidebar-content">


        <!-- Notifications -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">Branding</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <!-- <a class="list-icons-item" data-action="collapse"></a> -->
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <ul class="nav nav-sidebar" data-nav-type="accordion">

                    <li class="nav-item">
                        <a href="<?=base_url('doctor/settings/app_logo/'); ?>" class="nav-link sub <?php if($active_mini_sidebar == "app_logo"){echo "active"; }?>">Logo Setting</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url('doctor/settings/email_header_setting/'); ?>" class="nav-link sub <?php if($active_mini_sidebar == "email_header"){echo "active"; }?>">Email Design</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url('doctor/settings/Invoice_customization/'); ?>" class="nav-link sub <?php if($active_mini_sidebar == "invoice_customization"){echo "active"; }?>">Invoice Design</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url('doctor/settings/calendar_customization/'); ?>" class="nav-link sub <?php if($active_mini_sidebar == "calendar_customization"){echo "active"; }?>">Calendar Design</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url('doctor/settings/manage_favicon/'); ?>" class="nav-link sub <?php if($active_mini_sidebar == "favicon"){echo "active"; }?>">Favicon</a>
                    </li>

                </ul>
            </div>

        </div>
        <!-- /Notifications -->

    </div>

</div>