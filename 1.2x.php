<html>
  <?php require 'master.php'; $MasterPage = 'master.php';?>

  <?php if (0):?><meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
  <link type="text/css" rel="stylesheet" href="style.css"/><?php endif;?>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
<script src="particles.min.js"></script>

<head>
<title>Front-end system</title>
</head>
<body style="background-color:GhostWhite">
  <p style="line-height:1px;margin:0px;"><br></p>
  <nav class="navbar text-white thead-light">
    <span class="navbar-brand mb-0 h1">
      Customer Contract
	  <button type="button" class="btn btn-success" onclick="window.location.href='1.2_Add.php'"><i class="fa fa-id-card"></i>Add</button>
    </span>
	<span class="navbar-brand mb-0 h1">
	  <input type="text" placeholder="Search.." class="form-control">
    </span>
	
  </nav>
  <div class="container-fluid">
    <br>
	<table id="tableMember" class="table mx-auto">
	<thead class="thead-light">
	  <tr>
	  <th scope"col"></th>
	  <th scope"col">Contract No.</th>
	  <th scope"col">Contract Date</th>
	  <th scope"col">Start Date</th>
	  <th scope"col">End Date</th>
	  <th scope"col">Customer</th>
	  <th scope"col">Customer Ref.</th>
	  <th scope"col">Active</th>
	  <th scope"col">Status</th>
	  </tr>
	</thead>
	<tbody>
	  <tr>
	    <td align="center"><input type="checkbox" class="form-check" id="exampleCheck1"></td>
	    <td scope"col">C00001</td>
	    <td scope"col">01/01/2564</td>
		<td scope"col">01/01/2564</td>
		<td scope"col">01/01/2565</td>
	    <td scope"col">National Oilwell Varco (Thailand) Ltd.</td>
		<td scope"col">10900</td>
		<td scope"col">Y</td>
		<td scope"col">on going</td>
		<td <button type="button"  class="btn btn-warning" data-toggle="modal" date-target="#exampleModal"><i class="far fa-edit"></i>Edit</button></td>
		<td <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#bb1"><i class="fa fa-id-card"></i>Delete</button></td>	
	  </tr>
	  <tr>
	    <td align="center"><input type="checkbox" class="form-check" id="exampleCheck1"></td>
	    <td scope"col">C00002</td>
	    <td scope"col">01/01/2564</td>
		<td scope"col">01/01/2564</td>
		<td scope"col">01/01/2565</td>
	    <td scope"col">ATWOOD OFFSHORE DRILLING LIMITED.</td>
		<td scope"col">10260</td>
		<td scope"col">Y</td>
		<td scope"col">on going</td>
		<td <button type="button"  class="btn btn-warning" data-toggle="modal" date-target="#exampleModal"><i class="far fa-edit"></i>Edit</button></td>
		<td <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#bb1"><i class="fa fa-id-card"></i>Delete</button></td>
	  </tr>
	  <tr>
	    <td align="center"><input type="checkbox" class="form-check" id="exampleCheck1"></td>
	    <td scope"col">C00003</td>
	    <td scope"col">01/01/2564</td>
		<td scope"col">01/01/2564</td>
		<td scope"col">01/01/2565</td>
	    <td scope"col">Chevron Thailand Exploration and Production, Ltd.</td>
		<td scope"col">10900</td>
		<td scope"col">Y</td>
		<td scope"col">on going</td>
		<td <button type="button"  class="btn btn-warning" data-toggle="modal" date-target="#exampleModal"><i class="far fa-edit"></i>Edit</button></td>
		<td <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#bb1"><i class="fa fa-id-card"></i>Delete</button></td>
	  </tr>
	</tbody>
	<table>
  </div>
  <div class="modal fade" id="bb1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog" role="document" style="z-index:1040">
    <div class="modal-content">      
      <div class="modal-body">
        <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-4">
	          <div class="field">
		        <label>Are you sure want to delete this</label>
			    </div>
    	    </div> 					
		  </div>
		  <br>
	      <button type="button" class="btn btn-success"><i class="far fa-save"></i>Confirm</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>Cancel</button>
		  <div class="modal-footer">
		    <table class="table table-striped">			  
			</table>
		  </div>
		</form>
	  </div>
	</div>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">      
      <div class="modal-body">
        <form id="formMember">
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
		<h5 style="background-color:Gray;color:White;" class="modal-title" id="classModalLabel">Location</h5>		
		</form>
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
		<br>
		<h5 style="background-color:Gray;color:White;" class="modal-title" id="classModalLabel">Cargo Transport Service > Transporation Rate</h5>		 
	
		</form>
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
		<br>
		<h5 style="background-color:Gray;color:White;" class="modal-title" id="classModalLabel">Cargo Transport Service > Service Rate</h5>	
		</form>
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
		<br>
		<h5 style="background-color:Gray;color:White;" class="modal-title" id="classModalLabel">Cargo Transport Service > Service Rate at Diesel Price Variable</h5>	
		</form>
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
		<br>
		<h5 style="background-color:Gray;color:White;" class="modal-title" id="classModalLabel">Cargo Handling Service > Heavy Equipment Rental</h5>	
		</form>
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
		<br>
		<h5 style="background-color:Gray;color:White;" class="modal-title" id="classModalLabel">Manpower Supply Service > non-working date table</h5>	
		</form>
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
		<br>
		<h5 style="background-color:Gray;color:White;" class="modal-title" id="classModalLabel">Manpower Supply Service > Overtime Charge Rates</h5>	
		</form>
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
		  <br>
		  <h5 style="background-color:Gray;color:White;" class="modal-title" id="classModalLabel">Manpower Supply Service > Hourly Rates</h5>	
		</form>
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
		  <br>
			<button type="submit" class="btn btn-success"><i class="far fa-save"></i>Save</button>
			<button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>Cancel</button>
	    </form>
      </div>      
    </div>
  </div>
</div>

<!-- ผู้รับผลประโยชน์ -->
<div class="modal" id="b1">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Contact List</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-4">
	          <div class="field">
		        <label>Name</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-4">
	          <div class="field">
		        <label>Tel.</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-4">
	          <div class="field">
		        <label>E-Mail Address</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>			
		  </div>		 
		  <br> <center>
		  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#a1"><i class="far fa-plus-square"></i>Add</button>
	      <button type="button" class="btn btn-success"><i class="far fa-save"></i>Save</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>Cancel</button> </center>
		  <h5 class="modal-title" id="classModalLabel">-</h5>		  
		</form>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>Name</th>
				<th>Tel.</th>
				<th>E-Mail Address</th>
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>K.Mingkwan T. / K.Somaek N.</td>
			<td>0-2 545-5555</td>
			<td>1234@hotmail.com</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
		</tr>
			<tr>
			<td>Mr.Sahadee K.</td>
			<td>0-2 545-5555</td>
			<td>1234@hotmail.com</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
			</tr>
		<tr>
			<td>K.CHALERMPORN.</td>
			<td>0-2 545-5555</td>
			<td>1234@hotmail.com</td>
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

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- ผู้ชำระเงินแทน -->
<div class="modal" id="b2">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Location</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Location</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Contact 1</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Tel.</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
		  </div>	
		  <div class="row">
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label></label>
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Contact 2</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>Tel.</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 					
		  </div>
		  <br> <center>
		  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a1"><i class="far fa-plus-square"></i>Add</button>
	      <button type="button" class="btn btn-success"><i class="far fa-save"></i>Save</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>Cancel</button> </center>
		  <h5 class="modal-title" id="classModalLabel">-</h5>		  
		</form>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>Location</th>
				<th>Contact 1</th>
				<th>Tel.</th>
				<th>Contact 2</th>
				<th>Tel.</th>			
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>Sadao border</td>
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

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- ผู้ถูกชำระแทน -->
<div class="modal" id="b3">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">ผู้ถูกชำระแทน</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>ประเภทสมาชิก</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>เลขทะเบียนสมาชิก</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>ชื่อ</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>นามสกุล</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>						
		  </div>		  
		  <br> 
		  <h5 class="modal-title" id="classModalLabel">รายการข้อมูล</h5>		  
		</form>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>ประเภทสมาชิก</th>
				<th>เลขทะเบียนสมาชิก</th>
				<th>ชื่อ</th>
				<th>นามสกุล</th>				
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>วิสามัญ</td>
			<td>67890</td>
			<td>นายทดสอบ 2</td>
			<td>ทดสอบ</td>
		</tbody>
		</table>
	  </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
      </div>

    </div>
  </div>
</div>
<!-- ชำระเงินค่าสงเคราะห์ -->
<div class="modal" id="b5">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">ชำระเงินค่าสงเคราะห์</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
	  <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>เลขทะเบียนสมาชิก</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
		    <div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>ชื่อ</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>นามสกุล</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>ชำระเงินล่าสุด</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>		
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>จำนวนเงิน</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		  </div>
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>เงินฝากจ่ายคงเหลือ</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>วันที่ชำระ</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>		
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>จำนวนเงินที่ชำระ</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>		    
		  </div>
		  <br> <center>
	      <button type="button" class="btn btn-success"><i class="far fa-save"></i>บันทึก</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>ยกเลิก</button> </center>
		  <h5 class="modal-title" id="classModalLabel">ข้อมูลผู้ชำระแทน</h5>		  
		</form>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>ประเภทสมาชิก</th>
				<th>เลขทะเบียนสมาชิก</th>
				<th>ชื่อ</th>
				<th>นามสกุล</th>	
				<th>จำนวนเงินที่ชำระ</th>
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>วิสามัญ</td>
			<td>67890</td>
			<td>นายทดสอบ 2</td>
			<td>ทดสอบ</td>
			<td>0</td>
		</tbody>
		</table>
		<h5 class="modal-title" id="classModalLabel">ข้อมูลผู้ถูกชำระแทน</h5>	
		<table class="table table-striped">
			<thead>
			<tr>
				<th>ประเภทสมาชิก</th>
				<th>เลขทะเบียนสมาชิก</th>
				<th>ชื่อ</th>
				<th>นามสกุล</th>	
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>สามัญ</td>
			<td>67899</td>
			<td>นายทดสอบ 99</td>
			<td>ทดสอบ</td>
		</tbody>
		</table>
	  </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
      </div>

    </div>
  </div>
</div>
</body>
</html>


