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
<title>ระบบงานการฌาปนกิจสงเคราะห์ กรมป้องกันและบรรเทาสาธารณภัย</title>
</head>
<body>
  <p style="line-height:1px;margin:0px;"><br></p>
  <nav class="navbar text-white thead-light">
    <span class="navbar-brand mb-0 h1">
      บันทึกข้อมูลสมาชิก
	  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="far fa-plus-square"></i>เพิ่มข้อมูลสมาชิก</button>
    </span>
	<span class="navbar-brand mb-0 h1">
      ขึ้นทะเบียน
	  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirm"><i class="far fa-check-circle"></i>ผ่านการพิจารณา</button>
	  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancel"><i class="far fa-window-close"></i>ไม่ผ่านการพิจารณา</button>
    </span>
	<span class="navbar-brand mb-0 h1">
      รับชำระเงิน
	  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#payment"><i class="far fa-check-circle"></i>ชำระเงิน</button>
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
	  <th scope"col"></th>
	  <th scope"col">เลขที่ใบสมัคร</th>
	  <th scope"col">เลขประจำตัวประชาชน</th>
	  <th scope"col">ชื่อ</th>
	  <th scope"col">นามสกุล</th>
	  </tr>
	</thead>
	<tbody>
	  <tr>
	    <td align="center"><input type="checkbox" class="form-check" id="exampleCheck1"></td>
	    <td scope"col">1234</td>
	    <td scope"col">1234567890123</td>
	    <td scope"col">นายทดสอบ 1</td>
	    <td scope"col">ระบบ 1</td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
	  </tr>
	  <tr>
	    <td align="center"><input type="checkbox" class="form-check" id="exampleCheck1"></td>
	    <td scope"col">1235</td>
	    <td scope"col">2345678901234</td>
	    <td scope"col">นายทดสอบ 2</td>
	    <td scope"col">ระบบ 2</td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
	  </tr>
	  <tr>
	    <td align="center"><input type="checkbox" class="form-check" id="exampleCheck1"></td>
	    <td scope"col">1236</td>
	    <td scope"col">3456789012345</td>
	    <td scope"col">นายทดสอบ 3</td>
	    <td scope"col">ระบบ 3</td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
	  </tr>
	  <tr>
	    <td align="center"><input type="checkbox" class="form-check" id="exampleCheck1"></td>
	    <td scope"col">1237</td>
	    <td scope"col">4567890123456</td>
	    <td scope"col">นายทดสอบ 4</td>
	    <td scope"col">ระบบ 4</td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
	  </tr>
	  <tr>
	    <td align="center"><input type="checkbox" class="form-check" id="exampleCheck1"></td>
	    <td scope"col">1238</td>
	    <td scope"col">5678901234567</td>
	    <td scope"col">นายทดสอบ 5</td>
	    <td scope"col">ระบบ 5</td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
	  </tr>
	  <tr>
	    <td align="center"><input type="checkbox" class="form-check" id="exampleCheck1"></td>
	    <td scope"col">1239</td>
	    <td scope"col">6789012345678</td>
	    <td scope"col">นายทดสอบ 6</td>
	    <td scope"col">ระบบ 6</td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
	  </tr>
	  <tr>
	    <td align="center"><input type="checkbox" class="form-check" id="exampleCheck1"></td>
	    <td scope"col">1240</td>
	    <td scope"col">7890123456789</td>
	    <td scope"col">นายทดสอบ 7</td>
	    <td scope"col">ระบบ 7</td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
	  </tr>
	  <tr>
	    <td align="center"><input type="checkbox" class="form-check" id="exampleCheck1"></td>
	    <td scope"col">1241</td>
	    <td scope"col">8901234567890</td>
	    <td scope"col">นายทดสอบ 8</td>
	    <td scope"col">ระบบ 8</td>
		<td <button type="button" id="new" class="btn btn-warning" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-edit"></i>
			แก้ไข</button></td>
	    <td <button type="button" id="new" class="btn btn-danger" data-toggle="modal"
			date-target="#exampleModal"><i class="far fa-trash-alt"></i>
			ลบ</button></td>
	  </tr>
	</tbody>
	<table>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-xl" role="document" style="z-index:1040">
    <div class="modal-content">      
      <div class="modal-body">
        <form id="formMember">
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
	          <div class="field">
		        <label>เลขที่ใบสมัคร</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>วันที่สมัคร</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
			    </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-1">
		      <div class="field">
		        <label>รุ่นที่</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
			  </div>
    	    </div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>ประเภท</label>
		        <select id="type" name="type" class="form-control">
					<option value="1">สามัญ</option>
					<option value="2">วิสามัญ</option>
				</select>
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>วันที่รับใบสมัคร</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
		  </div>
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>รหัสคำนำหน้าชื่อ</label>
		        <select id="type" name="type" class="form-control">
					<option value="1">นาย</option>
					<option value="2">นาง</option>
					<option value="3">นางสาว</option>
				</select>
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
			<div class="col-xs-12 col-sm-6 col-md-3">
	  	      <div class="field">
	  	        <label>เลขประจำตัวประชาชน</label>
	  	        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
		  </div>
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>หมายเลขเงินเดือน</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>สถานะ</label>
		        <select id="type" name="type" class="form-control">
					<option value="1">พนง.ราชการ</option>
				</select>
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
	  	      <div class="field">
	  	        <label>ตำแหน่ง</label>
	  	        <select id="type" name="type" class="form-control">
					<option value="1">พนง.ป้องกันและบรรเทาสาธารณภัย</option>
				</select>
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>ระดับ</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
		      <div class="field">
		        <label>รหัสสังกัด</label>
		        <select id="type" name="type" class="form-control">
					<option value="1">พนักงานราชการ ปภ.</option>
				</select>
    	      </div>
			</div>
		  </div>
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-3">
		      <div class="field">
		        <label>โดย</label>
		        <select id="type" name="type" class="form-control">
					<option value="1">เริ่มรับราชการ</option>
				</select>
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>ในสังกัดนี้เมื่อ</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>เกิดเมื่อ</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-1">
		      <div class="field">
		        <label>อายุ</label>
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
		    <div class="col-xs-12 col-sm-6 col-md-3">
		      <div class="field">
		        <label>หมายเลขโทรศัพท์</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
		      <div class="field">
		        <label>-</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
		      <div class="field">
		        <label>บิดา</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
		      <div class="field">
		        <label>มราดา</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
		  </div>
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-4">
		      <div class="field">
		        <label>คู่สมรส</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4">
		      <div class="field">
		        <label>เลขทะเบียนสมรส</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>วันที่จดทะเบียน</label>
		        <input type="date" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
		  </div>
		  <div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>เงินค่าสมัคร</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>ค่าสงเคราะห์ล่วงหน้า</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-2">
		      <div class="field">
		        <label>เงินสงเคราะห์ฝากจ่าย</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
		      <div class="field">
		        <label>การชำระเงิน</label>
		        <select id="type" name="type" class="form-control">
					<option value="1">ชำระเอง</option>
				</select>
    	      </div>
			</div>
		  </div>
		  <div class="row">		    
			<div class="col-xs-12 col-sm-6 col-md-12">
		      <div class="field">
		        <label>หมายเหตุ</label>
		        <input type="text" class="form-control" id="ID" placeholder="">
    	      </div>
			</div>
		  </div>
		  <br>
	      <button type="submit" class="btn btn-success"><i class="far fa-save"></i>บันทึก</button>
		  <button type="submit" class="btn btn-danger"><i class="far fa-window-close"></i>ยกเลิก</button>
	    </form>
      </div>      
    </div>
  </div>
</div>

</body>
</html>


