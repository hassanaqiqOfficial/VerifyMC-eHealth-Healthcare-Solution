<style type="text/css">
    .sidebar-secondary{
        width: 12rem;
    }
</style>
<div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md">

    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-secondary-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">Notifications</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <div class="sidebar-content">
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">Notifications Setting</span>
                <div class="header-elements">
                    <div class="list-icons">
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <ul class="nav nav-sidebar" data-nav-type="accordion">
                    <li class="nav-item">
                        <a href="<?= base_url('doctor/notifications/customize_patient_notification'); ?>"
                           class="nav-link sub <?php if ($active_mini_sidebar == "customize_patient_notification") {
                               echo "active";
                           } ?>">Patient Email's & SMS's</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('doctor/notifications/customize_doctor_notification'); ?>"
                           class="nav-link sub <?php if ($active_mini_sidebar == "customize_doctor_notification") {
                               echo "active";
                           } ?>"> Doctor Email's & SMS's</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('doctor/notifications/custom_email'); ?>"
                           class="nav-link sub <?php if ($active_mini_sidebar == "custom_email") {
                               echo "active";
                           } ?>">Custom Email</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('doctor/notifications/custom_sms'); ?>"
                           class="nav-link sub <?php if ($active_mini_sidebar == "custom_sms") {
                               echo "active";
                           } ?>">Custom SMS
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>