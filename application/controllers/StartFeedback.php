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
    public function index()
    {
        $classlist = $this->CommonModel->getRecord('class_master')->result_array();
        $criteria_list = $this->CommonModel->getRecord('criteria_master')->result_array();
        $this->pageTitle = 'Feedback System';
        $this->pageData['class_list'] = $classlist;
        $this->pageData['criteria_list'] = $criteria_list;
        $this->render('startfeedback.php');
    }

    public function getRelatedEmployees(){
        $class_id = $this->input->post('class_id');
        $response = array('code'=>0,'data'=>array(),'message'=>'');
        if($class_id != ''){
            $emp_list = $this->CommonModel
                ->dbjoin(
                    array(
                        array(
                            'table' => 'employee_master',
                            'condition' => 'employee_allocation.employee_codes = employee_master.emp_code'
                        )
                    ))
                ->getRecord("employee_allocation", array('class_id' => $class_id),'employee_allocation.employee_codes,employee_master.emp_name')->result_array();
            /*$employee_code_list = array_map(function ($data){return $data['employee_codes'];},$emp_list);
            $employee_name_list = array_map(function ($data){return $data['emp_name'];},$emp_list);*/

            if(!empty($emp_list)){
                $response['data'] = $emp_list;
                $response['code'] = 1;
            }
            else{
                $response['message'] = 'No Employees allocated to this class';
            }

        }else{
            $response['messsage'] = 'Null Class id';
        }
        echo json_encode($response);
    }
}