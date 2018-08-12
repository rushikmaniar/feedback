<div class="card">
    <div class="card-body">
        <form id="frm_sitesettings" method="post" action="<?= base_url('backoffice/SiteManagement/editSettings')?>" enctype="multipart/form-data">
            <div class="row col-sm-12">

                <!-- Front HomePage Heading -->
                <div class="col-sm-12 form-group">
                    <div class="input-group">
                        <label class="col-sm-12">Front Home Page Heading (html)</label>
                        <textarea class="form-control frm_sitesettings summernote"
                                  name="frm_sitesettings[<?= $site_settings[0]['settings_id'] ?>]"
                        placeholder="Enter Html For Front Home Page Heading">
                            <?= $site_settings[0]['settings_value'] ?>
                        </textarea>


                    </div>
                </div>
                <!-- Front HomePage Footer -->
                <div class="col-sm-12 form-group">
                    <div class="input-group">
                        <label class="col-sm-12">Front Home Page Footer (html)</label>
                        <textarea class="form-control frm_sitesettings summernote"
                                  name="frm_sitesettings[<?= $site_settings[1]['settings_id'] ?>]"
                                  placeholder="Enter Html For Front Home Page Footer">
                            <?= $site_settings[1]['settings_value'] ?>
                        </textarea>
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