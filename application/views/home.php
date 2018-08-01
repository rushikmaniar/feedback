<?php /**
 * Created by PhpStorm.
 * User: jatin
 * Date: 010 10-06-2018
 * Time: 01:12 PM
 */?>
<style>
    .center-block {
        display: block;
        margin-right: auto;
        margin-left: auto;
    }
    .rslides {
        position: relative;
        list-style: none;
        overflow: hidden;
        padding: 0;
        margin: 0;
    }

    .rslides li {
        -webkit-backface-visibility: hidden;
        position: absolute;
        display: none;
        left: 0;
        top: 0;
    }

    .rslides li:first-child {
        position: relative;
        display: block;
        float: left;
    }

    .rslides img {
        display: block;
        height: auto;
        float: left;
        width: 100%;
        border: 0;
    }
</style>

<div class="row">
    <div class="col-md-12 col-sm-12 jumbotron">

            <h1>Welcome To Feedback System</h1>
            <p>christ college feedback.</p>

    </div>
    <div class="col-md-12 col-sm-12 center-block" style="height: 500px;width: 500px;">
        <ul class="rslides" style="margin-left: 20%">
            <?php foreach ($imagelist as $row):?>
                <li><img src="<?= base_url().'images/slider-image/'.$row; ?>" style="width: 800px;height: 500px" alt="no image found"></li>
            <?php endforeach;?>
        </ul>
    </div>
    <div class="col-md-12 col-sm-12">
        <a href="<?= base_url().'StartFeedback'?>"> <button type="button" class="btn btn-primary btn-pill">Start Feedback</button></a>
    </div>
</div>
<div id="MiddleCarousel" class="carousel slide UACarousel" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#MiddleCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#MiddleCarousel" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="https://i.hizliresim.com/LDPMg0.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://i.hizliresim.com/7DmJXL.jpg" alt="Second slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#MiddleCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#MiddleCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<script type="text/javascript">
    $(function() {
        $(".rslides").responsiveSlides({
            auto: true,
            pauseControls: true,    // Boolean: Pause when hovering controls, true or false
            prevText: "Previous",   // String: Text for the "previous" button
            nextText: "Next",
            nav: true
        });
    });
</script>