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

    <!--want options data ? -->
    <div class="col-sm-12 form-group">
        <label>Type Of Data</label>
        <div>
            Simple Data (0-5)
            <input type="radio" name="radios" value="simple" checked="checked">
            With Options
            <input type="radio" name="radios" value="options">
        </div>

        <div id="options" style="display: none">
            <div class="row">

                <div class="col-sm-12 form-group">
                    <button class="btn-primary btn-sm pull-right" onclick="addoptions()"><i class="fa fa-plus"></i> Add
                        Fields
                    </button>
                </div>

                <div class="col-sm-12" id="options_div">
                    <!-- option for design -->
                    <?php if(isset($criteria_data['option_data'])):?>
                    <?php else:?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group form-group">
                                    <input type="text" class="form-control" name="options[][][option_text]" placeholder="Enter Option Text" required="true">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group form-group">
                                    <input type="text" class="form-control" name="options[][][option_value]" placeholder="Enter Option Value" required="true">
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
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
        function addoptions() {
            var options_div = $('#options_div');
            html = '<div class="row">';
            html += '<div class="col-sm-6">';
                html += '<div class="input-group form-group">';
                html += '<input type="text" class="form-control" name="options[][][option_text]" placeholder="Enter Option Text" required="true">';
                html += '</div>';
            html += '</div>';

            html += '<div class="col-sm-6">';
                html += '<div class="input-group form-group">';
                html += '<input type="text" class="form-control"  name="options[][][option_value]" placeholder="Enter Option Value" required="true">';
                html += '<button class="btn-danger btn-sm" onclick="deleteoption(this)"><i class="fa fa-minus"></i> Delete</button>';
                html +=  '</div>';
            html +=  '</div>';
            html +=  '</div>';


            options_div.append(html);
        }
        function  deleteoption(element) {
            console.log(element);
            $(element).parent().parent().parent().html('');
        }

        var update_id = $('#update_id').val();
        $(document).ready(function () {
            /*On radio change */
            $('input[type=radio]').on('change',function () {
               if($(this).val() == "options"){
                   $('#options').css('display','block');
               }else{
                   $('#options').css('display','none');
               }
            });

            $('#criteria_frm_section_id').select2({
                placeholder: "Select Section"
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
                rules: {
                    criteria_frm_section_id: {
                        required: true
                    },
                    'criteria_frm_point_name': {
                        required: true,
                        remote: {
                            url: base_url + "backoffice/CriteriaManagement/checkexists/" + update_id,
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
                messages: {
                    'criteria_frm_point_name': {
                        required: "This field is required.",
                        remote: "Criteria already Exists"
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