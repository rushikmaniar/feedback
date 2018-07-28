<?= form_open("backoffice/DatabaseManagement/truncatetables", array('id' => 'truncate_frm', 'method' => 'post')) ?>

<div class="row">



    <!-- tables list -->
    <div class="col-sm-12">
        <select name="tables_list[]" id="tables_list" style="width: 30%" class="form-control" multiple="multiple">
            <?php foreach ($tablelist as $row): ?>

                    <option value="<?= $row ?>"><?= $row ?></option>

            <?php endforeach; ?>
        </select>
    </div>

    <!--  submit -->
    <div class="col-md-12">
        <button type="submit" id="btn-truncate" class="btn btn-danger m-t-10 pull-right" onclick="sure()">
            <i class="fa fa-remove"></i>Truncate
        </button>
    </div>
    <?= form_close(); ?>

    <script>
        function sure() {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Truncate it!'
            }).then(function (result) {
                $('#truncate_frm').submit();

            }).catch(swal.noop);
        }
        $(document).ready(function () {
            $('#tables_list').select2();

            /*************************************
             truncate tables
             *************************************/
            $("#class_frm").validate({
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
                    'tables_list[]': {
                        required: true

                    }
                },

                messages: {
                    'tables_list[]': {
                        required: "This field is required."
                    }
                }
            });
            /*************************************
             trucate tables
             *************************************/

        });
    </script>