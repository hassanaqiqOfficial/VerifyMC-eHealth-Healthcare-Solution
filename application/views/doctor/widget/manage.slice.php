@extends('layout.master_doctor')
@section('title', 'Manage widgets')
@section('content')

<div class="content-wrapper">

     <!-- Page header -->
     <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="d-flex page-title pb-2 pt-2">
                <h4> <span class="font-weight-semibold">Manage widgets </span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <a href="<?=base_url("doctor/widgets/add");?>" class="btn btn-outline-primary btn-sm" ><span>Add widget</span></a>
                </div>
            </div>

        </div>
    </div>
    <!-- /page header -->
    <section class="content">

        <div class="card">
            
            <div class="card-body">
               <?=__message()?>
                <table class="table" id="datatable" width="100%">

                    <thead>
                    <tr>
                        <th width="75%">Widget</th>
                        <th width="25%">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>

    </section>
</div>
@endsection

@section('scripts')

<?php
    $column = array(
        
        "qtwo"=>array("search"=>'true',"sort"=>'true'),
        "three"=>array("search"=>'false',"sort"=>'false')
    );
?>

    <script src="<?=base_url('assets/global_assets/js/plugins/tables/datatables/datatables.min.js');?>"></script> 
    <script src="<?=base_url('assets/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js'); ?>"></script>
    <script src="<?=base_url('assets/global_assets/js/plugins/tables/datatables/extensions/responsive.min.js'); ?>"></script> 

<script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
    
    widgets_datatable = $("#datatable").DataTable({
 
            buttons: [
            {
                extend: 'colvis',
                text: '<i class="icon-grid7"></i>',
                className: 'btn bg-teal-400 btn-icon dropdown-toggle',
                postfixButtons: [ 'colvisRestore' ]
            }
        ],
 
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
           
        },
     
        
        "autoWidth": false,
        "iDisplayLength":25,
        "lengthMenu": [ [5,25, 50, 100, 500, -1], [5,25, 50, 100, 500, "All"] ],
        "processing": true,
        "serverSide": true,
        "order": [1,"asc"],
        "oLanguage": {
        "sSearch": "",
        "sProcessing":'',
        "sFilterInput":'',
        /*sLengthMenu: "Show_MENU_",*/
        },
 
        "aoColumnDefs": [
                <?php
                if($column)
                {
                $i = 0;
                foreach($column as $key => $value)
                {
                ?>{"bSortable": <?=$value["sort"]?>, "searchable":<?=$value["search"]?>, "aTargets": [<?=$i?>]},<?php
            $i++;
            }
            }?>
        ],
        responsive: true,
            "ajax": {
            "url" : "<?= base_url("doctor/widgets/list_widgets")?>",
            "type": "POST",
            "data": function ( d ) {
                 d.custom_filter = '';
            }
        },
 
 
 
    } );
 
 
    $("input[type=search]").attr("placeholder","Search")
 
 
    $(".alpha_filter").html($(".filter").html())
    $(".filter").remove();
    $(".alpha_date").html($(".date").html())
    $(".date").remove();
 
 
 
    $('#datatable').on( 'draw.dt', function () {
        $("#datatable_previous a").text('previous');
        $("#datatable_next a").text('next');
    })
 
 
 
});

</script>

@endsection