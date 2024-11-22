<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 
session_start();

require_once 'config_db.php';
require_once 'utils/helper.php';
if(isset($_POST['user']) && isset($_POST['password']) ){

    $user_name = $_POST['user'];
    $pass_word = $_POST['password'];
    $fQuery = "SELECT * from users WHERE user_name = '$user_name' and password = '$pass_word'";
    $result = sqlsrv_query($conn, $fQuery);
    $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
    if(!empty($row)){
        $_SESSION["user_name"] = $user_name;
        $_SESSION["name"] = $row['name'];
        $_SESSION["user_role"] = $row['user_role'];
        $_SESSION["reopen"] = $row['reopen'];
		$_SESSION["show_price"] = $row['show_price'];
		$_SESSION["print_worksheet"] = $row['print_worksheet'];
		$_SESSION["branch"] = $row['branch'];
        $_SESSION["department"] =  $row['department'];
        $_SESSION["cost_center"] = $row['cost_center'];

        //add
        if( $row['user_type'] == 'ALL'){
          $_SESSION["user_type"] = 'AAL';
        }else{
          $_SESSION["user_type"] = $row['user_type'];
        }
        $_SESSION["type_user"] = $row['user_type'];

        $fQuery = "SELECT * from user_permission WHERE user_name = '$user_name'";
        $result = sqlsrv_query($conn, $fQuery);
        while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
            $_SESSION["menu"][$row['menu_id']]['access'] = $row['access'];
            $_SESSION["menu"][$row['menu_id']]['add'] = $row['is_add'];
            $_SESSION["menu"][$row['menu_id']]['edit'] = $row['is_edit'];
            $_SESSION["menu"][$row['menu_id']]['delete'] = $row['is_delete'];
        }
        userlogs('Login',$conn);
        if($_SESSION["user_role"]=='driver')
            header( "location: 5.1.php" );
        else
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