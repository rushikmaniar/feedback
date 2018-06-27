<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CriteriaManagement extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
       $OrWhere = array();
        $val = '
        criteria_master.*,
        section_master.id as section_id,
        section_master.section_name
        ';
        $criteria_data = $this->CommonModel
            ->dbOrderBy(array('criteria_master.id'=>'DESC'))
            ->dbjoin(
                array(
                    array(
                        'table' => 'section_master',
                        'condition' => 'criteria_master.section_id = section_master.id'
                    )
                )
            )
            ->getRecord('criteria_master', $OrWhere, $val)->result_array();

        $new_criteria_data = array();
        foreach ($criteria_data as $row):
            $new_criteria_data[$row['id']] = $row;
        endforeach;
        $criteria_data = $new_criteria_data;
        foreach ($criteria_data as $row):
            if($row['type_data'] == 1):
                $criteria_data[$row['id']]['options'] = $this->CommonModel->getRecord('option_master',array('criteria_id'=>$row['id']))->result_array();
                endif;
        endforeach;

        $this->pageTitle = 'Criteria Management';
        $this->pageData['criteria_data'] = $criteria_data;
        $this->render("Criteria/index.php");
    }
    
    
    /**
     * View add Criteria modal
     * 
     */
    public function viewAddCriteriaModal()
    {
        $OrWhere = array();
        $section_list = $this->CommonModel
            ->dbOrderBy(array('id'=>'ASC'))
            ->getRecord('section_master', $OrWhere, 'section_master.id as section_id,section_master.section_name')->result_array();

        $this->pageData['section_list'] = $section_list;
        $this->render("backoffice/Criteria/view_add_criteria",FALSE);
    }

    
    /**
     * Add or edit Criteria
     * 
     */
    public function addEditCriteria()
    {

        if ($this->input->post('action') && $this->input->post('action') == "addCriteria")
        {
            $criteria_data = array(
                "section_id" => $this->input->post('criteria_frm_section_id'),
                "point_name" => $this->input->post('criteria_frm_point_name')
            );
            if($this->input->post('radios') == "options"){
                $criteria_data['type_data'] = 1;
            }



            $save = $this->CommonModel->save("criteria_master",$criteria_data);


            if($save){

                //entry in option_master if options are available
                if($this->input->post('radios') == "options"){
                    $options = $this->input->post('options');
                    foreach ($options as $row):
                        $row['criteria_id'] = $save;
                        $option_data = $row;
                        unset($option_data['section_id']);
                        $this->CommonModel->save("option_master",$option_data);
                    endforeach;
                }
                $this->session->set_flashdata("success","Criteria added successfully");
            }else{
                $this->session->set_flashdata("error","problem adding Criteria. Try Later");
            }
        }
        
        if ($this->input->post('action') && $this->input->post('action') == "editCriteria")
        {
            $criteria_data = array(
                "section_id" => $this->input->post('criteria_frm_section_id'),
                "point_name" => $this->input->post('criteria_frm_point_name'),
                "type_data" => 0
            );
            if($this->input->post('radios') == "options"){
                $criteria_data['type_data'] = 1;
            }
            //entry in option_master if options are available
            if($this->input->post('radios') == "options"){
                //delete previous if any
                $this->CommonModel->delete("option_master",array('criteria_id'=>$this->input->post('update_id')));
                $options = $this->input->post('options');
                foreach ($options as $row):
                    $row['criteria_id'] = $this->input->post('update_id');
                    $option_data = $row;
                    unset($option_data['section_id']);
                    $this->CommonModel->save("option_master",$option_data);
                endforeach;
            }
            $update = $this->CommonModel->update("criteria_master",$criteria_data,array('id'=>$this->input->post('update_id')));
            if($update){
                $this->session->set_flashdata("success","Criteria updated successfully");
            }else{
                $this->session->set_flashdata("error","Problem Editing Criteria.Try Later");
            }
        }
        
        redirect("backoffice/CriteriaManagement","refresh");
    }
    
    
    /**
     * View edit modal with set Criteria data
     * 
     * @param int $criteria_id
     */
    public function viewEditCriteriaModal($criteria_id)
    {
        $OrWhere = array();
        $section_list = $this->CommonModel
            ->dbOrderBy(array('id'=>'ASC'))
            ->getRecord('section_master', $OrWhere, 'section_master.id as section_id,section_master.section_name')->result_array();



        $criteria_data = $this->CommonModel->getRecord("criteria_master",array('id'=>$criteria_id))->row_array();
        if($criteria_data['type_data'] == 1){
            $option_data = $this->CommonModel->getRecord("option_master",array('criteria_id'=>$criteria_id))->result_array();
            $this->pageData['option_data'] = $option_data;
        }else{
            //delete all option from option_master
            $this->CommonModel->delete('option_master',array('criteria_id'=>$criteria_id));
        }

        $this->pageData['section_list'] = $section_list;
        $this->pageData['criteria_data'] = $criteria_data;

        $this->render("backoffice/criteria/view_add_criteria",FALSE);
    }
    
    
    /**
     * Delete Criteria
     * 
     */
    public function deleteCriteria()
    {
        if ($this->input->post('criteria_id'))
        {
            $result = $this->CommonModel->delete("criteria_master",array('id'=>$this->input->post('criteria_id')));
            if ($result)
            {
                $res_output['code'] = 1;
                $res_output['status'] = "success";
                $res_output['message'] = "Criteria deleted successfully";
                echo json_encode($res_output);
                exit();
            }
            else 
            {
                $res_output['code'] = 0;
                $res_output['status'] = "error";
                $res_output['message'] = "Criteria not delete";
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