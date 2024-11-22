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
                    <h5 class="modal-title" id="exampleModalLabel">Customer Detail</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <?php include "modal/1.1_edit.php"?>
            </div>
        </div>
    </div>

	<div class="modal fade" id="vieweditmodal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Contact List</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <?php include "modal/1.1_sub.php"?>
            </div>
        </div>
    </div>

    <br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    <div class="ml-3">  
						Customer Detail
                        <button style="width:100px" type="button" class="btn btn-success " id="customer_add" data-bs-target="#" >
                            <i class="fa fa-plus"></i> Add
                        </button>                        
						<!-- More Information
                        <button style="width:130px" type="button" class="btn btn-success contactview" id="customer_contact" data-bs-target="#" >
                            <i class="fas fa-plus-square"></i> Contact List
                        </button>                         -->
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
                        <script>init('customer');</script>
                        
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
                    <table id="customer_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
								<th scope="col" style="width: 20%;"></th>
                                <th scope="col" style="width: 10%;"></th>
                                <th scope="col" style="width: 10%;">Client ID</th>
								<th scope="col" style="width: 10%;">ERP ID</th>
								<th scope="col" style="width: 20%;">Company Name</th>
                                <th scope="col" style="width: 15%;">Province</th>
								<th scope="col" style="width: 10%;">Postcode</th>
                                <th scope="col" style="width: 15%;">Tel.</th>                     
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
            var table = $('#customer_table').DataTable( {
                "ajax": "api/view_customer.php",

				"scrollX": true,
                "columnDefs": [ {
                    "targets": 0,
                    "data": null,
                    "defaultContent": btn_table
                },{
                    "targets": 1,
                    "data": null,
                    "defaultContent": "<input type=\"checkbox\" class=\"form-check chkbox\">"
                } ],
                
                "bDestroy": true
            } );

            $('#customer_table tbody').on( 'change', '.chkbox', function () {
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                var id = data[2];
                var val = this.checked;
                $(':checkbox').each(function() {
                    this.checked = false;
                });

                this.checked = val;
                if(val === false){
					 $('#customer_id').val()
                }else{
					 $('#customer_id').val(data[2])
                }
            });

            $('#customer_add').on('click',function(){
                clear_data();
                $('#form_type').val('insert'); 
                $('#code').attr('readonly', false);
                $('#vieweditmodal').modal('show'); 
                get_number();
            });

			$('#customer_contact').on('click',function(){
				if($("#customer_id").val()!= ''){
					clear_data_sub();
					$('#form_type').val('insert'); 
					$('#vieweditmodal2').modal('show'); 
					load_contact()
				}else{
                    swal("Please select customer");
                }               
            });

            $('#customer_table tbody').on( 'click', 'button.deletebtn', function () {
                var table = $('#customer_table').DataTable();
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
                            url: 'api/delete_customer.php?customer_id='+data[1],
                            success: function(data) {
                                $('#customer_table').DataTable().ajax.reload();
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

             $('#customer_table tbody').on( 'click', 'button.editbtn', function () {
                var table = $('#customer_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_customer(data[2]);
                $('#form_type').val('update'); 
                $('#vieweditmodal').modal('show'); 
            });

            $('#customer_table tbody').on( 'click', 'button.infobtn', function () {
                var table = $('#customer_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_customer(data[2]);
                $('#form_type').val(''); 
                $('#vieweditmodal').modal('show'); 

                $('#customer_data input').attr('readonly', 'readonly');
                $('#customer_data button').hide();
            });
        });
    </script>
    
  </body>
</html>
<?php sqlsrv_close($conn); ?>