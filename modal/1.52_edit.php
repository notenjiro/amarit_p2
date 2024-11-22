<div class="modal-body"> 

    <form action="" method="POST" role="form" id="roleList_data">
        <div class="row d-flex flex-column">  
            <div class="col-12 d-flex" > 
                <div class="form-group d-flex align-items-center justify-content-between col-6">
                    <b>Code</b>
                    <input required type="text" name="code" id="code" class="form-control col-10">
                </div>  
                <div class="form-group d-flex align-items-center justify-content-between col-6">
                    <b>Description</b>
                    <input required type="text" name="description" id="description" class="form-control col-10">
                </div> 
            </div>
           
        </div>

        <div class="row">
            <div class="col-12">  

                <button style="width:100px" type="submit" id="bt-save" class="btn btn-success" data-bs-target="#" >
                    <i class="fa fa-save"></i> Save
                </button>

                <button style="width:100px" type="button" id="btn-cancel" class="btn btn-danger"  data-bs-target="#" >
                    <i class="fa fa-minus"></i> Cancel
                </button>

            </div>
        </div>                  
    </form>

</div>

<input required type="hidden" name="form_type" id="form_type">

<script>
   

   $("#roleList_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#roleList_data");
        var dataForm = getFormData($form);
     
            const data = {
                code: dataForm['code'],
               description: dataForm['description'],
            }

            $("#type_submit").prop("disabled",true);
            if($("#form_type").val() == 'insert'){
                 insert_data(data);
            }
         
        
        
    });
    
    function insert_data(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_poepod.php',
            data: data,
            success: function(res) {
                $("#type_submit").prop("disabled",false);
                $('#type_table').DataTable().ajax.reload();
                console.log(res)
                if(res.status == 1) {
                    swal({
                        icon: "success",
                        text: res.msg,
                        timer: 2000,
                        buttons: false,
                        });
			    $('#vieweditmodal').modal('hide'); 
                clear_data();
                setTimeout(() => {
                        location.reload();
                    }, 2100);
                }
                else {
                    swal({
                        icon: "error",
                        text: res.msg,
                        timer: 3000,
                        buttons: false,
                        });
                        setTimeout(() => {
                        location.reload();
                    }, 3100);
                }
            }
        });
    }

   

    $("#btn-cancel").on('click',function(){
        clear_data();
		$('#vieweditmodal').modal('hide');
    })
    
    function load_type(id){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/get_role.php?id='+id,
            success: function(res) {
                if(res.data){
                    $('#roleid').val(id);
                    $('#rolename').val(res.data.role);
                    if(res.data.column.length > 0){
                        res.data.column.forEach(el =>{  
                        $('#' + el.id).prop('checked', true);
                        })
                    }
                    $("#type_submit").prop("disabled",false);   
                }
            }
        });
        
    }

    function clear_data(){
        $('form#code input:text').val('');
        $('form#description input:text').val('');
        $("#type_submit").prop("disabled",false);
    }
</script>