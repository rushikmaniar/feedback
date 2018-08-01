<?php
/**
 * Created by PhpStorm.
 * User: Rushik
 * Date: 12-04-2018
 * Time: 11:44 AM
 */
class Home extends SiteController{
    public function __construct()
    {

        parent::__construct();
    }
    public function index(){
        $this->load->helper('directory');

            $this->pageData['imagelist'] = directory_map(FCPATH.'\images\slider-image');

        $this->pageTitle = 'feedback | Home';
        $this->render('home');
    }
}
?>

