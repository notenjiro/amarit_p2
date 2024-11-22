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
<body style="background-color:GhostWhite">

<div class="container">
  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Contract No.</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>Contract Date</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
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
		        <label>End Date</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
			  </div>
    	    </div>
		  </div>		 
		  <div class="row">
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
		        <label>Customer Ref.</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
		  </div>
		  <br>
		  <div class="row">
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <input type="checkbox" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
			    <br>
				<label >Active</label>
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-3">
		      <div class="field">
		        <label>Status</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">on going</option>
                    <option value="02">nearing expire</option>
                    <option value="03">expired</option>
                </select>  
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <input type="checkbox" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
			    <br>
				<label >Pay Cash</label>
			    </div>
    	    </div> 
		  </div>
		  <div class="row">
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <input type="checkbox" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-11">
	          <div class="field">
			  <br>
				<label >If Diesel price does exceed THB ___ per liter then a ___ % increse in our charge rate per unit will be applied for every THB __ increase in the Diesal price.</label>
			    </div>
    	    </div> 
		  </div>
		  <div class="row">
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <input type="checkbox" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-11">
	          <div class="field">
			    <br>
				<label >Rounding trip (Backload) is charged at __ % of a "with cargo-single trip"</label>
			    </div>
    	    </div> 
		  </div>
		  <br>
			<button type="submit" class="btn btn-success"><i class="far fa-save"></i>Save</button>
			<button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>Cancel</button>
			<br><br>	
		</form>
		<div class="col-xs-12 col-sm-6 col-md-12">
	          <div class="field">
				<h5 class="modal-title" id="classModalLabel">----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</h5>
			    </div>
    	    </div>
		

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Location</a></li>
    <li><a data-toggle="tab" href="#menu1">Transporation Rate</a></li>
    <li><a data-toggle="tab" href="#menu2">Service Rate</a></li>
	<li><a data-toggle="tab" href="#menu3">Service Rate at Diesel Price Variable</a></li>
	<li><a data-toggle="tab" href="#menu4">Heavy Equipment Rental</a></li>
	<li><a data-toggle="tab" href="#menu5">non-working date table</a></li>
	<li><a data-toggle="tab" href="#menu6">Overtime Charge Rates</a></li>
	<li><a data-toggle="tab" href="#menu7">Hourly Rates</a></li>
	<li><a data-toggle="tab" href="#menu8">working day by position</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
	<br>
      <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Location</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Universal Location</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">AAL YARD 5 SKL</option>
                    <option value="02">AAL YARD 6B SKL</option>
                    <option value="03">PSB Jetty SKL</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Contact 1</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Tel.</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Contact 2</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Tel.</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
				<br>
		        <button type="submit" class="btn btn-success"><i class="far fa-save"></i>Add</button>
			    </div>
    	    </div> 
		  </div>
		  <h5 class="modal-title" id="classModalLabel">-</h5>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>Location</th>
				<th>Universal Location</th>
				<th>Contact 1</th>
				<th>Tel.</th>
				<th>Contact 2</th>
				<th>Tel.</th>			
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>Sadao border</td>
			<td>AAL YARD 5 SKL</td>
			<td>นายทดสอบ 1</td>
			<td>02-1234567</td>
			<td>นายทดสอบ 2</td>
			<td>02-1234567</td>		
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
		</tbody>
		</table>
    </div>
    <div id="menu1" class="tab-pane fade">
	<br>
      <div class="row">
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Vehicle type</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">10 Wheeler Special Truck</option>
                    <option value="02">6 Wheeler Special Truck</option>
                    <option value="03">4 Wheeler Special Truck</option>
                </select>  
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Diesel baht from</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>to</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Transporation rate</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
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
		        <label>Back hual</label>
		        <input type="checkbox" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
		  </div>
		  <h5 class="modal-title" id="classModalLabel">-</h5>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>Vehicle type</th>
				<th>Diesel baht from</th>
				<th>to</th>
				<th>Transporation rate</th>		
				<th>From</th>	
				<th>To</th>	
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>10 Wheeler Special Truck</td>
			<td>27.00</td>
			<td>28.00</td>
			<td>100</td>
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
			<td>10 Wheeler Special Truck</td>
			<td>28.01</td>
			<td>29.00</td>
			<td>120</td>
			<td>AAL YARD 5 SKL</td>
			<td>AAL YARD 6B SKL</td>
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
    <div id="menu2" class="tab-pane fade">	
	<br>
      <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-4">
	          <div class="field">
		        <label>Equipment</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">40 Foot Semi-Triller</option>
                    <option value="02">Prime Mover and Trillers(Flatbed)</option>
                    <option value="03">Prime Mover and Trillers(Lowbed)</option>
                </select>  
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Hourly rate</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Daily rate</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Monthly rate</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">

			    </div>
    	    </div> 	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
				<br>
		        <button type="submit" class="btn btn-success"><i class="far fa-save"></i>Add</button>
			    </div>
    	    </div> 
		  </div>
		  <h5 class="modal-title" id="classModalLabel">-</h5>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>Equipment</th>
				<th>Hourly rate</th>
				<th>Daily rate</th>
				<th>Monthly rate</th>	
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>40 Foot Semi-Triller</td>
			<td>300</td>
			<td>2,000</td>
			<td>50,000</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
		</tbody>
		</table>
    </div>
	<div id="menu3" class="tab-pane fade">	
	<br>
      <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Category</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">F01-T3</option>
                    <option value="02">F02-T3</option>
                    <option value="03">F03-T3</option>
                </select>  
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Commute range with in</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">10 KM</option>
                    <option value="02">20 KM</option>
                    <option value="03">30 KM</option>
                </select>  
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Diesel baht from</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>to</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Ony way</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Round trip</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
				<br>
		        <button type="submit" class="btn btn-success"><i class="far fa-save"></i>Add</button>
			    </div>
    	    </div> 
		  </div>
		  <h5 class="modal-title" id="classModalLabel">-</h5>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>Category</th>
				<th>Commute range with in</th>
				<th>Diesel baht from</th>
				<th>to</th>	
				<th>Ony way</th>
				<th>Round trip</th>	
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>F01-T3</td>
			<td>10 KM</td>
			<td>20.00</td>
			<td>21.99</td>
			<td>xxx</td>
			<td>xxx</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			<tr>
			<td>F01-T3</td>
			<td>10 KM</td>
			<td>22.00</td>
			<td>23.99</td>
			<td>xxx</td>
			<td>xxx</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			<tr>
			<td>F01-T3</td>
			<td>10 KM</td>
			<td>24.00</td>
			<td>25.99</td>
			<td>xxx</td>
			<td>xxx</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			<tr>
			<td>F01-T3</td>
			<td>10 KM</td>
			<td>26.00</td>
			<td>27.99</td>
			<td>xxx</td>
			<td>xxx</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			<tr>
			<td>F01-T3</td>
			<td>10 KM</td>
			<td>28.00</td>
			<td>29.99</td>
			<td>xxx</td>
			<td>xxx</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			<tr>
			<td>F01-T3</td>
			<td>10 KM</td>
			<td>30.00</td>
			<td>31.99</td>
			<td>xxx</td>
			<td>xxx</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
		</tbody>
		</table>
    </div>
	<div id="menu4" class="tab-pane fade">	
	<br>
      <div class="row">
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Branch</label>
		        <select name="transfer_by" class="form-control">
					<option value="BKK">BKK</option>
                    <option value="STH">STH</option>
                    <option value="SKL">SKL</option>
                </select>  
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Equipment</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">25 ton capacity</option>
                    <option value="02">35 ton capacity</option>
                    <option value="03">40 ton capacity</option>
                </select>  
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Diesel baht from</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>to</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Rate</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Minimum charge hour</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
				<br>
		        <button type="submit" class="btn btn-success"><i class="far fa-save"></i>Add</button>
			    </div>
    	    </div> 
		  </div>
		  <h5 class="modal-title" id="classModalLabel">-</h5>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>Branch</th>
				<th>Equipment</th>
				<th>Diesel baht from</th>
				<th>to</th>	
				<th>Rate</th>
				<th>Minimum charge hour</th>	
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>SKL</td>
			<td>25 ton capacity</td>
			<td>20.00</td>
			<td>24.99</td>
			<td>xxx</td>
			<td>xxx</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			<tr>
			<td>SKL</td>
			<td>25 ton capacity</td>
			<td>25.00</td>
			<td>29.99</td>
			<td>xxx</td>
			<td>xxx</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			<tr>
			<td>SKL</td>
			<td>25 ton capacity</td>
			<td>30.00</td>
			<td>34.99</td>
			<td>xxx</td>
			<td>xxx</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			<tr>
			<td>SKL</td>
			<td>25 ton capacity</td>
			<td>35.00</td>
			<td>39.99</td>
			<td>xxx</td>
			<td>xxx</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
		</tbody>
		</table>
    </div>
	<div id="menu5" class="tab-pane fade">	
	<br>
      <div class="row">
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Date</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Holiday Name</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
				<br>
		        <button type="submit" class="btn btn-success"><i class="far fa-save"></i>Add</button>
			    </div>
    	    </div> 
		  </div>
		  <h5 class="modal-title" id="classModalLabel">-</h5>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>Date</th>
				<th>Holiday Name</th>
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>22/10/2564</td>
			<td>วันหยุดชดเชยวันปิยมหาราช</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
		</tbody>
		</table>
    </div>
	<div id="menu6" class="tab-pane fade">	
	<br>
      <div class="row">
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Monday-Friday</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Sunday/Public Holiday 8:01-17:00</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Sunday/Public Holiday 17:01-8:00</label>
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
		 
    </div>
	<div id="menu7" class="tab-pane fade">	
	<br>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Position</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 	
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Universal Position</label>
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
		        <label>Type</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">Working Days</option>
                    <option value="02">Sundays</option>
                </select>  
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Normal</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>After Normal</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
				<br>
		        <button type="submit" class="btn btn-success"><i class="far fa-save"></i>Add</button>
			    </div>
    	    </div> 
		  </div>
		  <h5 class="modal-title" id="classModalLabel">-</h5>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>Position</th>
				<th>Universal Position</th>
				<th>Type</th>
				<th>Normal</th>
				<th>After Normal</th>	
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>Forklift Operation</td>
			<td>Forklift Operation</td>
			<td>Working Days</td>
			<td>xxx</td>
			<td>xxx</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			<tr>
			<td>Forklift Operation</td>
			<td>Forklift Operation</td>
			<td>Sundays</td>
			<td>xxx</td>
			<td>xxx</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>		
		</tbody>
		</table>
    </div>
	<div id="menu8" class="tab-pane fade">	
	<br>
		<div class="row">
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
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <input type="checkbox" class="form-control" id="ID" placeholder="">
				<label>Monday</label>
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <input type="checkbox" class="form-control" id="ID" placeholder="">
				<label>Tuesday</label>
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <input type="checkbox" class="form-control" id="ID" placeholder="">
				<label>Wednesday</label>
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <input type="checkbox" class="form-control" id="ID" placeholder="">
				<label>Thursday</label>
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <input type="checkbox" class="form-control" id="ID" placeholder="">
				<label>Friday</label>
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <input type="checkbox" class="form-control" id="ID" placeholder="">
				<label>Saturday</label>
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-1">
	          <div class="field">
		        <input type="checkbox" class="form-control" id="ID" placeholder="">
				<label>Sunday</label>
			    </div>
    	    </div>		    
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
				<br>
		        <button type="submit" class="btn btn-success"><i class="far fa-save"></i>Add</button>
			    </div>
    	    </div> 
		  </div>
		  <h5 class="modal-title" id="classModalLabel">-</h5>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>Position</th>
				<th>Monday</th>
				<th>Tuesday</th>
				<th>Wednesday</th>
				<th>Thursday</th>	
				<th>Friday</th>
				<th>Saturday</th>
				<th>Sunday</th>
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>Forklift Operation</td>
			<td>Y</td>
			<td>Y</td>
			<td>Y</td>
			<td>Y</td>
			<td>Y</td>
			<td>Y</td>
			<td>N</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
			<td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>	
		</tbody>
		</table>
    </div>
</div>
<div class="modal fade bd-example-modal-xl" id="location" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">   	
      <div class="modal-body">
        <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Location</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Universal Location</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">AAL YARD 5 SKL</option>
                    <option value="02">AAL YARD 6B SKL</option>
                    <option value="03">PSB Jetty SKL</option>
                </select> 
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Contact 1</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Tel.</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Contact 2</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>Tel.</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>		
		  <br>
	      <button type="submit" class="btn btn-success"><i class="far fa-save"></i>Save</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>Cancel</button>
	    </form>
      </div>      
    </div>
  </div>
</div>


</body>
</html>
