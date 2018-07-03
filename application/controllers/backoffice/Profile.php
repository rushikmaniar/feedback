<?php
class Profile extends AdminController{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->pageTitle = "Profile";
        $user_data = $this->CommonModel->getRecord('user',array('user_id'=>$this->session->userdata('feedback-admin')['user_id']));

        $this->pageData['user_details'] = $user_data;
    }
}
?>