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
                    <h5 class="modal-title" id="exampleModalLabel">Allowance & OT setup</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <?php include "modal/7.1_edit.php"?>
            </div>
        </div>
    </div>


    <br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">  
						Allowance & OT setup
                        <button style="width:100px" type="button" class="btn btn-success" id="allowance_add" data-bs-target="#" >
                            <i class="fas fa-plus-square"></i> Add
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
					<table id="allowance_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
								<th scope="col" style="width: 20%;"></th>
                                <th scope="col" style="width: 10%;">Branch</th>
                                <th scope="col" style="width: 15%;">Position</th>
                                <th scope="col" style="width: 15%;">Vehicle type</th>
                                <th scope="col" style="width: 15%;">Benefit type</th>
                                <th scope="col" style="width: 15%;">Service</th>
								<th scope="col" style="width: 10%;">Client</th>
								<th scope="col" style="width: 10%;">Allowance type</th>
								<th scope="col" style="width: 10%;">Trip</th>
								<th scope="col" style="width: 10%;">Amount</th>
								<th scope="col" style="width: 10%;">Special rate</th>
								<th scope="col" style="width: 10%;">Location from</th>
								<th scope="col" style="width: 10%;">Location to</th>
								<th scope="col" style="width: 10%;">Special OT rate</th>
								
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
            var table = $('#allowance_table').DataTable( {
                "ajax": "api/view_allowance.php",
				"pageLength": 10,
                "processing": true,
                "scrollX": true,
                "columnDefs": [ {
                    "targets": 0,
                    "data": null,
                    "defaultContent": btn_table
                } ],
                "bDestroy": true
            } );

            $('#allowance_add').on('click',function(){
                clear_data();
                $('#form_type').val('insert'); 
                //$('#code').attr('readonly', false);
                $('#vieweditmodal').modal('show'); 
                
            });

            $('#allowance_table tbody').on( 'click', 'button.deletebtn', function () {
                var table = $('#allowance_table').DataTable();
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
                            url: 'api/delete_allowance_setup.php?reccode='+data[0],
                            success: function(data) {
                                $('#allowance_table').DataTable().ajax.reload();
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

             $('#allowance_table tbody').on( 'click', 'button.editbtn', function () {
                var table = $('#allowance_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_operator(data[0]);
                $('#form_type').val('update'); 
                $('#vieweditmodal').modal('show'); 
            });

            $('#allowance_table tbody').on( 'click', 'button.infobtn', function () {
                var table = $('#allowance_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_operator(data[0]);
                $('#form_type').val(''); 
                $('#vieweditmodal').modal('show'); 

                $('#allowance_data input').attr('readonly', 'readonly');
                $('#allowance_data select').attr('readonly', 'readonly');
                $('#allowance_data input:checkbox').prop("disabled",true);
                $('#allowance_data button').hide();
            });
        });
    </script>
    
  </body>
</html>
<?php sqlsrv_close($conn); ?>