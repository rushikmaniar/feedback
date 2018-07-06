<?php

class Profile extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->pageTitle = "Profile";
        $user_data = $this->CommonModel->getRecord('user', array('user_id' => $this->session->userdata('feedback-admin')['user_id']));

        $this->pageData['user_details'] = $user_data->row_array();
        $this->render('Profile/index.php');
    }


    public function editProfile()
    {

        //post data
        $user_details = $this->input->post();

        //session data
        $session_user = $this->session->userdata('feedback-admin');

        $update = $this->CommonModel->update('user', array('user_email' => $user_details['frm_profile_user_email']), array('user_id' => $session_user['user_id']));
        if ($update) {
            //update session
            $session_user['user_email'] = $user_details['frm_profile_user_email'];
            $this->session->set_userdata('feedback-admin', $session_user);

            $this->session->set_flashdata('success', 'Profile Updated successfully');

        } else {
            $this->session->set_flashdata('error', 'Fail To  Update Profile.Try Again');

        }
    }
}

?>