<div class="modal-body"> 

    <form action="" method="POST" role="form" id="vehicle_owner_data">
        <div class="row">  
            <div class="col-2">   
                <div class="form-group">
                    <label>Code</label>
                    <input required type="text" name="code" id="code" class="form-control lower" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label>Description</label>
                    <input required type="text" name="description" id="description" class="form-control" maxlength="50">
                </div>
            </div>
			<div class="col-1">   
                <div class="form-group">
					<label>Outsource</label>
                    <input type="checkbox"  value="true" id="outsource" name="outsource" class="form-check">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
                    <label>ERP Vendor ID</label>
                    <input required type="text" name="erp_vendor_id" id="erp_vendor_id" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">  

                <button style="width:100px" type="submit" class="btn btn-success" id="vehicle_owner_submit" data-bs-target="#" >
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
    $("#vehicle_owner_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#vehicle_owner_data");
        var data = getFormData($form);
        $("#vehicle_owner_submit").prop("disabled",true);
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
            url: 'api/insert_vehicle_owner.php',
            data: data,
            success: function(data) {
                $("#vehicle_owner_submit").prop("disabled",false);
                $('#vehicle_owner_table').DataTable().ajax.reload();
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
            url: 'api/update_vehicle_owner.php',
            data: data,
            success: function(data) {
                $("#vehicle_owner_submit").prop("disabled",false);
                $('#vehicle_owner_table').DataTable().ajax.reload();
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
            load_vehicle_owner($("#code").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    function load_vehicle_owner(code){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_vehicle_owner.php?code='+code,
            success: function(data) {
                $('#code').val(data.code);
                $('#description').val(data.description);
                $('#outsource').prop('checked', data.outsource);
				$('#erp_vendor_id').val(data.erp_vendor_id);
            }
        });
        $('#code').attr('readonly', true);
        $("#vehicle_owner_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#vehicle_owner_data input:checkbox').prop('checked', false);
        $('form#vehicle_owner_data input:text').val('');
        $("#vehicle_owner_submit").prop("disabled",false);
    }

	function get_number(){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_owner_number.php',
            success: function(data) {
                $('#code').val(data.num);
				$('#code').attr('readonly', true);
            }
        });
    }
</script>