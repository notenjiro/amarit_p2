<div class="modal-body"> 

    <form action="" method="POST" role="form" id="manpower_data">
        <div class="row">  
            <div class="col-2">   
                <div class="form-group">
                    <label>Manpower ID</label>
                    <input required type="text" name="manpower_id" id="manpower_id" class="form-control" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Name</label>
                    <input required type="text" name="name" id="name" class="form-control" maxlength="50">
                </div>
            </div>
			<div class="col-3">
                <div class="form-group">
                    <label>Last Name</label>
                    <input required type="text" name="lastname" id="lastname" class="form-control" maxlength="50">
                </div>
            </div>
			<div class="col-3">
                <div class="form-group">
                    <label>Position</label>
					<select id="position" name="position" class="form-control" required>
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
			<div class="col-2">
                <div class="form-group">
                    <label>Company</label>
					<select name="company" id="company" class="form-control">
						<option value=""></option>
						<option value="AA">AA</option>
                        <option value="AAL">AAL</option>
						<option value="AAC">AAC</option>
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
			<div class="col-3">
                <div class="form-group">
                    <label>Tel.</label>
                    <input required type="text" name="tel" id="tel" class="form-control" maxlength="50">
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
			<div class="col-1">   
                <div class="form-group">
					<label>Outsource</label>
                    <input type="checkbox"  value="true" id="outsource" name="outsource" class="form-check">
                </div>
            </div>
		</div>
		<div class="row">
			<div class="col-1">
                <div class="form-group">
                    <label>Day Off</label> 
                </div>
            </div>
			<div class="col-1">   
				<div class="form-group">
					<label>Mon</label>
                    <input type="checkbox"  value="true" id="monday" name="monday" class="form-check">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label>Tue</label>
                    <input type="checkbox"  value="true" id="tuesday" name="tuesday" class="form-check">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label>Wed</label>
                    <input type="checkbox"  value="true" id="wednesday" name="wednesday" class="form-check">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label>Thu</label>
                    <input type="checkbox"  value="true" id="thursday" name="thursday" class="form-check">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label>Fri</label>
                    <input type="checkbox"  value="true" id="friday" name="friday" class="form-check">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label>Sat</label>
                    <input type="checkbox"  value="true" id="saturday" name="saturday" class="form-check">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label>Sun</label>
                    <input type="checkbox"  value="true" id="sunday" name="sunday" class="form-check">
                </div>
            </div>
		</div>
		<br>	

        <div class="row">
            <div class="col-12">  

                <button style="width:100px" type="submit" class="btn btn-success" id="manpower_submit" data-bs-target="#" >
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
    $("#manpower_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#manpower_data");
        var data = getFormData($form);
        $("#manpower_submit").prop("disabled",true);
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
            url: 'api/insert_manpower.php',
            data: data,
            success: function(data) {
                $("#manpower_submit").prop("disabled",false);
                $('#manpower_table').DataTable().ajax.reload();
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
            url: 'api/update_manpower.php',
            data: data,
            success: function(data) {
                $("#manpower_submit").prop("disabled",false);
                $('#manpower_table').DataTable().ajax.reload();
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
            load_manpower($("#manpower_id").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    function load_manpower(manpower_id){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_manpower.php?manpower_id='+manpower_id,
            success: function(data) {
                $('#manpower_id').val(data.manpower_id);
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
            }
        });
        $('#manpower_id').attr('readonly', true);
        $("#manpower_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#manpower_data input:checkbox').prop('checked', false);
        $('form#manpower_data input:text').val('');
        $("#manpower_submit").prop("disabled",false);
    }
</script>