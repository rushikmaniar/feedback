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
        $criteria_list = $this->CommonModel->getRecord('criteria_master', array('section_id' => $section_id));

        if ($section_id == 1)
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
        if ($class_id) {
            $class_ids = $class_id;
            if ($class_ids[0] == 0 && $class_ids . sizeof($class_ids) == 1) {
                //all class selected
                $where = 'class_ != 0';
            } else {
                //combination or 1 class except all class
                $where = 'class_id IN ALL (\'' . implode(",", $class_ids) . '\')';
            }
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
                ->getRecord('employee_allocation', $where, $val);
            echo $this->db->last_query();
            $response['employee_list'] = $employee_list->result_array();
            echo json_encode($response);
            exit;

        }
        exit;


    }

    public function getAnalysisData()
    {

        //if Analysis Parameter  is Posted
        if ($this->input->post('class_select') && $this->input->post('section_select') && $this->input->post('criteria_select')) {

            //if section is employee section
            if ($this->input->post('employee_select')) {

            } else {

            }

        } else {

        }

    }

}