<!doctype html>
<html lang="en">
    <?php 
        require_once 'config_db.php';
        require_once './api/view_worksheet_column.php';
        require 'master.php'; 
        $MasterPage = 'master.php';


        $data = get_worksheet_column();
        $columns = "";
                    foreach ($data as $column) {
                        $columns=$columns.'{ title:"'.$column["name"].'", visible:'.($column["status"]==0?"false":"true").'},';
                        //echo '<script>console.log("'.$column["name"].'");</script>';
                    }
                    // echo $columns;
        // debug_get_worksheet_column();
    
        // $data = get_worksheet_column();
        //             foreach ($data as $column) {
        //                 echo '{ title:"'.$column["name"].'", visible:'.($column["status"]==0?"false":"true").'},<br>';
        //             }
    ?>   
        
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Front-end system</title>

    <style>
.modal-xl {
    max-width: 95% !important;
}
    div.dataTables_wrapper {
        /* width: 800px; */
        margin: 0 auto;
    }
.show,.form-check-input,#searchInput{
display: block!important;
}
.dropdown-menu {
      max-height: 300px;
      overflow-y: auto;
    }
    .tag {
      display: inline-block;
      padding: 0.4em 0.6em;
      margin: 0.2em;
      background-color: #6c757d;
      color: #fff;
      border-radius: 4px;
    }
    .tag .remove-tag {
      margin-left: 10px;
      cursor: pointer;
    }
    .form-control-tags {
      display: flex;
      flex-wrap: wrap;
      min-height: 38px;
      border: 1px solid #ced4da;
      padding: 5px;
      background-color: #fff;
      align-items: center;
      cursor: pointer;
      height: auto!important;
    }
    .form-control-tags input {
      border: none;
      outline: none;
      flex: 1;
    }
</style>
  </head>

  
  <body style="background-color:GhostWhite">

 
    <br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
				<form action="" method="POST">
				<label><?php 
				if($_SESSION["user_type"] == 'AA') {
					echo "Job";
				}else{
					echo "Worksheet";
				}
				?> Status</label>  
                <div class="row">
					<?php
							if(isset($_POST['from_date'])){
								$from_date = $_POST['from_date'];
                                $to_date = $_POST['to_date'];
                            }else{
                                $y = date('Y')+543;
                                $from_date =  '';
                                $to_date =  ''; 
                            }
                        ?>
					<div class="col-xs-6 col-sm-6 col-md-2">
                            <div class="form-group">
                                <label>From date</label>
                                <input type="date" name="from_date" id="from_date" value="<?php echo date('Y-m-d'); ?>" onchange="checkDate(this);" class="form-control date" aria-describedby="inputGroupPrepend2" required>
                            </div>   
                        </div> 
                        <div class="col-xs-6 col-sm-6 col-md-2">
                            <div class="form-group">
                                <label>to date</label>
                                <input type="date" name="to_date" id="to_date" value="<?php echo date('Y-m-d'); ?>" onchange="checkDate(this);" class="form-control date" aria-describedby="inputGroupPrepend2" required>
                            </div>   
                        </div> 
						<div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <br>
								<input type="hidden" id="submittype">
                                <button type="submit" id="submitbtn" class="invisible"> 
								<button type="submit" name="update_invoice" class="btn btn-success">
                                    <i class="fa fa-sync"></i>Update Invoice data
                                </button>
                                <button type="button" name="submit" id="showdata" class="btn btn-success">
                                    <i class="fa fa-search"></i> Show data
                                </button>
                                <button type="submit" name="excel" class="btn btn-success">
                                    <i class="fa fa-file-excel"></i>Export to excel
                                </button>
								
                            </div>   
                        </div>
					</div>
				</form> 
            </div>
        </div>

<?php
if(isset($_POST['from_date'])){
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
}else{
    $y = date('Y')+543;
    $from_date =  '';
    $to_date =  ''; 
}
?>
<input type="hidden" name="from_date" id="from_date" value="<?php echo date('Y-m-d'); ?>">
<input type="hidden" name="to_date" id="to_date" value="<?php echo date('Y-m-d'); ?>">

        <div class="card mt-2">
            <div class="card-body">
				    <label>Filter</label>  
                  
           


                    <div class="row pb-3">
                    <div class="col-auto" style="width:200px;">
                            <div class="form-check" style="padding-top:25px;">
                                <input class="form-check-input" style="display:block !important;" type="checkbox" value="0" oninput="cb_toggle(this)" id="filter_2">
                                <label class="form-check-label" style="width:300px;" for="filter_2">Service Date</label>
                            </div>
                        </div>
                        <div class="col">
                        From <input type="date" id="service_from" disabled onchange="ip_serviceDate(this);" class="form-control date" value="">
                        </div>
                        <div class="col">
                           To <input type="date" id="service_to" disabled onchange="ip_serviceDate(this);" class="form-control date" value="">
                        </div>
                    </div>
                    



                    <div class="row pb-3">
                    <div class="col-auto" style="width:200px;">
                            <div class="form-check">
                                <input class="form-check-input" style="display:block !important;" type="checkbox" value="0" oninput="cb_toggle(this)" id="filter_3">
                                <label class="form-check-label" style="width:300px;" for="filter_3">Line No Charge</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled oninput="rb_noCharge(1)" style="display:block !important;" type="radio" name="line_no_charge" id="line_no_charge1" value="1" checked>
                                <label class="form-check-label" for="line_no_charge1">Yes</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled oninput="rb_noCharge(2)" style="display:block !important;" type="radio" name="line_no_charge" id="line_no_charge2" value="2" >
                                <label class="form-check-label" for="line_no_charge2">No</label>
                            </div>
                        </div>
                    </div>

                    


                    <div class="row pb-3">
                        <div class="col-auto" style="width:200px;">
                            <div class="form-check" style="padding-top:5px;">
                                <input class="form-check-input" style="display:block !important;" type="checkbox" value="0" oninput="cb_toggle(this)" id="filter_4">
                                <label class="form-check-label" style="width:300px;" for="filter_4">Customer Name</label>
                            </div>
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" disabled id="customer_name" onkeyup="filter_data(this)" placeholder="">
                        </div>
                    </div>


                    <div class="row pb-3">
                        <div class="col-auto" style="width:200px;">
                            <div class="form-check" style="padding-top:10px;">
                                <input class="form-check-input" style="display:block !important;" type="checkbox" value="0" oninput="cb_toggle(this)" id="filter_5">
                                <label class="form-check-label" style="width:300px;" for="filter_5">Service Type</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                            <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_service(this);" value="TRANSPORT" type="checkbox" name="service_type" id="service_type1">
                                <label class="form-check-label" style="width:300px;" for="service_type1">TRANSPORT</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_service(this);" value="MANPOWER"  type="checkbox" name="service_type" id="service_type2" >
                                <label class="form-check-label" style="width:300px;" for="service_type2">MANPOWER</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_service(this);" value="CARGO HANDLE"  type="checkbox" name="service_type" id="service_type3">
                                <label class="form-check-label" style="width:300px;" for="service_type3">CARGO HANDLE</label>
                            </div>
                        </div>
                            </div>
                        <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_service(this);" value="SERVICE - OTHER"  type="checkbox" name="service_type" id="service_type4">
                                <label class="form-check-label" style="width:300px;" for="service_type4">SERVICE - OTHER</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_service(this);" value="IMMIGRATION"  type="checkbox" name="service_type" id="service_type5">
                                <label class="form-check-label" style="width:300px;" for="service_type5">IMMIGRATION</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_service(this);" value="PERSONNEL TRANSPORT"  type="checkbox" name="service_type" id="service_type6">
                                <label class="form-check-label" style="width:300px;" for="service_type6">PERSONNEL TRANSPORT</label>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_service(this);" value="WAREHOUSING"  type="checkbox" name="service_type" id="service_type7">
                                <label class="form-check-label" style="width:300px;" for="service_type7">WAREHOUSING</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_service(this);" value="UTILITIES"  type="checkbox" name="service_type" id="service_type8">
                                <label class="form-check-label" style="width:300px;" for="service_type8">UTILITIES</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_service(this);" value="RENTAL"  type="checkbox" name="service_type" id="service_type9">
                                <label class="form-check-label" style="width:300px;" for="service_type9">RENTAL</label>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_service(this);" value="HOTEL BOOKING"  type="checkbox" name="service_type" id="service_type10">
                                <label class="form-check-label" style="width:300px;" for="service_type10">HOTEL BOOKING</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_service(this);" value="TICKET BOOKING"  type="checkbox" name="service_type" id="service_type11">
                                <label class="form-check-label" style="width:300px;" for="service_type11">TICKET BOOKING</label>
                            </div>
                        </div>
                        <div class="col"></div>
                        </div>
                        </div>
                    </div>



                    <div class="row pb-3">
                        <div class="col-auto" style="width:200px;">
                            <div class="form-check">
                                <input class="form-check-input" style="display:block !important;" type="checkbox" value="0" oninput="cb_toggle(this)" id="filter_6">
                                <label class="form-check-label" style="width:300px;" for="filter_6">
                                    <?php 
                                        if($_SESSION["user_type"] == 'AA') {
                                            echo "Job";
                                        }else{
                                            echo "Worksheet";
                                        }
                                    ?>  Status</label>
                            </div>
                        </div>
                        <div class="col">
                        <div class="row">

                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_worksheetStatus(this);" value="Open"  type="checkbox" name="worksheet_status" id="worksheet_status3">
                                <label class="form-check-label" style="width:300px;" for="worksheet_status3">Open</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_worksheetStatus(this);" value="Closed"  type="checkbox" name="worksheet_status" id="worksheet_status5">
                                <label class="form-check-label" style="width:300px;" for="worksheet_status5">Closed</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_worksheetStatus(this);" value="Send to A/R"  type="checkbox" name="worksheet_status" id="worksheet_status6">
                                <label class="form-check-label" style="width:300px;" for="worksheet_status6">Send to A/R</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_worksheetStatus(this);" value="RCVD by A/R"  type="checkbox" name="worksheet_status" id="worksheet_status2">
                                <label class="form-check-label" style="width:300px;" for="worksheet_status2">RCVD by A/R</label>
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_worksheetStatus(this);" value="Reject by A/R"  type="checkbox" name="worksheet_status" id="worksheet_status7">
                                <label class="form-check-label" style="width:300px;" for="worksheet_status7">Reject by A/R</label>
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_worksheetStatus(this);" value="Cancelled"  type="checkbox" name="worksheet_status" id="worksheet_status4">
                                <label class="form-check-label" style="width:300px;" for="worksheet_status4">Cancelled</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" disabled style="display:block !important;" oninput="cb_worksheetStatus(this);" value="Send to NAV"  type="checkbox" name="worksheet_status" id="worksheet_status1">
                                <label class="form-check-label" style="width:300px;" for="worksheet_status1">Send to NAV</label>
                            </div>
                        </div>
                        
                        
                            </div>
                        </div>
                    </div>




                    <div class="row pb-3">
                        <div class="col-auto" style="width:200px;">
                            <div class="form-check" style="padding-top:5px;">
                                <input class="form-check-input" style="display:block !important;" type="checkbox" value="0" oninput="cb_toggle(this)" id="filter_7">
                                <label class="form-check-label" style="width:300px;" for="filter_7">WS/Job ID</label>
                            </div>
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" disabled id="ws_job_id" onkeyup="ws_job_id(this)" placeholder="">
                        </div>
                    </div>




                    <div class="row pb-3">
                        <div class="col-auto" style="width:200px;">
                            <div class="form-check" style="padding-top:5px;">
                                <input class="form-check-input" style="display:block !important;" type="checkbox" value="0" oninput="cb_toggle(this)" id="filter_8">
                                <label class="form-check-label" style="width:300px;" for="filter_8">Service Line ID</label>
                            </div>
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" disabled id="service_line_id" onkeyup="service_line_id(this)" placeholder="">
                        </div>
                    </div>




                    <div class="row pb-3">
                        <div class="col-auto" style="width:200px;">
                            <div class="form-check" style="padding-top:5px;">
                                <input class="form-check-input" style="display:block !important;" type="checkbox" value="0" oninput="cb_toggle(this)" id="filter_9">
                                <label class="form-check-label" style="width:300px;" for="filter_9">Vehicle ID</label>
                            </div>
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" disabled id="vehicle_id" onkeyup="vehicle_id(this)" placeholder="">
                        </div>
                    </div>




                    <div class="row pb-3">
                        <div class="col-auto" style="width:200px;">
                            <div class="form-check" style="padding-top:5px;">
                                <input class="form-check-input" style="display:block !important;" type="checkbox" value="0" oninput="cb_toggle(this)" id="filter_10">
                                <label class="form-check-label" style="width:300px;" for="filter_10">Vehicle Base Location</label>
                            </div>
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" disabled id="vehicle_base_location" onkeyup="vehicle_base_location(this)" placeholder="">
                        </div>
                    </div>





                    <div class="row pb-3">
                        <div class="col-auto" style="width:200px;">
                            <div class="form-check" style="padding-top:5px;">
                                <input class="form-check-input" style="display:block !important;" type="checkbox" value="0" oninput="cb_toggle(this)" id="filter_11">
                                <label class="form-check-label" style="width:300px;" for="filter_11">User ID</label>
                            </div>
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" disabled id="user_id" onkeyup="user_id(this)" placeholder="">
                        </div>
                    </div>


                    <div class="row pb-3">
                        <div class="col-auto" style="width:200px;">
                            <div class="form-check" style="padding-top:5px;">
                                <input class="form-check-input" style="display:block !important;" type="checkbox" value="0" oninput="cb_toggle(this)" id="filter_12">
                                <label class="form-check-label" style="width:300px;" for="filter_12">Branch</label>
                            </div>
                        </div>
                        <div class="col">

                        
                        <div class="dropdown">
    <div class="form-control form-control-tags" id="selectedTagsContainer">
      <input type="text" id="searchInput" placeholder="Search or select" autocomplete="off">
    </div>

    <div class="dropdown-menu p-3" id="dropdownList" style="width:auto;">
      <div class="d-flex justify-content-between mb-2">
        <button type="button" class="btn btn-sm btn-primary mx-1" id="selectAll">Select All</button>
        <button type="button" class="btn btn-sm btn-primary mx-1" id="unselectAll">Unselect All</button>
      </div>

      <div id="checkboxList">
        <div class="form-check">
          <input class="form-check-input dropdown-checkbox" type="checkbox" value="Antwerp" id="antwerp">
          <label class="form-check-label" for="antwerp">Antwerp</label>
        </div>
        <div class="form-check">
          <input class="form-check-input dropdown-checkbox" type="checkbox" value="Barcelona" id="barcelona">
          <label class="form-check-label" for="barcelona">Barcelona</label>
        </div>
        <div class="form-check">
          <input class="form-check-input dropdown-checkbox" type="checkbox" value="Birmingham" id="birmingham">
          <label class="form-check-label" for="birmingham">Birmingham</label>
        </div>
        <div class="form-check">
          <input class="form-check-input dropdown-checkbox" type="checkbox" value="Bradford" id="bradford">
          <label class="form-check-label" for="bradford">Bradford</label>
        </div>
        <div class="form-check">
          <input class="form-check-input dropdown-checkbox" type="checkbox" value="Düsseldorf" id="dusseldorf">
          <label class="form-check-label" for="dusseldorf">Düsseldorf</label>
        </div>
        <div class="form-check">
          <input class="form-check-input dropdown-checkbox" type="checkbox" value="Frankfurt" id="frankfurt">
          <label class="form-check-label" for="frankfurt">Frankfurt</label>
        </div>
        <div class="form-check">
          <input class="form-check-input dropdown-checkbox" type="checkbox" value="Sheffield" id="sheffield">
          <label class="form-check-label" for="sheffield">Sheffield</label>
        </div>
        <div class="form-check">
          <input class="form-check-input dropdown-checkbox" type="checkbox" value="Sofia" id="sofia">
          <label class="form-check-label" for="sofia">Sofia</label>
        </div>
      </div>
    </div>
  </div>

                        <!-- <input type="text" class="form-control" disabled id="branch_filter" onkeyup="filter_data(this)" placeholder=""> -->
                        </div>
                    </div>

                    <div class="row pb-3">
                        <div class="col-auto" style="width:200px;">
                            <div class="form-check" style="padding-top:5px;">
                                <input class="form-check-input" style="display:block !important;" type="checkbox" value="0" oninput="cb_toggle(this)" id="filter_13">
                                <label class="form-check-label" style="width:300px;" for="filter_13">Vendor Name</label>
                            </div>
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" disabled id="vendor_filter" onkeyup="filter_data(this)" placeholder="">
                        </div>
                    </div>


                    <div class="row pb-3">
                        <div class="col-auto" style="width:200px;">
                            <div class="form-check" style="padding-top:5px;">
                                <input class="form-check-input" style="display:block !important;" type="checkbox" value="0" oninput="cb_toggle(this)" id="filter_14">
                                <label class="form-check-label" style="width:300px;" for="filter_14">Position</label>
                            </div>
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" disabled id="position_filter" onkeyup="filter_data(this)" placeholder="">
                        </div>
                    </div>



                    <div class="row pb-3">
                        <div class="col-auto" style="width:200px;">
                            <div class="form-check" style="padding-top:5px;">
                                <input class="form-check-input" style="display:block !important;" type="checkbox" value="0" oninput="cb_toggle(this)" id="filter_15">
                                <label class="form-check-label" style="width:300px;" for="filter_15">Vehicle Type</label>
                            </div>
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" disabled id="vehicle_filter" onkeyup="filter_data(this)" placeholder="">
                        </div>
                    </div>



                    <script>
function checkDate(id){

if($(id).attr('id')=="from_date"){
    if($("#from_date").val()>$("#to_date").val()){
        // alert("กรุณาใส่วันที่ ที่น้อยกว่าหรือเท่ากับ To Date");
        $("#to_date").val($("#from_date").val())
    }
}

if($(id).attr('id')=="endDate = $('#service_to').val();"){
    if($("#from_date").val()>$("#to_date").val()){
        // alert("กรุณาใส่วันที่ ที่มากกว่าหรือเท่ากับ From Date");
        $("#from_date").val($("#to_date").val())
    }
}



}

function cb_worksheetStatus(id){
    var filterValues = $('input[name="worksheet_status"]:checked').map(function() {
        return $(this).val();
    }).get().join();

    var table = $('#worksheet_table').DataTable();
    console.log(filterValues.length)

    if(filterValues.length == 0){
        delete customSearches['worksheet_status'];
        applyCustomSearches();
    }else{
        console.log("AA")
    
        customSearches['worksheet_status'] = function(settings, data, dataIndex) {

            var searchColumn = data[4];
        
            if (filterValues.includes(searchColumn)) {
                return true;
            }
            return false;

        };

        applyCustomSearches();


    }
}

function cb_service(id){

    var filterValues = $('input[name="service_type"]:checked').map(function() {
        return $(this).val();
    }).get().join();

    var table = $('#worksheet_table').DataTable();
    console.log(filterValues.length)

    if(filterValues.length == 0){
        delete customSearches['transportFilter'];
        applyCustomSearches();
    }else{
        console.log("AA")
    
        customSearches['transportFilter'] = function(settings, data, dataIndex) {

            var searchColumn = data[8];
        
            if (filterValues.includes(searchColumn)) {
                return true;
            }
            return false;

        };

        applyCustomSearches();


    }
}


           
            var customSearches = {};


            function applyCustomSearches() {
                var table = $('#worksheet_table').DataTable();
        $.fn.dataTable.ext.search = [];
        for (let key in customSearches) {
            $.fn.dataTable.ext.search.push(customSearches[key]);
        }
        console.log(customSearches)
        table.draw();
    }

function addCustomSearch(name, searchFunction) {
    
        customSearches[name] = searchFunction;
        $.fn.dataTable.ext.search.push(searchFunction);
        table.draw();
    }


    function removeCustomSearch(name) {
        if (customSearches[name]) {
            // Find the index of the custom search
            $.fn.dataTable.ext.search = $.fn.dataTable.ext.search.filter(function(func) {
                return func !== customSearches[name]; // Remove the specific search function
            });
            delete customSearches[name]; // Remove from the customSearches object
            table.draw(); // Redraw the table
        }
    }


function ws_job_id(id){
    $('#worksheet_table').DataTable().column(6).search(id.value).draw();
}

function user_id(id){
    $('#worksheet_table').DataTable().column(0).search(id.value).draw();
}

function filter_data(id){
    $('#worksheet_table').DataTable().column(12).search(id.value).draw();
}

function rb_noCharge(val){
    $('#worksheet_table').DataTable().column(60).search((val==1?"Yes":(val==2?"No":""))).draw();
}

function service_line_id(id){
    // $('#worksheet_table').DataTable().column(0).search(id.value).draw();
}

function vehicle_id(id){

}

function vehicle_base_location(id){

}



function ip_serviceDate(id){
    var table = $('#worksheet_table').DataTable();

let i = 0;
console.log($(id).attr('id'))
if(($(id).attr('id')=="service_from")){

    let startDate = new Date($('#service_from').val());
    startDate.setUTCHours(0, 0, 0, 0);
    var table = $('#worksheet_table').DataTable();
        customSearches['service_from'] = function(settings, data, dataIndex) {

            var dateStr = data[51];
            var parts = dateStr.split('/');
            var formattedDateStr = parts[1] + '/' + parts[0] + '/' + parts[2];
            var dateObj = new Date(formattedDateStr);
            
            if (startDate.toISOString()<=dateObj.toISOString()) {
                console.log('true',startDate.toISOString(),dateObj.toISOString())
                return true;
            }
            else{
                console.log('false',startDate.toISOString(),dateObj.toISOString())
                return false;
            }
    }
    applyCustomSearches();
}


if(($(id).attr('id')=="service_to")){

let startDate = new Date($('#service_to').val());
startDate.setUTCHours(0, 0, 0, 0);
var table = $('#worksheet_table').DataTable();
    customSearches['service_to'] = function(settings, data, dataIndex) {

        var dateStr = data[53];
        var parts = dateStr.split('/');
        var formattedDateStr = parts[1] + '/' + parts[0] + '/' + parts[2];
        var dateObj = new Date(formattedDateStr);
        
        if (startDate.toISOString()>=dateObj.toISOString()) {
            console.log('true',startDate.toISOString(),dateObj.toISOString())
            return true;
        }
        else{
            console.log('false',startDate.toISOString(),dateObj.toISOString())
            return false;
        }
}
applyCustomSearches();
}

  
      
}


                        function cb_toggle(id){
                        
                            $(id).val((id.value==0?1:0))

                            let ele = $(id).attr('id');
                            let val = id.value

                            if(ele=="filter_2"&&val==0){
                                $("#service_from").attr('disabled', 'disabled');
                                $("#service_to").attr('disabled', 'disabled');
                                $('#service_from').val('');
                                $('#service_to').val('');
                                delete customSearches['service_from'];
                                delete customSearches['service_to'];
                                applyCustomSearches();
                            }
                            else if(ele=="filter_2"&&val==1){
                                $("#service_from").removeAttr("disabled");
                                $("#service_to").removeAttr("disabled");

                                $("#service_from").attr('min', $('#from_date').val()).attr('max', $('#to_date').val());
                                $("#service_to").attr('min', $('#from_date').val()).attr('max', $('#to_date').val());
     

                            }
                            else if(ele=="filter_3"&&val==0){
                                
                                rb_noCharge(0)

                                $("#line_no_charge1").attr('disabled', 'disabled');
                                $("#line_no_charge2").attr('disabled', 'disabled');
                            }
                            else if(ele=="filter_3"&&val==1){

                                rb_noCharge($("#line_no_charge1").val())

                                $("#line_no_charge1").removeAttr("disabled");
                                $("#line_no_charge2").removeAttr("disabled");
                            }

                            else if(ele=="filter_4"&&val==0){
                                $("#customer_name").attr('disabled', 'disabled');
                                $('#customer_name').val('');
                                $('#worksheet_table').DataTable().column(12).search("").draw();
                            }
                            else if(ele=="filter_4"&&val==1){
                                $("#customer_name").removeAttr("disabled");
                            }
                            

                            else if(ele=="filter_5"&&val==0){
                                $('input[name="service_type"]').attr('disabled', 'disabled');
                                $('input[name="service_type"]').prop('checked', false); 
                                // $("#service_type1").attr('disabled', 'disabled');
                                // $("#service_type2").attr('disabled', 'disabled');
                                // $("#service_type3").attr('disabled', 'disabled');
                                // $("#service_type4").attr('disabled', 'disabled');
                                // $("#service_type5").attr('disabled', 'disabled');
                                // $("#service_type6").attr('disabled', 'disabled');
                                // $("#service_type1").prop('checked', false); 
                                // $("#service_type2").prop('checked', false); 
                                // $("#service_type3").prop('checked', false); 
                                // $("#service_type4").prop('checked', false); 
                                // $("#service_type5").prop('checked', false); 
                                // $("#service_type6").prop('checked', false); 
                                delete customSearches['transportFilter'];
                                applyCustomSearches();
                            }
                            else if(ele=="filter_5"&&val==1){
                                $('input[name="service_type"]').removeAttr("disabled");
                                // $("#service_type1").removeAttr("disabled");
                                // $("#service_type2").removeAttr("disabled");
                                // $("#service_type3").removeAttr("disabled");
                                // $("#service_type4").removeAttr("disabled");
                                // $("#service_type5").removeAttr("disabled");
                                // $("#service_type6").removeAttr("disabled");
                            }


                            else if(ele=="filter_6"&&val==0){
                                $('input[name="worksheet_status"]').attr('disabled', 'disabled');
                                $('input[name="worksheet_status"]').prop('checked', false); 
                                // $("#worksheet_status1").attr('disabled', 'disabled');
                                // $("#worksheet_status2").attr('disabled', 'disabled');
                                // $("#worksheet_status3").attr('disabled', 'disabled');
                                // $("#worksheet_status4").attr('disabled', 'disabled');
                                // $("#worksheet_status1").prop('checked', false); 
                                // $("#worksheet_status2").prop('checked', false); 
                                // $("#worksheet_status3").prop('checked', false); 
                                // $("#worksheet_status4").prop('checked', false); 
                         
                          
                                delete customSearches['worksheet_status'];
                                applyCustomSearches();
                            }
                            else if(ele=="filter_6"&&val==1){
                                $('input[name="worksheet_status"]').removeAttr("disabled");
                                // $("#worksheet_status1").removeAttr("disabled");
                                // $("#worksheet_status2").removeAttr("disabled");
                                // $("#worksheet_status3").removeAttr("disabled");
                                // $("#worksheet_status4").removeAttr("disabled");
                            }


                            else if(ele=="filter_7"&&val==0){
                                $("#ws_job_id").attr('disabled', 'disabled');
                                $('#ws_job_id').val('');
                                $('#worksheet_table').DataTable().column(6).search("").draw();
                            }
                            else if(ele=="filter_7"&&val==1){
                                $("#ws_job_id").removeAttr("disabled");
                            }

                            
                            else if(ele=="filter_8"&&val==0){
                                $("#service_line_id").attr('disabled', 'disabled');
                                
                                $('#service_line_id').val('');
                                // $('#worksheet_table').DataTable().column(X).search("").draw();
                                
                            }
                            else if(ele=="filter_8"&&val==1){
                                $("#service_line_id").removeAttr("disabled");
                            }

                            
                            else if(ele=="filter_9"&&val==0){
                                $("#vehicle_id").attr('disabled', 'disabled');

                                $('#vehicle_id').val('');
                                // $('#worksheet_table').DataTable().column(X).search("").draw();
                            }
                            else if(ele=="filter_9"&&val==1){
                                $("#vehicle_id").removeAttr("disabled");
                            }

                            
                            else if(ele=="filter_10"&&val==0){
                                $("#vehicle_base_location").attr('disabled', 'disabled');

                                $('#vehicle_base_location').val('');
                                // $('#worksheet_table').DataTable().column(X).search("").draw();
                            }
                            else if(ele=="filter_10"&&val==1){
                                $("#vehicle_base_location").removeAttr("disabled");
                            }

                            
                            else if(ele=="filter_11"&&val==0){
                                $("#user_id").attr('disabled', 'disabled');
                                $('#user_id').val('');
                                $('#worksheet_table').DataTable().column(0).search("").draw();
                            }
                            else if(ele=="filter_11"&&val==1){
                                $("#user_id").removeAttr("disabled");
                            }

                            else if(ele=="filter_12"&&val==0){
                                $("#branch_filter").attr('disabled', 'disabled');
                                $('#branch_filter').val('');
                                $('#worksheet_table').DataTable().column(1).search("").draw();
                            }
                            else if(ele=="filter_12"&&val==1){
                                $("#branch_filter").removeAttr("disabled");
                            }

                            else if(ele=="filter_13"&&val==0){
                                $("#vendor_filter").attr('disabled', 'disabled');
                                $('#vendor_filter').val('');
                                $('#worksheet_table').DataTable().column(30).search("").draw();
                            }
                            else if(ele=="filter_13"&&val==1){
                                $("#vendor_filter").removeAttr("disabled");
                            }

                            else if(ele=="filter_14"&&val==0){
                                $("#position_filter").attr('disabled', 'disabled');
                                $('#position_filter').val('');
                                $('#worksheet_table').DataTable().column(32).search("").draw();
                            }
                            else if(ele=="filter_14"&&val==1){
                                $("#position_filter").removeAttr("disabled");
                            }

                            else if(ele=="filter_15"&&val==0){
                                $("#vehicle_filter").attr('disabled', 'disabled');
                                $('#vehicle_filter').val('');
                                $('#worksheet_table').DataTable().column(27).search("").draw();
                            }
                            else if(ele=="filter_15"&&val==1){
                                $("#vehicle_filter").removeAttr("disabled");
                            }
                            
                        }

                    
                    </script>


				</form> 
            </div>
        </div>




        <div class="card mt-2">
            <div class="card-body">  
                <table id="worksheet_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>
                </div>                    
        </div>
    </div> 

	<?php
    if(isset($_POST['excel'])){ 
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
		$showprice = $_SESSION['show_price'];
        echo '<script type="text/javascript">
				location.replace("4.1_excel.php?from_date='.$from_date.'&to_date='.$to_date.'&show_amount='.$showprice.'");
			  </script>';             
    }
	if(isset($_POST['update_invoice'])){ 
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
		$showprice = $_SESSION['show_price'];
        echo '<script type="text/javascript">
				window.open("4.1_excel_update.php?from_date='.$from_date.'&to_date='.$to_date.'");
			  </script>';             
    }
    ?> 



    <script>
 
         $(document).ready(function(){
            
			$("#showdata").on('click',function(){
				showDatax();
			});

			$("#excel").on('click',function(){
				$("#submittype").val("excel");
				$("#submitbtn").trigger("click");      
			});

			$("#update_invoice").on('click',function(){
				$("#submittype").val("excel");
				$("#submitbtn").trigger("click");      
			});			

			var table = $('#worksheet_table').DataTable( {
                "ajax": "api/view_worksheet_status.php?from_date="+$("#from_date").val()+"&to_date="+$("#to_date").val()+"&show_amount=<?php echo $_SESSION["show_price"];?>",
				"pageLength": 100,
                "processing": true,
                "scrollX": true,

                "bDestroy": true,
                "columns": [
                    <?php
                    echo $columns;
                    ?>
                ]
            } );

            $('#worksheet_print').on('click',function(){
                if($('#worksheet_id').val() != ''){
                    var url = "print/3.1_print.php?worksheet_id="+$('#worksheet_id').val();
                    window.open(url, '_blank').focus();
                }else{
                    swal("Please select worksheet");
                }
            });

			$('#worksheet_email').on('click',function(){
                if($('#worksheet_id').val() != ''){
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: 'api/send_email.php?worksheet_id='+$('#worksheet_id').val(),
                        success: function(data) {
                            if(data.Status == "Success") {
                                swal(data.msg);
                            } else {
                                swal(data.msg);
                            }
                        }
                    });
                }else{
                    swal("Please select worksheet");
                }
            });


            $('#worksheet_table tbody').on( 'change', '.chkbox', function () {
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                var id = data[1];
                var val = this.checked;
                $(':checkbox').each(function() {
                    this.checked = false;
                });

                this.checked = val;
                if(val === false){
                    $('#worksheet_id').val('');
                }else{
                    $('#worksheet_id').val(id);
                }
            });

            $('#worksheet_add').on('click',function(){
                clear_data();
                $('#form_type').val('insert'); 
                $('#worksheet_id').attr('readonly', false);
                $('#vieweditmodal').modal('show'); 
                $("#sub_data").hide();
                $(".send").hide();
                $(".rcvd").hide();
				$(".close_st").hide();
				$(".cancel").hide();
                get_number();
            });

            $('#worksheet_table tbody').on( 'click', 'button.deletebtn', function () {
                var table = $('#worksheet_table').DataTable();
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
                            url: 'api/delete_worksheet.php?worksheet_id='+data[1],
                            success: function(data) {
                                $('#worksheet_table').DataTable().ajax.reload();
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

             $('#worksheet_table tbody').on( 'click', 'button.editbtn', function () {
                var table = $('#worksheet_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_worksheet(data[1]);
                $('#form_type').val('update'); 
                $('#vieweditmodal').modal('show'); 
            });

            $('#worksheet_table tbody').on( 'click', 'button.infobtn', function () {
                var table = $('#worksheet_table').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                load_worksheet(data[1]);
                $('#form_type').val(''); 
                $('#vieweditmodal').modal('show'); 

                $('#vieweditmodal :input').attr('readonly', 'readonly');
                // $('#vieweditmodal :select').attr('readonly', 'readonly');
                $('#vieweditmodal :button').hide();
            });
        });

		function showDatax(){
            console.log("api/view_worksheet_status.php?from_date="+$("#from_date").val()+"&to_date="+$("#to_date").val()+"&show_amount=<?php echo $_SESSION["show_price"];?>")
            var table = $('#worksheet_table').DataTable( {
				"ajax": "api/view_worksheet_status.php?from_date="+$("#from_date").val()+"&to_date="+$("#to_date").val()+"&show_amount=<?php echo $_SESSION["show_price"];?>",
				"pageLength": 100,
                "processing": true,
                "scrollX": true,
                "bDestroy": true,
             "columns": [
                    <?php
                    echo $columns;
                    ?>
                ]
            } );
		}

		function showData(){

		var table = $('#worksheet_tablex').DataTable( {
                "ajax": "api/view_worksheet.php?user_role=<?php echo $_SESSION["user_role"];?>&user_name=<?php echo $_SESSION["user_name"];?>",
				"pageLength": 100,
                "processing": true,
                "scrollX": true,
                "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": btn_table
                },{
                    "targets": 0,
                    "data": null,
                    "defaultContent": "<input type=\"checkbox\" class=\"form-check chkbox\">"
                } ],
                "bDestroy": true
            } );
		}
    </script>
    







    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
  $(document).ready(function() {
    // Dropdown toggle on search input click
    $('#selectedTagsContainer').on('click', function() {
      $('#dropdownList').toggle();
    });

    // Close dropdown if clicking outside
    $(document).on('click', function(e) {
      if (!$(e.target).closest('.dropdown').length) {
        $('#dropdownList').hide();
      }
    });

    // Update selected tags and handle checkbox changes
    function updateSelectedTags() {
      let selectedValues = [];
      $('#checkboxList input[type="checkbox"]:checked').each(function() {
        selectedValues.push($(this).val());
      });

      // Display tags for selected items
      $('#selectedTagsContainer').empty();
      selectedValues.forEach(function(value) {
        $('#selectedTagsContainer').append(
          `<span class="tag">${value} <span class="remove-tag" data-value="${value}">&times;</span></span>`
        );
      });

      // Re-add the search input box
      $('#selectedTagsContainer').append('<input type="text" id="searchInput" placeholder="Search or select" autocomplete="off">');
    }

    // Add event listener for checkbox changes
    $('#checkboxList input[type="checkbox"]').on('change', function() {
      updateSelectedTags();
    });

    // Remove tag and uncheck the associated checkbox
    $(document).on('click', '.remove-tag', function() {
      const value = $(this).data('value');
      $(`#checkboxList input[value="${value}"]`).prop('checked', false);
      updateSelectedTags();
    });

    // Filter the checkbox list based on search input
    $(document).on('keyup', '#searchInput', function() {
      var value = $(this).val().toLowerCase();
      $('#checkboxList .form-check').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });

    // Select All functionality scoped to dropdown checkboxes only
    $('#selectAll').on('click', function() {
      $('#checkboxList input[type="checkbox"]').prop('checked', true);
      updateSelectedTags();
    });

    // Unselect All functionality scoped to dropdown checkboxes only
    $('#unselectAll').on('click', function() {
      $('#checkboxList input[type="checkbox"]').prop('checked', false);
      updateSelectedTags();
    });
  });
</script>

  </body>
</html>