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
				<label>Send Worksheet to NAV</label>  
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
						<div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <br>
                                <button type="submit" id="submitbtn" class="invisible">
                                <input type="hidden" id="submittype">
                                <button type="button" name="submit" id="showdata" class="btn btn-success">
                                    <i class="fa fa-search"></i> Show data
                                </button>
                                <!-- <button type="button" name="submit" id="send_nav" class="btn btn-success">
                                    <i class="fas fa-file-excel"></i>Send to NAV
                                </button> -->
                            </div>   
                        </div>
						<div class="col-xs-12 col-sm-6 col-md-2">
                        <button type="button" name="submit" id="send_nav3" class="btn btn-success">
                                    <i class="fa fa-file-excel"></i> Send to NAV
                                </button>
                        </div>

						<!-- <div class="col-xs-12 col-sm-6 col-md-2">
                            <div class="form-group">
                                <label>Worksheet ID</label>
                                <input type="text" name="worksheet_id" id="worksheet_id" class="form-control">
                            </div>   
                        </div> -->
						<!-- <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
								<br>
                                <button type="button" name="submit" id="send_nav2" class="btn btn-success">
                                    <i class="fas fa-file-excel"></i>Send to NAV
                                </button>
                            </div>   
                        </div> -->
					</div>	
				</form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">  
				<input type="hidden" id="check_id">
                <table id="worksheet_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th><input type="checkbox" id="select-all" style="display:block!important;" ></th>
								<th scope="col" style="width: 15%;">Worksheet ID</th>
								<th scope="col" style="width: 15%;">Date</th>
								<th scope="col" style="width: 15%;">Service Type</th>
								<th scope="col" style="width: 15%;">Service ID</th>               
								<th scope="col" style="width: 15%;">Customer No.</th>
								<th scope="col" style="width: 15%;">Customer</th>
								<th scope="col" style="width: 15%;">Subject</th>
								<th scope="col" style="width: 15%;">Contract number</th>
								<th scope="col" style="width: 15%;">Contract line number</th>
								<th scope="col" style="width: 15%;">Customer ref.</th>
								<th scope="col" style="width: 15%;">Requester</th>
								<th scope="col" style="width: 15%;">Remark</th>					
								<th scope="col" style="width: 15%;">Request method</th>
								<th scope="col" style="width: 15%;">Request to</th>
								<th scope="col" style="width: 15%;">CS inform OPR</th>
								<th scope="col" style="width: 15%;">time</th>
								<th scope="col" style="width: 15%;">OPR inform CS</th>
								<th scope="col" style="width: 15%;">time</th>
								<th scope="col" style="width: 15%;">CS inform client</th>
								<th scope="col" style="width: 15%;">time</th>
								<th scope="col" style="width: 15%;">Vehicle</th>
                                <th scope="col" style="width: 15%;">Operator/Manpower</th>
								<th scope="col" style="width: 15%;">Position</th>
                                <th scope="col" style="width: 15%;">From (Contract)</th>
								<th scope="col" style="width: 15%;">To (Contract)</th>
								<th scope="col" style="width: 15%;">Specific location from</th>
								<th scope="col" style="width: 15%;">Specific location to</th>
								<th scope="col" style="width: 15%;">Contact person (from)</th>
								<th scope="col" style="width: 15%;">Contact person (to)</th>
								<th scope="col" style="width: 15%;">Charge as</th>
								<th scope="col" style="width: 15%;">Outsource charge as</th>
								<th scope="col" style="width: 15%;">Remark</th>
								<th scope="col" style="width: 15%;">Reference 1</th>
								<th scope="col" style="width: 15%;">Reference 2</th>
								<th scope="col" style="width: 15%;">Department</th>
								<th scope="col" style="width: 15%;">Cost center</th>
								<th scope="col" style="width: 15%;">Universal Location/From</th>
								<th scope="col" style="width: 15%;">Universal To</th>
								<th scope="col" style="width: 15%;">Mileage start</th>
								<th scope="col" style="width: 15%;">Mileage end</th>
								<th scope="col" style="width: 15%;">Total Km.</th>
								<th scope="col" style="width: 15%;">Km. from contract</th>
                                <th scope="col" style="width: 15%;">Start date</th>
								<th scope="col" style="width: 15%;">Start time</th>
								<th scope="col" style="width: 15%;">End date</th>
								<th scope="col" style="width: 15%;">End time</th>
								<th scope="col" style="width: 15%;">Qty</th>
                                <th scope="col" style="width: 15%;">UOM</th>					
								<th scope="col" style="width: 15%;">Amount</th>
								<th scope="col" style="width: 15%;">Diesel rate</th>
								<th scope="col" style="width: 15%;">No charge</th>
								<th scope="col" style="width: 15%;">Consolidate</th>
								<th scope="col" style="width: 15%;">Vehicle switch</th>
								<th scope="col" style="width: 15%;">Cancel reason</th>
								<th scope="col" style="width: 15%;">Cargo type</th>
								<th scope="col" style="width: 15%;">Cargo quantity</th>
								<th scope="col" style="width: 15%;">Cargo weight</th>
								<th scope="col" style="width: 15%;">Dimension</th>
								<th scope="col" style="width: 15%;">Actual start date</th>
								<th scope="col" style="width: 15%;">Actual start time</th>
								<th scope="col" style="width: 15%;">Actual end date</th>
								<th scope="col" style="width: 15%;">Actual end time</th>
                                <th scope="col" style="width: 15%;">Name</th>
								<th scope="col" style="width: 15%;">Type</th>
								<th scope="col" style="width: 15%;">Sub type 1</th>
								<th scope="col" style="width: 15%;">Sub type 2</th>
                                <th scope="col" style="width: 15%;">Sub type 3</th>
                                <th scope="col" style="width: 15%;">Sub type 4</th>
                                <th scope="col" style="width: 15%;">Barcode</th>
								<th scope="col" style="width: 15%;">line status</th>
								<th scope="col" style="width: 15%;">type 1</th>
								<th scope="col" style="width: 15%;">type 2</th>
                                <th scope="col" style="width: 15%;">type 3</th>
                                <th scope="col" style="width: 15%;">type 4</th>
								<th scope="col" style="width: 15%;">User ID</th>
								<th scope="col" style="width: 15%;">Branch</th>
								<th scope="col" style="width: 15%;">Client request date</th>
								<th scope="col" style="width: 15%;">time</th>
								<th scope="col" style="width: 15%;">Worksheet status</th>
                            </tr>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>
                </div>
                    
        </div>

    </div> 








<!-- Modal -->
<div class="modal fade" id="send_nav_modal" tabindex="-1" aria-labelledby="send_nav_modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="send_nav_modalLabel">Confirm Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <table class="table">
        <thead>
            <tr>
                <th>Worksheet ID</th>
                <th>Date</th>
                <th>Service Type</th>
                <th>Service ID</th>
                <th>Customer No.</th>
                <th>Customer</th>
            </tr>
        </thead>
        <tbody id="confirm_list"></tbody>
      </table>
      </div>
      <div class="modal-footer">
        <div class="row w-100">
            <div class="col align-self-start">
            <a type="button" class="btn btn-primary " target="_blank" href="./cover_Page.php">Preview</a>
            </div>
            <div class="col align-self-end text-right">
            <button type="button" class="btn btn-primary">Confirm</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>




	<?php
    if(isset($_POST['send_nav'])){ 
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        echo '<script type="text/javascript">
				location.replace("4.1_excel.php?from_date='.$from_date.'&to_date='.$to_date.'");
			  </script>';             
    }
    ?> 


    <script>
         $(document).ready(function(){
			$("#showdata").on('click',function(){
				showDatax();
			});

			$("#send_nav2").on('click',function(){
				send_nav2();				
			});

            $("#send_nav3").on('click',function(){
				send_nav3();				
			});

			$('#send_nav').on('click',function(){	

                var count = 0;
                var table = $('#worksheet_table').DataTable();
                var dataTable = table.data();
				var idx = [];
                for (var i = 0; i < $('#worksheet_table :checkbox').length; i++) {
                    if($('#worksheet_table :checkbox')[i].checked){
                        count++;						
						var id = dataTable[i][4];
                        var ids = id.split(" ");
                        idx.push(dataTable[i][4]);
						var data = JSON.stringify(idx);
						swal(data);
						swal("Data already send to NAV");
						$.ajax({
                            type: "post",
                            url: "api/insert_nav.php",
                            dataType: "json",
                            data: data,
                            success: function(response){
								swal(response.msg);
                                var table = $('#worksheet_table').DataTable();
                                table.ajax.reload();
                            }
                        });
						
						
						//$.ajax({
                        //type: 'POST',
                        //dataType: "json",
                        //url: 'api/insert_nav.php?service_id='+id,
                        //success: function(data) {
                        //    if(data.Status == "Success") {
                        //        swal(data.msg);
                        //    } else {
                        //        swal(data.msg);
                        //    }
                        //}
                    //})
                    }
                };

            });

			var table = $('#worksheet_table').DataTable( {
            //    "ajax": "api/view_worksheet_send.php?from_date="+$("#s_from_date").val()+"&to_date="+$("#s_to_date").val(),
				"paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "columnDefs": [
            {
                "targets": 0,
                "orderable": false,
                "className": 'dt-body-center',
                "render": function(data, type, full, meta){
                    return '<input type="checkbox" class="row-check" style="display:block!important;" >';
                }
            }
        ]
            } );

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
				var ids = id.split(" ");
                var val = this.checked;
                //$(':checkbox').each(function() {
                //    this.checked = false;
                //});

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


        function send_nav3(){
            // var table = $('#worksheet_table').DataTable()
            // var rows_selected = table.rows({selected: true}).data();

            if( $('#worksheet_table').DataTable().$('input[type="checkbox"]:checked').length == 0){
                alert('กรุณาเลือกข้อมูลที่ต้องการก่อน')
                return false;
            }
            $("#confirm_list").html("");

            let list_data = "";
            
            $('#worksheet_table').DataTable().$('input[type="checkbox"]:checked').each(function() {
                // var value = $(this).closest('tr').find('td:eq(2)').text();
                console.log()
                list_data += `<tr>
                    <td>${$(this).closest('tr').find('td:eq(1)').text()}</td>
                    <td>${$(this).closest('tr').find('td:eq(2)').text()}</td>
                    <td>${$(this).closest('tr').find('td:eq(3)').text()}</td>
                    <td>${$(this).closest('tr').find('td:eq(4)').text()}</td>
                    <td>${$(this).closest('tr').find('td:eq(5)').text()}</td>
                    <td>${$(this).closest('tr').find('td:eq(6)').text()}</td>
                </tr>`
            });
            $("#confirm_list").append(list_data);
            $('#send_nav_modal').modal('show'); 
        }

		function send_nav2(){
			if($('#worksheet_id').val() != ''){
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: "api/insert_nav_worksheet.php?worksheet_id="+$('#worksheet_id').val(),
                        success: function(data) {
                            if(data.Status == "Success") {
                                swal(data.msg);
                            } else {
                                swal(data.msg);
                            }
                        }
                    });
					//swal($('#worksheet_id').val());
					swal("Sent successfully.");
                }else{
                    swal("Please select worksheet");
                }
		}

		function showDatax(){
			var table = $('#worksheet_table').DataTable( {
                "ajax": "api/view_worksheet_send.php?from_date="+$("#from_date").val()+"&to_date="+$("#to_date").val(),
				//"pageLength": 1000,
                "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "columnDefs": [
            {
                "targets": 0,
                "orderable": false,
                "className": 'dt-body-center',
                "render": function(data, type, full, meta){
                    return '<input type="checkbox" class="row-check" style="display:block!important;" >';
                }
            }
        ],
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
                } ],
                "bDestroy": true
            } );
		}




        // Handle Select/Deselect All
    $('#select-all').on('click', function() {
        var rows = $('#worksheet_table').DataTable().rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    // Handle row checkboxes
    $('#worksheet_table tbody').on('change', 'input[type="checkbox"]', function() {
        if (!this.checked) {
            var el = $('#select-all').get(0);
            if (el && el.checked && ('indeterminate' in el)) {
                el.indeterminate = true;
            }
        }
    });


    </script>



    
  </body>
</html>