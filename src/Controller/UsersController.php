<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{



    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login() {
        if ($this->request->is('post')){
            $user = $this->Auth->identify();
            if($user){
                $this->Auth->setUser($user);
               // $this->Flash->success('Connexion avec succes');
                switch ($user['role'])
                {
                    case 'admin':
                        return $this->redirect(array('controller' => 'Admin', 'action' => 'index'));
                        break;
                    case 'resposcolarite':
                        return $this->redirect(array('controller' => 'resposcolarites', 'action' => 'index'));
                        break;
                    case 'respopersonel':
                        return $this->redirect(array('controller' => 'Respopersonels', 'action' => 'index'));
                        break;
                    case 'respobiblio':
                        return $this->redirect(array('controller' => 'respobiblios', 'action' => 'index'));
                        break;
                    case 'respobureauordre':
                        return $this->redirect(array('controller' => 'respobureauordres', 'action' => 'index'));
                        break;
                    case 'respofinance':
                        return $this->redirect(array('controller' => 'respofinances', 'action' => 'index'));
                        break;
                    case 'respostock':
                        return $this->redirect(array('controller' => 'respostocks', 'action' => 'index'));
                        break;
                    case 'etudiant':
                        return $this->redirect(array('controller' => 'Etudiants', 'action' => 'index'));
                        break;
                    case 'profvacataire':
                        return $this->redirect(array('controller' => 'profvacataires', 'action' => 'index'));
                        break;
                    case 'profpermanent':
                        return $this->redirect(array('controller' => 'profpermanents', 'action' => 'index'));
                        break;
                    case 'ingenieur':
                        return $this->redirect(array('controller' => 'ingenieurs', 'action' => 'index'));
                        break;
                    case 'respostage':
                        return $this->redirect(array('controller' => 'respostages', 'action' => 'indexrespo'));
                        break;
                }

            }

            //if nothing happend 
            $this->Flash->error('Veuillez verifier vos entrers');
        }
    }

    public function logout(){
        //$this->Flash->success('Déconnexion avec succes ');
        return $this->redirect($this->Auth->logout());
    }
}
