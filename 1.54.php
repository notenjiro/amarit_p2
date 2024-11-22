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
    <style>
        .editbtn{
            display:none!important;
        }
    </style>
  </head>
  <body style="background-color:GhostWhite">

  <!-- serve view -->
  <div class="modal fade" id="vieweditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vessel Type</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <?php include "modal/1.54_edit.php"?>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    <div class="ml-3">  Vessel Type
                        <button style="width:100px" type="button" class="btn btn-success ml-3" id="vessel_type_add" data-bs-target="#" >
                            <i class="fa fa-plus"></i>&nbsp; Add
                        </button>
                    </div>
                </div>  
            </div>
        </div>

        <div class="card">
            <div class="card-body">   
                <div class="row">  
                    <div class="col-12">        
                      <table id="vessel_type_table" class="table table-striped" style="width: 100%;">
                        <thead>
                            <tr>
								<th scope="col" style="width: 15%;"></th>
								<th scope="col" style="width: 25%;">Code</th>
								<th scope="col" style="width: 60%;">Description</th>
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


    <script>
        $(document).ready(function(){
            loadData();
            $('#nameroleid').hide();
            $('#roleid').hide();

            $('#vessel_type_add').on('click',function(){
                clear_data();
                $('#form_type').val('insert'); 
                $('#vieweditmodal').modal('show'); 
                
            });


            $('#vessel_type_table tbody').on( 'click', 'button.deletebtn', function () {
                var table = $('#vessel_type_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                swal({
                    title: "Delete data ?",
                    icon: "warning",
                    buttons: ["Cancel", "Ok"],
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        
                        $.ajax({
                            type: 'GET',
                            dataType: "json",
                            url: 'api/delete_vessel_type.php?code='+data[0],
                            success: function(res) {
                                console.log(willDelete,data,res)
                                $('#vessel_type_table').DataTable().ajax.reload();
                                Result = res;
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


            function loadData(){
                var table = $('#vessel_type_table').DataTable( {
                "ajax": "api/view_vessel_type.php",
                "columnDefs": [ {
                    "targets": 0,
                    "data": null,
                    "defaultContent": btn_table
                } ],
                "bDestroy": true
            } );
            }
        });

    </script>
    
  </body>
</html>
<?php sqlsrv_close($conn); ?>