<div class="modal-body"> 

    <form action="" method="POST" role="form" id="charge_type_data">
        <div class="row">  
            <div class="col-3">   
                <div class="form-group">
                    <label>Code</label>
                    <input required type="text" name="code" id="code" class="form-control lower" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Description</label>
                    <input required type="text" name="description" id="description" class="form-control" maxlength="50">
                </div>
            </div>
			<div class="col-4">
                <div class="form-group">
                    <label>Description 2</label>
                    <input required type="text" name="description2" id="description2" class="form-control" maxlength="50">
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
    $("#charge_type_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#charge_type_data");
        var data = getFormData($form);
        $("#charge_type_submit").prop("disabled",true);
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
            url: 'api/insert_charge_type.php',
            data: data,
            success: function(data) {
                $("#charge_type_submit").prop("disabled",false);
                $('#charge_type_table').DataTable().ajax.reload();
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
            url: 'api/update_charge_type.php',
            data: data,
            success: function(data) {
                $("#charge_type_submit").prop("disabled",false);
                $('#charge_type_table').DataTable().ajax.reload();
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
            load_charge_type($("#code").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    function load_charge_type(code){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_charge_type.php?code='+code,
            success: function(data) {
                $('#code').val(data.code);
                $('#description').val(data.description);
				$('#description2').val(data.description2);
            }
        });
        $('#code').attr('readonly', true);
        $("#charge_type_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#charge_type_data input:checkbox').prop('checked', false);
        $('form#charge_type_data input:text').val('');
        $("#charge_type_submit").prop("disabled",false);
    }
</script>