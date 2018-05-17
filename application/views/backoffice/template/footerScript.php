<?php // js scripts and custom.js ?>

<!-- slimscrollbar scrollbar JavaScript -->
<script src="<?= base_url('assets/backoffice/')?>js/jquery.slimscroll.js"></script>
<!--Menu sidebar -->
<script src="<?= base_url('assets/backoffice/')?>js/sidebarmenu.js"></script>

<!--stickey kit -->
<script src="<?= base_url('assets/backoffice/')?>js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
<!--Custom JavaScript -->


<!-- Amchart -->

<script src="<?= base_url('assets/backoffice/')?>js/lib/morris-chart/raphael-min.js"></script>
<script src="<?= base_url('assets/backoffice/')?>js/lib/morris-chart/morris.js"></script>
<script src="<?= base_url('assets/backoffice/')?>js/lib/morris-chart/dashboard1-init.js"></script>


<script src="<?= base_url('assets/backoffice/')?>js/lib/calendar-2/moment.latest.min.js"></script>
<!-- scripit init-->
<script src="<?= base_url('assets/backoffice/')?>js/lib/calendar-2/semantic.ui.min.js"></script>
<!-- scripit init-->
<script src="<?= base_url('assets/backoffice/')?>js/lib/calendar-2/prism.min.js"></script>
<!-- scripit init-->
<script src="<?= base_url('assets/backoffice/')?>js/lib/calendar-2/pignose.calendar.min.js"></script>
<!-- scripit init-->
<script src="<?= base_url('assets/backoffice/')?>js/lib/calendar-2/pignose.init.js"></script>

<script src="<?= base_url('assets/backoffice/')?>js/lib/owl-carousel/owl.carousel.min.js"></script>
<script src="<?= base_url('assets/backoffice/')?>js/lib/owl-carousel/owl.carousel-init.js"></script>
<script src="<?= base_url('assets/backoffice/')?>js/scripts.js"></script>

<!-- Include Again Duew To above script -->
<script src="<?= base_url('assets/backoffice/')?>js/lib/bootstrap/js/bootstrap.min.js"></script>
<!-- scripit init-->

<!-- jquery validation -->
<script src="<?= base_url()?>assets/backoffice/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script src="<?= base_url()?>assets/backoffice/plugins/jquery-validation/js/additional-methods.js"></script>

<script src="<?= base_url('assets/backoffice/')?>js/custom.min.js"></script>

<script type="text/javascript">
        function ajaxModel(url,title,width='modal-lg')
        {
            if(url){
                $.ajax({
                    url:SITE_URL+url,
                    dataType:'html',
                    success:function(responce)
                    {
                        $('#feedback_admin_modal .modal-title').html(title);
                        $('#feedback_admin_modal .modal-body').html(responce);
                        $('#feedback_admin_modal .modal-dialog').addClass(width);

                        if(!$('#feedback_admin_modal').hasClass('show')){
                            $('#feedback_admin_modal').modal('show');
                        }

                    }
                });
            }
        }
    jQuery(document).ready(function($) {

        <?php if($this->session->flashdata('error')) : ?>
        toastr["success"]("<?= $this->session->flashdata('error');?>");
        <?php elseif($this->session->flashdata('success')) : ?>

        toastr["error"]("<?= $this->session->flashdata('error');?>");
        <?php endif; ?>
    });
</script>