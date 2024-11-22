<style>
    .modal-xl {
        max-width: 95% !important;
    }
</style>
<!doctype html>
<html lang="en">
<?php
require_once 'config_db.php';
require 'master.php';
$MasterPage = 'master.php';

?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Front-end system</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
</head>

<body style="background-color:GhostWhite">


<div class="modal fade" id="optionPrint" tabindex="-1" aria-labelledby="optionPrintLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="optionPrintLabel">Print Option</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col text-right">
                <div class="btn btn-primary" onclick="optionPrint(1)">Print original only</div>
            </div>
            <div class="col text-left">
                <div class="btn btn-primary" onclick="optionPrint(2)">Print original and copy</div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

    <!-- serve view -->

    <div class="modal fade" id="vieweditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <?php
                        if ($_SESSION["user_type"] == 'Admin')
                            echo "Worksheet ID and Job ID";
                        elseif ($_SESSION["user_type"] == 'AAL')
                            echo "Time Sheet";
                        elseif ($_SESSION["user_type"] == 'AA')
                            echo "Job ID";
                        ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php include "modal/7.3_edit.php" ?>
            </div>
        </div>
    </div>

    <br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                    <span class="mr-2">
                        <?php
                        if ($_SESSION["user_type"] == 'Admin')
                            echo "Worksheet ID and Job ID";
                        elseif ($_SESSION["user_type"] == 'AAL')
                            echo "Time Sheet";
                        elseif ($_SESSION["user_type"] == 'AA')
                            echo "Job ID";
                    ?>
                    </span>
                    <?php
                        if ($_SESSION["user_type"] == 'AAL')
                            echo '
                        <button style="width:100px;" type="button" class="btn btn-success" id="timesheet_add"
                            data-bs-target="#">
                            <i class="fa fa-plus-square"></i> Add
                        </button>
                        <button style="width:100px" type="button" class="btn btn-success" id="timesheet_scan"
                            data-bs-target="#">
                            <i class="fa fa-barcode"></i> Scan
                        </button>
                       ';
                        if ($_SESSION["user_type"] == 'AA')
                            echo '
                            <button style="width:100px" type="button" class="btn btn-success" id="job_add"
                            data-bs-target="#">
                            <i class="fa fa-plus-square"></i> Add
                        </button>
                        <button style="width:100px" type="button" class="btn btn-success" id="job_print"
                            data-bs-target="#">
                            <i class="fa fa-print"></i> Print 
                        </button>

                        <button style="width:100px" type="button" class="btn btn-success" id="job_email"
                            data-bs-target="#">
                            <i class="fa fa-envelope"></i> Email 
                        </button>
                        <input type="hidden" id="job_id">
                        <input type="hidden" id="printed">';
                        if ($_SESSION["user_type"] == 'Admin')
                            echo '<button  type="button" class="btn btn-success" id="timesheet_add"
                            data-bs-target="#">
                            <i class="fa fa-plus-square"></i> Add (timesheet)
                        </button> 
                        <button  type="button" class="btn btn-success" id="job_add"
                            data-bs-target="#">
                            <i class="fa fa-plus-square"></i> Add (job)
                        </button>
                        
                       
                        <button style="width:100px" type="button" class="btn btn-success" id="timesheet_print"
                            data-bs-target="#">
                            <i class="fa fa-print"></i> Print 
                        </button>

                        <button style="width:100px" type="button" class="btn btn-success" id="timesheet_email"
                            data-bs-target="#">
                            <i class="fa fa-envelope"></i> Email 
                        </button>
                        ';
                        echo ' 
                        <button type="button" class="btn btn-success" id="copy-add"
                            data-bs-target="#">
                            <i class="fa fa-copy"></i> Copy
                        </button>
                        ';
                                ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">

                        </div>
                    </div>

                    <div class="card-body">
                        <table id="timesheet_table" class="table table-striped display nowrap" style="width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="width: 20%;"></th>
                                    <th></th>
                                    <th scope="col" style="width: 15%;">
                                        <?php
                                        if ($_SESSION["user_type"] == 'Admin')
                                            echo "Worksheet ID or Job ID";
                                        elseif ($_SESSION["user_type"] == 'AAL')
                                            echo "Worksheet ID";
                                        elseif ($_SESSION["user_type"] == 'AA')
                                            echo "Job ID";
                        ?>
                                </th>
                                <th scope="col" style="width: 10%;">Status</th>
                                <th scope="col" style="width: 10%;">Print status</th>
                                <th scope="col" style="width: 10%;">Branch</th>
                                <th scope="col" style="width: 10%;">Date</th>
                                <th scope="col" style="width: 15%;">Subject</th>
                                <th scope="col" style="width: 15%;">Customer</th>
                                <th scope="col" style="width: 15%;">Requester</th>
                                <th scope="col" style="width: 15%;">Customer Ref.</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>


</div>





    <script>


        $(document).ready(function () {

            $('#timesheet_add').show();

            $('#timesheet_table tbody').on('change', '.chkbox', function () {
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                var id = data[2];
                var print_status = data[4];
                var timesheet_status = data[3];
                var val = this.checked;
                $(':checkbox').each(function () {
                    this.checked = false;
                });

                this.checked = val;
                if (val === false) {
                    $('#timesheet_id').val('');
                    $('#printed').val('');
                    $('#timesheet_status').val('');
                } else {
                    $('#timesheet_id').val(id);
                    $('#printed').val(print_status);
                    $('#timesheet_status').val(timesheet_status);
                }
            });

            $('#timesheet_add').on('click', function () {
                $('#vieweditmodal').modal('show');
                
            });


            $('#timesheet_table tbody').on('click', 'button.deletebtn', function () {
                var table = $('#timesheet_table').DataTable();
                var data = table.row($(this).parents('tr')).data();
                swal('not allow to delete timesheet!!');
                //swal({
                //    title: "Delete",
                //    text: "Confirm",
                //    icon: "warning",
                //    buttons: ["Cancel", "Ok"],
                //    dangerMode: true,
                //    })
                //    .then((willDelete) => {
                //    if (willDelete) {
                //        $.ajax({
                //            type: 'GET',
                //            dataType: "json",
                //            url: 'api/delete_timesheet.php?timesheet_id='+data[2],
                //            success: function(data) {
                //                $('#timesheet_table').DataTable().ajax.reload();
                //                Result = data;
                //                if(Result.Status == "Success") {
                //                    swal(Result.msg);

                //                } else {
                //                    swal(Result.msg);
                //                }
                //            }
                //        });

                //    } 
                //});
            });

            $('#timesheet_table tbody').on('click', 'button.editbtn', function () {
                clear_data();
                var table = $('#timesheet_table').DataTable();
                var data = table.row($(this).parents('tr')).data();
                countRowJob(data[2],"timesheet");
                load_timesheet(data[2]);
                $('#form_type').val('update');
                //$('#user_name').val(''); //$_SESSION["user_name"]
                $('#vieweditmodal').modal('show');
                $('#modalcopyFromWorksheet').modal('hide');
            });

            $('#timesheet_table tbody').on('click', 'button.infobtn', function () {
                var table = $('#timesheet_table').DataTable();
                var data = table.row($(this).parents('tr')).data();
                load_timesheet(data[2]);
                $('#form_type').val('');
                $('#vieweditmodal').modal('show');

                $('#vieweditmodal :input').attr('readonly', 'readonly');
                // $('#vieweditmodal :select').attr('readonly', 'readonly');
                $('#vieweditmodal :button').hide();
            });
        });

        
    </script>

</body>

</html>