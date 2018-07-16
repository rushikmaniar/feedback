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

        if ($class_id != '') {
            if ($class_id == 0) {
                //all class selected
                $where = 'class_id != 0';
            } else {
                $where = 'class_id = ' . $class_id;
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
            //echo $this->db->last_query();
            $response['employee_list'] = $employee_list->result_array();
            echo json_encode($response);
            exit;

        } else {

        }
        exit;


    }

    public function getAnalysisData()
    {
        echo '<pre>';
        print_r($this->input->post());
        echo '</pre>';
        //if Analysis Parameter  is Posted
        if ($this->input->post('class_id') != null && $this->input->post('section_id') != null && $this->input->post('criteria_id') != null) {

            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $criteria_id = $this->input->post('criteria_id');

            //where Condition

            if ($class_id == 0) {
                $where = "analysis_master.section_id = $section_id AND analysis_master.criteria_id = $criteria_id AND entry_record.class_id != 0";
                $analyses_where = "analysis_master.section_id = $section_id AND analysis_master.criteria_id = $criteria_id AND entry_record.class_id != 0";

            } else {
                $where = "analysis_master.section_id = $section_id AND analysis_master.criteria_id = $criteria_id AND entry_record.class_id = $class_id";
                $analyses_where = "analysis_master.section_id = $section_id AND analysis_master.criteria_id = $criteria_id AND entry_record.class_id != 0";
            }
            //if section is employee section
            if ($this->input->post('employee_id') != null) {
                $employee_id = $this->input->post('employee_id');

                //fetch entry_record
                $where = $where."AND entry_record.entry_id = $employee_id";
                $analyses_where = $analyses_where.'AND analysis_master.emp_code = '.$employee_id;

            } else {
            //not employee section

            }

            //entry record
            $val = 'entry_record.entry_id,entry_record.class_id';
            $entry_record = $this->CommonModel
                ->dbjoin(
                    array(
                        array(
                            'table' => 'analysis_master',
                            'condition' => 'entry_record.entry_id = analysis_master.entry_id'
                        )
                    ))
                ->getRecord('entry_record', $where, $val);

            $total_student_entries = $entry_record->num_rows();

            //analyses record
            $analyses_data = $this->CommonModel
                ->getRecord('analysis_master', $analyses_where);


            //criteria info
            $criteria_info = $this->CommonModel->getRecord('criteria_master', array('criteria_id' => $criteria_id, 'criteria_id,criteria_name,type_data'));
            //check criteria data type
            if ($criteria_info['type_data'] == 0) {
                //0-5 get from rank table used in proportion
                $ranklist = $this->CommonModel->getRecord('ranking')->result_array();
            } else {
                //fetch record from option master
                $criteria_optionlist = $this->CommonModel->getRecord('option_master', array('criteria_id' => $criteria_id))->result_array();
            }


        } else {
            //invalid parameter
        }

    }

}