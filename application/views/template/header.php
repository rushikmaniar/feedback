<?php //header ?>
<div class="loader">
    <div class="page-loader"></div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <img src="<?= base_url().'zip/Shards-Version-2.0.2/images/demo/shards-logo.svg';?>" alt="Example Navbar 1" class="mr-2" height="30">
    <a class="navbar-brand" href="#">Shards</a>
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
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="https://designrevision.com" id="navbarDropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Services
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Design</a>
                    <a class="dropdown-item" href="#">Development</a>
                    <a class="dropdown-item" href="#">Marketing</a>
                </div>
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