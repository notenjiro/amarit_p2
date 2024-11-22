<div class="modal-body"> 

    <form action="" method="POST" role="form" id="customer_data">
        <div class="row">  
            <div class="col-2">   
                <div class="form-group">
                    <label>Client ID</label>
                    <input required type="text" name="customer_id" id="customer_id" class="form-control" onkeypress="return lettersOnly(event)" maxlength="20" readonly>
                </div>
            </div>
			<div class="col-3">
                <div class="form-group">
                    <label>ERP ID </label>
					<select name="erp_id" id="erp_id"  class="form-control"  >
						<option value=""></option>
						<?php
                            //require_once '../config_db_erp.php';
						    //$serverNamex = "192.168.10.4";
							//$connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
							//$connx = sqlsrv_connect( $serverNamex, $connectionInfox);
							//$table = '';
							//$dimension = "";//" and [Dimension Code] = 'VEHICLE ID' ";
							//$name = "";//" and Name <> 'OUTSOURCE' ";
							//$fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Customer] where Blocked = 0 '.$dimension.$name;
							//$result_skill = sqlsrv_query($conn_erp, $fQuery);
							//while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
							<option value="<?php //echo $row['No_'];?>"><?php //echo $row['No_'];?></option>	              
						<?php //} ?>
					</select>
                </div>
            </div>
			<div class="col-5">   
                <div class="form-group">
                    <label>Name</label>
                    <input required type="text" name="name" id="name" class="form-control" onkeypress="return lettersOnly(event)" maxlength="100">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
                    <label>ABS</label>
                    <input type="text" name="abs" id="abs" class="form-control" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
			<div class="col-4">   
                <div class="form-group">
                    <label>Address</label>
                    <input required type="text" name="address" id="address" class="form-control" onkeypress="return lettersOnly(event)" maxlength="100">
                </div>
            </div>
			<div class="col-5">   
                <div class="form-group">
                    <label>Address 2</label>
                    <input type="text" name="address2" id="address2" class="form-control" onkeypress="return lettersOnly(event)" maxlength="100">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
                    <label>Province</label>
                    <input required type="text" name="province" id="province" class="form-control" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
                    <label>Postcode</label>
                    <input required type="text" name="postcode" id="postcode" class="form-control" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
                    <label>Te.</label>
                    <input required type="text" name="tel" id="tel" class="form-control" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>
			<div class="col-2">   
                <div class="form-group">
                    <label>Fax</label>
                    <input type="text" name="fax" id="fax" class="form-control" onkeypress="return lettersOnly(event)" maxlength="20">
                </div>
            </div>	
			<div class="col-1">
				<div class="form-group">
					<label>Block</label>
					<input type="checkbox"  value="1" id="block" name="block" class="form-check">
				</div>
			</div>
			<div class="col-4">   
				<div class="form-group">
					<label>Remark</label>
					<input type="text" name="remark" id="remark"		class="form-control" >
				</div>
			</div>
        </div>			

        <div class="row">
            <div class="col-12">  

                <button style="width:100px" type="submit" class="btn btn-success" id="customer_submit" data-bs-target="#" >
                    <i class="fa fa-save"></i> Save
                </button>

                <button style="width:100px" type="button" class="btn btn-danger"  id="cancel" data-bs-target="#" >
                    <i class="fa fa-minus-square"></i> Cancel
                </button>

            </div>
        </div>                  
    </form>

</div>

<input required type="hidden" name="form_type" id="form_type">

<script>
    $("#customer_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#customer_data");
        var data = getFormData($form);
        $("#customer_submit").prop("disabled",true);
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
            url: 'api/insert_customer.php',
            data: data,
            success: function(data) {
                $("#customer_submit").prop("disabled",false);
                $('#customer_table').DataTable().ajax.reload();
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
            url: 'api/update_customer.php',
            data: data,
            success: function(data) {
                $("#customer_submit").prop("disabled",false);
                $('#customer_table').DataTable().ajax.reload();
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
            load_customer($("#customer_id").val())
        else
            clear_data();
		$('#vieweditmodal').modal('hide');
    });

	$("#erp_id").on('change',function(){
		//$("#remark").val("123");
		//$("#name").val("123");
		get_customer($("#erp_id").val());
		//get_customer("C0001");
    });
    
    function load_customer(customer_id){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_customer.php?customer_id='+customer_id,
            success: function(data) {
                $('#customer_id').val(data.customer_id);
                $('#erp_id').val(data.erp_id);
				$('#name').val(data.name);
                $('#abs').val(data.abs);
				$('#address').val(data.address);
				$('#address2').val(data.address2);
                $('#province').val(data.province);
				$('#postcode').val(data.postcode);
				$('#tel').val(data.tel);
                $('#fax').val(data.fax);
				$('#remark').val(data.remark);
				//$('#block').prop('checked', torf(data.block));
				if(data.block)
                    $('#block').prop( "checked", true );
                else
                    $('#block').prop( "checked", false );
				// $.each( data.outsource, function( i, val ) {
                //     $('#check_'+val.id).prop('checked', val.access);
                // })
            }
        });
        $('#customer_id').attr('readonly', true);
        $("#customer_submit").prop("disabled",false);
    }

    function clear_data(){
        $('form#customer_data input:checkbox').prop('checked', false);
        $('form#customer_data input:text').val('');
        $("#customer_submit").prop("disabled",false);
    }

	function get_number(){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_customer_number.php',
            success: function(data) {
                $('#customer_id').val(data.num);
				$('#customer_id').attr('readonly', true);
            }
        });
    }

	function get_customer(erp_id){
		//$('#name').val(erp_id);
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_customer_info.php?erp_id='+erp_id,
            success: function(data) {
				$('#name').val(data.name);
				$('#address').val(data.address);
				$('#address2').val(data.address2);
				$('#tel').val(data.tel);
				$('#province').val(data.province);
				$('#postcode').val(data.postcode);
            }
        });
    }

</script>