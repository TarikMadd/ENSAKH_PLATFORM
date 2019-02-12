<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;

use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth',[
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ]
        ]);
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
        $this->viewBuilder()->theme('AdminLTE');
        $this->set('theme', Configure::read('Theme'));
    }
public function updateNotifications(){

        $connection = ConnectionManager::get('default');

        $user_id =$this->Auth->user('id');
        $user_role = $this->Auth->user('role');
        $test1 =  $connection->execute('SELECT * FROM notifications_users WHERE user_id = :userid ORDER BY created DESC',[':userid' => $user_id])->fetchAll('assoc');
        $test2 = $connection->execute('SELECT * FROM notifications_groupe WHERE role = :userrole ORDER BY created DESC',[':userrole' => $user_role])->fetchAll('assoc');
        $test = array();
        if(!empty($test1) && !empty($test2)){
            $test = array_merge($test1,$test2);
        }elseif(!empty($test1) && empty($test2)){
            $test = $test1;
        }elseif(empty($test1) && !empty($test2)){
            $test = $test2;
        }

        $session = $this->request->session();
        $session->write('notifications', $test);

        $this->render('/Element/notification');
    }
    protected function preparerNotification($donne,$type){
        if($type == "indiv"){
            $Notifications = TableRegistry::get('notifications_users');
            $notification = $Notifications->newEntity();
            $notification->user_id = $donne['user_id'];
        }elseif($type == "grp"){
            $Notifications = TableRegistry::get('notifications_groupe');
            $notification = $Notifications->newEntity();
            $notification->role = $donne['role'];

        }
        $notification->titre = $donne['titre'];
        $notification->principale = $donne['principale'];
        $notification->commentaire = $donne['commentaire'];
        $notification->lien = $donne['lien'];
        $notification->style = $donne['style'];
        if($Notifications->save($notification)){
            return true;
        }
        return false;
    }


}
