<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeAllocation extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //get class list , department list and related employee details
        $val = '
       class_master.class_id,
       class_master.class_name,
       
       (SELECT COUNT(`entry_id`) FROM `entry_record` WHERE entry_record.class_id = class_master.class_id) as entries,
       
       department_master.dept_id,
       department_master.dept_name
       ';
        $OrWhere = array();
        $class_data = $this->CommonModel
            ->dbOrderBy(array('class_master.class_id' => 'DESC'))
            ->dbjoin(
                array(
                    array(
                        'table' => 'department_master',
                        'condition' => 'class_master.dept_id = department_master.dept_id'
                    )
                )
            )->getRecord('class_master', $OrWhere, $val)->result_array();

        $this->pageData['class_list'] = $class_data;

        $allocation_data = array();
        if (!empty($class_data)) {
            $employee_details = array();
            foreach ($class_data as $row):
                $where = array('employee_allocation.class_id' => $row['class_id']);
                $val = '
                employee_master.emp_code,
                employee_master.emp_name
                ';
                $data = $this->CommonModel
                    ->dbOrderBy(array('employee_allocation.class_id' => 'DESC'))
                    ->dbjoin(
                        array(
                            array(
                                'table' => 'employee_master',
                                'condition' => 'employee_master.emp_code = employee_allocation.emp_code'
                            )
                        )
                    )
                    ->getRecord('employee_allocation', $where, $val)->result_array();
               $allocation_data[$row['class_id']] = $data;

            endforeach;
        }
        $this->pageTitle = 'Employee Allocation';
        $this->pageData['allocation_data'] = $allocation_data;
        $this->render("Allocation/index.php");
    }


    /**
     * Edit Allocation
     *
     */
    public function editAllocation()
    {

            if($this->input->post('allocation_frm_emp_codes')) {
                //delete previous data
                $delete = $this->CommonModel->delete('employee_allocation', array('class_id' => $this->input->post('update_id')));
                $emp_codes = $this->input->post('allocation_frm_emp_codes');
                $data = array();
                foreach ($emp_codes as $row):
                    $data[] = array('class_id' => $this->input->post('update_id'), 'emp_code' => $row);
                endforeach;

                $update = $this->CommonModel->db->insert_batch('employee_allocation', $data);
                if ($update) {
                    $this->session->set_flashdata("success", "Allocation updated successfully");
                } else {
                    $this->session->set_flashdata("error", "Problem Editing Allocation.Try Later");
                }
            }else{
                //delete previous data
                $delete = $this->CommonModel->delete('employee_allocation', array('class_id' => $this->input->post('update_id')));
                if ($delete) {
                    $this->session->set_flashdata("success", "Allocation updated successfully");
                }
            }
        redirect("backoffice/EmployeeAllocation", "refresh");
    }


    /**
     * View edit modal with set Allocation data
     *
     * @param int $class_id
     */
    public function viewEditAllocationModal($class_id,$class_name)
    {

        //get employee_list
        $employee_list = $this->CommonModel->getRecord('employee_master','','emp_code,emp_name')->result_array();
        $allocation_data = array_map(function ($data){return $data['emp_code'];},$this->CommonModel->getRecord("employee_allocation", array('class_id' => $class_id),'emp_code')->result_array());
        $this->pageData['allocation_data'] = $allocation_data;
        $this->pageData['class_id'] = $class_id;
        $this->pageData['class_name'] = $class_name;
        $this->pageData['employee_list'] = $employee_list;
        $this->pageData['emp_codes'] = array_map(function ($data){return $data['emp_code'];},$employee_list);
        $this->render("backoffice/Allocation/view_add_allocation", FALSE);
    }


    /**
     * Delete Allocation
     *
     */
    public function deleteallocation()
    {
        if ($this->input->post('class_id')) {
            $result = $this->CommonModel->delete("employee_allocation", array('class_id' => $this->input->post('class_id')));
            if ($result) {
                $res_output['code'] = 1;
                $res_output['status'] = "success";
                $res_output['message'] = "Allocation deleted successfully";
                echo json_encode($res_output);
                exit();
            } else {
                $res_output['code'] = 0;
                $res_output['status'] = "error";
                $res_output['message'] = "Allocation not deleted";
                echo json_encode($res_output);
                exit();
            }
        } else {
            $res_output['code'] = 0;
            $res_output['status'] = "error";
            $res_output['message'] = "Request parameter not found,please try again";
            echo json_encode($res_output);
            exit();
        }
    }
}

?>