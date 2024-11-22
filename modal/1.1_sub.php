<div class="modal-body"> 
    <div id="edit_area">
        <form id="contact_data">
            <div class="row">  
                <div class="col-4">   
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="contact_name" id="contact_name" class="form-control">
                    </div>
                </div>
                <div class="col-4">   
                    <div class="form-group">
                        <label>Tel.</label>
                        <input type="text" name="tel" id="tel" class="form-control">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>E-Mail Address</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-12">  
            <button style="width:100px" type="button" class="btn btn-success" id="contact_add" data-bs-target="#" >
                <i class="fas fa-plus-square"></i> Add
            </button>
            <button style="width:100px" type="button" class="btn btn-success" id="contact_insert" data-bs-target="#" >
                <i class="fas fa-save"></i> Save
            </button>
            <button style="width:100px" type="button" class="btn btn-danger"  id="contact_cancel" data-bs-target="#" >
                <i class="fas fa-minus-square"></i> Cancel
            </button>
            <input type="hidden" id="contact_id">
        </div>
    </div>                  
    <div class="row">  
    </div>
    <div>
        <div class="card-body">            
            <table id="contact_table" class="table table-striped display nowrap" style="width: 100%;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="width: 20%;">Name</th>
                        <th scope="col" style="width: 20%;">Tel.</th>
                        <th scope="col" style="width: 20%;">E-Mail Address</th>
                        <th scope="col" style="width: 20%;"></th>
                    </tr>
                </thead>                       
                <tbody>  
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function load_contact(){
        
        var table = $('#contact_table').DataTable( {
            "ajax": "api/view_contact.php?id="+$("#customer_id").val(),
            "columnDefs": [ {
                "targets": -1,
                "data": null,
                "defaultContent": "<button style=\"width:100px\" type=\"button\" class=\"btn btn-warning editbtn\"><i class=\"fas fa-edit\"></i> Edit</button> <button style=\"width:100px\" type=\"button\" class=\"btn btn-danger deletebtn\"><i class=\"fas fa-trash-alt\"></i> Delete</button>"
            } ],
            "bDestroy": true
        } );

        clear_data_sub();
    }

    $(document).ready(function(){
        $('#contact_table tbody').on( 'click', 'button.editbtn', function () {
            var table = $('#contact_table').DataTable();
            var data = table.row( $(this).parents('tr') ).data();
            $("#edit_area").show();
            $("#contact_update").show();
            $("#contact_cancel").show();
            $("#contact_add").hide();
            $("#contact_insert").hide();

            $("#contact_update").prop("disabled",false);

            $("#contact_name").val(data[0]);
            $("#tel").val(data[1]);
            $("#email").val(data[2]);

            $("#contact_id").val(data[3]);
        });

        $('#contact_table tbody').on( 'click', 'button.deletebtn', function () {
            var table = $('#contact_table').DataTable();
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
                        url: 'api/delete_contact.php?id='+$("#check_id").val()+'&contact_id='+data[3],
                        success: function(data) {
                            $('#contact_table').DataTable().ajax.reload();
                            Result = data;
                            if(Result.Status == "Success") {
                                swal(Result.msg);
                                
                                clear_data();
                                
                            } else {
                                swal(Result.msg);
                            }
                        }
                    });
                  
                } 
            });

        });



        $('#contact_add').on('click',function(){
            clear_data_sub();
            $("#edit_area").show();
            $("#contact_insert").show();
            $("#contact_cancel").show();
            $("#contact_add").hide();
            $("#contact_insert").prop("disabled",false);
        });


        $('#contact_cancel').on('click',function(){
            clear_data_sub();
        });

        $("#contact_insert").on('click',function(){
            $("#contact_insert").prop("disabled",true);
            var $form = $("#contact_data");
            var data = getFormData($form);
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: 'api/insert_contact.php?id='+$("#customer_id").val(),
                data: data,
                success: function(data) {
                    $("#contact_insert").prop("disabled",false);
                    $('#contact_table').DataTable().ajax.reload();
                    Result = data;
                    if(Result.Status == "Success") {
                        swal(Result.msg);
						$('#vieweditmodal').modal('hide'); 
                        clear_data_sub();
                    } else {
                        swal(Result.msg);
                    }
                }
            });
        });

        $("#contact_update").on('click',function(){
            $("#contact_update").prop("disabled",true);
            var $form = $("#contact_data");
            var data = getFormData($form);
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: 'api/update_contact.php?id='+$("#check_id").val()+'&contact_id='+$("#contact_id").val(),
                data: data,
                success: function(data) {
                    $("#contact_update").prop("disabled",false);
                    $('#contact_table').DataTable().ajax.reload();
                    Result = data;
                    if(Result.Status == "Success") {
                        swal(Result.msg);
						$('#vieweditmodal').modal('hide'); 
                        clear_data_sub();
                    } else {
                        swal(Result.msg);
                    }
                }
            });
        });
    });

    function clear_data_sub(){
        $("#contact_name").val('');
        $("#tel").val('');
        $("#email").val('');

        $("#edit_area").hide();
        $("#contact_insert").hide();
        $("#contact_update").hide();
        $("#contact_cancel").hide();
        $("#contact_add").show();
    }
</script>