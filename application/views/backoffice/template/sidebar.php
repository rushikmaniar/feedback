<?php //sidebar ?>
<div class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">Home</li>
                <li> <a href="<?= base_url('backoffice/dashboard')?>" aria-expanded="false"><i class="fa fa-tachometer"></i>Dashboard</a></li>
                    <li> <a href="<?= base_url('backoffice/Employee')?>" aria-expanded="false"><i class="fa fa-user"></i>Employee management</a></li>
                    <li> <a href="<?= base_url('backoffice/Department')?>" aria-expanded="false"><i class="fa fa-user"></i>Department management</a></li>
                    <li> <a href="<?= base_url('backoffice/ClassManagement')?>" aria-expanded="false"><i class="fa fa-user"></i>Class management</a></li>
                    <li> <a href="<?= base_url('backoffice/CriteriaManagement')?>" aria-expanded="false"><i class="fa fa-user"></i>Criteria management</a></li>

                 <!--<li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-envelope"></i><span class="hide-menu">Email</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="email-compose.html">Compose</a></li>
                        <li><a href="email-read.html">Read</a></li>
                        <li><a href="email-inbox.html">Inbox</a></li>
                    </ul>
                </li>-->

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>
