<?= form_open("backoffice/CriteriaManagement/addEditCriteria", array('id' => 'criteria_frm', 'method' => 'post')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'action', 'id' => 'action', 'value' => (isset($criteria_data)) ? 'editCriteria' : 'addCriteria')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'update_id', 'id' => 'update_id', 'value' => (isset($criteria_data)) ? $criteria_data['id'] : '')) ?>

<div class="row">

    <!-- Select Section -->
    <div class="col-sm-12 form-group">
        <label>Select section</label>
        <select name="criteria_frm_section_id" id="criteria_frm_section_id" style="width: 30%" class="form-control">
            <?php foreach ($section_list as $row): ?>
                <?php if (isset($criteria_data['section_id'])): ?>
                    <?php if (($criteria_data['section_id']) == $row['section_id']): ?>
                        <option value="<?= $row['section_id'] ?>" selected><?= $row['section_name'] ?></option>
                    <?php else: ?>
                        <option value="<?= $row['section_id'] ?>"><?= $row['section_name'] ?></option>
                    <?php endif; ?>
                <?php else: ?>
                    <option value="<?= $row['section_id'] ?>"><?= $row['section_name'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>


    <!-- Criteria Name  -->
    <div class="col-sm-12">
        <div class="input-group form-group">
            <?= form_input(array('name' => 'criteria_frm_point_name', 'id' => 'criteria_frm_point_name', 'class' => 'form-control', 'placeholder' => 'Criteria  Name', 'value' => (isset($criteria_data)) ? $criteria_data['point_name'] : '')) ?>
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
        </div>
    </div>

    <!--  submit -->
    <div class="col-md-12">
        <button type="submit" id="btn-add-user" class="btn btn-success m-t-10 pull-right">
            <?= (isset($criteria_data)) ? '<i class="fa fa-save"></i> Save' : '<i class="fa fa-plus"></i> Add' ?>
        </button>
    </div>
    <?= form_close(); ?>

    <script>

        var update_id = $('#update_id').val();
        $(document).ready(function () {
            $('#criteria_frm_section_id').select2({
                placeholder:"Select Section"
            });
            /*************************************
             Add Edit Criteria
             *************************************/
            $("#criteria_frm").validate({
                errorClass: 'invalid-feedback animated fadeInDown',
                /*errorPlacement: function(error, element) {
                    error.appendTo(element.parent().parent());
                },*/
                errorPlacement: function (e, a) {
                    jQuery(a).parents(".input-group").append(e)
                },
                highlight: function (e) {
                    jQuery(e).closest(".input-group").removeClass("is-invalid").addClass("is-invalid")
                },
                success: function (e) {
                    jQuery(e).closest(".input-group").removeClass("is-invalid"), jQuery(e).remove()
                },
                rules:
                    {
                        criteria_frm_section_id:{
                            required: true
                        },
                        'criteria_frm_point_name': {
                            required: true,
                            remote: {
                                url: base_url+"backoffice/CriteriaManagement/checkexists/"+update_id,
                                type: "post",
                                data: {
                                    'table': 'criteria_master',
                                    'field': 'point_name',
                                    point_name: function () {
                                        return $('#criteria_frm_point_name').val();
                                    }
                                }
                            }
                        }

                    },
                messages:
                    {
                        'criteria_frm_point_name': {
                            required: "This field is required.",
                            remote:"Criteria already Exists"
                        },
                        criteria_frm_section_id: {
                            required: "This field is required."
                        }
                    }
            });
            /*************************************
             Add Edit Criteria End
             *************************************/

        });
    </script>