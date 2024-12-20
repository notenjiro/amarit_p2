<style> 
    .w-5{
        width: 100px!important
    }
</style>
<div class="modal-body"> 
    <form id="contract_data">
        <div id="edit_area">
            <div class="row">  
                <div class="col-2">   
                    <div class="form-group">
						<span>Front-end Contract No. </span><span style="color:red"> *</span>
                        <input type="text" name="contract_no" id="contract_no" class="form-control" required>
                    </div>
                </div>
				<div class="col-2">   
                    <div class="form-group">
						<span>ERP Contract No.</span><span style="color:red"> *</span>
                        <input type="text" name="erp_contract_no" id="erp_contract_no" class="form-control" required>
                    </div>
                </div>
                <div class="col-2">   
                    <div class="form-group">
						<span>Contract Date</span><span style="color:red"> *</span>
                        <input type="date" name="contract_date" id="contract_date" class="form-control" required>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
						<span>Start Date</span><span style="color:red"> *</span>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
						<span>End Date</span><span style="color:red"> *</span>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                    </div>
                </div>
				<div class="col-2">
                    <div class="form-group">
						<span>Status</span><span style="color:red"> *</span>
                        <select name="status" id="status" class="form-control" aria-describedby="inputGroupPrepend2">
                            <option value="on going">on going</option>
                            <option value="nearing expire">nearing expire</option>
                            <option value="expired">expired</option>
                        </select>
                    </div>
                </div>
				
            </div>
            <div class="row">  
				<div class="col-1">
                    <div class="form-group">
						<span>Customer code</span>
                        <input type="text" name="customer_no" id="customer_no" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-5">   
                    <div class="form-group">
						<span>Customer</span><span style="color:red"> *</span>
                        <select name="customer" id="customer" class="form-control" aria-describedby="inputGroupPrepend2" required>
                            <option value=""></option>
                            <?php
                                $fQuery = "SELECT customer_id,name FROM customer order by name";
                                $result_chart_of_account = sqlsrv_query($conn, $fQuery);
                                $x = 1;
                                while($row = sqlsrv_fetch_array( $result_chart_of_account, SQLSRV_FETCH_ASSOC)) {?>					  
                                <option value="<?php echo $row['customer_id'];?>"><?php echo $row['name'];?></option>	              
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
						<span>Customer ref.</span>
                        <input type="text" name="customer_ref" id="customer_ref" class="form-control" required>
                    </div>
                </div>
				<div class="col-1">   
					<div class="form-group">
						<span>Active</span>
                        <input type="checkbox"  value="1" id="active" name="active" class="form-check">
                    </div>
                </div>
                <div class="col-1">   
					<div class="form-group">
						<span>Pay Cash</span>
                        <input type="checkbox"  value="1" id="pay_cash" name="pay_cash" class="form-check">
                    </div>
                </div>
				<div class="col-2">
                    <div class="form-group">
						<span>Create Date</span><span style="color:red"> *</span>
                        <input type="date" name="create_date" id="create_date" class="form-control" required >
                    </div>
                </div>
            </div>
            <div class="row">  
				<div class="col-3">
                    <div class="form-inline">
                        <label>Payment Terms</label>&nbsp;
						<input type="number" name="payment_term" id="payment_term" class="form-control w-5" style="text-align:right;">&nbsp;Days
                    </div>
                </div>
				<div class="col-3">
                    <div class="form-inline">
                        <label>Round trip rate %</label>&nbsp;
						<input type="number" name="round_trip_rate" id="round_trip_rate" class="form-control w-5" style="text-align:right;">
                    </div>
                </div>
			</div>
			<div class="row">
				<div class="col-3">
				<div class="form-inline">
                        <label>-</label>
                    </div>
				</div>
			</div>
            <div class="row">
				<div class="col-12">
  
					<div class="form-group">
					<!--<input type="checkbox"  value="1" id="diesel" name="diesel" class="form-check">-->
                    <div class="form-inline">
                        <lavel>If Diesel price does exceed THB <input type="number" name="diesel1" id="diesel1" class="form-control w-5" style="text-align:right;" > per liter then a <input type="number" name="diesel2" id="diesel2" class="form-control w-5" style="text-align:right;" > % increse in our charge rate per unit will be applied for every THB <input type="number" name="diesel3" id="diesel3" class="form-control w-5" style="text-align:right;" > increase in the Diesal price.</label>
                    </div>
					</div>
                </div>
				
				<!--<div class="col-6">
					<div class="form-group">
					<input type="checkbox"  value="1" id="rounding" name="rounding" class="form-check">
                    <div class="form-inline">
                        <lavel>Rounding trip (Backload) is charged at <input type="number" name="rounding1" id="rounding1" class="form-control w-5" style="text-align:right;" > % of a "with cargo-single trip"</label>
                    </div>
					</div>
                </div>-->
                <!--<div class="col-2">
                    <br>
                    <br>
                    <div class="form-inline">
                    &nbsp;&nbsp;<input type="checkbox"  value="true" id="active" name="active" class="form-check"> &nbsp;&nbsp;&nbsp;
                        <lavel>Active</label>
                    </div>
                </div>			
                <div class="col-2">
                    <br>
                    <br>
                    <div class="form-inline">
                    <input type="checkbox"  value="true" id="pay_cash" name="pay_cash" class="form-check"> &nbsp;&nbsp;&nbsp;
                        <lavel>Pay Cash</label>
                    </div>
                </div>-->				
            </div>
            <div class="row">
                
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-12">  
                <button style="width:100px" type="submit" class="btn btn-success" id="contract_submit" data-bs-target="#" >
                        <i class="fa fa-save"></i> Save
                    </button>
                <button style="width:100px" type="button" class="btn btn-danger"  id="contract_cancel" data-bs-target="#" >
                    <i class="fa fa-minus-square"></i> Cancel
                </button>
                <input type="hidden" id="contact_id">
            </div>
        </div>               
    
    </form>


    <div id="sub_data">
        <div class="card-body">  
            <ul class="nav nav-tabs" role="tablist" id="menu-contract">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#transportation-tab" id="transportation-nav">TP Format 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#service-tab" id="service-nav">TP Format 2</a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#serviceat-tab" id="serviceat-nav">TP Format 3</a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#heavy-tab" id="heavy-nav">Cargo handling</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#hourly-tab" id="hourly-nav">Manpower</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#immigration-tab" id="immigration-nav">Immigration</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#taxi-tab" id="taxi-nav">Taxi service</a>
                </li>
				<!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#promotion-tab" id="promotion-nav">Promotion</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#warehouse-tab" id="warehouse-nav">Warehouse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#utilities-tab" id="utilities-nav">Utilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#retal-tab" id="retal-nav">Retal (Vehicle & Heavy Eq)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#customer-clearance-cargo" id="customer-clearance-cargo">Customer Clearance ( Cargo )</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#customer-clearance-vessle" id="customer-clearance-vessle">Customer Clearance ( Vessel )</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#hotelbooking-tab" id="hotelbooking-nav">Hotel Booking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#ticketbooking-tab" id="ticketbooking-nav">Ticket Booking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#space-rental" id="space-rental">Space Rental</a>
                </li>
            </ul>
            <div class="tab-content">

                <div class="tab-pane active" id="transportation-tab">
					<br>
                    <form id="transportation_data">
                        <div id="transportation_edit_area">                        
                            <div class="row"> 
								<div class="col-2">   
									<div class="form-group">
										<span>Contract line number</span><span style="color:red"> *</span>
										<input type="text" name="contract_line1" id="contract_line1" class="form-control" required>
									</div>
								</div>
								<div class="col-4">   
                                    <div class="form-group">
										<span>Vehicle type</span><span style="color:red"> *</span>
										<select name="vehicle_type1" id="vehicle_type1" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        <option value=""></option>
                                        <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code ";
                                            $result_vehicle_type = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_vehicle_type, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-2">   
                                    <div class="form-group">
									<span>Diesel baht from</span><span style="color:red"> *</span>
                                        <input type="text" name="diesel_baht_from" id="diesel_baht_from" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
									<span>Diesel baht to</span><span style="color:red"> *</span>
                                        <input type="text" name="diesel_baht_to" id="diesel_baht_to" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>			
								<div class="col-2">   
                                    <div class="form-group">
										<span>UOM</span><span style="color:red"> *</span>
										<select name="transportation_uom" id="transportation_uom" class="form-control" aria-describedby="inputGroupPrepend2" required>
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
										<span>Transportation from</span><span style="color:red"> *</span>										          
										<select name="transportation_from" id="transportation_from" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        <option value=""></option>
                                        <?php
                                            $fQuery = "SELECT * FROM contract_location_master where active = 1 order by location";
                                            $result_vehicle_type = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_vehicle_type, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['location'];?>"><?php echo $row['location'];?></option>         
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div> 
								<div class="col-4">   
                                    <div class="form-group">
										<span>Transportation to</span><span style="color:red"> *</span>
										<select name="transportation_to" id="transportation_to" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        <option value=""></option>
                                        <?php
                                            $fQuery = "SELECT * FROM contract_location_master where active = 1 order by location";
                                            $result_vehicle_type = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_vehicle_type, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['location'];?>"><?php echo $row['location'];?></option>         
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
										<span>Transportation rate</span><span style="color:red"> *</span>
                                        <input type="text" name="transportation_rate" id="transportation_rate" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								 
								<div class="col-2">   
                                    <div class="form-group">
										<span>Total KM.</span><span style="color:red"> *</span>
                                        <input type="text" name="total_km" id="total_km" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								<!-- <div class="col-2">   
                                    <div class="form-group">
										<span>lumsum</span>
                                        <input type="checkbox"  value="1" id="transport_solution1" name="transport_solution1" class="form-check">
                                    </div>
                                </div> -->
								<div class="col-2">   
                                    <div class="form-group">
										<span>Customer reference</span><span style="color:red"> *</span>
                                        <input type="text" name="transport_category" id="transport_category" class="form-control" required>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
										<span>Round trip rate</span>
                                        <input type="text" name="transportation_round_trip_rate" id="transportation_round_trip_rate" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>

                                <div class="col-2">   
									<div class="form-group">
                                    <span>Sub3</span><span style="color:red"> *</span><?php //switch transport_operator to service_operator?>
                                        <select name="sub3" id="transport_category" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT no_sub_type3, sub_type3, TP FROM FES.dbo.barcode_sub_type3 where TP = 1";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['no_sub_type3'];?>"><?php echo $row['sub_type3']?></option>	
                                            <?php } ?>
                                        </select>
									</div>
								</div>

                                <div class="col-2">   
									<div class="form-group">
                                    <span>Sub5</span><span style="color:red"> *</span><?php //switch transport_operator to service_operator?>
                                        <select name="sub5" id="transport_category" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT no_sub_type5, sub_type5, TP FROM FES.dbo.barcode_sub_type5 where TP = 1";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['no_sub_type5'];?>"><?php echo $row['sub_type5']?></option>	
                                            <?php } ?>
                                        </select>
									</div>
								</div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="transportation_add" data-bs-target="#" >
                                    <i class="fa fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="transportation_submit" data-bs-target="#" >
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="transportation_cancel" data-bs-target="#" >
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="transportation_type" id="transportation_type">
                                <input type="hidden" name="transportation_reccode" id="transportation_reccode">

                            </div>
                        </div>     
                    </form>
					<br>
                    <table id="transportation_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
								<th scope="col" width="20%"></th>
								<th scope="col" width="15%">Customer code</th>
								<th scope="col" width="15%">Contract line number</th>
                                <th scope="col" width="15%">Vehicle type</th>
                                <th scope="col" width="15%">Diesel baht from</th>
                                <th scope="col" width="10%">Diesel baht to</th>
                                <th scope="col" width="15%">Transportation from</th>
                                <th scope="col" width="15%">Transportation to</th>
								<th scope="col" width="15%">Transportation rate</th>
                                <th scope="col" width="10%">Total KM.</th>
								<th scope="col" width="10%">Transport solution</th>
								<th scope="col" width="10%">UOM</th>
                            </tr>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="service-tab">
                    <form id="service_data">
                        <div id="service_edit_area">                        
                            <div class="row"> 
								<div class="col-2">   
									<div class="form-group">
										<span>Contract line number</span><span style="color:red"> *</span>
										<input type="text" name="contract_line2" id="contract_line2" class="form-control" required>
									</div>
								</div>
								<div class="col-3">   
                                    <div class="form-group">
										<span>Vehicle Type</span><span style="color:red"> *</span>
										<select name="vehicle_type2" id="vehicle_type2" class="form-control" aria-describedby="inputGroupPrepend2" required>
										<option value=""></option>
										<?php
											$fQuery = "SELECT * FROM vehicle_type order by code ";
											$result = sqlsrv_query($conn, $fQuery);
											while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
											<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
										<?php } ?>
										</select>
                                    </div>
                                </div> 
                                <div class="col-2">   
                                    <div class="form-group">
										<span>Hourly rate</span><span style="color:red"> *</span>
                                        <input type="text" name="hourly_rate" id="hourly_rate" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
										<span>Daily rate</span><span style="color:red"> *</span>
                                        <input type="text" name="daily_rate" id="daily_rate" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
										<span>Monthly rate</span><span style="color:red"> *</span>
                                        <input type="text" name="monthly_rate" id="monthly_rate" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div> 
								<div class="col-2">   
                                    <div class="form-group">
										<span>Minimum hour</span><span style="color:red"> *</span>
                                        <input type="text" name="minimum_charge_hour2" id="minimum_charge_hour2" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								<div class="col-3">   
                                    <div class="form-group">
										<span>Transport solution</span>
                                        <input type="checkbox"  value="1" id="transport_solution2" name="transport_solution2" class="form-check">
                                    </div>
                                </div>
								<!-- <div class="col-2">   
                                    <div class="form-group">
										<span>Standby charge</span>
                                        <input type="checkbox"  value="1" id="standby_charge" name="standby_charge" class="form-check">
                                    </div>
                                </div> -->
								<div class="col-2">   
                                    <div class="form-group">
										<span>OT rate/ hour</span><span style="color:red"> *</span>
                                        <input type="text" name="tp2_ot_hour" id="tp2_ot_hour" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
										<span>Customer reference</span><span style="color:red"> *</span>
                                        <input type="text" name="transport_category" id="transport_category" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">   
									<div class="form-group">
                                    <span>Sub3</span><span style="color:red"> *</span><?php //switch transport_operator to service_operator?>
                                        <select name="sub3" id="transport_category" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT no_sub_type3, sub_type3, TP FROM FES.dbo.barcode_sub_type3 where TP = 1";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['no_sub_type3'];?>"><?php echo $row['sub_type3']?></option>	
                                            <?php } ?>
                                        </select>
									</div>
								</div>

                                <div class="col-2">   
									<div class="form-group">
                                    <span>Sub5</span><span style="color:red"> *</span><?php //switch transport_operator to service_operator?>
                                        <select name="sub5" id="transport_category" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT no_sub_type5, sub_type5, TP FROM FES.dbo.barcode_sub_type5 where TP = 1";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['no_sub_type5'];?>"><?php echo $row['sub_type5']?></option>	
                                            <?php } ?>
                                        </select>
									</div>
								</div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="service_add" data-bs-target="#" >
                                    <i class="fa fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="service_submit" data-bs-target="#" >
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="service_cancel" data-bs-target="#" >
                                    <i class="fa fa-minus-square"></i> Cancel
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
								<th scope="col" width="15%">Contract line number</th>
								<th scope="col" width="20%">Vehicle Type</th>
                                <th scope="col" width="20%">Hourly rate</th>
                                <th scope="col" width="20%">Daily rate</th>
                                <th scope="col" width="20%">Monthly rate</th>
								<th scope="col" width="20%">Minimum hour</th>
                                <th scope="col" width="10%">Transport solution</th>
                            </tr>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>
				</div>

                <div class="tab-pane fade" id="serviceat-tab">
                    <form id="serviceat_data">
                        <div id="serviceat_edit_area">						
                            <div class="row">
								<div class="col-2">   
									<div class="form-group">
										<span>Contract line number</span><span style="color:red"> *</span>
										<input type="text" name="contract_line3" id="contract_line3" class="form-control" required>
									</div>
								</div>
								<div class="col-3">   
                                    <div class="form-group">
										<span>Vehicle Type</span><span style="color:red"> *</span>
										<select name="vehicle_type3" id="vehicle_type3" class="form-control" aria-describedby="inputGroupPrepend2" required>
										<option value=""></option>
										<?php
											$fQuery = "SELECT * FROM vehicle_type order by code";
											$result = sqlsrv_query($conn, $fQuery);
											while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
											<option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
										<?php } ?>
										</select>
                                    </div>
                                </div> 
								<div class="col-2">   
                                    <div class="form-group">
										<span>Category</span><span style="color:red"> *</span>
                                        <input type="text" name="category" id="category" class="form-control" required>
                                    </div>
                                </div>
								<div class="col-3">   
                                    <div class="form-group">
										<span>Commute range with in</span><span style="color:red"> *</span>
                                        <select name="commute_range" id="commute_range" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value="10 KM">10 KM</option>
											<option value="20 KM">20 KM</option>
											<option value="30 KM">30 KM</option>
											<option value="40 KM">40 KM</option>
											<option value="50 KM">50 KM</option>
											<option value="60 KM">60 KM</option>
											<option value="70 KM">70 KM</option>
											<option value="80 KM">80 KM</option>
											<option value="90 KM">90 KM</option>
											<option value="100 KM">100 KM</option>
											<option value="110 KM">110 KM</option>
											<option value="120 KM">120 KM</option>
											<option value="130 KM">130 KM</option>
											<option value="140 KM">140 KM</option>
											<option value="150 KM">150 KM</option>
											<option value="160 KM">160 KM</option>
											<option value="170 KM">170 KM</option>
											<option value="180 KM">180 KM</option>
											<option value="190 KM">190 KM</option>
											<option value="200 KM">200 KM</option>
											<option value="210 KM">210 KM</option>
											<option value="220 KM">220 KM</option>
											<option value="230 KM">230 KM</option>
											<option value="240 KM">240 KM</option>
											<option value="250 KM">250 KM</option>
											<option value="260 KM">260 KM</option>
											<option value="270 KM">270 KM</option>
											<option value="280 KM">280 KM</option>
											<option value="290 KM">290 KM</option>
											<option value="300 KM">300 KM</option>
											<option value="310 KM">310 KM</option>
											<option value="320 KM">320 KM</option>
											<option value="330 KM">330 KM</option>
											<option value="340 KM">340 KM</option>
											<option value="350 KM">350 KM</option>
											<option value="360 KM">360 KM</option>
											<option value="370 KM">370 KM</option>
											<option value="380 KM">380 KM</option>
											<option value="390 KM">390 KM</option>
											<option value="400 KM">400 KM</option>
											<option value="410 KM">410 KM</option>
											<option value="420 KM">420 KM</option>
											<option value="430 KM">430 KM</option>
											<option value="440 KM">440 KM</option>
											<option value="450 KM">450 KM</option>
											<option value="460 KM">460 KM</option>
											<option value="470 KM">470 KM</option>
											<option value="480 KM">480 KM</option>
											<option value="490 KM">490 KM</option>
											<option value="500 KM">500 KM</option>
											<option value="510 KM">510 KM</option>
											<option value="520 KM">520 KM</option>
											<option value="530 KM">530 KM</option>
											<option value="540 KM">540 KM</option>
											<option value="550 KM">550 KM</option>
											<option value="560 KM">560 KM</option>
											<option value="570 KM">570 KM</option>
											<option value="580 KM">580 KM</option>
											<option value="590 KM">590 KM</option>
											<option value="600 KM">600 KM</option>
											<option value="610 KM">610 KM</option>
											<option value="620 KM">620 KM</option>
											<option value="630 KM">630 KM</option>
											<option value="640 KM">640 KM</option>
											<option value="650 KM">650 KM</option>
											<option value="660 KM">660 KM</option>
											<option value="670 KM">670 KM</option>
											<option value="680 KM">680 KM</option>
											<option value="690 KM">690 KM</option>
											<option value="700 KM">700 KM</option>
											<option value="710 KM">710 KM</option>
											<option value="720 KM">720 KM</option>
											<option value="730 KM">730 KM</option>
											<option value="740 KM">740 KM</option>
											<option value="750 KM">750 KM</option>
											<option value="760 KM">760 KM</option>
											<option value="770 KM">770 KM</option>
											<option value="780 KM">780 KM</option>
											<option value="790 KM">790 KM</option>
											<option value="800 KM">800 KM</option>
											<option value="810 KM">810 KM</option>
											<option value="820 KM">820 KM</option>
											<option value="830 KM">830 KM</option>
											<option value="840 KM">840 KM</option>
											<option value="850 KM">850 KM</option>
											<option value="860 KM">860 KM</option>
											<option value="870 KM">870 KM</option>
											<option value="880 KM">880 KM</option>
											<option value="890 KM">890 KM</option>
											<option value="900 KM">900 KM</option>
											<option value="910 KM">910 KM</option>
											<option value="920 KM">920 KM</option>
											<option value="930 KM">930 KM</option>
											<option value="940 KM">940 KM</option>
											<option value="950 KM">950 KM</option>
											<option value="960 KM">960 KM</option>
											<option value="970 KM">970 KM</option>
											<option value="980 KM">980 KM</option>
											<option value="990 KM">990 KM</option>
											<option value="1,000 KM">1,000 KM</option>
											<option value="1,100 KM">1,100 KM</option>
											<option value="1,110 KM">1,110 KM</option>
											<option value="1,120 KM">1,120 KM</option>
											<option value="1,130 KM">1,130 KM</option>
											<option value="1,140 KM">1,140 KM</option>
											<option value="1,150 KM">1,150 KM</option>
											<option value="1,160 KM">1,160 KM</option>
											<option value="1,170 KM">1,170 KM</option>
											<option value="1,180 KM">1,180 KM</option>
											<option value="1,190 KM">1,190 KM</option>
											<option value="1,200 KM">1,200 KM</option>
											<option value="1,210 KM">1,210 KM</option>
											<option value="1,220 KM">1,220 KM</option>
											<option value="1,230 KM">1,230 KM</option>
											<option value="1,240 KM">1,240 KM</option>
											<option value="1,250 KM">1,250 KM</option>
											<option value="1,260 KM">1,260 KM</option>
											<option value="1,270 KM">1,270 KM</option>
											<option value="1,280 KM">1,280 KM</option>
											<option value="1,290 KM">1,290 KM</option>
											<option value="1,300 KM">1,300 KM</option>
											<option value="1,310 KM">1,310 KM</option>
											<option value="1,320 KM">1,320 KM</option>
											<option value="1,330 KM">1,330 KM</option>
											<option value="1,340 KM">1,340 KM</option>
											<option value="1,350 KM">1,350 KM</option>
											<option value="1,360 KM">1,360 KM</option>
											<option value="1,370 KM">1,370 KM</option>
											<option value="1,380 KM">1,380 KM</option>
											<option value="1,390 KM">1,390 KM</option>
											<option value="1,400 KM">1,400 KM</option>
											<option value="1,410 KM">1,410 KM</option>
											<option value="1,420 KM">1,420 KM</option>
											<option value="1,430 KM">1,430 KM</option>
											<option value="1,440 KM">1,440 KM</option>
											<option value="1,450 KM">1,450 KM</option>
											<option value="1,460 KM">1,460 KM</option>
											<option value="1,470 KM">1,470 KM</option>
											<option value="1,480 KM">1,480 KM</option>
											<option value="1,490 KM">1,490 KM</option>
											<option value="1,500 KM">1,500 KM</option>
											<option value="1,510 KM">1,510 KM</option>
											<option value="1,520 KM">1,520 KM</option>
											<option value="1,530 KM">1,530 KM</option>
											<option value="1,540 KM">1,540 KM</option>
											<option value="1,550 KM">1,550 KM</option>
											<option value="1,560 KM">1,560 KM</option>
											<option value="1,570 KM">1,570 KM</option>
											<option value="1,580 KM">1,580 KM</option>
											<option value="1,590 KM">1,590 KM</option>
											<option value="1,600 KM">1,600 KM</option>
											<option value="1,610 KM">1,610 KM</option>
											<option value="1,620 KM">1,620 KM</option>
											<option value="1,630 KM">1,630 KM</option>
											<option value="1,640 KM">1,640 KM</option>
											<option value="1,650 KM">1,650 KM</option>
											<option value="1,660 KM">1,660 KM</option>
											<option value="1,670 KM">1,670 KM</option>
											<option value="1,680 KM">1,680 KM</option>
											<option value="1,690 KM">1,690 KM</option>
											<option value="1,700 KM">1,700 KM</option>
											<option value="1,710 KM">1,710 KM</option>
											<option value="1,720 KM">1,720 KM</option>
											<option value="1,730 KM">1,730 KM</option>
											<option value="1,740 KM">1,740 KM</option>
											<option value="1,750 KM">1,750 KM</option>
											<option value="1,760 KM">1,760 KM</option>
											<option value="1,770 KM">1,770 KM</option>
											<option value="1,780 KM">1,780 KM</option>
											<option value="1,790 KM">1,790 KM</option>
											<option value="1,800 KM">1,800 KM</option>
											<option value="1,810 KM">1,810 KM</option>
											<option value="1,820 KM">1,820 KM</option>
											<option value="1,830 KM">1,830 KM</option>
											<option value="1,840 KM">1,840 KM</option>
											<option value="1,850 KM">1,850 KM</option>
											<option value="1,860 KM">1,860 KM</option>
											<option value="1,870 KM">1,870 KM</option>
											<option value="1,880 KM">1,880 KM</option>
											<option value="1,890 KM">1,890 KM</option>
											<option value="1,900 KM">1,900 KM</option>
											<option value="1,910 KM">1,910 KM</option>
											<option value="1,920 KM">1,920 KM</option>
											<option value="1,930 KM">1,930 KM</option>
											<option value="1,940 KM">1,940 KM</option>
											<option value="1,950 KM">1,950 KM</option>
											<option value="1,960 KM">1,960 KM</option>
											<option value="1,970 KM">1,970 KM</option>
											<option value="1,980 KM">1,980 KM</option>
											<option value="1,990 KM">1,990 KM</option>
											<option value="2,000 KM">2,000 KM</option>
                                        </select>
                                    </div>
                                </div> 
								<div class="col-2">   
                                    <div class="form-group">
                                        <span>Transport solution</span>
                                        <input type="checkbox"  value="1" id="transport_solution3" name="transport_solution3" class="form-check">
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
										<span>Diesel baht from</span><span style="color:red"> *</span>
                                        <input type="text" name="diesel_baht_from" id="serviceat_diesel_baht_from" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
										<span>Diesel baht to</span><span style="color:red"> *</span>
                                        <input type="text" name="diesel_baht_to" id="serviceat_diesel_baht_to" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
                                <div class="col-2">   
                                    <div class="form-group">
										<span>One way</span><span style="color:red"> *</span>
                                        <input type="text" name="one_way" id="one_way" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
										<span>Round trip</span><span style="color:red"> *</span>
                                        <input type="text" name="round_trip" id="round_trip" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="serviceat_add" data-bs-target="#" >
                                    <i class="fa fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="serviceat_submit" data-bs-target="#" >
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="serviceat_cancel" data-bs-target="#" >
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="serviceat_type" id="serviceat_type">
                                <input type="hidden" name="serviceat_reccode" id="serviceat_reccode">

                            </div>
                        </div>     
                    </form>
                    <table id="serviceat_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
								<th scope="col" width="20%"></th>
								<th scope="col" width="15%">Contract line number</th>
								<th scope="col" width="10%">Vehicle Type</th>
                                <th scope="col" width="10%">Category</th>
                                <th scope="col" width="15%">Commute range with in</th>
								<th scope="col" width="15%">Diesel baht from</th>
                                <th scope="col" width="10%">Diesel baht to</th>
                                <th scope="col" width="15%">One way</th>
                                <th scope="col" width="15%">Round trip</th>
                                <th scope="col" width="10%">Transport solution</th>
                            </tr>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="heavy-tab">
                    <form id="heavy_data">
                        <div id="heavy_edit_area">                   
                            <div class="row"> 
								<div class="col-2">   
									<div class="form-group">
										<span>Contract line number</span><span style="color:red"> *</span>
										<input type="text" name="contract_line4" id="contract_line4" class="form-control" required>
									</div>
								</div>
								<div class="col-4">   
                                    <div class="form-group">
										<span>Location</span><span style="color:red"> *</span>
										<select name="heavy_branch" id="heavy_branch" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        <option value=""></option>
                                        <?php
                                            $fQuery = "SELECT * FROM contract_location_master where active = 1 order by location";
                                            $result_vehicle_type = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_vehicle_type, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['location'];?>"><?php echo $row['location'];?></option>         
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div> 
								<div class="col-3">   
                                    <div class="form-group">
										<span>Vehicle type</span><span style="color:red"> *</span>
										<select name="heavy_equipment" id="heavy_equipment" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        <option value=""></option>
                                        <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_vehicle_type = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_vehicle_type, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
										<span>UOM</span><span style="color:red"> *</span>
										<select name="heavy_uom" id="heavy_uom" class="form-control" aria-describedby="inputGroupPrepend2" required>
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
									<span>Diesel baht from</span><span style="color:red"> *</span>
                                        <input type="text" name="diesel_baht_from" id="heavy_diesel_baht_from" style="text-align:right;" class="form-control" required>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
									<span>Diesel baht to</span><span style="color:red"> *</span>
                                        <input type="text" name="diesel_baht_to" id="heavy_diesel_baht_to" style="text-align:right;" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">   
                                    <div class="form-group">
									<span>Rate/Hour</span><span style="color:red"> *</span>
                                        <input type="text" name="rate" id="rate" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
									<span>Minimum hour</span><span style="color:red"> *</span>
                                        <input type="text" name="minimum_charge_hour" id="minimum_charge_hour" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
									<span>Rate/Day</span><span style="color:red"> *</span>
                                        <input type="text" name="day_rate" id="day_rate" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
									<span>Baht/Ton</span><span style="color:red"> *</span>
                                        <input type="text" name="ton_rate" id="ton_rate" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
                                <div class="col-4">   
                                    <div class="form-group">
										<span>Customer reference</span><span style="color:red"> *</span>
                                        <input type="text" name="customeref" id="customeref" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">   
									<div class="form-group">
                                    <span>Sub5</span><span style="color:red"> *</span><?php //switch transport_operator to service_operator?>
                                        <select name="sub5" id="sub5" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT no_sub_type5, sub_type5, CH FROM FES.dbo.barcode_sub_type5 where CH = 1";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['no_sub_type5'];?>"><?php echo $row['sub_type5']?></option>	
                                            <?php } ?>
                                        </select>
									</div>
								</div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="heavy_add" data-bs-target="#" >
                                    <i class="fa fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="heavy_submit" data-bs-target="#" >
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="heavy_cancel" data-bs-target="#" >
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="heavy_type" id="heavy_type">
                                <input type="hidden" name="heavy_reccode" id="heavy_reccode">

                            </div>
                        </div>     
                    </form>
                    <table id="heavy_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
								<th scope="col" width="20%"></th>
								<th scope="col" width="15%">Contract line number</th>
                                <th scope="col" width="10%">Location</th>
                                <th scope="col" width="15%">Vehicle type</th>
								<th scope="col" width="15%">Diesel baht from</th>
                                <th scope="col" width="10%">Diesel baht to</th>
                                <th scope="col" width="15%">Rate/Hour</th>
                                <th scope="col" width="15%">Minimum hour</th>   
								<th scope="col" width="15%">Rate/Day</th> 
								<th scope="col" width="15%">UOM</th> 
                            </tr>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="hourly-tab">
                    <form id="hourly_data">
                        <div id="hourly_edit_area">                        
                            <div class="row"> 
								<div class="col-3">   
									<div class="form-group">
										<span>Contract line number</span><span style="color:red"> *</span>
										<input type="text" name="contract_line5" id="contract_line5" class="form-control" required>
									</div>
								</div>
                                <div class="col-3">   
                                    <div class="form-group">
									<span>Position</span><span style="color:red"> *</span>
                                        <input type="text" name="manpower_position" id="manpower_position" class="form-control" maxlength="30" required>
                                    </div>
                                </div>
                                <div class="col-3">   
                                    <div class="form-group">
										<span>Universal Position</span><span style="color:red"> *</span>
                                        <select name="universal_position" id="universal_position" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        <option value=""></option>
                                        <?php
                                            $fQuery = "SELECT * FROM position order by sort_id";
                                            $result_position = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_position, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>	              
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <!--<div class="col-2">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select name="type" id="type" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value="Working Days">Working Days</option>
											<option value="Sundays">Sundays</option>
                                        </select>
                                    </div>
                                </div>-->
                
                                <div class="col-3">
                                    <div class="form-group">
										<span>Working Day - Regular Rate/hour</span><span style="color:red"> *</span>
                                        <input type="text" name="normal" id="normal"  class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
										<span>Working Day - OT Rate/hour</span><span style="color:red"> *</span>
                                        <input type="text" name="after_normal" id="after_normal"  class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								<div class="col-3">
                                    <div class="form-group">
										<span>Sunday - Regular Rate/hour</span><span style="color:red"> *</span>
                                        <input type="text" name="s_normal" id="s_normal"  class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
										<span>Sunday - OT Rate/hour</span><span style="color:red"> *</span>
                                        <input type="text" name="s_after_normal" id="s_after_normal"  class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								<div class="col-3">
                                    <div class="form-group">
										<span>Minimum charge(hour)</span><span style="color:red"> *</span>
                                        <input type="text" name="minimum_charge" id="minimum_charge"  class="form-control" style="text-align:right;" >
                                    </div>
                                </div>
                            </div>							

							<div class="row">
								<div class="col-2 close_st">
									<div class="form-group">
										<span>Start shift</span><span style="color:red"> *</span>
										<input type="time" name="start_ship" id="start_ship" class="form-control" required>
									</div>
								</div>
								<div class="col-2 close_st">
									<div class="form-group">
										<span>Start break</span><span style="color:red"> *</span>
										<input type="time" name="start_break" id="start_break" class="form-control" required>
									</div>
								</div>
								<div class="col-2 close_st">
									<div class="form-group">
										<span>End shift</span><span style="color:red"> *</span>
										<input type="time" name="end_ship" id="end_ship" class="form-control" required>
									</div>
								</div>
								<div class="col-3">
                                    <div class="form-group">
										<span>OT rate lump sum</span><span style="color:red"> *</span>
                                        <input type="text" name="ot_lamsam" id="ot_lamsam"  class="form-control" style="text-align:right;" >
                                    </div>
                                </div>
								<div class="col-3">
                                    <div class="form-group">
										<span>Sunday OT rate lump sum</span><span style="color:red"> *</span>
                                        <input type="text" name="sunday_lamsam" id="sunday_lamsam"  class="form-control" style="text-align:right;" >
                                    </div>
                                </div>
							</div>

							<div class="row">
								<div class="col-2">
									<div class="form-group">
										<span>Working day</span> 
									</div>
								</div>
								<div class="col-1">   
                                    <div class="form-group">
                                        <span>Mon</span>
                                        <input type="checkbox"  value="1" id="monday" name="monday" class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Tue</span>
                                        <input type="checkbox"  value="1" id="tuesday" name="tuesday" class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Wed</span>
                                        <input type="checkbox"  value="1" id="wednesday" name="wednesday" class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Thu</span>
                                        <input type="checkbox"  value="1" id="thursday" name="thursday" class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Fri</span>
                                        <input type="checkbox"  value="1" id="friday" name="friday" class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Sat</span>
                                        <input type="checkbox"  value="1" id="saturday" name="saturday" class="form-check">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <span>Sun</span>
                                        <input type="checkbox"  value="1" id="sunday" name="sunday" class="form-check">
                                    </div>
                                </div>
								<div class="col-3">
                                    <div class="form-group">
										<span>lump sum charge rate</span><span style="color:red"> *</span>
                                        <input type="text" name="lamsum_charge_rate" id="lamsum_charge_rate"  class="form-control" style="text-align:right;" >
                                    </div>
                                </div>
								
								
								<!-- <div class="col-2">
                                    <div class="form-group">
                                        <label>Hire type</label>
                                        <select name="type" id="type" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                            <option value="Salary">Salary</option>
											<option value="Wage">Wage</option>
                                        </select>
                                    </div>
                                </div> -->
							</div>

                        </div>
						
                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="hourly_add" data-bs-target="#" >
                                    <i class="fa fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="hourly_submit" data-bs-target="#" >
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="hourly_cancel" data-bs-target="#" >
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="hourly_type" id="hourly_type">
                                <input type="hidden" name="hourly_reccode" id="hourly_reccode">

                            </div>
                        </div>     
                    </form>
                    <table id="hourly_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
								<th scope="col" width="20%"></th>
								<th scope="col" width="15%">Contract line number</th>
                                <th scope="col" width="15%">Position</th>
                                <th scope="col" width="20%">Universal Position</th>
                                <th scope="col" width="15%">Regular Rate/hour</th>
                                <th scope="col" width="15%">OT Rate/hour</th>
								<th scope="col" width="10%">lump sum charge rate</th>
								<th scope="col" width="10%">Working day</th>                     
                            </tr>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>

                </div>

				<div class="tab-pane fade" id="promotion-tab">
                    <form id="promotion_data">
                        <div id="promotion_edit_area">                        
                            <div class="row"> 
								<div class="col-3">   
									<div class="form-group">
										<span>Contract line number</span><span style="color:red"> *</span>
										<input type="text" name="promotion_contract_line" id="promotion_contract_line" class="form-control" required>
									</div>
								</div>
								<div class="col-4">   
									<div class="form-group">
											<span>Description</span><span style="color:red"> *</span>
											<input type="text" name="promotion_description" id="promotion_description" class="form-control" >
									</div>
								</div>              
								<div class="col-3">
                                    <div class="form-group">
										<span>%</span><span style="color:red"> *</span>
                                        <input type="number" name="promotion_discount" id="promotion_discount"  class="form-control" style="text-align:right;" >
                                    </div>
                                </div>
                            </div>					

                        </div>
						
                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="promotion_add" data-bs-target="#" >
                                    <i class="fa fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="promotion_submit" data-bs-target="#" >
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="promotion_cancel" data-bs-target="#" >
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="promotion_type" id="promotion_type">
                                <input type="hidden" name="promotion_reccode" id="promotion_reccode">

                            </div>
                        </div>     
                    </form>
                    <table id="promotion_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
								<th scope="col" width="20%"></th>
								<th scope="col" width="20%">Contract line number</th>
                                <th scope="col" width="30%">Description</th>
                                <th scope="col" width="30%">%</th>
                                
                            </tr>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>
                </div>

				<div class="tab-pane fade" id="taxi-tab">
                    <form id="taxi_data">
                        <div id="taxi_edit_area">                        
                            <div class="row"> 
								<div class="col-2">   
									<div class="form-group">
										<span>Contract line number</span><span style="color:red"> *</span>
										<input type="text" name="taxi_contract_line" id="taxi_contract_line" class="form-control" required>
									</div>
								</div>
								<div class="col-4">   
                                    <div class="form-group">
										<span>Vehicle type</span><span style="color:red"> *</span>
										<select name="taxi_vehicle_type" id="taxi_vehicle_type" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        <option value=""></option>
                                        <?php
                                            $fQuery = "SELECT * FROM vehicle_type order by code";
                                            $result_vehicle_type = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_vehicle_type, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div> 	
								<div class="col-2">   
                                    <div class="form-group">
										<span>Transport rate</span><span style="color:red"> *</span>
                                        <input type="text" name="taxi_rate" id="taxi_rate" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>	
								<div class="col-2">   
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
								<div class="col-2">   
                                    <div class="form-group">
										<span>Customer reference</span><span style="color:red"> *</span>
                                        <input type="text" name="taxi_ref" id="taxi_ref" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-5">   
                                    <div class="form-group">
										<span>Transport from</span><span style="color:red"> *</span>
										<select name="taxi_from" id="taxi_from" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        <option value=""></option>
                                        <?php
                                            $fQuery = "SELECT * FROM contract_location_master where active = 1 order by location";
                                            $result_vehicle_type = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_vehicle_type, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['location'];?>"><?php echo $row['location'];?></option>         
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div> 
								<div class="col-5">   
                                    <div class="form-group">
										<span>Transport to</span><span style="color:red"> *</span>
										<select name="taxi_to" id="taxi_to" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        <option value=""></option>
                                        <?php
                                            $fQuery = "SELECT * FROM contract_location_master where active = 1 order by location";
                                            $result_vehicle_type = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_vehicle_type, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['location'];?>"><?php echo $row['location'];?></option>         
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
															 
								<div class="col-2">   
                                    <div class="form-group">
										<span>Total KM.</span><span style="color:red"> *</span>
                                        <input type="text" name="taxi_total_km" id="taxi_total_km" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
									<span>Diesel baht from</span><span style="color:red"> *</span>
                                        <input type="text" name="taxi_diesel_baht_from" id="taxi_diesel_baht_from" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								<div class="col-2">   
                                    <div class="form-group">
									<span>Diesel baht to</span><span style="color:red"> *</span>
                                        <input type="text" name="taxi_diesel_baht_to" id="taxi_diesel_baht_to" class="form-control" style="text-align:right;" required>
                                    </div>
                                </div>
								
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="taxi_add" data-bs-target="#" >
                                    <i class="fa fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="taxi_submit" data-bs-target="#" >
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="taxi_cancel" data-bs-target="#" >
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="taxi_type" id="taxi_type">
                                <input type="hidden" name="taxi_reccode" id="taxi_reccode">

                            </div>
                        </div>     
                    </form>
					<br>
                    <table id="taxi_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
								<th scope="col" width="20%"></th>
								<th scope="col" width="15%">Contract line number</th>
                                <th scope="col" width="15%">Vehicle type</th>
                                <th scope="col" width="15%">Transport from</th>
                                <th scope="col" width="15%">Transport to</th>
								<th scope="col" width="15%">Transport rate</th>
                                <th scope="col" width="10%">Total KM.</th>
								<th scope="col" width="10%">UOM</th>
								<th scope="col" width="10%">Customer Reference</th>
                            </tr>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>
                </div>

				<div class="tab-pane fade" id="immigration-tab">
                    <form id="immigration_data">
                        <div id="immigration_edit_area">                        
                            <div class="row"> 
								<div class="col-2">   
									<div class="form-group">
										<span>Contract line number</span><span style="color:red"> *</span>
										<input type="text" name="immigration_contract_line" id="immigration_contract_line" class="form-control" required>
									</div>
								</div>
								<div class="col-3">   
									<div class="form-group">
											<span>Description</span><span style="color:red"> *</span>
											<input type="text" name="immigration_description" id="immigration_description" class="form-control" >
									</div>
								</div>              
								<div class="col-2">
                                    <div class="form-group">
										<span>Unit price</span><span style="color:red"> *</span>
                                        <input type="number" name="immigration_unit_price" id="immigration_unit_price"  class="form-control" style="text-align:right;" >
                                    </div>
                                </div>
								<div class="col-3">   
                                    <div class="form-group">
										<span>Location</span><span style="color:red"> *</span>
										<select name="immigration_location" id="immigration_location" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        <option value=""></option>
                                        <?php
                                            $fQuery = "SELECT * FROM location";
                                            $result_location = sqlsrv_query($conn, $fQuery);
                                            while($row = sqlsrv_fetch_array( $result_location, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['description'];?></option>         
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
								<div class="col-2">   
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

                        </div>
						
                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="immigration_add" data-bs-target="#" >
                                    <i class="fa fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="immigration_submit" data-bs-target="#" >
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="immigration_cancel" data-bs-target="#" >
                                    <i class="fa fa-minus-square"></i> Cancel
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
								<th scope="col" width="20%">Contract line number</th>
                                <th scope="col" width="20%">Description</th>
                                <th scope="col" width="15%">Unit price</th>
								<th scope="col" width="15%">UOM</th>
                            </tr>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="warehouse-tab">
                <form id="warehouse_data" class="mt-4 mb-4">
                        <div id="warehouse_data_area" >                        
                            <div class="row"> 
                                <div class="col-2">   
									<div class="form-group">
										<span>Contract line number</span>
										<input type="text" name="contract_line_number" id="warehouse_contract_line_number" class="form-control" >
									</div>
								</div> 
								<div class="col-4">   
									<div class="form-group">
											<span>Description</span><span style="color:red"> *</span>
											<input type="text" name="description" id="warehouse_description" class="form-control" required>
									</div>
								</div>
								
								<div class="col-2">   
									<div class="form-group">
                                        <!-- barcode_service  -->
										<span>Name</span><span style="color:red"> *</span> <?php //switch transport_vehicle to service_vehicle?>
                                        <select name="barcode_service" id="warehouse_barcode_service" class="form-control" aria-describedby="inputGroupPrepend2">
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT no_service, type_service_name, [group] FROM FES.dbo.barcode_service where [group] = 'WH'";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['no_service'];?>"><?php echo $row['type_service_name']?></option>	              
                                            <?php } ?>
                                        </select>
									</div>
								</div>
							
							    <div class="col-2">   
                                    <div class="form-group">
                                        <span>Location</span><span style="color:red"> *</span> <?php //switch transport_vehicle to service_vehicle?>
                                        <select name="barcode_location" id="warehouse_barcode_location" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT no_location, location_name, WH FROM FES.dbo.barcode_location where WH = 1";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option id="<?php echo $row['location_name']?>" value="<?php echo $row['no_location'];?>"><?php echo $row['location_name']?></option>	              
                                            <?php } ?>  
                                        </select>
                                    </div>
                                </div>       

							    <div class="col-2">   
                                    <div class="form-group">
                                        <span>Branch</span><span style="color:red"> *</span> <?php //switch transport_vehicle to service_vehicle?>
                                        <select name="barcode_branch" id="warehouse_barcode_branch" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT code_branch,branch_name FROM FES.dbo.barcode_branch ";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option id="<?php echo $row['code_branch']?>" value="<?php echo $row['code_branch'];?>"><?php echo $row['branch_name']?></option>	              
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>    

								<div class="col-2">   
                                    <div class="form-group">
                                        <span>Type</span><span style="color:red"> *</span><?php //switch transport_operator to service_operator?>
                                        <select name="barcode_type" id="warehouse_barcode_type" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT no_product_type, product_type_name, WH FROM FES.dbo.barcode_product_type where WH = 1";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['no_product_type'];?>"><?php echo $row['product_type_name']?></option>	
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
								<div class="col-2">   
									<div class="form-group">
                                    <span>Sub1</span><span style="color:red"> *</span><?php //switch transport_operator to service_operator?>
                                        <select name="sub1" id="warehouse_sub1" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT no_sub_type1, sub_type1, WH FROM FES.dbo.barcode_sub_type1 where WH = 1";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['no_sub_type1'];?>"><?php echo $row['sub_type1']?></option>	
                                            <?php } ?>
                                        </select>
									</div>
								</div>
								<div class="col-2">   
									<div class="form-group">
                                    <span>Sub3</span><span style="color:red"> *</span><?php //switch transport_operator to service_operator?>
                                        <select name="sub3" id="warehouse_sub3" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT no_sub_type3, sub_type3, WH FROM FES.dbo.barcode_sub_type3 where WH = 1";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['no_sub_type3'];?>"><?php echo $row['sub_type3']?></option>	
                                            <?php } ?>
                                        </select>
									</div>
								</div>
                                <div class="col-2">   
									<div class="form-group">
                                    <span>Sub4</span><span style="color:red"> *</span><?php //switch transport_operator to service_operator?>
                                        <select name="sub4" id="warehouse_sub4" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT no_sub_type4, sub_type4, WH FROM FES.dbo.barcode_sub_type4 where WH = 1";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['no_sub_type4'];?>"><?php echo $row['sub_type4']?></option>	
                                            <?php } ?>
                                        </select>
									</div>
								</div>
                                <div class="col-2">   
									<div class="form-group">
                                    <span>Sub5</span><span style="color:red"> *</span><?php //switch transport_operator to service_operator?>
                                        <select name="sub5" id="warehouse_sub5" class="form-control" aria-describedby="inputGroupPrepend2" >
                                            <option value=""></option>
                                            <?php
                                                $fQuery = "SELECT no_sub_type5, sub_type5, WH FROM FES.dbo.barcode_sub_type5 where WH = 1";
                                                $result = sqlsrv_query($conn, $fQuery);
                                                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>					  
                                                <option value="<?php echo $row['no_sub_type5'];?>"><?php echo $row['sub_type5']?></option>	
                                            <?php } ?>
                                        </select>
									</div>
								</div>
                                <div class="col-2">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Fixed Space</span>
                                        <input type="checkbox"  value="1" id="warehouse_fixed_space" name="fixed_space" class="form-check">
                                    </div>
                                </div>                              
							</div>


                                <div class="row">  
                                    
                                    <div class="col-2">   
                                            <div class="form-group">
                                                <span>UOM</span><span style="color:red"> *</span>
                                                    <select name="uom" id="warehouse_uom" class="form-control" aria-describedby="inputGroupPrepend2" required>
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
                                                <span>Charge per unit</span><span style="color:red"> *</span>
                                                <input type="number" name="charge_per_unit" id="warehouse_charge_per_unit" class="form-control" required >
                                            </div>
                                    </div>

                                    <div class="col-2">   
                                        <div class="form-group">
                                            <span>Minimum Qty</span><span style="color:red"> *</span>
                                            <input type="number" name="minimum_qty" id="warehouse_minimum_qty" class="form-control" required>
                                        </div>
                                    </div>   
                                    
                                    <div class="col-2">   
                                        <div class="form-group">
                                            <span>Minimum Charge Amount</span><span style="color:red"> *</span>
                                            <input type="number" name="minimum_charge_amount" id="warehouse_minimum_charge_amount" class="form-control" required>
                                        </div>
                                    </div>   

								    <div class="col-2">   
										<div class="form-group">
											<span>Customer reference </span>
											<input type="text" name="customer_reference" id="warehouse_customer_reference" class="form-control" >
										</div>
									</div>

                                </div>
                            </div>     

                                

							
                            <div class="row">
                                <div class="col-12">  
                                    <button type="submit" style="width:100px" class="btn btn-success" id="warehouse-submit" data-bs-target="#" onclick="submitform(id)">
                                        <i class="fa fa-plus-square"></i> Save
                                    </button>

                                    <button type="button" style="width:100px" class="btn btn-danger"  id="warehouse-cancel_add" data-bs-target="#" onclick="cancleAddForm(id)">
                                        <i class="fa fa-minus-square"></i> Cancel
                                    </button>
                     

                                    <button type="button" style="display:none" class="btn btn-success" id="warehouse-update" data-bs-target="#" onclick="updateJob(id)">
                                        <i class="fa fa-save"></i> Update
                                    </button>

                                    <button type="button" style="display:none" class="btn btn-danger"  id="warehouse-cancel" data-bs-target="#" onclick="cancleUpdate(id)">
                                        <i class="fa fa-minus-square"></i> Cancel
                                    </button>

                            </div>
                        </div>
                    </form>
                    <button type="button" style="width:100px" class="btn btn-success mt-4 mb-4" id="warehouse-add" data-bs-target="#" onclick="showForm(id)">
                        <i class="fa fa-plus-square"></i> Add
                    </button>
                    <div class="table-responsive">
                      <table id="warehouse_table" class="table table-striped display nowrap ">
                        <thead class="thead-light">
                            <tr>
								<th scope="col" width="10%"></th>
                                <th scope="col" >Contract line number</th>
                                <th scope="col" >Descrption</th>
                                <th scope="col" >name</th>
                                <th scope="col" >Location</th>
                                <th scope="col" >Branch</th>
                                <th scope="col" >Type</th>
                                <th scope="col" >Sub Type 1</th>
                                <th scope="col" >Sub Type 3</th>
                                <th scope="col" >Sub Type 4</th>
                                <th scope="col" >Sub Type 5</th>
                                <th scope="col" >Fixed space</th>
                                <th scope="col" >UOM</th>
                                <th scope="col" >Charge per unit</th>
                                <th scope="col" >Minimum QTY</th>
                                <th scope="col" >Minimum Charge Amount</th>
                                <th scope="col" >Customer reference</th>
                            </tr>
                        </thead>                       
                        <tbody >  
                        </tbody>
                    </table>  
                    </div>
                </div>
            


            <div class="tab-pane fade" id="utilities-tab">
                <form id="utilities_data" class="mt-4  mb-4">
                    <div id="utilities_data_area">
                        <div class="row">

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Contract line number</span>
                                    <input type="text" name="contract_line_number" id="utilities_contract_line_number" class="form-control">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <span>Description</span><span style="color:red"> *</span>
                                    <input type="text" name="description" id="utilities_description" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <!-- barcode_service  -->
                                    <span>Name</span><span style="color:red"> *</span>
                                    <?php //switch transport_vehicle to service_vehicle
                                    ?>
                                    <select name="barcode_service" id="utilities_barcode_service" class="form-control" required
                                        aria-describedby="inputGroupPrepend2">
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
                                    <span>Location</span><span style="color:red"> *</span>
                                    <?php //switch transport_vehicle to service_vehicle
                                    ?>
                                    <select name="barcode_location" id="utilities_barcode_location" class="form-control" required
                                        aria-describedby="inputGroupPrepend2">
                                        <option value=""></option>
                                        <?php
                                        $fQuery = "SELECT no_location, location_name, UT FROM FES.dbo.barcode_location where UT = 1";
                                        $result = sqlsrv_query($conn, $fQuery);
                                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                            <option id="<?php echo $row['location_name'] ?>" value="<?php echo $row['no_location']; ?>">
                                                <?php echo $row['location_name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Branch</span><span style="color:red"> *</span>
                                    <?php //switch transport_vehicle to service_vehicle
                                    ?>
                                    <select name="barcode_branch" id="utilities_barcode_branch" class="form-control" required
                                        aria-describedby="inputGroupPrepend2">
                                        <option value=""></option>
                                        <?php
                                        $fQuery = "SELECT code_branch,branch_name FROM FES.dbo.barcode_branch ";
                                        $result = sqlsrv_query($conn, $fQuery);
                                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                            <option id="<?php echo $row['code_branch'] ?>" value="<?php echo $row['code_branch']; ?>">
                                                <?php echo $row['branch_name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Type</span><span style="color:red"> *</span>
                                    <?php //switch transport_operator to service_operator
                                    ?>
                                    <select name="barcode_type" id="utilities_barcode_type" class="form-control" required
                                        aria-describedby="inputGroupPrepend2">
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
                                    <span>Sub4</span><span style="color:red"> *</span>
                                    <?php //switch transport_operator to service_operator
                                    ?>
                                    <select name="sub4" id="utilities_sub4" class="form-control" required
                                        aria-describedby="inputGroupPrepend2">
                                        <option value=""></option>
                                        <?php
                                        $fQuery = "SELECT no_sub_type4, sub_type4,UT FROM FES.dbo.barcode_sub_type4 where UT = 1";
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
                                    <span>Sub5</span><span style="color:red"> *</span> 
                                    <?php //switch transport_operator to service_operator
                                    ?>
                                    <select name="sub5" id="utilities_sub5" class="form-control" required
                                        aria-describedby="inputGroupPrepend2">
                                        <option value=""></option>
                                        <?php
                                        $fQuery = "SELECT no_sub_type5, sub_type5,UT FROM FES.dbo.barcode_sub_type5 where UT = 1";
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
                                    <span>UOM</span><span style="color:red"> *</span>
                                    <select name="uom" id="utilities_uom" class="form-control" required aria-describedby="inputGroupPrepend2"
                                        required>
                                        <option value=""></option>
                                        <?php
                                        $fQuery = "SELECT * FROM uom";
                                        $result_uom = sqlsrv_query($conn, $fQuery);
                                        while ($row = sqlsrv_fetch_array($result_uom, SQLSRV_FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row['code']; ?>">
                                                <?php echo $row['description']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Charge per unit</span><span style="color:red"> *</span>
                                    <input type="number" name="charge_per_unit" id="utilities_charge_per_unit" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Minimum Qty</span><span style="color:red"> *</span>
                                    <input type="number" name="minimum_qty" id="utilities_minimum_qty" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Minimum Charge Amount</span><span style="color:red"> *</span>
                                    <input type="number" name="minimum_charge_amount" id="utilities_minimum_charge_amount"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Customer reference </span>
                                    <input type="text" name="customer_reference" id="utilities_customer_reference"
                                        class="form-control">
                                </div>
                            </div>

                            

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" style="width:100px" class="btn btn-success" id="utilities-submit"
                                data-bs-target="#" onclick="submitform(id)">
                                <i class="fa fa-plus-square"></i> Save
                            </button>

                                                <button type="button" style="width:100px" class="btn btn-danger"  id="utilities-cancel_add" data-bs-target="#" onclick="cancleAddForm(id)">
                                                    <i class="fa fa-minus-square"></i> Cancel
                                                </button>
                                

                                                <button type="button" style="display:none" class="btn btn-success" id="utilities-update" data-bs-target="#" onclick="updateJob(id)">
                                                    <i class="fa fa-save"></i> Update
                                                </button>

                                                <button type="button" style="display:none" class="btn btn-danger"  id="utilities-cancel" data-bs-target="#" onclick="cancleUpdate(id)">
                                                    <i class="fa fa-minus-square"></i> Cancel
                                                </button>


                            <!-- <input type="hidden" name="service_type" id="service_type">
                                            <input type="hidden" name="service_reccode" id="service_reccode"> -->

                        </div>
                    </div>
                </form>
                <button type="button" style="width:100px" class="btn btn-success mt-4 mb-4" id="utilities-add" data-bs-target="#" onclick="showForm(id)">
                                    <i class="fa fa-plus-square"></i> Add
                </button>
                <div class="table-responsive">
                    <table id="utilities_table" class="table table-striped display nowrap " style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="10%"></th>
                                <th scope="col">Contract line number</th>
                                <th scope="col">Descrption</th>
                                <th scope="col">name</th>
                                <th scope="col">Location</th>
                                <th scope="col">Branch</th>
                                <th scope="col">Type</th>
                                <th scope="col">Sub Type 4</th>
                                <th scope="col">Sub Type 5</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Charge per unit</th>
                                <th scope="col">Minimum QTY</th>
                                <th scope="col">Minimum Charge Amount</th>
                                <th scope="col">Customer reference</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

 
            <div class="tab-pane fade" id="retal-tab">
                <form id="retal_data" class="mt-4 mb-4">
                    <div id="retal_data_area">
                        <div class="row">

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Contract line number</span>
                                    <input type="text" name="contract_line_number" id="retal_contract_line_number" class="form-control">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <span>Description</span><span style="color:red"> *</span>
                                    <input type="text" name="description" id="retal_description" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <!-- barcode_service  -->
                                    <span>Name</span><span style="color:red"> *</span>
                                    <?php //switch transport_vehicle to service_vehicle
                                    ?>
                                    <select name="barcode_service" id="retal_barcode_service" class="form-control"
                                        aria-describedby="inputGroupPrepend2">
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

                            <div class="col-3">
                                <div class="form-group">
                                    <span>Location</span><span style="color:red"> *</span>
                                    <?php //switch transport_vehicle to service_vehicle
                                    ?>
                                    <select name="barcode_location" id="retal_barcode_location" class="form-control"
                                        aria-describedby="inputGroupPrepend2">
                                        <option value=""></option>
                                        <?php
                                        $fQuery = "SELECT no_location, location_name, RN FROM FES.dbo.barcode_location where RN = 1";
                                        $result = sqlsrv_query($conn, $fQuery);
                                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                            <option id="<?php echo $row['location_name'] ?>" value="<?php echo $row['no_location']; ?>">
                                                <?php echo $row['location_name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-2">
                                <div class="form-group">
                                    <span>Sub3</span><span style="color:red"> *</span>
                                    <?php //switch transport_operator to service_operator
                                    ?>
                                    <select name="sub3" id="retal_sub3" class="form-control"
                                        aria-describedby="inputGroupPrepend2">
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
                                    <span>Sub4</span><span style="color:red"> *</span>
                                    <?php //switch transport_operator to service_operator
                                    ?>
                                    <select name="sub4" id="retal_sub4" class="form-control"
                                        aria-describedby="inputGroupPrepend2">
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
                                    <span>Sub5</span><span style="color:red"> *</span>
                                    <?php //switch transport_operator to service_operator
                                    ?>
                                    <select name="sub5" id="retal_sub5" class="form-control"
                                        aria-describedby="inputGroupPrepend2">
                                        <option value=""></option>
                                        <?php
                                        $fQuery = "SELECT no_sub_type5, sub_type5,RN FROM FES.dbo.barcode_sub_type5 where RN = 1";
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
                                    <span>UOM</span><span style="color:red"> *</span>
                                    <select name="uom" id="retal_uom" class="form-control" aria-describedby="inputGroupPrepend2"
                                        required>
                                        <option value=""></option>
                                        <?php
                                        $fQuery = "SELECT * FROM uom";
                                        $result_uom = sqlsrv_query($conn, $fQuery);
                                        while ($row = sqlsrv_fetch_array($result_uom, SQLSRV_FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row['code']; ?>">
                                                <?php echo $row['description']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Charge per unit</span><span style="color:red"> *</span>
                                    <input type="number" name="charge_per_unit" id="retal_charge_per_unit" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Minimum Qty</span><span style="color:red"> *</span>
                                    <input type="number" name="minimum_qty" id="retal_minimum_qty" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Minimum Charge Amount</span><span style="color:red"> *</span>
                                    <input type="number" name="minimum_charge_amount" id="retal_minimum_charge_amount"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Customer reference </span>
                                    <input type="text" name="customer_reference" id="retal_customer_reference"
                                        class="form-control">
                                </div>
                            </div>

                            

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" style="width:100px" class="btn btn-success" id="retal-submit"
                                data-bs-target="#" onclick="submitform(id)">
                                <i class="fa fa-plus-square"></i> Save
                            </button>

                                                <button type="button" style="width:100px" class="btn btn-danger"  id="retal-cancel_add" data-bs-target="#" onclick="cancleAddForm(id)">
                                                    <i class="fa fa-minus-square"></i> Cancel
                                                </button>
                                

                                                <button type="button" style="display:none" class="btn btn-success" id="retal-update" data-bs-target="#" onclick="updateJob(id)">
                                                    <i class="fa fa-save"></i> Update
                                                </button>

                                                <button type="button" style="display:none" class="btn btn-danger"  id="retal-cancel" data-bs-target="#" onclick="cancleUpdate(id)">
                                                    <i class="fa fa-minus-square"></i> Cancel
                                                </button>


                            <!-- <input type="hidden" name="service_type" id="service_type">
                                            <input type="hidden" name="service_reccode" id="service_reccode"> -->

                        </div>
                    </div>
                </form>
                <button type="button" style="width:100px" class="btn btn-success mt-4 mb-4" id="retal-add" data-bs-target="#" onclick="showForm(id)">
                                    <i class="fa fa-plus-square"></i> Add
                </button>
                <div class="table-responsive">
                    <table id="retal_table" class="table table-striped display nowrap ">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="10%"></th>
                                <th scope="col">Contract line number</th>
                                <th scope="col">Descrption</th>
                                <th scope="col">name</th>
                                <th scope="col">Location</th>
                                <th scope="col">Sub Type 3</th>
                                <th scope="col">Sub Type 4</th>
                                <th scope="col">Sub Type 5</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Charge per unit</th>
                                <th scope="col">Minimum QTY</th>
                                <th scope="col">Minimum Charge Amount</th>
                                <th scope="col">Customer reference</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="hotelbooking-tab">
                <form id="hotelbooking_data" class="mt-4 mb-4">
                    <div id="hotelbooking_data_area">
                        <div class="row">

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Contract line number</span>
                                    <input type="text" name="contract_line_number" id="hotelbooking_contract_line_number" class="form-control">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <span>Description</span><span style="color:red"> *</span>
                                    <input type="text" name="description" id="hotelbooking_description" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <!-- barcode_service  -->
                                    <span>Hotel Name</span><span style="color:red"> *</span>
                                    <?php //switch transport_vehicle to service_vehicle
                                    ?>
                                    <select name="hotel_name" id="hotelbooking_hotel_name" class="form-control"
                                        aria-describedby="inputGroupPrepend2">
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

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Price from Date</span><span style="color:red"> *</span>
                                    <input type="date" name="price_from_date" id="hotelbooking_price_from_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Price to Date</span><span style="color:red"> *</span>
                                    <input type="date" name="price_to_date" id="hotelbooking_price_to_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Type</span><span style="color:red"> *</span>
                                    <?php //switch transport_operator to service_operator
                                    ?>
                                    <select name="barcode_type" id="hotelbooking_barcode_type" class="form-control"
                                        aria-describedby="inputGroupPrepend2">
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
                                    <span>Sub4</span><span style="color:red"> *</span>
                                    <?php //switch transport_operator to service_operator
                                    ?>
                                    <select name="sub4" id="hotelbooking_sub4" class="form-control"
                                        aria-describedby="inputGroupPrepend2">
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
                                    <span>Sub5</span><span style="color:red"> *</span>
                                    <?php //switch transport_operator to service_operator
                                    ?>
                                    <select name="sub5" id="hotelbooking_sub5" class="form-control"
                                        aria-describedby="inputGroupPrepend2">
                                        <option value=""></option>
                                        <?php
                                        $fQuery = "SELECT no_sub_type5, sub_type5,BS FROM FES.dbo.barcode_sub_type5 where BS = 1";
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
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Meal included</span>
                                        <input type="checkbox"  value="1" id="hotelbooking_meal_included" name="meal_included" class="form-check">
                                    </div>
                            </div>
                            
                            <div class="col-2">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">Laundry included</span>
                                        <input type="checkbox"  value="1" id="hotelbooking_laundry_included" name="laundry_included" class="form-check">
                                    </div>
                            </div>      

                                
                            <div class="col-2">
                                <div class="form-group">
                                    <span>UOM</span><span style="color:red"> *</span>
                                    <select name="uom" id="hotelbooking_uom" class="form-control" aria-describedby="inputGroupPrepend2"
                                        required>
                                        <option value=""></option>
                                        <?php
                                        $fQuery = "SELECT * FROM uom";
                                        $result_uom = sqlsrv_query($conn, $fQuery);
                                        while ($row = sqlsrv_fetch_array($result_uom, SQLSRV_FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row['code']; ?>">
                                                <?php echo $row['description']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Charge per unit</span><span style="color:red"> *</span>
                                    <input type="number" name="charge_per_unit" id="hotelbooking_charge_per_unit" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Minimum Qty</span><span style="color:red"> *</span>
                                    <input type="number" name="minimum_qty" id="hotelbooking_minimum_qty" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Minimum Charge Amount</span><span style="color:red"> *</span>
                                    <input type="number" name="minimum_charge_amount" id="hotelbooking_minimum_charge_amount"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Customer reference </span>
                                    <input type="text" name="customer_reference" id="hotelbooking_customer_reference"
                                        class="form-control">
                                </div>
                            </div>

                            

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" style="width:100px" class="btn btn-success" id="hotelbooking-submit"
                                data-bs-target="#" onclick="submitform(id)">
                                <i class="fa fa-plus-square"></i> Save
                            </button>

                                                <button type="button" style="width:100px" class="btn btn-danger"  id="hotelbooking-cancel_add" data-bs-target="#" onclick="cancleAddForm(id)">
                                                    <i class="fa fa-minus-square"></i> Cancel
                                                </button>
                                

                                                <button type="button" style="display:none" class="btn btn-success" id="hotelbooking-update" data-bs-target="#" onclick="updateJob(id)">
                                                    <i class="fa fa-save"></i> Update
                                                </button>

                                                <button type="button" style="display:none" class="btn btn-danger"  id="hotelbooking-cancel" data-bs-target="#" onclick="cancleUpdate(id)">
                                                    <i class="fa fa-minus-square"></i> Cancel
                                                </button>


                            <!-- <input type="hidden" name="service_type" id="service_type">
                                            <input type="hidden" name="service_reccode" id="service_reccode"> -->

                        </div>
                    </div>
                </form>
                <button type="button" style="width:100px" class="btn btn-success mt-4 mb-4" id="hotelbooking-add" data-bs-target="#" onclick="showForm(id)">
                                    <i class="fa fa-plus-square"></i> Add
                </button>
                <div class="table-responsive">
                    <table id="hotelbooking_table" class="table table-striped display nowrap ">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="10%"></th>
                                <th scope="col">Contract line number</th>
                                <th scope="col">Descrption</th>
                                <th scope="col">Hotel name</th>
                                <th scope="col">Price From Date</th>
                                <th scope="col">Price To Date</th>
                                <th scope="col">Type</th>
                                <th scope="col">Sub Type 4</th>
                                <th scope="col">Sub Type 5</th>
                                <th scope="col">Meal included</th>
                                <th scope="col">Laundry included</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Charge per unit</th>
                                <th scope="col">Minimum QTY</th>
                                <th scope="col">Minimum Charge Amount</th>
                                <th scope="col">Customer reference</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="ticketbooking-tab">
                <form id="ticketbooking_data" class="mt-4 mb-4">
                    <div id="ticketbooking_data_area">
                        <div class="row">

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Contract line number</span>
                                    <input type="text" name="contract_line_number" id="ticketbooking_contract_line_number" class="form-control">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <span>Description</span><span style="color:red"> *</span>
                                    <input type="text" name="description" id="ticketbooking_description" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Flight number</span><span style="color:red"> *</span>
                                    <input type="text" name="flight_number" id="ticketbooking_flight_number" class="form-control" required>
                                   
                                </div>
                            </div>

                            <div class="col-2">   
                                    <div class="form-group">
                                        <span>Destination Date</span><span style="color:red"> *</span>
                                        <input type="date" name="destination_date" id="ticketbooking_destination_date" class="form-control" required>
                                    </div>
                                </div>


                                <div class="col-2">   
                                    <div class="form-group">
                                        <span>Destination</span><span style="color:red"> *</span>
                                        <input type="text" name="destination" id="ticketbooking_destination" class="form-control" required>
                                    </div>
                                </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Type</span><span style="color:red"> *</span>
                                    <?php //switch transport_operator to service_operator
                                    ?>
                                    <select name="barcode_type" id="ticketbooking_barcode_type" class="form-control"
                                        aria-describedby="inputGroupPrepend2">
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
                                    <span>Sub4</span><span style="color:red"> *</span>
                                    <?php //switch transport_operator to service_operator
                                    ?>
                                    <select name="sub4" id="ticketbooking_sub4" class="form-control"
                                        aria-describedby="inputGroupPrepend2">
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
                                    <span>Sub5</span><span style="color:red"> *</span>
                                    <?php //switch transport_operator to service_operator
                                    ?>
                                    <select name="sub5" id="ticketbooking_sub5" class="form-control"
                                        aria-describedby="inputGroupPrepend2">
                                        <option value=""></option>
                                        <?php
                                        $fQuery = "SELECT no_sub_type5, sub_type5,BS FROM FES.dbo.barcode_sub_type5 where BS = 1";
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
                                    <!-- barcode_service  -->
                                    <span>Airline name</span><span style="color:red"> *</span>
                                    <select name="airline_name" id="ticketbooking_airline_name" class="form-control" required
                                        aria-describedby="inputGroupPrepend2">
                                        <option value=""></option>
                                        <?php
                                        $fQuery = "SELECT * from air_line";
                                        $result = sqlsrv_query($conn, $fQuery);
                                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row['air_line_name']; ?>">
                                                <?php echo $row['air_line_name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                    <div class="form-group d-flex flex-column " style="height:100%;">
                                        <span class="mb-3">With Luggage</span>
                                        <input type="checkbox"  value="1" id="ticketbooking_with_luggage" name="with_luggage" class="form-check">
                                    </div>
                            </div>      

                                
                            <div class="col-2">
                                <div class="form-group">
                                    <span>UOM</span><span style="color:red"> *</span>
                                    <select name="uom" id="ticketbooking_uom" class="form-control" aria-describedby="inputGroupPrepend2"
                                        required>
                                        <option value=""></option>
                                        <?php
                                        $fQuery = "SELECT * FROM uom";
                                        $result_uom = sqlsrv_query($conn, $fQuery);
                                        while ($row = sqlsrv_fetch_array($result_uom, SQLSRV_FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row['code']; ?>">
                                                <?php echo $row['description']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Charge per unit</span><span style="color:red"> *</span>
                                    <input type="number" name="charge_per_unit" id="ticketbooking_charge_per_unit" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Minimum Qty</span><span style="color:red"> *</span>
                                    <input type="number" name="minimum_qty" id="ticketbooking_minimum_qty" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <span>Minimum Charge Amount</span><span style="color:red"> *</span>
                                    <input type="number" name="minimum_charge_amount" id="ticketbooking_minimum_charge_amount"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <span>Customer reference </span>
                                    <input type="text" name="customer_reference" id="ticketbooking_customer_reference"
                                        class="form-control">
                                </div>
                            </div>

                            

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" style="width:100px" class="btn btn-success" id="ticketbooking-submit"
                                data-bs-target="#" onclick="submitform(id)">
                                <i class="fa fa-plus-square"></i> Save
                            </button>

                                                <button type="button" style="width:100px" class="btn btn-danger"  id="ticketbooking-cancel_add" data-bs-target="#" onclick="cancleAddForm(id)">
                                                    <i class="fa fa-minus-square"></i> Cancel
                                                </button>
                                

                                                <button type="button" style="display:none" class="btn btn-success" id="ticketbooking-update" data-bs-target="#" onclick="updateJob(id)">
                                                    <i class="fa fa-save"></i> Update
                                                </button>

                                                <button type="button" style="display:none" class="btn btn-danger"  id="ticketbooking-cancel" data-bs-target="#" onclick="cancleUpdate(id)">
                                                    <i class="fa fa-minus-square"></i> Cancel
                                                </button>


                            <!-- <input type="hidden" name="service_type" id="service_type">
                                            <input type="hidden" name="service_reccode" id="service_reccode"> -->

                        </div>
                    </div>
                </form>
                <button type="button" style="width:100px" class="btn btn-success mt-4 mb-4" id="ticketbooking-add" data-bs-target="#" onclick="showForm(id)">
                                    <i class="fa fa-plus-square"></i> Add
                </button>
                <div class="table-responsive">
                    <table id="ticketbooking_table" class="table table-striped display nowrap " style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="10%"></th>
                                <th scope="col">Contract line number</th>
                                <th scope="col">Descrption</th>
                                <th scope="col">Flight Number</th>
                                <th scope="col">Type</th>
                                <th scope="col">Sub Type 4</th>
                                <th scope="col">Sub Type 5</th>
                                <th scope="col">Airline name</th>
                                <th scope="col">With luggage</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Charge per unit</th>
                                <th scope="col">Minimum QTY</th>
                                <th scope="col">Minimum Charge Amount</th>
                                <th scope="col">Customer reference</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>



                <!-- END -->


                
            </div>          
            
        </div>
            <!-- <div class="card-body">  
            <ul class="nav nav-tabs" role="tablist"> -->
                <!--<li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#location-tab" id="location-nav">Location</a>
                </li>-->
                <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#nonworking-tab" id="nonworking-nav">Non-working date table</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#overtime-tab" id="overtime-nav">Overtime charge rates</a>
                </li> -->
                <!--<li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#working-tab" id="working-nav">Working day by position</a>
                </li>-->

            <!-- </ul> -->
            <!-- <div class="tab-content"> -->
                <!-- <div class="tab-pane fade" id="location-tab">
					<br>
                    <form id="location_data">
                        <div id="location_edit_area">                        
                            <div class="row">  
                                <div class="col-3">   
                                    <div class="form-group">
                                    <label>Location</label>
                                        <input type="text" name="location" id="location" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-3">   
                                    <div class="form-group">
                                        <label>Universal location</label>
										<select name="universal_location" id="universal_location" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        <option value=""></option>
                                        <?php
                                            // $fQuery = "SELECT * FROM location";
                                            // $result_location = sqlsrv_query($conn, $fQuery);
                                            // while($row = sqlsrv_fetch_array( $result_location, SQLSRV_FETCH_ASSOC)) {
                                                ?>					  
                                            <option value="
                                            <?php 
                                            // echo $row['code'];
                                            ?>"><?php 
                                            // echo $row['description'];
                                            ?>
                                            </option>         
                                        <?php 
                                        // }
                                     ?>
                                        </select>
                                    </div>
                                </div> 
								<div class="col-2">   
                                    <div class="form-group">
                                        <label>Sub location</label>
										<select name="sub_location" id="sub_location" class="form-control" aria-describedby="inputGroupPrepend2">
                                        <option value=""></option>
                                        <?php
                                            // $fQuery = "SELECT * FROM sub_location order by sort_id";
                                            // $result_location = sqlsrv_query($conn, $fQuery);
                                            // while($row = sqlsrv_fetch_array( $result_location, SQLSRV_FETCH_ASSOC)) {
                                                ?>					  
                                            <option value="
                                            <?php 
                                            // echo $row['code'];?>"><?php
                                            //  echo $row['description'];
                                            ?>
                                        </option>         
                                        <?php
                                        //  } 
                                        ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Contact 1</label>
                                        <input type="text" name="contact1" id="contact1"  class="form-control" >
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Tel</label>
                                        <input type="text" name="tel1" id="tel1"  class="form-control" >
                                    </div>
                                </div>
								<div class="col-2">
                                    <div class="form-group">
                                        <label>Contact 2</label>
                                        <input type="text" name="contact2" id="contact2"  class="form-control" >
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Tel</label>
                                        <input type="text" name="tel2" id="tel2"  class="form-control" >
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="location_add" data-bs-target="#" >
                                    <i class="fa fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="location_submit" data-bs-target="#" >
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="location_cancel" data-bs-target="#" >
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="location_type" id="location_type">
                                <input type="hidden" name="location_reccode" id="location_reccode">

                            </div>
                        </div>     
                    </form>
                    <table id="location_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
								<th scope="col" width="20%"></th>
                                <th scope="col" width="15%">Location</th>
                                <th scope="col" width="15%">Universal location</th>
								<th scope="col" width="15%">Sub location</th>
                                <th scope="col" width="15%">Contact 1</th>
                                <th scope="col" width="10%">Tel</th>
                                <th scope="col" width="15%">Contact 2</th>
                                <th scope="col" width="10%">Tel</th>
                                
                            </tr>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>
                </div>  
                <div class="tab-pane fade" id="nonworking-tab">
					<br>
                    <form id="nonworking_data">
                        <div id="nonworking_edit_area">
                        
                            <div class="row">  
                                <div class="col-2">   
                                    <div class="form-group">
                                    <label>Non-working date</label>
                                        <input type="date" name="non_working_date" id="non_working_date" class="form-control" required>
                                    </div>
                                </div>                
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Holiday Name</label>
                                        <input type="text" name="holiday_name" id="holiday_name"  class="form-control" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">  
                                <button type="button" style="width:100px" class="btn btn-success" id="nonworking_add" data-bs-target="#" >
                                    <i class="fa fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="nonworking_submit" data-bs-target="#" >
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="nonworking_cancel" data-bs-target="#" >
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="nonworking_type" id="nonworking_type">
                                <input type="hidden" name="nonworking_reccode" id="nonworking_reccode">

                            </div>
                        </div>     
                    </form>
                    <table id="nonworking_table" class="table table-striped display nowrap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
								<th scope="col" width="20%"></th>
                                <th scope="col" width="40%">Non-working date</th>
                                <th scope="col" width="40%">Holiday Name</th>
                                
                            </tr>
                        </thead>                       
                        <tbody>  
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane active" id="overtime-tab">
                    <br>
                    <form id="overtime_data">
                        <div class="row">  
                            <div class="col-4">   
                                <div class="form-group">
                                    <label>OT on normal day outside regular hours</label>
                                    <input type="number" maxlength="1" name="monday_friday" id="monday_friday" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">   
                                <div class="form-group">
                                    <label>OT on day off first 8 hour</label>
                                    <input type="number" maxlength="1" name="sunday_8" id="sunday_8" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>OT on day off after 8 hour</label>
                                    <input type="number" maxlength="1" name="sunday_17" id="sunday_17" class="form-control">
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <br>
                                    <button style="width:100px" type="button" class="btn btn-success" id="overtime_save" data-bs-target="#" >
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>              
                </div> -->
                <!--<div class="tab-pane fade" id="working-tab">

                <br>
                    <form id="working_data">
                        <div id="working_edit_area">
                        
                            <div class="row">  
                                <div class="col-3">   
                                    <div class="form-group">
                                    <label>Position</label>
                                        <select name="working_position" id="working_position" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                        <option value=""></option>
                                        <?php
                                            // $contract_no = $_GET['contract_no'];
                                            // $fQuery = "SELECT * FROM contract_hourly_rate WHERE contract_no = '$contract_no'";
                                            // $result_working_position = sqlsrv_query($conn, $fQuery);
                                            // while($row = sqlsrv_fetch_array( $result_working_position, SQLSRV_FETCH_ASSOC)) {?>					  
                                            <option value="
                                            <?php 
                                            // echo $row['position'];
                                            ?>
                                            ">
                                            <?php 
                                            // echo $row['position'];
                                            ?>
                                        </option>	              
                                        <?php 
                                    // }
                                     ?>
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
                                <button type="button" style="width:100px" class="btn btn-success" id="working_add" data-bs-target="#" >
                                    <i class="fa fa-plus-square"></i> Add
                                </button>

                                <button type="submit" style="width:100px" class="btn btn-success" id="working_submit" data-bs-target="#" >
                                    <i class="fa fa-save"></i> Save
                                </button>

                                <button type="button" style="width:100px" class="btn btn-danger"  id="working_cancel" data-bs-target="#" >
                                    <i class="fa fa-minus-square"></i> Cancel
                                </button>

                                <input type="hidden" name="working_type" id="working_type">
                                <input type="hidden" name="working_reccode" id="working_reccode">

                            </div>
                        </div>     
                    </form>
                    <table id="working_table" class="table table-striped display nowrap" style="width: 100%;">
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
                </div>-->
            <!-- </div> -->
            <!-- </div> -->
    </div>
</div>


<input required type="hidden" name="form_type" id="form_type">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
    $('input[type="number"]').css( "text-align","right");
    function load_contract(contract_no){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract.php?contract_no='+contract_no,
            success: function(data) {
                $('#contract_no').val(data.contract_no);
				$('#erp_contract_no').val(data.erp_contract_no);
                $('#contract_date').val(data.contract_date);
				$('#start_date').val(data.start_date);
                $('#end_date').val(data.end_date);
				$('#customer').val(data.customer);
				$('#customer').attr('readonly', true);

				$('#customer_no').val(data.customer);
				$('#customer_ref').val(data.customer_ref);
                $('#status').val(data.status);
				$('#payment_term').val(data.payment_term);

                $('#active').prop('checked', data.active);
                $('#pay_cash').prop('checked', data.pay_cash);
                $('#diesel').prop('checked', data.diesel);
                $('#rounding').prop('checked', data.rounding);

				$('#monday_friday').val(data.monday_friday);
                $('#sunday_8').val(data.sunday_8);
				$('#sunday_17').val(data.sunday_17);

                $('#diesel1').val(data.diesel1);
                $('#diesel2').val(data.diesel2);
                $('#diesel3').val(data.diesel3);
                $('#rounding1').val(data.rounding1);
				$('#round_trip_rate').val(data.round_trip_rate);
				$('#create_date').val(data.create_date);
				$('#create_date').attr('readonly', true);

				//get_location(data.customer,data.contract_no);   
            }
        });
        //$('#contract_no').attr('readonly', true);
        $("#vehicle_submit").prop("disabled",false);
        $("#sub_data").show();

        $('[href="#overtime-tab"]').tab('show');
        $('[href="#transportation-tab"]').tab('show');

        $("#location_add").show();
        $("#location_edit_area").fadeOut();
        $("#location_submit").hide();
        $("#location_cancel").hide();

        if($("#form_type").val()!="")
            $("#transportation_add").show();
        $("#transportation_edit_area").hide();
        $("#transportation_submit").hide();
        $("#transportation_cancel").hide();
        
		setTimeout(load_location, 1000);
        setTimeout(load_transportation, 1000);

    }

	$("#customer").on("change",function(){
        var selectedValue = $(this).val();
        const codeCustomer = document.getElementById('customer_no');
        if(codeCustomer){
            codeCustomer.value = selectedValue;
        }

        //get_location($("#customer").val(),$("#contract_no").val());
    });
    

    function clear_data(){
        $('form#contract_data input:checkbox').prop('checked', false);
        $('form#contract_data input:text').val('');
        $('form#contract_data input[type="number"]').val('');
        $('form#contract_data input[type="date"]').val('');
        $('form#contract_data select').val('');
        $("#contract_submit").prop("disabled",false);
    }

	async function get_location(customer_id,contract_no){
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_location.php?customer='+customer_id+'&contract_no='+contract_no,
            success: function(data) {
                var $el = $("#transportation_from");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });

                var $el = $("#transportation_to");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });

				var $el = $("#heavy_branch");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", "").text(""));
                $.each(data, function(key,value) {
                    $el.append($("<option></option>")
                    .attr("value", key).text(value));
                });

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

    $("#menu-contract a.nav-link").on('click', function(event) {
            const tabId = $(this).attr('id');
            var form = tabId.split("-");
            $("#"+form[0]+"_data").hide();
            $("#"+form[0]+"-add").show();
        $('#'+form[0]+'_contract_line_number').attr('readonly', false);

            // if(tabId == 'warehouse-nav'){
            //   getDatatoTable(tabId);  
            // }
            // if(tabId == 'utilities-nav'){
              getDatatoTable(tabId);  
            // }
            
    });

    function showForm(id){
        var form = id.split("-");
        $("#"+form[0]+"_data").show();
        $("#"+form[0]+"-add").hide();
        cancleUpdate(id)
    }

    function cancleAddForm(t){
        var form = t.split('-');
        $("#"+form[0]+"_data").hide();
        $("#"+form[0]+"-add").show();
    }

    function cancleUpdate(t){
        var tab = t.split('-');
        document.getElementById(tab[0] + "_data").reset();
        $('#'+tab[0]+'_contract_line_number').attr('readonly', false);
                        
        $('#'+tab[0]+"-update").hide();
        $('#'+tab[0]+"-cancel").hide();
        $('#'+tab[0]+"-submit").show();
        $('#'+tab[0]+"-cancel_add").show();

    }

    function updateJob(id){
        var formName = id.split('-');
        
        if(formName[0]){ 
                 var name = '#'+formName[0]+'_data';
                 var $form = $(name);
                 var dataForm = getFormData($form);
            
                 const formid = document.getElementById(formName[0]+'_data');
                 const checkRq = formid.querySelectorAll('[required]');
                 let allFieldsValid = true;
                 checkRq.forEach((field) => {
                        if (!field.value) {  // เช็คว่ามีค่าในฟิลด์หรือไม่
                            allFieldsValid = false;
                            field.classList.add('border','border-danger');
                        }else{
                            field.classList.remove('border', 'border-danger');
                        }
                 });
                 if( allFieldsValid == true){
                         const checkboxes = formid.querySelectorAll('input[type="checkbox"]');
                        checkboxes.forEach(checkbox => {
                    if(!checkbox.checked){
                        dataForm[checkbox.name] = null;
                    }
                    });
                    const customer_code = document.getElementById('customer_no');

                    var obj = {
                        type: formName[0],
                        data: dataForm,
                        customer_id:customer_code.value
                    }; 
                    if(obj){
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
                                    url: 'api/update_details_contract.php',
                                    success: function(res) {
                                        if(res.status == 1) {
                                            swal({
                                            icon: "success",
                                            text: "Update success",
                                            timer: 2000,
                                            buttons: false,
                                            });
                                            document.getElementById(formName[0] + "_data").reset();

                                            get_Details(res.id,formName[0])
                                            getDatatoTable(id)
                                        }
                                        else if (res.status == 0) {
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
                 }else{
                    swal({
                        icon: "warning",
                        text: "Please fill out the information completely.",
                        timer: 3000,
                        buttons: false,
                    });
                 }
        }    
    }

    function submitform(formname){
        var formName = formname.split("-");
        if(formName){
            var name = '#'+formName[0]+'_data';
            $(name).submit(function(e) {
                 e.preventDefault();
                 var $form = $(name);
                 var dataForm = getFormData($form);
                 const customer_code = document.getElementById('customer_no');
                 if(customer_code.value){
                    dataForm['customer_code'] = customer_code.value; 
                    const obj = {
                    name:formName[0],
                    data:dataForm
                    }
                    if(obj){
                         swal({
                            icon: "warning",
                            text: "Save data ?",
                            buttons: true, // แสดงปุ่ม "OK"
                        }).then((willProceed) => { 
                            if(willProceed){
                            $.ajax({
                                type: 'POST',
                                dataType: "json",
                                data: obj,
                                url: 'api/insert_job_contract.php',
                                success: function(res) {
                                    if(res.status == 1) {
                                        swal({
                                        icon: "success",
                                        text: res.msg,
                                        timer: 2000,
                                        buttons: false,
                                        }).then(() =>{
                                            getDatatoTable(formname)
                                        });
                                       
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
                                            // location.reload();
                                        }, 3100);
                                    }
                                } 				
                            });
                            }
                        });
                    }
                   
                  
                 }
            })
        }    
    }

    function getDatatoTable(tab){
        var tabName = tab.split('-');
        var tabtable = tabName[0]+'_table';
        var divTable =  document.getElementById(tabtable);
        if(divTable){
          var api = "api/view_contract_job.php?id="+$('#customer_no').val()+"&job="+tabName[0];
          var table = $('#'+tabtable).DataTable( {
                "ajax": api,
                "columnDefs": [ {
                    "targets": 0,
                    "data": null,
                    "defaultContent": btn_table_in_popup
                } ],
                "bDestroy": true ,
                "initComplete": function() {

                    var table = $('#'+tabtable).DataTable();

                    $('.editbt').on('click', function() {
                        $("#"+tabName[0]+"_data").show();
                        $("#"+tabName[0]+"-add").hide();
                        $('#'+tabName[0]+"-cancel_add").hide();
                        $('#'+tabName[0]+"-update").show();
                        $('#'+tabName[0]+"-cancel").show();
                        $('#'+tabName[0]+"-submit").hide();
                        $('#'+tabName[0]+'_contract_line_number').attr('readonly', true);
                        
                        var data = table.row( $(this).parents('tr')).data();

                        if(data[1]){
                            get_Details(data[1],tabName[0])
                        }
                    });

                    $('.deletebt').on('click', function() {
                        var data = table.row( $(this).parents('tr')).data();
                        if(data[1]){
                            swal({
                                icon: "warning",
                                text: "Delete data ?",
                                buttons: true, // แสดงปุ่ม "OK"
                            }).then((willProceed) => {   
                                if (willProceed) {
                                const customer_code = document.getElementById('customer_no');
                                if(customer_code){
                                    var obj = {
                                        type : tabName[0],
                                        id : data[1],
                                        customer_id: customer_code.value,
                                    }
                                     $.ajax({
                                        type: 'POST',
                                        dataType: "json",
                                        data: obj,
                                        url: 'api/delete_details_contract.php',
                                        success: function(res) {
                                            if(res.status == 1) {
                                                swal({
                                                icon: "success",
                                                text: res.msg,
                                                timer: 2000,
                                                buttons: false,
                                                });
                                                setTimeout(() => {
                                                    location.reload();  
                                                }, 2100);
                                            }
                                            else if (res.status == 0) {
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
                                
                                }
                                
                            });
                        }
                       
                    });
                }
            } );   
        }
       
    } 


    function get_Details(id,type){
        const customer_code = document.getElementById('customer_no');
        $.ajax({
                            type: 'GET',
                            dataType: "json",
                            url: 'api/get_details_contract.php?id='+ id+'&type='+type+'&customer_id='+customer_code.value,
                            success: function(res) {
                                if(res){
                                  Object.keys(res).forEach((el,index) =>{
                                    let ip;
                                    if(el.includes(type)){
                                      ip = document.getElementById(el);
                                    }else{
                                      ip = document.getElementById(type+"_"+el);  
                                    }
                                    if(ip){
                                        if(el == 'contract_number'){
                                            const dropdown = document.getElementById(type+'_contract_number');
                                            dropdown.innerHTML = '';
                                            const option = document.createElement('option');
                                            option.value = res[el]; 
                                            option.textContent = res[el]; 
                                            dropdown.appendChild(option);
                                        }else{
                                            
                                            if(ip.type === "checkbox") {
                                                if (res[el] == 1) {
                                                    ip.checked = true; 
                                                } else {
                                                    ip.checked = false; 
                                                }
                                            }else{
                                              ip.value = res[el];    
                                            }
                                        }
                                    
                                    }
                            
                                 })  
                                }
                            }
                            })  
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

	/********* Location ************/
    $("#location-nav").on('click',function(){
        if($("#form_type").val()!="")
            $("#location_add").show();
        $("#location_edit_area").hide();
        $("#location_submit").hide();
        $("#location_cancel").hide();

        setTimeout(load_location, 1000);
    })

    function load_location(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        var table = $('#location_table').DataTable( {
            "ajax": "api/view_contract_location.php?contract_no="+$("#contract_no").val(),
			"pageLength": 10,
            "processing": true,
            "paging": true,
            "searching": true,
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

    $("#location_add").on('click',function(){
        $('form#location_data input:text').val('');
        $('form#location_data select').val('');

        $("#location_type").val('insert');
        $("#location_add").hide();
        $("#location_edit_area").fadeIn();
        $("#location_submit").show();
        $("#location_cancel").show();
    })

    $('#location_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#location_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

        $("#location").val(data[1]);
        $("#universal_location_name").val(data[2]);
        $("#contact1").val(data[4]);
        $("#tel1").val(data[5]);
        $("#contact2").val(data[6]);
		$("#tel2").val(data[7]);
        $("#location_reccode").val(data[8]);
		$("#sub_location_name").val(data[3]);
		$("#universal_location").val(data[9]);
		$("#sub_location").val(data[10]);

        $("#location_type").val('update');
        $("#location_add").hide();
        $("#location_edit_area").fadeIn();
        $("#location_submit").show();
        $("#location_cancel").show();
    });
    
    $('#location_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#location_table').DataTable();
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
                    url: 'api/delete_contract_location.php?reccode='+data[8],
                    success: function(data) {
                        $('#location_table').DataTable().ajax.reload();
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
    
    $("#location_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#location_data");
        var data = getFormData($form);
        $("#location_submit").prop("disabled",true);
        if($("#location_type").val() == 'insert')
            insert_location(data);
        if($("#location_type").val() == 'update')
            update_location(data);

        return false;
    });

    function insert_location(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_contract_location.php?contract_no='+$("#contract_no").val()+"&customer="+$("#customer").val(),
            data: data,
            success: function(data) {
                $("#location_submit").prop("disabled",false);
                $('#location_table').DataTable().ajax.reload();

                $("#location_add").show();
                $("#location_edit_area").fadeOut();
                $("#location_submit").hide();
                $("#location_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_location(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_contract_location.php?reccode='+$("#location_reccode").val(),
            data: data,
            success: function(data) {
                $("#location_submit").prop("disabled",false);
                $('#location_table').DataTable().ajax.reload();

                $("#location_add").show();
                $("#location_edit_area").hide();
                $("#location_submit").hide();
                $("#location_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#location_cancel").on('click',function(){
        $("#location_add").show();
        $("#location_edit_area").fadeOut();
        $("#location_submit").hide();
        $("#location_cancel").hide();
    })

	/********* Transportation TP Format 1 ************/
    $("#transportation-nav").on('click',function(){
        if($("#form_type").val()!="")
            $("#transportation_add").show();
        $("#transportation_edit_area").hide();
        $("#transportation_submit").hide();
        $("#transportation_cancel").hide();

        setTimeout(load_transportation, 1000);
    })

    function load_transportation(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        var table = $('#transportation_table').DataTable( {
            "ajax": "api/view_contract_transportation_rate.php?contract_no="+$("#contract_no").val(),
            "pageLength": 10,
            "processing": true,
            "paging": true,
            "searching": true,
            "bInfo" : false,
            "scrollX": true,
            "columnDefs": [ {
                "targets": 0,
                "data": null,
                "defaultContent": btn
            },
            {
                "targets": 4,
                "className": "text-right"
            },
            {
                "targets": 5,
                "className": "text-right"
            },
            {
                "targets": 8,
                "className": "text-right"
            },
            {
                "targets": 9,
                "className": "text-right"
            }],
            "bDestroy": true
        } );
    }

    $("#transportation_add").on('click',function(){
        $('form#transportation_data input:text').val('');
        $('form#transportation_data select').val('');
        $('form#transportation_data input:checkbox').prop('checked', false);

        $("#transportation_type").val('insert');
        $("#transportation_add").hide();
        $("#transportation_edit_area").fadeIn();
        $("#transportation_submit").show();
        $("#transportation_cancel").show();
    })

    $('#transportation_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#transportation_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

		$("#contract_line1").val(data[2]);
        $("#vehicle_type1").val(data[15]);
        $("#diesel_baht_from").val(data[4]);
        $("#diesel_baht_to").val(data[5]);
        $("#transportation_rate").val(data[8]);
        $("#transportation_from").val(data[6]);
        $("#transportation_to").val(data[7]);
		$("#total_km").val(data[9]);
		$("#transportation_uom").val(data[11]);
		$("#transport_category").val(data[12]);
		// $("#backhual").val(data[6]);
        //if(data[8])
        //    $('#backhual').prop( "checked", true );
        //else
        //    $('#backhual').prop( "checked", false );
		//$('#backhual').prop('backhual', torf(data[8]));
		$('#transport_solution1').prop('transport_solution1', torf(data[10]));
		$("#transportation_reccode").val(data[13]);
		$("#transportation_round_trip_rate").val(data[18]);

        $("#transportation_type").val('update');
        $("#transportation_add").hide();
        $("#transportation_edit_area").fadeIn();
        $("#transportation_submit").show();
        $("#transportation_cancel").show();
    });
    
    $('#transportation_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#transportation_table').DataTable();
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
                    url: 'api/delete_contract_transportation_rate.php?reccode='+data[0],
                    success: function(data) {
                        $('#transportation_table').DataTable().ajax.reload();
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
    
    $("#transportation_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#transportation_data");
        var data = getFormData($form);
        $("#transportation_submit").prop("disabled",true);
        if($("#transportation_type").val() == 'insert')
            insert_transportation(data);
        if($("#transportation_type").val() == 'update')
            update_transportation(data);

        return false;
    });

    function insert_transportation(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_contract_transportation_rate.php?contract_no='+$("#contract_no").val()+"&customer="+$("#customer").val(),
            data: data,
            success: function(data) {
                $("#transportation_submit").prop("disabled",false);
                $('#transportation_table').DataTable().ajax.reload();

                $("#transportation_add").show();
                $("#transportation_edit_area").fadeOut();
                $("#transportation_submit").hide();
                $("#transportation_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_transportation(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_contract_transportation_rate.php?reccode='+$("#transportation_reccode").val(),
            data: data,
            success: function(data) {
                $("#transportation_submit").prop("disabled",false);
                $('#transportation_table').DataTable().ajax.reload();

                $("#transportation_add").show();
                $("#transportation_edit_area").hide();
                $("#transportation_submit").hide();
                $("#transportation_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#transportation_cancel").on('click',function(){
        $("#transportation_add").show();
        $("#transportation_edit_area").fadeOut();
        $("#transportation_submit").hide();
        $("#transportation_cancel").hide();
    })

	/********* Service CH&TP Format 2 ************/
    $("#service-nav").on('click',function(){
        if($("#form_type").val()!="")
            $("#service_add").show();
        $("#service_edit_area").hide();
        $("#service_submit").hide();
        $("#service_cancel").hide();

        setTimeout(load_service, 1000);
    })

    function load_service(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        var table = $('#service_table').DataTable( {
            "ajax": "api/view_contract_service_rate.php?contract_no="+$("#contract_no").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": true,
            "bInfo" : false,
            "scrollX": true,
            "columnDefs": [ {
                "targets": 0,
                "data": null,
                "defaultContent": btn
            },
            {
                "targets": 4,
                "className": "text-right"
            },
            {
                "targets": 5,
                "className": "text-right"
            },
            {
                "targets": 6,
                "className": "text-right"
            } ],
            "bDestroy": true
        } );
    }

    $("#service_add").on('click',function(){
        $('form#service_data input:text').val('');
        $('form#service_data select').val('');

        $("#service_type").val('insert');
        $("#service_add").hide();
        $("#service_edit_area").fadeIn();
        $("#service_submit").show();
        $("#service_cancel").show();
    })

    $('#service_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#service_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

		$("#contract_line2").val(data[1]);
		$("#vehicle_type2").val(data[10]);
        //$("#equipment").val(data[8]);
        $("#hourly_rate").val(data[3]);
        $("#daily_rate").val(data[4]);
        $("#monthly_rate").val(data[5]);
		$("#minimum_charge_hour2").val(data[6]);
		//$('#transport_solution2').prop('transport_solution2', torf(data[7]));
		if(data[7] == 'Y')
			$('#transport_solution2').prop( "checked", true );
        else
            $('#transport_solution2').prop( "checked", false );
		$('#standby_charge').prop('standby_charge', torf(data[11]));
		$("#service_reccode").val(data[8]);

        $("#service_type").val('update');
        $("#service_add").hide();
        $("#service_edit_area").fadeIn();
        $("#service_submit").show();
        $("#service_cancel").show();
    });
    
    $('#service_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#service_table').DataTable();
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
                    url: 'api/delete_contract_service_rate.php?reccode='+data[8],
                    success: function(data) {
                        $('#service_table').DataTable().ajax.reload();
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
            url: 'api/insert_contract_service_rate.php?contract_no='+$("#contract_no").val()+"&customer="+$("#customer").val(),
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
            url: 'api/update_contract_service_rate.php?reccode='+$("#service_reccode").val(),
            data: data,
            success: function(data) {
                $("#service_submit").prop("disabled",false);
                $('#service_table').DataTable().ajax.reload();

                $("#service_add").show();
                $("#service_edit_area").hide();
                $("#service_submit").hide();
                $("#service_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
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

	/********* Service rate at diesel TP Format 3 ************/
    $("#serviceat-nav").on('click',function(){
        if($("#form_type").val()!="")
            $("#serviceat_add").show();
        $("#serviceat_edit_area").hide();
        $("#serviceat_submit").hide();
        $("#serviceat_cancel").hide();

        setTimeout(load_serviceat, 1000);
    })

    function load_serviceat(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        var table = $('#serviceat_table').DataTable( {
            "ajax": "api/view_contract_diesel_price.php?contract_no="+$("#contract_no").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": true,
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
                "targets": 6,
                "className": "text-right"
            },
            {
                "targets": 7,
                "className": "text-right"
            }  ],
            "bDestroy": true
        } );
    }

    $("#serviceat_add").on('click',function(){
        $('form#serviceat_data input:text').val('');
        $('form#serviceat_data select').val('');

        $("#serviceat_type").val('insert');
        $("#serviceat_add").hide();
        $("#serviceat_edit_area").fadeIn();
        $("#serviceat_submit").show();
        $("#serviceat_cancel").show();
    })

    $('#serviceat_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#serviceat_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

		$("#contract_line3").val(data[1]);
		$("#vehicle_type3").val(data[11]);
        $("#category").val(data[3]);
        $("#commute_range").val(data[4]);
        $("#serviceat_diesel_baht_from").val(data[5]);
        $("#serviceat_diesel_baht_to").val(data[6]);
		$("#one_way").val(data[7]);
        $("#round_trip").val(data[8]);
		$('#transport_solution3').prop('transport_solution3', torf(data[9]));
		$("#serviceat_reccode").val(data[10]);

        $("#serviceat_type").val('update');
        $("#serviceat_add").hide();
        $("#serviceat_edit_area").fadeIn();
        $("#serviceat_submit").show();
        $("#serviceat_cancel").show();
    });
    
    $('#serviceat_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#serviceat_table').DataTable();
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
                    url: 'api/delete_contract_diesel_price.php?reccode='+data[10],
                    success: function(data) {
                        $('#serviceat_table').DataTable().ajax.reload();
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
    
    $("#serviceat_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#serviceat_data");
        var data = getFormData($form);
        $("#serviceat_submit").prop("disabled",true);
        if($("#serviceat_type").val() == 'insert')
            insert_serviceat(data);
        if($("#serviceat_type").val() == 'update')
            update_serviceat(data);

        return false;
    });

    function insert_serviceat(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_contract_diesel_price.php?contract_no='+$("#contract_no").val()+"&customer="+$("#customer").val(),
            data: data,
            success: function(data) {
                $("#serviceat_submit").prop("disabled",false);
                $('#serviceat_table').DataTable().ajax.reload();

                $("#serviceat_add").show();
                $("#serviceat_edit_area").fadeOut();
                $("#serviceat_submit").hide();
                $("#serviceat_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_serviceat(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_contract_diesel_price.php?reccode='+$("#serviceat_reccode").val(),
            data: data,
            success: function(data) {
                $("#serviceat_submit").prop("disabled",false);
                $('#serviceat_table').DataTable().ajax.reload();

                $("#serviceat_add").show();
                $("#serviceat_edit_area").hide();
                $("#serviceat_submit").hide();
                $("#serviceat_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#serviceat_cancel").on('click',function(){
        $("#serviceat_add").show();
        $("#serviceat_edit_area").fadeOut();
        $("#serviceat_submit").hide();
        $("#serviceat_cancel").hide();
    })

	/********* Taxi Service ************/
    $("#taxi-nav").on('click',function(){
        if($("#form_type").val()!="")
            $("#taxi_add").show();
        $("#taxi_edit_area").hide();
        $("#taxi_submit").hide();
        $("#taxi_cancel").hide();

        setTimeout(load_taxi, 1000);
    })

    function load_taxi(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        var table = $('#taxi_table').DataTable( {
            "ajax": "api/view_contract_taxi_service.php?contract_no="+$("#contract_no").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": true,
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
                "targets": 6,
                "className": "text-right"
            },
            {
                "targets": 7,
                "className": "text-right"
            }  ],
            "bDestroy": true
        } );
    }

    $("#taxi_add").on('click',function(){
        $('form#taxi_data input:text').val('');
        $('form#taxi_data select').val('');

        $("#taxi_type").val('insert');
        $("#taxi_add").hide();
        $("#taxi_edit_area").fadeIn();
        $("#taxi_submit").show();
        $("#taxi_cancel").show();
    })

    $('#taxi_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#taxi_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

		$("#taxi_contract_line").val(data[1]);
		$("#taxi_vehicle_type").val(data[2]);
		$("#taxi_from").val(data[3]);
		$("#taxi_to").val(data[4]);
        $("#taxi_rate").val(data[5]);
		$("#taxi_total_km").val(data[6]);
        $("#taxi_uom").val(data[7]);
        $("#taxi_ref").val(data[8]);
		$("#taxi_diesel_baht_from").val(data[9]);
		$("#taxi_diesel_baht_to").val(data[10]);
		$("#taxi_reccode").val(data[0]);

        $("#taxi_type").val('update');
        $("#taxi_add").hide();
        $("#taxi_edit_area").fadeIn();
        $("#taxi_submit").show();
        $("#taxi_cancel").show();
    });
    
    $('#taxi_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#taxi_table').DataTable();
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
                    url: 'api/delete_contract_taxi_service.php?reccode='+data[0],
                    success: function(data) {
                        $('#taxi_table').DataTable().ajax.reload();
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
            url: 'api/insert_contract_taxi_service.php?contract_no='+$("#contract_no").val()+"&customer="+$("#customer").val(),
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
            url: 'api/update_contract_taxi_service.php?reccode='+$("#taxi_reccode").val(),
            data: data,
            success: function(data) {
                $("#taxi_submit").prop("disabled",false);
                $('#taxi_table').DataTable().ajax.reload();

                $("#taxi_add").show();
                $("#taxi_edit_area").hide();
                $("#taxi_submit").hide();
                $("#taxi_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
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

	/********* Heavy Equipment Rental CH Format 2 ************/
    $("#heavy-nav").on('click',function(){
        if($("#form_type").val()!="")
            $("#heavy_add").show();
        $("#heavy_edit_area").hide();
        $("#heavy_submit").hide();
        $("#heavy_cancel").hide();

        setTimeout(load_heavy, 1000);
    })

    function load_heavy(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        var table = $('#heavy_table').DataTable( {
            "ajax": "api/view_contract_equipment_rental.php?contract_no="+$("#contract_no").val(),
			"pageLength": 10,
            "processing": true,
            "paging": true,
            "searching": true,
            "bInfo" : false,
            "scrollX": true,
            "columnDefs": [ {
                "targets": 0,
                "data": null,
                "defaultContent": btn
            },
            {
                "targets": 4,
                "className": "text-right"
            },
            {
                "targets": 5,
                "className": "text-right"
            },
            {
                "targets": 6,
                "className": "text-right"
            },
            {
                "targets": 7,
                "className": "text-right"
            } ],
            "bDestroy": true
        } );
    }

    $("#heavy_add").on('click',function(){
        $('form#heavy_data input:text').val('');
        $('form#heavy_data select').val('');

        $("#heavy_type").val('insert');
        $("#heavy_add").hide();
        $("#heavy_edit_area").fadeIn();
        $("#heavy_submit").show();
        $("#heavy_cancel").show();
    })

    $('#heavy_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#heavy_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

		$("#contract_line4").val(data[1]);
        $("#heavy_branch").val(data[2]);
        $("#heavy_equipment").val(data[3]);
        $("#heavy_diesel_baht_from").val(data[4]);
        $("#heavy_diesel_baht_to").val(data[5]);
		$("#rate").val(data[6]);
        $("#minimum_charge_hour").val(data[7]);
		$("#day_rate").val(data[8]);
		$("#heavy_uom").val(data[9]);
		$("#heavy_reccode").val(data[10]);
		$("#ton_rate").val(data[12]);
		//get_location(data.customer,data.contract_no); 

        $("#heavy_type").val('update');
        $("#heavy_add").hide();
        $("#heavy_edit_area").fadeIn();
        $("#heavy_submit").show();
        $("#heavy_cancel").show();
    });
    
    $('#heavy_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#heavy_table').DataTable();
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
                    url: 'api/delete_contract_equipment_rental.php?reccode='+data[10],
                    success: function(data) {
                        $('#heavy_table').DataTable().ajax.reload();
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
    
    $("#heavy_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#heavy_data");
        var data = getFormData($form);
        $("#heavy_submit").prop("disabled",true);
        if($("#heavy_type").val() == 'insert')
            insert_heavy(data);
        if($("#heavy_type").val() == 'update')
            update_heavy(data);

        return false;
    });

    function insert_heavy(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_contract_equipment_rental.php?contract_no='+$("#contract_no").val()+"&customer="+$("#customer").val(),
            data: data,
            success: function(data) {
                $("#heavy_submit").prop("disabled",false);
                $('#heavy_table').DataTable().ajax.reload();

                $("#heavy_add").show();
                $("#heavy_edit_area").fadeOut();
                $("#heavy_submit").hide();
                $("#heavy_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_heavy(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_contract_equipment_rental.php?reccode='+$("#heavy_reccode").val(),
            data: data,
            success: function(data) {
                $("#heavy_submit").prop("disabled",false);
                $('#heavy_table').DataTable().ajax.reload();

                $("#heavy_add").show();
                $("#heavy_edit_area").hide();
                $("#heavy_submit").hide();
                $("#heavy_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#heavy_cancel").on('click',function(){
        $("#heavy_add").show();
        $("#heavy_edit_area").fadeOut();
        $("#heavy_submit").hide();
        $("#heavy_cancel").hide();
    })

	/********* Non-working Date Table ************/
    $("#nonworking-nav").on('click',function(){
        if($("#form_type").val()!="")
            $("#nonworking_add").show();
        $("#nonworking_edit_area").hide();
        $("#nonworking_submit").hide();
        $("#nonworking_cancel").hide();

        setTimeout(load_nonworking, 1000);
    })

    function load_nonworking(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        var table = $('#nonworking_table').DataTable( {
            "ajax": "api/view_contract_non_working_date.php?contract_no="+$("#contract_no").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": true,
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

    $("#nonworking_add").on('click',function(){
        $('form#nonworking_data input:text').val('');
        $('form#nonworking_data select').val('');

        $("#nonworking_type").val('insert');
        $("#nonworking_add").hide();
        $("#nonworking_edit_area").fadeIn();
        $("#nonworking_submit").show();
        $("#nonworking_cancel").show();
    })

    $('#nonworking_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#nonworking_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();

        $("#non_working_date").val(data[4]);
        $("#holiday_name").val(data[2]);
        $("#nonworking_reccode").val(data[3]);

        $("#nonworking_type").val('update');
        $("#nonworking_add").hide();
        $("#nonworking_edit_area").fadeIn();
        $("#nonworking_submit").show();
        $("#nonworking_cancel").show();
    });
    
    $('#nonworking_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#nonworking_table').DataTable();
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
                    url: 'api/delete_contract_non_working_date.php?reccode='+data[3],
                    success: function(data) {
                        $('#nonworking_table').DataTable().ajax.reload();
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
    
    $("#nonworking_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#nonworking_data");
        var data = getFormData($form);
        $("#nonworking_submit").prop("disabled",true);
        if($("#nonworking_type").val() == 'insert')
            insert_nonworking(data);
        if($("#nonworking_type").val() == 'update')
            update_nonworking(data);

        return false;
    });

    function insert_nonworking(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_contract_non_working_date.php?contract_no='+$("#contract_no").val()+"&customer="+$("#customer").val(),
            data: data,
            success: function(data) {
                $("#nonworking_submit").prop("disabled",false);
                $('#nonworking_table').DataTable().ajax.reload();

                $("#nonworking_add").show();
                $("#nonworking_edit_area").fadeOut();
                $("#nonworking_submit").hide();
                $("#nonworking_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_nonworking(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_contract_non_working_date.php?reccode='+$("#nonworking_reccode").val(),
            data: data,
            success: function(data) {
                $("#nonworking_submit").prop("disabled",false);
                $('#nonworking_table').DataTable().ajax.reload();

                $("#nonworking_add").show();
                $("#nonworking_edit_area").hide();
                $("#nonworking_submit").hide();
                $("#nonworking_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#nonworking_cancel").on('click',function(){
        $("#nonworking_add").show();
        $("#nonworking_edit_area").fadeOut();
        $("#nonworking_submit").hide();
        $("#nonworking_cancel").hide();
    })

    /********* Hourly ************/
    $("#hourly-nav").on('click',function(){
        if($("#form_type").val()!="")
            $("#hourly_add").show();
        $("#hourly_edit_area").hide();
        $("#hourly_submit").hide();
        $("#hourly_cancel").hide();

        setTimeout(load_hourly, 1000);
    })

    function load_hourly(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        var table = $('#hourly_table').DataTable( {
            "ajax": "api/view_contract_hourly.php?contract_no="+$("#contract_no").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": true,
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
                "targets": 6,
                "className": "text-right"
            } ],
            "bDestroy": true
        } );
    }

    $("#hourly_add").on('click',function(){
        $('form#hourly_data input:text').val('');
        $('form#hourly_data select').val('');
		$('form#hourly_data input[type="time"]').val('');

        $("#hourly_type").val('insert');
        $("#hourly_add").hide();
        $("#hourly_edit_area").fadeIn();
        $("#hourly_submit").show();
        $("#hourly_cancel").show();
    })

    $('#hourly_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#hourly_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
		$("#hourly_reccode").val(data[0]);
		$.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_hourly.php?reccode='+data[0],
            success: function(data) {

				$("#contract_line5").val(data.contract_line);
				$('#manpower_position').val(data.position);
				$('#universal_position').val(data.universal_position);
				$('#type').val(data.type);
				$('#normal').val(data.normal);
				$('#after_normal').val(data.after_normal);
				$('#s_normal').val(data.s_normal);
				$('#s_after_normal').val(data.s_after_normal);
				//$('#hourly_reccode').val(data.reccede);
				//$("#hourly_reccode").val(data[0]);

				//$('#monday').prop('checked', torf(data.monday));
				//$('#tuesday').prop('checked', torf(data.tuesday));
				//$('#wednesday').prop('checked', torf(data.wednesday));
				//$('#thursday').prop('checked', torf(data.thursday));
				//$('#friday').prop('checked', torf(data.friday));
				//$('#saturday').prop('checked', torf(data.saturday));
				//$('#sunday').prop('checked', torf(data.sunday));
				$('#monday').prop('checked', data.monday);
                $('#tuesday').prop('checked', data.tuesday);
                $('#wednesday').prop('checked', data.wednesday);
                $('#thursday').prop('checked', data.thursday);
                $('#friday').prop('checked', data.friday);
                $('#saturday').prop('checked', data.saturday);
                $('#sunday').prop('checked', data.sunday);

				//if(data.wednesday)
                //    $('#wednesday').prop( "checked", true );
                //else
                //    $('#wednesday').prop( "checked", false );

				$('#start_ship').val(data.start_ship);
				$('#start_break').val(data.start_break);
				$('#end_ship').val(data.end_ship);

				$('#minimum_charge').val(data.minimum_charge);
				$('#ot_lamsam').val(data.ot_lamsam);
				$('#sunday_lamsam').val(data.sunday_lamsam);
				$('#lamsum_charge_rate').val(data.lamsum_charge_rate);
	
			}
        });

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
                    url: 'api/delete_contract_hourly.php?reccode='+data[0],
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

	/********* Immigration ************/
    $("#immigration-nav").on('click',function(){
        if($("#form_type").val()!="")
            $("#immigration_add").show();
        $("#immigration_edit_area").hide();
        $("#immigration_submit").hide();
        $("#immigration_cancel").hide();

        setTimeout(load_immigration, 1000);
    })

    function load_immigration(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        var table = $('#immigration_table').DataTable( {
            "ajax": "api/view_contract_immigration.php?contract_no="+$("#contract_no").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": true,
            "bInfo" : false,
            "scrollX": true,
            "columnDefs": [ {
                "targets": 0,
                "data": null,
                "defaultContent": btn
            },
            {
                "targets": 3,
                "className": "text-right"
            }],
            "bDestroy": true
        } );
    }

    $("#immigration_add").on('click',function(){
        $('form#immigration_data input:text').val('');
        $('form#immigration_data select').val('');
		$('form#immigration_data input[type="time"]').val('');

        $("#immigration_type").val('insert');
        $("#immigration_add").hide();
        $("#immigration_edit_area").fadeIn();
        $("#immigration_submit").show();
        $("#immigration_cancel").show();
    })

    $('#immigration_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#immigration_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
		$("#immigration_reccode").val(data[0]);
		$.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_immigration.php?reccode='+data[0],
            success: function(data) {
				$("#immigration_contract_line").val(data.contract_line);
				$('#immigration_description').val(data.description);
				$('#immigration_unit_price').val(data.unit_price);
				$('#immigration_location').val(data.location);
				$('#immigration_uom').val(data.uom);
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
                    url: 'api/delete_contract_immigration.php?reccode='+data[0],
                    success: function(data) {
                        $('#immigration_table').DataTable().ajax.reload();
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
            url: 'api/insert_contract_immigration.php?contract_no='+$("#contract_no").val()+"&customer="+$("#customer").val(),
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
            url: 'api/update_contract_immigration.php?reccode='+$("#immigration_reccode").val(),
            data: data,
            success: function(data) {
                $("#immigration_submit").prop("disabled",false);
                $('#immigration_table').DataTable().ajax.reload();

                $("#immigration_add").show();
                $("#immigration_edit_area").hide();
                $("#immigration_submit").hide();
                $("#immigration_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
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

	/********* Promotion ************/
    $("#promotion-nav").on('click',function(){
        if($("#form_type").val()!="")
            $("#promotion_add").show();
        $("#promotion_edit_area").hide();
        $("#promotion_submit").hide();
        $("#promotion_cancel").hide();

        setTimeout(load_promotion, 1000);
    })

    function load_promotion(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        var table = $('#promotion_table').DataTable( {
            "ajax": "api/view_contract_promotion.php?contract_no="+$("#contract_no").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": true,
            "bInfo" : false,
            "scrollX": true,
            "columnDefs": [ {
                "targets": 0,
                "data": null,
                "defaultContent": btn
            },
            {
                "targets": 3,
                "className": "text-right"
            }],
            "bDestroy": true
        } );
    }

    $("#promotion_add").on('click',function(){
        $('form#promotion_data input:text').val('');
        $('form#promotion_data select').val('');
		$('form#promotion_data input[type="time"]').val('');

        $("#promotion_type").val('insert');
        $("#promotion_add").hide();
        $("#promotion_edit_area").fadeIn();
        $("#promotion_submit").show();
        $("#promotion_cancel").show();
    })

    $('#promotion_table tbody').on( 'click', 'button.editbtn', function () {
        var table = $('#promotion_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
		$("#promotion_reccode").val(data[0]);
		$.ajax({
            type: 'GET',
            dataType: "json",
            url: 'api/get_contract_promotion.php?reccode='+data[0],
            success: function(data) {
				$("#promotion_contract_line").val(data.contract_line);
				$('#promotion_description').val(data.description);
				$('#promotion_discount').val(data.discount);
				$('#promotion_reccode').val(data.reccode);
			}
        });

        $("#promotion_type").val('update');
        $("#promotion_add").hide();
        $("#promotion_edit_area").fadeIn();
        $("#promotion_submit").show();
        $("#promotion_cancel").show();
    });
    
    $('#promotion_table tbody').on( 'click', 'button.deletebtn', function () {
        var table = $('#promotion_table').DataTable();
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
                    url: 'api/delete_contract_promotion.php?reccode='+data[0],
                    success: function(data) {
                        $('#promotion_table').DataTable().ajax.reload();
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
    
    $("#promotion_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#promotion_data");
        var data = getFormData($form);
        $("#promotion_submit").prop("disabled",true);
        if($("#promotion_type").val() == 'insert')
            insert_promotion(data);
        if($("#promotion_type").val() == 'update')
            update_promotion(data);

        return false;
    });

    function insert_promotion(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/insert_contract_promotion.php?contract_no='+$("#contract_no").val()+"&customer="+$("#customer").val(),
            data: data,
            success: function(data) {
                $("#promotion_submit").prop("disabled",false);
                $('#promotion_table').DataTable().ajax.reload();

                $("#promotion_add").show();
                $("#promotion_edit_area").fadeOut();
                $("#promotion_submit").hide();
                $("#promotion_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    function update_promotion(data){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/update_contract_promotion.php?reccode='+$("#promotion_reccode").val(),
            data: data,
            success: function(data) {
                $("#promotion_submit").prop("disabled",false);
                $('#promotion_table').DataTable().ajax.reload();

                $("#promotion_add").show();
                $("#promotion_edit_area").hide();
                $("#promotion_submit").hide();
                $("#promotion_cancel").hide();
                Result = data;
                if(Result.Status == "Success") {
                    swal(Result.msg);
                } else {
                    swal(Result.msg);
                }
            }
        });
    }

    $("#promotion_cancel").on('click',function(){
        $("#promotion_add").show();
        $("#promotion_edit_area").fadeOut();
        $("#promotion_submit").hide();
        $("#promotion_cancel").hide();
    })

    /********* Working ************/
    $("#working-nav").on('click',function(){
        if($("#form_type").val()!="")
            $("#working_add").show();
        $("#working_edit_area").fadeOut();
        $("#working_submit").hide();
        $("#working_cancel").hide();

        setTimeout(load_working, 1000);
    })

    function load_working(){
        var btn = "";
        if($("#form_type").val()!="")
            btn = btn_table;

        var table = $('#working_table').DataTable( {
            "ajax": "api/view_contract_working.php?contract_no="+$("#contract_no").val(),
            "pageLength": 100,
            "processing": true,
            "paging": false,
            "searching": true,
            "bInfo" : false,
            "scrollX": true,
            "columnDefs": [ {
                "targets": -1,
                "data": null,
                "defaultContent": btn
            } ],
            "bDestroy": true
        } );
    }

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
        //$('#monday').prop('checked', torf(data[1]));
        //$('#tuesday').prop('checked', torf(data[2]));
        //$('#wednesday').prop('checked', torf(data[3]));
        //$('#thursday').prop('checked', torf(data[4]));
        //$('#friday').prop('checked', torf(data[5]));
        //$('#saturday').prop('checked', torf(data[6]));
        //$('#sunday').prop('checked', torf(data[7]));
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