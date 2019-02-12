<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;



class respostagesController extends AppController {

    public function beforeFilter(Event $event)
    {
        // allow only login, forgotpassword
        $this->Auth->authorize = 'controller';
        $usrole = $this->Auth->user('role');
        if($usrole!='respostage' && $usrole!='admin')
        {

            $this->Flash->error(__('Vous ne pouvez pas acceder a ce lien'));
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'logout']
            );
        }
        $this->Auth->deny();

    }
    public function index() {

        $usrole = $this->Auth->user('role');
        if($usrole=='respostage') {
            $this->set('role', $usrole);
            $this->render('/Espaces/respostages/home');
        }
    }
    public function indexCertificatsEtudiants($f = NULL)  {
        
         

        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $connection = ConnectionManager::get('default');
        $suite = "";
        if($f != NULL){
            $suite = "AND filieres.id = :f ";
        }

        $donne_delivrer =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,certificats.id,etudiants.id, etudiants.nom_fr,etudiants.cne,etudiants.prenom_fr, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id
                                                               WHERE certificats_etudiants.etat = "Délivré" AND certificats.type LIKE "%stage" '.$suite.' ORDER BY certificats_etudiants.created ASC',[':f'=>$f])->fetchAll('assoc');



        $donne_demande =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr,etudiants.cne, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = "Demande envoyé" AND certificats.type LIKE "%stage" '.$suite.' ORDER BY certificats_etudiants.created ASC',[':f'=>$f])->fetchAll('assoc');



        $donne_enCour =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr,etudiants.cne, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = "En cours de traitement" AND certificats.type LIKE "%stage" '.$suite.' ORDER BY certificats_etudiants.created ASC',[':f'=>$f])->fetchAll('assoc');


        $donne_rejeter =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr,etudiants.cne, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = "Rejeter" AND certificats.type LIKE "%stage" '.$suite.' ORDER BY certificats_etudiants.created ASC',[':f'=>$f])->fetchAll('assoc');


        $donne_prete =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr,etudiants.cne, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = "Prête" AND certificats.type LIKE "%stage" '.$suite.' ORDER BY certificats_etudiants.created ASC',[':f'=>$f])->fetchAll('assoc');


       
        $this->set('donne_delivrer',$donne_delivrer);
        $this->set('donne_demande',$donne_demande);
        $this->set('donne_enCour',$donne_enCour);
        $this->set('donne_rejeter',$donne_rejeter);
        $this->set('donne_prete',$donne_prete);
       
       
        $this->set('_serialize', ['donne_delivrer']);  
         $this->set('_serialize', ['donne_enCour']);  
          $this->set('_serialize', ['donne_demande']);  
           $this->set('_serialize', ['donne_rejeter']);  
            $this->set('_serialize', ['donne_prete']);  
        $this->render('/Espaces/respostages/CertificatsEtudiants/index');
       
    }


   /**********************************************************************************************************************/
// home du responsable

    public function indexrespo() {
        $connection = ConnectionManager::get('default');

       $donne_demande =  $connection->execute('SELECT certificats_etudiants.id AS cer_id FROM certificats_etudiants
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = "Demande envoyé" AND certificats.type LIKE "%stage" ')->fetchAll('assoc');
        
       $nbre=count($donne_demande);
        $envoye='"Demande envoyé"';
       $enCours='"En cours de traitement"';
       $prete='"Prête"';
       $delivre='"Délivré"';
       $rejeter='"Rejeter"';
       $nEnvoye= $this->nbre(NULL,$envoye);
       $nEncours= $this->nbre(NULL,$enCours);
       $nPrete=$this->nbre(NULL,$prete);
       $nDelivre=$this->nbre(NULL,$delivre);
       $nRejete=$this->nbre(NULL,$rejeter);
       $this->set('nEnvoye',$nEnvoye);
       $this->set('nEncours',$nEncours);
       $this->set('nPrete',$nPrete);
       $this->set('nDelivre',$nDelivre);
       $this->set('nRejete',$nRejete);


      
        $this->render('/Espaces/respostages/home'); 
    }
/******************************************************************************************************************************************/
// creation automatique du dossier    
    private function dossier()
    { $a=date("Y-m-d");
    $path = 'files' . DS . $a;
$folder = new Folder($path);

if (is_null($folder->path)) {
    $dir = new Folder(WWW_ROOT.'certificats stage'.DS.$a, true, 0755);
  }
     
  
    }
/**************************************************************************************************************************/
// afficher certificat de l'atudiant    
      public function viewCertificatsEtudiants($id = null)
    {
    	$CertificatsEtudiants = TableRegistry::get("certificats_etudiants");
        $certificatsEtudiant = $CertificatsEtudiants->get($id, [
            'contain' => ['Certificats', 'Etudiants']
        ]);
        
        $certificatsEtudiant->notif_respo = FALSE;
        $certificatsEtudiant->modified = $certificatsEtudiant->modified;
        if($CertificatsEtudiants->save($certificatsEtudiant)){
            $this->set('certificatsEtudiant', $certificatsEtudiant);
            $this->set('_serialize', ['certificatsEtudiant']);    
                 
            $this->render('/Espaces/respostages/CertificatsEtudiants/view');
        }else{
             
            return $this->Flash->error(_('Erreur innatendue !!'));
        }
    }
/********************************************************************************************************************************************/
// IMPRIMER CERTIFIACT DE L'ETUDIANT    
    public function imprimerCertificatsEtudiants($id = null)
    {
      $this->dossier();
         
        $connection = ConnectionManager::get('default');
        $donne =  $connection->execute('SELECT etudiants.nom_fr,etudiants.prenom_fr, etudiants.code_sexe, etudiants.cne, certificats_etudiants.entreprise, filieres.libile, certificats.type, certificats_etudiants.duree_stage, certificats_etudiants.theme_stage, certificats_etudiants.debut_stage, certificats_etudiants.fin_stage
                                        FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.id = :id',[':id'=>$id])->fetchAll('assoc');
      $prof=$connection->execute('SELECT profpermanents.prenom_prof, profpermanents.nom_prof FROM profpermanents JOIN certificats_etudiants ON profpermanents.id = certificats_etudiants.profpermanent_id WHERE certificats_etudiants.id = :id',[':id'=>$id])->fetchAll('assoc');
        $niveau=$connection->execute('SELECT niveaus.id, niveaus.libile FROM niveaus
          JOIN groupes ON niveaus.id= groupes.niveaus_id
          JOIN etudiers ON groupes.id = etudiers.groupe_id
          JOIN etudiants ON etudiers.etudiant_id= etudiants.id
          JOIN certificats_etudiants ON etudiants.id= certificats_etudiants.etudiant_id
          WHERE certificats_etudiants.id = :id',[':id'=>$id])->fetchAll('assoc');

         $this->set('prof', $prof);
        $this->set('donne', $donne);
        $this->set('niveau',$niveau);
        if($donne[0]['type']=="Convention - stage")
        {

          switch ($niveau[0]['id']) {
            case 3:
              $this->render('/Espaces/respostages/CertificatsEtudiants/conventionTC');
              break;
              case 4 :
              $this->render('/Espaces/respostages/CertificatsEtudiants/conventionCI');
              break;
              case 5:
              $this->render('/Espaces/respostages/CertificatsEtudiants/convention5');
              break;

          }

        }
        elseif ($donne[0]['type']=="Recommandation - stage") {
          switch ($niveau[0]['id']) {
            case 1:
              $this->render('/Espaces/respostages/CertificatsEtudiants/recommendation');
              break;
              case 2 :
              $this->render('/Espaces/respostages/CertificatsEtudiants/recommendation');
              break;
              case 3:
              $this->render('/Espaces/respostages/CertificatsEtudiants/recommendation3');
              break;
               case 4:
              $this->render('/Espaces/respostages/CertificatsEtudiants/recommendation4');
              break;
               case 5:
              $this->render('/Espaces/respostages/CertificatsEtudiants/recommendation5');
              break;
        }
        
    }
    }
    /*********************************************************************************************************************/
    // MISE A ZERO DE LA TABLE
    public function miseAzeroCertificatsEtudiants()
      {
        $this->request->allowMethod(['post', 'delete']);
        $connection=ConnectionManager::get('default');
        $connection->execute('TRUNCATE TABLE certificats_etudiants');
        return $this->redirect(['action' => 'indexCertificatsEtudiants']);  

      }
   /**************************************************************************************************************************/
  // public function rechercherCertificatsEtudinats   
/**************************************************************************************************************************/ 
// COMMENTER CERTIFICAT ET ENTRER LA RAISON DU REJET   

  public function cmntCertificatsEtudiants($id = null)
    {
        
         
        $connection = ConnectionManager::get('default');
    	
        $CertificatsEtudiants = TableRegistry::get("certificats_etudiants");
        $certificatsEtudiant = $CertificatsEtudiants->get($id, [
            'contain' => ['Certificats', 'Etudiants']
        ]);
        $donne =  $connection->execute('SELECT  filieres.id  
                                        FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.id = :id',[':id'=>$id])->fetchAll('assoc');
              $f=$donne[0]['id'];
        if ($this->request->is(['patch', 'post', 'put']) && !isset($this->request->data['Rejeter'])) {
            $certificatsEtudiant->commentaire = $this->request->data['commentaire'];
            $certificatsEtudiant->notif_etudiant = TRUE;
            if (isset($this->request->data['rejeterprince']) && $this->request->data['rejeterprince']) {
              $certificatsEtudiant->etat = "Rejeter";
            }
            if ($CertificatsEtudiants->save($certificatsEtudiant)) {
                $this->Flash->success(__('Le commentaire est envoyé.'));;
                return $this->redirect(['action' => 'indexCertificatsEtudiants/'.$f.'']);                
            }
            $this->Flash->error(__('Le commentaire n est pas envoyé. Réssayer'));
        }
        $certificats = $CertificatsEtudiants->Certificats->find('list', ['limit' => 200]);
        $etudiants = $CertificatsEtudiants->Etudiants->find('list', ['limit' => 200]);
        $certificatCmnt= $CertificatsEtudiants->find('all',array('conditions'=>array('certificats_etudiants.id'=>$certificatsEtudiant->id),'fields' => 'commentaire'))->toArray();
        if (isset($this->request->data['Rejeter'])) {
            $this->set('test',$this->request->data);
        }
        $this->set(compact('certificatsEtudiant', 'certificats', 'etudiants'));
        $this->set('_serialize', ['certificatsEtudiant']);

        $this->render('/Espaces/respostages/CertificatsEtudiants/cmnt');

    }
/*********************************************************************************************************************************************/
// MODIFIER L'ETAT DU CERTIFICAT DE L'ETUDIANT

    public function editCertificatsEtudiants($id = null)
    {
         
        $connection = ConnectionManager::get('default');
        $this->request->allowMethod(['post', 'Prête','Approuver','Délivré','Cmnt']);
        $CertificatsEtudiants = TableRegistry::get("certificats_etudiants");

        $certificatsEtudiant = $CertificatsEtudiants->get($id, [
            'contain' => []
        ]);

       
              $donne =  $connection->execute('SELECT  filieres.id  
                                        FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.id = :id',[':id'=>$id])->fetchAll('assoc');
              $f=$donne[0]['id'];
       
        switch ($this->request->data['editer']) {
            case 'Approuver':
                $certificatsEtudiant->etat = "En cours de traitement";
                $certificatsEtudiant->notif_etudiant=1;
                break;
            case 'Valider':
                $certificatsEtudiant->etat = "Prête";
                $certificatsEtudiant->notif_etudiant=1;
                break;
            case 'Délivrer':
                $certificatsEtudiant->etat = "Délivré";
                $certificatsEtudiant->notif_etudiant=1;
                break;  
                  
                        
        }
            if ($CertificatsEtudiants->save($certificatsEtudiant)) {
                $this->Flash->success(__($this->request->data));
                return $this->redirect(['action' => 'indexCertificatsEtudiants']);
            }
        $this->Flash->error(__('Aucn changement n \' est effectué.'));
        return $this->redirect(['action' => 'indexCertificatsEtudiants']);

    }
/**************************************************************************************************************************************************/
// CHOISIR LES CERTIDICATS A SUPPRIMER
    public function reinitialiserCertificatsEtudiants(){
         
        //$this->request->allowMethod(['post', 'delete']);
        $connection = ConnectionManager::get('default');
        
        $CertificatsEtudiants = TableRegistry::get("certificats_etudiants");
        $certificats_type =  $connection->execute('SELECT type, id FROM certificats WHERE certificats.type LIKE "%stage" ')->fetchAll('assoc');
        $this->set('certificats_type', $certificats_type);
         if ($this->request->is(['patch', 'post', 'put']) && !isset($this->request->data['Réinitialiser'])) 
         {
                $certif_id = array();
                foreach($this->request->data as $key => $value){
                    if($key != "vider")
                    $certif_id[] = $key;
                }
               if($CertificatsEtudiants->deleteAll(["certificat_id IN(".implode(',', $certif_id).")"])){
                   $this->Flash->success(__('Réinitilisation avec success'));
               }else{
                   $this->Flash->error(__('Erreur'));
               }
               return $this->redirect(['action'=>'indexCertificatsEtudiants']);
            }
         $this->render('/Espaces/respostages/CertificatsEtudiants/choix');
    }
    /*********************************************************************************************************************************/
    /*****************************************************************************************************************************************/

    private function nbre($f = NULL,$a)
    {
       $connection = ConnectionManager::get('default');
      $suite = "";
        if($f != NULL){
            $suite = "AND filieres.id = :f ";
        }

        $donne_delivrer =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,certificats.id,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = '.$a.' AND certificats.type LIKE "%stage" '.$suite,[':f'=>$f])->fetchAll('assoc');
        return count($donne_delivrer);

    }
    /**********************************************************************************************************************************/

    private function nbreMois($f = NULL,$m)
    {
       $connection = ConnectionManager::get('default');
     $suite = "";
        if($f != NULL){
            $suite = "AND filieres.id = :f ";
        }
        $b=date("Y");
      

        $donne_delivrer =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,certificats.id,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.created between "'.$b.'-'.$m.'-01" and "'.$b.'-'.$m.'-31" AND certificats.type LIKE "%stage" '.$suite,[':f'=>$f])->fetchAll('assoc');
        return count($donne_delivrer);

    }
    /****************************************************************************************************************************************/
    // STATISTIQUES
    public function statiqtiquesCertificatsEtudiants()
    {
       $connection = ConnectionManager::get('default');
     
        $filiere= $connection->execute('SELECT * FROM filieres ')->fetchAll('assoc');
        $del=array();
       $envoye='"Demande envoyé"';
       $enCours='"En cours de traitement"';
       $prete='"Prête"';
       $delivre='"Délivré"';
       $rejeter='"Rejeter"';

        for($i=0;$i<count($filiere);$i++)
        {
          $a=$filiere[$i]['id'];
          $envoyeStat[$a]=$this->nbre($a,$envoye);
          $enCoursStat[$a]=$this->nbre($a,$enCours);
          $preteStat[$a]=$this->nbre($a,$prete);
          $delivreStat[$a]=$this->nbre($a,$delivre);
          $rejeterStat[$a]=$this->nbre($a,$rejeter);
        }

      
        $this->set('envoyeStat',$envoyeStat);
        $this->set('enCoursStat',$enCoursStat);
        $this->set('preteStat',$preteStat);
        $this->set('delivreStat',$delivreStat);
        $this->set('rejeterStat',$rejeterStat);

        

       $this->set('filiere',$filiere);
       
   
      $this->render('/Espaces/respostages/CertificatsEtudiants/statistiques'); 


    }
    /**********************************************************************************************************/
 public function graphesCertificatsEtudiants()
    {
       $connection = ConnectionManager::get('default');
     
        $filiere= $connection->execute('SELECT * FROM filieres ')->fetchAll('assoc');
        $del=array();
       

        for($i=0;$i<count($filiere);$i++)
        {
          for($j=1 ; $j<13;$j++){
          $a=$filiere[$i]['id'];
          $envoyemois[$a][$j]=$this->nbreMois($a,$j);
          }
        }
         for($j=1;$j<13;$j++){
          
          $envoyemoisTotal[$j]=$this->nbreMois(NULL,$j);
        }
         $this->set('envoyemois',$envoyemois);

        $this->set('envoyemoisTotal',$envoyemoisTotal);

       

       $this->set('filiere',$filiere);
       
   
      $this->render('/Espaces/respostages/CertificatsEtudiants/graphes'); 


    }

             
/****************************************************************************************************************************************************************/
                                              //                  GESTION DES CERTIFICATS


/****************************************************************************************************************************************************************/
// AFFICHAGE DES CERTIFICATS 
   public function indexCertificats()
    {
         
        $connection = ConnectionManager::get('default');
        $certificats = $connection->execute('SELECT * FROM certificats  WHERE certificats.type LIKE "%stage" ')->fetchAll('assoc');

        $this->set(compact('certificats'));
        $this->set('_serialize', ['certificats']);
        $this->render('/Espaces/respostages/Certificats/index');
    }

/**********************************************************************************************************************************************************/
// RECHERCHE

    public function searchCertificats()
    {
         
        $Certificats = TableRegistry::get("certificats");
        $certificat = $Certificats->get($this->request->data['search'], [
            'contain' => ['Etudiants']
        ]);

        $this->set('certificat', $certificat);
        $this->set('_serialize', ['certificat']);

        $this->render('/Espaces/respostages/Certificats/view');    
    }
/*******************************************************************************************************************************************************/
// AFFICHER LA CERTIFICAT    
  
    public function viewCertificats($id = null)
    {
         
        $Certificats = TableRegistry::get("certificats");
        $certificat = $Certificats->get($id, [
            'contain' => ['Etudiants']
        ]);
        $this->set('certificat', $certificat);
        $this->set('_serialize', ['certificat']);

        $this->render('/Espaces/respostages/Certificats/view');
    }

/*******************************************************************************************************************************************************/
// AJOUTER UNE CERTIFICAT 
    public function addCertificats()
    {
         
        $Certificats = TableRegistry::get("certificats");
        
        $certificat = $Certificats->newEntity();
        
        if ($this->request->is('post') ) {
         $a= strval($this->request->data['type']);

        $this->request->data['type'] =$a.'-stage';
            $certificat = $Certificats->patchEntity($certificat, $this->request->data);
            if ($Certificats->save($certificat)) {
                $this->Flash->success(__('The {0} has been saved.', 'Certificat'));
                return $this->redirect(['action' => 'indexCertificats']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Certificat'));
            }
        }
        $connection = ConnectionManager::get('default');
        $profs= $connection->execute('SELECT profpermanents.id, profpermanents.nom_prof, profpermanents.prenom_prof FROM profpermanents');
        $this->set('profs',$profs);
      
     
      
       
        $this->set(compact('certificat', 'etudiants'));
        $this->set('_serialize', ['certificat']);
        $this->render('/Espaces/respostages/Certificats/add');
    }

/*******************************************************************************************************************************************************/
// EDITER UNE CERTIFICAT 
    public function editCertificats($id = null)
    {
         
        $Certificats = TableRegistry::get("certificats");
        $certificat = $Certificats->get($id, [
            'contain' => ['Etudiants']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $certificat = $Certificats->patchEntity($certificat, $this->request->data);
            if ($Certificats->save($certificat)) {
                $this->Flash->success(__('The {0} has been saved.', 'Certificat'));
                return $this->redirect(['action' => 'indexCertificats']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Certificat'));
            }
        }
        $this->set(compact('certificat', 'etudiants'));
        $this->set('_serialize', ['certificat']);
        $this->render('/Espaces/respostages/Certificats/edit');
    }
/*******************************************************************************************************************************************************/
// SUPPRIMER UNE CERTIFICAT 
    public function deleteCertificats($id = null)
    {
         
        $this->request->allowMethod(['post', 'delete']);
        $Certificats = TableRegistry::get("certificats");
        $certificat = $Certificats->get($id);
        if ($Certificats->delete($certificat)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Certificat'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Certificat'));
        }
        return $this->redirect(['action' => 'indexCertificats']);

    }
/*******************************************************************************************************************************************************/
/*******************************************************************************************************************************************************/
/*******************************************************************************************************************************************************/
/*******************************************************************************************************************************************************/
// notifications resposcolarites

   public function updateNotifications(){

        $connection = ConnectionManager::get('default');

        $usrole=$this->Auth->user('id');
        $test =  $connection->execute('SELECT certificats_etudiants.id,etudiants.nom_fr,etudiants.prenom_fr, certificats_etudiants.etat, filieres.libile, 
                                        certificats.type, certificats_etudiants.modified FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE (certificats.type LIKE "%stage") AND (certificats_etudiants.notif_respo = TRUE)
                                                               ')->fetchAll('assoc');

        $notif_respo = array();
        for($i=0;$i<count($test);$i++){
                $notif_respo[$i]['id'] = $test[$i]['id'];
                $notif_respo[$i]['commentaire'] = $test[$i]['nom_fr'].' '.$test[$i]['prenom_fr'].' de la filiere '.$test[$i]['libile'];
                $notif_respo[$i]['principale'] = $test[$i]['etat'];
                $notif_respo[$i]['titre'] = $test[$i]['type'];
                $notif_respo[$i]['date'] = $test[$i]['modified'];
                $notif_respo[$i]['lien'] = 'viewCertificatsEtudiants';
                switch ($test[$i]['etat']){
                            case 'Rejeter' : 
                                    $notif_respo[$i]['style']= "badge bg-red";
                                    break;
                            case 'En cours de traitement' : 
                                    $notif_respo[$i]['style']= "badge bg-yellow";
                                    break;
                            case 'Demande envoyé' : 
                                    $notif_respo[$i]['style']= "badge bg-light-blue";
                                    break;
                            case 'Prête' : 
                                    $notif_respo[$i]['style']= "badge bg-green";
                                    break;
                            case 'Délivré' : 
                                    $notif_respo[$i]['style']= "badge bg-navy";
                                    break;
                            } 
        }
        $session = $this->request->session();
        $session->write('notifications', $notif_respo);

        $this->render('/Element/notification');
    }


}

?>