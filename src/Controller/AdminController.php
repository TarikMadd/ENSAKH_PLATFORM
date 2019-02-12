<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;



class AdminController extends AppController {
    public function beforeFilter(Event $event)
    {
        // allow only login, forgotpassword
        $this->Auth->authorize = 'controller';
        $usrole = $this->Auth->user('role');
        if($usrole!='admin')
        {

            $this->Flash->error(__('Vous ne pouvez pas acceder a ce lien'));
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'logout']
            );
        }
        $this->Auth->deny();

    }
    public function index() {

        $usrole=$this->Auth->user('role');
        if($usrole=='admin') {
            $this->set('role', $usrole);
            $this->render('/Espaces/Admin/home');
        }
    }




}

?>