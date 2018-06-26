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
                <select name="class_list" id="class_list" class="form-control select2">
                    <?php foreach ($class_list as $row_class): ?>
                        <option>All Class</option>
                        <option value="<?= $row_class['class_id']; ?>"><?= $row_class['class_name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            </div>
            <!-- Section List -->
            <div class="col-md-3">
                <label>Select Section</label>
                <select name="section_list" id="section_list" class="form-control select2">
                    <?php foreach ($section_list as $row_section): ?>
                        <option>General Analysis</option>
                        <option value="<?= $row_section['id']; ?>"><?= $row_section['section_name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Criteria List -->
            <div class="col-md-3">
                <label>Select Criterias</label>
                <select name="criteria_list" id="criteria_list" class="form-control select2">

                </select>
            </div>

            <!-- Employee List -->
            <div class="col-md-3">
                <label>Select Employees</label>
                <select name="employee_list" id="employee_list" class="form-control select2">

                </select>
            </div>


        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
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


