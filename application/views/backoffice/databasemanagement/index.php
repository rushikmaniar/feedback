<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- Export Database -->
            <div class="col-sm-6 col-md-6">
                <div><label>Export Database</label></div>
                <a href="<?= base_url().'backoffice/Databasemanagement/exportdatabase'?>">
                <button type="button" class="btn btn-success btn-top" id="btn_export"
                    <i class="fa fa-file-export"></i> Export Database
                </button>
                </a>
            </div>

            <!-- Truncate Database -->
            <div class="col-sm-6 col-md-6">
                <div><label>Truncate Database</label></div>

                <button type="button" class="btn btn-success btn-top" id="btn_export"
                        onclick="ajaxModel('backoffice/Databasemanagement/viewTruncateModal','Truncate Table','modal-md')"
                    <i class="fa fa-file-export"></i> Truncate Database
                </button>

            </div>

        </div>

    </div>

</div>
<script type="text/javascript">

</script>
