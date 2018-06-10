<?php

/**
 * Created by PhpStorm.
 * User: jatin
 * Date: 010 10-06-2018
 * Time: 01:39 PM
 */
class StartFeedback extends SiteController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $this->render('startfeedback.php');
    }

}