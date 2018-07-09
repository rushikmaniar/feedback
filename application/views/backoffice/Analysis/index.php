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
            <!-- Class List -->
            <div class="col-md-3 form-group">
                <label>Select Class</label>
                <select name="class_select" id="class_select" class="form-control select2">
                    <option value="0">All class</option>
                    <?php foreach ($class_list as $row_class): ?>
                        <option value="<?= $row_class['class_id']; ?>"><?= $row_class['class_name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Section List -->
            <div class="col-md-3 form-group">
                <label>Select Section</label>
                <select name="section_select" id="section_select" class="form-control select2">
                    <?php foreach ($section_list as $row_section): ?>
                        <option value="<?= $row_section['section_id']; ?>"><?= $row_section['section_name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Criteria List -->
            <div class="col-md-3 form-group">
                <label>Select Criterias</label>
                <select name="criteria_select" id="criteria_select" class="form-control select2">
                </select>
            </div>

            <!-- Employee List -->
            <div class="col-md-3 form-group" id="employee_select_div">
                <label>Select Employees</label>
                <select name="employee_select" id="employee_select" class="form-control select2">
                </select>
            </div>

            <!-- Submit  Button -->
            <div class="col-md-12 form-group" id="employee_select_div">
                <button type="submit" class="btn-md btn-primary">Submit</button>
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
            var sectionid = $(this).val();

            //get criteria list
            $.ajax({
               url:base_url + 'backoffice/Analysis/getCriteriaList',
                type:'post',
                data:{'section_id':sectionid},
                success:function (response) {
                   response = JSON.parse(response);
                   //$('#criteria_select').html('');
                   var option = '';
                   $.each(response.data,function (index,value) {
                       option += '<option value="'+value.section_id+'">'+value.criteria_name+'</option>';
                    });
                   $('#criteria_select').html(option);
                },
                error:function (response) {
                    console.log(response);
                }
            });
        });

        //Section select2
        $('#class_select').select2({
            placeholder: "Select a Class"
        });

        //Section select2
        $('#section_select').select2({
            placeholder: "Select a Section"
        });

        //Criteria select2
        $('#criteria_select').select2({
            placeholder: "Select a Criteria"
        });


        //select2
        $('.select2').select2({
            //allowClear: true,
            dropdownAutoWidth : true
        });
    });
</script>


