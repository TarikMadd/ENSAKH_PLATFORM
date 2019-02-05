<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Etudiers Controller
 *
 * @property \App\Model\Table\EtudiersTable $Etudiers
 *
 * @method \App\Model\Entity\Etudier[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EtudiersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Etudiants', 'AnneeScolaires', 'Groupes', 'Elements']
        ];
        $etudiers = $this->paginate($this->Etudiers);

        $this->set(compact('etudiers'));
    }

    /**
     * View method
     *
     * @param string|null $id Etudier id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $etudier = $this->Etudiers->get($id, [
            'contain' => ['Etudiants', 'AnneeScolaires', 'Groupes', 'Elements', 'Notes']
        ]);

        $this->set('etudier', $etudier);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $etudier = $this->Etudiers->newEntity();
        if ($this->request->is('post')) {
            $etudier = $this->Etudiers->patchEntity($etudier, $this->request->getData());
            if ($this->Etudiers->save($etudier)) {
                $this->Flash->success(__('The etudier has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The etudier could not be saved. Please, try again.'));
        }
        $etudiants = $this->Etudiers->Etudiants->find('list', ['limit' => 200]);
        $anneeScolaires = $this->Etudiers->AnneeScolaires->find('list', ['limit' => 200]);
        $groupes = $this->Etudiers->Groupes->find('list', ['limit' => 200]);
        $elements = $this->Etudiers->Elements->find('list', ['limit' => 200]);
        $this->set(compact('etudier', 'etudiants', 'anneeScolaires', 'groupes', 'elements'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Etudier id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $etudier = $this->Etudiers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $etudier = $this->Etudiers->patchEntity($etudier, $this->request->getData());
            if ($this->Etudiers->save($etudier)) {
                $this->Flash->success(__('The etudier has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The etudier could not be saved. Please, try again.'));
        }
        $etudiants = $this->Etudiers->Etudiants->find('list', ['limit' => 200]);
        $anneeScolaires = $this->Etudiers->AnneeScolaires->find('list', ['limit' => 200]);
        $groupes = $this->Etudiers->Groupes->find('list', ['limit' => 200]);
        $elements = $this->Etudiers->Elements->find('list', ['limit' => 200]);
        $this->set(compact('etudier', 'etudiants', 'anneeScolaires', 'groupes', 'elements'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Etudier id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $etudier = $this->Etudiers->get($id);
        if ($this->Etudiers->delete($etudier)) {
            $this->Flash->success(__('The etudier has been deleted.'));
        } else {
            $this->Flash->error(__('The etudier could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
