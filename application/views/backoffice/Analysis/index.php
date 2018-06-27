<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26/6/2018
 * Time: 1:08 PM
 */?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            <!-- Class List -->
            <div class="col-md-4">
                <label>Select Class</label>
                <select name="class_select" id="class_select" class="form-control select2">
                    <?php foreach ($class_list as $row_class): ?>
                        <option>Select Class</option>
                        <option value="<?= $row_class['class_id']; ?>"><?= $row_class['class_name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            </div>
            <!-- Section List -->
            <div class="col-md-3">
                <label>Select Section</label>
                <select name="section_select" id="section_select" class="form-control select2">
                    <option value="" selected>Select section</option>
                    <?php foreach ($section_list as $row_section): ?>
                        <option value="<?= $row_section['id']; ?>"><?= $row_section['section_name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Criteria List -->
            <div class="col-md-3">
                <label>Select Criterias</label>
                <select name="criteria_select" id="criteria_select" class="form-control select2">
                    <option>Select Criteia</option>
                </select>
            </div>

            <!-- Employee List -->
            <div class="col-md-3" id="employee_select_div" style="display: none">
                <label>Select Employees</label>
                <select name="employee_select" id="employee_select" class="form-control select2">
                    <option>Select Employee</option>
                </select>
            </div>


        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        
        function getAnlaysedData(section_id,criteria_id,employee_id,class_id) {
            if(undefined(criteria_id)){
                criteria_id = null;
            }
            if(undefined(employee_id)){
                employee_id = null;
            }
            if(undefined(class_id)){
                class_id = null;
            }

            //ajax call for data

        }
        
        //on section change
        $('#section_select').on('change',function () {
            var section_id = $(this).val();
        });

        //Section select2
        $('#class_list').select2({
            placeholder: "Select a Class"
        });

        //Section select2
        $('#section_list').select2({
            placeholder: "Select a Section"
        });

        //Criteria select2
        $('#criteria_list').select2({
            placeholder: "Select a Criteria"
        });


        //select2
        $('.select2').select2({
            //allowClear: true,
            dropdownAutoWidth : true
        });
    });
</script>


