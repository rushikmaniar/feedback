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
        $val = '
        section_master.id,
        section_master.section_name,
        
        criteria_master.id as point_id,
        criteria_master.point_name,
        criteria_master.type_data                  
        ';
        $section_data = $this->CommonModel
            ->dbOrderBy(array('section_master.id'))
            ->dbjoin(
                array(
                    array(
                        'table' => 'criteria_master',
                        'condition' => 'criteria_master.section_id = section_master.id'
                    )
                ))
            ->getRecord('section_master','',$val)->result_array();

        //section wise criteria list
        $section_list = array();
        foreach ($section_data as $row):

            if(array_key_exists($row['id'],$section_list)):
                $section_list[$row['id']]['criteria_list'][$row['point_id'] ]= array('point_id'=>$row['point_id'],'point_name'=>$row['point_name'],'type_data'=>$row['type_data']);
            else:
                $section_list[$row['id']] = array('id'=>$row['id'],'section_name'=>$row['section_name'],'criteria_list'=>array($row['point_id'] => array('point_id'=>$row['point_id'],'point_name'=>$row['point_name'],'type_data'=>$row['type_data'])));
                    endif;

            endforeach;

        //if options are there
        $section_with_options = array();
        foreach ($section_list as $row):
            foreach ($row['criteria_list'] as $row_criteria):
                if($row_criteria['type_data'] == 1) {
                    $option_list = $this->CommonModel->getRecord('option_master', array('option_master.criteria_id' => $row_criteria['point_id']), 'id as option_id,option_text,option_value')->result_array();
                    $row_criteria['option_list'] = $option_list;
                    $section_list[$row['id']]['criteria_list'][$row_criteria['point_id']]['option_list'] = $option_list;
                }
            endforeach;
        endforeach;

        $this->pageTitle = 'Feedback System';
        $this->pageData['class_list'] = $classlist;
        $this->pageData['section_list'] = $section_list;
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
    public function FeedbackData(){
        echo '<pre>';
        print_r($this->input->post());
        echo '</pre>';exit;
    }
}