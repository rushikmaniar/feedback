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
       
       department_master.dept_id,
       department_master.dept_name
       ';
        $OrWhere = array();
        $class_data = $this->CommonModel
            ->dbOrderBy(array('class_master.id' => 'DESC'))
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
                                'condition' => 'employee_master.emp_code = employee_allocation.employee_codes'
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
     * View add Criteria modal
     *
     */
    public function viewAddCriteriaModal()
    {
        $this->render("backoffice/Criteria/view_add_criteria", FALSE);
    }


    /**
     * Add or edit Criteria
     *
     */
    public function addEditCriteria()
    {

        if ($this->input->post('action') && $this->input->post('action') == "addCriteria") {
            $criteria_data = array(
                "point_name" => $this->input->post('criteria_frm_point_name')
            );


            $save = $this->CommonModel->save("criteria_master", $criteria_data);
            if ($save) {
                $this->session->set_flashdata("success", "Criteria added successfully");
            } else {
                $this->session->set_flashdata("error", "problem adding Criteria. Try Later");
            }
        }

        if ($this->input->post('action') && $this->input->post('action') == "editCriteria") {
            $criteria_data = array(
                "point_name" => $this->input->post('criteria_frm_point_name')
            );

            $update = $this->CommonModel->update("criteria_master", $criteria_data, array('id' => $this->input->post('update_id')));
            if ($update) {
                $this->session->set_flashdata("success", "Criteria updated successfully");
            } else {
                $this->session->set_flashdata("error", "Problem Editing Criteria.Try Later");
            }
        }

        redirect("backoffice/CriteriaManagement", "refresh");
    }


    /**
     * View edit modal with set Criteria data
     *
     * @param int $criteria_id
     */
    public function viewEditCriteriaModal($criteria_id)
    {

        $criteria_data = $this->CommonModel->getRecord("criteria_master", array('id' => $criteria_id))->row_array();
        $this->pageData['criteria_data'] = $criteria_data;
        $this->render("backoffice/criteria/view_add_criteria", FALSE);
    }


    /**
     * Delete Criteria
     *
     */
    public function deleteCriteria()
    {
        if ($this->input->post('criteria_id')) {
            $result = $this->CommonModel->delete("criteria_master", array('id' => $this->input->post('criteria_id')));
            if ($result) {
                $res_output['code'] = 1;
                $res_output['status'] = "success";
                $res_output['message'] = "Criteria deleted successfully";
                echo json_encode($res_output);
                exit();
            } else {
                $res_output['code'] = 0;
                $res_output['status'] = "error";
                $res_output['message'] = "Criteria not delete";
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