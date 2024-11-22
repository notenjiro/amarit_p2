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
                    <h5 class="modal-title" id="exampleModalLabel">Cut Off Account</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <?php include "modal/1.55_edit.php"?>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    <div class="ml-3"> Cut Off Account
                        <button style="width:100px" type="button" class="btn btn-success ml-3" id="cut_off_account_add" data-bs-target="#" >
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
                      <table id="cut_off_account_type_table" class="table table-striped" style="width: 100%;">
                        <thead>
                            <tr>
								<th scope="col" style="width: 15%;"></th>
								<th scope="col" style="width: 25%;">Code</th>
								<th scope="col" style="width: 60%;">Date</th>
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
            $('#cut_off_account_add').on('click',function(){
                // clear_data();
                $('#form_type').val('insert'); 
                $('#vieweditmodal').modal('show'); 
                
            });


            $('#cut_off_account_table tbody').on( 'click', 'button.deletebtn', function () {
                var table = $('#cut_off_account_table').DataTable();
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
                            url: 'api/delete_cut_off_account.php?code='+data[0],
                            success: function(res) {
                                console.log(willDelete,data,res)
                                $('#cut_off_account_table').DataTable().ajax.reload();
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
                var table = $('#cut_off_account_table').DataTable( {
                "ajax": "api/view_cut_off_account.php",
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