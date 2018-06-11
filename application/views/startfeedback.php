<?php
/**
 * Created by PhpStorm.
 * User: jatin
 * Date: 010 10-06-2018
 * Time: 01:36 PM
 */?>
<div align="center">
    <h1>CHRIST COLLEGE RAJKOT</h1>
    <h2> Student Feedback Form </h2>
</div>
<h3 class="text-danger">Please give Rating On scale 1-5</h3>
<h3 class="text-warning blink">1-Unstatisfactory ,2-Statisfactory,3-Good,4-Very Good,5-Excellent</h3>
<div class="container mb-5">
    <form id="frm_feedback" name="frm_feedback" method="post" action="<?= base_url().''?>">
        <div>

            <!-- Select Class -->
            <h3>Select Class</h3>
            <section>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="frm_feedback_class" class="col-form-label-lg"><h4>Select Class</h4></label>
                        <select name="frm_feedback_class" id="frm_feedback_class" class="select2 form-control" style="width: 80%">
                            <option value="">Select Class</option>
                        <?php foreach ($class_list as $row):?>
                            <option value="<?= $row['class_id']; ?>"><?= $row['class_name']; ?></option>
                        <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </section>

            <!-- Employee Feedback -->
            <h3>Employee Feddback</h3>
            <section>
                <div class="row">
                    <div class="form-group col-md-12 card">
                        <table id="frm_feedback_emp_table" class="table table-bordered table-hover">
                            <thead>
                            <?php foreach ($criteria_list as $row):?>
                                <td data-criteriaid="<?= $row['id']; ?>"><?= $row['point_name']; ?></td>
                            <?php endforeach;?>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>


        </div>

    </form>
</div>
<script type="text/javascript">
$(document).ready(function () {

   //blink text
    $('.blink').modernBlink({
       duration: 2000
   });


    //multi step form
    $('#frm_feedback').children('div').steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex)
        {
            $('#frm_feedback').validate().settings.ignore = ":disabled,:hidden";
            return $('#frm_feedback').valid();
        },
        onFinishing: function (event, currentIndex)
        {
            $('#frm_feedback').validate().settings.ignore = ":disabled";
            return $('#frm_feedback').valid();
        },
        onFinished: function (event, currentIndex)
        {
            alert("Submitted!");
        }
    });

    $('#frm_feedback_class').on('change',function () {
        var class_id = $(this).val();
        if(class_id){
            $.ajax({
                type:'post',
                async:false,
                url:base_url+'/StartFeedback/getRelatedEmployees',
                data:{'class_id':class_id},
                success:function (response) {
                    var response = JSON.parse(response);
                    if(response.code == 1){
                        var html = '';
                        $.each(response.data,function (key,value) {
                           html+= '<tr>' +
                               '<td data-emp_code="'+value.employee_codes+'">'+value.emp_name+'</td>' +
                               '</tr>';
                            console.log(value);
                        });
                        $('#frm_feedback_emp_table tbody').html(html);
                    }else{
                        toastr["error"](response.message, "Error");
                    }
                },
                error:function (response) {
                    console.log(response);
                }
            })
        }
    });

    // jquery validation
    $('#frm_feedback').validate({
        errorClass: 'invalid-feedback animated fadeInDown',
        highlight: function (e) {
            jQuery(e).addClass("is-invalid");
        },
        success: function (label,element) {
            jQuery(element).removeClass("is-invalid").removeClass("invalid-feedback").addClass("is-valid");
        },
        rules: {
            frm_feedback_class:{
                required:true
            }
        },messages:{
            frm_feedback_class:{
                required:"This field is required"
            }
        }
    });

    //select2
    $('#frm_feedback_class').select2({
        placeholder: "Select a class",
        allowClear: true
    });
});
</script>
