<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * CertificatsEtudiants Controller
 *
 * @property \App\Model\Table\CertificatsEtudiantsTable $CertificatsEtudiants
 */
class CertificatsEtudiantsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        
        
        $connection = ConnectionManager::get('default');


        $donne_delivrer =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,certificats.id,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = "Délivré" AND (certificats.type= 
                      "Retrait définitive bac" OR certificats.type="Retrait provisoire bac" OR certificats.type="Certificat scolarité")')->fetchAll('assoc');



        $donne_demande =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = "Demande envoyé" AND (certificats.type= 
                                 "Retrait définitive bac" OR certificats.type="Retrait provisoire bac" OR certificats.type="Certificat scolarité") ')->fetchAll('assoc');



        $donne_enCour =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified FROM filieres 
                                JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = "En cours de traitement" AND (certificats.type= 
                                 "Retrait définitive bac" OR certificats.type="Retrait provisoire bac" OR certificats.type="Certificat scolarité") ')->fetchAll('assoc');


        $donne_rejeter =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = "Rejeter" AND (certificats.type= 
                                 "Retrait définitive bac" OR certificats.type="Retrait provisoire bac" OR certificats.type="Certificat scolarité")')->fetchAll('assoc');


        $donne_prete =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = "Prête" AND (certificats.type= 
                                 "Retrait définitive bac" OR certificats.type="Retrait provisoire bac" OR certificats.type="Certificat scolarité") ')->fetchAll('assoc');

       
        $this->set('donne_delivrer',$donne_delivrer);
        $this->set('donne_demande',$donne_demande);
        $this->set('donne_enCour',$donne_enCour);
        $this->set('donne_rejeter',$donne_rejeter);
        $this->set('donne_prete',$donne_prete);
        $this->render('/Espaces/resposcolarites/CertificatsEtudiants/index');
    }

    /**
     * View method
     *
     * @param string|null $id Certificats Etudiant id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $certificatsEtudiant = $this->CertificatsEtudiants->get($id, [
            'contain' => ['Certificats', 'Etudiants']
        ]);

        $this->set('certificatsEtudiant', $certificatsEtudiant);
        $this->set('_serialize', ['certificatsEtudiant']);
                $this->render('/Espaces/resposcolarites/CertificatsEtudiants/view');
    }
    public function com($id = null)
    {
        $connection = ConnectionManager::get('default');
        $donne =  $connection->execute('SELECT etudiants.nom_fr,etudiants.prenom_fr, etudiants.date_naissance,etudiants.cne, certificats_etudiants.entreprise, filieres.libile  
                                        FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.id = :id',[':id'=>$id])->fetchAll('assoc');

        $this->set('donne', $donne);
                $this->render('/Espaces/resposcolarites/CertificatsEtudiants/com');
    }

    /**
     * Edit method
     *
     * @param string|null $id Certificats Etudiant id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.

     */

  public function cmnt($id = null)
    {
        $certificatsEtudiant = $this->CertificatsEtudiants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $certificatsEtudiant = $this->CertificatsEtudiants->patchEntity($certificatsEtudiant, $this->request->data);
            if ($this->CertificatsEtudiants->save($certificatsEtudiant)) {
                $this->Flash->success(__('The certificats etudiant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The certificats etudiant could not be saved. Please, try again.'));
        }
        $certificats = $this->CertificatsEtudiants->Certificats->find('list', ['limit' => 200]);
        $etudiants = $this->CertificatsEtudiants->Etudiants->find('list', ['limit' => 200]);
         $certificatCmnt= $this->CertificatsEtudiants->find('all',array('conditions'=>array('CertificatsEtudiants.id'=>$certificatsEtudiant->id),'fields' => 'commentaire'))->toArray();
        $this->set(compact('certificatsEtudiant', 'certificats', 'etudiants'));
        $this->set('_serialize', ['certificatsEtudiant']);

        $this->render('/Espaces/resposcolarites/CertificatsEtudiants/cmnt');

    }

    public function edit($id = null)
    {
        $this->request->allowMethod(['post', 'Prête','Approuver','Rejeter','Délivré','Cmnt']);
        $certificatsEtudiant = $this->CertificatsEtudiants->get($id, [
            'contain' => []
        ]);
       
              
       
        switch ($this->request->data['editer']) {
            case 'Approuver':
                $certificatsEtudiant->etat = "En cours de traitement";
                break;
            case 'Valider':
                $certificatsEtudiant->etat = "Prête";
                break;
            case 'Délivrer':
                $certificatsEtudiant->etat = "Délivré";
                break;  
                 case 'Rejeter':
                $certificatsEtudiant->etat = "Rejeter";
                break;   
                        
          /*  default:
                break;*/
        }
            if ($this->CertificatsEtudiants->save($certificatsEtudiant)) {
                $this->Flash->success(__($this->request->data));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The certificats etudiant could not be saved. Please, try again.'));
        
       $certificatEtat= $this->CertificatsEtudiants->find('all',array('conditions'=>array('CertificatsEtudiants.id'=>$certificatsEtudiant->id),'fields' => 'etat'))->toArray();
       //print_r($certificatEtat[0]['etat']);

        $certificats = $this->CertificatsEtudiants->Certificats->find('list', ['limit' => 200]);
        $etudiants = $this->CertificatsEtudiants->Etudiants->find('list', ['limit' => 200]);
        
        $this->set(compact('certificatsEtudiant', 'certificats', 'etudiants','certificatEtat'));
        $this->set('_serialize', ['certificatsEtudiant']);
        return $this->redirect(['action' => 'index']);
        $this->render('/Espaces/resposcolarites/CertificatsEtudiants/edit');
    }

    /**
     * Delete method
     *
     * @param string|null $id Certificats Etudiant id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    private function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $certificatsEtudiant = $this->CertificatsEtudiants->get($id);
        if ($this->CertificatsEtudiants->delete($certificatsEtudiant)) {
            $this->Flash->success(__('The certificats etudiant has been deleted.'));
        } else {
            $this->Flash->error(__('The certificats etudiant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


}