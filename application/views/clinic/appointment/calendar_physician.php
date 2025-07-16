    <section class="content">

       <!-- Default Grid -->
       <div class="card">
           
        <form action="" method="post">
                <div class="card-body" style="padding:55px;">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="section">
                                <br>

                                <div class="col-md-4 col-lg-4">
                                    <label class="option option-primary"><b>Select Physician</b>
                                    </label>
                                        <select name="doctor_id" class="form-control" id="doctors">
                                        <?php 
                                            if($doctors){
                                                foreach($doctors as $doctor)
                                                {
                                                ?>
                                                <option value="<?=$doctor['doctor_user_id'];?>"><?=$doctor['doctor_name'];?></option>
                                                <?php   
                                                }
                                            }
                                            ?>
                                     </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </form>
         </div>
    </section>


  <script type="text/javascript">
 
    $(document).ready(function(){
      $("#doctors").on('change',function(e){
        var doctor_id = $(this).val();
        window.location = "calendar/"+doctor_id;    
      });
    });

 </script>