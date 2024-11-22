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

 
  <!-- serve view -->
  <div class="modal fade" id="vieweditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customer Contract</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <?php include "modal/1.2_edit.php"?>
            </div>
        </div>
    </div>


    <br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">  
						Customer Contract
                        <button style="width:100px" type="button" class="btn btn-success" id="contract_add" data-bs-target="#" >
                            <i class="fa fa-plus-square"></i>&nbsp; Add
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
                    <table id="contract_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
								<th scope="col" style="width: 20%;"></th>
                                <th scope="col" style="width: 10%;">Front-end Contract No.</th>
								<th scope="col" style="width: 10%;">ERP Contract No.</th>
								<th scope="col" style="width: 12%;">Contact Date</th>
								<th scope="col" style="width: 9%;">Start Date</th>
                                <th scope="col" style="width: 9%;">End Date</th>
								<th scope="col" style="width: 15%;">Customer</th>
                                <th scope="col" style="width: 15%;">Customer Ref.</th>
								<th scope="col" style="width: 5%;">Active</th>
                                <th scope="col" style="width: 5%;">Status</th>
                                
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
            var table = $('#contract_table').DataTable( {
                "ajax": "api/view_contract.php",
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

            $('#contract_add').on('click',function(){
                clear_data();
                $('#form_type').val('insert'); 
                //$('#contract_no').attr('readonly', true);
				var now = new Date();
				var day = ("0" + now.getDate()).slice(-2);
				var month = ("0" + (now.getMonth() + 1)).slice(-2);
				var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
				//$('#worksheet_date').val(today);
				$('#create_date').val(today);
				$('#create_date').attr('readonly', true);
				
                $('#vieweditmodal').modal('show'); 
                $("#sub_data").hide();
            });

            $('#contract_table tbody').on( 'click', 'button.deletebtn', function () {
                var table = $('#contract_table').DataTable();
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
                            url: 'api/delete_contract.php?contract_no='+data[0],
                            success: function(data) {
                                $('#contract_table').DataTable().ajax.reload();
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

             $('#contract_table tbody').on( 'click', 'button.editbtn', function () {
                var table = $('#contract_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_contract(data[1]);
                countRowJob(data[1]);
                $('#form_type').val('update'); 
                $('#vieweditmodal').modal('show'); 
            });

            $('#contract_table tbody').on( 'click', 'button.infobtn', function () {
                var table = $('#contract_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_contract(data[1]);
                $('#form_type').val(''); 
                $('#vieweditmodal').modal('show'); 

                $('#vieweditmodal :input').attr('readonly', 'readonly');
                // $('#vieweditmodal :select').attr('readonly', 'readonly');
                $('#contract_data input:checkbox').prop("disabled",true);
                $('#vieweditmodal :button').hide();
            });
        });
    </script>
    
  </body>
</html>
<?php sqlsrv_close($conn); ?>