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

    public function getCriteriaEmpList()
    {

        $section_id = $this->input->post('section_id');
        $criteria_list = $this->CommonModel->getRecord('criteria_master',array('section_id'=>$section_id));

        if($section_id == 1)
        $employee_list = $this->CommonModel->getRecord('employee_master')->result_array();
        else
            $employee_list = array();

        $response['criteria_list'] = $criteria_list->result_array();
        $response['employee_list'] = $employee_list;
        echo json_encode($response);
        exit;
    }
    public function getEmpList()
    {

        $class_id = $this->input->post('class_id');

        $val = '
        employee_allocation.emp_code,
        employee_master.emp_name
        ';

        $employee_list = $this->CommonModel

            ->dbjoin(
                array(
                    array(
                        'table' => 'employee_master',
                        'condition' => 'employee_master.emp_code = employee_allocation.emp_code'
                    )
                ))
            ->getRecord('employee_allocation',($class_id != 0)?array('class_id'=>$class_id):'class_id != 0',$val);

        $response['employee_list'] = $employee_list->result_array();
        echo json_encode($response);
        exit;
    }

}