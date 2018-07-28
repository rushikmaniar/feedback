<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 28/7/2018
 * Time: 10:04 AM
 */
class DatabaseManagement extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->pageTitle = 'Database Management';
        $this->render("databasemanagement/index.php");
    }

    /* Truncate Almost tables */
        public function truncatedatabase()
    {
        $tables=$this->db->query("SELECT t.TABLE_NAME AS myTables FROM INFORMATION_SCHEMA.TABLES AS t WHERE t.TABLE_SCHEMA = 'feedback'")->result_array();
        foreach($tables as $key => $val) {
            echo $val['myTables']."<br>";// myTables is the alias used in query.
        }
    }

    /* Export Full database */
    public function exportdatabase()
    {
        $this->load->dbutil();
        $db_name = 'feedback'.date('Y').'.zip';



        $backup =& $this->dbutil->backup();


        $save = FCPATH.'backup\\'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup);


        $this->load->helper('download');
        force_download($db_name, $backup);
        redirect(base_url('backoffice/DatabaseManagement'));
    }
    public function viewTruncateModal(){
        $tables=$this->db->query("SELECT t.TABLE_NAME AS myTables FROM INFORMATION_SCHEMA.TABLES AS t WHERE t.TABLE_SCHEMA = 'feedback'")->result_array();

        unset($tables['user']);
        unset($tables['ranking']);
        $newtables = array();

        $this->pageData['tablelist'] = array_map(function ($data){return $data['myTables'];},$newtables);
        echo '<pre>';
        print_r($this->pageData['tablelist']);
        echo '</pre>';exit;
        $this->render("backoffice/databasemanagement/truncatedatabaseModal.php",FALSE);
    }
}