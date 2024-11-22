<style>
    .w-5{
        width: 100px!important
    }
</style>
    
<div class="modal-body"> 
    <form id="worksheet_data">
        <div id="edit_area">
            <div class="row">  
				<div class="col-6">
                    <div class="form-group">
						<span >Subject</span><span style="color:red"> *</span>
						<select name="subject" id="subject" class="form-control" aria-describedby="inputGroupPrepend2" required>
                            <option value=""></option>
                            <?php
                                $fQuery = "SELECT * FROM subject";
                                $result = sqlsrv_query($conn, $fQuery);
                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-2">   
                    <div class="form-group">
                        <span class="label success">Job ID</span>
                        <input type="text" name="worksheet_id" id="worksheet_id" class="form-control" readonly> 
                        <!-- fix -->
                    </div>
                </div>
				<div class="col-2">
                    <div class="form-group">
						<span >Branch</span><span style="color:red"> *</span>
						<select name="branch" id="branch" class="form-control" aria-describedby="inputGroupPrepend2" required>
                            <option value=""></option>
                            <?php
                                $fQuery = "SELECT * FROM branch";
                                $result = sqlsrv_query($conn, $fQuery);
                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-2">   
                    <div class="form-group">
                        <span>Date</span>
                        <input type="date" name="worksheet_date" id="worksheet_date" class="form-control" required readonly>
                    </div>
                </div>                
			</div>
			<div class="row"> 
                <div class="col-6">
                    <div class="form-group">
					<span >Customer</span><span style="color:red"> *</span>
                        <select name="customer" id="customer" class="form-control" aria-describedby="inputGroupPrepend2" required>
                            <option value=""></option>
                            <?php
                                $fQuery = "SELECT customer_id,name FROM customer where block = 0 order by name ";
                                $result = sqlsrv_query($conn, $fQuery);
                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                <option value="<?php echo $row['customer_id'];?>"><?php echo $row['name'];?></option>	              
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
                        <span>Worksheet Status</span>
                        <select name="worksheet_status" id="worksheet_status" class="form-control" aria-describedby="inputGroupPrepend2" >
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
				<div class="col-2 ">
                    <div class="form-group">
						<span >Request method</span><span style="color:red"> *</span>
                        <select name="request_method" id="request_method" class="form-control" aria-describedby="inputGroupPrepend2" >
							<option value="Line">Line</option>
							<option value="Phone">Phone</option>
							<option value="Email">Email</option>
							<option value="Talk">Talk</option>
                        </select> 
                    </div>
                </div>
				<div class="col-2 ">
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
                </div>
				<div class="col-2">   
                    <div class="form-group">
						<span >Client request date</span><span style="color:red"> *</span>
                        <input type="date" name="client_inform_amarit_date" id="client_inform_amarit_date" class="form-control" required>
                    </div>
                </div>
				<div class="col-2">
                    <div class="form-group">
						<span >time</span><span style="color:red"> *</span>
                        <input type="time" name="client_inform_amarit_time" id="client_inform_amarit_time" class="form-control" required>
                    </div>
                </div>
				<div class="col-2">   
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
                </div>
				<div class="col-2">   
                    <div class="form-group">
						<span >CS inform Client</span>
                        <input type="date" name="cs_inform_client_date" id="cs_inform_client_date" class="form-control" >
                    </div>
                </div>
				<div class="col-2">
                    <div class="form-group">
                        <span >time</span>
                        <input type="time" name="cs_inform_client_time" id="cs_inform_client_time" class="form-control" >
                    </div>
                </div>
                <div class="col-2 send">
                    <div class="form-group">
						<span >Send to A/R  Date</span><span style="color:red"> *</span>
                        <input type="date" name="send_date" id="send_date" class="form-control">
                    </div>
                </div>
                <div class="col-2 send">
                    <div class="form-group">
						<span >Send to A/R  Time</span><span style="color:red"> *</span>
                        <input type="time" name="send_time" id="send_time" class="form-control">
                    </div>
                </div>
                
                <div class="col-2 rcvd">
                    <div class="form-group">
						<span >RCVD by A/R Date</span><span style="color:red"> *</span>
                        <input type="date" name="rcvd_date" id="rcvd_date" class="form-control">
                    </div>
                </div>
                <div class="col-2 rcvd">
                    <div class="form-group">
						<span >RCVD by A/R Time</span><span style="color:red"> *</span>
                        <input type="time" name="rcvd_time" id="rcvd_time" class="form-control">
                    </div>
                </div>

				<div class="col-2 close_stt">
                    <div class="form-group">
						<span >Close Date</span><span style="color:red"> *</span>
                        <input type="date" name="close_date" id="close_date" class="form-control">
                    </div>
                </div>
                <div class="col-2 close_stt">
                    <div class="form-group">
						<span >Close Time</span><span style="color:red"> *</span>
                        <input type="time" name="close_time" id="close_time" class="form-control">
                    </div>
                </div>

				<div class="col-3 cancel">
                    <div class="form-group">
						<span >Cancel Reason</span><span style="color:red"> *</span>
						<select name="cancel_reason" id="cancel_reason" class="form-control" aria-describedby="inputGroupPrepend2" >
                            <option value=""></option>
                            <?php
                                $fQuery = "SELECT * FROM cancellation_reason";
                                $result = sqlsrv_query($conn, $fQuery);
                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
                            <?php } ?>
                        </select>
                    </div>
                </div>
				<div class="col-8 reject">
					<div class="form-group">
                        <span class="label success">Reject reason</span>
                        <input type="text" name="reject_reason" id="reject_reason" class="form-control" >
                    </div>
                </div>
            </div>
			<div class="row"> 
				<div class="col-6">
                    <div class="form-group">
                        <span>Reference 1</span>
                        <input type="text" name="worksheet_ref1" id="worksheet_ref1" class="form-control" maxlength="50">
                    </div>
                </div>
				<div class="col-6">
                    <div class="form-group">
                        <span>Reference 2</span>
                        <input type="text" name="worksheet_ref2" id="worksheet_ref2" class="form-control" maxlength="50">
                    </div>
                </div>
				<div class="col-6">
                    <div class="form-group">
                        <span>Reference 3</span>
                        <input type="text" name="worksheet_ref3" id="worksheet_ref3" class="form-control" maxlength="50">
                    </div>
                </div>
				<div class="col-6">
                    <div class="form-group">
                        <span>Reference 4</span>
                        <input type="text" name="worksheet_ref4" id="worksheet_ref4" class="form-control" maxlength="50">
                    </div>
                </div>
				<div class="col-6">
                    <div class="form-group">
                        <span>Reference 5</span>
                        <input type="text" name="worksheet_ref5" id="worksheet_ref5" class="form-control" maxlength="50">
                    </div>
                </div>
				<div class="col-6">
                    <div class="form-group">
                        <span>Reference 6</span>
                        <input type="text" name="worksheet_ref6" id="worksheet_ref6" class="form-control" maxlength="50">
                    </div>
                </div>
			</div>
        </div>
			

        <br>

        <div class="row">
            <div class="col-6"> 
				<br>
                <button style="width:100px" type="submit" class="btn btn-success" id="worksheet_submit" data-bs-target="#" >
                        <i class="fas fa-save"></i> Save
                    </button>
                <button style="width:100px" type="button" class="btn btn-danger"  id="worksheet_cancel" data-bs-target="#" >
                    <i class="fas fa-minus-square"></i> Cancel
                </button>
                <input type="hidden" id="contact_id">
				<input type="hidden" id="user_name">
            </div>
			<div class="col-2">   
				<div class="form-group">
					<span>Create service from id</span>
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
                        <i class="fas fa-save"></i> Confirm
                    </button>
            </div>
        </div>               
    
    </form>


    <div id="sub_data">
        <div class="card-body">  
            <ul class="nav nav-tabs" role="tablist">
                <!-- fix -->
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#transport-tab" id="transport-nav">Warehouse Rental</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#manpower-tab" id="manpower-nav">Space Rental</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#cargo-tab" id="cargo-nav">Vehicle Rental</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#service-tab" id="service-nav">Customs clearance</a>
                </li> 
				<li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#immigration-tab" id="immigration-nav">Immigration</a> 
                </li>
				<li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#taxi-tab" id="taxi-nav">Taxi Booking</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#service-tab" id="service-nav">Service Other</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#service-tab" id="service-nav">Manpower</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#hotel-tab" id="hotel-nav">Hotel Booking</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#ticket-tab" id="ticket-nav">Ticket Booking</a> 
                </li>
            </ul>                

            <div class="tab-content">
                <div class="tab-pane active" id="transport-tab">
					<br>
                    <form id="transport_data">
                        <div id="transport_edit_area">
                        
                            <div class="row"> 
                                <div class="col-2">   
                                    <div class="form-group">
									<span>Transport ID</span>
                                        <input type="text" name="transport_id" id="transport_id" class="form-control" required readonly>
                                    </div>
                                </div>
								<div class="col-5">   
                                    <div class="form-group">
										<span>Vehicle</span><span style="color:red"> *</span>
                                        <select name="vehicle" id="transport_vehicle" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT vehicle_id, vehicle_type, b.description as vehicle_owner, registration_no, branch FROM vehicle left join vehicle_owner b on b.code = vehicle_owner where category = 'Vehicles' and block = 0 order by registration_no ";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['vehicle_id'];?>"><?php echo $row['registration_no'].' | '.$row['vehicle_type'].' | '.$row['vehicle_owner'];?></option>	              
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>       
								<div class="col-5">   
                                    <div class="form-group">
                                        <span>Operator</span><span style="color:red"> *</span>
                                        <select name="operator" id="transport_operator" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT o.operator_id, o.name, o.lastname, p.description, o.branch, l.description as br FROM operator o left join position p on p.code = o.position left join location l on o.branch = l.code where o.operator = 1 and o.block = 0 order by o.name, o.lastname ";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['operator_id'];?>"><?php echo $row['name']."  ".$row['lastname'].' | '.$row['description'].' | '.$row['br'];?></option>	              
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> 
								<div class="col-2">   
                                    <div class="form-group">
                                    <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" name="quantity" id="transport_quantity" class="form-control" required>
                                    </div>
                                </div> 
								<div class="col-2">   
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red"> *</span>
										<select name="uom" id="transport_uom" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        <option value=""></option>
                                        <?php
                                            $fQuery = "SELECT * FROM uom";
                                            $result_uom = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_uom, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
								<div class="col-4">
										<div class="form-group">
											<span>Charge as</span><span style="color:red"> *</span>
											<select id="charge_as" name="charge_as" class="form-control" required>
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM vehicle_type order by code";
													$result_skill = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<span>Outsource charge as</span><span style="color:red"> *</span>
											<select id="outsource_charge_as" name="outsource_charge_as" class="form-control" required>
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM vehicle_type order by code";
													$result_skill = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>
                            </div>

							<div class="row"> 
								<div class="col-4">   
                                    <div class="form-group">
                                        <span>From</span><span style="color:red"> *</span>
                                        <select name="transport_from" id="transport_transport_from" class="form-control" aria-describedby="inputGroupPrepend2" required>      
                                        </select>
                                    </div>
                                </div>
								<div class="col-4">   
									<div class="form-group">
										<span>Specific location (from)</span><span style="color:red"> *</span>
											<input type="text" name="specific_location_from" id="specific_location_from" class="form-control" required>
									</div>
								</div>
								<div class="col-4">   
									<div class="form-group">
										<span>Contact person (from)</span><span style="color:red"> *</span>
											<input type="text" name="contact1" id="contact1" class="form-control" >
									</div>
								</div>
								<div class="col-4">   
                                    <div class="form-group">
                                        <span>To</span>
                                        <select name="transport_to" id="transport_transport_to" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        </select>
                                    </div>
                                </div>
								<div class="col-4">   
									<div class="form-group">
										<span>Specific location (to)</span>
											<input type="text" name="specific_location_to" id="specific_location_to" class="form-control" required>
									</div>
								</div>
								<div class="col-4">   
									<div class="form-group">
										<span>Contact person (to)</span><span style="color:red"> *</span>
											<input type="text" name="contact2" id="contact2" class="form-control" >
									</div>
								</div>
									
									<div class="col-2">   
										<div class="form-group">
											<span>Contract Number</span><span style="color:red"> *</span>											
											<select name="contract_no1" id="contract_no1" class="form-control" > 
											</select>
										</div>
									</div>
									<div class="col-2">   
										<div class="form-group">
											<span>Show hidden contract</span>										
											<input type="text" name="contract_no1_1" id="contract_no1_1" class="form-control" readonly>
										</div>
									</div>
								<div class="col-2">
									<div class="form-group">
										<span>Confirm Contract</span>
										<input type="checkbox"  value="1" id="transport_confirm_contract" name="transport_confirm_contract" class="form-check">
									</div>
								</div>
									<div class="col-2">   
										<div class="form-group">
											<span>Contract line number</span>
											<input type="text" name="contract_line1" id="contract_line1" class="form-control" readonly>
										</div>
									</div>
									<div class="col-2">   
										<div class="form-group">
											<span>Diesel Rate</span><span style="color:red"> *</span>
											<input type="text" name="diesel_rate" id="diesel_rate" class="form-control" required>
										</div>
									</div>
								<div class="col-2">   
                                    <div class="form-group">
                                        <span>Promotion</span>
                                        <select name="transport_promotion_code" id="transport_promotion_code" class="form-control" >      
                                        </select>
                                    </div>
                                </div>
							</div> 

                            <div class="row"> 
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="start_date" id="transport_start_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="start_time" id="transport_start_time" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="end_date" id="transport_end_date" class="form-control" required>
                                    </div>
                                </div> 
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>End Time</span><span style="color:red"> *</span>
                                        <input type="time" name="end_time" id="transport_end_time" class="form-control" required>
                                    </div>
                                </div> 
                                <div class="col-4">   
									<div class="form-group">
										<span>Remark</span>
										<input type="text" name="transport_remark" id="transport_remark"		class="form-control" >
									</div>
								</div>	
								<div class="col-2">   
                                    <div class="form-group">
										<span>Transport solution</span>
                                        <input type="checkbox"  value="1" id="transport_solution" name="transport_solution" class="form-check">
                                    </div>
                                </div>
								<div class="col-2">
									<div class="form-group">
										<span>No charge</span>
										<input type="checkbox"  value="1" id="no_charge" name="no_charge" class="form-check">
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>Consolidate</span>
										<input type="checkbox"  value="1" id="consolidate" name="consolidate" class="form-check">
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>Vehicle Switch</span>
										<input type="checkbox"  value="1" id="vehicle_switch" name="vehicle_switch" class="form-check">
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>Standby</span>
										<input type="checkbox"  value="1" id="standby_charge" name="standby_charge" class="form-check">
									</div>
								</div>
								
								<div class="col-2">
									<div class="form-group">
										<span>Round trip</span>
										<input type="checkbox"  value="1" id="round_trip" name="round_trip" class="form-check">
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>Lumsum charge</span>
										<input type="checkbox"  value="1" id="lumsum_charge" name="lumsum_charge" class="form-check">
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>No allowance</span>
										<input type="checkbox"  value="1" id="no_allowance" name="no_allowance" class="form-check">
									</div>
								</div>
								<div class="col-2 ">
										<div class="form-group">
											<span>Line status</span>
											<select name="transport_line_status" id="transport_line_status" class="form-control" aria-describedby="inputGroupPrepend2" required>
												<option value="Open">Open</option>
												<option value="Cancelled">Cancelled</option>
											</select>
										</div>
									</div>
								<div class="col-2 cancel1">
										<div class="form-group">
											<span>Cancel Reason</span>
											<select name="transport_cancel_reason" id="transport_cancel_reason" class="form-control" aria-describedby="inputGroupPrepend2" >
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM cancellation_reason";
													$result = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>
								<div class="col-2 cancel1">
										<div class="form-group">
											<span>Reason for outsource</span>
											<select name="transport_outsource_reason" id="transport_outsource_reason" class="form-control" aria-describedby="inputGroupPrepend2" >
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM outsource_reason";
													$result = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>

                            </div>

                            <div class="row"> 								

									<div class="col-2 ">
										<div class="form-group">
										 <span>Cargo type</span>
											<select name="transport_cargo_type" id="transport_cargo_type" class="form-control" aria-describedby="inputGroupPrepend2" >
												<option value="Normal">Normal</option>
												<option value="DG">DG</option>
												<option value="Radio active">Radio active</option>
												<option value="Batteries">Batteries</option>
											</select>
										</div>
									</div>
									<div class="col-2">   
                                        <div class="form-group">
                                        <span>Cargo quantity</span>
                                            <input type="number" name="transport_cargo_qty" id="transport_cargo_qty" class="form-control"  >
                                        </div>
                                    </div>  
									<div class="col-2">   
                                        <div class="form-group">
                                        <span>Cargo weight(Kg.)</span>
                                            <input type="number" name="transport_cargo_weight" id="transport_cargo_weight" class="form-control"  >
                                        </div>
                                    </div>
									<div class="col-2">   
										<div class="form-group">
											<span>Dimension</span>
											<input type="text" name="dimension" id="dimension" class="form-control" >
										</div>
									</div>
									<div class="col-2">
									<div class="form-group">
										<span>Department</span>
										<select id="transport_department" name="transport_department" class="form-control" readonly>
											<option value=""></option>
											<?php
												// $serverNamex = "192.168.10.4";
												// $connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
												// $connx = sqlsrv_connect( $serverName, $connectionInfo);
												// $table = '';
												// $dimension = " and [Dimension Code] = 'DEPARTMENT' ";
												// $name = "";//" and Name <> 'OUTSOURCE' ";
												// //$fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
                                                // $fQuery = ' SELECT * FROM worksheet_cargo_transport '.$dimension.$name;
												// $result_skill = sqlsrv_query($connx, $fQuery);
												//while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
												<option value="<?php //echo $row['Code'];?>"><?php //echo $row['Code'];?></option>	              
											<?php //} ?>
										</select>
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>Cost center</span><span style="color:red"> *</span>
										<select id="transport_cost_center" name="transport_cost_center" class="form-control" readonly>
											<option value=""></option>
											<?php
												// $serverNamex = "192.168.10.4";
												// $connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
												// $connx = sqlsrv_connect( $serverName, $connectionInfo);
												// $table = '';
												// $dimension = " and [Dimension Code] = 'COST CENTER' ";
												// $name = "";//" and Name <> 'OUTSOURCE' ";
												// // $fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
                                                // $fQuery = ' SELECT * FROM worksheet_cargo_transport';
												// $result_skill = sqlsrv_query($connx, $fQuery);
												//while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
												<option value="<?php //echo $row['Code'];?>"><?php //echo $row['Code'];?></option>	              
											<?php //} ?>
										</select>
									</div>
								</div>
                            </div>
                            <div id="moreinfo"> 
								<div class="row">
									<div class="col-2">   
										<div class="form-group">
										<span>Actual start date</span><span style="color:red"> *</span>
											<input type="date" name="actual_start_date" id="actual_start_date" class="form-control" >
										</div>
									</div> 
									<div class="col-2">   
										<div class="form-group">
										<span>Actual start time</span><span style="color:red"> *</span>
											<input type="time" name="actual_start_time" id="actual_start_time" class="form-control" >
										</div>
									</div>
									
										<div class="col-2">   
										<div class="form-group">
										<span>Actual finished date</span><span style="color:red"> *</span>
											<input type="date" name="actual_finish_date" id="actual_finish_date" class="form-control" >
										</div>
									</div> 
									<div class="col-2">   
										<div class="form-group">
										<span>Actual finished time</span><span style="color:red"> *</span>
											<input type="time" name="actual_finish_time" id="actual_finish_time" class="form-control" >
										</div>
									</div>
									<div class="col-2">   
										<div class="form-group">
										<span>Started mileage</span><span style="color:red"> *</span>
											<input type="number" name="mileage_start" id="mileage_start" class="form-control" >
										</div>
									</div>  
									<div class="col-2">   
										<div class="form-group">
										<span>Finished mileage</span><span style="color:red"> *</span>
											<input type="number" name="mileage_end" id="mileage_end" class="form-control" >
										</div>
									</div>
								</div>
                                <div class="row"> 
									<div class="col-4">   
                                        <div class="form-group">
                                            <span>Name</span>
											<select name="transport_group_name" id="transport_group_name" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM group_name where transport = 1";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['code'].'-'.$row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 1</span>
											<select name="transport_type1" id="transport_type1" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_1 where transport = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 2</span>
											<select name="transport_type2" id="transport_type2" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_2 where transport = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 3</span>
											<select name="transport_type3" id="transport_type3" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_3 where transport = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 4</span>
											<select name="transport_type4" id="transport_type4" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_4 where transport = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>								
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 1</span>
											<input type="text" name="ref1" id="ref1"		class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 2</span>
											<input type="text" name="ref2" id="ref2"		class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 3</span>
											<input type="text" name="ref3" id="ref3"		class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 4</span>
											<input type="text" name="ref4" id="ref4"		class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 5</span>
											<input type="text" name="ref5" id="ref5"		class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 6</span>
											<input type="text" name="ref6" id="ref6"		class="form-control" >
										</div>
									</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="transport_add" data-bs-target="#" >
                                    <i class="fas fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="transport_submit" data-bs-target="#" >
                                    <i class="fas fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="transport_cancel" data-bs-target="#" >
                                    <i class="fas fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="transport_type" id="transport_type">
								<input type="hidden" name="transport_outsource" id="transport_outsource">
                                <input type="hidden" name="transport_reccode" id="transport_reccode">

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
                                    <span>Labour service ID</span>
                                        <input type="text" name="labor_service_id" id="labor_service_id" class="form-control" required readonly>
                                    </div>
                                </div>
								
								<div class="col-3">   
                                    <div class="form-group">
                                        <span>Position</span><span style="color:red"> *</span>
										<select name="position" id="manpower_position" class="form-control" aria-describedby="inputGroupPrepend2" required>      
                                        </select>
                                    </div>
                                </div> 
								<div class="col-4">   
                                    <div class="form-group">
                                        <span>Manpower Name</span>
                                        <select name="labor" id="labor" class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT o.operator_id, o.name, o.lastname, p.description, o.branch FROM operator o left join position p on p.code = o.position where o.manpower = 1 order by o.name, o.lastname";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['operator_id'];?>"><?php echo $row['name']."  ".$row['lastname'].' | '.$row['description'];?></option>	              
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> 
								<div class="col-3">   
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
										<select id="location" name="location" class="form-control" required>
												<option value=""></option>
												<?php
													$fQuery = " SELECT * FROM contract_location_master where active = 1 ";
													$result_location = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result_location, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['location'];?>"><?php echo $row['location'];?></option>	              
												<?php } ?>
											</select>
                                    </div>
                                </div> 
							</div>

                            <div class="row"> 
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="manpower_start_date" id="manpower_start_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="manpower_start_time" id="manpower_start_time" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="manpower_end_date" id="manpower_end_date" class="form-control">
                                    </div>
                                </div> 
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>End Time</span><span style="color:red"> *</span>
                                        <input type="time" name="manpower_end_time" id="manpower_end_time" class="form-control" >
                                    </div>
                                </div> 
                                <div class="col-1">   
                                    <div class="form-group">
                                    <span>Qty</span><span style="color:red"> *</span>
                                        <input type="number" placeholder="1.0" step="0.01" min="0" max="100" name="manpower_quantity" id="manpower_quantity" class="form-control" required>
                                    </div>
                                </div> 
								<div class="col-3">   
                                    <div class="form-group">
                                        <span>UOM</span><span style="color:red"> *</span>
                                        <select name="manpower_uom" id="manpower_uom" class="form-control" aria-describedby="inputGroupPrepend2" required>
										<option value=""></option>
										<?php
                                          $fQuery = "SELECT * FROM uom";
                                          $result_uom = sqlsrv_query($conn, $fQuery);
                                          while($row = sqlsrv_fetch_array( $result_uom, SQLSRV_FETCH_ASSOC)) {?>					  
                                          <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
										<?php } ?>
										</select>
                                    </div>
                                </div>
								<div class="col-2">
									<div class="form-group">
										<span>OT line</span>
										<input type="checkbox"  value="1" id="manpower_ot" name="manpower_ot" class="form-check">
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>On time</span>
										<input type="checkbox"  value="1" id="ontime" name="ontime" class="form-check">
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>No charge</span>
										<input type="checkbox"  value="1" id="manpower_no_charge" name="manpower_no_charge" class="form-check">
									</div>
								</div>
								<div class="col-3">
									<div class="form-group">
										<span>Charge as</span><span style="color:red"> *</span>
											<select name="manpower_charge_as" id="manpower_charge_as"		class="form-control"	aria-describedby="inputGroupPrepend2" required>      
											</select>

									</div>
								</div>
								<div class="col-3">
									<div class="form-group">
										<span>Outsource charge as</span><span style="color:red"> *</span>
											<select id="manpower_outsource_charge_as" name="manpower_outsource_charge_as" class="form-control" required>
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM position";
													$result_skill = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>Lumsum charge</span>
										<input type="checkbox"  value="1" id="manpower_lumsum_charge" name="manpower_lumsum_charge" class="form-check">
									</div>
								</div>
								<div class="col-2 ">
										<div class="form-group">
											<span>Status</span>
											<select name="manpower_line_status" id="manpower_line_status" class="form-control" aria-describedby="inputGroupPrepend2" required>
												<option value="Open">Open</option>
												<option value="Cancelled">Cancelled</option>
											</select>
										</div>
									</div>
								<div class="col-4">   
		                           <div class="form-group">
			                       <span>Remark</span>
				                       <input type="text" name="manpower_remark" id="manpower_remark"		class="form-control" >
								  </div>
								</div>
								<div class="col-4">   
									<div class="form-group">
										<span>Contact person</span>
											<input type="text" name="manpower_contact" id="manpower_contact" class="form-control" >
									</div>
								</div>
                            </div>

                            <div class="row"> 
								
								
									<div class="col-3 manpower_cancel_reason">
										<div class="form-group">
											<span>Cancel Reason</span>
											<select name="manpower_cancel_reason" id="manpower_cancel_reason" class="form-control" aria-describedby="inputGroupPrepend2" required>
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM cancellation_reason";
													$result = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>
								<div class="col-6 cancel1">
										<div class="form-group">
											<span>Reason for outsource</span>
											<select name="manpower_outsource_reason" id="manpower_outsource_reason" class="form-control" aria-describedby="inputGroupPrepend2" >
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM outsource_reason";
													$result = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>
								
								<div class="col-2">   
                                    <div class="form-group">
                                    <span>Timesheet no.</span>
                                        <input type="text" name="timesheet_no" id="timesheet_no" class="form-control">
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
                                    <span>Timesheet issue date</span>
                                        <input type="date" name="timesheet_issue_date" id="timesheet_issue_date" class="form-control" >
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
                                    <span>Timesheet return date</span>
                                        <input type="date" name="timesheet_return_date" id="timesheet_return_date" class="form-control" >
                                    </div>
                                </div>

								<div class="col-6">   
                                        <div class="form-group">
                                            <span>Name</span>
											<select name="manpower_group_name" id="manpower_group_name" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM group_name where manpower = 1";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['code'].'-'.$row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 1</span>
											<select name="manpower_type1" id="manpower_type1" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_1 where manpower = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 2</span>
											<select name="manpower_type2" id="manpower_type2" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_2 where manpower = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 3</span>
											<select name="manpower_type3" id="manpower_type3" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_3 where manpower = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 4</span>
											<select name="manpower_type4" id="manpower_type4" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_4 where manpower = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									
									<div class="col-2 ">
										<div class="form-group">
											<span>Cost type</span>
											<select name="manpower_cost_type" id="manpower_cost_type" class="form-control" aria-describedby="inputGroupPrepend2" required>
												<option value="Charge">Charge</option>
												<option value="Fixed Cost">Fixed Cost</option>	
												<option value="Non work">Non work</option>
											</select>
										</div>
									</div>
									<div class="col-4">   
                                        <div class="form-group">
                                            <span>Sub task name</span>
											<select name="sub_task_name" id="sub_task_name" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM sub_task order by code";
                                            $result_sub_task = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_sub_task, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">
									<div class="form-group">
										<span>Department</span><span style="color:red"> *</span>
										<select id="manpower_department" name="manpower_department" class="form-control" readonly>
											<option value=""></option>
											<?php
												// $serverNamex = "192.168.10.4";
												// $connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
												$connx = sqlsrv_connect( $serverName, $connectionInfo);
												$table = '';
												$dimension = " and [Dimension Code] = 'DEPARTMENT' ";
												$name = "";//" and Name <> 'OUTSOURCE' ";
												//$fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
                                                $fQuery = ' SELECT * FROM worksheet_manpower ';//.$dimension.$name;
												$result_skill = sqlsrv_query($connx, $fQuery);
												while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
												<option value="<?php echo $row['Code'];?>"><?php echo $row['Code'];?></option>	              
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>Cost center</span><span style="color:red"> *</span>
										<select id="manpower_cost_center" name="manpower_cost_center" class="form-control" readonly>
											<option value=""></option>
											<?php
												// $serverNamex = "192.168.10.4";
												// $connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
												// $connx = sqlsrv_connect( $serverName, $connectionInfo);
												// $table = '';
												// $dimension = " and [Dimension Code] = 'COST CENTER' ";
												// $name = "";//" and Name <> 'OUTSOURCE' ";
												// //$fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
                                                // $fQuery = ' SELECT * FROM worksheet_manpower ';
												// $result_skill = sqlsrv_query($connx, $fQuery);
												// while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
												<option value="<?php //echo $row['Code'];?>"><?php //echo $row['Code'];?></option>	              
											<?php //} ?>
										</select>
									</div>
								</div>
								<div class="col-2">   
										<div class="form-group">
											<span>Contract Number</span><span style="color:red"> *</span>											
											<select name="manpower_contract_no" id="manpower_contract_no" class="form-control" >     
											</select>
										</div>
									</div>
								<div class="col-2">   
									<div class="form-group">
										<span>Show hidden contract</span>										
										<input type="text" name="manpower_contract_no_1" id="manpower_contract_no_1" class="form-control" readonly>
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>Confirm Contract</span>
										<input type="checkbox"  value="1" id="manpower_confirm_contract" name="manpower_confirm_contract" class="form-check">
									</div>
								</div>
									<div class="col-2">   
										<div class="form-group">
											<span>Contract line number</span>
											<input type="text" name="manpower_contract_line" id="manpower_contract_line" class="form-control" readonly>
										</div>
									</div>
								<div class="col-4">   
                                    <div class="form-group">
                                        <span>Promotion</span>
                                        <select name="manpower_promotion_code" id="manpower_promotion_code" class="form-control" aria-describedby="inputGroupPrepend2">      
                                        </select>
                                    </div>
                                </div>
							</div>							
							<div class="row"> 
								<div class="col-6">   
										<div class="form-group">
											<span>Reference 1</span>
											<input type="text" name="manpower_ref1" id="manpower_ref1" class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 2</span>
											<input type="text" name="manpower_ref2" id="manpower_ref2" class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 3</span>
											<input type="text" name="manpower_ref3" id="manpower_ref3"	class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 4</span>
											<input type="text" name="manpower_ref4" id="manpower_ref4"	class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 5</span>
											<input type="text" name="manpower_ref5" id="manpower_ref5"	class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 6</span>
											<input type="text" name="manpower_ref6" id="manpower_ref6"	class="form-control" >
										</div>
									</div>
							</div>
						</div>

                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="manpower_add" data-bs-target="#" >
                                    <i class="fas fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="manpower_submit" data-bs-target="#" >
                                    <i class="fas fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="manpower_cancel" data-bs-target="#" >
                                    <i class="fas fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="manpower_type" id="manpower_type">
								<input type="hidden" name="manpower_outsource" id="manpower_outsource">
                                <input type="hidden" name="manpower_reccode" id="manpower_reccode">

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
                                        <input type="text" name="cargo_service_id" id="cargo_service_id" class="form-control" required readonly>
                                    </div>
                                </div>
								<div class="col-3">   
                                    <div class="form-group">
                                        <span>Vehicle</span><span style="color:red"> *</span>
                                        <select name="cargo_vehicle" id="cargo_vehicle" class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT vehicle_id, vehicle_type, b.description as vehicle_owner, registration_no, branch FROM vehicle left join vehicle_owner b on b.code = vehicle_owner where category = 'Heavy Equipment' order by vehicle_type, b.description ";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['vehicle_id'];?>"><?php echo $row['registration_no'].' | '.$row['vehicle_type'].' | '.$row['vehicle_owner'].' | '.$row['branch'];?></option>	              
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> 
								<div class="col-4">   
                                    <div class="form-group">
                                        <span>Operator</span><span style="color:red"> *</span>
                                        <select name="operator" id="cargo_operator" class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT o.operator_id, o.name, o.lastname, p.description, o.branch FROM operator o left join position p on p.code = o.position where o.operator = 1 order by o.name, o.lastname";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['operator_id'];?>"><?php echo $row['name']."  ".$row['lastname'].' | '.$row['description'].' | '.$row['branch'];?></option>	              
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> 
								<div class="col-3">   
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span>
										<select name="cargo_transport_from" id="cargo_transport_from" class="form-control" aria-describedby="inputGroupPrepend2" required>      
                                        </select>
                                    </div>
                                </div>  
							</div>

                            <div class="row"> 
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="start_date" id="cargo_start_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="start_time" id="cargo_start_time" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>End Date</span>
                                        <input type="date" name="end_date" id="cargo_end_date" class="form-control" >
                                    </div>
                                </div> 
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>End Time</span>
                                        <input type="time" name="end_time" id="cargo_end_time" class="form-control" >
                                    </div>
                                </div>
								<div class="col-1">   
                                    <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                            <input type="text" name="quantity" id="cargo_quantity" class="form-control" required>
                                    </div>
                                </div>   
                                <div class="col-3">   
                                    <div class="form-group">
                                            <span>UOM</span><span style="color:red"> *</span>
                                            <select name="uom" id="cargo_uom" class="form-control" aria-describedby="inputGroupPrepend2" required>
											<option value=""></option>
											<?php
											$fQuery = "SELECT * FROM uom";
											$result_uom = sqlsrv_query($conn, $fQuery);
											while($row = sqlsrv_fetch_array( $result_uom, SQLSRV_FETCH_ASSOC)) {?>					  
											<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                    </div>
                                </div>
								<div class="col-2">
									<div class="form-group">
										<span>OT</span>
										<input type="checkbox"  value="1" id="cargo_ot" name="cargo_ot" class="form-check">
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>No charge</span>
										<input type="checkbox"  value="1" id="cargo_no_charge" name="cargo_no_charge" class="form-check">
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>On time</span>
										<input type="checkbox"  value="1" id="cargo_ontime" name="cargo_ontime" class="form-check">
									</div>
								</div>
								<div class="col-3">
									<div class="form-group">
											<span>Charge as</span><span style="color:red"> *</span>
											<select name="cargo_charge_as" id="cargo_charge_as" class="form-control" aria-describedby="inputGroupPrepend2" required>      
											</select>
									</div>
								</div>
								<div class="col-3">
									<div class="form-group">
											<span>Outsource charge as</span><span style="color:red"> *</span>
											<select id="cargo_outsource_charge_as" name="cargo_outsource_charge_as" class="form-control" required>
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM vehicle_type order by code";
													$result_skill = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
									</div>
								</div>
								<div class="col-4">   
									<div class="form-group">
											<span>Remark</span>
											<input type="text" name="cargo_remark" id="cargo_remark"		class="form-control" >
									</div>
								</div>
								<div class="col-4">   
										<div class="form-group">
											<span>Contact person</span>
											<input type="text" name="cargo_handling_contact" id="cargo_handling_contact" class="form-control" >
										</div>
									</div>
								<div class="col-2">
									<div class="form-group">
										<span>Department</span><span style="color:red"> *</span>
										<select id="cargo_department" name="cargo_department" class="form-control" readonly>
											<option value=""></option>
											<?php
												// // $serverNamex = "192.168.10.4";
												// // $connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
												// $connx = sqlsrv_connect( $serverName, $connectionInfo);
												// $table = '';
												// $dimension = " and [Dimension Code] = 'DEPARTMENT' ";
												// $name = "";//" and Name <> 'OUTSOURCE' ";
												// // $fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
                                                // $fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value]';
												// $result_skill = sqlsrv_query($connx, $fQuery);
												// while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
												<option value="<?php //echo $row['Code'];?>"><?php //echo $row['Code'];?></option>	              
											<?php //} ?>
										</select>
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>Cost center</span><span style="color:red"> *</span>
										<select id="cargo_cost_center" name="cargo_cost_center" class="form-control" readonly>
											<option value=""></option>
											<?php
												// $serverNamex = "192.168.10.4";
												// $connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
												// $connx = sqlsrv_connect( $serverName, $connectionInfo);
												// $table = '';
												// $dimension = " and [Dimension Code] = 'COST CENTER' ";
												// $name = "";//" and Name <> 'OUTSOURCE' ";
												// $fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
												// $result_skill = sqlsrv_query($connx, $fQuery);
												// while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
												<option value="<?php //echo $row['Code'];?>"><?php //echo $row['Code'];?></option>	              
											<?php //} ?>
										</select>
									</div>
								</div>
                            </div>

							<div class="row"> 
								<div class="col-4">   
                                       <div class="form-group">
                                            <span>Name</span>
											<select name="cargo_group_name" id="cargo_group_name" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM group_name where cargo_handling = 1";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['code'].'-'.$row['description'];?></option>         
											<?php } ?>
											</select>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
                                            <span>Sub type 1</span>
											<select name="cargo_type1" id="cargo_type1" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_1 where cargo_handling = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
                                            <span>Sub type 2</span>
											<select name="cargo_type2" id="cargo_type2" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_2 where cargo_handling = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
                                            <span>Sub type 3</span>
											<select name="cargo_type3" id="cargo_type3" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_3 where cargo_handling = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
                                            <span>Sub type 4</span>
											<select name="cargo_type4" id="cargo_type4" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_4 where cargo_handling = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                    </div>
                                </div>
							</div>

							<div class="row">                                     
									<div class="col-2 ">
										<div class="form-group">
											<span>Status</span>
											<select name="cargo_line_status" id="cargo_line_status" class="form-control" aria-describedby="inputGroupPrepend2" required>
												<option value="Open">Open</option>
												<option value="Cancelled">Cancelled</option>
											</select>
										</div>
									</div>
									<div class="col-4 cancel1">
										<div class="form-group">
											<span>Cancel Reason</span>
											<select name="cancel_reason3" id="cargo_cancel_reason" class="form-control" aria-describedby="inputGroupPrepend2">
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM cancellation_reason";
													$result = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-4 cancel1">
										<div class="form-group">
											<span>Reason for outsource</span>
											<select name="cargo_outsource_reason" id="cargo_outsource_reason" class="form-control" aria-describedby="inputGroupPrepend2" >
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM outsource_reason";
													$result = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>
									
								<div class="col-2">   
										<div class="form-group">
											<span>Contract Number</span><span style="color:red"> *</span>
											<select name="cargo_contract_no" id="cargo_contract_no" class="form-control" required> 
											</select>
										</div>
									</div>
								<div class="col-2">   
									<div class="form-group">
										<span>Show hidden contract</span>										
										<input type="text" name="cargo_contract_no_1" id="cargo_contract_no_1" class="form-control" readonly>
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>Confirm Contract</span>
										<input type="checkbox"  value="1" id="cargo_confirm_contract" name="cargo_confirm_contract" class="form-check">
									</div>
								</div>

									<div class="col-2">   
										<div class="form-group">
											<span>Contract line number</span>
											<input type="text" name="cargo_contract_line" id="cargo_contract_line" class="form-control" readonly>
										</div>
									</div>
								<div class="col-2">   
										<div class="form-group">
											<span>Diesel Rate</span><span style="color:red"> *</span>
											<input type="text" name="cargo_diesel_rate" id="cargo_diesel_rate" class="form-control" >
										</div>
									</div>
								<div class="col-4">   
                                    <div class="form-group">
                                        <span>Promotion</span>
                                        <select name="cargo_promotion_code" id="cargo_promotion_code" class="form-control" aria-describedby="inputGroupPrepend2">      
                                        </select>
                                    </div>
                                </div>
                            </div>
							<div class="row"> 
								<div class="col-6">   
										<div class="form-group">
											<span>Reference 1</span>
											<input type="text" name="cargo_ref1" id="cargo_ref1" class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 2</span>
											<input type="text" name="cargo_ref2" id="cargo_ref2" class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 3</span>
											<input type="text" name="cargo_ref3" id="cargo_ref3"	class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 4</span>
											<input type="text" name="cargo_ref4" id="cargo_ref4"	class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 5</span>
											<input type="text" name="cargo_ref5" id="cargo_ref5"	class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 6</span>
											<input type="text" name="cargo_ref6" id="cargo_ref6"	class="form-control" >
										</div>
									</div>
							</div>

						</div>

                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="cargo_add" data-bs-target="#" >
                                    <i class="fas fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="cargo_submit" data-bs-target="#" >
                                    <i class="fas fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="cargo_cancel" data-bs-target="#" >
                                    <i class="fas fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="cargo_types" id="cargo_types">
                                <input type="hidden" name="cargo_reccode" id="cargo_reccode">

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
                <div class="tab-pane fade" id="service-tab">
				<br>
                    <form id="service_data">
                        <div id="service_edit_area">                        
                            <div class="row"> 
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>Service ID</span>
                                        <input type="text" name="cargo_service_id" id="service_cargo_service_id" class="form-control" required readonly>
                                    </div>
                                </div>
								<div class="col-4">   
									<div class="form-group">
											<span>Description</span><span style="color:red"> *</span>
											<input type="text" name="service_description" id="service_description" class="form-control" required>
									</div>
								</div>
								<div class="col-3">   
									<div class="form-group">
										<span>Description 2</span>
										<input type="text" name="service_description2" id="service_description2" class="form-control" >
									</div>
								</div> 
								<div class="col-3">   
									<div class="form-group">
										<span>Contact person</span>
										<input type="text" name="service_contact" id="service_contact" class="form-control" >
									</div>
								</div>
							
							<div class="col-3">   
                                    <div class="form-group">
                                        <span>Vehicle</span>
                                        <select name="vehicle" id="transport_vehicle" class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT vehicle_id, vehicle_type, b.description as vehicle_owner, registration_no, branch FROM vehicle left join vehicle_owner b on b.code = vehicle_owner where category = 'Vehicles' order by registration_no ";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['vehicle_id'];?>"><?php echo $row['registration_no'].' | '.$row['vehicle_type'].' | '.$row['vehicle_owner'].' | '.$row['branch'];?></option>	              
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>       
								<div class="col-3">   
                                    <div class="form-group">
                                        <span>Operator</span><span style="color:red"> *</span>
                                        <select name="operator" id="transport_operator" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT o.operator_id, o.name, o.lastname, p.description, o.branch FROM operator o left join position p on p.code = o.position where o.operator = 1 order by o.name, o.lastname ";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['operator_id'];?>"><?php echo $row['name']."  ".$row['lastname'].' | '.$row['description'].' | '.$row['branch'];?></option>	              
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
								<div class="col-3">   
									<div class="form-group">
										<span>From</span>
										<input type="text" name="service_transport_from" id="service_transport_from" class="form-control" >
									</div>
								</div>
								<div class="col-3">   
									<div class="form-group">
										<span>To</span>
										<input type="text" name="service_transport_to" id="service_transport_to" class="form-control" >
									</div>
								</div>
							</div>
                            <div class="row"> 
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="start_date" id="service_start_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="start_time" id="service_start_time" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="end_date" id="service_end_date" class="form-control" >
                                    </div>
                                </div> 
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>End Time</span><span style="color:red"> *</span>
                                        <input type="time" name="end_time" id="service_end_time" class="form-control" >
                                    </div>
                                </div> 
								<div class="col-1">   
                                        <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                            <input type="number" name="quantity" id="service_quantity" class="form-control" required>
                                        </div>
                                    </div>   
                                    <div class="col-3">   
                                        <div class="form-group">
                                            <span>UOM</span><span style="color:red"> *</span>
                                            <select name="uom" id="service_uom" class="form-control" aria-describedby="inputGroupPrepend2" required>
											<option value=""></option>
											<?php
											$fQuery = "SELECT * FROM uom";
											$result_uom = sqlsrv_query($conn, $fQuery);
											while($row = sqlsrv_fetch_array( $result_uom, SQLSRV_FETCH_ASSOC)) {?>					  
											<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
								
                            </div>

							<div class="row"> 
								<div class="col-2">   
                                    <div class="form-group">
                                        <span>Amount</span><span style="color:red"> *</span>
                                            <input type="text" name="service_amount" id="service_amount" class="form-control" >
                                    </div>
                                </div>
								<div class="col-4">   
									<div class="form-group">
											<span>Remark</span>
											<input type="text" name="service_remark" id="service_remark"		class="form-control" >
									</div>
								</div>
								<div class="col-2">   
									<div class="form-group">
											<span>Agreement No.</span><span style="color:red"> *</span>
											<input type="text" name="service_agreement_number" id="service_agreement_number" class="form-control" >
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>Department</span><span style="color:red"> *</span>
										<select id="service_department" name="service_department" class="form-control" readonly>
											<option value=""></option>
											<?php
												$serverNamex = "vps261";
												$connectionInfox = array( "Database"=>"FES", "UID"=>"sa", "PWD"=>"Tmigb2wcz4#", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
												$connx = sqlsrv_connect( $serverNamex, $connectionInfox);
												$table = '';
												$dimension = " and [Dimension Code] = 'DEPARTMENT' ";
												$name = "";//" and Name <> 'OUTSOURCE' ";
												//$fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
                                                $fQuery = ' SELECT DISTINCT department FROM worksheet_service';
												$result_skill = sqlsrv_query($connx, $fQuery);
												while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
												<option value="<?php //echo $row['Code'];
                                                echo $row['department'];?>">
                                                <?php //echo $row['Code'];
                                                echo $row['department'];?></option>	              
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>Cost center</span><span style="color:red"> *</span>
										<select id="service_cost_center" name="service_cost_center" class="form-control" readonly>
											<option value=""></option>
											<?php
												//  $serverNamex = "192.168.10.4";
												//  $connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
												//  $connx = sqlsrv_connect( $serverNamex, $connectionInfox);
												//  $table = '';
												// $dimension = " and [Dimension Code] = 'COST CENTER' ";
												// $name = "";//" and Name <> 'OUTSOURCE' ";
												// $fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
												// $result_skill = sqlsrv_query($connx, $fQuery);
												//  while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
												<option value="<?php echo $row['Code'];?>"><?php echo $row['Code'];?></option>	              
											<?php //} ?>
										</select>
									</div>
								</div>
									<div class="col-4">   
                                        <div class="form-group">
                                            <span>Name</span>
											<select name="service_group_name" id="service_group_name" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM group_name where service_other = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['code'].'-'.$row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 1</span>
											<select name="service_type1" id="service_type1" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_1 where service_other = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 2</span>
											<select name="service_type2" id="service_type2" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_2 where service_other = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 3</span>
											<select name="service_type3" id="service_type3" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_3 where service_other = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 4</span>
											<select name="service_type4" id="service_type4" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_4 where service_other = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
								</div>

							<div class="row"> 
								<div class="col-2 ">
										<div class="form-group">
											<span>Status</span>
											<select name="service_line_status" id="service_line_status" class="form-control" aria-describedby="inputGroupPrepend2" required>
												<option value="Open">Open</option>
												<option value="Cancelled">Cancelled</option>
											</select>
										</div>
									</div>
									<div class="col-4 cancel1">
										<div class="form-group">
											<span>Cancel Reason</span>
											<select name="service_cancel_reason" id="service_cancel_reason" class="form-control" aria-describedby="inputGroupPrepend2">
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM cancellation_reason";
													$result = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-2 cancel1">
										<div class="form-group">
											<span>Reason for outsource</span>
											<select name="service_outsource_reason" id="service_outsource_reason" class="form-control" aria-describedby="inputGroupPrepend2" >
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM outsource_reason";
													$result = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-2">
										<div class="form-group">
											<span>No charge</span>
											<input type="checkbox"  value="1" id="service_no_charge" name="service_no_charge" class="form-check">
										</div>
									</div>
									<div class="col-2">   
										<div class="form-group">
											<span>Reimbursment</span>
											<input type="checkbox"  value="1" id="reimbursment" name="reimbursment" class="form-check">
										</div>
									</div>
								</div>
							<div class="row"> 
								<div class="col-6">   
										<div class="form-group">
											<span>Reference 1</span>
											<input type="text" name="service_ref1" id="service_ref1" class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 2</span>
											<input type="text" name="service_ref2" id="service_ref2" class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 3</span>
											<input type="text" name="service_ref3" id="service_ref3"	class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 4</span>
											<input type="text" name="service_ref4" id="service_ref4"	class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 5</span>
											<input type="text" name="service_ref5" id="service_ref5"	class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 6</span>
											<input type="text" name="service_ref6" id="service_ref6"	class="form-control" >
										</div>
									</div>
									

							</div>

						</div>

                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="service_add" data-bs-target="#" >
                                    <i class="fas fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="service_submit" data-bs-target="#" >
                                    <i class="fas fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="service_cancel" data-bs-target="#" >
                                    <i class="fas fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="service_type" id="service_type">
                                <input type="hidden" name="service_reccode" id="service_reccode">

                            </div>
                        </div>

                    </form>
                    <table id="service_table" class="table table-striped display nowrap" style="width: 100%;">
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

				<div class="tab-pane fade" id="taxi-tab">
				<br>
                    <form id="taxi_data">
                        <div id="taxi_edit_area">                        
                            <div class="row"> 
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>Service ID</span>
                                        <input type="text" name="taxi_service_id" id="taxi_service_id" class="form-control" required readonly>
                                    </div>
                                </div>
							
							<div class="col-3">   
                                    <div class="form-group">
                                        <span>Vehicle</span><span style="color:red"> *</span>
                                        <select name="taxi_vehicle" id="taxi_vehicle" class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT vehicle_id, vehicle_type, b.description as vehicle_owner, registration_no, branch FROM vehicle left join vehicle_owner b on b.code = vehicle_owner where category = 'Vehicles' order by registration_no ";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['vehicle_id'];?>"><?php echo $row['registration_no'].' | '.$row['vehicle_type'].' | '.$row['vehicle_owner'].' | '.$row['branch'];?></option>	              
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>       
								<div class="col-3">   
                                    <div class="form-group">
                                        <span>Operator</span><span style="color:red"> *</span>
                                        <select name="taxi_operator" id="taxi_operator" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT o.operator_id, o.name, o.lastname, p.description, o.branch FROM operator o left join position p on p.code = o.position where o.operator = 1 order by o.name, o.lastname ";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['operator_id'];?>"><?php echo $row['name']."  ".$row['lastname'].' | '.$row['description'].' | '.$row['branch'];?></option>	              
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
								<div class="col-1">   
                                        <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                            <input type="number" name="taxi_quantity" id="taxi_quantity" class="form-control" required >
                                        </div>
                                    </div>   
                                    <div class="col-3">   
                                        <div class="form-group">
                                            <span>UOM</span><span style="color:red"> *</span>
                                            <select name="taxi_uom" id="taxi_uom" class="form-control" aria-describedby="inputGroupPrepend2" required>
											<option value=""></option>
											<?php
											$fQuery = "SELECT * FROM uom";
											$result_uom = sqlsrv_query($conn, $fQuery);
											while($row = sqlsrv_fetch_array( $result_uom, SQLSRV_FETCH_ASSOC)) {?>					  
											<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-12">   
									<div class="form-group">
										<span>Contact person</span><span style="color:red"> *</span>
											<input type="text" name="taxi_contact" id="taxi_contact" class="form-control" required>
									</div>
								</div>
								<div class="col-4">   
                                    <div class="form-group">
                                        <span>From</span><span style="color:red"> *</span>
                                        <select name="taxi_from" id="taxi_from" class="form-control" aria-describedby="inputGroupPrepend2" required>      
                                        </select>
                                    </div>
                                </div>
								<div class="col-6">   
									<div class="form-group">
										<span>Specific location (from)</span><span style="color:red"> *</span>
											<input type="text" name="taxi_specific_location_from" id="taxi_specific_location_from" class="form-control"  required>
									</div>
								</div>
								<div class="col-2">   
										<div class="form-group">
											<span>Contract Number</span><span style="color:red"> *</span>
											<input type="text" name="taxi_contract" id="taxi_contract" class="form-control" readonly >
										</div>
									</div>
								<div class="col-4">   
                                    <div class="form-group">
                                        <span>To</span><span style="color:red"> *</span>
                                        <select name="taxi_to" id="taxi_to" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        </select>
                                    </div>
                                </div>
								<div class="col-6">   
									<div class="form-group">
										<span>Specific location (to)</span><span style="color:red"> *</span>
											<input type="text" name="taxi_specific_location_to" id="taxi_specific_location_to" class="form-control" required>
									</div>
								</div>
								
									<div class="col-2">   
										<div class="form-group">
											<span>Contract line number</span>
											<input type="text" name="taxi_contract_line" id="taxi_contract_line" class="form-control" readonly>
										</div>
									</div>

							</div>
                            <div class="row"> 
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="taxi_start_date" id="taxi_start_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="taxi_start_time" id="taxi_start_time" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="taxi_end_date" id="taxi_end_date" class="form-control" >
                                    </div>
                                </div> 
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>End Time</span><span style="color:red"> *</span>
                                        <input type="time" name="taxi_end_time" id="taxi_end_time" class="form-control" >
                                    </div>
                                </div> 
								<div class="col-2">
									<div class="form-group">
										<span>Department</span><span style="color:red"> *</span>
										<select id="taxi_department" name="taxi_department" class="form-control" readonly>
											<option value=""></option>
											<?php
												// $serverNamex = "192.168.10.4";
												// $connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
												// $connx = sqlsrv_connect( $serverName, $connectionInfo);
												// $table = '';
												// $dimension = " and [Dimension Code] = 'DEPARTMENT' ";
												// $name = "";//" and Name <> 'OUTSOURCE' ";
												// $fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
												// $result_skill = sqlsrv_query($connx, $fQuery);
												// while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
												 <option value="<?php //echo $row['Code'];?>"><?php //echo $row['Code'];?></option>	              
											<?php //} ?>
										</select>
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>Cost center</span><span style="color:red"> *</span>
										<select id="taxi_cost_center" name="taxi_cost_center" class="form-control" readonly>
											<option value=""></option>
											<?php
												// $serverNamex = "192.168.10.4";
												// $connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
												// $connx = sqlsrv_connect( $serverName, $connectionInfo);
												// $table = '';
												// $dimension = " and [Dimension Code] = 'COST CENTER' ";
												// $name = "";//" and Name <> 'OUTSOURCE' ";
												// $fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
												// $result_skill = sqlsrv_query($connx, $fQuery);
												// while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
												<option value="<?php //echo $row['Code'];?>"><?php //echo $row['Code'];?></option>	              
											<?php //} ?>
										</select>
									</div>
								</div>
								
                            </div>

							<div class="row"> 
								<div class="col-3">
										<div class="form-group">
											<span>Charge as</span><span style="color:red"> *</span>
											<select id="taxi_charge_as" name="taxi_charge_as" class="form-control" required>
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM vehicle_type order by code";
													$result_skill = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-3">
										<div class="form-group">
											<span>Outsource charge as</span><span style="color:red"> *</span>
											<select id="taxi_outsource_charge_as" name="taxi_outsource_charge_as" class="form-control" required>
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM vehicle_type order by code";
													$result_skill = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>
								<div class="col-4">   
									<div class="form-group">
											<span>Remark</span>
											<input type="text" name="taxi_remark" id="taxi_remark" class="form-control" >
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>No charge</span>
										<input type="checkbox"  value="1" id="taxi_no_charge" name="taxi_no_charge" class="form-check">
									</div>
								</div>
								
									<div class="col-4">   
                                        <div class="form-group">
                                            <span>Name</span>
											<select name="taxi_group_name" id="taxi_group_name" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM group_name where taxi_service = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['code'].'-'.$row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 1</span>
											<select name="taxi_type1" id="taxi_type1" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_1 where taxi_service = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 2</span>
											<select name="taxi_type2" id="taxi_type2" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_2 where taxi_service = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 3</span>
											<select name="taxi_type3" id="taxi_type3" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_3 where taxi_service = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 4</span>
											<select name="taxi_type4" id="taxi_type4" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_4 where taxi_service = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
								</div>

							<div class="row"> 
								<div class="col-2 ">
										<div class="form-group">
											<span>Status</span>
											<select name="taxi_line_status" id="taxi_line_status" class="form-control" aria-describedby="inputGroupPrepend2" required>
												<option value="Open">Open</option>
												<option value="Cancelled">Cancelled</option>
											</select>
										</div>
									</div>
									<div class="col-4 cancel1">
										<div class="form-group">
											<span>Cancel Reason</span>
											<select name="taxi_cancel_reason" id="taxi_cancel_reason" class="form-control" aria-describedby="inputGroupPrepend2">
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM cancellation_reason";
													$result = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-4 cancel1">
										<div class="form-group">
											<span>Reason for outsource</span>
											<select name="taxi_outsource_reason" id="taxi_outsource_reason" class="form-control" aria-describedby="inputGroupPrepend2" >
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM outsource_reason";
													$result = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-2">   
										<div class="form-group">
											<span>Diesel Rate</span><span style="color:red"> *</span>
											<input type="text" name="taxi_diesel_rate" id="taxi_diesel_rate" class="form-control" >
										</div>
									</div>
								</div>								

								<div class="row">
									<div class="col-2">   
										<div class="form-group">
										<span>Actual start date</span><span style="color:red"> *</span>
											<input type="date" name="taxi_actual_start_date" id="taxi_actual_start_date" class="form-control" >
										</div>
									</div> 
									<div class="col-2">   
										<div class="form-group">
										<span>Actual start time</span><span style="color:red"> *</span>
											<input type="time" name="taxi_actual_start_time" id="taxi_actual_start_time" class="form-control" >
										</div>
									</div>
									
										<div class="col-2">   
										<div class="form-group">
										<span>Actual finished date</span><span style="color:red"> *</span>
											<input type="date" name="taxi_actual_finish_date" id="taxi_actual_finish_date" class="form-control" >
										</div>
									</div> 
									<div class="col-2">   
										<div class="form-group">
										<span>Actual finished time</span><span style="color:red"> *</span>
											<input type="time" name="taxi_actual_finish_time" id="taxi_actual_finish_time" class="form-control" >
										</div>
									</div>
									<div class="col-2">   
										<div class="form-group">
										<span>Started mileage</span>
											<input type="number" name="taxi_mileage_start" id="taxi_mileage_start" class="form-control" >
										</div>
									</div>  
									<div class="col-2">   
										<div class="form-group">
										<span>Finished mileage</span>
											<input type="number" name="taxi_mileage_end" id="taxi_mileage_end" class="form-control" >
										</div>
									</div>
								</div>
								<div class="row"> 
								<div class="col-6">   
										<div class="form-group">
											<span>Reference 1</span>
											<input type="text" name="taxi_ref1" id="taxi_ref1" class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 2</span>
											<input type="text" name="taxi_ref2" id="taxi_ref2" class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 3</span>
											<input type="text" name="taxi_ref3" id="taxi_ref3"	class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 4</span>
											<input type="text" name="taxi_ref4" id="taxi_ref4"	class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 5</span>
											<input type="text" name="taxi_ref5" id="taxi_ref5"	class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 6</span>
											<input type="text" name="taxi_ref6" id="taxi_ref6"	class="form-control" >
										</div>
									</div>
								</div>
							</div>

						

                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="taxi_add" data-bs-target="#" >
                                    <i class="fas fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="taxi_submit" data-bs-target="#" >
                                    <i class="fas fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="taxi_cancel" data-bs-target="#" >
                                    <i class="fas fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="taxi_type" id="taxi_type">
                                <input type="hidden" name="taxi_reccode" id="taxi_reccode">

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

				<div class="tab-pane fade" id="immigration-tab">
				<br>
					<form id="immigration_data">
						<div id="immigration_edit_area">                        
                            <div class="row"> 
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>Immigration ID</span>
                                        <input type="text" name="immigration_id" id="immigration_id" class="form-control" required readonly>
                                    </div>
                                </div>
								<div class="col-3">   
									<div class="form-group">
											<span>Expat name</span><span style="color:red"> *</span>
											<input type="text" name="immigration_expat_name" id="immigration_expat_name" class="form-control" required>
									</div>
								</div>
								<div class="col-4">   
									<div class="form-group">
										<span>Description</span><span style="color:red"> *</span>
										<input type="text" name="immigration_description" id="immigration_description" class="form-control" required>
									</div>
								</div>
								<div class="col-3">   
                                    <div class="form-group">
                                    <span>Service</span><span style="color:red"> *</span>
                                        <select name="immigration_service" id="immigration_service" class="form-control" aria-describedby="inputGroupPrepend2" >
                                        </select>
                                    </div>
                                </div>
							</div>

                            <div class="row"> 
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>Start Date</span><span style="color:red"> *</span>
                                        <input type="date" name="immigration_start_date" id="immigration_start_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>Start Time</span><span style="color:red"> *</span>
                                        <input type="time" name="immigration_start_time" id="immigration_start_time" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>End Date</span><span style="color:red"> *</span>
                                        <input type="date" name="immigration_end_date" id="immigration_end_date" class="form-control">
                                    </div>
                                </div> 
                                <div class="col-2">   
                                    <div class="form-group">
                                    <span>End Time</span><span style="color:red"> *</span>
                                        <input type="time" name="immigration_end_time" id="immigration_end_time" class="form-control" >
                                    </div>
                                </div> 
								<div class="col-1">   
                                        <div class="form-group">
                                        <span>Qty</span><span style="color:red"> *</span>
                                            <input type="number" name="immigration_quantity" id="immigration_quantity" class="form-control" required>
                                        </div>
                                    </div>   
                                    <div class="col-3">   
                                        <div class="form-group">
                                            <span>UOM</span><span style="color:red"> *</span>
                                            <select name="immigration_uom" id="immigration_uom" class="form-control" aria-describedby="inputGroupPrepend2" required>
											<option value=""></option>
											<?php
											$fQuery = "SELECT * FROM uom";
											$result_uom = sqlsrv_query($conn, $fQuery);
											while($row = sqlsrv_fetch_array( $result_uom, SQLSRV_FETCH_ASSOC)) {?>					  
											<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
								
                            </div>

							<div class="row"> 
								<!--<div class="col-2">   
                                    <div class="form-group">
                                        <label>Amount</label>
                                            <input type="number" name="immigration_amount" id="immigration_amount" class="form-control" >
                                    </div>
                                </div> -->
								<div class="col-4">   
									<div class="form-group">
											<span>Remark</span>
											<input type="text" name="immigration_remark" id="immigration_remark"		class="form-control" >
									</div>
								</div>
								<div class="col-2">   
									<div class="form-group">
											<span>Agreement No.</span><span style="color:red"> *</span>
											<input type="text" name="immigration_agreement_number" id="immigration_agreement_number" class="form-control" readonly>
									</div>
								</div>
								<div class="col-2">   
									<div class="form-group">
											<span>Contract line</span>
											<input type="text" name="immigration_contract_line" id="immigration_contract_line" class="form-control" readonly>
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>Department</span><span style="color:red"> *</span>
										<select id="immigration_department" name="immigration_department" class="form-control" readonly>
											<option value=""></option>
											<?php
												// $serverNamex = "192.168.10.4";
												// $connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
												// $connx = sqlsrv_connect( $serverName, $connectionInfo);
												// $table = '';
												// $dimension = " and [Dimension Code] = 'DEPARTMENT' ";
												// $name = "";//" and Name <> 'OUTSOURCE' ";
												// $fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
												// $result_skill = sqlsrv_query($connx, $fQuery);
												// while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
												<option value="<?php //echo $row['Code'];?>"><?php //echo $row['Code'];?></option>	              
											<?php //} ?>
										</select>
									</div>
								</div>
								<div class="col-2">
									<div class="form-group">
										<span>Cost center</span><span style="color:red"> *</span>
										<select id="immigration_cost_center" name="immigration_cost_center" class="form-control" readonly>
											<option value=""></option>
											<?php
												// $serverNamex = "192.168.10.4";
												// $connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
												// $connx = sqlsrv_connect( $serverName, $connectionInfo);
												// $table = '';
												// $dimension = " and [Dimension Code] = 'COST CENTER' ";
												// $name = "";//" and Name <> 'OUTSOURCE' ";
												// $fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value] where blocked = 0 '.$dimension.$name;
												// $result_skill = sqlsrv_query($connx, $fQuery);
												// while($row = sqlsrv_fetch_array( $result_skill, SQLSRV_FETCH_ASSOC)) {?>					  
												<option value="<?php //echo $row['Code'];?>"><?php //echo $row['Code'];?></option>	              
											<?php //} ?>
										</select>
									</div>
								</div>
									<div class="col-4">   
                                        <div class="form-group">
                                            <span>Name</span>
											<select name="immigration_group_name" id="immigration_group_name" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM group_name where immigration = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['code'].'-'.$row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 1</span>
											<select name="immigration_type1" id="immigration_type1" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_1 where immigration = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 2</span>
											<select name="immigration_type2" id="immigration_type2" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_2 where immigration = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 3</span>
											<select name="immigration_type3" id="immigration_type3" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_3 where immigration = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>
									<div class="col-2">   
                                        <div class="form-group">
                                            <span>Sub type 4</span>
											<select name="immigration_type4" id="immigration_type4" class="form-control" aria-describedby="inputGroupPrepend2" >
											<option value=""></option>
											<?php
                                            $fQuery = "SELECT * FROM type_4 where immigration = 1 order by code";
                                            $result_trip_type1 = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_trip_type1, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
											<?php } ?>
											</select>
                                        </div>
                                    </div>

								<div class="col-2 ">
									<div class="form-group">
											<span>Status</span>
											<select name="immigration_line_status" id="immigration_line_status" class="form-control" aria-describedby="inputGroupPrepend2" required>
												<option value="Open">Open</option>
												<option value="Cancelled">Cancelled</option>
											</select>
										</div>
									</div>
									<div class="col-4 cancel1">
										<div class="form-group">
											<span>Cancel Reason</span>
											<select name="immigration_cancel_reason" id="immigration_cancel_reason" class="form-control" aria-describedby="inputGroupPrepend2">
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM cancellation_reason";
													$result = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-2 cancel1">
										<div class="form-group">
											<span>Reason for outsource</span>
											<select name="immigration_outsource_reason" id="immigration_outsource_reason" class="form-control" aria-describedby="inputGroupPrepend2" >
												<option value=""></option>
												<?php
													$fQuery = "SELECT * FROM outsource_reason";
													$result = sqlsrv_query($conn, $fQuery);
													while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
													<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-2">
										<div class="form-group">
											<span>No charge</span>
											<input type="checkbox"  value="1" id="immigration_no_charge" name="immigration_no_charge" class="form-check">
										</div>
									</div>
									<div class="col-2">   
										<div class="form-group">
											<span>Reimbursment</span>
											<input type="checkbox"  value="1" id="immigration_reimbursment" name="immigration_reimbursment" class="form-check">
										</div>
									</div>
								</div>
							<div class="row"> 
								<div class="col-6">   
										<div class="form-group">
											<span>Reference 1</span>
											<input type="text" name="immigration_ref1" id="immigration_ref1" class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 2</span>
											<input type="text" name="immigration_ref2" id="immigration_ref2" class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 3</span>
											<input type="text" name="immigration_ref3" id="immigration_ref3"	class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 4</span>
											<input type="text" name="immigration_ref4" id="immigration_ref4"	class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 5</span>
											<input type="text" name="immigration_ref5" id="immigration_ref5"	class="form-control" >
										</div>
									</div>
									<div class="col-6">   
										<div class="form-group">
											<span>Reference 6</span>
											<input type="text" name="immigration_ref6" id="immigration_ref6"	class="form-control" >
										</div>
									</div>
									
							</div>

						</div>

                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="immigration_add" data-bs-target="#" >
                                    <i class="fas fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="immigration_submit" data-bs-target="#" >
                                    <i class="fas fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="immigration_cancel" data-bs-target="#" >
                                    <i class="fas fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="immigration_type" id="immigration_type">
                                <input type="hidden" name="immigration_reccode" id="immigration_reccode">

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
				
            </div>           
        </div>
    </div>
</div>

<input required type="hidden" name="form_type" id="form_type">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
	$(document).ready(function(){
		$("#copy_submit").on('click',function(){
			copy_submit();
		});
// fix




	});

	function copy_submit(){
		if($('#copy_id').val() != '' && $('#copy_num').val() != ''){
			$.ajax({
				type: 'POST',
                dataType: "json",
                url: 'api/copy_service.php?copy_id='+$('#copy_id').val()+'&copy_num='+$('#copy_num').val()+'&copy_date='+$('#worksheet_date').val(),
                success: function(data) {
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
		}else{
            swal("Please fill in data");
        }
	}

    var worksheet_status = "";
    var re_open = <?php echo $_SESSION["reopen"]; ?>;
    function get_number(){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_number.php?date='+$("#worksheet_date").val(),
            success: function(data) {
                $('#worksheet_id').val(data.num);
				$('#worksheet_id').attr('readonly', true);
				var now = new Date();
				var day = ("0" + now.getDate()).slice(-2);
				var month = ("0" + (now.getMonth() + 1)).slice(-2);
				var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
				$('#worksheet_date').val(today);
				$('#worksheet_date').attr('readonly', true);
				$('#worksheet_status').val("Open");
				$('#worksheet_status').attr('readonly', true);
            }
        });
    }
    
    $("#worksheet_date").on('change',function(){
        if($("#form_type").val() == 'insert'){
			$('#worksheet_id').attr('readonly', true);
			var now = new Date();
			var day = ("0" + now.getDate()).slice(-2);
			var month = ("0" + (now.getMonth() + 1)).slice(-2);
			var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
			$('#worksheet_date').val(today);
			$('#worksheet_date').attr('readonly', true);
			$('#worksheet_status').val("Open");
			$('#worksheet_status').attr('readonly', true);
		}
            //get_number();
    });

    function load_worksheet(worksheet_id){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet.php?worksheet_id='+worksheet_id,
            success: function(data) {
                $('#worksheet_id').val(data.worksheet_id);
				$('#branch').val(data.branch);
                $('#worksheet_date').val(data.worksheet_date);
				$('#customer').val(data.customer);
				$('#customer_ref').val(data.customer_ref);
                // $('#contact').val(data.contact);
                
				$('#subject').val(data.subject);
                get_contact(data.customer,data.contact);
                get_location(data.customer);
				get_location_taxi(data.customer);
				get_promotion(data.customer,'');
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

                var el_status = [];
                if(data.worksheet_status == 'Closed'){
                    var el_status = ["Open","Closed","Send to A/R","RCVD by A/R","Reject by A/R","Cancelled","Send to NAV"];
                }else{
                    var el_status = ["Open","Closed","Send to A/R","RCVD by A/R","Reject by A/R","Cancelled","Send to NAV"];
                }
                var $el = $("#worksheet_status");
                $el.empty(); // remove old options
                $.each(el_status, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", value).text(value));
                });
                $('#worksheet_status').val(data.worksheet_status);

				if(data.worksheet_status == 'Send to NAV'){
					$('#worksheet_status').attr('readonly', true);
                } else {
					$('#worksheet_status').attr('readonly', false);
				}

                if(data.worksheet_status == 'Closed' && re_open != 1){
                    $("#worksheet_status").prop("disabled",true);
                }

                if(data.worksheet_status != 'Send to A/R')
                    $(".send").hide();
                else
                    $(".send").show();

                if(data.worksheet_status != 'RCVD by A/R')
                    $(".rcvd").hide();
                else
                    $(".rcvd").show();

				if(data.worksheet_status != 'Closed')
                    $(".close_st").hide();
                else {
                    $(".close_st").show();
					//$('#cs_inform_client_date').attr('required', '');
					//$('#cs_inform_client_time').attr('required', '');
				}

				if(data.worksheet_status != 'Cancelled')
                    $(".cancel").hide();
                else {
                    $(".cancel").show();
					$('#cancel_reason').attr('required', '');
				}

				if(data.worksheet_status != 'Reject by A/R')
                    $(".reject").hide();
                else
                    $(".reject").show();

                worksheet_status = data.worksheet_status;
                if(worksheet_status != 'Open' && re_open != 1)
                    $('form#worksheet_data button').hide();
                else
                    $('form#worksheet_data button').show();
                
                if(worksheet_status != 'Open'){
					$("#branch").prop("disabled",true);
                    $("#worksheet_date").prop("disabled",true);
                    $("#subject").prop("disabled",true);
                    $("#customer").prop("disabled",true);
                    $("#contact").prop("disabled",true);
                    $("#customer_ref").prop("disabled",true);
					$('#close_date').prop("disabled",true);
					$('#close_time').prop("disabled",true);
					//$('#send_date').prop("disabled",true);
					//$('#send_time').prop("disabled",true);
					//$('#rcvd_date').prop("disabled",true);
					//$('#rcvd_time').prop("disabled",true);
					//$('#cancel_reason').prop("disabled",true);
					$("#request_method").prop("disabled",true);
					$("#request_to").prop("disabled",true);
					$("#client_inform_amarit_date").prop("disabled",true);
					$("#client_inform_amarit_time").prop("disabled",true);
					$("#cs_inform_opr_date").prop("disabled",true);
					$("#cs_inform_opr_time").prop("disabled",true);
					$("#opr_inform_cs_date").prop("disabled",true);
					$("#opr_inform_cs_time").prop("disabled",true);
					$("#cs_inform_client_date").prop("disabled",true);
					$("#cs_inform_client_time").prop("disabled",true);
					$("#worksheet_ref1").prop("disabled",true);
					$("#worksheet_ref2").prop("disabled",true);
					$("#worksheet_ref3").prop("disabled",true);
					$("#worksheet_ref4").prop("disabled",true);
					$("#worksheet_ref5").prop("disabled",true);
					$("#worksheet_ref6").prop("disabled",true);
					$("#worksheet_remark").prop("disabled",true);
                }else{
					$("#branch").prop("disabled",false);
                    $("#worksheet_date").prop("disabled",false);
                    $("#subject").prop("disabled",false);
                    $("#customer").prop("disabled",false);
                    $("#contact").prop("disabled",false);
                    $("#customer_ref").prop("disabled",false);
					$('#close_date').prop("disabled",false);
					$('#close_time').prop("disabled",false);
					//$('#send_date').prop("disabled",false);
					//$('#send_time').prop("disabled",false);
					//$('#rcvd_date').prop("disabled",false);
					//$('#rcvd_time').prop("disabled",false);
					//$('#cancel_reason').prop("disabled",false);
					$("#request_method").prop("disabled",false);
					$("#request_to").prop("disabled",false);
					$("#client_inform_amarit_date").prop("disabled",false);
					$("#client_inform_amarit_time").prop("disabled",false);
					$("#cs_inform_opr_date").prop("disabled",false);
					$("#cs_inform_opr_time").prop("disabled",false);
					$("#opr_inform_cs_date").prop("disabled",false);
					$("#opr_inform_cs_time").prop("disabled",false);
					$("#cs_inform_client_date").prop("disabled",false);
					$("#cs_inform_client_time").prop("disabled",false);
					$("#worksheet_ref1").prop("disabled",false);
					$("#worksheet_ref2").prop("disabled",false);
					$("#worksheet_ref3").prop("disabled",false);
					$("#worksheet_ref4").prop("disabled",false);
					$("#worksheet_ref5").prop("disabled",false);
					$("#worksheet_ref6").prop("disabled",false);
					$("#worksheet_remark").prop("disabled",false);
                }
            }
        });
        $('#worksheet_id').attr('readonly', true);
        $("#worksheet_submit").prop("disabled",false);
        $("#sub_data").show();

        $('[href="#transport-tab"]').tab('show');
        setTimeout(load_transport, 1000);
        // load_transport();
    }

    $("#customer").on("change",function(){
        get_contact($("#customer").val(),"");
        get_location($("#customer").val());
		get_location_taxi($("#customer").val());
		get_location_handling($("#customer").val());
		get_vehicle_handling($("#customer").val());
		get_position($("#customer").val());
		get_position_charge_as($("#customer").val());
		get_immigrationservice($("#customer").val());
		get_promotion($("#customer").val(),$("#contract_no1").val());

    });

	$("#contract_no1").on("change",function(){
		get_promotion($("#customer").val(),$("#contract_no1").val());
    });

	
	
    function clear_data(){
        $('form#worksheet_data input:checkbox').prop('checked', false);
        $('form#worksheet_data input:text').val('');
        $('form#worksheet_data input[type="number"]').val('');
        $('form#worksheet_data input[type="date"]').val('');
        $('form#worksheet_data select').val('');
        $("#worksheet_submit").prop("disabled",false);
    }

    async function get_contact(customer_id,contact){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contact_by_customer.php?customer_id='+customer_id,
            success: function(data) {
                var $el = $("#contact");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });
                $('#contact').val(contact);
            }
        });
    }

	async function get_immigrationservice(customer_id){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_immigrationservice.php?customer='+customer_id,
            success: function(data) {
                var $el = $("#immigration_service");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });
            }
        });
    }

	async function get_position(customer_id){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_position.php?customer='+customer_id,
            success: function(data) {
                var $el = $("#manpower_position");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });
            }
        });
    }

	async function get_position_charge_as(customer_id){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_position.php?customer='+customer_id,
            success: function(data) {
                var $el = $("#manpower_charge_as");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });
            }
        });
    }

    async function get_location_taxi(customer_id){        
		$.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_location_worksheet_taxi.php?customer='+customer_id,
            success: function(data) {

				var $el = $("#taxi_from");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });

				var $el = $("#taxi_to");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });
            }
        });
    }

	async function get_location_manpower(customer_id){        
		$.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_location_worksheet_manpower.php?customer='+customer_id,
            success: function(data) {

				var $el = $("#location");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });
            }
        });
    }

	async function get_location(customer_id){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_location_worksheet.php?customer='+customer_id,
            success: function(data) {
                var $el = $("#transport_transport_from");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });

                var $el = $("#transport_transport_to");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
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
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });

				
            }
        });
    }

	async function get_promotion(customer_id,contract){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_promotion_worksheet.php?customer='+customer_id+'&contract='+contract,
            success: function(data) {
                var $el = $("#transport_promotion_code");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });
            }
        });
    }

	async function get_location_handling(customer_id){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_location_handling.php?customer='+customer_id,
            success: function(data) {

				var $el = $("#cargo_transport_from");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });		
            }
        });
    }

	async function get_vehicle_handling(customer_id){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_vehicle_handling.php?customer='+customer_id,
            success: function(data) {
				
				var $el = $("#cargo_charge_as");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });		
            }
        });
    }

    /********* MAIN  ************/
    $("#worksheet_data").submit(function(e) {
        e.preventDefault();
        $("#worksheet_status").prop("disabled",false);
		$("#branch").prop("disabled",false);
        $("#worksheet_date").prop("disabled",false);
        $("#subject").prop("disabled",false);
        $("#customer").prop("disabled",false);
        $("#contact").prop("disabled",false);
        $("#customer_ref").prop("disabled",false);
		$("#request_method").prop("disabled",false);
		$("#request_to").prop("disabled",false);
		$("#client_inform_amarit_date").prop("disabled",false);
		$("#client_inform_amarit_time").prop("disabled",false);
		$("#cs_inform_opr_date").prop("disabled",false);
		$("#cs_inform_opr_time").prop("disabled",false);
		$("#opr_inform_cs_date").prop("disabled",false);
		$("#opr_inform_cs_time").prop("disabled",false);
		$("#cs_inform_client_date").prop("disabled",false);
		$("#cs_inform_client_time").prop("disabled",false);
		$("#worksheet_ref1").prop("disabled",false);
		$("#worksheet_ref2").prop("disabled",false);
		$("#worksheet_ref3").prop("disabled",false);
		$("#worksheet_ref4").prop("disabled",false);
		$("#worksheet_ref5").prop("disabled",false);
		$("#worksheet_ref6").prop("disabled",false);

        var $form = $("#worksheet_data");
        var data = getFormData($form);
        $("#worksheet_submit").prop("disabled",true);
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
            url: 'api/insert_worksheet.php',
            data: data,
            success: function(data) {
                $("#worksheet_submit").prop("disabled",false);
                $('#worksheet_table').DataTable().ajax.reload();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
					$('#worksheet_id').val(Result.worksheet_id);
                    load_worksheet($('#worksheet_id').val());
                    $('#form_type').val('update'); 
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
            url: 'api/update_worksheet.php',
            data: data,
            success: function(data) {
                $("#worksheet_submit").prop("disabled",false);
                $('#worksheet_table').DataTable().ajax.reload();
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

    $("#worksheet_cancel").on('click',function(){
		$('#vieweditmodal').modal('hide');
    })

	$('#worksheet_status').on('focusin', function(){
		console.log("Saving value " + $(this).val());
		$(this).data('val', $(this).val());
	});

	 $("#send_date").on('change',function(){
		if ($("#send_date").val() < $("#close_date").val())
		{
			swal('Send Date can not be earlier than Close Date');
		}
	 })

	 $("#rcvd_date").on('change',function(){
		if ($("#rcvd_date").val() < $("#send_date").val())
		{
			swal('RCVD Date can not be earlier than Send to AR Date');
		}
	 })



    $("#worksheet_status").on('change',function(){
		var prev = $(this).data('val');
        var worksheet_status = $("#worksheet_status").val();
		//$("#close_date").val($("#close_date").val());
		
        if(worksheet_status != 'Send to A/R')
            $(".send").hide();
        else {
			if (prev != 'Closed')
			{
				$("#worksheet_status").val(prev);
				swal('Worksheet status is not Closed');
			} else {
			const dateObj = new Date();
            const month = String(dateObj.getMonth()+1).padStart(2, '0');
            const day = String(dateObj.getDate()).padStart(2, '0');
            const year = dateObj.getFullYear();
            const output =  year  + '-' + month + '-' + day;
            //if($("#send_date").val() == "")
                $("#send_date").val(output);

            const hour = String(dateObj.getHours()).padStart(2, '0');
            const min = String(dateObj.getMinutes()).padStart(2, '0');
            const output2 =  hour  + ':' + min;
            //if($("#send_time").val() == "")
                $("#send_time").val(output2);
            $(".send").show();
			//$("#close_date").val(output);
		}
		}

        if(worksheet_status != 'RCVD by A/R')
            $(".rcvd").hide();
        else {
			if (prev != 'Send to A/R')
			{
				$("#worksheet_status").val(prev);
				swal('Worksheet status is not Send to A/R');
			} else {
			const dateObj = new Date();
            const month = String(dateObj.getMonth()+1).padStart(2, '0');
            const day = String(dateObj.getDate()).padStart(2, '0');
            const year = dateObj.getFullYear();
            const output =  year  + '-' + month + '-' + day;
            //if($("#rcvd_date").val() == "")
                $("#rcvd_date").val(output);

            const hour = String(dateObj.getHours()).padStart(2, '0');
            const min = String(dateObj.getMinutes()).padStart(2, '0');
            const output2 =  hour  + ':' + min;
            //if($("#rcvd_time").val() == "")
                $("#rcvd_time").val(output2);
            $(".rcvd").show();
		}
		}

		if(worksheet_status != 'Closed')
            $(".close_st").hide();

        else{
			if (prev != 'Open')
			{
				$("#worksheet_status").val(prev);
				swal('Worksheet status is not Open');
			} else {
            const dateObj = new Date();
            const month = String(dateObj.getMonth()+1).padStart(2, '0');
            const day = String(dateObj.getDate()).padStart(2, '0');
            const year = dateObj.getFullYear();
            const output =  year  + '-' + month + '-' + day;
            //if($("#close_date").val() == "")
                $("#close_date").val(output);

            const hour = String(dateObj.getHours()).padStart(2, '0');
            const min = String(dateObj.getMinutes()).padStart(2, '0');
            const output2 =  hour  + ':' + min;
            //if($("#close_time").val() == "")
                $("#close_time").val(output2);

            $(".close_st").show();
			//$('#cs_inform_client_date').attr('required', '');
			//$('#cs_inform_client_time').attr('required', '');
			}
        }

		if(worksheet_status != 'Cancelled') {
            $(".cancel").hide();
			$("#cancel_reason").removeAttr('required');
        } else {
            $(".cancel").show();
			$("#cancel_reason").attr('required', '');
			$("#cancel_reason").validate();
		}

		if(worksheet_status != 'Reject by A/R')
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
    function get_number_transport(){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_transport_number.php?date='+$("#worksheet_date").val(),
			//url: 'api/get_transport_number.php?worksheet_id='+$("#worksheet_id").val(),
            success: function(data) {
                $('#transport_id').val(data.num);
				$('#transport_type1').val(data.t1);
				$('#transport_group_name').val(data.gn);
				$('#transport_line_status').val("Open");
				$('#transport_line_status').attr('readonly', true);
            }
        });
    }
 
    $("#tansport-nav").on('click',function(){
        setTimeout(load_transport, 1000);
    })

    $("#transport_uom").on('change',function(){
        if($("#transport_uom").val() == "TP" || $("#transport_uom").val() == "TP/S")
            $("#transport_type1").val("13");
        else if($("#transport_uom").val() == "R/Tp")
            $("#transport_type1").val("14");
        else if($("#transport_uom").val() == "Days" || $("#transport_uom").val() == "Day")
            $("#transport_type1").val("20");
        else if($("#transport_uom").val() == "Hours" || $("#transport_uom").val() == "Hour")
            $("#transport_type1").val("06");
		else
			$("#transport_type1").val("00");
		$("#transport_type3").val("00");
    })

	$("#transport_transport_from").on("change",function(){
        get_location_to($("#customer").val(),$("#transport_transport_from").val());
    });

	async function get_location_to(customer_id,location_from){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_location_to.php?customer='+customer_id+'&location_from='+location_from,
            success: function(data) {
                var $el = $("#transport_transport_to");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });
				//$("#transport_remark").val("00");
            }
        });
    }

	$("#transport_transport_to").on("change",function(){
        get_contract_line($("#customer").val(),$("#transport_transport_from").val(),$("#transport_transport_to").val(),$("#diesel_rate").val(),$("#charge_as").val());
		
    });

	$("#charge_as").on("change",function(){
        get_contract_line($("#customer").val(),$("#transport_transport_from").val(),$("#transport_transport_to").val(),$("#diesel_rate").val(),$("#charge_as").val());
		
    });

	async function get_contract_line(customer_id,location_from,location_to,diesel_rate,charge_as){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_line.php?customer='+customer_id+'&location_from='+location_from+'&location_to='+location_to+'&diesel_rate='+diesel_rate+'&charge_as='+charge_as,
            success: function(data) {
				//$('#contract_no1').val(data.contract_no);
				//$('#contract_line1').val(data.contract_line);
				var $el = $("#contract_no1");
                $el.empty(); // remove old options
                //$el.append($("<option></option>")
                //    .attr("value", "-").text("-"));
				var $x = 0;
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
					$x = $x+1;
                });
				if ($x>1)
				{
					$el.empty(); // remove old options
					$el.append($("<option></option>")
                    .attr("value", "xxxxx").text("xxxxx"));
					$.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
					});
				} else {
					$el.empty(); // remove old options
					$.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
					});
				}
				$('#contract_no1').val($transport_contract_no);
            }
        });
    }

	$("#transport_vehicle").on("change",function(){
        get_vehicle($("#transport_vehicle").val());
    });

	async function get_vehicle(vehicle){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_vehicle.php?vehicle_id='+vehicle,
            success: function(data) {
				$('#charge_as').val(data.type);
				$('#outsource_charge_as').val(data.type);
				$('#transport_department').val(data.department);
				$('#transport_cost_center').val(data.cost_center);
				$('#transport_outsource').val(data.outsource);
				if(data.outsource) {
                    $('#transport_outsource').prop( "checked", true );

					$('#transport_outsource_reason').prop('required',true);
                }else{
                    $('#transport_outsource').prop( "checked", false );
					$('#transport_outsource_reason').prop('required',false)
				}
				if (data.owner == 'AAL')
				{
					$('#transport_department').attr('readonly', true);
					$('#transport_cost_center').attr('readonly', true);

				} else {
					$('#transport_department').attr('readonly', false);
					$('#transport_cost_center').attr('readonly', false);

				}
            }
        });
    }


    $("#service_vehicle").on("change",function(){
        get_vehicle($("#transport_vehicle").val());
    });
    async function get_Servicevehicle(vehicle){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_vehicle.php?vehicle_id='+vehicle,
            success: function(data) {
				$('#charge_as').val(data.type);
				$('#outsource_charge_as').val(data.type);
				$('#service_department').val(data.department);
				$('#service_cost_center').val(data.cost_center);
				if(data.outsource) {
                    $('#transport_outsource').prop( "checked", true );

					$('#service_outsource_reason').prop('required',true);
					

                }else{
                    $('#transport_outsource').prop( "checked", false );
					$('#service_outsource_reason').prop('required',false);

				}
				if (data.owner == 'AAL')
				{
					$('#service_department').attr('readonly', true);
					$('#service_cost_center').attr('readonly', true);

				} else {
					$('#service_department').attr('readonly', false);
					$('#service_cost_center').attr('readonly', false);

				}
            }
        });
    }



    $('#fademore').on('click',function(){
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
    
    function load_transport(){
        //$("#moreinfo").hide();
        $(".fa-caret-down").hide();

        if($("#form_type").val()!="")
            $("#transport_add").show();
        $("#transport_edit_area").hide();
        $("#transport_submit").hide();
        $("#transport_cancel").hide();

        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        if(worksheet_status != 'Open'){
            btn = "";
            $('#transport-tab button').hide();
        }
        var table = $('#transport_table').DataTable( {
            "ajax": "api/view_worksheet_transport.php?worksheet_id="+$("#worksheet_id").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo" : false,
            "scrollX": true,
            "columnDefs": [ {
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
			}],
            "bDestroy": true
        } );

    }

    $("#transport_add").on('click',function(){
        $('form#transport_data input:text').val('');
        $('form#transport_data select').val('');
        $('form#transport_data input:checkbox').prop( "checked", false );
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
            success: function(data) {
                $('#diesel_rate').val(data.diesel_rate);
            }
        });

        get_number_transport();
    })

    $('#transport_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#transport_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_transport.php?reccode='+data[0],
            success: function(data) {
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
                if(data.backhaul)
                    $('#backhaul').prop( "checked", true );
                else
                    $('#backhaul').prop( "checked", false );

                if(data.no_charge)
                    $('#no_charge').prop( "checked", true );
                else
                    $('#no_charge').prop( "checked", false );
                $('#diesel_rate').val(data.diesel_rate);
                $('#trip_type1').val(data.trip_type1);
                $('#charge_type1').val(data.charge_type1);
                $('#additional_charge1').val(data.additional_charge1);
                $('#quantity1').val(data.quantity1);
                $('#uom1').val(data.uom1);
                if(data.consolidate)
                    $('#consolidate').prop( "checked", true );
                else
                    $('#consolidate').prop( "checked", false );
                if(data.vehicle_switch)
                    $('#vehicle_switch').prop( "checked", true );
                else
                    $('#vehicle_switch').prop( "checked", false );
                if(data.outsource)
                    $('#transport_outsource').prop( "checked", true );
                else
                    $('#transport_outsource').prop( "checked", false );
				if(data.standby_charge)
                    $('#standby_charge').prop( "checked", true );
                else
                    $('#standby_charge').prop( "checked", false );
				if(data.standby_no_charge)
                    $('#standby_no_charge').prop( "checked", true );
                else
                    $('#standby_no_charge').prop( "checked", false );
				if(data.transport_solution)
                    $('#transport_solution').prop( "checked", true );
                else
                    $('#transport_solution').prop( "checked", false );
                $('#vehicle_type').val(data.vehicle_type);
                $('#charge_as').val(data.charge_as);
                $('#vendor').val(data.vendor);
                $('#actual_start_date').val(data.actual_start_date);
                $('#actual_start_time').val(data.actual_start_time);
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
				$('#outsource_charge_as').val(data.outsource_charge_as);
				$('#contract_no1').val(data.contract_no);
				$('#contract_no1_1').val(data.contract_no);
				$transport_contract_no = data.contract_no;
				get_contract_line($("#customer").val(),$("#transport_transport_from").val(),$("#transport_transport_to").val(),$("#diesel_rate").val(),$("#charge_as").val());

				$('#contract_line1').val(data.contract_line);
                $('#contact1').val(data.contact1);
				$('#contact2').val(data.contact2);
				$('#dimension').val(data.dimension);
				$('#transport_department').val(data.department);
				$('#transport_cost_center').val(data.cost_center);
				$('#specific_location_from').val(data.specific_location_from);
				$('#specific_location_to').val(data.specific_location_to);
				$('#transport_promotion_code').val(data.promotion_code);
				if(data.confirm_contract)
                    $('#transport_confirm_contract').prop( "checked", true );
                else
                    $('#transport_confirm_contract').prop( "checked", false );
				if(data.round_trip)
                    $('#round_trip').prop( "checked", true );
                else
                    $('#round_trip').prop( "checked", false );
				if(data.lumsum_charge)
                    $('#lumsum_charge').prop( "checked", true );
                else
                    $('#lumsum_charge').prop( "checked", false );
				if(data.no_allowance)
                    $('no_allowance').prop( "checked", true );
                else
                    $('no_allowance').prop( "checked", false );
				//$('#transport_department').attr('readonly', true);
				//$('#transport_department').attr("disabled", true);
				//$('#transport_cost_center').attr("disabled", true);
				$('#transport_department').attr('readonly', true);
				$('#transport_cost_center').attr('readonly', true);

				if ($("#contract_no1_1").val() == ''){
					$('#contract_no1').prop('required',true);
				}
				else {					
					
					$('#contract_no1').removeAttr('required');
				}

                $('#transport_reccode').val(data.reccode);
            }
        });

        $("#transport_type").val('update');
        $("#transport_add").hide();
        $("#transport_edit_area").fadeIn();
        $("#transport_submit").show();
        $("#transport_cancel").show();
    });
    
    $('#transport_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#transport_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
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
    
    $("#transport_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#transport_data");
        var data = getFormData($form);
        $("#transport_submit").prop("disabled",true);
        if($("#transport_type").val() == 'insert')
			if($("#contract_no1").val() == 'xxxxx')
				swal('Contract number should not be blank!!');
			else
				insert_transport(data);
        if($("#transport_type").val() == 'update')
            update_transport(data);

        return false;
    });

    function insert_transport(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_worksheet_transport.php?worksheet_id='+$("#worksheet_id").val()+"&customer="+$("#customer").val(),
            data: data,
            success: function(data) {
                $("#transport_submit").prop("disabled",false);
                
                Result = data;
                if(Result.Status == "Success") {
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

    function update_transport(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_worksheet_transport.php?reccode='+$("#transport_reccode").val(),
            data: data,
            success: function(data) {
                $("#transport_submit").prop("disabled",false);
                // $('#transport_table').DataTable().ajax.reload();

                // $("#transport_add").show();
                // $("#transport_edit_area").hide();
                // $("#transport_submit").hide();
                // $("#transport_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    setTimeout(load_transport, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#transport_cancel").on('click',function(){
        $("#transport_add").show();
        $("#transport_edit_area").fadeOut();
        $("#transport_submit").hide();
        $("#transport_cancel").hide();
    })

	/********* Manpower ************/
	function get_number_manpower(){
        $.ajax({
            type: 'GET',
            dataType: "json",
            //url: 'api/get_manpower_number.php?worksheet_id='+$("#worksheet_id").val(),
			url: 'api/get_manpower_number.php?date='+$("#worksheet_date").val(),
            success: function(data) {
                $('#labor_service_id').val(data.num);
				$('#manpower_line_status').val("Open");
				$('#manpower_line_status').attr('readonly', true);
            }
        });
    }

    $("#manpower-nav").on('click',function(){
		if($("#form_type").val()!="")
            $("#manpower_add").show();
        $("#manpower_edit_area").fadeOut();
        $("#manpower_submit").hide();
        $("#manpower_cancel").hide();
        setTimeout(load_manpower, 1000);
    })
	
	$("#manpower_position").on("change",function(){
        get_manpower_charge_as($("#manpower_position").val());
		get_contract_manpower($("#customer").val(),$("#manpower_position").val());
		load_operator($("#labor").val());
    });

	$("#labor").on("change",function(){
		load_operator($("#labor").val());
    });

	async function get_manpower_charge_as(position){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_manpower_position.php?position='+position,
            success: function(data) {
				//$('#manpower_charge_as').val(data.universal_position);
				$('#manpower_charge_as').val($("#manpower_position").val());
				$('#manpower_outsource_charge_as').val(data.universal_position);
            }
        });
    }

	async function get_contract_manpower(customer_id,position){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_manpower.php?customer='+customer_id+'&position='+position,
            success: function(data) {
				//$('#manpower_contract_no').val(data.contract_no);
				//$('#manpower_contract_no').val(data.contract_no);
				var $el = $("#manpower_contract_no");
                $el.empty(); // remove old options
                //$el.append($("<option></option>")
                //    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });
				$('#manpower_contract_no').val($manpower_contract);
            }
        });
    }

	async function load_operator(operator_id){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_operator.php?operator_id='+operator_id,
            success: function(data) {
				$('#manpower_department').val(data.department);
				$('#manpower_cost_center').val(data.cost_center);
				if(data.outsource) {
					$('#manpower_outsource_reason').prop('required',true);	
                }else{
					$('#manpower_outsource_reason').prop('required',false);

				}
            }
        });
    }
   
    function load_manpower(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        if(worksheet_status != 'Open'){
            btn = "";
            $('#manpower-tab button').hide();
        }
        var table = $('#manpower_table').DataTable( {
            "ajax": "api/view_worksheet_manpower.php?worksheet_id="+$("#worksheet_id").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo" : false,
            "scrollX": true,
            "columnDefs": [ {
                "targets": 0,
                "data": null,
                "defaultContent": btn
			} ],
            "bDestroy": true
        } );
    }

    $("#manpower_add").on('click',function(){
        $('form#manpower_data input:text').val('');
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

    $('#manpower_line_status').on( 'change',  function () {
        if($('#manpower_line_status').val() == "Cancelled"){
            $('.manpower_cancel_reason').show();
            $('#manpower_cancel_reason').prop('required',true);
        }else{
            $('.manpower_cancel_reason').hide();
            $('#manpower_cancel_reason').removeAttr('required');
        }
    });

    $('#manpower_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#manpower_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_manpower.php?reccode='+data[0],
            success: function(data) {
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

                if(data.line_status == "Cancelled"){
                    $('.manpower_cancel_reason').show();
                    $('#manpower_cancel_reason').prop('required',true);
                }else{
                    $('.manpower_cancel_reason').hide();
                    $('#manpower_cancel_reason').removeAttr('required');
                }

				$('#manpower_group_name').val(data.group_name)
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
				get_contract_manpower($("#customer").val(),$("#manpower_position").val());
				$('#manpower_contract_line').val(data.contract_line);
				$('#manpower_ot').val(data.ot);
				if(data.no_charge)
                    $('#manpower_no_charge').prop( "checked", true );
                else
                    $('#manpower_no_charge').prop( "checked", false );
				if(data.lump_sum)
                    $('#manpower_lumsum_charge').prop( "checked", true );
                else
                    $('#manpower_lumsum_charge').prop( "checked", false );				

                $('#manpower_reccode').val(data.reccode);
            }
        });

        $("#manpower_type").val('update');
        $("#manpower_add").hide();
        $("#manpower_edit_area").fadeIn();
        $("#manpower_submit").show();
        $("#manpower_cancel").show();
    });
    
    $('#manpower_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#manpower_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
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
    
    $("#manpower_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#manpower_data");
        var data = getFormData($form);
        $("#manpower_submit").prop("disabled",true);
        if($("#manpower_type").val() == 'insert')
            insert_manpower(data);
        if($("#manpower_type").val() == 'update')
            update_manpower(data);

        return false;
    });

    function insert_manpower(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_worksheet_manpower.php?worksheet_id='+$("#worksheet_id").val()+"&customer="+$("#customer").val(),
            data: data,
            success: function(data) {
                $("#manpower_submit").prop("disabled",false);
				$('#manpower_table').DataTable().ajax.reload();

                $("#manpower_add").show();
                $("#manpower_edit_area").fadeOut();
                $("#manpower_submit").hide();
                $("#manpower_cancel").hide();
                
                Result = data;
                if(Result.Status == "Success") {
                    setTimeout(load_manpower, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_manpower(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_worksheet_manpower.php?reccode='+$("#manpower_reccode").val(),
            data: data,
            success: function(data) {
                $("#manpower_submit").prop("disabled",false);
				$('#manpower_table').DataTable().ajax.reload();

                $("#manpower_add").show();
                $("#manpower_edit_area").fadeOut();
                $("#manpower_submit").hide();
                $("#manpower_cancel").hide();

                Result = data;
                if(Result.Status == "Success") {
                    setTimeout(load_manpower, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#manpower_cancel").on('click',function(){
        $("#manpower_add").show();
        $("#manpower_edit_area").fadeOut();
        $("#manpower_submit").hide();
        $("#manpower_cancel").hide();
    })

	/********* Cargo handling ************/
	function get_number_cargo(){
        $.ajax({
            type: 'GET',
            dataType: "json",
            //url: 'api/get_cargo_number.php?worksheet_id='+$("#worksheet_id").val(),
			url: 'api/get_cargo_number.php?date='+$("#worksheet_date").val(),
            success: function(data) {
                $('#cargo_service_id').val(data.num);
				$('#cargo_line_status').val("Open");
				$('#cargo_line_status').attr('readonly', true);
            }
        });
    }	

    $("#cargo-nav").on('click',function(){
		if($("#form_type").val()!="")
            $("#cargo_add").show();
        $("#cargo_edit_area").fadeOut();
        $("#cargo_submit").hide();
        $("#cargo_cancel").hide();
        setTimeout(load_cargo, 1000);
    })

	$("#cargo_vehicle").on("change",function(){
		get_vehicle_handling($("#customer").val());
        get_vehicle2($("#cargo_vehicle").val());
		//get_vehicle_handling($("#customer").val());
		//$('#cargo_charge_as').val($("#cargo_outsource_charge_as").val());

		//get_contract_cargo($("#customer").val(),$("#charge_as2").val(),$("#diesel_rate").val(),$("#cargo_transport_from").val());
    })

	async function get_vehicle2(vehicle){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_vehicle.php?vehicle_id='+vehicle,
            success: function(data) {
				$('#cargo_charge_as').val(data.type);
				//$("#cargo_charge_as").val('CRANE 40T');
				$('#cargo_outsource_charge_as').val(data.type);
				get_contract_cargo($("#customer").val(),data.type,$("#cargo_diesel_rate").val(),$("#cargo_transport_from").val());
				$('#cargo_department').val(data.department);
				$('#cargo_cost_center').val(data.cost_center);
				//$('#cargo_charge_as').val(data.type);
            }
        });
    }

	async function get_contract_cargo(customer_id,vehicle,diesel_rate,cargo_location){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_cargo.php?customer='+customer_id+'&vehicle='+vehicle+'&diesel_rate='+diesel_rate+'&cargo_location='+cargo_location,
            success: function(data) {
				//$('#cargo_contract_no').val(data.contract_no);
				//$('#cargo_contract_line').val(data.contract_line);
				var $el = $("#cargo_contract_no");
                $el.empty(); // remove old options
                //$el.append($("<option></option>")
                //    .attr("value", "-").text("-"));
				var $x = 0;
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
					$x = $x+1;
                });
				if ($x>1)
				{
					$el.empty(); // remove old options
					$el.append($("<option></option>")
                    .attr("value", "xxxxx").text("xxxxx"));
					$.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
					});
				} else {
					$el.empty(); // remove old options
					$.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
					});
				}
				$('#cargo_contract_no').val($cargo_contract_no);
            }
        });
    }

	$("#cargo_transport_from").on("change",function(){
        get_contract_cargo($("#customer").val(),$("#cargo_charge_as").val(),$("#cargo_diesel_rate").val(),$("#cargo_transport_from").val());
		
    });
   
    function load_cargo(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        if(worksheet_status != 'Open'){
            btn = "";
            $('#cargo-tab button').hide();
        }

        var table = $('#cargo_table').DataTable( {
            "ajax": "api/view_worksheet_cargo_handling.php?worksheet_id="+$("#worksheet_id").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo" : false,
            "scrollX": true,
            "columnDefs": [ {
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
            } ],
            "bDestroy": true
        } );
    }

    $("#cargo_add").on('click',function(){
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
		get_number_cargo();
		$.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_last_diesel_rate.php?',
            success: function(data) {
                $('#cargo_diesel_rate').val(data.diesel_rate);
            }
        });
    })

    $('#cargo_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#cargo_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_cargo_handling.php?reccode='+data[0],
            success: function(data) {
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
                $('#cargo_type1').val(data.type1);
                $('#cargo_type2').val(data.type2);
				$('#cargo_type3').val(data.type3);
                $('#cargo_type4').val(data.type4);
				$('#cargo_type5').val(data.type5);
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
				get_contract_cargo($("#customer").val(),$("#cargo_charge_as").val(),$("#cargo_diesel_rate").val(),$("#cargo_transport_from").val());
				$('#cargo_contract_line').val(data.contract_line);
				$('#cargo_ot').val(data.ot);
				if(data.no_charge)
                    $('#cargo_no_charge').prop( "checked", true );
                else
                    $('#cargo_no_charge').prop( "checked", false );
				if(data.ontime)
                    $('#cargo_ontime').prop( "checked", true );
                else
                    $('#cargo_ontime').prop( "checked", false );

                $('#cargo_reccode').val(data.reccode);
            }
        });

        $("#cargo_types").val('update');
        $("#cargo_add").hide();
        $("#cargo_edit_area").fadeIn();
        $("#cargo_submit").show();
        $("#cargo_cancel").show();
    });
    
    $('#cargo_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#cargo_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
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
    
    $("#cargo_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#cargo_data");
        var data = getFormData($form);
        $("#cargo_submit").prop("disabled",true);
        if($("#cargo_types").val() == 'insert')
            insert_cargo(data);
        if($("#cargo_types").val() == 'update')
            update_cargo(data);

        return false;
    });

    function insert_cargo(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_worksheet_cargo_handling.php?worksheet_id='+$("#worksheet_id").val()+"&customer="+$("#customer").val(),
            data: data,
            success: function(data) {
                $("#cargo_submit").prop("disabled",false);
				$('#cargo_table').DataTable().ajax.reload();

                $("#cargo_add").show();
                $("#cargo_edit_area").fadeOut();
                $("#cargo_submit").hide();
                $("#cargo_cancel").hide();
                
                Result = data;
                if(Result.Status == "Success") {
                    setTimeout(load_cargo, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_cargo(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_worksheet_cargo_handling.php?reccode='+$("#cargo_reccode").val(),
            data: data,
            success: function(data) {
                $("#cargo_submit").prop("disabled",false);
				$('#cargo_table').DataTable().ajax.reload();

                $("#cargo_add").show();
                $("#cargo_edit_area").fadeOut();
                $("#cargo_submit").hide();
                $("#cargo_cancel").hide();

                Result = data;
                if(Result.Status == "Success") {
                    setTimeout(load_cargo, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#cargo_cancel").on('click',function(){
        $("#cargo_add").show();
        $("#cargo_edit_area").fadeOut();
        $("#cargo_submit").hide();
        $("#cargo_cancel").hide();
    })

	/********* Service ************/
	function get_number_service(){
        $.ajax({
            type: 'GET',
            dataType: "json",
            //url: 'api/get_service_number.php?worksheet_id='+$("#worksheet_id").val(),
			url: 'api/get_service_number.php?date='+$("#worksheet_date").val(),
            success: function(data) {
                $('#service_cargo_service_id').val(data.num);
				$('#service_line_status').val("Open");
				$('#service_line_status').attr('readonly', true);
            }
        });
    }

    $("#service-nav").on('click',function(){
		if($("#form_type").val()!="")
            $("#service_add").show();
        $("#service_edit_area").fadeOut();
        $("#service_submit").hide();
        $("#service_cancel").hide();
        setTimeout(load_service, 1000);
    })
   
    function load_service(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        if(worksheet_status != 'Open'){
            btn = "";
            $('#service-tab button').hide();
        }

        var table = $('#service_table').DataTable( {
            "ajax": "api/view_worksheet_service.php?worksheet_id="+$("#worksheet_id").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo" : false,
            "scrollX": true,
            "columnDefs": [ {
                "targets": 0,
                "data": null,
                "defaultContent": btn
			} ],
            "bDestroy": true
        } );
    }

    $("#service_add").on('click',function(){
        $('form#service_data input:text').val('');
        $('form#service_data select').val('');
        $('form#service_data input[type="number"]').val('');
        $('form#service_data input[type="date"]').val('');
        $('form#service_data input[type="time"]').val('');
        document.getElementById("service_no_charge").checked = false;
        document.getElementById("reimbursment").checked = false;
        $("#service_type").val('insert');
        $("#service_add").hide();
        $("#service_edit_area").fadeIn();
        $("#service_submit").show();
        $("#service_cancel").show();
		get_number_service()
    })

    $('#service_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#service_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_service.php?reccode='+data[0],
            success: function(data) {
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
                if(data.no_charge)
                    $('#service_no_charge').prop( "checked", true );
                else
                    $('#service_no_charge').prop( "checked", false );
				if(data.reimbursment)
                    $('#reimbursment').prop( "checked", true );
                else
                    $('#reimbursment').prop( "checked", false );

                if(data.line_status == "Cancelled"){
                    $('.service_cancel_reason').show();
                    $('#service_cancel_reason').prop('required',true);
                }else{
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
    
    $('#service_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#service_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
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
    
    $("#service_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#service_data");
        var data = getFormData($form);
        $("#service_submit").prop("disabled",true);
        if($("#service_type").val() == 'insert')
            insert_service(data);
        if($("#service_type").val() == 'update')
            update_service(data);

        return false;
    });

    function insert_service(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_worksheet_service.php?worksheet_id='+$("#worksheet_id").val()+"&customer="+$("#customer").val(),
            data: data,
            success: function(data) {
                $("#service_submit").prop("disabled",false);
				$('#service_table').DataTable().ajax.reload();

                $("#service_add").show();
                $("#service_edit_area").fadeOut();
                $("#service_submit").hide();
                $("#service_cancel").hide();
                
                Result = data;
                if(Result.Status == "Success") {
                    setTimeout(load_service, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_service(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_worksheet_service.php?reccode='+$("#service_reccode").val(),
            data: data,
            success: function(data) {
                $("#service_submit").prop("disabled",false);
				$('#service_table').DataTable().ajax.reload();

                $("#service_add").show();
                $("#service_edit_area").fadeOut();
                $("#service_submit").hide();
                $("#service_cancel").hide();

                Result = data;
                if(Result.Status == "Success") {
                    setTimeout(load_service, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#service_cancel").on('click',function(){
        $("#service_add").show();
        $("#service_edit_area").fadeOut();
        $("#service_submit").hide();
        $("#service_cancel").hide();
    })

    function torf(val){
        if(val == 'Y')
            return true;
        else
            return false;
    }

	/********* Taxi ************/
	function get_number_taxi(){
        $.ajax({
            type: 'GET',
            dataType: "json",
			url: 'api/get_taxi_number.php?date='+$("#worksheet_date").val(),
            success: function(data) {
                $('#taxi_service_id').val(data.num);
				$('#taxi_line_status').val("Open");
				$('#taxi_line_status').attr('readonly', true);
            }
        });
    }

	$("#taxi_from").on("change",function(){
		if ($("#taxi_from").val() == ''){
			$('#taxi_contract').val('');
			$('#taxi_contract_line').val('');
		} else {
			get_taxi_to($("#customer").val(),$("#taxi_from").val());
		}
    });

	async function get_taxi_to(customer_id,location_from){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_location_taxi_to.php?customer='+customer_id+'&location_from='+location_from,
            success: function(data) {
                var $el = $("#taxi_to");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });
            }
        });
    }

	$("#taxi_to").on("change",function(){
		if ($("#taxi_to").val() == ''){
			$('#taxi_contract').val('');
			$('#taxi_contract_line').val('');
		} else {
			get_contract_taxi_line($("#customer").val(),$("#taxi_from").val(),$("#taxi_to").val(),$("#taxi_charge_as").val());
		}
    });

	async function get_contract_taxi_line(customer_id,location_from,location_to,vehicle_type){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_taxi_line.php?customer='+customer_id+'&location_from='+location_from+'&location_to='+location_to+'&vehicle_type='+vehicle_type,
            success: function(data) {
				$('#taxi_contract').val(data.contract_no);
				$('#taxi_contract_line').val(data.contract_line);
            }
        });
    }



    $("#taxi-nav").on('click',function(){
		if($("#form_type").val()!="")
            $("#taxi_add").show();
        $("#taxi_edit_area").fadeOut();
        $("#taxi_submit").hide();
        $("#taxi_cancel").hide();
        setTimeout(load_taxi, 1000);
    })
   
    function load_taxi(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        if(worksheet_status != 'Open'){
            btn = "";
            $('#taxi-tab button').hide();
        }

        var table = $('#taxi_table').DataTable( {
            "ajax": "api/view_worksheet_taxi.php?worksheet_id="+$("#worksheet_id").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo" : false,
            "scrollX": true,
            "columnDefs": [ {
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
            } ],
            "bDestroy": true
        } );
    }

    $("#taxi_add").on('click',function(){
        $('form#taxi_data input:text').val('');
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

    $('#taxi_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#taxi_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_taxi.php?reccode='+data[0],
            success: function(data) {
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

                if(data.line_status == "Cancelled"){
                    $('.taxi_cancel_reason').show();
                    $('#taxi_cancel_reason').prop('required',true);
                }else{
                    $('.taxi_cancel_reason').hide();
                    $('#taxi_cancel_reason').removeAttr('required');
                }

				$('#taxi_group_name').val(data.group_name)
                $('#taxi_type1').val(data.type1);
                $('#taxi_type2').val(data.type2);
				$('#taxi_type3').val(data.type3);
                $('#taxi_type4').val(data.type4);
				$('#taxi_type5').val(data.type5);
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
    
    $('#taxi_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#taxi_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
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
    
    $("#taxi_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#taxi_data");
        var data = getFormData($form);
        $("#taxi_submit").prop("disabled",true);
        if($("#taxi_type").val() == 'insert')
            insert_taxi(data);
        if($("#taxi_type").val() == 'update')
            update_taxi(data);

        return false;
    });

    function insert_taxi(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_worksheet_taxi.php?worksheet_id='+$("#worksheet_id").val()+"&customer="+$("#customer").val(),
            data: data,
            success: function(data) {
                $("#taxi_submit").prop("disabled",false);
				$('#taxi_table').DataTable().ajax.reload();

                $("#taxi_add").show();
                $("#taxi_edit_area").fadeOut();
                $("#taxi_submit").hide();
                $("#taxi_cancel").hide();
                
                Result = data;
                if(Result.Status == "Success") {
                    setTimeout(load_taxi, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_taxi(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_worksheet_taxi.php?reccode='+$("#taxi_reccode").val(),
            data: data,
            success: function(data) {
                $("#taxi_submit").prop("disabled",false);
				$('#taxi_table').DataTable().ajax.reload();

                $("#taxi_add").show();
                $("#taxi_edit_area").fadeOut();
                $("#taxi_submit").hide();
                $("#taxi_cancel").hide();

                Result = data;
                if(Result.Status == "Success") {
                    setTimeout(load_taxi, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#taxi_cancel").on('click',function(){
        $("#taxi_add").show();
        $("#taxi_edit_area").fadeOut();
        $("#taxi_submit").hide();
        $("#taxi_cancel").hide();
    })

    function torf(val){
        if(val == 'Y')
            return true;
        else
            return false;
    }

	/********* immigration ************/
	function get_number_immigration(){
        $.ajax({
            type: 'GET',
            dataType: "json",
            //url: 'api/get_service_number.php?worksheet_id='+$("#worksheet_id").val(),
			url: 'api/get_immigration_number.php?date='+$("#worksheet_date").val(),
            success: function(data) {
                $('#immigration_id').val(data.num);
				$('#immigration_line_status').val("Open");
				$('#immigration_line_status').attr('readonly', true);
            }
        });
    }

    $("#immigration-nav").on('click',function(){
		if($("#form_type").val()!="")
            $("#immigration_add").show();
        $("#immigration_edit_area").fadeOut();
        $("#immigration_submit").hide();
        $("#immigration_cancel").hide();
        setTimeout(load_immigration, 1000);
    })

	$("#immigration_service").on("change",function(){
		if ($("#immigration_service").val() == ''){
			$('#immigration_agreement_number').val('');
			$('#immigration_contract_line').val('');
		} else {
			get_contract_immigration($("#customer").val(),$("#immigration_service").val());
			//$('#immigration_remark').val($("#immigration_service").val());
		}
    });

	async function get_contract_immigration(customer_id,service){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_immigration_line.php?customer='+customer_id+'&service='+service,
            success: function(data) {
				$('#immigration_agreement_number').val(data.contract_no);
				$('#immigration_contract_line').val(data.contract_line);
            }
        });
    }
   
    function load_immigration(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        if(worksheet_status != 'Open'){
            btn = "";
            $('#immigration-tab button').hide();
        }

        var table = $('#immigration_table').DataTable( {
            "ajax": "api/view_worksheet_immigration.php?worksheet_id="+$("#worksheet_id").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo" : false,
            "scrollX": true,
            "columnDefs": [ {
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
            } ],
            "bDestroy": true
        } );
    }

    $("#immigration_add").on('click',function(){
        $('form#immigration_data input:text').val('');
        $('form#immigration_data select').val('');
        $('form#immigration_data input[type="number"]').val('');
        $('form#immigration_data input[type="date"]').val('');
        $('form#immigration_data input[type="time"]').val('');

        $("#immigration_type").val('insert');
        $("#immigration_add").hide();
        $("#immigration_edit_area").fadeIn();
        $("#immigration_submit").show();
        $("#immigration_cancel").show();
		get_number_immigration()
    })

    $('#immigration_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#immigration_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_immigration.php?reccode='+data[0],
            success: function(data) {
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

                if(data.line_status == "Cancelled"){
                    $('.immigration_cancel_reason').show();
                    $('#immigration_cancel_reason').prop('required',true);
                }else{
                    $('.immigration_cancel_reason').hide();
                    $('#immigration_cancel_reason').removeAttr('required');
                }

				$('#immigration_group_name').val(data.group_name)
                $('#immigration_type1').val(data.type1);
                $('#immigration_type2').val(data.type2);
				$('#immigration_type3').val(data.type3);
                $('#immigration_type4').val(data.type4);
				$('#immigration_type5').val(data.type5);
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
				if(data.reimbursment)
                    $('#immigration_reimbursment').prop( "checked", true );
                else
                    $('#immigration_reimbursment').prop( "checked", false );

                $('#immigration_reccode').val(data.reccode);
            }
        });

        $("#immigration_type").val('update');
        $("#immigration_add").hide();
        $("#immigration_edit_area").fadeIn();
        $("#immigration_submit").show();
        $("#immigration_cancel").show();
    });
    
    $('#immigration_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#immigration_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
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
    
    $("#immigration_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#immigration_data");
        var data = getFormData($form);
        $("#immigration_submit").prop("disabled",true);
        if($("#immigration_type").val() == 'insert')
            insert_immigration(data);
        if($("#immigration_type").val() == 'update')
            update_immigration(data);

        return false;
    });

    function insert_immigration(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_worksheet_immigration.php?worksheet_id='+$("#worksheet_id").val()+"&customer="+$("#customer").val(),
            data: data,
            success: function(data) {
                $("#immigration_submit").prop("disabled",false);
				$('#immigration_table').DataTable().ajax.reload();

                $("#immigration_add").show();
                $("#immigration_edit_area").fadeOut();
                $("#immigration_submit").hide();
                $("#immigration_cancel").hide();
                
                Result = data;
                if(Result.Status == "Success") {
                    setTimeout(load_immigration, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_immigration(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_worksheet_immigration.php?reccode='+$("#immigration_reccode").val(),
            data: data,
            success: function(data) {
                $("#immigration_submit").prop("disabled",false);
				$('#immigration_table').DataTable().ajax.reload();

                $("#immigration_add").show();
                $("#immigration_edit_area").fadeOut();
                $("#immigration_submit").hide();
                $("#immigration_cancel").hide();

                Result = data;
                if(Result.Status == "Success") {
                    setTimeout(load_immigration, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#immigration_cancel").on('click',function(){
        $("#immigration_add").show();
        $("#immigration_edit_area").fadeOut();
        $("#immigration_submit").hide();
        $("#immigration_cancel").hide();
    })

    	/********* Hotel booking ************/
	function get_number_hotel(){
        $.ajax({
            type: 'GET',
            dataType: "json",
            //url: 'api/get_service_number.php?worksheet_id='+$("#worksheet_id").val(),
			url: 'api/get_immigration_number.php?date='+$("#worksheet_date").val(),
            success: function(data) {
                $('#hotel_id').val(data.num);
				$('#hotel_line_status').val("Open");
				$('#hotel_line_status').attr('readonly', true);
            }
        });
    }

    $("#hotel-nav").on('click',function(){
        $('#viewhotelmodal').modal('show'); 
		if($("#form_type").val()!="")
            $("#hotel_add").show();
        $("#hotel_edit_area").fadeOut();
        $("#hotel_submit").show();
        $("#hotel_cancel").show();
        setTimeout(load_hotel, 1000);
    })

	$("#hotel_service").on("change",function(){
		if ($("#hotel_service").val() == ''){
			$('#hotel_agreement_number').val('');
			$('#hotel_contract_line').val('');
		} else {
			get_contract_hotel($("#customer").val(),$("#hotel_service").val());
		}
    });

	async function get_contract_hotel(customer_id,service){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_immigration_line.php?customer='+customer_id+'&service='+service,
            success: function(data) {
				$('#hotel_agreement_number').val(data.contract_no);
				$('#hotel_contract_line').val(data.contract_line);
            }
        });
    }
   
    function load_hotel(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        if(worksheet_status != 'Open'){
            btn = "";
            $('#hotel-tab button').hide();
        }

        var table = $('#hotel_table').DataTable( {
            "ajax": "api/view_worksheet_immigration.php?worksheet_id="+$("#worksheet_id").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo" : false,
            "scrollX": true,
            "columnDefs": [ {
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
            } ],
            "bDestroy": true
        } );
    }

    $("#hotel_add").on('click',function(){
        $('form#hotel_data input:text').val('');
        $('form#hotel_data select').val('');
        $('form#hotel_data input[type="number"]').val('');
        $('form#hotel_data input[type="date"]').val('');
        $('form#hotel_data input[type="time"]').val('');

        $("#hotel_type").val('insert');
        $("#hotel_add").hide();
        $("#hotel_edit_area").fadeIn();
        $("#hotel_submit").show();
        $("#hotel_cancel").show();
		get_number_hotel()
    })

    $('#hotel_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#hotel_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_immigration.php?reccode='+data[0],
            success: function(data) {
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

                if(data.line_status == "Cancelled"){
                    $('.immigration_cancel_reason').show();
                    $('#immigration_cancel_reason').prop('required',true);
                }else{
                    $('.immigration_cancel_reason').hide();
                    $('#immigration_cancel_reason').removeAttr('required');
                }

				$('#immigration_group_name').val(data.group_name)
                $('#immigration_type1').val(data.type1);
                $('#immigration_type2').val(data.type2);
				$('#immigration_type3').val(data.type3);
                $('#immigration_type4').val(data.type4);
				$('#immigration_type5').val(data.type5);
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
				if(data.reimbursment)
                    $('#immigration_reimbursment').prop( "checked", true );
                else
                    $('#immigration_reimbursment').prop( "checked", false );

                $('#immigration_reccode').val(data.reccode);
            }
        });

        $("#hotel_type").val('update');
        $("#hotel_add").hide();
        $("#hotel_edit_area").fadeIn();
        $("#hotel_submit").show();
        $("#hotel_cancel").show();
    });
    
    $('#hotel_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#hotel_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
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
    
    $("#hotel_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#hotel_data");
        var data = getFormData($form);
        $("#hotel_submit").prop("disabled",true);
        if($("#hotel_type").val() == 'insert')
            insert_hotel(data);
        if($("#hotel_type").val() == 'update')
            update_hotel(data);

        return false;
    });

    function insert_hotel(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_worksheet_immigration.php?worksheet_id='+$("#worksheet_id").val()+"&customer="+$("#customer").val(),
            // fix
            data: data,
            success: function(data) {
                $("#hotel_submit").prop("disabled",false);
				$('#hotel_table').DataTable().ajax.reload();

                $("#hotel_add").show();
                $("#hotel_edit_area").fadeOut();
                $("#hotel_submit").hide();
                $("#hotel_cancel").hide();
                
                Result = data;
                if(Result.Status == "Success") {
                    setTimeout(load_hotel, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_hotel(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_worksheet_immigration.php?reccode='+$("#hotel_reccode").val(),
            data: data,
            success: function(data) {
                $("#hotel_submit").prop("disabled",false);
				$('#hotel_table').DataTable().ajax.reload();

                $("#hotel_add").show();
                $("#hotel_edit_area").fadeOut();
                $("#hotel_submit").hide();
                $("#hotel_cancel").hide();

                Result = data;
                if(Result.Status == "Success") {
                    setTimeout(load_hotel, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#hotel_cancel").on('click',function(){
        $("#hotel_add").show();
        $("#hotel_edit_area").fadeOut();
        $("#hotel_submit").hide();
        $("#hotel_cancel").hide();
    })
    
    	/********* Ticket booking ************/
	function get_number_hotel(){
        $.ajax({
            type: 'GET',
            dataType: "json",
            //url: 'api/get_service_number.php?worksheet_id='+$("#worksheet_id").val(),
			url: 'api/get_immigration_number.php?date='+$("#worksheet_date").val(),
            success: function(data) {
                $('#hotel_id').val(data.num);
				$('#hotel_line_status').val("Open");
				$('#hotel_line_status').attr('readonly', true);
            }
        });
    }

    $("#ticket-nav").on('click',function(){
        $('#viewticketmodal').modal('show'); 
		if($("#form_type").val()!="")
            $("#ticket_add").show();
        $("#ticket_edit_area").fadeOut();
        $("#ticket_submit").show();
        $("#ticket_cancel").show();
        setTimeout(load_ticket, 1000);
    })

	$("#ticket_service").on("change",function(){
		if ($("#ticket_service").val() == ''){
			$('#ticket_agreement_number').val('');
			$('#ticket_contract_line').val('');
		} else {
			get_contract_ticket($("#customer").val(),$("#ticket_service").val());
		}
    });

	async function get_contract_ticket(customer_id,service){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_immigration_line.php?customer='+customer_id+'&service='+service,
            success: function(data) {
				$('#ticket_agreement_number').val(data.contract_no);
				$('#ticket_contract_line').val(data.contract_line);
            }
        });
    }
   
    function load_ticket(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        if(worksheet_status != 'Open'){
            btn = "";
            $('#ticket-tab button').hide();
        }

        var table = $('#ticket_table').DataTable( {
            "ajax": "api/view_worksheet_immigration.php?worksheet_id="+$("#worksheet_id").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": false,
            "bInfo" : false,
            "scrollX": true,
            "columnDefs": [ {
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
            } ],
            "bDestroy": true
        } );
    }

    $("#ticket_add").on('click',function(){
        $('form#ticket_data input:text').val('');
        $('form#ticket_data select').val('');
        $('form#ticket_data input[type="number"]').val('');
        $('form#ticket_data input[type="date"]').val('');
        $('form#ticket_data input[type="time"]').val('');

        $("#ticket_type").val('insert');
        $("#ticket_add").hide();
        $("#ticket_edit_area").fadeIn();
        $("#ticket_submit").show();
        $("#ticket_cancel").show();
		get_number_ticket()
    })

    $('#ticket_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#ticket_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_worksheet_immigration.php?reccode='+data[0],
            success: function(data) {
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

                if(data.line_status == "Cancelled"){
                    $('.immigration_cancel_reason').show();
                    $('#immigration_cancel_reason').prop('required',true);
                }else{
                    $('.immigration_cancel_reason').hide();
                    $('#immigration_cancel_reason').removeAttr('required');
                }

				$('#immigration_group_name').val(data.group_name)
                $('#immigration_type1').val(data.type1);
                $('#immigration_type2').val(data.type2);
				$('#immigration_type3').val(data.type3);
                $('#immigration_type4').val(data.type4);
				$('#immigration_type5').val(data.type5);
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
				if(data.reimbursment)
                    $('#immigration_reimbursment').prop( "checked", true );
                else
                    $('#immigration_reimbursment').prop( "checked", false );

                $('#immigration_reccode').val(data.reccode);
            }
        });

        $("#ticket_type").val('update');
        $("#ticket_add").hide();
        $("#ticket_edit_area").fadeIn();
        $("#ticket_submit").show();
        $("#ticket_cancel").show();
    });
    
    $('#ticket_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#ticket_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
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
    
    $("#ticket_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#ticket_data");
        var data = getFormData($form);
        $("#ticket_submit").prop("disabled",true);
        if($("#ticket_type").val() == 'insert')
            insert_ticket(data);
        if($("#ticket_type").val() == 'update')
            update_ticket(data);

        return false;
    });

    function insert_ticket(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: ''//'api/insert_worksheet_immigration.php?worksheet_id='+$("#worksheet_id").val()+"&customer="+$("#customer").val()
            ,
            // fix
            data: data,
            success: function(data) {
                $("#ticket_submit").prop("disabled",false);
				$('#ticket_table').DataTable().ajax.reload();

                $("#ticket_add").show();
                $("#ticket_edit_area").fadeOut();
                $("#ticket_submit").hide();
                $("#ticket_cancel").hide();
                
                Result = data;
                if(Result.Status == "Success") {
                    setTimeout(load_ticket, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_ticket(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: '',//'api/update_worksheet_immigration.php?reccode='+$("#ticket_reccode").val(),
            data: data,
            success: function(data) {
                $("#ticket_submit").prop("disabled",false);
				$('#ticket_table').DataTable().ajax.reload();

                $("#ticket_add").show();
                $("#ticket_edit_area").fadeOut();
                $("#ticket_submit").hide();
                $("#ticket_cancel").hide();

                Result = data;
                if(Result.Status == "Success") {
                    setTimeout(load_ticket, 1000);

                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#ticket_cancel").on('click',function(){
        $("#ticket_add").show();
        $("#ticket_edit_area").fadeOut();
        $("#ticket_submit").hide();
        $("#ticket_cancel").hide();
    })

</script>