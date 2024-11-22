<div class="modal-body"> 

    <form action="" method="POST" role="form" id="branch_data">
        <div class="row">  
            <div class="col-3">   
                <div class="form-group">
                    <label>Code</label>
                    <input required type="text" name="code" id="code" class="form-control lower" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Description</label>
                    <input required type="text" name="description" id="description" class="form-control" maxlength="50">
                </div>
            </div>
			<div class="col-3">
				<div class="form-group">
					<label>Department</label>
					<select id="department" name="department" class="form-control" >
					<option value=""></option>
					<?php
						//$serverNamex = "192.168.10.4";
						//$connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
						//$connx = sqlsrv_connect( $serverNamex, $connectionInfox);
						$table = '';
						$dimension = " and [Dimension Code] = 'DEPARTMENT' ";
						$name = "";//" and Name <> 'OUTSOURCE' ";
						//$fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
                        $fQuery = ' SELECT * FROM vendor '.$dimension.$name;
						$result_skill = sqlsrv_query($conn, $fQuery);
						//while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>	<option value="<?php //echo $row['Code'];?>"><?php //echo $row['Code'];?></option>	              
					<?php //} ?>
					</select>
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					<label>Cost center</label>
					<select id="cost_center" name="cost_center" class="form-control" >
					<option value=""></option>
					<?php
						//$serverNamex = "192.168.10.4";
						//$connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
						//$connx = sqlsrv_connect( $serverNamex, $connectionInfox);
						$table = '';
						$dimension = " and [Dimension Code] = 'COST CENTER' ";
						$name = "";//" and Name <> 'OUTSOURCE' ";
						//$fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
                        $fQuery = ' SELECT * FROM vendor '.$dimension.$name;
						//$result_skill = sqlsrv_query($conn, $fQuery);
						//while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>	<option value="<?php //echo $row['Code'];?>"><?php //echo $row['Code'];?></option>	              
					<?php //} ?>
					</select>
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
    $("#branch_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#branch_data");
        var data = getFormData($form);
        $("#branch_submit").prop("disabled",true);
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
            url: 'api/insert_branch.php',
            data: data,
            success: function(data) {
                $("#branch_submit").prop("disabled",false);
                $('#branch_table').DataTable().ajax.reload();
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
            url: 'api/update_branch.php',
            data: data,
            success: function(data) {
                $("#branch_submit").prop("disabled",false);
                $('#branch_table').DataTable().ajax.reload();
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
            load_branch($("#code").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    function load_branch(code){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_branch.php?code='+code,
            success: function(data) {
                $('#code').val(data.code);
                $('#description').val(data.description);
				$('#department').val(data.department);
				$('#cost_center').val(data.cost_center);
            }
        });
        $('#code').attr('readonly', true);
        $("#branch_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#branch_data input:checkbox').prop('checked', false);
        $('form#branch_data input:text').val('');
        $("#branch_submit").prop("disabled",false);
    }
</script>