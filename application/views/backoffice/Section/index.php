<div class="card">
    <div class="card-body">
        <div class="col-sm-12 col-md-12">
                        <h1 class="blink text-danger" align="center">Don't Edit This Section Unless You Know  What You Are Doing .</h1>
                        <h1 class="blink text-danger" align="center">Criteria Management,Analysis tables , Front site Feedback form Relies On Sections</h1>
                        <button type="button" class="btn btn-success btn-top" title="Add Section" onclick="ajaxModel('backoffice/SectionManagement/viewAddSectionModal','Add New Section','modal-md')" data-toggle="modal" data-target="#feedback_admin_modal">
                            <i class="fa fa-plus"></i> Add New Section
                        </button>
        </div>
            <table class="display nowrap table table-hover table-striped table-bordered dataTable" id="SectionTable">
                        <thead>
                        <tr>
                            <th>Section ID</th>
                            <th>Section Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($section_master_data as $row): ?>
                            <tr>
                                <!-- Section id -->

                                <td><?=$row['id']?></td>
                                <td><?=$row['section_name']?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm" data-tooltip="Edit Section" data-container="body" title="Edit Section" onclick="ajaxModel('backoffice/SectionManagement/viewEditSectionModal/<?=$row['id']?>','Edit Section',800)">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-tooltip="Delete Section" data-container="body" title="Delete Section" onclick="deletesection(<?=$row['id']?>)">
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

        $('#SectionTable').dataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        //blink text
        $('.blink').modernBlink({
            duration: 3000
        });

    });
	/*************************************
				Delete Section Criteria
	*************************************/
    function deletesection(section_master_id)
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
            url: base_url + "backoffice/SectionManagement/deleteSection",
            type: "POST",
            dataType: "json",
            data: {"section_master_id": section_master_id},
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
				Delete Section End
	*************************************/
</script>