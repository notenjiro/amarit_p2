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
<body style="background-color:GhostWhite"  >
  <p style="line-height:1px;margin:0px;"><br></p>
	<br>
  <div class="container" style="border:1px solid #cecece;" >
    <br>
	
		    <div class="col-xs-12 col-sm-6 col-md-5">
	          	<div class="field">
				  	<form id="trip_data">
						<div class="w-25 p-2" style="background-color: #eee;">Step 1 </div>
						<input type="text" placeholder="Trip Number.." id="trip_number" name="trip_number" class="form-control" size="10" required>

						<input type="text" id="vehicle" name="vehicle" class="form-control" size="50" readonly>							

						<!--<button type="button"  class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-barcode"></i>  สแกนบาร์โค้ด</button>-->
						<button type="submit" class="btn btn-warning" id="start_trip"><i ></i>ตรวจสอบ</button>
						<!--<?php
							if(isset($_POST['vehicle'])){
								$vehicle = $_POST['vehicle'];
                            }else{
                                $vehicle =  ''; 
                            }
                        ?>
						<label for="ex1"><?php echo $vehicle; ?></label>
						<span class="help-block">This is some help text...</span>-->
  					</form>
			    </div>
    	    </div> 
			<br>
			<form id="mileage_data" enctype="multipart/form-data">
				<input type="hidden" id="reccode" name="reccode">
				<input type="hidden" id="worksheet_id" name="worksheet_id">
				<div class="col-xs-12 col-sm-6 col-md-5">
				<div class="field">
					<div class="w-25 p-2" style="background-color: #eee;">Step 2</div>
					<label>Mileage Start</label>
					<input type="text" class="form-control" id="mileage_start" name="mileage_start" placeholder="เลขไมล์เริ่มต้น">

					<label class="input-group-btn">
						<span class="btn btn-success">
							<input type="file" name="step201" id="step201" style="display: none;" accept="image/*" capture="camera" multiple><i class="fa fa-camera-retro"></i>  ถ่ายรูปเลขไมล์
						</span>
					</label>


					<label class="input-group-btn">
						<span class="btn btn-success">
							<input type="file" name="step202" id="step202" style="display: none;" accept="image/*" capture="camera" multiple><i class="fa fa-camera-retro"></i>  ถ่ายรูปสินค้า
						</span>
					</label>

					<button type="submit"  class="btn btn-warning" id="start"><i ></i>เริ่มทริป</button>
					<progress id="progressStep2"></progress>
					<span id="step2Status"></span>
					</div>
				</div>
				<br>

				<div class="col-xs-12 col-sm-6 col-md-5">
				<div class="field">
					<div class="w-25 p-2" style="background-color: #eee;">Step 3</div>
					<label>Mileage End</label>
					<input type="text" class="form-control" id="mileage_end" name="mileage_end" placeholder="เลขไมล์สิ้นสุด">

					<label class="input-group-btn">
						<span class="btn btn-success">
							<input type="file" name="step301" id="step301" style="display: none;" accept="image/*" capture="camera" multiple><i class="fa fa-camera-retro"></i>  ถ่ายรูปเลขไมล์
						</span>
					</label>

					<label class="input-group-btn">
						<span class="btn btn-success">
							<input type="file" name="step302" id="step302" style="display: none;" accept="image/*" capture="camera" multiple><i class="fa fa-camera-retro"></i>  ถ่ายรูปสินค้า
						</span>
					</label>

					<button type="submit"  class="btn btn-warning" id="end"><i ></i>จบทริป</button>
					<progress id="progressStep3"></progress>
					<span id="step3Status"></span>
					</div>
				</div> 
  			</form>
			<div class="col-xs-12 col-sm-6 col-md-5">
	          <!--<div class="field">
			    <br>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#bb1"><i class="fa fa-id-card"></i>ข้อแนะนำในการใช้งาน</button>
			  </div>-->
    	    </div> 
			<br>
			
  </div>




  
</body>
</html>

<script>
	$("#progressStep2").hide();
	$("#progressStep3").hide();

	$('#step201').on('change', function () {
		upload_trip('01');
	});

	$('#step202').on('change', function () {
		upload_trip('03');
	});

	$('#step301').on('change', function () {
		upload_trip('02');
	});

	$('#step302').on('change', function () {
		upload_trip('04');
	});

	function upload_trip(num){
		if($('#reccode').val() == ''){
			swal('Please specify trip number');
			return false;
		}
		
		var fd = new FormData();
		if (num == '01') {
			var files = $('#step201')[0].files[0];
			$("#progressStep2").show();
			$("#step2Status").html("");
		}
		if (num == '02') {
			var files = $('#step301')[0].files[0];
			$("#progressStep3").show();
			$("#step3Status").html("");
		}
		if (num == '03') {
			var files = $('#step202')[0].files[0];
			$("#progressStep2").show();
			$("#step2Status").html("");
		}
		if (num == '04') {
			var files = $('#step302')[0].files[0];
			$("#progressStep3").show();
			$("#step3Status").html("");
		}
		fd.append('file', files);
		var filename = $("#worksheet_id").val()+$("#trip_number").val()+"step2"+num;
		if (num == '03') {
			var now = new Date();
			var filename = $("#trip_number").val()+'_'+now.getTime();
		}
		if (num == '04') {
			var now = new Date();
			var filename = $("#trip_number").val()+'_'+now.getTime();
		}
		$.ajax({
			// Your server script to process the upload
			url: 'api/upload_trip.php?filename='+filename,
			type: 'POST',
			data: fd,
			// cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			xhr: function () {
				var myXhr = $.ajaxSettings.xhr();
				if (myXhr.upload) {
					// For handling the progress of the upload
					myXhr.upload.addEventListener('progress', function (e) {
					if (e.lengthComputable) {
						$('progress').attr({
						value: e.loaded,
						max: e.total,
						});
					}
					}, false);
				}
				return myXhr;
			},
			success: function(data) {
				if (num == '01') {
					$("#progressStep2").hide();
					if(data.status == 'success'){
						$("#step2Status").html("<p style=\"color:green\">บันทึกรูปภาพเรียบร้อย</p>");
						$('#mileage_start').val(data.miledge);
					}else{
						$("#step2Status").html("<p style=\"color:red\">มีบางอย่างผิดพลาด</p>");
					}
				}
				if (num == '02') {
					$("#progressStep3").hide();
					if(data.status == 'success'){
						$("#step3Status").html("<p style=\"color:green\">บันทึกรูปภาพเรียบร้อย</p>");
						$('#mileage_end').val(data.miledge);
					}else{
						$("#step3Status").html("<p style=\"color:red\">มีบางอย่างผิดพลาด</p>");
					}
				}
				if (num == '03') {
					$("#progressStep2").hide();
					if(data.status == 'success'){
						$("#step2Status").html("<p style=\"color:green\">บันทึกรูปภาพเรียบร้อย</p>");
					}else{
						$("#step2Status").html("<p style=\"color:red\">มีบางอย่างผิดพลาด</p>");
					}
				}
				if (num == '04') {
					$("#progressStep3").hide();
					if(data.status == 'success'){
						$("#step3Status").html("<p style=\"color:green\">บันทึกรูปภาพเรียบร้อย</p>");
					}else{
						$("#step3Status").html("<p style=\"color:red\">มีบางอย่างผิดพลาด</p>");
					}
				}
			}
			
		});

	}
	$("#trip_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#trip_data");
        var data = getFormData($form);

        $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'api/get_trip.php',
			data: data,
            success: function(data) {
				if(data.status == 'success'){
					$('#mileage_start').val(data.mileage_start);
					$('#miledge_check_in').val(data.miledge_check_in);
					$('#mileage_end').val(data.mileage_end);
					$('#vehicle').val(data.vehicle);

					$('#reccode').val(data.reccode);
					$('#worksheet_id').val(data.worksheet_id);
					
					if (data.mileage_start > 0)
						$("#start").hide();
					if (data.mileage_end > 0)
						$("#end").hide();

				}else{
					swal(data.msg);
				}
              
            }
        });

        return false;
    });

	$("#mileage_data").submit(function(e) {
        e.preventDefault();
        var $form = $("#mileage_data");
        var data = getFormData($form);

		if($('#reccode').val() == ''){
			swal('Please specify trip number');
		}else{	
			$.ajax({
				type: 'POST',
				dataType: "json",
				url: 'api/update_trip.php',
				data: data,
				success: function(data) {
					swal(data.msg);
				}
			});
		}
        return false;
    });

</script>
