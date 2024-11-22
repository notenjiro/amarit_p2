<style>
.modal-xl {
    max-width: 95% !important;
}
</style>
<!doctype html>
<html lang="en">
    <?php 
        require_once 'config_db.php';
        require 'master.php'; 
        $MasterPage = 'master.php';
    ?>   
        
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Front-end system</title>
  </head>
  <body style="background-color:GhostWhite">

 
  <!-- serve view
  <div class="modal fade" id="vieweditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customer Contract</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <?php //include "modal/2.1_edit.php"?>
            </div>
        </div>
    </div> -->


    <br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">  
						Application Setup                                          
                    </div>
                </div>  
            </div>
        </div>

        <div class="card">
            <div class="card-body">   
                <div class="row">  
                    <div class="col-12">        
                        
                    </div>
                </div>
 
                <!-- <div class="card-body">   -->
                    <!-- <form id="application_data">
                        <div class="row">  
                            <div class="col-2">   
                                <div class="form-group">
                                    <label>Picture Folder</label>
                                </div>
                            </div>
                            <div class="col-5">   
                                <div class="form-group">
                                    <input type="text" name="picture_folder" id="picture_folder" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-5">   
                            </div>
                        </div>
						<div class="row">  
                            <div class="col-2">   
                                <div class="form-group">
                                    <label>longhaul range km.</label>
                                </div>
                            </div>
                            <div class="col-5">   
                                <div class="form-group">
                                    <input type="text" name="long_haul" id="long_haul" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-5">   
                            </div>
                        </div> -->
						<!--<div class="row">  
                            <div class="col-2">   
                                <div class="form-group">
                                    <label>Fuel KM./Litre</label>
                                </div>
                            </div>
                            <div class="col-5">   
                                <div class="form-group">
                                    <input type="text" name="fuel_km_per_litre" id="fuel_km_per_litre" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-5">   
                            </div>
                        </div>-->
                    <!--                             
                        <br>

                        <div class="row">
                            <div class="col-12">  
                                <button style="width:100px" type="button" class="btn btn-success" id="application_submit" data-bs-target="#" >
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                <button style="width:100px" type="button" class="btn btn-danger"  id="application_cancel" data-bs-target="#" >
                                    <i class="fas fa-minus-square"></i> Cancel
                                </button>
                            </div>
                        </div>         
                    </form>  -->
                <!-- </div> -->
                <div class="card">
                    <div class="card-body">  
                        <table id="users_table" class="table table-striped display nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col" >User Role</th>
                                    <th scope="col" >Name</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col" style="width:20%"></th>
                                </tr>
                            </thead>                       
                            <tbody>  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div> 
   
   
    <!-- <script>
        $(document).ready(function(){

            function load_data(){
                $.ajax({
                    type: 'GET',
                    dataType: "json",
                    url: 'api/get_application_setup.php',
                    success: function(data) {
                        $('#picture_folder').val(data.picture_folder);
						$('#fuel_km_per_litre').val(data.fuel_km_per_litre);
						$('#long_haul').val(data.long_haul);
                    }
                });
            }

            load_data();

            $("#application_cancel").on("click",function(){
                load_data();
            });

            $("#application_submit").on("click",function(){
                var $form = $("#application_data");
                var data = getFormData($form);
                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    url: 'api/update_application.php',
                    data: data,
                    success: function(data) {
                        if(data.Status == "Success") {
                            swal(data.msg);
                        } else {
                            swal(data.msg);
                        }
                    }
                });
            })
        });
    </script> -->

   
    <script>
    var checkbok_table = `
    <div class="d-flex  justify-content-center">
        <div class="d-flex col-5">
            <input type="checkbox" id="vehicle1" class="form-check" name="vehicle1" value="Bike">
            <span class="ml-2">Re - Open</span>
        </div>
        <div class="d-flex col-5">   
            <input type="checkbox" id="vehicle2" class="form-check" name="vehicle2" value="Order">
            <span class="ml-2">Create older</span>
         </div> 
    </div>
    
     `;
    
    $(document).ready(function(){
        var table = $('#users_table').DataTable({
            "ajax": "api/view_users.php",
            "columnDefs": [ {
                "targets": -1,
                "data": null,
                "defaultContent": checkbok_table
            } ],
        });
    });
    </script>

  </body>
</html>
<?php sqlsrv_close($conn); ?>