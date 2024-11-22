<html>
<head>
<meta charset="utf-8">
<title>Front-end system</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>	
  <nav>
    <a href="index.php"><div class="logo">logout</div></a>
	<a href="mainmenu.php"><div class="logo">Home</div></a>
	<label for "btn" class="icon">
	  <span class="fa fa-bars"></span>
	</label>
	<input type="checkbox" id="btn">
    <ul>
      <li>
	    <label for="btn-1" class="show">Master Data +</label>
		<a href="#"></i>1.Master Data</a>
		<input type="checkbox" id="btn-1">
		<ul>
			<li><a href="1.1.php">1.1.Customer Master</a></li>
			<li><a href="1.2.php">1.2.Customer Contract</a></li>
			<li><a href="1.3.php">1.3.Vehicle Master</a></li>
			<li><a href="1.4.php">1.4.Vehicle Type</a></li>
			<li><a href="1.5.php">1.5.Vehicle Brand</a></li>
			<li><a href="1.6.php">1.6.Vehicle Group</a></li>
			<li><a href="1.7.php">1.7.Vehicle Category</a></li>
			<li><a href="1.8.php">1.8.Vehicle Owner</a></li>
			<li><a href="1.9.php">1.9.Location</a></li>
			<li><a href="1.10.php">1.10.Branch</a></li>
			<li><a href="1.11.php">1.11.Operator</a></li>
			<li><a href="1.12.php">1.12.Position</a></li>
			<li><a href="1.13.php">1.13.Labor</a></li>
			<li><a href="1.14.php">1.14.Skill</a></li>
			<li><a href="1.15.php">1.15.Driver non-working date table</a></li> 
			<li><a href="1.16.php">1.16.Vehicle non-working date table</a></li>
			<li><a href="1.17.php">1.17.Worksheet reject reason</a></li>
			<li><a href="1.18.php">1.18.Driver absence reason</a></li>
			<li><a href="1.19.php">1.19.Trip type</a></li>
			<li><a href="1.20.php">1.20.Charge type</a></li>
			<li><a href="1.21.php">1.21.Additional charge</a></li>
			<li><a href="1.22.php">1.22.Distance</a></li> 
			<li><a href="1.23.php">1.23.Reason for outsource</a></li>
			<li><a href="1.24.php">1.24.Reason for cancel worksheet</a></li>
			<li><a href="1.25.php">1.25.Crane</a></li>
			<li><a href="1.26.php">1.26.Forklift</a></li>
			<li><a href="1.27.php">1.27.Reason for create worksheet backdate</a></li>
			<li><a href="1.28.php">1.28.Service type</a></li>
			<li><a href="1.29.php">1.29.Sub Task</a></li>
			<li><a href="1.30.php">1.30.Day Type</a></li>
			<li><a href="1.31.php">1.31.Invoice Template </a></li>
		</ul>
	  </li>
      <li>
	    <label for="btn-2" class="show">System Administration +</label>
		<a href="#">2.System Administration</a>
		<input type="checkbox" id="btn-2">
		<ul>
			<li><a href="2.1.php">2.1.Application Setup</a></li>
			<li><a href="2.2.php">2.2.E-mail Setup</a></li>
			<li><a href="2.3.php">2.3.User login</a></li>
			<li><a href="2.4.php">2.4.User menu permission</a></li>
			<li><a href="2.5.php">2.5.User log</a></li>
		</ul>
	  </li>
	  <li>
	    <label for="btn-3" class="show">Transaction+</label>
		<a href="#">3.Transaction</a>
		<input type="checkbox" id="btn-3">
		<ul>
			<li><a href="3.1.php">3.1.Worksheet</a></li>
		</ul>
	  </li>
	  <li>
	    <label for="btn-4" class="show">Report +</label>
		<a href="#">4.Report</a>
		<input type="checkbox" id="btn-4">
		<ul>
			<li><a href="4.1.php">4.1.Worksheet status</a></li>
			<li><a href="4.5.jpg">4.2.Time sheet</a></li>
		</ul>
	  </li>
	  <li>
	    <label for="btn-5" class="show">Driver +</label>
		<a href="#">5.Driver</a>
		<input type="checkbox" id="btn-5">
		<ul>
			<li><a href="5.1.php">5.1.Start & End Trip</a></li>
		</ul>
	  </li>
	</ul>
  </nav>
<!-- ข้อมูลประเภทสมาชิก -->
<div class="modal" id="b111">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">ข้อมูลประเภทสมาชิก</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>รหัสประเภทสมาชิก</label>
		        <input type="text" class="form-control" id="ID" placeholder="" >
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>ชื่อประเภทสมาชิก</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>	
		  </div>
		  <br> <center>
		  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a1"><i class="far fa-plus-square"></i>เพิ่มข้อมูล</button>
	      <button type="button" class="btn btn-success"><i class="far fa-save"></i>บันทึก</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>ยกเลิก</button> </center>
		  <h5 class="modal-title" id="classModalLabel">รายการข้อมูล</h5>		  
		</form>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>รหัสประเภทสมาชิก</th>
				<th>ชื่อประเภทสมาชิก</th>
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>1</td>
			<td>สามัญ</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
			<tr>
			<td>2</td>
			<td>วิสามัญ</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
			</tr>
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
<!-- ข้อมูลคำนำหน้าชื่อ -->
<div class="modal" id="b112">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">ข้อมูลคำนำหน้าชื่อ</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>รหัสคำนำหน้าชื่อ</label>
		        <input type="text" class="form-control" id="ID" placeholder="" >
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>รายละเอียด</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>	
		  </div>
		  <br> <center>
		  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a1"><i class="far fa-plus-square"></i>เพิ่มข้อมูล</button>
	      <button type="button" class="btn btn-success"><i class="far fa-save"></i>บันทึก</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>ยกเลิก</button> </center>
		  <h5 class="modal-title" id="classModalLabel">รายการข้อมูล</h5>		  
		</form>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>รหัสคำนำหน้าชื่อ</th>
				<th>รายละเอียด</th>
			</tr>
			</thead>
		<tbody>
		<tr>
			<td>นาย</td>
			<td>นาย</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
		<tr>
			<td>นาง</td>
			<td>นาง</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
		<tr>
			<td>นางสาว</td>
			<td>นางสาว</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
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
<!-- ข้อมูลสถานะ -->
<div class="modal" id="b113">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">ข้อมูลสถานะ</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>รหัสสถานะ</label>
		        <input type="text" class="form-control" id="ID" placeholder="" >
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>รายละเอียด</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>	
		  </div>
		  <br> <center>
		  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a1"><i class="far fa-plus-square"></i>เพิ่มข้อมูล</button>
	      <button type="button" class="btn btn-success"><i class="far fa-save"></i>บันทึก</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>ยกเลิก</button> </center>
		  <h5 class="modal-title" id="classModalLabel">รายการข้อมูล</h5>		  
		</form>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>รหัสสถานะ</th>
				<th>รายละเอียด</th>
			</tr>
			</thead>
		<tbody>
		<tr>
			<td>1</td>
			<td>พนง.ราชการ</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
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
<!-- ข้อมูลตำแหน่ง -->
<div class="modal" id="b114">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">ข้อมูลตำแหน่ง</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>รหัสตำแหน่ง</label>
		        <input type="text" class="form-control" id="ID" placeholder="" >
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>ชื่อตำแหน่ง</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>	
		  </div>
		  <br> <center>
		  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a1"><i class="far fa-plus-square"></i>เพิ่มข้อมูล</button>
	      <button type="button" class="btn btn-success"><i class="far fa-save"></i>บันทึก</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>ยกเลิก</button> </center>
		  <h5 class="modal-title" id="classModalLabel">รายการข้อมูล</h5>		  
		</form>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>รหัสตำแหน่ง</th>
				<th>ชื่อตำแหน่ง</th>
			</tr>
			</thead>
		<tbody>
		<tr>
			<td>10000</td>
			<td>พนง.ประจำสำนักงาน</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
		<tr>
			<td>10001</td>
			<td>พนง.ป้องกันและบรรเทา</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
		<tr>
			<td>10002</td>
			<td>นักบริหาร</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
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
<!-- ข้อมูลรหัสสังกัดหน่วยงาน -->
<div class="modal" id="b115">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">ข้อมูลรหัสสังกัดหน่วยงาน</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>รหัสสังกัดหน่วยงาน</label>
		        <input type="text" class="form-control" id="ID" placeholder="" >
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>ชื่อสังกัดหน่วยงาน</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>	
		  </div>
		  <br> <center>
		  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a1"><i class="far fa-plus-square"></i>เพิ่มข้อมูล</button>
	      <button type="button" class="btn btn-success"><i class="far fa-save"></i>บันทึก</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>ยกเลิก</button> </center>
		  <h5 class="modal-title" id="classModalLabel">รายการข้อมูล</h5>		  
		</form>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>รหัสสังกัดหน่วยงาน</th>
				<th>ชื่อสังกัดหน่วยงาน</th>
			</tr>
			</thead>
		<tbody>
		<tr>
			<td>200</td>
			<td>ลจ.สนง.ทางหลวงชนบท</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
		<tr>
			<td>300</td>
			<td>ข้าราชการกรมป้องกัน</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
		<tr>
			<td>400</td>
			<td>พนักงานราชการ ปภ.</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
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
<!-- กำหนดสิทธิในการใช้งาน -->
<div class="modal" id="b116">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">กำหนดสิทธิในการใช้งาน</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>รหัสผู้ใช้งาน</label>
		        <input type="text" class="form-control" id="ID" placeholder="" >
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>รหัสผ่าน</label>
		        <input type="text" class="form-control" id="ID" placeholder="" >
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>ชื่อผู้ใช้งาน</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>	
		  </div>
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    1.งานทะเบียนสมาชิก<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    เพิ่มข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    แก้ไขข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div>	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    ลบข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div>	
		  </div>
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    2.การเรียกเก็บเงิน<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    เพิ่มข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    แก้ไขข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div>	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    ลบข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div>	
		  </div>
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    3.การทวงเงินสงเคราะห์<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    เพิ่มข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    แก้ไขข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div>	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    ลบข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div>	
		  </div>
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    4.งานทะเบียนธุรการ<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    เพิ่มข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    แก้ไขข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div>	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    ลบข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div>	
		  </div>
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    5.การจ่ายเงินสงเคราะห์<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    เพิ่มข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    แก้ไขข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div>	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    ลบข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div>	
		  </div>
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    6.บัญชี<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    เพิ่มข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    แก้ไขข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div>	
			<div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
			    ลบข้อมูล<input type="checkbox" class="form-check" id="exampleCheck1">
			  </div>
    	    </div>	
		  </div>
		  <br> <center>
		  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a1"><i class="far fa-plus-square"></i>เพิ่มข้อมูล</button>
	      <button type="button" class="btn btn-success"><i class="far fa-save"></i>บันทึก</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>ยกเลิก</button> </center>
		  <h5 class="modal-title" id="classModalLabel">รายการข้อมูล</h5>		  
		</form>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>รหัสผู้ใช้งาน</th>
				<th>ชื่อผู้ใช้งาน</th>
			</tr>
			</thead>
		<tbody>
		<tr>
			<td>admin</td>
			<td>ผู้ดูแลระบบ</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
		<tr>
			<td>pook</td>
			<td>บัญชี</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
		<tr>
			<td>joy</td>
			<td>งานทะเบียนสมาชิก</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
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
<!-- ข้อมูลสมุดรายวัน -->
<div class="modal" id="b610">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">ข้อมูลสมุดรายวัน</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>รหัสสมุดรายวัน</label>
		        <input type="text" class="form-control" id="ID" placeholder="" >
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>ชื่อสมุดรายวัน</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>	
		  </div>
		  <br> <center>
		  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a1"><i class="far fa-plus-square"></i>เพิ่มข้อมูล</button>
	      <button type="button" class="btn btn-success"><i class="far fa-save"></i>บันทึก</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>ยกเลิก</button> </center>
		  <h5 class="modal-title" id="classModalLabel">รายการข้อมูล</h5>		  
		</form>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>รหัสสมุดรายวัน</th>
				<th>ชื่อสมุดรายวัน</th>
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>01</td>
			<td>ทั่วไป</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
			<tr>
			<td>02</td>
			<td>รับ</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
			</tr>
		</tr>
			<tr>
			<td>03</td>
			<td>จ่าย</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
			</tr>
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
<!-- ข้อมูลรหัสหมวดหมู่บัญชี -->
<div class="modal" id="b611">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">ข้อมูลรหัสหมวดหมู่บัญชี</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>รหัสหมวดหมู่บัญชี</label>
		        <input type="text" class="form-control" id="ID" placeholder="" >
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>ชื่อหมวดหมู่บัญชี</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>	
		  </div>
		  <br> <center>
		  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a1"><i class="far fa-plus-square"></i>เพิ่มข้อมูล</button>
	      <button type="button" class="btn btn-success"><i class="far fa-save"></i>บันทึก</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>ยกเลิก</button> </center>
		  <h5 class="modal-title" id="classModalLabel">รายการข้อมูล</h5>		  
		</form>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>รหัสหมวดหมู่บัญชี</th>
				<th>ชื่อหมวดหมู่บัญชี</th>
			</tr>
			</thead>
		<tbody>
			<tr>
			<td>1</td>
			<td>สินทรัพย์</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
			<tr>
			<td>2</td>
			<td>หนี้สิน</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
			</tr>
		</tr>
			<tr>
			<td>3</td>
			<td>ทุน</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
			</tr>
		</tr>
			<tr>
			<td>4</td>
			<td>รายได้</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
			</tr>
		</tr>
			<tr>
			<td>5</td>
			<td>ค่าใช้จ่าย</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
			</tr>
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
<!-- ข้อมูลสาเหตุการเสียชีวิต -->
<div class="modal" id="b512">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">ข้อมูลสาเหตุการเสียชีวิต</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>รหัสสาเหตุการเสียชีวิต</label>
		        <input type="text" class="form-control" id="ID" placeholder="" >
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>รายละเอียด</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>	
		  </div>
		  <br> <center>
		  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a1"><i class="far fa-plus-square"></i>เพิ่มข้อมูล</button>
	      <button type="button" class="btn btn-success"><i class="far fa-save"></i>บันทึก</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>ยกเลิก</button> </center>
		  <h5 class="modal-title" id="classModalLabel">รายการข้อมูล</h5>		  
		</form>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>รหัสสาเหตุการเสียชีวิต</th>
				<th>รายละเอียด</th>
			</tr>
			</thead>
		<tbody>
		<tr>
			<td>1</td>
			<td>อุบัติเหตุ</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
		<tr>
			<td>2</td>
			<td>โรคมะเร็ง</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
		<tr>
			<td>3</td>
			<td>โรคหัวใจ</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
		<tr>
			<td>4</td>
			<td>โรคปอด</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
		<tr>
			<td>5</td>
			<td>โรคหลอดเลือดในสมอง</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
		<tr>
			<td>6</td>
			<td>โรคเบาหวาน</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
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