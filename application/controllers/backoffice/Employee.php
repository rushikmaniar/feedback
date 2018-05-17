<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends AdminController
{
    public $DIR = "upload/employee/";
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $search = ($this->input->get('txt_srch')) ? $this->input->get('txt_srch') : FALSE;
        //$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$pageLink = $this->CommonModel->createPagination(site_url("backoffice/Employee/index"),"emloyee_master",'',NULL,array('emp_code'=>'%'.($search) ? $search : ''.'%','emp_name'=>'%'.($search) ? $search : ''.'%','emp_phone'=>'%'.($search) ? $search : ''.'%','emp_email'=>'%'.($search) ? $search : ''.'%'),$this->per_page,$offset);
        //$employee_data = $this->CommonModel->dblike(array('emp_code'=>'%'.($search) ? $search : ''.'%','emp_name'=>'%'.($search) ? $search : ''.'%','emp_phone'=>'%'.($search) ? $search : ''.'%','emp_email'=>'%'.($search) ? $search : ''.'%'))->dbOrderBy(array('id'=>'DESC'))->getRecord("emloyee_master",'','employee_master.*,SELE',$this->per_page,$offset)->result_array();
        $OrWhere = array();
        $employee_data = $this->CommonModel
            ->dbOrderBy(array('id'=>'DESC'))
            ->dbjoin(
            array(
                array(
                    'table' => 'department_master',
                    'condition' => 'employee_master.dept_id = department_master.dept_id'
                )
            )
        )->getRecord('employee_master', $OrWhere, 'employee_master.*,department_master.dept_id,department_master.dept_name')->result_array();

        $this->pageTitle = 'Employee Management';
        $this->pageData['employee_data'] = $employee_data;
        $this->pageData['totalDisplay'] = count($employee_data);
        /*$this->pageData['offset'] = $offset;
        $this->pageData['pagelink'] = $pageLink;*/
        $this->render("Employee/index.php");
    }
    
    
    /**
     * View add Employee modal
     * 
     */
    public function viewAddEmployeeModal()
    {
        $this->render("backoffice/Employee/view_add_employee",FALSE);
    }
    

    
    
    /**
     * Add or edit Employee
     * 
     */
    public function addEditEmployee()
    {
        if ($this->input->post('action') && $this->input->post('action') == "addEmployee")
        {
            $employee_data = array(
                "emp_code" => $this->input->post('employee_frm_emp_code'),
                "emp_name" => $this->input->post('employee_frm_emp_name'),
                "emp_phone" => $this->input->post('employee_frm_emp_phone'),
                "emp_email" => $this->input->post('employee_frm_emp_email'),
                "dept_id" => $this->input->post('employee_frm_dept_id')
            );


            $save = $this->CommonModel->save("employee_master",$employee_data);
            if($save){
                $this->session->set_flashdata("success","Employee added successfully");
            }else{
                $this->session->set_flashdata("error","problem adding employee. Try Later");
            }
        }
        
        if ($this->input->post('action') && $this->input->post('action') == "editEmployee")
        {
            $employee_data = array(
                "emp_code" => $this->input->post('employee_frm_emp_code'),
                "emp_name" => $this->input->post('employee_frm_emp_name'),
                "emp_phone" => $this->input->post('employee_frm_emp_phone'),
                "emp_email" => $this->input->post('employee_frm_emp_email'),
                "dept_id" => $this->input->post('employee_frm_dept_id')
            );
            
            $update = $this->CommonModel->update("employee_master",$employee_data,array('id'=>$this->input->post('update_id')));
            if($update){
                $this->session->set_flashdata("success","Employee updated successfully");
            }else{
                $this->session->set_flashdata("error","Problem Editing Employee.Try Later");
            }
        }
        
        redirect("backoffice/Employee","refresh");
    }
    
    
    /**
     * View edit modal with set employee data
     * 
     * @param int $user_id
     */
    public function viewEditEmployeeModal($emp_id)
    {
        $department_list = $this->CommonModel->getRecord("department_master",'')->result_array();
        $employee_data = $this->CommonModel->getRecord("employee_master",array('id'=>$emp_id))->row_array();
        $this->pageData['employee_data'] = $employee_data;
        $this->pageData['department_list'] = $department_list;
        $this->render("backoffice/Employee/view_add_Employee",FALSE);
    }
    
    
    /**
     * Delete Employee
     * 
     */
    public function deleteEmployee()
    {
        if ($this->input->post('emp_id'))
        {
            $result = $this->CommonModel->delete("employee_master",array('id'=>$this->input->post('emp_id')));
            if ($result)
            {
                if ($this->input->post('emp_pic'))
                {
                    unlink($this->DIR.$this->input->post('emp_pic'));
                }
                
                $res_output['code'] = 1;
                $res_output['status'] = "success";
                $res_output['message'] = "Employee delete successfully";
                echo json_encode($res_output);
                exit();
            }
            else 
            {
                $res_output['code'] = 0;
                $res_output['status'] = "error";
                $res_output['message'] = "Employee not delete";
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