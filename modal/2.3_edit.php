<div class="modal-body"> 

    <form action="" method="POST" role="form" id="user_data">
        <div class="row">  
            <div class="col-2">   
                <div class="form-group">
                    <label>User Name</label>
                    <input required type="text" name="user_name" id="user_name" class="form-control lower" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
            <div class="col-2">   
                <div class="form-group">
                    <label>Password</label>
                    <input required type="text" name="password" id="password" class="form-control" maxlength="20">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Full Name</label>
                    <input required type="text" name="name" id="name" class="form-control" maxlength="50">
                </div>
            </div>
			<div class="col-2">
                <div class="form-group">
                    <label>Role</label>
                    <select name="user_role" id="user_role" class="form-control" aria-describedby="inputGroupPrepend2" required>
                        <!-- <option value="User">User</option>
						<option value="Supervisor">Supervisor</option>
						<option value="Driver">Driver</option> -->
                            <?php
                            $fQuery = "SELECT * FROM FES.dbo.[role] WHERE status = 1";
                            $result = sqlsrv_query($conn, $fQuery);
                            while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                        <option value="<?php echo $row['rolename'];?>"><?php echo $row['rolename']?></option>	              
                            <?php } ?>
                    </select>
                </div>
            </div>
            <!-- add -->
            <div class="col-2">
                <div class="form-group">
                    <label>Type</label>
                    <select name="user_type" id="user_type" class="form-control" aria-describedby="inputGroupPrepend2"  required>
                    <option  disabled selected></option>
                        <option value="Admin">Admin</option>
						<option value="AAL">AAL</option>
						<option value="AA">AA</option>
                        <option value="ALL">ALL</option>
                    </select>
                </div>
            </div>
			<div class="col-3">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" id="email" class="form-control" maxlength="50">
                </div>
            </div>
			<div class="col-3">
                <div class="form-group">
                    <label>Manager name</label>
                    <input type="text" name="manager_name" id="manager_name" class="form-control" maxlength="50">
                </div>
            </div>
			<div class="col-2">
				<div class="form-group">
					<label>re-open worksheet</label>
					<input type="checkbox" value="1" id="reopen" name="reopen" class="form-check">
				</div>
			</div>
			<div class="col-2">
				<div class="form-group">
					<label>Show price</label>
					<input type="checkbox" value="1" id="show_price" name="show_price" class="form-check">
				</div>
			</div>
			<div class="col-2">
				<div class="form-group">
					<label>re-print worksheet</label>
					<input type="checkbox" value="1" id="print_worksheet" name="print_worksheet" class="form-check">
				</div>
			</div>
        </div>
        <div class="row">  
                <div class="col-2">   

                </div>
                <div class="col-2">   
                    Access
                </div>
                <div class="col-2">   
                    Add
                </div>
                <div class="col-2">   
                    Edit
                </div>
                <div class="col-2">   
                    Delete
                </div>

        </div>
        <?php
        $fQuery = "SELECT * FROM user_menu";
        $result = sqlsrv_query($conn, $fQuery);
        while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
        ?>                    
            <div class="row">  
                <div class="col-2">   
                    <div class="form-group">
                        <label><?php echo $row['menu_name']; ?></label>
                       
                    </div>
                </div>
                <div class="col-2">   
                    <div class="form-group ">
                        <input type="checkbox"  value="<?php echo $row['menu_id']; ?>" id="check_access_<?php echo $row['menu_id']; ?>" name="check_access_<?php echo $row['menu_id']; ?>" class="form-check">
                    </div>
                </div>
                <div class="col-2">   
                    <div class="form-group">
                        <input type="checkbox"  value="<?php echo $row['menu_id']; ?>" id="check_add_<?php echo $row['menu_id']; ?>" name="check_add_<?php echo $row['menu_id']; ?>" class="form-check">
                    </div>
                </div>
                <div class="col-2">   
                    <div class="form-group">
                        <input type="checkbox"  value="<?php echo $row['menu_id']; ?>" id="check_edit_<?php echo $row['menu_id']; ?>" name="check_edit_<?php echo $row['menu_id']; ?>" class="form-check">
                    </div>
                </div>
                <div class="col-2">   
                    <div class="form-group">
                        <input type="checkbox"  value="<?php echo $row['menu_id']; ?>" id="check_delete_<?php echo $row['menu_id']; ?>" name="check_delete_<?php echo $row['menu_id']; ?>" class="form-check">
                    </div>
                </div>
       
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-12">  

                <button type="submit" class="btn btn-success" id="user_submit" data-bs-target="#" >
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
    $("#user_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#user_data");
        var data = getFormData($form);
        $("#user_submit").prop("disabled",true);
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
            url: 'api/insert_user.php',
            data: data,
            success: function(data) {
                $("#user_submit").prop("disabled",false);
                $('#user_table').DataTable().ajax.reload();
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
            url: 'api/update_user.php',
            data: data,
            success: function(data) {
                $("#user_submit").prop("disabled",false);
                $('#user_table').DataTable().ajax.reload();
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
            load_user($("#user_name").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    function load_user(user_name){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_user.php?user_name='+user_name,
            success: function(data) {
                $('#user_name').val(data.user_name);
                $('#password').val(data.password);
                $('#name').val(data.name);
				$('#manager_name').val(data.manager_name);
                $('#user_type').val(data.user_type);
				$('#email').val(data.email);
                $('#reopen').prop('checked', data.reopen);
				$('#show_price').prop('checked', data.show_price);
				$('#print_worksheet').prop('checked', data.print_worksheet);
                $('#user_role').val(data.user_role);
                $.each( data.user_menu, function( i, val ) {
                    $('#check_access_'+val.id).prop('checked', val.access);
                    $('#check_add_'+val.id).prop('checked', val.add);
                    $('#check_edit_'+val.id).prop('checked', val.edit);
                    $('#check_delete_'+val.id).prop('checked', val.delete);
                });
            }
        });
        $('#user_name').attr('readonly', true);
        $("#user_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#user_data input:checkbox').prop('checked', false);
        $('form#user_data input:text').val('');
        $("#user_submit").prop("disabled",false);
    }
</script>