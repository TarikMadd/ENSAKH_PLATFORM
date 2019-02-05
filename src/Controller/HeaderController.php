<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;



class HeaderController extends AppController {
    public function index() {

        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $this->render('/Espaces/Admin/home');
    }




}

?>