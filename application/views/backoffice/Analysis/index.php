<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26/6/2018
 * Time: 1:08 PM
 */ ?>
<div class="card">
    <div class="card-body">
        <form id="form_analysis" method="post" action="">
            <div class="row">

                <!-- Class List -->
                <div class="col-md-3 form-group">
                    <label>Select Class</label>
                    <select name="class_select[]" id="class_select" class="form-control select2">
                        <option value="0" class="multi_class">All class</option>
                        <?php foreach ($class_list as $row_class): ?>
                            <option class="multi_class" value="<?= $row_class['class_id']; ?>"><?= $row_class['class_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Section List -->
                <div class="col-md-3 form-group">
                    <label>Select Section</label>
                    <select name="section_select" id="section_select" class="form-control select2" >
                        <option>Select Section</option>
                        <?php foreach ($section_list as $row_section): ?>
                            <option value="<?= $row_section['section_id']; ?>"><?= $row_section['section_name'] ?></option>
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
                    <button type="button" id="btn_refresh" class="btn-md btn-primary">Refresh</button>
                </div>

                <div id="morris-bar-chart"></div>
                <div id="morris-pie-chart"></div>

            </div>
        </form>
    </div>
</div>
<script type="text/javascript">

    function getAnalysisData(class_id, section_id, criteria_id, employee_id) {
        if (typeof class_id === 'undefined' ) {
            class_id = null;
        }
        if (typeof section_id === 'undefined' ) {
            section_id = null;
        }
        if (typeof criteria_id === 'undefined' ) {
            criteria_id = null;
        }
        if (typeof employee_id === 'undefined' ) {
            employee_id = null;
        }

        alert(class_id+'  ' + section_id + '  ' + criteria_id + '  ' + employee_id);

        //ajax call for data
        $.ajax({
            url: base_url + 'backoffice/Analysis/getAnalysisData',
            type: 'post',
            data: {
                'class_id':class_id,
                'section_id': section_id,
                'criteria_id': criteria_id,
                'employee_id': employee_id
            },
            success: function (response) {

            },
            error: function (response) {

            }
        });

    }

    $(document).ready(function () {

        //static morris chart
        // Morris bar chart
        Morris.Bar( {
            element: 'morris-bar-chart',
            data: [ {
                y: '2006',
                a: 100,
                b: 90,
                c: 60
            }, {
                y: '2007',
                a: 75,
                b: 65,
                c: 40
            }, {
                y: '2008',
                a: 50,
                b: 40,
                c: 30
            }, {
                y: '2009',
                a: 75,
                b: 65,
                c: 40
            }, {
                y: '2010',
                a: 50,
                b: 40,
                c: 30
            }, {
                y: '2011',
                a: 75,
                b: 65,
                c: 40
            }, {
                y: '2012',
                a: 100,
                b: 90,
                c: 40
            } ],
            xkey: 'y',
            ykeys: [ 'a', 'b', 'c' ],
            labels: [ 'A', 'B', 'C' ],
            barColors: [ '#26DAD2', '#fc6180', '#4680ff' ],
            hideHover: 'auto',
            gridLineColor: '#eef0f2',
            resize: true
        } );

        Morris.Pie






        $("#form_analysis").validate({
            errorClass: 'invalid-feedback animated fadeInDown',
            /*errorPlacement: function(error, element) {
             error.appendTo(element.parent().parent());
             },*/
            errorPlacement: function (e, a) {
                jQuery(a).parents(".form-group").append(e)
            },
            highlight: function (e) {
                jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
            },
            success: function (e) {
                jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
            },
            rules: {
                'class_select': {
                    required: true
                },
                'section_select': {
                    required: true
                },
                'criteria_select': {
                    required: true
                },
                'employee_select':{
                    required:{
                        depends:function () {
                            return $('#section_select').val() == 1
                        }
                    }
                }
            },
            messages: {
                'class_select[]': {
                    required: "This field is required."
                },
                'section_select': {
                    required: "This field is required."
                },
                'criteria_select': {
                    required: "This field is required."
                },
                'employee_select':{
                    required: "This field is required."
                }
            }
        });

        $('#btn_refresh').on('click', function () {
            if ($('#form_analysis').valid()) {
                //form is valid
                console.log('valid');
                var class_id = $('#class_select').select2('val');
                var section_id = $('#section_select').val();
                var criteria_id = $('#criteria_select').val();
                var employee_id = $('#employee_select').val();

                getAnalysisData(class_id,section_id,criteria_id,employee_id);


            } else {
                // form is invalid

                console.log('else');
            }
        });
        //on section change
        $('#section_select').on('change', function () {
            var sectionid = $(this).val();
            var class_id = $('#class_id').val();
            $('#class_select option[value = 0]').remove();
            if(sectionid != 1){
                $('#class_select').append($('<option>', {
                    value: 0,
                    text: 'All Class'
                }));
            }
            //get criteria list
            $.ajax({
                url: base_url + 'backoffice/Analysis/getCriteriaEmpList',
                type: 'post',
                data: {'section_id': sectionid,'class_id':class_id},
                success: function (response) {
                    response = JSON.parse(response);


                    //$('#criteria_select').html('');

                    //set criteria list
                    var option = '';
                    if(response.employee_list.length > 0)
                    option += '<option value="0">All Criterias</option>';
                    $.each(response.criteria_list, function (index, value) {
                        option += '<option value="' + value.criteria_id + '">' + value.criteria_name + '</option>';
                    });
                    $('#criteria_select').html(option);


                        //set employee list
                        var option = '';

                        // option += '<option value="0">All Employees</option>';
                        $.each(response.employee_list, function (index, value) {
                            option += '<option value="' + value.emp_code + '">' + value.emp_name + '</option>';
                        });
                        $('#employee_select').html(option);



                },
                error: function (response) {
                    console.log(response);
                }
            });
        });


        //on class change
        $('#class_select').on('change', function () {
            var class_id = $(this).val();
            var section_id = $('#section_select').val();
            console.log(class_id);
            if (section_id == 1) {
                //get criteria list
                $.ajax({
                    url: base_url + 'backoffice/Analysis/getEmpList',
                    type: 'post',
                    data: {'class_id': class_id},
                    success: function (response) {
                        response = JSON.parse(response);


                            //set employee list
                            var option = '';
                            //option += '<option value="">Select Employee</option>';
                            $.each(response.employee_list, function (index, value) {
                                option += '<option value="' + value.emp_code + '">' + value.emp_name + '</option>';
                            });
                            $('#employee_select').html(option);

                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
            }
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
            dropdownAutoWidth: true
        });
    });
</script>


