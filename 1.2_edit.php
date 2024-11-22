<div class="modal-body"> 
    <form id="contract_data">
        <div id="edit_area">
            <div class="row">  
                <div class="col-3">   
                    <div class="form-group">
                        <label>Contract No.</label>
                        <input type="text" name="contract_no" id="contract_no" class="form-control" required>
                    </div>
                </div>
                <div class="col-3">   
                    <div class="form-group">
                        <label>Contract Date</label>
                        <input type="date" name="contract_date" id="contract_date" class="form-control" required>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">  
                <div class="col-6">   
                    <div class="form-group">
                        <label>Customer</label>
                        <select name="customer" id="customer" class="form-control" aria-describedby="inputGroupPrepend2" required>
                            <option value=""></option>
                            <?php
                                $fQuery = "SELECT customer_id,name FROM customer";
                                $result_chart_of_account = sqlsrv_query($conn, $fQuery);
                                $x = 1;
                                while($row = sqlsrv_fetch_array( $result_chart_of_account, SQLSRV_FETCH_ASSOC)) {?>					  
                                <option value="<?php echo $row['customer_id'];?>"><?php echo $row['name'];?></option>	              
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>Customer ref.</label>
                        <input type="text" name="customer_ref" id="customer_ref" class="form-control" required>
                    </div>
                </div>
                <div class="col-3">
                </div>
            </div>
            <div class="row">  
                
                <div class="col-2">
                    <br>
                    <br>
                    <div class="form-inline">
                    &nbsp;&nbsp;<input type="checkbox"  value="true" id="active" name="active" class="form-check"> &nbsp;&nbsp;&nbsp;
                        <lavel>Active</label>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control" aria-describedby="inputGroupPrepend2">
                            <option value="on going">on going</option>
                            <option value="nearing expire">nearing expire</option>
                            <option value="expired">expired</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <br>
                    <br>
                    <div class="form-inline">
                    <input type="checkbox"  value="true" id="pay_cash" name="pay_cash" class="form-check"> &nbsp;&nbsp;&nbsp;
                        <lavel>Pay Cash</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <br>  
                    <div class="form-inline">
                    &nbsp;&nbsp;<input type="checkbox"  value="true" id="diesel" name="diesel" class="form-check"> &nbsp;&nbsp;&nbsp;
                        <lavel><small>If Diesel price does exceed THB ___ per liter then a ___ % increse in our charge rate per unit will be applied for every THB ___ increase in the Diesal price.</small></label>
                    </div>
                </div>
            </div>

            <div class="row">  
                
                <div class="col-12">
                    <br>
                    <div class="form-inline">
                    &nbsp;&nbsp;<input type="checkbox"  value="true" id="rounding" name="rounding" class="form-check"> &nbsp;&nbsp;&nbsp;
                        <lavel><small>Rounding trip (Backload) is charged at __ % of a "with cargo-single trip"</small></label>
                    </div>
                </div>

            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-12">  
                <button style="width:100px" type="submit" class="btn btn-success" id="contract_submit" data-bs-target="#" >
                        <i class="fas fa-save"></i> Save
                    </button>
                <button style="width:100px" type="button" class="btn btn-danger"  id="contract_cancel" data-bs-target="#" >
                    <i class="fas fa-minus-square"></i> Cancel
                </button>
                <input type="hidden" id="contact_id">
            </div>
        </div>               
    
    </form>


    <div id="sub_data">
        <div class="card-body">  
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#location-tab" id="location-nav">Location</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#transporation-tab" id="transporation-nav">Transporation Rate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#service-tab" id="service-nav">Service Rate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#serviceat-tab" id="serviceat-nav">Service Rate at Diesel Price Variable</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#heavy-tab" id="heavy-nav">Heavy Equipment Rental</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#nonworking-tab" id="nonworking-nav">non-working date table</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#overtime-tab" id="overtime-nav">Overtime Charge Rates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#hourly-tab" id="hourly-nav">Hourly Rates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#working-tab" id="working-nav">working day by position</a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane container fade" id="location-tab"></div>  
                <div class="tab-pane container fade" id="transporation-tab"></div>
                <div class="tab-pane container fade" id="service-tab"></div>
                <div class="tab-pane container fade" id="serviceat-tab"></div>
                <div class="tab-pane container fade" id="heavy-tab"></div>
                <div class="tab-pane container fade" id="nonworking-tab"></div>
                <div class="tab-pane container active" id="overtime-tab">
                    <br>
                    <form id="overtime_data">
                        <div class="row">  
                            <div class="col-3">   
                                <div class="form-group">
                                    <label>Monday-Friday</label>
                                    <input type="text" maxlength="1" name="monday_friday" id="monday_friday" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">   
                                <div class="form-group">
                                    <label>Sunday/Public Hoiday 8:01-17:00</label>
                                    <input type="text" maxlength="1" name="sunday_8" id="sunday_8" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Sunday/Public Holiday 17:01-8:00</label>
                                    <input type="text" maxlength="1" name="sunday_17" id="sunday_17" class="form-control">
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <br>
                                    <button style="width:100px" type="button" class="btn btn-success" id="overtime_save" data-bs-target="#" >
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>              
                </div>
                <div class="tab-pane container fade" id="hourly-tab">
                    <br>
                    <form id="hourly_data">
                        <div id="hourly_edit_area">
                        
                            <div class="row">  
                                <div class="col-3">   
                                    <div class="form-group">
                                    <label>Position</label>
                                        <input type="text" name="position" id="position" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-3">   
                                    <div class="form-group">
                                        <label>Universal Position</label>
                                        <select name="universal_position" id="universal_position" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value="Forklift Operation">Forklift Operation</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select name="type" id="type" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value="Working Days">Working Days</option>
                                        </select>
                                    </div>
                                </div>
                
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Normal</label>
                                        <input type="text" name="normal" id="normal"  class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>After Normal</label>
                                        <input type="text" name="after_normal" id="after_normal"  class="form-control" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">  
                                <button type="button" class="btn btn-primary" id="hourly_add" data-bs-target="#" >
                                    <i class="fas fa-plus-square"></i> Add
                                </button>

                                <button type="submit" class="btn btn-success" id="hourly_submit" data-bs-target="#" >
                                    <i class="fas fa-save"></i> Save
                                </button>

                                <button type="button" class="btn btn-danger"  id="hourly_cancel" data-bs-target="#" >
                                    <i class="fas fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="hourly_type" id="hourly_type">
                                <input type="hidden" name="hourly_reccode" id="hourly_reccode">

                            </div>
                        </div>     
                    </form>
                    <table id="hourly_table" class="table table-striped" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="15%">Position</th>
                                <th scope="col" width="20%">Universal Position</th>
                                <th scope="col" width="15%">Type</th>
                                <th scope="col" width="15%">Nomal</th>
                                <th scope="col" width="15%">After Nomal</th>
                                <th scope="col" width="20%"></th>
                            </tr>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>


                </div>
                <div class="tab-pane container fade" id="working-tab">

                <br>
                    <form id="working_data">
                        <div id="working_edit_area">
                        
                            <div class="row">  
                                <div class="col-3">   
                                    <div class="form-group">
                                    <label>Position</label>
                                        <select name="working_position" id="working_position" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value="Forklift Operation">Forklift Operation</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-1">   
                                    <div class="form-group">
                                        <label>Monday</label>
                                        <input type="checkbox"  value="true" id="monday" name="monday" class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <label>Tuesday</label>
                                        <input type="checkbox"  value="true" id="tuesday" name="tuesday" class="form-check">
                                    </div>
                                </div>
                
                                <div class="col-1">
                                    <div class="form-group">
                                        <label>Wednesday</label>
                                        <input type="checkbox"  value="true" id="wednesday" name="wednesday" class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <label>Thursday</label>
                                        <input type="checkbox"  value="true" id="thursday" name="thursday" class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <label>Friday</label>
                                        <input type="checkbox"  value="true" id="friday" name="friday" class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <label>Saturday</label>
                                        <input type="checkbox"  value="true" id="saturday" name="saturday" class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <label>Sunday</label>
                                        <input type="checkbox"  value="true" id="sunday" name="sunday" class="form-check">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">  
                                <button type="button" class="btn btn-primary" id="working_add" data-bs-target="#" >
                                    <i class="fas fa-plus-square"></i> Add
                                </button>

                                <button type="submit" class="btn btn-success" id="working_submit" data-bs-target="#" >
                                    <i class="fas fa-save"></i> Save
                                </button>

                                <button type="button" class="btn btn-danger"  id="working_cancel" data-bs-target="#" >
                                    <i class="fas fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="working_type" id="working_type">
                                <input type="hidden" name="working_reccode" id="working_reccode">

                            </div>
                        </div>     
                    </form>
                    <table id="working_table" class="table table-striped" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="15%">Position</th>
                                <th scope="col" width="10%">Monday</th>
                                <th scope="col" width="10%">Tuesday</th>
                                <th scope="col" width="10%">Wednesday</th>
                                <th scope="col" width="10%">Thursday</th>
                                <th scope="col" width="10%">Friday</th>
                                <th scope="col" width="10%">Saturday</th>
                                <th scope="col" width="10%">Sunday</th>
                                <th scope="col" width="15%"></th>
                            </tr>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>
                </div>
            </div>          
            
        </div>
    </div>
</div>

<input required type="hidden" name="form_type" id="form_type">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
    function load_contract(contract_no){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract.php?contract_no='+contract_no,
            success: function(data) {
                $('#contract_no').val(data.contract_no);
                $('#contract_date').val(data.contract_date);
				$('#start_date').val(data.start_date);
                $('#end_date').val(data.end_date);
				$('#customer').val(data.customer);
				$('#customer_ref').val(data.customer_ref);
                $('#status').val(data.status);

                $('#active').prop('checked', data.active);
                $('#pay_cash').prop('checked', data.pay_cash);
                $('#diesel').prop('checked', data.diesel);
                $('#rounding').prop('checked', data.rounding);

				$('#monday_friday').val(data.monday_friday);
                $('#sunday_8').val(data.sunday_8);
				$('#sunday_17').val(data.sunday_17);
            }
        });
        $('#contract_no').attr('readonly', true);
        $("#vehicle_submit").prop("disabled",false);
        $("#sub_data").show();

        $('[href="#overtime-tab"]').tab('show');
    }

    function clear_data(){
        $('form#contract_data input:checkbox').prop('checked', false);
        $('form#contract_data input:text').val('');
        $('form#contract_data input[type="date"]').val('');
        $('form#contract_data select').val('');
        $("#contract_submit").prop("disabled",false);
    }

    /********* MAIN  ************/
    $("#contract_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#contract_data");
        var data = getFormData($form);
        $("#contract_submit").prop("disabled",true);
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
            url: 'api/insert_contract.php',
            data: data,
            success: function(data) {
                $("#contract_submit").prop("disabled",false);
                $('#contract_table').DataTable().ajax.reload();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                    load_contract($("#contract_no").val());
                    $('#form_type').val('update'); 
					// $('#vieweditmodal').modal('hide'); 
                    // clear_data();
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
            url: 'api/update_contract.php',
            data: data,
            success: function(data) {
                $("#contract_submit").prop("disabled",false);
                $('#contract_table').DataTable().ajax.reload();
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

    $("#contract_cancel").on('click',function(){
		$('#vieweditmodal').modal('hide');
    })

    /********* Overtime ************/
    $("#overtime_save").on('click',function(){
        var $form = $("#overtime_data");
        var data = getFormData($form);
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_contract_overtime.php?contract_no='+$("#contract_no").val(),
            data: data,
            success: function(data) {
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    })

    /********* Hourly ************/
    $("#hourly-nav").on('click',function(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;
        var table = $('#hourly_table').DataTable( {
            "ajax": "api/view_contract_hourly.php?contract_no="+$("#contract_no").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo" : false,
            "columnDefs": [ {
                "targets": -1,
                "data": null,
                "defaultContent": btn
            } ],
            "bDestroy": true
        } );

        if($("#form_type").val()!="")
            $("#hourly_add").show();
        $("#hourly_edit_area").hide();
        $("#hourly_submit").hide();
        $("#hourly_cancel").hide();
    })

    $("#hourly_add").on('click',function(){
        $('form#hourly_data input:text').val('');
        $('form#hourly_data select').val('');

        $("#hourly_type").val('insert');
        $("#hourly_add").hide();
        $("#hourly_edit_area").fadeIn();
        $("#hourly_submit").show();
        $("#hourly_cancel").show();
    })

    $('#hourly_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#hourly_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

        $("#position").val(data[0]);
        $("#universal_position").val(data[1]);
        $("#type").val(data[2]);
        $("#normal").val(data[3]);
        $("#after_normal").val(data[4]);
        $("#hourly_reccode").val(data[5]);

        $("#hourly_type").val('update');
        $("#hourly_add").hide();
        $("#hourly_edit_area").fadeIn();
        $("#hourly_submit").show();
        $("#hourly_cancel").show();
    });
    
    $('#hourly_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#hourly_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
        swal({
            title: "Delete",
            text: "Confirm",
            icon: "warning",
            buttons: ["Cancel", "Ok"],
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'GET',
                    dataType: "json",
                    url: 'api/delete_contract_hourly.php?reccode='+data[5],
                    success: function(data) {
                        $('#hourly_table').DataTable().ajax.reload();
                        Result = data;
                        if(Result.Status == "Success") {
                            swal(Result.msg);
                        } else {
                            swal(Result.msg);
                        }
                    }
                });
            
            } 
        });
    });
    
    $("#hourly_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#hourly_data");
        var data = getFormData($form);
        $("#hourly_submit").prop("disabled",true);
        if($("#hourly_type").val() == 'insert')
            insert_hourly(data);
        if($("#hourly_type").val() == 'update')
            update_hourly(data);

        return false;
    });

    function insert_hourly(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_contract_hourly.php?contract_no='+$("#contract_no").val()+"&customer="+$("#customer").val(),
            data: data,
            success: function(data) {
                $("#hourly_submit").prop("disabled",false);
                $('#hourly_table').DataTable().ajax.reload();

                $("#hourly_add").show();
                $("#hourly_edit_area").fadeOut();
                $("#hourly_submit").hide();
                $("#hourly_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_hourly(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_contract_hourly.php?reccode='+$("#hourly_reccode").val(),
            data: data,
            success: function(data) {
                $("#hourly_submit").prop("disabled",false);
                $('#hourly_table').DataTable().ajax.reload();

                $("#hourly_add").show();
                $("#hourly_edit_area").hide();
                $("#hourly_submit").hide();
                $("#hourly_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#hourly_cancel").on('click',function(){
        $("#hourly_add").show();
        $("#hourly_edit_area").fadeOut();
        $("#hourly_submit").hide();
        $("#hourly_cancel").hide();
    })

    /********* Working ************/
    $("#working-nav").on('click',function(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;
        var table = $('#working_table').DataTable( {
            "ajax": "api/view_contract_working.php?contract_no="+$("#contract_no").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo" : false,
            "columnDefs": [ {
                "targets": -1,
                "data": null,
                "defaultContent": btn
            } ],
            "bDestroy": true
        } );

        if($("#form_type").val()!="")
            $("#working_add").show();
        $("#working_edit_area").fadeOut();
        $("#working_submit").hide();
        $("#working_cancel").hide();
    })

    $("#working_add").on('click',function(){
        $('form#working_data input:text').val('');
        $('form#working_data select').val('');
        $('form#working_data input:checkbox').prop('checked', false);

        $("#working_type").val('insert');
        $("#working_add").hide();
        $("#working_edit_area").fadeIn();
        $("#working_submit").show();
        $("#working_cancel").show();
    })

    $('#working_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#working_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

        $("#working_position").val(data[0]);
        $('#monday').prop('checked', torf(data[1]));
        $('#tuesday').prop('checked', torf(data[2]));
        $('#wednesday').prop('checked', torf(data[3]));
        $('#thursday').prop('checked', torf(data[4]));
        $('#friday').prop('checked', torf(data[5]));
        $('#saturday').prop('checked', torf(data[6]));
        $('#sunday').prop('checked', torf(data[7]));
        $("#working_reccode").val(data[8]);

        $("#working_type").val('update');
        $("#working_add").hide();
        $("#working_edit_area").fadeIn();
        $("#working_submit").show();
        $("#working_cancel").show();
    });
    
    $('#working_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#working_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
        swal({
            title: "Delete",
            text: "Confirm",
            icon: "warning",
            buttons: ["Cancel", "Ok"],
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'GET',
                    dataType: "json",
                    url: 'api/delete_contract_working.php?reccode='+data[8],
                    success: function(data) {
                        $('#working_table').DataTable().ajax.reload();
                        Result = data;
                        if(Result.Status == "Success") {
                            swal(Result.msg);
                        } else {
                            swal(Result.msg);
                        }
                    }
                });
            
            } 
        });
    });
    
    $("#working_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#working_data");
        var data = getFormData($form);
        $("#working_submit").prop("disabled",true);
        if($("#working_type").val() == 'insert')
            insert_working(data);
        if($("#working_type").val() == 'update')
            update_working(data);

        return false;
    });

    function insert_working(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_contract_working.php?contract_no='+$("#contract_no").val()+"&customer="+$("#customer").val(),
            data: data,
            success: function(data) {
                $("#working_submit").prop("disabled",false);
                $('#working_table').DataTable().ajax.reload();

                $("#working_add").show();
                $("#working_edit_area").fadeOut();
                $("#working_submit").hide();
                $("#working_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_working(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_contract_working.php?reccode='+$("#working_reccode").val(),
            data: data,
            success: function(data) {
                $("#working_submit").prop("disabled",false);
                $('#working_table').DataTable().ajax.reload();

                $("#working_add").show();
                $("#working_edit_area").fadeOut();
                $("#working_submit").hide();
                $("#working_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#working_cancel").on('click',function(){
        $("#working_add").show();
        $("#working_edit_area").fadeOut();
        $("#working_submit").hide();
        $("#working_cancel").hide();
    })

    function torf(val){
        if(val == 'Y')
            return true;
        else
            return false;
    }
</script>