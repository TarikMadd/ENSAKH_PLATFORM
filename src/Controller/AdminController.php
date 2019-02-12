<?php

namespace App\Controller;
use Cake\Datasource\ConnectionManager;

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
    public function autoriser()
    {
        $con=ConnectionManager::get('default');
        $_SESSION['iss'] = 'no';
        $classes = $con->execute("SELECT groupes.id, filieres.libile as f,niveaus.libile as n,niveaus.id as id_n FROM niveaus,filieres,groupes WHERE groupes.niveaus_id = niveaus.id AND groupes.filiere_id = filieres.id")->fetchAll('assoc');
        $_SESSION['classes'] = $classes;
        if(isset($_POST['choix']))
        {
            $_SESSION['iss'] = 'yes';
            if($this->request->data['classe']==0)
            {
                for ($i=1; $i <13 ; $i++)
                {

                    $con->execute("UPDATE access_admis SET access = 1 WHERE groupe_id = $i");
                }
            }
            else
            {
                $i = $this->request->data['classe'];
                $con->execute("UPDATE access_admis SET access = 1 WHERE groupe_id = $i");
            }
        }
        $this->render('/Espaces/resposcolarites/auto');
    }




}

?>