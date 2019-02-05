<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Phinx\Db\Table;
use PhpParser\Node\Expr\Empty_;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Session;
use Cake\Validation;

class RespopersonelsController extends AppController {

    public function beforeFilter(Event $event)
    {
// allow only login, forgotpassword
        $this->Auth->authorize = 'controller';
        $usrole = $this->Auth->user('role');
        if($usrole!='respopersonel' && $usrole!='admin')
        {

            $this->Flash->error(__('Vous ne pouvez pas acceder a ce lien'));
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'logout']
            );
        }
        $this->Auth->deny();

    }

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }
    // BOUHSISE YOUNESS DEBUT
    //2eme version
    public function tester()
    {
        $this->render('/Espaces/respopersonels/tester');

    }
    public function viewProfBis($id=null)
    {
        $Profpermanents=TableRegistry::get('Profpermanents');
        $profpermanent = $Profpermanents->get($id, [
            'contain' => ['Activites', 'Departements', 'Disciplines', 'Grades']
        ]);

        $this->set('profpermanent', $profpermanent);
        $this->set('_serialize', ['profpermanent']);
        $this->render('/Espaces/respopersonels/viewProfBis');

    }
    public function affecterProfDiscipline()
    {

    }
    public function listerDisciplines()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);

        if(isset($_POST['chercherDisc']))
        {
            echo 'oi';
            $indice=$_POST['chercherDisc'];
            $disciplines=$con->prepare("SELECT pp.nom_prof as nomprof , pp.prenom_prof as prenomprof,e.id as IDe , m.libile as module ,pp.id ,pp.somme ,e.libile as element ,ans.libile as AN,s.libile as semestre,
      n.libile as niveau,f.libile as filiere from  modules m,groupes g,filieres f,niveaus n,profpermanents pp,elements e,annee_scolaires ans,semestres s, 
      enseigners en where  pp.id=en.profpermanent_id and e.id=en.element_id and ans.id=en.annee_scolaire_id and s.id=en.semestre_id 
         and g.niveaus_id=n.id and g.filiere_id=f.id and e.module_id=m.id AND m.groupe_id=g.id and (pp.nom_prof like ? or pp.prenom_prof like
        ? or pp.somme like ? or f.libile like ? or n.libile like ? or m.libile like ? or e.libile like ? )");
            $disciplines->execute(array('%'.$indice.'%','%'.$indice.'%','%'.$indice.'%','%'.$indice.'%','%'.$indice.'%','%'.$indice.'%','%'.$indice.'%'));


        }
        else
        {
            $disciplines=$con->execute("SELECT pp.nom_prof as nomprof , pp.prenom_prof as prenomprof,e.id as IDe , m.libile as module ,pp.id ,pp.somme ,e.libile as element ,ans.libile as AN,s.libile as semestre,
      n.libile as niveau,f.libile as filiere from  modules m,groupes g,filieres f,niveaus n,profpermanents pp,elements e,annee_scolaires ans,semestres s, 
      enseigners en where  pp.id=en.profpermanent_id and e.id=en.element_id and ans.id=en.annee_scolaire_id and s.id=en.semestre_id 
         and g.niveaus_id=n.id and g.filiere_id=f.id and e.module_id=m.id AND m.groupe_id=g.id");
        }


        $this->set(compact('disciplines'));
        $this->set('_serialize', ['disciplines']);
        $this->render('/Espaces/respopersonels/listerDisciplines');

    }
    public function deleteDiscipline($id=null)
    {
        $Enseigners=TableRegistry::get('Enseigners');
        $this->request->allowMethod(['post', 'delete']);
        $enseigner = $Enseigners->get($id);
        if ($Enseigners->delete($enseigner)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Enseigner'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Enseigner'));
        }
        return $this->redirect(['action' => 'listerDisciplines']);

    }


    //Rechercher Prof
    public function rechercher()
    {
        $this->paginate = [
            'contain' => ['Profpermanents', 'Grades']
        ];
        $ProfpermanentsGrades=TableRegistry::get('ProfpermanentsGrades');


        if(isset($_POST['chercherProf']))
        {
            $indice=$_POST['chercherProf'];
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades->find('all')->where(['OR'=>
                ['Grades.nomGrade like '=>'%'.$indice.'%',' profpermanents.nom_prof like'=>'%'.$indice.'%'
                    ,' profpermanents.prenom_prof like'=>'%'.$indice.'%',' profpermanents.Lieu_Naissance like'=>'%'.$indice.'%',
                    'profpermanents.somme like '=>'%'.$indice.'%']]));
        }
        else
        {
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades);
        }



        $this->set(compact('profpermanentsGrades'));
        $this->set('_serialize', ['profpermanentsGrades']);
        /*$professeurs=TableRegistry::get('Profpermanents');
        if(isset($_POST['chercherProf'])) {
            $search = $_POST['chercherProf'];
            $profpermanents = $professeurs->find('all')->where(['OR'=>['nom_prof like' => '%' . $search . '%',
                'somme like' => '%' . $search . '%','prenom_prof like' => '%' . $search . '%',
                'Lieu_Naissance like' => '%' . $search . '%',]]);
        }
        else{
            $profpermanents = $professeurs->find('all');

        }

        $this->set(compact('profpermanents'));
        $this->set('_serialize', ['profpermanents']);*/
        $this->render('/Espaces/respopersonels/rechercher');
    }
    //FIN RECHERCHER PROF
    //2eme version
    //Grades Traitement
    public function listerGrade()
    {
        $this->paginate = [
            'contain' => ['Profpermanents', 'Grades']
        ];
        $ProfpermanentsGrades=TableRegistry::get('ProfpermanentsGrades');


        if(isset($_POST['gradeCherch']))
        {
            $indice=$_POST['gradeCherch'];
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades->find('all')->where(['OR'=>
                ['Grades.nomGrade like '=>'%'.$indice.'%',' profpermanents.nom_prof like'=>'%'.$indice.'%',
                    ' profpermanents.prenom_prof like'=>'%'.$indice.'%',' profpermanentsGrades.sous_grade like'=>'%'.$indice.'%',
                    ' profpermanentsGrades.echelon like'=>'%'.$indice.'%']]));
        }
        else
        {
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades);
        }



        $this->set(compact('profpermanentsGrades'));
        $this->set('_serialize', ['profpermanentsGrades']);
        $this->render('/Espaces/respopersonels/listerGrade');

    }
    public function affecterGradeProf()
    {
        $grrades=TableRegistry::get('Grades');
        $Profs=TableRegistry::get('Profpermanents');
        $profpermanentsGrades=TableRegistry::get('ProfpermanentsGrades');
        $profpermanentsGrade = $profpermanentsGrades->newEntity();
        //debug($this->request);
        /* foreach ($this->request->data('Date_debut')as $date)
         {
             $year=$date['year'];
             $month=$date['month'];
             $day=$date['day'];
         }*/
        if ($this->request->is('post')){
            //  $profpermanentsGrade->profpermanent_id =$this->request->data('nomSomme');

            $profpermanentsGrade->sous_grade=$this->request->data('sousgrade');
            $profpermanentsGrade->echelon=$this->request->data('echelon');
            $profpermanentsGrade->date_grade =$_POST['date_grade'];


            $req=$Profs->find('all')->select('id');
            $req1=$grrades->find('all')->select('id');

            $i=1;
            //debug($this->request->data('somme'));

            foreach($req as $ligne)
            {
                echo 'i='.$i;
                if($i==$this->request->data('somme'))
                {
                    $ID=$ligne->id;
                    break;

                }
                $i++;
            }
            $j=1;
            foreach($req1 as $ligne)
            {

                if($j==$this->request->data('grade'))
                {
                    $IDGRADE=$ligne->id;
                    break;

                }
                $j++;
            }
            $req3=$profpermanentsGrades->find('all')->select('id')->where(['ProfpermanentsGrades.profpermanent_id'=>$ID,
                'ProfpermanentsGrades.grade_id'=>$IDGRADE,'ProfpermanentsGrades.sous_grade'=>$this->request->data('sousgrade'),
                'ProfpermanentsGrades.echelon'=>$this->request->data('echelon')]);
            $nb=0;
            foreach($req3 as $existant)
            {
                $nb++;
            }

            $profpermanentsGrade->profpermanent_id =$ID;
            $profpermanentsGrade->grade_id =$IDGRADE;
            if($nb==1)
            {
                $this->Flash->error(__('ERREUR...Ce professeur est déja passé par ce grade , cette classe et cet échelon ! '));

            }
            elseif ($profpermanentsGrades->save($profpermanentsGrade)) {
                $this->Flash->success(__('Grade bien enregistré'));

                return $this->redirect(['action' => 'listerGrade']);
            }else{
                $this->Flash->error(__('Affectation Grade échouée'));

            }
        }


        $profpermanents = $profpermanentsGrades->profpermanents->find('list', ['limit' => 200]);
        $grades = $profpermanentsGrades->Grades->find('list', ['limit' => 200]);
        $this->set(compact('profpermanentsGrade', 'profpermanents', 'grades'));
        $i=1;
        $queryProf=$Profs->find('all');
        foreach ($queryProf as $query1)
        {
            $tabSomme[$i]=$query1->somme;
            $i++;
        }
        $j=1;
        $queryGrades=$grrades->find('all');
        foreach ($queryGrades as $query2)
        {
            $tabNom[$j]=$query2->nomGrade;
            $j++;
        }

        $this->set('sommetab',$tabSomme);
        $this->set('nomtab',$tabNom);
        $this->set('_serialize', ['profpermanentsGrade']);
        $this->render('/Espaces/respopersonels/affecterGradeProf');
    }
    public function viewEvolution($id=null)
    {
        $this->paginate = [
            'contain' => ['Profpermanents', 'Grades']
        ];
        $ProfpermanentsGrades=TableRegistry::get('ProfpermanentsGrades');
        $profpermanentsGrade = $this->paginate($ProfpermanentsGrades->find("all", array(
                "joins" => array(
                    array(
                        "table" => "profpermanents",
                        "conditions" => array(
                            "ProfpermanentsGrades.profpermanent_id = Profpermanents.id"
                        )
                    ),
                    array(
                        "table" => "Grades",
                        "conditions" => array(
                            "ProfpermanentsGrades.grade_id = Grades.id"
                        )
                    )
                ),
                'conditions' => array(
                    'ProfpermanentsGrades.profpermanent_id' => $id)
            )
        ));

        $this->set(compact('profpermanentsGrade'));
        $this->set('_serialize', ['profpermanentsGrade']);
        $this->render('/Espaces/respopersonels/viewEvolution');
    }
    //Rechercher

    //Traitement Activites
    public function afficherEvent()
    {
        $this->paginate = [
            'contain' => ['Profpermanents', 'Activites']
        ];
        $ProfpermanentsActivites=TableRegistry::get('ProfpermanentsActivites');
        if(isset($_POST['activiteCherch']))
        {
            $indice=$_POST['activiteCherch'];
            $profpermanentsActivites = $this->paginate($ProfpermanentsActivites->find('all')->where(['Activites.nomActivite
             like '=>'%'.$indice.'%']));
        }
        else{
            $profpermanentsActivites = $this->paginate($ProfpermanentsActivites);
        }


        $this->set(compact('profpermanentsActivites'));
        $this->set('_serialize', ['profpermanentsActivites']);
        $this->render('/Espaces/respopersonels/afficherEvent');

    }
    public function affecterProfEvnt()
    {
        $activities=TableRegistry::get('Activites');
        $Profs=TableRegistry::get('Profpermanents');
        $profpermanentsActivites=TableRegistry::get('ProfpermanentsActivites');
        $profpermanentsActivite = $profpermanentsActivites->newEntity();
        //debug($this->request);
        /* foreach ($this->request->data('Date_debut')as $date)
         {
             $year=$date['year'];
             $month=$date['month'];
             $day=$date['day'];
         }*/
        if ($this->request->is('post')){

            $profpermanentsActivite->poste_comite =$this->request->data('poste_comite');
            $req=$Profs->find('all')->select('id');
            $req1=$activities->find('all')->select('id');
            $i=1;
            // debug($this->request->data('somme'));

            foreach($req as $ligne)
            {
                echo 'i='.$i;
                if($i==$this->request->data('somme'))
                {
                    $ID=$ligne->id;
                    break;

                }
                $i++;

            }
            $j=1;
            foreach($req1 as $ligne)
            {

                if($j==$this->request->data('nomActivite'))
                {
                    $IDACT=$ligne->id;
                    break;

                }
                $j++;

            }
            $profpermanentsActivite->activite_id =$IDACT;

            $profpermanentsActivite->profpermanent_id =$ID;
            $req3=$profpermanentsActivites->find('all')->select('id')->where(['ProfpermanentsActivites.profpermanent_id'=>$ID,
                'ProfpermanentsActivites.activite_id'=>$IDACT]);
            $nb=0;
            foreach ($req3 as $existant) {
                $nb++;

            }
            if($nb==1)
            {
                $this->Flash->error(__('Erreur ... Ce Professeur appartient déja au comité de cet événement !'));

            }
            elseif ($profpermanentsActivites->save($profpermanentsActivite)) {
                $this->Flash->success(__('Activité affectée'));

                return $this->redirect(['action' => 'afficherEvent']);
            }else{
                $this->Flash->error(__('Affectation échouée'));

            }
        }


        $profpermanents = $profpermanentsActivites->Profpermanents->find('list', ['limit' => 200]);
        $activites = $profpermanentsActivites->Activites->find('list', ['limit' => 200]);
        $this->set(compact('profpermanentsActivite', 'profpermanents', 'activites'));
        $i=1;
        $queryProf=$Profs->find('all');
        foreach ($queryProf as $query1)
        {
            $tabSomme[$i]=$query1->somme;
            $i++;
        }
        $j=1;
        $queryActivites=$activities->find('all');
        foreach ($queryActivites as $query2)
        {
            $tabNom[$j]=$query2->nomActivite;
            $j++;
        }

        $this->set('sommetab',$tabSomme);
        $this->set('nomtab',$tabNom);
        $this->set('_serialize', ['profpermanentsActivite']);
        $this->render('/Espaces/respopersonels/affecterProfEvnt');

    }
    public function listerOrganisateur($id=null)
    {
        $this->paginate = [
            'contain' => ['Profpermanents', 'Activites']
        ];
        $profpermanentsActivites=TableRegistry::get('ProfpermanentsActivites');
        $profpermanentsActivite = $this->paginate($profpermanentsActivites->find("all", array(
                "joins" => array(
                    array(
                        "table" => "Profpermanents",
                        "conditions" => array(
                            "ProfpermanentsActivites.profpermanent_id = Profpermanents.id"
                        )
                    ),
                    array(
                        "table" => "Activites",
                        "conditions" => array(
                            "ProfpermanentsActivites.activite_id = Activites.id"
                        )
                    )
                ),
                'conditions' => array(
                    'profpermanentsActivites.activite_id' => $id)
            )
        ));

        $this->set(compact('profpermanentsActivite'));
        $this->set('_serialize', ['profpermanentsActivite']);
        $this->render('/Espaces/respopersonels/listerOrganisateur');
    }
    public function add()
    {
        $Activites = TableRegistry::get('Activites');
//echo WWW_ROOT.'admin_l_t_e'.DS.'img';

        $activite = $Activites->newEntity();

        if ($this->request->is('post')) {


            $activite->nomActivite=$this->request->data('nomActivite');
            $activite->dateDebut=$_POST['dateDebut'];
            $activite->dateFin=$_POST['dateFin'];
            $activite->photo=$_FILES['photoAct']['name'];



            $extensions_valides = array( 'jpg' , 'jpeg','png' );
            $extension_upload = strtolower(  substr(  strrchr($_FILES['photoAct']['name'], '.')  ,1)  );





            $req=$Activites->find('all')->select('id')->where(['nomActivite'=>$this->request->data('nomActivite')]);
            $nb=0;
            foreach($req as $existant)
            {
                $nb++;
            }
            if($nb==1)
            {
                $this->Flash->error(__('Erreur .. Cette activité est déja organisé , si c\'est une autre édition Merci de  l\'ajouter dans le nom , MERCI!'));

            }
            elseif( !in_array($extension_upload,$extensions_valides) )
            {

                $this->Flash->error(__('Veuillez choisir l\'extension  : JPEG , JPG Ou PNG , MERCI!'));
                return $this->redirect(['action' => 'add']);



            }
            elseif ($Activites->save($activite)) {

                $photo = $_FILES['photoAct']['name'];
                $phototempo = $_FILES['photoAct']['tmp_name'];
                //debug($photo);
                move_uploaded_file($phototempo, WWW_ROOT.DS.'/img'.DS.$photo);

                $this->Flash->success(__('Activité Bien Ajoute '));
                return $this->redirect(['action' => 'add']);
            }else {
                $this->Flash->error(__('Erreur .. Veuillez essayer un autre fois !'));
            }
        }
        $this->set(compact('activite'));
        $this->set('_serialize', ['activite']);
        $this->render('/Espaces/respopersonels/add');
    }
    public function index() {
        //Debut Bouhsise
        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        //debug($this->Auth->user('id'));
        //2eme version
        $Departements=TableRegistry::get('Departements');
        $depars=$Departements->find('all');
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);

        $nbAttes=$con->execute('select count(id) as nbAttest from profpermanents_documents pd where pd.document_id=1');
        $nbFiche=$con->execute('select count(id) as nbFiche from profpermanents_documents pd where pd.document_id=2');
        $nbAbsence=$con->execute('select count(id) as nbAbscence from profpermanents_documents pd where pd.document_id=3');
        $nbDemande=$con->execute('select count(id) as nbDemande from profpermanents_documents pd where pd.etatdemande=\'Demande envoyé\'');
        $nbDelivre=$con->execute('select count(id) as nbDemande from profpermanents_documents pd where pd.etatdemande=\'Delivré\'');
        $nbEnCours=$con->execute('select count(id) as nbDemande from profpermanents_documents pd where pd.etatdemande=\'En cours de traitement\'');
        $nbPrete=$con->execute('select count(id) as nbDemande from profpermanents_documents pd where pd.etatdemande=\'Prete\'');

        // debug($nbAttes);
        foreach($nbDelivre as $ligne)
        {
            $nbDelivre=$ligne['nbDemande'];
        }
        foreach($nbEnCours as $ligne)
        {
            $nbEnCours=$ligne['nbDemande'];
        }
        foreach($nbPrete as $ligne)
        {
            $nbPrete=$ligne['nbDemande'];
        }
        $this->set('nbDelivre',$nbDelivre);
        $this->set('nbEnCours',$nbEnCours);
        $this->set('nbPrete',$nbPrete);
        foreach($nbAttes as $ligne)
        {
            $nbAttes=$ligne['nbAttest'];
        }
        foreach($nbDemande as $ligne)
        {
            $nbDemande=$ligne['nbDemande'];
        }
        foreach($nbFiche as $ligne)
        {
            $nbFiche=$ligne['nbFiche'];
        }
        foreach($nbAbsence as $ligne)
        {
            $nbAbsence=$ligne['nbAbscence'];
        }
        $this->set('nbDemande',$nbDemande);
        $this->set('nbAttest',$nbAttes);
        $this->set('nbFiche',$nbFiche);
        $this->set('nbAbscence',$nbAbsence);
        $this->paginate = [
            'contain' => ['Profpermanents', 'Documents']
        ];
        $ProfpermanentsDocuments=TableRegistry::get('ProfpermanentsDocuments');
        $profpermanentsDocuments = $this->paginate($ProfpermanentsDocuments);
        $lastDemande=$con->execute('select * from profpermanents p,documents d , profpermanents_documents pd where pd.document_id=d.id 
                                     and pd.profpermanent_id=p.id and pd.etatdemande=\'Demande envoyé\' ORDER by pd.id DESC LIMIT 9');
        $this->set('lastDemande',$lastDemande);

        $this->set(compact('profpermanentsDocuments'));
        $this->set('_serialize', ['profpermanentsDocuments']);
        $this->render('/Espaces/respopersonels/statistiques');
        $this->set(compact('departements'));
        $this->set('__serialize',['departements']);
        //fin 2eme version


        //FIN BOUHSISE
        //Debut Kawtar


        $demandes = $con->execute("SELECT fonctionnaires.nom_fct, absences.fonctionnaire_id, fonctionnaires.prenom_fct,grades.codeGrade, services.nom_service,absences.duree_ab,absences.date_ab,absences.time_ab,absences.cause FROM absences,fonctionnaires,grades,services, fonctionnaires_grades, fonctionnaires_services WHERE isvalid = 0 AND fonctionnaires_grades.fonctionnaire_id = fonctionnaires.id AND fonctionnaires_grades.grade_id = grades.id AND fonctionnaires_services.fonctionnaire_id = fonctionnaires.id AND fonctionnaires_services.service_id = services.id AND absences.fonctionnaire_id = fonctionnaires.id")->fetchAll("assoc");
        if(!empty($demandes)) {
            $this->set("demandes", $demandes);
        }
        $this->render('/Espaces/respopersonels/home');
    }

    //2EME VERSION
    public function indexProf()
    {
        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        debug($this->Auth->user('id'));
        $this->render('/Espaces/respopersonels/homeProf');

    }
    //finn 2EME VERSION

    //Traitement Docment Youness Bouhsise
    public function deleteDocument($id = null,$id2=null)
    {
        $ProfpermanentsDocuments=TableRegistry::get('ProfpermanentsDocuments');
        $this->request->allowMethod(['post', 'delete']);
        $profpermanentsDocument = $ProfpermanentsDocuments->get($id);
        if ($ProfpermanentsDocuments->delete($profpermanentsDocument)) {
            $this->Flash->success(__('Demande Bien Supprimé'));
        } else {
            $this->Flash->error(__('Erreur , Suppression echouée'));
        }
        $this->consultationDemande($id2);
    }
    public function testerBis()
    {
        $this->render('/Espaces/respopersonels/testerBis');


    }
    public function voirDocument()
    {
        $this->paginate = [
            'contain' => ['Profpermanents', 'Documents']
        ];
        $ProfpermanentsDocuments=TableRegistry::get('ProfpermanentsDocuments');
        $ProfpermanentsDocuments = $this->paginate($ProfpermanentsDocuments);

        $this->set(compact('ProfpermanentsDocuments'));
        $this->set('_serialize', ['ProfpermanentsDocuments']);
        $this->render('/Espaces/respopersonels/voirDocument');

    }
    public function consultationDemande($id=null)
    {
        $this->paginate = [
            'contain' => ['Profpermanents', 'Documents']
        ];
        $ProfpermanentsDocuments = TableRegistry::get('ProfpermanentsDocuments');
        $profpermanentsDocuments = $this->paginate($ProfpermanentsDocuments->find("all", array(
                "joins" => array(
                    array(
                        "table" => "Profpermanents",
                        "conditions" => array(
                            "ProfpermanentsDocuments.profpermanent_id = Profpermanents.id"
                        )
                    ),
                    array(
                        "table" => "Documents",
                        "conditions" => array(
                            "ProfpermanentsDocuments.document_id = Documents.id"
                        )
                    )
                ),
                'conditions' => array(
                    'ProfpermanentsDocuments.profpermanent_id' => $id)
            )
        ));
        $comp=0;
        foreach ($profpermanentsDocuments as $ligne) {
            if ($ligne->etatdemande == 'Demande envoyé') {
                $comp++;
            }
        }

        $_SESSION['nouveaudemande']=$comp;
        $this->set(compact('profpermanentsDocuments'));
        $this->set('_serialize', ['profpermanentsDocuments']);
        $this->render('/Espaces/respopersonels/consultationDemande');
    }
    public function voirNouveau()
    {
        $this->paginate = [
            'contain' => ['Profpermanents', 'Documents']
        ];
        $ProfpermanentsDocuments=TableRegistry::get('ProfpermanentsDocuments');
        $ProfpermanentsDocuments = $this->paginate($ProfpermanentsDocuments);
        $this->set(compact('ProfpermanentsDocuments'));
        $this->set('_serialize', ['ProfpermanentsDocuments']);
        $this->render('/Espaces/respopersonels/voirNouveau');

    }

    public function approuverDemande($id1=null,$id2=null)
    {
        $ProfpermanentsDocuments=TableRegistry::get('ProfpermanentsDocuments');
        $query=$ProfpermanentsDocuments->find('all')->update()->set(['etatdemande' => 'En cours de traitement'])->where(['document_id' => $id1,'profpermanent_id'=>$id2]);
        $query->execute();
        $this->consultationDemande($id2);
    }
    public function imprimerDocument($id1=null,$id2=null)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);

        $gradeAssoc=$con->execute('select g.nomGrade from grades g,profpermanents_grades pg where g.id=pg.grade_id and pg.profpermanent_id='.$id2);
        $count=count($gradeAssoc);
        $this->set('nbGrade',count($gradeAssoc));
        $this->set('tabGrade',$gradeAssoc);
        // debug($count);
        $this->paginate = [
            'contain' => ['Profpermanents', 'Documents']
        ];
        $ProfpermanentsDocuments=TableRegistry::get('ProfpermanentsDocuments');
        $query=$ProfpermanentsDocuments->find('all')->update()->set(['etatdemande' => 'Prete'])->where(['document_id' => $id1,'profpermanent_id'=>$id2]);
        $query->execute();
        $profpermanentsDocuments = $this->paginate($ProfpermanentsDocuments->find("all", array(
                "joins" => array(
                    array(
                        "table" => "Profpermanents",
                        "conditions" => array(
                            "ProfpermanentsDocuments.profpermanent_id = Profpermanents.id"
                        )
                    ),
                    array(
                        "table" => "Documents",
                        "conditions" => array(
                            "ProfpermanentsDocuments.document_id = Documents.id"
                        )
                    )
                ),
                'conditions' => array(
                    'ProfpermanentsDocuments.document_id' => $id1,'ProfpermanentsDocuments.profpermanent_id'=>$id2)
            )
        ));

        switch($id1)
        {
            case 1:
            {
                $this->set(compact('profpermanentsDocuments'));
                $this->set('_serialize', ['profpermanentsDocuments']);
                $this->render('/Espaces/respopersonels/imprimerAttest');
                break;

            }
            case 2:
            {
                $this->set(compact('profpermanentsDocuments'));
                $this->set('_serialize', ['profpermanentsDocuments']);
                $this->set('_serialize', ['profpermanentsDocuments']);
                $this->consultationDemande($id2);
                break;

            }
            case 3:
            {
                $this->set(compact('profpermanentsDocuments'));
                $this->set('_serialize', ['profpermanentsDocuments']);
                $this->render('/ProfpermanentsDocuments/imprimerDemande');
                break;

            }
        }

    }

    //Espace Prof Bouhsise Youness demande doc
    public function demanderDoc()
    {
        $ProfpermanentsDocuments=TableRegistry::get('ProfpermanentsDocuments');
        $documentsProfesseur = $ProfpermanentsDocuments->newEntity();
        $documentbis=TableRegistry::get('Documents');
        $documentbis=$documentbis->find('all');
        $profbis=TableRegistry::get('Profpermanents');
        $profbis=$profbis->find('all');
        $idUser=$this->Auth->user('id');
        $profpermanents=TableRegistry::get('Profpermanents');
        $query=$profpermanents->find('all')->select('id')->where(['user_id'=>$idUser]);

        foreach($query as $ligne)
        {
            $usrid=$ligne->id;
        }

        if ($this->request->is('post')){

            $documentsProfesseur->profpermanent_id =$usrid;
            $documentsProfesseur->document_id =$this->request->data('nomDoc');
            //requete pour une demande déja effectué
            $requete = $ProfpermanentsDocuments->find('all',array('conditions' => array('ProfpermanentsDocuments.profpermanent_id' => $usrid
            ,   'ProfpermanentsDocuments.document_id' => $this->request->data('nomDoc'))));
            $nombre=0;
            foreach($requete as $resultat)
            {
                if($resultat->etatdemande=='Demande envoyé' or $resultat->etatdemande=='Prete' or $resultat->etatdemande=='En cours de traitement')
                {
                    $nombre++;
                }
            }
            debug($nombre);
            $Profpermanents=TableRegistry::get('Profpermanents');
            $identifiantDoc=$this->request->data('nomDoc');

            switch($identifiantDoc)
            {
                case 1:
                {
                    $nbtentativebis=$Profpermanents->find('all')->select('etat_attestation')->where(['id'=>$usrid]);
                    foreach ($nbtentativebis as $value) {
                        $nombrebis=$value->etat_attestation;

                    }

                    if($nombrebis>3)
                    {
                        $this->Flash->error(__('Vous avez dépassé le nombre maximum des attestations , pour plus d\'infos veuillez nous conatcter au service'));
                        break;
                    }

                    elseif($nombre>=1)
                    {
                        $this->Flash->error(__('Echéc d\'envoi ... Déja vous avez '.$nombre.' demande(s) dans le service, veuillez attender Svp'));
                        break;
                    }
                    elseif($ProfpermanentsDocuments->save($documentsProfesseur)) {
                        $nombrebis++;
                        $query=$profpermanents->find('all')->update()->set(['etat_attestation' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();

                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['action' => 'indexProf']);
                    }
                    else{
                        $this->Flash->error(__('Demande échouée'));

                    }



                    break;
                }
                case 2:
                {
                    // debug($usrid);
                    $nbtentativebis=$profpermanents->find('all')->select('etat_fichesalaire')->where(['id'=>$usrid]);
                    foreach ($nbtentativebis as $value) {
                        $nombrebis=$value->etat_attestation;

                    }
                    $nombrebis=count($nbtentativebis);
                    if($nombrebis>3)
                    {
                        $this->Flash->error(__('Vous avez dépassé le nombre maximum des fiches de salaire, pour plus d\'infos veuillez nous conatcter au service'));
                        break;
                    }
                    elseif($nombre>=1)
                    {
                        $this->Flash->error(__('Echec d\'envoi ... Déja vous avez '.$nombre.'  demande(s) dans le service , veuillez attender Svp'));
                    }
                    elseif ($ProfpermanentsDocuments->save($documentsProfesseur)) {
                        $nombrebis++;
                        $query=$profpermanents->find('all')->update()->set(['etat_fichesalaire' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();
                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['action' => 'indexProf']);
                    }
                    else{
                        $this->Flash->error(__('Demande echouée'));

                    }

                }
            }


        }

        $profpermanents = $ProfpermanentsDocuments->profpermanents->find('list', ['limit' => 200]);
        $documents = $ProfpermanentsDocuments->Documents->find('list', ['limit' => 200]);
        $this->set('doc',$documentbis);
        $this->set('prof',$profbis);
        $this->set(compact('documentsProfesseur', 'profpermanents', 'documents'));
        $this->set('_serialize', ['documentsProfesseur']);
        $this->render('/Espaces/respopersonels/demanderDoc');

    }
    //2ème version
    public function DelivrerDemande($id1,$id2)
    {
        $ProfpermanentsDocuments=TableRegistry::get('ProfpermanentsDocuments');
        $query=$ProfpermanentsDocuments->find('all')->update()->set(['etatdemande' => 'Delivré'])->where(['document_id' => $id1,'profpermanent_id'=>$id2]);
        $query->execute();
        $this->consultationDemande($id2);

    }
    public function DelivrerDemandeFct($id1,$id2)
    {
        $ProfpermanentsDocuments=TableRegistry::get('FonctionnairesDocuments');
        $query=$ProfpermanentsDocuments->find('all')->update()->set(['etatdemande' => 'Delivré'])->where(['document_id' => $id1,'fonctionnaire_id'=>$id2]);
        $query->execute();
        $this->consultationDemandeFct($id2);

    }
    public function statistiques()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);

        $nbAttes=$con->execute('select count(id) as nbAttest from profpermanents_documents pd where pd.document_id=1');
        $nbFiche=$con->execute('select count(id) as nbFiche from profpermanents_documents pd where pd.document_id=2');
        $nbAbsence=$con->execute('select count(id) as nbAbscence from profpermanents_documents pd where pd.document_id=3');
        $nbDemande=$con->execute('select count(id) as nbDemande from profpermanents_documents pd where pd.etatdemande=\'Demande envoyé\'');
        $nbDelivre=$con->execute('select count(id) as nbDemande from profpermanents_documents pd where pd.etatdemande=\'Delivré\'');
        $nbEnCours=$con->execute('select count(id) as nbDemande from profpermanents_documents pd where pd.etatdemande=\'En cours de traitement\'');
        $nbPrete=$con->execute('select count(id) as nbDemande from profpermanents_documents pd where pd.etatdemande=\'Prete\'');

        // debug($nbAttes);
        foreach($nbDelivre as $ligne)
        {
            $nbDelivre=$ligne['nbDemande'];
        }
        foreach($nbEnCours as $ligne)
        {
            $nbEnCours=$ligne['nbDemande'];
        }
        foreach($nbPrete as $ligne)
        {
            $nbPrete=$ligne['nbDemande'];
        }
        $this->set('nbDelivre',$nbDelivre);
        $this->set('nbEnCours',$nbEnCours);
        $this->set('nbPrete',$nbPrete);
        foreach($nbAttes as $ligne)
        {
            $nbAttes=$ligne['nbAttest'];
        }
        foreach($nbDemande as $ligne)
        {
            $nbDemande=$ligne['nbDemande'];
        }
        foreach($nbFiche as $ligne)
        {
            $nbFiche=$ligne['nbFiche'];
        }
        foreach($nbAbsence as $ligne)
        {
            $nbAbsence=$ligne['nbAbscence'];
        }
        $this->set('nbDemande',$nbDemande);
        $this->set('nbAttest',$nbAttes);
        $this->set('nbFiche',$nbFiche);
        $this->set('nbAbscence',$nbAbsence);
        $this->paginate = [
            'contain' => ['Profpermanents', 'Documents']
        ];
        $ProfpermanentsDocuments=TableRegistry::get('ProfpermanentsDocuments');
        $profpermanentsDocuments = $this->paginate($ProfpermanentsDocuments);
        $lastDemande=$con->execute('select * from profpermanents p,documents d , profpermanents_documents pd where pd.document_id=d.id 
                                     and pd.profpermanent_id=p.id and pd.etatdemande=\'Demande envoyé\' ORDER by pd.id DESC LIMIT 5');
        $this->set('lastDemande',$lastDemande);

        $this->set(compact('profpermanentsDocuments'));
        $this->set('_serialize', ['profpermanentsDocuments']);
        $this->render('/Espaces/respopersonels/statistiques');






    }
    //FIN 2EME VERSION



    /*public function consulterDocument()
    {
        $this->paginate = [
            'contain' => ['profpermanents', 'Documents']
        ];
        $ProfpermanentsDocuments = $this->paginate($this->ProfpermanentsDocuments->find('all',array(
            "joins"=>array(
                array(
                    "table" => "profpermanents",
                    "conditions"=>array(
                        "ProfpermanentsDocuments.profpermanent_id=Profpermanents.id")
                )
            ))));
        $this->render('/Espaces/respopersonels/consulterDocument');;

        $this->set(compact('ProfpermanentsDocuments'));
        $this->set('_serialize', ['ProfpermanentsDocuments']);

    }*/
    //Professeur Validation données
    /*public function validerDonnees()
    {
        $idUser=$this->Auth->user('id');
        $profpermanents=TableRegistry::get('Profpermanents');
        $query=$profpermanents->find('all')->select('id')->where(['user_id'=>$idUser]);

        foreach($query as $ligne)
        {
            $id=$ligne->id;
        }
        $professeur = $profpermanents->get($id, [
            'contain' => []
        ]);
        $this->set('professeur', $professeur);
        $this->set('_serialize', ['professeur']);
        $this->render('/Espaces/respopersonels/validerDonnees');

    }*/
// Espace Chef personnel
//2eme version
    public function listerProFParDeparBis($id=null)
    {
        $this->paginate = [
            'contain' => ['Profpermanents', 'Departements']
        ];
        $ProfpermanentsDepartements= TableRegistry::get('ProfpermanentsDepartements');
        if(isset($_POST['chercherProf'])) {
            $indice = $_POST['chercherProf'];
            $ProfpermanentsDepartements = $this->paginate($ProfpermanentsDepartements->find('all', array(
                "joins" => array(
                    array(
                        "table" => "Profpermanents",
                        "conditions" => array(
                            "ProfpermanentsDepartements.profpermanent_id = Profpermanents.id"
                        )
                    )
                ),'conditions' => array(
                    'ProfpermanentsDepartements.departement_id' => $id)))->where(['OR' => ['Profpermanents.nom_prof like ' => '%' . $indice . '%', ' profpermanents.prenom_prof like' => '%' . $indice . '%',
                'Profpermanents.somme like'=>'%'.$indice.'%','Profpermanents.Lieu_Naissance like'=>'%'.$indice.'%']]));
        }

        else{
            $ProfpermanentsDepartements = $this->paginate($ProfpermanentsDepartements->find("all", array(
                    "joins" => array(
                        array(
                            "table" => "Profpermanents",
                            "conditions" => array(
                                "ProfpermanentsDepartements.profpermanent_id = Profpermanents.id"
                            )
                        )
                    ),
                    'conditions' => array(
                        'ProfpermanentsDepartements.departement_id' => $id)
                )
            ));

        }
        $this->set(compact('ProfpermanentsDepartements'));
        $this->set('_serialize', ['ProfpermanentsDepartements']);
        $this->render('/Espaces/respopersonels/listerProFParDeparBis');


    }
//FIn 2eme version
    public function listerProfsParDepar()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $grt=$con->execute('select * from profpermanents_departements where departement_id=1');
        $gi=$con->execute('select * from profpermanents_departements where departement_id=2');
        $ge=$con->execute('select * from profpermanents_departements where departement_id=3');
        $gpee=$con->execute('select * from profpermanents_departements where departement_id=4');
        $this->set('grtProf',count($grt));
        $this->set('giProf',count($gi));
        $this->set('geProf',count($ge));
        $this->set('gpeeProf',count($gpee));

        $ProfpermanentsDepartements = TableRegistry::get('ProfpermanentsDepartements');
        $this->paginate=['contain' => ['Profpermanents','Departements'] ];
        if(isset($_POST['chercherParDep']))
        {
            $indice=$_POST['chercherParDep'];
            $profpermanentsDepartements=$this->paginate($ProfpermanentsDepartements->find('all',array(
                "joins"=>array(
                    array(
                        "table" => "profpermanents",
                        "conditions"=>array(
                            "profpermanentsDepartements.profpermanent_id=Profpermanents.id")
                    )
                )))->where(['OR'=>['departements.nom_departement like '=>'%'.$indice.'%',' profpermanents.nom_prof like'=>'%'.$indice.'%']]));
        }
        else
        {
            $profpermanentsDepartements=$this->paginate($ProfpermanentsDepartements->find('all',array(
                "joins"=>array(
                    array(
                        "table" => "profpermanents",
                        "conditions"=>array(
                            "profpermanentsDepartements.profpermanent_id=Profpermanents.id")
                    )
                ))));
        }

        $this->set(compact('profpermanentsDepartements'));
        $this->set('__serialize',['profpermanentsDepartements']);
        $this->render('/Espaces/respopersonels/listerProfsParDepar');

    }
    //2eme version

    //fin 2eme version
    public function view($id1 = null,$id2=null,$id3=null)
    {
        $departements=TableRegistry::get('Departements');
        $profdepars=TableRegistry::get('ProfpermanentsDepartements');
        $profpermanents=TableRegistry::get('Profpermanents');
        $professeur = $profpermanents->get($id1, [
            'contain' => []
        ]);
        $departement = $departements->get($id2, [
            'contain' => []
        ]);
        $profdepar = $profdepars->get($id3, [
            'contain' => []
        ]);

        $this->set('professeur', $professeur);
        $this->set('_serialize', ['professeur']);
        $this->set('departement', $departement);
        $this->set('_serialize', ['departement']);
        $this->set('profdepar', $profdepar);
        $this->set('_serialize', ['profdepar']);
        $this->render('/Espaces/respopersonels/view');


    }
    public function deleteProfDepar($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $profpermanentsDepartements=TableRegistry::get('ProfpermanentsDepartements');
        $profpermanentsDepartement = $profpermanentsDepartements->get($id);
        if ($profpermanentsDepartements->delete($profpermanentsDepartement)) {
            $this->Flash->success(__('The profpermanents departement has been deleted.'));
        } else {
            $this->Flash->error(__('The profpermanents departement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'listerProfsParDepar']);
    }
    public function affecterProfDepar()
    {
        $Departs=TableRegistry::get('Departements');
        $Profs=TableRegistry::get('Profpermanents');
        $profpermanentsDepartements=TableRegistry::get('ProfpermanentsDepartements');
        $profpermanentsDepartement = $profpermanentsDepartements->newEntity();
        //debug($this->request);
        /* foreach ($this->request->data('Date_debut')as $date)
         {
             $year=$date['year'];
             $month=$date['month'];
             $day=$date['day'];
         }*/
        if ($this->request->is('post')){

            $req=$Profs->find('all')->select('id');
            $i=1;
            // debug($this->request->data('somme'));

            foreach($req as $ligne)
            {
                //echo 'i='.$i;
                if($i==$this->request->data('somme'))
                {
                    $ID=$ligne->id;
                    break;

                }
                $i++;

            }
            $j=1;
            // debug($this->request->data('somme'));
            $req1=$Departs->find('all')->select('id');
            foreach($req1 as $ligne)
            {
                //echo 'i='.$i;
                if($j==$this->request->data('nomdepart'))
                {
                    $IDDEPAR=$ligne->id;
                    break;

                }
                $j++;

            }
            $req3=$profpermanentsDepartements->find('all')->select('id')->where(['ProfpermanentsDepartements.profpermanent_id'=>$ID,
                'ProfpermanentsDepartements.departement_id'=>$IDDEPAR]);
            $nb=0;
            foreach($req3 as $existant)
            {
                $nb++;
            }


            $profpermanentsDepartement->profpermanent_id =$ID;
            $profpermanentsDepartement->departement_id =$IDDEPAR;
            $profpermanentsDepartement->Poste_Filiere =$this->request->data('Poste_Filiere');
            /*$year=$this->request->data('Date_Debut')['year'];
            $month=$this->request->data('Date_Debut')['month'];
            $day=$this->request->data('Date_Debut')['day'];
            $date_string=$year.'-'.$month.'-'.$day;
            $date=date_create($date_string);*/
            $profpermanentsDepartement->Date_Debut =$_POST['date_debut'];
            if($nb==1)
            {
                $this->Flash->error(__('Le Professeur que vous voulez affecter existe déja dans ce département'));

            }
            elseif($profpermanentsDepartements->save($profpermanentsDepartement)){
                $this->Flash->success(__('The profpermanents departement has been saved.'));

                return $this->redirect(['action' => 'listerProfsParDepar']);
            }else{
                $this->Flash->error(__('The profpermanents departement could not be saved. Please, try again.'));

            }
        }


        $profpermanents = $profpermanentsDepartements->profpermanents->find('list', ['limit' => 200]);
        $departements = $profpermanentsDepartements->Departements->find('list', ['limit' => 200]);
        $this->set(compact('profpermanentsDepartement', 'profpermanents', 'departements'));
        $i=1;
        $queryProf=$Profs->find('all');
        foreach ($queryProf as $query1)
        {
            $tabSomme[$i]=$query1->somme;
            $i++;
        }
        $j=1;
        $queryDeparts=$Departs->find('all');
        foreach ($queryDeparts as $query2)
        {
            $tabNom[$j]=$query2->nom_departement;
            $j++;
        }

        $this->set('sommetab',$tabSomme);
        $this->set('nomtab',$tabNom);
        $this->set('_serialize', ['profpermanentsDepartement']);
        $this->render('/Espaces/respopersonels/affecterProfDepar');

    }
    public function edit($id = null)
    {
        $profpermanentsDepartements=TableRegistry::get('ProfpermanentsDepartements');
        $profpermanentsDepartement = $profpermanentsDepartements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $profpermanentsDepartement = $profpermanentsDepartements->patchEntity($profpermanentsDepartement, $this->request->data);
            if ($profpermanentsDepartements->save($profpermanentsDepartement)) {
                $this->Flash->success(__('Modification réussite'));

                return $this->redirect(['action' => 'listerProfsParDepar']);
            }
            $this->Flash->error(__('The profpermanents departement could not be saved. Please, try again.'));
        }
        $this->set(compact('profpermanentsDepartement'));
        $this->set('_serialize', ['profpermanentsDepartement']);
        $this->render('/Espaces/respopersonels/edit');
    }
    // Rechercher prof permanent
    public function foncBis(){

        $this->set(compact('Profpermanents'));
        $this->render('/Espaces/respopersonels/foncBis');

    }
    public function filterfoncBis($limit=100)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $cat=$_POST['cat'];

        switch($_POST['recherche'])
        {

            case "nom_fct":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE nom_prof LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents',$profpermanents);
                break;
            }
            case "somme":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE somme LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents',$profpermanents);
                break;
            }
            case "prenom_fct":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE prenom_fct LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents',$profpermanents);
                break;
            }
            case "specialite":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE specialite LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents',$profpermanents);
                break;
            }
            case "echelle":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE echelle LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents',$profpermanents);
                break;
            }
            case "age":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE age LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents',$profpermanents);
                break;
            }
            case "genre":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE genre LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents',$profpermanents);
                break;
            }
            case "date Recrutement":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE date_Recrut LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents',$profpermanents);
                break;
            }
            default:
                echo "Professeur Inexistans";
        }

        $this->render('/Espaces/respopersonels/filtrerfoncBis');

    }
    // FIN BOUHSISE YOUNESS

    // DEBUT IBTISSAM EL ABBADI


    public function listerFonctGrade()
    {

        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Grades']
        ];
        $FonctionnairesGrades=TableRegistry::get('FonctionnairesGrades');
        $fonctionnairesGrades = $this->paginate($FonctionnairesGrades);


        $this->set(compact('fonctionnairesGrades'));
        $this->set('_serialize', ['fonctionnairesGrades']);
        $this->render('/Espaces/respopersonels/listerFonctGrade');


    }
    public function listerFonctGrade2()
    {
        $this->paginate = ['contain' => ['Fonctionnaires', 'Grades']];
        $FonctionnairesGrades = TableRegistry::get('FonctionnairesGrades');
        $FonctionnairesGrades = $this->paginate($FonctionnairesGrades->find('all', array(
            "joins" => array(
                array(
                    "table" => "Fonctionnaires",
                    "conditions" => array(
                        "FonctionnairesGrades.fonctionnaire_id=Fonctionnaires.id")
                )
            ),
            'conditions' => array('Fonctionnaires.id'))));
        $this->set(compact('FonctionnairesGrades'));
        $this->set('__serialize', ['FonctionnairesGrades']);
        $this->render('/Espaces/respopersonels/listerFonctGrade');
    }

    public function editGradeFct($id = null)
    {
        $FonctionnairesGrades = TableRegistry::get('FonctionnairesGrades');
        $fonctionnairesGrade = $FonctionnairesGrades->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //  $fonctionnairesGrade = $FonctionnairesGrades->patchEntity($fonctionnairesGrade, $this->request->data);
            $fonctionnairesGrade->date_prise=$_POST['date_prise'];
            if ($FonctionnairesGrades->save($fonctionnairesGrade)) {
                $this->Flash->success(__('Modification réussite'));

                return $this->redirect(['action' => 'listerFonctGrade']);
            }
            $this->Flash->error(__('Le fonctionnaire ne peut pas etre sauvegardé '));
        }
        $this->set(compact('fonctionnairesGrade'));
        $this->set('_serialize', ['fonctionnairesGrade']);
        $this->render('/Espaces/respopersonels/editGradeFct');
    }

    public function viewGradeFct($id1 = null, $id2 = null, $id3 = null)
    {
        $grades = TableRegistry::get('Grades');
        $fonctionnaireGrade = TableRegistry::get('FonctionnairesGrades');
        $fonctionnaires = TableRegistry::get('Fonctionnaires');
        $fonctionnaire = $fonctionnaires->get($id1, [
            'contain' => []
        ]);
        $grade = $grades->get($id2, [
            'contain' => []
        ]);
        $fonctionnaireGra = $fonctionnaireGrade->get($id3, [
            'contain' => []
        ]);

        $this->set('fonctionnaire', $fonctionnaire);
        $this->set('_serialize', ['fonctionnaire']);
        $this->set('grade', $grade);
        $this->set('_serialize', ['fonctionnaireGra']);
        $this->set('fonctionnaireGra', $fonctionnaireGra);
        $this->set('_serialize', ['fonctionnaireGra']);
        $this->render('/Espaces/respopersonels/viewGradeFct');
    }

    public function deleteFonctGrade($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $FonctionnairesGrades = TableRegistry::get('FonctionnairesGrades');
        $fonctionnairesGrade = $FonctionnairesGrades->get($id);
        if ($FonctionnairesGrades->delete($fonctionnairesGrade)) {
            $this->Flash->success(__('The Employee grade has been deleted.'));
        } else {
            $this->Flash->error(__('The Employee grade could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'listerFonctGrade']);
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

    public function viewActivite($id1 = null, $id2 = null, $id3 = null)
    {
        $activites = TableRegistry::get('Activites');
        $fonctActivs = TableRegistry::get('FonctionnairesActivites');
        $fonctionnaires = TableRegistry::get('Fonctionnaires');
        $fonctionnaire = $fonctionnaires->get($id1, [
            'contain' => []]);
        $activite = $activites->get($id2, [
            'contain' => []]);
        $fonctActif = $fonctActivs->get($id3, [
            'contain' => []]);
        $this->set('fonctionnaire', $fonctionnaire);
        $this->set('_serialize', ['fonctionnaire']);
        $this->set('activite', $activite);
        $this->set('_serialize', ['activite']);
        $this->set('fonctActif', $fonctActif);
        $this->set('_serialize', ['fonctActif']);
        $this->render('/Espaces/respopersonels/viewActivite');
    }



    public function deleteFonctActivite($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $FonctionnairesActivites = TableRegistry::get('FonctionnairesActivites');
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
        $FonctionnairesActivites = TableRegistry::get('FonctionnairesActivites');
        $fonctionnairesActivite = $FonctionnairesActivites->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fonctionnairesActivite = $FonctionnairesActivites->patchEntity($fonctionnairesActivite, $this->request->data);
            if ($FonctionnairesActivites->save($fonctionnairesActivite)) {
                $this->Flash->success(__('Modification faite'));

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
                    array("table" => "Services",
                        "conditions" => array("FonctionnairesServices.service_id=Services.id")),
                    array("table" => "Fonctionnaires",
                        "conditions" => array("FonctionnairesServices.fonctionnaire_id=Fonctionnaires.id")),
                    'conditions' => array('Services.id')))));
        $this->set(compact('FonctionnairesServices'));
        $this->set('__serialize', ['FonctionnairesServices']);
        $this->render('/Espaces/respopersonels/mouvementService');
    }

    public function viewMouvement($id1 = null, $id2 = null, $id3 = null)
    {
        $services = TableRegistry::get('Services');
        $fonctionnaireService = TableRegistry::get('FonctionnairesServices');
        $fonctionnaires = TableRegistry::get('Fonctionnaires');
        $fonctionnaire = $fonctionnaires->get($id1, ['contain' => []]);
        $service = $services->get($id2, ['contain' => []]);
        $fonctionnaireServ = $fonctionnaireService->get($id3, ['contain' => []]);
        $this->set('fonctionnaire', $fonctionnaire);
        $this->set('_serialize', ['fonctionnaire']);
        $this->set('service', $service);
        $this->set('_serialize', ['fonctionnaireServ']);
        $this->set('fonctionnaireServ', $fonctionnaireServ);
        $this->set('_serialize', ['fonctionnaireServ']);
        $this->render('/Espaces/respopersonels/viewMouvement');
    }

    public function deleteMouvement($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $FonctionnairesServices = TableRegistry::get('FonctionnairesServices');
        $fonctionnairesService = $FonctionnairesServices->get($id);
        if ($FonctionnairesServices->delete($fonctionnairesService)) {
            $this->Flash->success(__('The Mouvement has been deleted.'));
        } else {
            $this->Flash->error(__('The Mouvement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'mouvementService']);
    }

    public function editMouvement($id = null)
    {
        $FonctionnairesServices = TableRegistry::get('FonctionnairesServices');
        $fonctionnairesService = $FonctionnairesServices->get($id, [
            'contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fonctionnairesService = $FonctionnairesServices->patchEntity($fonctionnairesService, $this->request->data);
            if ($FonctionnairesServices->save($fonctionnairesService)) {
                $this->Flash->success(__('Modification faite'));
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
        $Servs = TableRegistry::get('Services');
        $Foncts = TableRegistry::get('Fonctionnaires');
        $FonctionnairesServices = TableRegistry::get('FonctionnairesServices');
        $fonctionnairesService = $FonctionnairesServices->newEntity();

        if ($this->request->is('post')) {

            $fonctionnairesService->fonctionnaire_id = $this->request->data('somme');
            $fonctionnairesService->service_id = $this->request->data('nomService');
            if ($FonctionnairesServices->save($fonctionnairesService)) {
                $this->Flash->success(__('The fonctionnaire service has been saved.'));

                return $this->redirect(['action' => 'mouvementService']);
            }
            $this->Flash->error(__('The fonctionnaire service  could not be saved. Please, try again.'));
        }

        $fonctionnaires = $FonctionnairesServices->Fonctionnaires->find('list', ['limit' => 200]);
        $services = $FonctionnairesServices->Services->find('list', ['limit' => 200]);
        $this->set(compact('fonctionnairesService', 'fonctionnaires', 'services'));
        $a = 1;
        $requeteFonctionnaires = $Foncts->find('all');
        foreach ($requeteFonctionnaires as $requete1) {
            $tab1[$a] = $requete1->somme;
            $a++;
        }
        $b = 1;
        $requeteServices = $Servs->find('all');
        foreach ($requeteServices as $requete2) {
            $tab2[$b] = $requete2->nom_service;
            $b++;
        }
        $this->set('tab1', $tab1);
        $this->set('tab2', $tab2);
        $this->set('_serialize', ['fonctionnairesService']);
        $this->render('/Espaces/respopersonels/ajouterMvtService');
    }


//ACTIVITES
    public function afficherFonctEvent()
    {
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Activites']];
        $FonctionnairesActivites = TableRegistry::get('FonctionnairesActivites');
        $fonctionnairesActivites = $this->paginate($FonctionnairesActivites);
        $this->set(compact('fonctionnairesActivites'));
        $this->set('_serialize', ['fonctionnairesActivites']);
        $this->render('/Espaces/respopersonels/afficherFonctEvent');
    }

    public function deleteFonctActivite2($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $FonctionnairesActivites = TableRegistry::get('FonctionnairesActivites');
        $fonctionnairesActivite = $FonctionnairesActivites->get($id);
        if ($FonctionnairesActivites->delete($fonctionnairesActivite)) {
            $this->Flash->success(__(' the Activity has been deleted.'));
        } else {
            $this->Flash->error(__(' the Activity could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'afficherFonctEvent']);
    }

    public function affecterFonctEvent()
    {
        $activities = TableRegistry::get('Activites');
        $Foncts = TableRegistry::get('Fonctionnaires');
        $fonctionnairesActivites = TableRegistry::get('FonctionnairesActivites');
        $fonctionnairesActivite = $fonctionnairesActivites->newEntity();
        if ($this->request->is('post')) {
            $fonctionnairesActivite->activite_id = $this->request->data('nomActivite');
            $fonctionnairesActivite->poste_comite = $this->request->data('poste_comite');
            $req = $Foncts->find('all')->select('id');
            $a = 1;
            foreach ($req as $donnee) {
                if ($a == $this->request->data('somme')) {
                    $d = $donnee->id;
                    break;
                }
                $a++;
            }
            $fonctionnairesActivite->fonctionnaire_id = $d;
            if ($fonctionnairesActivites->save($fonctionnairesActivite)) {
                $this->Flash->success(__('Membre affecté'));
                return $this->redirect(['action' => 'afficherFonctEvent']);
            }
            $this->Flash->error(__('Affectation échouée'));
        }
        $fonctionnaires = $fonctionnairesActivites->Fonctionnaires->find('list', ['limit' => 200]);
        $activites = $fonctionnairesActivites->Activites->find('list', ['limit' => 200]);
        $this->set(compact('fonctionnairesActivite', 'fonctionnaires', 'activites'));
        $i = 1;
        $requeteFonct = $Foncts->find('all');
        foreach ($requeteFonct as $requete1) {
            $tab1[$i] = $requete1->somme;
            $i++;
        }
        $j = 1;
        $requeteActivites = $activities->find('all');
        foreach ($requeteActivites as $requete2) {
            $tab2[$j] = $requete2->nomActivite;
            $j++;
        }
        $this->set('tab1', $tab1);
        $this->set('tab2', $tab2);
        $this->set('_serialize', ['fonctionnairesActivite']);
        $this->render('/Espaces/respopersonels/affecterFonctEvent');
    }

    public function afficherMembre($id = null)
    {
        $this->paginate = ['contain' => ['Fonctionnaires', 'Activites']];
        $fonctionnairesActivites = TableRegistry::get('FonctionnairesActivites');
        $fonctionnairesActivite = $this->paginate($fonctionnairesActivites->find("all", array(
            "joins" => array(array(
                "table" => "Fonctionnaires",
                "conditions" => array("FonctionnairesActivites.fonctionnaire_id = Fonctionnaires.id")),
                array("table" => "Activites",
                    "conditions" => array("FonctionnairesActivites.activite_id = Activites.id"))),
            'conditions' => array(
                'fonctionnairesActivites.activite_id' => $id))));
        $this->set(compact('fonctionnairesActivite'));
        $this->set('_serialize', ['fonctionnairesActivite']);
        $this->render('/Espaces/respopersonels/afficherMembre');
    }

    /* public function ajouterEvenement()
     {
         $Activites = TableRegistry::get('Activites');
         $activite = $Activites->newEntity();
         if ($this->request->is('post')) {
             $activite = $Activites->patchEntity($activite, $this->request->data);
             if ($Activites->save($activite)) {
                 $this->Flash->success(__('Evénement Bien Ajoute'));
                 return $this->redirect(['action' => 'afficherFonctEvent']);
             } else {
                 $this->Flash->error(__('Erreur d\'ajout !'));
             }
         }
         $this->set(compact('activite'));
         $this->set('_serialize', ['activite']);
         $this->render('/Espaces/respopersonels/ajouterEvenement');
     }*/


//DEMANDES DANS LES ESPACES FONCTIONNAIRES
    public function demanderDocFct()
    {
        $FonctionnairesDocuments = TableRegistry::get('FonctionnairesDocuments');
        $documentsFonctionnaire = $FonctionnairesDocuments->newEntity();
        $documentbis = TableRegistry::get('Documents');
        $documentbis = $documentbis->find('all');
        $fctbis = TableRegistry::get('Fonctionnaires');
        $fctbis = $fctbis->find('all');
        $idUser = $this->Auth->user('id');
        $fonctionnaires = TableRegistry::get('Fonctionnaires');
        $query = $fonctionnaires->find('all')->select('id')->where(['user_id' => $idUser]);

        foreach ($query as $ligne) {
            $usrid = $ligne->id;
        }
        if ($this->request->is('post')) {

            $documentsFonctionnaire->fonctionnaire_id = $usrid;
            $documentsFonctionnaire->document_id = $this->request->data('nomDoc');
            //requete pour une demande déja effectué
            $requete = $FonctionnairesDocuments->find('all', array('conditions' => array('FonctionnairesDocuments.fonctionnaire_id' => $usrid
            , 'FonctionnairesDocuments.document_id' => $this->request->data('nomDoc'))));
            $nombre = 0;
            foreach ($requete as $resultat) {
                if ($resultat->etatdemande == 'Demande envoyé' or $resultat->etatdemande == 'Prete' or $resultat->etatdemande == 'En cours de traitement') {
                    $nombre++;
                }
            }
            $Fonctionnaires = TableRegistry::get('Fonctionnaires');
            $identifiantDoc = $this->request->data('nomDoc');

            switch ($identifiantDoc) {
                case 1: {
                    $nbtentativebis = $Fonctionnaires->find('all')->select('etat_attestation')->where(['id' => $usrid]);
                    foreach ($nbtentativebis as $value) {
                        $nombrebis = $value->etat_attestation;

                    }

                    if ($nombrebis > 3) {
                        $this->Flash->error(__('Vous avez dépassé le nombre maximum des attestations'));
                        break;
                    } elseif ($nombre >= 1) {
                        $this->Flash->error(__('Erreur . Vous avez déjà ' . $nombre . ' demande(s) dans le service, veuillez attender Svp'));
                        break;
                    } elseif ($FonctionnairesDocuments->save($documentsFonctionnaire)) {
                        $nombrebis++;
                        $query = $fonctionnaires->find('all')->update()->set(['etat_attestation' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();

                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('Demande échouée'));

                    }
                    break;
                }
                case 2: {
                    $nbtentativebis = $fonctionnaires->find('all')->select('etat_fiche')->where(['id' => $usrid]);
                    foreach ($nbtentativebis as $value) {
                        $nombrebis = $value->etat_attestation;

                    }
                    $nombrebis = count($nbtentativebis);
                    if ($nombrebis > 3) {
                        $this->Flash->error(__('Vous avez dépassé le nombre maximum des fiches de salaire'));
                        break;
                    } elseif ($nombre >= 1) {
                        $this->Flash->error(__('Erreur. Vous avez déjà ' . $nombre . '  demande(s)'));
                    } elseif ($FonctionnairesDocuments->save($documentsFonctionnaire)) {
                        $nombrebis++;
                        $query = $fonctionnaires->find('all')->update()->set(['etat_fichesalaire' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();
                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('Demande echouée'));
                    }
                }
            }
        }
        $fonctionnaires = $FonctionnairesDocuments->fonctionnaires->find('list', ['limit' => 200]);
        $documents = $FonctionnairesDocuments->Documents->find('list', ['limit' => 200]);
        $this->set('doc', $documentbis);
        $this->set('fct', $fctbis);
        $this->set(compact('documentsFonctionnaire', 'fonctionnaires', 'documents'));
        $this->set('_serialize', ['documentsFonctionnaire']);
        $this->render('/Espaces/respopersonels/demanderDocFct');

        /* $FonctionnairesDocuments = TableRegistry::get('FonctionnairesDocuments');
         $documentsFonctionnaire = $FonctionnairesDocuments->newEntity();
         $documentbis = TableRegistry::get('Documents');
         $documentbis = $documentbis->find('all');
         $fctbis = TableRegistry::get('Fonctionnaires');
         $fctbis = $fctbis->find('all');
         $idUser = $this->Auth->user('id');
         $Fonctionnaires = TableRegistry::get('Fonctionnaires');
         $query = $Fonctionnaires->find('all')->select('id')->where(['user_id' => $idUser]);

         foreach ($query as $ligne) {
             $usrid = $ligne->id;
             break;
         }
         if ($this->request->is('post')) {
             $documentsFonctionnaire->fonctionnaire_id = $usrid;
             $documentsFonctionnaire->document_id = $this->request->data('nomDoc');
             $nombre = $FonctionnairesDocuments->find('all', array('conditions' => array('FonctionnairesDocuments.fonctionnaire_id' => $usrid
             , 'FonctionnairesDocuments.document_id' => $this->request->data('nomDoc'))))->count();
             $identifiantDoc = $this->request->data('nomDoc');

             switch ($identifiantDoc) {
                 case 1: {
                     $nbtentativebis = $Fonctionnaires->find('all')->select('etat_attestation')->where(['id' => $usrid]);
                     foreach ($nbtentativebis as $value) {
                         $nombrebis = $value->etat_attestation;
                     }

                     if ($nombrebis > 3) {
                         $this->Flash->error(__('Vous avez dépassé le nombre maximum des attestations , pour plus d\'infos veuillez nous conatcter au service'));
                         break;
                     } elseif ($nombre == 1) {
                         $this->Flash->error(__('Erreur. Demande déja envoyée'));
                         break;
                     } elseif ($FonctionnairesDocuments->save($documentsFonctionnaire)) {
                         $nombrebis++;
                         $query = $Fonctionnaires->find('all')->update()->set(['etat_attestation' => $nombrebis])->where(['id' => $usrid]);
                         $query->execute();

                         $this->Flash->success(__('Demande envoyée.'));

                         return $this->redirect(['action' => 'index']);
                     } else {
                         $this->Flash->error(__('Demande échouée'));
                     }
                     break;
                 }
                 case 2: {
                     $nbtentativebis = $Fonctionnaires->find('all')->select('etat_fiche')->where(['id' => $usrid]);
                     foreach ($nbtentativebis as $value) {
                         $nombrebis = $value->etatdemande;

                     }
                     $nombrebis = count($nbtentativebis);
                     if ($nombrebis > 3) {
                         $this->Flash->error(__('Vous avez dépassé le nombre maximum des fiches de salaire, pour plus d\'infos veuillez nous contacter au service'));
                         break;
                     } elseif ($nombre == 1) {
                         $this->Flash->error(__('Erreur. Demande déja envoyée'));
                     } elseif ($FonctionnairesDocuments->save($documentsFonctionnaire)) {
                         $nombrebis++;
                         $query = $Fonctionnaires->find('all')->update()->set(['etat_fiche' => $nombrebis])->where(['id' => $usrid]);
                         $query->execute();
                         $this->Flash->success(__('Demande envoyée.'));

                         return $this->redirect(['action' => 'index']);
                     } else {
                         $this->Flash->error(__('Demande echouée'));
                     }
                 }
             }
         }
         $Fonctionnaires = $FonctionnairesDocuments->fonctionnaires->find('list', ['limit' => 200]);
         $documents = $FonctionnairesDocuments->Documents->find('list', ['limit' => 200]);
         $this->set('doc', $documentbis);
         $this->set('prof', $fctbis);
         $this->set(compact('documentsFonctionnaire', 'Fonctionnaires', 'documents'));
         $this->set('_serialize', ['documentsFonctionnaire']);
         $this->render('/Espaces/respopersonels/demanderDocFct');*/

    }



//DOCUMENTS DANS ESPACE PERSONNEL

    public function voirDocumentFct()
    {

        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Documents']
        ];
        $FonctionnairesDocuments = TableRegistry::get('FonctionnairesDocuments');
        $fonctionnairesDocuments = $this->paginate($FonctionnairesDocuments);

        $this->set(compact('fonctionnairesDocuments'));
        $this->set('_serialize', ['fonctionnairesDocuments']);
        $this->render('/Espaces/respopersonels/voirDocumentFct');

    }

    public function consultationDemandeFct($id = null)
    {
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Documents']
        ];
        $FonctionnairesDocuments = TableRegistry::get('FonctionnairesDocuments');
        $fonctionnairesDocuments = $this->paginate($FonctionnairesDocuments->find("all", array(
            "joins" => array(
                array(
                    "table" => "Fonctionnaires",
                    "conditions" => array(
                        "FonctionnairesDocuments.fonctionnaire_id = Fonctionnaires.id")),
                array(
                    "table" => "Documents",
                    "conditions" => array(
                        "FonctionnairesDocuments.document_id = Documents.id"))),
            'conditions' => array(
                'FonctionnairesDocuments.fonctionnaire_id' => $id))));
        $this->set(compact('fonctionnairesDocuments'));
        $this->set('_serialize', ['fonctionnairesDocuments']);
        $this->render('/Espaces/respopersonels/consultationDemandeFct');
    }

    public function approuverDemandeFct($id1 = null, $id2 = null)
    {
        $FonctionnairesDocuments = TableRegistry::get('FonctionnairesDocuments');
        $query = $FonctionnairesDocuments->find('all')->update()->set(['etatdemande' => 'En cours de traitement'])->where(['document_id' => $id1, 'fonctionnaire_id' => $id2]);
        $query->execute();
        $this->consultationDemandeFct($id2);
    }

    public function imprimerDocumentFct($id1 = null, $id2 = null)
    {
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Documents']
        ];
        $FonctionnairesDocuments = TableRegistry::get('FonctionnairesDocuments');
        $fonctionnairesDocuments = $this->paginate($FonctionnairesDocuments->find("all", array(
                "joins" => array(
                    array(
                        "table" => "Fonctionnaires",
                        "conditions" => array(
                            "FonctionnairesDocuments.fonctionnaire_id = Fonctionnaires.id"
                        )
                    ),
                    array(
                        "table" => "Documents",
                        "conditions" => array(
                            "FonctionnairesDocuments.document_id = Documents.id"
                        )
                    )
                ),
                'conditions' => array(
                    'FonctionnairesDocuments.document_id' => $id1, 'FonctionnairesDocuments.fonctionnaire_id' => $id2)
            )
        ));
        $query = $FonctionnairesDocuments->find('all')->update()->set(['etatdemande' => 'Prete'])->where(['document_id' => $id1, 'fonctionnaire_id' => $id2]);
        $query->execute();
        switch ($id1) {
            case 1: {
                $this->set(compact('fonctionnairesDocuments'));
                $this->set('_serialize', ['fonctionnairesDocuments']);
                $this->render('/Espaces/respopersonels/imprimerAttestFct');
                break;
            }
            case 2: {
                $this->set(compact('fonctionnairesDocuments'));
                $this->set('_serialize', ['fonctionnairesDocuments']);
                $this->render('/Espaces/respopersonels/imprimerFicheFct');
                break;
            }
            case 3: {
                $this->set(compact('fonctionnairesDocuments'));
                $this->set('_serialize', ['fonctionnairesDocuments']);
                $this->render('/FonctionnairesDocuments/imprimerDemandeFct');
                break;
            }
        }

    }

//RECHERCHER UN FONCTIONNAIRE
    public function fetch1()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);
        $search = $_POST['search'];
        $query = $con->execute("SELECT * FROM Fonctionnaires WHERE nom_fct LIKE '%" . $search . "%' OR id LIKE '%" . $search . "%'
            OR prenom_fct LIKE '%" . $search . "%' OR echelle LIKE '%" . $search . "%' OR somme LIKE '%" . $search . "%' 
            OR specialite LIKE '%" . $search . "%' OR situation_Familiale LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR age LIKE '%" . $search . "%'OR genre LIKE '%" . $search . "%'OR codeGrade LIKE '%" . $search . "%'OR cdPays LIKE '%" . $search . "%'OR cdDiplome LIKE '%" . $search . "%'OR ueDiplome LIKE '%" . $search . "%'")->fetchAll('assoc');

        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/fetch1');
    }

    public function fetch()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);
        $query = $con->execute("SELECT * FROM Fonctionnaires ")->fetchAll('assoc');
        $this->set(compact('query'));
        $this->render('/Espaces/respopersonels/fetch');

    }

    //POSTES OCCUPES
    public function listerMouvement()
    {
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Services']
        ];
        $FonctionnairesServices = TableRegistry::get('FonctionnairesServices');
        $fonctionnairesServices = $this->paginate($FonctionnairesServices);


        $this->set(compact('fonctionnairesServices'));
        $this->set('_serialize', ['fonctionnairesServices']);
        $this->render('/Espaces/respopersonels/listerMouvement');
    }

    public function deleteFonctService2($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $FonctionnairesServices = TableRegistry::get('FonctionnairesServices');
        $fonctionnairesService = $FonctionnairesServices->get($id);
        if ($FonctionnairesServices->delete($fonctionnairesService)) {
            $this->Flash->success(__('The employee service has been deleted.'));
        } else {
            $this->Flash->error(__('The employee service could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'listerMouvement']);
    }

    public function viewServiceFct($id = null)
    {
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Services']
        ];
        $FonctionnairesServices = TableRegistry::get('FonctionnairesServices');
        $fonctionnairesService = $this->paginate($FonctionnairesServices->find("all", array(
            "joins" => array(
                array(
                    "table" => "fonctionnaires",
                    "conditions" => array(
                        "FonctionnairesServices.fonctionnaire_id = Fonctionnaires.id")),
                array(
                    "table" => "Services",
                    "conditions" => array(
                        "FonctionnairesServices.service_id = Services.id"))),
            'conditions' => array(
                'FonctionnairesServices.fonctionnaire_id' => $id))));

        $this->set(compact('fonctionnairesService'));
        $this->set('_serialize', ['fonctionnairesService']);
        $this->render('/Espaces/respopersonels/viewServiceFct');
    }

    //RECHERCHE DANS ACTIVITES
    public function fetch1Activite()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);
        $search = $_POST['search'];
        $query = $con->execute("SELECT * FROM Activites WHERE id LIKE '%" . $search . "%' OR nomActivite LIKE '%" . $search . "%'
            OR dateDebut LIKE '%" . $search . "%' OR dateFin LIKE '%" . $search . "%' ")->fetchAll('assoc');

        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/fetch1Activite');
    }

    //RECHERCHE DANS SERVICES
    public function fetch1Service()
    {
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Services']
        ];
        $FonctionnairesServices=TableRegistry::get('FonctionnairesServices');
        if(isset($_POST['search']))
        {
            $indice=$_POST['search'];
            $fonctionnairesServices = $this->paginate($FonctionnairesServices->find('all')->where(['OR'=>
                ['Services.nom_service like '=>'%'.$indice.'%',' fonctionnaires.nom_fct like'=>'%'.$indice.'%'
                    ,' fonctionnaires.prenom_fct like'=>'%'.$indice.'%',' fonctionnaires.lieuNaissance like'=>'%'.$indice.'%',
                    'fonctionnaires.somme like '=>'%'.$indice.'%']]));
        }


        $this->set(compact('fonctionnairesServices'));
        $this->set('_serialize', ['fonctionnairesServices']);
        $this->render('/Espaces/respopersonels/fetch1Service');
    }

    public function addActivite()
    {
        $Activites = TableRegistry::get('Activites');
//echo WWW_ROOT.'admin_l_t_e'.DS.'img';
        $activite = $Activites->newEntity();

        if ($this->request->is('post')) {
            $activite->nomActivite = $this->request->data('nomActivite');
            $activite->dateDebut = $_POST['dateDebut'];
            $activite->dateFin = $_POST['dateFin'];
            $activite->photo = $_FILES['photoAct']['name'];


            $extensions_valides = array('jpg', 'jpeg', 'png');
            $extension_upload = strtolower(substr(strrchr($_FILES['photoAct']['name'], '.'), 1));


            $req = $Activites->find('all')->select('id')->where(['nomActivite' => $this->request->data('nomActivite')]);
            $nb = 0;
            foreach ($req as $existant) {
                $nb++;
            }
            if ($nb == 1) {
                $this->Flash->error(__('Erreur. Cette activité est déja organisée '));

            } elseif (!in_array($extension_upload, $extensions_valides)) {

                $this->Flash->error(__('Veuillez choisir l\'une des extensions :JPEG ,JPG Ou PNG'));
                return $this->redirect(['action' => 'addActivite']);


            } elseif ($Activites->save($activite)) {

                $photo = $_FILES['photoAct']['name'];
                $phototempo = $_FILES['photoAct']['tmp_name'];
                //debug($photo);
                move_uploaded_file($phototempo, WWW_ROOT . DS  . DS . '/img' . DS . $photo);

                $this->Flash->success(__('Activité Bien Ajoute '));
                return $this->redirect(['action' => 'addActivite']);
            } else {
                $this->Flash->error(__('Erreur .. Veuillez essayer un autre fois !'));
            }
        }
        $this->set(compact('activite'));
        $this->set('_serialize', ['activite']);
        $this->render('/Espaces/respopersonels/addActivite');
    }

    public function filtrerGradeFct()
    {
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Grades']
        ];
        $FonctionnairesGrades=TableRegistry::get('FonctionnairesGrades');

        if(isset($_POST['search']))
        {
            $indice=$_POST['search'];
            $fonctionnairesGrades = $this->paginate($FonctionnairesGrades->find('all')->where(['OR'=>
                ['Grades.nomGrade like '=>'%'.$indice.'%',' fonctionnaires.nom_fct like'=>'%'.$indice.'%'
                    ,' fonctionnaires.prenom_fct like'=>'%'.$indice.'%',' fonctionnaires.lieuNaissance like'=>'%'.$indice.'%',
                    'fonctionnaires.somme like '=>'%'.$indice.'%']]));
        }

        $this->set(compact('fonctionnairesGrades'));
        $this->set('_serialize', ['fonctionnairesGrades']);
        $this->render('/Espaces/respopersonels/filtrerGradeFct');
    }



    //FIN IBTISSAM
    // DEBUT KAWTAR AYOUJIL //
    public function abs(){

        $this->set(compact('absences'));
        $this->render('/Espaces/respopersonels/abs');

    }
    public function filterabs($limit=100)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $cat=$_POST['cat'];

        switch($_POST['recherche'])
        {
            case "id":
            {
                $absences=$con->execute("SELECT * FROM absences WHERE id LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('absences',$absences);
                break;
            }
            case "fonctionnaire_id":
            {
                $absences=$con->execute("SELECT * FROM absences WHERE fonctionnaire_id LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('absences',$absences);
                break;
            }
            case "duree_ab":
            {
                $absences=$con->execute("SELECT * FROM absences WHERE duree_ab LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('absences',$absences);
                break;
            }
            case "cause":
            {
                $absences=$con->execute("SELECT * FROM absences WHERE cause LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('absences',$absences);
                break;
            }
            case "date_ab":
            {
                $absences=$con->execute("SELECT * FROM absences WHERE date_ab LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('absences',$absences);
                break;
            }

            case "time_ab":
            {
                $absences=$con->execute("SELECT * FROM absences WHERE time_ab LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('absences',$absences);
                break;
            }
            default:
                echo "la requete demandée n'existe pas";
        }

        $this->render('/Espaces/respopersonels/filterabs');
    }

    public function listerAbsences()
    {
        $con=ConnectionManager::get('default');

        $absences=$con->execute("SELECT * FROM absences");
        $this->set('absences',$absences);
        $this->render('/Espaces/Respopersonels/listerAbsences');
    }
    public function listerAbsencesParDate()
    {
        $con=ConnectionManager::get('default');

        $absences=$con->execute("SELECT fonctionnaires.id,fonctionnaires.nom_fct , fonctionnaires.prenom_fct ,absences.cause,absences.date_ab FROM fonctionnaires,absences where( fonctionnaires.id=absences.fonctionnaire_id) ORDER BY absences.date_ab");
        $this->set('absences',$absences);
        $this->render('/Espaces/Respopersonels/listerAbsencesParDate');
    }
    public function gestionabsences()
    {
        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $this->render('/Espaces/respopersonels/home');
        $con=ConnectionManager::get('default');

        $demandes = $con->execute("SELECT absences.id, fonctionnaires.nom_fct, absences.fonctionnaire_id, fonctionnaires.prenom_fct,grades.codeGrade, services.nom_service,absences.duree_ab,absences.date_ab,absences.time_ab,absences.cause FROM absences,fonctionnaires,grades,services, fonctionnaires_grades, fonctionnaires_services WHERE isvalid = 0 AND fonctionnaires_grades.fonctionnaire_id = fonctionnaires.id AND fonctionnaires_grades.grade_id = grades.id AND fonctionnaires_services.fonctionnaire_id = fonctionnaires.id AND fonctionnaires_services.service_id = services.id AND absences.fonctionnaire_id = fonctionnaires.id")->fetchAll("assoc");
        //debug($demandes); die;
        if(empty($demandes))
        {
            $_SESSION['isdemande'] ='no';
        }
        else
        {
            $_SESSION['isdemande'] ='yes';
            $_SESSION['demandes'] = $demandes;

        }
        $this->render('/Espaces/respopersonels/gestionabsences');
    }

    public function traitementabs($id=null)
    {
        $con=ConnectionManager::get('default');
        $id_fonct = $_SESSION['demandes'][0]['fonctionnaire_id'];
        $duree = 0;
        $_SESSION['print'] = 'no';
        $_SESSION['refus'] = 'no';

        $nbr_absences = $con->execute("SELECT duree_ab FROM absences WHERE fonctionnaire_id = $id_fonct AND isvalid=1")->fetchAll("assoc");
        $nbr_abs = $con->execute("SELECT COUNT(*) as n FROM absences WHERE fonctionnaire_id = $id_fonct AND isvalid=1")->fetchAll("assoc");
        for ($i=0; $i <$nbr_abs[0]['n'] ; $i++)
        {
            $duree += $nbr_absences[0]['duree_ab'];
        }

        $_SESSION['nbr_abs'] = $duree;

        if(isset($_POST['refuser']))
        {
            $con->execute("UPDATE absences SET isvalid = 2 WHERE id = $id");
            $_SESSION['refus'] = 'yes';
        }

        if(isset($_POST['valider']))
        {
            $con->execute("UPDATE absences SET isvalid = 1 WHERE id = $id");
            $_SESSION['print'] = 'yes';
        }

        $this->render('/Espaces/respopersonels/viewKawtar');
    }

    public function Imprimer()
    {
        $this->render('/Espaces/respopersonels/imprimer');
    }



    // FIN KAWTAR AYOUJIL //


    //DEBUT MOUNA JELLOULI
    public function evolutionGrades()
    {
        $this->paginate = ['contain' => ['Grades', 'Fonctionnaires']];
        $FonctionnairesGrades = TableRegistry::get('FonctionnairesGrades');

        $con = ConnectionManager::get('default');
        $nombre = array();
        if($this->request->is('post'))
        {
            $fonctionnairesGrade = $this->paginate($FonctionnairesGrades->find('all',array(
                "joins" => array(
                    array(
                        "table" => "grades",
                        "conditions" => array( "fonctionnaires_grades.grade_id = grades.id")
                    ),
                    array(
                        "table" => "fonctionnaires",
                        "conditions" => array( "fonctionnaires_grades.fonctionnaire_id=fonctionnaire.id")
                    )))));
            $fonctionnaireG = $con->execute("SELECT FG.fonctionnaire_id, F.nom_fct, F.prenom_fct, F.somme, 
            G.codeGrade, G.nomGrade,G.categorie, FG.date_prise, FG.date_fin  FROM 
            fonctionnaires AS F,grades AS G,fonctionnaires_grades AS FG WHERE F.id = FG.fonctionnaire_id 
            AND G.id = FG.grade_id and F.nom_fct = ? ORDER By FG.date_fin DESC",
                [$this->request->data['somme']])->fetchAll('assoc');
        }
        else{

            $fonctionnaireG = $con->execute("SELECT FG.fonctionnaire_id, F.nom_fct, F.prenom_fct, F.somme, 
            G.codeGrade, G.nomGrade,G.categorie, FG.date_prise, FG.date_fin  FROM 
            fonctionnaires AS F,grades AS G,fonctionnaires_grades AS FG WHERE F.id = 
            FG.fonctionnaire_id AND 
            G.id = FG.grade_id ORDER BY  FG.fonctionnaire_id DESC ")->fetchAll('assoc');
        }
        for($k=0;$k<count($fonctionnaireG);$k++ ){
            if($k!=0 && $fonctionnaireG[$k]['fonctionnaire_id'] == $fonctionnaireG[$k-1]['fonctionnaire_id']){
                $temp = $nombre[$fonctionnaireG[$k]['fonctionnaire_id']] ;
                $nombre[$fonctionnaireG[$k]['fonctionnaire_id']] = $temp +1;
            }else{
                $nombre[$fonctionnaireG[$k]['fonctionnaire_id']] = 1;
            }
        }
        $this->set('FonctionnairesGrades',$FonctionnairesGrades);
        $this->set('nombre',$nombre);
        $this->set('fonctionnaireG',$fonctionnaireG);
        return $this->render('/Espaces/respopersonels/evo2');
    }


    public function evolutionGradesm()
    {
        $this->paginate = ['contain' => ['Grades', 'Fonctionnaires']];
        $FonctionnairesGrades = TableRegistry::get('FonctionnairesGrades');

        $con = ConnectionManager::get('default');
        $nombre = array();
        if($this->request->is('post'))
        {
            $fonctionnairesGrade = $this->paginate($FonctionnairesGrades->find('all',array(
                "joins" => array(
                    array(
                        "table" => "grades",
                        "conditions" => array( "fonctionnaires_grades.grade_id = grades.id")
                    ),
                    array(
                        "table" => "fonctionnaires",
                        "conditions" => array( "fonctionnaires_grades.fonctionnaire_id=fonctionnaire.id")
                    )))));
            $fonctionnaireG = $con->execute("SELECT FG.fonctionnaire_id, F.nom_fct, F.prenom_fct, F.somme, 
            G.codeGrade, G.nom_grade,G.categorie_grade, FG.date_prise, FG.date_fin  FROM 
            fonctionnaires AS F,grades AS G,fonctionnaires_grades AS FG WHERE F.id = FG.fonctionnaire_id 
            AND G.id = FG.grade_id and F.nom_fct = ? ORDER By FG.date_fin DESC",
                [$this->request->data['somme']])->fetchAll('assoc');
        }
        else{

            $fonctionnaireG = $con->execute("SELECT FG.fonctionnaire_id, F.nom_fct, F.prenom_fct, F.somme, 
            G.codeGrade, G.nom_grade,G.categorie_grade, FG.date_prise, FG.date_fin  FROM 
            fonctionnaires AS F,grades AS G,fonctionnaires_grades AS FG WHERE F.id = 
            FG.fonctionnaire_id AND 
            G.id = FG.grade_id ORDER BY  FG.fonctionnaire_id DESC ")->fetchAll('assoc');
        }
        for($k=0;$k<count($fonctionnaireG);$k++ ){
            if($k!=0 && $fonctionnaireG[$k]['fonctionnaire_id'] == $fonctionnaireG[$k-1]['fonctionnaire_id']){
                $temp = $nombre[$fonctionnaireG[$k]['fonctionnaire_id']] ;
                $nombre[$fonctionnaireG[$k]['fonctionnaire_id']] = $temp +1;
            }else{
                $nombre[$fonctionnaireG[$k]['fonctionnaire_id']] = 1;
            }
        }
        $this->set('FonctionnairesGrades',$FonctionnairesGrades);
        $this->set('nombre',$nombre);
        $this->set('fonctionnaireG',$fonctionnaireG);
        return $this->render('/Espaces/respopersonels/evo2');
    }
    public function voirDemandes()
    {
        $modif = ConnectionManager::get('default');

        $profpermabis = $modif->execute("SELECT * FROM profpermanentsbis  ORDER BY date_envoi DESC ")->fetchAll('assoc');
        if(empty($profpermabis)){
            echo "no data's edit has been sent";
        }

        $this->set('profpermabis', $profpermabis);
        $this->set('_serialize', ['profpermabis']);

        $this->render('/Espaces/respopersonels/voirDemandes');

    }

    public function validerDonnees($id=null)
    {
        $con = ConnectionManager::get('default');

        $profpermabis = $con->execute("SELECT somme, poste, echelle, echelon, 
            etat , date_Recrut,nom_prof, prenom_prof, age , diplome, specialite, universite , autresdiplomes, situation_familiale, code_situation_admin, dateNaissance, codeEtablissement, Lieu_Naissance, CIN, phone, email_prof FROM 
            profpermanentsbis WHERE id = $id   
              ")->fetchAll('assoc');
        $this->set("id",$id);


        if(isset($_POST['save']))
        {


            $idd0 = $profpermabis[0]['nom_prof'];
            $idd1 = $profpermabis[0]['prenom_prof'];
            $idd2 = $profpermabis[0]['somme'];
            $idd3 = $profpermabis[0]['poste'];
            $idd4 = $profpermabis[0]['echelle'];
            $idd5 = $profpermabis[0]['echelon'];
            $idd6 = $profpermabis[0]['etat'];
            $idd7 = $profpermabis[0]['date_Recrut'];
            $idd8 = $profpermabis[0]['age'];
            $idd9 = $profpermabis[0]['diplome'];
            $idd10 = $profpermabis[0]['specialite'];
            $idd11= $profpermabis[0]['universite'];
            $idd12 = $profpermabis[0]['autresdiplomes'];
            $idd13 = $profpermabis[0]['situation_familiale'];
            $idd14 = $profpermabis[0]['code_situation_admin'];
            $idd15 = $profpermabis[0]['dateNaissance'];
            $idd16 = $profpermabis[0]['codeEtablissement'];
            $idd17 = $profpermabis[0]['Lieu_Naissance'];
            $idd18 = $profpermabis[0]['CIN'];
            $idd19 = $profpermabis[0]['phone'];
            $idd20 = $profpermabis[0]['email_prof'];


            $con->execute( " UPDATE Profpermanents SET nom_prof='$idd0',prenom_prof='$idd1', somme='$idd2', poste='$idd3', echelle='$idd4', etat='$idd5', Lieu_Naissance='$idd17',
    date_Recrut='$idd6', age='$idd7',CIN='$idd18', diplome='$idd8',specialite='$idd9', 
     phone='$idd19', email_prof='$idd20', universite='$idd11', autresdiplomes='$idd12', situation_familiale='$idd13', dateNaissance='$idd15' WHERE id='$id' " );
            $con->execute(" DELETE FROM  Profpermanentsbis where id=$id");
            $this->Flash->success(__('les données sont validées avec succés'));


        }



        $this->set('profpermabis', $profpermabis);
        $this->set('_serialize', ['profpermabis']);

        $this->render('/Espaces/respopersonels/validerDonnees');

    }

    public function voirDemandesVac()
    {
        $modiff = ConnectionManager::get('default');

        $profvacbis = $modiff->execute("SELECT * FROM vacatairesbis ORDER BY date_envoi DESC ")->fetchAll('assoc');
        if(empty($profvacbis)){
            echo "no data's edit has been sent";
        }

        $this->set('profvacbis', $profvacbis);
        $this->set('_serialize', ['profvacbis']);

        $this->render('/Espaces/respopersonels/voirDemandesVac');

    }


    public function validerDonneesVac($id=null)
    {
        $con = ConnectionManager::get('default');

        $profvacbis = $con->execute("SELECT * FROM  vacatairesbis WHERE id = $id ")->fetchAll('assoc');
        $this->set("id",$id);


        if(isset($_POST['save']))
        {


            $idd0 = $profvacbis[0]['nom_vacataire'];
            $idd1 = $profvacbis[0]['prenom_vacataire'];
            $idd18 = $profvacbis[0]['CIN'];
            $idd2 = $profvacbis[0]['somme'];
            $idd3 = $profvacbis[0]['nb_heures'];
            $idd4 = $profvacbis[0]['echelle'];
            $idd5 = $profvacbis[0]['echelon'];
            //$idd6 = $profvacbis[0]['etat'];
            $idd7 = $profvacbis[0]['dateRecrut'];

            $idd9 = $profvacbis[0]['diplome'];
            $idd10 = $profvacbis[0]['specialite'];
            $idd11= $profvacbis[0]['universite'];
            $idd12 = $profvacbis[0]['dateAffectation'];
            $idd13 = $profvacbis[0]['situationFamiliale'];

            $idd15 = $profvacbis[0]['dateNaissance'];

            $idd6 = $profvacbis[0]['LieuNaissance'];
            $idd8 = $profvacbis[0]['phone'];
            $idd16 = $profvacbis[0]['email_prof'];




            $con->execute( " UPDATE Vacataires SET nom_vacataire='$idd0',prenom_vacataire='$idd1', somme='$idd2', nb_heures='$idd3', echelle='$idd4', echelon='$idd5', diplome='$idd9', specialite='$idd10', specialite='$idd10',
    universite='$idd11', dateAffectation='$idd12', situationFamiliale='$idd13', DateNaissance='$idd15' , LieuNaissance='$idd6', phone='$idd8', email_prof='$idd16' WHERE id='$id' " );
            $con->execute(" DELETE FROM  vacatairesbis where id=$id");
            $this->Flash->success(__('les données sont validées avec succés'));


        }



        $this->set('profvacbis',  $profvacbis);
        $this->set('_serialize', [' $profvacbis']);

        $this->render('/Espaces/respopersonels/validerDonneesVac');

    }





// FIN JELLOULI


    //DEBUT ASMAA SARIH
    public function addper()
    {
        $profpermanents = TableRegistry::get('profpermanents');
        $users = TableRegistry::get('users');
        $profpermanent = $profpermanents->newEntity();
        $user = $users->newEntity();

        if ($this->request->is('post')) {
           /* $user = $users->patchEntity($user, $this->request->data, [
                ]);*/
             $user->username=$this->request->data['username'];
             $pass=$this->request->data['password'];
             $user->password=$pass;
             $user->role='profpermanent';
            if ($users->save($user)) {

                $profpermanent = $profpermanents->patchEntity($profpermanent, $this->request->data);
                $profpermanent->user_id= $user->id;
                if ($profpermanents->save($profpermanent)) {
                    $this->Flash->success(__('The profpermanent has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The profpermanent could not be saved. Please, try again.'));
            }
        }
        $users = $profpermanents->Users->find('list', ['limit' => 200]);
        $this->set(compact('profpermanent', 'users', 'activites', 'departements', 'disciplines', 'documents', 'grades'));
        $this->set('_serialize', ['profpermanent']);
        $this->render('/Espaces/respopersonels/addper');
    }
    public function printListeprofpermanent()
    {
        $profpermanent = TableRegistry::get('profpermanents');
        $profpermanents = $this->paginate($profpermanent);
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set(compact('profpermanents'));
        $this->set('_serialize', ['profpermanents']);
        $this->render('/Espaces/respopersonels/printListeprofpermanent');
    }

    public function permanentsliste()
    {
        $profpermanents = TableRegistry::get('profpermanents');
        $this->paginate = [
            'contain' => ['Users']
        ];

        $profpermanents = $this->paginate($profpermanents);

        $this->set(compact('profpermanents'));
        $this->set('_serialize', ['profpermanent']);
        $this->render('/Espaces/respopersonels/permanentsliste');
    }

    public function viewprofpermanents($id = null)
    {

        $profpermanents = TableRegistry::get('profpermanents');
        $profpermanent = $profpermanents->get($id);
        $this->set('profpermanent', $profpermanent);
        $this->set('_serialize', ['profpermanent']);
        $this->render('/Espaces/respopersonels/viewprofpermanents');
    }
    public function editprofpermanents($id = null)
    {
        $profpermanents = TableRegistry::get('profpermanents');
        $profpermanent = $profpermanents->get($id, [
            'contain' => ['Activites', 'Departements', 'Disciplines', 'Documents', 'Grades']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $profpermanent = $profpermanents->patchEntity($profpermanent, $this->request->data);
            if ($profpermanents->save($profpermanent)) {
                $this->Flash->success(__('The profpermanent has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profpermanent could not be saved. Please, try again.'));
        }
        $users = $profpermanents->Users->find('list', ['limit' => 200]);

        $this->set(compact('profpermanent', 'users', 'activites', 'departements', 'disciplines', 'documents', 'grades'));
        $this->set('_serialize', ['profpermanent']);
        $this->render('/Espaces/respopersonels/editprofpermanents');

    }
    public function deleteprofpermanents($id = null)
    {
        $profpermanents = TableRegistry::get('profpermanents');
        $this->request->allowMethod(['post', 'delete']);
        $profpermanent = $profpermanents->get($id);
        if ($profpermanents->delete($profpermanent)) {
            $this->Flash->success(__('The profpermanent has been deleted.'));
        } else {
            $this->Flash->error(__('The profpermanent could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function exportPermanent($limit=100)
    {
        $cat=$_POST["cat"];
        $_SESSION['cat']=$cat;
        $profpermanents=TableRegistry::get('profpermanents')->find('all')->limit($limit)->where(['nom_prof like'=>'%'.$cat.'%']);
        $this->set(compact('profpermanents'));
        $this->set('_serialize', ['profpermanents']);
        $this->render('/Espaces/respopersonels/exportPermanent');

    }

    public function addvac()
    {
        $Vacataires = TableRegistry::get('Vacataires');
        $users = TableRegistry::get('users');
        $vacataire = $Vacataires->newEntity();
        $user = $users->newEntity();
        if ($this->request->is('post')) {
            $user->username=$this->request->data['username'];
            $user->password=$this->request->data['password'];
            $user->role='profvacataire';
            if ($users->save($user)) {
                $vacataire = $Vacataires->patchEntity($vacataire, $this->request->data);
                $vacataire->user_id= $user->id;

                if ($Vacataires->save($vacataire)) {
                    $this->Flash->success(__('The vacataire has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The vacataire could not be saved. Please, try again.'));
            }
        }
        $users = $Vacataires->Users->find('list', ['limit' => 200]);
        $this->set(compact('user', 'users', 'activites', 'departements', 'disciplines', 'grades'));
        $this->set(compact('vacataire', 'users', 'activites', 'departements', 'disciplines', 'grades'));
        $this->set('_serialize', ['vacataire']);
        $this->set('_serialize', ['user']);
        $this->render('/Espaces/respopersonels/addvac');
    }



    public function printListeVacataire()
    {
        $vacataire = TableRegistry::get('vacataires');
        $vacataires = $this->paginate($vacataire);
        $this->paginate = [
            'contain' => ['Users']
        ];


        $this->set(compact('vacataires'));
        $this->set('_serialize', ['vacataires']);
        $this->render('/Espaces/respopersonels/printListeVacataire');
    }

    public function vacatairesliste()
    {
        $vacataire = TableRegistry::get('vacataires');
        $vacataires = $this->paginate($vacataire);
        $this->paginate = [
            'contain' => ['Users']
        ];


        $this->set(compact('vacataires'));
        $this->set('_serialize', ['vacataires']);
        $this->render('/Espaces/respopersonels/vacatairesliste');
    }
    public function exportVacataires($limit=100)
    {
        $cat=$_POST["cat"];
        $_SESSION['cat']=$cat;
        $vacataires=TableRegistry::get('vacataires')->find('all')->limit($limit)->where(['nom_vacataire like'=>'%'.$cat.'%']);
        $this->set(compact('vacataires'));
        $this->set('_serialize', ['vacataires']);
        $this->render('/Espaces/respopersonels/exportVacataires');

    }
    public function viewvacataire($id = null)
    {
        $Vacataires = TableRegistry::get('Vacataires');
        $vacataire = $Vacataires->get($id);

        $this->set('vacataire', $vacataire);
        $this->set('_serialize', ['vacataire']);
        $this->render('/Espaces/respopersonels/viewvacataire');
    }
    public function editvacataire($id = null)
    {
        $Vacataires = TableRegistry::get('Vacataires');
        $vacataire = $Vacataires->get($id, [
            'contain' => ['Activites', 'Departements', 'Disciplines', 'Grades']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vacataire = $Vacataires->patchEntity($vacataire, $this->request->data);
            if ($Vacataires->save($vacataire)) {
                $this->Flash->success(__('The vacataire has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vacataire could not be saved. Please, try again.'));
        }
        $this->set(compact('vacataire', 'users', 'activites', 'departements', 'disciplines', 'grades'));
        $this->set('_serialize', ['vacataire']);
        $this->render('/Espaces/respopersonels/editvacataire');
    }
    public function deletevacataire($id = null)
    {

        $Vacataires = TableRegistry::get('Vacataires');
        $this->request->allowMethod(['post', 'delete']);
        $vacataire = $Vacataires->get($id);
        if ($Vacataires->delete($vacataire)) {
            $this->Flash->success(__('The vacataire has been deleted.'));
        } else {
            $this->Flash->error(__('The vacataire could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function addfonc()
    {
        $fonctionnaires = TableRegistry::get('fonctionnaires');
        $users = TableRegistry::get('users');
        $fonctionnaire = $fonctionnaires->newEntity();
        $user = $users->newEntity();
        if ($this->request->is('post')) {
            $user->username=$this->request->data['username'];
            $pass=$this->request->data['password'];
            $user->password=$pass;
            $user->role=$this->request->data['dawr'];

            if ($users->save($user)) {
                $fonctionnaire = $fonctionnaires->patchEntity($fonctionnaire, $this->request->data);
                $fonctionnaire->user_id= $user->id;

                if ($fonctionnaires->save($fonctionnaire)) {
                    $this->Flash->success(__('The fonctionnaire has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The fonctionnaire could not be saved. Please, try again.'));
            }
        }
        $users = $fonctionnaires->Users->find('list', ['limit' => 200]);
        $this->set(compact('fonctionnaire', 'users', 'activites', 'departements', 'disciplines', 'grades'));
        $this->set('_serialize', ['fonctionnaire']);
        $this->render('/Espaces/respopersonels/addfonc');
    }
    public function fonctionnairesliste()
    {
        $fonctionnaire = TableRegistry::get('fonctionnaires');
        $fonctionnaires = $this->paginate($fonctionnaire);
        $this->paginate = [
            'contain' => ['Users']
        ];


        $this->set(compact('fonctionnaires'));
        $this->set('_serialize', ['fonctionnaires']);
        $this->render('/Espaces/respopersonels/fonctionnairesliste');
    }
    public function viewfonctionnaire($id = null)
    {
        $fonctionnaires = TableRegistry::get('fonctionnaires');
        $fonctionnaire = $fonctionnaires->get($id);

        $this->set('fonctionnaire', $fonctionnaire);
        $this->set('_serialize', ['fonctionnaire']);
        $this->render('/Espaces/respopersonels/viewfonctionnaire');
    }
    public function editfonctionnaire($id = null)
    {
        $fonctionnaires = TableRegistry::get('fonctionnaires');
        $fonctionnaire = $fonctionnaires->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fonctionnaire = $fonctionnaires->patchEntity($fonctionnaire, $this->request->data);
            if ($fonctionnaires->save($fonctionnaire)) {
                $this->Flash->success(__('The fonctionnaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fonctionnaire could not be saved. Please, try again.'));
        }
        $this->set(compact('fonctionnaire', 'users'));
        $this->set('_serialize', ['fonctionnaire']);
        $this->render('/Espaces/respopersonels/editfonctionnaire');
    }
    public function deletefonctionnaire($id = null)
    {

        $Fonctionnaires = TableRegistry::get('Fonctionnaires');
        $this->request->allowMethod(['post', 'delete']);
        $fonctionnaire = $Fonctionnaires->get($id);
        if ($Fonctionnaires->delete($fonctionnaire)) {
            $this->Flash->success(__('The fonctionnaire has been deleted.'));
        } else {
            $this->Flash->error(__('The fonctionnaire could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function printListeFonctionnaire()
    {
        $fonctionnaire = TableRegistry::get('fonctionnaires');
        $fonctionnaires = $this->paginate($fonctionnaire);
        $this->paginate = [
            'contain' => ['Users']
        ];


        $this->set(compact('fonctionnaires'));
        $this->set('_serialize', ['fonctionnaires']);
        $this->render('/Espaces/respopersonels/printListeFonctionnaire');
    }
    public function exportFonctionnaire($limit=100)
    {
        $cat=$_POST["cat"];
        $_SESSION['cat']=$cat;
        $fonctionnaires=TableRegistry::get('fonctionnaires')->find('all')->limit($limit)->where(['nom_fct like'=>'%'.$cat.'%']);
        $this->set(compact('fonctionnaires'));
        $this->set('_serialize', ['fonctionnaires']);
        $this->render('/Espaces/respopersonels/exportFonctionnaire');

    }

    //FIN ASMAA SARIH

    /// DEBUT OMAR RAY
    ////////////////////////////////////////////////////////////////////////////////////omar raay debut////////////////////////
     /********** version bis ancienne ****************/
    public function viewVacationb($id = null)
    {
        $this->loadModel('Vacations');
        $vacation = $this->Vacations->get($id, [
            'contain' => ['Vacataires']
        ]);

        $this->set('vacation', $vacation);
        $this->set('_serialize', ['vacation']);
        $this->render('/Espaces/respopersonels/viewVacation');
    }


    public function supprimerVacationb($id = null)
    {
        $this->loadModel('Vacations');
        $this->request->allowMethod(['post', 'delete']);
        $vacation = $this->Vacations->get($id);
        if ($this->Vacations->delete($vacation)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Vacation'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Vacation'));
        }
        return $this->redirect(['action' => 'vacations']);
    }
    public function modifierVacationb($id = null){
        $this->loadModel('Vacations');
        $this->loadModel('Vacataires');

        $quer = $this->Vacataires->find()
            ->where(['user_id' => $this->Auth->user('id')]);
        //  $vacataire = $this->Vacataires->get($this->Auth->user('id'));
        foreach ($quer as $row) {
            if($row->id){
                $vacataire=$row;
            }
        }

        if(($vacataire->somme!= "SANS")){
            $max=20;
        }else {
            $max=30;
        }

        $vacation = $this->Vacations->get($id, [
            'contain' => []
        ]);


        if ($this->request->is(['patch', 'post', 'put'])) {
            $vacation = $this->Vacations->patchEntity($vacation, $this->request->data);
            if ($this->Vacations->save($vacation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Vacation'));
                return $this->redirect(['action' => 'vacations']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Vacation'));
            }
        }


        $this->set(compact('vacation', 'max'));
        $this->set('_serialize', ['vacation']);
        $this->render('/Espaces/respopersonels/modifierVacation');
    }
    public function vacationsb()
    {
        $this->loadModel('Vacations');
        $this->loadModel('Vacataires');

        $quer = $this->Vacataires->find()
            ->where(['user_id' => $this->Auth->user('id')]);
        //  $vacataire = $this->Vacataires->get($this->Auth->user('id'));
        foreach ($quer as $row) {
            if($row->id){
                $vacataire=$row;
            }
        }

        $this->paginate = [
            'contain' => ['Vacataires']
        ];
        $query = $this->Vacations->find()

            ->where(['vacataire_id' => $vacataire->id]);
        $vacations= $this->paginate( $query);

        $this->set(compact('vacations'));
        $this->set('_serialize', ['vacations']);
        $this->render('/Espaces/respopersonels/vacations');
    }



    ////////////////////////////////////////////////////////////////////////////////////omar raay debut////////////////////////

    public function listepardepb()
    {
        $con=ConnectionManager::get('default');
        $books=$con->execute("SELECT vacataires.id,vacataires.nom_vacataire,vacataires.prenom_vacataire,vacataires.somme,departements.nom_departement from vacataires,departements,vacataires_departements where(vacataires.id=vacataires_departements.vacataire_id AND departements.id=vacataires_departements.departement_id)
         ")->fetchAll('assoc');
        $this->set('books',$books);
        $this->render('/Espaces/respopersonels/listepardep');


    }


    public function listepardisciplineb()
    {
        $con=ConnectionManager::get('default');
        $books=$con->execute("SELECT vacataires.id,vacataires.nom_vacataire,vacataires.prenom_vacataire,vacataires.somme,disciplines.nom_discipline from vacataires,disciplines,vacataires_disciplines where(vacataires.id=vacataires_disciplines.vacataire_id AND disciplines.id=vacataires_disciplines.discipline_id)
         ")->fetchAll('assoc');
        $this->set('books',$books);
        $this->render('/Espaces/respopersonels/listepardiscipline');


    }

    public function resultrechercheparinputb(){

        $search = $this->request->data('search');
        $con = ConnectionManager::get('default');
        //if(in_array($search, vacataires))
        $books = $con->execute("SELECT * FROM vacataires where somme  like '%" . $search . "%' ")->fetchAll('assoc');
        $this->set('books', $books);
        $this->render('/Espaces/respopersonels/resultrechercheparinput');
    }



    public function rechercheparinputb(){


        $this->render('/Espaces/respopersonels/rechercheparinput');
    }


    public function resultrechercheparinputdepartementb(){

        $search = $this->request->data('search');
        $con = ConnectionManager::get('default');
        $books = $con->execute("SELECT vacataire_id,departement_id FROM vacataires_departements where id  like '%" . $search . "%' ")->fetchAll('assoc');
        $this->set('books', $books);
        $this->render('/Espaces/respopersonels/resultrechercheparinputdepartement');
    }


    public function rechercheparinputdepartementb(){


        $this->render('/Espaces/respopersonels/rechercheparinputdepartement');
    }

    /**ùù fin version omar bis ancienne ******/

    /**** nouvelle version *****/


    public function listepardep()
    {
        $con=ConnectionManager::get('default');
        $books=$con->execute("SELECT vacataires.nom_vacataire,vacataires.prenom_vacataire,vacataires.somme,departements.nom_departement from vacataires,departements,vacataires_departements where(vacataires.id=vacataires_departements.vacataire_id AND departements.id=vacataires_departements.departement_id)
         ")->fetchAll('assoc');
        $this->set('books',$books);
        $this->render('/Espaces/respopersonels/listepardep');


    }


    public function listepardiscipline()
    {
        $con=ConnectionManager::get('default');
        $books=$con->execute("SELECT vacataires.id,vacataires.nom_vacataire,vacataires.prenom_vacataire,vacataires.somme,disciplines.nom_discipline from vacataires,disciplines,vacataires_disciplines where(vacataires.id=vacataires_disciplines.vacataire_id AND disciplines.id=vacataires_disciplines.discipline_id)
         ")->fetchAll('assoc');
        $this->set('books',$books);
        $this->render('/Espaces/respopersonels/listepardiscipline');


    }

    public function resultrechercheparinput(){
        $search = $this->request->data('search');
        $con = ConnectionManager::get('default');

        $books = $con->execute("SELECT * FROM vacataires where somme  like '%" . $search . "%' ")->fetchAll('assoc');
        /*echo "<pre>";
        print_r($books);die();
        if(!empty($books)){*/
        $this->set('books', $books);
        $this->render('/Espaces/respopersonels/resultrechercheparinput');

    }
    /*else{

      $message="ce numero de somme n'existe pas";
      $this->set('message', $message);
      $this->set('books', $books);
        $this->render('/Espaces/respopersonels/resultrechercheparinput');
    }*/

    /*omar}*/

    public function rechercheparinput(){


        $this->render('/Espaces/respopersonels/rechercheparinput');
    }


    public function resultrechercheparinputdepartement(){

        $search = $this->request->data('search');
        $con = ConnectionManager::get('default');
        $books = $con->execute("SELECT vacataire_id,departement_id FROM vacataires_departements where id  like '%" . $search . "%' ")->fetchAll('assoc');
        $this->set('books', $books);
        $this->render('/Espaces/respopersonels/resultrechercheparinputdepartement');
    }


    public function rechercheparinputdepartement(){


        $this->render('/Espaces/respopersonels/rechercheparinputdepartement');
    }


    public function vacations()
    {
        $this->loadModel('Vacations');
        $this->loadModel('Vacataires');

        $quer = $this->Vacataires->find()
            ->where(['user_id' => $this->Auth->user('id')]);
        // $vacataire = $this->Vacataires->get($this->Auth->user('id'));
        foreach ($quer as $row) {
            if($row->id){
                $vacataire=$row;
            }
        }

        $this->paginate = [
            'contain' => ['Vacataires']
        ];
        $query = $this->Vacations->find()

            ->where(['vacataire_id' => $vacataire->id]);
        $vacations= $this->paginate( $query);

        $this->set(compact('vacations'));
        $this->set('_serialize', ['vacations']);
        $this->render('/Espaces/respopersonels/vacations');
    }
   /*public function saisienbheures(){

        $con = ConnectionManager::get('default');

            if ($this->request->is(['post'])) {
                $search = $this->request->data();



                $con->execute("INSERT INTO nbheures (id, nbheures, dat, vac_id) VALUES
              (NULL, '" . $search['choix'] . "', '" . $search['date'] . "','" . $this->Auth->user('id') . "');");

            }
               $id=$this->Auth->user('id');
                   $this->set('id',$id);


                $this->render('/Espaces/respopersonels/saisienbheures');
    }
    */
//abdo

    public function modifierVacation($id = null){
        $this->loadModel('Vacations');
        $this->loadModel('Vacataires');

        $quer = $this->Vacataires->find()
            ->where(['user_id' => $this->Auth->user('id')]);
        //  $vacataire = $this->Vacataires->get($this->Auth->user('id'));
        foreach ($quer as $row) {
            if($row->id){
                $vacataire=$row;
            }
        }

        if(($vacataire->somme!= "SANS")){
            $max=20;
        }else {
            $max=30;
        }

        $vacation = $this->Vacations->get($id, [
            'contain' => []
        ]);


        if ($this->request->is(['patch', 'post', 'put'])) {
            $vacation = $this->Vacations->patchEntity($vacation, $this->request->data);
            if ($this->Vacations->save($vacation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Vacation'));
                return $this->redirect(['action' => 'vacations']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Vacation'));
            }
        }


        $this->set(compact('vacation', 'max'));
        $this->set('_serialize', ['vacation']);
        $this->render('/Espaces/respopersonels/modifierVacation');
    }

    public function saisienbheures()
    {
        $this->loadModel('Vacations');
        $this->loadModel('Vacataires');

        $quer = $this->Vacataires->find()
            ->where(['user_id' => $this->Auth->user('id')]);
        //  $vacataire = $this->Vacataires->get($this->Auth->user('id'));
        foreach ($quer as $row) {
            if($row->id){
                $vacataire=$row;
            }
        }

        if(($vacataire->somme!= "SANS")){
            $max=20;
        }else {
            $max=30;
        }

        $vacation = $this->Vacations->newEntity();

        if ($this->request->is('post')) {
            $vacation = $this->Vacations->patchEntity($vacation, $this->request->data);
            $vacation->dateInsertion=date('Y-m-d H:i:s');
            $vacation->etat="non validé";
            $vacation->vacataire_id= $vacataire->id;




            $quer = $this->Vacations->find()
                ->where(['mois' => $vacation->mois])
                ->where(['annee' => $vacation->annee])
                ->where(['vacataire_id' => $vacation->vacataire_id]);
            $bol=false;

            foreach ($quer as $row) {
                if($row->id){
                    $bol=true;
                }
            }


            if($bol){

                $this->Flash->error(__('ce mois deja remplis '));

            }

            else if ($this->Vacations->save($vacation)) {
                $this->Flash->success(__('The vacation has been saved.'));

                return $this->redirect(['action' => 'vacations']);

            }else
                $this->Flash->error(__('The vacation could not be saved. Please, try again.'));

        }




        $vacataires = $this->Vacations->Vacataires->find('list', ['limit' => 200]);
        $paimentvacs = $this->Vacations->Paimentvacs->find('list', ['limit' => 200]);
        $this->set(compact('vacation', 'max'));
        $this->set('_serialize', ['vacation']);

        $this->render('/Espaces/respopersonels/saisienbheures');
    }


    public function viewVacation($id = null)
    {
        $this->loadModel('Vacations');
        $vacation = $this->Vacations->get($id, [
            'contain' => ['Vacataires']
        ]);

        $this->set('vacation', $vacation);
        $this->set('_serialize', ['vacation']);
        $this->render('/Espaces/respopersonels/viewVacation');
    }


    public function supprimerVacation($id = null)
    {
        $this->loadModel('Vacations');
        $this->request->allowMethod(['post', 'delete']);
        $vacation = $this->Vacations->get($id);
        if ($this->Vacations->delete($vacation)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Vacation'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Vacation'));
        }
        return $this->redirect(['action' => 'vacations']);
    }

    public function demandedocs(){

        $con = ConnectionManager::get('default');

        /*  if ($this->request->is(['post'])) {
              $search = $this->request->data();
              //dump($search);
              //exit;
              $quer = $this->Vacataires->find()
                      ->where(['user_id' => $this->Auth->user('id')]);
        //  $vacataire = $this->Vacataires->get($this->Auth->user('id'));
              foreach ($quer as $row) {
                      if($row->id){
                          $vacataire=$row;
                      }
                  }

              $con->execute("INSERT INTO vacataires_documents (id,vacataire_id,type_document) VALUES
            (NULL,'" . $vacataire->id . "','" . $search['choix'] . "');");


          }*/


        $this->loadModel('Vacataires');
        $this->loadModel('VacatairesDocuments');
        $vacatairesDocument = $this->VacatairesDocuments->newEntity();
        if ($this->request->is('post')) {
            $quer = $this->Vacataires->find()
                ->where(['user_id' => $this->Auth->user('id')]);
            foreach ($quer as $row) {
                if($row->id){
                    $vacataire=$row;
                }
            }
            $vacatairesDocument->type_document=$this->request->data['choix'];
            $vacatairesDocument->vacataire_id=$vacataire->id;

            if ($this->VacatairesDocuments->save($vacatairesDocument)) {
                $this->Flash->success(__('votre demande a été  bien envoyée'));

                $id=$this->Auth->user('id');
                $this->set('id',$id);


                return $this->redirect(['action' => 'demandedocs']);
            } else {
                $this->Flash->error(__(' votre demande n\'aest   pas  envoyée essayé à nouveau' ));
            }
        }
        $id=$this->Auth->user('id');
        $this->set('id',$id);
        $this->set(compact('vacatairesDocument'));
        $this->render('/Espaces/respopersonels/demandedocs');
    }


    public function consultation($id=NULL){


        $con = ConnectionManager::get('default');
        $books = $con->execute( "SELECT vacataires.nom_vacataire,vacataires.prenom_vacataire,vacataires.CIN,vacataires.somme,vacataires.dateRecrut FROM vacataires where vacataires.id='".$id."'")->fetchAll('assoc');


        $this->set('books', $books);
        $this->render('/Espaces/respopersonels/consultation');

    }
    public function vacatairedocument()
    {
        $this->loadModel('VacatairesDocuments');
        $this->paginate = [
            'contain' => ['Vacataires']
        ];
        $vacatairesDocuments = $this->paginate($this->VacatairesDocuments);

        $this->set(compact('vacatairesDocuments'));
        $this->set('_serialize', ['vacatairesDocuments']);
        $this->render('/Espaces/respopersonels/vacataireDocument');
    }


    /*public function viewVacataire($id = null)
    {
        $vacataire = $this->Vacataires->get($id, [
            'contain' => ['Activites', 'Departements', 'Disciplines', 'Grades', 'Documents', 'Vacations']
        ]);

        $this->set('vacataire', $vacataire);
        $this->set('_serialize', ['vacataire']);
    }*/



    public function affecteraundepart()
    {
        $this->loadModel('VacatairesDepartements');
        $this->loadModel('Vacataires');
        $this->loadModel('Departements');
        $vacatairesDepartement = $this->VacatairesDepartements->newEntity();
        if ($this->request->is('post')) {



            $vacatairesDepartement = $this->VacatairesDepartements->patchEntity($vacatairesDepartement, $this->request->data);

            $quer = $this->VacatairesDepartements->find()
                ->where(['vacataire_id' => $vacatairesDepartement->vacataire_id])
                ->where(['departement_id' => $vacatairesDepartement->departement_id]);
            //  $vacataire = $this->Vacataires->get($this->Auth->user('id'));
            $bol=false;
            foreach ($quer as $row) {
                if($row->id){
                    $bol =true;
                }
            }
            if($bol){
                $this->Flash->error(__('departement deja affecte'));
            }
            else if ($this->VacatairesDepartements->save($vacatairesDepartement)) {
                $this->Flash->success(__('The {0} has been saved.', 'Vacataires Departement'));
                return $this->redirect(['action' => 'viewvacatairre/'.$vacatairesDepartement->vacataire_id.'']);

            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Vacataires Departement'));
            }
        }
        $vacataires = $this->Vacataires->find();
        $departements = $this->Departements->find();

        $this->set(compact('vacatairesDepartement', 'vacataires', 'departements'));
        $this->set('_serialize', ['vacatairesDepartement']);
        $this->render('/Espaces/respopersonels/affecteraundepart');
    }
    public function affectergrades()
    {
        $this->loadModel('VacatairesGrades');
        $this->loadModel('Vacataires');
        $this->loadModel('Grades');
        $vacatairesGrade = $this->VacatairesGrades->newEntity();
        if ($this->request->is('post')) {
            $vacatairesGrade = $this->VacatairesGrades->patchEntity($vacatairesGrade, $this->request->data);
            $quer = $this->VacatairesGrades->find()
                ->where(['vacataire_id' => $vacatairesGrade->vacataire_id])
                ->where(['grade_id' => $vacatairesGrade->grade_id]);
            //  $vacataire = $this->Vacataires->get($this->Auth->user('id'));
            $bol=false;
            foreach ($quer as $row) {
                if($row->id){
                    $bol =true;
                }
            }
            if($bol){
                $this->Flash->error(__('grade deja affecte'));
            }
            else if ($this->VacatairesGrades->save($vacatairesGrade)) {
                $this->Flash->success(__('The {0} has been saved.', 'Vacataires Grade'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Vacataires Grade'));
            }
        }
        $grades = $this->Grades->find();
        $vacataires = $this->Vacataires->find();
        $this->set(compact('vacatairesGrade', 'grades', 'vacataires'));
        $this->set('_serialize', ['vacatairesGrade']);
        $this->render('/Espaces/respopersonels/affectergrade');
    }
    public function modifiervacgrade($id = null)
    {
        $this->loadModel('VacatairesGrades');
        $this->loadModel('Vacataires');
        $this->loadModel('Grades');
        $vacatairesGrade = $this->VacatairesGrades->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vacatairesGrade = $this->VacatairesGrades->patchEntity($vacatairesGrade, $this->request->data);
            if ($this->VacatairesGrades->save($vacatairesGrade)) {
                $this->Flash->success(__('The {0} has been saved.', 'Vacataires Grade'));

                return $this->redirect(['action' => 'viewvacatairre/'.$vacatairesGrade->vacataire_id.'']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Vacataires Grade'));
            }

        }
        $grades = $this->VacatairesGrades->Grades->find('list', ['limit' => 200]);
        $vacataires = $this->VacatairesGrades->Vacataires->find('list', ['limit' => 200]);
        $this->set(compact('vacatairesGrade', 'grades', 'vacataires'));
        $this->set('_serialize', ['vacatairesGrade']);
        $this->render('/Espaces/respopersonels/modifiervacgrade');
    }
    public function desaffectergrade($id = null)
    {
        $this->loadModel('VacatairesGrades');
        $this->request->allowMethod(['post', 'delete']);
        $vacatairesGrade = $this->VacatairesGrades->get($id);
        $v=$vacatairesGrade->vacataire_id;
        if ($this->VacatairesGrades->delete($vacatairesGrade)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Vacataires Grade'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Vacataires Grade'));
        }

        return $this->redirect(['action' => 'viewvacatairre/'.$v.'']);
    }

    public function desaffectervacataire($id = null)
    {
        $this->loadModel('VacatairesDepartements');
        $this->request->allowMethod(['post', 'delete']);
        $vacatairesDepartement = $this->VacatairesDepartements->get($id);
        $v=$vacatairesDepartement->vacataire_id;
        if ($this->VacatairesDepartements->delete($vacatairesDepartement)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Vacataires Departement'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Vacataires Departement'));
        }
        return $this->redirect(['action' => 'viewvacatairre/'.$v.'']);
    }
    public function viewvacatairre($id = null)
    {
        $this->loadModel('Vacataires');
        $vacataire = $this->Vacataires->get($id, [
            'contain' => ['Activites', 'Departements', 'Disciplines', 'Grades', 'Vacations']
        ]);

        $this->set('vacataire', $vacataire);
        $this->set('_serialize', ['vacataire']);
        $this->render('/Espaces/respopersonels/viewvacataire');
    }
    public function vacataires()
    {
        $this->loadModel('Vacataires');
        $vacataires = $this->paginate($this->Vacataires);

        $this->set(compact('vacataires'));
        $this->set('_serialize', ['vacataires']);
        $this->render('/Espaces/respopersonels/vacataires');
    }

    public function ajoutergrade(){



    }



///////////////////////////////omar raaaay fin//////////////////////////////////////////////

    // FIN OMAR RAY


}

?>