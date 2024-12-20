<div class="modal-body"> 

    <form action="" method="POST" role="form" id="group_name_data">
        <div class="row">  
            <div class="col-3">   
                <div class="form-group">
                    <label>Code</label>
                    <input required type="text" name="code" id="code" class="form-control lower" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <label>Description</label>
                    <input required type="text" name="description" id="description" class="form-control" maxlength="50">
                </div>
            </div>
        </div>
		<div class="row">  
			<div class="col-2">   
                <div class="form-group">
					<label>Transport</label>
                    <input type="checkbox"  value="1" id="transport" name="transport" class="form-check">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
					<label>Manpower</label>
                    <input type="checkbox"  value="1" id="manpower" name="manpower" class="form-check">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
					<label>Cargo handling</label>
                    <input type="checkbox"  value="1" id="cargo_handling" name="cargo_handling" class="form-check">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
					<label>Service other</label>
                    <input type="checkbox"  value="1" id="service_other" name="service_other" class="form-check">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
					<label>Immigration</label>
                    <input type="checkbox"  value="1" id="immigration" name="immigration" class="form-check">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
					<label>Taxt service</label>
                    <input type="checkbox"  value="1" id="taxi_service" name="taxi_service" class="form-check">
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
    $("#group_name_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#group_name_data");
        var data = getFormData($form);
        $("#group_name_submit").prop("disabled",true);
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
            url: 'api/insert_group_name.php',
            data: data,
            success: function(data) {
                $("#group_name_submit").prop("disabled",false);
                $('#group_name_table').DataTable().ajax.reload();
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
            url: 'api/update_group_name.php',
            data: data,
            success: function(data) {
                $("#group_name_submit").prop("disabled",false);
                $('#group_name_table').DataTable().ajax.reload();
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
            load_group_name($("#code").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    function load_group_name(code){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_group_name.php?code='+code,
            success: function(data) {
                $('#code').val(data.code);
                $('#description').val(data.description);
				if(data.transport)
                    $('#transport').prop( "checked", true );
                else
                    $('#transport').prop( "checked", false );
				if(data.manpower)
                    $('#manpower').prop( "checked", true );
                else
                    $('#manpower').prop( "checked", false );
				if(data.cargo_handling)
                    $('#cargo_handling').prop( "checked", true );
                else
                    $('#cargo_handling').prop( "checked", false );
				if(data.service_other)
                    $('#service_other').prop( "checked", true );
                else
                    $('#service_other').prop( "checked", false );
				if(data.immigration)
                    $('#immigration').prop( "checked", true );
                else
                    $('#immigration').prop( "checked", false );
				if(data.taxi_service)
                    $('#taxi_service').prop( "checked", true );
                else
                    $('#taxi_service').prop( "checked", false );
            }
        });
        $('#code').attr('readonly', true);
        $("#group_name_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#group_name_data input:checkbox').prop('checked', false);
        $('form#group_name_data input:text').val('');
        $("#group_name_submit").prop("disabled",false);
    }
</script>