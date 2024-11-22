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

 
  <!-- serve view -->
  <div class="modal fade" id="vieweditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User log</h5>
                </div>
                <?php include "modal/1.5_edit.php"?>
            </div>
        </div>
    </div>

    <br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">  
						User log                      
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
 
                <div class="card-body">  
                    <table id="user_log_table" class="table table-striped" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="width: 20%;">User Name</th>
                                <th scope="col" style="width: 20%;">Time</th>
								<th scope="col" style="width: 20%;">Date</th>
                                <th scope="col" style="width: 20%;">Action Type</th>
								<th scope="col" style="width: 20%;">Description</th>
                            </tr>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>
                </div>
                    
            </div>
        </div>

    </div> 


    <script>
        $(document).ready(function(){
            var table = $('#user_log_table').DataTable( {
                "ajax": "api/view_user_log.php",
                "columnDefs": [ {
                    "targets": -1
                    //"data": null,
                    //"defaultContent": "<button style=\"width:100px\" type=\"button\" class=\"btn btn-warning editbtn\"><i class=\"fas fa-edit\"></i> Edit</button> <button style=\"width:100px\" type=\"button\" class=\"btn btn-danger deletebtn\"><i class=\"fas fa-trash-alt\"></i> Delete</button>"
                } ],
                "bDestroy": true
            } );

        });
    </script>
    
  </body>
</html>
<?php sqlsrv_close($conn); ?>