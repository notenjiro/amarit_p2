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

    <div class="modal fade" id="vieweditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <?php
                        if ($_SESSION["user_type"] == 'Admin')
                            echo "Worksheet ID and Job ID";
                        elseif ($_SESSION["user_type"] == 'AAL')
                            echo "Worksheet ID";
                        elseif ($_SESSION["user_type"] == 'AA')
                            echo "Job ID";
                        ?>
                    </h5>
                    <div id="divcopyfromid">
                        <div class="d-flex align-items-center ml-2" >
                            <span style="white-space:nowrap" class="mr-3"> ( Copy <?php if ($_SESSION["user_type"] == 'AA') {
                                echo "Job";
                            } else {
                                echo "Worksheet";
                            } ?> From</span>
                            <span id="copyfromid"></span>
                            <span class="ml-3"> ) </span>

                        </div>
                    </div>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php include "modal/3.1_edit.php" ?>
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
                                echo "Worksheet ID";
                            elseif ($_SESSION["user_type"] == 'AA')
                                echo "Job ID";
                            //     echo '<button style="width:100px" type="button" class="btn btn-success" id="worksheet_add"
                            //     data-bs-target="#">
                            //     <i class="fas fa-plus-square"></i> Add
                            // </button>';
                            ?>
                        </span>
                        <?php
                        if ($_SESSION["user_type"] == 'AAL')
                            echo '<button style="width:100px" type="button" class="btn btn-success" id="worksheet_add"
                            data-bs-target="#">
                            <i class="fa fa-plus-square"></i> Add
                        </button>
                        
                        <button style="width:100px" type="button" class="btn btn-success" id="worksheet_print"
                            data-bs-target="#">
                            <i class="fa fa-print"></i> Print
                        </button>

                        <button style="width:100px" type="button" class="btn btn-success" id="worksheet_email"
                            data-bs-target="#">
                            <i class="fa fa-envelope"></i> Email
                        </button>
                        <input type="hidden" id="worksheet_id">
                        <input type="hidden" id="printed">';
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
                            echo '<button  type="button" class="btn btn-success" id="worksheet_add"
                            data-bs-target="#">
                            <i class="fa fa-plus-square"></i> Add (worksheet)
                        </button> 
                        <button  type="button" class="btn btn-success" id="job_add"
                            data-bs-target="#">
                            <i class="fa fa-plus-square"></i> Ad
                            
                            d (job)
                        </button>
                        
                       
                        <button style="width:100px" type="button" class="btn btn-success" id="worksheet_print"
                            data-bs-target="#">
                            <i class="fa fa-print"></i> Print 
                        </button>

                        <button style="width:100px" type="button" class="btn btn-success" id="worksheet_email"
                            data-bs-target="#">
                            <i class="fa fa-envelope"></i> Email 
                        </button>
                        ';
                        echo ' <button type="button" class="btn btn-success" id="worksheet_preview" data-bs-target="#"> <i class="fa fa-eye"></i>  Preview</button>
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
                    <table id="worksheet_table" class="table table-striped display nowrap" style="width: 100%;">
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

    <div class="modal fade" id="modalcopyFromWorksheet" tabindex="-1" aria-labelledby="copyFromWorksheetLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="copyFromWorksheetLabel">Copy service line from Other Worksheet</h5>
                    <button type="button" style="border:none;background-color:white;" onclick="closeModalCopy()">
                        x</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 d-flex">
                            <input type="text" name="rows" id="wscopy" class="form-control col mr-2"
                                placeholder="Worksheet Id">
                            <button type="button" class="btn btn-info mb-4 col-3" id="warehousing_copyFromWorksheet"
                                data-bs-target="#" onclick="findWorksheet()">
                                <i class="fa fa-search"></i> search
                            </button>
                        </div>

                        <div class="card-body">
                            <ul class="nav nav-tabs" id="menuCopy" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#transportcopy-tab"
                                        id="copy/transport-nav">Cargo Transport ( <span></span> )</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#manpowercopy-tab"
                                        id="copy/manpower-nav">Manpower ( <span></span> )</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#cargocopy-tab"
                                        id="copy/cargo-nav">Cargo Handling ( <span></span> )</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#serviceothercopy-tab"
                                        id="copy/serviceother">Service Other ( <span></span> )</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#immigrationcopy-tab"
                                        id="copy/immigration-nav">Immigration ( <span></span> )</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#taxicopy-tab" id="copy/taxi-nav">Taxi
                                        service ( <span></span> )</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#warehousingcopy-tab"
                                        id="copy/warehousing">Warehousing / Space Rental ( <span></span> )</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#utilitiescopy-tab"
                                        id="copy/utilities">Utilities ( <span></span> )</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#rentalcopy-tab"
                                        id="copy/rental">Rental(Veicles&Heavy Eq.) ( <span></span> )</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#hotelbookingcopy-tab"
                                        id="copy/hotelbooking">Hotel Booking ( <span></span> )</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#ticketbookingcopy-tab"
                                        id="copy/ticketbooking">Ticket Booking ( <span></span> ) </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#customerclearancecargocopy-tab"
                                        id="copy/customerclearancecargo">Customer Clearance (Cargo) ( <span></span> )
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#customerclearancevesselcopy-tab"
                                        id="copy/customerclearancevessel">Customer Clearance (Vessel) ( <span></span> )
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#agencyservicecopy-tab"
                                        id="copy/agencyservice">Agency Service ( <span></span> ) </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#managementfreecopy-tab"
                                        id="copy/managementfree">Management fee ( <span></span> ) </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#provisionincomecopy-tab"
                                        id="copy/provisionincome">Provision Income ( <span></span> ) </a>
                                </li>

                            </ul>

                            <div class="tab-content mt-4" id="tabMenuCopy">
                                <div class="tab-pane fade divCheckbox" id="" style="height:25vh;overflow:auto">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button type="button" class="btn btn-info" onclick="CopyService()">
                            <i class="fa fa-copy mr-3"></i><span>copy service</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>





    <script>

        function optionPrint(type) {
            var url = "print/3.1_print2.php?optionPrint=" + type + "&worksheet_id=" + $('#worksheet_id').val();
            window.open(url, '_blank').focus();
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: 'api/update_worksheet_printed.php?worksheet_id=' + $('#worksheet_id').val(),
                success: function (data) {
                }
            });
        }

        function closeModalCopy() {
            $('#vieweditmodal').modal('show');
            $('.modal').modal('hide');
        }

        $(document).ready(function () {

            $('#copy-add').on('click', function () {
                var idworksheet = $('#worksheet_id').val();
                var header = idworksheet.replace(/[0-9]/g, '');
                let type;
                if (header == "WS") {
                    type = 'worksheet';
                }
                if (header == "JO") {
                    type = 'job';
                }
                if (idworksheet) {
                    $.ajax({
                        type: 'GET',
                        dataType: "json",
                        url: 'api/copy_worksheet.php?id=' + idworksheet + "&type=" + type,
                        success: function (res) {
                            console.log(res)
                            if (res.status == 1) {
                                swal({
                                    icon: "success",
                                    text: res.msg,
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    icon: "error",
                                    text: res.msg,
                                    timer: 3000,
                                    buttons: false,
                                });
                            }
                        }, error: function (xhr, status, error) {
                            console.log("Error Message:", error);
                            console.log("XHR Object:", xhr);
                        }
                    });
                } else {
                    swal({
                        icon: "warning",
                        text: 'Please select a worksheet before copying.',
                        timer: 3000,
                        buttons: false,
                    });
                }
            });

            var table = $('#worksheet_table').DataTable({
                // add
                "ajax": "api/view_worksheet.php?user_role=<?php echo $_SESSION["user_role"]; ?>&user_name=<?php echo $_SESSION["user_name"]; ?>&type=<?php echo $_SESSION["user_type"]; ?>",
                "pageLength": 10,
                "processing": true,
                "scrollX": true,
                "columnDefs": [{
                    "targets": 0,
                    "data": null,
                    "defaultContent": btn_table
                }, {
                    "targets": 1,
                    "data": null,
                    "defaultContent": "<input type=\"checkbox\" class=\"form-check chkbox\">"
                }],
                "bDestroy": true
            });

            //$('#worksheet_status').val() != 'Cancelled'
            $('#worksheet_print').on('click', function () {

                if ($('#worksheet_id').val() != '') {
                    var print_permission = "<?php echo $_SESSION["print_worksheet"]; ?>";
                    if (($('#printed').val() != 'Printed' || print_permission == '1') && $('#worksheet_status').val() != 'Cancelled') {

                        $('#optionPrint').modal('show');



                    } else {
                        swal("You can't print cancel worksheet");
                    }
                } else {
                    swal("Please select worksheet");
                }
            });

            $('#worksheet_preview').on('click', function () {
                if ($('#worksheet_id').val() != '') {
                    var print_permission = "<?php echo $_SESSION["print_worksheet"]; ?>";
                    // if (($('#printed').val() != 'Printed' || print_permission == '1') && $('#worksheet_status').val() != 'Cancelled') {
                    if (print_permission == '1') {
                        var url = "print/3.1_print2.php?preview=true&worksheet_id=" + $('#worksheet_id').val();
                        window.open(url, '_blank').focus();
                        // $.ajax({
                        //     type: 'POST',
                        //     dataType: "json",
                        //     url: 'api/update_worksheet_printed.php?worksheet_id=' + $('#worksheet_id').val(),
                        //     success: function (data) {
                        //     }
                        // });
                    } else {
                        swal("You can't print cancel worksheet");
                    }
                } else {
                    swal("Please select worksheet");
                }
            });


            $('#worksheet_print2').on('click', function () {
                if ($('#worksheet_id').val() != '') {
                    var print_permission = "<?php echo $_SESSION["print_worksheet"]; ?>";
                    if ($('#printed').val() != 'Printed' || print_permission == '1') {
                        var url = "print/3.1_print2.php?worksheet_id=" + $('#worksheet_id').val();
                        window.open(url, '_blank').focus();
                        $.ajax({
                            type: 'POST',
                            dataType: "json",
                            url: 'api/update_worksheet_printed.php?worksheet_id=' + $('#worksheet_id').val(),
                            success: function (data) {
                            }
                        });
                    } else {
                        swal("You can't print this worksheet");
                    }
                } else {
                    swal("Please select worksheet");
                }
            });

            $('#worksheet_email').on('click', function () {
                if ($('#worksheet_id').val() != '') {
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: 'api/send_email.php?worksheet_id=' + $('#worksheet_id').val(),
                        success: function (data) {
                            if (data.Status == "Success") {
                                swal(data.msg);
                            } else {
                                swal(data.msg);
                            }
                        }
                    });
                    swal("Your mail has been sent successfully.");
                } else {
                    swal("Please select worksheet");
                }
            });


            $('#worksheet_table tbody').on('change', '.chkbox', function () {
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                var id = data[2];
                var print_status = data[4];
                var worksheet_status = data[3];
                var val = this.checked;
                $(':checkbox').each(function () {
                    this.checked = false;
                });

                this.checked = val;
                if (val === false) {
                    $('#worksheet_id').val('');
                    $('#printed').val('');
                    $('#worksheet_status').val('');
                } else {
                    $('#worksheet_id').val(id);
                    $('#printed').val(print_status);
                    $('#worksheet_status').val(worksheet_status);
                }
            });

            var branch = '<?php echo $_SESSION["branch"]; ?>';

            $('#worksheet_add').on('click', function () {
                clear_data();
                get_number('worksheet');
                $('#form_type').val('insert');
                $('#worksheet_id').attr('readonly', false);
                $('#vieweditmodal').modal('show');
                $("#sub_data").hide();
                $(".send").hide();
                $(".rcvd").hide();
                $(".close_stt").hide();
                $(".cancel").hide();
                $('#worksheet_id').attr('readonly', true);
                $('#branch').val(branch);
                var now = new Date();
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                var today = now.getFullYear() + "-" + (month) + "-" + (day);
                $('#worksheet_date').val(today);
                $('#worksheet_date').attr('readonly', true);
                $('#worksheet_status').val("Open");
                $('#worksheet_status').attr('readonly', true);
            });

            //add
            $('#job_add').on('click', function () {
                clear_data();
                get_number('job');
                $('#form_type').val('insert');
                $('#worksheet_id').attr('readonly', false);
                $('#vieweditmodal').modal('show');
                $("#sub_data").hide();
                $(".send").hide();
                $(".rcvd").hide();
                $(".close_st").hide();
                $(".cancel").hide();
                $('#branch').val(branch);
                $('#worksheet_id').attr('readonly', true);
                var now = new Date();
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                var today = now.getFullYear() + "-" + (month) + "-" + (day);
                $('#worksheet_date').val(today);
                $('#worksheet_date').attr('readonly', true);
                $('#worksheet_status').val("Open");
                $('#worksheet_status').attr('readonly', true);

            });


            $('#worksheet_table tbody').on('click', 'button.deletebtn', function () {
                var table = $('#worksheet_table').DataTable();
                var data = table.row($(this).parents('tr')).data();
                swal('not allow to delete worksheet!!');
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
                //            url: 'api/delete_worksheet.php?worksheet_id='+data[2],
                //            success: function(data) {
                //                $('#worksheet_table').DataTable().ajax.reload();
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

            $('#worksheet_table tbody').on('click', 'button.editbtn', function () {
                clear_data();
                var table = $('#worksheet_table').DataTable();
                var data = table.row($(this).parents('tr')).data();
                countRowJob(data[2], "worksheet");
                load_worksheet(data[2]);
                $('#form_type').val('update');
                //$('#user_name').val(''); //$_SESSION["user_name"]
                $('#vieweditmodal').modal('show');
                $('#modalcopyFromWorksheet').modal('hide');
               
            });

            $('#worksheet_table tbody').on('click', 'button.infobtn', function () {
                var table = $('#worksheet_table').DataTable();
                var data = table.row($(this).parents('tr')).data();
                load_worksheet(data[2]);
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