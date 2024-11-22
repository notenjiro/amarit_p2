<style>
    .w-5 {
        width: 100px !important
    }
</style>
<div class="modal-body">
    <form id="worksheet_data">
        <div id="edit_area">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <span>Subject</span><span style="color:red"> *</span>
                        <select name="subject" id="subject" class="form-control" aria-describedby="inputGroupPrepend2"
                            required>
                            <option value=""></option>
                            <?php
                            $fQuery = "SELECT * FROM subject";
                            $result = sqlsrv_query($conn, $fQuery);
                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                <option value="<?php echo $row['code']; ?>"><?php echo $row['description']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <span class="label success">
                            <?php if ($_SESSION["user_type"] == 'AA') {
                                echo "Job";
                            } else {
                                echo "Worksheet";
                            } ?> ID</span>
                        <input type="text" name="worksheet_id" id="worksheet_id" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <span>Branch</span><span style="color:red"> * </span>
                        <input type="text" name="branch" id="branch" class="form-control" required readonly>

                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <span>Date</span>
                        <input type="date" name="worksheet_date" id="worksheet_date" class="form-control" required
                            readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <span>Customer</span><span style="color:red"> *</span>
                        <select name="customer" id="customer" class="form-control" aria-describedby="inputGroupPrepend2"
                            required>
                            <option value=""></option>
                            <?php
                            $fQuery = "SELECT customer_id,name FROM customer where block = 0 order by name ";
                            $result = sqlsrv_query($conn, $fQuery);
                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                <option value="<?php echo $row['customer_id']; ?>"><?php echo $row['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <span>Requester</span>
                        <input type="text" name="contact" id="contact" class="form-control">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <span>Customer ref.</span>
                        <input type="text" name="customer_ref" id="customer_ref" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <span>Remark</span>
                        <input type="text" name="worksheet_remark" id="worksheet_remark" class="form-control">
                    </div>
                </div>
                <div class="col-2 ">
                    <div class="form-group">
                        <span><?php if ($_SESSION["user_type"] == 'AA') {
                            echo "Job";
                        } else {
                            echo "Worksheet";
                        } ?> Status</span>
                        <select name="worksheet_status" id="worksheet_status" class="form-control"
                            aria-describedby="inputGroupPrepend2">
                            <option value="Open">Open</option>
                            <option value="Closed">Closed</option>
                            <option value="Send to A/R">Send to A/R</option>
                            <option value="RCVD by A/R">RCVD by A/R</option>
                            <option value="Reject by A/R">Reject by A/R</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Send to NAV">Send to NAV</option>
                        </select>
                    </div>
                </div>
                <!-- <div class="col-2 ">
                    <div class="form-group">
                        <span >Request method</span><span style="color:red"> *</span>
                        <select name="request_method" id="request_method" class="form-control" aria-describedby="inputGroupPrepend2" >
                            <option value="Line">Line</option>
                            <option value="Phone">Phone</option>
                            <option value="Email">Email</option>
                            <option value="Talk">Talk</option>
                        </select> 
                    </div>
                </div> -->
                <!-- <div class="col-2 ">
                    <div class="form-group">
                        <span >Request to</span><span style="color:red"> *</span>
                        <select name="request_to" id="request_to" class="form-control" aria-describedby="inputGroupPrepend2" >
                            <option value="CS">CS</option>
                            <option value="OPR/STH">OPR/STH</option>
                            <option value="OPR/SKL">OPR/SKL</option>
                            <option value="OPR/RNG">OPR/RNG</option>
                            <option value="OPR/BKK">OPR/BKK</option>
                        </select> 
                    </div>
                </div> -->
                <div class="col-2">
                    <div class="form-group">
                        <span>Client request date</span><span style="color:red"> *</span>
                        <input type="date" name="client_inform_amarit_date" id="client_inform_amarit_date"
                            class="form-control" required>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <span>time</span><span style="color:red"> *</span>
                        <input type="time" name="client_inform_amarit_time" id="client_inform_amarit_time"
                            class="form-control" required>
                    </div>
                </div>
                <!-- <div class="col-2">   
                    <div class="form-group">
                        <span >CS inform OPR</span>
                        <input type="date" name="cs_inform_opr_date" id="cs_inform_opr_date" class="form-control" >
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <span >time</span>
                        <input type="time" name="cs_inform_opr_time" id="cs_inform_opr_time" class="form-control" >
                    </div>
                </div>
                <div class="col-2">   
                    <div class="form-group">
                        <span >OPR inform CS</span>
                        <input type="date" name="opr_inform_cs_date" id="opr_inform_cs_date" class="form-control" >
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <span >time</span>
                        <input type="time" name="opr_inform_cs_time" id="opr_inform_cs_time" class="form-control" >
                    </div>
                </div> -->
                <!-- <div class="col-2">   
                    <div class="form-group">
                        <span >CS inform Client</span>
                        <input type="date" name="cs_inform_client_date" id="cs_inform_client_date" class="form-control" >
                    </div>
                </div> -->
                <!-- <div class="col-2">
                    <div class="form-group">
                        <span >time</span>
                        <input type="time" name="cs_inform_client_time" id="cs_inform_client_time" class="form-control" >
                    </div>
                </div> -->
                <div class="col-2 send">
                    <div class="form-group">
                        <span>Send to A/R Date</span><span style="color:red"> *</span>
                        <input type="date" name="send_date" id="send_date" class="form-control">
                    </div>
                </div>
                <div class="col-2 send">
                    <div class="form-group">
                        <span>Send to A/R Time</span><span style="color:red"> *</span>
                        <input type="time" name="send_time" id="send_time" class="form-control">
                    </div>
                </div>

                <div class="col-2 rcvd">
                    <div class="form-group">
                        <span>RCVD by A/R Date</span><span style="color:red"> *</span>
                        <input type="date" name="rcvd_date" id="rcvd_date" class="form-control">
                    </div>
                </div>
                <div class="col-2 rcvd">
                    <div class="form-group">
                        <span>RCVD by A/R Time</span><span style="color:red"> *</span>
                        <input type="time" name="rcvd_time" id="rcvd_time" class="form-control">
                    </div>
                </div>

                <div class="col-2 close_stt">
                    <div class="form-group">
                        <span>Close Date</span><span style="color:red"> *</span>
                        <input type="date" name="close_date" id="close_date" class="form-control">
                    </div>
                </div>
                <div class="col-2 close_stt">
                    <div class="form-group">
                        <span>Close Time</span><span style="color:red"> *</span>
                        <input type="time" name="close_time" id="close_time" class="form-control">
                    </div>
                </div>

                <div class="col-3 cancel">
                    <div class="form-group">
                        <span>Cancel Reason</span><span style="color:red"> *</span>
                        <select name="cancel_reason" id="cancel_reason" class="form-control"
                            aria-describedby="inputGroupPrepend2">
                            <option value=""></option>
                            <?php
                            $fQuery = "SELECT * FROM cancellation_reason";
                            $result = sqlsrv_query($conn, $fQuery);
                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                <option value="<?php echo $row['code']; ?>"><?php echo $row['description']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-4 reject">
                    <div class="form-group">
                        <span class="label success">Reject reason</span>
                        <input type="text" name="reject_reason" id="reject_reason" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <span>Date in vendor invoice document </span>
                        <input type="date" name="invoice_date" id="invoice_date" class="form-control" maxlength="50">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <span>Date vendor submit invoice to AMARIT</span>
                        <input type="date" name="submitinvoice_date" id="submitinvoice_date" class="form-control"
                            maxlength="50">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <span>Vendor invoice Number</span>
                        <input type="text" name="vendor_number" id="vendor_number" class="form-control" maxlength="50">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <span>Vendor invoice value</span>
                        <input type="text" name="vendor_value" id="vendor_value" class="form-control" maxlength="50">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <span>Vendor invoice due date</span>
                        <input type="date" name="invoice_due_date" id="invoice_due_date" class="form-control"
                            maxlength="50">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <span>Expense submission date</span>
                        <input type="date" name="submission_date" id="submission_date" class="form-control"
                            maxlength="50">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <span>Date Job/WS sent to Manager for review</span>
                        <input type="date" name="date_review" id="date_review" class="form-control" maxlength="50">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <span>Date Job/WS received back from Manager</span>
                        <input type="date" name="date_back" id="date_back" class="form-control" maxlength="50">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <span>Job/WS mailing List reference</span>
                        <input type="text" name="mailing_list" id="mailing_list" class="form-control" maxlength="50">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <span>Reference 1</span>
                        <input type="text" name="worksheet_ref1" id="worksheet_ref1" class="form-control"
                            maxlength="50">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <span>Reference 2</span>
                        <input type="text" name="worksheet_ref2" id="worksheet_ref2" class="form-control"
                            maxlength="50">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <span>Reference 3</span>
                        <input type="text" name="worksheet_ref3" id="worksheet_ref3" class="form-control"
                            maxlength="50">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <span>Reference 4</span>
                        <input type="text" name="worksheet_ref4" id="worksheet_ref4" class="form-control"
                            maxlength="50">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <span>Reference 5</span>
                        <input type="text" name="worksheet_ref5" id="worksheet_ref5" class="form-control"
                            maxlength="50">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <span>Reference 6</span>
                        <input type="text" name="worksheet_ref6" id="worksheet_ref6" class="form-control"
                            maxlength="50">
                    </div>
                </div>


            </div>
        </div>


        <br>

        <div class="row">
            <div class="col-6">
                <br>
                <button style="width:100px" type="submit" class="btn btn-success" id="worksheet_submit"
                    data-bs-target="#">
                    <i class="fa fa-save"></i> Save
                </button>
                <button style="width:100px" type="button" class="btn btn-danger" id="worksheet_cancel"
                    data-bs-target="#">
                    <i class="fa fa-minus-square"></i> Cancel
                </button>
                <input type="hidden" id="contact_id">
                <input type="hidden" id="user_name">
            </div>
            <!-- <div class="col-2">   
                <div class="form-group">
                    <span>Create 
                        <?php
                        // if ($_SESSION["user_type"] == 'AA'){
                        //         echo "Job";
                        //     } else{
                        //         echo "Worksheet";
                        //     }
                        ?> 
                            from id</span>
                    <input type="text" name="copy_id" id="copy_id" class="form-control" >
                </div>
            </div>
            <div class="col-1">   
                <div class="form-group">
                    <span>Amount</span>
                    <input type="text" name="copy_num" id="copy_num" class="form-control" >
                </div>
            </div>
            <div class="col-2"> 
                <br>
                <button style="width:120px" type="button" class="btn btn-success" name="submit" id="copy_submit" data-bs-target="#" >
                        <i class="fa fa-save"></i> Confirm
                    </button>
            </div> -->

        </div>

    </form>


    <div id="sub_data">
        <div class="card-body">
            <ul class="nav nav-tabs" id="menujob" role="tablist">

                <!-- Phase 1 -->
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#transport-tab" id="transport-nav">Cargo
                        Transport ( <span></span> )</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#manpower-tab" id="manpower-nav">Manpower (
                        <span></span> )</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#cargo-tab" id="cargo-nav">Cargo Handling (
                        <span></span> )</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#serviceother-tab" id="serviceother">Service Other (
                        <span></span> )</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#immigration-tab" id="immigration-nav">Immigration (
                        <span></span> )</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#taxi-tab" id="taxi-nav">Taxi service ( <span></span>
                        )</a>
                </li>

                <!-- Phase 2 -->

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#warehousing-tab" id="warehousing">Warehousing / Space
                        Rental ( <span></span> )</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#utilities-tab" id="utilities">Utilities ( <span></span>
                        )</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#rental-tab" id="rental">Rental(Veicles&Heavy Eq.) (
                        <span></span> )</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#hotelbooking-tab" id="hotelbooking">Hotel Booking (
                        <span></span> )</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#ticketbooking-tab" id="ticketbooking">Ticket Booking (
                        <span></span> ) </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#customerclearancecargo-tab"
                        id="customerclearancecargo">Custom Clearance (Cargo) ( <span></span> ) </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#customerclearancevessel-tab"
                        id="customerclearancevessel">Custom Clearance (Vessel) ( <span></span> ) </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#agencyservice-tab" id="agencyservice">Agency Service (
                        <span></span> ) </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#taxi-tab" id="taxi_service">Taxi service ( <span></span> ) </a> 
                </li>  -->
                <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#immagration-service-job-tab" id="immigrationservice">Immagration Service ( <span></span> ) </a> 
                </li>     -->
                <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#service-tab" id="service_other">Service Other ( <span></span> ) </a>
                </li>  -->

                <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#requisition-supply-tab" id="requisition-supply">Requisition Supply</a> 
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#managementfree-tab" id="managementfree">Management fee
                        ( <span></span> ) </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#provisionincome-tab" id="provisionincome">Provision
                        Income ( <span></span> ) </a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#manpower-job-tab" id="manpower">Manpower ( <span></span> ) </a> 
                </li> -->
            </ul>

            <div class="tab-content mt-4">
                <!-- Phase 1 -->
                <div class="tab-pane active" id="transport-tab">
                    <br>
                    <form id="transport_data">
                        <div id="transport_edit_area">

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cargo Trasport ID</span>
                                        <input type="text" name="transport_id" id="transport_id" class="form-control"
                                            required readonly>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Name</span><span style="color:red"> *</span>
                                        <select name="name" id="transport_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, TP FROM FES.dbo.barcode_service where TP = 1 ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="location" id="transport_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, TP FROM FES.dbo.barcode_branch where TP = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code_branch']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <select name="location" id="transport_location" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name, TP FROM FES.dbo.barcode_location where TP = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="barcode_type" id="transport_barcode_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name, RN FROM FES.dbo.barcode_product_type where TP = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red"> *</span>
                                        <select name="type1" id="transport_type1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1 FROM FES.dbo.barcode_sub_type1 where TP = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red"> *</span>
                                        <select name="type2" id="transport_type2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2 FROM FES.dbo.barcode_sub_type2 where TP = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red"> *</span>
                                        <select name="type3" id="transport_type3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3 FROM FES.dbo.barcode_sub_type3 where TP = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red"> *</span>
                                        <select name="type4" id="transport_type4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4  FROM FES.dbo.barcode_sub_type4 where TP = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type5" id="transport_type5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5 FROM FES.dbo.barcode_sub_type5 where TP = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type6" id="transport_type6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6 FROM FES.dbo.barcode_sub_type6 where TP = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="quantity" id="transport_quantity"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="transport_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where TP = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract line number</span>
                                        <select name="contract_number" id="transport_contract_number"
                                            onchange="changeContract(id)" class="form-control">
                                        </select>

                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract description</span><span style="color:red"> </span>
                                        <select name="contract_description" id="transport_contract_description"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContractDes(id)"></select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" id="transport_department" name="department"
                                            class="form-control" value="<?php echo $_SESSION["department"]; ?>" require
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" id="transport_cost_center" name="cost_center"
                                            class="form-control" value=" <?php echo $_SESSION["cost_center"]; ?>"
                                            require readonly>
                                    </div>
                                </div>

                                <div class="col-2 ">
                                    <div class="form-group">
                                        <span>Line status</span>
                                        <select name="transport_line_status" id="transport_line_status"
                                            class="form-control" aria-describedby="inputGroupPrepend2" readonly
                                            required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="transport_cancel_reason" id="transport_cancel_reason"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>


                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Vehicle</span><span style="color:red"> *</span>
                                        <select name="vehicle" id="transport_vehicle" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT vehicle_id, vehicle_type, b.description as vehicle_owner, registration_no, branch FROM vehicle left join vehicle_owner b on b.code = vehicle_owner where category = 'Vehicles' and block = 0 order by registration_no ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['vehicle_id']; ?>">
                                                    <?php echo $row['registration_no'] . ' | ' . $row['vehicle_type'] . ' | ' . $row['vehicle_owner']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Operator</span><span style="color:red"> *</span>
                                        <select name="operator" id="transport_operator" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT o.operator_id, o.name, o.lastname, p.description, o.branch, l.description as br FROM operator o left join position p on p.code = o.position left join location l on o.branch = l.code where o.operator = 1 and o.block = 0 order by o.name, o.lastname ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['operator_id']; ?>">
                                                    <?php echo $row['name'] . "  " . $row['lastname'] . ' | ' . $row['description'] . ' | ' . $row['br']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Charge as</span><span style="color:red"> *</span>
                                        <select id="charge_as" name="transport_charge_as" class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Outsource charge as</span><span style="color:red"> *</span>
                                        <select id="outsource_charge_as" name="outsource_charge_as" class="form-control"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <span>From</span><span style="color:red"> *</span>
                                        <select name="transport_from" id="transport_transport_from" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Specific location (from)</span><span style="color:red"> *</span>
                                        <input type="text" name="specific_location_from" id="specific_location_from"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Contact person (from)</span><span style="color:red"> *</span>
                                        <input type="text" name="contact1" id="contact1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <span>To</span>
                                        <select name="transport_to" id="transport_transport_to" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Specific location (to)</span>
                                        <input type="text" name="specific_location_to" id="specific_location_to"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Contact person (to)</span><span style="color:red"> *</span>
                                        <input type="text" name="contact2" id="contact2" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="start_date" id="transport_start_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="start_time" id="transport_start_time"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="end_date" id="transport_end_date" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Time</span><span style="color:red"> *</span>
                                        <input type="time" name="end_time" id="transport_end_time" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-4 cancel1">
                                    <div class="form-group">
                                        <span>Reason for outsource</span>
                                        <select name="transport_outsource_reason" id="transport_outsource_reason"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM outsource_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Remark</span>
                                        <input type="text" name="transport_remark" id="transport_remark"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Transport solution</span>
                                        <input type="checkbox" value="1" id="transport_solution"
                                            name="transport_solution" class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>No charge</span>
                                        <input type="checkbox" value="1" id="no_charge" name="no_charge"
                                            class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Consolidate</span>
                                        <input type="checkbox" value="1" id="consolidate" name="consolidate"
                                            class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Vehicle Switch</span>
                                        <input type="checkbox" value="1" id="vehicle_switch" name="vehicle_switch"
                                            class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Standby</span>
                                        <input type="checkbox" value="1" id="standby_charge" name="standby_charge"
                                            class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Round trip</span>
                                        <input type="checkbox" value="1" id="round_trip" name="round_trip"
                                            class="form-check" onclick="selectRoundTrip()">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Lumsum charge</span>
                                        <input type="checkbox" value="1" id="lumsum_charge" name="lumsum_charge"
                                            class="form-check">
                                    </div>
                                </div>

                                <div class="col-1"></div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount (฿)</span><span style="color:red"> *</span>
                                        <input type="text" name="amont_system" id="amont_system" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Charge %</span>
                                        <input type="text" name="charge" id="charge" class="form-control">
                                    </div>
                                </div>



                            </div>

                            <div class="row">


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Diesel Rate (฿)</span><span style="color:red"> *</span>
                                        <input type="text" name="diesel_rate" id="diesel_rate" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="col-2 ">
                                    <div class="form-group">
                                        <span>Cargo type</span>
                                        <select name="transport_cargo_type" id="transport_cargo_type"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value="Normal">Normal</option>
                                            <option value="DG">DG</option>
                                            <option value="Radio active">Radio active</option>
                                            <option value="Batteries">Batteries</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-2">
                                        <div class="form-group">
                                            <span>Cargo quantity</span>
                                            <input type="number" name="transport_cargo_qty" id="transport_cargo_qty"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <span>Cargo weight (kg)</span>
                                            <input type="number" name="transport_cargo_weight" id="transport_cargo_weight"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <span>Dimension (m)</span>
                                            <input type="text" name="dimension" id="dimension" class="form-control">
                                        </div>
                                    </div> -->

                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Started mileage</span><span style="color:red"> *</span>
                                        <input type="number" name="mileage_start" id="mileage_start"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Finished mileage</span><span style="color:red"> *</span>
                                        <input type="number" name="mileage_end" id="mileage_end" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div id="moreinfo">

                                <div class="row">
                                    <div class="col-12 mb-5">
                                        <hr />
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <span>Reference 1</span>
                                            <input type="text" name="ref1" id="ref1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <span>Reference 2</span>
                                            <input type="text" name="ref2" id="ref2" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <span>Reference 3</span>
                                            <input type="text" name="ref3" id="ref3" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <span>Reference 4</span>
                                            <input type="text" name="ref4" id="ref4" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <span>Reference 5</span>
                                            <input type="text" name="ref5" id="ref5" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <span>Reference 6</span>
                                            <input type="text" name="ref6" id="ref6" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row ">


                            <div class="d-flex col-12">
                                <div class="col-7">
                                    <button type="button" style="width:100px" class="btn btn-success" id="transport_add"
                                        data-bs-target="#">
                                        <i class="fa fa-plus-square"></i> Add
                                    </button>

                                    <button type="submit" style="width:100px" class="btn btn-success"
                                        id="transport_submit" data-bs-target="#">
                                        <i class="fa fa-save"></i> Save
                                    </button>



                                    <button type="button" style="width:100px" class="btn btn-danger"
                                        id="transport_cancel" data-bs-target="#">
                                        <i class="fa fa-minus-square"></i> Cancel
                                    </button>

                                    <input type="hidden" name="transport_type" id="transport_type">
                                    <input type="hidden" name="transport_outsource" id="transport_outsource">
                                    <input type="hidden" name="transport_reccode" id="transport_reccode">

                                </div>
                                <div class="d-flex col-5 justify-content-end">
                                    <div class="d-flex justify-content-between col">
                                        <div class="d-flex col-6">
                                            <button type="button" class="btn btn-info mb-4 col-6"
                                                id="transport_copyFromWorksheet" data-bs-target="#"
                                                onclick="copyJobsFromWorksheet(id)">
                                                <i class="fa fa-copy"></i> Copy from worksheet
                                            </button>
                                        </div>
                                        <div class="d-flex col-6">
                                            <input type="number" name="rows" id="transport_rows"
                                                class="form-control col mr-2" placeholder="Number of rows">
                                            <button type="button" style="width:100px" class="btn btn-info mb-4"
                                                id="transport_copy" data-bs-target="#" onclick="copyJobs(id)">
                                                <i class="fa fa-copy"></i> Copy
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <table id="transport_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="10%"></th>
                                <th scope="col" width="10%">Transport ID</th>
                                <th scope="col" width="10%">Vehicle</th>
                                <th scope="col" width="10%">Operator</th>
                                <th scope="col" width="10%">From</th>
                                <th scope="col" width="10%">To</th>
                                <th scope="col" width="10%">Start Date</th>
                                <th scope="col" width="10%">End Date</th>
                                <th scope="col" width="5%">Qty</th>
                                <th scope="col" width="5%">UOM</th>
                                <th scope="col" width="10%">Contract No.</th>
                                <th scope="col" width="10%">Started Mileage</th>
                                <th scope="col" width="10%">Finished Mileage</th>

                                <th scope="col" width="10%">No Charge</th>
                                <th scope="col" width="10%">Diesel Rate</th>
                                <th scope="col" width="10%">Fuel estimate (litre)</th>
                                <th scope="col" width="10%">line status</th>
                                <th scope="col" width="10%">Barcode</th>
                                <th scope="col" width="10%">sub1</th>
                                <th scope="col" width="10%">sub2</th>
                                <th scope="col" width="10%">sub3</th>
                                <th scope="col" width="10%">sub4</th>
                                <th scope="col" width="10%">sub5</th>
                                <th scope="col" width="10%">sub6</th>
                                <th scope="col" style="width: 15%;">Reference 1</th>
                                <th scope="col" style="width: 15%;">Reference 2</th>
                                <th scope="col" style="width: 15%;">Reference 3</th>
                                <th scope="col" style="width: 15%;">Reference 4</th>
                                <th scope="col" style="width: 15%;">Reference 5</th>
                                <th scope="col" style="width: 15%;">Reference 6</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="manpower-tab">
                    <br>
                    <form id="manpower_data">
                        <div id="manpower_edit_area">

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Manpower job ID</span>
                                        <input type="text" name="labor_service_id" id="labor_service_id"
                                            class="form-control" required readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Name</span><span style="color:red"> *</span>
                                        <select name="name" id="manpower_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, TP FROM FES.dbo.barcode_service where LS = 1 ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="branch" id="manpower_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, TP FROM FES.dbo.barcode_branch where LS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code_branch']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <select name="location" id="manpower_location" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name, TP FROM FES.dbo.barcode_location where LS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="barcode_type" id="manpower_barcode_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name, RN FROM FES.dbo.barcode_product_type where LS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red"> *</span>
                                        <select name="type1" id="manpower_type1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1 FROM FES.dbo.barcode_sub_type1 where LS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red"> *</span>
                                        <select name="type2" id="manpower_type2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2 FROM FES.dbo.barcode_sub_type2 where LS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red"> *</span>
                                        <select name="type3" id="manpower_type3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3 FROM FES.dbo.barcode_sub_type3 where LS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red"> *</span>
                                        <select name="type4" id="manpower_type4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4  FROM FES.dbo.barcode_sub_type4 where LS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type5" id="manpower_type5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5 FROM FES.dbo.barcode_sub_type5 where LS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type6" id="manpower_type6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6 FROM FES.dbo.barcode_sub_type6 where LS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="quantity" id="manpower_quantity"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="manpower_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where LS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>





                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract line number</span>
                                        <select name="manpower_contract_number" id="manpower_contract_number"
                                            class="form-control" onchange="changeContract(id)">
                                        </select>

                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Description</span><span style="color:red"> *</span>
                                        <select name="manpower_contract_description" id="manpower_contract_description"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContractDes(id)"></select>

                                    </div>
                                </div>
                                <!-- <div class="col-2">
                                    <div class="form-group">
                                        <span>Show hidden contract</span>
                                        <input type="text" name="manpower_contract_no_1" id="manpower_contract_no_1"
                                            class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Confirm Contract</span>
                                        <input type="checkbox" value="1" id="manpower_confirm_contract"
                                            name="manpower_confirm_contract" class="form-check">
                                    </div>
                                </div> -->

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" id="manpower_department" name="manpower_department"
                                            class="form-control" value="<?php echo $_SESSION["department"]; ?>" required
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" id="manpower_cost_center" name="manpower_cost_center"
                                            class="form-control" value="<?php echo $_SESSION["cost_center"]; ?>"
                                            required readonly>
                                    </div>
                                </div>


                                <div class="col-2 ">
                                    <div class="form-group">
                                        <span>Line status</span>
                                        <select name="manpower_line_status" id="manpower_line_status"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="manpower_cancel_reason" id="manpower_cancel_reason"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Manpower Name</span>
                                        <select name="labor" id="labor" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT o.operator_id, o.name, o.lastname, p.description, o.branch FROM operator o left join position p on p.code = o.position where o.manpower = 1 and o.block = 0 order by o.name, o.lastname";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['operator_id']; ?>">
                                                    <?php echo $row['name'] . "  " . $row['lastname'] . ' | ' . $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Charge as</span><span style="color:red"> *</span>
                                        <select name="manpower_charge_as" id="manpower_charge_as" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount (฿)</span><span style="color:red"> *</span>
                                        <input type="text" name="manpower_amont_system" id="manpower_amont_system"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Outsource charge as</span><span style="color:red"> *</span>
                                        <select id="manpower_outsource_charge_as" name="manpower_outsource_charge_as"
                                            class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM position";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Contact person</span>
                                        <input type="text" name="manpower_contact" id="manpower_contact"
                                            class="form-control">
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="manpower_start_date" id="manpower_start_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="manpower_start_time" id="manpower_start_time"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="manpower_end_date" id="manpower_end_date"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Time</span><span style="color:red"> *</span>
                                        <input type="time" name="manpower_end_time" id="manpower_end_time"
                                            class="form-control">
                                    </div>
                                </div>


                                <div class="col-1">
                                    <div class="form-group">
                                        <span>OT line</span>
                                        <input type="checkbox" value="1" id="manpower_ot" name="manpower_ot"
                                            class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>On time</span>
                                        <input type="checkbox" value="1" id="ontime" name="ontime" class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>No charge</span>
                                        <input type="checkbox" value="1" id="manpower_no_charge"
                                            name="manpower_no_charge" class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Lumsum charge</span>
                                        <input type="checkbox" value="1" id="manpower_lumsum_charge"
                                            name="manpower_lumsum_charge" class="form-check">
                                    </div>
                                </div>
                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Reason for outsource</span>
                                        <select name="manpower_outsource_reason" id="manpower_outsource_reason"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM outsource_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Remark</span>
                                        <input type="text" name="manpower_remark" id="manpower_remark"
                                            class="form-control">
                                    </div>
                                </div>


                            </div>

                            <div class="row">




                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Timesheet no.</span>
                                        <input type="text" name="timesheet_no" id="timesheet_no" class="form-control">
                                    </div>
                                </div>



                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Name</span>
                                        <select name="manpower_group_name" id="manpower_group_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM group_name where manpower = 1";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_trip_type1, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['code'] . '-' . $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="col-1">
                                    <div class="form-group">
                                        <span>Amount (฿)</span><span style="color:red"> *</span>
                                        <input type="text" name="amont_system" id="serviceother_amont_system"
                                            class="form-control">
                                    </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <span>Charge %</span>
                                            <input type="text" name="charge" id="serviceother_charge" class="form-control">
                                        </div>
                                    </div>
 -->



                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Sub task name</span>
                                        <select name="sub_task_name" id="sub_task_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM sub_task order by code";
                                            $result_sub_task = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_sub_task, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Issue date</span>
                                        <input type="date" name="timesheet_issue_date" id="timesheet_issue_date"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Return date</span>
                                        <input type="date" name="timesheet_return_date" id="timesheet_return_date"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2 ">
                                    <div class="form-group">
                                        <span>Cost type</span>
                                        <select name="manpower_cost_type" id="manpower_cost_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                            <option value="Charge">Charge</option>
                                            <option value="Fixed Cost">Fixed Cost</option>
                                            <option value="Non work">Non work</option>
                                        </select>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-12 mb-5">
                                    <hr />
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 1</span>
                                        <input type="text" name="manpower_ref1" id="manpower_ref1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 2</span>
                                        <input type="text" name="manpower_ref2" id="manpower_ref2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 3</span>
                                        <input type="text" name="manpower_ref3" id="manpower_ref3" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 4</span>
                                        <input type="text" name="manpower_ref4" id="manpower_ref4" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 5</span>
                                        <input type="text" name="manpower_ref5" id="manpower_ref5" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 6</span>
                                        <input type="text" name="manpower_ref6" id="manpower_ref6" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex col-12">
                                <div class="col-7">
                                    <button type="button" style="width:100px" class="btn btn-success" id="manpower_add"
                                        data-bs-target="#">
                                        <i class="fa fa-plus-square"></i> Add
                                    </button>

                                    <button type="submit" style="width:100px" class="btn btn-success"
                                        id="manpower_submit" data-bs-target="#">
                                        <i class="fa fa-save"></i> Save
                                    </button>

                                    <button type="button" style="width:100px" class="btn btn-danger"
                                        id="manpower_cancel" data-bs-target="#">
                                        <i class="fa fa-minus-square"></i> Cancel
                                    </button>

                                    <input type="hidden" name="manpower_type" id="manpower_type">
                                    <input type="hidden" name="manpower_outsource" id="manpower_outsource">
                                    <input type="hidden" name="manpower_reccode" id="manpower_reccode">

                                </div>
                                <div class="d-flex col-5 justify-content-end">
                                    <div class="d-flex justify-content-between col">
                                        <div class="d-flex col-6">
                                            <button type="button" class="btn btn-info mb-4 col-6"
                                                id="manpower_copyFromWorksheet" data-bs-target="#"
                                                onclick="copyJobsFromWorksheet(id)">
                                                <i class="fa fa-copy"></i> Copy from worksheet
                                            </button>
                                        </div>
                                        <div class="d-flex col-6">
                                            <input type="number" name="rows" id="manpower_rows"
                                                class="form-control col mr-2" placeholder="Number of rows">
                                            <button type="button" style="width:100px" class="btn btn-info mb-4"
                                                id="manpower_copy" data-bs-target="#" onclick="copyJobs(id)">
                                                <i class="fa fa-copy"></i> Copy
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <table id="manpower_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="20%"></th>
                                <th scope="col" width="15%">Labour service ID</th>
                                <th scope="col" width="10%">Timesheet No.</th>
                                <th scope="col" width="10%">Position</th>
                                <th scope="col" width="10%">Manpower Name</th>
                                <th scope="col" width="10%">Location</th>
                                <th scope="col" width="10%">Start Date</th>
                                <th scope="col" width="10%">Start Time</th>
                                <th scope="col" width="5%">Qty</th>
                                <th scope="col" width="5%">UOM</th>
                                <th scope="col" width="15%">Remark</th>
                                <th scope="col" width="10%">line status</th>
                                <th scope="col" width="10%">Barcode</th>
                                <th scope="col" style="width: 15%;">Reference 1</th>
                                <th scope="col" style="width: 15%;">Reference 2</th>
                                <th scope="col" style="width: 15%;">Reference 3</th>
                                <th scope="col" style="width: 15%;">Reference 4</th>
                                <th scope="col" style="width: 15%;">Reference 5</th>
                                <th scope="col" style="width: 15%;">Reference 6</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="cargo-tab">
                    <br>
                    <form id="cargo_data">
                        <div id="cargo_edit_area">

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cargo service ID</span>
                                        <input type="text" name="cargo_service_id" id="cargo_service_id"
                                            class="form-control" required readonly>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Name</span><span style="color:red"> *</span>
                                        <select name="name" id="cargo_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, CH FROM FES.dbo.barcode_service where CH = 1 ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="branch" id="cargo_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, CH FROM FES.dbo.barcode_branch where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['branch_name']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <select name="location" id="cargo_location" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name, CH FROM FES.dbo.barcode_location where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="barcode_type" id="cargo_barcode_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name, RN FROM FES.dbo.barcode_product_type where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red"> *</span>
                                        <select name="type1" id="cargo_type1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1 FROM FES.dbo.barcode_sub_type1 where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red"> *</span>
                                        <select name="type2" id="cargo_type2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2 FROM FES.dbo.barcode_sub_type2 where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red"> *</span>
                                        <select name="type3" id="cargo_type3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3 FROM FES.dbo.barcode_sub_type3 where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red"> *</span>
                                        <select name="type4" id="cargo_type4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4  FROM FES.dbo.barcode_sub_type4 where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type5" id="cargo_type5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5 FROM FES.dbo.barcode_sub_type5 where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type6" id="cargo_type6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6 FROM FES.dbo.barcode_sub_type6 where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="quantity" id="cargo_quantity"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="cargo_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>



                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Line Number</span><span style="color:red"> *</span>
                                        <select name="contract_number" id="cargo_contract_number" class="form-control"
                                            onchange="changeContract(id)">
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Drescription</span><span style="color:red"> *</span>
                                        <select name="contract_description" id="cargo_contract_description"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContractDes(id)"></select>

                                    </div>
                                </div>


                                <!-- <div class="col-2">
                                    <div class="form-group">
                                        <span>Show hidden contract</span>
                                        <input type="text" name="cargo_contract_no_1" id="cargo_contract_no_1"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Confirm Contract</span>
                                        <input type="checkbox" value="1" id="cargo_confirm_contract"
                                            name="cargo_confirm_contract" class="form-check">
                                    </div>
                                </div> -->


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" id="cargo_department" name="cargo_department"
                                            class="form-control" value="<?php echo $_SESSION["department"]; ?>" required
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" id="cargo_cost_center" name="cargo_cost_center"
                                            class="form-control" value="<?php echo $_SESSION["cost_center"]; ?>"
                                            required readonly>
                                    </div>
                                </div>

                                <div class="col-2 ">
                                    <div class="form-group">
                                        <span>Line status</span>
                                        <select name="cargo_line_status" id="cargo_line_status" class="form-control"
                                            aria-describedby="inputGroupPrepend2" readonly required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="cargo_cancel_reason" id="cargo_cancel_reason" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>



                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Vehicle</span><span style="color:red"> *</span>
                                        <select name="cargo_vehicle" id="cargo_vehicle" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT vehicle_id, vehicle_type, b.description as vehicle_owner, registration_no, branch FROM vehicle left join vehicle_owner b on b.code = vehicle_owner where category = 'Heavy Equipment' and block = 0 order by vehicle_type, b.description ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['vehicle_id']; ?>">
                                                    <?php echo $row['registration_no'] . ' | ' . $row['vehicle_type'] . ' | ' . $row['vehicle_owner'] . ' | ' . $row['branch']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Operator</span><span style="color:red"> *</span>
                                        <select name="operator" id="cargo_operator" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT o.operator_id, o.name, o.lastname, p.description, o.branch FROM operator o left join position p on p.code = o.position where o.operator = 1 and o.block = 0 order by o.name, o.lastname";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['operator_id']; ?>">
                                                    <?php echo $row['name'] . "  " . $row['lastname'] . ' | ' . $row['description'] . ' | ' . $row['branch']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <select name="cargo_transport_from" id="cargo_transport_from"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Charge as</span><span style="color:red"> *</span>
                                        <select name="cargo_charge_as" id="cargo_charge_as" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount (฿)</span><span style="color:red"> *</span>
                                        <input type="text" name="cargo_amont_system" id="cargo_amont_system"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Outsource charge as</span><span style="color:red"> *</span>
                                        <select id="cargo_outsource_charge_as" name="cargo_outsource_charge_as"
                                            class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="start_date" id="cargo_start_date" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="start_time" id="cargo_start_time" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Date</span>
                                        <input type="date" name="end_date" id="cargo_end_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Time</span>
                                        <input type="time" name="end_time" id="cargo_end_time" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contact person</span>
                                        <input type="text" name="cargo_handling_contact" id="cargo_handling_contact"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-3 cancel1">
                                    <div class="form-group">
                                        <span>Reason for outsource</span>
                                        <select name="cargo_outsource_reason" id="cargo_outsource_reason"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM outsource_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Remark</span>
                                        <input type="text" name="cargo_remark" id="cargo_remark" class="form-control">
                                    </div>
                                </div>



                            </div>

                            <div class="row">
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>On time</span>
                                        <input type="checkbox" value="1" id="cargo_ontime" name="cargo_ontime"
                                            class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>OT</span>
                                        <input type="checkbox" value="1" id="cargo_ot" name="cargo_ot"
                                            class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>No charge</span>
                                        <input type="checkbox" value="1" id="cargo_no_charge" name="cargo_no_charge"
                                            class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Diesel Rate (฿)</span><span style="color:red"> *</span>
                                        <input type="text" name="cargo_diesel_rate" id="cargo_diesel_rate"
                                            class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 mb-5">
                                    <hr />
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 1</span>
                                        <input type="text" name="cargo_ref1" id="cargo_ref1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 2</span>
                                        <input type="text" name="cargo_ref2" id="cargo_ref2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 3</span>
                                        <input type="text" name="cargo_ref3" id="cargo_ref3" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 4</span>
                                        <input type="text" name="cargo_ref4" id="cargo_ref4" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 5</span>
                                        <input type="text" name="cargo_ref5" id="cargo_ref5" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 6</span>
                                        <input type="text" name="cargo_ref6" id="cargo_ref6" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="d-flex col-12">
                                <div class="col-7">
                                    <button type="button" style="width:100px" class="btn btn-success" id="cargo_add"
                                        data-bs-target="#">
                                        <i class="fa fa-plus-square"></i> Add
                                    </button>

                                    <button type="submit" style="width:100px" class="btn btn-success" id="cargo_submit"
                                        data-bs-target="#">
                                        <i class="fa fa-save"></i> Save
                                    </button>

                                    <button type="button" style="width:100px" class="btn btn-danger" id="cargo_cancel"
                                        data-bs-target="#">
                                        <i class="fa fa-minus-square"></i> Cancel
                                    </button>

                                    <input type="hidden" name="cargo_types" id="cargo_types">
                                    <input type="hidden" name="cargo_reccode" id="cargo_reccode">

                                </div>
                                <div class="d-flex col-5 justify-content-end">
                                    <div class="d-flex justify-content-between col">
                                        <div class="d-flex col-6">
                                            <button type="button" class="btn btn-info mb-4 col-6"
                                                id="cargo_copyFromWorksheet" data-bs-target="#"
                                                onclick="copyJobsFromWorksheet(id)">
                                                <i class="fa fa-copy"></i> Copy from worksheet
                                            </button>
                                        </div>
                                        <div class="d-flex col-6">
                                            <input type="number" name="rows" id="cargo_rows"
                                                class="form-control col mr-2" placeholder="Number of rows">
                                            <button type="button" style="width:100px" class="btn btn-info mb-4"
                                                id="cargo_copy" data-bs-target="#" onclick="copyJobs(id)">
                                                <i class="fa fa-copy"></i> Copy
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <table id="cargo_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="20%"></th>
                                <th scope="col" width="15%">Carge service ID</th>
                                <th scope="col" width="10%">Vehicle</th>
                                <th scope="col" width="10%">Operator</th>
                                <th scope="col" width="10%">Location</th>
                                <th scope="col" width="10%">Start Date</th>
                                <th scope="col" width="5%">Qty</th>
                                <th scope="col" width="10%">UOM</th>
                                <th scope="col" width="15%">Remark</th>
                                <th scope="col" width="10%">line status</th>
                                <th scope="col" width="10%">Barcode</th>
                                <th scope="col" style="width: 15%;">Reference 1</th>
                                <th scope="col" style="width: 15%;">Reference 2</th>
                                <th scope="col" style="width: 15%;">Reference 3</th>
                                <th scope="col" style="width: 15%;">Reference 4</th>
                                <th scope="col" style="width: 15%;">Reference 5</th>
                                <th scope="col" style="width: 15%;">Reference 6</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="serviceother-tab">
                    <br>
                    <form id="serviceother_data">
                        <div id="serviceother_edit_area">

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Service Other ID</span>
                                        <input type="text" name="serviceother_id" id="serviceother_id"
                                            class="form-control" required readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Name</span><span style="color:red"> *</span>
                                        <select name="name" id="serviceother_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, SO FROM FES.dbo.barcode_service where SO = 1 ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="branch" id="serviceother_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, SO FROM FES.dbo.barcode_branch where SO = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code_branch']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <select name="location" id="serviceother_location" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name, SO FROM FES.dbo.barcode_location where SO = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type" id="serviceother_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name, RN FROM FES.dbo.barcode_product_type where SO = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red"> *</span>
                                        <select name="sub1" id="serviceother_sub1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1 FROM FES.dbo.barcode_sub_type1 where SO = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red"> *</span>
                                        <select name="sub2" id="serviceother_sub2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2 FROM FES.dbo.barcode_sub_type2 where SO = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red"> *</span>
                                        <select name="sub3" id="serviceother_sub3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3 FROM FES.dbo.barcode_sub_type3 where SO = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red"> *</span>
                                        <select name="sub4" id="serviceother_sub4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4  FROM FES.dbo.barcode_sub_type4 where SO = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub5" id="serviceother_sub5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5 FROM FES.dbo.barcode_sub_type5 where SO = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub6" id="serviceother_sub6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6 FROM FES.dbo.barcode_sub_type6 where SO = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="qty" id="serviceother_qty"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="serviceother_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where SO = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract number (Auto)</span><span style="color:red"> *</span>
                                        <select name="contract_number_auto" id="serviceother_contract_number_auto"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContract(id)"></select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Description </span>
                                        <select type="text" name="contract_description"
                                            id="serviceother_contract_description" class="form-control"
                                            onchange="changeContractDes(id)" required></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" id="serviceother_department" name="department"
                                            class="form-control" value="<?php echo $_SESSION["department"]; ?>" require
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" id="serviceother_cost_center" name="cost_center"
                                            class="form-control" value=" <?php echo $_SESSION["cost_center"]; ?>"
                                            require readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Line status</span>
                                        <select name="status" id="serviceother_status" class="form-control"
                                            aria-describedby="inputGroupPrepend2" readonly required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="cancel_reason" id="serviceother_cancel_reason"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Service Type</span><span style="color:red"> *</span>
                                        <select name="service_line_type" id="serviceother_service_line_type"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeServiceType(id)">
                                            <option value="manpower">Manpower</option>
                                            <option value="vehicle">Vehicles</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <span>Description</span><span style="color:red"> *</span>
                                        <input type="text" name="description" id="serviceother_description"
                                            class="form-control" required>
                                    </div>
                                </div>


                                <div class="col-5">
                                    <div class="form-group">
                                        <span>Remark</span>
                                        <input type="text" name="remark" id="serviceother_remark" class="form-control">
                                    </div>
                                </div>


                                <!-- End Row -->

                                <div class="col-4" id="serviceother_vehicle">
                                    <div class="form-group">
                                        <span>Vehicle</span> <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="vehicle_id" id="serviceother_vehicle_id" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getDataService(id)">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT vehicle_id, vehicle_type, b.description as vehicle_owner, registration_no, branch FROM vehicle left join vehicle_owner b on b.code = vehicle_owner where category = 'Vehicles' and block = 0 order by registration_no ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <!-- <option value="<?php echo $row['vehicle_id']; ?>"><?php echo $row['registration_no'] . ' | ' . $row['vehicle_type'] . ' | ' . $row['vehicle_owner'] . ' | ' . $row['branch']; ?></option>	               -->
                                                <option name="<?php echo $row['vehicle_type']; ?>"
                                                    value="<?php echo $row['vehicle_id']; ?>">
                                                    <?php echo $row['registration_no'] . ' | ' . $row['vehicle_type'] . ' | ' . $row['vehicle_owner']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4" id="serviceother_operator">
                                    <div class="form-group">
                                        <span>Operator</span><span style="color:red"> *</span>
                                        <?php //switch transport_operator to service_operator 
                                        ?>
                                        <select name="operator_id" id="serviceother_operator_id" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getDataService(id)">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT o.operator_id, o.name, o.lastname, p.description, o.branch,o.position FROM operator o left join position p on p.code = o.position where o.operator = 1 and o.block = 0 order by o.name, o.lastname ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <!-- <option value="<?php echo $row['operator_id']; ?>"><?php echo $row['name'] . "  " . $row['lastname'] . ' | ' . $row['description'] . ' | ' . $row['branch']; ?></option>	 -->
                                                <option name="<?php echo $row['position']; ?>"
                                                    value="<?php echo $row['operator_id']; ?>">
                                                    <?php echo $row['name'] . "  " . $row['lastname'] . ' | ' . $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Charge as</span>
                                        <select name="charge_as" id="serviceother_charge_as" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * from vehicle_type";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option name="" value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['code']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Position</span>
                                        <select name="position" id="serviceother_position" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * from position";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>From</span>
                                        <select name="from_contract" id="serviceother_from_contract"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * from contract_location_master where active = 1 ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['location']; ?>">
                                                    <?php echo $row['location']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>To</span>
                                        <select name="to_contract" id="serviceother_to_contract" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * from contract_location_master where active = 1 ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['location']; ?>">
                                                    <?php echo $row['location']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="start_date" id="serviceother_start_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="start_time" id="serviceother_start_time"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="end_date" id="serviceother_end_date"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Time</span><span style="color:red"> *</span>
                                        <input type="time" name="end_time" id="serviceother_end_time"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Diesel Rate (฿)</span>
                                        <input type="text" name="diesel_rate" id="serviceother_diesel_rate"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>No charge</span>
                                        <input type="checkbox" value="1" id="serviceother_no_charge" name="no_charge"
                                            class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Reimbursment</span>
                                        <input type="checkbox" value="1" id="serviceother_reimbursment"
                                            name="reimbursment" class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Lump-sum charge</span>
                                        <input type="checkbox" value="1" id="serviceother_lump_sum_charge"
                                            name="lump_sum_charge" class="form-check">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount (฿)</span><span style="color:red"> *</span>
                                        <input type="text" name="amont_system" id="serviceother_amont_system"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Charge %</span>
                                        <input type="text" name="charge" id="serviceother_charge" class="form-control">
                                    </div>
                                </div>






                            </div>

                            <div class="row">
                                <div class="col-12 mb-5">
                                    <hr />
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 1</span>
                                        <input type="text" name="ref1" id="serviceother_ref1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 2</span>
                                        <input type="text" name="ref2" id="serviceother_ref2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 3</span>
                                        <input type="text" name="ref3" id="serviceother_ref3" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 4</span>
                                        <input type="text" name="ref4" id="serviceother_ref4" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 5</span>
                                        <input type="text" name="ref5" id="serviceother_ref5" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 6</span>
                                        <input type="text" name="ref6" id="serviceother_ref6" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-12 mb-4">
                                <hr />
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Vendor invoice Date</span>
                                    <input type="date" name="vendor_invoice_date" id="serviceother_vendor_invoice_date"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <span>Vendor invoice number</span>
                                    <input type="text" name="vendor_invoice_number"
                                        id="serviceother_vendor_invoice_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <span>Vendor invoice Submission date</span>
                                    <input type="date" name="vendor_invoice_submission_date"
                                        id="serviceother_invoice_submission_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <span>Vendor invoice Value </span>
                                    <input type="text" name="vendor_invoice_value"
                                        id="serviceother_vendor_invoice_value" class="form-control">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Vendor invoice Due date</span>
                                    <input type="date" name="vendor_invoice_due_date"
                                        id="serviceother_vendor_invoice_due_date" class="form-control">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Expense Submission date</span>
                                    <input type="date" name="expense_submission_date"
                                        id="serviceother_expense_submission_date" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">

                                <button type="submit" style="width:100px" class="btn btn-success"
                                    id="serviceother_submit" data-bs-target="#" onclick="submitform(id)">
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"
                                    id="serviceother_cancel_add" data-bs-target="#" onclick="cancleAddForm(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>


                                <button type="button" style="display:none" class="btn btn-success"
                                    id="serviceother_update" data-bs-target="#" onclick="updateJob(id)">
                                    <i class="fa fa-save"></i> Update
                                </button>

                                <button type="button" style="display:none" class="btn btn-danger"
                                    id="serviceother_cancel" data-bs-target="#" onclick="cancleUpdate(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <!-- <input type="hidden" name="service_type" id="service_type">
                                    <input type="hidden" name="service_reccode" id="service_reccode"> -->
                            </div>
                        </div>
                    </form>


                    <div class="d-flex col">
                        <button type="button" style="width:100px" class="btn btn-success mb-4" id="serviceother_add"
                            data-bs-target="#" onclick="showForm(id)">
                            <i class="fa fa-plus-square"></i> Add
                        </button>
                        <div class="d-flex col justify-content-end">
                            <div class="d-flex justify-content-between col-xl-5">
                                <div class="d-flex col-6">
                                    <button type="button" class="btn btn-info mb-4 col-6"
                                        id="serviceother_copyFromWorksheet" data-bs-target="#"
                                        onclick="copyJobsFromWorksheet(id)">
                                        <i class="fa fa-copy"></i> Copy from worksheet
                                    </button>
                                </div>
                                <div class="d-flex col-6">
                                    <input type="number" name="rows" id="utilities_rows" class="form-control col mr-2"
                                        placeholder="Number of rows">
                                    <button type="button" style="width:100px" class="btn btn-info mb-4"
                                        id="serviceother_copy" data-bs-target="#" onclick="copyJobs(id)">
                                        <i class="fa fa-copy"></i> Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table id="serviceother_table" class="table table-striped display nowrap" style="width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" width="20%"></th>
                                    <th scope="col"></th>
                                    <th scope="col" width="10%">line status</th>
                                    <th scope="col" width="15%">Service Other ID</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Description(Contract)</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Sub1</th>
                                    <th scope="col">Sub2</th>
                                    <th scope="col">Sub3</th>
                                    <th scope="col">Sub4</th>
                                    <th scope="col">Sub5</th>
                                    <th scope="col">Sub6</th>
                                    <th scope="col">Vehicle</th>
                                    <th scope="col">Operator</th>
                                    <th scope="col">Operator Name</th>
                                    <th scope="col">Charge as</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Diesel Rate</th>
                                    <th scope="col">From</th>
                                    <th scope="col">to</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col" width="5%">Qty</th>
                                    <th scope="col" width="10%">UOM</th>
                                    <th scope="col" width="15%">Contract number (Manual)</th>
                                    <th scope="col" width="15%">Contract number (Auto)</th>
                                    <th scope="col">Department </th>
                                    <th scope="col">Cost center</th>
                                    <th scope="col">Amount </th>
                                    <th scope="col">Charge(%) </th>
                                    <th scope="col">No charge</th>
                                    <th scope="col">Reimbursment</th>
                                    <th scope="col">Lump sum charge</th>
                                    <th scope="col">Vendor invoice Date</th>
                                    <th scope="col">Vendor invoice number</th>
                                    <th scope="col">Vendor invoice Value</th>
                                    <th scope="col">Vendor invoice Submission date</th>
                                    <th scope="col" style="width: 15%;">Reference 1</th>
                                    <th scope="col" style="width: 15%;">Reference 2</th>
                                    <th scope="col" style="width: 15%;">Reference 3</th>
                                    <th scope="col" style="width: 15%;">Reference 4</th>
                                    <th scope="col" style="width: 15%;">Reference 5</th>
                                    <th scope="col" style="width: 15%;">Reference 6</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="immigration-tab">
                    <br>
                    <form id="immigration_data">
                        <div id="immigration_edit_area">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Immigration ID</span>
                                        <input type="text" name="immigration_id" id="immigration_id"
                                            class="form-control" required readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Name</span><span style="color:red"> *</span>
                                        <select name="name" id="immigration_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, IM FROM FES.dbo.barcode_service where IM = 1 ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="branch" id="immigration_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, IM FROM FES.dbo.barcode_branch where IM = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code_branch']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <select name="location" id="immigration_location" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name, IM FROM FES.dbo.barcode_location where IM = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="barcode_type" id="immigration_barcode_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name, RN FROM FES.dbo.barcode_product_type where IM = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red"> *</span>
                                        <select name="type1" id="immigration_type1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1 FROM FES.dbo.barcode_sub_type1 where IM = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red"> *</span>
                                        <select name="type2" id="immigration_type2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2 FROM FES.dbo.barcode_sub_type2 where IM = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red"> *</span>
                                        <select name="type3" id="immigration_type3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3 FROM FES.dbo.barcode_sub_type3 where IM = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red"> *</span>
                                        <select name="type4" id="immigration_type4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4  FROM FES.dbo.barcode_sub_type4 where IM = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type5" id="immigration_type5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5 FROM FES.dbo.barcode_sub_type5 where IM = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type6" id="immigration_type6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6 FROM FES.dbo.barcode_sub_type6 where IM = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="immigration_quantity" id="immigration_quantity"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="immigration_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where IM = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>



                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Agreement No.</span><span style="color:red"> *</span>
                                        <select type="text" name="immigration_agreement_number"
                                            id="immigration_agreement_number" class="form-control"
                                            onchange="changeContract(id)"></select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Description </span>
                                        <select name="contract_description" id="immigration_contract_description"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContractDes(id)"></select>

                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" id="immigration_department" name="immigration_department"
                                            class="form-control" value="<?php echo $_SESSION["department"]; ?>" required
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" id="immigration_cost_center" name="immigration_cost_center"
                                            class="form-control" value="<?php echo $_SESSION["cost_center"]; ?>"
                                            required readonly>
                                    </div>
                                </div>

                                <div class="col-2 ">
                                    <div class="form-group">
                                        <span>Line status</span>
                                        <select name="immigration_line_status" id="immigration_line_status"
                                            class="form-control" aria-describedby="inputGroupPrepend2" readonly
                                            required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="immigration_cancel_reason" id="immigration_cancel_reason"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>





                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Service</span><span style="color:red"> *</span>
                                        <select name="immigration_service" id="immigration_service" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Expat name</span><span style="color:red"> *</span>
                                        <input type="text" name="immigration_expat_name" id="immigration_expat_name"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Description</span><span style="color:red"> *</span>
                                        <input type="text" name="immigration_description" id="immigration_description"
                                            class="form-control">
                                    </div>
                                </div>

                            </div>



                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="immigration_start_date" id="immigration_start_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="immigration_start_time" id="immigration_start_time"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="immigration_end_date" id="immigration_end_date"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>End Time</span><span style="color:red"> *</span>
                                        <input type="time" name="immigration_end_time" id="immigration_end_time"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Charge as</span><span style="color:red"> *</span>
                                        <select id="immigration_charge_as" name="immigration_charge_as"
                                            class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount (฿)</span><span style="color:red"> *</span>
                                        <input type="text" name="immigration_amount" id="immigration_amount"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>No charge</span>
                                        <input type="checkbox" value="1" id="immigration_no_charge"
                                            name="immigration_no_charge" class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Reimbursment</span>
                                        <input type="checkbox" value="1" id="immigration_reimbursment"
                                            name="immigration_reimbursment" class="form-check">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Remark</span>
                                        <input type="text" name="immigration_remark" id="immigration_remark"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-12 mb-5">
                                    <hr />
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 1</span>
                                        <input type="text" name="immigration_ref1" id="immigration_ref1"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 2</span>
                                        <input type="text" name="immigration_ref2" id="immigration_ref2"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 3</span>
                                        <input type="text" name="immigration_ref3" id="immigration_ref3"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 4</span>
                                        <input type="text" name="immigration_ref4" id="immigration_ref4"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 5</span>
                                        <input type="text" name="immigration_ref5" id="immigration_ref5"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 6</span>
                                        <input type="text" name="immigration_ref6" id="immigration_ref6"
                                            class="form-control">
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="d-flex col-12">
                                <div class="col-7">
                                    <button type="button" style="width:100px" class="btn btn-success"
                                        id="immigration_add" data-bs-target="#">
                                        <i class="fa fa-plus-square"></i> Add
                                    </button>

                                    <button type="submit" style="width:100px" class="btn btn-success"
                                        id="immigration_submit" data-bs-target="#">
                                        <i class="fa fa-save"></i> Save
                                    </button>

                                    <button type="button" style="width:100px" class="btn btn-danger"
                                        id="immigration_cancel" data-bs-target="#">
                                        <i class="fa fa-minus-square"></i> Cancel
                                    </button>

                                    <input type="hidden" name="immigration_type" id="immigration_type">
                                    <input type="hidden" name="immigration_reccode" id="immigration_reccode">

                                </div>
                                <div class="d-flex col-5 justify-content-end">
                                    <div class="d-flex justify-content-between col">
                                        <div class="d-flex col-6">
                                            <button type="button" class="btn btn-info mb-4 col-6"
                                                id="warehousing_copyFromWorksheet" data-bs-target="#"
                                                onclick="copyJobsFromWorksheet(id)">
                                                <i class="fa fa-copy"></i> Copy from worksheet
                                            </button>
                                        </div>
                                        <div class="d-flex col-6">
                                            <input type="number" name="rows" id="warehousing_rows"
                                                class="form-control col mr-2" placeholder="Number of rows">
                                            <button type="button" style="width:100px" class="btn btn-info mb-4"
                                                id="warehousing_copy" data-bs-target="#" onclick="copyJobs(id)">
                                                <i class="fa fa-copy"></i> Copy
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <table id="immigration_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="20%"></th>
                                <th scope="col" width="15%">Immigration ID</th>
                                <th scope="col" width="10%">Start Date</th>
                                <th scope="col" width="10%">Start Time</th>
                                <th scope="col" width="5%">Qty</th>
                                <th scope="col" width="10%">UOM</th>
                                <th scope="col" width="15%">Remark</th>
                                <th scope="col" width="10%">line status</th>
                                <!-- <th scope="col" width="10%">Barcode</th> -->
                                <th scope="col" width="10%">sub1</th>
                                <th scope="col" width="10%">sub2</th>
                                <th scope="col" width="10%">sub3</th>
                                <th scope="col" width="10%">sub4</th>
                                <th scope="col" width="10%">sub5</th>
                                <th scope="col" width="10%">sub6</th>
                                <th scope="col" style="width: 15%;">Reference 1</th>
                                <th scope="col" style="width: 15%;">Reference 2</th>
                                <th scope="col" style="width: 15%;">Reference 3</th>
                                <th scope="col" style="width: 15%;">Reference 4</th>
                                <th scope="col" style="width: 15%;">Reference 5</th>
                                <th scope="col" style="width: 15%;">Reference 6</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>

                <div class="tab-pane fade" id="taxi-tab">
                    <br>
                    <form id="taxi_data">
                        <div id="taxi_edit_area">
                            <div class="row">

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Service ID</span>
                                        <input type="text" name="taxi_service_id" id="taxi_service_id"
                                            class="form-control" required readonly>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Name</span><span style="color:red"> *</span>
                                        <select name="name" id="taxi_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, PT FROM FES.dbo.barcode_service where PT = 1 ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="branch" id="taxi_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, PT FROM FES.dbo.barcode_branch where PT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code_branch']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <select name="location" id="taxi_location" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name, PT FROM FES.dbo.barcode_location where PT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="barcode_type" id="taxi_barcode_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name, RN FROM FES.dbo.barcode_product_type where PT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red"> *</span>
                                        <select name="type1" id="taxi_type1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1 FROM FES.dbo.barcode_sub_type1 where PT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red"> *</span>
                                        <select name="type2" id="taxi_type2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2 FROM FES.dbo.barcode_sub_type2 where PT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red"> *</span>
                                        <select name="type3" id="taxi_type3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3 FROM FES.dbo.barcode_sub_type3 where PT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red"> *</span>
                                        <select name="type4" id="taxi_type4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4  FROM FES.dbo.barcode_sub_type4 where PT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type5" id="taxi_type5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5 FROM FES.dbo.barcode_sub_type5 where PT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type6" id="taxi_type6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6 FROM FES.dbo.barcode_sub_type6 where PT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="taxi_quantity" id="taxi_quantity"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="taxi_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where PT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Number</span><span style="color:red"> *</span>
                                        <select id="taxi_contract_number" name="taxi_contract_number"
                                            class="form-control" onchange="changeContract(id)">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Drescription</span>
                                        <select name="taxi_contract_description" id="taxi_contract_description"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContractDes(id)"></select>

                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" id="taxi_department" name="taxi_department"
                                            class="form-control" value="<?php echo $_SESSION["department"]; ?>" required
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" id="taxi_cost_center" name="taxi_cost_center"
                                            class="form-control" value="<?php echo $_SESSION["cost_center"]; ?>"
                                            required readonly>
                                    </div>
                                </div>

                                <div class="col-2 ">
                                    <div class="form-group">
                                        <span>Status</span>
                                        <select name="taxi_line_status" id="taxi_line_status" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="taxi_cancel_reason" id="taxi_cancel_reason" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Vehicle</span><span style="color:red"> *</span>
                                        <select name="taxi_vehicle" id="taxi_vehicle" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT vehicle_id, vehicle_type, b.description as vehicle_owner, registration_no, branch FROM vehicle left join vehicle_owner b on b.code = vehicle_owner where category = 'Vehicles' and block = 0 order by registration_no ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['vehicle_id']; ?>">
                                                    <?php echo $row['registration_no'] . ' | ' . $row['vehicle_type'] . ' | ' . $row['vehicle_owner'] . ' | ' . $row['branch']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Vehicle type</span><span style="color:red"> *</span>
                                        <select name="vehicle_type" id="taxi_vehicle_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_vehicle_type = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_vehicle_type, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Operator</span><span style="color:red"> *</span>
                                        <select name="taxi_operator" id="taxi_operator" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT o.operator_id, o.name, o.lastname, p.description, o.branch FROM operator o left join position p on p.code = o.position where o.operator = 1 and o.block = 0 order by o.name, o.lastname ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['operator_id']; ?>">
                                                    <?php echo $row['name'] . "  " . $row['lastname'] . ' | ' . $row['description'] . ' | ' . $row['branch']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Contact person</span><span style="color:red"> *</span>
                                        <input type="text" name="taxi_contact" id="taxi_contact" class="form-control"
                                            required>
                                    </div>

                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Remark</span>
                                        <input type="text" name="taxi_remark" id="taxi_remark" class="form-control">
                                    </div>
                                </div>



                                <div class="col-3">
                                    <div class="form-group">
                                        <span>From</span><span style="color:red"> *</span>
                                        <select name="taxi_from" id="taxi_from" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Specific location (from)</span><span style="color:red"> *</span>
                                        <input type="text" name="taxi_specific_location_from"
                                            id="taxi_specific_location_from" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>To</span><span style="color:red"> *</span>
                                        <select name="taxi_to" id="taxi_to" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Specific location (to)</span><span style="color:red"> *</span>
                                        <input type="text" name="taxi_specific_location_to"
                                            id="taxi_specific_location_to" class="form-control" required>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="taxi_start_date" id="taxi_start_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="taxi_start_time" id="taxi_start_time"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="taxi_end_date" id="taxi_end_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>End Time</span><span style="color:red"> *</span>
                                        <input type="time" name="taxi_end_time" id="taxi_end_time" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Diesel Rate (฿)</span><span style="color:red"> *</span>
                                        <input type="text" name="taxi_diesel_rate" id="taxi_diesel_rate"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>No charge</span>
                                        <input type="checkbox" value="1" id="taxi_no_charge" name="taxi_no_charge"
                                            class="form-check">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Charge as</span><span style="color:red"> *</span>
                                        <select id="taxi_charge_as" name="taxi_charge_as" class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount (฿)</span><span style="color:red"> *</span>
                                        <input type="text" name="taxi_amont_system" id="taxi_amont_system"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Outsource charge as</span><span style="color:red"> *</span>
                                        <select id="taxi_outsource_charge_as" name="taxi_outsource_charge_as"
                                            class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Reason for outsource</span>
                                        <select name="taxi_outsource_reason" id="taxi_outsource_reason"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM outsource_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Started mileage</span>
                                        <input type="number" name="taxi_mileage_start" id="taxi_mileage_start"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Finished mileage</span>
                                        <input type="number" name="taxi_mileage_end" id="taxi_mileage_end"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <hr />
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 1</span>
                                        <input type="text" name="taxi_ref1" id="taxi_ref1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 2</span>
                                        <input type="text" name="taxi_ref2" id="taxi_ref2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 3</span>
                                        <input type="text" name="taxi_ref3" id="taxi_ref3" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 4</span>
                                        <input type="text" name="taxi_ref4" id="taxi_ref4" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 5</span>
                                        <input type="text" name="taxi_ref5" id="taxi_ref5" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 6</span>
                                        <input type="text" name="taxi_ref6" id="taxi_ref6" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">


                            <div class="d-flex col-12">
                                <div class="col-7">
                                    <button type="button" style="width:100px" class="btn btn-success" id="taxi_add"
                                        data-bs-target="#">
                                        <i class="fa fa-plus-square"></i> Add
                                    </button>

                                    <button type="submit" style="width:100px" class="btn btn-success" id="taxi_submit"
                                        data-bs-target="#">
                                        <i class="fa fa-save"></i> Save
                                    </button>

                                    <button type="button" style="width:100px" class="btn btn-danger" id="taxi_cancel"
                                        data-bs-target="#">
                                        <i class="fa fa-minus-square"></i> Cancel
                                    </button>

                                    <input type="hidden" name="taxi_type" id="taxi_type">
                                    <input type="hidden" name="taxi_reccode" id="taxi_reccode">

                                </div>
                                <div class="d-flex col-5 justify-content-end">
                                    <div class="d-flex justify-content-between col">
                                        <div class="d-flex col-6">
                                            <button type="button" class="btn btn-info mb-4 col-6"
                                                id="taxi_copyFromWorksheet" data-bs-target="#"
                                                onclick="copyJobsFromWorksheet(id)">
                                                <i class="fa fa-copy"></i> Copy from worksheet
                                            </button>
                                        </div>
                                        <div class="d-flex col-6">
                                            <input type="number" name="rows" id="taxi_rows"
                                                class="form-control col mr-2" placeholder="Number of rows">
                                            <button type="button" style="width:100px" class="btn btn-info mb-4"
                                                id="taxi_copy" data-bs-target="#" onclick="copyJobs(id)">
                                                <i class="fa fa-copy"></i> Copy
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <table id="taxi_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="20%"></th>
                                <th scope="col" width="15%">Service ID</th>
                                <th scope="col" width="10%">Start Date</th>
                                <th scope="col" width="5%">Qty</th>
                                <th scope="col" width="10%">UOM</th>
                                <th scope="col" width="15%">Remark</th>
                                <th scope="col" width="10%">line status</th>
                                <th scope="col" width="10%">Barcode</th>
                                <th scope="col" style="width: 15%;">Reference 1</th>
                                <th scope="col" style="width: 15%;">Reference 2</th>
                                <th scope="col" style="width: 15%;">Reference 3</th>
                                <th scope="col" style="width: 15%;">Reference 4</th>
                                <th scope="col" style="width: 15%;">Reference 5</th>
                                <th scope="col" style="width: 15%;">Reference 6</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>



                <!-- Phase 2 -->
                <div class="tab-pane fade" id="warehousing-tab">
                    <form id="warehousing_data" class="mb-4">
                        <div id="warehousing_data_area">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Warehousing ID</span>
                                        <input type="text" name="warehousing_space_rental_id"
                                            id="warehousing_space_rental_id" class="form-control" required readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <!-- barcode_service  -->
                                        <span>Name</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="name" id="warehousing_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, [group] FROM FES.dbo.barcode_service where [group] = 'WH'";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="branch" id="warehousing_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, SO FROM FES.dbo.barcode_branch where WH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code_branch']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="location" id="warehousing_location" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name, WH FROM FES.dbo.barcode_location where WH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option id="<?php echo $row['location_name'] ?>"
                                                    value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type" id="warehousing_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name, WH FROM FES.dbo.barcode_product_type where WH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub1" id="warehousing_sub1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1, WH FROM FES.dbo.barcode_sub_type1 where WH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub2" id="warehousing_sub2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2, WH FROM FES.dbo.barcode_sub_type2 where WH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub3" id="warehousing_sub3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3, WH FROM FES.dbo.barcode_sub_type3 where WH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub4" id="warehousing_sub4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4, WH FROM FES.dbo.barcode_sub_type4 where WH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub5" id="warehousing_sub5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5, WH FROM FES.dbo.barcode_sub_type5 where WH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub6" id="warehousing_sub6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6, WH FROM FES.dbo.barcode_sub_type6 where WH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="qty" id="warehousing_qty"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="warehousing_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where WH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Number</span><span style="color:red"> *</span>
                                        <select name="contract_number" id="warehousing_contract_number"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContract(id)"></select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Description</span>
                                        <select name="contract_description" id="warehousing_contract_description"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContractDes(id)"></select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" name="department" id="warehousing_department"
                                            class="form-control" value="<?php echo $_SESSION["department"]; ?>"  readonly required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" name="cost_center" id="warehousing_cost_center"
                                            class="form-control" value="<?php echo $_SESSION["cost_center"]; ?>"  readonly required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Status</span>
                                        <select name="status" id="warehousing_status" class="form-control"
                                            aria-describedby="inputGroupPrepend2" readonly required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 ">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="cancel_reason" id="warehousing_cancel_reason" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Description</span><span style="color:red"> *</span>
                                        <input type="text" name="description" id="warehousing_description"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Remark</span>
                                        <input type="text" name="remark" id="warehousing_remark" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="start_date" id="warehousing_start_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="end_date" id="warehousing_end_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Charge as</span><span style="color:red"> *</span>
                                        <select id="warehousing_charge_as" name="charge_as" class="form-control"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount (฿)</span><span style="color:red"> *</span>
                                        <input type="text" name="amount" id="warehousing_amount" class="form-control"
                                            value="" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Charge(%)</span><span style="color:red"> *</span>
                                        <input type="text" name="charge" id="warehousing_charge" class="form-control"
                                            value="100" required>
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Fixed Space</span>
                                        <input type="checkbox" value="1" id="warehousing_fix_space" name="fix_space"
                                            class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">No charge</span>
                                        <input type="checkbox" value="1" id="warehousing_no_charge" name="no_charge"
                                            class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Reimbursment</span>
                                        <input type="checkbox" value="1" id="warehousing_reimbursment"
                                            name="reimbursment" class="form-check">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Lump-sum charge</span>
                                        <input type="checkbox" value="1" id="warehousing_lump_sum_charge"
                                            name="lump_sum_charge" class="form-check">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-12 mb-4">
                                <hr />
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Vendor invoice Date</span>
                                    <input type="date" name="vendor_invoice_date" id="warehousing_vendor_invoice_date"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <span>Vendor invoice number</span>
                                    <input type="text" name="vendor_invoice_number"
                                        id="warehousing_vendor_invoice_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <span>Vendor invoice Submission date</span>
                                    <input type="date" name="vendor_invoice_submission_date"
                                        id="warehousing_invoice_submission_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <span>Vendor invoice Value </span>
                                    <input type="text" name="vendor_invoice_value" id="warehousing_vendor_invoice_value"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Vendor invoice Due date</span>
                                    <input type="date" name="vendor_invoice_due_date"
                                        id="warehousing_vendor_invoice_due_date" class="form-control">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Expense Submission date</span>
                                    <input type="date" name="expense_submission_date"
                                        id="warehousing_expense_submission_date" class="form-control">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12 mb-4">
                                <hr />
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <span>Reference 1</span>
                                    <input type="text" name="ref1" id="warehousing_ref1" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <span>Reference 2</span>
                                    <input type="text" name="ref2" id="warehousing_ref2" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <span>Reference 3</span>
                                    <input type="text" name="ref3" id="warehousing_ref3" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <span>Reference 4</span>
                                    <input type="text" name="ref4" id="warehousing_ref4" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <span>Reference 5</span>
                                    <input type="text" name="ref5" id="warehousing_ref5" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <span>Reference 6</span>
                                    <input type="text" name="ref6" id="warehousing_ref6" class="form-control">
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-12">


                                <button type="submit" style="width:100px" class="btn btn-success"
                                    id="warehousing_submit" data-bs-target="#" onclick="submitform(id)">
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"
                                    id="warehousing_cancel_add" data-bs-target="#" onclick="cancleAddForm(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>


                                <button type="button" style="display:none" class="btn btn-success"
                                    id="warehousing_update" data-bs-target="#" onclick="updateJob(id)">
                                    <i class="fa fa-save"></i> Update
                                </button>

                                <button type="button" style="display:none" class="btn btn-danger"
                                    id="warehousing_cancel" data-bs-target="#" onclick="cancleUpdate(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <!-- <input type="hidden" name="service_type" id="service_type">
                                <input type="hidden" name="service_reccode" id="service_reccode"> -->

                            </div>
                        </div>
                    </form>
                    <div class="d-flex col">
                        <button type="button" style="width:100px" class="btn btn-success mb-4" id="warehousing_add"
                            data-bs-target="#" onclick="showForm(id)">
                            <i class="fa fa-plus-square"></i> Add
                        </button>
                        <div class="d-flex col justify-content-end">
                            <div class="d-flex justify-content-between col-xl-5">
                                <div class="d-flex col-6">
                                    <button type="button" class="btn btn-info mb-4 col-6"
                                        id="warehousing_copyFromWorksheet" data-bs-target="#"
                                        onclick="copyJobsFromWorksheet(id)">
                                        <i class="fa fa-copy"></i> Copy from worksheet
                                    </button>
                                </div>
                                <div class="d-flex col-6">
                                    <input type="number" name="rows" id="warehousing_rows" class="form-control col mr-2"
                                        placeholder="Number of rows">
                                    <button type="button" style="width:100px" class="btn btn-info mb-4"
                                        id="warehousing_copy" data-bs-target="#" onclick="copyJobs(id)">
                                        <i class="fa fa-copy"></i> Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="warehousing_table" class="table table-striped display nowrap ">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" width="10%"></th>
                                    <th scope="col"></th>
                                    <th scope="col">Line status</th>
                                    <th scope="col" width="10%">Warehousing ID</th>
                                    <th scope="col" width="20%">Description</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Sub1</th>
                                    <th scope="col">Sub2</th>
                                    <th scope="col">Sub3</th>
                                    <th scope="col">Sub4</th>
                                    <th scope="col">Sub5</th>
                                    <th scope="col">Sub6</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">UOM</th>
                                    <th scope="col">Contract Number</th>
                                    <th scope="col">Department </th>
                                    <th scope="col">Cost center</th>
                                    <th scope="col">Amount </th>
                                    <th scope="col">Charge(%) </th>
                                    <th scope="col">Fixed Space</th>
                                    <th scope="col">No charge</th>
                                    <th scope="col">Reimbursment</th>
                                    <th scope="col">Lump sum charge</th>
                                    <th scope="col">Reference 1</th>
                                    <th scope="col">Reference 2</th>
                                    <th scope="col">Reference 3</th>
                                    <th scope="col">Reference 4</th>
                                    <th scope="col">Reference 5</th>
                                    <th scope="col">Reference 6</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>


                </div>

                <div class="tab-pane fade" id="utilities-tab">
                    <form id="utilities_data" class="mb-4">
                        <div id="utilities_data_area">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Utilities ID</span>
                                        <input type="text" name="utilities_id" id="utilities_id" class="form-control"
                                            required readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <!-- barcode_service  -->
                                        <span>Name</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="name" id="utilities_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, [group] FROM FES.dbo.barcode_service where [group] = 'UT'";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="branch" id="utilities_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, SO FROM FES.dbo.barcode_branch where UT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code_branch']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="location" id="utilities_location" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name, UT FROM FES.dbo.barcode_location where UT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option id="<?php echo $row['location_name'] ?>"
                                                    value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type" id="utilities_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name, UT FROM FES.dbo.barcode_product_type where UT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub1" id="utilities_sub1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1, UT FROM FES.dbo.barcode_sub_type1 where UT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub2" id="utilities_sub2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2, UT FROM FES.dbo.barcode_sub_type2 where UT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub3" id="utilities_sub3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3, UT FROM FES.dbo.barcode_sub_type3 where UT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub4" id="utilities_sub4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4, UT FROM FES.dbo.barcode_sub_type4 where UT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub5" id="utilities_sub5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5, WH FROM FES.dbo.barcode_sub_type5 where UT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub6" id="utilities_sub6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6, WH FROM FES.dbo.barcode_sub_type6 where UT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="qty" id="utilities_qty"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="utilities_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where UT = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Number</span><span style="color:red"> *</span>
                                        <select name="contract_number" id="utilities_contract_number"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContract(id)"></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Drescription</span><span style="color:red"> *</span>
                                        <select name="contract_description" id="utilities_contract_description"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContractDes(id)"></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" name="department" id="utilities_department"
                                            class="form-control"  value="<?php echo $_SESSION["department"]; ?>"  readonly required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" id="utilities_cost_center" name="cost_center"
                                            class="form-control"  value="<?php echo $_SESSION["cost_center"]; ?>"  readonly required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Status</span>
                                        <select name="status" id="utilities_status" class="form-control"
                                            aria-describedby="inputGroupPrepend2" readonly required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="cancel_reason" id="utilities_cancel_reason" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Description</span><span style="color:red"> *</span>
                                        <input type="text" name="description" id="utilities_description"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Remark</span>
                                        <input type="text" name="remark" id="utilities_remark" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="start_date" id="utilities_start_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="end_date" id="utilities_end_date" class="form-control"
                                            required>
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Meter record</span>
                                        <input type="text" name="meter_record" id="utilities_meter_record"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Charge as</span><span style="color:red"> *</span>
                                        <select id="utilities_charge_as" name="charge_as" class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount</span><span style="color:red"> *</span>
                                        <input type="text" name="amount" id="utilities_amount" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Charge(%)</span><span style="color:red"> *</span>
                                        <input type="text" name="charge" id="utilities_charge" class="form-control"
                                            value="100" required>
                                    </div>
                                </div>


                                <div class="col-1">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">No Charge</span>
                                        <input type="checkbox" value="1" id="utilities_no_charge" name="no_charge"
                                            class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Reimbursment</span>
                                        <input type="checkbox" value="1" id="utilities_reimbursement"
                                            name="reimbursement" class="form-check">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Lump-sum charge</span>
                                        <input type="checkbox" value="1" id="utilities_lump_sum_charge"
                                            name="lump_sum_charge" class="form-check">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Date</span>
                                        <input type="date" name="vendor_invoice_date" id="utilities_vendor_invoice_date"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice number</span>
                                        <input type="text" name="vendor_invoice_number"
                                            id="utilities_vendor_invoice_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Submission date</span>
                                        <input type="date" name="vendor_invoice_submission_date"
                                            id="utilities_invoice_submission_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Value </span>
                                        <input type="text" name="vendor_invoice_value"
                                            id="utilities_vendor_invoice_value" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Due date</span>
                                        <input type="date" name="vendor_invoice_due_date"
                                            id="utilities_vendor_invoice_due_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Expense Submission date</span>
                                        <input type="date" name="expense_submission_date"
                                            id="utilities_expense_submission_date" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 mb-4">
                                    <hr />
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 1</span>
                                        <input type="text" name="ref1" id="utilities_ref1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 2</span>
                                        <input type="text" name="ref2" id="utilities_ref2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 3</span>
                                        <input type="text" name="ref3" id="utilities_ref3" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 4</span>
                                        <input type="text" name="ref4" id="utilities_ref4" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 5</span>
                                        <input type="text" name="ref5" id="utilities_ref5" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 6</span>
                                        <input type="text" name="ref6" id="utilities_ref6" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">
                                <!-- <button type="button" style="width:100px" class="btn btn-success" id="utilities_add" data-bs-target="#">
                                    <i class="fa fa-plus-square"></i> Add
                                </button> -->



                                <button type="submit" style="width:100px" class="btn btn-success" id="utilities_submit"
                                    data-bs-target="#" onclick="submitform(id)">
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"
                                    id="utilities_cancel_add" data-bs-target="#" onclick="cancleAddForm(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>


                                <button type="button" style="display:none" class="btn btn-success" id="utilities_update"
                                    data-bs-target="#" onclick="updateJob(id)">
                                    <i class="fa fa-save"></i> Update
                                </button>

                                <button type="button" style="display:none" class="btn btn-danger" id="utilities_cancel"
                                    data-bs-target="#" onclick="cancleUpdate(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="d-flex col">
                        <button type="button" style="width:100px" class="btn btn-success mb-4" id="utilities_add"
                            data-bs-target="#" onclick="showForm(id)">
                            <i class="fa fa-plus-square"></i> Add
                        </button>
                        <div class="d-flex col justify-content-end">
                            <div class="d-flex justify-content-between col-xl-5">
                                <div class="d-flex col-6">
                                    <button type="button" class="btn btn-info mb-4 col-6"
                                        id="utilities_copyFromWorksheet" data-bs-target="#"
                                        onclick="copyJobsFromWorksheet(id)">
                                        <i class="fa fa-copy"></i> Copy from worksheet
                                    </button>
                                </div>
                                <div class="d-flex col-6">
                                    <input type="number" name="rows" id="utilities_rows" class="form-control col mr-2"
                                        placeholder="Number of rows">
                                    <button type="button" style="width:100px" class="btn btn-info mb-4"
                                        id="utilities_copy" data-bs-target="#" onclick="copyJobs(id)">
                                        <i class="fa fa-copy"></i> Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table id="utilities_table" class="table table-striped display nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" width="10%"></th>
                                    <th scope="col"></th>
                                    <th scope="col">Line status</th>
                                    <th scope="col" width="10%">Utilities ID</th>
                                    <th scope="col" width="20%">Description</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Sub1</th>
                                    <th scope="col">Sub2</th>
                                    <th scope="col">Sub3</th>
                                    <th scope="col">Sub4</th>
                                    <th scope="col">Sub5</th>
                                    <th scope="col">Sub6</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">UOM</th>
                                    <th scope="col">Contract Number</th>
                                    <th scope="col">Department </th>
                                    <th scope="col">Cost center</th>
                                    <th scope="col">Amount </th>
                                    <th scope="col">Charge(%) </th>
                                    <th scope="col">No charge</th>
                                    <th scope="col">Reimbursement</th>
                                    <th scope="col">Lump sum charge</th>
                                    <th scope="col">Reference 1</th>
                                    <th scope="col">Reference 2</th>
                                    <th scope="col">Reference 3</th>
                                    <th scope="col">Reference 4</th>
                                    <th scope="col">Reference 5</th>
                                    <th scope="col">Reference 6</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="rental-tab">
                    <form id="rental_data" class="mb-4">
                        <div id="rental_data_area">
                            <div class="row">

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Rental (Vehicles & Heavy Eq.) ID</span>
                                        <input type="text" name="rental_id" id="rental_id" class="form-control" required
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <!-- barcode_service  -->
                                        <span>Name</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="name" id="rental_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, [group] FROM FES.dbo.barcode_service where [group] = 'RN'";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="branch" id="rental_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, SO FROM FES.dbo.barcode_branch where RN = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code_branch']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="location" id="rental_location" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name, UT FROM FES.dbo.barcode_location where RN = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option id="<?php echo $row['location_name'] ?>"
                                                    value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type" id="rental_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name, RN FROM FES.dbo.barcode_product_type where RN = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub1" id="rental_sub1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1, RN FROM FES.dbo.barcode_sub_type1 where RN = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub2" id="rental_sub2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2, RN FROM FES.dbo.barcode_sub_type2 where RN = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub3" id="rental_sub3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3, RN FROM FES.dbo.barcode_sub_type3 where RN = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub4" id="rental_sub4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4, RN FROM FES.dbo.barcode_sub_type4 where RN = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub5" id="rental_sub5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5, RN FROM FES.dbo.barcode_sub_type5 where RN = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub6" id="rental_sub6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6, RN FROM FES.dbo.barcode_sub_type6 where RN = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="qty" id="rental_qty"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="rental_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where RN = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Number</span><span style="color:red"> *</span>
                                        <select name="contract_number" id="rental_contract_number" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContract(id)"></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Drescription</span><span style="color:red"> *</span>

                                        <select name="contract_description" id="rental_contract_description"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContractDes(id)"></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" name="department" id="rental_department" class="form-control"
                                            readonly required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" id="rental_cost_center" name="cost_center"
                                            class="form-control" readonly required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Line Status</span>
                                        <select name="status" id="rental_status" class="form-control"
                                            aria-describedby="inputGroupPrepend2" readonly required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="cancel_reason" id="rental_cancel_reason" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Description</span><span style="color:red"> *</span>
                                        <input type="text" name="description" id="rental_description"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Remark</span>
                                        <input type="text" name="remark" id="rental_remark" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Vehicle / Equipment</span><span style="color:red"> *</span>
                                        <select name="vehicle" id="rental_vehicle" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT vehicle_id, vehicle_type, b.description as vehicle_owner, registration_no, branch FROM vehicle left join vehicle_owner b on b.code = vehicle_owner where category = 'Vehicles' and block = 0 order by registration_no ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['vehicle_id']; ?>">
                                                    <?php echo $row['registration_no'] . ' | ' . $row['vehicle_type'] . ' | ' . $row['vehicle_owner']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Vehicle type</span><span style="color:red"> *</span>
                                        <select name="vehicle_type" id="rental_vehicle_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_vehicle_type = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_vehicle_type, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Charge as</span><span style="color:red"> *</span>
                                        <select id="rental_charge_as" name="charge_as" class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="start_date" id="rental_start_date" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="start_time" id="rental_start_time" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="end_date" id="rental_end_date" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Time</span><span style="color:red"> *</span>
                                        <input type="time" name="end_time" id="rental_end_time" class="form-control"
                                            required>
                                    </div>
                                </div>


                                <div class="col-1">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">No Charge</span>
                                        <input type="checkbox" value="1" id="rental_no_charge" name="no_charge"
                                            class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Reimbursment</span>
                                        <input type="checkbox" value="1" id="rental_reimbursement" name="reimbursement"
                                            class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Lump-sum charge</span>
                                        <input type="checkbox" value="1" id="rental_lump_sum_charge"
                                            name="lump_sum_charge" class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Replacement</span>
                                        <input type="checkbox" value="1" id="rental_replacement" name="replacement"
                                            class="form-check">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount</span><span style="color:red"> *</span>
                                        <input type="text" name="amount" id="rental_amount" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Charge(%)</span><span style="color:red"> *</span>
                                        <input type="text" name="charge" id="rental_charge" class="form-control"
                                            value="100" required>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Date</span>
                                        <input type="date" name="vendor_invoice_date" id="rental_vendor_invoice_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice number</span>
                                        <input type="text" name="vendor_invoice_number"
                                            id="rental_vendor_invoice_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Submission date</span>
                                        <input type="date" name="vendor_invoice_submission_date"
                                            id="rental_vendor_invoice_submission_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Value </span>
                                        <input type="text" name="vendor_invoice_value" id="rental_vendor_invoice_value"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Due date</span>
                                        <input type="date" name="vendor_invoice_due_date"
                                            id="rental_vendor_invoice_due_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Expense Submission date</span>
                                        <input type="date" name="expense_submission_date"
                                            id="rental_expense_submission_date" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-5">
                                <hr />
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 1</span>
                                        <input type="text" name="ref1" id="rental_ref1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 2</span>
                                        <input type="text" name="ref2" id="rental_ref2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 3</span>
                                        <input type="text" name="ref3" id="rental_ref3" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 4</span>
                                        <input type="text" name="ref4" id="rental_ref4" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 5</span>
                                        <input type="text" name="ref5" id="rental_ref5" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 6</span>
                                        <input type="text" name="ref6" id="rental_ref6" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">
                                <!-- <button type="button" style="width:100px" class="btn btn-success" id="utilities_add" data-bs-target="#">
                                    <i class="fa fa-plus-square"></i> Add
                                </button> -->



                                <button type="submit" style="width:100px" class="btn btn-success" id="rental_submit"
                                    data-bs-target="#" onclick="submitform(id)">
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger" id="rental_cancel_add"
                                    data-bs-target="#" onclick="cancleAddForm(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>


                                <button type="button" style="display:none" class="btn btn-success" id="rental_update"
                                    data-bs-target="#" onclick="updateJob(id)">
                                    <i class="fa fa-save"></i> Update
                                </button>

                                <button type="button" style="display:none" class="btn btn-danger" id="rental_cancel"
                                    data-bs-target="#" onclick="cancleUpdate(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="d-flex col">
                        <button type="button" style="width:100px" class="btn btn-success mb-4" id="rental_add"
                            data-bs-target="#" onclick="showForm(id)">
                            <i class="fa fa-plus-square"></i> Add
                        </button>
                        <div class="d-flex col justify-content-end">
                            <div class="d-flex justify-content-between col-xl-5">
                                <div class="d-flex col-6">
                                    <button type="button" class="btn btn-info mb-4 col-6" id="rental_copyFromWorksheet"
                                        data-bs-target="#" onclick="copyJobsFromWorksheet(id)">
                                        <i class="fa fa-copy"></i> Copy from worksheet
                                    </button>
                                </div>
                                <div class="d-flex col-6">
                                    <input type="number" name="rows" id="utilities_rows" class="form-control col mr-2"
                                        placeholder="Number of rows">
                                    <button type="button" style="width:100px" class="btn btn-info mb-4" id="rental_copy"
                                        data-bs-target="#" onclick="copyJobs(id)">
                                        <i class="fa fa-copy"></i> Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="rental_table" class="table table-striped display nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" width="10%"></th>
                                    <th scope="col"></th>
                                    <th scope="col">Line status</th>
                                    <th scope="col" width="10%">Rental ID</th>
                                    <th scope="col" width="20%">Description</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Vehicles/Equipment ID</th>
                                    <th scope="col">Charge as</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Sub1</th>
                                    <th scope="col">Sub2</th>
                                    <th scope="col">Sub3</th>
                                    <th scope="col">Sub4</th>
                                    <th scope="col">Sub5</th>
                                    <th scope="col">Sub6</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">UOM</th>
                                    <th scope="col">Contract Number</th>
                                    <th scope="col">Amount </th>
                                    <th scope="col">Charge(%) </th>
                                    <th scope="col">Department </th>
                                    <th scope="col">Cost center</th>
                                    <th scope="col">No charge</th>
                                    <th scope="col">Reimbursement</th>
                                    <th scope="col">Lump sum charge</th>
                                    <th scope="col">Replacement</th>
                                    <th scope="col">Vendor invoice Date</th>
                                    <th scope="col">Vendor invoice number</th>
                                    <th scope="col">Vendor invoice Submission date</th>
                                    <th scope="col">Vendor invoice Value</th>
                                    <th scope="col">Vendor invoice Due date</th>
                                    <th scope="col">Reference 1</th>
                                    <th scope="col">Reference 2</th>
                                    <th scope="col">Reference 3</th>
                                    <th scope="col">Reference 4</th>
                                    <th scope="col">Reference 5</th>
                                    <th scope="col">Reference 6</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="hotelbooking-tab">
                    <form id="hotelbooking_data" class="mb-4">
                        <div id="hotelbooking_data_area">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Hotel Booking ID</span>
                                        <input type="text" name="hotelbooking_id" id="hotelbooking_id"
                                            class="form-control" required readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <!-- barcode_service  -->
                                        <span>Name</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="name" id="hotelbooking_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, [group] FROM FES.dbo.barcode_service where [group] = 'BS'";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="branch" id="hotelbooking_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, SO FROM FES.dbo.barcode_branch where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code_branch']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="location" id="hotelbooking_location" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name, BS FROM FES.dbo.barcode_location where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option id="<?php echo $row['location_name'] ?>"
                                                    value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type" id="hotelbooking_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name, BS FROM FES.dbo.barcode_product_type where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub1" id="hotelbooking_sub1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1, BS FROM FES.dbo.barcode_sub_type1 where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub2" id="hotelbooking_sub2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2, BS FROM FES.dbo.barcode_sub_type2 where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub3" id="hotelbooking_sub3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3, BS FROM FES.dbo.barcode_sub_type3 where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub4" id="hotelbooking_sub4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4, BS FROM FES.dbo.barcode_sub_type4 where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub5" id="hotelbooking_sub5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5, BS FROM FES.dbo.barcode_sub_type5 where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub6" id="hotelbooking_sub6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6, BS FROM FES.dbo.barcode_sub_type6 where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="qty" id="hotelbooking_qty"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="hotelbooking_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Number</span><span style="color:red"> *</span>
                                        <select name="contract_number" id="hotelbooking_contract_number"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContract(id)"></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Drescription</span><span style="color:red"> *</span>

                                        <select name="contract_description" id="hotelbooking_contract_description"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContractDes(id)"></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" name="department" id="hotelbooking_department"
                                            class="form-control" readonly required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" id="hotelbooking_cost_center" name="cost_center"
                                            class="form-control" readonly required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Status</span>
                                        <select name="status" id="hotelbooking_status" class="form-control"
                                            aria-describedby="inputGroupPrepend2" readonly required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="cancel_reason" id="hotelbooking_cancel_reason"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>



                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Description</span><span style="color:red"> *</span>
                                        <input type="text" name="description" id="hotelbooking_description"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <!-- barcode_service  -->
                                        <span>Hotel Name</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle
                                        ?>
                                        <select name="hotel_name" id="hotelbooking_hotel_name" class="form-control"
                                            onchange="changeHotel(id)" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM FES.dbo.hotel";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['hotel_id']; ?>">
                                                    <?php echo $row['hotel_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Occupant</span>
                                        <input type="text" name="occupant" id="hotelbooking_occupant"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Check in Date</span><span style="color:red"> *</span>
                                        <input type="date" name="checkin_date" id="hotelbooking_checkin_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Check out Date</span><span style="color:red"> *</span>
                                        <input type="date" name="checkout_date" id="hotelbooking_checkout_date"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Meal included</span>
                                        <input type="checkbox" value="1" id="hotelbooking_meal_included"
                                            name="meal_included" class="form-check">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Laundry included</span>
                                        <input type="checkbox" value="1" id="hotelbooking_laundry_included"
                                            name="laundry_included" class="form-check">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Remark</span>
                                        <input type="text" name="remark" id="hotelbooking_remark" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Charge as</span><span style="color:red"> *</span>
                                        <select id="hotelbooking_charge_as" name="charge_as" class="form-control"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount</span><span style="color:red"> *</span>
                                        <input type="text" name="amount" id="hotelbooking_amount" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Charge(%)</span><span style="color:red"> *</span>
                                        <input type="text" name="charge" id="hotelbooking_charge" class="form-control"
                                            value="100" required>
                                    </div>
                                </div>



                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount (system price per unit)</span><span style="color:red"> *</span>
                                        <input type="text" name="amount_system_price"
                                            id="hotelbooking_amount_system_price" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">No Charge</span>
                                        <input type="checkbox" value="1" id="hotelbooking_no_charge" name="no_charge"
                                            class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Reimbursment</span>
                                        <input type="checkbox" value="1" id="hotelbooking_reimbursement"
                                            name="reimbursement" class="form-check">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Lump-sum charge</span>
                                        <input type="checkbox" value="1" id="hotelbooking_lump_sum_charge"
                                            name="lump_sum_charge" class="form-check">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Payment method</span>
                                        <select name="payment_method" id="hotelbooking_payment_method"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value="cash">Cash</option>
                                            <option value="creditcard">Credit card</option>
                                            <option value="cheque">Cheque</option>
                                            <option value="banktransfer">Bank transfer</option>
                                            <option value="etc">Etc.</option>

                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="col-2">
                                    <div class="form-group">
                                        <span>IOU/Cheque Date</span>
                                        <input type="date" name="iou_cheque_date" id="hotelbooking_iou_cheque_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>IOU Number</span>
                                        <input type="number" name="iou_number" id="hotelbooking_iou_number"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>IOU/Cheque Amount</span>
                                        <input type="number" name="iou_cheque_amount"
                                            id="hotelbooking_iou_cheque_amount" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Cheque Remark</span>
                                        <input type="text" name="cheque_remark" id="hotelbooking_cheque_remark"
                                            class="form-control" required>
                                    </div>
                                </div> -->

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Date</span>
                                        <input type="date" name="vendor_invoice_date"
                                            id="hotelbooking_vendor_invoice_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice number</span>
                                        <input type="text" name="vendor_invoice_number"
                                            id="hotelbooking_vendor_invoice_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Submission date</span>
                                        <input type="date" name="vendor_invoice_submission_date"
                                            id="hotelbooking_vendor_invoice_submission_date" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Value </span>
                                        <input type="text" name="vendor_invoice_value"
                                            id="hotelbooking_vendor_invoice_value" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Due date</span>
                                        <input type="date" name="vendor_invoice_due_date"
                                            id="hotelbooking_vendor_invoice_due_date" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Expense Submission date</span>
                                        <input type="date" name="expense_submission_date"
                                            id="hotelbooking_expense_submission_date" class="form-control" required>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 mb-4">
                                    <hr />
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 1</span>
                                        <input type="text" name="ref1" id="hotelbooking_ref1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 2</span>
                                        <input type="text" name="ref2" id="hotelbooking_ref2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 3</span>
                                        <input type="text" name="ref3" id="hotelbooking_ref3" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 4</span>
                                        <input type="text" name="ref4" id="hotelbooking_ref4" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 5</span>
                                        <input type="text" name="ref5" id="hotelbooking_ref5" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 6</span>
                                        <input type="text" name="ref6" id="hotelbooking_ref6" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">

                                <button type="submit" style="width:100px" class="btn btn-success"
                                    id="hotelbooking_submit" data-bs-target="#" onclick="submitform(id)">
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"
                                    id="hotelbooking_cancel_add" data-bs-target="#" onclick="cancleAddForm(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>


                                <button type="button" style="display:none" class="btn btn-success"
                                    id="hotelbooking_update" data-bs-target="#" onclick="updateJob(id)">
                                    <i class="fa fa-save"></i> Update
                                </button>

                                <button type="button" style="display:none" class="btn btn-danger"
                                    id="hotelbooking_cancel" data-bs-target="#" onclick="cancleUpdate(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="d-flex col">
                        <button type="button" style="width:100px" class="btn btn-success mb-4" id="hotelbooking_add"
                            data-bs-target="#" onclick="showForm(id)">
                            <i class="fa fa-plus-square"></i> Add
                        </button>
                        <div class="d-flex col justify-content-end">
                            <div class="d-flex justify-content-between col-xl-5">
                                <div class="d-flex col-6">
                                    <button type="button" class="btn btn-info mb-4 col-6"
                                        id="hotelbooking_copyFromWorksheet" data-bs-target="#"
                                        onclick="copyJobsFromWorksheet(id)">
                                        <i class="fa fa-copy"></i> Copy from worksheet
                                    </button>
                                </div>
                                <div class="d-flex col-6">
                                    <input type="number" name="rows" id="utilities_rows" class="form-control col mr-2"
                                        placeholder="Number of rows">
                                    <button type="button" style="width:100px" class="btn btn-info mb-4"
                                        id="hotelbooking_copy" data-bs-target="#" onclick="copyJobs(id)">
                                        <i class="fa fa-copy"></i> Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="hotelbooking_table" class="table table-striped display nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" width="10%"></th>
                                    <th scope="col"></th>
                                    <th scope="col">Line status</th>
                                    <th scope="col" width="10%">Hotel Booking ID</th>
                                    <th scope="col" width="20%">Description</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Sub1</th>
                                    <th scope="col">Sub2</th>
                                    <th scope="col">Sub3</th>
                                    <th scope="col">Sub4</th>
                                    <th scope="col">Sub5</th>
                                    <th scope="col">Sub6</th>
                                    <th scope="col">Hotel Name</th>
                                    <th scope="col">Occupant</th>
                                    <th scope="col">Meal included</th>
                                    <th scope="col">Laundry included</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Check in Date</th>
                                    <th scope="col">Check out Date </th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">UOM</th>
                                    <th scope="col">Amount </th>
                                    <th scope="col">Charge(%) </th>
                                    <th scope="col">Contract Number</th>
                                    <th scope="col">Department </th>
                                    <th scope="col">Cost center</th>
                                    <th scope="col">Amount (system price per unit)</th>
                                    <th scope="col">No charge</th>
                                    <th scope="col">Reimbursement</th>
                                    <th scope="col">Lump sum charge</th>
                                    <th scope="col">Payment method</th>
                                    <th scope="col">IOU/Cheque Date</th>
                                    <th scope="col">IOU Number</th>
                                    <th scope="col">IOU/Cheque Amount</th>
                                    <th scope="col">Cheque Remark</th>
                                    <th scope="col">Vendor invoice Date</th>
                                    <th scope="col">Vendor invoice number</th>
                                    <th scope="col">Vendor invoice Submission date</th>
                                    <th scope="col">Vendor invoice Value</th>
                                    <th scope="col">Vendor invoice Due date</th>
                                    <th scope="col">Expense Submission date</th>
                                    <th scope="col">Reference 1</th>
                                    <th scope="col">Reference 2</th>
                                    <th scope="col">Reference 3</th>
                                    <th scope="col">Reference 4</th>
                                    <th scope="col">Reference 5</th>
                                    <th scope="col">Reference 6</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="ticketbooking-tab">
                    <form id="ticketbooking_data" class="mb-4">
                        <div id="ticketbooking_data_area">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Ticket Booking ID</span>
                                        <input type="text" name="ticketbooking_id" id="ticketbooking_id"
                                            class="form-control" readonly required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <!-- barcode_service  -->
                                        <span>Name</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="name" id="ticketbooking_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, [group] FROM FES.dbo.barcode_service where [group] = 'BS'";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="branch" id="ticketbooking_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, SO FROM FES.dbo.barcode_branch where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code_branch']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="location" id="ticketbooking_location" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name, BS FROM FES.dbo.barcode_location where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option id="<?php echo $row['location_name'] ?>"
                                                    value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type" id="ticketbooking_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name, BS FROM FES.dbo.barcode_product_type where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub1" id="ticketbooking_sub1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1, BS FROM FES.dbo.barcode_sub_type1 where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub2" id="ticketbooking_sub2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2, BS FROM FES.dbo.barcode_sub_type2 where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub3" id="ticketbooking_sub3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3, BS FROM FES.dbo.barcode_sub_type3 where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub4" id="ticketbooking_sub4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4, BS FROM FES.dbo.barcode_sub_type4 where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub5" id="ticketbooking_sub5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5, BS FROM FES.dbo.barcode_sub_type5 where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub6" id="ticketbooking_sub6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6, BS FROM FES.dbo.barcode_sub_type6 where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="qty" id="ticketbooking_qty"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="ticketbooking_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where BS = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Number</span><span style="color:red"> *</span>
                                        <select name="contract_number" id="ticketbooking_contract_number"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContract(id)"></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Description</span><span style="color:red"> *</span>

                                        <!-- <input type="text" name="contract_description"
                                            id="ticketbooking_contract_description"
                                            style="background-color: lemonchiffon;" class="form-control" required> -->
                                        <select name="contract_description" id="ticketbooking_contract_description"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContractDes(id)"></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" name="department" id="ticketbooking_department"
                                            class="form-control" value="<?php echo $_SESSION["department"]; ?>" readonly
                                            required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" id="ticketbooking_cost_center" name="cost_center"
                                            class="form-control" value="<?php echo $_SESSION["cost_center"]; ?>"
                                            readonly required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Status</span>
                                        <select name="status" id="ticketbooking_status" class="form-control"
                                            aria-describedby="inputGroupPrepend2" readonly required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="cancel_reason" id="ticketbooking_cancel_reason"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>



                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Description</span><span style="color:red"> *</span>
                                        <input type="text" name="description" id="ticketbooking_description"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Airline name</span>
                                        <input type="text" name="airline_name" id="ticketbooking_airline_name"
                                            class="form-control" required readonly>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Flight number</span><span style="color:red"> *</span>
                                        <input type="text" name="flight_number" id="ticketbooking_flight_number"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Remark</span>
                                        <input type="text" name="remark" id="ticketbooking_remark" class="form-control">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Passenger</span>
                                        <input type="text" name="passenger" id="ticketbooking_passenger"
                                            class="form-control">
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Departure Date</span><span style="color:red"> *</span>
                                        <input type="date" name="departure_date" id="ticketbooking_departure_date"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Departure location</span><span style="color:red"> *</span>
                                        <input type="text" class="form-control" name="departure_location"
                                            id="ticketbooking_departure_location" required>

                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Destination Date</span><span style="color:red"> *</span>
                                        <input type="date" name="destination_date" id="ticketbooking_destination_date"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Destination</span><span style="color:red"> *</span>
                                        <input type="text" name="destination_location"
                                            id="ticketbooking_destination_location" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span>With Luggage</span>
                                        <input type="checkbox" value="1" name="with_luggage"
                                            id="ticketbooking_with_luggage" class="form-check">
                                    </div>
                                </div>


                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Charge as</span><span style="color:red"> *</span>
                                        <select id="ticketbooking_charge_as" name="charge_as" class="form-control"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>



                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount</span><span style="color:red"> *</span>
                                        <input type="text" name="amount" id="ticketbooking_amount" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Charge(%)</span><span style="color:red"> *</span>
                                        <input type="text" name="charge" id="ticketbooking_charge" class="form-control"
                                            value="100" required>
                                    </div>
                                </div>


                                <div class="col-1">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">No Charge</span>
                                        <input type="checkbox" value="1" id="ticketbooking_no_charge" name="no_charge"
                                            class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Reimbursment</span>
                                        <input type="checkbox" value="1" id="ticketbooking_reimbursement"
                                            name="reimbursement" class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Lump-sum charge</span>
                                        <input type="checkbox" value="1" id="ticketbooking_lump_sum_charge"
                                            name="lump_sum_charge" class="form-check">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Payment method</span>
                                        <select name="payment_method" id="ticketbooking_payment_method"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value="cash">Cash</option>
                                            <option value="creditcard">Credit card</option>
                                            <option value="cheque">Cheque</option>
                                            <option value="banktransfer">Bank transfer</option>
                                            <option value="etc">Etc.</option>

                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-3">
                                    <div class="form-group">
                                        <span>IOU/Cheque Date</span>
                                        <input type="date" name="iou_cheque_date" id="ticketbooking_iou_cheque_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>IOU Number</span>
                                        <input type="number" name="iou_number" id="ticketbooking_iou_number"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>IOU/Cheque Amount</span>
                                        <input type="number" name="iou_cheque_amount"
                                            id="ticketbooking_iou_cheque_amount" class="form-control" required>
                                    </div>
                                </div> -->
                            </div>

                            <div class="row">
                                <div class="col-12 mb-4">
                                    <hr />
                                </div>


                                <!-- <div class="col-3">
                                    <div class="form-group">
                                        <span>Cheque Remark</span>
                                        <input type="text" name="cheque_remark" id="ticketbooking_cheque_remark"
                                            class="form-control" required>
                                    </div>
                                </div> -->
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Date</span>
                                        <input type="date" name="vendor_invoice_date"
                                            id="ticketbooking_vendor_invoice_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice number</span>
                                        <input type="text" name="vendor_invoice_number"
                                            id="ticketbooking_vendor_invoice_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Submission date</span>
                                        <input type="date" name="vendor_invoice_submission_date"
                                            id="ticketbooking_vendor_invoice_submission_date" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Value </span>
                                        <input type="text" name="vendor_invoice_value"
                                            id="ticketbooking_vendor_invoice_value" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Due date</span>
                                        <input type="date" name="vendor_invoice_due_date"
                                            id="ticketbooking_vendor_invoice_due_date" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Expense Submission date</span>
                                        <input type="date" name="expense_submission_date"
                                            id="ticketbooking_expense_submission_date" class="form-control" required>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 mb-4">
                                    <hr />
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 1</span>
                                        <input type="text" name="ref1" id="ticketbooking_ref1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 2</span>
                                        <input type="text" name="ref2" id="ticketbooking_ref2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 3</span>
                                        <input type="text" name="ref3" id="ticketbooking_ref3" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 4</span>
                                        <input type="text" name="ref4" id="ticketbooking_ref4" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 5</span>
                                        <input type="text" name="ref5" id="ticketbooking_ref5" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 6</span>
                                        <input type="text" name="ref6" id="ticketbooking_ref6" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">

                                <button type="submit" style="width:100px" class="btn btn-success"
                                    id="ticketbooking_submit" data-bs-target="#" onclick="submitform(id)">
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"
                                    id="ticketbooking_cancel_add" data-bs-target="#" onclick="cancleAddForm(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>


                                <button type="button" style="display:none" class="btn btn-success"
                                    id="ticketbooking_update" data-bs-target="#" onclick="updateJob(id)">
                                    <i class="fa fa-save"></i> Update
                                </button>

                                <button type="button" style="display:none" class="btn btn-danger"
                                    id="ticketbooking_cancel" data-bs-target="#" onclick="cancleUpdate(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="d-flex col">
                        <button type="button" style="width:100px" class="btn btn-success mb-4" id="ticketbooking_add"
                            data-bs-target="#" onclick="showForm(id)">
                            <i class="fa fa-plus-square"></i> Add
                        </button>
                        <div class="d-flex col justify-content-end">
                            <div class="d-flex justify-content-between col-xl-5">
                                <div class="d-flex col-6">
                                    <button type="button" class="btn btn-info mb-4 col-6"
                                        id="ticketbooking_copyFromWorksheet" data-bs-target="#"
                                        onclick="copyJobsFromWorksheet(id)">
                                        <i class="fa fa-copy"></i> Copy from worksheet
                                    </button>
                                </div>
                                <div class="d-flex col-6">
                                    <input type="number" name="rows" id="utilities_rows" class="form-control col mr-2"
                                        placeholder="Number of rows">
                                    <button type="button" style="width:100px" class="btn btn-info mb-4"
                                        id="ticketbooking_copy" data-bs-target="#" onclick="copyJobs(id)">
                                        <i class="fa fa-copy"></i> Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="ticketbooking_table" class="table table-striped display nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" width="10%"></th>
                                    <th scope="col"></th>
                                    <th scope="col">Line status</th>
                                    <th scope="col" width="10%">Ticket Booking ID</th>
                                    <th scope="col" width="20%">Description</th>
                                    <th scope="col">Flight number</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Sub1</th>
                                    <th scope="col">Sub2</th>
                                    <th scope="col">Sub3</th>
                                    <th scope="col">Sub4</th>
                                    <th scope="col">Sub5</th>
                                    <th scope="col">Sub6</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Passenger</th>
                                    <th scope="col">Airline name</th>
                                    <th scope="col">Departure Date</th>
                                    <th scope="col">Departure location </th>
                                    <th scope="col">Destination Date</th>
                                    <th scope="col">Destination Location</th>
                                    <th scope="col">With Luggage</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">UOM</th>
                                    <th scope="col">Amount </th>
                                    <th scope="col">Charge(%) </th>
                                    <th scope="col">Contract Number</th>
                                    <th scope="col">Amount (system price per unit)</th>
                                    <th scope="col">Department </th>
                                    <th scope="col">Cost center</th>
                                    <th scope="col">No charge</th>
                                    <th scope="col">Reimbursement</th>
                                    <th scope="col">Lump sum charge</th>
                                    <th scope="col">Payment method</th>
                                    <th scope="col">IOU/Cheque Date</th>
                                    <th scope="col">IOU Number</th>
                                    <th scope="col">IOU/Cheque Amount</th>
                                    <th scope="col">Cheque Remark</th>
                                    <th scope="col">Vendor invoice Date</th>
                                    <th scope="col">Vendor invoice number</th>
                                    <th scope="col">Vendor invoice Submission date</th>
                                    <th scope="col">Vendor invoice Value</th>
                                    <th scope="col">Vendor invoice Due date</th>
                                    <th scope="col">Expense Submission date</th>
                                    <th scope="col">Reference 1</th>
                                    <th scope="col">Reference 2</th>
                                    <th scope="col">Reference 3</th>
                                    <th scope="col">Reference 4</th>
                                    <th scope="col">Reference 5</th>
                                    <th scope="col">Reference 6</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="customerclearancecargo-tab">
                    <br>
                    <form id="customerclearancecargo_data">
                        <div id="customerclearancecargo_edit_area">

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Clearance Cargo ID</span>
                                        <input type="text" name="customerclearancecargo_id"
                                            id="customerclearancecargo_id" class="form-control" required readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <!-- barcode_service  -->
                                        <span>Name</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="name" id="customerclearancecargo_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, [group] FROM FES.dbo.barcode_service where [group] = 'CH'";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="branch" id="customerclearancecargo_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, SO FROM FES.dbo.barcode_branch where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code_branch']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="location" id="customerclearancecargo_location"
                                            class="form-control" aria-describedby="inputGroupPrepend2"
                                            onchange="changeLocation(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name FROM FES.dbo.barcode_location where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option id="<?php echo $row['location_name'] ?>"
                                                    value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type" id="customerclearancecargo_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name FROM FES.dbo.barcode_product_type where PV = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub1" id="customerclearancecargo_sub1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1, SO FROM FES.dbo.barcode_sub_type1 where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub2" id="customerclearancecargo_sub2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2 FROM FES.dbo.barcode_sub_type2 where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub3" id="customerclearancecargo_sub3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3 FROM FES.dbo.barcode_sub_type3 where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub4" id="customerclearancecargo_sub4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4 FROM FES.dbo.barcode_sub_type4 where PV = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub5" id="customerclearancecargo_sub5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5 FROM FES.dbo.barcode_sub_type5 where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub6" id="customerclearancecargo_sub6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6 FROM FES.dbo.barcode_sub_type6 where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="qty" id="customerclearancecargo_qty"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="customerclearancecargo_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Number</span>
                                        <select name="contract_number" id="customerclearancecargo_contract_number"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContract(id)"></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Drescription</span>
                                        <select name="contract_description"
                                            id="customerclearancecargo_contract_description" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContractDes(id)"></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" id="customerclearancecargo_department" name="department"
                                            class="form-control" value="<?php echo $_SESSION["department"]; ?>" require
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" id="customerclearancecargo_cost_center" name="cost_center"
                                            class="form-control" value=" <?php echo $_SESSION["cost_center"]; ?>"
                                            require readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Status</span>
                                        <select name="status" id="customerclearancecargo_status" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="cancel_reason" id="customerclearancecargo_cancel_reason"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Service process</span>
                                        <select name="service_process" id="customerclearancecargo_service_porcess"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value="cargo_import">Import</option>
                                            <option value="cargo_export">Export</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Description</span><span style="color:red"> *</span>
                                        <input type="text" name="description" id="customerclearancecargo_description"
                                            class="form-control" required>
                                    </div>
                                </div>



                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Clearance Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="clearance_start_date"
                                            id="customerclearancecargo_clearance_start_date" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Clearance Finish Date</span><span style="color:red"> *</span>
                                        <input type="date" name="clearance_finish_date"
                                            id="customerclearancecargo_clearance_finish_date" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Customs Entry Number</span><span style="color:red"> *</span>
                                        <input type="text" name="customs_entry_number"
                                            id="customerclearancecargo_customs_entry_number" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cargo Total Weight</span><span style="color:red"> *</span>
                                        <input type="number" name="cargo_total_weight"
                                            id="customerclearancecargo_cargo_total_weight" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Origin Country</span>
                                        <input type="text" name="origin_country"
                                            id="customerclearancecargo_origin_country" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>(Import) POE</span>
                                        <select name="import_poe" id="customerclearancecargo_import_poe"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM FES.dbo.poe_pod";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>(Export) POD</span>
                                        <select name="export_pod" id="customerclearancecargo_export_pod"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM FES.dbo.poe_pod";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>(Import) ETA Date</span>
                                        <input type="date" name="import_eta_date"
                                            id="customerclearancecargo_import_eta_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>(Import) ATA Date</span>
                                        <input type="date" name="import_ata_date"
                                            id="customerclearancecargo_import_ata_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>(Export) ETD Date</span>
                                        <input type="date" name="export_etd_date"
                                            id="customerclearancecargo_export_etd_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>(Export) ATD Date</span>
                                        <input type="date" name="export_atd_date"
                                            id="customerclearancecargo_export_atd_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>DO release Date</span>
                                        <input type="date" name="do_release_date"
                                            id="customerclearancecargo_do_release_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Container Open Date</span>
                                        <input type="date" name="container_open_date"
                                            id="customerclearancecargo_container_open_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cheque received Date</span>
                                        <input type="date" name="cheque_received_date"
                                            id="customerclearancecargo_cheque_received_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Duty & Tax Amount</span>
                                        <input type="number" name="duty_tax_amount"
                                            id="customerclearancecargo_duty_tax_amount" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>AWB/BL Number</span>
                                        <input type="number" name="awb_bl_number"
                                            id="customerclearancecargo_awb_bl_number" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>CIPL Number</span>
                                        <input type="number" name="cipl_number" id="customerclearancecargo_cipl_number"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>CIPL Value</span>
                                        <input type="number" name="cipl_value" id="customerclearancecargo_cipl_value"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Charge as</span><span style="color:red"> *</span>
                                        <select id="customerclearancecargo_charge_as" name="charge_as"
                                            class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>



                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount</span><span style="color:red"> *</span>
                                        <input type="text" name="amount_system"
                                            id="customerclearancecargo_amount_system" class="form-control">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Charge %</span>
                                        <input type="text" name="charge" id="customerclearancecargo_charge"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>No charge</span>
                                        <input type="checkbox" value="1" id="customerclearancecargo_no_charge"
                                            name="no_charge" class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Reimbursement</span>
                                        <input type="checkbox" value="1" id="customerclearancecargo_reimbursement"
                                            name="reimbursement" class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Lump-sum charge</span>
                                        <input type="checkbox" value="1" id="customerclearancecargo_lump_sum_charge"
                                            name="lump_sum_charge" class="form-check">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Date</span>
                                        <input type="date" name="vendor_invoice_date"
                                            id="customerclearancecargo_vendor_invoice_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice number</span>
                                        <input type="text" name="vendor_invoice_number"
                                            id="customerclearancecargo_vendor_invoice_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Submission date</span>
                                        <input type="date" name="vendor_invoice_submission_date"
                                            id="customerclearancecargo_invoice_submission_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Value </span>
                                        <input type="text" name="vendor_invoice_value"
                                            id="customerclearancecargo_vendor_invoice_value" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Due date</span>
                                        <input type="date" name="vendor_invoice_due_date"
                                            id="customerclearancecargo_vendor_invoice_due_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Expense Submission date</span>
                                        <input type="date" name="expense_submission_date"
                                            id="customerclearancecargo_expense_submission_date" class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 mb-5">
                                    <hr />
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 1</span>
                                        <input type="text" name="ref1" id="customerclearancecargo_ref1"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 2</span>
                                        <input type="text" name="ref2" id="customerclearancecargo_ref2"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 3</span>
                                        <input type="text" name="ref3" id="customerclearancecargo_ref3"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 4</span>
                                        <input type="text" name="ref4" id="customerclearancecargo_ref4"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 5</span>
                                        <input type="text" name="ref5" id="customerclearancecargo_ref5"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 6</span>
                                        <input type="text" name="ref6" id="customerclearancecargo_ref6"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">

                                <button type="submit" style="width:100px" class="btn btn-success"
                                    id="customerclearancecargo_submit" data-bs-target="#" onclick="submitform(id)">
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"
                                    id="customerclearancecargo_cancel_add" data-bs-target="#"
                                    onclick="cancleAddForm(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>


                                <button type="button" style="display:none" class="btn btn-success"
                                    id="customerclearancecargo_update" data-bs-target="#" onclick="updateJob(id)">
                                    <i class="fa fa-save"></i> Update
                                </button>

                                <button type="button" style="display:none" class="btn btn-danger"
                                    id="customerclearancecargo_cancel" data-bs-target="#" onclick="cancleUpdate(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <!-- <input type="hidden" name="service_type" id="service_type">
                                    <input type="hidden" name="service_reccode" id="service_reccode"> -->
                            </div>
                        </div>
                    </form>
                    <div class="d-flex col">
                        <button type="button" style="width:100px" class="btn btn-success mb-4"
                            id="customerclearancecargo_add" data-bs-target="#" onclick="showForm(id)">
                            <i class="fa fa-plus-square"></i> Add
                        </button>
                        <div class="d-flex col justify-content-end">
                            <div class="d-flex justify-content-between col-xl-5">
                                <div class="d-flex col-6">
                                    <button type="button" class="btn btn-info mb-4 col-6"
                                        id="customerclearancecargo_copyFromWorksheet" data-bs-target="#"
                                        onclick="copyJobsFromWorksheet(id)">
                                        <i class="fa fa-copy"></i> Copy from worksheet
                                    </button>
                                </div>
                                <div class="d-flex col-6">
                                    <input type="number" name="rows" id="utilities_rows" class="form-control col mr-2"
                                        placeholder="Number of rows">
                                    <button type="button" style="width:100px" class="btn btn-info mb-4"
                                        id="customerclearancecargo_copy" data-bs-target="#" onclick="copyJobs(id)">
                                        <i class="fa fa-copy"></i> Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="table-responsive">
                        <table id="customerclearancecargo_table" class="table table-striped display nowrap"
                            style="width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col">line status</th>
                                    <th scope="col">Clearance Cargo ID</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Service Description</th>
                                    <th scope="col">Work Location</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Sub1</th>
                                    <th scope="col">Sub2</th>
                                    <th scope="col">Sub3</th>
                                    <th scope="col">Sub4</th>
                                    <th scope="col">Sub5</th>
                                    <th scope="col">Sub6</th>
                                    <th scope="col">Clearance Start Date</th>
                                    <th scope="col">Clearance Finish Date</th>
                                    <th scope="col">Customs Entry Number</th>
                                    <th scope="col">Cargo Total Weight</th>
                                    <th scope="col">Origin Country</th>
                                    <th scope="col">(Import) POE</th>
                                    <th scope="col">(Export) POD</th>
                                    <th scope="col">(Import) ETA Date</th>
                                    <th scope="col">(Import) ATA Date</th>
                                    <th scope="col">(Export) ETD Date</th>
                                    <th scope="col">(Export) ATD Date</th>
                                    <th scope="col">DO release Date</th>
                                    <th scope="col">Container Open Date</th>
                                    <th scope="col">Cheque received Date</th>
                                    <th scope="col">Duty & Tax Amount</th>
                                    <th scope="col">AWB/BL Number</th>
                                    <th scope="col">CIPL Number</th>
                                    <th scope="col">CIPL Value</th>
                                    <th scope="col" width="5%">Qty</th>
                                    <th scope="col" width="10%">UOM</th>
                                    <th scope="col" width="15%">Contract number </th>
                                    <th scope="col">Department </th>
                                    <th scope="col">Cost center</th>
                                    <th scope="col">Amount </th>
                                    <th scope="col">Charge(%) </th>
                                    <th scope="col">No charge</th>
                                    <th scope="col">Reimbursment</th>
                                    <th scope="col">Lump sum charge</th>
                                    <th scope="col">IOU/Cheque Date</th>
                                    <th scope="col">IOU Number</th>
                                    <th scope="col">IOU Amount</th>
                                    <th scope="col">Cheque Remark</th>
                                    <th scope="col">Cheque Amount</th>
                                    <th scope="col">Vendor invoice Date</th>
                                    <th scope="col">Vendor invoice number</th>
                                    <th scope="col">Vendor invoice Submission date</th>
                                    <th scope="col">Vendor invoice Value</th>
                                    <th scope="col">Vendor invoice Due date</th>
                                    <th scope="col">Expense submission date</th>
                                    <th scope="col" style="width: 15%;">Reference 1</th>
                                    <th scope="col" style="width: 15%;">Reference 2</th>
                                    <th scope="col" style="width: 15%;">Reference 3</th>
                                    <th scope="col" style="width: 15%;">Reference 4</th>
                                    <th scope="col" style="width: 15%;">Reference 5</th>
                                    <th scope="col" style="width: 15%;">Reference 6</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="customerclearancevessel-tab">
                    <br>
                    <form id="customerclearancevessel_data">
                        <div id="customerclearancevessel_edit_area">

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Clearance Vessel ID</span>
                                        <input type="text" name="customerclearancevessel_id"
                                            id="customerclearancevessel_id" class="form-control" required readonly>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <!-- barcode_service  -->
                                        <span>Name</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="name" id="customerclearancevessel_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, [group] FROM FES.dbo.barcode_service where [group] = 'CH'";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="branch" id="customerclearancevessel_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, SO FROM FES.dbo.barcode_branch where SH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code_branch']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="location" id="customerclearancevessel_location"
                                            class="form-control" aria-describedby="inputGroupPrepend2"
                                            onchange="changeLocation(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name FROM FES.dbo.barcode_location where SH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option id="<?php echo $row['location_name'] ?>"
                                                    value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type" id="customerclearancevessel_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name FROM FES.dbo.barcode_product_type where SH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub1" id="customerclearancevessel_sub1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1, SO FROM FES.dbo.barcode_sub_type1 where SH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub2" id="customerclearancevessel_sub2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2 FROM FES.dbo.barcode_sub_type2 where SH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub3" id="customerclearancevessel_sub3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3 FROM FES.dbo.barcode_sub_type3 where SH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub4" id="customerclearancevessel_sub4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4 FROM FES.dbo.barcode_sub_type4 where SH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub5" id="customerclearancevessel_sub5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5 FROM FES.dbo.barcode_sub_type5 where SH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub6" id="customerclearancevessel_sub6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6 FROM FES.dbo.barcode_sub_type6 where SH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="qty" id="customerclearancevessel_qty"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="customerclearancevessel_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where SH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Number</span>
                                        <select name="contract_number" id="customerclearancevessel_contract_number"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContract(id)"></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Drescription</span>
                                        <select type="text" name="contract_description"
                                            id="customerclearancevessel_contract_description" class="form-control"
                                            onchange="changeContractDes(id)" required></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" id="customerclearancevessel_department" name="department"
                                            class="form-control" value="<?php echo $_SESSION["department"]; ?>" require
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" id="customerclearancevessel_cost_center" name="cost_center"
                                            class="form-control" value=" <?php echo $_SESSION["cost_center"]; ?>"
                                            require readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Status</span>
                                        <select name="status" id="customerclearancecargo_status" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="cancel_reason" id="customerclearancecargo_cancel_reason"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Service process</span>
                                        <select name="service_process" id="customerclearancecargo_service_process"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value="cargo_import">Import</option>
                                            <option value="cargo_export">Export</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Description</span><span style="color:red"> *</span>
                                        <input type="text" name="description" id="customerclearancevessel_description"
                                            class="form-control" required>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Clearance Port</span>
                                        <input type="text" name="clearance_port"
                                            id="customerclearancevessel_clearance_port" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Start</span>
                                        <input type="date" name="startdate" id="customerclearancevessel_startdate"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Finish</span>
                                        <input type="date" name="finishdate" id="customerclearancevessel_finishdate"
                                            class="form-control">
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vessel Type</span>
                                        <select name="vessel_type" id="customerclearancevessel_vessel_type"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vessel_type order by code ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="col-2">
                                    <div class="form-group">
                                        <span>Vessel Detail</span>
                                        <select name="vessel_detail" id="customerclearancevessel_vessel_detail"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vessel_detail order by code ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['vessel_name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="col-4">
                                    <div class="form-group">
                                        <span>Vessel Name & Vessel Owner</span><span style="color:red"> *</span>
                                        <select name="vessel_detail" id="customerclearancevessel_vessel_detail"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vessel_detail order by code ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['vehicle_id']; ?>">
                                                    <?php echo $row['vessel_name'] . ' | ' . $row['vessel_owner'] . ' | ' . $row['vessel_weight'] . ' | ' . $row['vessel_lenght'] . ' | ' . $row['vessel_draft']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vessel Weight (kg)</span>
                                        <input type="text" name="vessel_weight"
                                            id="customerclearancevessel_vessel_weight" class="form-control" readonly>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vessel Length (m)</span>
                                        <input type="text" name="vessel_length"
                                            id="customerclearancevessel_vessel_length" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Draft (m)</span>
                                        <input type="text" name="vessel_draft" id="customerclearancevessel_vessel_draft"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                <!-- 
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vessel Owner</span>
                                        <input type="text" name="vessel_owner" id="customerclearancevessel_vessel_owner"
                                            class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Vessel Weight (kg)</span>
                                        <input type="text" name="vessel_weight"
                                            id="customerclearancevessel_vessel_weight" class="form-control" readonly>
                                    </div>
                                </div>


                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Vessel Length (m)</span>
                                        <input type="text" name="vessel_length"
                                            id="customerclearancevessel_vessel_length" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Draft (m)</span>
                                        <input type="text" name="vessel_draft" id="customerclearancevessel_vessel_draft"
                                            class="form-control" readonly>
                                    </div>
                                </div> -->

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Last port of departure</span>
                                        <select name="last_port_of_department"
                                            id="customerclearancevessel_last_port_of_department" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM FES.dbo.poe_pod";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Next Port</span>
                                        <select name="next_port" id="customerclearancevessel_next_port"
                                            class="form-control" aria-describedby="inputGroupPrepend2"
                                            onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM FES.dbo.poe_pod";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Charge as</span><span style="color:red"> *</span>
                                        <select id="customerclearancevessel_charge_as" name="charge_as"
                                            class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount</span>
                                        <input type="text" name="amount_system"
                                            id="customerclearancevessel_amount_system" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Charge %</span>
                                        <input type="text" name="charge" id="customerclearancevessel_charge"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>No charge</span>
                                        <input type="checkbox" value="1" id="customerclearancevessel_no_charge"
                                            name="no_charge" class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Reimbursement</span>
                                        <input type="checkbox" value="1" id="customerclearancevessel_reimbursement"
                                            name="reimbursement" class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Lump-sum charge</span>
                                        <input type="checkbox" value="1" id="customerclearancevessel_lump_sum_charge"
                                            name="lump_sum_charge" class="form-check">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Date</span>
                                        <input type="date" name="vendor_invoice_date"
                                            id="customerclearancevessel_vendor_invoice_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice number</span>
                                        <input type="text" name="vendor_invoice_number"
                                            id="customerclearancevessel_vendor_invoice_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Submission date</span>
                                        <input type="date" name="vendor_invoice_submission_date"
                                            id="customerclearancevesselvendor_invoice_submission_date"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Value </span>
                                        <input type="text" name="vendor_invoice_value"
                                            id="customerclearancevessel_vendor_invoice_value" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Due date</span>
                                        <input type="date" name="vendor_invoice_due_date"
                                            id="customerclearancevessel_vendor_invoice_due_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Expense Submission date</span>
                                        <input type="date" name="expense_submission_date"
                                            id="customerclearancevessel_expense_submission_date" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 1</span>
                                        <input type="text" name="ref1" id="customerclearancevessel_ref1"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 2</span>
                                        <input type="text" name="ref2" id="customerclearancevessel_ref2"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 3</span>
                                        <input type="text" name="ref3" id="customerclearancevessel_ref3"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 4</span>
                                        <input type="text" name="ref4" id="customerclearancevessel_ref4"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 5</span>
                                        <input type="text" name="ref5" id="customerclearancevessel_ref5"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 6</span>
                                        <input type="text" name="ref6" id="customerclearancevessel_ref6"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">

                                <button type="submit" style="width:100px" class="btn btn-success"
                                    id="customerclearancevessel_submit" data-bs-target="#" onclick="submitform(id)">
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"
                                    id="customerclearancevessel_cancel_add" data-bs-target="#"
                                    onclick="cancleAddForm(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>


                                <button type="button" style="display:none" class="btn btn-success"
                                    id="customerclearancevessel_update" data-bs-target="#" onclick="updateJob(id)">
                                    <i class="fa fa-save"></i> Update
                                </button>

                                <button type="button" style="display:none" class="btn btn-danger"
                                    id="customerclearancevessel_cancel" data-bs-target="#" onclick="cancleUpdate(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <!-- <input type="hidden" name="service_type" id="service_type">
                                    <input type="hidden" name="service_reccode" id="service_reccode"> -->
                            </div>
                        </div>
                    </form>

                    <div class="d-flex col">
                        <button type="button" style="width:100px" class="btn btn-success mb-4"
                            id="customerclearancevessel_add" data-bs-target="#" onclick="showForm(id)">
                            <i class="fa fa-plus-square"></i> Add
                        </button>
                        <div class="d-flex col justify-content-end">
                            <div class="d-flex justify-content-between col-xl-5">
                                <div class="d-flex col-6">
                                    <button type="button" class="btn btn-info mb-4 col-6"
                                        id="customerclearancevessel_copyFromWorksheet" data-bs-target="#"
                                        onclick="copyJobsFromWorksheet(id)">
                                        <i class="fa fa-copy"></i> Copy from worksheet
                                    </button>
                                </div>
                                <div class="d-flex col-6">
                                    <input type="number" name="rows" id="utilities_rows" class="form-control col mr-2"
                                        placeholder="Number of rows">
                                    <button type="button" style="width:100px" class="btn btn-info mb-4"
                                        id="customerclearancevessel_copy" data-bs-target="#" onclick="copyJobs(id)">
                                        <i class="fa fa-copy"></i> Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="customerclearancevessel_table" class="table table-striped display nowrap"
                            style="width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col">line status</th>
                                    <th scope="col">Clearance Vessel ID</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Service Description</th>
                                    <th scope="col">Work Location</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Sub1</th>
                                    <th scope="col">Sub2</th>
                                    <th scope="col">Sub3</th>
                                    <th scope="col">Sub4</th>
                                    <th scope="col">Sub5</th>
                                    <th scope="col">Sub6</th>
                                    <th scope="col">Clearance Port</th>
                                    <th scope="col">Start</th>
                                    <th scope="col">Finish</th>
                                    <th scope="col">Vessel Name</th>
                                    <th scope="col">Vessel Type</th>
                                    <th scope="col">Vessel Owner</th>
                                    <th scope="col">Vessel Weight</th>
                                    <th scope="col">Vessel Length</th>
                                    <th scope="col">Draft</th>
                                    <th scope="col">Last port of departure</th>
                                    <th scope="col">Next Port</th>
                                    <th scope="col" width="5%">Qty</th>
                                    <th scope="col" width="10%">UOM</th>
                                    <th scope="col" width="15%">Contract number </th>
                                    <th scope="col">Department </th>
                                    <th scope="col">Cost center</th>
                                    <th scope="col">Amount </th>
                                    <th scope="col">Charge(%) </th>
                                    <th scope="col">No charge</th>
                                    <th scope="col">Reimbursment</th>
                                    <th scope="col">Lump sum charge</th>
                                    <th scope="col">IOU/Cheque Date</th>
                                    <th scope="col">IOU Number</th>
                                    <th scope="col">IOU Amount</th>
                                    <th scope="col">Cheque Remark</th>
                                    <th scope="col">Cheque Amount</th>
                                    <th scope="col">Vendor invoice Date</th>
                                    <th scope="col">Vendor invoice number</th>
                                    <th scope="col">Vendor invoice Submission date</th>
                                    <th scope="col">Vendor invoice Value</th>
                                    <th scope="col">Vendor invoice Due date</th>
                                    <th scope="col">Expense submission date</th>
                                    <th scope="col" style="width: 15%;">Reference 1</th>
                                    <th scope="col" style="width: 15%;">Reference 2</th>
                                    <th scope="col" style="width: 15%;">Reference 3</th>
                                    <th scope="col" style="width: 15%;">Reference 4</th>
                                    <th scope="col" style="width: 15%;">Reference 5</th>
                                    <th scope="col" style="width: 15%;">Reference 6</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="agencyservice-tab">
                    <br>
                    <form id="agencyservice_data">
                        <div id="agencyservice_edit_area">

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Agency Service Other ID</span>
                                        <input type="text" name="agencyservice_id" id="agencyservice_id"
                                            class="form-control" required readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <!-- barcode_service  -->
                                        <span>Name</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="name" id="agencyservice_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, [group] FROM FES.dbo.barcode_service where [group] = 'CH'";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="branch" id="agencyservice_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, SO FROM FES.dbo.barcode_branch where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code_branch']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="location" id="agencyservice_location" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name FROM FES.dbo.barcode_location where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option id="<?php echo $row['location_name'] ?>"
                                                    value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type" id="agencyservice_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name FROM FES.dbo.barcode_product_type where AG = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub1" id="agencyservice_sub1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1 FROM FES.dbo.barcode_sub_type1 where AG = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub2" id="agencyservice_sub2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2 FROM FES.dbo.barcode_sub_type2 where AG = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub3" id="agencyservice_sub3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3 FROM FES.dbo.barcode_sub_type3 where AG = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub4" id="agencyservice_sub4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4 FROM FES.dbo.barcode_sub_type4 where AG = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub5" id="agencyservice_sub5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5 FROM FES.dbo.barcode_sub_type5 where AG = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub6" id="agencyservice_sub6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6 FROM FES.dbo.barcode_sub_type6 where AG = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="qty" id="agencyservice_qty"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="agencyservice_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract number</span><span style="color:red"> *</span>
                                        <select name="contract_number_auto" id="agencyservice_contract_number_auto"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContract(id)"></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Description</span>
                                        <select type="text" name="contract_description"
                                            id="agencyservice_contract_description" class="form-control"
                                            onchange="changeContractDes(id)" required></select>

                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" id="agencyservice_department" name="department"
                                            class="form-control" value="<?php echo $_SESSION["department"]; ?>" require
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" id="agencyservice_cost_center" name="cost_center"
                                            class="form-control" value=" <?php echo $_SESSION["cost_center"]; ?>"
                                            require readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Status</span>
                                        <select name="status" id="agencyservice_status" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="cancel_reason" id="agencyservice_cancel_reason"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Description</span><span style="color:red"> *</span>
                                        <input type="text" name="description" id="agencyservice_description"
                                            class="form-control" required>
                                    </div>
                                </div>


                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Remark</span>
                                        <input type="text" name="remark" id="agencyservice_remark" class="form-control">
                                    </div>
                                </div>



                                <!-- End Row -->

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Vehicle</span> <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="vehicle_id" id="agencyservice_vehicle_id" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT vehicle_id, vehicle_type, b.description as vehicle_owner, registration_no, branch FROM vehicle left join vehicle_owner b on b.code = vehicle_owner where category = 'Vehicles' and block = 0 order by registration_no ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <!-- <option value="<?php echo $row['vehicle_id']; ?>"><?php echo $row['registration_no'] . ' | ' . $row['vehicle_type'] . ' | ' . $row['vehicle_owner'] . ' | ' . $row['branch']; ?></option>	               -->
                                                <option value="<?php echo $row['vehicle_id']; ?>">
                                                    <?php echo $row['registration_no'] . ' | ' . $row['vehicle_type'] . ' | ' . $row['vehicle_owner']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Vehicle type</span><span style="color:red"> *</span>
                                        <select name="vehicle_type" id="agencyservice_vehicle_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_vehicle_type = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_vehicle_type, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Operator</span><span style="color:red"> *</span>
                                        <?php //switch transport_operator to service_operator 
                                        ?>
                                        <select name="operator_id" id="agencyservice_operator_id" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT o.operator_id, o.name, o.lastname, p.description, o.branch FROM operator o left join position p on p.code = o.position where o.operator = 1 and o.block = 0 order by o.name, o.lastname ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <!-- <option value="<?php echo $row['operator_id']; ?>"><?php echo $row['name'] . "  " . $row['lastname'] . ' | ' . $row['description'] . ' | ' . $row['branch']; ?></option>	 -->
                                                <option value="<?php echo $row['operator_id']; ?>">
                                                    <?php echo $row['name'] . "  " . $row['lastname'] . ' | ' . $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Charge as</span><span style="color:red"> *</span>
                                        <select id="agencyservice_charge_as" name="charge_as" class="form-control"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Position</span>
                                        <input type="text" name="position" id="agencyservice_position"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Diesel Rate (฿)</span>
                                        <input type="text" name="diesel_rate" id="agencyservice_diesel_rate"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>From</span>
                                        <input type="text" name="from_contract" id="agencyservice_from_contract"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>To</span>
                                        <input type="text" name="to_contract" id="agencyservice_to_contract"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="start_date" id="agencyservice_start_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="start_time" id="agencyservice_start_time"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="end_date" id="agencyservice_end_date"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Time</span><span style="color:red"> *</span>
                                        <input type="time" name="end_time" id="agencyservice_end_time"
                                            class="form-control">
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount (฿)</span><span style="color:red"> *</span>
                                        <input type="text" name="amont_system" id="agencyservice_amont_system"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Charge %</span>
                                        <input type="text" name="charge" id="agencyservice_charge" class="form-control">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>No charge</span>
                                        <input type="checkbox" value="1" id="agencyservice_no_charge" name="no_charge"
                                            class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Reimbursment</span>
                                        <input type="checkbox" value="1" id="agencyservice_reimbursment"
                                            name="reimbursment" class="form-check">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Lump-sum charge</span>
                                        <input type="checkbox" value="1" id="agencyservice_lump_sum_charge"
                                            name="lump_sum_charge" class="form-check">
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Date</span>
                                        <input type="date" name="vendor_invoice_date"
                                            id="agencyservice_vendor_invoice_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice number</span>
                                        <input type="text" name="vendor_invoice_number"
                                            id="agencyservice_vendor_invoice_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Submission date</span>
                                        <input type="date" name="vendor_invoice_submission_date"
                                            id="agencyservice_invoice_submission_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Value </span>
                                        <input type="text" name="vendor_invoice_value"
                                            id="agencyservice_vendor_invoice_value" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Due date</span>
                                        <input type="date" name="vendor_invoice_due_date"
                                            id="agencyservice_vendor_invoice_due_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Expense Submission date</span>
                                        <input type="date" name="expense_submission_date"
                                            id="agencyservice_expense_submission_date" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 mb-5">
                                    <hr />
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 1</span>
                                        <input type="text" name="ref1" id="agencyservice_ref1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 2</span>
                                        <input type="text" name="ref2" id="agencyservice_ref2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 3</span>
                                        <input type="text" name="ref3" id="agencyservice_ref3" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 4</span>
                                        <input type="text" name="ref4" id="agencyservice_ref4" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 5</span>
                                        <input type="text" name="ref5" id="agencyservice_ref5" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 6</span>
                                        <input type="text" name="ref6" id="agencyservice_ref6" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">

                                <button type="submit" style="width:100px" class="btn btn-success"
                                    id="agencyservice_submit" data-bs-target="#" onclick="submitform(id)">
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"
                                    id="agencyservice_cancel_add" data-bs-target="#" onclick="cancleAddForm(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>


                                <button type="button" style="display:none" class="btn btn-success"
                                    id="agencyservice_update" data-bs-target="#" onclick="updateJob(id)">
                                    <i class="fa fa-save"></i> Update
                                </button>

                                <button type="button" style="display:none" class="btn btn-danger"
                                    id="agencyservice_cancel" data-bs-target="#" onclick="cancleUpdate(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <!-- <input type="hidden" name="service_type" id="service_type">
                                    <input type="hidden" name="service_reccode" id="service_reccode"> -->
                            </div>
                        </div>
                    </form>

                    <div class="d-flex col">
                        <button type="button" style="width:100px" class="btn btn-success mb-4" id="agencyservice_add"
                            data-bs-target="#" onclick="showForm(id)">
                            <i class="fa fa-plus-square"></i> Add
                        </button>
                        <div class="d-flex col justify-content-end">
                            <div class="d-flex justify-content-between col-xl-5">
                                <div class="d-flex col-6">
                                    <button type="button" class="btn btn-info mb-4 col-6"
                                        id="agencyservice_copyFromWorksheet" data-bs-target="#"
                                        onclick="copyJobsFromWorksheet(id)">
                                        <i class="fa fa-copy"></i> Copy from worksheet
                                    </button>
                                </div>
                                <div class="d-flex col-6">
                                    <input type="number" name="rows" id="utilities_rows" class="form-control col mr-2"
                                        placeholder="Number of rows">
                                    <button type="button" style="width:100px" class="btn btn-info mb-4"
                                        id="agencyservice_copy" data-bs-target="#" onclick="copyJobs(id)">
                                        <i class="fa fa-copy"></i> Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="agencyservice_table" class="table table-striped display nowrap" style="width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" width="20%"></th>
                                    <th scope="col"></th>
                                    <th scope="col" width="10%">line status</th>
                                    <th scope="col" width="15%">Service Other ID</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Description(Contract)</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Sub1</th>
                                    <th scope="col">Sub2</th>
                                    <th scope="col">Sub3</th>
                                    <th scope="col">Sub4</th>
                                    <th scope="col">Sub5</th>
                                    <th scope="col">Sub6</th>
                                    <th scope="col">Vehicle</th>
                                    <th scope="col">Operator</th>
                                    <th scope="col">Operator Name</th>
                                    <th scope="col">Charge as</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Diesel Rate</th>
                                    <th scope="col">From</th>
                                    <th scope="col">to</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col" width="5%">Qty</th>
                                    <th scope="col" width="10%">UOM</th>
                                    <th scope="col" width="15%">Contract number (Manual)</th>
                                    <th scope="col" width="15%">Contract number (Auto)</th>
                                    <th scope="col">Department </th>
                                    <th scope="col">Cost center</th>
                                    <th scope="col">Amount </th>
                                    <th scope="col">Charge(%) </th>
                                    <th scope="col">No charge</th>
                                    <th scope="col">Reimbursment</th>
                                    <th scope="col">Lump sum charge</th>
                                    <th scope="col">Vendor invoice Date</th>
                                    <th scope="col">Vendor invoice number</th>
                                    <th scope="col">Vendor invoice Value</th>
                                    <th scope="col">Vendor invoice Submission date</th>
                                    <th scope="col" style="width: 15%;">Reference 1</th>
                                    <th scope="col" style="width: 15%;">Reference 2</th>
                                    <th scope="col" style="width: 15%;">Reference 3</th>
                                    <th scope="col" style="width: 15%;">Reference 4</th>
                                    <th scope="col" style="width: 15%;">Reference 5</th>
                                    <th scope="col" style="width: 15%;">Reference 6</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="managementfree-tab">
                    <br>
                    <form id="managementfree_data">
                        <div id="managementfree_edit_area">

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Management Free ID</span>
                                        <input type="text" name="managementfree_id" id="managementfree_id"
                                            class="form-control" required readonly>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <!-- barcode_service  -->
                                        <span>Name</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="name" id="managementfree_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, [group] FROM FES.dbo.barcode_service where [group] = 'CH'";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="branch" id="managementfree_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, SO FROM FES.dbo.barcode_branch where AG = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code_branch']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="location" id="managementfree_location" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name FROM FES.dbo.barcode_location where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option id="<?php echo $row['location_name'] ?>"
                                                    value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type" id="managementfree_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name FROM FES.dbo.barcode_product_type where AG = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub1" id="managementfree_sub1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1 FROM FES.dbo.barcode_sub_type1 where AG = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub2" id="managementfree_sub2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2 FROM FES.dbo.barcode_sub_type2 where AG = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub3" id="managementfree_sub3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3 FROM FES.dbo.barcode_sub_type3 where AG = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub4" id="managementfree_sub4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4 FROM FES.dbo.barcode_sub_type4 where AG = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub5" id="managementfree_sub5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5 FROM FES.dbo.barcode_sub_type5 where AG = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub6" id="managementfree_sub6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6 FROM FES.dbo.barcode_sub_type6 where AG = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="qty" id="managementfree_qty"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="managementfree_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract number</span><span style="color:red"> *</span>
                                        <select name="contract_number_auto" id="managementfree_contract_number_auto"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContract(id)"></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Description</span>
                                        <select type="text" name="contract_description"
                                            id="managementfree_contract_description" class="form-control"
                                            onchange="changeContractDes(id)" required></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" id="managementfree_department" name="department"
                                            class="form-control" value="<?php echo $_SESSION["department"]; ?>" require
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" id="managementfree_cost_center" name="cost_center"
                                            class="form-control" value=" <?php echo $_SESSION["cost_center"]; ?>"
                                            require readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Status</span>
                                        <select name="status" id="managementfree_status" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="cancel_reason" id="managementfree_cancel_reason"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Description</span><span style="color:red"> *</span>
                                        <input type="text" name="description" id="managementfree_description"
                                            class="form-control" required>
                                    </div>
                                </div>


                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Remark</span>
                                        <input type="text" name="remark" id="managementfree_remark"
                                            class="form-control">
                                    </div>
                                </div>



                                <!-- End Row -->

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Vehicle</span> <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="vehicle_id" id="managementfree_vehicle_id" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT vehicle_id, vehicle_type, b.description as vehicle_owner, registration_no, branch FROM vehicle left join vehicle_owner b on b.code = vehicle_owner where category = 'Vehicles' and block = 0 order by registration_no ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <!-- <option value="<?php echo $row['vehicle_id']; ?>"><?php echo $row['registration_no'] . ' | ' . $row['vehicle_type'] . ' | ' . $row['vehicle_owner'] . ' | ' . $row['branch']; ?></option>	               -->
                                                <option value="<?php echo $row['vehicle_id']; ?>">
                                                    <?php echo $row['registration_no'] . ' | ' . $row['vehicle_type'] . ' | ' . $row['vehicle_owner']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Vehicle type</span><span style="color:red"> *</span>
                                        <select name="vehicle_type" id="managementfree_vehicle_type"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_vehicle_type = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_vehicle_type, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Operator</span><span style="color:red"> *</span>
                                        <?php //switch transport_operator to service_operator 
                                        ?>
                                        <select name="operator_id" id="managementfree_operator_id" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT o.operator_id, o.name, o.lastname, p.description, o.branch FROM operator o left join position p on p.code = o.position where o.operator = 1 and o.block = 0 order by o.name, o.lastname ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <!-- <option value="<?php echo $row['operator_id']; ?>"><?php echo $row['name'] . "  " . $row['lastname'] . ' | ' . $row['description'] . ' | ' . $row['branch']; ?></option>	 -->
                                                <option value="<?php echo $row['operator_id']; ?>">
                                                    <?php echo $row['name'] . "  " . $row['lastname'] . ' | ' . $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Charge as</span><span style="color:red"> *</span>
                                        <select id="managementfree_charge_as" name="charge_as" class="form-control"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Position</span>
                                        <input type="text" name="position" id="managementfree_position"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Diesel Rate (฿)</span>
                                        <input type="text" name="diesel_rate" id="managementfree_diesel_rate"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>From</span>
                                        <input type="text" name="from_contract" id="managementfree_from_contract"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>To</span>
                                        <input type="text" name="to_contract" id="managementfree_to_contract"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="start_date" id="managementfree_start_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="start_time" id="managementfree_start_time"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="end_date" id="managementfree_end_date"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Time</span><span style="color:red"> *</span>
                                        <input type="time" name="end_time" id="managementfree_end_time"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount (฿)</span><span style="color:red"> *</span>
                                        <input type="text" name="amont_system" id="managementfree_amont_system"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Charge %</span>
                                        <input type="text" name="charge" id="managementfree_charge"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>No charge</span>
                                        <input type="checkbox" value="1" id="managementfree_no_charge" name="no_charge"
                                            class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Reimbursment</span>
                                        <input type="checkbox" value="1" id="managementfree_reimbursment"
                                            name="reimbursment" class="form-check">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Lump-sum charge</span>
                                        <input type="checkbox" value="1" id="managementfree_lump_sum_charge"
                                            name="lump_sum_charge" class="form-check">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Date</span>
                                        <input type="date" name="vendor_invoice_date"
                                            id="managementfree_vendor_invoice_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice number</span>
                                        <input type="text" name="vendor_invoice_number"
                                            id="managementfree_vendor_invoice_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Submission date</span>
                                        <input type="date" name="vendor_invoice_submission_date"
                                            id="managementfree_invoice_submission_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Value </span>
                                        <input type="text" name="vendor_invoice_value"
                                            id="managementfree_vendor_invoice_value" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Due date</span>
                                        <input type="date" name="vendor_invoice_due_date"
                                            id="managementfree_vendor_invoice_due_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Expense Submission date</span>
                                        <input type="date" name="expense_submission_date"
                                            id="managementfree_expense_submission_date" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 mb-5">
                                    <hr />
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 1</span>
                                        <input type="text" name="ref1" id="managementfree_ref1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 2</span>
                                        <input type="text" name="ref2" id="managementfree_ref2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 3</span>
                                        <input type="text" name="ref3" id="managementfree_ref3" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 4</span>
                                        <input type="text" name="ref4" id="managementfree_ref4" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 5</span>
                                        <input type="text" name="ref5" id="managementfree_ref5" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 6</span>
                                        <input type="text" name="ref6" id="managementfree_ref6" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">

                                <button type="submit" style="width:100px" class="btn btn-success"
                                    id="managementfree_submit" data-bs-target="#" onclick="submitform(id)">
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"
                                    id="managementfree_cancel_add" data-bs-target="#" onclick="cancleAddForm(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>


                                <button type="button" style="display:none" class="btn btn-success"
                                    id="managementfree_update" data-bs-target="#" onclick="updateJob(id)">
                                    <i class="fa fa-save"></i> Update
                                </button>

                                <button type="button" style="display:none" class="btn btn-danger"
                                    id="managementfree_cancel" data-bs-target="#" onclick="cancleUpdate(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <!-- <input type="hidden" name="service_type" id="service_type">
                                    <input type="hidden" name="service_reccode" id="service_reccode"> -->
                            </div>
                        </div>
                    </form>

                    <div class="d-flex col">
                        <button type="button" style="width:100px" class="btn btn-success mb-4" id="managementfree_add"
                            data-bs-target="#" onclick="showForm(id)">
                            <i class="fa fa-plus-square"></i> Add
                        </button>
                        <div class="d-flex col justify-content-end">
                            <div class="d-flex justify-content-between col-xl-5">
                                <div class="d-flex col-6">
                                    <button type="button" class="btn btn-info mb-4 col-6"
                                        id="managementfree_copyFromWorksheet" data-bs-target="#"
                                        onclick="copyJobsFromWorksheet(id)">
                                        <i class="fa fa-copy"></i> Copy from worksheet
                                    </button>
                                </div>
                                <div class="d-flex col-6">
                                    <input type="number" name="rows" id="utilities_rows" class="form-control col mr-2"
                                        placeholder="Number of rows">
                                    <button type="button" style="width:100px" class="btn btn-info mb-4"
                                        id="managementfree_copy" data-bs-target="#" onclick="copyJobs(id)">
                                        <i class="fa fa-copy"></i> Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="managementfree_table" class="table table-striped display nowrap"
                            style="width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" width="20%"></th>
                                    <th scope="col"></th>
                                    <th scope="col" width="10%">line status</th>
                                    <th scope="col" width="15%">Service Other ID</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Description(Contract)</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Sub1</th>
                                    <th scope="col">Sub2</th>
                                    <th scope="col">Sub3</th>
                                    <th scope="col">Sub4</th>
                                    <th scope="col">Sub5</th>
                                    <th scope="col">Sub6</th>
                                    <th scope="col">Vehicle</th>
                                    <th scope="col">Operator</th>
                                    <th scope="col">Operator Name</th>
                                    <th scope="col">Charge as</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Diesel Rate</th>
                                    <th scope="col">From</th>
                                    <th scope="col">to</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col" width="5%">Qty</th>
                                    <th scope="col" width="10%">UOM</th>
                                    <th scope="col" width="15%">Contract number (Manual)</th>
                                    <th scope="col" width="15%">Contract number (Auto)</th>
                                    <th scope="col">Department </th>
                                    <th scope="col">Cost center</th>
                                    <th scope="col">Amount </th>
                                    <th scope="col">Charge(%) </th>
                                    <th scope="col">No charge</th>
                                    <th scope="col">Reimbursment</th>
                                    <th scope="col">Lump sum charge</th>
                                    <th scope="col">Vendor invoice Date</th>
                                    <th scope="col">Vendor invoice number</th>
                                    <th scope="col">Vendor invoice Value</th>
                                    <th scope="col">Vendor invoice Submission date</th>
                                    <th scope="col" style="width: 15%;">Reference 1</th>
                                    <th scope="col" style="width: 15%;">Reference 2</th>
                                    <th scope="col" style="width: 15%;">Reference 3</th>
                                    <th scope="col" style="width: 15%;">Reference 4</th>
                                    <th scope="col" style="width: 15%;">Reference 5</th>
                                    <th scope="col" style="width: 15%;">Reference 6</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="provisionincome-tab">
                    <br>
                    <form id="provisionincome_data">
                        <div id="provisionincome_edit_area">

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Provision Income ID</span>
                                        <input type="text" name="provisionincome_id" id="provisionincome_id"
                                            class="form-control" required readonly>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <!-- barcode_service  -->
                                        <span>Name</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="name" id="provisionincome_name" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_service, type_service_name, [group] FROM FES.dbo.barcode_service where [group] = 'PV'";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_service']; ?>">
                                                    <?php echo $row['type_service_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span>
                                        <select name="branch" id="provisionincome_branch" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code_branch, branch_name, SO FROM FES.dbo.barcode_branch where PV = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code_branch']; ?>">
                                                    <?php echo $row['branch_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
                                        <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="location" id="provisionincome_location" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="changeLocation(id)"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_location, location_name FROM FES.dbo.barcode_location where CH = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option id="<?php echo $row['location_name'] ?>"
                                                    value="<?php echo $row['no_location']; ?>">
                                                    <?php echo $row['location_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="type" id="provisionincome_type" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_product_type, product_type_name FROM FES.dbo.barcode_product_type where PV = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_product_type']; ?>">
                                                    <?php echo $row['product_type_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub1</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub1" id="provisionincome_sub1" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type1, sub_type1 FROM FES.dbo.barcode_sub_type1 where PV = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type1']; ?>">
                                                    <?php echo $row['sub_type1'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub2</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub2" id="provisionincome_sub2" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type2, sub_type2 FROM FES.dbo.barcode_sub_type2 where PV = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type2']; ?>">
                                                    <?php echo $row['sub_type2'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub3</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub3" id="provisionincome_sub3" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type3, sub_type3 FROM FES.dbo.barcode_sub_type3 where PV = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type3']; ?>">
                                                    <?php echo $row['sub_type3'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub4</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub4" id="provisionincome_sub4" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type4, sub_type4 FROM FES.dbo.barcode_sub_type4 where PV = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type4']; ?>">
                                                    <?php echo $row['sub_type4'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub5</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub5" id="provisionincome_sub5" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type5, sub_type5 FROM FES.dbo.barcode_sub_type5 where PV = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type5']; ?>">
                                                    <?php echo $row['sub_type5'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Sub6</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="sub6" id="provisionincome_sub6" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT no_sub_type6, sub_type6 FROM FES.dbo.barcode_sub_type6 where PV = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['no_sub_type6']; ?>">
                                                    <?php echo $row['sub_type6'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="qty" id="provisionincome_qty"
                                            style="background-color: lemonchiffon;" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red">
                                            *</span><?php //switch transport_operator to service_operator 
                                            ?>
                                        <select name="uom" id="provisionincome_uom" class="form-control"
                                            aria-describedby="inputGroupPrepend2" onchange="getContract(id)" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT code,description FROM FES.dbo.uom where PV = 1";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract number</span><span style="color:red"> *</span>
                                        <select name="contract_number_auto" id="provisionincome_contract_number_auto"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required
                                            onchange="changeContract(id)"></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Contract Description</span>
                                        <select type="text" name="contract_description"
                                            id="provisionincome_contract_description" class="form-control"
                                            onchange="changeContractDes(id)" required></select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Department</span><span style="color:red"> *</span>
                                        <input type="text" id="provisionincome_department" name="department"
                                            class="form-control" value="<?php echo $_SESSION["department"]; ?>" require
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Cost center</span><span style="color:red"> *</span>
                                        <input type="text" id="provisionincome_cost_center" name="cost_center"
                                            class="form-control" value=" <?php echo $_SESSION["cost_center"]; ?>"
                                            require readonly>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Status</span>
                                        <select name="status" id="provisionincome_status" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                            <option value="Open">Open</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 cancel1">
                                    <div class="form-group">
                                        <span>Cancel Reason</span>
                                        <select name="cancel_reason" id="provisionincome_cancel_reason"
                                            class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM cancellation_reason";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Description</span><span style="color:red"> *</span>
                                        <input type="text" name="description" id="provisionincome_description"
                                            class="form-control" required>
                                    </div>
                                </div>


                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Remark</span>
                                        <input type="text" name="remark" id="provisionincome_remark"
                                            class="form-control">
                                    </div>
                                </div>



                                <!-- End Row -->

                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Vehicle</span> <?php //switch transport_vehicle to service_vehicle 
                                        ?>
                                        <select name="vehicle_id" id="provisionincome_vehicle_id" class="form-control"
                                            aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT vehicle_id, vehicle_type, b.description as vehicle_owner, registration_no, branch FROM vehicle left join vehicle_owner b on b.code = vehicle_owner where category = 'Vehicles' and block = 0 order by registration_no ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <!-- <option value="<?php echo $row['vehicle_id']; ?>"><?php echo $row['registration_no'] . ' | ' . $row['vehicle_type'] . ' | ' . $row['vehicle_owner'] . ' | ' . $row['branch']; ?></option>	               -->
                                                <option value="<?php echo $row['vehicle_id']; ?>">
                                                    <?php echo $row['registration_no'] . ' | ' . $row['vehicle_type'] . ' | ' . $row['vehicle_owner']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Vehicle type</span><span style="color:red"> *</span>
                                        <select name="vehicle_type" id="provisionincome_vehicle_type"
                                            class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_vehicle_type = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_vehicle_type, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Operator</span><span style="color:red"> *</span>
                                        <?php //switch transport_operator to service_operator 
                                        ?>
                                        <select name="operator_id" id="provisionincome_operator_id" class="form-control"
                                            aria-describedby="inputGroupPrepend2" required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT o.operator_id, o.name, o.lastname, p.description, o.branch FROM operator o left join position p on p.code = o.position where o.operator = 1 and o.block = 0 order by o.name, o.lastname ";
                                            $result = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                                <!-- <option value="<?php echo $row['operator_id']; ?>"><?php echo $row['name'] . "  " . $row['lastname'] . ' | ' . $row['description'] . ' | ' . $row['branch']; ?></option>	 -->
                                                <option value="<?php echo $row['operator_id']; ?>">
                                                    <?php echo $row['name'] . "  " . $row['lastname'] . ' | ' . $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Charge as</span><span style="color:red"> *</span>
                                        <select id="provisionincome_charge_as" name="charge_as" class="form-control"
                                            required>
                                            <option value=""></option>
                                            <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_skill = sqlsrv_query($conn, $fQuery);
                                            while ($row = sqlsrv_fetch_array($result_skill, SQLSRV_FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['code']; ?>">
                                                    <?php echo $row['description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <span>Position</span>
                                        <input type="text" name="position" id="provisionincome_position"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Diesel Rate (฿)</span>
                                        <input type="text" name="diesel_rate" id="provisionincome_diesel_rate"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>From</span>
                                        <input type="text" name="from_contract" id="provisionincome_from_contract"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>To</span>
                                        <input type="text" name="to_contract" id="provisionincome_to_contract"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="start_date" id="provisionincome_start_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="start_time" id="provisionincomee_start_time"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="end_date" id="provisionincome_end_date"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>End Time</span><span style="color:red"> *</span>
                                        <input type="time" name="end_time" id="provisionincome_end_time"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Amount (฿)</span><span style="color:red"> *</span>
                                        <input type="text" name="amont_system" id="provisionincome_amont_system"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Charge %</span>
                                        <input type="text" name="charge" id="provisionincome_charge"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>No charge</span>
                                        <input type="checkbox" value="1" id="provisionincome_no_charge" name="no_charge"
                                            class="form-check">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Reimbursment</span>
                                        <input type="checkbox" value="1" id="provisionincome_reimbursment"
                                            name="reimbursment" class="form-check">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Lump-sum charge</span>
                                        <input type="checkbox" value="1" id="provisionincome_lump_sum_charge"
                                            name="lump_sum_charge" class="form-check">
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-12 mb-4">
                                    <hr />
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Date</span>
                                        <input type="date" name="vendor_invoice_date"
                                            id="provisionincome_vendor_invoice_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice number</span>
                                        <input type="text" name="vendor_invoice_number"
                                            id="provisionincome_vendor_invoice_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Submission date</span>
                                        <input type="date" name="vendor_invoice_submission_date"
                                            id="provisionincome_invoice_submission_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Value </span>
                                        <input type="text" name="vendor_invoice_value"
                                            id="provisionincome_vendor_invoice_value" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Vendor invoice Due date</span>
                                        <input type="date" name="vendor_invoice_due_date"
                                            id="provisionincome_vendor_invoice_due_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <span>Expense Submission date</span>
                                        <input type="date" name="expense_submission_date"
                                            id="provisionincome_expense_submission_date" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 mb-4">
                                    <hr />
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 1</span>
                                        <input type="text" name="ref1" id="provisionincome_ref1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 2</span>
                                        <input type="text" name="ref2" id="provisionincome_ref2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 3</span>
                                        <input type="text" name="ref3" id="provisionincome_ref3" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 4</span>
                                        <input type="text" name="ref4" id="provisionincome_ref4" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 5</span>
                                        <input type="text" name="ref5" id="provisionincome_ref5" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <span>Reference 6</span>
                                        <input type="text" name="ref6" id="provisionincome_ref6" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">

                                <button type="submit" style="width:100px" class="btn btn-success"
                                    id="provisionincome_submit" data-bs-target="#" onclick="submitform(id)">
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"
                                    id="provisionincome_cancel_add" data-bs-target="#" onclick="cancleAddForm(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>


                                <button type="button" style="display:none" class="btn btn-success"
                                    id="provisionincome_update" data-bs-target="#" onclick="updateJob(id)">
                                    <i class="fa fa-save"></i> Update
                                </button>

                                <button type="button" style="display:none" class="btn btn-danger"
                                    id="provisionincome_cancel" data-bs-target="#" onclick="cancleUpdate(id)">
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <!-- <input type="hidden" name="service_type" id="service_type">
                                    <input type="hidden" name="service_reccode" id="service_reccode"> -->
                            </div>
                        </div>
                    </form>

                    <div class="d-flex col">
                        <button type="button" style="width:100px" class="btn btn-success mb-4" id="provisionincome_add"
                            data-bs-target="#" onclick="showForm(id)">
                            <i class="fa fa-plus-square"></i> Add
                        </button>

                        <div class="d-flex col justify-content-end">
                            <div class="d-flex justify-content-between col-xl-5">
                                <div class="d-flex col-6">
                                    <button type="button" class="btn btn-info mb-4 col-6"
                                        id="provisionincome_copyFromWorksheet" data-bs-target="#"
                                        onclick="copyJobsFromWorksheet(id)">
                                        <i class="fa fa-copy"></i> Copy from worksheet
                                    </button>
                                </div>
                                <div class="d-flex col-6">
                                    <input type="number" name="rows" id="utilities_rows" class="form-control col mr-2"
                                        placeholder="Number of rows">
                                    <button type="button" style="width:100px" class="btn btn-info mb-4"
                                        id="provisionincome_copy" data-bs-target="#" onclick="copyJobs(id)">
                                        <i class="fa fa-copy"></i> Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table id="provisionincome_table" class="table table-striped display nowrap"
                            style="width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col">line status</th>
                                    <th scope="col">Provision Income ID</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Description(Contract)</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Sub1</th>
                                    <th scope="col">Sub2</th>
                                    <th scope="col">Sub3</th>
                                    <th scope="col">Sub4</th>
                                    <th scope="col">Sub5</th>
                                    <th scope="col">Sub6</th>
                                    <th scope="col">Vehicle</th>
                                    <th scope="col">Operator</th>
                                    <th scope="col">Operator Name</th>
                                    <th scope="col">Charge as</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Diesel Rate</th>
                                    <th scope="col">From</th>
                                    <th scope="col">to</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col" width="5%">Qty</th>
                                    <th scope="col" width="10%">UOM</th>
                                    <th scope="col" width="15%">Contract number (Manual)</th>
                                    <th scope="col" width="15%">Contract number (Auto)</th>
                                    <th scope="col">Department </th>
                                    <th scope="col">Cost center</th>
                                    <th scope="col">Amount </th>
                                    <th scope="col">Charge(%) </th>
                                    <th scope="col">No charge</th>
                                    <th scope="col">Reimbursment</th>
                                    <th scope="col">Lump sum charge</th>
                                    <th scope="col">Vendor invoice Date</th>
                                    <th scope="col">Vendor invoice number</th>
                                    <th scope="col">Vendor invoice Value</th>
                                    <th scope="col">Vendor invoice Submission date</th>
                                    <th scope="col" style="width: 15%;">Reference 1</th>
                                    <th scope="col" style="width: 15%;">Reference 2</th>
                                    <th scope="col" style="width: 15%;">Reference 3</th>
                                    <th scope="col" style="width: 15%;">Reference 4</th>
                                    <th scope="col" style="width: 15%;">Reference 5</th>
                                    <th scope="col" style="width: 15%;">Reference 6</th>
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

</div>



<input required type="hidden" name="form_type" id="form_type">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {


        // $("#copy_submit").on('click',function(){
        // 	copy_submit();
        // });

        $("#menujob a.nav-link").on('click', function (event) {

            const tabId = $(this).attr('id');
            var form = tabId.split("-");
            const formData = document.getElementById(form[0] + "_data");
            if (formData) {
                document.getElementById(form[0] + "_data").reset();
                const inputs = formData.getElementsByTagName("input");

                if (inputs) {
                    for (let i = 0; i < inputs.length; i++) {
                        inputs[i].maxLength = 50;
                    }
                }
            }
            if (tabId == 'serviceother') {
                $("#" + tabId + "_vehicle").hide();
                $("#serviceother_service_line_type").val("manpower");
                $("#serviceother_charge_as").prop('disabled', true);
                $("#serviceother_position").prop('disabled', false);
            }

            const formStatus = document.getElementById(form[0] + "_line_status");

            if (formStatus) {
                $(`#${form[0]}_line_status`).val("Open");
                $(`#${form[0]}_cancel_reason`).prop('disabled', true);
            }


            $("#" + tabId + "_data").hide();
            $("#" + tabId + "_add").show();
            getDatatoTable(tabId);
            getContractDesc(form[0]);

            let select = "";
            if (tabId == "serviceother" || tabId == "agencyservice" || tabId == 'managementfree' || tabId == 'provisionincome') {
                select = document.getElementById(tabId + '_contract_number_auto');
            } else {
                select = document.getElementById(tabId + '_contract_number');
            }
            if (select) {
                select.classList.add('contractip')
            }
        });
    });

    // function cancleStatus(){
    //     if ($("#"+tabId+'_line_status').prop('open')) {
    //         $("#"+tabId+'_line_status').prop('disabled', true);
    //     } else {
    //         $("#"+tabId+'_line_status').prop('disabled', false);
    //     }
    // }


    function selectRoundTrip() {
        if ($('#round_trip').prop('checked')) {
            $('#transport_uom').val('R/Tp');
            $('#transport_uom').prop('disabled', true);
        } else {
            $('#transport_uom').val('');
            $('#transport_uom').prop('disabled', false);
        }
    }

    function changeServiceType(id) {
        const job = id.split('_');
        const val = document.getElementById(id);
        clearsevice(job[0]);
        if (val.value == "manpower") {
            $("#" + job[0] + "_vehicle").hide();
            $("#" + job[0] + "_operator").show();
            $("#" + job[0] + "_charge_as").prop('disabled', true);
            $("#" + job[0] + "_position").prop('disabled', false);
        }
        if (val.value == "vehicle") {
            $("#" + job[0] + "_vehicle").show();
            $("#" + job[0] + "_operator").hide();
            $("#" + job[0] + "_charge_as").prop('disabled', false);
            $("#" + job[0] + "_position").prop('disabled', true);
        }
        if (val.value == "others") {
            $("#" + job[0] + "_vehicle").show();
            $("#" + job[0] + "_operator").show();
            $("#" + job[0] + "_charge_as").prop('disabled', false);
            $("#" + job[0] + "_position").prop('disabled', false);
        }
        val.value = val.value;
    }

    function clearsevice(id) {
        $("#" + id + "_charge_as").val("");
        $("#" + id + "_position").val("");
    }

    function getDataService(id) {
        const job = id.split('_');
        const selectElement = document.getElementById(id);
        const selected = selectElement.options[selectElement.selectedIndex];
        const selectedValue = selected.getAttribute('name');
        if (job) {
            if (job[1] == "operator") {
                $('#serviceother_position').val(selectedValue);
            } else if (job[1] == "vehicle") {
                $('#serviceother_charge_as').val(selectedValue);
            }
        }
    }

    function copyJobs(id) { //copy worksheet เดียวกัน
        var form = id.split("_");
        var table = $('#' + form[0] + "_table").DataTable();
        const arrDataselect = [];
        var selectedCheckboxes = table.$('input[type="checkbox"]:checked');
        selectedCheckboxes.each(function () {
            var data = table.row($(this).parents('tr')).data();
            arrDataselect.push(data[3]);
            // console.log("Row data:", data[3]);
        });

        var inputRows = document.getElementById(form[0] + '_rows');
        var inputWscopyRows = document.getElementById(form[0] + '_wscopy');

        if (arrDataselect.length == 1) {
            if (inputRows) {
                inputRows.style.display = 'block';
            }
        } else if (arrDataselect.length > 1) {
            if (inputRows) {
                inputRows.style.display = 'none';
            }
        } else {
            swal({
                icon: "warning",
                text: "Please select Sevice Line",
                timer: 1000,
                buttons: false,
            });
        }

        if (inputWscopyRows.value && inputRows.value) {
            swal({
                icon: "warning",
                text: "Do you want Copy Sevice Line From ?",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
            });
        } else {

        }
        // console.log("data :",arrDataselect);
    }

    function findWorksheet() {
        $('#menuCopy').hide();
        $('#tabMenuCopy').hide();
        if ($('#wscopy').val()) {
            var idworksheet = $('#wscopy').val();
            var header = idworksheet.replace(/[0-9]/g, '');
            var ws = $('#worksheet_id').val().replace(/[0-9]/g, '');

            // console.log(ws,header)
            if (ws == header) {
                checkSameCustomer();
            } else {
                swal({
                    icon: "warning",
                    text: "Sorry, Can't Copy Service from " + idworksheet + " as they are in different service ",
                    timer: 4000,
                    buttons: false,
                });
            }

        } else {
            swal({
                icon: "warning",
                text: "Please fill in worksheet id.",
                timer: 2000,
                buttons: false,
            });
        }
    }

    function checkSameCustomer() {
        var idworksheet = $('#wscopy').val();
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/checkSameCustomer.php?wsid=' + idworksheet,
            success: function (data) {
                if (data.Status == 1) {
                    if (data.data[0]) {
                        if (data.data[0]['customer'] == $('#customer').val()) {
                            countRowJob($('#wscopy').val(), "copy");
                            $('#menuCopy').show();
                        } else {
                            swal({
                                icon: "error",
                                text: `Sorry, customer not match `,
                                timer: 3000,
                                buttons: false,
                            });
                        }
                    } else {
                        swal({
                            icon: "error",
                            text: `Sorry, can't find worksheet `,
                            timer: 3000,
                            buttons: false,
                        });
                    }

                } else {
                    swal({
                        icon: "error",
                        text: `Sorry, can't find worksheet `,
                        timer: 3000,
                        buttons: false,
                    });
                }
            }
        })
    }

    function copyJobsFromWorksheet(id) { //getCheckbox
        $('#modalcopyFromWorksheet').modal('show');
        $('#vieweditmodal').modal('hide');
        $('#menuCopy').hide();

        $("#menuCopy a.nav-link").off('click').on('click', function (event) {
            $('#tabMenuCopy').show();

            const tabId = $(this).attr('id');
            var form = tabId.split("/");
            var job = form[1].split("-");
            console.log(job[0])
            if (form[1]) {
                const worksheet_id = $('#wscopy').val();
                var header = worksheet_id.replace(/[0-9]/g, '');
                let type;
                if (header == "WS") {
                    type = 'worksheet';
                }
                if (header == "JO") {
                    type = 'job';
                }

                checkbox(job[0], type)
            }
        });

    }


    async function CopyService() {


        const allCheckbox = document.getElementsByName('wscopyid');

        const arrCheckbox = [];
        if (allCheckbox) {
            allCheckbox.forEach(el => {

                if (el.checked == true) {
                    arrCheckbox.push(el.value);
                }
            });
        }
        if (arrCheckbox.length == 0) {
            alert('กรุณาเลือก Service ก่อนทำการ Copy')
        } else {
            let service = '';
            $("#menuCopy a.nav-link").each(function () {
                if ($(this).hasClass("active")) {
                    service = $(this).attr('id');
                }
            });

            const splitS = service.split('/');
            const nameService = splitS[1].split('-')

            var idworksheet = $('#wscopy').val();
            var header = idworksheet.replace(/[0-9]/g, '');
            let type;
            if (header == "WS") {
                type = 'worksheet';
            }
            if (header == "JO") {
                type = 'job';
            }
            let index = 0;
            for (const id of arrCheckbox) {
                const result = await copyNewService(id, nameService[0], type, idworksheet);

                if (result && result.status === 0) {
                    console.log(result, Object.keys(result['mg']).length)
                    swal({
                        icon: "error",
                        text: `Sorry, Copy Error `,
                        timer: 3000,
                        buttons: false,
                    });
                    break;
                } else if (result.status === 1 && index === arrCheckbox.length - 1) {
                    countRowJob($('#worksheet_id').val(), "worksheet");
                    getDatatoTable(nameService);
                    swal({
                        icon: "success",
                        text: `Copy Success `,
                        timer: 2000,
                        buttons: false,
                    })
                }
                index++;
            }

        }
    }


    async function copyNewService(id, nameService, type, idworksheet) {

        const api = 'api/copy_servicefromotherworksheet.php?idService=' + id +
            "&nameservice=" + nameService +
            "&type=" + type +
            "&wsid=" + $('#worksheet_id').val() +
            "&idWsFind=" + idworksheet;
        try {
            const res = await $.ajax({
                type: 'GET',
                dataType: "json",
                url: api,
            });

            if (res.status == 0) {
                return res;
            } else {
                return res;
            }
        } catch (error) {
            console.error("Error in AJAX request:", error);
        }
    }


    function checkbox(service, type) {
        const arrApi = {
            "transport": 'view_worksheet_transport.php',
            "manpower": 'view_worksheet_manpower.php',
            "cargo": 'view_worksheet_cargo_handling.php',
            "immigration": 'view_worksheet_immigration.php',
            "taxi": 'view_worksheet_taxi.php',
        }

        if (service != 'transport' && service != 'manpower' && service != 'cargo' &&
            service != 'immigration' && service != 'taxi') {
            arrApi[service] = "view_worksheet_job.php?id=" + $('#wscopy').val() + "&job=" + service + "&type=" + type;
        } else {
            arrApi[service] = arrApi[service] + '?worksheet_id=' + $('#wscopy').val();
        }

        if (arrApi[service]) {
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: 'api/' + arrApi[service],
                success: function (data) {
                    if (data) {
                        const divCheckbox = document.getElementsByClassName('divCheckbox')[0];

                        divCheckbox.id = service + 'copy-tab';
                        divCheckbox.innerHTML = '';
                        divCheckbox.classList.add('show', 'active');

                        data['data'].forEach((element, index) => {
                            let val;
                            if (service != 'transport' && service != 'manpower' && service != 'cargo' &&
                                service != 'immigration' && service != 'taxi') {
                                val = element[3];
                            } else {
                                val = element[1];
                            }

                            // สร้าง div
                            const div = document.createElement('div');
                            div.className = 'd-flex col-3 mb-3';

                            // สร้าง input
                            const input = document.createElement('input');
                            input.type = 'checkbox';
                            // input.id = element[3] ;
                            input.className = 'form-check';
                            input.name = 'wscopyid';
                            input.value = val;

                            // สร้าง span
                            const span = document.createElement('span');
                            span.className = 'ml-2';
                            span.textContent = val;

                            // เพิ่ม input และ span เข้าไปใน div
                            div.appendChild(input);
                            div.appendChild(span);
                            divCheckbox.appendChild(div);
                        });
                    }
                }
            });
        }

    }


    function showForm(id) {
        var form = id.split("_");
        $("#" + form[0] + "_add").hide();
        getHeader(form[0]);
        if (form[0] == 'rental') {
            get_vehicle_handling($("#customer").val());
        }

        if (form[0] == 'serviceother') {
            $("#" + form[0] + "_vehicle").hide();
            $("#serviceother_service_line_type").val("manpower");
        }

        cancleUpdate(id)
    }


    function getHeader(tab) {
        var idworksheet = $('#worksheet_id').val();
        var header = idworksheet.replace(/[0-9]/g, '');
        let type;
        if (header == "WS") {
            type = 'worksheet';
        }
        if (header == "JO") {
            type = 'job';
        }
        let input = "";
        if (tab == 'warehousing') {
            input = 'warehousing_space_rental';
        } else {
            input = tab;
        }

        let divtab;
        if (tab == 'cargo_handling') {
            divtab = document.getElementById('cargo_service_id');
        } else {
            divtab = document.getElementById(input + '_id');
        }
        if (divtab) {
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: 'api/get_header_job.php?job=' + tab + "&type=" + type,
                success: function (res) {
                    if (res.status == 1) {

                        divtab.value = res['id'];
                        divtab.setAttribute('readonly', 'true');
                        $("#" + tab + "_add").hide();
                        $("#" + tab + "_data").show();
                    } else {
                        console.log(res);
                    }
                }
            });
        }

    }

    function countRowJob(worksheet, type) {
        let menujob;
        if (type == "worksheet") {
            menujob = document.getElementById('menujob');
        } else {
            menujob = document.getElementById('menuCopy');
        }


        const listItems = menujob.getElementsByTagName('a');
        const arrTable = {
            "transport-nav": 'worksheet_cargo_transport',
            "manpower-nav": 'worksheet_manpower',
            "cargo-nav": 'worksheet_cargo_handling',
            "immigration-nav": 'worksheet_immigration',
            "taxi-nav": 'worksheet_taxi',
            warehousing: 'worksheet_warehousing_space_rental',
            utilities: 'worksheet_utilities',
            rental: 'worksheet_rental',
            hotelbooking: 'worksheet_hotel_booking',
            ticketbooking: 'worksheet_ticket_booking_job',
            serviceother: 'worksheet_service_other_job',
            agencyservice: 'worksheet_agency_service',
            managementfree: 'worksheet_management_free',
            provisionincome: 'worksheet_provision_income',
            customerclearancecargo: 'worksheet_customer_clearance_cargo',
            customerclearancevessel: 'worksheet_customer_clearance_vessel'
        };
        const obj = [];
        if (listItems) {
            for (let i = 0; i < listItems.length; i++) {
                if (type == "copy") {
                    const newCopy = listItems[i].id.split('/');
                    listItems[i].id = newCopy[1]
                }
                const find = arrTable[listItems[i].id];
                if (find) {
                    const obj = {
                        type: 'worksheet',
                        worksheet_id: worksheet,
                        name: listItems[i].id,
                        table: find
                    }
                    if (type == "copy") {
                        const oldId = "copy/" + listItems[i].id;
                        obj.name = oldId;
                        listItems[i].id = oldId;
                    }
                    getRowsJob(obj);
                }
            }
        }
    }

    function getRowsJob(data) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            data: data,
            url: 'api/view_countRows.php',
            success: function (res) {

                if (res.status == 1) {
                    const divTab = document.getElementById(res.data[0].name);
                    if (divTab) {

                        const span = divTab.getElementsByTagName('span');

                        if (span.length > 0) {
                            span[0].innerText = res.data[0]?.rows || 0;
                        }
                    }
                }
                // else {
                //     swal({
                //         icon: "error",
                //         text: `Sorry, can't save data`,
                //         timer: 3000,
                //         buttons: false,
                //         });
                //         setTimeout(() => {
                //         // location.reload();
                //     }, 3100);
                // }
            }
        });
    }

    function submitform(formname) {
        var formName = formname.split("_");
        var idworksheet = $('#worksheet_id').val();
        var header = idworksheet.replace(/[0-9]/g, '');
        let type;
        if (header == "WS") {
            type = 'worksheet';
        }
        if (header == "JO") {
            type = 'job';
        }

        if (formName) {
            var name = '#' + formName[0] + '_data';
            $(name).off('submit');
            $(name).submit(function (e) {
                e.preventDefault();
                var $form = $(name);
                var dataForm = getFormData($form);
                dataForm['worksheet_id'] = document.getElementById('worksheet_id').value;
                dataForm['customer'] = document.getElementById('customer').value;
                //  if(dataForm['destination_date']){
                //     // var destination = dataForm['destination_date'].split("|");
                //     // dataForm['destination_date'] = destination[0];
                //     dataForm['destination_location'] = destination[1];
                //    
                //  }


                if (formName[0] == 'serviceother' || formName[0] == "agencyservice" || formName[0] == 'managementfree' || formName[0] == 'provisionincome') {
                    const operator = document.getElementById(formName[0] + '_operator_id');
                    if (operator) {
                        const operatorname = operator.options[operator.selectedIndex].text;
                        const name = operatorname.split("|");
                        if (name[0]) {
                            dataForm['operator_name'] = name[0];
                        }
                    }
                }

                if (formName[0] == 'serviceother') {
                    if (dataForm['service_line_type'] == 'manpower') {
                        dataForm['vehicle_id'] = "";
                    }
                    if (dataForm['service_line_type'] == 'vehicle') {
                        dataForm['operator_id'] = "";
                        dataForm['operator_name'] = "";
                    }

                }
                // console.log(dataForm, dataForm['service_line_type'])

                let headBarcode = '';
                let barcodenumber = '';

                if (formName[0] == 'warehousing') {
                    headBarcode = 'WH';
                    barcodenumber =
                        headBarcode +
                        dataForm['name'] + '-' +
                        document.getElementById('branch').value + '-' + //branch
                        dataForm['location'] + '-' +
                        dataForm['type'] + '-' +
                        dataForm['sub1'] + '-' +
                        '00' + '-' +
                        dataForm['sub3'] + '-' +
                        dataForm['sub4'] + '-' +
                        dataForm['sub5'] + '-' +
                        '00';
                    dataForm['barcode'] = barcodenumber;
                }


                var obj = {
                    name: formName[0],
                    data: dataForm
                };
                if (obj) {
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        data: obj,
                        url: 'api/insert_job_Detail.php' + "?type=" + type,
                        success: function (res) {
                            console.log(res)
                            if (res.status == 1) {
                                swal({
                                    icon: "success",
                                    text: res.msg,
                                    timer: 2000,
                                    buttons: false,
                                });
                                getDatatoTable(formName[0]);
                                countRowJob(dataForm['worksheet_id'], "worksheet");
                                cancleAddForm(formName[0]);
                            } else if (res.status == 0) {
                                swal({
                                    icon: "error",
                                    text: `Sorry, can't save data`,
                                    timer: 3000,
                                    buttons: false,
                                });
                            }
                        }
                    });
                }

            })
        }
    }


    function updateJob(id) {
        var formName = id.split('_');
        var idworksheet = $('#worksheet_id').val();
        var header = idworksheet.replace(/[0-9]/g, '');
        let typeSheet;
        if (header == "WS") {
            typeSheet = 'worksheet';
        }
        if (header == "JO") {
            typeSheet = 'job';
        }

        if (formName[0]) {
            var name = '#' + formName[0] + '_data';
            var $form = $(name);
            var dataForm = getFormData($form);
            const formid = document.getElementById(formName[0] + '_data');
            if (formName[0] == 'serviceother') {
                if (dataForm['service_line_type'] == 'manpower') {
                    dataForm['vehicle_id'] = "";
                }
                if (dataForm['service_line_type'] == 'vehicle') {
                    dataForm['operator_id'] = "";
                    dataForm['operator_name'] = "";
                }

            }
            if (formName[0] == 'serviceother' || formName[0] == "agencyservice" || formName[0] == 'managementfree' || formName[0] == 'provisionincome') {
                const operator = document.getElementById(formName[0] + '_operator_id');
                if (dataForm['operator_id'] != "") {
                    const operatorname = operator.options[operator.selectedIndex].text;
                    const name = operatorname.split("|");
                    if (name[0]) {
                        dataForm['operator_name'] = name[0];
                    } else {
                        swal('Please,select Operator')
                    }
                }
            }
            if (dataForm['destination_date']) {

                var destination = dataForm['destination_date'].split("|");
                dataForm['destination_date'] = destination[0];
                if (destination[1]) {
                    dataForm['destination_location'] = destination[1]
                }
            }
            const checkRq = formid.querySelectorAll('[required]');
            let allFieldsValid = true;
            checkRq.forEach((field) => {
                if (!field.value) { // เช็คว่ามีค่าในฟิลด์หรือไม่
                    allFieldsValid = false;
                    field.classList.add('border', 'border-danger');
                } else {
                    field.classList.remove('border', 'border-danger');
                }
            });
            if (allFieldsValid == true) {
                const checkboxes = formid.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach(checkbox => {
                    if (!checkbox.checked) {
                        dataForm[checkbox.name] = null;
                    }
                });


                const worksheet_id = $('#worksheet_id').val();
                var obj = {
                    type: formName[0],
                    data: dataForm,
                    worksheet_id: worksheet_id,
                };

                if (obj) {
                    swal({
                        icon: "warning",
                        text: "Update data ?",
                        buttons: true, // แสดงปุ่ม "OK"
                    }).then((willProceed) => {
                        if (willProceed) {
                            $.ajax({
                                type: 'POST',
                                dataType: "json",
                                data: obj,
                                url: 'api/update_details_job.php?typeSheet=' + typeSheet,
                                success: function (res) {
                                    console.log(res)
                                    if (res.status == 1) {
                                        swal({
                                            icon: "success",
                                            text: "Update success",
                                            timer: 2000,
                                            buttons: false,
                                        });
                                        document.getElementById(formName[0] + "_data").reset();
                                        getDatatoTable(formName[0])
                                        get_Details(res.id, formName[0], worksheet_id)

                                    } else if (res.status == 0) {
                                        swal({
                                            icon: "error",
                                            text: `Sorry, can't update data`,
                                            timer: 3000,
                                            buttons: false,
                                        });
                                    }
                                }
                            });
                        }

                    });

                }

            } else {
                swal({
                    icon: "warning",
                    text: "Please fill out the information completely.",
                    timer: 3000,
                    buttons: false,
                });
            }



        }
    }

    function cancleAddForm(t) {
        var form = t.split('_');
        var formElement = document.getElementById(form[0] + '_data');
        if (formElement) {
            formElement.reset();
            $("#" + form[0] + "_data").hide();
            $("#" + form[0] + "_add").show();
        } else {
            console.error('Form not found: ' + form[0] + '_data');
        }
    }

    function cancleUpdate(t) {
        var tab = t.split('_');
        // document.getElementById(tab[0] + "_data").reset();
        cancleAddForm(tab[0])
        let select = "";
        if (tab[0] == "serviceother" || tab[0] == "agencyservice" || tab[0] == 'managementfree' || tab[0] == 'provisionincome') {
            select = document.getElementById(tab[0] + '_contract_number_auto');
        } else {
            select = document.getElementById(tab[0] + '_contract_number');
        }
        select.innerHTML = '';
        $('#' + tab[0] + "_update").hide();
        $('#' + tab[0] + "_cancel").hide();
        $('#' + tab[0] + "_submit").show();
        $('#' + tab[0] + "_cancel_add").show();

    }

    function getDatatoTable(tab) {
        var tabtable = tab + '_table';
        var divTable = document.getElementById(tabtable);
        const worksheet_id = $('#worksheet_id').val();

        var header = worksheet_id.replace(/[0-9]/g, '');
        let type;
        if (header == "WS") {
            type = 'worksheet';
        }
        if (header == "JO") {
            type = 'job';
        }

        if (divTable) {


            var api = "api/view_worksheet_job.php?id=" + $('#worksheet_id').val() + "&job=" + tab + "&type=" + type;
            var table = $('#' + tabtable).DataTable({
                "ajax": api,
                "columnDefs": [{
                    "targets": 0,
                    "data": null,
                    "defaultContent": btn_table_in_popup
                }, {
                    "targets": 1,
                    "data": null,
                    "defaultContent": "<input type=\"checkbox\" class=\"form-check chkbox\">"
                }],
                "bDestroy": true,
                "initComplete": function () {

                    var tableBody = $('#' + tabtable + ' tbody');
                    tableBody.off('click', '.editbt');
                    tableBody.off('click', '.deletebt');

                    tableBody.on('click', '.editbt', function () {

                        $("#" + tab + "_data").show();
                        $("#" + tab + "_add").hide();
                        $('#' + tab + "_cancel_add").hide();
                        $('#' + tab + "_update").show();
                        $('#' + tab + "_cancel").show();
                        $('#' + tab + "_submit").hide();

                        var data = table.row($(this).parents('tr')).data();



                        if (data[2]) {
                            setCancle(tab, data[2]);
                        }


                        if (data[3]) {
                            get_Details(data[3], tab, worksheet_id)
                        }
                    });

                    tableBody.on('click', '.deletebt', function () {
                        var data = table.row($(this).parents('tr')).data();

                        if (data[3]) {
                            swal({
                                icon: "warning",
                                text: "Delete data ?",
                                buttons: true, // แสดงปุ่ม "OK"
                            }).then((willProceed) => {
                                if (willProceed) {

                                    var obj = {
                                        type: tab,
                                        id: data[3],
                                        worksheet_id: worksheet_id
                                    }
                                    $.ajax({
                                        type: 'POST',
                                        dataType: "json",
                                        data: obj,
                                        url: 'api/delete_details_job.php?typeSheet=' + type,
                                        success: function (res) {
                                            if (res.status == 1) {
                                                swal({
                                                    icon: "success",
                                                    text: res.msg,
                                                    timer: 2000,
                                                    buttons: false,
                                                });
                                                countRowJob(worksheet_id, "worksheet");
                                                getDatatoTable(tab);
                                                cancleAddForm(tab);
                                                cancleUpdate(tab);
                                            } else if (res.status == 0) {
                                                swal({
                                                    icon: "error",
                                                    text: res.msg,
                                                    timer: 3000,
                                                    buttons: false,
                                                });
                                            }
                                        }
                                    });
                                }

                            });
                        }

                    });
                }, "processing": true,
            });


        }
    }

    function setCancle(service, status) {
        getContractDesc(service);
        if (status == "Open") {
            $("#" + service + "_cancel_reason").prop('disabled', true);
        } else if (status = "Cancelled") {
            $("#" + service + "_cancel_reason").prop('disabled', false);
        }
    }

    function get_Details(id, type, worksheet_id) {
        var header = worksheet_id.replace(/[0-9]/g, '');
        let typeSheet;
        if (header == "WS") {
            typeSheet = 'worksheet';
        }
        if (header == "JO") {
            typeSheet = 'job';
        }

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_details_job.php?id=' + id + '&type=' + type + '&worksheet_id=' + worksheet_id + '&typeSheet=' + typeSheet,
            success: function (res) {

                if (res) {
                    Object.keys(res).forEach((el, index) => {
                        
                        let ip;
                        if (el.includes(type)) {
                            ip = document.getElementById(el);
                        } else {
                            ip = document.getElementById(type + "_" + el);
                        }
                        console.log(ip,el,res[el])
                        if (ip) {
                            if (el == 'contract_number' || el == 'contract_number_auto') {
                                let dropdown = "";

                                if (type == "serviceother" || type == "agencyservice" || type == 'managementfree' || type == 'provisionincome') {
                                    dropdown = document.getElementById(type + '_contract_number_auto');
                                } else {
                                    dropdown = document.getElementById(type + '_contract_number');
                                }

                                dropdown.innerHTML = '';
                                const option = document.createElement('option');
                                option.value = res[el];
                                option.textContent = res[el];
                                dropdown.appendChild(option);
                            } else {
                                if (el == 'service_line_type') {
                                    if (res[el] == "manpower") {
                                        $("#" + type + "_vehicle").hide();
                                        $("#" + type + "_operator").show();
                                    }
                                    if (res[el] == "vehicle") {
                                        $("#" + type + "_vehicle").show();
                                        $("#" + type + "_operator").hide();
                                    }
                                    if (res[el] == "others") {
                                        $("#" + type + "_vehicle").show();
                                        $("#" + type + "_operator").show();
                                    }
                                }

                                if (ip.type === "checkbox") {
                                    if (res[el] == 1) {
                                        ip.checked = true;
                                    } else {
                                        ip.checked = false;
                                    }
                                } else {

                                    //   if(el == "destination_date"){
                                    //     ip.value = res[el] + "|" + res?.['destination_location'];   
                                    //   }
                                    //   else{
                                    ip.value = res[el];
                                    //   }
                                }
                            }

                        }

                    })
                }
            }
        })
    }

    function changeLocation(id) {
        getContract(id);
        const location = document.getElementById(id);

        if (location.value) {
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: 'api/view_detail_input_job.php?id=' + location.value + '&type=location',
                success: function (res) {
                    if (res.status == 1) {
                        const job = id.split('_');
                        const costcenter = document.getElementById(job[0] + '_cost_center');
                        const department = document.getElementById(job[0] + '_department');

                        if (costcenter && department) {
                            costcenter.value = res['cost_center'];
                            department.value = res['department'];
                        }
                    }

                }
            });
        }
    }

    function changeHotel(id) {
        const hotel = document.getElementById(id);
        if (hotel.value) {
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: 'api/view_detail_input_job.php?id=' + hotel.value + '&type=hotel',
                success: function (res) {
                    if (res.status == 1) {
                        const job = id.split('_');
                        const costcenter = document.getElementById(job[0] + '_cost_center');
                        const department = document.getElementById(job[0] + '_department');

                        if (costcenter && department) {
                            costcenter.value = res['cost_center'];
                            department.value = res['department'];
                        }
                    }

                }
            });
        }
    }

    function changeContract(id) {
        const contract = document.getElementById(id);
        const selectedText = contract.options[contract.selectedIndex].text;
        const job = id.split('_');
        if (selectedText) {
            const valueContract = selectedText.split(' | ');
            console.log(valueContract)
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: 'api/view_detail_input_job.php?contractLineId=' + valueContract[1] + '&contractId=' + valueContract[0] + '&job=' + job[0] + '&type=contract_number',
                success: function (res) {

                    if (res.status == 1) {
                        const amount_system = document.getElementById(job[0] + '_amount_system_price');
                        const description = document.getElementById(job[0] + '_contract_description');

                        if (description) {
                            description.value = valueContract[1];
                            getcontract(job[0], valueContract[1], valueContract[0])
                        }

                        if (amount_system) {
                            amount_system.value = res['charge_per_unit'];
                        }
                        if (res['destination'] && res['destination_date'] && res['airline_name'] && res['flight_number']) {
                            const airline_name = document.getElementById(job[0] + '_airline_name');
                            // const flight_number = document.getElementById(job[0]+'_flight_number');
                            const destination = document.getElementById(job[0] + '_destination_date');

                            //    if(destination){
                            //      destination.value =  res['destination_date']+" | "+ res['destination']
                            //    }                             
                        }

                    }

                }
            });
        }
    }


    function getcontract(job, linecontract, contract) {

        let contractline;
        if (job == "transport" || job == "manpower" || job == "cargo" || job == "taxi" || job == "immigration") {
            contractline = "contract_line";
        } else {
            contractline = "contract_line_number";
        }

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/view_detail_input_job.php?contractLineId=' + linecontract + '&contractId=' + contract + '&job=' + job + '&type=contract_desc',
            success: function (res) {
                console.log(res.data[0])
                if (res.status == 1) {
                    Object.keys(res.data[0]).forEach(el => {

                        if (el != 'contract_no' && el != contractline && el != 'status' && el != 'customer_code' && el != 'customer_reference' && el != 'user_type' && el != 'reccode') {

                            let ip = document.getElementById(job + "_" + el);


                            if ((job != 'taxi' && job != 'immigration' && job != 'manpower' && job != 'cargo' && job != 'transport') && el == 'barcode_type') {
                                ip = document.getElementById(job + "_type");

                            }

                            if ((job == 'taxi' || job == 'immigration' || job == 'manpower' || job == 'cargo' || job == 'transport') && el == 'barcode_type') {
                                ip = document.getElementById(job + "_barcode_type");
                            }

                            if (job == 'manpower' && el == "type") {
                                ip = "";
                            }

                            if (el == 'barcode_location' || el == 'location') {
                                ip = document.getElementById(job + "_location");
                            }

                            if (el == 'barcode_service' || el == 'name') {
                                ip = document.getElementById(job + "_name");
                            }

                            if (el == 'fixed_space' || el == 'fix_space') {
                                ip = document.getElementById(job + "_fix_space");
                            }

                            if (el == 'minimum_qty' || el == 'qty' || el == 'quantity') {
                                ip = document.getElementById(job + "_qty");
                            }
                            if (el == 'charge_per_unit') {
                                ip = document.getElementById(job + "_charge");
                            }

                            if (el == 'destination') {
                                ip = document.getElementById(job + "_destination_location");
                            }


                            if (el == 'barcode_branch' || el == 'branch') {
                                ip = document.getElementById(job + "_branch");
                            }

                            if (el == 'from_contract_location') {
                                ip = document.getElementById(job + "_from_contract");
                            }
                            if (el == 'to_contract_location') {
                                ip = document.getElementById(job + "_to_contract");
                            }



                            if (el == 'transportation_from') {
                                ip = document.getElementById(job + "_transport_from");
                            }

                            if (el == 'transportation_to') {
                                ip = document.getElementById(job + "_transport_to");
                            }


                            if (el.includes('sub') && (job == 'taxi' || job == 'immigration' || job == 'manpower' || job == 'cargo' || job == 'transport')) {
                                const replacedText = el.replace(/sub/g, "type");
                                ip = document.getElementById(job + "_" + replacedText);
                            }


                            if (ip) {

                                if (el.includes('date')) {
                                    ip.value = moment(res.data[0][el]['date']).format('YYYY-MM-DD');
                                } else {
                                    ip.value = res.data[0][el];
                                }


                                if (ip.type == "checkbox") {
                                    if (res.data[0][el] == 1) {
                                        ip.checked = true;
                                    } else {
                                        ip.checked = false;
                                    }
                                }
                            }

                        }

                    })



                }

            }
        });

    }


    function changeContractDes(id) {
        const contract = document.getElementById(id);
        const selectedText = contract.options[contract.selectedIndex].text;
        const job = id.split('_');
        const valueContract = selectedText.split(' | ');
        let sl = "";

        if (job[0] == "serviceother" || job[0] == "agencyservice" || job[0] == 'managementfree' || job[0] == 'provisionincome') {
            sl = document.getElementById(job[0] + '_contract_number_auto');
        } else if (job[0] == "immigration") {
            sl = document.getElementById(job[0] + '_agreement_number');
        } else {
            sl = document.getElementById(job[0] + '_contract_number');
        }

        sl.innerHTML = "";

        const option = document.createElement('option');
        option.value = valueContract[1];
        option.textContent = valueContract[0] + " | " + valueContract[1];
        sl.appendChild(option);
        sl.value = valueContract[1]

        if (contract.value && valueContract[0]) {

            let contractline;
            if (job[0] == "transport" || job[0] == "manpower" || job[0] == "cargo" || job[0] == "taxi" || job[0] == "immigration") {
                contractline = "contract_line";
            } else {
                contractline = "contract_line_number";
            }
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: 'api/view_detail_input_job.php?contractLineId=' + valueContract[1] + '&contractId=' + valueContract[0] + '&job=' + job[0] + '&type=contract_desc',
                success: function (res) {
                    console.log(res)

                    if (res.status == 1) {
                        Object.keys(res.data[0]).forEach(el => {

                            if (el != 'contract_no' && el != contractline && el != 'status' && el != 'customer_code' && el != 'customer_reference' && el != 'user_type' && el != 'reccode') {

                                let ip = document.getElementById(job[0] + "_" + el);

                                if ((job[0] != 'taxi' && job[0] != 'immigration' && job[0] != 'manpower' && job[0] != 'cargo' && job[0] != 'transport') && el == 'barcode_type') {
                                    ip = document.getElementById(job[0] + "_type");

                                }

                                if ((job[0] == 'taxi' || job[0] == 'immigration' || job[0] == 'manpower' || job[0] == 'cargo' || job[0] == 'transport') && el == 'barcode_type') {
                                    ip = document.getElementById(job[0] + "_barcode_type");
                                }

                                if (job[0] == 'manpower' && el == "type") {
                                    ip = "";
                                }

                                if (el == 'barcode_location' || el == 'location') {
                                    ip = document.getElementById(job[0] + "_location");
                                }

                                if (el == 'barcode_service' || el == 'name') {
                                    ip = document.getElementById(job[0] + "_name");
                                }

                                if (el == 'fixed_space' || el == 'fix_space') {
                                    ip = document.getElementById(job[0] + "_fix_space");
                                }

                                if (el == 'minimum_qty' || el == 'qty' || el == 'quantity') {
                                    ip = document.getElementById(job[0] + "_qty");
                                }
                                if (el == 'charge_per_unit') {
                                    ip = document.getElementById(job[0] + "_charge");
                                }

                                if (el == 'destination') {
                                    ip = document.getElementById(job[0] + "_destination_location");
                                }


                                if (el == 'transportation_from') {
                                    ip = document.getElementById(job[0] + "_transport_from");
                                }

                                if (el == 'transportation_to') {
                                    ip = document.getElementById(job[0] + "_transport_to");
                                }

                                if (el == 'barcode_branch' || el == 'branch') {
                                    ip = document.getElementById(job[0] + "_branch");
                                }

                                if (el == 'from_contract_location') {
                                    ip = document.getElementById(job[0] + "_from_contract");
                                }
                                if (el == 'to_contract_location') {
                                    ip = document.getElementById(job[0] + "_to_contract");
                                }

                                if (el.includes('sub') && (job[0] == 'taxi' || job[0] == 'immigration' || job[0] == 'manpower' || job[0] == 'cargo' || job[0] == 'transport')) {
                                    const replacedText = el.replace(/sub/g, "type");
                                    ip = document.getElementById(job[0] + "_" + replacedText);
                                }


                                console.log(ip)

                                if (ip) {

                                    if (el.includes('date')) {
                                        if (res.data[0][el]['date']) {
                                            ip.value = moment(res.data[0][el]['date']).format('YYYY-MM-DD');
                                        } else {
                                            ip.value = moment(res.data[0][el]).format('YYYY-MM-DD');
                                        }

                                    } else {
                                        ip.value = res.data[0][el];
                                    }
                                   

                                    if (ip.type == "checkbox") {
                                        if (res.data[0][el] == 1) {
                                            ip.checked = true;
                                        } else {
                                            ip.checked = false;
                                        }
                                    }
                                }
                            }

                        })



                    }

                }
            });
        }
    }

    function getContractDesc(job) {
        const nameJob = job.split('_');
        const customer = $("#customer").val();

        const selectDesc = document.getElementById(nameJob[0] + "_contract_description");
        selectDesc.innerHTML = "";

        if (nameJob[0] && customer) {
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: 'api/view_detail_input_job.php?customer=' + customer + '&job=' + nameJob[0] + '&type=contract_desc_all',
                success: function (res) {
                    if (res.status == 1) {


                        let contract;
                        if (nameJob[0] == "transport" || nameJob[0] == "manpower" || nameJob[0] == "cargo" || nameJob[0] == "taxi" || nameJob[0] == "immigration") {
                            contract = "contract_line";
                        } else {
                            contract = "contract_line_number";
                        }

                        if (selectDesc.options.length == 0) {
                            res["data"].forEach((el) => {
                                const optionDesc = document.createElement('option');
                                optionDesc.value = "";
                                optionDesc.textContent = "";
                                selectDesc.appendChild(optionDesc);
                                if(el[contract] != null && el[contract] != "-"){
                                  optionDesc.value = el[contract].trim();
                                  console.log(optionDesc.value)
                                }else{
                                    optionDesc.value = el[contract]
                                }
                                
                                optionDesc.textContent = el.contract_no + " | " + el[contract] + " | " + el.description;
                                selectDesc.appendChild(optionDesc);
                            })
                        }

                    }

                }
            });
        }
    }

    function createContractLine(id) {
        const nameJob = id.split('_');
        let select = "";

        if (nameJob[0] == "serviceother" || nameJob[0] == "agencyservice" || nameJob[0] == 'managementfree' || nameJob[0] == 'provisionincome') {
            select = document.getElementById(nameJob[0] + '_contract_number_auto');
        } else if (nameJob[0] == "immigration") {
            select = document.getElementById(nameJob[0] + '_agreement_number');
        } else {
            select = document.getElementById(nameJob[0] + '_contract_number');
        }

        const desc = document.getElementById(nameJob[0] + '_contract_description');
        const selectedText = desc.options[desc.selectedIndex].text;
        const text = selectedText.split(" | ");

        if (select && text) {
            select.innerHTML = "";
            const option = document.createElement('option');
            option.value = text[1];
            option.textContent = text[0] + " | " + text[1];
            select.appendChild(option);

        }

    }

    function getContract(job) {
        const nameJob = job.split('_');
        let select = "";

        if (nameJob[0] == "serviceother" || nameJob[0] == "agencyservice" || nameJob[0] == 'managementfree' || nameJob[0] == 'provisionincome') {
            select = document.getElementById(nameJob[0] + '_contract_number_auto');
        } else if (nameJob[0] == "immigration") {
            select = document.getElementById(nameJob[0] + '_agreement_number');
        } else {
            select = document.getElementById(nameJob[0] + '_contract_number');
        }

        select.innerHTML = "";

        let check = false;
        let obj = {};
        const destination = document.getElementById(nameJob[0] + '_destination');
        if (destination) {
            destination.value = "";
        }
        let sub1;
        let sub2;
        let sub3;
        let sub4;
        let sub5;
        let sub6;

        if (nameJob[0] == 'transport' || nameJob[0] == 'cargo' || nameJob[0] == 'immigration' || nameJob[0] == 'manpower' || nameJob[0] == 'taxi') {
            sub1 = $("#" + nameJob[0] + "_type1").val();
            sub2 = $("#" + nameJob[0] + "_type2").val();
            sub3 = $("#" + nameJob[0] + "_type3").val();
            sub4 = $("#" + nameJob[0] + "_type4").val();
            sub5 = $("#" + nameJob[0] + "_type5").val();
            sub6 = $("#" + nameJob[0] + "_type6").val();
        } else {
            sub1 = $("#" + nameJob[0] + "_sub1").val();
            sub2 = $("#" + nameJob[0] + "_sub2").val();
            sub3 = $("#" + nameJob[0] + "_sub3").val();
            sub4 = $("#" + nameJob[0] + "_sub4").val();
            sub5 = $("#" + nameJob[0] + "_sub5").val();
            sub6 = $("#" + nameJob[0] + "_sub6").val();
        }



        if (nameJob[0] == 'warehousing') {
            const name = $("#" + nameJob[0] + "_name").val();
            const location = $("#" + nameJob[0] + "_location").val();
            const type = $("#" + nameJob[0] + "_type").val();
            const uom = $("#" + nameJob[0] + "_uom").val();

            check = name && location && type && sub1 && sub2 && sub3 && sub4 && sub5 && sub6 && uom;
            obj = {
                job: nameJob[0],
                barcode_service: name,
                barcode_location: location,
                barcode_type: type,
                uom: uom,
            }
        } else if (nameJob[0] == 'utilities') {
            const location = $("#" + nameJob[0] + "_location").val();
            const type = $("#" + nameJob[0] + "_type").val();
            const uom = $("#" + nameJob[0] + "_uom").val();

            check = location && type && sub1 && sub2 && sub3 && sub4 && sub5 && sub6 && uom;
            obj = {
                job: nameJob[0],
                barcode_location: location,
                barcode_type: type,
                uom: uom,
            }

        } else if (nameJob[0] == 'rental') {
            const location = $("#" + nameJob[0] + "_location").val();
            const uom = $("#" + nameJob[0] + "_uom").val();

            check = location && sub1 && sub2 && sub3 && sub4 && sub5 && sub6 && uom;
            obj = {
                job: nameJob[0],
                barcode_location: location,
                uom: uom,
            }
        } else if (nameJob[0] == 'hotelbooking' || nameJob[0] == 'ticketbooking') {
            const type = $("#" + nameJob[0] + "_type").val();
            const uom = $("#" + nameJob[0] + "_uom").val();

            check = type && sub1 && sub2 && sub3 && sub4 && sub5 && sub6 && uom;
            obj = {
                job: nameJob[0],
                uom: uom,
                barcode_type: type,
            }
        } else if (nameJob[0] == 'serviceother' || nameJob[0] == 'agencyservice' || nameJob[0] == 'managementfree' || nameJob[0] == 'provisionincome' || nameJob[0] == 'customerclearancecargo' || nameJob[0] == 'customerclearancevessel') {
            //const type = $("#" + nameJob[0] + "_type").val();
            const uom = $("#" + nameJob[0] + "_uom").val();

            check = sub1 && sub2 && sub3 && sub4 && sub5 && sub6 && uom;
            obj = {
                job: nameJob[0],
                // barcode_type: type,
                uom: uom,
            }
        } else {
            const uom = $("#" + nameJob[0] + "_uom").val();

            check = sub1 && sub2 && sub3 && sub4 && sub5 && sub6 && uom;
            obj = {
                job: nameJob[0],
                // barcode_type: type,
                uom: uom,
            }
        }


        obj['sub1'] = sub1;
        obj['sub2'] = sub2;
        obj['sub3'] = sub3;
        obj['sub4'] = sub4;
        obj['sub5'] = sub5;
        obj['sub6'] = sub6;

        if (check) {

            const customercode = document.getElementById('customer');
            if (customercode) {
                obj['id'] = customercode.value;

                if (obj) {
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        data: obj,
                        url: 'api/get_contract_job_by_customer.php',
                        success: function (res) {
                            console.log(res)

                            if (res.status == 1) {

                                if (res.data) {


                                    if (select && res.data) {

                                        if (res.data.length > 0) {
                                            const emptyOption = document.createElement('option');
                                            emptyOption.value = "";
                                            emptyOption.textContent = "Select Contract";
                                            select.appendChild(emptyOption);
                                        }


                                        res.data.forEach(it => {
                                            console.log(it)
                                            const option = document.createElement('option');
                                            option.value = "";
                                            option.textContent = "";
                                            select.appendChild(option);
                                            option.value = it[1];
                                            option.textContent = it[0] + " | " + it[1];
                                            select.appendChild(option);

                                        });

                                    }

                                    if (res.data?.[0]?.[1]) {
                                        const amountsystem = document.getElementById(nameJob[0] + '_amount_system_price');
                                        if (amountsystem) {
                                            amountsystem.value = res.data[0][2];
                                        }
                                    }

                                    if (nameJob[0] == 'ticketbooking') {
                                        if (res.data?.[0]?.[3]) {
                                            const flight_number = document.getElementById(nameJob[0] + '_flight_number');

                                            if (flight_number) {
                                                flight_number.value = res.data[0][3];
                                            }
                                        }

                                        if (res.data?.[0]?.[4]) {
                                            const airline_name = document.getElementById(nameJob[0] + '_airline_name');

                                            if (airline_name) {
                                                airline_name.value = res.data[0][4];
                                            }
                                        }
                                    }

                                }
                            }
                        }
                    });
                }

            }
        }

    }


    function copy_submit() {
        if ($('#copy_id').val() != '' && $('#copy_num').val() != '') {
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: 'api/copy_service.php?copy_id=' + $('#copy_id').val() + '&copy_num=' + $('#copy_num').val() + '&copy_date=' + $('#worksheet_date').val(),
                success: function (data) {
                    //if(data.Status == "Success") {
                    //    swal(data.msg);
                    //} else {
                    //    swal(data.msg);
                    //}
                    swal(data.msg);
                }
            });
            //swal($('#copy_num').val());
            swal("Copy successfully.");
        } else {
            swal("Please fill in data");
        }
    }

    var worksheet_status = "";
    var re_open = <?php echo $_SESSION["reopen"]; ?>;

    function get_number(type) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_number.php?date=' + $("#worksheet_date").val() + '&type=' + type,
            success: function (data) {
                $('#worksheet_id').val(data.num);
                $('#worksheet_id').attr('readonly', true);
                var now = new Date();
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                var today = now.getFullYear() + "-" + (month) + "-" + (day);
                $('#worksheet_date').val(today);
                $('#worksheet_date').attr('readonly', true);
                $('#worksheet_status').val("Open");
                $('#worksheet_status').attr('readonly', true);
            }
        });
    }

    $("#worksheet_date").on('change', function () {
        if ($("#form_type").val() == 'insert') {
            $('#worksheet_id').attr('readonly', true);
            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear() + "-" + (month) + "-" + (day);
            $('#worksheet_date').val(today);
            $('#worksheet_date').attr('readonly', true);
            $('#worksheet_status').val("Open");
            $('#worksheet_status').attr('readonly', true);
        }
        //get_number();
    });

    function load_worksheet(worksheet_id) {
        var type = '<?php echo $_SESSION["user_type"]; ?>';
        if (type) {
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: 'api/get_worksheet.php?worksheet_id=' + worksheet_id + '&type=' + type,
                success: function (data) {
                    if (data['copyfrom'] !== null) {
                        $('#divcopyfromid').show();

                        const text = " \" " + data['copyfrom'] + " \" ";
                        $('#copyfromid').html(text);
                    } else {
                        $('#divcopyfromid').hide();
                    }

                    $('#worksheet_id').val(data.worksheet_id);
                    $('#branch').val(data.branch);
                    $('#worksheet_date').val(data.worksheet_date);
                    $('#customer').val(data.customer);
                    $('#customer_ref').val(data.customer_ref);
                    // $('#contact').val(data.contact);

                    $('#subject').val(data.subject);
                    get_contact(data.customer, data.contact);
                    get_location(data.customer);
                    get_location_taxi(data.customer);
                    get_promotion(data.customer, '');
                    get_location_handling(data.customer);
                    get_vehicle_handling(data.customer);
                    get_position(data.customer);
                    get_position_charge_as(data.customer);
                    get_immigrationservice(data.customer);
                    $('#contact').val(data.contact);

                    $('#send_date').val(data.send_date);
                    $('#send_time').val(data.send_time);
                    $('#rcvd_date').val(data.rcvd_date);
                    $('#rcvd_time').val(data.rcvd_time);
                    $('#close_date').val(data.close_date);
                    $('#close_time').val(data.close_time);
                    $('#cancel_reason').val(data.cancel_reason);
                    $('#worksheet_remark').val(data.remark);

                    $("#request_method").val(data.request_method);
                    $("#request_to").val(data.request_to);
                    $("#client_inform_amarit_date").val(data.client_inform_amarit_date);
                    $("#client_inform_amarit_time").val(data.client_inform_amarit_time);
                    $("#cs_inform_opr_date").val(data.cs_inform_opr_date);
                    $("#cs_inform_opr_time").val(data.cs_inform_opr_time);
                    $("#opr_inform_cs_date").val(data.opr_inform_cs_date);
                    $("#opr_inform_cs_time").val(data.opr_inform_cs_time);
                    $("#cs_inform_client_date").val(data.cs_inform_client_date);
                    $("#cs_inform_client_time").val(data.cs_inform_client_time);
                    $('#worksheet_ref1').val(data.ref1);
                    $('#worksheet_ref2').val(data.ref2);
                    $('#worksheet_ref3').val(data.ref3);
                    $('#worksheet_ref4').val(data.ref4);
                    $('#worksheet_ref5').val(data.ref5);
                    $('#worksheet_ref6').val(data.ref6);
                    $('#reject_reason').val(data.reject_reason);
                    $('#invoice_date').val(data.invoice_date);
                    $('#submitinvoice_date').val(data.submitinvoice_date);
                    $('#vendor_number').val(data.vendor_number);
                    $('#vendor_value').val(data.vendor_value);
                    $('#invoice_due_date').val(data.invoice_due_date);
                    $('#submission_date').val(data.submission_date);
                    $('#date_review').val(data.date_review);
                    $('#date_back').val(data.date_back);
                    $('#mailing_list').val(data.mailing_list);



                    var el_status = [];
                    if (data.worksheet_status == 'Closed') {
                        var el_status = ["Open", "Closed", "Send to A/R", "RCVD by A/R", "Reject by A/R", "Cancelled", "Send to NAV"];
                    } else {
                        var el_status = ["Open", "Closed", "Send to A/R", "RCVD by A/R", "Reject by A/R", "Cancelled", "Send to NAV"];
                    }
                    var $el = $("#worksheet_status");
                    $el.empty(); // remove old options
                    $.each(el_status, function (key, value) {
                        $el.append($("<option></option>")
                            .attr("value", value).text(value));
                    });
                    $('#worksheet_status').val(data.worksheet_status);

                    if (data.worksheet_status == 'Send to NAV') {
                        $('#worksheet_status').attr('readonly', true);
                    } else {
                        $('#worksheet_status').attr('readonly', false);
                    }

                    if (data.worksheet_status == 'Closed' && re_open != 1) {
                        $("#worksheet_status").prop("disabled", true);
                    }

                    if (data.worksheet_status == 'Closed') {
                        $(".close_stt").show();
                    } else {
                        $(".close_stt").hide();
                    }

                    if (data.worksheet_status != 'Send to A/R')
                        $(".send").hide();
                    else
                        $(".send").show();

                    if (data.worksheet_status != 'RCVD by A/R')
                        $(".rcvd").hide();
                    else
                        $(".rcvd").show();

                    if (data.worksheet_status != 'Closed')
                        $(".close_st").hide();
                    else {
                        $(".close_st").show();
                        $('#cs_inform_client_date').attr('required', '');
                        $('#cs_inform_client_time').attr('required', '');
                    }

                    if (data.worksheet_status != 'Cancelled')
                        $(".cancel").hide();
                    else {
                        $(".cancel").show();
                        $('#cancel_reason').attr('required', '');
                    }

                    if (data.worksheet_status != 'Reject by A/R')
                        $(".reject").hide();
                    else
                        $(".reject").show();

                    worksheet_status = data.worksheet_status;
                    if (worksheet_status != 'Open' && re_open != 1)
                        $('form#worksheet_data button').hide();
                    else
                        $('form#worksheet_data button').show();

                    if (worksheet_status != 'Open') {
                        $("#branch").prop("disabled", true);
                        $("#worksheet_date").prop("disabled", true);
                        $("#subject").prop("disabled", true);
                        $("#customer").prop("disabled", true);
                        $("#contact").prop("disabled", true);
                        $("#customer_ref").prop("disabled", true);
                        $('#close_date').prop("disabled", true);
                        $('#close_time').prop("disabled", true);
                        //$('#send_date').prop("disabled",true);
                        //$('#send_time').prop("disabled",true);
                        //$('#rcvd_date').prop("disabled",true);
                        //$('#rcvd_time').prop("disabled",true);
                        //$('#cancel_reason').prop("disabled",true);
                        $("#request_method").prop("disabled", true);
                        $("#request_to").prop("disabled", true);
                        $("#client_inform_amarit_date").prop("disabled", true);
                        $("#client_inform_amarit_time").prop("disabled", true);
                        $("#cs_inform_opr_date").prop("disabled", true);
                        $("#cs_inform_opr_time").prop("disabled", true);
                        $("#opr_inform_cs_date").prop("disabled", true);
                        $("#opr_inform_cs_time").prop("disabled", true);
                        $("#cs_inform_client_date").prop("disabled", true);
                        $("#cs_inform_client_time").prop("disabled", true);
                        $("#worksheet_ref1").prop("disabled", true);
                        $("#worksheet_ref2").prop("disabled", true);
                        $("#worksheet_ref3").prop("disabled", true);
                        $("#worksheet_ref4").prop("disabled", true);
                        $("#worksheet_ref5").prop("disabled", true);
                        $("#worksheet_ref6").prop("disabled", true);
                        $("#worksheet_remark").prop("disabled", true);
                    } else {
                        $("#branch").prop("disabled", false);
                        $("#worksheet_date").prop("disabled", false);
                        $("#subject").prop("disabled", false);
                        $("#customer").prop("disabled", false);
                        $("#contact").prop("disabled", false);
                        $("#customer_ref").prop("disabled", false);
                        $('#close_date').prop("disabled", false);
                        $('#close_time').prop("disabled", false);
                        //$('#send_date').prop("disabled",false);
                        //$('#send_time').prop("disabled",false);
                        //$('#rcvd_date').prop("disabled",false);
                        //$('#rcvd_time').prop("disabled",false);
                        //$('#cancel_reason').prop("disabled",false);
                        $("#request_method").prop("disabled", false);
                        $("#request_to").prop("disabled", false);
                        $("#client_inform_amarit_date").prop("disabled", false);
                        $("#client_inform_amarit_time").prop("disabled", false);
                        $("#cs_inform_opr_date").prop("disabled", false);
                        $("#cs_inform_opr_time").prop("disabled", false);
                        $("#opr_inform_cs_date").prop("disabled", false);
                        $("#opr_inform_cs_time").prop("disabled", false);
                        $("#cs_inform_client_date").prop("disabled", false);
                        $("#cs_inform_client_time").prop("disabled", false);
                        $("#worksheet_ref1").prop("disabled", false);
                        $("#worksheet_ref2").prop("disabled", false);
                        $("#worksheet_ref3").prop("disabled", false);
                        $("#worksheet_ref4").prop("disabled", false);
                        $("#worksheet_ref5").prop("disabled", false);
                        $("#worksheet_ref6").prop("disabled", false);
                        $("#worksheet_remark").prop("disabled", false);
                    }
                }
            });
            $('#worksheet_id').attr('readonly', true);
            $("#worksheet_submit").prop("disabled", false);
            $("#sub_data").show();

            $('[href="#transport-tab"]').tab('show');
            setTimeout(load_transport, 1000);

            // load_transport(); 
        }
    }

    $("#customer").on("change", function () {
        get_contact($("#customer").val(), "");
        get_location($("#customer").val());
        get_location_taxi($("#customer").val());
        get_location_handling($("#customer").val());
        get_vehicle_handling($("#customer").val());
        get_position($("#customer").val());
        get_position_charge_as($("#customer").val());
        get_immigrationservice($("#customer").val());
        get_promotion($("#customer").val(), $("#contract_no1").val());

    });

    $("#contract_no1").on("change", function () {
        get_promotion($("#customer").val(), $("#contract_no1").val());
    });



    function clear_data() {
        $('form#worksheet_data input:checkbox').prop('checked', false);
        $('form#worksheet_data input:text').val('');
        $('form#worksheet_data input[type="number"]').val('');
        $('form#worksheet_data input[type="date"]').val('');
        $('form#worksheet_data select').val('');
        $("#worksheet_submit").prop("disabled", false);

        var activeTab = document.querySelector('.nav-link.active');

        if (activeTab) {
            activeTab.classList.remove('active');
        }

        var activePane = document.querySelector('.tab-pane.active');
        if (activePane) {
            activePane.classList.remove('show', 'active');
        }
    }

    async function get_contact(customer_id, contact) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contact_by_customer.php?customer_id=' + customer_id,
            success: function (data) {
                var $el = $("#contact");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });
                $('#contact').val(contact);
            }
        });
    }

    async function get_immigrationservice(customer_id) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_immigrationservice.php?customer=' + customer_id,
            success: function (data) {
                var $el = $("#immigration_service");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });
            }
        });
    }

    async function get_position(customer_id) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_position.php?customer=' + customer_id,
            success: function (data) {
                var $el = $("#manpower_position");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });
            }
        });
    }

    async function get_position_charge_as(customer_id) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_position.php?customer=' + customer_id,
            success: function (data) {
                var $el = $("#manpower_charge_as");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });
            }
        });
    }

    async function get_location_taxi(customer_id) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_location_worksheet_taxi.php?customer=' + customer_id,
            success: function (data) {

                var $el = $("#taxi_from");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });

                var $el = $("#taxi_to");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });
            }
        });
    }

    async function get_location_manpower(customer_id) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_location_worksheet_manpower.php?customer=' + customer_id,
            success: function (data) {

                var $el = $("#location");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });
            }
        });
    }

    async function get_location(customer_id) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_location_worksheet.php?customer=' + customer_id,
            success: function (data) {
                var $el = $("#transport_transport_from");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });

                var $el = $("#transport_transport_to");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });

                //var $el = $("#cargo_transport_from");
                //$el.empty(); // remove old options
                //$el.append($("<option></option>")
                //    .attr("value", "").text(""));
                //$.each(data, function(key,value) {
                //    $el.append($("<option></option>")
                //    .attr("value", key).text(value));
                //});

                var $el = $("#service_transport_from");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });


            }
        });
    }

    async function get_promotion(customer_id, contract) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_promotion_worksheet.php?customer=' + customer_id + '&contract=' + contract,
            success: function (data) {
                var $el = $("#transport_promotion_code");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });
            }
        });
    }

    async function get_location_handling(customer_id) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_location_handling.php?customer=' + customer_id,
            success: function (data) {

                var $el = $("#cargo_transport_from");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });
            }
        });
    }

    async function get_vehicle_handling(customer_id) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_vehicle_handling.php?customer=' + customer_id,
            success: function (data) {

                var $el = $("#cargo_charge_as");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));

                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });
            }
        });
    }

    /********* MAIN  ************/
    $("#worksheet_data").submit(function (e) {
        e.preventDefault();

        $("#worksheet_status").prop("disabled", false);
        $("#branch").prop("disabled", false);
        $("#worksheet_date").prop("disabled", false);
        $("#subject").prop("disabled", false);
        $("#customer").prop("disabled", false);
        $("#contact").prop("disabled", false);
        $("#customer_ref").prop("disabled", false);
        $("#request_method").prop("disabled", false);
        $("#request_to").prop("disabled", false);
        $("#client_inform_amarit_date").prop("disabled", false);
        $("#client_inform_amarit_time").prop("disabled", false);
        $("#cs_inform_opr_date").prop("disabled", false);
        $("#cs_inform_opr_time").prop("disabled", false);
        $("#opr_inform_cs_date").prop("disabled", false);
        $("#opr_inform_cs_time").prop("disabled", false);
        $("#cs_inform_client_date").prop("disabled", false);
        $("#cs_inform_client_time").prop("disabled", false);
        $("#worksheet_ref1").prop("disabled", false);
        $("#worksheet_ref2").prop("disabled", false);
        $("#worksheet_ref3").prop("disabled", false);
        $("#worksheet_ref4").prop("disabled", false);
        $("#worksheet_ref5").prop("disabled", false);
        $("#worksheet_ref6").prop("disabled", false);

        var $form = $("#worksheet_data");
        var data = getFormData($form);
        // $("#worksheet_submit").prop("disabled",true);


        var submitButtonId = $(e.originalEvent.submitter).attr('id');
        var check = $("#worksheet_id").val();

        if ($("#form_type").val() == 'insert') {
            insert_data(data, check[0]);
        }

        if ($("#form_type").val() == 'update') {
            update_data(data);
        }


        return false;
    });

    function insert_data(data, type) {
        let api = "";
        if (type == 'W') {
            api = 'api/insert_worksheet.php';
        } else {
            api = 'api/insert_job.php';
        }
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: api,
            data: data,
            success: function (data) {
                $("#worksheet_submit").prop("disabled", false);
                $('#worksheet_table').DataTable().ajax.reload();
                Result = data;
                if (Result.Status == "Success") {
                    swal({
                        icon: "success",
                        text: Result.msg,
                        timer: 2000,
                        buttons: false,
                    });
                    //$('#vieweditmodal').modal('hide'); 

                    $('#worksheet_id').val(Result.worksheet_id);
                    load_worksheet($('#worksheet_id').val());
                    $('#form_type').val('update');
                    countRowJob(Result.worksheet_id, "worksheet");
                    //  clear_data();
                    // setTimeout(() => {
                    //     location.reload();
                    // }, 2100);

                } else {
                    swal(Result.msg);
                }
            }
        });

    }

    function update_data(data) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_worksheet.php',
            data: data,
            success: function (data) {
                $("#worksheet_submit").prop("disabled", false);
                $('#worksheet_table').DataTable().ajax.reload();
                Result = data;
                if (Result.Status == "Success") {
                    swal(Result.msg);
                    $('#vieweditmodal').modal('hide');
                    clear_data();
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#worksheet_cancel").on('click', function () {
        $('#vieweditmodal').modal('hide');
    })

    $('#worksheet_status').on('focusin', function () {
        // console.log("Saving value " + $(this).val());
        $(this).data('val', $(this).val());
    });

    $("#send_date").on('change', function () {
        if ($("#send_date").val() < $("#close_date").val()) {
            swal('Send Date can not be earlier than Close Date');
        }
    })

    $("#rcvd_date").on('change', function () {
        if ($("#rcvd_date").val() < $("#send_date").val()) {
            swal('RCVD Date can not be earlier than Send to AR Date');
        }
    })

    $("#worksheet_status").on('change', function () {
        var prev = $(this).data('val');
        var worksheet_status = $("#worksheet_status").val();
        //$("#close_date").val($("#close_date").val());

        if (worksheet_status != 'Send to A/R')
            $(".send").hide();
        else {
            if (prev != 'Closed') {
                $("#worksheet_status").val(prev);
                swal('Worksheet status is not Closed');
            } else {
                const dateObj = new Date();
                const month = String(dateObj.getMonth() + 1).padStart(2, '0');
                const day = String(dateObj.getDate()).padStart(2, '0');
                const year = dateObj.getFullYear();
                const output = year + '-' + month + '-' + day;
                //if($("#send_date").val() == "")
                $("#send_date").val(output);

                const hour = String(dateObj.getHours()).padStart(2, '0');
                const min = String(dateObj.getMinutes()).padStart(2, '0');
                const output2 = hour + ':' + min;
                //if($("#send_time").val() == "")
                $("#send_time").val(output2);
                $(".send").show();
                //$("#close_date").val(output);
            }
        }

        if (worksheet_status != 'RCVD by A/R')
            $(".rcvd").hide();
        else {
            if (prev != 'Send to A/R') {
                $("#worksheet_status").val(prev);
                swal('Worksheet status is not Send to A/R');
            } else {
                const dateObj = new Date();
                const month = String(dateObj.getMonth() + 1).padStart(2, '0');
                const day = String(dateObj.getDate()).padStart(2, '0');
                const year = dateObj.getFullYear();
                const output = year + '-' + month + '-' + day;
                //if($("#rcvd_date").val() == "")
                $("#rcvd_date").val(output);

                const hour = String(dateObj.getHours()).padStart(2, '0');
                const min = String(dateObj.getMinutes()).padStart(2, '0');
                const output2 = hour + ':' + min;
                //if($("#rcvd_time").val() == "")
                $("#rcvd_time").val(output2);
                $(".rcvd").show();
            }
        }



        if (worksheet_status != 'Closed')
            $(".close_stt").hide();
        else {
            if (prev != 'Open') {
                $("#worksheet_status").val(prev);
                swal('Worksheet status is not Open');
            } else {
                const dateObj = new Date();
                const month = String(dateObj.getMonth() + 1).padStart(2, '0');
                const day = String(dateObj.getDate()).padStart(2, '0');
                const year = dateObj.getFullYear();
                const output = year + '-' + month + '-' + day;
                //if($("#close_date").val() == "")
                $("#close_date").val(output);

                const hour = String(dateObj.getHours()).padStart(2, '0');
                const min = String(dateObj.getMinutes()).padStart(2, '0');
                const output2 = hour + ':' + min;
                //if($("#close_time").val() == "")
                $("#close_time").val(output2);
                if (worksheet_status == 'Closed') {
                    $(".close_stt").show();

                }
                // $(".close_stt").show();
                //$('#cs_inform_client_date').attr('required', '');
                //$('#cs_inform_client_time').attr('required', '');
            }


        }

        if (worksheet_status != 'Cancelled') {
            $(".cancel").hide();
            $("#cancel_reason").removeAttr('required');
        } else {
            $(".cancel").show();
            $("#cancel_reason").attr('required', '');
            $("#cancel_reason").validate();
        }

        if (worksheet_status != 'Reject by A/R')
            $(".reject").hide();
        else {
            //if (prev != 'Send to A/R' || prev != 'RCVD by A/R')
            //{
            //	$("#worksheet_status").val(prev);
            //	swal('Worksheet status is not Send to A/R or RCVD by A/R');
            //} else {
            $(".reject").show();
            $("#reject_reason").validate();
            //}
        }

    })

    /********* Transport ************/
    function get_number_transport() {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_transport_number.php?date=' + $("#worksheet_date").val(),
            //url: 'api/get_transport_number.php?worksheet_id='+$("#worksheet_id").val(),
            success: function (data) {
                $('#transport_id').val(data.num);
                $('#transport_type1').val(data.t1);
                $('#transport_group_name').val(data.gn);
                $('#transport_line_status').val("Open");
                $('#transport_line_status').attr('readonly', true);
            }
        });
    }

    $("#tansport-nav").on('click', function () {
        setTimeout(load_transport, 1000);
    })

    $("#transport_uom").on('change', function () {
        if ($("#transport_uom").val() == "TP" || $("#transport_uom").val() == "TP/S")
            $("#transport_type1").val("13");
        else if ($("#transport_uom").val() == "R/Tp")
            $("#transport_type1").val("14");
        else if ($("#transport_uom").val() == "Days" || $("#transport_uom").val() == "Day")
            $("#transport_type1").val("20");
        else if ($("#transport_uom").val() == "Hours" || $("#transport_uom").val() == "Hour")
            $("#transport_type1").val("06");
        else
            $("#transport_type1").val("00");
        $("#transport_type3").val("00");
    })

    $("#transport_transport_from").on("change", function () {
        get_location_to($("#customer").val(), $("#transport_transport_from").val());
    });

    async function get_location_to(customer_id, location_from) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_location_to.php?customer=' + customer_id + '&location_from=' + location_from,
            success: function (data) {
                var $el = $("#transport_transport_to");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });
                //$("#transport_remark").val("00");
            }
        });
    }

    $("#transport_transport_to").on("change", function () {
        get_contract_line($("#customer").val(), $("#transport_transport_from").val(), $("#transport_transport_to").val(), $("#diesel_rate").val(), $("#charge_as").val());

    });

    $("#charge_as").on("change", function () {
        get_contract_line($("#customer").val(), $("#transport_transport_from").val(), $("#transport_transport_to").val(), $("#diesel_rate").val(), $("#charge_as").val());

    });

    async function get_contract_line(customer_id, location_from, location_to, diesel_rate, charge_as) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_line.php?customer=' + customer_id + '&location_from=' + location_from + '&location_to=' + location_to + '&diesel_rate=' + diesel_rate + '&charge_as=' + charge_as,
            success: function (data) {
                //$('#contract_no1').val(data.contract_no);
                //$('#contract_line1').val(data.contract_line);
                var $el = $("#contract_no1");
                $el.empty(); // remove old options
                //$el.append($("<option></option>")
                //    .attr("value", "-").text("-"));
                var $x = 0;
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                    $x = $x + 1;
                });
                if ($x > 1) {
                    $el.empty(); // remove old options
                    $el.append($("<option></option>")
                        .attr("value", "xxxxx").text("xxxxx"));
                    $.each(data, function (key, value) {
                        $el.append($("<option></option>")
                            .attr("value", key).text(value));
                    });
                } else {
                    $el.empty(); // remove old options
                    $.each(data, function (key, value) {
                        $el.append($("<option></option>")
                            .attr("value", key).text(value));
                    });
                }
                $('#contract_no1').val($transport_contract_no);
            }
        });
    }

    $("#transport_vehicle").on("change", function () {
        get_vehicle($("#transport_vehicle").val());
    });

    //add new function to handle value of service dep and cost
    $("#service_vehicle").on("change", function () {
        get_vehicle_for_service($("#service_vehicle").val());
    });

    // $("#rental_vehicle").on("change", function () {
    //     get_vehicle($("#rental_vehicle").val());
    // });


    async function get_vehicle(vehicle) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_vehicle.php?vehicle_id=' + vehicle,
            success: function (data) {
                $('#charge_as').val(data.type);
                $('#outsource_charge_as').val(data.type);
                $('#transport_department').val(data.department);
                $('#transport_cost_center').val(data.cost_center);
                $('#transport_outsource').val(data.outsource);
                if (data.outsource) {
                    $('#transport_outsource').prop("checked", true);

                    $('#transport_outsource_reason').prop('required', true);


                } else {
                    $('#transport_outsource').prop("checked", false);
                    $('#transport_outsource_reason').prop('required', false);

                }
                if (data.owner == 'AAL') {
                    $('#transport_department').attr('readonly', true);
                    $('#transport_cost_center').attr('readonly', true);

                } else {
                    $('#transport_department').attr('readonly', false);
                    $('#transport_cost_center').attr('readonly', false);

                }
            }
        });
    }
    //add new function to put the data to the field in SERVICE OTHER
    async function get_vehicle_for_service(vehicle) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_vehicle.php?vehicle_id=' + vehicle,
            success: function (data) {
                $('#charge_as').val(data.type);
                $('#outsource_charge_as').val(data.type);
                $('#service_department').val(data.department);
                $('#service_cost_center').val(data.cost_center);
                $('#service_outsource').val(data.outsource);
                if (data.outsource) {
                    $('#service_outsource').prop("checked", true);

                    $('#service_outsource_reason').prop('required', true);


                } else {
                    $('#service_outsource').prop("checked", false);
                    $('#service_outsource_reason').prop('required', false);

                }
                if (data.owner == 'AAL') {
                    $('#service_department').attr('readonly', true);
                    $('#service_cost_center').attr('readonly', true);

                } else {
                    $('#service_department').attr('readonly', false);
                    $('#service_cost_center').attr('readonly', false);

                }
            }
        });
    }


    $('#fademore').on('click', function () {
        //if($("#moreinfo").is(":visible")){
        //    $("#moreinfo").fadeOut();
        //    $(".fa-caret-down").hide();
        //    $(".fa-caret-right").show();
        //}else{
        //    $("#moreinfo").fadeIn();
        //    $(".fa-caret-right").hide();
        //    $(".fa-caret-down").show();
        //}
    });

    function load_transport() {
        //$("#moreinfo").hide();
        $(".fa-caret-down").hide();

        if ($("#form_type").val() != "")
            $("#transport_add").show();
        $("#transport_edit_area").hide();
        $("#transport_submit").hide();
        $("#transport_cancel").hide();

        var btn = "";
        if ($("#form_type").val() != "")
            btn = btn_table;

        if (worksheet_status != 'Open') {
            btn = "";
            $('#transport-tab button').hide();
        }

        var table = $('#transport_table').DataTable({
            "ajax": "api/view_worksheet_transport.php?worksheet_id=" + $("#worksheet_id").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo": false,
            "scrollX": true,
            "columnDefs": [{
                "targets": 0,
                "data": null,
                "defaultContent": btn
            },
            {
                "targets": 8,
                "className": "text-right"
            },
            {
                "targets": 10,
                "className": "text-right"
            },
            {
                "targets": 11,
                "className": "text-right"
            },
            {
                "targets": 13,
                "className": "text-right"
            },
            {
                "targets": 14,
                "className": "text-right"
            }
            ],
            "bDestroy": true
        });

    }

    $("#transport_add").on('click', function () {
        getContractDesc('transport');

        $('form#transport_data input:text').val('');
        $('form#transport_data select').val('');
        $('form#transport_data input:checkbox').prop("checked", false);
        $('form#transport_data input[type="number"]').val('');
        $('form#transport_data input[type="date"]').val('');
        $('form#transport_data input[type="time"]').val('');

        $("#transport_type").val('insert');
        $("#transport_add").hide();
        $("#transport_edit_area").fadeIn();
        $("#transport_submit").show();
        $("#transport_cancel").show();

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_last_diesel_rate.php?',
            success: function (data) {
                $('#diesel_rate').val(data.diesel_rate);
            }
        });

        // get_number_transport();
        getHeader('transport')


        // console.log($(`#transport_line_status`))
        // $('#transport_line_status').val("Open");
        // console.log($('#transport_line_status>option:eq(0)'))
        $('#transport_line_status>option:eq(0)').attr('selected', true);
        $(`#transport_cancel_reason`).prop('disabled', true);

    })

    $('#transport_table tbody').on('click', 'button.editbtn', function () {
        

        var table = $('#transport_table').DataTable();
        var data = table.row($(this).parents('tr')).data();
        setCancle('transport', data[16])
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_transport.php?reccode=' + data[0],
            success: function (data) {

                $('#transport_id').val(data.transport_id);
                $('#transport_vehicle').val(data.vehicle);
                $('#transport_operator').val(data.operator);
                $('#transport_transport_from').val(data.transport_from);
                $('#transport_transport_to').val(data.transport_to);
                $('#transport_start_date').val(data.start_date);
                $('#transport_start_time').val(data.start_time);
                $('#transport_end_date').val(data.end_date);
                $('#transport_end_time').val(data.end_time);
                $('#transport_quantity').val(data.quantity);
                $('#transport_uom').val(data.uom);
                $('#actual_finish_date').val(data.actual_finish_date);
                $('#actual_finish_time').val(data.actual_finish_time);
                $('#mileage_start').val(data.mileage_start);
                $('#mileage_end').val(data.mileage_end);
                if (data.backhaul)
                    $('#backhaul').prop("checked", true);
                else
                    $('#backhaul').prop("checked", false);

                if (data.no_charge)
                    $('#no_charge').prop("checked", true);
                else
                    $('#no_charge').prop("checked", false);
                $('#diesel_rate').val(data.diesel_rate);
                $('#trip_type1').val(data.trip_type1);
                $('#charge_type1').val(data.charge_type1);
                $('#additional_charge1').val(data.additional_charge1);
                $('#quantity1').val(data.quantity1);
                $('#uom1').val(data.uom1);
                if (data.consolidate)
                    $('#consolidate').prop("checked", true);
                else
                    $('#consolidate').prop("checked", false);
                if (data.vehicle_switch)
                    $('#vehicle_switch').prop("checked", true);
                else
                    $('#vehicle_switch').prop("checked", false);
                if (data.outsource)
                    $('#transport_outsource').prop("checked", true);
                else
                    $('#transport_outsource').prop("checked", false);
                if (data.standby_charge)
                    $('#standby_charge').prop("checked", true);
                else
                    $('#standby_charge').prop("checked", false);
                if (data.standby_no_charge)
                    $('#standby_no_charge').prop("checked", true);
                else
                    $('#standby_no_charge').prop("checked", false);
                if (data.transport_solution)
                    $('#transport_solution').prop("checked", true);
                else
                    $('#transport_solution').prop("checked", false);
                $('#vehicle_type').val(data.vehicle_type);
                $('#charge_as').val(data.charge_as);
                $('#vendor').val(data.vendor);
                // $('#actual_start_date').val(data.actual_start_date);
                // $('#actual_start_time').val(data.actual_start_time);
                $('#transport_line_status').val(data.line_status);
                $('#transport_cancel_reason').val(data.cancel_reason);
                $('#transport_outsource_reason').val(data.outsource_reason);
                $('#transport_remark').val(data.remark);
                $('#ref1').val(data.ref1);
                $('#ref2').val(data.ref2);
                $('#ref3').val(data.ref3);
                $('#ref4').val(data.ref4);
                $('#ref5').val(data.ref5);
                $('#ref6').val(data.ref6);
                $('#transport_cargo_type').val(data.cargo_type);
                $('#transport_cargo_qty').val(data.cargo_qty);
                $('#transport_cargo_weight').val(data.cargo_weight);
                $('#transport_group_name').val(data.group_name)
                $('#transport_type1').val(data.type1);
                $('#transport_type2').val(data.type2);
                $('#transport_type3').val(data.type3);
                $('#transport_type4').val(data.type4);
                $('#transport_type5').val(data.type5);
                $('#transport_type6').val(data.type6);
                $('#transport_barcode_type').val(data.barcode_type);
                $('#transport_name').val(data.barcode_service);
                $('#transport_location').val(data.barcode_location);
                $('#transport_branch').val(data.barcode_branch);
                $('#transport_contract_description').val(data.contract_description);
                $('#transport_charge_as').val(data.charge_as);

                $('#outsource_charge_as').val(data.outsource_charge_as);
                $('#contract_no1').val(data.contract_no);
                $('#contract_no1_1').val(data.contract_no);
                $transport_contract_no = data.contract_no;
                get_contract_line($("#customer").val(), $("#transport_transport_from").val(), $("#transport_transport_to").val(), $("#diesel_rate").val(), $("#charge_as").val());

                $('#transport_contract_number').val(data.contract_line);
                $('#contact1').val(data.contact1);
                $('#contact2').val(data.contact2);
                $('#dimension').val(data.dimension);
                $('#transport_department').val(data.department);
                $('#transport_cost_center').val(data.cost_center);
                $('#specific_location_from').val(data.specific_location_from);
                $('#specific_location_to').val(data.specific_location_to);
                $('#transport_promotion_code').val(data.promotion_code);
                if (data.confirm_contract)
                    $('#transport_confirm_contract').prop("checked", true);
                else
                    $('#transport_confirm_contract').prop("checked", false);
                if (data.round_trip)
                    $('#round_trip').prop("checked", true);
                else
                    $('#round_trip').prop("checked", false);
                if (data.lumsum_charge)
                    $('#lumsum_charge').prop("checked", true);
                else
                    $('#lumsum_charge').prop("checked", false);
                // if(data.no_allowance)
                //     $('no_allowance').prop( "checked", true );
                // else
                //     $('no_allowance').prop( "checked", false );
                //$('#transport_department').attr('readonly', true);
                //$('#transport_department').attr("disabled", true);
                //$('#transport_cost_center').attr("disabled", true);
                $('#transport_department').attr('readonly', true);
                $('#transport_cost_center').attr('readonly', true);

                if ($("#contract_no1_1").val() == '') {
                    $('#contract_no1').prop('required', true);
                } else {

                    $('#contract_no1').removeAttr('required');
                }

                $('#transport_reccode').val(data.reccode);
                createContractLine('transport');
            }
        });

        $("#transport_type").val('update');
        // $("#transport_add").hide();
        $("#transport_edit_area").fadeIn();
        $("#transport_submit").show();
        $("#transport_cancel").show();


    });

    $('#transport_table tbody').on('click', 'button.deletebtn', function () {
        var table = $('#transport_table').DataTable();
        var data = table.row($(this).parents('tr')).data();
        swal('not allow to delete this transaction!!');
        //swal({
        //    title: "Delete",
        //    text: "Confirm",
        //    icon: "warning",
        //    buttons: ["Cancel", "Ok"],
        //    dangerMode: true,
        //    })
        //    .then((willDelete) => {
        //    if (willDelete) {
        //        $.ajax({
        //            type: 'GET',
        //            dataType: "json",
        //            url: 'api/delete_worksheet_transport.php?reccode='+data[0],
        //            success: function(data) {
        //                $('#transport_table').DataTable().ajax.reload();
        //                Result = data;
        //                if(Result.Status == "Success") {
        //                    swal(Result.msg);
        //                } else {
        //                    swal(Result.msg);
        //                }
        //            }
        //        });
        //    
        //    } 
        //});
    });

    $("#transport_data").submit(function (e) {
        e.preventDefault();
        var $form = $("#transport_data");
        var data = getFormData($form);
        console.log(data, $("#transport_type").val())
        $("#transport_submit").prop("disabled", true);
        if ($("#transport_type").val() == 'insert')
            if ($("#contract_no1").val() == 'xxxxx')
                swal('Contract number should not be blank!!');
            else
                insert_transport(data);
        if ($("#transport_type").val() == 'update')
            update_transport(data);

        return false;
    });

    function insert_transport(data) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_worksheet_transport.php?worksheet_id=' + $("#worksheet_id").val() + "&customer=" + $("#customer").val(),
            data: data,
            success: function (data) {
                $("#transport_submit").prop("disabled", false);

                Result = data;
                if (Result.Status == "Success") {
                    // $('#transport_table').DataTable().ajax.reload();
                    // $("#transport_add").show();
                    // $("#transport_edit_area").fadeOut();
                    // $("#transport_submit").hide();
                    // $("#transport_cancel").hide();
                    setTimeout(load_transport, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_transport(data) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_worksheet_transport.php?reccode=' + $("#transport_reccode").val(),
            data: data,
            success: function (data) {
                $("#transport_submit").prop("disabled", false);
                // $('#transport_table').DataTable().ajax.reload();

                // $("#transport_add").show();
                // $("#transport_edit_area").hide();
                // $("#transport_submit").hide();
                // $("#transport_cancel").hide();
                console.log(data)
                Result = data;
                if (Result.Status == "Success") {
                    setTimeout(load_transport, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#transport_cancel").on('click', function () {
        $("#transport_add").show();
        $("#transport_edit_area").fadeOut();
        $("#transport_submit").hide();
        $("#transport_cancel").hide();
    })

    /********* Manpower ************/
    function get_number_manpower() {
        $.ajax({
            type: 'GET',
            dataType: "json",
            //url: 'api/get_manpower_number.php?worksheet_id='+$("#worksheet_id").val(),
            url: 'api/get_manpower_number.php?date=' + $("#worksheet_date").val(),
            success: function (data) {
                $('#labor_service_id').val(data.num);
                $('#manpower_line_status').val("Open");
                $('#manpower_line_status').attr('readonly', true);
            }
        });
    }

    $("#manpower-nav").on('click', function () {
        if ($("#form_type").val() != "")
            $("#manpower_add").show();
        $("#manpower_edit_area").fadeOut();
        $("#manpower_submit").hide();
        $("#manpower_cancel").hide();
        setTimeout(load_manpower, 1000);
    })

    $("#manpower_position").on("change", function () {
        get_manpower_charge_as($("#manpower_position").val());
        get_contract_manpower($("#customer").val(), $("#manpower_position").val());
        load_operator($("#labor").val());
    });

    $("#labor").on("change", function () {
        load_operator($("#labor").val());
    });

    async function get_manpower_charge_as(position) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_manpower_position.php?position=' + position,
            success: function (data) {
                //$('#manpower_charge_as').val(data.universal_position);
                $('#manpower_charge_as').val($("#manpower_position").val());
                $('#manpower_outsource_charge_as').val(data.universal_position);
            }
        });
    }

    async function get_contract_manpower(customer_id, position) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_manpower.php?customer=' + customer_id + '&position=' + position,
            success: function (data) {
                //$('#manpower_contract_no').val(data.contract_no);
                //$('#manpower_contract_no').val(data.contract_no);
                var $el = $("#manpower_contract_no");
                $el.empty(); // remove old options
                //$el.append($("<option></option>")
                //    .attr("value", "").text(""));
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });
                $('#manpower_contract_no').val($manpower_contract);
            }
        });
    }

    async function load_operator(operator_id) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_operator.php?operator_id=' + operator_id,
            success: function (data) {
                $('#manpower_department').val(data.department);
                $('#manpower_cost_center').val(data.cost_center);
                if (data.outsource) {
                    $('#manpower_outsource_reason').prop('required', true);
                } else {
                    $('#manpower_outsource_reason').prop('required', false);

                }
            }
        });
    }

    function load_manpower() {
        var btn = "";
        if ($("#form_type").val() != "")
            btn = btn_table;

        if (worksheet_status != 'Open') {
            btn = "";
            $('#manpower-tab button').hide();
        }
        var table = $('#manpower_table').DataTable({
            "ajax": "api/view_worksheet_manpower.php?worksheet_id=" + $("#worksheet_id").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo": false,
            "scrollX": true,
            "columnDefs": [{
                "targets": 0,
                "data": null,
                "defaultContent": btn
            }],
            "bDestroy": true
        });
    }

    $("#manpower_add").on('click', function () {
        // $('form#manpower_data input:text').val('');
        $('form#manpower_data select').val('');
        $('form#manpower_data input[type="number"]').val('');
        $('form#manpower_data input[type="date"]').val('');
        $('form#manpower_data input[type="time"]').val('');

        $("#manpower_type").val('insert');
        $("#manpower_add").hide();
        $("#manpower_edit_area").fadeIn();
        $("#manpower_submit").show();
        $("#manpower_cancel").show();

        $('.manpower_cancel_reason').hide();
        $('#manpower_cancel_reason').removeAttr('required');

        get_number_manpower();
    })

    $('#manpower_line_status').on('change', function () {
        if ($('#manpower_line_status').val() == "Cancelled") {
            $('.manpower_cancel_reason').show();
            $('#manpower_cancel_reason').prop('required', true);
        } else {
            $('.manpower_cancel_reason').hide();
            $('#manpower_cancel_reason').removeAttr('required');
        }
    });

    $('#manpower_table tbody').on('click', 'button.editbtn', function () {
        var table = $('#manpower_table').DataTable();
        var data = table.row($(this).parents('tr')).data();
        setCancle('manpower', data[11]);

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_manpower.php?reccode=' + data[0],
            success: function (data) {
                $('#labor_service_id').val(data.labor_service_id);
                $('#timesheet_no').val(data.timesheet_no);
                $('#manpower_position').val(data.position);
                $('#labor').val(data.labor);
                $('#location').val(data.location);
                $('#manpower_start_date').val(data.start_date);
                $('#manpower_start_time').val(data.start_time);
                $('#manpower_end_date').val(data.end_date);
                $('#manpower_end_time').val(data.end_time);
                $('#manpower_quantity').val(data.quantity);
                $('#manpower_uom').val(data.uom);
                $('#manpower_remark').val(data.remark);
                $('#manpower_line_status').val(data.line_status);
                $('#manpower_cancel_reason').val(data.cancel_reason);

                if (data.line_status == "Cancelled") {
                    $('.manpower_cancel_reason').show();
                    $('#manpower_cancel_reason').prop('required', true);
                } else {
                    $('.manpower_cancel_reason').hide();
                    $('#manpower_cancel_reason').removeAttr('required');
                }

                $('#manpower_group_name').val(data.group_name)
                $('#manpower_barcode_type').val(data.barcode_type);
                $('#manpower_type1').val(data.type1);
                $('#manpower_type2').val(data.type2);
                $('#manpower_type3').val(data.type3);
                $('#manpower_type4').val(data.type4);
                $('#manpower_type5').val(data.type5);

                $('#on_time').val(data.on_time);
                $('#manpower_cost_type').val(data.cost_type);
                $('#sub_task_name').val(data.task_list);
                $('#manpower_ref1').val(data.ref1);
                $('#manpower_ref2').val(data.ref2);
                $('#manpower_ref3').val(data.ref3);
                $('#manpower_ref4').val(data.ref4);
                $('#manpower_ref5').val(data.ref5);
                $('#manpower_ref6').val(data.ref6);
                $('#manpower_contact').val(data.contact);
                $('#manpower_charge_as').val(data.charge_as);
                $('#manpower_outsource_charge_as').val(data.outsource_charge_as);
                $('#manpower_department').val(data.department);
                $('#manpower_cost_center').val(data.cost_center);
                $('#manpower_contract_no').val(data.contract_no);
                $('#manpower_contract_no_1').val(data.contract_no);
                $manpower_contract = data.contract_no;
                get_contract_manpower($("#customer").val(), $("#manpower_position").val());
                $('#manpower_contract_line').val(data.contract_line);
                $('#manpower_ot').val(data.ot);
                if (data.no_charge)
                    $('#manpower_no_charge').prop("checked", true);
                else
                    $('#manpower_no_charge').prop("checked", false);
                if (data.lump_sum)
                    $('#manpower_lumsum_charge').prop("checked", true);
                else
                    $('#manpower_lumsum_charge').prop("checked", false);

                $('#manpower_reccode').val(data.reccode);
            }
        });

        $("#manpower_type").val('update');
        $("#manpower_add").hide();
        $("#manpower_edit_area").fadeIn();
        $("#manpower_submit").show();
        $("#manpower_cancel").show();
    });

    $('#manpower_table tbody').on('click', 'button.deletebtn', function () {
        var table = $('#manpower_table').DataTable();
        var data = table.row($(this).parents('tr')).data();
        swal('not allow to delete this transaction!!');
        //swal({
        //    title: "Delete",
        //    text: "Confirm",
        //    icon: "warning",
        //    buttons: ["Cancel", "Ok"],
        //    dangerMode: true,
        //    })
        //    .then((willDelete) => {
        //    if (willDelete) {
        //        $.ajax({
        //            type: 'GET',
        //            dataType: "json",
        //            url: 'api/delete_worksheet_manpower.php?reccode='+data[0],
        //            success: function(data) {
        //                $('#manpower_table').DataTable().ajax.reload();
        //                Result = data;
        //                if(Result.Status == "Success") {
        //                    swal(Result.msg);
        //                } else {
        //                    swal(Result.msg);
        //                }
        //            }
        //        });
        //    
        //    } 
        //});
    });

    $("#manpower_data").submit(function (e) {
        e.preventDefault();
        var $form = $("#manpower_data");
        var data = getFormData($form);
        console.log(data, $("#manpower_type").val())
        $("#manpower_submit").prop("disabled", true);
        if ($("#manpower_type").val() == 'insert')
            insert_manpower(data);
        if ($("#manpower_type").val() == 'update')
            update_manpower(data);

        return false;
    });

    function insert_manpower(data) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_worksheet_manpower.php?worksheet_id=' + $("#worksheet_id").val() + "&customer=" + $("#customer").val(),
            data: data,
            success: function (data) {
                $("#manpower_submit").prop("disabled", false);
                $('#manpower_table').DataTable().ajax.reload();

                $("#manpower_add").show();
                $("#manpower_edit_area").fadeOut();
                $("#manpower_submit").hide();
                $("#manpower_cancel").hide();

                Result = data;
                if (Result.Status == "Success") {
                    setTimeout(load_manpower, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_manpower(data) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_worksheet_manpower.php?reccode=' + $("#manpower_reccode").val(),
            data: data,
            success: function (data) {
                $("#manpower_submit").prop("disabled", false);
                $('#manpower_table').DataTable().ajax.reload();

                $("#manpower_add").show();
                $("#manpower_edit_area").fadeOut();
                $("#manpower_submit").hide();
                $("#manpower_cancel").hide();

                Result = data;
                if (Result.Status == "Success") {
                    setTimeout(load_manpower, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#manpower_cancel").on('click', function () {
        $("#manpower_add").show();
        $("#manpower_edit_area").fadeOut();
        $("#manpower_submit").hide();
        $("#manpower_cancel").hide();
    })

    /********* Cargo handling ************/
    function get_number_cargo() {
        $.ajax({
            type: 'GET',
            dataType: "json",
            //url: 'api/get_cargo_number.php?worksheet_id='+$("#worksheet_id").val(),
            url: 'api/get_cargo_number.php?date=' + $("#worksheet_date").val(),
            success: function (data) {

                $('#cargo_service_id').val(data.num);
                $('#cargo_line_status').val("Open");
                $('#cargo_line_status').attr('readonly', true);
            }
        });
    }

    $("#cargo-nav").on('click', function () {
        if ($("#form_type").val() != "")
            $("#cargo_add").show();
        $("#cargo_edit_area").fadeOut();
        $("#cargo_submit").hide();
        $("#cargo_cancel").hide();
        setTimeout(load_cargo, 1000);
    })

    $("#cargo_vehicle").on("change", function () {
        get_vehicle_handling($("#customer").val());
        get_vehicle2($("#cargo_vehicle").val());

        //get_vehicle_handling($("#customer").val());
        //$('#cargo_charge_as').val($("#cargo_outsource_charge_as").val());

        //get_contract_cargo($("#customer").val(),$("#charge_as2").val(),$("#diesel_rate").val(),$("#cargo_transport_from").val());
    })

    async function get_vehicle2(vehicle) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_vehicle.php?vehicle_id=' + vehicle,
            success: function (data) {
                $('#cargo_charge_as').val(data.type);
                //$("#cargo_charge_as").val('CRANE 40T');
                $('#cargo_outsource_charge_as').val(data.type);
                get_contract_cargo($("#customer").val(), data.type, $("#cargo_diesel_rate").val(), $("#cargo_transport_from").val());
                $('#cargo_department').val(data.department);
                $('#cargo_cost_center').val(data.cost_center);
                //$('#cargo_charge_as').val(data.type);
            }
        });
    }

    async function get_contract_cargo(customer_id, vehicle, diesel_rate, cargo_location) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_cargo.php?customer=' + customer_id + '&vehicle=' + vehicle + '&diesel_rate=' + diesel_rate + '&cargo_location=' + cargo_location,
            success: function (data) {
                //$('#cargo_contract_no').val(data.contract_no);
                //$('#cargo_contract_line').val(data.contract_line);
                var $el = $("#cargo_contract_no");
                $el.empty(); // remove old options
                //$el.append($("<option></option>")
                //    .attr("value", "-").text("-"));
                var $x = 0;
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                    $x = $x + 1;
                });
                if ($x > 1) {
                    $el.empty(); // remove old options
                    $el.append($("<option></option>")
                        .attr("value", "xxxxx").text("xxxxx"));
                    $.each(data, function (key, value) {
                        $el.append($("<option></option>")
                            .attr("value", key).text(value));
                    });
                } else {
                    $el.empty(); // remove old options
                    $.each(data, function (key, value) {
                        $el.append($("<option></option>")
                            .attr("value", key).text(value));
                    });
                }
                $('#cargo_contract_no').val($cargo_contract_no);
            }
        });
    }

    $("#cargo_transport_from").on("change", function () {
        get_contract_cargo($("#customer").val(), $("#cargo_charge_as").val(), $("#cargo_diesel_rate").val(), $("#cargo_transport_from").val());

    });

    function load_cargo() {
        var btn = "";
        if ($("#form_type").val() != "")
            btn = btn_table;

        if (worksheet_status != 'Open') {
            btn = "";
            $('#cargo-tab button').hide();
        }

        var table = $('#cargo_table').DataTable({
            "ajax": "api/view_worksheet_cargo_handling.php?worksheet_id=" + $("#worksheet_id").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo": false,
            "scrollX": true,
            "columnDefs": [{
                "targets": 0,
                "data": null,
                "defaultContent": btn
            },
            {
                "targets": 7,
                "className": "text-right"
            },
            {
                "targets": 9,
                "className": "text-right"
            }
            ],
            "bDestroy": true
        });
    }

    $("#cargo_add").on('click', function () {
        $('form#cargo_data input:text').val('');
        $('form#cargo_data select').val('');
        $('form#cargo_data input[type="number"]').val('');
        $('form#cargo_data input[type="date"]').val('');
        $('form#cargo_data input[type="time"]').val('');

        $("#cargo_types").val('insert');
        $("#cargo_add").hide();
        $("#cargo_edit_area").fadeIn();
        $("#cargo_submit").show();
        $("#cargo_cancel").show();
        $("#cargo_line_status").val("Open");
        // get_number_cargo();
        getHeader('cargo_handling')

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_last_diesel_rate.php?',
            success: function (data) {
                $('#cargo_diesel_rate').val(data.diesel_rate);
            }
        });
    })

    $('#cargo_table tbody').on('click', 'button.editbtn', function () {
        var table = $('#cargo_table').DataTable();
        var data = table.row($(this).parents('tr')).data();
        setCancle('cargo', data[9]);
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_cargo_handling.php?reccode=' + data[0],
            success: function (data) {
                $('#cargo_service_id').val(data.cargo_service_id);
                $('#cargo_vehicle').val(data.vehicle);
                $('#cargo_operator').val(data.operator);
                $('#cargo_transport_from').val(data.transport_from);
                $('#cargo_transport_to').val(data.transport_to);
                $('#cargo_start_date').val(data.start_date);
                $('#cargo_start_time').val(data.start_time);
                $('#cargo_end_date').val(data.end_date);
                $('#cargo_end_time').val(data.end_time);
                $('#cargo_trip_type').val(data.trip_type);
                $('#cargo_charge_type').val(data.charge_type);
                $('#cargo_additional_charge').val(data.additional_charge)
                $('#cargo_quantity').val(data.quantity);
                $('#cargo_uom').val(data.uom);
                $('#cargo_remark').val(data.remark);

                $('#cargo_type').val(data.cargo_type)
                $('#cargo_qty').val(data.cargo_qty);
                $('#cargo_weight').val(data.weight);
                $('#cargo_line_status').val(data.line_status);
                $('#cargo_cancel_reason').val(data.cancel_reason);

                //if(data.line_status == "Cancelled"){
                //    $('.cargo_cancel_reason').show();
                //    $('#cargo_cancel_reason').prop('required',true);
                //}else{
                //    $('.cargo_cancel_reason').hide();
                //    $('#cargo_cancel_reason').removeAttr('required');
                //}

                $('#cargo_group_name').val(data.group_name)
                $('#cargo_sub1').val(data.type1);
                $('#cargo_sub2').val(data.type2);
                $('#cargo_sub3').val(data.type3);
                $('#cargo_sub4').val(data.type4);
                $('#cargo_sub5').val(data.type5);
                $('#cargo_sub6').val(data.type6);
                $('#cargo_ref1').val(data.ref1);
                $('#cargo_ref2').val(data.ref2);
                $('#cargo_ref3').val(data.ref3);
                $('#cargo_ref4').val(data.ref4);
                $('#cargo_ref5').val(data.ref5);
                $('#cargo_ref6').val(data.ref6);
                $('#cargo_handling_contact').val(data.contact);
                $('#cargo_department').val(data.department);
                $('#cargo_cost_center').val(data.cost_center);
                $('#cargo_diesel_rate').val(data.diesel_rate);
                $('#cargo_charge_as').val(data.charge_as);
                $('#cargo_outsource_charge_as').val(data.outsource_charge_as);
                $('#cargo_contract_no').val(data.contract_no);
                $('#cargo_contract_no_1').val(data.contract_no);
                $cargo_contract_no = data.contract_no;
                get_contract_cargo($("#customer").val(), $("#cargo_charge_as").val(), $("#cargo_diesel_rate").val(), $("#cargo_transport_from").val());
                $('#cargo_contract_line').val(data.contract_line);
                $('#cargo_ot').val(data.ot);
                if (data.no_charge)
                    $('#cargo_no_charge').prop("checked", true);
                else
                    $('#cargo_no_charge').prop("checked", false);
                if (data.ontime)
                    $('#cargo_ontime').prop("checked", true);
                else
                    $('#cargo_ontime').prop("checked", false);

                $('#cargo_reccode').val(data.reccode);
            }
        });

        $("#cargo_types").val('update');
        $("#cargo_add").hide();
        $("#cargo_edit_area").fadeIn();
        $("#cargo_submit").show();
        $("#cargo_cancel").show();
    });

    $('#cargo_table tbody').on('click', 'button.deletebtn', function () {
        var table = $('#cargo_table').DataTable();
        var data = table.row($(this).parents('tr')).data();
        swal('not allow to delete this transaction!!');
        //swal({
        //    title: "Delete",
        //    text: "Confirm",
        //    icon: "warning",
        //    buttons: ["Cancel", "Ok"],
        //    dangerMode: true,
        //    })
        //    .then((willDelete) => {
        //    if (willDelete) {
        //        $.ajax({
        //            type: 'GET',
        //            dataType: "json",
        //            url: 'api/delete_worksheet_cargo_handling.php?reccode='+data[0],
        //            success: function(data) {
        //                $('#cargo_table').DataTable().ajax.reload();
        //                Result = data;
        //                if(Result.Status == "Success") {
        //                    swal(Result.msg);
        //                } else {
        //                    swal(Result.msg);
        //                }
        //            }
        //        });
        //    
        //    } 
        //});
    });

    $("#cargo_data").submit(function (e) {
        e.preventDefault();
        var $form = $("#cargo_data");
        var data = getFormData($form);
        $("#cargo_submit").prop("disabled", true);
        if ($("#cargo_types").val() == 'insert')
            insert_cargo(data);
        if ($("#cargo_types").val() == 'update')
            update_cargo(data);

        return false;
    });

    function insert_cargo(data) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_worksheet_cargo_handling.php?worksheet_id=' + $("#worksheet_id").val() + "&customer=" + $("#customer").val(),
            data: data,
            success: function (data) {
                $("#cargo_submit").prop("disabled", false);
                $('#cargo_table').DataTable().ajax.reload();

                $("#cargo_add").show();
                $("#cargo_edit_area").fadeOut();
                $("#cargo_submit").hide();
                $("#cargo_cancel").hide();

                Result = data;
                if (Result.Status == "Success") {
                    setTimeout(load_cargo, 1000);
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_cargo(data) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_worksheet_cargo_handling.php?reccode=' + $("#cargo_reccode").val(),
            data: data,
            success: function (data) {
                $("#cargo_submit").prop("disabled", false);
                $('#cargo_table').DataTable().ajax.reload();

                $("#cargo_add").show();
                $("#cargo_edit_area").fadeOut();
                $("#cargo_submit").hide();
                $("#cargo_cancel").hide();

                Result = data;
                if (Result.Status == "Success") {
                    setTimeout(load_cargo, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#cargo_cancel").on('click', function () {
        $("#cargo_add").show();
        $("#cargo_edit_area").fadeOut();
        $("#cargo_submit").hide();
        $("#cargo_cancel").hide();
    })

    /********* Service ************/
    function get_number_service() {

        $.ajax({
            type: 'GET',
            dataType: "json",
            //url: 'api/get_service_number.php?worksheet_id='+$("#worksheet_id").val(),
            url: 'api/get_service_number.php?date=' + $("#worksheet_date").val(),
            success: function (data) {
                $('#service_cargo_service_id').val(data.num);
                $('#service_line_status').val("Open");
                $('#service_line_status').attr('readonly', true);
            }
        });
    }

    $("#service-nav").on('click', function () {
        if ($("#form_type").val() != "") {
            $("#service_add").show();
            $("#service_edit_area").fadeOut();

            $("#service_submit").hide();
            $("#service_cancel").hide();
            setTimeout(load_service, 1000);
        }

    })

    function load_service() {
        var btn = "";
        if ($("#form_type").val() != "")
            btn = btn_table;

        if (worksheet_status != 'Open') {
            btn = "";
            $('#service-tab button').hide();
        }

        var table = $('#service_table').DataTable({
            "ajax": "api/view_worksheet_service.php?worksheet_id=" + $("#worksheet_id").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo": false,
            "scrollX": true,
            "columnDefs": [{
                "targets": 0,
                "data": null,
                "defaultContent": btn
            }],
            "bDestroy": true
        });
    }

    $("#service_add").on('click', function () {

        $('form#service_data input:text').val('');
        $('form#service_data select').val('');
        $('form#service_data input[type="number"]').val('');
        $('form#service_data input[type="date"]').val('');
        $('form#service_data input[type="time"]').val('');
        //add document to reset both check box from service other
        document.getElementById("service_no_charge").checked = false;
        document.getElementById("reimbursment").checked = false;
        $("#service_type").val('insert');
        $("#service_add").hide();
        $("#service_edit_area").fadeIn();
        $("#service_submit").show();
        $("#service_cancel").show();
        get_number_service()
    })

    $('#service_table tbody').on('click', 'button.editbtn', function () {
        var table = $('#service_table').DataTable();
        var data = table.row($(this).parents('tr')).data();

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_service.php?reccode=' + data[0],
            success: function (data) {
                $('#service_cargo_service_id').val(data.cargo_service_id);
                $('#service_vehicle').val(data.vehicle);
                $('#service_operator').val(data.operator);
                $('#service_transport_from').val(data.transport_from);
                $('#service_transport_to').val(data.transport_to);
                $('#service_start_date').val(data.start_date);
                $('#service_start_time').val(data.start_time);
                $('#service_end_date').val(data.end_date);
                $('#service_end_time').val(data.end_time);
                $('#service_trip_type').val(data.trip_type);
                $('#service_charge_type').val(data.charge_type);
                $('#service_additional_charge').val(data.additional_charge)
                $('#service_quantity').val(data.quantity);
                $('#service_uom').val(data.uom);
                $('#service_remark').val(data.remark);

                $('#service_line_status').val(data.line_status);
                $('#service_cancel_reason').val(data.cancel_reason);
                //add
                if (data.no_charge == 1)
                    $('#service_no_charge').prop("checked", true);
                else
                    $('#service_no_charge').prop("checked", false);
                //
                if (data.reimbursment)
                    $('#reimbursment').prop("checked", true);
                else
                    $('#reimbursment').prop("checked", false);

                if (data.line_status == "Cancelled") {
                    $('.service_cancel_reason').show();
                    $('#service_cancel_reason').prop('required', true);
                } else {
                    $('.service_cancel_reason').hide();
                    $('#service_cancel_reason').removeAttr('required');
                }

                $('#service_group_name').val(data.group_name)
                $('#service_type1').val(data.type1);
                $('#service_type2').val(data.type2);
                $('#service_type3').val(data.type3);
                $('#service_type4').val(data.type4);
                $('#service_type5').val(data.type5);
                $('#service_ref1').val(data.ref1);
                $('#service_ref2').val(data.ref2);
                $('#service_ref3').val(data.ref3);
                $('#service_ref4').val(data.ref4);
                $('#service_ref5').val(data.ref5);
                $('#service_ref6').val(data.ref6);

                $('#service_number').val(data.service_number);
                $('#service_description').val(data.description);
                $('#service_description2').val(data.description2);
                $('#service_amount').val(data.amount);
                $('#service_agreement_number').val(data.agreement_number);
                $('#service_department').val(data.department);
                $('#service_cost_center').val(data.cost_center);

                $('#service_reccode').val(data.reccode);
            }
        });

        $("#service_type").val('update');
        $("#service_add").hide();
        $("#service_edit_area").fadeIn();
        $("#service_submit").show();
        $("#service_cancel").show();
    });

    $('#service_table tbody').on('click', 'button.deletebtn', function () {
        var table = $('#service_table').DataTable();
        var data = table.row($(this).parents('tr')).data();
        swal('not allow to delete this transaction!!');
        //swal({
        //    title: "Delete",
        //    text: "Confirm",
        //    icon: "warning",
        //    buttons: ["Cancel", "Ok"],
        //    dangerMode: true,
        //    })
        //    .then((willDelete) => {
        //    if (willDelete) {
        //        $.ajax({
        //            type: 'GET',
        //            dataType: "json",
        //            url: 'api/delete_worksheet_service.php?reccode='+data[0],
        //            success: function(data) {
        //                $('#service_table').DataTable().ajax.reload();
        //                Result = data;
        //                if(Result.Status == "Success") {
        //                    swal(Result.msg);
        //                } else {
        //                    swal(Result.msg);
        //                }
        //            }
        //        });
        //    
        //    } 
        //});
    });

    $("#service_data").submit(function (e) {
        e.preventDefault();
        var $form = $("#service_data");
        var data = getFormData($form);
        $("#service_submit").prop("disabled", true);
        if ($("#service_type").val() == 'insert')
            insert_service(data);
        if ($("#service_type").val() == 'update')
            update_service(data);

        return false;
    });

    function insert_service(data) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_worksheet_service.php?worksheet_id=' + $("#worksheet_id").val() + "&customer=" + $("#customer").val(),
            data: data,
            success: function (data) {
                $("#service_submit").prop("disabled", false);
                $('#service_table').DataTable().ajax.reload();

                $("#service_add").show();
                $("#service_edit_area").fadeOut();
                $("#service_submit").hide();
                $("#service_cancel").hide();

                Result = data;
                if (Result.Status == "Success") {
                    setTimeout(load_service, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_service(data) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_worksheet_service.php?reccode=' + $("#service_reccode").val(),
            data: data,
            success: function (data) {
                $("#service_submit").prop("disabled", false);
                $('#service_table').DataTable().ajax.reload();

                $("#service_add").show();
                $("#service_edit_area").fadeOut();
                $("#service_submit").hide();
                $("#service_cancel").hide();

                Result = data;
                if (Result.Status == "Success") {
                    setTimeout(load_service, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#service_cancel").on('click', function () {
        $("#service_add").show();
        $("#service_edit_area").fadeOut();
        $("#service_submit").hide();
        $("#service_cancel").hide();
    })

    function torf(val) {
        if (val == 'Y')
            return true;
        else
            return false;
    }

    /********* Taxi ************/
    function get_number_taxi() {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_taxi_number.php?date=' + $("#worksheet_date").val(),
            success: function (data) {
                $('#taxi_service_id').val(data.num);
                $('#taxi_line_status').val("Open");
                $('#taxi_line_status').attr('readonly', true);
            }
        });
    }

    $("#taxi_from").on("change", function () {
        if ($("#taxi_from").val() == '') {
            $('#taxi_contract').val('');
            $('#taxi_contract_line').val('');
        } else {
            get_taxi_to($("#customer").val(), $("#taxi_from").val());
        }
    });

    async function get_taxi_to(customer_id, location_from) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_ _location_taxi_to.php?customer=' + customer_id + '&location_from=' + location_from,
            success: function (data) {
                var $el = $("#taxi_to");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", key).text(value));
                });
            }
        });
    }

    $("#taxi_to").on("change", function () {
        if ($("#taxi_to").val() == '') {
            $('#taxi_contract').val('');
            $('#taxi_contract_line').val('');
        } else {
            get_contract_taxi_line($("#customer").val(), $("#taxi_from").val(), $("#taxi_to").val(), $("#taxi_charge_as").val());
        }
    });

    async function get_contract_taxi_line(customer_id, location_from, location_to, vehicle_type) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_taxi_line.php?customer=' + customer_id + '&location_from=' + location_from + '&location_to=' + location_to + '&vehicle_type=' + vehicle_type,
            success: function (data) {
                $('#taxi_contract').val(data.contract_no);
                $('#taxi_contract_line').val(data.contract_line);
            }
        });
    }

    $("#taxi-nav").on('click', function () {
        if ($("#form_type").val() != "")
            $("#taxi_add").show();
        $("#taxi_edit_area").fadeOut();
        $("#taxi_submit").hide();
        $("#taxi_cancel").hide();
        setTimeout(load_taxi, 1000);
    })

    function load_taxi() {
        var btn = "";
        if ($("#form_type").val() != "")
            btn = btn_table;

        if (worksheet_status != 'Open') {
            btn = "";
            $('#taxi-tab button').hide();
        }

        var table = $('#taxi_table').DataTable({
            "ajax": "api/view_worksheet_taxi.php?worksheet_id=" + $("#worksheet_id").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo": false,
            "scrollX": true,
            "columnDefs": [{
                "targets": 0,
                "data": null,
                "defaultContent": btn
            },
            {
                "targets": 5,
                "className": "text-right"
            },
            {
                "targets": 7,
                "className": "text-right"
            }
            ],
            "bDestroy": true
        });
    }

    $("#taxi_add").on('click', function () {
        // $('form#taxi_data input:text').val('');
        $('form#taxi_data select').val('');
        $('form#taxi_data input[type="number"]').val('');
        $('form#taxi_data input[type="date"]').val('');
        $('form#taxi_data input[type="time"]').val('');

        $("#taxi_type").val('insert');
        $("#taxi_add").hide();
        $("#taxi_edit_area").fadeIn();
        $("#taxi_submit").show();
        $("#taxi_cancel").show();
        get_number_taxi()
    })

    $('#taxi_table tbody').on('click', 'button.editbtn', function () {
        var table = $('#taxi_table').DataTable();
        var data = table.row($(this).parents('tr')).data();
        setCancle('taxi', data[6]);
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_taxi.php?reccode=' + data[0],
            success: function (data) {
                $('#taxi_service_id').val(data.taxi_service_id);
                $('#taxi_vehicle').val(data.vehicle);
                $('#taxi_operator').val(data.operator);
                $('#taxi_from').val(data.transport_from);
                $('#taxi_to').val(data.transport_to);
                $('#taxi_start_date').val(data.start_date);
                $('#taxi_start_time').val(data.start_time);
                $('#taxi_end_date').val(data.end_date);
                $('#taxi_end_time').val(data.end_time);
                $('#taxi_quantity').val(data.quantity);
                $('#taxi_uom').val(data.uom);
                $('#taxi_remark').val(data.remark);
                $('#taxi_line_status').val(data.line_status);
                $('#taxi_cancel_reason').val(data.cancel_reason);

                if (data.line_status == "Cancelled") {
                    $('.taxi_cancel_reason').show();
                    $('#taxi_cancel_reason').prop('required', true);
                } else {
                    $('.taxi_cancel_reason').hide();
                    $('#taxi_cancel_reason').removeAttr('required');
                }

                $('#taxi_group_name').val(data.group_name)
                $('#taxi_type1').val(data.type1);
                $('#taxi_type2').val(data.type2);
                $('#taxi_type3').val(data.type3);
                $('#taxi_type4').val(data.type4);
                $('#taxi_type5').val(data.type5);
                $('#taxi_type6').val(data.type6);
                $('#taxi_barcode_type').val(data.barcode_type);
                $('#taxi_location').val(data.barcode_location);
                $('#taxi_branch').val(data.barcode_branch);

                $('#taxi_ref1').val(data.ref1);
                $('#taxi_ref2').val(data.ref2);
                $('#taxi_ref3').val(data.ref3);
                $('#taxi_ref4').val(data.ref4);
                $('#taxi_ref5').val(data.ref5);
                $('#taxi_ref6').val(data.ref6);

                $('#taxi_actual_start_date').val(data.actual_start_date);
                $('#taxi_actual_start_time').val(data.actual_start_time);
                $('#taxi_actual_finish_date').val(data.actual_finish_date);
                $('#taxi_actual_finish_time').val(data.actual_finish_time);
                $('#taxi_department').val(data.department);
                $('#taxi_cost_center').val(data.cost_center);
                $('#taxi_mileage_start').val(data.mileage_start);
                $('#taxi_mileage_end').val(data.mileage_end);
                $('#taxi_contact').val(data.contact);
                $('#taxi_specific_location_from').val(data.specific_location_from);
                $('#taxi_specific_location_to').val(data.specific_location_to);
                $('#taxi_charge_as').val(data.charge_as);
                $('#taxi_outsource_charge_as').val(data.outsource_charge_as);
                $('#taxi_contract').val(data.contract_no);
                $('#taxi_contract_line').val(data.contract_line);
                $('#taxi_diesel_rate').val(data.diesel_rate);

                $('#taxi_reccode').val(data.reccode);
            }
        });

        $("#taxi_type").val('update');
        $("#taxi_add").hide();
        $("#taxi_edit_area").fadeIn();
        $("#taxi_submit").show();
        $("#taxi_cancel").show();
    });

    $('#taxi_table tbody').on('click', 'button.deletebtn', function () {
        var table = $('#taxi_table').DataTable();
        var data = table.row($(this).parents('tr')).data();
        swal('not allow to delete this transaction!!');
        //swal({
        //    title: "Delete",
        //    text: "Confirm",
        //    icon: "warning",
        //    buttons: ["Cancel", "Ok"],
        //    dangerMode: true,
        //    })
        //    .then((willDelete) => {
        //    if (willDelete) {
        //        $.ajax({
        //            type: 'GET',
        //            dataType: "json",
        //            url: 'api/delete_worksheet_taxi.php?reccode='+data[0],
        //            success: function(data) {
        //                $('#taxi_table').DataTable().ajax.reload();
        //                Result = data;
        //                if(Result.Status == "Success") {
        //                    swal(Result.msg);
        //                } else {
        //                    swal(Result.msg);
        //                }
        //            }
        //        });
        //    
        //    } 
        //});
    });

    $("#taxi_data").submit(function (e) {
        e.preventDefault();
        var $form = $("#taxi_data");
        var data = getFormData($form);
        console.log(data)
        $("#taxi_submit").prop("disabled", true);
        if ($("#taxi_type").val() == 'insert')
            insert_taxi(data);
        if ($("#taxi_type").val() == 'update')
            update_taxi(data);

        return false;
    });

    function insert_taxi(data) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_worksheet_taxi.php?worksheet_id=' + $("#worksheet_id").val() + "&customer=" + $("#customer").val(),
            data: data,
            success: function (data) {
                $("#taxi_submit").prop("disabled", false);
                $('#taxi_table').DataTable().ajax.reload();

                $("#taxi_add").show();
                $("#taxi_edit_area").fadeOut();
                $("#taxi_submit").hide();
                $("#taxi_cancel").hide();

                Result = data;
                if (Result.Status == "Success") {
                    setTimeout(load_taxi, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_taxi(data) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_worksheet_taxi.php?reccode=' + $("#taxi_reccode").val(),
            data: data,
            success: function (data) {
                $("#taxi_submit").prop("disabled", false);
                $('#taxi_table').DataTable().ajax.reload();

                $("#taxi_add").show();
                $("#taxi_edit_area").fadeOut();
                $("#taxi_submit").hide();
                $("#taxi_cancel").hide();

                Result = data;
                if (Result.Status == "Success") {
                    setTimeout(load_taxi, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#taxi_cancel").on('click', function () {
        $("#taxi_add").show();
        $("#taxi_edit_area").fadeOut();
        $("#taxi_submit").hide();
        $("#taxi_cancel").hide();
    })

    function torf(val) {
        if (val == 'Y')
            return true;
        else
            return false;
    }

    /********* immigration ************/
    function get_number_immigration() {
        $.ajax({
            type: 'GET',
            dataType: "json",
            //url: 'api/get_service_number.php?worksheet_id='+$("#worksheet_id").val(),
            url: 'api/get_immigration_number.php?date=' + $("#worksheet_date").val(),
            success: function (data) {
                $('#immigration_id').val(data.num);
                $('#immigration_line_status').val("Open");
                $('#immigration_line_status').attr('readonly', true);
            }
        });
    }

    $("#immigration-nav").on('click', function () {
        if ($("#form_type").val() != "")
            $("#immigration_add").show();
        $("#immigration_edit_area").fadeOut();
        $("#immigration_submit").hide();
        $("#immigration_cancel").hide();
        setTimeout(load_immigration, 1000);
    })

    $("#immigration_service").on("change", function () {
        if ($("#immigration_service").val() == '') {
            $('#immigration_agreement_number').val('');
            $('#immigration_contract_line').val('');
        } else {
            get_contract_immigration($("#customer").val(), $("#immigration_service").val());
            //$('#immigration_remark').val($("#immigration_service").val());
        }
    });

    async function get_contract_immigration(customer_id, service) {
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_immigration_line.php?customer=' + customer_id + '&service=' + service,
            success: function (data) {
                $('#immigration_agreement_number').val(data.contract_no);
                $('#immigration_contract_line').val(data.contract_line);
            }
        });
    }

    function load_immigration() {
        var btn = "";
        if ($("#form_type").val() != "")
            btn = btn_table;

        if (worksheet_status != 'Open') {
            btn = "";
            $('#immigration-tab button').hide();
        }

        var table = $('#immigration_table').DataTable({
            "ajax": "api/view_worksheet_immigration.php?worksheet_id=" + $("#worksheet_id").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo": false,
            "scrollX": true,
            "columnDefs": [{
                "targets": 0,
                "data": null,
                "defaultContent": btn
            },
            {
                "targets": 7,
                "className": "text-right"
            },
            {
                "targets": 9,
                "className": "text-right"
            }
            ],
            "bDestroy": true
        });
    }

    $("#immigration_add").on('click', function () {
        // $('form#immigration_data input:text').val('');
        $('form#immigration_data select').val('');
        $('form#immigration_data input[type="number"]').val('');
        $('form#immigration_data input[type="date"]').val('');
        $('form#immigration_data input[type="time"]').val('');

        $("#immigration_type").val('insert');
        $("#immigration_add").hide();
        $("#immigration_edit_area").fadeIn();
        $("#immigration_submit").show();
        $("#immigration_cancel").show();
        $("#immigration_line_status").val("Open");
        // get_number_immigration()
        getHeader('immigration')
    })

    $('#immigration_table tbody').on('click', 'button.editbtn', function () {
        var table = $('#immigration_table').DataTable();
        var data = table.row($(this).parents('tr')).data();
        setCancle('immigration', data[7]);
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_immigration.php?reccode=' + data[0],
            success: function (data) {
                $('#immigration_id').val(data.immigration_id);
                $('#immigration_start_date').val(data.start_date);
                $('#immigration_start_time').val(data.start_time);
                $('#immigration_end_date').val(data.end_date);
                $('#immigration_end_time').val(data.end_time);
                $('#immigration_quantity').val(data.quantity);
                $('#immigration_uom').val(data.uom);
                $('#immigration_remark').val(data.remark);

                $('#immigration_line_status').val(data.line_status);
                $('#immigration_cancel_reason').val(data.cancel_reason);

                if (data.line_status == "Cancelled") {
                    $('.immigration_cancel_reason').show();
                    $('#immigration_cancel_reason').prop('required', true);
                } else {
                    $('.immigration_cancel_reason').hide();
                    $('#immigration_cancel_reason').removeAttr('required');
                }

                $('#immigration_group_name').val(data.group_name)
                $('#immigration_sub1').val(data.type1);
                $('#immigration_sub2').val(data.type2);
                $('#immigration_sub3').val(data.type3);
                $('#immigration_sub4').val(data.type4);
                $('#immigration_sub5').val(data.type5);
                $('#immigration_sub6').val(data.type6);
                $('#immigration_ref1').val(data.ref1);
                $('#immigration_ref2').val(data.ref2);
                $('#immigration_ref3').val(data.ref3);
                $('#immigration_ref4').val(data.ref4);
                $('#immigration_ref5').val(data.ref5);
                $('#immigration_ref6').val(data.ref6);

                $('#immigration_number').val(data.immigration_number);
                $('#immigration_description').val(data.description);
                $('#immigration_expat_name').val(data.expat_name);
                $('#immigration_amount').val(data.amount);
                $('#immigration_agreement_number').val(data.agreement_number);
                $('#immigration_department').val(data.department);
                $('#immigration_cost_center').val(data.cost_center);
                $('#immigration_service').val(data.service);
                if (data.reimbursment)
                    $('#immigration_reimbursment').prop("checked", true);
                else
                    $('#immigration_reimbursment').prop("checked", false);

                $('#immigration_reccode').val(data.reccode);
            }
        });

        $("#immigration_type").val('update');
        $("#immigration_add").hide();
        $("#immigration_edit_area").fadeIn();
        $("#immigration_submit").show();
        $("#immigration_cancel").show();
    });

    $('#immigration_table tbody').on('click', 'button.deletebtn', function () {
        var table = $('#immigration_table').DataTable();
        var data = table.row($(this).parents('tr')).data();
        swal('not allow to delete this transaction!!');
        //swal({
        //    title: "Delete",
        //    text: "Confirm",
        //   icon: "warning",
        //    buttons: ["Cancel", "Ok"],
        //    dangerMode: true,
        //    })
        //    .then((willDelete) => {
        //    if (willDelete) {
        //        $.ajax({
        //            type: 'GET',
        //            dataType: "json",
        //            url: 'api/delete_worksheet_immigration.php?reccode='+data[0],
        //            success: function(data) {
        //                $('#immigration_table').DataTable().ajax.reload();
        //                Result = data;
        //                if(Result.Status == "Success") {
        //                    swal(Result.msg);
        //                } else {
        //                    swal(Result.msg);
        //                }
        //            }
        //        });
        //    
        //    } 
        //});
    });

    $("#immigration_data").submit(function (e) {
        e.preventDefault();
        var $form = $("#immigration_data");
        var data = getFormData($form);
        $("#immigration_submit").prop("disabled", true);
        if ($("#immigration_type").val() == 'insert')
            insert_immigration(data);
        if ($("#immigration_type").val() == 'update')
            update_immigration(data);

        return false;
    });

    function insert_immigration(data) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_worksheet_immigration.php?worksheet_id=' + $("#worksheet_id").val() + "&customer=" + $("#customer").val(),
            data: data,
            success: function (data) {
                $("#immigration_submit").prop("disabled", false);
                $('#immigration_table').DataTable().ajax.reload();

                $("#immigration_add").show();
                $("#immigration_edit_area").fadeOut();
                $("#immigration_submit").hide();
                $("#immigration_cancel").hide();

                Result = data;
                if (Result.Status == "Success") {
                    setTimeout(load_immigration, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_immigration(data) {
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_worksheet_immigration.php?reccode=' + $("#immigration_reccode").val(),
            data: data,
            success: function (data) {
                $("#immigration_submit").prop("disabled", false);
                $('#immigration_table').DataTable().ajax.reload();

                $("#immigration_add").show();
                $("#immigration_edit_area").fadeOut();
                $("#immigration_submit").hide();
                $("#immigration_cancel").hide();

                Result = data;
                if (Result.Status == "Success") {
                    setTimeout(load_immigration, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#immigration_cancel").on('click', function () {
        $("#immigration_add").show();
        $("#immigration_edit_area").fadeOut();
        $("#immigration_submit").hide();
        $("#immigration_cancel").hide();
    })


    $('select').bind('change', function () {
        if ($(this).attr("id") == "transport_line_status" && $(this).val() == "Open") {
            $('select#transport_cancel_reason').val("")
            $('select#transport_cancel_reason').attr('disabled', true);
        } else {
            $('select#transport_cancel_reason').attr('disabled', false);
        }

        if ($(this).attr("id") == "manpower_line_status" && $(this).val() == "Open") {
            $('select#manpower_cancel_reason').val("")
            $('select#manpower_cancel_reason').attr('disabled', true);
        } else {
            $('select#manpower_cancel_reason').attr('disabled', false);
        }

        if ($(this).attr("id") == "cargo_line_status" && $(this).val() == "Open") {
            $('select#cargo_cancel_reason').val("")
            $('select#cargo_cancel_reason').attr('disabled', true);
        } else {
            $('select#cargo_cancel_reason').attr('disabled', false);
        }

        if ($(this).attr("id") == "serviceother_status" && $(this).val() == "Open") {
            $('select#serviceother_cancel_reason').val("")
            $('select#serviceother_cancel_reason').attr('disabled', true);
        } else {
            $('select#serviceother_cancel_reason').attr('disabled', false);
        }

        if ($(this).attr("id") == "immigration_line_status" && $(this).val() == "Open") {
            $('select#immigration_cancel_reason').val("")
            $('select#immigration_cancel_reason').attr('disabled', true);
        } else {
            $('select#immigration_cancel_reason').attr('disabled', false);
        }

        if ($(this).attr("id") == "taxi_line_status" && $(this).val() == "Open") {
            $('select#taxi_cancel_reason').val("")
            $('select#taxi_cancel_reason').attr('disabled', true);
        } else {
            $('select#taxi_cancel_reason').attr('disabled', false);
        }

        if ($(this).attr("id") == "warehousing_status" && $(this).val() == "Open") {
            $('select#warehousing_cancel_reason').val("")
            $('select#warehousing_cancel_reason').attr('disabled', true);
        } else {
            $('select#warehousing_cancel_reason').attr('disabled', false);
        }

        if ($(this).attr("id") == "utilities_status" && $(this).val() == "Open") {
            $('select#utilities_cancel_reason').val("")
            $('select#utilities_cancel_reason').attr('disabled', true);
        } else {
            $('select#utilities_cancel_reason').attr('disabled', false);
        }

        if ($(this).attr("id") == "rental_status" && $(this).val() == "Open") {
            $('select#rental_cancel_reason').val("")
            $('select#rental_cancel_reason').attr('disabled', true);
        } else {
            $('select#rental_cancel_reason').attr('disabled', false);
        }

        if ($(this).attr("id") == "hotelbooking_status" && $(this).val() == "Open") {
            $('select#hotelbooking_cancel_reason').val("")
            $('select#hotelbooking_cancel_reason').attr('disabled', true);
        } else {
            $('select#hotelbooking_cancel_reason').attr('disabled', false);
        }

        if ($(this).attr("id") == "ticketbooking_status" && $(this).val() == "Open") {
            $('select#ticketbooking_cancel_reason').val("")
            $('select#ticketbooking_cancel_reason').attr('disabled', true);
        } else {
            $('select#ticketbooking_cancel_reason').attr('disabled', false);
        }

        if ($(this).attr("id") == "customerclearancecargo_status" && $(this).val() == "Open") {
            $('select#customerclearancecargo_cancel_reason').val("")
            $('select#customerclearancecargo_cancel_reason').attr('disabled', true);
        } else {
            $('select#customerclearancecargo_cancel_reason').attr('disabled', false);
        }

        if ($(this).attr("id") == "customerclearancevessel_status" && $(this).val() == "Open") {
            $('select#customerclearancevessel_cancel_reason').val("")
            $('select#customerclearancevessel_cancel_reason').attr('disabled', true);
        } else {
            $('select#customerclearancevessel_cancel_reason').attr('disabled', false);
        }

        if ($(this).attr("id") == "agencyservice_status" && $(this).val() == "Open") {
            $('select#agencyservice_cancel_reason').val("")
            $('select#agencyservice_cancel_reason').attr('disabled', true);
        } else {
            $('select#agencyservice_cancel_reason').attr('disabled', false);
        }

        if ($(this).attr("id") == "managementfree_status" && $(this).val() == "Open") {
            $('select#managementfree_cancel_reason').val("")
            $('select#managementfree_cancel_reason').attr('disabled', true);
        } else {
            $('select#managementfree_cancel_reason').attr('disabled', false);
        }

        if ($(this).attr("id") == "provisionincome_status" && $(this).val() == "Open") {
            $('select#provisionincome_cancel_reason').val("")
            $('select#provisionincome_cancel_reason').attr('disabled', true);
        } else {
            $('select#provisionincome_cancel_reason').attr('disabled', false);
        }





    });
</script>