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
                    <h5 class="modal-title" id="exampleModalLabel">Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <?php include "modal/3.4_edit.php"?>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewhotelmodal" tabindex="-1" aria-labelledby="hotelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hotelModalLabel">Hotel booking</h5>
                    <button type="button" id="hotelclose" >
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <?php include "modal/3.4_hotel.php"?>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewticketmodal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ticketModalLabel">Ticket booking</h5>
                    <button type="button" id="ticketclose" >
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <?php include "modal/3.4_ticket.php"?>
                
            </div>
        </div>
    </div>

    <br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">  
						Job
                        <button style="width:100px" type="button" class="btn btn-success" id="worksheet_add" data-bs-target="#" >
                            <i class="fas fa-plus-square"></i> Add
                        </button>                                              
                        <button style="width:100px" type="button" class="btn btn-success" id="worksheet_print" data-bs-target="#" >
                            <i class="fas fa-print"></i> Print
                        </button> 
						 
						<button style="width:100px" type="button" class="btn btn-success" id="worksheet_email" data-bs-target="#" >
                            <i class="fas fa-envelope"></i> Email
                        </button> 
                        <input type="hidden" id="worksheet_id">
						<input type="hidden" id="printed">
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
                    <table id="worksheet_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
								<th scope="col" style="width: 20%;"></th>
                                <th></th>
                                <th scope="col" style="width: 15%;">Job ID</th>
								<th scope="col" style="width: 10%;">Status</th>
								<th scope="col" style="width: 10%;">Print status</th>
								<th scope="col" style="width: 10%;">Branch</th>
								<th scope="col" style="width: 10%;">Date</th>
								<th scope="col" style="width: 15%;">Subject</th>
								<th scope="col" style="width: 15%;">Customer</th>
                                <th scope="col" style="width: 15%;">Requester</th>
                                <th scope="col" style="width: 15%;">Customer Ref.</th>
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
            var table = $('#worksheet_table').DataTable( {
                "ajax": "api/view_worksheet.php?user_role=<?php echo $_SESSION["user_role"];?>&user_name=<?php echo $_SESSION["user_name"];?>",
				"pageLength": 10,
                "processing": true,
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
			//$('#worksheet_status').val() != 'Cancelled'
            $('#worksheet_print').on('click',function(){
				if($('#worksheet_id').val() != ''){
					var print_permission = "<?php echo $_SESSION["print_worksheet"];?>";
					if(($('#printed').val() != 'Printed' || print_permission == '1') && $('#worksheet_status').val() != 'Cancelled'){
						var url = "print/3.1_print2.php?worksheet_id="+$('#worksheet_id').val();
						window.open(url, '_blank').focus();
						$.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: 'api/update_worksheet_printed.php?worksheet_id='+$('#worksheet_id').val(),
                        success: function(data) {							
                        }
                    });
					} else {
						swal("You can't print cancel worksheet");
					}
                }else{
                    swal("Please select worksheet");
                }     
            });

			$('#worksheet_print2').on('click',function(){
				if($('#worksheet_id').val() != ''){
					var print_permission = "<?php echo $_SESSION["print_worksheet"];?>";
					if($('#printed').val() != 'Printed' || print_permission == '1'){
						var url = "print/3.1_print2.php?worksheet_id="+$('#worksheet_id').val();
						window.open(url, '_blank').focus();
						$.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: 'api/update_worksheet_printed.php?worksheet_id='+$('#worksheet_id').val(),
                        success: function(data) {							
                        }
                    });
					} else {
						swal("You can't print this worksheet");
					}
                }else{
                    swal("Please select worksheet");
                }     
            });

			$('#worksheet_email').on('click',function(){
                if($('#worksheet_id').val() != ''){
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: 'api/send_email.php?worksheet_id='+$('#worksheet_id').val(),
                        success: function(data) {							
                            if(data.Status == "Success") {
                                swal(data.msg);
                            } else {
                                swal(data.msg);
                            }
                        }
                    });
					swal("Your mail has been sent successfully.");
                }else{
                    swal("Please select worksheet");
                }
            });


            $('#worksheet_table tbody').on( 'change', '.chkbox', function () {
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                var id = data[2];
				var print_status = data[4];
				var worksheet_status = data[3];
                var val = this.checked;
                $(':checkbox').each(function() {
                    this.checked = false;
                });

                this.checked = val;
                if(val === false){
                    $('#worksheet_id').val('');
					$('#printed').val('');
					$('#worksheet_status').val('');
                }else{
                    $('#worksheet_id').val(id);
					$('#printed').val(print_status);
					$('#worksheet_status').val(worksheet_status);
                }
            });

            $('#worksheet_add').on('click',function(){
                clear_data();
                $('#form_type').val('insert'); 
                $('#worksheet_id').attr('readonly', false);
                $('#vieweditmodal').modal('show'); 
                $("#sub_data").hide();
                $(".send").hide();
                $(".rcvd").hide();
				$(".close_st").hide();
				$(".cancel").hide();
				$('#worksheet_id').attr('readonly', true);
				var now = new Date();
				var day = ("0" + now.getDate()).slice(-2);
				var month = ("0" + (now.getMonth() + 1)).slice(-2);
				var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
				$('#worksheet_date').val(today);
				$('#worksheet_date').attr('readonly', true);
				$('#worksheet_status').val("Open");
				$('#worksheet_status').attr('readonly', true);
                //get_number();
            });

            $('#worksheet_table tbody').on( 'click', 'button.deletebtn', function () {
                var table = $('#worksheet_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
				swal('not allow to delete worksheet!!');
                //swal({
                //    title: "Delete",
                //    text: "Confirm",
                //    icon: "warning",
                //    buttons: ["Cancel", "Ok"],
                //    dangerMode: true,
                //    })
                //    .then((willDelete) => {
                //    if (willDelete) {
                //        $.ajax({
                //            type: 'GET',
                //            dataType: "json",
                //            url: 'api/delete_worksheet.php?worksheet_id='+data[2],
                //            success: function(data) {
                //                $('#worksheet_table').DataTable().ajax.reload();
                //                Result = data;
                //                if(Result.Status == "Success") {
                //                    swal(Result.msg);

                //                } else {
                //                    swal(Result.msg);
                //                }
                //            }
                //        });
                    
                //    } 
                //});
             });

             $('#worksheet_table tbody').on( 'click', 'button.editbtn', function () {
                var table = $('#worksheet_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_worksheet(data[2]);
                $('#form_type').val('update'); 
				//$('#user_name').val(''); //$_SESSION["user_name"]
                $('#vieweditmodal').modal('show'); 
            });

            $('#worksheet_table tbody').on( 'click', 'button.infobtn', function () {
                var table = $('#worksheet_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_worksheet(data[2]);
                $('#form_type').val(''); 
                $('#vieweditmodal').modal('show'); 

                $('#vieweditmodal :input').attr('readonly', 'readonly');
                // $('#vieweditmodal :select').attr('readonly', 'readonly');
                $('#vieweditmodal :button').hide();
            });

            $('#hotelclose').click(function(e) {
                $('#viewhotelmodal').modal('hide');
            });
            $('#ticketclose').click(function(e) {
                $('#viewticketmodal').modal('hide');
            });
            
        });

        
    </script>
    
  </body>
</html>