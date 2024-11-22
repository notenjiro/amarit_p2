<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
        $_SESSION["user_name"] = $user_name;
        $_SESSION["name"] = $row['name'];

        $fQuery = "SELECT * from user_permission WHERE user_name = '$user_name'";
        $result = sqlsrv_query($conn, $fQuery);
        while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
            $_SESSION["menu"][$row['menu_id']]['access'] = $row['access'];
        }
        header( "location: mainmenu.php" );
    }else{
	?>
	<script>
		alert("ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง");
        window.location.replace("index.php");
	</script>
	<?php
	}
}
?>