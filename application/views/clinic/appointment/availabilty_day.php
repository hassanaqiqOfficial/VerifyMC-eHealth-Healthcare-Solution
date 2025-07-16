      <style>
       
                /*element.style
                 {
                    background: darkgray;
                    color: #333;
                 }
                 a
                 {
                  color: #333; 
                 }
                 .fc-event-title
                 {
                  background: darkgrey;
                 }*/
                 .fc-daygrid-dot-event 
                 {
                  display: hidden;
                 }

     </style>
         
       <div class="card">
           <div class="card-header header-elements-inline ml-2 mr-2">
             <h3 class="card-title">Manage Availablity</h3>
               <div class="header-element"> 
                 <a href="<?=base_url('clinic/appointment/add_availability/0/'.$doctor_id);?>" class="btn btn-primary btn-sm pull-right add_availability ">+ Add
                 </a>
               </div>
            </div> 
         <div class="card-body">
            <div id="calendar" class="container">
            </div>
        </div>
      </div>

