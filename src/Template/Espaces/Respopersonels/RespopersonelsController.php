<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use PhpParser\Node\Expr\Empty_;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;



class RespopersonelsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    public function index()
    {
        $usrole = $this->Auth->user('role');
        $this->set('role', $usrole);
        $this->render('/Espaces/respopersonels/home');
    }


                                             //PARTIE IBTISSAM


//RECHERCHE DU FONCTIONNAIRE
/*public function rechercheActivite()
{
    $this->render('/Espaces/respopersonels/rechercheActivite');
}
public function trierActivite()
{
    $dsn = 'mysql://root:password@localhost/ensaksite';
    $con= ConnectionManager::get('default', ['url' => $dsn]);
    $search=$_POST['search'];

    $query=$con->execute("SELECT * FROM activites WHERE nomActivite LIKE '%" .$search. "%'")->fetchAll('assoc');
    $this->set('query',$query);
    $this->render('/Espaces/respopersonels/trierActivite');
}*/

    //RECHERCHER UN FONCTIONNAIRE
    
    public function fonc(){

        $this->set(compact('fonctionnaires'));
        $this->render('/Espaces/respopersonels/fonc');

    }
    public function filterfonc($limit=100)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $cat=$_POST['cat'];

        switch($_POST['recherche'])
        {
            case "id":
            {$fonctionnaires=$con->execute("SELECT * FROM fonctionnaires WHERE id LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('fonctionnaires',$fonctionnaires);
                break;}
            case "nom_fct":
            {
                $fonctionnaires=$con->execute("SELECT * FROM fonctionnaires WHERE nom_fct LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('fonctionnaires',$fonctionnaires);
                break;
            }
            case "somme":
            {
                $fonctionnaires=$con->execute("SELECT * FROM fonctionnaires WHERE somme LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('fonctionnaires',$fonctionnaires);
                break;
            }
            case "prenom_fct":
            {
                $fonctionnaires=$con->execute("SELECT * FROM fonctionnaires WHERE prenom_fct LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('fonctionnaires',$fonctionnaires);
                break;
            }
            case "specialite":
            {
                $fonctionnaires=$con->execute("SELECT * FROM fonctionnaires WHERE specialite LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('fonctionnaires',$fonctionnaires);
                break;
            }
            case "echelle":
            {
                $fonctionnaires=$con->execute("SELECT * FROM fonctionnaires WHERE echelle LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('fonctionnaires',$fonctionnaires);
                break;
            }
            case "age":
            {
                $fonctionnaires=$con->execute("SELECT * FROM fonctionnaires WHERE age LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('fonctionnaires',$fonctionnaires);
                break;
            }
            case "genre":
            {
                $fonctionnaires=$con->execute("SELECT * FROM fonctionnaires WHERE genre LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('fonctionnaires',$fonctionnaires);
                break;
            }
            case "date Recrutement":
            {
                $fonctionnaires=$con->execute("SELECT * FROM fonctionnaires WHERE date_Recrut LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('fonctionnaires',$fonctionnaires);
                break;
            }
            default:
                echo "la requete demandée n'existe pas";
        }

        $this->render('/Espaces/respopersonels/filtrerfonc');

    }

    //SERVICES D'UN FONCTIONNAIRE
    public function listerFonctParService()
    {
        $this->paginate = ['contain' => ['Fonctionnaires', 'Services']];
        $FonctionnairesServices = TableRegistry::get('FonctionnairesServices');
        $FonctionnairesServices = $this->paginate($FonctionnairesServices->find('all', array(
            "joins" => array(
                array(
                    "table" => "Fonctionnaires",
                    "conditions" => array(
                        "FonctionnairesServices.fonctionnaire_id=Fonctionnaires.id")
                )
            ),
            'conditions' => array('Fonctionnaires.id'))));
        $this->set(compact('FonctionnairesServices'));
        $this->set('__serialize', ['FonctionnairesServices']);
        $this->render('/Espaces/respopersonels/listerFonctParService');
    }
    public function editService($id = null)
    {
        $FonctionnairesServices=TableRegistry::get('FonctionnairesServices');
        $fonctionnairesService = $FonctionnairesServices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fonctionnairesService = $FonctionnairesServices->patchEntity($fonctionnairesService, $this->request->data);
            if ($FonctionnairesServices->save($fonctionnairesService)) {
                $this->Flash->success(__('Modification réussite'));

                return $this->redirect(['action' => 'listerFonctParService']);
            }
            $this->Flash->error(__('Le fonctionnaire ne peut pas etre sauvegardé '));
        }
        $this->set(compact('fonctionnairesService'));
        $this->set('_serialize', ['fonctionnairesService']);
        $this->render('/Espaces/respopersonels/editService');
    }
     public function statipermanent(){
     $profpermanents = TableRegistry::get('profpermanentsGrades');
        $profpermanent = $profpermanents->newEntity();
        $profpermanent = $profpermanents->patchEntity($profpermanent, $this->request->data);
        $profdeps = TableRegistry::get('profpermanentsDepartements');
        $profdep = $profdeps->newEntity();
        $profdep = $profdeps->patchEntity($profdep, $this->request->data);

        
        $profpermanent = $profpermanents->find('all',[
            'fields' => [
            'grd' => 'Grades.nomGrade',
            'nbrGrades' => 'COUNT(profpermanentsGrades.profpermanent_id)'],
            'contain'=>['Grades'],'group' => ['profpermanentsGrades.grade_id'],
        ]);

        $profpermanentdep = $profdeps->find('all',[
            'fields' => [
            'dep' => 'Departements.nom_departement',
            'nbrDep' => 'COUNT(profpermanentsDepartements.profpermanent_id)'],
            'contain'=>['Departements'],'group' => ['profpermanentsDepartements.departement_id'],
        ]);

        
        $this->set(compact('profpermanent','profpermanentdep'));
        $this->set('_serialize', ['profpermanent','profpermanentdep']);
        $this->render('/Espaces/respopersonels/statipermanent');


}
    public function viewService($id1=null,$id2=null,$id3=null)
    {
        $services=TableRegistry::get('Services');
        $fonctionnaireService=TableRegistry::get('FonctionnairesServices');
        $fonctionnaires=TableRegistry::get('Fonctionnaires');
        $fonctionnaire = $fonctionnaires->get($id1, [
            'contain' => []
        ]);
        $service = $services->get($id2, [
            'contain' => []
        ]);
        $fonctionnaireServ = $fonctionnaireService->get($id3, [
            'contain' => []
        ]);

        $this->set('fonctionnaire', $fonctionnaire);
        $this->set('_serialize', ['fonctionnaire']);
        $this->set('service', $service);
        $this->set('_serialize', ['fonctionnaireServ']);
        $this->set('fonctionnaireServ', $fonctionnaireServ);
        $this->set('_serialize', ['fonctionnaireServ']);
        $this->render('/Espaces/respopersonels/viewService');
    }
    public function deleteFonctService($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $FonctionnairesServices=TableRegistry::get('FonctionnairesServices');
        $fonctionnairesService = $FonctionnairesServices->get($id);
        if ($FonctionnairesServices->delete($fonctionnairesService)) {
            $this->Flash->success(__('The professeurs departement has been deleted.'));
        } else {
            $this->Flash->error(__('The professeurs departement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'listerFonctParService']);
    }
public function ajouterFonctParService()
{
    $Servs=TableRegistry::get('Services');
    $Foncts=TableRegistry::get('Fonctionnaires');
    $FonctionnairesServices=TableRegistry::get('FonctionnairesServices');
    $fonctionnairesService = $FonctionnairesServices->newEntity();

    if ($this->request->is('post')){
        $fonctionnairesService->fonctionnaire_id =$this->request->data('somme');
        $fonctionnairesService->service_id =$this->request->data('nomService');
        if ($FonctionnairesServices->save($fonctionnairesService)) {
            $this->Flash->success(__('The fonctionnaires service has been saved.'));

            return $this->redirect(['action' => 'listerFonctParService']);
        }
        $this->Flash->error(__('The fonctionnaires service  could not be saved. Please, try again.'));
    }


    $fonctionnaires = $FonctionnairesServices->Fonctionnaires->find('list', ['limit' => 200]);
    $services = $FonctionnairesServices->Services->find('list', ['limit' => 200]);
    $this->set(compact('fonctionnairesService', 'fonctionnaires', 'services'));
    $i=1;
    $queryFonct=$Foncts->find('all');
    foreach ($queryFonct as $query1)
    {
        $tabSomme[$i]=$query1->somme;
        $i++;
    }
    $j=1;
    $queryServs=$Servs->find('all');
    foreach ($queryServs as $query2)
    {
        $tabNom[$j]=$query2->nomService;
        $j++;
    }

    $this->set('sommetab',$tabSomme);
    $this->set('nomtab',$tabNom);
    $this->set('_serialize', ['fonctionnairesService']);$this->render('/Espaces/respopersonels/ajouterFonctParService');

}

// ACTIVITES D'UN FONCTIONNAIRE
    public function listerActivites()
    {
        $this->paginate = ['contain' => ['Activites', 'Fonctionnaires']];
        $FonctionnairesActivites = TableRegistry::get('FonctionnairesActivites');
        $FonctionnairesActivites = $this->paginate($FonctionnairesActivites->find('all', array(
            "joins" => array(
                array(
                    "table" => "Activites",
                    "conditions" => array(
                        "FonctionnairesActivites.activite_id=Activites.id")
                )
            ),
            'conditions' => array('Activites.id'))));
        $this->set(compact('FonctionnairesActivites'));
        $this->set('__serialize', ['FonctionnairesActivites']);
        $this->render('/Espaces/respopersonels/listerActivites');
    }

    public function viewActivite($id1 = null,$id2=null,$id3=null)
    {
        $activites=TableRegistry::get('Activites');
        $fonctActivs=TableRegistry::get('FonctionnairesActivites');
        $fonctionnaires=TableRegistry::get('Fonctionnaires');
        $fonctionnaire = $fonctionnaires->get($id1, [
            'contain' => []
        ]);
        $activite = $activites->get($id2, [
            'contain' => []
        ]);
        $fonctActif = $fonctActivs->get($id3, [
            'contain' => []
        ]);

        $this->set('fonctionnaire', $fonctionnaire);
        $this->set('_serialize', ['fonctionnaire']);
        $this->set('activite', $activite);
        $this->set('_serialize', ['activite']);
        $this->set('fonctActif', $fonctActif);
        $this->set('_serialize', ['fonctActif']);
        $this->render('/Espaces/respopersonels/viewActivite');
    }
public function ajouterFonctActivite()
{
    $Activs=TableRegistry::get('Activites');
    $Foncts=TableRegistry::get('Fonctionnaires');
    $FonctionnairesActivites=TableRegistry::get('FonctionnairesActivites');
    $fonctionnairesActivite = $FonctionnairesActivites->newEntity();

    if ($this->request->is('post')){
        $fonctionnairesActivite->fonctionnaire_id =$this->request->data('somme');
        $fonctionnairesActivite->activite_id =$this->request->data('nomActivite');
        //$fonctionnairesActivite->date_organisation =$this->request->data('date_organisation');

        if ($FonctionnairesActivites->save($fonctionnairesActivite)) {
            $this->Flash->success(__(" it's saved."));

            return $this->redirect(['action' => 'listerActivites']);
        }
        $this->Flash->error(__(' not be saved. Please, try again.'));
    }


    $fonctionnaires = $FonctionnairesActivites->Fonctionnaires->find('list', ['limit' => 200]);
    $activites = $FonctionnairesActivites->Activites->find('list', ['limit' => 200]);
    $this->set(compact('fonctionnairesActivite', 'fonctionnaires', 'activites'));
    $i=1;
    $queryFonct=$Foncts->find('all');
    foreach ($queryFonct as $query1)
    {
        $tabSomme[$i]=$query1->somme;
        $i++;
    }
    $j=1;
    $queryActivs=$Activs->find('all');
    foreach ($queryActivs as $query2)
    {
        $tabNom[$j]=$query2->nomActivite;
        $j++;
    }

    $this->set('sommetab',$tabSomme);
    $this->set('nomtab',$tabNom);
    $this->set('_serialize', ['fonctionnairesActivite']);
    $this->render('/Espaces/respopersonels/ajouterFonctActivite');


}
    public function deleteFonctActivite($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $FonctionnairesActivites=TableRegistry::get('FonctionnairesActivites');
        $fonctionnairesActivite = $FonctionnairesActivites->get($id);
        if ($FonctionnairesActivites->delete($fonctionnairesActivite)) {
            $this->Flash->success(__(' the Activity has been deleted.'));
        } else {
            $this->Flash->error(__(' the Activity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'listerActivites']);
    }
    public function editFonctActivite($id = null)
    {
        $FonctionnairesActivites=TableRegistry::get('FonctionnairesActivites');
        $fonctionnairesActivite = $FonctionnairesActivites->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fonctionnairesActivite = $FonctionnairesActivites->patchEntity($fonctionnairesActivite, $this->request->data);
            if ($FonctionnairesActivites->save($fonctionnairesActivite)) {
                $this->Flash->success(__('Modification réussite'));

                return $this->redirect(['action' => 'listerActivites']);
            }
            $this->Flash->error(__("L'Activité ne peut pas etre sauvegardé "));
        }
        $this->set(compact('fonctionnairesActivite'));
        $this->set('_serialize', ['fonctionnairesActivite']);
        $this->render('/Espaces/respopersonels/editFonctActivite');
    }

    //MOUVEMENT SERVICE
    public function mouvementService()
    {
        $this->paginate = ['contain' => ['Services', 'Fonctionnaires']];
        $FonctionnairesServices = TableRegistry::get('FonctionnairesServices');
        $FonctionnairesServices = $this->
        paginate($FonctionnairesServices->find('all',
            array(
                "joins" => array(
                    array(
                        "table" => "Services",
                        "conditions" => array( "FonctionnairesServices.service_id=Services.id") ),
                    array(
                        "table" => "Fonctionnaires",
                        "conditions" => array( "FonctionnairesServices.fonctionnaire_id=Fonctionnaires.id") ),

                    'conditions' => array('Services.id')))));
        $this->set(compact('FonctionnairesServices'));
        $this->set('__serialize', ['FonctionnairesServices']);
        $this->render('/Espaces/respopersonels/mouvementService');

    }
    public function viewMouvement($id1=null,$id2=null,$id3=null)
    {
        $services = TableRegistry::get('Services');
        $fonctionnaireService = TableRegistry::get('FonctionnairesServices');
        $fonctionnaires = TableRegistry::get('Fonctionnaires');
        $fonctionnaire = $fonctionnaires->get($id1, [
            'contain' => []
        ]);
        $service = $services->get($id2, [
            'contain' => []
        ]);
        $fonctionnaireServ = $fonctionnaireService->get($id3, [
            'contain' => []
        ]);

        $this->set('fonctionnaire', $fonctionnaire);
        $this->set('_serialize', ['fonctionnaire']);
        $this->set('service', $service);
        $this->set('_serialize', ['fonctionnaireServ']);
        $this->set('fonctionnaireServ', $fonctionnaireServ);
        $this->set('_serialize', ['fonctionnaireServ']);
        $this->render('/Espaces/respopersonels/viewMouvement');
    }

    public function deleteMouvement($id= null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $FonctionnairesServices=TableRegistry::get('FonctionnairesServices');
        $fonctionnairesService = $FonctionnairesServices->get($id);
        if ($FonctionnairesServices->delete($fonctionnairesService)) {
            $this->Flash->success(__('The Mouvement has been deleted.'));
        } else {
            $this->Flash->error(__('The Mouvement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'deleteMouvement']);
    }
    public function editMouvement($id=null)
    {
        $FonctionnairesServices=TableRegistry::get('FonctionnairesServices');
        $fonctionnairesService = $FonctionnairesServices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fonctionnairesService = $FonctionnairesServices->patchEntity($fonctionnairesService, $this->request->data);
            if ($FonctionnairesServices->save($fonctionnairesService)) {
                $this->Flash->success(__('Modification réussite'));

                return $this->redirect(['action' => 'mouvementService']);
            }
            $this->Flash->error(__('Le fonctionnaire ne peut pas etre sauvegardé '));
        }
        $this->set(compact('fonctionnairesService'));
        $this->set('_serialize', ['fonctionnairesService']);
        $this->render('/Espaces/respopersonels/editMouvement');
    }
    public function ajouterMvtService()
    {
        $Servs=TableRegistry::get('Services');
        $Foncts=TableRegistry::get('Fonctionnaires');
        $FonctionnairesServices=TableRegistry::get('FonctionnairesServices');
        $fonctionnairesService = $FonctionnairesServices->newEntity();

        if ($this->request->is('post')){
            $fonctionnairesService->fonctionnaire_id =$this->request->data('somme');
            $fonctionnairesService->service_id =$this->request->data('nomService');
            if ($FonctionnairesServices->save($fonctionnairesService)) {
                $this->Flash->success(__('The fonctionnaires service has been saved.'));

                return $this->redirect(['action' => 'listerFonctParService']);
            }
            $this->Flash->error(__('The fonctionnaires service  could not be saved. Please, try again.'));
        }


        $fonctionnaires = $FonctionnairesServices->Fonctionnaires->find('list', ['limit' => 200]);
        $services = $FonctionnairesServices->Services->find('list', ['limit' => 200]);
        $this->set(compact('fonctionnairesService', 'fonctionnaires', 'services'));
        $i=1;
        $queryFonct=$Foncts->find('all');
        foreach ($queryFonct as $query1)
        {
            $tabSomme[$i]=$query1->somme;
            $i++;
        }
        $j=1;
        $queryServs=$Servs->find('all');
        foreach ($queryServs as $query2)
        {
            $tabNom[$j]=$query2->nomService;
            $j++;
        }

        $this->set('sommetab',$tabSomme);
        $this->set('nomtab',$tabNom);
        $this->set('_serialize', ['fonctionnairesService']);$this->render('/Espaces/respopersonels/ajouterMvtService');
    }



}
?>