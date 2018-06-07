<div class="card">
    <div class="card-body">
            <table class="display nowrap table table-hover table-striped table-bordered dataTable" id="AllocationTable">
                        <thead>
                        <tr>
                            <th>Class Name</th>
                            <th>Emplyoees Allocated</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($class_list as $row): ?>
                            <tr>
                                <!-- Class id -->

                                <td><?=$row['class_name']?></td>
                                <td>
                                    <?php if(!empty($allocation_data[$row['class_id']])):?>
                                    <?php foreach ($allocation_data[$row['class_id']] as $emp):
                                            echo $emp['emp_name']."<br>";
                                        endforeach;?>
                                        <?php else:?>
                                        NO Employees Allocated to this class
                                    <?php endif;?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm" data-tooltip="Edit Criteria" data-container="body" title="Edit Criteria" onclick="ajaxModel('backoffice/CriteriaManagement/viewEditCriteriaModal/<?=$row['class_id']?>','Edit Criteria',800)">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-tooltip="Delete Criteria" data-container="body" title="Delete Criteria" onclick="deleteallocation(<?=$row['class_id']?>)">
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

        $('#AllocationTable').dataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    });
	/*************************************
				Delete Allocation
	*************************************/
    function deleteallocation(class_id)
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
            url: base_url + "backoffice/CriteriaManagement/deleteCriteria",
            type: "POST",
            dataType: "json",
            data: {"criteria_id": criteria_id},
            success: function (result) {
                if (result.code == 1 && result.code != '') {
                    toastr["success"](result.message, "Success");
                }
                else {
                    toastr["error"](result.message, "Error");
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
				Delete Criteria End
	*************************************/
</script>