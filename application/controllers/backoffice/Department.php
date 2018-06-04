<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
       $OrWhere = array();
        $department_data = $this->CommonModel
            ->dbOrderBy(array('id'=>'DESC'))
            ->getRecord('department_master', $OrWhere, 'department_master.*')->result_array();

        $this->pageTitle = 'Department Management';
        $this->pageData['department_data'] = $department_data;
        $this->render("Department/index.php");
    }
    
    
    /**
     * View add Department modal
     * 
     */
    public function viewAddDepartmentModal()
    {
        $this->render("backoffice/Department/view_add_department",FALSE);
    }

    
    /**
     * Add or edit Employee
     * 
     */
    public function addEditDepartment()
    {

        if ($this->input->post('action') && $this->input->post('action') == "addDepartment")
        {
            $department_data = array(
                "dept_id" => $this->input->post('department_frm_dept_id'),
                "dept_name" => $this->input->post('department_frm_dept_name')
            );


            $save = $this->CommonModel->save("department_master",$department_data);
            if($save){
                $this->session->set_flashdata("success","Department added successfully");
            }else{
                $this->session->set_flashdata("error","problem adding Department. Try Later");
            }
        }
        
        if ($this->input->post('action') && $this->input->post('action') == "editDepartment")
        {
            $department_data = array(
                "dept_name" => $this->input->post('department_frm_dept_name')
            );
            
            $update = $this->CommonModel->update("department_master",$department_data,array('id'=>$this->input->post('update_id')));
            if($update){
                $this->session->set_flashdata("success","Employee updated successfully");
            }else{
                $this->session->set_flashdata("error","Problem Editing Employee.Try Later");
            }
        }
        
        redirect("backoffice/Department","refresh");
    }
    
    
    /**
     * View edit modal with set Department data
     * 
     * @param int $user_id
     */
    public function viewEditDepartmentModal($dept_id)
    {

        $department_data = $this->CommonModel->getRecord("department_master",array('id'=>$dept_id))->row_array();
        $this->pageData['department_data'] = $department_data;
        $this->render("backoffice/Department/view_add_Department",FALSE);
    }
    
    
    /**
     * Delete Department
     * 
     */
    public function deleteDepartment()
    {
        if ($this->input->post('dept_id'))
        {
            $result = $this->CommonModel->delete("department_master",array('id'=>$this->input->post('dept_id')));
            if ($result)
            {
                $res_output['code'] = 1;
                $res_output['status'] = "success";
                $res_output['message'] = "Department deleted successfully";
                echo json_encode($res_output);
                exit();
            }
            else 
            {
                $res_output['code'] = 0;
                $res_output['status'] = "error";
                $res_output['message'] = "Department not delete";
                echo json_encode($res_output);
                exit();
            }
        }
        else 
        {
            $res_output['code'] = 0;
            $res_output['status'] = "error";
            $res_output['message'] = "Request parameter not found,please try again";
            echo json_encode($res_output);
            exit();
        }
    }
}
?>