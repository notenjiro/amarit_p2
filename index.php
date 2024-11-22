
<?php 
 session_start();

 require_once 'config_db.php';
if(isset($_POST['user']) && isset($_POST['password']) ){

    $user_name = $_POST['user'];
    $pass_word = $_POST['password'];
    $fQuery = "SELECT * from users WHERE user_name = '$user_name' and password = '$pass_word'";
    $result = sqlsrv_query($conn, $fQuery);
    $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
    if(!empty($row)){
        header( "location: mainmenu.php" );
    }else{
		echo "b"
	?>
	
	<script>
		alert("ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง");
	</script>
	<?php
 	}
}
?>
<!DOCTYPE html>
<html lang "en dir"ltr">
  <head>
    <meta charset="utf-8">
	<title>Front end system</title>
	<link rel="stylesheet" href="stylelogin.css">
  </head>
  <style type="text/css">
    body {background-image: url('/img/background.jpg'); background-repeat: no-repeat;background-size: cover;background-position: center;}
  </style>
<body>
  <br></br><br>
  <h1 style="color:white;text-align:center">Front end system</h1>
  <div class="center">    
    <form method="post" action="login.php">
	  <div class="txt_field">
	    <input type="text" name="user" required>
		<span></span>
	    <label>Username</label>
      </div>
	  <div class="txt_field">
	    <input type="password" name="password" required>
		<span></span>
	   <label>Password</label>
	  </div>
      <input type="submit"  value="Login">
	  <br></br>
	</form>
  </div>
</body>
</html>
