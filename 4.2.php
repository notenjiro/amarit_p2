<style>
.modal-xl {
    max-width: 95% !important;
}
    div.dataTables_wrapper {
        /* width: 800px; */
        margin: 0 auto;
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

 
    <br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
				<form action="" method="POST">
				<label>Time - Pay Slip</label>  
                <div class="row">
					<?php
							if(isset($_POST['from_date'])){
								$from_date = $_POST['from_date'];
                                $to_date = $_POST['to_date'];
                            }else{
                                $y = date('Y')+543;
                                $from_date =  '';
                                $to_date =  ''; 
                            }
                        ?>
					<div class="col-xs-12 col-sm-6 col-md-2">
                            <div class="form-group">
                                <label>From date</label>
                                <input type="date" name="from_date" id="from_date" value="<?php echo date('Y-m-d'); ?>" class="form-control date" aria-describedby="inputGroupPrepend2" required>
                            </div>   
                        </div> 
                        <div class="col-xs-12 col-sm-6 col-md-2">
                            <div class="form-group">
                                <label>to date</label>
                                <input type="date" name="to_date" id="to_date" value="<?php echo date('Y-m-d'); ?>" class="form-control date" aria-describedby="inputGroupPrepend2" required>
                            </div>   
                        </div>
						<div class="col-4">   
                                    <div class="form-group">
                                        <label>Employee</label>
                                        <select name="operator" id="operator" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $time_payQuery = "SELECT o.operator_id, o.name, o.lastname, p.description, o.branch FROM operator o left join position p on p.code = o.position where o.outsource = 0 order by o.name, o.lastname ";
                                                //rig: add another connection
                                                $time_payconn = sqlsrv_connect( $serverName, $connectionInfo);
                                                $result = sqlsrv_query($time_payconn, $time_payQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['operator_id'];?>"><?php echo $row['name']."  ".$row['lastname'].' | '.$row['description'];?></option>	              
                                            <?php }
                                                sqlsrv_close($time_payconn);
                                                 ?>
                                        </select>
                                    </div>
                                </div> 
						<div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <br>
								<input type="hidden" id="submittype">
                                <button type="submit" id="submitbtn" class="invisible">           
                                <button type="button" name="submit" id="showdata" class="btn btn-success">
                                    <i class="fas fa-search"></i>Show data
                                </button>
                                <button type="submit" name="excel" class="btn btn-success">
                                    <i class="fas fa-file-excel"></i>Export to excel
                                </button>
								<button type="submit" name="excel" class="btn btn-success">
                                    <i class="fas fa-print"></i>Pay Slip
                                </button>
                            </div>   
                        </div>
					</div> 
				</form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">  
                <table id="worksheet_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
								<th scope="col" style="width: 15%;">Month</th>
                                <th scope="col" style="width: 15%;">Start Date</th>
								<th scope="col" style="width: 15%;">End Date</th>
								<th scope="col" style="width: 15%;">Day type</th>
								<th scope="col" style="width: 15%;">Work type</th>
								<th scope="col" style="width: 15%;">Day</th>
								<th scope="col" style="width: 15%;">Worksheet Number</th>	
								<th scope="col" style="width: 15%;">Service ID</th>				
								<th scope="col" style="width: 15%;">Start time</th>
								<th scope="col" style="width: 15%;">End time</th>
								<th scope="col" style="width: 15%;">Transport from</th>
								<th scope="col" style="width: 15%;">Specific location from</th>
								<th scope="col" style="width: 15%;">Transport to</th>
								<th scope="col" style="width: 15%;">Specific location to</th>
								<th scope="col" style="width: 15%;">Total Km.</th>
								<th scope="col" style="width: 15%;">Worksheet Remark</th>
								<th scope="col" style="width: 15%;">Vehicle</th>
                                <th scope="col" style="width: 15%;">Operator/Manpower</th>
                                <th scope="col" style="width: 15%;">Position</th>
								<th scope="col" style="width: 15%;">Charge as</th>
								<th scope="col" style="width: 15%;">Total hrs.</th>
                                <th scope="col" style="width: 15%;">OT 1</th>
								<th scope="col" style="width: 15%;">OT 1.5</th>
								<th scope="col" style="width: 15%;">OT 2</th>
								<th scope="col" style="width: 15%;">OT 3</th>
								<th scope="col" style="width: 15%;">Customer</th>
								<th scope="col" style="width: 15%;">Service Type</th>
								<th scope="col" style="width: 15%;">Charge</th>
								<th scope="col" style="width: 15%;">Remark</th>
								<th scope="col" style="width: 15%;">Allowance</th>
								<th scope="col" style="width: 15%;">Qty</th>
								<th scope="col" style="width: 15%;">UOM</th>
								<th scope="col" style="width: 15%;">Total Main Allowance</th>
								<th scope="col" style="width: 15%;">Food allowance</th>
								<th scope="col" style="width: 15%;">Allowance for diligence</th>
								<th scope="col" style="width: 15%;">Special allowance</th>
								<th scope="col" style="width: 15%;">Position allowance</th>
								<th scope="col" style="width: 15%;">Deligence allowance</th>
								

                            </tr>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>
                </div>
                    
        </div>

    </div> 

	<?php
    if(isset($_POST['excel'])){ 
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        echo '<script type="text/javascript">
				location.replace("4.2_excel.php?from_date='.$from_date.'&to_date='.$to_date.'");
			  </script>';             
    }
    ?> 

    <script>
         $(document).ready(function(){
			$("#showdata").on('click',function(){
				showDatax();
			});

			$("#excel").on('click',function(){
				$("#submittype").val("excel");
				$("#submitbtn").trigger("click");      
			});

			//var table = $('#worksheet_table').DataTable( {
            //    "ajax": "api/view_worksheet_timesheet.php?from_date="+$("#s_from_date").val()+"&to_date="+$("#s_to_date").val(),
			//	"pageLength": 100,
            //    "processing": true,
            //    "scrollX": true,

            //    "bDestroy": true
            //} );

            $('#worksheet_print').on('click',function(){
                if($('#worksheet_id').val() != ''){
                    var url = "print/3.1_print.php?worksheet_id="+$('#worksheet_id').val();
                    window.open(url, '_blank').focus();
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
                }else{
                    swal("Please select worksheet");
                }
            });


            $('#worksheet_table tbody').on( 'change', '.chkbox', function () {
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                var id = data[1];
                var val = this.checked;
                $(':checkbox').each(function() {
                    this.checked = false;
                });

                this.checked = val;
                if(val === false){
                    $('#worksheet_id').val('');
                }else{
                    $('#worksheet_id').val(id);
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
                get_number();
            });

            $('#worksheet_table tbody').on( 'click', 'button.deletebtn', function () {
                var table = $('#worksheet_table').DataTable();
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
                            url: 'api/delete_worksheet.php?worksheet_id='+data[1],
                            success: function(data) {
                                $('#worksheet_table').DataTable().ajax.reload();
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

             $('#worksheet_table tbody').on( 'click', 'button.editbtn', function () {
                var table = $('#worksheet_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_worksheet(data[1]);
                $('#form_type').val('update'); 
                $('#vieweditmodal').modal('show'); 
            });

            $('#worksheet_table tbody').on( 'click', 'button.infobtn', function () {
                var table = $('#worksheet_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_worksheet(data[1]);
                $('#form_type').val(''); 
                $('#vieweditmodal').modal('show'); 

                $('#vieweditmodal :input').attr('readonly', 'readonly');
                // $('#vieweditmodal :select').attr('readonly', 'readonly');
                $('#vieweditmodal :button').hide();
            });
        });

		function showDatax(){
            console.log()
			var table = $('#worksheet_table').DataTable( {
                "ajax": "api/view_worksheet_timesheet.php?from_date="+$("#from_date").val()+"&to_date="+$("#to_date").val()+"&operator="+$("#operator").val(),
				"pageLength": 10,
                "processing": true,
                "scrollX": true,
					"columnDefs": [ 
            {
                "targets": 8,
                "className": "text-right"
			},{
                "targets": 9,
                "className": "text-right"
			},{
                "targets": 12,
                "className": "text-right"
			},{
                "targets": 18,
                "className": "text-right"
			},{
                "targets": 19,
                "className": "text-right"
			},{
                "targets": 20,
                "className": "text-right"
			},{
                "targets": 21,
                "className": "text-right"
			},{
                "targets": 22,
                "className": "text-right"
			},{
                "targets": 27,
                "className": "text-right"
			},{
                "targets": 28,
                "className": "text-right"
			},{
                "targets": 29,
                "className": "text-right"
			},{
                "targets": 30,
                "className": "text-right"
			}],
                "bDestroy": true
            } );
		}

		function showData(){
		var table = $('#worksheet_tablex').DataTable( {
                "ajax": "api/view_worksheet.php?user_role=<?php echo $_SESSION["user_role"];?>&user_name=<?php echo $_SESSION["user_name"];?>",
				"pageLength": 100,
                "processing": true,
                "scrollX": true,
                "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": btn_table
                },{
                    "targets": 0,
                    "data": null,
                    "defaultContent": "<input type=\"checkbox\" class=\"form-check chkbox\">"
                },
            {
                "targets": 8,
                "className": "text-right"
			},{
                "targets": 9,
                "className": "text-right"
			}],
                "bDestroy": true
            } );
		}
    </script>
    
  </body>
</html>