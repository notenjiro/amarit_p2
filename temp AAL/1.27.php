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
<body>
  <p style="line-height:1px;margin:0px;"><br></p>
  <nav class="navbar text-white thead-light">
    <span class="navbar-brand mb-0 h1">
      Reason for create worksheet backdate
	  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-id-card"></i>Add</button> 
    </span>
	<span class="navbar-brand mb-0 h1">
	  <input type="text" placeholder="Search.." class="form-control">
    </span>
	
  </nav>
  <div class="container">
    <br>
	<table id="tableMember" class="table mx-auto">
	<thead class="thead-light">
	  <tr>
	  <th scope"col">#</th>
	  <th scope"col">Code</th>
	  <th scope"col">Description</th>
	  </tr>
	</thead>
	<tbody>
	  <tr>
	    <td scope"col">1</td>
	    <td scope"col">01</td>
	    <td scope"col">reason 1</td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>		
	  </tr>
	  <tr>
	    <td scope"col">2</td>
	    <td scope"col">02</td>
	    <td scope"col">reason 1</td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
	  </tr>
	  <tr>
	    <td scope"col">3</td>
	    <td scope"col">03</td>
	    <td scope"col">reason 1</td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			Delete</button></td>
	  </tr>
	  <tr>
	    <td scope"col">4</td>
	    <td scope"col">04</td>
	    <td scope"col">reason 1</td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			Edit</button></td>
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
		        <label>Code</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-4">
		      <div class="field">
		        <label>Description</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
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

<!-- ผู้รับผลประโยชน์ -->
<div class="modal" id="b1">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">รายชื่อผู้ติดต่อ</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-4">
	          <div class="field">
		        <label>รายชื่อผู้ตอดต่อ</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div> 
			<div class="col-xs-12 col-sm-6 col-md-4">
	          <div class="field">
		        <label>เบอร์ติดต่อ</label>
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
		  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a1"><i class="far fa-plus-square"></i>เพิ่มข้อมูล</button>
	      <button type="button" class="btn btn-success"><i class="far fa-save"></i>บันทึก</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>ยกเลิก</button> </center>
		  <h5 class="modal-title" id="classModalLabel">รายการข้อมูล</h5>		  
		</form>
        <table class="table table-striped">
			<thead>
			<tr>
				<th>รายชื่อผู้ตอดต่อ</th>
				<th>เบอร์ติดต่อ</th>
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
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
		</tr>
			<tr>
			<td>Mr.Sahadee K.</td>
			<td>0-2 545-5555</td>
			<td>1234@hotmail.com</td>
			<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
			</tr>
		<tr>
			<td>K.CHALERMPORN.</td>
			<td>0-2 545-5555</td>
			<td>1234@hotmail.com</td>
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

<!-- ผู้ชำระเงินแทน -->
<div class="modal" id="b2">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">สถานที่และผู้รับสินค้า</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>สถานที่</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>ผู้รับสินค้า 1</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>เบอร์โทรผู้รับสินค้า 1</label>
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
		        <label>ผู้รับสินค้า 2</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
		    <div class="col-xs-12 col-sm-6 col-md-3">
	          <div class="field">
		        <label>เบอร์โทรผู้รับสินค้า 2</label>
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
				<th>สถานที่</th>
				<th>ผู้รับสินค้า 1</th>
				<th>เบอร์โทรผู้รับสินค้า 1</th>
				<th>ผู้รับสินค้า 2</th>
				<th>เบอร์โทรผู้รับสินค้า 2</th>			
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
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
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


