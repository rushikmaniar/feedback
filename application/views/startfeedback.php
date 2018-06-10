<?php
/**
 * Created by PhpStorm.
 * User: jatin
 * Date: 010 10-06-2018
 * Time: 01:36 PM
 */?>
<h1>Feedback</h1>
<h3 class="text-danger">Please give Rating On scale 1-5</h3>
<h3 class="text-warning blink">1-Unstatisfactory ,2-Statisfactory,3-Good,4-Very Good,5-Excellent</h3>
<div class="container mb-5">
    <form id="frm_feedback" name="frm_feedback" method="post" action="<?= base_url().''?>">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="form1-name" class="col-form-label">Name</label>
                <input type="text" class="form-control" id="form1-name" placeholder="Name">
            </div>
            <div class="form-group col-md-6">
                <label for="form1-email" class="col-form-label">Email</label>
                <input type="email" class="form-control" id="form1-email" placeholder="Email">
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
$(document).ready(function () {
   $('.blink').modernBlink({
       duration: 2000
   });
});
</script>
