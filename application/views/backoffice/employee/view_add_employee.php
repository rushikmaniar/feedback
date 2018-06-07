<?= form_open("backoffice/Employee/addEditEmployee", array('id' => 'employee_frm', 'method' => 'post')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'action', 'id' => 'action', 'value' => (isset($employee_data)) ? 'editEmployee' : 'addEmployee')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'update_id', 'id' => 'update_id', 'value' => (isset($employee_data)) ? $employee_data['id'] : '')) ?>

<div class="row">

    <!-- Employee Code  -->
    <div class="col-sm-6">
        <div class="input-group form-group">
            <?= form_input(array('name' => 'employee_frm_emp_code', 'id' => 'employee_frm_emp_code', 'class' => 'form-control', 'placeholder' => 'Employee  Code', 'value' => (isset($employee_data)) ? $employee_data['emp_code'] : '')) ?>
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
        </div>
    </div>

    <!-- Employee Name  -->
    <div class="col-sm-6">
        <div class="input-group form-group">
            <?= form_input(array('name' => 'employee_frm_emp_name', 'id' => 'employee_frm_emp_name', 'class' => 'form-control', 'placeholder' => 'Employee  Name', 'value' => (isset($employee_data)) ? $employee_data['emp_name'] : '')) ?>
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
        </div>
    </div>

    <!-- Employee Phone  -->
    <div class="col-sm-6">
        <div class="input-group form-group">
            <?= form_input(array('name' => 'employee_frm_emp_phone', 'id' => 'employee_frm_emp_phone', 'class' => 'form-control', 'placeholder' => 'Employee  Phone', 'value' => (isset($employee_data)) ? $employee_data['emp_phone'] : '')) ?>
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
        </div>
    </div>

    <!-- Employee Email  -->
    <div class="col-sm-6">
        <div class="input-group form-group">
            <?= form_input(array('name' => 'employee_frm_emp_email', 'id' => 'employee_frm_emp_email', 'class' => 'form-control', 'placeholder' => 'Employee  Email', 'value' => (isset($employee_data)) ? $employee_data['emp_email'] : '')) ?>
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
        </div>
    </div>

    <!-- Select Department -->
    <div class="col-sm-12">
        <select name="class_frm_dept_id" id="class_frm_dept_id" style="width: 30%" class="form-control">
            <option value="0" selected>No Department</option>
            <?php foreach ($department_list as $row): ?>
                <?php if (isset($class_data['dept_id'])): ?>
                    <?php if (($class_data['dept_id']) == $row['dept_id']): ?>
                        <option value="<?= $row['dept_id'] ?>" selected><?= $row['dept_name'] ?></option>
                    <?php else: ?>
                        <option value="<?= $row['dept_id'] ?>"><?= $row['dept_name'] ?></option>
                    <?php endif; ?>
                <?php else: ?>
                    <option value="<?= $row['dept_id'] ?>"><?= $row['dept_name'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>

    <!--  submit -->
    <div class="col-md-12">
        <button type="submit" id="btn-add-user" class="btn btn-success m-t-10 pull-right">
            <?= (isset($employee_data)) ? '<i class="fa fa-save"></i> Save' : '<i class="fa fa-plus"></i> Add' ?>
        </button>
    </div>
    <?= form_close(); ?>

    <script>

        var update_id = $('#update_id').val();
        $(document).ready(function () {
            $('#employee_frm_dept_id').select2();

            /*************************************
             Add Edit employee
             *************************************/
            $("#employee_frm").validate({
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
                        'employee_frm_emp_code': {
                            required: true,
                            remote: {
                                url: base_url+"backoffice/Employee/checkexists/"+update_id,
                                type: "post",
                                data: {
                                    'table': 'employee_master',
                                    'field': 'emp_code',
                                    emp_code: function () {
                                        return $('#employee_frm_emp_code').val();
                                    }
                                }
                            }
                        },
                        'employee_frm_emp_name': {
                            required: true
                        },
                        'employee_frm_emp_email': {
                            required: true,
                            email: true,
                            remote: {
                                url: base_url+"backoffice/Employee/checkexists/"+update_id,
                                type: "post",
                                data: {
                                    'table': 'employee_master',
                                    'field': 'emp_email',
                                    emp_email: function () {
                                        return $('#employee_frm_emp_email').val();
                                    }
                                }
                            }
                        },
                        'employee_frm_emp_phone': {
                            regex: "^[6-9]\\d{9}$",
                            remote: {
                                url: base_url+"backoffice/Employee/checkexists/"+update_id,
                                type: "post",
                                data: {
                                    'table': 'employee_master',
                                    'field': 'emp_phone',
                                    emp_phone: function () {
                                        return $('#employee_frm_emp_phone').val();
                                    }
                                }
                            }
                        }
                    },

                messages:
                    {
                        'employee_frm_emp_code': {
                            required: "This field is required.",
                            remote:"Employee code already Exists"
                        },
                        'employee_frm_emp_name': {
                            required: "This field is required."
                        },
                        'employee_frm_emp_email': {
                            required: "This field is required.",
                            email: "Please enter valid email.",
                            remote:"Employee Email already Exists"
                        },
                        'employee_frm_emp_phone': {
                            regex: "Please Enter valid mobile number",
                            remote:"Employee Phone already Exists"
                        }
                    }
            });
            /*************************************
             Add Edit User End
             *************************************/

        });
    </script>