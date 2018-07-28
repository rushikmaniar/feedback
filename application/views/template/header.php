<?php //header ?>
<div class="loader">
    <div class="page-loader"></div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <img src="<?= base_url().'images/front-logo.png';?>" style="background:none;" alt="Feedback 1" class="mr-2" height="80">
    <a class="navbar-brand" href="<?= base_url(); ?>">Feedback</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown-1" aria-controls="navbarNavDropdown-1"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown-1">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-linkedin"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-github"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>