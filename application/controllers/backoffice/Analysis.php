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
        //final rsponse json string
        $response_array = array('status' => 0, 'data' => array(), 'chart_type' => 0, 'error' => 0);
        //if Analysis Parameter  is Posted
        if ($this->input->post('class_id') != null && $this->input->post('section_id') != null && $this->input->post('criteria_id') != null) {

            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $criteria_id = $this->input->post('criteria_id');

            //where Condition

            $where = "analysis_master.section_id = $section_id AND " . ($criteria_id != 0 ? " analysis_master.criteria_id = $criteria_id" : "analysis_master.criteria_id != 0") . " AND " . ($class_id == 0 ? " entry_record.class_id != 0 " : " entry_record.class_id = $class_id");
            $analyses_where = 'analysis_master.section_id = ' . $section_id . ' AND ' . ($criteria_id == 0 ? 'analysis_master.criteria_id != 0 ' : 'analysis_master.criteria_id = ' . $criteria_id);

            //if section is employee section
            if ($this->input->post('employee_id') != null) {
                $employee_id = $this->input->post('employee_id');

                //fetch entry_record
                $where = $where . " AND analysis_master.emp_code = $employee_id";
                $analyses_where = $analyses_where . ' AND analysis_master.emp_code = ' . $employee_id;

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
                ->dbjoin(
                    array(
                        array(
                            'table' => 'entry_record',
                            'condition' => 'analysis_master.entry_id = entry_record.entry_id'
                        )
                    ))
                ->getRecord('analysis_master', $analyses_where);


            $analysis_data_total_rows = $analyses_data->num_rows();


            $final_data = array();


            //criteria info
            $criteria_info = $this->CommonModel->getRecord('criteria_master', 'section_id = ' . $section_id . ' AND ' . ($criteria_id == 0 ? 'criteria_id != 0' : 'criteria_id = ' . $criteria_id), 'criteria_id,criteria_name,type_data');

            foreach ($criteria_info->result_array() as $row_criteria) {
                if ($row_criteria['type_data'] == 0) {
                    //simple data
                    $ranklist = $this->CommonModel->getRecord('ranking')->result_array();
                    foreach ($ranklist as $row_rank) {
                        $final_data['rank_' . $row_rank['rank_id']]['rank_name'] = $row_rank['rank_name'];
                        $final_data['rank_' . $row_rank['rank_id']]['rank_value'] = $row_rank['rank_value'];
                        $final_data['rank_' . $row_rank['rank_id']]['points'][$row_criteria['criteria_id']] = $this->CommonModel->getRecord('analysis_master', 'section_id = ' . $section_id . ' AND criteria_id = ' . $row_criteria['criteria_id'] . ' AND analysis_master.criteria_points =' . $row_rank['rank_value'] . (isset($employee_id) ? ' AND emp_code = ' . $employee_id : ''))->num_rows();

                        //calculating rank row total
                        if (isset($final_data['rank_' . $row_rank['rank_id']]['row_total'])) {
                            $final_data['rank_' . $row_rank['rank_id']]['row_total'] += $final_data['rank_' . $row_rank['rank_id']]['points'][$row_criteria['criteria_id']];
                        } else {
                            $final_data['rank_' . $row_rank['rank_id']]['row_total'] = 0;
                            $final_data['rank_' . $row_rank['rank_id']]['row_total'] += $final_data['rank_' . $row_rank['rank_id']]['points'][$row_criteria['criteria_id']];
                        }

                        //calculating rank column total
                        if (isset($final_data['col_total'][$row_criteria['criteria_id']])) {
                            $final_data['col_total'][$row_criteria['criteria_id']] += $final_data['rank_' . $row_rank['rank_id']]['points'][$row_criteria['criteria_id']];
                        } else {
                            $final_data['col_total'][$row_criteria['criteria_id']] = 0;
                            $final_data['col_total'][$row_criteria['criteria_id']] += $final_data['rank_' . $row_rank['rank_id']]['points'][$row_criteria['criteria_id']];
                        }

                        //calculating final column row  total
                        if (isset($final_data['col_total']['final_total'])) {
                            $final_data['col_total']['final_total'] += $final_data['rank_' . $row_rank['rank_id']]['points'][$row_criteria['criteria_id']];
                        } else {
                            $final_data['col_total']['final_total'] = 0;
                            $final_data['col_total']['final_total'] += $final_data['rank_' . $row_rank['rank_id']]['points'][$row_criteria['criteria_id']];
                        }
                    }

                } else {
                    //option data
                    //fetch record from option master
                    $criteria_optionlist = $this->CommonModel->getRecord('option_master', array('criteria_id' => $criteria_id))->result_array();

                    //foreach option
                    foreach ($criteria_optionlist as $row_option) {
                        $final_data['option_' . $row_option['option_id']]['option_name'] = $row_option['option_text'];
                        $final_data['option_' . $row_option['option_id']]['option_value'] = $row_option['option_value'];
                        $final_data['option_' . $row_option['option_id']]['points'][$row_criteria['criteria_id']] = $this->CommonModel->getRecord('analysis_master', 'section_id = ' . $section_id . ' AND criteria_id = ' . $row_criteria['criteria_id'] . ' AND analysis_master.criteria_points =' . $row_option['option_id'] . (isset($employee_id) ? ' AND emp_code = ' . $employee_id : ''))->num_rows();

                        //calculating option row total
                        if (isset($final_data[$row_option['option_id']]['row_total'])) {
                            $final_data['option_' . $row_option['option_id']]['row_total'] += $final_data['option_' . $row_option['option_id']]['points'][$row_criteria['criteria_id']];
                        } else {
                            $final_data['option_' . $row_option['option_id']]['row_total'] = 0;
                            $final_data['option_' . $row_option['option_id']]['row_total'] += $final_data['option_' . $row_option['option_id']]['points'][$row_criteria['criteria_id']];
                        }

                        //calculating option column total
                        if (isset($final_data['col_total'][$row_criteria['criteria_id']])) {
                            $final_data['col_total'][$row_criteria['criteria_id']] += $final_data['option_' . $row_option['option_id']]['points'][$row_criteria['criteria_id']];
                        } else {
                            $final_data['col_total'][$row_criteria['criteria_id']] = 0;
                            $final_data['col_total'][$row_criteria['criteria_id']] += $final_data['option_' . $row_option['option_id']]['points'][$row_criteria['criteria_id']];
                        }

                        //calculating final column row  total
                        if (isset($final_data['col_total']['final_total'])) {
                            $final_data['col_total']['final_total'] += $final_data['option_' . $row_option['option_id']]['points'][$row_criteria['criteria_id']];
                        } else {
                            $final_data['col_total']['final_total'] = 0;
                            $final_data['col_total']['final_total'] += $final_data['option_' . $row_option['option_id']]['points'][$row_criteria['criteria_id']];
                        }


                    }
                }
            }


            //push column row  total  to last
            $temp = $final_data['col_total']['final_total'];
            unset($final_data['col_total']['final_total']);
            $final_data['col_total']['final_total'] = $temp;


            //move col total to last

            $temp = $final_data['col_total'];
            unset($final_data['col_total']);
            $final_data['col_total'] = $temp;


            //for amcharts
            //if 1 criteria donout chart
            $response_array['status'] = 1;

            if ($criteria_info->num_rows() == 1) {
                $response_array['data']['criteria'] = $criteria_info->result_array()[0]['criteria_name'];
                $response_array['data']['total_feedback'] = $final_data['col_total']['final_total'];
                $response_array['data']['valueField'] = 'value';
                $response_array['data']['titleField'] = 'label';
                $response_array['data']['donut_data'] = array();
                $response_array['chart_type'] = "donut";

                $temp = $final_data;
                unset($temp['col_total']);

                if ($response_array['data']['total_feedback'] > 0):
                    foreach ($temp as $row) {
                        //data in percentage
                        $temp1 = ((isset($row['points'][$criteria_id]) ? $row['points'][$criteria_id] : 0));
                        $response_array['data']['donut_data'][] = array('label' => ((isset($row['rank_name']) ? $row['rank_name'] : $row['option_name'])), 'value' => $temp1);
                    }
                else:
                    $response_array['status'] = 0;
                    $response_array['error'] = "No Data Found";
                    //empty or no data
                endif;

            } else if ($criteria_info->num_rows() > 1) {
                //multiple criteria
                $response_array['data']['total_feedback'] = $final_data['col_total']['final_total'];
                $response_array['chart_type'] = "bar";

                $ranks_data = $final_data;
                unset($ranks_data['col_total']);
                $bar_table_data = array();


                if ($response_array['data']['total_feedback'] > 0):
                    //rows

                    foreach ($ranks_data as $row) {

                        $rank_name = (isset($row['rank_name']) ? $row['rank_name'] : $row['option_name']);

                        //for each columns
                        foreach ($row['points'] as $key => $cols) {
                            $criteria_name = $this->CommonModel->getRecord('criteria_master', array('criteria_id' => $key))->row_array()['criteria_name'];
                            $bar_table_data[$rank_name][$criteria_name] = $cols;
                            $bar_table_data['col_total'][$criteria_name] = (isset($bar_table_data['col_total'][$criteria_name]) ? $bar_table_data['col_total'][$criteria_name] + $cols : 0);
                        }
                        $bar_table_data[$rank_name]['row_total'] = $row['row_total'];
                    }

                    //move col_data to end
                    $temp_bar = $bar_table_data['col_total'];
                    unset($bar_table_data['col_total']);
                    $bar_table_data['col_total'] = $temp_bar;
                    $graph_array = array();

                    //from bar table data
                    $bar_chart_data = array();
                    $temp2 = $bar_table_data;
                    unset($temp2['col_total']);
                    $i=0;
                    foreach ($temp2 as $key => $value):
                        unset($value['row_total']);
                        $value['criteria_name'] = $key;
                        $bar_chart_data[] = $value;
                    endforeach;
                    unset($bar_chart_data['col_total']);

                    foreach ($criteria_info->result_array() as $value){
                        //for graph
                        $graph_array[] = array(
                            "balloonText"=>$value['criteria_name'].':'.'[[percents]]',
                            'fillAlphas'=> 0.8,
                            'id'=>'AmGraph-'.++$i,
                            'lineAlpha'=>0.2,
                            'title'=>$value['criteria_name'],
                            'type'=>'column',
                            'valueField'=>$value['criteria_name']
                        );

                    }

                    //set data to response array
                    $response_array['status'] = 1;
                    $response_array['data']['bar_chart_data']=$bar_chart_data;
                    $response_array['data']['bar_table_data']=$bar_table_data;
                    $response_array['data']['bar_graph_array']=$graph_array;
                    $response_array['data']['bar_category_field']='criteria_name';


                else:
                    $response_array['status'] = 0;
                    $response_array['error'] = "No Data Found";
                    //empty or no data
                endif;


            } else {
                $response_array['status'] = 0;
                $response_array['error'] = "Criteria Not found.Internal Error . try Later";
            }
        } else {
            //invalid parameter
            $response_array['status'] = 0;
            $response_array['error'] = "Invalid Or Insufficient Parameters";
        }

        echo json_encode($response_array);


    }

}