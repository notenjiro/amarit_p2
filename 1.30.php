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
                    <h5 class="modal-title" id="exampleModalLabel">Day Type</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <?php include "modal/1.30_edit.php"?>
            </div>
        </div>
    </div>

    <br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    <div class="ml-3">  
						Day Type
                        <button style="width:100px" type="button" class="btn btn-success" id="day_type_add" data-bs-target="#" >
                            <i class="fa fa-plus"></i> Add
                        </button>

                        
                    </div>
                    <div class="ml-3">  
						More Information &nbsp;
                        <button  type="button" class="btn btn-success"  data-bs-target="#" >
                        <i class="fa fa-address-book"></i>&nbsp; Contact List
                        </button>
                        <button style="width:100px" type="button" class="btn btn-success" id="button_import" >
                        <i class="fa fa-sign-in"></i>&nbsp; Import
                        </button>
                        <button style="width:100px" type="button" class="btn btn-success" id="button_export" >
                        <i class="fa fa-sign-out"></i>&nbsp; Export
                        </button>

                        <script src="./module_import_export.js"></script>
                        <script>init('day_type');</script>
                        
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
                    <table id="day_type_table" class="table table-striped" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
								<th scope="col" style="width: 20%;"></th>
                                <th scope="col" style="width: 20%;">Code</th>
                                <th scope="col" style="width: 30%;">Day Type</th>
								<th scope="col" style="width: 30%;">Description</th>
                                
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
            var table = $('#day_type_table').DataTable( {
                "ajax": "api/view_day_type.php",
                "columnDefs": [ {
                    "targets": 0,
                    "data": null,
                    "defaultContent": btn_table
                } ],
                "bDestroy": true
            } );

            $('#day_type_add').on('click',function(){
                clear_data();
                $('#form_type').val('insert'); 
                $('#code').attr('readonly', false);
                $('#vieweditmodal').modal('show'); 
                
            });

            $('#day_type_table tbody').on( 'click', 'button.deletebtn', function () {
                var table = $('#day_type_table').DataTable();
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
                            url: 'api/delete_day_type.php?code='+data[0],
                            success: function(data) {
                               $('#day_type_table').DataTable().ajax.reload();
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

             $('#day_type_table tbody').on( 'click', 'button.editbtn', function () {
                var table = $('#day_type_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_day_type(data[0]);
                $('#form_type').val('update'); 
                $('#vieweditmodal').modal('show'); 
            });

            $('#day_type_table tbody').on( 'click', 'button.infobtn', function () {
                var table = $('#day_type_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_day_type(data[0]);
                $('#form_type').val(''); 
                $('#vieweditmodal').modal('show'); 

                $('#day_type_data input').attr('readonly', 'readonly');
                $('#day_type_data select').attr('readonly', 'readonly');
                $('#day_type_data input:checkbox').prop("disabled",true);
                $('#day_type_data button').hide();
            });
        });
    </script>
    
  </body>
</html>
<?php sqlsrv_close($conn); ?>