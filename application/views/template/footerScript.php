<?php // js scripts and custom.js ?>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

<script src="<?= base_url().'assets/fronted/js/shards.min.js'?>"></script>
<script src="<?= base_url().'assets/fronted/js/jquery.modern-blink.js'?>"></script>

<script type="text/javascript">

    function ajaxModel(url, title, width) {
        if (typeof(width) === 'undefined') {
            width = 'modal-lg';
        }
        if (url) {
            $.ajax({
                url: SITE_URL + url,
                dataType: 'html',
                success: function (responce) {
                    $('#feedback_frontsite_modal .modal-title').html(title);
                    $('#feedback_frontsite_modal .modal-body').html(responce);
                    $('#feedback_frontsite_modal .modal-dialog').addClass(width);

                    if (!$('#feedback_frontsite_modal').hasClass('show')) {
                        $('#feedback_frontsite_modal').modal('show');
                    }

                }
            });
        }
    }
</script>
