<?php 
 session_start();
 if(!isset($_SESSION["user_name"])){
 	header( "location: logout.php" );
 }
 $pages = explode(".",str_replace("/","",$_SERVER['REQUEST_URI']));


 if($pages[0] != 'mainmenu' && !$_SESSION['menu'][$pages[0]]['access'] && $_SESSION["user_type"] != "AAL" && $_SESSION["user_type"] != "Admin" ){
 	header( "location: mainmenu.php" );
 }

 $menu = $pages[0];
 $btn = "";

 if(isset($_SESSION["menu"][$menu])){
 	if($_SESSION["menu"][$menu]['edit'] || $_SESSION["type_user"] == 'ALL')
 		$btn .= "<button style=\\\"width:100px\\\" type=\\\"button\\\" class=\\\"btn btn-warning editbtn\\\"><i class=\\\"fa fa-edit\\\"></i> Edit</button> ";
 	else if($_SESSION["menu"][$menu]['access'] || $_SESSION["type_user"] == 'ALL')
 		$btn .= "<button style=\\\"width:100px\\\" type=\\\"button\\\" class=\\\"btn btn-info infobtn\\\"><i class=\\\"fa fa-info\\\"></i> View</button> ";
 	if($_SESSION["menu"][$menu]['delete'] || $_SESSION["type_user"] == 'ALL')
 		$btn .= "<button style=\\\"width:100px\\\" type=\\\"button\\\" class=\\\"btn btn-danger deletebtn\\\"><i class=\\\"fa fa-trash-alt\\\"></i> Delete</button> ";
 }else{
 	$btn = "";
 }

 $btn_table_in_popup  = "";
 $btn_table_in_popup .= "<button style=\\\"width:100px\\\" type=\\\"button\\\" class=\\\"btn  btn-primary editbt \\\" id=\\\"editbt\\\"><i class=\\\"fa fa-edit\\\"></i> Edit</button> ";
 $btn_table_in_popup .= "<button style=\\\"width:100px\\\" type=\\\"button\\\" class=\\\"btn btn-danger deletebt\\\" id=\\\deletebt\\\"><i class=\\\"fa fa-trash-alt\\\"></i> Delete</button> ";

?>

<html>
<head>
<meta charset="utf-8">
<title>Front-end system</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.th.min.js" integrity="sha512-cp+S0Bkyv7xKBSbmjJR0K7va0cor7vHYhETzm2Jy//ZTQDUvugH/byC4eWuTii9o5HN9msulx2zqhEXWau20Dg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

<script src="/web_components/bootstrap-datepicker-BE.js"></script>
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<!-- SSL error -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert@latest/dist/sweetalert.min.js"></script>

<script src= "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="utils/helper.js"></script>

<?php include_once('utils/helper.php');?>

<style type="text/css">
    .lower {
        text-transform:lowercase
    }
	.result {
		position: absolute;
		width: 100%;
		max-width:870px;
		cursor: pointer;
		overflow-y: auto;
		max-height: 400px;
		box-sizing: border-box;
		z-index: 1001;
  	}
	.e_result {
		position: absolute;
		width: 100%;
		max-width:870px;
		cursor: pointer;
		overflow-y: auto;
		max-height: 400px;
		box-sizing: border-box;
		z-index: 1001;
  	}
	.link-class:hover{
		background-color:#f1f1f1;
	}
	.mainmenu {
		max-height: 40em;
		overflow: scroll;
		overflow-x: hidden;
		z-index: 1500;
	}
	.modal{
    /* -webkit-filter: blur(5px) grayscale(90%); */
	background-color: rgba(0,0,0,.4);
	
	}

	.btn-success
	{
		background-color: #1e6337 !important;
		border-color: #1e6337 !important;
	}
	.btn-danger
	{
		background-color: #fa0606 !important;
		border-color: #fa0606 !important;
	}
	.btn-warning
	{
		background-color: #6dbe57 !important;
		border-color: #6dbe57 !important;
	}

	.form-check {width: 20px; height: 20px;}

</style>

<script>
	$(document).ready(function(){
		$(".close").on( 'click',  function () {
			$(".modal").modal('hide');
		});
		<?php if(!$_SESSION["menu"][$menu]['add']) { ?>
			$("button[id$=_add]").hide();
		<?php } ?>
	});

	var btn_table = "<?php echo $btn; ?>";
	var btn_table_in_popup = "<?php echo $btn_table_in_popup; ?>";


</script>
</head>
<body>	
<?php 
if($_SERVER['PHP_SELF'] != '/5.1.php'){;
?>
  <nav 
  
  <?php //เปลี่ยนสี nav ตาม type ของ user
    if ($_SESSION["user_type"] == 'Admin' || $_SESSION["user_type"] == 'AA') {
        echo 'style="background-color:red"';
    } elseif ($_SESSION["user_type"] == 'AAL' ) {
        echo 'style="background-color:#1c6337"';
    } 
    ?>
	>
    <a href="logout.php"><div class="logo">logout</div></a>
	<a href="mainmenu.php"><div class="logo">Home</div></a>
	<a><div class="logo d-flex flex-column  justify-content-evenly col-xl-2" style="line-height:35px"> 
		<span>
		User : &nbsp; <?php echo $_SESSION["name"] ?>
	 	<?php // แสดง type ของ user
   			 if ($_SESSION["user_type"] == 'Admin') {
        	 echo '( Admin )';
    		} elseif ($_SESSION["user_type"]  == 'AAL' && $_SESSION["type_user"] == 'AAL') {
       	     echo '( AAL )';
    		} elseif ($_SESSION["user_type"] == 'AA' && $_SESSION["type_user"] == 'AA') {
			 echo '( AA )';
    		} elseif ($_SESSION["type_user"] == 'ALL') {
				echo '( ALL )';
			   }

    	?>
		</span>
		<?php 
		if ($_SESSION["type_user"] == 'ALL' ) { ?>
			<select class="p-0 dropdownChangetypeUser" id="select-type-user">
					<option value="AAL" 
					<?php  
					if($_SESSION["user_type"] == 'AAL'){
						echo 'selected';
					}
					?>
					>AAL ( Amarit and Associates Logistics Company Limited )</option>
					<option value="AA"
					<?php  
					if($_SESSION["user_type"] == 'AA'){
						echo 'selected';
					}
					?>
					>AA ( Amarit and Associates Co.,Ltd. )</option>
			</select>
		<?php
		   }
		?>
		<?php  if($_SESSION["type_user"] != 'ALL'){  // แสดง type ของ user ?>
		<span class="tagType">
		<?php
   			 if ($_SESSION["user_type"] == 'Admin') {
        	 echo 'Admin';
    		} elseif ($_SESSION["user_type"] == 'AAL' && $_SESSION["type_user"] == 'AAL') {
       	     echo 'Amarit and Associates Logistics Company Limited';
    		} elseif ($_SESSION["user_type"] == 'AA' && $_SESSION["type_user"] == 'AA') {
			 echo 'Amarit and Associates Co.,Ltd.';
    		}
    	?>	
		</span>
		<?php } ?>
		</div>
	</a>
	<label for "btn" class="icon">
	  <span class="fa fa-bars"></span>
	</label>
	<input type="checkbox" id="btn">
    <ul
	
	<?php //เปลี่ยนสี nav ตาม type ของ user
    		if ($_SESSION["user_type"] == 'Admin' || $_SESSION["user_type"] == 'AA') {
       			echo 'class="liAdmin"';
    		} elseif ($_SESSION["user_type"] == 'AAL' ) {
				echo 'class=" liAAL"';
    		}
    	?>
		>
	  <?php if($_SESSION['menu'][1]['access']){ ?>
      <li>
	    <label for="btn-1" class="show">Master Data +</label>
		<a href="#"></i>Master Data</a>
		<input type="checkbox" id="btn-1">
		<ul class="mainmenu">	
			<li><a href="1.10.php">Branch</a></li>
			<!-- <li><a href="1.42.php">Barcode > Name</a></li>
			<li><a href="1.41.php">Barcode > Type</a></li>
			<li><a href="1.37.php">Barcode > Sub type 1</a></li>
			<li><a href="1.38.php">Barcode > Sub type 2</a></li>
			<li><a href="1.39.php">Barcode > Sub type 3</a></li>
			<li><a href="1.40.php">Barcode > Sub type 4</a></li>
			<li><a href="1.50.php">Barcode > Sub type 5</a></li> -->
			<li><a href="barcode.php?type=branch">Barcode Branch</a></li>
			<li><a href="barcode.php?type=group">Barcode Group</a></li>
			<li><a href="barcode.php?type=location">Barcode Location</a></li>
			<li><a href="barcode.php?type=product_type">Barcode Product Type</a></li>
			<li><a href="barcode.php?type=service">Barcode Service</a></li>
			<li><a href="barcode.php?type=sub_type1">Barcode Sub Type 1</a></li>
			<li><a href="barcode.php?type=sub_type2">Barcode Sub Type 2</a></li>
			<li><a href="barcode.php?type=sub_type3">Barcode Sub Type 3</a></li>
			<li><a href="barcode.php?type=sub_type4">Barcode Sub Type 4</a></li>
			<li><a href="barcode.php?type=sub_type5">Barcode Sub Type 5</a></li>
			<li><a href="barcode.php?type=sub_type6">Barcode Sub Type 6</a></li>
			<!-- <li><a >(No charge) Worker type</a></li>
			<li><a >(No charge) Task type</a></li> -->
			<li><a href="1.15.php">Calendar public holiday</a></li> 
			<li><a href="1.24.php">Cancellation Reason</a></li> 
			<li><a href="1.44.php">Contract Location</a></li>
			<li><a href="1.1.php">Customer Master</a></li>
			<li><a href="1.30.php">Day Type</a></li>
			<li><a href="1.35.php">Diesel Rates</a></li>
			<li><a href="1.11.php">Driver & Operator & Manpower</a></li>
			<li><a href="1.3.php">Equipment & Vehicle Master</a></li>
			<li><a href="1.9.php">Location</a></li>
			<li><a href="1.23.php">Reason for outsource</a></li> 
			<li><a href="1.43.php">Sub Location</a></li>
			<li><a href="1.33.php">Subject</a></li>
			<li><a href="1.32.php">Unit of measure</a></li>
			<li><a href="1.5.php">Vehicle Brand</a></li>
			<li><a href="1.8.php">Vehicle Owner</a></li>
			<li><a href="1.4.php">Vehicle Type</a></li>
			<li><a href="1.51.php">Role</a></li>
			<li><a href="1.52.php">POE POD</a></li>
			<li><a href="1.54.php">Vessel Type</a></li>

			
			<!--<li><a href="1.6.php">Vehicle Group</a></li>-->
			<!--<li><a href="1.7.php">1.7.Vehicle Category</a></li>-->
			<!-- <li><a href="1.12.php">Position</a></li> -->
			<!--<li><a href="1.13.php">Manpower</a></li>-->
			<!--<li><a href="1.14.php">Skill</a></li>-->			
			<!--<li><a href="1.16.php">1.16.Vehicle non-working date table</a></li>-->
			<!--<li><a href="1.17.php">1.17.Worksheet reject reason</a></li>-->
			<!--<li><a href="1.18.php">1.18.Driver absence reason</a></li>-->
			<!--<li><a href="1.19.php">Trip type</a></li>-->
			<!--<li><a href="1.20.php">Charge type</a></li>-->
			<!--<li><a href="1.21.php">Additional charge</a></li>-->
			<!--<li><a href="1.22.php">1.22.Distance</a></li>--> 		
			<!--<li><a href="1.25.php">Crane</a></li>-->
			<!--<li><a href="1.26.php">Forklift</a></li>-->
			<!--<li><a href="1.27.php">1.27.Reason for create worksheet backdate</a></li>-->
			<!--<li><a href="1.28.php">Service type</a></li>-->
			<!-- <li><a href="1.29.php">Sub Task</a></li> -->				
			<!--<li><a href="1.31.php">1.31.Invoice Template </a></li>-->
			<!--<li><a href="1.34.php">Equipment</a></li>-->
			<!--<li><a href="1.36.php">Vendor</a></li>-->
			<!--<li><a href="1.99.php">test</a></li>-->
		</ul>
	  </li>
	  <?php } if($_SESSION['menu'][2]['access'] ||( $_SESSION['type_user'] == "ALL" &&  $_SESSION['user_type'] ==  'AAL' ) ){ ?>	
      <li>
	    <label for="btn-2" class="show">System Admin +</label>
		<a href="#">System Admin</a>
		<input type="checkbox" id="btn-2">
		<ul>
			<li><a href="2.1.php">Application Setup</a></li>
			<!--<li><a href="2.2.php">E-mail Setup</a></li>-->
			<li><a href="2.3.php">User login</a></li>
			<!--<li><a href="2.4.php">User menu permission</a></li>-->
			<li><a href="2.5.php">User log</a></li>
			<li><a href="1.55.php">Cut Off Account</a></li>

		</ul>
	  </li>
	  <?php } if($_SESSION['menu'][3]['access']){ ?>	
	  <li>
	    <label for="btn-3" class="show">Transaction +</label>
		<a href="#">Transaction</a>
		<input type="checkbox" id="btn-3">
		<ul>
			<li><a href="3.1.php"><?php
                            if($_SESSION["user_type"] == 'Admin')
                                echo "Worksheet and Job";
                            elseif($_SESSION["user_type"] == 'AAL')
                                echo "Worksheet";
                            elseif($_SESSION["user_type"] == 'AA')
                                echo "Job";
                            

                            ?></a></li>
			<!-- <li><a href="3.4.php">Job</a></li> -->
			<li><a href="3.2.php">Send worksheet to NAV</a></li>
			<li><a href="3.3.php">Scan worksheet</a></li>
		</ul>
	  </li>
	  <?php } if($_SESSION['menu'][4]['access']){ ?>	
	  <li>
	    <label for="btn-4" class="show">Report +</label>
		<a href="#">Report</a>
		<input type="checkbox" id="btn-4">
		<ul>
			<li><a href="4.1.php">
				<?php 
				if($_SESSION["user_type"] == 'AA') {
					echo "Job";
				}else{
					echo "Worksheet";
				}
				?>
				 
				status</a></li>
			<li><a href="">Manpower Activity Summary report</a></li>
			<li><a href="11.1.php">Time sheet</a></li>
		</ul>
	  </li>
	  <?php 
	 } 
	//if($_SESSION['menu'][5]['access']){ 
	?>	
	  <!-- <li>
	    <label for="btn-5" class="show">Driver +</label>
		<a href="#">Driver</a>
		<input type="checkbox" id="btn-5">
		<ul>
			<li><a href="5.1.php">Start & End Trip</a></li>
		</ul>
	  </li> -->
	  <?php 
	//   } 
	  if($_SESSION['menu'][6]['access']){ ?>

	 <li>
	    <label for="btn-6" class="show">Customer Contract</label>
		<a href="#">Customer Contract</a>
		<input type="checkbox" id="btn-6">
				<ul>
					<li><a href="1.2.php">Customer Contract</a></li>
				</ul>
		
	 </li>	
	  <?php 
	  } 
	  if($_SESSION['menu'][7]['access'] ||  $_SESSION['user_type'] ==  'AAL' ||  $_SESSION['user_type'] ==  'AA' ){ ?>
	  <li>
	    <!-- <label for="btn-7" class="show">Time - Pay Slip</label> -->
	    <label for="btn-7" class="show">Time sheet - Miledge Calc</label>
		<!-- <a href="#">Time - Pay Slip</a> -->
		<a href="#">Time sheet - Miledge Calc</a>
		<input type="checkbox" id="btn-7">
		<ul>
			<!-- <li><a href="7.1.php">Allowance & OT Setup</a></li>
			<li><a href="4.2.php">Time - Pay Slip</a></li> -->
			<li><a href="7.2.php">Miledge Calc</a></li>
			<li><a href="7.3.php">Time sheet</a></li>
		</ul>
	  </li>
	  <?php } ?>
	  <?php if($_SESSION['menu'][11]['access']){ ?>
		<li><a href="">Update vehicle mileage</a></li>
	  <!-- <li>
	    <label for="btn-7" class="show">New feature</label>
		<a href="#">New feature</a>
		<input type="checkbox" id="btn-7">
		<ul>
			
		</ul>
	  </li>  -->
	  <?php } ?>
	</ul>
  </nav>
<?php } ?>
<script>
	$(document).ready(function(){
		$("#select-type-user").on( 'change',  function () {
			const selectedValue = $(this).val();
			$.ajax({
                 type: 'POST',
                 url: 'changeTypeUser.php',
				 data: { type: selectedValue },
				 dataType: 'json',
				 success: function(res) {
					location.reload();
        		},
       			 error: function(xhr, status, error) {
            	 console.error('AJAX Error:', status, error);
        	}
		});
		});
	});

	var btn_table = "<?php echo $btn; ?>";
</script>
</body>
</html>

