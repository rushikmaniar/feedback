<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26/6/2018
 * Time: 1:05 PM
 */
class Analysis extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->pageTitle = "Feedback Analysis";

        //Section List
        $section_list = $this->CommonModel->getRecord('section_master')->result_array();

        //Class List
        $class_list = $this->CommonModel->getRecord('class_master')->result_array();

        $this->pageData['section_list'] = $section_list;
        $this->pageData['class_list'] = $class_list;
        $this->render('Analysis/index.php');
    }
}