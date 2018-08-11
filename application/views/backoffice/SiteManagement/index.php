<div class="card">
    <div class="card-body">
        <form id="frm_sitesetting" method="post" action="<?= base_url('backoffice/Profile/editProfile')?>" enctype="multipart/form-data">
            <div class="row col-sm-12">
                <!-- User Image -->
                <div class="col-sm-3 form-group thumbnail">
                    <div class="input-group image">

                        <input type="file" name="frm_profile_user_image" id="frm_profile_user_image" style="display:none" onchange="readURL(this)">
                        <a href="javscript:void()" onclick="$('#frm_profile_user_image').click()">
                            <img src="<?= base_url('uploads/user/profile/').$user_details['user_image']?>" id="user_image"

                                 class="img-responsive img-circle img-fluid"
                                 onerror="this.src='<?= base_url('images/person-noimage-found.png')?>'">
                        </a>

                    </div>
                </div>

                <!-- User Email -->
                <div class="col-sm-12 form-group">
                    <div class="input-group">
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

</script>