<div class="modal-body"> 

    <form action="" method="POST" role="form" id="diesel_rate_data">
        <div class="row">  
            <div class="col-3">   
                <div class="form-group">
                    <label>Date</label>
                    <input required type="date" name="diesel_rate_date" id="diesel_rate_date" class="form-control lower" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Diesel Rate</label>
                    <input required type="text" name="diesel_rate" id="diesel_rate" class="form-control" maxlength="100">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">  

                <button style="width:100px" type="submit" class="btn btn-success" id="diesel_rate_submit" data-bs-target="#" >
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
    $("#diesel_rate_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#diesel_rate_data");
        var data = getFormData($form);
        $("#diesel_rate_submit").prop("disabled",true);
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
            url: 'api/insert_diesel_rate.php',
            data: data,
            success: function(data) {
                $("#diesel_rate_submit").prop("disabled",false);
                $('#diesel_rate_table').DataTable().ajax.reload();
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
            url: 'api/update_diesel_rate.php',
            data: data,
            success: function(data) {
                $("#diesel_rate_submit").prop("disabled",false);
                $('#diesel_rate_table').DataTable().ajax.reload();
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
            load_diesel_rate($("#code").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    function load_diesel_rate(code){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_diesel_rate.php?code='+code,
            success: function(data) {
                $('#diesel_rate_date').val(data.diesel_rate_date);
                $('#diesel_rate').val(data.diesel_rate);
            }
        });
        $('#diesel_rate_date').attr('readonly', true);
        $("#diesel_rate_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#diesel_rate_data input:checkbox').prop('checked', false);
        $('form#diesel_rate_data input:text').val('');
        $("#diesel_rate_submit").prop("disabled",false);
    }
</script>