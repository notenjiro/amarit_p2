<div class="modal-body"> 

    <form action="" method="POST" role="form" id="roleList_data">
        <div class="row d-flex flex-column">  
            <div class="col-12 d-flex" > 
                <div class="form-group d-flex align-items-center justify-content-between col-6">
                    <b>Role name</b>
                    <input required type="text" name="rolename" id="rolename" class="form-control lower col-10"  maxlength="20">
                </div>  
                <div class="form-group d-flex align-items-center justify-content-between col-6">
                    <b id="nameroleid">Role Id</b>
                    <input type="number" name="roleid" id="roleid" class="form-control lower col-10" readonly>
                    <div class="d-flex col-3 mb-3">
                        <input type="checkbox" id="0" class="form-check" name="role" value="Select All">
                        <span class="ml-2">Select All</span>
                    </div>
                </div> 
            </div>
            <div class="col-12 d-flex flex-column align-items-center">
                <b class="col-12 mb-3">Worksheet column</b>
                <div class="col-12 d-flex flex-wrap mb-5" id="divCheckbox">
                   
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">  

                <button style="width:100px" type="submit" id="bt-save" class="btn btn-success" data-bs-target="#" >
                    <i class="fa fa-save"></i> Save
                </button>

                <button style="width:100px" type="button" class="btn btn-danger"  data-bs-target="#" >
                    <i class="fa fa-minus"></i> Cancel
                </button>

            </div>
        </div>                  
    </form>

</div>

<input required type="hidden" name="form_type" id="form_type">

<script>
    checkbox();

    $("#roleList_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#roleList_data");
        var dataForm = getFormData($form);
        const allCheckbox = document.getElementsByName('role');
        const arrCheckbox = [];
        if(allCheckbox){
            allCheckbox.forEach(el=> { 
            if(el.checked && el.id != 0){
              arrCheckbox.push(Number(el.id));
            }
          });
        } 
        if(arrCheckbox.length == 0){
            alert('กรุณาเลือก Column ก่อนทำการบันทึกข้อมูล')
        }else{
            const data = {
               role: dataForm['rolename'],
               allColumn: arrCheckbox
            }

            $("#type_submit").prop("disabled",true);
            if($("#form_type").val() == 'insert'){
                 insert_data(data);
            }
            if($("#form_type").val() == 'update'){
                data['id'] = Number(dataForm['roleid']);
                update_data(data);
            } 
        }
        
        
    });


    $("#0").on('click',function(){      //select all check box
        const isChecked = $(this).prop("checked");
        $("input[name='role']").prop("checked", isChecked);
    })

    function checkbox(){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/view_columnworksheet.php',
            success: function(data) {
              if(data){
                const divCheckbox = document.getElementById('divCheckbox');
                data['data'].forEach( (element,index) => {
                    
                    // สร้าง div
                    const div = document.createElement('div');
                    div.className = 'd-flex col-3 mb-3';

                    // สร้าง input
                    const input = document.createElement('input');
                    input.type = 'checkbox';
                    input.id = element[0] ;
                    input.className = 'form-check';
                    input.name = 'role' ;
                    input.value = element[1];

                    // สร้าง span
                    const span = document.createElement('span');
                    span.className = 'ml-2';
                    span.textContent = element[1]; 

                    // เพิ่ม input และ span เข้าไปใน div
                    div.appendChild(input);
                    div.appendChild(span);
                    divCheckbox.appendChild(div);
                 });
              }
            }
        });
    }
    
    function insert_data(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_role.php',
            data: data,
            success: function(res) {
                $("#type_submit").prop("disabled",false);
                $('#type_table').DataTable().ajax.reload();
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
                        text: `Sorry, can't save data`,
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

    function update_data(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_role.php',
            data: data,
            success: function(res) {
                console.log(res)
                $("#type_submit").prop("disabled",false);
                $('#type_table').DataTable().ajax.reload();
                if(res.status == 1) {
                    
                    swal({
                        icon: "success",
                        text: res.msg,
                        timer: 2000,
                        buttons: false,
                        });
					$('#vieweditmodal').modal('hide'); 
                    setTimeout(() => {
                        location.reload();
                    }, 2100);
                    
                } else {
                    swal({
                        icon: "error",
                        text: `Sorry, can't update data`,
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

    $("#cancel").on('click',function(){
        if($("#form_type").val() == 'update')
            load_type($("#code").val())
        else
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
        $('form#roleList_data input:checkbox').prop('checked', false);
        $('form#roleList_data input:text').val('');
        $("#type_submit").prop("disabled",false);
    }
</script>