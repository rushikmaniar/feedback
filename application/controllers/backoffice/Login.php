<?php
/**
 * Created by PhpStorm.
 * User: Rushik
 * Date: 12-04-2018
 * Time: 11:47 AM
 */
class Login extends AdminController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }
    /**
     * Login page
     */
    public function index()
    {
        print_r($_POST);
        if ($this->session->userdata('feedback-admin')){redirect('backoffice/dashboard','refresh');}

        if($this->input->post('LoginFormEmail'))
        {
            $whr = array("user_email"=>$this->input->post('LoginFormEmail'),"user_password"=>md5($this->input->post('LoginFormPassword')));
            $result = $this->UserModel->getRecord("user",$whr);
            print_r($this->db->last_query());
            if ($result->num_rows() == 1)
            {
                $data = $result->result_array();
                print_r($data);exit;
                $this->session->set_userdata("feedback-admin",$data[0]['id']);
                redirect('backoffice/dashboard','refresh');
            }
            else
            {
                $this->session->set_flashdata('login_error','Incorrect username and password!');
                redirect('backoffice/login','refresh');
            }
        }
        $this->load->view('backoffice/login/index','refresh');
    }


    /**
     * Logout functionality
     *
     */
    public function logout()
    {
        $this->session->unset_userdata('feedback-admin');
        redirect('backoffice/login','refresh');
    }
}