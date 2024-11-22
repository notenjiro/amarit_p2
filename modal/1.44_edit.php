<div class="modal-body"> 

    <form action="" method="POST" role="form" id="location_data">
        <div class="row">  
            <div class="col-3">   
                <div class="form-group">
                    <label>Location</label>
                    <input required type="text" name="location" id="location" class="form-control" onkeypress="return lettersOnly(event)" maxlength="50">
                </div>
            </div>
			<!--<div class="col-3">   
				<div class="form-group">
					<label>Universal location</label>
					<select name="universal_location" id="universal_location" class="form-control" aria-describedby="inputGroupPrepend2" required>
                    <option value=""></option>
                    <?php
						$fQuery = "SELECT * FROM location";
                        $result_location = sqlsrv_query($conn, $fQuery);
                        while($row = sqlsrv_fetch_array( $result_location, SQLSRV_FETCH_ASSOC)) {?>					  
                        <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
                    <?php } ?>
                    </select>
                </div>
            </div>
			<!-- <div class="col-2">   
                <div class="form-group">
                    <label>Sub location</label>
					<select name="sub_location" id="sub_location" class="form-control" aria-describedby="inputGroupPrepend2">
                    <option value=""></option>
                    <?php
                        $fQuery = "SELECT * FROM sub_location order by sort_id";
                        $result_location = sqlsrv_query($conn, $fQuery);
                        while($row = sqlsrv_fetch_array( $result_location, SQLSRV_FETCH_ASSOC)) {?>					  
                        <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
                    <?php } ?>
                    </select>
                </div>
            </div> -->
			<div class="col-3">   
                <div class="form-group">
                    <label>District</label>
					<select name="post_code" id="post_code" class="form-control" aria-describedby="inputGroupPrepend2">
                    <option value=""></option>
                    <?php
                        $fQuery = "SELECT post_code,place,district1 FROM post_code order by place";
                        $result_location = sqlsrv_query($conn, $fQuery);
                        while($row = sqlsrv_fetch_array( $result_location, SQLSRV_FETCH_ASSOC)) {?>					  
                        <option value="<?php echo $row['post_code'];?>"><?php echo $row['place'];?></option>         
                    <?php } ?>
                    </select>
                </div>
            </div>
			<div class="col-3">   
                <div class="form-group">
                    <label>Province</label>
					<select name="post_code2" id="post_code2" class="form-control" aria-describedby="inputGroupPrepend2" readonly>
                    <option value=""></option>
                    <?php
                        $fQuery = "SELECT post_code,place,district1 FROM post_code order by district1";
                        $result_location = sqlsrv_query($conn, $fQuery);
                        while($row = sqlsrv_fetch_array( $result_location, SQLSRV_FETCH_ASSOC)) {?>					  
                        <option value="<?php echo $row['post_code'];?>"><?php echo $row['district1'];?></option>         
                    <?php } ?>
                    </select>
                </div>
            </div>
			<div class="col-3">   
                <div class="form-group">
                    <label>Postcode</label>
					<select name="post_code3" id="post_code3" class="form-control" aria-describedby="inputGroupPrepend2" readonly>
                    <option value=""></option>
                    <?php
                        $fQuery = "SELECT post_code,place,district1 FROM post_code order by post_code";
                        $result_location = sqlsrv_query($conn, $fQuery);
                        while($row = sqlsrv_fetch_array( $result_location, SQLSRV_FETCH_ASSOC)) {?>					  
                        <option value="<?php echo $row['post_code'];?>"><?php echo $row['post_code'];?></option>         
                    <?php } ?>
                    </select>
                </div>
            </div>
			
			<input type="text" id="reccode" name="reccode">
        </div>

        <div class="row">
            <div class="col-12">  

                <button style="width:100px" type="submit" class="btn btn-success" id="vehicle_type_submit" data-bs-target="#" >
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
    $("#location_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#location_data");
        var data = getFormData($form);
        $("#location_submit").prop("disabled",true);
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
            url: 'api/insert_contract_location_master.php',
            data: data,
            success: function(data) {
                $("#location_submit").prop("disabled",false);
                $('#location_table').DataTable().ajax.reload();
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
            url: 'api/update_contract_location_master.php',
            data: data,
            success: function(data) {
                $("#location_submit").prop("disabled",false);
                $('#location_table').DataTable().ajax.reload();
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
            load_location($("#reccode").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    function load_location(code){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_location_master.php?code='+code,
            success: function(data) {
                $('#location').val(data.location);
                $('#universal_location').val(data.universal_location);
				$('#sub_location').val(data.sub_location);
				$('#post_code').val(data.post_code);
				$('#post_code2').val(data.post_code);
				$('#post_code3').val(data.post_code);
				$('#reccode').val(data.reccode);
            }
        });
        //$('#code').attr('readonly', true);
        //$("#location_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#location_data input:checkbox').prop('checked', false);
        $('form#location_data input:text').val('');
        $("#location_submit").prop("disabled",false);
    }
</script>