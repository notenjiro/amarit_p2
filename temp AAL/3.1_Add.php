<!DOCTYPE html>
<html lang="en">
<head>
  <title>Front-end system</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Worksheet ID</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>Date</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
		      <div class="field">
		        <label>Subject</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">Transportation Charge</option>
                    <option value="02">Cargo Handling Charge</option>
                    <option value="03">Labour Service Charge</option>
                </select> 
    	      </div>
			</div>
		    <div class="col-xs-12 col-sm-6 col-md-5">
		      <div class="field">
		        <label>Customer</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">National Oilwell Varco (Thailand) Ltd.</option>
                    <option value="02">ATWOOD OFFSHORE DRILLING LIMITED.</option>
                    <option value="03">Chevron Thailand Exploration and Production, Ltd.</option>
                </select>  
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>Contact</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">Mr.A</option>
                    <option value="02">Mr.B</option>
                    <option value="03">Mr.C</option>
                </select>  
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>Customer Ref.</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>Worksheet Status</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">Open</option>
                    <option value="02">Printed</option>
                    <option value="03">Close</option>
                </select>  
    	      </div>
			 </div>
		  </div>	
		  <br>
			<button type="submit" class="btn btn-success"><i class="far fa-save"></i>Save</button>
			<button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>Cancel</button>
			<br><br>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Cargo Transport</a></li>
    <li><a data-toggle="tab" href="#menu1">Manpower</a></li>
    <li><a data-toggle="tab" href="#menu2">Cargo Handling</a></li>
	<li><a data-toggle="tab" href="#menu3">Service Other</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div class="row">
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Transport ID</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Vehicle</label>
		        <select name="transfer_by" class="form-control">
					<option value="77-3738">77-3738</option>
                    <option value="77-1977">77-1977</option>
                    <option value="79-6503">79-6503</option>
                </select>  
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Operator</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">Daree C.</option>
                    <option value="02">Sompong S.</option>
                    <option value="03">Nipon M.</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>From</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">AAL YARD 5 SKL</option>
                    <option value="02">AAL YARD 6B SKL</option>
                    <option value="03">PSB Jetty SKL</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>To</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">AAL YARD 5 SKL</option>
                    <option value="02">AAL YARD 6B SKL</option>
                    <option value="03">PSB Jetty SKL</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Route</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Start Date</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Start Time</label>
		        <input type="time" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>End Date</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>End Time</label>
		        <input type="time" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <label>Qty</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>UOM</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">TRIP</option>
                </select> 
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-12">
	          <div class="field">
				<h5 class="modal-title" id="classModalLabel">--------------------------------------------------------------------------------------------------------------------------------------------------------</h5>
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Actual Finish Date</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Actual Finish Time</label>
		        <input type="time" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>		    
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Mileage Start</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Mileage End</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Back hual</label>
		        <input type="checkbox" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>No charge</label>
		        <input type="checkbox" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Diesel Rate</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-12">
	          <div class="field">
				<h5 class="modal-title" id="classModalLabel">--------------------------------------------------------------------------------------------------------------------------------------------------------</h5>
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Trip Type</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">None</option>
                    <option value="02">Single trip</option>
                    <option value="03">Round trip</option>
					<option value="04">backhaul trip</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Charge Type</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">None</option>
                    <option value="02">Gate fee/Border fee</option>
                    <option value="03">Additional driver</option>
					<option value="04">Additional helper</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Additional Charge</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">None</option>
                    <option value="02">Stand by charge</option>
                    <option value="03">Cancellation charge(no show)</option>
					<option value="04">At cost plus</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <label>Qty</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>UOM</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">TRIP</option>
                </select> 
			    </div>
    	    </div>			
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Trip Type 2</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">None</option>
                    <option value="02">Single trip</option>
                    <option value="03">Round trip</option>
					<option value="04">backhaul trip</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Charge Type 2</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">None</option>
                    <option value="02">Gate fee/Border fee</option>
                    <option value="03">Additional driver</option>
					<option value="04">Additional helper</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Additional Charge 2</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">None</option>
                    <option value="02">Stand by charge</option>
                    <option value="03">Cancellation charge(no show)</option>
					<option value="04">At cost plus</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <label>Qty 2</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>UOM 2</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">TRIP</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Trip Type 3</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">None</option>
                    <option value="02">Single trip</option>
                    <option value="03">Round trip</option>
					<option value="04">backhaul trip</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Charge Type 3</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">None</option>
                    <option value="02">Gate fee/Border fee</option>
                    <option value="03">Additional driver</option>
					<option value="04">Additional helper</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Additional Charge 3</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">None</option>
                    <option value="02">Stand by charge</option>
                    <option value="03">Cancellation charge(no show)</option>
					<option value="04">At cost plus</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <label>Qty 3</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>UOM 3</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">TRIP</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
				<br>
		        <button type="submit" class="btn btn-success"><i class="far fa-save"></i>Save</button>
			    </div>
    	    </div> 
		  </div>
		  <h5 class="modal-title" id="classModalLabel">-</h5>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>Transport ID</th>
				<th>Vehicle</th>
				<th>Operator</th>
				<th>From</th>
				<th>To</th>		
				<th>Start Date</th>
				<th>Start Time</th>
				<th>End Date</th>
				<th>End Time</th>
				<th>Qty</th>	
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>TP2110001</td>
			<td>77-1977</td>
			<td>Daree C.</td>
			<td>AAL YARD 5 SKL</td>
			<td>AAL YARD 6B SKL</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			</tr>
			<tr>
			<td>TP2110002</td>
			<td>79-6503</td>
			<td>Daree C.</td>
			<td>AAL YARD 6B SKL</td>
			<td>PSB Jetty SKL</td>	
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			</tr>
		</tbody>
		</table>
    </div>
    <div id="menu1" class="tab-pane fade">
      <div class="row">
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Labor Service ID</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Timesheet No.</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Position</label>
		        <select name="transfer_by" class="form-control">
					<option value="BKK">Forklift Operation</option>
                    <option value="STH">Rigger/Signaler</option>
                    <option value="SKL">Tally Clerk</option>
					<option value="SKL">Foreman</option>
                </select>  
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Labor</label>
		        <select name="transfer_by" class="form-control">
					<option value="Adisai P.">Adisai P.</option>
                    <option value="Adisai S.">Adisai S.</option>
                    <option value="Adisak W.">Adisak W.</option>
                </select>  
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Location</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">AAL YARD 5 SKL</option>
                    <option value="02">AAL YARD 6B SKL</option>
                    <option value="03">PSB Jetty SKL</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Start Date</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Start Time</label>
		        <input type="time" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>End Date</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>End Time</label>
		        <input type="time" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <label>Qty</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>UOM</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">TRIP</option>
                </select> 
			    </div>
    	    </div> 	
			<div class="col-xs-12 col-sm-6 col-md-4">
	          <div class="field">
		        <label>Remark</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
				<br>
		        <button type="submit" class="btn btn-success"><i class="far fa-save"></i>Save</button>
			    </div>
    	    </div> 
		  </div>
		  <h5 class="modal-title" id="classModalLabel">-</h5>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>Service ID</th>
				<th>Timesheet</th>
				<th>Labor</th>
				<th>Location</th>	
				<th>Start Date</th>
				<th>Start Time</th>	
				<th>End Date</th>
				<th>End Time</th>	
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>LS00001</td>
			<td>SKL/D/20/0001</td>
			<td>Nattaporn S.</td>
			<td>NOV YARD SKL</td>
			<td>02-January-64</td>
			<td>13:00</td>
			<td>02-January-64</td>
			<td>15:00</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			<tr>
			<td>LS00002</td>
			<td>SKL/D/20/0002</td>
			<td>Jareon P.</td>
			<td>NOV YARD SKL</td>
			<td>02-January-64</td>
			<td>13:00</td>
			<td>02-January-64</td>
			<td>15:00</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
		</tbody>
		</table>
    </div>
    <div id="menu2" class="tab-pane fade">
      <div class="row">
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Cargo Service ID</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Vehicle</label>
		        <select name="transfer_by" class="form-control">
					<option value="77-3738">77-3738</option>
                    <option value="77-1977">77-1977</option>
                    <option value="79-6503">79-6503</option>
                </select>  
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Operator</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">Daree C.</option>
                    <option value="02">Sompong S.</option>
                    <option value="03">Nipon M.</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>From</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">AAL YARD 5 SKL</option>
                    <option value="02">AAL YARD 6B SKL</option>
                    <option value="03">PSB Jetty SKL</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>To</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">AAL YARD 5 SKL</option>
                    <option value="02">AAL YARD 6B SKL</option>
                    <option value="03">PSB Jetty SKL</option>
                </select> 
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Start Date</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Start Time</label>
		        <input type="time" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>End Date</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>End Time</label>
		        <input type="time" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>    
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Trip Type</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">None</option>
                    <option value="02">Single trip</option>
                    <option value="03">Round trip</option>
					<option value="04">backhaul trip</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Charge Type</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">None</option>
                    <option value="02">Gate fee/Border fee</option>
                    <option value="03">Additional driver</option>
					<option value="04">Additional helper</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Additional Charge</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">None</option>
                    <option value="02">Stand by charge</option>
                    <option value="03">Cancellation charge(no show)</option>
					<option value="04">At cost plus</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <label>Qty</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>UOM</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">TRIP</option>
                </select> 
			    </div>
    	    </div>		
			<div class="col-xs-12 col-sm-6 col-md-4">
	          <div class="field">
		        <label>Remark</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 				
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
				<br>
		        <button type="submit" class="btn btn-success"><i class="far fa-save"></i>Save</button>
			    </div>
    	    </div> 
		  </div>
		  <h5 class="modal-title" id="classModalLabel">-</h5>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>Cargo Service ID</th>
				<th>Vehicle</th>
				<th>Operator</th>
				<th>From</th>
				<th>To</th>			
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>TP2110001</td>
			<td>77-1977</td>
			<td>Daree C.</td>
			<td>AAL YARD 5 SKL</td>
			<td>AAL YARD 6B SKL</td>		
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			</tr>
			<tr>
			<td>TP2110002</td>
			<td>79-6503</td>
			<td>Daree C.</td>
			<td>AAL YARD 6B SKL</td>
			<td>PSB Jetty SKL</td>		
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			</tr>
		</tbody>
		</table>
    </div>
	<div id="menu3" class="tab-pane fade">
      <div class="row">
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Service ID</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Vehicle</label>
		        <select name="transfer_by" class="form-control">
					<option value="77-3738">77-3738</option>
                    <option value="77-1977">77-1977</option>
                    <option value="79-6503">79-6503</option>
                </select>  
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Operator</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">Daree C.</option>
                    <option value="02">Sompong S.</option>
                    <option value="03">Nipon M.</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>From</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">AAL YARD 5 SKL</option>
                    <option value="02">AAL YARD 6B SKL</option>
                    <option value="03">PSB Jetty SKL</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>To</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">AAL YARD 5 SKL</option>
                    <option value="02">AAL YARD 6B SKL</option>
                    <option value="03">PSB Jetty SKL</option>
                </select> 
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Start Date</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Start Time</label>
		        <input type="time" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>End Date</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>End Time</label>
		        <input type="time" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>    
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Trip Type</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">None</option>
                    <option value="02">Single trip</option>
                    <option value="03">Round trip</option>
					<option value="04">backhaul trip</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Charge Type</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">None</option>
                    <option value="02">Gate fee/Border fee</option>
                    <option value="03">Additional driver</option>
					<option value="04">Additional helper</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Additional Charge</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">None</option>
                    <option value="02">Stand by charge</option>
                    <option value="03">Cancellation charge(no show)</option>
					<option value="04">At cost plus</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <label>Qty</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>UOM</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">TRIP</option>
                </select> 
			    </div>
    	    </div>		
			<div class="col-xs-12 col-sm-6 col-md-4">
	          <div class="field">
		        <label>Remark</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 				
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
				<br>
		        <button type="submit" class="btn btn-success"><i class="far fa-save"></i>Save</button>
			    </div>
    	    </div> 
		  </div>
		  <h5 class="modal-title" id="classModalLabel">-</h5>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>Service ID</th>
				<th>Vehicle</th>
				<th>Operator</th>
				<th>From</th>
				<th>To</th>			
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>TP2110001</td>
			<td>77-1977</td>
			<td>Daree C.</td>
			<td>AAL YARD 5 SKL</td>
			<td>AAL YARD 6B SKL</td>		
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			</tr>
			<tr>
			<td>TP2110002</td>
			<td>79-6503</td>
			<td>Daree C.</td>
			<td>AAL YARD 6B SKL</td>
			<td>PSB Jetty SKL</td>		
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			</tr>
		</tbody>
		</table>
    </div>
  </div>
</div>

</body>
</html>
