<?php
  session_start();
  $edit_state = false;
  //connect to database
  $serverName = "I3OAT\SQL2019"; //serverName\instanceName
  $connectionInfo = array( "Database"=>"CRE", "UID"=>"sa", "PWD"=>"delphib006");
  $conn = sqlsrv_connect( $serverName, $connectionInfo);

  

  //code to save chart_of_account data
  if (isset($_POST['save'])) { 
    if(!empty($_POST['account_category_code']) && !empty($_POST['account_code']) && !empty($_POST['account_name']) && !empty($_POST['account_level']) && !empty($_POST['account_type'])) {
	  $account_category_code = $_POST['account_category_code'];
	  $account_code = $_POST['account_code'];
	  $account_name = $_POST['account_name'];
	  $account_level = $_POST['account_level'];
	  $account_type = $_POST['account_type'];
      echo $account_code;
	  $iquery = "INSERT INTO chart_of_account (account_category_code, account_code, account_name, account_level, account_type) VALUES (?, ?, ?, ?, ?)";
	  $params = array($account_category_code, $account_code, $account_name,$account_level, $account_type );
	  $stmt = sqlsrv_query($conn, $iquery, $params);
      $_SESSION['msg'] = "Saved";
	  echo $_SESSION['msg'];
	  header("location:index.php");
	}
  }
  //update record
  if (isset($_POST['edit'])) { 
    if(!empty($_POST['account_category_code']) && !empty($_POST['account_code']) && !empty($_POST['account_name']) && !empty($_POST['account_level']) && !empty($_POST['account_type'])) {
	  $account_category_code = $_POST['account_category_code'];
	  $account_code = $_POST['account_code'];
	  $account_name = $_POST['account_name'];
	  $account_level = $_POST['account_level'];
	  $account_type = $_POST['account_type'];
      echo $account_code;
	  $iquery = "UPDATE chart_of_account SET account_category_code = ?, account_code = ?, account_name = ?, account_level = ?, account_type = ?) WHERE account_code = ?";
	  $params = array($account_category_code, $account_code, $account_name,$account_level, $account_type,$account_code );
	  $stmt = sqlsrv_query($conn, $iquery, $params);
      $_SESSION['msg'] = "Update";
	  echo $_SESSION['msg'];
	  header("location:index.php");
	}
  }

  //receive reord
  $sQuery = "SELECT TOP (20) * FROM chart_of_account";
  $result = sqlsrv_query($conn, $sQuery);

#Delete select data
if (isset($_POST['delete'])) {
	$account_code = $_POST['delete'];
	$dquery = "DELETE FROM chart_of_account WHERE account_code = ?";
	$params = array($account_code);	
	$stmt = sqlsrv_query($conn, $dquery, $params);
	if( $stmt === true ) {
		$_SESSION['msg'] = "Selected record is successfully delete";
		$_SESSION['alert'] = "alert alert-danger";
	}
	//sqlsrv_close($conn);
	header("location:javascript://history.go(-1)");

}

?>