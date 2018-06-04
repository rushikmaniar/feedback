<div class="card">
    <div class="card-body">
        <div class="col-sm-12 col-md-12">
                        <button type="button" class="btn btn-success btn-top" id="btn_add_user" onclick="ajaxModel('backoffice/Employee/viewAddEmployeeModal','Add New Employee','modal-lg')" data-toggle="modal" data-target="#feedback_admin_modal">
                            <i class="fa fa-plus"></i> Add Employee
                        </button>
        </div>
            <table class="display nowrap table table-hover table-striped table-bordered dataTable" id="EmployeeTable">
                        <thead>
                        <tr>
                            <th>Employee Code</th>
                            <th>Employee Name</th>
                            <th>Employee Email</th>
                            <th>Employee Mobile</th>
                            <th>Department</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($employee_data as $row): ?>
                            <tr>
                                <!-- Employee Code -->

                                <td><?=$row['emp_code']?></td>
                                <td><?=$row['emp_name']?></td>
                                <td><?=$row['emp_phone']?></td>
                                <td><?=$row['emp_email']?></td>
                                <td><?=$row['dept_name']?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm" data-tooltip="Edit Employee" data-container="body" title="Edit User" onclick="ajaxModel('backoffice/Employee/viewEditEmployeeModal/<?=$row['id']?>','Edit Employee',800)">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-tooltip="Delete Employee" data-container="body" title="Delete User" onclick="deleteUser(<?=$row['id']?>)">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
            </div>

    </div>
<script>
    $(document).ready(function () {

        $('#EmployeeTable').dataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    });
	/*************************************
				Delete User
	*************************************/
    function deleteUser(emp_id)
    {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function(result)  {

            $.ajax({
            url: base_url + "backoffice/Employee/deleteEmployee",
            type: "POST",
            dataType: "json",
            data: {"emp_id": emp_id},
            success: function (result) {
                if (result.code == 1 && result.code != '') {
                    $.notify({message: result.message },{type: 'success'});
                }
                else {
                    $.notify({message: result.message },{type: 'error'});
                }
            },
            error:function (result) {
                console.log(result);
            }
        });
        setTimeout(function () {
            location.reload();
        },1000);


    }).catch(swal.noop);
    }
	/*************************************
				Delete User End
	*************************************/
</script>