<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use DebugBar\StandardDebugBar;

class AdminController extends CI_Controller {

	public $pageData = array();
    public $debugbar;
    public $debugbarRenderer;

    public $pageTitle = 'Page Title';
	public $userInfo = array();
	public $total_customer = 0;
	public $total_category = 0;
	public $total_section = 0;
	public $per_page = 10;
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('CommonModel');
	}
    public function checkexists($id = false)
    {

        $table = $this->input->post('table');
        $field = $this->input->post('field');
        $value = $this->input->post($field);

        if (isset($id)) {
            $c = $this->CommonModel->getRecord($table, array($field => $value, "id !=" => $id))->num_rows();

        } else {
            $c = $this->CommonModel->getRecord($table, array($field => $value))->num_rows();
        }

        if ($c > 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit();

    }
	public function render($the_view=null,$template='main')
	{
	    if($the_view)
		{
		    if($template){
			$this->pageData['page_content'] = $this->load->view('backoffice/'.$the_view,$this->pageData,TRUE);
			$this->load->view('backoffice/template/'.$template,$this->pageData);
		    }
		    else 
		    {
		        $this->load->view($the_view,$this->pageData);
		    }
		    
		}
		else
		{
		    exit("View Not Found");
		}
	}
}
