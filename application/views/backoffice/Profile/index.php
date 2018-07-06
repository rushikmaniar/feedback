<div class="card">
    <div class="card-body">
        <form id="frm_profile" method="post" action="<?= base_url('backoffice/Profile/editProfile')?>">
            <div class="row col-sm-12">

                <!-- User Email -->
                <div class="col-sm-12">
                    <div class="input-group ">
                        <label class="col-sm-12">User Email</label>
                            <input type="hidden" name="frm_profile_user_id" id="frm_profile_user_id" value="<?= $user_details['user_id'] ?>">
                            <input type="text" class="form-control" id="frm_profile_user_email"
                                   name="frm_profile_user_email" value="<?= $user_details['user_email'] ?>"
                                   placeholder="Enter User Email">

                    </div>
                </div>

                <!-- submit  -->
                <div class="col-sm-6">
                    <div class="input-group form-group">
                        <button type="submit" class="btn-md btn-primary"><i class="fa fa-save"></i>Submit</button>
                    </div>
                </div>


            </div>
        </form>
    </div>

</div>
<script>
    $(document).ready(function () {
        var update_id = $('#frm_profile_user_id').val();
        $("#frm_profile").validate({
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
                'frm_profile_user_email': {
                    required: true,
                    remote: {
                        url: base_url + "backoffice/Profile/checkexists/user_id/" + update_id,
                        type: "post",
                        data: {
                            'table': 'user',
                            'field': 'user_email',
                            user_email: function () {
                                return $('#frm_profile_user_email').val();
                            }
                        }
                    }
                }


            },
            messages: {
                'frm_profile_user_email': {
                    required: "This field is required.",
                    remote: "User Email already Exists"
                }
            }
        });
    });

</script>