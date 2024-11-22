<div class="modal-body"> 

    <form action="" method="POST" role="form" id="location_data">
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
			<div class="col-2">
                <div class="form-group">
                    <label>Sort ID</label>
                    <input required type="number" name="sort_id" id="sort_id" class="form-control" >
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
            url: 'api/insert_sub_location.php',
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
            url: 'api/update_sub_location.php',
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
            load_location($("#code").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    function load_location(code){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_sub_location.php?code='+code,
            success: function(data) {
                $('#code').val(data.code);
                $('#description').val(data.description);
				$('#sort_id').val(data.sort_id);
            }
        });
        $('#code').attr('readonly', true);
        $("#location_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#location_data input:checkbox').prop('checked', false);
        $('form#location_data input:text').val('');
        $("#location_submit").prop("disabled",false);
    }
</script>