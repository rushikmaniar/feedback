<?php
/**
 * Created by PhpStorm.
 * User: Rushik
 * Date: 12-04-2018
 * Time: 11:44 AM
 */
class Home extends SiteController{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        echo 'home';
    }
}
?>

