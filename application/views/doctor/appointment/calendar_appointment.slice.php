@extends('layout.master_doctor')
@section('title','Manage Appointment')
@section('content')

<style>

    .fc-content {
        margin: 5px;
        border: 1px solid;
        background: #fff;
    }

    .fc-content hr.bar {
        margin: 0;
        border-width: 5px;
    }

    .event_body {
        padding: 5px;
        font-size: 12px;
    }



    .time {
        font-size: 12px;
        font-weight: 900;
    }

    hr.separator {
        margin-top: 10px;
        margin-bottom: 10px;
    }

</style>
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4><span class="font-weight-semibold">Manage Appointments</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <a href="<?= base_url("doctor/appointment/add_appointment"); ?>"
                       class="btn btn-outline-primary btn-sm"><span>Add Appointment</span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <section class="content">
        <div class="card">
            <div class="card-body">
                <?= __message() ?>
                <div id="calendar" class="">
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal" id="mymodal" style="border-radius:5px;" tabindex="-1" role="dialog">
    <div class="modal-dialog w-50" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display:block;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4>Appointment Detail</h4>
            </div>
            <div class="modal-body">
                <div id="patient_detail"></div>
                <h4 class="mt-3">Options</h4>
                <hr class="solid">
                <div class="row">
                    <span class="col-md-6 col-sm-6 col-lg-6" id="appointment_links" style="line-height:2;"></span>
                    <span class="col-md-6 col-sm-6 col-lg-6" id="patient_links" style="line-height:2;"></span>
                </div>
                <h4 class="mt-3">Appointment Category</h4>
                <hr class="solid">
                <div class="form-group row">
                    <?php if ($categories) { ?>
                        <div class="col-md-6 col-sm-6">
                            <label>Click here to change appointment category</label>
                            <select name="appointment_category" id="app_cat" class="form-control pull-left">
                                <?php

                                foreach ($categories as $category) {

                                    ?>
                                    <option value="<?= $category['pk_app_categoryid'] ?>"><?= $category['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')


<link rel="stylesheet" href="<?= base_url('assets/plugins/jAlert-master/jAlert.css'); ?>">
<script type="text/javascript" src="<?= base_url('assets/plugins/jAlert-master/jAlert.min.js'); ?>"></script>

<!--<link rel="stylesheet" href="<? /*=base_url('assets/plugins/fullcalendar-new/lib/main.min.css');*/ ?>">
    <script type="text/javascript" src="<? /*=base_url('assets/plugins/fullcalendar-new/lib/main.min.js'); */ ?>"></script>
    <script type="text/javascript" src="<? /*=base_url('assets/plugins/fullcalendar-new/lib/locales-all.min.js'); */ ?>"></script> -->

<script src="<?= base_url("assets/global_assets/js/plugins/ui/fullcalendar/core/main.min.js") ?>"></script>
<script src="<?= base_url("assets/global_assets/js/plugins/ui/fullcalendar/daygrid/main.min.js") ?>"></script>
<script src="<?= base_url("assets/global_assets/js/plugins/ui/fullcalendar/timegrid/main.min.js") ?>"></script>
<script src="<?= base_url("assets/global_assets/js/plugins/ui/fullcalendar/interaction/main.min.js") ?>"></script>


<script type="text/javascript" language="javascript" class="init">

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['dayGrid'],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
            },

            editable: false,
            events: "<?=base_url("doctor/appointment/calendar_appointment/")?>",
            eventRender: function (event, element, view) {

                var event_template = '<div class="fc-content event_container">' +
                    '<hr class="bar" style="border-color: '+event.event.extendedProps.app_cat_color+'">' +
                    '<div class="event_body">' +
                    '<div class="time">'+event.event.title+'</div>' +
                    '<div class="data hidden">'+JSON.stringify(event.event.extendedProps)+'</div>' +

                    '<hr class="separator">' +

                    '<div>'+event.event.extendedProps.patient_name+'</div>' +
                    '<div>'+event.event.extendedProps.patient_phone+'</div>' +
                    '<div>'+event.event.extendedProps.patient_email+'</div>' +
                    '<hr class="separator">' +
                    '<div><i class="fa fa-circle '+event.event.extendedProps.appointment_color+'-800"></i> '+event.event.extendedProps.appointment_status+'</div>' +
                    '</div>' +
                    '</div>'
                return $(event_template);
            },
            eventClick:function(event){
                console.log(event)

            },

            /*eventDidMount: function(info,event,el)
            {
                if(info.event.extendedProps.background)
                {
                  info.el.style.background = info.event.extendedProps.background;
                  info.el.style.color = info.textColor;

                }
            },*/

            /* eventContent: function(arg)
             {
                 console.log(arg);
                 return {
                          html: '<div class="container text-dark cursor-pointer mt-0" style="border-top:12px solid '+arg.event._def.extendedProps.app_cat_color+';">'
                                 +'<span class="uncategorized_css"></span>'
                                 +'<span class"collapsable"><h5><b>'+arg.event.title+'</b></h5>'
                                 +'<p>'+arg.event._def.extendedProps.patient_email+'</p><hr>'+
                                 '<p><b>'+arg.event._def.extendedProps.patient_name+'</b></p>'+
                                 '<p>Age: 15 Yrs</p>'+
                                 '</span>'+
                                 '<span style="padding-top:0px"></span></div>'
                        }
             },*/

            eventResize: function (info) {

            },

            /*eventClick: function(info){

                  //console.log(info);
                  var desc = info.event._def.extendedProps.description;
                  var app_id = info.event._def.extendedProps.pk_appointment_id;
                  var app_categoryid = info.event._def.extendedProps.fk_app_category_id;
                  var link = info.event._def.extendedProps.link;
                  var link_patient = info.event._def.extendedProps.link_patient;


                  $("#mymodal").modal('show');
                  $('#patient_detail').html(desc);
                  $("#appointment_links").html(link);
                  $("#patient_links").html(link_patient);
                  $("#app_cat").val(app_categoryid);

                  $("#app_cat").change(function(){
                  var id = $(this).val();
                  if(id != 0)
                  {
                    confirmationbox(function(res){
                    if(!res)
                    {
                      $("#app_cat").val(app_categoryid);
                      return false;
                    }
                    else
                    {
                      $.post("<?=base_url('doctor/appointment/update_appointment_category');?>",{category_id : id,appointment_id : app_id},function(data){
                  location.reload();
                  });
                }
              });
            }


           });

          } */
        });

        calendar.render();

        

    });
    
    $(document).on("click",".event_container",function(){
        data = $(this).find(".data").text();
        data = JSON.parse(data);
        console.log(data);
        $.dialog({
            title:'',
            content: function () {
                var self = this;
                return $.ajax({
                    url: 'https://craftpip.github.io/jquery-confirm/bower.json',
                    dataType: 'json',
                    method: 'get'
                }).done(function (response) {
                    self.setContent('Description: ' + response.description);
                    self.setContentAppend('<br>Version: ' + response.version);
                    self.setTitle('');
                }).fail(function(){
                    self.setContent('Something went wrong.');
                });
            }
        });
    })

    function confirmationbox(callback) {

        var b = $.jAlert({
            'title': 'Confirm!',
            'content': "Are you sure you want to change this category ?",
            'theme': 'blue',
            'btns':
                [
                    {
                        'text': 'Yes',
                        'theme': 'green',
                        'onClick': function (e, btn) {
                            callback(true);
                        }
                    },
                    {
                        'text': 'No',
                        'theme': 'default',
                        'onClick': function (e, btn) {
                            callback(false);
                        }
                    }
                ]
        });

    }

</script>
@endsection