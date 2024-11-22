<!doctype html>
<html lang="en">
    <?php 
        require_once 'config_db.php';
        require 'master.php'; 
        $MasterPage = 'master.php';

    if(isset($_GET["type"])){
        $columns=array();

       
    
        
        if($_GET["type"]=="branch"){
            $barcode_title = "Barcode Branch";
            $api = "./api/view_barcode.php?type=branch";
            $columns[] = array("title"=>"code_branch");
            $columns[] = array("title"=>"branch_name");
        }
        if($_GET["type"]=="group"){
            $barcode_title = "Barcode Group";
            $api = "./api/view_barcode.php?type=group";
            $columns[] = array("title"=>"no_group");
            $columns[] = array("title"=>"group_name");
             $columns[] = array("title"=>"WH");
            $columns[] = array("title"=>"UT");
            $columns[] = array("title"=>"RN");
            $columns[] = array("title"=>"CH");
            $columns[] = array("title"=>"TP");
            $columns[] = array("title"=>"TS");
            $columns[] = array("title"=>"LS");
            $columns[] = array("title"=>"PT");
            $columns[] = array("title"=>"BS");
            $columns[] = array("title"=>"IM");
            $columns[] = array("title"=>"SH");
            $columns[] = array("title"=>"AG");
            $columns[] = array("title"=>"PV");
            $columns[] = array("title"=>"SO");
        }
        if($_GET["type"]=="location"){
            $barcode_title = "Barcode Location";
            $api = "./api/view_barcode.php?type=location";
            $columns[] = array("title"=>"no_location");
            $columns[] = array("title"=>"location_name");
            $columns[] = array("title"=>"WH");
            $columns[] = array("title"=>"UT");
            $columns[] = array("title"=>"RN");
            $columns[] = array("title"=>"CH");
            $columns[] = array("title"=>"TP");
            $columns[] = array("title"=>"TS");
            $columns[] = array("title"=>"LS");
            $columns[] = array("title"=>"PT");
            $columns[] = array("title"=>"BS");
            $columns[] = array("title"=>"IM");
            $columns[] = array("title"=>"SH");
            $columns[] = array("title"=>"AG");
            $columns[] = array("title"=>"PV");
            $columns[] = array("title"=>"SO");
        }
        if($_GET["type"]=="product_type"){
            $barcode_title = "Barcode Product Type";
            $api = "./api/view_barcode.php?type=product_type";
            $columns[] = array("title"=>"product_type");
            $columns[] = array("title"=>"product_type_name");
            $columns[] = array("title"=>"WH");
            $columns[] = array("title"=>"UT");
            $columns[] = array("title"=>"RN");
            $columns[] = array("title"=>"CH");
            $columns[] = array("title"=>"TP");
            $columns[] = array("title"=>"TS");
            $columns[] = array("title"=>"LS");
            $columns[] = array("title"=>"PT");
            $columns[] = array("title"=>"BS");
            $columns[] = array("title"=>"IM");
            $columns[] = array("title"=>"SH");
            $columns[] = array("title"=>"AG");
            $columns[] = array("title"=>"PV");
            $columns[] = array("title"=>"SO");
        }
        if($_GET["type"]=="service"){
            $barcode_title = "Barcode Service";
            $api = "./api/view_barcode.php?type=service";
            $columns[] = array("title"=>"<input type='checkbox' class='d-block'>");
            $columns[] = array("title"=>"no_service");
            $columns[] = array("title"=>"type_service_name");
            $columns[] = array("title"=>"group");
        }

        if(
            $_GET["type"]=="sub_type1"
         || $_GET["type"]=="sub_type2"
         || $_GET["type"]=="sub_type3"
         || $_GET["type"]=="sub_type4"
         || $_GET["type"]=="sub_type5"
         || $_GET["type"]=="sub_type6"
     ){
        $type = substr($_GET["type"], -1, 1);
            $barcode_title = "Barcode Sub Type ".$type;
            $api = "./api/view_barcode.php?type=". $_GET["type"];
            $columns[] = array("title"=>"no_sub_type".$type);
            $columns[] = array("title"=>"sub_type".$type);
            $columns[] = array("title"=>"WH");
            $columns[] = array("title"=>"UT");
            $columns[] = array("title"=>"RN");
            $columns[] = array("title"=>"CH");
            $columns[] = array("title"=>"TP");
            $columns[] = array("title"=>"TS");
            $columns[] = array("title"=>"LS");
            $columns[] = array("title"=>"PT");
            $columns[] = array("title"=>"BS");
            $columns[] = array("title"=>"IM");
            $columns[] = array("title"=>"SH");
            $columns[] = array("title"=>"AG");
            $columns[] = array("title"=>"PV");
            $columns[] = array("title"=>"SO");

            // $type = explode('_',$_GET["type"]);
            // $type = $type[1];
        }
    }
    


    ?>   
        
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Front-end system</title>
  </head>
  <body style="background-color:GhostWhite">

 
  <!-- serve view -->
  <div class="modal fade" id="vieweditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sub Type <?php echo $type; ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <?php include "modal/1.50_edit.php"?>
            </div>
        </div>
    </div>

    <br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    <div class="ml-3">  
						<?php echo $barcode_title; ?>
                        <button style="width:100px" type="button" class="btn btn-success" id="add_custom" data-bs-target="#" >
                            <i class="fa fa-plus"></i>&nbsp; Add
                        </button>
                    </div>
                    <div class="ml-3">  
						More Information &nbsp;
                        <button  type="button" class="btn btn-success"  data-bs-target="#" >
                        <i class="fa fa-address-book"></i>&nbsp; Contact List
                        </button>
                        <button style="width:100px" type="button" class="btn btn-success" id="button_import" >
                        <i class="fa fa-sign-in"></i>&nbsp; Import
                        </button>
                        <button style="width:100px" type="button" class="btn btn-success" id="button_export" >
                        <i class="fa fa-sign-out"></i>&nbsp; Export
                        </button>

                        <script src="./module_import_export.js"></script>
                        <script>init('type<?php echo $type; ?>');</script>
                        
                    </div>
                </div>  
            </div>
        </div>

        <div class="card">
            <div class="card-body">   
                <div class="row">  
                    <div class="col-12">        
                        
                    </div>
                </div>
 
                <div class="card-body">  
                    <table id="barcode_table" class="table table-striped" style="width: 100%;">
                        <thead>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>
                </div>
                    
            </div>
        </div>

    </div> 

    
    <script>
         function load_data(){
                var table = $('#barcode_table').DataTable( {
                "ajax": "<?php echo $api; ?>",
                "bDestroy": true,
                "columns": <?php echo json_encode($columns); ?>
                
            } );
            }
        $(document).ready(function(){
            load_data()
           
            $('#set_type_id').val(<?php echo $type; ?>);
            
            $('#form_type').val('insert'); 
            $('#add_custom').on('click',function(){
                clear_data();
                $('#form_type').val('insert'); 
                $('#code').attr('readonly', false);
                $('#vieweditmodal').modal('show'); 
            });

            $('#type<?php echo $type; ?>_table tbody').on( 'click', 'button.deletebtn', function () {
                var table = $('#type<?php echo $type; ?>_table').DataTable();
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
                            url: 'api/delete_type<?php echo $type; ?>.php?code='+data[0],
                            success: function(data) {
                                $('#type<?php echo $type; ?>_table').DataTable().ajax.reload();
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

             $('#type<?php echo $type; ?>_table tbody').on( 'click', 'button.editbtn', function () {
                var table = $('#type<?php echo $type; ?>_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_type(data[0]);
                $('#form_type').val('update'); 
                $('#vieweditmodal').modal('show'); 
            });

            $('#type<?php echo $type; ?>_table tbody').on( 'click', 'button.infobtn', function () {
                var table = $('#type<?php echo $type; ?>_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_type(data[0]);
                $('#form_type').val(''); 
                $('#vieweditmodal').modal('show'); 

                $('#type_data input').attr('readonly', 'readonly');
                $('#type_data select').attr('readonly', 'readonly');
                $('#type_data input:checkbox').prop("disabled",true);
                $('#type_data button').hide();
            });



            $('#barcode_table tbody').on( 'click', 'input.cb-custom', function () {
            //  console.log($(this).attr("id"))
             let data_val = $(this).val();
             data_val=(data_val==0?1:0)
             let data = $(this).attr("id").split('-')
             data = data[1].split('_')
          
            
             $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_type.php',
            data: {type_id:data[0],type_no:data[1],type_col:data[2],type_val:data_val},
            success: function(data) {
                console.log(data)
            }
            });


            });
        });
    </script>
    
  </body>
</html>
<?php sqlsrv_close($conn); ?>