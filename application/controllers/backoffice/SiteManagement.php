<?php
/**
 * Created by PhpStorm.
 * User: rushikwin8
 * Date: 012 12-08-2018
 * Time: 12:18 PM
 */

class SiteManagement extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->pageTitle = 'Site Management';
        $this->pageData['site_settings'] = $this->CommonModel->getRecord('site_settings')->result_array();

        $this->render('SiteManagement/index');
    }

    public function editSettings()
    {
        if ($this->input->post('frm_sitesettings')) {
            $settings_data = $this->input->post('frm_sitesettings');
            foreach ($settings_data as $key => $value) {
                $this->CommonModel->update('site_settings', array('settings_value' => $value), array('settings_id' => $key));
            }
            redirect(base_url('backoffice/SiteManagement'));
        } else {

            $this->session->flashdata('error', 'Invalid Parameter');
            redirect(base_url('backoffice'));
        }
    }
}