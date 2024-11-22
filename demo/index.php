<?php include("chart_of_account.php"); ?>
<!DOCTYPE html>
<html>
  <head>
	<title>CRUD</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
<script src="particles.min.js"></script>
  </head>
<body>
  <?php if (isset($_SESSION['msg'])): ?>
    <div class="msg">
	  <?php
	    echo $_SESSION['msg'];
		//unset($_SESSION['msg']);
	  ?>
	</div>
  <?php endif ?>

  <table>
    <thead>
	  <tr>
		<th>รหัสหมวดหมู่บัญชี</th>
		<th>รหัสบัญชี</th>
		<th>ชื่อบัญชี</th>
		<th>ระดับ</th>
		<th>ประเภท</th>
	  </tr>
	</thead>
	<tbody>
	  <?php
		while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {?>
		  <tr>
		    <td><?= $row['account_category_code']; ?></td>
		    <td><?= $row['account_code']; ?></td>
		    <td><?= $row['account_name']; ?></td>
		    <td><?= $row['account_level']; ?></td>
		    <td><?= $row['account_type']; ?></td>
		    <td style="width: 20%">
		    <button type="button" name="edit" value="<?= $x; $x++;?>" class="btn btn-primary" ><i class="far fa-trash-alt"></i>แก้ไข</button>
		    <button type="submit" name="delete" value="<?= $row['account_code']; ?>" class="btn btn-danger" ><i class="far fa-edit"></i>ลบ</button>				
		    </td>
    	  </tr>
 	  <?php } ?>  
	</tbody>
  </table>
  <form method="POST" action"chart_of_account.php">
    <div class"input-grop">
	  <label>รหัสหมวดหมู่บัญชี</label>
	  <select id="account_category_code" name="account_category_code" class="form-control" value"<?php echo $account_category_code; ?>">
	    <option value="1">สินทรัพย์</option>
	    <option value="2">หนี้สิน</option>
	    <option value="3">ทุน</option>
	    <option value="4">รายได้</option>
	    <option value="5">ค่าใช้จ่าย</option>
	  </select>
	</div>
    <div class"input-grop">
	  <label>รหัสบัญชี</label>
	  <input type="text" id="account_code" name="account_code" class="form-control" value"<?php echo $account_code; ?>">
	</div>
	<div class"input-grop">
	  <label>ชื่อบัญชี</label>
	  <input type="text" id="account_name" name="account_name" class="form-control" value"<?php echo $account_name; ?>">
	</div>
	<div class"input-grop">
	  <label>ระดับ</label>
	  <select id="account_level" name="account_level" class="form-control" value"<?php echo $account_level; ?>">
	    <option value="1">1</option>
	    <option value="2">2</option>
	    <option value="3">3</option>
	    <option value="1">4</option>
	    <option value="2">5</option>
	    <option value="3">6</option>
	  </select>
	</div>
	<div class"input-grop">
	  <label>ประเภท</label>
	    <select id="account_type" name="account_type" class="form-control" value"<?php echo $account_type; ?>">
		  <option value="1">G</option>
		  <option value="2">D</option>
	  </select>
	</div>
	<div class"input-grop">
	    <button type="submit" name="save" class="btn btn-info"><i class="far fa-save"></i>บันทึก</button>
	</div>

	<script type="text/javascript">
	  $(document).ready(function(){
	    setfunction(function(){
		  $(".msg").remove();
		}, 3000);
	</script>

  <form>
</body>
</html>
