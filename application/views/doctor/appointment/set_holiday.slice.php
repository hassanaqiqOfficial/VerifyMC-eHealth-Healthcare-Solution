@extends('layout.master_doctor')
@section('title', 'Manage Availablity')
@section('bodyClass', 'sidebar-right-visible')
@section('content')

<style>



    .jqyc-table {
        table-layout: fixed;
    }

    .table-sm td, .table-sm th {
        padding: .625rem .0rem;
    }

    #my-popover {
        left: -169px !important;
    }

    #my-popover .arrow {
        left: 90%
    }

    .jconfirm .jconfirm-box div.jconfirm-title-c {
        font-size: 18px;
    }






</style>


<?php require ("application/views/doctor/appointment/appointment_setting_sidebar.php")?>


<div class="content-wrapper">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4><span class="font-weight-semibold">Manage Holidays</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <!-- <button type="submit" class="btn btn-sm btn-outline-primary" name="Update" form="myform">Update
                    </button> -->
                </div>
            </div>

        </div>
    </div>
    <section class="content">
        <div class="card" >
            <div class="card-body">
                <div class="calendar" id="holidays_tab"></div>

            </div>
        </div>
    </section>
</div>





@endsection
@section('scripts')

<link rel="stylesheet" type="text/css" href="<?= base_url('vendor/plugins/magnific-popup/magnific-popup.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/Year-Calendar/jquery.bootstrap.year.calendar.css'); ?>">
<script src="<?= base_url('assets/plugins/Year-Calendar/jquery.bootstrap.year.calendar.js'); ?>"
<script src="<?= base_url('vendor/plugins/magnific-popup/magnific-popup.js'); ?>"></script>

<script type="text/javascript">

    var holidays = <?php echo json_encode($holidays)?>;
    $(document).ready(function () {

        var date = new Date();
        $('.calendar').calendar({

            showHeaders: true,
            startYear: date.getFullYear(),

            //Max/Min day & Year
            maxYear: null,
            maxDay: null,
            maxMonth: null,
            maxDayMessage: 'You can not choose day from future',
            minYear: null,
            minDay: null,
            minMonth: null,
            minDayMessage: 'You can not choose day from past',

            boostrapVersion: 4,

            // // for custom layout
            cols: 12,
            colsSm: 6,
            colsMd: 6,
            colsLg: 4,
            colsXl: 4,

            // classic or rangepicker
            mode: 'classic',

            // adds class to day on click
            addUniqueClassOnClick: "selected",

        });

        setholidays();

        $('.calendar').on('jqyc.changeYear', function (event) {
            setholidays();
        });


        function setholidays() {
            console.log(holidays)
            $.each(holidays, function(i, holiday) {
                $('.calendar').calendar('selectedDate', holiday.year, holiday.month, holiday.day);
            });



        }

        $('.calendar').on('jqyc.dayChoose', function (event) {

            var choosenYear = $(this).data('year');
            var choosenMonth = $(this).data('month');
            var choosenDay = $(this).data('day-of-month');

            var current_date = choosenDay + '-' + choosenMonth + '-' + choosenYear;

            console.log(choosenYear);
            console.log(event);

            $.confirm({
                title: 'Set Holiday',
                content: function () {
                    var self = this;
                    return $.ajax({
                        url: '<?=base_url("doctor/appointment/get_holiday/")?>',
                        dataType: 'json',
                        data: {cdate: current_date},
                        method: 'get'
                    }).done(function (response) {
                        self.setContent(response.content);
                    }).fail(function () {
                        self.setContent('<div>Failed to load the function data.</div>');
                    });
                },

                buttons: {
                    Save: function () {
                        var formData = $("#form").serialize();
                        $.post('<?=base_url("doctor/appointment/set_holiday/"); ?>', {
                            currentDate: current_date,
                            form: formData
                        }, function (data) {

                            holidays = data;
                            $('.calendar').calendar('clearAllSelected');

                            setholidays();
                            //$('.calendar').calendar('selectedDate', 2021,03,02);


                        });
                    },
                    Close: function () {

                    }
                }


            });

        });

        // triggered when day is clicked
    });



</script>

@endsection