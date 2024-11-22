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
                    <h5 class="modal-title" id="exampleModalLabel">User login</h5>
                </div>
                <?php include "modal/2.3_edit.php"?>
            </div>
        </div>
    </div>

    <br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">  
						User login
                        <button type="button" class="btn btn-success" id="user_add" data-bs-target="#" >
                            <i class="fa fa-plus"></i> Add
                        </button>

                        
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
                    <table id="user_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead>
                            <tr>
								<th scope="col" style="width: 20%;"></th>
                                <th scope="col" style="width: 20%;">User Name</th>
                                <th scope="col" style="width: 20%;">Full Name</th>
								<th scope="col" style="width: 20%;">User Role</th>
                                <th scope="col" style="width: 20%;">E-mail</th>
                                <!-- add -->
                                <th scope="col" style="width: 20%;">Type</th>
                             
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
            var table = $('#user_table').DataTable( {
                "ajax": "api/view_user.php",
                "columnDefs": [ {
                    "targets": 0,
                    "data": null,
                    "defaultContent": btn_table
                } ],
                "bDestroy": true
            } );

            $('#user_add').on('click',function(){
                clear_data();
                $('#form_type').val('insert'); 
                $('#user_name').attr('readonly', false);
                $('#vieweditmodal').modal('show'); 
                
            });

            $('#user_table tbody').on( 'click', 'button.deletebtn', function () {
                var table = $('#user_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                swal({
                    title: "Delete",
                    text: "Confirm",
                    icon: "warning",
                    buttons: ["Cancel", "Ok"],
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'GET',
                            dataType: "json",
                            url: 'api/delete_user.php?user_name='+data[0],
                            success: function(data) {
                                $('#user_table').DataTable().ajax.reload();
                                Result = data;
                                if(Result.Status == "Success") {
                                    swal(Result.msg);

                                } else {
                                    swal(Result.msg);
                                }
                            }
                        });
                    
                    } 
                });
             });

             $('#user_table tbody').on( 'click', 'button.editbtn', function () {
                var table = $('#user_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_user(data[0]);
                $('#form_type').val('update'); 
                $('#vieweditmodal').modal('show'); 
            });

            $('#user_table tbody').on( 'click', 'button.infobtn', function () {
                var table = $('#user_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_user(data[0]);
                $('#form_type').val(''); 
                $('#vieweditmodal').modal('show'); 

                $('#user_data input').attr('readonly', 'readonly');
                $('#user_data select').attr('readonly', 'readonly');
                $('#user_data input:checkbox').prop("disabled",true);
                $('#user_data button').hide();
            });
        });
    </script>
    
  </body>
</html>
<?php sqlsrv_close($conn); ?>