<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Vacatairesbis Controller
 *
 * @property \App\Model\Table\VacatairesbisTable $Vacatairesbis
 */
class VacatairesbisController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $vacatairesbis = $this->paginate($this->Vacatairesbis);

        $this->set(compact('vacatairesbis'));
        $this->set('_serialize', ['vacatairesbis']);
    }

    /**
     * View method
     *
     * @param string|null $id Vacatairesbi id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vacatairesbi = $this->Vacatairesbis->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('vacatairesbi', $vacatairesbi);
        $this->set('_serialize', ['vacatairesbi']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vacatairesbi = $this->Vacatairesbis->newEntity();
        if ($this->request->is('post')) {
            $vacatairesbi = $this->Vacatairesbis->patchEntity($vacatairesbi, $this->request->getData());
            if ($this->Vacatairesbis->save($vacatairesbi)) {
                $this->Flash->success(__('The vacatairesbi has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vacatairesbi could not be saved. Please, try again.'));
        }
        $users = $this->Vacatairesbis->Users->find('list', ['limit' => 200]);
        $this->set(compact('vacatairesbi', 'users'));
        $this->set('_serialize', ['vacatairesbi']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vacatairesbi id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vacatairesbi = $this->Vacatairesbis->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vacatairesbi = $this->Vacatairesbis->patchEntity($vacatairesbi, $this->request->getData());
            if ($this->Vacatairesbis->save($vacatairesbi)) {
                $this->Flash->success(__('The vacatairesbi has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vacatairesbi could not be saved. Please, try again.'));
        }
        $users = $this->Vacatairesbis->Users->find('list', ['limit' => 200]);
        $this->set(compact('vacatairesbi', 'users'));
        $this->set('_serialize', ['vacatairesbi']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vacatairesbi id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vacatairesbi = $this->Vacatairesbis->get($id);
        if ($this->Vacatairesbis->delete($vacatairesbi)) {
            $this->Flash->success(__('The vacatairesbi has been deleted.'));
        } else {
            $this->Flash->error(__('The vacatairesbi could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
