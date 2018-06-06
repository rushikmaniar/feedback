<?= form_open("backoffice/CriteriaManagement/addEditCriteria", array('id' => 'criteria_frm', 'method' => 'post')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'action', 'id' => 'action', 'value' => (isset($criteria_data)) ? 'editCriteria' : 'addCriteria')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'update_id', 'id' => 'update_id', 'value' => (isset($criteria_data)) ? $criteria_data['id'] : '')) ?>

<div class="row">



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
                        }
                    }
            });
            /*************************************
             Add Edit Criteria End
             *************************************/

        });
    </script>