<?php

require 'DBManager.php';
require 'GeneralController.php';


class ManagerController
{
    public $userController;
    public $generalController;
    public $adminController;

    public function __construct()
    {
        /** Instantiation of Controller */
        $this->generalController  = new GeneralController();
    }
}