<div class="modal-body"> 
    <form action="" method="POST" role="form" id="public_holiday_data">
        <div class="row">  
            <div class="col-3">   
                <div class="form-group">
                    <label>Date</label>
                    <input required type="date" name="non_working_date" id="non_working_date" class="form-control" >
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Holiday name</label>
                    <input required type="text" name="holiday_name" id="holiday_name" class="form-control" maxlength="100">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">  

                <button style="width:100px" type="submit" class="btn btn-success" id="public_holiday_submit" data-bs-target="#" >
                    <i class="fas fa-save"></i> Save
                </button>

                <button style="width:100px" type="button" class="btn btn-danger" id="cancel" data-bs-target="#" >
                    <i class="fas fa-minus-square"></i> Cancel
                </button>
				<input type="hidden" id="reccode">
            </div>
        </div>                  
    </form>

</div>

<input required type="hidden" name="form_type" id="form_type">

<script>
    $("#public_holiday_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#public_holiday_data");
        var data = getFormData($form);
        $("#public_holiday_submit").prop("disabled",true);
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
            url: 'api/insert_public_holiday.php',
            data: data,
            success: function(data) {
                $("#public_holiday_submit").prop("disabled",false);
                $('#public_holiday_table').DataTable().ajax.reload();	
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
					$('#vieweditmodal').modal('hide'); 
					$('#vieweditmodal').modal('hide');
                    table				
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
            url: 'api/update_public_holiday.php',
            data: data,
            success: function(data) {
                $("#public_holiday_submit").prop("disabled",false);
                $('#public_holiday_table').DataTable().ajax.reload();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
					$('#vieweditmodal').modal('hide'); 
					$('#vieweditmodal').modal('hide');
			
                } else {
                    swal(Result.msg);
					$('#vieweditmodal').modal('hide');
                }
            }
        });
    }

    $("#cancel").on('click',function(){
        if($("#form_type").val() == 'update') {
            load_public_holiday($("#code").val());
			$('#vieweditmodal').modal('hide');
        } else {
            clear_data();
			$('#vieweditmodal').modal('hide');
		}
    })
   
    function load_public_holiday(code){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_public_holiday.php?reccode='+code,
            success: function(data) {
                $('#non_working_date').val(data.non_working_date);
                $('#holiday_name').val(data.holiday_name);
            }
        });
        //$('#code').attr('readonly', true);
        $("#public_holiday_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#public_holiday_data input:checkbox').prop('checked', false);
        $('form#public_holiday_data input:text').val('');
        $("#public_holiday_submit").prop("disabled",false);
    }
</script>