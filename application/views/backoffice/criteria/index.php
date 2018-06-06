<div class="card">
    <div class="card-body">
        <div class="col-sm-12 col-md-12">
                        <button type="button" class="btn btn-success btn-top" title="Add Criteria" id="btn_add_user" onclick="ajaxModel('backoffice/CriteriaManagement/viewAddCriteriaModal','Add New Criteria','modal-md')" data-toggle="modal" data-target="#feedback_admin_modal">
                            <i class="fa fa-plus"></i> Add Criteria
                        </button>
        </div>
            <table class="display nowrap table table-hover table-striped table-bordered dataTable" id="CriteriaTable">
                        <thead>
                        <tr>
                            <th>Criteria ID</th>
                            <th>Criteria Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($criteria_data as $row): ?>
                            <tr>
                                <!-- Criteria id -->

                                <td><?=$row['id']?></td>
                                <td><?=$row['point_name']?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm" data-tooltip="Edit Criteria" data-container="body" title="Edit Criteria" onclick="ajaxModel('backoffice/CriteriaManagement/viewEditCriteriaModal/<?=$row['id']?>','Edit Criteria',800)">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-tooltip="Delete Criteria" data-container="body" title="Delete Criteria" onclick="deletecriteria(<?=$row['id']?>)">
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

        $('#CriteriaTable').dataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    });
	/*************************************
				Delete Criteria
	*************************************/
    function deletecriteria(criteria_id)
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