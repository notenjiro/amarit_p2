<div class="modal-body"> 

    <form action="" method="POST" role="form" id="vehicle_type_data">
        <div class="row">  
            <div class="col-3">   
                <div class="form-group">
                    <label>Code</label>
                    <input required type="text" name="code" id="code" class="form-control" onkeypress="return lettersOnly(event)" maxlength="50">
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label>Description</label>
                    <input required type="text" name="description" id="description" class="form-control" maxlength="50">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
					<label>Fuel ratio</label>
                    <input type="text" name="fuel_km_per_litre" id="fuel_km_per_litre" class="form-control" >
                </div>
            </div>
			<div class="col-2">
                <div class="form-group">
                    <label>Vehicle Group</label>
					<select name="vehicle_group" id="vehicle_group" class="form-control">
						<option value=""></option>
						<option value="Vehicle">Vehicle</option>
                        <option value="Forklift">Forklift</option>
						<option value="Crane">Crane</option>
                    </select> 
                </div>
            </div>
			<div class="col-3">
				<div class="form-group">
					<span>Block in driver allowance</span>
					<input type="checkbox"  value="1" id="block_allowance" name="block_allowance" class="form-check">
				</div>
			</div>
			<div class="col-1">   
                <div class="form-group">
                    <input type="text" name="reccode" id="reccode" hidden>
                </div>
            </div>
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
    $("#vehicle_type_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#vehicle_type_data");
        var data = getFormData($form);
        $("#vehicle_type_submit").prop("disabled",true);
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
            url: 'api/insert_vehicle_type.php',
            data: data,
            success: function(data) {
                $("#vehicle_type_submit").prop("disabled",false);
                var table = $('#vehicle_type_table').DataTable();
				$('#vehicle_type_table').DataTable().ajax.reload();
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
            url: 'api/update_vehicle_type.php?reccode='+$("#reccode").val(),
            data: data,
            success: function(data) {
                $("#vehicle_type_submit").prop("disabled",false);
                Result = data;
                var table = $('#vehicle_type_table').DataTable();
				$('#vehicle_type_table').DataTable().ajax.reload();
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
            load_vehicle_type($("#code").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    function load_vehicle_type(code){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_vehicle_type.php?code='+code,
            success: function(data) {
                $('#code').val(data.code);
                $('#description').val(data.description);
				$('#fuel_km_per_litre').val(data.fuel_km_per_litre);
				$('#vehicle_group').val(data.vehicle_group);
				$('#reccode').val(data.reccode);
				if(data.block_allowance)
                    $('#block_allowance').prop( "checked", true );
                else
                    $('#block_allowance').prop( "checked", false );
            }
        });
        //$('#code').attr('readonly', true);
		$('#code').attr('readonly', false);
        $("#vehicle_type_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#vehicle_type_data input:checkbox').prop('checked', false);
        $('form#vehicle_type_data input:text').val('');
        $("#vehicle_type_submit").prop("disabled",false);
    }
</script>