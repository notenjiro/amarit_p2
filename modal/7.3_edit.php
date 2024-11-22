<div class="modal-body">

    <form action="" method="POST" role="form" id="vehicle_type_data">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <b>Month</b>
                    <select name="month" id="timesheet_month" class="form-control"
                        aria-describedby="inputGroupPrepend2"></select>
                </div>
            </div>
            <div class="col-3">
                <b>Sheet</b>
                <div class="form-group d-flex align-items-center">
                    <select name="employee" id="timesheet_employee" class="form-control"
                        aria-describedby="inputGroupPrepend2">
                        <?php
                        if ($_SESSION["user_type"] == 'Admin' || $_SESSION["user_type"] == 'AAL') {
                            $fQuery = 'SELECT worksheet_id FROM worksheet UNION SELECT job_id FROM Job;';
                        } elseif ($_SESSION["user_type"] == 'AA') {
                            $fQuery = "SELECT job_id FROM job order by job_id desc";
                        }

                        $result = sqlsrv_query($conn, $fQuery);
                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                            <option value="<?php
                            if ($_SESSION["user_type"] == 'Admin' || $_SESSION["user_type"] == 'AAL') {
                                echo $row['worksheet_id'];
                            } elseif ($_SESSION["user_type"] == 'AA') {
                                echo $row['job_id'];
                            }
                            ?>">
                                <?php if ($_SESSION["user_type"] == 'Admin' || $_SESSION["user_type"] == 'AAL') {
                                    echo $row['worksheet_id'];
                                } elseif ($_SESSION["user_type"] == 'AA') {
                                    echo $row['job_id'];
                                } ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <b>Employee ID</b>
                    <select name="employee" id="timesheet_employee" class="form-control"
                        aria-describedby="inputGroupPrepend2">
                        <option value=""></option>
                        <?php
                        $fQuery = "SELECT operator_id,name,lastname FROM operator";
                        $result = sqlsrv_query($conn, $fQuery);
                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
                            <option value="<?php echo $row['operator_id']; ?>">
                                <?php echo $row['operator_id'] . " | " . $row['name'] . " " . $row['lastname']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="form-group d-flex justify-content-center align-items-center flex-column">
                    <b class="mb-3 align-self-start"> Working hours</b>
                    <div class="col-11 d-flex flex-column" id="divcheckbox"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <button style="width:100px" type="submit" class="btn btn-success" id="vehicle_type_submit"
                    data-bs-target="#">
                    <i class="fa fa-save"></i> Save
                </button>

                <button style="width:100px" type="button" class="btn btn-danger" id="cancel" data-bs-target="#">
                    <i class="fa fa-minus-square"></i> Cancel
                </button>

            </div>
        </div>
    </form>

</div>

<input required type="hidden" name="form_type" id="form_type">

<script>
    $(document).ready(function () {


        const divtimesheet_month = document.getElementById('timesheet_month');
        if (divtimesheet_month) {
            for (let i = 0; i < 12; i++) {
                const month = moment().startOf('year').add(i, 'months').format('MMMM');
                const option = document.createElement('option');
                option.value = month;
                option.textContent = month;
                divtimesheet_month.appendChild(option);
            }
        }

        const divcheckbox = document.getElementById('divcheckbox');
        if (divcheckbox) {
            const arrTime = [];
            for (let i = 0; i <= 31; i++) {
                const div = document.createElement('div');
                div.className = 'd-flex col-12 justify-content-between'
                const day = document.createElement('span');
                day.className = 'd-flex  justify-content-center mb-4';
                day.style.width = '50px';
                if (i == 0) {
                    day.textContent = '';
                } else {
                    day.textContent = i;
                }

                div.appendChild(day);
                const divcb = document.createElement('div');
                divcb.className = 'd-flex col  flex-wrap justify-content-between';

                if (i == 0) {

                    for (let k = 0; k < 24; k++) {
                        const startTime = moment().set({ hour: k, minute: 0, second: 0 });
                        const halfHourLater = moment(startTime).add(30, 'minutes');
                        arrTime.push(startTime.format('HH:mm'), halfHourLater.format('HH:mm'))
                    }

                    arrTime.forEach(element => {
                        const span = document.createElement('span');
                        span.className = 'mb-3';
                        span.style.transform = 'rotate(-50deg)';
                        span.style.fontSize = '1.1vh';
                        span.textContent = element;
                        divcb.appendChild(span);
                    });

                } else {
                    for (let j = 0; j < 48; j++) {
                        // สร้าง input
                        const input = document.createElement('input');
                        input.type = 'checkbox';
                        input.id = 'day' + i;
                        input.className = 'form-check col';
                        input.name = 'day' + i;
                        input.title = 'day ' + i + ' ' + arrTime[j];
                        divcb.appendChild(input);
                    }
                }

                div.appendChild(divcb);
                divcheckbox.appendChild(div);
            }

        }

    })
</script>