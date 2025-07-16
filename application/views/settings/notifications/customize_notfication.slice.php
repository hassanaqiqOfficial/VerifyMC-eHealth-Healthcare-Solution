@extends('layout.master_clinic')
@section('title', 'Customize Notifications')
@section('content')

<style>
   
   .btn.btn-default{
     width:70px;
     border-radius:5px;
     background-color:#fff;
    }

</style>
 
 <div class="content-wrapper">
     
     <?php echo $page; ?>  

</div> 



@endsection

@section('scripts')
 <script src="https://cdn.ckeditor.com/4.5.8/standard-all/ckeditor.js"></script>
@endsection