<div class="modal-body"> 

    <form action="" method="POST" role="form" id="vehicle_data">
        <div class="row">  
            <div class="col-2">   
                <div class="form-group">
                    <span>ID</span>
                    <input required type="text" name="vehicle_id" id="vehicle_id" class="form-control" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
			<div class="col-3">
                <div class="form-group">
                    <span>ERP ID </span>
					<select id="vehicle_id_erp" name="vehicle_id_erp" class="form-control" >
						<option value=""></option>
						<?php
						    // $serverNamex = "192.168.10.4";
							// $connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
							$connx = sqlsrv_connect( $serverName, $connectionInfo);
							$table = '';
							$dimension = " and [Dimension Code] = 'VEHICLE ID' ";
							$name = "";//" and Name <> 'OUTSOURCE' ";
							$fQuery = ' SELECT * FROM vehicle where block = 0 ';//.$dimension.$name;
							$result_skill = sqlsrv_query($connx, $fQuery);
							while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
							<option value="<?php echo $row['vehicle_id_erp'];?>"><?php echo $row['vehicle_id_erp'];?></option>	              
						<?php } ?>
					</select>
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
                    <span>Registration No.</span>
                    <input required type="text" name="registration_no" id="registration_no" class="form-control" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
			<!--<div class="col-2">   
                <div class="form-group">
                    <label>Vehicle No.</label>
                    <input required type="text" name="vehicle_no" id="vehicle_no" class="form-control" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>-->
			<div class="col-4">
                <div class="form-group">
					<span>Vehicle type</span><span style="color:red"> *</span>
					<select id="type" name="type" class="form-control" required>
						<option value=""></option>
						<?php
							$fQuery = "SELECT * FROM vehicle_type";
							$result_skill = sqlsrv_query($conn, $fQuery);
							while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
							<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
						<?php } ?>
					</select>
                </div>
            </div>
			<div class="col-1">   
                <div class="form-group">
					<span>Outsource</span>
                    <input type="checkbox"  value="true" id="outsource" name="outsource" class="form-check">
                </div>
            </div>
			<!--<div class="col-2">
                <div class="form-group">
                    <label>Capacity</label>
					<select name="capacity" id="capacity" class="form-control">
						<option value=""></option>
						<option value="1.5t">1.5-ton</option>
						<option value="1.8t">1.8-ton</option>
						<option value="2t">2-ton</option>
						<option value="2.5t">2.5-ton</option>
						<option value="3t">3-ton</option>
						<option value="3.5t">3.5-ton</option>
						<option value="4t">4-ton</option>
						<option value="4.5t">4.5-ton</option>
						<option value="5t">5-ton</option>
						<option value="7t">7-ton</option>
						<option value="8t">8-ton</option>
						<option value="10t">10-ton</option>
                        <option value="15t">15-ton</option>
						<option value="16t">16-ton</option>
						<option value="20t">20-ton</option>
						<option value="25t">25-ton</option>
                        <option value="35t">35-ton</option>
						<option value="40t">40-ton</option>
						<option value="45t">45-ton</option>
						<option value="50t">50-ton</option>
						<option value="50t">51-ton</option>
						<option value="50t">55-ton</option>
						<option value="50t">60-ton</option>
                        <option value="80t">80-ton</option>
						<option value="100t">100-ton</option>
						<option value="120t">120-ton</option>
                    </select> 
                </div>
            </div>-->
			<div class="col-3">
                <div class="form-group">
                    <span>Type</span>
					<select name="category" id="category" class="form-control">
						<option value=""></option>
						<option value="Vehicles">Vehicles</option>
						<option value="Heavy Equipment">Heavy Equipment</option>
                    </select> 
                </div>
            </div>
			
			<div class="col-3">
                <div class="form-group">
                    <span>Brand</span>
					<select id="brand" name="brand" class="form-control" >
						<option value=""></option>
						<?php
							$fQuery = "SELECT * FROM vehicle_brand";
							$result_position = sqlsrv_query($conn, $fQuery);
							while($row = sqlsrv_fetch_array( $result_position, SQLSRV_FETCH_ASSOC)) {?>					  
							<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
						<?php } ?>
					</select>
                </div>
            </div>
			
			<!--<div class="col-3">
                <div class="form-group">
                    <label>Group</label>
					<select id="group" name="group" class="form-control" required>
						<option value=""></option>
						<?php
							$fQuery = "SELECT * FROM vehicle_group";
							$result_skill = sqlsrv_query($conn, $fQuery);
							while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
							<option value="<?php echo $row['code'];?>"><?php echo $row['code']." - ".$row['description'];?></option>	              
						<?php } ?>
					</select>
                </div>
            </div>-->
			
			
			<div class="col-6">
                <div class="form-group">
                    <span>Owner</span>
					<select id="owner" name="owner" class="form-control">
						<option value=""></option>
						<?php
							$fQuery = "SELECT * FROM vehicle_owner";
							$result_skill = sqlsrv_query($conn, $fQuery);
							while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
							<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
						<?php } ?>
					</select>
                </div>
            </div>
			<!--<div class="col-2">   
                <div class="form-group">
                    <label>on behalf of</label>
                    <input type="text" name="on_behalf_of" id="on_behalf_of" class="form-control" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>-->
			<!--<div class="col-3">
                <div class="form-group">
                    <label>Location</label>
					<select id="vlocation" name="vlocation" class="form-control" required>
						<option value=""></option>
						<?php
							$fQuery = "SELECT * FROM location";
							$result_skill = sqlsrv_query($conn, $fQuery);
							while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
							<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
						<?php } ?>
					</select>
                </div>
            </div>-->	
			<div class="col-3">
                <div class="form-group">
                    <span>Base location</span>
					<select id="vbranch" name="vbranch" class="form-control" required>
						<option value=""></option>
						<?php
							$fQuery = "SELECT * FROM location";
							$result_skill = sqlsrv_query($conn, $fQuery);
							while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
							<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
						<?php } ?>
					</select>
                </div>
            </div>
			<div class="col-1">
				<div class="form-group">
					<span>Block</span>
					<input type="checkbox"  value="1" id="block" name="block" class="form-check">
				</div>
			</div>
			<div class="col-8">   
				<div class="form-group">
					<span>Remark</span>
					<input type="text" name="remark" id="remark" class="form-control" >
				</div>
			</div>

			<div class="col-3">
                <div class="form-group">
                    <span>Department</span>
					<select id="department" name="department" class="form-control" >
						<option value=""></option>
						<?php
						    // $serverNamex = "192.168.10.4"; problem atart here
							// $connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
							$connx = sqlsrv_connect( $serverName, $connectionInfo);
							$table = '';
							$dimension = " and [Dimension Code] = 'DEPARTMENT' ";
							$name = "";//" and Name <> 'OUTSOURCE' ";
							// $fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
                            $fQuery = ' SELECT DISTINCT department FROM vehicle where block = 0 ';//.$dimension.$name;
							$result_skill = sqlsrv_query($connx, $fQuery);
							while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
							<option value="<?php echo $row['department'];?>"><?php echo $row['department'];?></option>	              
						<?php } ?>
					</select>
                </div>
            </div>
			<div class="col-3">
				<div class="form-group">
					<span>Cost center</span>
					<select id="cost_center" name="cost_center" class="form-control" >
					<option value=""></option>
					<?php
						// $serverNamex = "192.168.10.4";
						// $connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
						$connx = sqlsrv_connect( $serverName, $connectionInfo);
						$table = '';
						$dimension = " and [Dimension Code] = 'COST CENTER' ";
						$name = "";//" and Name <> 'OUTSOURCE' ";
						// $fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
                        $fQuery = ' SELECT DISTINCT cost_center FROM vehicle where block = 0 ';//.$dimension.$name;
						$result_skill = sqlsrv_query($connx, $fQuery);
						while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>	<option value="<?php echo $row['cost_center'];?>"><?php echo $row['cost_center'];?></option>	              
					<?php } ?>
					</select>
				</div>
			</div>
        </div>			

        <div class="row">
            <div class="col-12">  

                <button style="width:100px" type="submit" class="btn btn-success" id="vehicle_submit" data-bs-target="#" >
                    <i class="fas fa-save"></i> Save
                </button>

                <button style="width:100px" type="button" class="btn btn-danger"  id="cancel" data-bs-target="#" >
                    <i class="fas fa-minus-square"></i> Cancel
                </button>

            </div>
        </div>                  
    </form>

</div>

<input required type="hidden" name="form_type" id="form_type">

<script>
	$("#owner").on("change",function(){
        if($("#owner").val() == 'AAL')
			$('#outsource').prop('checked', true);
		else
			$('#outsource').prop('checked', false);
    });

    $("#vehicle_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#vehicle_data");
        var data = getFormData($form);
        $("#vehicle_submit").prop("disabled",true);
        if($("#form_type").val() == 'insert')
            insert_data(data);
        if($("#form_type").val() == 'update')
            update_data(data);

        return false;
    });

    function insert_data(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_vehicle.php',
            data: data,
            success: function(data) {
                $("#vehicle_submit").prop("disabled",false);
                $('#vehicle_table').DataTable().ajax.reload();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
					$('#vieweditmodal').modal('hide'); 
                    clear_data();
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_data(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_vehicle.php',
            data: data,
            success: function(data) {
                $("#vehicle_submit").prop("disabled",false);
                $('#vehicle_table').DataTable().ajax.reload();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
					$('#vieweditmodal').modal('hide'); 

                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#cancel").on('click',function(){
        if($("#form_type").val() == 'update')
            load_vehicle($("#vehicle_id").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    $("#outsource").on('change',function(){
        //if($('#outsource').is(":checked")){
            //$('#owner').prop("disabled",false);
        //}else{
        //    $('#owner').val("");
        //    $('#owner').prop("disabled",true);
        //}
    });

    function load_vehicle(vehicle_id){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_vehicle.php?vehicle_id='+vehicle_id,
            success: function(data) {
                $('#vehicle_id').val(data.vehicle_id);
                $('#vehicle_id_erp').val(data.vehicle_id_erp);
				$('#registration_no').val(data.registration_no);
                $('#vehicle_no').val(data.vehicle_no);
				$('#brand').val(data.brand);
				$('#capacity').val(data.capacity);
                $('#group').val(data.group);
				$('#type').val(data.type);
                $('#outsource').prop('checked', data.outsource);
				$('#owner').val(data.owner);
                $('#on_behalf_of').val(data.on_behalf_of);
				$('#vlocation').val(data.vlocation);
				$('#vbranch').val(data.vbranch);
				$('#category').val(data.category);
				$('#block').prop('checked', data.block);
				//$('#block').val(data.block);
				$('#remark').val(data.remark);
				$('#department').val(data.department);
				$('#cost_center').val(data.cost_center);
                //if(data.outsource)
                    //$('#owner').prop("disabled",false);
                //else
                //    $('#owner').prop("disabled",true);
            }
        });
        //$('#vehicle_id').attr('readonly', true);
        $("#vehicle_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#vehicle_data input:checkbox').prop('checked', false);
        $('form#vehicle_data input:text').val('');
		$('form#vehicle_data select').val('');
        //$('#owner').prop("disabled",true);
        $("#vehicle_submit").prop("disabled",false);
    }

	function get_number(){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_vehicle_number.php',
            success: function(data) {
                $('#vehicle_id').val(data.num);
				$('#vehicle_id').attr('readonly', true);
            }
        });
    }
</script>