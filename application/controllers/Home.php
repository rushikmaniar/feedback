<?php

/**
 * Created by PhpStorm.
 * User: Rushik
 * Date: 12-04-2018
 * Time: 11:44 AM
 */
class Home extends SiteController
{
    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $this->load->helper('directory');
        $imagelist = array();

        $imagelist = directory_map(FCPATH . '\images\slider-image');
        $this->pageData['imagelist'] = $imagelist;

        //site settings
        $site_settings = $this->CommonModel->getRecord('site_settings');
        $this->pageData['site_settings'] = $site_settings->result_array();
        $this->pageTitle = 'feedback | Home';
        $this->render('home');
    }
}

?>

