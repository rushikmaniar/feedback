<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public $pageData = array();
	public $pageTitle = 'Page Title';
	public $userInfo = array();
	public $total_customer = 0;
	public $total_category = 0;
	public $total_section = 0;
	public $per_page = 10;
	
	public function __construct()
	{
		parent::__construct();
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
