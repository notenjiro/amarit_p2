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
    <style>
        .show,.form-check-input,#searchInput{
display: block!important;
}
.dropdown-menu {
      max-height: 300px;
      overflow-y: auto;
    }
    #searchInput{
        outline: none;
  box-shadow: none;
    }
    .tag {
      display: inline-block;
      /* padding: 0.4em 0.6em; */
      padding: 0px 6px;
      margin: 0.2em;
      background-color: #6c757d;
      color: #fff;
      border-radius: 4px;
    }
    .tag .remove-tag {
      /* margin-left: 10px; */
      background-color: black;
      border-radius: 50px;
      padding: 1px 3px 0px 3px;
      cursor: pointer;
    }
    .tag .remove-tag::before{
        content: "\2715";
    }
    .form-control-tags {
      display: flex;
      flex-wrap: wrap;
      min-height: 38px;
      border: 1px solid #ced4da;
      /* padding: 5px; */
      padding: 0px;
      background-color: #fff;
      align-items: center;
      cursor: pointer;
      height: auto!important;
    }
    .form-control-tags input {
      border: none;
      outline: none;
      flex: 1;

    }
    .form-check{
        width:unset;
        height: unset;
    }
    </style>
</head>

<body style="background-color:GhostWhite">


    <br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col">
                        Miledge Calc

                    </div>
                </div>

                <div class="row">
					<?php
							if(isset($_POST['from_date'])){
								$from_date = $_POST['from_date'];
                                $to_date = $_POST['to_date'];
                            }else{
                                $y = date('Y')+543;
                                $from_date =  '';
                                $to_date =  ''; 
                            }
                        ?>
					<div class="col-xs-6 col-sm-6 col-md-2">
                            <div class="form-group">
                                <label>From date</label>
                                <input type="date" name="from_date" id="from_date" value="<?php echo date('Y-m-d'); ?>" onchange="checkDate(this);" class="form-control date" aria-describedby="inputGroupPrepend2" required>
                            </div>   
                        </div> 
                        <div class="col-xs-6 col-sm-6 col-md-2">
                            <div class="form-group">
                                <label>to date</label>
                                <input type="date" name="to_date" id="to_date" value="<?php echo date('Y-m-d'); ?>" onchange="checkDate(this);" class="form-control date" aria-describedby="inputGroupPrepend2" required>
                            </div>   
                        </div> 
						<div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group" style="margin-top: 31px;">
                               
                                <button type="button" name="submit" id="showdata" class="btn btn-success">
                                    <i class="fa fa-search"></i> Show data
                                </button>
								
                            </div>   
                        </div>
					</div>

            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <label>Filter</label>

                <div class="row pb-3">
                    <div class="col-auto" style="width:200px;">
                        <div class="form-check" style="padding-top:5px;">
                            <input class="form-check-input" style="display:block !important;" type="checkbox" value="0"
                                oninput="cb_toggle(this)" id="filter_1">
                            <label class="form-check-label" style="width:300px;" for="filter_1">Vehicle ID</label>
                        </div>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" disabled id="vehicle_id" onkeyup="filter_data(this)">
                    </div>
                </div>

                <div class="row pb-3">
                    <div class="col-auto" style="width:200px;">
                        <div class="form-check" style="padding-top:5px;">
                            <input class="form-check-input" style="display:block !important;" type="checkbox" value="0"
                                oninput="cb_toggle(this)" id="filter_2">
                            <label class="form-check-label" style="width:300px;" for="filter_2">Vehicle Group</label>
                        </div>
                    </div>
                    <div class="col">
                        <!-- <input type="text" class="form-control" disabled id="vehicle_group" onkeyup="filter_data(this)"> -->



                        <div class="dropdown">
    <div class="form-control form-control-tags" id="selectedTagsContainer">
      <input type="text" id="searchInput" class="form-control" placeholder="Search or select" disabled autocomplete="off">
    </div>

    <div class="dropdown-menu p-3 shadow-lg" id="dropdownList" style="width:auto;">
      <div class="d-flex justify-content-between mb-2">
        <button type="button" class="btn btn-sm btn-primary mx-1" id="selectAll">Select All</button>
        <button type="button" class="btn btn-sm btn-primary mx-1" id="unselectAll">Unselect All</button>
      </div>

      <div id="checkboxList">

      </div>
    </div>
  </div>



        

                    </div>
                </div>

                <div class="row pb-3">
                    <div class="col-auto" style="width:200px;">
                        <div class="form-check" style="padding-top:5px;">
                            <input class="form-check-input" style="display:block !important;" type="checkbox" value="0"
                                oninput="cb_toggle(this)" id="filter_3">
                            <label class="form-check-label" style="width:300px;" for="filter_3">Vehicle Base
                                Location</label>
                        </div>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" disabled id="vehicle_base_location"
                            onkeyup="filter_data(this)">
                    </div>
                </div>



                <div class="row pb-3">
                    <div class="col-auto" style="width:200px;">
                        <div class="form-check" style="padding-top:25px;">
                            <input class="form-check-input" style="display:block !important;" type="checkbox" value="0"
                                oninput="cb_toggle(this)" id="filter_4">
                            <label class="form-check-label" style="width:300px;" for="filter_4">Period date</label>
                        </div>
                    </div>
                    <div class="col">
                        Start Date <input type="date" id="start_date" disabled onchange="ip_serviceDate(this);"
                            class="form-control date" value="">
                    </div>
                    <div class="col">
                        End Date <input type="date" id="end_date" disabled onchange="ip_serviceDate(this);"
                            class="form-control date" value="">
                    </div>
                </div>


            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">

                <div class="card-body">
                    <table id="vehicle_table" class="table table-striped" style="width: 100%;"></table>
                </div>

            </div>
        </div>

    </div>












    <!-- Modal -->
    <div class="modal fade" id="viewMileModal" tabindex="-1" aria-labelledby="viewMileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewMileModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <input type="hidden" id="data_id">
                        <input type="hidden" id="vehicle_id">
                        <div class="col">
                            <div class="form-group">
                                <label for="mile_start">Mile Start</label>
                                <input type="number" class="form-control" id="mile_start" placeholder="">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="mile_end">Mile End</label>
                                <input type="number" class="form-control" id="mile_end" placeholder="">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="mile_total">Total</label>
                                <input type="number" class="form-control" id="mile_total" placeholder="">
                            </div>
                        </div>

                        <div class="col-auto" style="align-self: center;" id="set_btn_mile"></div>


                    </div>
                    <hr>
                    <table id="vehicle_data" class="table table-striped" style="width: 100%;"></table>
                </div>
            </div>
        </div>
    </div>







    <?php




    ?>

    <script>


$("#showdata").on('click',function(){
	// from_date="+$("#from_date").val()+"&to_date="+$("#to_date").val()
    showData()
       
			});





            function showData(){


var vehicle_table = $('#vehicle_table').DataTable({
"ajax": { url: "api/manage_mile.php?vehicle_list=true", dataSrc: "" },
"columns": [
    { title: "vehicle_id", data: "vehicle_id", visible: false, searchable: false },
    { title: "registration_no", data: "registration_no" },
    { title: "vehicle_type", data: "vehicle_type" },
    { title: "", },
],
"bDestroy": true,
"columnDefs": [
    {
        "targets": -1,
        "data": null,
        "defaultContent": `<div id="btn_manage_mile" onclick="btn_manage_mile(this)" class='btn btn-sm btn-primary'>Manage</div>`
    },

]
});

}


function btn_manage_mile(val){
    var data = $('#vehicle_table').DataTable().row($(val).parents('tr')).data();
                $("#set_btn_mile").empty().append('<div class="btn btn-primary mt-3" onclick="btn_add_mile()" id="btn_add_mile">Add Mile</div>');
                $("#vehicle_id").val(data.vehicle_id)
                editMile(data.vehicle_id);
}




// $('#vehicle_table tbody').on('click', 'div.btn#btn_manage_mile', function () {
//                 var data = $('#vehicle_table').DataTable().row($(this).parents('tr')).data();
//                 $("#set_btn_mile").empty().append('<div class="btn btn-primary mt-3" id="btn_add_mile">Add Mile</div>');
//                 $("#vehicle_id").val(data.vehicle_id)
//                 editMile(data.vehicle_id);
//             });


function btn_add_mile(val){
    $.post("api/manage_mile.php?add_mile=true", { vehicle_id: $("#vehicle_id").val(), mile_start: $("#mile_start").val(), mile_end: $("#mile_end").val(), mile_total: $("#mile_total").val() })
    .done(function (data) {
        console.log(data)
        if (data == 1) {
            $("#vehicle_id").val("")
            $("#mile_start").val("")
            $("#mile_end").val("")
            $("#mile_total").val("")
            $('#vehicle_data').DataTable().ajax.reload();
        }
    });
}


// $('body').on('click', '#btn_add_mile', function () {

// $.post("api/manage_mile.php?add_mile=true", { vehicle_id: $("#vehicle_id").val(), mile_start: $("#mile_start").val(), mile_end: $("#mile_end").val(), mile_total: $("#mile_total").val() })
//     .done(function (data) {
//         if (data == 1) {
//             $("#vehicle_id").val("")
//             $("#mile_start").val("")
//             $("#mile_end").val("")
//             $("#mile_total").val("")
//             $('#vehicle_data').DataTable().ajax.reload();
//         }
//     });

// });

function editMile(vehicleId) {

var vehicle_data = $('#vehicle_data').DataTable({
    "ajax": { url: "api/manage_mile.php?vehicle_data=" + vehicleId, dataSrc: "" },
    "columns": [
        { title: "id", data: "id", visible: false, searchable: false },
        { title: "vehicle_id", data: "vehicle_id", visible: false, searchable: false },
        { title: "mile_start", data: "mile_start" },
        { title: "mile_end", data: "mile_end" },
        { title: "mile_total", data: "mile_total" },
        { title: "", },
    ],
    "bDestroy": true,
    "columnDefs": [
        {
            "targets": -1,
            "data": null,
            "defaultContent": `<div class='btn btn-sm btn-primary' id="btn_edit_mile">Edit Mile</div>`
        },

    ]
});


$("#viewMileModalLabel").text("Editing Mile Vehicle")
$('#viewMileModal').modal("show")
}


$(document).ready(function() {

  


    
  $.post("api/manage_mile.php?vehicle_group=true")
                .done(function (data) {
                   
                    JSON.parse(data).forEach( (element,index) => {
                        $('#checkboxList').append('<div class="form-check"> <input class="form-check-input dropdown-checkbox" type="checkbox" value="'+element.description+'" id="dropbowncb'+index+'"> <label class="form-check-label" for="dropbowncb'+index+'">'+element.description+'</label> </div>');
                    });


    // Dropdown toggle on search input click
    $('#selectedTagsContainer').on('click', function() {
      $('#dropdownList').toggle();
    });

    // Close dropdown if clicking outside
    $(document).on('click', function(e) {
      if (!$(e.target).closest('.dropdown').length) {
        $('#dropdownList').hide();
      }
    });

    // Update selected tags and handle checkbox changes
    function updateSelectedTags() {
      let tempText = $('#searchInput').val();
      let selectedValues = [];
      $('#checkboxList input[type="checkbox"]:checked').each(function() {
        selectedValues.push($(this).val());
      });

      // Display tags for selected items
      $('#selectedTagsContainer').empty();
      selectedValues.forEach(function(value) {
        //&times;
        $('#selectedTagsContainer').append(
          `<span class="tag">${value} <span class="remove-tag" data-value="${value}"></span></span>`
        );
      });

      // Re-add the search input box
      $('#selectedTagsContainer').append('<input type="text" id="searchInput" class="form-control" placeholder="Search or select" autocomplete="off">');
      $('#searchInput').focus()
      $('#searchInput').val(tempText) 

    }

    // Add event listener for checkbox changes
    $('#checkboxList input[type="checkbox"]').on('change', function() {
      updateSelectedTags();
    });

    // Remove tag and uncheck the associated checkbox
    $(document).on('click', '.remove-tag', function() {
      const value = $(this).data('value');
      $(`#checkboxList input[value="${value}"]`).prop('checked', false);
      updateSelectedTags();
    });

    // Filter the checkbox list based on search input
    $(document).on('keyup', '#searchInput', function() {
      var value = $(this).val().toLowerCase();
      $('#checkboxList .form-check').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    //   console.log( $('#checkboxList .form-check').length) // WIP when not match all show message
      $('#dropdownList').show()
    });

    // Select All functionality scoped to dropdown checkboxes only
    $('#selectAll').on('click', function() {
      $('#checkboxList input[type="checkbox"]').prop('checked', true);
      $('#searchInput').val("")
      $('#checkboxList .form-check').show();
      updateSelectedTags();
    });

    // Unselect All functionality scoped to dropdown checkboxes only
    $('#unselectAll').on('click', function() {
      $('#checkboxList input[type="checkbox"]').prop('checked', false);
      $('#searchInput').val("")
      $('#checkboxList .form-check').show();
      updateSelectedTags();
    });


                });
    
  });

        function cb_toggle(id) {

            $(id).val((id.value == 0 ? 1 : 0))

            let ele = $(id).attr('id');
            let val = id.value

            if(ele=="filter_1"&&val==0){
                $("#vehicle_id").attr('disabled', 'disabled');
                $('#vehicle_id').val('');
                $('#vehicle_table').DataTable().column(0).search("").draw();
            }
            else if(ele=="filter_1"&&val==1){
                $("#vehicle_id").removeAttr("disabled");
            }

            if(ele=="filter_2"&&val==0){
                $("#searchInput").attr('disabled', 'disabled');
                $('#searchInput').val('');
                $('.dropdown > .form-control-tags > .tag').remove()
                $('#checkboxList > .form-check > input').prop('checked', false);
                $('#checkboxList .form-check').show();
                // $('#vehicle_table').DataTable().column(1).search("").draw();
            }
            else if(ele=="filter_2"&&val==1){
                $("#searchInput").removeAttr("disabled");
            }

            else if (ele == "filter_4" && val == 0) {
                $("#start_date").attr('disabled', 'disabled');
                $("#end_date").attr('disabled', 'disabled');
                $('#start_date').val('');
                $('#end_date').val('');
                delete customSearches['start_date'];
                delete customSearches['end_date'];
                applyCustomSearches();
            }
            else if (ele == "filter_4" && val == 1) {
                $("#start_date").removeAttr("disabled");
                $("#end_date").removeAttr("disabled");

                $("#start_date").attr('min', $('#start_date').val()).attr('max', $('#end_date').val());
                $("#end_date").attr('min', $('#start_date').val()).attr('max', $('#end_date').val());


            }
        }

        var customSearches = {};


        function applyCustomSearches() {
            var table = $('#vehicle_table').DataTable();
            $.fn.dataTable.ext.search = [];
            for (let key in customSearches) {
                $.fn.dataTable.ext.search.push(customSearches[key]);
            }
            console.log(customSearches)
            table.draw();
        }


        function filter_data(id) {
            $('#vehicle_table').DataTable().column(12).search(id.value).draw();
        }



        function ip_serviceDate(id) {
            // var table = $('#vehicle_table').DataTable();

            // let i = 0;
            // console.log($(id).attr('id'))
            // if (($(id).attr('id') == "service_from")) {

            //     let startDate = new Date($('#service_from').val());
            //     startDate.setUTCHours(0, 0, 0, 0);
            //     var table = $('#vehicle_table').DataTable();
            //     customSearches['service_from'] = function (settings, data, dataIndex) {

            //         var dateStr = data[51];
            //         var parts = dateStr.split('/');
            //         var formattedDateStr = parts[1] + '/' + parts[0] + '/' + parts[2];
            //         var dateObj = new Date(formattedDateStr);

            //         if (startDate.toISOString() <= dateObj.toISOString()) {
            //             console.log('true', startDate.toISOString(), dateObj.toISOString())
            //             return true;
            //         }
            //         else {
            //             console.log('false', startDate.toISOString(), dateObj.toISOString())
            //             return false;
            //         }
            //     }
            //     applyCustomSearches();
            // }


            // if (($(id).attr('id') == "service_to")) {

            //     let startDate = new Date($('#service_to').val());
            //     startDate.setUTCHours(0, 0, 0, 0);
            //     var table = $('#vehicle_table').DataTable();
            //     customSearches['service_to'] = function (settings, data, dataIndex) {

            //         var dateStr = data[53];
            //         var parts = dateStr.split('/');
            //         var formattedDateStr = parts[1] + '/' + parts[0] + '/' + parts[2];
            //         var dateObj = new Date(formattedDateStr);

            //         if (startDate.toISOString() >= dateObj.toISOString()) {
            //             console.log('true', startDate.toISOString(), dateObj.toISOString())
            //             return true;
            //         }
            //         else {
            //             console.log('false', startDate.toISOString(), dateObj.toISOString())
            //             return false;
            //         }
            //     }
            //     applyCustomSearches();
            // }



        }


        function update_mile() {

            console.log("S")
            $.post("api/manage_mile.php?update_mile=true", { data_id: $("#data_id").val(), vehicle_id: $("#vehicle_id").val(), mile_start: $("#mile_start").val(), mile_end: $("#mile_end").val(), mile_total: $("#mile_total").val() })
                .done(function (data) {
                    if (data == 1) {
                        $("#data_id").val("")
                        $("#vehicle_id").val("")
                        $("#mile_start").val("")
                        $("#mile_end").val("")
                        $("#mile_total").val("")
                        $("#set_btn_mile").empty().append('<div class="btn btn-primary mt-3" id="btn_add_mile">Add Mile</div>');
                        $('#vehicle_data').DataTable().ajax.reload();
                    }

                });

        };

        $(document).ready(function () {






            $('body').on('click', '#btn_cancel_mile', function () {
                $("#data_id").val("")
                $("#vehicle_id").val("")
                $("#mile_start").val("")
                $("#mile_end").val("")
                $("#mile_total").val("")
                $("#set_btn_mile").empty().append('<div class="btn btn-primary mt-3" id="btn_add_mile">Add Mile</div>');
                $('#vehicle_data').DataTable().ajax.reload();
            });

            $('body').on('click', '#btn_edit_mile', function () {
                var data = $('#vehicle_data').DataTable().row($(this).parents('tr')).data();
                console.log(data)
                $("#data_id").val(data.id)
                $("#vehicle_id").val(data.vehicle_id)
                $("#mile_start").val(data.mile_start)
                $("#mile_end").val(data.mile_end)
                $("#mile_total").val(data.mile_total)
                $("#set_btn_mile").empty().append(`
    <div class="btn btn-success mt-3" id="btn_update_mile" onclick="update_mile()">Update Mile</div>
    <div class="btn btn-danger mt-3" id="btn_cancel_mile">Cancel</div>
    `);
            });

            $('#vehicle_data tbody').on('click', 'div.btn#btn_edit_mile', function () {
                var data = $('#vehicle_data').DataTable().row($(this).parents('tr')).data();
                $("#set_btn_mile").empty().append('<div class="btn btn-primary mt-3" onclick="btn_add_mile(this)" id="btn_add_mile">Add Mile</div>');
                $("#vehicle_id").val(data.vehicle_id)
                editMile(data.vehicle_id);
            });


            




        






        })
    </script>

</body>

</html>
<?php sqlsrv_close($conn); ?>