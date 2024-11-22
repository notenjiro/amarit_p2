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
      Worksheet
	  <button type="button" class="btn btn-success" onclick="window.location.href='3.1_Add.php'"><i class="fa fa-id-card"></i>Add</button>
	  Print
	  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#b1x"><i class="fa fa-print"></i>Worksheet</button>  
	  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#b1x"><i class="fa fa-envelope"></i>E-mail</button> 
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
	  <th scope"col">Worksheet ID</th>
	  <th scope"col">Date</th>
	  <th scope"col">Customer</th>
	  <th scope"col">Contract Number</th>
	  <th scope"col">Customer Ref.</th>
	  <th scope"col">Status</th>
	  </tr>
	</thead>
	<tbody>
	  <tr>
	    <td align="center"><input type="checkbox" class="form-check" id="exampleCheck1"></td>
	    <td scope"col">WS2110001</td>
	    <td scope"col">01/10/2021</td>
		<td scope"col">National Oilwell Varco (Thailand) Ltd.</td>
		<td scope"col">C00001</td>
	    <td scope"col"></td>
		<td scope"col">Open</td>		
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Attached</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>		
	  </tr>
	  <tr>
	    <td align="center"><input type="checkbox" class="form-check" id="exampleCheck1"></td>
		<td scope"col">WS2110002</td>
	    <td scope"col">01/10/2021</td>
		<td scope"col">ATWOOD OFFSHORE DRILLING LIMITED.</td>
		<td scope"col">C00002</td>
	    <td scope"col"></td>
		<td scope"col">Open</td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Attached</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
	  </tr>
	  <tr>
		<td align="center"><input type="checkbox" class="form-check" id="exampleCheck1"></td>
		<td scope"col">WS2110003</td>
	    <td scope"col">01/10/2021</td>
		<td scope"col">Chevron Thailand Exploration and Production, Ltd.</td>
		<td scope"col">C00003</td>
	    <td scope"col"></td>
		<td scope"col">Open</td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Attached</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
	  </tr>
	</tbody>
	<table>
  </div>
  <div class="modal fade" id="bb1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">      
      <div class="modal-body">
        <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-4">
	          <div class="field">
		        <label>ชื่อ</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-4">
	          <div class="field">
		        <label>นามสกุล</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-4">
	          <div class="field">
		        <label>ความสัมพันธ์</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>			
		  </div>
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-4">
		      <div class="field">
		        <label>ที่อยู่ปัจจุบัน</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4">
		      <div class="field">
		        <label>-</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>จังหวัด</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>รหัสไปรษณีย์</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
		  </div>
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-4">
	          <div class="field">
		        <label>หมายเลขโทรศัพท์</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			  </div>
    	    </div>
		  </div>
		  <br>
		  <button type="button" class="btn btn-primary"><i class="far fa-plus-square"></i>เพิ่มข้อมูล</button>
	      <button type="button" class="btn btn-success"><i class="far fa-save"></i>บันทึก</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>ยกเลิก</button>
		  <h5 class="modal-title" id="classModalLabel">รายการข้อมูล</h5> 
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
		        <label>Contract Number</label>
		        <select name="transfer_by" class="form-control">
					<option value="01">C00001</option>
                    <option value="02">C00002</option>
                    <option value="03">C00003</option>
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
		<h5 style="background-color:Green;color:White;" class="modal-title" id="classModalLabel">Cargo Transport</h5>		
		</form>
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
		<h5 style="background-color:Green;color:White;" class="modal-title" id="classModalLabel">Manpower</h5>	
		</form>
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
		<h5 style="background-color:Green;color:White;" class="modal-title" id="classModalLabel">Cargo Handling</h5>		
		</form>
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


