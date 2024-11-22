<div class="modal-body"> 

    <form action="" method="POST" role="form" id="operator_data">
        <div class="row">  
            <div class="col-2">   
                <div class="form-group">
                    <span>ID</span>
                    <input required type="text" name="operator_id" id="operator_id" class="form-control" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>			
            <div class="col-2">
                <div class="form-group">
                    <span>First name</span>
                    <input required type="text" name="name" id="name" class="form-control" maxlength="50">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <span>Last name</span>
                    <input required type="text" name="lastname" id="lastname" class="form-control" maxlength="50">
                </div>
            </div>
			<div class="col-2">
                <div class="form-group">
                    <span>Employee ID</span>
                    <input type="text" name="staff_id" id="staff_id" class="form-control" maxlength="50">
                </div>
            </div>
			<div class="col-4">
                <div class="form-group">
                    <span>Position</span>
					<select id="position" name="position" class="form-control" required>
						<option value=""></option>
						<?php
							$fQuery = "SELECT * FROM position order by sort_id";
							$result_position = sqlsrv_query($conn, $fQuery);
							while($row = sqlsrv_fetch_array( $result_position, SQLSRV_FETCH_ASSOC)) {?>					  
							<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
						<?php } ?>
					</select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <span>Employer</span>
					<select name="company" id="company" class="form-control">
						<option value=""></option>
						<option value="AA">AA</option>
                        <option value="AAL">AAL</option>
                    </select> 
                </div>
            </div>
			<div class="col-2">
                <div class="form-group">
                    <span>Employment type</span>
					<select name="employment_type" id="employment_type" class="form-control">
						<option value=""></option>
						<option value="Salary">Salary</option>
                        <option value="Wage">Wage</option>
                    </select> 
                </div>
            </div>
			<div class="col-2">   
               <div class="form-group">
                    <span>Branch</span>
                    <select name="vbranch" id="vbranch" class="form-control" aria-describedby="inputGroupPrepend2" required>
                    <option value=""></option>
                    <?php
						$fQuery = "SELECT * FROM location";
                        $result_position = sqlsrv_query($conn, $fQuery);
                        while($row = sqlsrv_fetch_array( $result_position, SQLSRV_FETCH_ASSOC)) {?>					  
                    <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
                    <?php } ?>
                    </select>
               </div>
            </div>
			<div class="col-2">   
               <div class="form-group">
                    <span>Branch 2</span>
                    <select name="vbranch2" id="vbranch2" class="form-control" aria-describedby="inputGroupPrepend2" >
                    <option value=""></option>
                    <?php
						$fQuery = "SELECT * FROM location";
                        $result_position = sqlsrv_query($conn, $fQuery);
                        while($row = sqlsrv_fetch_array( $result_position, SQLSRV_FETCH_ASSOC)) {?>					  
                    <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
                    <?php } ?>
                    </select>
               </div>
            </div>
			<div class="col-2">   
               <div class="form-group">
                    <span>Branch 3</span>
                    <select name="vbranch3" id="vbranch3" class="form-control" aria-describedby="inputGroupPrepend2" >
                    <option value=""></option>
                    <?php
						$fQuery = "SELECT * FROM location";
                        $result_position = sqlsrv_query($conn, $fQuery);
                        while($row = sqlsrv_fetch_array( $result_position, SQLSRV_FETCH_ASSOC)) {?>					  
                    <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
                    <?php } ?>
                    </select>
               </div>
            </div>
			<div class="col-2">   
               <div class="form-group">
                    <span>Branch 4</span>
                    <select name="vbranch4" id="vbranch4" class="form-control" aria-describedby="inputGroupPrepend2" >
                    <option value=""></option>
                    <?php
						$fQuery = "SELECT * FROM location";
                        $result_position = sqlsrv_query($conn, $fQuery);
                        while($row = sqlsrv_fetch_array( $result_position, SQLSRV_FETCH_ASSOC)) {?>					  
                    <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
                    <?php } ?>
                    </select>
               </div>
            </div>
			<div class="col-2">   
               <div class="form-group">
                    <span>Branch 5</span>
                    <select name="vbranch5" id="vbranch5" class="form-control" aria-describedby="inputGroupPrepend2" >
                    <option value=""></option>
                    <?php
						$fQuery = "SELECT * FROM location";
                        $result_position = sqlsrv_query($conn, $fQuery);
                        while($row = sqlsrv_fetch_array( $result_position, SQLSRV_FETCH_ASSOC)) {?>					  
                    <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
                    <?php } ?>
                    </select>
               </div>
            </div>
			<!--<div class="col-3">
                <div class="form-group">
                    <label>Skill</label>
					<select id="skill" name="skill" class="form-control" required>
						<option value=""></option>
						<?php
							$fQuery = "SELECT * FROM skill";
							$result_skill = sqlsrv_query($conn, $fQuery);
							while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
							<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
						<?php } ?>
					</select>
                </div>
            </div>-->
			<div class="col-4">
                <div class="form-group">
                    <span>Mobile No..</span>
                    <input required type="text" name="tel" id="tel" class="form-control" maxlength="50">
                </div>
            </div>
			<div class="col-6">
                <div class="form-group">
                    <span>Remark</span>
                    <input type="text" name="remark" id="remark" class="form-control">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
					<span>Driver</span>
                    <input type="checkbox" value="1" id="driver" name="driver" class="form-check">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
					<span>Operator</span>
                    <input type="checkbox" value="1" id="operator" name="operator" class="form-check">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
					<span>Manpower</span>
                    <input type="checkbox" value="1" id="manpower" name="manpower" class="form-check">
                </div>
            </div>
			<div class="col-2">   
				<div class="form-group">
					<span>Work start time</span><span style="color:red"> *</span>
						<input type="time" name="start_time" id="start_time" class="form-control" >
				</div>
			</div>
            <div class="col-2">   
                <div class="form-group">
                    <span>Work end time</span><span style="color:red"> *</span>
                        <input type="time" name="end_time" id="end_time" class="form-control" >
                </div>
            </div> 
			<div class="col-3">   
                <div class="form-group">
					<span>allowance follow vehicle type</span>
                    <input type="checkbox" value="1" id="follow_vehicle" name="follow_vehicle" class="form-check">
                </div>
            </div>
			<div class="col-2">
                <div class="form-group">
                    <span>Special allowance</span>
                    <input type="text" name="special_allowance" id="special_allowance" class="form-control" >
                </div>
            </div>
			<div class="col-2">
                <div class="form-group">
                    <span>Phone allowance</span>
                    <input type="text" name="phone_allowance" id="phone_allowance" class="form-control" >
                </div>
            </div>
			<div class="col-3">   
                <div class="form-group">
					<span>OT follow staff format</span>
                    <input type="checkbox" value="1" id="ot_staff" name="ot_staff" class="form-check">
                </div>
            </div>
			<div class="col-3">   
                <div class="form-group">
					<span>Lumpsum OT on day off</span>
                    <input type="checkbox" value="1" id="lumpsum_ot" name="lumpsum_ot" class="form-check">
                </div>
            </div>
			<div class="col-3">   
                <div class="form-group">
					<span>Double allowance on day off</span>
                    <input type="checkbox" value="1" id="double_allowance" name="double_allowance" class="form-check">
                </div>
            </div>
			<div class="col-3">   
                <div class="form-group">
					<span>No OT during longhaul</span>
                    <input type="checkbox" value="1" id="no_ot_long" name="no_ot_long" class="form-check">
                </div>
            </div>
			<div class="col-3">   
                <div class="form-group">
					<span>Count OT after 8 hours</span>
                    <input type="checkbox" value="1" id="ot8" name="ot8" class="form-check">
                </div>
            </div>
			<!--<div class="col-3">
                <div class="form-group">
                    <label>Day Off</label>
					<select name="day_off" id="day_off" class="form-control">
						<option value=""></option>
						<option value="Sunday">Sunday</option>
                        <option value="Monday">Monday</option>
						<option value="Tuesday">Tuesday</option>
						<option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
						<option value="Friday">Friday</option>
						<option value="Saturday">Saturday</option>
                    </select> 
                </div>
            </div>-->
			
			<!--<div class="col-3">   
               <div class="form-group">
                    <label>Universal Position</label>
                    <select name="universal_position" id="universal_position" class="form-control" aria-describedby="inputGroupPrepend2" required>
                    <option value=""></option>
                    <?php
						$fQuery = "SELECT * FROM location";
                        $result_position = sqlsrv_query($conn, $fQuery);
                        while($row = sqlsrv_fetch_array( $result_position, SQLSRV_FETCH_ASSOC)) {?>					  
                    <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
                    <?php } ?>
                    </select>
               </div>
            </div>-->
						
					
        </div>
		<div class="row">
			<div class="col-1">
                <div class="form-group">
                    <span>Day Off</span> 
                </div>
            </div>
			<div class="col-1">   
				<div class="form-group">
					<span>Mon</span>
                    <input type="checkbox"  value="1" id="monday" name="monday" class="form-check">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <span>Tue</span>
                    <input type="checkbox"  value="1" id="tuesday" name="tuesday" class="form-check">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <span>Wed</span>
                    <input type="checkbox"  value="1" id="wednesday" name="wednesday" class="form-check">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <span>Thu</span>
                    <input type="checkbox"  value="1" id="thursday" name="thursday" class="form-check">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <span>Fri</span>
                    <input type="checkbox"  value="1" id="friday" name="friday" class="form-check">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <span>Sat</span>
                    <input type="checkbox"  value="1" id="saturday" name="saturday" class="form-check">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <span>Sun</span>
                    <input type="checkbox"  value="1" id="sunday" name="sunday" class="form-check">
                </div>
            </div>
			
		</div>
		<div class="row">
			<div class="col-1">   
                <div class="form-group">
					<span>Outsource</span>
                    <input type="checkbox" value="1" id="outsource" name="outsource" class="form-check">
                </div>
            </div>
			<div class="col-5">
                <div class="form-group">
					<span >Vendor</span><span style="color:red"> *</span>
					<select id="vendor" name="vendor" class="form-control" required>
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
			<div class="col-1">
				<div class="form-group">
					<span>Block</span>
					<input type="checkbox" value="1" id="block" name="block" class="form-check">
				</div>
			</div>
			<div class="col-2">
                <div class="form-group">
                    <span>Department</span>
					<select id="department" name="department" class="form-control" >
						<option value=""></option>
						<?php
						    //$serverNamex = "192.168.10.4";
							//$connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
							//$connx = sqlsrv_connect( $serverNamex, $connectionInfox);
							//$table = '';
							//$dimension = " and [Dimension Code] = 'DEPARTMENT' ";
							//$name = "";//" and Name <> 'OUTSOURCE' ";
							//$fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
							//$result_skill = sqlsrv_query($connx, $fQuery);
							//while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
							<option value="<?php //echo $row['Code'];?>"><?php //echo $row['Code'];?></option>	              
						<?php //} ?>
					</select>
                </div>
            </div>
			<div class="col-2">
				<div class="form-group">
					<span>Cost center</span>
					<select id="cost_center" name="cost_center" class="form-control" >
					<option value=""></option>
					<?php
						//$serverNamex = "192.168.10.4";
						//$connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
						//$connx = sqlsrv_connect( $serverNamex, $connectionInfox);
						//$table = '';
						//$dimension = " and [Dimension Code] = 'COST CENTER' ";
						//$name = "";//" and Name <> 'OUTSOURCE' ";
						//$fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
						//$result_skill = sqlsrv_query($connx, $fQuery);
						//while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>
                        <option value="<?php //echo $row['Code'];?>"><?php //echo $row['Code'];?></option>	              
					<?php //} ?>
					</select>
				</div>
			</div>
		</div>
		<br>

        <div class="row">
            <div class="col-12">  

                <button style="width:100px" type="submit" class="btn btn-success" id="operator_submit" data-bs-target="#" >
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
	$("#outsource").on('change',function(){
		$('#vendor').attr('required', '');
	});

    $("#operator_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#operator_data");
        var data = getFormData($form);
        $("#operator_submit").prop("disabled",true);
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
            url: 'api/insert_operator.php',
            data: data,
            success: function(data) {
                $("#operator_submit").prop("disabled",false);
                $('#operator_table').DataTable().ajax.reload();
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
            url: 'api/update_operator.php',
            data: data,
            success: function(data) {
                $("#operator_submit").prop("disabled",false);
                $('#operator_table').DataTable().ajax.reload();
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
            load_operator($("#operator_id").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    function load_operator(operator_id){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_operator.php?operator_id='+operator_id,
            success: function(data) {
                $('#operator_id').val(data.operator_id);
                $('#name').val(data.name);
                $('#lastname').val(data.lastname);
				$('#position').val(data.position);
                $('#skill').val(data.skill);
				$('#company').val(data.company);
				$('#day_off').val(data.day_off);
                $('#tel').val(data.tel);
                $('#outsource').prop('checked', data.outsource);
                $('#monday').prop('checked', data.monday);
                $('#tuesday').prop('checked', data.tuesday);
                $('#wednesday').prop('checked', data.wednesday);
                $('#thursday').prop('checked', data.thursday);
                $('#friday').prop('checked', data.friday);
                $('#saturday').prop('checked', data.saturday);
                $('#sunday').prop('checked', data.sunday);
				$('#staff_id').val(data.staff_id);
				$('#vbranch').val(data.vbranch);
				$('#vbranch2').val(data.vbranch2);
				$('#vbranch3').val(data.vbranch3);
				$('#vbranch4').val(data.vbranch4);
				$('#vbranch5').val(data.vbranch5);
				$('#operator').prop('checked', data.operator);
                $('#manpower').prop('checked', data.manpower);
				$('#follow_vehicle').prop('checked', data.follow_vehicle);
				$('#employment_type').val(data.employment_type);
				$('#remark').val(data.remark);
				$('#vendor').val(data.vendor);
				$('#department').val(data.department);
				$('#cost_center').val(data.cost_center);
				$('#ot_staff').prop('checked', data.ot_staff);
				$('#lumpsum_ot').prop('checked', data.lumpsum_ot);
				$('#double_allowance').prop('checked', data.double_allowance);
				$('#no_ot_long').prop('checked', data.no_ot_long);
				$('#ot8').prop('checked', data.ot8);
				$('#driver').prop('checked', data.driver);
				$('#start_time').val(data.start_time);
				$('#end_time').val(data.end_time);
                $('#special_allowance').val(data.special_allowance);
                $('#phone_allowance').val(data.phone_allowance);
				if(data.block)
                    $('#block').prop( "checked", true );
                else
                    $('#block').prop( "checked", false );
				
            }
        });
        //$('#operator_id').attr('readonly', true);
        $("#operator_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#operator_data input:checkbox').prop('checked', false);
        $('form#operator_data input:text').val('');
        $('form#operator_data select').val('');
        $('form#operator_data input:text').prop("readonly",false);
        $("#operator_submit").prop("disabled",false);
    }
</script>