<div class="modal-body"> 

    <form action="" method="POST" role="form" id="allowance_data">
        <div class="row"> 
			<div class="col-2">   
               <div class="form-group">
                    <span>Branch</span>
                    <select name="branch" id="branch" class="form-control" aria-describedby="inputGroupPrepend2" required>
                    <option value=""></option>
                    <?php
						$fQuery = "SELECT * FROM branch";
                        $result_position = sqlsrv_query($conn, $fQuery);
                        while($row = sqlsrv_fetch_array( $result_position, SQLSRV_FETCH_ASSOC)) {?>					  
                    <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
                    <?php } ?>
                    </select>
               </div>
            </div>
			<div class="col-3">   
               <div class="form-group">
                    <span>Position</span>
                    <select name="position" id="position" class="form-control" aria-describedby="inputGroupPrepend2" required>
                    <option value=""></option>
                    <?php
						$fQuery = "SELECT * FROM position";
                        $result_position = sqlsrv_query($conn, $fQuery);
                        while($row = sqlsrv_fetch_array( $result_position, SQLSRV_FETCH_ASSOC)) {?>					  
                    <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
                    <?php } ?>
                    </select>
               </div>
            </div>
			<div class="col-4">   
               <div class="form-group">
                    <span>Vehicle type</span>
                    <select name="vehicle_type" id="vehicle_type" class="form-control" aria-describedby="inputGroupPrepend2" >
                    <option value=""></option>
                    <?php
						$fQuery = "SELECT * FROM vehicle_type";
                        $result_position = sqlsrv_query($conn, $fQuery);
                        while($row = sqlsrv_fetch_array( $result_position, SQLSRV_FETCH_ASSOC)) {?>					  
                    <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
                    <?php } ?>
                    </select>
               </div>
            </div>
			<div class="col-3">
                <div class="form-group">
                    <span>Benefit type</span>
					<select name="benefit_type" id="benefit_type" class="form-control">
						<option value="Salary">Salary</option>
						<option value="Trip allowance">Trip allowance</option>
                        <option value="Special allowance">Special allowance</option>
						<option value="OT">OT</option>
						<option value="Position allowance">Position allowance</option>
						<option value="Phone allowance">Phone allowance</option>
						<option value="Food allowance">Food allowance</option>
						<option value="Standby charge">Standby charge</option>
						<option value="Diligence allowance">Diligence allowance</option>
						<option value="Main allowance">Main allowance</option>
                    </select> 
                </div>
            </div>
			<div class="col-3">
                <div class="form-group">
                    <span>Service</span>
					<select name="service" id="service" class="form-control">
						<option value=""></option>
						<option value="Cargo transport">Cargo transport</option>
                        <option value="Equipment rental">Equipment rental</option>
						<option value="Transport solution">Transport solution</option>
                    </select> 
                </div>
            </div>
			<div class="col-5">
                <div class="form-group">
					<span >Client</span>
					<select id="client" name="client" class="form-control" >
						<option value=""></option>
						<?php
							$fQuery = "SELECT * FROM customer order by name";
							$result_skill = sqlsrv_query($conn, $fQuery);
							while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
							<option value="<?php echo $row['customer_id'];?>"><?php echo $row['name'];?></option>	              
						<?php } ?>
					</select>
                </div>
            </div>
		</div>
		<div class="row"> 
			<div class="col-3">
                <div class="form-group">
                    <span>Allowance type</span>
					<select name="allowance_type" id="allowance_type" class="form-control">
						<option value=""></option>
						<option value="Allowance for shorthaul">Allowance for shorthaul</option>
						<option value="Allowance for longhaul">Allowance for longhaul</option>
						<option value="Standby charge">Standby charge</option>
                    </select> 
                </div>
            </div>
			<div class="col-2">
                <div class="form-group">
                    <span>Trip</span>
					<select name="trip" id="trip" class="form-control">
						<option value="1st">1st</option>
						<option value="2nd">2nd</option>
                        <option value="3rd">3rd</option>
						<option value="4th">4th</option>
						<option value="5th">5th</option>
						<option value="6th">6th</option>
						<option value="7th">7th</option>
						<option value="8th">8th</option>
						<option value="9th">9th</option>
                    </select> 
                </div>
            </div>
            <div class="col-3">   
                <div class="form-group">
                    <span>Amount within base | amt 1</span>
                    <input type="text" name="amount" id="amount" class="form-control" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
			<div class="col-3">   
                <div class="form-group">
                    <span>Amount with outside base | amt 2</span>
                    <input type="text" name="amount2" id="amount2" class="form-control" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
		</div>
		<div class="row"> 
            <div class="col-2">
                <div class="form-group">
                    <span>Special rate</span>
                    <input type="text" name="special_rate" id="special_rate" class="form-control" maxlength="50">
                </div>
            </div>
			<div class="col-3">
                <div class="form-group">
					<span >Location from</span>
					<select id="location_from" name="location_from" class="form-control" >
						<option value=""></option>
						<?php
							$fQuery = "select location from contract_location_master where active = 1 order by location";
							$result_skill = sqlsrv_query($conn, $fQuery);
							while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
							<option value="<?php echo $row['location'];?>"><?php echo $row['location'];?></option>	              
						<?php } ?>
					</select>
                </div>
            </div>
			<div class="col-3">
                <div class="form-group">
					<span >Location to</span>
					<select id="location_to" name="location_to" class="form-control" >
						<option value=""></option>
						<?php
							$fQuery = "select location from contract_location_master where active = 1 order by location";
							$result_skill = sqlsrv_query($conn, $fQuery);
							while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
							<option value="<?php echo $row['location'];?>"><?php echo $row['location'];?></option>	              
						<?php } ?>
					</select>
                </div>
            </div>
			<div class="col-2">
                <div class="form-group">
                    <span>Special OT rate</span>
                    <input type="text" name="special_ot_rate" id="special_ot_rate" class="form-control">
                </div>
            </div>
			<div class="col-2">
                <div class="form-group">
                    <span>Minimum hours</span>
                    <input type="text" name="minimum_hours" id="minimum_hours" class="form-control">
                </div>
            </div>
		</div>
		<br>

        <div class="row">
            <div class="col-12">  

                <button style="width:100px" type="submit" class="btn btn-success" id="allowance_submit" data-bs-target="#" >
                    <i class="fas fa-save"></i> Save
                </button>

                <button style="width:100px" type="button" class="btn btn-danger"  id="cancel" data-bs-target="#" >
                    <i class="fas fa-minus-square"></i> Cancel
                </button>
				<input type="hidden" name="reccode" id="reccode">

            </div>
        </div>                  
    </form>

</div>

<input required type="hidden" name="form_type" id="form_type">

<script>

    $("#allowance_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#allowance_data");
        var data = getFormData($form);
        $("#allowance_submit").prop("disabled",true);
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
            url: 'api/insert_allowance_setup.php',
            data: data,
            success: function(data) {
                $("#allowance_submit").prop("disabled",false);
                $('#allowance_table').DataTable().ajax.reload();
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
            url: 'api/update_allowance_setup.php',
            data: data,
            success: function(data) {
                $("#allowance_submit").prop("disabled",false);
                $('#allowance_table').DataTable().ajax.reload();
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
            load_operator($("#reccode").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    function load_operator(reccode){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_allowance_setup.php?reccode='+reccode,
            success: function(data) {
                $('#branch').val(data.branch);
                $('#position').val(data.position);
                $('#vehicle_type').val(data.vehicle_type);
				$('#benefit_type').val(data.benefit_type);
                $('#service').val(data.service);
				$('#client').val(data.client);
				$('#allowance_type').val(data.allowance_type);
                $('#trip').val(data.trip);
				$('#amount').val(data.amount);
				$('#amount2').val(data.amount2);
				$('#special_rate').val(data.special_rate);
				$('#location_from').val(data.location_from);
				$('#location_to').val(data.location_to);
				$('#special_ot_rate').val(data.special_ot_rate);
				$('#minimum_hours').val(data.minimum_hours);
				$('#reccode').val(data.reccode);
            }
        });
        //$('#operator_id').attr('readonly', true);
        $("#allowance_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#allowance_data input:checkbox').prop('checked', false);
        $('form#allowance_data input:text').val('');
        $('form#allowance_data select').val('');
        $('form#allowance_data input:text').prop("readonly",false);
        $("#allowance_submit").prop("disabled",false);
    }
</script>