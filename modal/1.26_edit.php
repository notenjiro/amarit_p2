<div class="modal-body"> 

    <form action="" method="POST" role="form" id="forklift_data">
        <div class="row">  
            <div class="col-3">   
                <div class="form-group">
                    <label>Code</label>
                    <input required type="text" name="code" id="code" class="form-control lower" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Description</label>
                    <input required type="text" name="description" id="description" class="form-control" maxlength="50">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">  

                <button type="submit" class="btn btn-success" id="forklift_submit" data-bs-target="#" >
                    <i class="fas fa-save"></i> Save
                </button>

                <button type="button" class="btn btn-danger"  id="cancel" data-bs-target="#" >
                    <i class="fas fa-minus-square"></i> Cancel
                </button>

            </div>
        </div>                  
    </form>

</div>

<input required type="hidden" name="form_type" id="form_type">

<script>
    $("#forklift_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#forklift_data");
        var data = getFormData($form);
        $("#forklift_submit").prop("disabled",true);
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
            url: 'api/insert_forklift.php',
            data: data,
            success: function(data) {
                $("#forklift_submit").prop("disabled",false);
                $('#forklift_table').DataTable().ajax.reload();
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
            url: 'api/update_forklift.php',
            data: data,
            success: function(data) {
                $("#forklift_submit").prop("disabled",false);
                $('#forklift_table').DataTable().ajax.reload();
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
            load_forklift($("#code").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    function load_forklift(code){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_forklift.php?code='+code,
            success: function(data) {
                $('#code').val(data.code);
                $('#description').val(data.description);
            }
        });
        $('#code').attr('readonly', true);
        $("#forklift_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#forklift_data input:checkbox').prop('checked', false);
        $('form#forklift_data input:text').val('');
        $("#forklift_submit").prop("disabled",false);
    }
</script>