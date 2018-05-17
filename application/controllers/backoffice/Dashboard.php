<?php
/**
 * Created by PhpStorm.
 * User: Rushik
 * Date: 23-04-2018
 * Time: 11:07 AM
 */

class Dashboard extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->pageTitle = 'Dashboard';
        $this->render("dashboard/index");
    }
}