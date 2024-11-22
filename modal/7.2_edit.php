<div class="modal-body"> 

    <form action="" method="POST" role="form" id="vehicle_type_data">
        <div class="row">  
            <div class="col-3">   
                <div class="form-group">
                    <span>Miledge from</span>
                    <input required type="text" name="miledge_from" id="miledge_from" class="form-control" onkeypress="return lettersOnly(event)" maxlength="50">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <span>Miledge to</span>
                    <input required type="text" name="miledge_to" id="miledge_to" class="form-control" maxlength="50">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
					<span>Qty</span>
                    <input type="text" name="qty" id="qty" class="form-control" >
                </div>
            </div>
			<div class="col-2">
				<div class="form-group">
					<span>Long haul</span>
					<input type="checkbox"  value="1" id="long_haul" name="long_haul" class="form-check">
				</div>
			</div>
			<div class="col-2">
				<div class="form-group">
					<span>Round trip</span>
					<input type="checkbox"  value="1" id="round_trip" name="round_trip" class="form-check">
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
            url: 'api/insert_miledge_calc.php',
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
            url: 'api/update_miledge_calc.php?reccode='+$("#reccode").val(),
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
            load_vehicle_type($("#reccode").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    function load_vehicle_type(code){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_miledge_calc.php?reccode='+code,
            success: function(data) {
                $('#miledge_from').val(data.miledge_from);
                $('#miledge_to').val(data.miledge_to);
				$('#qty').val(data.qty);
				//$('#long_haul').val(data.long_haul);
				if(data.long_haul)
                    $('#long_haul').prop( "checked", true );
                else
                    $('#long_haul').prop( "checked", false );
				if(data.round_trip)
                    $('#round_trip').prop( "checked", true );
                else
                    $('#round_trip').prop( "checked", false );
				$('#reccode').val(data.reccode);
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