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

class RespopersonelsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    public function tester()
    {
        $this->render('/Espaces/respopersonels/tester');
    }
    public function viewProfBis($id = null)
    {
        $Profpermanents=TableRegistry::get('Profpermanents');
        $profpermanent = $Profpermanents->get($id, [
            'contain' => ['Activites', 'Departements', 'Disciplines', 'Grades']
        ]);

        $this->set('profpermanent', $profpermanent);
        $this->set('_serialize', ['profpermanent']);
        $this->render('/Espaces/respopersonels/viewProfBis');
    }
   

    public function deleteDiscipline($id = null)
    {
        $Enseigners=TableRegistry::get('Enseigners');
        $this->request->allowMethod(['post', 'delete']);
        $enseigner = $Enseigners->get($id);
        if ($Enseigners->delete($enseigner)) {
            $this->Flash->success(__('Désaffecatation Validée'));
        } else {
            $this->Flash->error(__('Désaffecatation Echouée'));
        }
        return $this->redirect(['action' => 'listerDisciplines']);
    }


    //Rechercher Prof
    public function rechercher()
    {
       $this->paginate = [
            'contain' => ['Profpermanents', 'Infosgradesprofs']
        ]; 
        $ProfpermanentsGrades=TableRegistry::get('ProfpermanentsGrades');


        if (isset($_POST['chercherProf'])) {
            $indice=$_POST['chercherProf'];
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades->find('all')->where(['OR'=>
                ['Infosgradesprofs.indice like '=>'%'.$indice.'%','Infosgradesprofs.grade like '=>'%'.$indice.'%',
                ' profpermanents.nom_prof like'=>'%'.$indice.'%',' profpermanents.prenom_prof like'=>'%'.$indice.'%',
                ' profpermanents.Lieu_Naissance like'=>'%'.$indice.'%', 'profpermanents.somme like '=>'%'.$indice.'%',
                'profpermanents.email_prof like '=>'%'.$indice.'%', 'Infosgradesprofs.echelon like '=>'%'.$indice.'%', 
                ]]));
        } else {
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades);
        }


        $this->set(compact('profpermanentsGrades'));
        $this->set('_serialize', ['profpermanentsGrades']);
       
        $this->render('/Espaces/respopersonels/rechercher');
    }
    
    //Rechercher Prof
    public function rechercherVac()
    {
       $this->paginate = [
            'contain' => ['Vacataires', 'Infosgradesprofs']
        ]; 
        $ProfpermanentsGrades=TableRegistry::get('VacatairesGrades');


        if (isset($_POST['chercherProf'])) {
            $indice=$_POST['chercherProf'];
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades->find('all')->where(['OR'=>
                ['Infosgradesprofs.indice like '=>'%'.$indice.'%','Infosgradesprofs.grade like '=>'%'.$indice.'%',
                ' vacataires.nom_vacataire like'=>'%'.$indice.'%',' vacataires.prenom_vacataire like'=>'%'.$indice.'%',
                ' vacataires.LieuNaissance like'=>'%'.$indice.'%', 'vacataires.somme like '=>'%'.$indice.'%',
                'vacataires.email like '=>'%'.$indice.'%', 'Infosgradesprofs.echelon like '=>'%'.$indice.'%', 
                ]]));
        } else {
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades);
        }


        $this->set(compact('profpermanentsGrades'));
        $this->set('_serialize', ['profpermanentsGrades']);
       
        $this->render('/Espaces/respopersonels/rechercherVac');
    }
    //Recherche Fonctionnaire

    public function rechercherFonc()
    {
       
        $ProfpermanentsGrades=TableRegistry::get('Fonctionnaires');


        if (isset($_POST['chercherProf'])) {
            $indice=$_POST['chercherProf'];
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades->find('all')->where(['OR'=>
                [' nom_fct like'=>'%'.$indice.'%',' nom_fct like'=>'%'.$indice.'%',
                ' LieuNaissance like'=>'%'.$indice.'%', 'somme like '=>'%'.$indice.'%',
                'email like '=>'%'.$indice.'%'
                ]]));
        } else {
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades);
        }


        $this->set(compact('profpermanentsGrades'));
        $this->set('_serialize', ['profpermanentsGrades']);
       
        $this->render('/Espaces/respopersonels/rechercherFonc');
    }

    public function affecterGradeProf()
    {
        $grrades=TableRegistry::get('Grades');
        $infoGrades = TableRegistry::get('Infosgradesprofs');
        $Profs=TableRegistry::get('Profpermanents');
        $profpermanentsGrades=TableRegistry::get('ProfpermanentsGrades');
        $profpermanentsGrade = $profpermanentsGrades->newEntity();
        //Ancien Code
       
        //Code Naoufal
        $cadre = $this->request->data('grade');
        $grade = $this->request->data('sousgrade');
        $echelon = $this->request->data('echelon');
        if ($this->request->is('post')) {
            $profEdit = $profpermanentsGrades->find('all')->where(['profpermanent_id'=>$this->request->data['idProf']])->first();
            switch ($cadre) {
                case '0':
                    # code...
                    break;
                    
                case '1':
                    # code...
                    $profEdit->cadre = 'PES';
                    $id_grade = $infoGrades->find('all')->select('id')->where(['cadre'=>'PES', 'grade'=>$grade,'echelon'=>$echelon])->first()['id'];
                    break;
                    
                case '2':
                    # code...
                    $profEdit->cadre = 'H';
                    $id_grade = $infoGrades->find('all')->select('id')->where(['cadre'=>'H', 'grade'=>$grade,'echelon'=>$echelon])->first()['id'];
                    break;
                    
                case '3':
                    # code...
                    $profEdit->cadre = 'A';
                    $id_grade = $infoGrades->find('all')->select('id')->where(['cadre'=>'A', 'grade'=>$grade,'echelon'=>$echelon])->first()['id'];
                    break;
                
                default:
                    # code...
                    break;
            }

            $profEdit->sous_grade = $this->request->data['sousgrade'];
            $profEdit->echelon = $this->request->data['echelon'];
            $profEdit->grade_id = $id_grade;
            $dateTest = explode("/", $_POST['date_grade']);
            $date_string=$dateTest[2].'-'.$dateTest[1].'-'.$dateTest[0];
            $year_exep=$dateTest[2]+6;
            $year_normal=$dateTest[2]+8;
            $year_rapide=$dateTest[2]+7;
            $year_next=$dateTest[2]+2;

            $date_string_exep=$year_exep.'-'.$dateTest[1].'-'.$dateTest[0];
                    
            $date_string_normal=$year_normal.'-'.$dateTest[1].'-'.$dateTest[0];
            $date_string_rapide=$year_rapide.'-'.$dateTest[1].'-'.$dateTest[0];
            $date_next_echelon=$year_next.'-'.$dateTest[1].'-'.$dateTest[0];

            $profEdit->date_grade =$date_string;
            $profEdit->date_exep =$date_string_exep;
            $profEdit->date_normal =$date_string_normal;
            $profEdit->date_rapide =$date_string_rapide;
            $profEdit->date_next_echelon =$date_next_echelon;
                    

             

            if (!$profpermanentsGrades->save($profEdit)) {
                $this->Flash->error(__('Affectation Grade échouée'));
            } else {
                # code...
                $this->Flash->success(__('Affectation Grade avec succès'));
            }
        }



        $profpermanents = $profpermanentsGrades->profpermanents->find('list', ['limit' => 200]);
        $grades = $profpermanentsGrades->Grades->find('list', ['limit' => 200]);
        $this->set(compact('profpermanentsGrade', 'profpermanents', 'grades'));
        $i=1;
        $queryProf=$Profs->find('all');
        
        $j=1;
        $queryGrades=$grrades->find('all');
        foreach ($queryGrades as $query2) {
            $tabNom[$j]=$query2->nomGrade;
            $j++;
        }
        $this->set('queryProf', $queryProf);
        //$this->set('nomtab', $tabNom);
        $this->set('_serialize', ['profpermanentsGrade']);
        $this->render('/Espaces/respopersonels/affecterGradeProf');
    }
    
   

    
    public function etatAvancementEchelon()
    {
        $profsPermanents=TableRegistry::get('ProfPermanentsGrades');
        $profsPermanents->paginate = [
            'contain' => ['Grades', 'ProfPermanents']
        ];
        $date=date('Y-m-d');
        $query_exep=$profsPermanents->find('all')->select()->where(['date_next_echelon'=>$date])->count();
        $this->set('passageEchelon', $query_exep);
        $this->set('dateActuelle', $date);
    }
    public function etatAvancementFct()
    {
        $profsPermanents=TableRegistry::get('FonctionnairesGrades');
        $profsPermanents->paginate = [
            'contain' => ['Grades', 'Fonctionnaires']
        ];
        $date=date('Y-m-d');
        $query_moyen=$profsPermanents->find('all')->select()->where(['date_echelon_moyen <= '=>$date])->count();
        $query_normal=$profsPermanents->find('all')->select()->where(['date_echelon_normal <= '=>$date])->count();
        $query_rapide=$profsPermanents->find('all')->select()->where(['date_echelon_rapide <= '=>
            $date])->count();
        $this->set('passageMoyenFct', $query_moyen);
        $this->set('passageNormalFct', $query_normal);
        $this->set('passageRapideFct', $query_rapide);
        $this->set('dateActuelleFct', $date);
    }
    public function etatAvancementGrade()
    {
        $profsPermanents=TableRegistry::get('ProfPermanentsGrades');
        $profsPermanents->paginate = [
            'contain' => ['Grades', 'ProfPermanents']
        ];
        $date=date('Y-m-d');
        $query_exep=$profsPermanents->find('all')->select()->where(['date_exep <= '=>$date])->count();
        $query_normal=$profsPermanents->find('all')->select()->where(['date_normal <= '=>$date])->count();
        $query_rapide=$profsPermanents->find('all')->select()->where(['date_rapide <= '=>
            $date])->count();
        $this->set('passageExep', $query_exep);
        $this->set('passageNormal', $query_normal);
        $this->set('passageRapide', $query_rapide);
        $this->set('dateActuelle', $date);
    }
    public function passerClassePA($id = null, $classe)
    {
        $PPG=TableRegistry::get('ProfPermanentsGrades');
        $dateExeptionnel=$PPG->find('all')->select('date_exep')->where(['id'=>$id]);
        foreach ($dateExeptionnel as $date) {
            $dateNext=$date->date_exep;
        }
        $dateTest = explode("/", $dateNext);
        $year=$dateTest[2];
        if ($year>=1 && $year<=9) {
            $dateInsert=$year.'-0'.$dateTest[0].'-'.$dateTest[1];
            $year_exep=$dateTest[2]+6;
            $year_normal=$dateTest[2]+8;
            $year_rapide=$dateTest[2]+7;
            $year_next=$dateTest[2]+2;
            $date_string_exep=$year_exep.'0-'.$dateTest[0].'-'.$dateTest[1];
            $date_string_normal=$year_normal.'0-'.$dateTest[0].'-'.$dateTest[1];
            $date_string_rapide=$year_rapide.'0-'.$dateTest[0].'-'.$dateTest[1];
            $date_next_echelon=$year_next.'0-'.$dateTest[0].'-'.$dateTest[1];
            $PPG->date_grade = $dateInsert;
            $PPG->date_exep =$date_string_exep;
            $PPG->date_normal =$date_string_normal;
            $PPG->date_rapide =$date_string_rapide;
            $PPG->date_next_echelon =$date_next_echelon;
        } else {
            $dateInsert=$year.'-'.$dateTest[0].'-'.$dateTest[1];
            $year_exep=$dateTest[2]+6;
            $year_normal=$dateTest[2]+8;
            $year_rapide=$dateTest[2]+7;
            $year_next=$dateTest[2]+2;
            $date_string_exep=$year_exep.'-'.$dateTest[0].'-'.$dateTest[1];
            $date_string_normal=$year_normal.'-'.$dateTest[0].'-'.$dateTest[1];
            $date_string_rapide=$year_rapide.'-'.$dateTest[0].'-'.$dateTest[1];
            $date_next_echelon=$year_next.'-'.$dateTest[0].'-'.$dateTest[1];
        }




        switch ($classe) {
            case 'A':
            {
                $query=$PPG->find('all')->update()->set(
                    ['sous_grade' => 'B','echelon'=>1,'date_exep'=>$date_string_exep,
                       'date_normal'=>$date_string_normal,'date_rapide'=>$date_string_rapide,'date_grade'=>$dateInsert,
                       'date_next_echelon'=>$date_next_echelon]
                )->where(['id' => $id]);
                $query->execute();

                break;
            }
            case 'B':
            {
                $query=$PPG->find('all')->update()->set(
                    ['sous_grade' => 'C','echelon'=>1,'date_exep'=>$date_string_exep,'date_rapide'=>$date_string_exep,
                       'date_normal'=>$date_string_normal,'date_grade'=>$dateInsert,
                    'date_next_echelon'=>$date_next_echelon]
                )->where(['id' => $id]);
                $query->execute();
                break;
            }
            case 'C':
            {
                $query=$PPG->find('all')->update()->set(
                    ['sous_grade' => 'D','echelon'=>1,'date_exep'=>'9999=12-12','date_rapide'=>'9999=12-12',
                       'date_normal'=>'9999=12-12','date_grade'=>$dateInsert,
                    'date_next_echelon'=>$date_next_echelon]
                )->where(['id' => $id]);
                $query->execute();
                break;
            }
        }
        $this->listerGrade();
    }
    public function passerClassePESH($id = null, $classe)
    {
        $PPG=TableRegistry::get('ProfPermanentsGrades');
        $dateExeptionnel=$PPG->find('all')->select('date_exep')->where(['id'=>$id]);
        foreach ($dateExeptionnel as $date) {
            $dateNext=$date->date_exep;
        }
        $dateTest = explode("/", $dateNext);
        $year=$dateTest[2];
        if ($year>=1 && $year<=9) {
            $dateInsert=$year.'-0'.$dateTest[0].'-'.$dateTest[1];
            $year_exep=$dateTest[2]+6;
            $year_normal=$dateTest[2]+8;
            $year_rapide=$dateTest[2]+7;
            $year_next=$dateTest[2]+2;
            $date_string_exep=$year_exep.'0-'.$dateTest[0].'-'.$dateTest[1];
            $date_string_normal=$year_normal.'0-'.$dateTest[0].'-'.$dateTest[1];
            $date_string_rapide=$year_rapide.'0-'.$dateTest[0].'-'.$dateTest[1];
            $date_next_echelon=$year_next.'0-'.$dateTest[0].'-'.$dateTest[1];
            $PPG->date_grade = $dateInsert;
            $PPG->date_exep =$date_string_exep;
            $PPG->date_normal =$date_string_normal;
            $PPG->date_rapide =$date_string_rapide;
            $PPG->date_next_echelon =$date_next_echelon;
        } else {
            $dateInsert=$year.'-'.$dateTest[0].'-'.$dateTest[1];
            $year_exep=$dateTest[2]+6;
            $year_normal=$dateTest[2]+8;
            $year_rapide=$dateTest[2]+7;
            $year_next=$dateTest[2]+2;
            $date_string_exep=$year_exep.'-'.$dateTest[0].'-'.$dateTest[1];
            $date_string_normal=$year_normal.'-'.$dateTest[0].'-'.$dateTest[1];
            $date_string_rapide=$year_rapide.'-'.$dateTest[0].'-'.$dateTest[1];
            $date_next_echelon=$year_next.'-'.$dateTest[0].'-'.$dateTest[1];
        }




        switch ($classe) {
            case 'A':
            {
                $query=$PPG->find('all')->update()->set(
                    ['sous_grade' => 'B','echelon'=>1,'date_exep'=>$date_string_exep,
                        'date_normal'=>$date_string_normal,'date_rapide'=>$date_string_rapide,'date_grade'=>$dateInsert,
                        'date_next_echelon'=>$date_next_echelon]
                )->where(['id' => $id]);
                $query->execute();

                break;
            }
            case 'B':
            {
                $query=$PPG->find('all')->update()->set(
                    ['sous_grade' => 'C','echelon'=>1,'date_exep'=>"9999-99-99",
                        'date_normal'=>"9999-99-99",'date_rapide'=>"9999-99-99",'date_grade'=>$dateInsert,
                        'date_next_echelon'=>$date_next_echelon]
                )->where(['id' => $id]);
                $query->execute();
                break;
            }
        }
        $this->listerGrade();
    }
    public function passerClasse($param1, $param2, $param3)
    {
        switch ($param3) {
            case 'Professeur Assistant':
            {
                $this->passerClassePA($param1, $param2);
                break;
            }
            case 'Professeur d\'Enseignement Supérieur':
            {
                $this->passerClassePESH($param1, $param2);
                break;
            }
            case 'Professeur Habilité':
            {
                $this->passerClassePESH($param1, $param2);
                break;
            }
        }
    }
    /*public function passerEchelonPA($id=null,$echelon)
    {
        $PPG=TableRegistry::get('ProfPermanentsGrades');
        $dateEchelon=$PPG->find('all')->select('date_next_echelon')->where(['id'=>$id]);
        foreach($dateEchelon as $date) {
            $dateNext=$date->date_next_echelon;
        }
        $dateTest = explode("/",$dateNext);
        $year=$dateTest[2]+2002;
        $dateInsert=$year.'-0'.$dateTest[0].'-'.$dateTest[1];
            if($echelon==1 or $echelon==2 )
            {
                $query=$PPG->find('all')->update()->set(['echelon'=>$echelon+1,'date_next_echelon'=>$dateInsert])->where(['id' => $id]);
                $query->execute();
            }
            if($echelon==3)
            {
                $query=$PPG->find('all')->update()->set(['echelon' => $echelon+1,'date_next_echelon'=>'1900-12-12'])->where(['id' => $id]);
                $query->execute();
            }

        $this->listerGrade();

    }*/
    public function passerEchelonPESH($id = null, $echelon, $grade, $classe)
    {
        $PPG=TableRegistry::get('ProfPermanentsGrades');
        $dateEchelon=$PPG->find('all')->select('date_next_echelon')->where(['id'=>$id]);
        foreach ($dateEchelon as $date) {
            $dateNext=$date->date_next_echelon;
        }
        $dateTest = explode("/", $dateNext);
        $year=$dateTest[2]+2002;
        $dateInsert=$year.'-0'.$dateTest[0].'-'.$dateTest[1];
        if ($classe='A' or $classe='B') {
            if ($echelon==1 or $echelon==2) {
                $query=$PPG->find('all')->update()->set(['echelon'=>$echelon+1,'date_next_echelon'=>$dateInsert])->where(['id' => $id]);
                $query->execute();
            }
            if ($echelon==3) {
                $query=$PPG->find('all')->update()->set(['echelon' => $echelon+1,'date_next_echelon'=>'1900-12-12'])->where(['id' => $id]);
                $query->execute();
            }
        }
        if ($classe='C') {
            if ($echelon==1 or $echelon==2 or $echelon==3) {
                $query=$PPG->find('all')->update()->set(['echelon'=>$echelon+1,'date_next_echelon'=>$dateInsert])->where(['id' => $id]);
                $query->execute();
            }
            if ($echelon==4) {
                $query=$PPG->find('all')->update()->set(['echelon' => $echelon+1,'date_next_echelon'=>'1900-12-12'])->where(['id' => $id]);
                $query->execute();
            }
        }


        $this->listerGrade();
    }
    public function passerEchelon($id, $echelon, $grade, $classe)
    {
        switch ($grade) {
            case 'Professeur Assistant':
            {
                $this->passerEchelonPA($id, $echelon);
                break;
            }
            case 'Professeur d\'Enseignement Supérieur':
            {
                $this->passerEchelonPESH($id, $echelon);
                break;
            }
            case 'Professeur Habilité':
            {
                $this->passerEchelonPESH($id, $echelon);
                break;
            }
        }
    }
    public function passerEchelonPA($id = null, $echelon)
    {
        $PPG=TableRegistry::get('ProfPermanentsGrades');
        $dateEchelon=$PPG->find('all')->select('date_next_echelon')->where(['id'=>$id]);
        foreach ($dateEchelon as $date) {
            $dateNext=$date->date_next_echelon;
        }
        $dateTest = explode("/", $dateNext);
        $year=$dateTest[2]+2002;
        $dateInsert=$year.'-0'.$dateTest[0].'-'.$dateTest[1];
        if ($echelon==1 or $echelon==2) {
            $query=$PPG->find('all')->update()->set(['echelon' => $echelon+1,'date_next_echelon'=>$dateInsert])->where(['id' => $id]);
            $query->execute();
        }
        if ($echelon==3) {
            $query=$PPG->find('all')->update()->set(['echelon' => $echelon+1,'date_next_echelon'=>'1900-12-12'])->where(['id' => $id]);
            $query->execute();
        }

        $this->listerGrade();
    }

    public function listerPassageEchelon()
    {
        $this->paginate = [
            'contain' => ['Profpermanents', 'Grades']
        ];
        $ProfpermanentsGrades=TableRegistry::get('ProfpermanentsGrades');


        $date=date('Y-m-d');
        $profpermanentsGrades = $this->paginate($ProfpermanentsGrades->find('all')->select()->where(['date_next_echelon'=>$date]));
        $this->set(compact('profpermanentsGrades'));
        $this->set('_serialize', ['profpermanentsGrades']);
        $this->render('/Espaces/respopersonels/listerPassageEchelon');
    }
    public function listerPassage($id = null)
    {
        $profsPermanentsGrades=TableRegistry::get('ProfPermanentsGrades');
        $this->paginate = [
            'contain' => ['Profpermanents', 'Grades']
        ];
        $date=date('Y-m-d');
        switch ($id) {
            case 0:
            {
                $profpermanentsGrades = $this->paginate($profsPermanentsGrades->find('all')->select()->where(['date_exep <= '=>$date,
                    ]));
                break;
            }
            case 1:
            {
                $profpermanentsGrades = $this->paginate($profsPermanentsGrades->find('all')->select()->where(['date_normal <= '=>$date]));
                break;
            }
            case 2:
            {
                $profpermanentsGrades = $this->paginate($profsPermanentsGrades->find('all')->select()->where(['date_rapide <= '=>$date]));
                break;
            }
        }
        $this->set(compact('profpermanentsGrades'));
        $this->set('_serialize', ['profpermanentsGrades']);
        $this->render('/Espaces/respopersonels/listerPassage');
    }

    public function viewEvolution($id = null)
    {
        $this->paginate = [
            'contain' => ['Profpermanents', 'Grades']
        ];
        $ProfpermanentsGrades=TableRegistry::get('ProfpermanentsGrades');
        $profpermanentsGrade = $this->paginate($ProfpermanentsGrades->find(
            "all",
            array(
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
        $activites=TableRegistry::get('Activites');
        $Activites = $this->paginate($activites);
        if (isset($_POST['activiteCherch'])) {
            $indice=$_POST['activiteCherch'];
            $Activites = $this->paginate($activites->find('all')->where(['nomActivite
             like '=>'%'.$indice.'%']));
        } else {
            $Activites = $this->paginate($activites);
        }

        $this->set(compact('Activites'));
        $this->set('_serialize', ['Activites']);
        $this->render('/Espaces/respopersonels/afficherEvent');
    }
    
    public function redimensionner_image($fichier, $extension)
    {

    //VARIABLE D'ERREUR

        global $error;



        //TAILLE EN PIXELS DE L'IMAGE REDIMENSIONNEE

        $longueur = 1000;

        $largeur = 1000;



        //TAILLE DE L'IMAGE ACTUELLE

        $taille = getimagesize($fichier);



        //SI LE FICHIER EXISTE

        if ($taille) {
            //SI JPG

            if ($extension=='jpg' or $extension=='jpeg') {
                //OUVERTURE DE L'IMAGE ORIGINALE

                $img_big = imagecreatefromjpeg($fichier);

                $img_new = imagecreate($longueur, $largeur);



                //CREATION DE LA MINIATURE

                $img_petite = imagecreatetruecolor($longueur, $largeur) ;



                //COPIE DE L'IMAGE REDIMENSIONNEE

                imagecopyresized($img_petite, $img_big, 0, 0, 0, 0, $longueur, $largeur, $taille[0], $taille[1]);

                imagejpeg($img_petite, $fichier);
            }



            //SI PNG

            elseif ($extension=='png') {
                //OUVERTURE DE L'IMAGE ORIGINALE

                $img_big = imagecreatefrompng($fichier); // On ouvre l'image d'origine

                $img_new = imagecreate($longueur, $largeur);


                //CREATION DE LA MINIATURE

                $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);



                //COPIE DE L'IMAGE REDIMENSIONNEE

                imagecopyresized($img_petite, $img_big, 0, 0, 0, 0, $longueur, $largeur, $taille[0], $taille[1]);

                imagepng($img_petite, $fichier);
            }
        }
    }

    public function affecterProfEvnt()
    {
        $activities=TableRegistry::get('Activites');
        $Profs=TableRegistry::get('Profpermanents');
        $profpermanentsActivites=TableRegistry::get('ProfpermanentsActivites');
        $profpermanentsActivite = $profpermanentsActivites->newEntity();
        /* foreach ($this->request->data('Date_debut')as $date)
         {
             $year=$date['year'];
             $month=$date['month'];
             $day=$date['day'];
         }*/
        if ($this->request->is('post')) {
            $profpermanentsActivite->poste_comite =$this->request->data('poste_comite');
            //$req=$Profs->find('all')->select('id')->where(['id'=>$_POST['nomProf'],'prenom_prof'=>$_POST['prenomProf']])->first();
            //debug($req);
            $req1=$activities->find('all')->select('id');
            $i=1;
            
            /* foreach ($req as $ligne) {
                $ID=$ligne->id;
            } */
            $j=1;
            foreach ($req1 as $ligne) {
                if ($j==$this->request->data('nomActivite')) {
                    $IDACT=$ligne->id;
                    break;
                }
                $j++;
            }

            $profpermanentsActivite->activite_id =$IDACT;

            $profpermanentsActivite->profpermanent_id = $this->request->data('idProf');
            $req3=$profpermanentsActivites->find('all')->select('id')->where(['ProfpermanentsActivites.profpermanent_id'=>$this->request->data('idProf'),
            'ProfpermanentsActivites.activite_id'=>$IDACT]);
            $nb=0;
            foreach ($req3 as $existant) {
                $nb++;
            }
            if ($nb==1) {
                $this->Flash->error(__('Erreur ... Ce Professeur appartient déja au comité de cet événement !'));
            } elseif ($profpermanentsActivites->save($profpermanentsActivite)) {
                $this->Flash->success(__('Activité affectée'));

                return $this->redirect(['action' => 'afficherEvent']);
            } else {
                $this->Flash->error(__('Affectation échouée'));
            }
        }


        $profpermanents = $profpermanentsActivites->Profpermanents->find('list', ['limit' => 200]);
        $activites = $profpermanentsActivites->Activites->find('list', ['limit' => 200]);
        $this->set(compact('profpermanentsActivite', 'profpermanents', 'activites'));
        $i=1;
        $queryProf=$Profs->find('all');
        /* foreach ($queryProf as $query1) {
            $tabNomProf[$i]=$query1->nom_prof;
            $tabPrenomProf[$i]=$query1->prenom_prof;

            $i++;
        } */
        $j=1;
        $queryActivites=$activities->find('all');
        foreach ($queryActivites as $query2) {
            $tabNom[$j]=$query2->nomActivite;
            $j++;
        }

        // $this->set('tabNomProf', $tabNomProf);
        //$this->set('tabPrenomProf', $tabPrenomProf);
        $this->set('queryProf', $queryProf);
        $this->set('nomtab', $tabNom);
        $this->set('_serialize', ['profpermanentsActivite']);
        $this->render('/Espaces/respopersonels/affecterProfEvnt');
    }
    public function listerOrganisateur($id = null)
    {
        $this->paginate = [
            'contain' => ['Profpermanents', 'Activites']
        ];
        $profpermanentsActivites=TableRegistry::get('ProfpermanentsActivites');
        $profpermanentsActivite = $this->paginate($profpermanentsActivites->find(
            "all",
            array(
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
            $extension_upload = strtolower(substr(strrchr($_FILES['photoAct']['name'], '.'), 1));





            $req=$Activites->find('all')->select('id')->where(['nomActivite'=>$this->request->data('nomActivite')]);
            $nb=0;
            foreach ($req as $existant) {
                $nb++;
            }
            if ($nb==1) {
                $this->Flash->error(__('Erreur .. Cette activité est déja organisé , si c\'est une autre édition Merci de  l\'ajouter dans le nom , MERCI!'));
            } elseif (!in_array($extension_upload, $extensions_valides)) {
                $this->Flash->error(__('Veuillez choisir l\'extension  : JPEG , JPG Ou PNG , MERCI!'));
                return $this->redirect(['action' => 'add']);
            } elseif ($Activites->save($activite)) {
                $photo = $_FILES['photoAct']['name'];
                $phototempo = $_FILES['photoAct']['tmp_name'];
                move_uploaded_file($phototempo, WWW_ROOT.DS.'/img'.DS.$photo);
                $this->redimensionner_image(WWW_ROOT.DS.'/admin_l_t_e'.DS.'/img'.DS.$photo, $extension_upload);

                $this->Flash->success(__('Activité Bien Ajoute '));
                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('Erreur .. Veuillez essayer un autre fois !'));
            }
        }
        $this->set(compact('activite'));
        $this->set('_serialize', ['activite']);
        $this->render('/Espaces/respopersonels/add');
    }
    public function index()
    {
        $usrole=$this->Auth->user('role');
        $this->set('role', $usrole);
       
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default');
        
        $nbAttes=$con->execute('select count(id) as nbAttest from profpermanents_documents pd where pd.document_id=1');
        $nbAttesBis=$con->execute('select count(id) as nbAttest from fonctionnaires_documents pd where pd.document_id=1');


        $nbFiche=$con->execute('select count(id) as nbFiche from profpermanents_documents pd where pd.document_id=2');
        $nbFicheBis=$con->execute('select count(id) as nbFiche from fonctionnaires_documents  pd where pd.document_id=2');

        $nbAbsence=$con->execute('select count(id) as nbAbscence from profpermanents_documents pd where pd.document_id=3');

        $nbDemande=$con->execute('select count(id) as nbDemande from profpermanents_documents pd where pd.etatdemande=\'Demande envoyé\'');

        $nbDelivre=$con->execute('select count(id) as nbDemande from profpermanents_documents pd where pd.etatdemande=\'Delivré\'');
        $nbEnCours=$con->execute('select count(id) as nbDemande from profpermanents_documents pd where pd.etatdemande=\'En cours de traitement\'');
        $nbPrete=$con->execute('select count(id) as nbDemande from profpermanents_documents pd where pd.etatdemande=\'Prete\'');
        //pour vacataire
        $nbDemandee=$con->execute('select count(id) as nbDemandee from vacataires_documents pd where pd.etatdemande=\'Demande envoyé\'');
        $nbDelivree=$con->execute('select count(id) as nbDemandee from vacataires_documents pd where pd.etatdemande=\'Delivré\'');
        $nbEnCourss=$con->execute('select count(id) as nbDemandee from vacataires_documents pd where pd.etatdemande=\'En cours de traitement\'');
        foreach ($nbDelivree as $ligne) {
            $nbDelivree=$ligne['nbDemandee'];
        }
        foreach ($nbEnCourss as $ligne) {
            $nbEnCourss=$ligne['nbDemandee'];
        }
        foreach ($nbDemandee as $ligne) {
            $nbDemandee=$ligne['nbDemandee'];
        }
        
        foreach ($nbDelivre as $ligne) {
            $nbDelivre=$ligne['nbDemande'];
        }
       
        foreach ($nbEnCours as $ligne) {
            $nbEnCours=$ligne['nbDemande'];
        }
        
        $this->set('nbDelivre', $nbDelivre);
        $this->set('nbDelivree', $nbDelivree);
        $this->set('nbEnCours', $nbEnCours);
        $this->set('nbEnCourss', $nbEnCourss);
        
        foreach ($nbAttes as $ligne) {
            $nbAttes=$ligne['nbAttest'];
        }
        foreach ($nbAttesBis as $ligne) {
            $nbAttesBis=$ligne['nbAttest'];
        }
        foreach ($nbDemande as $ligne) {
            $nbDemande=$ligne['nbDemande'];
        }
        /*foreach($nbDemandeBis as $ligne)
        {
            $nbDemandeBis=$ligne['nbDemande'];
        }*/
        foreach ($nbFiche as $ligne) {
            $nbFiche=$ligne['nbFiche'];
        }
        foreach ($nbFicheBis as $ligne) {
            $nbFicheBis=$ligne['nbFiche'];
        }
        foreach ($nbAbsence as $ligne) {
            $nbAbsence=$ligne['nbAbscence'];
        }
        $nbattestTotal=$nbAttes+$nbAttesBis;
        $nbFicheTotal=$nbFiche+$nbFicheBis;
        $this->set('nbDemande', $nbDemande);
        $this->set('nbDemandee', $nbDemandee);
        $this->set('nbAttest', $nbAttes);
        $this->set('nbFiche', $nbFiche);
      
        $this->set('nbAttest', $nbattestTotal);
        $this->set('nbFiche', $nbFicheTotal);
        $this->set('nbAbscence', $nbAbsence);
        $this->paginate = [
            'contain' => ['Profpermanents', 'Documents']
        ];
        $ProfpermanentsDocuments=TableRegistry::get('ProfpermanentsDocuments');
        $profpermanentsDocuments = $this->paginate($ProfpermanentsDocuments);
        $lastDemande=$con->execute('select * from profpermanents p,documents d , profpermanents_documents pd where pd.document_id=d.id 
                                     and pd.profpermanent_id=p.id and pd.etatdemande=\'Demande envoyé\' ORDER by pd.id DESC LIMIT 9');
     
        $this->set('lastDemande', $lastDemande);
        
        $lastDemandee=$con->execute('select * from vacataires p,documents d , vacataires_documents pd where pd.document_id=d.id 
                                     and pd.vacataire_id=p.id and pd.etatdemande=\'Demande envoyé\' ORDER by pd.id DESC LIMIT 9');
     
        $lastDemandex=$con->execute('select * from fonctionnaires p,documents d , fonctionnaires_documents pd where pd.document_id=d.id 
                                     and pd.fonctionnaire_id=p.id and pd.etatdemande=\'Demande envoyé\' ORDER by pd.id DESC LIMIT 9');
     
        $this->set('lastDemandee', $lastDemandee);
        $this->set('lastDemandex', $lastDemandex);

        $this->set(compact('profpermanentsDocuments'));
        $this->set(compact('vacatairesDocuments'));
        $this->set('_serialize', ['profpermanentsDocuments']);
        $this->set('_serialize', ['vacatairesDocuments']);
        $this->render('/Espaces/respopersonels/statistiques');
        $this->set(compact('departements'));
        $this->set('__serialize', ['departements']);

     

        $demandes = $con->execute("SELECT fonctionnaires.nom_fct, absences.fonctionnaire_id, fonctionnaires.prenom_fct,grades.codeGrade, services.nom_service,absences.duree_ab,absences.date_ab,absences.time_ab,absences.cause FROM absences,fonctionnaires,grades,services, fonctionnaires_grades, fonctionnaires_services WHERE isvalid = 0 AND fonctionnaires_grades.fonctionnaire_id = fonctionnaires.id AND fonctionnaires_grades.grade_id = grades.id AND fonctionnaires_services.fonctionnaire_id = fonctionnaires.id AND fonctionnaires_services.service_id = services.id AND absences.fonctionnaire_id = fonctionnaires.id")->fetchAll("assoc");
        if (!empty($demandes)) {
            $this->set("demandes", $demandes);
        }
        
        $this->etatAvancementGrade();
        $this->etatAvancementEchelon();
        $this->etatAvancementFct();
        $this->etatAvancementGradeFct();

        $this->render('/Espaces/respopersonels/home');
    }

    
    public function indexProf()
    {
        $usrole=$this->Auth->user('role');
        $this->set('role', $usrole);
        $this->render('/Espaces/respopersonels/homeProf');
    }
    

    
    public function deleteDocument($id = null, $id2 = null)
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
        $profsPermanentsGrades=TableRegistry::get('ProfPermanentsGrades');
        $this->paginate = [
            'contain' => ['Profpermanents', 'Grades']
        ];
        $date=date('Y-m-d');

        $profpermanentsGrades = $this->paginate($profsPermanentsGrades->find('all')->select()->where(['date_exep'>=$date,
                ]));
        $this->render('/Espaces/respopersonels/testerBis');
    }
    public function voirrDocument()
    {
        $this->paginate = [
            'contain' => ['Vacataires', 'Documents']
        ];
        $VacatairesDocuments = TableRegistry::get('VacatairesDocuments');
        $VacatairesDocuments = $this->paginate($VacatairesDocuments);

        $this->set(compact('VacatairesDocuments'));
        $this->set('_serialize', ['VacatairesDocuments']);
        $this->render('/Espaces/respopersonels/voirrDocument');
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
    public function consultationDemande($id = null)
    {
        $this->paginate = [
            'contain' => ['Profpermanents', 'Documents']
        ];
        $ProfpermanentsDocuments = TableRegistry::get('ProfpermanentsDocuments');
        $profpermanentsDocuments = $this->paginate($ProfpermanentsDocuments->find(
            "all",
            array(
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
    public function vacataireDocument($id = null)
    {
        $this->paginate = [
            'contain' => ['Vacataires', 'Documents']
        ];
        $VacatairesDocuments = TableRegistry::get('VacatairesDocuments');
        $vacatairesDocuments = $this->paginate($VacatairesDocuments->find(
            "all",
            array(
                "joins" => array(
                    array(
                        "table" => "Vacataires",
                        "conditions" => array(
                            "VacatairesDocuments.vacataire_id = Vacataires.id"
                        )
                    ),
                    array(
                        "table" => "Documents",
                        "conditions" => array(
                            "VacatairesDocuments.document_id = Documents.id"
                        )
                    )
                ),
                'conditions' => array(
                    'VacatairesDocuments.vacataire_id' => $id)
            )
        ));
        $comp=0;
        foreach ($vacatairesDocuments as $ligne) {
            if ($ligne->etatdemande == 'Demande envoyé') {
                $comp++;
            }
        }

        $_SESSION['nouveaudemande']=$comp;
        $this->set(compact('vacatairesDocuments'));
        $this->set('_serialize', ['vacatairesDocuments']);
        $this->render('/Espaces/respopersonels/vacataireDocument');
    }
    public function approuverDemande($id1 = null, $id2 = null, $id3 = null)
    {
        $ProfpermanentsDocuments=TableRegistry::get('ProfpermanentsDocuments');
        $query=$ProfpermanentsDocuments->find('all')->update()->set(['etatdemande' => 'En cours de traitement'])->where(['document_id' => $id1,'profpermanent_id'=>$id2,'id'=>$id3]);
        $query->execute();
        $this->consultationDemande($id2);
    }
    public function approuveDemande($id1 = null, $id2 = null, $id3 = null)
    {
        $VacatairesDocuments = TableRegistry::get('VacatairesDocuments');
        $query = $VacatairesDocuments->find('all')->update()->set(['etatdemande' => 'En cours de traitement'])->where(['document_id' => $id1, 'vacataire_id' => $id2,'id'=>$id3]);
        $query->execute();
        $this->vacataireDocument($id2);
    }
    public function panier($id1 = null, $id2 = null, $id3 = null)
    {
        $ProfpermanentsDocuments=TableRegistry::get('ProfpermanentsDocuments');
        $query=$ProfpermanentsDocuments->find('all')->update()->set(['etatdemande' => 'Prete'])->where(['document_id' => $id1,'profpermanent_id'=>$id2,'id'=>$id3]);
        $query->execute();
        $this->consultationDemande($id2);
    }
    public function imprimerDocument($id1 = null, $id2 = null, $id3 = null)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);

        $gradeAssoc=$con->execute('select pg.cadre, pg.sous_grade from profpermanents_grades pg where pg.profpermanent_id='.$id2);
        $count=count($gradeAssoc);
        $this->set('nbGrade', count($gradeAssoc));
        $this->set('tabGrade', $gradeAssoc);
        $this->paginate = [
            'contain' => ['Profpermanents', 'Documents']
        ];
        $ProfpermanentsDocuments=TableRegistry::get('ProfpermanentsDocuments');
        $query=$ProfpermanentsDocuments->find('all')->update()->set(['etatdemande' => 'Delivré'])->where(['document_id' => $id1,'profpermanent_id'=>$id2,'id'=>$id3]);
        $query->execute();
        $profpermanentsDocuments = $this->paginate($ProfpermanentsDocuments->find(
            "all",
            array(
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

        switch ($id1) {
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
                $this->render('/Espaces/respopersonels/imprimerFiche');
                break;

            }
        }
    }
    public function imprimerDocumentt($id1 = null, $id2 = null, $id3 = null)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);

        $gradeAssoc=$con->execute('select vg.cadre,vg.sous_grade from vacataires_grades vg where vg.vacataire_id='.$id2);
        $count=count($gradeAssoc);
        $this->set('nbGrade', count($gradeAssoc));
        $this->set('tabGrade', $gradeAssoc);
         
        $this->paginate = [
            'contain' => ['Vacataires', 'Documents']
        ];
        $VacatairesDocuments=TableRegistry::get('VacatairesDocuments');
        $query=$VacatairesDocuments->find('all')->update()->set(['etatdemande' => 'Delivré'])->where(['document_id' => $id1,'vacataire_id'=>$id2,'id'=>$id3]);
        $query->execute();
        $vacatairesDocuments = $this->paginate($VacatairesDocuments->find(
            "all",
            array(
                "joins" => array(
                    array(
                        "table" => "Vacataires",
                        "conditions" => array(
                            "VacatairesDocuments.vacataire_id = Vacataires.id"
                        )
                    ),
                    array(
                        "table" => "Documents",
                        "conditions" => array(
                            "VacatairesDocuments.document_id = Documents.id"
                        )
                    )
                ),
                'conditions' => array(
                    'VacatairesDocuments.document_id' => $id1,'VacatairesDocuments.vacataire_id'=>$id2)
            )
        ));

        switch ($id1) {
            case 1:
            {
                $this->set(compact('vacatairesDocuments'));
                $this->set('_serialize', ['vacatairesDocuments']);
                $this->render('/Espaces/respopersonels/imprimerAttestx');
                break;

            }
            
            case 2:
            {
                  $this->set(compact('vacatairesDocuments'));
                    $this->set('_serialize', ['vacatairesDocuments']);
                    $this->render('/Espaces/respopersonels/imprimerFichex');
                    break;

            }
        }
    }

    
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

        foreach ($query as $ligne) {
            $usrid=$ligne->id;
        }

        if ($this->request->is('post')) {
            $documentsProfesseur->profpermanent_id =$usrid;
            $documentsProfesseur->document_id =$this->request->data('nomDoc');
            //requete pour une demande déja effectué
            $requete = $ProfpermanentsDocuments->find('all', array('conditions' => array('ProfpermanentsDocuments.profpermanent_id' => $usrid
            ,   'ProfpermanentsDocuments.document_id' => $this->request->data('nomDoc'))));
            $nombre=0;
            foreach ($requete as $resultat) {
                if ($resultat->etatdemande=='Demande envoyé' or $resultat->etatdemande=='Prete' or $resultat->etatdemande=='En cours de traitement') {
                    $nombre++;
                }
            }
            $Profpermanents=TableRegistry::get('Profpermanents');
            $identifiantDoc=$this->request->data('nomDoc');

            switch ($identifiantDoc) {
                case 1:
                {
                    $nbtentativebis=$Profpermanents->find('all')->select('etat_attestation')->where(['id'=>$usrid]);
                    foreach ($nbtentativebis as $value) {
                        $nombrebis=$value->etat_attestation;
                    }

                   
                    if ($ProfpermanentsDocuments->save($documentsProfesseur)) {
                        $nombrebis++;
                        $query=$profpermanents->find('all')->update()->set(['etat_attestation' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();

                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['action' => 'indexProf']);
                    } else {
                        $this->Flash->error(__('Demande échouée'));
                    }



                    break;
                }
                case 2:
                {
                    $nbtentativebis=$profpermanents->find('all')->select('etat_fichesalaire')->where(['id'=>$usrid]);
                    foreach ($nbtentativebis as $value) {
                        $nombrebis=$value->etat_attestation;
                    }
                    $nombrebis=count($nbtentativebis);
                    
                    if ($ProfpermanentsDocuments->save($documentsProfesseur)) {
                        $nombrebis++;
                        $query=$profpermanents->find('all')->update()->set(['etat_fichesalaire' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();
                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['action' => 'indexProf']);
                    } else {
                        $this->Flash->error(__('Demande echouée'));
                    }

                }
            }
        }

        $profpermanents = $ProfpermanentsDocuments->profpermanents->find('list', ['limit' => 200]);
        $documents = $ProfpermanentsDocuments->Documents->find('list', ['limit' => 200]);
        $this->set('doc', $documentbis);
        $this->set('prof', $profbis);
        $this->set(compact('documentsProfesseur', 'profpermanents', 'documents'));
        $this->set('_serialize', ['documentsProfesseur']);
        $this->render('/Espaces/respopersonels/demanderDoc');
    }
    public function demandedoc()
    {
        $VacatairesDocuments=TableRegistry::get('VacatairesDocuments');
        $documentsProfesseur = $VacatairesDocuments->newEntity();
        $documentbis=TableRegistry::get('Documents');
        $documentbis=$documentbis->find('all');
        $profbis=TableRegistry::get('Vacataires');
        $profbis=$profbis->find('all');
        $idUser=$this->Auth->user('id');
        $vacataires=TableRegistry::get('Vacataires');
        $query=$vacataires->find('all')->select('id')->where(['user_id'=>$idUser]);

        foreach ($query as $ligne) {
            $usrid=$ligne->id;
        }

        if ($this->request->is('post')) {
            $documentsProfesseur->vacataire_id =$usrid;
            $documentsProfesseur->document_id =$this->request->data('nomDocument');
            //requete pour une demande déja effectué
            $requete = $VacatairesDocuments->find('all', array('conditions' => array('VacatairesDocuments.vacataire_id' => $usrid
            ,   'VacatairesDocuments.document_id' => $this->request->data('nomDocument'))));
            $nombre=0;
            foreach ($requete as $resultat) {
                if ($resultat->etatdemande=='Demande envoyé' or $resultat->etatdemande=='Prete' or $resultat->etatdemande=='En cours de traitement') {
                    $nombre++;
                }
            }
            $Vacataires=TableRegistry::get('Vacataires');
            $identifiantDoc=$this->request->data('nomDoc');

            switch ($identifiantDoc) {
                case 1:
                {
                    $nbtentativebis=$Vacataires->find('all')->select('etat_attestation')->where(['id'=>$usrid]);
                    foreach ($nbtentativebis as $value) {
                        $nombrebis=$value->etat_attestation;
                    }

                   
                    if ($VacatairesDocuments->save($documentsProfesseur)) {
                        $nombrebis++;
                        $query=$vacataires->find('all')->update()->set(['etat_attestation' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();

                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['action' => 'indexProf']);
                    } else {
                        $this->Flash->error(__('Demande échouée'));
                    }



                    break;
                }
                case 2:
                {
                    $nbtentativebis=$vacataires->find('all')->select('etat_fichesalaire')->where(['id'=>$usrid]);
                    foreach ($nbtentativebis as $value) {
                        $nombrebis=$value->etat_attestation;
                    }
                    $nombrebis=count($nbtentativebis);
                   
                    if ($VacatairesDocuments->save($documentsProfesseur)) {
                        $nombrebis++;
                        $query=$vacataires->find('all')->update()->set(['etat_fichesalaire' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();
                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['action' => 'indexProf']);
                    } else {
                        $this->Flash->error(__('Demande echouée'));
                    }

                }
            }
        }

        $vacataires = $VacatairesDocuments->profpermanents->find('list', ['limit' => 200]);
        $documents = $VacatairesDocuments->Documents->find('list', ['limit' => 200]);
        $this->set('doc', $documentbis);
        $this->set('prof', $profbis);
        $this->set(compact('documentsProfesseur', 'vacataires', 'documents'));
        $this->set('_serialize', ['documentsProfesseur']);
        $this->render('/Espaces/respopersonels/demandedoc');
    }
    public function DelivrerDemande($id1, $id2, $id3)
    {
        $ProfpermanentsDocuments=TableRegistry::get('ProfpermanentsDocuments');
        $query=$ProfpermanentsDocuments->find('all')->update()->set(['etatdemande' => 'Delivré'])->where(['document_id' => $id1,'profpermanent_id'=>$id2,'id' =>$id3]);
        $query->execute();
        $this->consultationDemande($id2);
    }
    public function DelivreDemande($id1, $id2, $id3)
    {
        $VacatairesDocuments=TableRegistry::get('VacatairesDocuments');
        $query=$VacatairesDocuments->find('all')->update()->set(['etatdemande' => 'Delivré'])->where(['document_id' => $id1,'vacataire_id'=>$id2,'id'=>$id3]);
        $query->execute();
        $this->vacataireDocument($id2);
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

        foreach ($nbDelivre as $ligne) {
            $nbDelivre=$ligne['nbDemande'];
        }
        foreach ($nbEnCours as $ligne) {
            $nbEnCours=$ligne['nbDemande'];
        }
        foreach ($nbPrete as $ligne) {
            $nbPrete=$ligne['nbDemande'];
        }
        $this->set('nbDelivre', $nbDelivre);
        $this->set('nbEnCours', $nbEnCours);
        $this->set('nbPrete', $nbPrete);
        foreach ($nbAttes as $ligne) {
            $nbAttes=$ligne['nbAttest'];
        }
        foreach ($nbDemande as $ligne) {
            $nbDemande=$ligne['nbDemande'];
        }
        foreach ($nbFiche as $ligne) {
            $nbFiche=$ligne['nbFiche'];
        }
        foreach ($nbAbsence as $ligne) {
            $nbAbsence=$ligne['nbAbscence'];
        }
        $this->set('nbDemande', $nbDemande);
        $this->set('nbAttest', $nbAttes);
        $this->set('nbFiche', $nbFiche);
        $this->set('nbAbscence', $nbAbsence);
        $this->paginate = [
            'contain' => ['Profpermanents', 'Documents']
        ];
        $ProfpermanentsDocuments=TableRegistry::get('ProfpermanentsDocuments');
        $profpermanentsDocuments = $this->paginate($ProfpermanentsDocuments);
        $lastDemande=$con->execute('select * from profpermanents p,documents d , profpermanents_documents pd where pd.document_id=d.id 
                                     and pd.profpermanent_id=p.id and pd.etatdemande=\'Demande envoyé\' ORDER by pd.id DESC LIMIT 5');
        $this->set('lastDemande', $lastDemande);

        $this->set(compact('profpermanentsDocuments'));
        $this->set('_serialize', ['profpermanentsDocuments']);
        $this->render('/Espaces/respopersonels/statistiques');
    }
    

    public function etatDemande()
    {
        $idUser=$this->Auth->user('id');
        $Profs=TableRegistry::get('Profpermanents');
        $query=$Profs->find('all')->select('id')->where(['user_id'=>$idUser]);

        foreach ($query as $ligne) {
            $ide=$ligne->id;
        }
        $this->paginate = [
            'contain' => ['Profpermanents', 'Documents']
        ];
        $ProfpermanentsDocuments = TableRegistry::get('ProfpermanentsDocuments');
        $ProfpermanentsDocuments = $this->paginate($ProfpermanentsDocuments->find(
            "all",
            array(
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
                    'ProfpermanentsDocuments.profpermanent_id' => $ide)
            )
        ));
        $this->set(compact('ProfpermanentsDocuments'));
        $this->set('_serialize', ['ProfpermanentsDocuments']);
        $this->render('/Espaces/respopersonels/etatDemande');
    }


    
    public function listerProFParDeparBis($id = null, $nomDep)
    {
        $this->paginate = [
        'contain' => ['Profpermanents', 'Departements']
        ];
        $ProfpermanentsDepartements= TableRegistry::get('ProfpermanentsDepartements');
        if (isset($_POST['chercherProf'])) {
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
        } else {
            $ProfpermanentsDepartements = $this->paginate($ProfpermanentsDepartements->find(
                "all",
                array(
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
        $this->set("nomDep", $nomDep);
        $this->render('/Espaces/respopersonels/listerProFParDeparBis');
    }
    
    public function listerProfsParDepar()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $grt=$con->execute('select * from profpermanents_departements where departement_id=1');
        $gi=$con->execute('select * from profpermanents_departements where departement_id=2');
        $ge=$con->execute('select * from profpermanents_departements where departement_id=3');
        $gpee=$con->execute('select * from profpermanents_departements where departement_id=4');
        $this->set('grtProf', count($grt));
        $this->set('giProf', count($gi));
        $this->set('geProf', count($ge));
        $this->set('gpeeProf', count($gpee));

        $ProfpermanentsDepartements = TableRegistry::get('ProfpermanentsDepartements');
        $this->paginate=['contain' => ['Profpermanents','Departements'] ];
        if (isset($_POST['chercherParDep'])) {
            $indice=$_POST['chercherParDep'];
            $profpermanentsDepartements=$this->paginate($ProfpermanentsDepartements->find('all', array(
            "joins"=>array(
               array(
                   "table" => "profpermanents",
                   "conditions"=>array(
                       "profpermanentsDepartements.profpermanent_id=Profpermanents.id")
               )
            )))->where(['OR'=>['departements.nom_departement like '=>'%'.$indice.'%',' profpermanents.nom_prof like'=>'%'.$indice.'%']]));
        } else {
            $profpermanentsDepartements=$this->paginate($ProfpermanentsDepartements->find('all', array(
                "joins"=>array(
                    array(
                        "table" => "profpermanents",
                        "conditions"=>array(
                            "profpermanentsDepartements.profpermanent_id=Profpermanents.id")
                    )
                ))));
        }

        $this->set(compact('profpermanentsDepartements'));
        $this->set('__serialize', ['profpermanentsDepartements']);
        $this->render('/Espaces/respopersonels/listerProfsParDepar');
    }
    
    public function view($id1 = null, $id2 = null, $id3 = null)
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
        /* foreach ($this->request->data('Date_debut')as $date)
         {
             $year=$date['year'];
             $month=$date['month'];
             $day=$date['day'];
         }*/
        if ($this->request->is('post')) {
            $req=$Profs->find('all')->select('id')->where(['nom_prof'=>$_POST['nomProf'],'prenom_prof'=>$_POST['prenomProf']]);

            $i=0;

            foreach ($req as $ligne) {
                $ID=$ligne->id;
                $i++;
            }
            if ($i==0) {
                $this->Flash->error(__('Le Professeur que vous voulez affecter n\'existe pas'));
            } else {
                $j=1;
                $req1=$Departs->find('all')->select('id');
                foreach ($req1 as $ligne) {
                    //echo 'i='.$i;
                    if ($j==$this->request->data('nomdepart')) {
                        $IDDEPAR=$ligne->id;
                        break;
                    }
                    $j++;
                }
                $req3=$profpermanentsDepartements->find('all')->select('id')->where(['ProfpermanentsDepartements.profpermanent_id'=>$ID,
                   'ProfpermanentsDepartements.departement_id'=>$IDDEPAR]);
                $nb=0;
                foreach ($req3 as $existant) {
                    $nb++;
                }


                $profpermanentsDepartement->profpermanent_id =$ID;
                $profpermanentsDepartement->departement_id =$IDDEPAR;
                $profpermanentsDepartement->Poste_Filiere =$this->request->data('Poste_Filiere');

                $dateTest = explode("/", $_POST['date_debut']);
                $date_string=$dateTest[2].'-'.$dateTest[1].'-'.$dateTest[0];
                $profpermanentsDepartement->Date_Debut =$date_string;
                if ($nb==1) {
                    $this->Flash->error(__('Le Professeur que vous voulez affecter existe déja dans ce département'));
                } elseif ($profpermanentsDepartements->save($profpermanentsDepartement)) {
                    $this->Flash->success(__('The profpermanents departement has been saved.'));

                    return $this->redirect(['action' => 'listerProfsParDepar']);
                } else {
                    $this->Flash->error(__('The profpermanents departement could not be saved. Please, try again.'));
                }
            }
        }


        $profpermanents = $profpermanentsDepartements->profpermanents->find('list', ['limit' => 200]);
        $departements = $profpermanentsDepartements->Departements->find('list', ['limit' => 200]);
        $this->set(compact('profpermanentsDepartement', 'profpermanents', 'departements'));
        $i=1;
        $queryProf=$Profs->find('all');
        foreach ($queryProf as $query1) {
            $tabNomProf[$i]=$query1->nom_prof;
            $tabPrenomProf[$i]=$query1->prenom_prof;
            $i++;
        }
        $j=1;
        $queryDeparts=$Departs->find('all');
        foreach ($queryDeparts as $query2) {
            $tabNom[$j]=$query2->nom_departement;
            $j++;
        }

        $this->set('tabNomProf', $tabNomProf);
        $this->set('tabPrenomProf', $tabPrenomProf);

        $this->set('nomtab', $tabNom);
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
    public function foncBis()
    {
        $this->set(compact('Profpermanents'));
        $this->render('/Espaces/respopersonels/foncBis');
    }
    public function filterfoncBis($limit = 100)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $cat=$_POST['cat'];

        switch ($_POST['recherche']) {
            case "nom_fct":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE nom_prof LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents', $profpermanents);
                break;
            }
            case "somme":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE somme LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents', $profpermanents);
                break;
            }
            case "prenom_fct":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE prenom_fct LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents', $profpermanents);
                break;
            }
            case "specialite":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE specialite LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents', $profpermanents);
                break;
            }
            case "echelle":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE echelle LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents', $profpermanents);
                break;
            }
            case "age":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE age LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents', $profpermanents);
                break;
            }
            case "genre":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE genre LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents', $profpermanents);
                break;
            }
            case "date Recrutement":
            {
                $profpermanents=$con->execute("SELECT * FROM profpermanents WHERE date_Recrut LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('Profpermanents', $profpermanents);
                break;
            }
            default:
                echo "Professeur Inexistans";
        }

        $this->render('/Espaces/respopersonels/filtrerfoncBis');
    }
    


    public function listerFonctGrade()
    {
        $this->paginate = [
            'contain' => ['Fonctionnaires']
        ];
        $FonctionnairesGrades=TableRegistry::get('FonctionnairesGrades');
        $fonctionnairesGrades = $this->paginate($FonctionnairesGrades);


        $this->set(compact('fonctionnairesGrades'));
        $this->set('_serialize', ['fonctionnairesGrades']);
        $this->render('/Espaces/respopersonels/listerFonctGrade');
    }


    public function editGradeFct($id = null)
    {
        $FonctionnairesGrades = TableRegistry::get('FonctionnairesGrades');
        $fonctionnairesGrade = $FonctionnairesGrades->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fonctionnairesGrade = $FonctionnairesGrades->patchEntity($fonctionnairesGrade, $this->request->data);
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
            $this->Flash->success(__('Le fonctionnaire est supprimé.'));
        } else {
            $this->Flash->error(__('Erreur de suppression. Veuillez essayer une autre fois.'));
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
        paginate($FonctionnairesServices->find(
            'all',
            array(
                "joins" => array(
                    array("table" => "Services",
                        "conditions" => array("FonctionnairesServices.service_id=Services.id")),
                    array("table" => "Fonctionnaires",
                        "conditions" => array("FonctionnairesServices.fonctionnaire_id=Fonctionnaires.id")),
                    'conditions' => array('Services.id')))
        ));
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

public function absencesprofperm()
    {
        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $this->render('/Espaces/respopersonels/home');
        $con=ConnectionManager::get('default');

        $demandes = $con->execute("SELECT  profperm_absences.id, ProfPermanents.nom_prof, profperm_absences.profpermanent_id, profpermanents.prenom_prof, profpermanents_grades.sous_grade,profperm_absences.duree_ab,profperm_absences.date_ab,profperm_absences.time_ab,profperm_absences.cause FROM profperm_absences,profpermanents,  profpermanents_grades WHERE isvalid = 0 AND  profpermanents_grades.profpermanent_id = profpermanents.id  AND profperm_absences.profpermanent_id = profpermanents.id")->fetchAll("assoc");
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
        $this->render('/Espaces/respopersonels/absencesprofperm');
    }



public function absencesprofvac()
    {
        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $this->render('/Espaces/respopersonels/home');
        $con=ConnectionManager::get('default');

        $demandes = $con->execute("SELECT  vacataires_absences.id, vacataires.nom_vacataire, vacataires_absences.vacataire_id, vacataires.prenom_vacataire, vacataires_grades.sous_grade,vacataires_absences.duree_ab,vacataires_absences.date_ab,vacataires_absences.time_ab,vacataires_absences.cause FROM vacataires_absences,vacataires,  vacataires_grades WHERE isvalid = 0 AND  vacataires_grades.vacataire_id = vacataires.id  AND vacataires_absences.vacataire_id = vacataires.id")->fetchAll("assoc");
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
        $this->render('/Espaces/respopersonels/absencesprofvac');
    }


 public function gestionabsences()
    {
        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $this->render('/Espaces/respopersonels/home');
        $con=ConnectionManager::get('default');

        $demandes = $con->execute("SELECT  absences.id, fonctionnaires.nom_fct, absences.fonctionnaire_id, fonctionnaires.prenom_fct,fonctionnaires_grades.grade,absences.duree_ab,absences.date_ab,absences.time_ab,absences.cause FROM absences,fonctionnaires, fonctionnaires_grades WHERE isvalid = 0 AND fonctionnaires_grades.fonctionnaire_id = fonctionnaires.id  AND absences.fonctionnaire_id = fonctionnaires.id")->fetchAll("assoc");
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

    public function editMouvement($id = null)
    {
        $FonctionnairesServices = TableRegistry::get('FonctionnairesServices');
        $fonctionnairesService = $FonctionnairesServices->get($id, [
            'contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // dump($fonctionnairesService);exit;
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
            $fonctionnairesService->service_id = $this->request->data('nom_service');
            $fonctionnairesService->date_debut = $this->request->data('date_debut');
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
                if ($resultat->etatdemande == 'Demande  envoyÃ©' or $resultat->etatdemande == 'Prete' or $resultat->etatdemande == 'En cours de traitement') {
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

                    if ($FonctionnairesDocuments->save($documentsFonctionnaire)) {
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
                  
                    if ($FonctionnairesDocuments->save($documentsFonctionnaire)) {
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
    }

    public function etatDemandeFct()
    {
        $idUser = $this->Auth->user('id');
        $Foncts = TableRegistry::get('Fonctionnaires');
        $query = $Foncts->find('all')->select('id')->where(['user_id' => $idUser]);
        foreach ($query as $ligne) {
            $ide = $ligne->id;
            break;
        }
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Documents']
        ];
        $FonctionnairesDocuments = TableRegistry::get('FonctionnairesDocuments');
        $FonctionnairesDocuments = $this->paginate($FonctionnairesDocuments->find(
            "all",
            array(
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
                    'FonctionnairesDocuments.fonctionnaire_id' => $ide)
            )
        ));
        $this->set(compact('FonctionnairesDocuments'));
        $this->set('_serialize', ['FonctionnairesDocuments']);
        $this->render('/Espaces/respopersonels/etatDemandeFct');
    }

    //DOCUMENTS DANS ESPACE PERSONNEL

    //DOCUMENTS DANS ESPACE PERSONNEL
    //version2
    public function deleteDocumentFct($id = null, $id2 = null)
    {
        $FonctionnairesDocuments=TableRegistry::get('FonctionnairesDocuments');
        $this->request->allowMethod(['post', 'delete']);
        $profpermanentsDocument = $FonctionnairesDocuments->get($id);
        if ($FonctionnairesDocuments->delete($profpermanentsDocument)) {
            $this->Flash->success(__('Demande Bien Supprimée'));
        } else {
            $this->Flash->error(__('Erreur , Suppression echouée'));
        }
        $this->consultationDemandeFct($id2);
    }

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
        $fonctionnairesDocuments = $this->paginate($FonctionnairesDocuments->find(
            "all",
            array(
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
                            "Fonctionnaires.document_id = Documents.id"
                        )
                    )
                ),
                'conditions' => array(
                    'FonctionnairesDocuments.fonctionnaire_id' => $id)
            )
        ));
        $comp=0;
        foreach ($fonctionnairesDocuments as $ligne) {
            if ($ligne->etatdemande == 'Demande envoyé') {
                $comp++;
            }
        }

        $_SESSION['nouveaudemande']=$comp;
        $this->set(compact('fonctionnairesDocuments'));
        $this->set('_serialize', ['fonctionnairesDocuments']);
        $this->render('/Espaces/respopersonels/consultationDemandeFct');
    }
    public function DelivrerDemandeFct($id1, $id2, $id3)
    {
        $ProfpermanentsDocuments=TableRegistry::get('FonctionnairesDocuments');
        $query=$ProfpermanentsDocuments->find('all')->update()->set(['etatdemande' => 'Delivré'])->where(['document_id' => $id1,'fonctionnaire_id'=>$id2, 'id'=>$id3]);
        $query->execute();
        $this->consultationDemandeFct($id2);
    }
    public function approuverDemandeFct($id1 = null, $id2 = null, $id3 = null)
    {
        $FonctionnairesDocuments = TableRegistry::get('FonctionnairesDocuments');
        $query = $FonctionnairesDocuments->find('all')->update()->set(['etatdemande' => 'En cours de traitement'])->where(['document_id' => $id1, 'fonctionnaire_id' => $id2,'id'=>$id3]);
        $query->execute();
        $this->consultationDemandeFct($id2);
    }
    public function imprimerDocumentFct($id1 = null, $id2 = null, $id3 = null)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);

        $gradeAssoc=$con->execute('select pg.grade from fonctionnaires_grades pg where  pg.fonctionnaire_id='.$id2);
        $count=count($gradeAssoc);
        $this->set('nbGrade', count($gradeAssoc));
        $this->set('tabGrade', $gradeAssoc);
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Documents']
        ];
        $FonctionnairesDocuments=TableRegistry::get('FonctionnairesDocuments');
        $query=$FonctionnairesDocuments->find('all')->update()->set(['etatdemande' => 'Prete'])->where(['document_id' => $id1,'fonctionnaire_id'=>$id2,'id'=>$id3]);
        $query->execute();
        $profpermanentsDocuments = $this->paginate($FonctionnairesDocuments->find(
            "all",
            array(
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
                    'FonctionnairesDocuments.document_id' => $id1,'FonctionnairesDocuments.fonctionnaire_id'=>$id2)
            )
        ));

        switch ($id1) {
            case 1:
            {
                $this->set(compact('profpermanentsDocuments'));
                $this->set('_serialize', ['profpermanentsDocuments']);
                $this->render('/Espaces/respopersonels/imprimerAttestFct');
                break;

            }
            
            case 2:
            {
                $this->set(compact('profpermanentsDocuments'));
                $this->set('_serialize', ['profpermanentsDocuments']);
                $this->render('/Espaces/respopersonels/imprimerDemandeFct');
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
            OR prenom_fct LIKE '%" . $search . "%'OR somme LIKE '%" . $search . "%' 
            OR specialite LIKE '%" . $search . "%' OR situation_Familiale LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'OR age LIKE '%" . $search . "%'OR genre LIKE '%" . $search . "%'")->fetchAll('assoc');

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
            $this->Flash->success(__('Le fonctionnaire dans ce service est supprimé.'));
        } else {
            $this->Flash->error(__('Erreur de suppression'));
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
        if (isset($_POST['search'])) {
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
        $activite = $Activites->newEntity();

        if ($this->request->is('post')) {
            $activite->nomActivite = $this->request->data('nomActivite');
            $activite->dateDebut = $_POST['dateDebut'];
            $activite->dateFin = $_POST['dateFin'];
            $activite->photo = $_FILES['photoAct']['name'];
            $photo = $_FILES['photoAct']['name'];

            $phototempo = $_FILES['photoAct']['tmp_name'];




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
            } elseif (!move_uploaded_file($phototempo, WWW_ROOT . DS . 'img' . DS . $photo)) {
                $this->Flash->error(__('erreur webroot'));
                exit;
            } elseif ($Activites->save($activite)) {
                $photo = $_FILES['photoAct']['name'];
                $phototempo = $_FILES['photoAct']['tmp_name'];

                move_uploaded_file($phototempo, WWW_ROOT . DS . '/img' . DS . $photo);

                $this->Flash->success(__('Activité Bien Ajoutée '));
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

        if (isset($_POST['search'])) {
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
    public function statistiquesFct()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $nbFct=$con->execute('select count(id) as nbFct from fonctionnaires');
        $nbHomme=$con->execute('select count(id) as nbHomme from fonctionnaires fc where fc.genre="M"');
        $nbFemme=$con->execute('select count(id) as nbFemme from fonctionnaires fc where fc.genre="F"');
        $ageinf=$con->execute('select count(id) as ageinf from fonctionnaires fc where fc.age BETWEEN 20 and 40');
        $agesup=$con->execute('select count(id) as agesup from fonctionnaires fc where fc.age>40');

        foreach ($nbFct as $ligne) {
            $nbFct=$ligne['nbFct'];
        }
        foreach ($nbHomme as $ligne) {
            $nbHomme=$ligne['nbHomme'];
        }
        foreach ($nbFemme as $ligne) {
            $nbFemme=$ligne['nbFemme'];
        }
        foreach ($ageinf as $ligne) {
            $ageinf=$ligne['ageinf'];
        }
        foreach ($agesup as $ligne) {
            $agesup=$ligne['agesup'];
        }
        $this->set('nbFct', $nbFct);
        $this->set('nbHomme', $nbHomme);
        $this->set('nbFemme', $nbFemme);
        $this->set('ageinf', $ageinf);
        $this->set('agesup', $agesup);

        $this->paginate=['contain'=>['Fonctionnaires','Grades']];
        $FonctionnairesGrades=TableRegistry::get('FonctionnairesGrades');
        $fonctionnairesGrade=$this->paginate($FonctionnairesGrades);
        $gradesfct=$con->execute('select count(fonctionnaire_id) as gradesfct from fonctionnaires_grades fg,fonctionnaires f,grades g where fg.fonctionnaire_id=
        f.id and fg.grade_id=g.id and g.nomGrade="Administrateur"');
        foreach ($gradesfct as $ligne) {
            $gradesfct=$ligne['gradesfct'];
        }
        $gradesfct1=$con->execute('select count(fonctionnaire_id) as gradesfct1 from fonctionnaires_grades fg,fonctionnaires f,grades g where fg.fonctionnaire_id=
        f.id and fg.grade_id=g.id and g.nomGrade="Ingenieur"');
        foreach ($gradesfct1 as $ligne) {
            $gradesfct1=$ligne['gradesfct1'];
        }
        $gradesfct2=$con->execute('select count(fonctionnaire_id) as gradesfct2 from fonctionnaires_grades fg,fonctionnaires f,grades g where fg.fonctionnaire_id=
        f.id and fg.grade_id=g.id and g.nomGrade="Technicien"');
        foreach ($gradesfct2 as $ligne) {
            $gradesfct2=$ligne['gradesfct2'];
        }
        $gradesfct3=$con->execute('select count(fonctionnaire_id) as gradesfct3 from fonctionnaires_grades fg,fonctionnaires f,grades g where fg.fonctionnaire_id=
        f.id and fg.grade_id=g.id and g.nomGrade="Aide technicien"');
        foreach ($gradesfct3 as $ligne) {
            $gradesfct3=$ligne['gradesfct3'];
        }
        $gradesfct4=$con->execute('select count(fonctionnaire_id) as gradesfct4 from fonctionnaires_grades fg,fonctionnaires f,grades g where fg.fonctionnaire_id=
        f.id and fg.grade_id=g.id and g.nomGrade="Aide administrateur"');
        foreach ($gradesfct4 as $ligne) {
            $gradesfct4=$ligne['gradesfct4'];
        }
        $res=array('gradesfct'=>$gradesfct,'gradesfct1'=>$gradesfct1,'gradesfct2'=>$gradesfct2,'gradesfct3'=>$gradesfct3,'gradesfct4'=>$gradesfct4);
        $this->set('res', $res);


        $this->render('/Espaces/respopersonels/statistiquesFct');
    }


    public function statistiquesVac()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $nbVac=$con->execute('select count(id) as nbVac from vacataires');
        $nbHomme=$con->execute('select count(id) as nbHomme from vacataires fc where fc.genre="M"');
        $nbFemme=$con->execute('select count(id) as nbFemme from vacataires fc where fc.genre="F"');
        $ageinf=$con->execute('select count(id) as ageinf from vacataires fc where fc.age BETWEEN 28 and 40');
        $agesup=$con->execute('select count(id) as agesup from vacataires fc where fc.age BETWEEN 40 and 60');
        $nbheurein=$con->execute('select count(id) as nbheurein from vacataires V where V.nb_heures BETWEEN 0 and 60');
        $nbheuresu=$con->execute('select count(id) as nbheuresu from vacataires V where V.nb_heures BETWEEN 60 and 120');
        foreach ($nbVac as $ligne) {
            $nbVac=$ligne['nbVac'];
        }
        foreach ($nbHomme as $ligne) {
            $nbHomme=$ligne['nbHomme'];
        }
        foreach ($nbFemme as $ligne) {
            $nbFemme=$ligne['nbFemme'];
        }
        foreach ($ageinf as $ligne) {
            $ageinf=$ligne['ageinf'];
        }
        foreach ($agesup as $ligne) {
            $agesup=$ligne['agesup'];
        }

        foreach ($nbheurein as $ligne) {
            $nbheurein=$ligne['nbheurein'];
        }
        foreach ($nbheuresu as $ligne) {
            $nbheuresu=$ligne['nbheuresu'];
        }
        $this->set('nbVac', $nbVac);
        $this->set('nbHomme', $nbHomme);
        $this->set('nbFemme', $nbFemme);
        $this->set('ageinf', $ageinf);
        $this->set('agesup', $agesup);
        $this->set('nbheurein', $nbheurein);
        $this->set('nbheuresu', $nbheuresu);
        
       

        $this->render('/Espaces/Respopersonels/statistiquesVac');
        /*$this->render('/Espaces/Respopersonels/mounaNBFem');
        $this->render('/Espaces/Respopersonels/mounaNBMas');
        $this->render('/Espaces/Respopersonels/mounaNB');
        $this->render('/Espaces/Respopersonels/mounaNBage');
        $this->render('/Espaces/Respopersonels/mounaNBAAGE');
        $this->render('/Espaces/Respopersonels/mounaNBheure');
        $this->render('/Espaces/Respopersonels/mounaNBheuure');*/
    }

    public function mounaNbMas()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $queries=$con->execute('select * from vacataires V where V.genre="M"');
        $nbHomme=$con->execute('select count(id) as nbHomme from vacataires fc where fc.genre="M"');
        foreach ($nbHomme as $ligne) {
            $nbHomme=$ligne['nbHomme'];
        }
        $this->set('queries', $queries);
        $this->set('nbHomme', $nbHomme);
        $this->render('/Espaces/respopersonels/mounaNbMas');
    }
    public function mounaNBFem()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $queries=$con->execute('select * from vacataires V where V.genre="F"');
        $nbFemme=$con->execute('select count(id) as nbFemme from vacataires fc where fc.genre="F"');
        foreach ($nbFemme as $ligne) {
            $nbFemme=$ligne['nbFemme'];
        }

        $this->set('queries', $queries);
        $this->set('nbFemme', $nbFemme);
        $this->set('_serialize', ['queries']);

        $this->render('/Espaces/respopersonels/mounaNBFem');
    }
    public function mounaNb()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from vacataires ');
        $nbVac=$con->execute('select count(id) as nbVac from vacataires');
        foreach ($nbVac as $ligne) {
            $nbVac=$ligne['nbVac'];
        }

       
        $this->set('nbVac', $nbVac);


        $this->set('query', $query);

        $this->render('/Espaces/respopersonels/mounaNb');
    }
   
    public function mounaNBage()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from vacataires ');
        $ageinf=$con->execute('select count(id) as ageinf from vacataires fc where fc.age BETWEEN 28 and 40');
        foreach ($ageinf as $ligne) {
            $ageinf=$ligne['ageinf'];
        }

       
        $this->set('ageinf', $ageinf);

        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/mounaNBage');
    }
    public function mounaNBAAGE()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from vacataires ');

        $agesup=$con->execute('select count(id) as agesup from vacataires fc where fc.age BETWEEN 40 and 60');
        foreach ($agesup as $ligne) {
            $agesup=$ligne[' agesup'];
        }

       
        $this->set('agesup', $agesup);

        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/mounaNBAAGE');
    }
   


    public function mounaNBheure()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from vacataires ');
        $nbheurein=$con->execute('select count(id) as nbheurein from vacataires V where V.nb_heures BETWEEN 0 and 60');
        foreach ($nbheurein as $ligne) {
            $nbheurein=$ligne['nbheurein'];
        }

       
        $this->set('nbheurein', $nbheurein);
       
        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/mounaNBheure');
    }
    public function mounaNBheuure()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from vacataires ');

        $nbheuresu=$con->execute('select count(id) as nbheuresu from vacataires V where V.nb_heures BETWEEN 0 and 60');
        foreach ($nbheuresu as $ligne) {
            $nbheuresu=$ligne['nbheuresu'];
        }

       
        $this->set('nbheuresu', $nbheuresu);
       
        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/mounaNBheuure');
    }


    public function statistiquesPrper()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $nbper=$con->execute('select count(id) as nbper from profpermanents');
        $nbHomme=$con->execute('select count(id) as nbHomme from  profpermanents fc where fc.genre="M"');
        $nbFemme=$con->execute('select count(id) as nbFemme from  profpermanents fc where fc.genre="F"');
        $ageinf=$con->execute('select count(id) as ageinf from profpermanents fc where fc.age BETWEEN 28 and 40');
        $agesup=$con->execute('select count(id) as agesup from  profpermanents fc where fc.age BETWEEN 40 and 60');
      
        foreach ($nbper as $ligne) {
            $nbper=$ligne['nbper'];
        }
        foreach ($nbHomme as $ligne) {
            $nbHomme=$ligne['nbHomme'];
        }
        foreach ($nbFemme as $ligne) {
            $nbFemme=$ligne['nbFemme'];
        }
        foreach ($ageinf as $ligne) {
            $ageinf=$ligne['ageinf'];
        }
        foreach ($agesup as $ligne) {
            $agesup=$ligne['agesup'];
        }

        
        $this->set('nbper', $nbper);
        $this->set('nbHomme', $nbHomme);
        $this->set('nbFemme', $nbFemme);
        $this->set('ageinf', $ageinf);
        $this->set('agesup', $agesup);
         
        
       

        $this->render('/Espaces/Respopersonels/statistiquesPrper');
        /*$this->render('/Espaces/Respopersonels/mounaNBFem');
        $this->render('/Espaces/Respopersonels/mounaNBMas');
        $this->render('/Espaces/Respopersonels/mounaNB');
        $this->render('/Espaces/Respopersonels/mounaNBage');
        $this->render('/Espaces/Respopersonels/mounaNBAAGE');
        $this->render('/Espaces/Respopersonels/mounaNBheure');
        $this->render('/Espaces/Respopersonels/mounaNBheuure');*/
    }

    public function kawtarNbMas()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $queries=$con->execute('select * from profpermanents V where V.genre="M"');
        $nbHomme=$con->execute('select count(id) as nbHomme from profpermanents fc where fc.genre="M"');
        foreach ($nbHomme as $ligne) {
            $nbHomme=$ligne['nbHomme'];
        }
        $this->set('queries', $queries);
        $this->set('nbHomme', $nbHomme);
        $this->render('/Espaces/respopersonels/kawtarNbMas');
    }
    public function kawtarNBFem()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $queries=$con->execute('select * from profpermanents V where V.genre="F"');
        $nbFemme=$con->execute('select count(id) as nbFemme from profpermanents fc where fc.genre="F"');
        foreach ($nbFemme as $ligne) {
            $nbFemme=$ligne['nbFemme'];
        }

        $this->set('queries', $queries);
        $this->set('nbFemme', $nbFemme);
        $this->set('_serialize', ['queries']);

        $this->render('/Espaces/respopersonels/kawtarNBFem');
    }
    public function kawtarNb()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from profpermanents ');
        $nbper=$con->execute('select count(id) as nbper from profpermanents');
        foreach ($nbper as $ligne) {
            $nbper=$ligne['nbper'];
        }

       
        $this->set('nbper', $nbper);


        $this->set('query', $query);

        $this->render('/Espaces/respopersonels/kawtarNb');
    }
   
    public function kawtarNBage()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from profpermanents ');
        $ageinf=$con->execute('select count(id) as ageinf from profpermanents fc where fc.age BETWEEN 28 and 40');
        foreach ($ageinf as $ligne) {
            $ageinf=$ligne['ageinf'];
        }

       
        $this->set('ageinf', $ageinf);

        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/kawtarNBage');
    }
    public function kawtarNBAAGE()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from profpermanents ');

        $agesup=$con->execute('select count(id) as agesup from profpermanents fc where fc.age BETWEEN 40 and 60');
        foreach ($agesup as $ligne) {
            $agesup=$ligne['agesup'];
        }

       
        $this->set('agesup', $agesup);

        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/kawtarNBAAGE');
    }
   





    
    public function StatistiquesFctService()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $FonctionnairesServices=TableRegistry::get('FonctionnairesServices');
        $fonctionnairesService=$this->paginate($FonctionnairesServices);
        $service=$con->execute('select count(fonctionnaire_id) as service from fonctionnaires_services fs,fonctionnaires f,services s where fs.fonctionnaire_id=
        f.id and fs.service_id=s.id and s.nom_service="Scolarite"');
        foreach ($service as $ligne) {
            $service=$ligne['service'];
        }
        $service2=$con->execute('select count(fonctionnaire_id) as service2 from fonctionnaires_services fs,fonctionnaires f,services s where fs.fonctionnaire_id=
        f.id and fs.service_id=s.id and s.nom_service="Finance"');
        foreach ($service2 as $ligne) {
            $service2=$ligne['service2'];
        }
        $service3=$con->execute('select count(fonctionnaire_id) as service3 from fonctionnaires_services fs,fonctionnaires f,services s where fs.fonctionnaire_id=
        f.id and fs.service_id=s.id and s.nom_service="RH"');
        foreach ($service3 as $ligne) {
            $service3=$ligne['service3'];
        }
        $service4=$con->execute('select count(fonctionnaire_id) as service4 from fonctionnaires_services fs,fonctionnaires f,services s where fs.fonctionnaire_id=
        f.id and fs.service_id=s.id and s.nom_service="Economique"');
        foreach ($service4 as $ligne) {
            $service4=$ligne['service4'];
        }
        $res1=array('service'=>$service,'service2'=>$service2,'service3'=>$service3,'service4'=>$service4);
        $this->set('res1', $res1);
        $this->render('/Espaces/respopersonels/statistiquesFct');
    }
    public function StatistiquesFctActivite()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $FonctionnairesActivites=TableRegistry::get('FonctionnairesActivites');
        $fonctionnairesActivite=$this->paginate($FonctionnairesActivites);
        $activite=$con->execute('select count(fonctionnaire_id) as activite from fonctionnaires_activites fs,fonctionnaires f,activites s where fs.fonctionnaire_id=
        f.id and fs.activite_id=s.id and s.nomActivite="FORUM FEE2017"');
        foreach ($activite as $ligne) {
            $activite=$ligne['activite'];
        }
        $activite2=$con->execute('select count(fonctionnaire_id) as activite2 from fonctionnaires_activites fs,fonctionnaires f,activites s where fs.fonctionnaire_id=
        f.id and fs.activite_id=s.id and s.nomActivite="Open SOurce"');
        foreach ($activite2 as $ligne) {
            $activite2=$ligne['activite2'];
        }
        $activite3=$con->execute('select count(fonctionnaire_id) as activite3 from fonctionnaires_activites fs,fonctionnaires f,activites s where fs.fonctionnaire_id=
        f.id and fs.activite_id=s.id and s.nomActivite="Ensak Got Talents"');
        foreach ($activite3 as $ligne) {
            $activite3=$ligne['activite3'];
        }

        $res2=array('activite'=>$activite,'activite2'=>$activite2,'activite3'=>$activite3);
        $this->set('res2', $res2);
        $this->render('/Espaces/respopersonels/statistiquesFct');
    }
    public function passerNextEchelleTec($id = null)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);
        for ($i=6; $i<=10; $i++) {
            $query = $con->execute('update fonctionnaires f,grades g,fonctionnaires_grades fg set f.echelle=' . $i . '
  where  fg.fonctionnaire_id=f.id and fg.grade_id=g.id and g.nomGrade="technicien"');
            $this->avancementGradeFct();
        }
    }
    public function passerNextEchelleAAdmin($id = null, $echelle)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);
        $echelle=$echelle+1;
        $query = $con->execute('update fonctionnaires f,grades g,fonctionnaires_grades fg set f.echelle=".$echelle." ,
  where  fg.fonctionnaire_id=f.id and fg.grade_id=g.id and f.echelle=8 
and g.nomGrade="aide_administrateur"');
        $this->avancementGradeFct();
    }
    public function passerNextGradeAAdmin($id = null)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $query = $con->execute('update fonctionnaires f,grades g,fonctionnaires_grades fg set f.echelle=6 ,
g.nomGrade="aide_technicien " where  fg.fonctionnaire_id=f.id and fg.grade_id=g.id and f.echelle=8 
and g.nomGrade="aide_administrateur"');
        $this->avancementGradeFct();
    }
    public function passerNextGradeIng($id = null)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $query = $con->execute('update fonctionnaires f,grades g,fonctionnaires_grades fg set f.echelle=10 ,
g.nomGrade="administrateur " where  fg.fonctionnaire_id=f.id and fg.grade_id=g.id and f.echelle="HE" 
and g.nomGrade="ingenieur"');
        $this->avancementGradeFct();
    }
    public function passerNextGradeATec($id = null)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query = $con->execute('update fonctionnaires f,grades g,fonctionnaires_grades fg set f.echelle=6 ,
g.nomGrade="technicien "  where  fg.fonctionnaire_id=f.id and fg.grade_id=g.id 
and g.nomGrade="aide_technicien"');

        $this->avancementGradeFct();
    }
    public function ibtissamAge()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from fonctionnaires fc where fc.age between 20 and 40');
        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/ibtissamAge');
    }
    public function ibtissamAgeProf()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from profpermanents fc where fc.age between 20 and 40');
        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/ibtissamAgeProf');
    }
    public function ibtissamAge2()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from fonctionnaires fc where fc.age>40');
        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/ibtissamAge2');
    }
    public function ibtissamAge2Prof()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from profpermanents fc where fc.age>40');
        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/ibtissamAge2Prof');
    }
    public function ibtissamNbMas()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from fonctionnaires fc where fc.genre="M"');
        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/ibtissamNbMas');
    }
    public function ibtissamNbMasProf()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from profpermanents fc where fc.genre="M"');
        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/ibtissamNbMasProf');
    }
    public function ibtissamNbFem()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from fonctionnaires fc where fc.genre="F"');
        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/ibtissamNbFem');
    }
    public function ibtissamNbFemProf()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from profpermanents fc where fc.genre="F"');
        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/ibtissamNbFemProf');
    }
    public function ibtissamNb()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from fonctionnaires ');
        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/ibtissamNb');
    }
    public function ibtissamNbProf()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';

        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $query=$con->execute('select * from profpermanents ');
        $this->set('query', $query);
        $this->render('/Espaces/respopersonels/ibtissamNbProf');
    }
    public function avancementGradeFct()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $this->paginate=['contain'=>['Fonctionnaires','Grades']];
        $FonctionnairesGrades=TableRegistry::get('FonctionnairesGrades');
        $fonctionnairesGrade=$this->paginate($FonctionnairesGrades);


        $query=$con->execute("select * from fonctionnaires f,grades g,fonctionnaires_grades fg where 
fg.fonctionnaire_id=f.id and fg.grade_id=g.id and g.nomGrade='administrateur' and ((f.echelle='HE' and fg.nbAnciennete=10) OR f.echelle=6 and fg.isPassExam=1)");

        $query1 = $con->execute("select * from fonctionnaires f,grades g,fonctionnaires_grades fg where 
fg.fonctionnaire_id=f.id and fg.grade_id=g.id and g.nomGrade='technicien'and ((f.echelle=8 and fg.nbAnciennete=10) OR (f.echelle=6 and fg.isPassExam=1)) ");
        $query2 = $con->execute("select * from fonctionnaires f,grades g,fonctionnaires_grades fg where 
fg.fonctionnaire_id=f.id and fg.grade_id=g.id and g.nomGrade='aide_technicien' and ((f.echelle=8 and fg.nbAnciennete=10) OR (f.echelle=6 and fg.isPassExam=1))");
        $query3 = $con->execute("select * from fonctionnaires f,grades g,fonctionnaires_grades fg where 
fg.fonctionnaire_id=f.id and fg.grade_id=g.id and g.nomGrade='aide_administrateur' and ((f.echelle=8 and fg.nbAnciennete=10) OR (f.echelle=6 and fg.isPassExam=1))");

        $query4=$con->execute("select * from fonctionnaires f,grades g,fonctionnaires_grades fg where 
fg.fonctionnaire_id=f.id and fg.grade_id=g.id and g.nomGrade='ingenieur' and (f.echelle=111 and fg.nbAnciennete=5 and f.echelon=7)");

        $res=array('query'=>$query,'query1'=>$query1,'query2'=>$query2,'query3'=>$query3,'query4'=>$query4);
        $this->set('res', $res);
        $this->render('/Espaces/respopersonels/avancementGradeFct');
    }

   
    public function abs()
    {
        $this->set(compact('absences'));
        $this->render('/Espaces/respopersonels/abs');
    }
    
    public function filterabs($limit = 100)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);
        $cat=$_POST['cat'];

        switch ($_POST['recherche']) {
            case "id":
            {
                $absences=$con->execute("SELECT * FROM absences WHERE id LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('absences', $absences);
                break;
            }
            case "fonctionnaire_id":
            {
                $absences=$con->execute("SELECT * FROM absences WHERE fonctionnaire_id LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('absences', $absences);
                break;
            }
            case "duree_ab":
            {
                $absences=$con->execute("SELECT * FROM absences WHERE duree_ab LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('absences', $absences);
                break;
            }
            case "cause":
            {
                $absences=$con->execute("SELECT * FROM absences WHERE cause LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('absences', $absences);
                break;
            }
            case "date_ab":
            {
                $absences=$con->execute("SELECT * FROM absences WHERE date_ab LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('absences', $absences);
                break;
            }

            case "time_ab":
            {
                $absences=$con->execute("SELECT * FROM absences WHERE time_ab LIKE '%" .$cat. "%'")->fetchAll('assoc');
                $this->set('absences', $absences);
                break;
            }
            default:
                echo "la requete demandée n'existe pas";
        }

        $this->render('/Espaces/respopersonels/filterabs');
    }
    public function affecterGradeFct()
    {
        $grrades=TableRegistry::get('Grades');
        $Profs=TableRegistry::get('Fonctionnaires');
        $profpermanentsGrades=TableRegistry::get('FonctionnairesGrades');
        
        if ($this->request->is('post')) {
            //  $profpermanentsGrade->profpermanent_id =$this->request->data('nomSomme');
            $profpermanentsGrade = $profpermanentsGrades->find('all')->where(['fonctionnaire_id'=>$this->request->data['idProf']])->first();

            $profpermanentsGrade->echelon=$this->request->data('echelon');
            $dateTest = explode("/", $_POST['date_grade']);
            $profpermanentsGrade->grade=$this->request->data('grade');
            $date_string=$dateTest[2].'-'.$dateTest[1].'-'.$dateTest[0];
            $date_echelon_rapide = date_create($date_string);
            $date_echelon_moyen=date_create($date_string);
            $date_echelon_normal=date_create($date_string);

            $catgrie = $this->request->data('categorie');

            if ($catgrie == 0 or $catgrie == 1 or $catgrie == 2 or $catgrie == 3) {
                switch ($this->request->data('echelon')) {
                    case 1:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('12 months'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('12 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('12 months'));
                        break;
                    }
                    case 2:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('12 months'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('18 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('2 years'));
                        break;

                    }
                    case 3:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('3 years'));
                        break;

                    }
                    case 4:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('42 months'));
                        break;


                    }
                    case 5:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('42 months'));
                        break;


                    }
                    case 6:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('3 years'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('42 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('4 years'));
                        break;


                    }
                    case 7:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('3 years'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('42 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('4 years'));
                        break;


                    }
                    case 8:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('3 years'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('42 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('54 months'));
                        break;


                    }
                    case 9:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('4 years'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('54 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('66 months'));
                        break;
                    }
                }
            } //If categorie
            elseif ($catgrie == 4 or $catgrie == 5) {
                switch ($this->request->data('echelon')) {
                    case 1:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('12 months'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('12 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('12 months'));
                        break;
                    }
                    case 2:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('12 months'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('18 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('2 years'));
                        break;

                    }
                    case 3:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('3 years'));
                        break;

                    }
                    case 4:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('42 months'));
                        break;


                    }
                }
            } elseif ($catgrie == 7 or $catgrie == 6) {
                # code...
                switch ($this->request->data('echelon')) {
                    case 1:
                        {
                            date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                            date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                            date_add($date_echelon_normal, date_interval_create_from_date_string('36 months'));
                            break;
                    }
                    case 2:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('36 months'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('36 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('3 years'));
                        break;

                    }
                    case 3:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('36 months'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('48 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('4 years'));
                        break;

                    }
                    case 4:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('36 months'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('48 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('48 months'));
                        break;


                    }
                    case 5:
                    {
                        date_add($date_echelon_rapide, date_interval_create_from_date_string('36 months'));
                        date_add($date_echelon_moyen, date_interval_create_from_date_string('48 months'));
                        date_add($date_echelon_normal, date_interval_create_from_date_string('48 months'));
                        break;


                    }
                }
            }
            $profpermanentsGrade->date_grade =$date_string;
            $profpermanentsGrade->date_echelon_rapide =$date_echelon_rapide;
            $profpermanentsGrade->date_echelon_normal =$date_echelon_normal;
            $profpermanentsGrade->date_echelon_moyen =$date_echelon_moyen;


            //$req=$Profs->find('all')->select('id')->where(['nom_fct'=>$_POST['nomProf'],'prenom_fct'=>$_POST['prenomProf']]);
            switch ($_POST['grade']) {
                case 1:
                {
                    $IDGRADE=4;
                    break;
                }
                case 2:
                {
                      $IDGRADE=5;
                    break;
                }
                case 3:
                {
                    $IDGRADE=6;
                    break;

                }
                case 4:
                {
                    $IDGRADE=7;
                    break;
                }
                case 5:
                {
                    $IDGRADE=8;
                    break;
                }
                case 6:
                {
                    $IDGRADE=9;
                    break;
                }
                case 7:
                {
                    $IDGRADE=10;
                    break;
                }
                case 8:
                {
                    $IDGRADE=11;
                    break;
                }
            }


            

            $profpermanentsGrade->fonctionnaire_id =$this->request->data('idProf');
            $profpermanentsGrade->grade_id =$IDGRADE;
            $profpermanentsGrade->categorie=$_POST['categorie'];


            if ($profpermanentsGrades->save($profpermanentsGrade)) {
                $this->Flash->success(__('Grade bien enregistré'));

                return $this->redirect(['action' => 'listerGrade']);
            } else {
                $this->Flash->error(__('Affectation Grade échouée'));
            }
        }


        $fonctionnaires = $profpermanentsGrades->Fonctionnaires->find('list', ['limit' => 200]);
        $grades = $profpermanentsGrades->Grades->find('list', ['limit' => 200]);
        $this->set(compact('fonctionnairesGrade', 'fonctionnaires', 'grades'));
        $i=1;
        $queryProf=$Profs->find('all');
       
        $j=1;
        $tabNom=['Aide technicien','Technicien','Aide administrateur','Administrateur','Ingenieur etat','Ingenieur application','Ingenieur application principal','Ingenieur etat principal', 'Ingenieur en chef'];
        $tabechelon=[1 => 1,2,3,4,5,6,7,8,9,10];
        //$this->set('tabNomProf', $tabNomProf);
        //$this->set('tabPrenomProf', $tabPrenom);
        $this->set('queryProf', $queryProf);
        $this->set('nomtab', $tabNom);
        $this->set('tabechelon', $tabechelon);
        $this->set('_serialize', ['fonctionnairesGrade']);
        $this->render('/Espaces/respopersonels/affecterGradeFct');
    }

    public function etatAvancementGradeFct()
    {
        $profsPermanents=TableRegistry::get('FonctionnairesGrades');
        $profsPermanents->paginate = [
            'contain' => ['Grades', 'Fonctionnaires']
        ];
        $date=date('Y-m-d');
        $dateEssai=explode('-', $date);
        $yearEssai=$dateEssai[0]-10;
        $yearEssaiBis=$dateEssai[0]-6;

        $dateFinal=$yearEssai.'-'.$dateEssai[1].'-'.$dateEssai[2];
        $dateFinalBis=$yearEssaiBis.'-'.$dateEssai[1].'-'.$dateEssai[2];
        $date_passage_tableau=$profsPermanents->find('all')->select()->where(['date_grade <= '=>$dateFinal])->count();
        $date_passage_examen=$profsPermanents->find('all')->select()->where(['date_grade <= '=>$dateFinalBis])->count();
        
      
        $this->set('nb_passage_tableau', $date_passage_tableau);
        $this->set('nb_passage_examen', $date_passage_examen);
    }
    public function listerPassageGradeFcttableau()
    {
        $profsPermanentsGrades=TableRegistry::get('FonctionnairesGrades');
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Grades']
        ];
        $date=date('Y-m-d');
        $dateEssai=explode('-', $date);
        $yearEssai=$dateEssai[0]-10;
        $dateFinal=$yearEssai.'-'.$dateEssai[1].'-'.$dateEssai[2];
        $profpermanentsGrades = $this->paginate($profsPermanentsGrades->find('all')->select()->where(['date_grade <= '=>$dateFinal]));


        $this->set(compact('profpermanentsGrades'));
        $this->set('_serialize', ['profpermanentsGrades']);
        $this->render('/Espaces/respopersonels/listerPassageGradeFcttableau');
    }
    public function passerSuivant($id, $grade, $indice)
    {
        $date=date('y-m-d');

        $date_echelon_rapide=date_create($date);
        $date_echelon_moyen=date_create($date);
        $date_echelon_normal=date_create($date);


        date_add($date_echelon_rapide, date_interval_create_from_date_string('12 months'));
        date_add($date_echelon_moyen, date_interval_create_from_date_string('12 months'));
        date_add($date_echelon_normal, date_interval_create_from_date_string('12 months'));
        switch ($grade) {
            case 'Aide technicien':
            {
                $gradeSuivant=5;
                break;
            }
            case 'Technicien':
            {
                $gradeSuivant=6;
                break;
            }
            case 'Aide administrateur':
            {
                $gradeSuivant=7;
                break;
            }
        }

        $dateInsert=date('y-m-d');
        $fctsgrades=TableRegistry::get('FonctionnairesGrades');
        $query=$fctsgrades->find('all')->update()->set(
            ['grade_id'=>$gradeSuivant,'echelon'=>1,'date_echelon_rapide'=>$date_echelon_rapide,
                'date_echelon_normal'=>$date_echelon_normal,'date_echelon_moyen'=>$date_echelon_moyen,'date_grade'=>$dateInsert,'categorie'=>'1er Grade']
        )->where(['id' => $id]);
        $query->execute();
        $this->set('indice', $indice);
        $this->listerGradeFct();
    }
    public function listerPassageGradeFctExamen()
    {
        $profsPermanentsGrades=TableRegistry::get('FonctionnairesGrades');
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Grades']
        ];
        $date=date('Y-m-d');
        $dateEssai=explode('-', $date);
        $yearEssai=$dateEssai[0]-6;
        $dateFinal=$yearEssai.'-'.$dateEssai[1].'-'.$dateEssai[2];
        $profpermanentsGrades = $this->paginate($profsPermanentsGrades->find('all')->select()->where(['date_grade <= '=>$dateFinal]));


        $this->set(compact('profpermanentsGrades'));
        $this->set('_serialize', ['profpermanentsGrades']);
        $this->render('/Espaces/respopersonels/listerPassageGradeFctExamen');
    }
    public function listerPassageGradeFct($id)
    {
        switch ($id) {
            case 0:
            {
                $this->listerPassageGradeFcttableau();
            }
            case 1:
            {
                $this->listerPassageGradeFctExamen();
            }
        }
    }
    public function passageEchelonFctBis($id, $echelon, $grade)
    {
        $date=date('y-m-d');
        $date_echelon_rapide=date_create($date);
        $date_echelon_moyen=date_create($date);
        $date_echelon_normal=date_create($date);
        if ($grade=='Ingenieur etat'||$grade='Ingenieur application') {
            switch ($echelon) {
                case 1:
                {
                    date_add($date_echelon_rapide, date_interval_create_from_date_string('12 months'));
                    date_add($date_echelon_moyen, date_interval_create_from_date_string('12 months'));
                    date_add($date_echelon_normal, date_interval_create_from_date_string('12 months'));
                    break;
                }
                case 2:
                {
                    date_add($date_echelon_rapide, date_interval_create_from_date_string('12 months'));
                    date_add($date_echelon_moyen, date_interval_create_from_date_string('18 months'));
                    date_add($date_echelon_normal, date_interval_create_from_date_string('2 years'));
                    break;

                }
                case 3:
                {
                    date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                    date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                    date_add($date_echelon_normal, date_interval_create_from_date_string('3 years'));
                    break;

                }
                case 4:
                {
                    date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                    date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                    date_add($date_echelon_normal, date_interval_create_from_date_string('3 years'));
                    break;


                }
            }
        }
        if ($grade=='Ingenieur etat principal'||$grade=='Ingenieur application principal') {
            switch ($echelon) {
                case 1:
                {
                    date_add($date_echelon_rapide, date_interval_create_from_date_string('2 years'));
                    date_add($date_echelon_moyen, date_interval_create_from_date_string('18 months'));
                    date_add($date_echelon_normal, date_interval_create_from_date_string('3 years'));
                    break;
                }
                case 2:
                {
                    date_add($date_echelon_rapide, date_interval_create_from_date_string('3 years'));
                    date_add($date_echelon_moyen, date_interval_create_from_date_string('3 years'));
                    date_add($date_echelon_normal, date_interval_create_from_date_string('3 years'));
                    break;

                }
                case 3:
                {
                    date_add($date_echelon_rapide, date_interval_create_from_date_string('3 years'));
                    date_add($date_echelon_moyen, date_interval_create_from_date_string('4 years'));
                    date_add($date_echelon_normal, date_interval_create_from_date_string('4 years'));
                    break;

                }
                case 4:
                {
                    date_add($date_echelon_rapide, date_interval_create_from_date_string('3 years'));
                    date_add($date_echelon_moyen, date_interval_create_from_date_string('4 years'));
                    date_add($date_echelon_normal, date_interval_create_from_date_string('4 years'));
                    break;


                }
            }
        }
        if ($echelon<>5) {
            $echelonInsert=$echelon+1;
        }
        $dateInsert=date('y-m-d');
        $fctsgrades=TableRegistry::get('FonctionnairesGrades');
        $query=$fctsgrades->find('all')->update()->set(
            ['echelon' => $echelonInsert,'echelon'=>1,'date_echelon_rapide'=>$date_echelon_rapide,
                'date_echelon_normal'=>$date_echelon_normal,'date_echelon_moyen'=>$date_echelon_moyen,'date_grade'=>$dateInsert]
        )->where(['id' => $id]);
        $query->execute();
        $this->listerGradeFct();
    }
    public function passageGlobalFct($id, $echelon, $grade)
    {
        if ($grade=='Ingenieur etat'||$grade=='Ingenieur application') {
            $this->passageEchelonFctBis($id, $echelon);
        } else {
            $this->passageEchelonFct($id, $echelon);
        }
    }
    public function passageEchelonFct($id, $echelon)
    {
        $date=date('y-m-d');

        $date_echelon_rapide=date_create($date);
        $date_echelon_moyen=date_create($date);
        $date_echelon_normal=date_create($date);

        switch ($echelon) {
            case 1:
            {
                date_add($date_echelon_rapide, date_interval_create_from_date_string('12 months'));
                date_add($date_echelon_moyen, date_interval_create_from_date_string('12 months'));
                date_add($date_echelon_normal, date_interval_create_from_date_string('12 months'));
                break;
            }
            case 2:
            {
                date_add($date_echelon_rapide, date_interval_create_from_date_string('12 months'));
                date_add($date_echelon_moyen, date_interval_create_from_date_string('18 months'));
                date_add($date_echelon_normal, date_interval_create_from_date_string('2 years'));
                break;

            }
            case 3:
            {
                date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                date_add($date_echelon_normal, date_interval_create_from_date_string('3 years'));
                break;

            }
            case 4:
            {
                date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                date_add($date_echelon_normal, date_interval_create_from_date_string('42 months'));
                break;


            }
            case 5:
            {
                date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                date_add($date_echelon_normal, date_interval_create_from_date_string('42 months'));
                break;


            }
            case 5:
            {
                date_add($date_echelon_rapide, date_interval_create_from_date_string('3 years'));
                date_add($date_echelon_moyen, date_interval_create_from_date_string('42 months'));
                date_add($date_echelon_normal, date_interval_create_from_date_string('4 years'));
                break;


            }
            case 6:
            {
                date_add($date_echelon_rapide, date_interval_create_from_date_string('3 years'));
                date_add($date_echelon_moyen, date_interval_create_from_date_string('42 months'));
                date_add($date_echelon_normal, date_interval_create_from_date_string('4 years'));
                break;


            }
            case 7:
            {
                date_add($date_echelon_rapide, date_interval_create_from_date_string('3 years'));
                date_add($date_echelon_moyen, date_interval_create_from_date_string('42 months'));
                date_add($date_echelon_normal, date_interval_create_from_date_string('54 months'));
                break;


            }
            case 8:
            {
                date_add($date_echelon_rapide, date_interval_create_from_date_string('4 years'));
                date_add($date_echelon_moyen, date_interval_create_from_date_string('54 months'));
                date_add($date_echelon_normal, date_interval_create_from_date_string('66 months'));
                break;
            }
        }
        if ($echelon<>10) {
            $echelonInsert=$echelon+1;
        }
        $dateInsert=date('y-m-d');
        $fctsgrades=TableRegistry::get('FonctionnairesGrades');
        $query=$fctsgrades->find('all')->update()->set(
            ['echelon' => $echelonInsert,'date_echelon_rapide'=>$date_echelon_rapide,
                'date_echelon_normal'=>$date_echelon_normal,'date_echelon_moyen'=>$date_echelon_moyen,'date_grade'=>$dateInsert]
        )->where(['id' => $id]);
        $query->execute();
        $this->listerGradeFct();
    }
    public function listerPassageFct($id)
    {
        $profsPermanentsGrades=TableRegistry::get('FonctionnairesGrades');
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Grades']
        ];
        $date=date('Y-m-d');
        switch ($id) {
            case 0:
            {
                $profpermanentsGrades = $this->paginate($profsPermanentsGrades->find('all')->select()->where(['date_echelon_moyen <= '=>$date,
                ]));
                break;
            }
            case 1:
            {
                $profpermanentsGrades = $this->paginate($profsPermanentsGrades->find('all')->select()->where(['date_echelon_normal <= '=>$date]));
                break;
            }
            case 2:
            {
                $profpermanentsGrades = $this->paginate($profsPermanentsGrades->find('all')->select()->where(['date_echelon_rapide <= '=>$date]));
                break;
            }
        }
        $this->set(compact('profpermanentsGrades'));
        $this->set('_serialize', ['profpermanentsGrades']);
        $this->render('/Espaces/respopersonels/listerPassageFct');
    }
    public function listerGradeFct()
    {
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Infosgradesprofs']
        ];
        $ProfpermanentsGrades=TableRegistry::get('FonctionnairesGrades');
        $profpermanentsGrades = $this->paginate($ProfpermanentsGrades);
        debug($profpermanentsGrades);
        $this->set(compact('profpermanentsGrades'));
        $this->set('_serialize', ['profpermanentsGrades']);
        $this->render('/Espaces/respopersonels/listerGradeFct');
    }
    public function listerAbsences()
    {
        $con=ConnectionManager::get('default');

        $absences=$con->execute("SELECT * FROM absences");
        $this->set('absences', $absences);
        $this->render('/Espaces/Respopersonels/listerAbsences');
    }

   public function listerAbsencesperm()
    {
        $con=ConnectionManager::get('default');

        $absences=$con->execute("SELECT * FROM profperm_absences");
        $this->set('absences', $absences);
        $this->render('/Espaces/Respopersonels/listerAbsencesperm');
    }
    public function listerAbsencesvac()
    {
        $con=ConnectionManager::get('default');

        $absences=$con->execute("SELECT * FROM vacataires_absences");
        $this->set('absences', $absences);
        $this->render('/Espaces/Respopersonels/listerAbsencesvac');
    }


    public function listerAbsencesParDate()
    {
        $con=ConnectionManager::get('default');

        $absences=$con->execute("SELECT fonctionnaires.id,fonctionnaires.nom_fct , fonctionnaires.prenom_fct ,absences.cause,absences.date_ab FROM fonctionnaires,absences where( fonctionnaires.id=absences.fonctionnaire_id) ORDER BY absences.date_ab");
        $this->set('absences', $absences);
        $this->render('/Espaces/Respopersonels/listerAbsencesParDate');
    }
    public function listerAbspermParDate()
    {
        $con=ConnectionManager::get('default');

        $absences=$con->execute("SELECT profpermanents.id,profpermanents.nom_prof , profpermanents.prenom_prof ,profperm_absences.cause,profperm_absences.date_ab FROM profpermanents,profperm_absences where( profpermanents.id=profperm_absences.profpermanent_id) ORDER BY profperm_absences.date_ab");
        $this->set('absences', $absences);
        $this->render('/Espaces/Respopersonels/listerAbspermParDate');
    }

    public function listerAbsvacParDate()
    {
        $con=ConnectionManager::get('default');

        $absences=$con->execute("SELECT vacataires.id,vacataires.nom_vacataire , vacataires.prenom_vacataire ,vacataires_absences.cause,vacataires_absences.date_ab FROM vacataires,vacataires_absences where( vacataires.id=vacataires_absences.vacataire_id) ORDER BY vacataires_absences.date_ab");
        $this->set('absences', $absences);
        $this->render('/Espaces/Respopersonels/listerAbsvacParDate');
    }








    public function traitementabsprof($id = null)
    {
        $con=ConnectionManager::get('default');
        $id_prof = $_SESSION['demandes'][0]['profpermanent_id'];
        $duree = 0;
        $_SESSION['print'] = 'no';
        $_SESSION['refus'] = 'no';

        $nbr_absences = $con->execute("SELECT duree_ab FROM profperm_absences WHERE profpermanent_id = $id_prof AND isvalid=1")->fetchAll("assoc");
        $nbr_abs = $con->execute("SELECT COUNT(*) as n FROM profperm_absences WHERE profpermanent_id = $id_prof AND isvalid=1")->fetchAll("assoc");
        for ($i=0; $i <$nbr_abs[0]['n']; $i++) {
            $duree += $nbr_absences[0]['duree_ab'];
        }

        $_SESSION['nbr_abs'] = $duree;

        if (isset($_POST['refuser'])) {
            $con->execute("UPDATE profperm_absences SET isvalid = 2 WHERE id = $id");
            $_SESSION['refus'] = 'yes';
        }

        if (isset($_POST['valider'])) {
            $con->execute("UPDATE profperm_absences SET isvalid = 1 WHERE id = $id");
            $_SESSION['print'] = 'yes';
        }

        $this->render('/Espaces/respopersonels/traitementabsprof');
    }
 public function traitementabsvac($id = null)
    {
        $con=ConnectionManager::get('default');
        $id_prof = $_SESSION['demandes'][0]['vacataire_id'];
        $duree = 0;
        $_SESSION['print'] = 'no';
        $_SESSION['refus'] = 'no';

        $nbr_absences = $con->execute("SELECT duree_ab FROM vacataires_absences WHERE vacataire_id = $id_prof AND isvalid=1")->fetchAll("assoc");
        $nbr_abs = $con->execute("SELECT COUNT(*) as n FROM vacataires_absences WHERE vacataire_id = $id_prof AND isvalid=1")->fetchAll("assoc");
        for ($i=0; $i <$nbr_abs[0]['n']; $i++) {
            $duree += $nbr_absences[0]['duree_ab'];
        }

        $_SESSION['nbr_abs'] = $duree;

        if (isset($_POST['refuser'])) {
            $con->execute("UPDATE vacataires_absences SET isvalid = 2 WHERE id = $id");
            $_SESSION['refus'] = 'yes';
        }

        if (isset($_POST['valider'])) {
            $con->execute("UPDATE vacataires_absences SET isvalid = 1 WHERE id = $id");
            $_SESSION['print'] = 'yes';
        }

        $this->render('/Espaces/respopersonels/traitementabsvac');
    }

    public function traitementabs($id = null)
    {
        $con=ConnectionManager::get('default');
        $id_fonct = $_SESSION['demandes'][0]['fonctionnaire_id'];
        $duree = 0;
        $_SESSION['print'] = 'no';
        $_SESSION['refus'] = 'no';

        $nbr_absences = $con->execute("SELECT duree_ab FROM absences WHERE fonctionnaire_id = $id_fonct AND isvalid=1")->fetchAll("assoc");
        $nbr_abs = $con->execute("SELECT COUNT(*) as n FROM absences WHERE fonctionnaire_id = $id_fonct AND isvalid=1")->fetchAll("assoc");
        for ($i=0; $i <$nbr_abs[0]['n']; $i++) {
            $duree += $nbr_absences[0]['duree_ab'];
        }

        $_SESSION['nbr_abs'] = $duree;

        if (isset($_POST['refuser'])) {
            $con->execute("UPDATE absences SET isvalid = 2 WHERE id = $id");
            $_SESSION['refus'] = 'yes';
        }

        if (isset($_POST['valider'])) {
            $con->execute("UPDATE absences SET isvalid = 1 WHERE id = $id");
            $_SESSION['print'] = 'yes';
        }

        $this->render('/Espaces/respopersonels/viewKawtar');
    }

    public function Imprimer()
    {
        $this->render('/Espaces/respopersonels/imprimer');
    }
    public function Imprimerabsperm()
    {
        $this->render('/Espaces/respopersonels/Imprimerabsperm');
    }
  public function Imprimerabsvac()
    {
        $this->render('/Espaces/respopersonels/Imprimerabsvac');
    }



    
    public function evolutionGrades()
    {
        $this->paginate = ['contain' => ['Grades', 'Fonctionnaires']];
        $FonctionnairesGrades = TableRegistry::get('FonctionnairesGrades');

        $con = ConnectionManager::get('default');
        $nombre = array();
        if ($this->request->is('post')) {
            $fonctionnairesGrade = $this->paginate($FonctionnairesGrades->find('all', array(
                         "table" => "fonctionnaires",
                        "conditions" => array( "fonctionnaires_grades.fonctionnaire_id=fonctionnaire.id")
                    )));
            $fonctionnaireG = $con->execute("SELECT FG.fonctionnaire_id, F.nom_fct, F.prenom_fct, F.somme, 
             FG.grade,FG.categorie,FG.echelon, FG.date_grade,FG.date_echelon_rapide,FG.date_echelon_moyen,FG.date_echelon_normal FROM 
            fonctionnaires AS F,fonctionnaires_grades AS FG WHERE F.id = FG.fonctionnaire_id 
             and F.nom_fct = ? "
                [$this->request->data['somme']])->fetchAll('assoc');

        /*    "joins" => array(
                array(
                    "table" => "grades",
                    "conditions" => array( "fonctionnaires_grades.grade_id = grades.id")
                ),
                array(
                    "table" => "fonctionnaires",
                    "conditions" => array( "fonctionnaires_grades.fonctionnaire_id=fonctionnaire.id")
                )))));   */

           /* $fonctionnaireG = $con->execute("SELECT FG.fonctionnaire_id, F.nom_fct, F.prenom_fct, F.somme,
            G.codeGrade, G.nomGrade,G.categorie, FG.date_grade FROM
            fonctionnaires AS F,grades AS G,fonctionnaires_grades AS FG WHERE F.id = FG.fonctionnaire_id
            AND G.id = FG.grade_id and F.nom_fct = ? "
                [$this->request->data['somme']])->fetchAll('assoc');*/
        } else {
            $fonctionnaireG = $con->execute("SELECT FG.fonctionnaire_id, F.nom_fct, F.prenom_fct, F.somme, 
            FG.grade,FG.categorie, FG.echelon, FG.date_grade,FG.date_echelon_rapide,FG.date_echelon_moyen,FG.date_echelon_normal  FROM 
            fonctionnaires AS F,fonctionnaires_grades AS FG WHERE F.id = 
            FG.fonctionnaire_id  
             ORDER BY  FG.fonctionnaire_id ASC ")->fetchAll('assoc');


            /*
             $fonctionnaireG = $con->execute("SELECT FG.fonctionnaire_id, F.nom_fct, F.prenom_fct, F.somme,
             G.codeGrade, G.nomGrade,FG.categorie, FG.date_grade FROM
             fonctionnaires AS F,grades AS G,fonctionnaires_grades AS FG WHERE F.id =
             FG.fonctionnaire_id AND
             G.id = FG.grade_id ORDER BY  FG.fonctionnaire_id DESC ")->fetchAll('assoc');*/
        }
        for ($k=0; $k<count($fonctionnaireG); $k++) {
            if ($k!=0 && $fonctionnaireG[$k]['fonctionnaire_id'] == $fonctionnaireG[$k-1]['fonctionnaire_id']) {
                $temp = $nombre[$fonctionnaireG[$k]['fonctionnaire_id']] ;
                $nombre[$fonctionnaireG[$k]['fonctionnaire_id']] = $temp +1;
            } else {
                $nombre[$fonctionnaireG[$k]['fonctionnaire_id']] = 1;
            }
        }
        $this->set('FonctionnairesGrades', $FonctionnairesGrades);
        $this->set('nombre', $nombre);
        $this->set('fonctionnaireG', $fonctionnaireG);
        return $this->render('/Espaces/respopersonels/evo2');
    }
    public function voirDemandes()
    {
        $modif = ConnectionManager::get('default');

        $profpermabis = $modif->execute("SELECT * FROM profpermanentsbis  ORDER BY date_envoi DESC ")->fetchAll('assoc');
        if (empty($profpermabis)) {
            echo "no data's edit has been sent";
        }

        $this->set('profpermabis', $profpermabis);
        $this->set('_serialize', ['profpermabis']);

        $this->render('/Espaces/respopersonels/voirDemandes');
    }

    public function voirDemandesVac()
    {
        $modif = ConnectionManager::get('default');

        $profpermabis = $modif->execute("SELECT * FROM vacatairesbis  ORDER BY date_envoi DESC ")->fetchAll('assoc');
        if (empty($profpermabis)) {
            echo "no data's edit has been sent";
        }

        $this->set('profpermabis', $profpermabis);
        $this->set('_serialize', ['profpermabis']);

        $this->render('/Espaces/respopersonels/voirDemandesVac');
    }

    public function voirDemandesFonc()
    {
        $modif = ConnectionManager::get('default');

        $profpermabis = $modif->execute("SELECT * FROM fonctionnairesbis  ORDER BY date_envoi DESC ")->fetchAll('assoc');
        if (empty($profpermabis)) {
            echo "no data's edit has been sent";
        }

        $this->set('profpermabis', $profpermabis);
        $this->set('_serialize', ['profpermabis']);

        $this->render('/Espaces/respopersonels/voirDemandesFonc');
    }
    public function validerDonneesFonc($id = null)
    {
        $con = ConnectionManager::get('default');
        $ProfPermanents = TableRegistry::get('Fonctionnaires');
        
        $profpermabis = $con->execute("SELECT somme, 
            etat , date_Recrut, nom_fct, prenom_fct, age , specialite , situation_Familiale,  lieuNaissance, CIN, phone, email, genre , nbr_enfants, dateNaissance, isPassExam, user_id FROM 
            fonctionnairesbis WHERE id = $id    
              ")->fetchAll('assoc');
        $editedId = $ProfPermanents->find()->select('id')->where(['user_id' => $profpermabis[0]['user_id']])->first()['id'];
        $editedProf = $ProfPermanents->get($editedId);
        $this->set("id", $id);


        if (isset($_POST['save'])) {
            $editedProf->nom_fct = $profpermabis[0]['nom_fct'];
            $editedProf->prenom_fct = $profpermabis[0]['prenom_fct'];
            $editedProf->somme = $profpermabis[0]['somme'];
            $editedProf->etat = $profpermabis[0]['etat'];
            $editedProf->age = $profpermabis[0]['age'];
            $editedProf->specialite = $profpermabis[0]['specialite'];
            $editedProf->situation_Familiale = $profpermabis[0]['situation_Familiale'];
            $editedProf->lieuNaissance = $profpermabis[0]['lieuNaissance'];
            $editedProf->CIN = $profpermabis[0]['CIN'];
            $editedProf->phone = $profpermabis[0]['phone'];
            $editedProf->genre = $profpermabis[0]['genre'];
            $editedProf->nbr_enfants = $profpermabis[0]['nbr_enfants'];
            $editedProf->isPassExam = $profpermabis[0]['isPassExam'];
            $editedProf->email = $profpermabis[0]['email'];
            
            $ProfPermanents->save($editedProf);
           
            $con->execute(" DELETE FROM  fonctionnairesbis where id=$id");
            $this->Flash->success(__('les données sont validées avec succés'));
        }



        $this->set('profpermabis', $profpermabis);
        $this->set('_serialize', ['profpermabis']);

        $this->render('/Espaces/respopersonels/validerDonneesFonc');
    }


    public function validerDonnees($id = null)
    {
        $con = ConnectionManager::get('default');
        $ProfPermanents = TableRegistry::get('ProfPermanents');
        
        $profpermabis = $con->execute("SELECT somme, 
            etat , date_Recrut,nom_prof, prenom_prof, age , diplome, specialite, universite , autresdiplomes, situation_familiale,   Lieu_Naissance, CIN, phone, email_prof, user_id FROM 
            profpermanentsbis WHERE id = $id    
              ")->fetchAll('assoc');
        $editedId = $ProfPermanents->find()->select('id')->where(['user_id' => $profpermabis[0]['user_id']])->first()['id'];
        $editedProf = $ProfPermanents->get($editedId);
        $this->set("id", $id);


        if (isset($_POST['save'])) {
            $editedProf->nom_prof = $profpermabis[0]['nom_prof'];
            $editedProf->prenom_prof = $profpermabis[0]['prenom_prof'];
            $editedProf->somme = $profpermabis[0]['somme'];
            $editedProf->etat = $profpermabis[0]['etat'];
            $editedProf->date_Recrut = $profpermabis[0]['date_Recrut'];
            $editedProf->age = $profpermabis[0]['age'];
            $editedProf->diplome = $profpermabis[0]['diplome'];
            $editedProf->specialite = $profpermabis[0]['specialite'];
            $editedProf->universite= $profpermabis[0]['universite'];
            $editedProf->autresdiplomes = $profpermabis[0]['autresdiplomes'];
            $editedProf->situation_familiale = $profpermabis[0]['situation_familiale'];
            $editedProf->Lieu_Naissance = $profpermabis[0]['Lieu_Naissance'];
            $editedProf->CIN = $profpermabis[0]['CIN'];
            $editedProf->phone = $profpermabis[0]['phone'];
            $editedProf->email_prof = $profpermabis[0]['email_prof'];
            
            $ProfPermanents->save($editedProf);

            $con->execute(" DELETE FROM  Profpermanentsbis where id=$id");
            $this->Flash->success(__('les données sont validées avec succés'));
        }



        $this->set('profpermabis', $profpermabis);
        $this->set('_serialize', ['profpermabis']);

        $this->render('/Espaces/respopersonels/validerDonnees');
    }

    //Safwa

    public function voirDemandesHeuresVac()
    {
        //$modiff = ConnectionManager::get('default');
        $this->paginate = [
            'contain' => ['Vacataires']
        ];
        $profvac = TableRegistry::get('Vacations');
        $profvac = $this->paginate($profvac);
        $this->set(compact('profvac'));

        //$profvac = $modiff->execute("SELECT * FROM vacations ORDER BY dateInsertion DESC ")->fetchAll('assoc');
        if (empty($profvac)) {
            echo "no data's edit has been sent";
        }

        //$this->set('profvac', $profvac);
        $this->set('_serialize', ['profvac']);

        $this->render('/Espaces/respopersonels/voirDemandesHeuresVac');
    } 


    public function validerDonneesVac($id = null)
    {
        $con = ConnectionManager::get('default');

        $profvacbis = $con->execute("SELECT * FROM  vacatairesbis WHERE id = $id ")->fetchAll('assoc');
        $this->set("id", $id);

        $user_id = $profvacbis[0]['user_id'];
        $profVacId = $con->execute("SELECT id FROM  vacataires WHERE user_id =  $user_id")->fetchAll('assoc')[0]['id'];

        if (isset($_POST['save'])) {
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
            
            $idd16 = $profvacbis[0]['email'];
            $idd17 = $profvacbis[0]['nbr_enfants'];
            $idd18 = $profvacbis[0]['genre'];
            $idd19 = $profvacbis[0]['age'];




            $con->execute(" UPDATE vacataires SET nom_vacataire='$idd0',prenom_vacataire='$idd1', somme='$idd2', nb_heures='$idd3',
             echelle='$idd4', echelon='$idd5', diplome='$idd9', specialite='$idd10', dateRecrut='$idd7', CIN='$idd18',
             universite='$idd11', dateAffectation='$idd12', situationFamiliale='$idd13', DateNaissance='$idd15' , LieuNaissance='$idd6',
               email='$idd16', nbr_enfants='$idd17', genre='$idd18', age='$idd19'  WHERE id='$profVacId' ");
            $con->execute(" DELETE FROM  vacatairesbis where id=$id");
            $this->Flash->success(__('les données sont validées avec succés'));
            return $this->redirect(['action' => 'voirDemandes']);
        }



        $this->set('profvacbis', $profvacbis);
        $this->set('_serialize', [' $profvacbis']);

        $this->render('/Espaces/respopersonels/validerDonneesVac');
    }


    //Safwa
     public function validerHeuresVac($id1=null, $id2=null)
    {
        $this->paginate = [
            'contain' => ['Vacataires', 'Vacations']
        ];
        $Vacations = TableRegistry::get('Vacations');
        $Vacataires = TableRegistry::get('Vacataires');
        
        $query = $Vacations->find('all')->update()->set(['etat' =>'Validé'])->where(['id' => $id1, 'vacataire_id' => $id2]);
        $query->execute();
         $con = ConnectionManager::get('default');
        //profvac: vacations
       $profvac = $con->execute("SELECT nbHeure FROM 
            vacations WHERE id= $id1 ")->fetchAll('assoc');
          $this->set("id",$id1);
                $idd = $profvac[0]['nbHeure'];
        $queryy = $Vacataires->find('all')->update()->set(['nb_heures' => $idd])->where([ 'id'=> $id2]);
        $queryy->execute();

        //$this->voirDemandesVac($id1,$id2);
         $this->set(compact('Vacations'));
        $this->set(compact('Vacataires'));
         return $this->redirect(['action' => 'voirDemandesHeuresVac']);

       
    } 


    
    public function addper()
    {
        $profpermanents = TableRegistry::get('ProfPermanents');
        $users = TableRegistry::get('Users');
        $profpermanent = $profpermanents->newEntity();
        $user = $users->newEntity();
        $Departs=TableRegistry::get('Departements');
        $profpermanentsDepartements=TableRegistry::get('ProfpermanentsDepartements');
        $profpermanentsDepartement = $profpermanentsDepartements->newEntity();
        $infoGrades = TableRegistry::get('Infosgradesprofs');
        $grrades=TableRegistry::get('Grades');
        $profpermanentsGrades=TableRegistry::get('ProfpermanentsGrades');
        $profpermanentsGrade = $profpermanentsGrades->newEntity();
        $Activites = TableRegistry::get('Activites');


        $activite = $Activites->newEntity();

        if ($this->request->is('post')) {
            $user->username=$this->request->data['username'];
            $user->password=$this->request->data['password'];
            $user->role='profpermanent';
            $profpermanent->somme=$this->request->data('somme');
            $profpermanent->salaire=$this->request->data('salaire');
            $profpermanent->etat=$this->request->data('etat');
            $profpermanent->date_Recrut=$this->request->data('dateRecrut');
            $profpermanent->nom_prof=$this->request->data('nom_prof');
            $profpermanent->prenom_prof=$this->request->data('prenom_prof');
            $profpermanent->age=$this->request->data('age');
            $profpermanent->diplome=$this->request->data('diplome');
            $profpermanent->specialite=$this->request->data('specialite');
            $profpermanent->universite=$this->request->data('universite');
            $profpermanent->autresdiplomes=$this->request->data('autresdiplomes');
            $profpermanent->situation_familiale=$this->request->data('situation_familiale');
            $profpermanent->dateNaissance=$this->request->data('dateNaissance');
            $profpermanent->Lieu_Naissance=$this->request->data('Lieu_Naissance');
            $profpermanent->CIN=$this->request->data('CIN');
            $profpermanent->email_prof=$this->request->data('email_prof');
            $profpermanent->phone=$this->request->data('phone');
            $profpermanent->genre=$this->request->data('genre');
            $profpermanent->photo=$_FILES['photo']['name'];
            /*$extensions_valides = array( 'jpg' , 'jpeg','png' );
            $extension_upload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
            if (!in_array($extension_upload, $extensions_valides)) {
                $this->Flash->error(__('Veuillez choisir l\'extension  : JPEG , JPG Ou PNG , MERCI!'));
                return $this->redirect(['action' => 'add']);
            }*/
            if ($users->save($user)) {
                $userBis=$users->find('all')->select('id')->where(['username'=>$this->request->data['username']]);
                foreach ($userBis as $req) {
                    $ID=$req->id;
                }
                $usrID = $ID;
                $profpermanent->user_id= $ID;

               
                if ($profpermanents->save($profpermanent)) {
                    $photo = $_FILES['photo']['name'];
                    $phototempo = $_FILES['photo']['tmp_name'];
                    move_uploaded_file($phototempo, WWW_ROOT .DS . '/img' . DS . $photo);
                    $req=$profpermanents->find('all')->select('id')->where(['nom_prof'=>$_POST['nom_prof'],'prenom_prof'=>$_POST['prenom_prof']]);
                    $req1=$Departs->find('all')->select('id');

                    $i=1;
                    $req2=$grrades->find('all')->select('id');


                    foreach ($req as $ligne) {
                        // echo 'i='.$i;

                        $IDPROF=$ligne->id;
                    }
                    foreach ($req1 as $ligne) {
                        // echo 'i='.$i;

                        $IDDepar=$ligne->id;
                    }

                    $j=1;
                    foreach ($req2 as $ligne) {
                        if ($j==$this->request->data('grade')) {
                            $IDGRADE=$ligne->id;
                            break;
                        }
                        $j++;
                    }

                    
                    $cadre = $this->request->data('grade');
                    $grade = $this->request->data('sousgrade');
                    $echelon = $this->request->data('echelon');
                    switch ($cadre) {
                        case '0':
                            # code...
                            break;
                        case '1':
                            # code...
                            $profpermanentsGrade->cadre = 'PES';
                            $id_grade = $infoGrades->find('all')->select('id')->where(['cadre'=>'PES', 'grade'=>$grade,'echelon'=>$echelon])->first()['id'];
                            break;
                        case '2':
                            # code...
                            $profpermanentsGrade->cadre = 'H';
                            $id_grade = $infoGrades->find('all')->select('id')->where(['cadre'=>'H', 'grade'=>$grade,'echelon'=>$echelon])->first()['id'];
                            break;
                        case '3':
                            $profpermanentsGrade->cadre = 'A';
                            $id_grade = $infoGrades->find('all')->select('id')->where(['cadre'=>'A', 'grade'=>$grade,'echelon'=>$echelon])->first()['id'];
                            # code...
                            break;
                        default:
                            # code...
                            break;
                    }
                    $profpermanentsDepartement->profpermanent_id =$IDPROF;
                    $profpermanentsDepartement->departement_id =$IDDepar;
                    $profpermanentsDepartement->Poste_Filiere =$this->request->data('Poste');
                    $profpermanentsDepartement->Date_Debut = $this->request->data('date_debut');
                    
                    $profpermanentsGrade->sous_grade=$this->request->data('sousgrade');
                    $profpermanentsGrade->echelon=$this->request->data('echelon');
                    $profpermanentsGrade->grade_id=$id_grade;
                    $profpermanentsGrade->profpermanent_id=$IDPROF;
                   

                    
                    $dateTest = explode("/", $_POST['date_grade']);
                    $date_string=$dateTest[2].'-'.$dateTest[1].'-'.$dateTest[0];
                    $year_exep=$dateTest[2]+6;
                    $year_normal=$dateTest[2]+8;
                    $year_rapide=$dateTest[2]+7;
                    $year_next=$dateTest[2]+2;

                    $date_string_exep=$year_exep.'-'.$dateTest[1].'-'.$dateTest[0];
                    
                    $date_string_normal=$year_normal.'-'.$dateTest[1].'-'.$dateTest[0];
                    $date_string_rapide=$year_rapide.'-'.$dateTest[1].'-'.$dateTest[0];
                    $date_next_echelon=$year_next.'-'.$dateTest[1].'-'.$dateTest[0];

                    $profpermanentsGrade->date_grade =$date_string;
                    $profpermanentsGrade->date_exep =$date_string_exep;
                    $profpermanentsGrade->date_normal =$date_string_normal;
                    $profpermanentsGrade->date_rapide =$date_string_rapide;
                    $profpermanentsGrade->date_next_echelon =$date_next_echelon;
                    $dateTest = explode("/", $_POST['date_debut']);
                    $date_string_bis=$dateTest[2].'-'.$dateTest[1].'-'.$dateTest[0];

                    //

                    //$profpermanentsDepartement->Date_Debut =$date_string_bis;
                    
                    $profpermanentsGrades->save($profpermanentsGrade);
                    $profpermanentsDepartements->save($profpermanentsDepartement);
                    $this->Flash->success(__('Ajout d\'un professeur est effectué avec succés'));
                    return $this->redirect(['action' => 'viewprofpermanents', $IDPROF]);
                } else {
                    $entity = $users->get($usrID);
                    $result = $users->delete($entity);
                    $this->Flash->error(__('Erreur , veuillez répétez l\'insertion'));
                    return $this->redirect(['action' => 'addper']);
                }
            } else {
                $this->Flash->error(__('Compte Utilisateur non ajouté ! '));
                return $this->redirect(['action' => 'addper']);
            }

            $users = $profpermanents->Users->find('list', ['limit' => 200]);
            $this->set(compact('profpermanent', 'users', 'activites', 'departements', 'disciplines', 'documents', 'grades'));
            $this->set('_serialize', ['profpermanent']);
            $this->set('profpermanent', $profpermanent);
        }
        $queryDeparts=$Departs->find('all');
        $j=1;
        foreach ($queryDeparts as $query2) {
            $tabNom[$j]=$query2->nom_departement;
            $j++;
        }
        $this->set('nomtab', $tabNom);
        $this->render('/Espaces/Respopersonels/addper');
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
        $profpermanentgrades = TableRegistry::get('ProfpermanentsGrades');

        $profpermanent = $profpermanents->get($id);
        $profpermanentgrade = $profpermanentgrades->find()->where(['profpermanent_id' => $id])->first();
        $this->set('profpermanent', $profpermanent);
        $this->set('profpermanentgrade', $profpermanentgrade);
        $this->set('_serialize', ['profpermanent']);
        $this->render('/Espaces/respopersonels/viewprofpermanents');
    }

    public function listerDisciplines()
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);

        if (isset($_POST['chercherDisc'])) {
            echo 'oi';
            $indice=$_POST['chercherDisc'];
            $disciplines=$con->prepare("SELECT pp.nom_prof as nomprof , 
pp.prenom_prof as prenomprof,en.id as IDe , m.libile as module ,pp.id ,pp.somme 
,e.libile as element ,ans.libile as AN,s.libile as semestre,
      n.libile as niveau,f.libile as filiere from  modules m,groupes g,filieres 
f,niveaus n,profpermanents pp,elements e,annee_scolaires ans,semestres s, 
      enseigners en where  pp.id=en.profpermanent_id and e.id=en.element_id and 
ans.id=en.annee_scolaire_id and s.id=en.semestre_id 
         and g.niveaus_id=n.id and g.filiere_id=f.id and e.module_id=m.id AND 
m.groupe_id=g.id and (pp.nom_prof like ? or pp.prenom_prof like
        ? or pp.somme like ? or f.libile like ? or n.libile like ? or m.libile 
like ? or e.libile like ? )");
            $disciplines->execute(array('%'.$indice.'%','%'.$indice.'%','%'.
                $indice.'%','%'.$indice.'%','%'.$indice.'%','%'.$indice.'%','%'.$indice.'%'));
        } else {
            $disciplines=$con->execute("SELECT pp.nom_prof as nomprof , 
pp.prenom_prof as prenomprof,en.id as IDe , m.libile as module ,pp.id ,pp.somme 
,e.libile as element ,ans.libile as AN,s.libile as semestre,
      n.libile as niveau,f.libile as filiere from  modules m,groupes g,filieres 
f,niveaus n,profpermanents pp,elements e,annee_scolaires ans,semestres s, 
      enseigners en where  pp.id=en.profpermanent_id and e.id=en.element_id and 
ans.id=en.annee_scolaire_id and s.id=en.semestre_id 
         and g.niveaus_id=n.id and g.filiere_id=f.id and e.module_id=m.id AND 
m.groupe_id=g.id");
        }


        $this->set(compact('disciplines'));
        $this->set('_serialize', ['disciplines']);
        $this->render('/Espaces/respopersonels/listerDisciplines');
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

   

    public function addvac()
    {
        $profpermanents = TableRegistry::get('Vacataires');
        $users = TableRegistry::get('Users');
        $profpermanent = $profpermanents->newEntity();
        $user = $users->newEntity();
        $Departs=TableRegistry::get('Departements');
        $profpermanentsDepartements=TableRegistry::get('VacatairesDepartements');
        $profpermanentsDepartement = $profpermanentsDepartements->newEntity();
        $infoGrades = TableRegistry::get('Infosgradesprofs');
        $grrades=TableRegistry::get('Grades');
        $profpermanentsGrades=TableRegistry::get('VacatairesGrades');
        $profpermanentsGrade = $profpermanentsGrades->newEntity();
        $Activites = TableRegistry::get('Activites');


        $activite = $Activites->newEntity();

        if ($this->request->is('post')) {
            $user->username=$this->request->data['username'];
            $user->password=$this->request->data['password'];
            $user->role='profvacataire';
            $profpermanent->somme=$this->request->data('somme');
            $profpermanent->prenom_vacataire=$this->request->data('prenom_vacataire');
            $profpermanent->nom_vacataire=$this->request->data('nom_vacataire');
            $profpermanent->echelle=$this->request->data('sousgrade');
            $profpermanent->echelon=$this->request->data('echelon');
            $profpermanent->dateRecrut=$this->request->data('dateRecrut');
            $profpermanent->age=$this->request->data('age');
            $profpermanent->genre=$this->request->data('genre');
            $profpermanent->diplome=$this->request->data('diplome');
            $profpermanent->specialite=$this->request->data('specialite');
            $profpermanent->universite=$this->request->data('universite');
            $profpermanent->situationFamiliale=$this->request->data('situationFamiliale');
            $profpermanent->codeSituation = 1;  //??
            $profpermanent->dateNaissance=$this->request->data('dateNaissance');
            $profpermanent->LieuNaissance=$this->request->data('LieuNaissance');
            $profpermanent->CIN=$this->request->data('CIN');
            $profpermanent->email=$this->request->data('email');
            $profpermanent->dateAffectation=$this->request->data('dateAffectation');
            $profpermanent->nb_heures=$this->request->data('nb_heures');
            $profpermanent->nbr_enfants=$this->request->data('nbr_enfants');
            
            if ($users->save($user)) {
                $userBis=$users->find('all')->select('id')->where(['username'=>$this->request->data['username']]);
                foreach ($userBis as $req) {
                    $ID=$req->id;
                }
                $usrID = $ID;
                $profpermanent->user_id= $ID;

               
                if (($newLigne = $profpermanents->save($profpermanent))) {
                    //$req=$profpermanents->find('all')->select('id')->where(['nom_vacataire'=>$_POST['nom_vacataire'],'prenom_vacataire'=>$_POST['prenom_vacataire']]);
                    $req1=$Departs->find('all')->select('id');

                    $i=1;
                    $req2=$grrades->find('all')->select('id');


                    /*foreach ($req as $ligne) {
                        // echo 'i='.$i;

                        $IDPROF=$ligne->id;
                    }*/
                    $IDPROF=$newLigne['id'];

                    foreach ($req1 as $ligne) {
                        // echo 'i='.$i;

                        $IDDepar=$ligne->id;
                    }

                    $j=1;
                    foreach ($req2 as $ligne) {
                        if ($j==$this->request->data('grade')) {
                            $IDGRADE=$ligne->id;
                            break;
                        }
                        $j++;
                    }

                    
                    $cadre = $this->request->data('grade');
                    $grade = $this->request->data('sousgrade');
                    $echelon = $this->request->data('echelon');
                    switch ($cadre) {
                        case '0':
                            # code...
                            break;
                        case '1':
                            # code...
                            $profpermanentsGrade->cadre = 'PES';
                            $id_grade = $infoGrades->find('all')->select('id')->where(['cadre'=>'PES', 'grade'=>$grade,'echelon'=>$echelon])->first()['id'];
                            break;
                        case '2':
                            # code...
                            $profpermanentsGrade->cadre = 'H';
                            $id_grade = $infoGrades->find('all')->select('id')->where(['cadre'=>'H', 'grade'=>$grade,'echelon'=>$echelon])->first()['id'];
                            break;
                        case '3':
                            $profpermanentsGrade->cadre = 'A';
                            $id_grade = $infoGrades->find('all')->select('id')->where(['cadre'=>'A', 'grade'=>$grade,'echelon'=>$echelon])->first()['id'];
                            # code...
                            break;
                        default:
                            # code...
                            break;
                    }
                    $profpermanentsDepartement->vacataire_id =$IDPROF;
                    $profpermanentsDepartement->departement_id =$IDDepar;
                    $profpermanentsDepartement->Date_Debut = $this->request->data('dateAffectation');
                    //$profpermanentsDepartement->Poste_Filiere =$this->request->data('Poste');

                    
                    $profpermanentsGrade->sous_grade=$this->request->data('sousgrade');
                    $profpermanentsGrade->echelon=$this->request->data('echelon');
                    $profpermanentsGrade->grade_id=$id_grade;
                    $profpermanentsGrade->vacataire_id=$IDPROF;
                   

                    
                    $dateTest = explode("/", $_POST['date_grade']);
                    $date_string=$dateTest[2].'-'.$dateTest[1].'-'.$dateTest[0];
                    $year_exep=$dateTest[2]+6;
                    $year_normal=$dateTest[2]+8;
                    $year_rapide=$dateTest[2]+7;
                    $year_next=$dateTest[2]+2;

                    $date_string_exep=$year_exep.'-'.$dateTest[1].'-'.$dateTest[0];
                    
                    $date_string_normal=$year_normal.'-'.$dateTest[1].'-'.$dateTest[0];
                    $date_string_rapide=$year_rapide.'-'.$dateTest[1].'-'.$dateTest[0];
                    $date_next_echelon=$year_next.'-'.$dateTest[1].'-'.$dateTest[0];

                    $profpermanentsGrade->date_grade =$date_string;
                    $profpermanentsGrade->date_exep =$date_string_exep;
                    $profpermanentsGrade->date_normal =$date_string_normal;
                    $profpermanentsGrade->date_rapide =$date_string_rapide;
                    $profpermanentsGrade->date_next_echelon =$date_next_echelon;
                    $profpermanentsGrade->datedebut =$date_next_echelon;
                    $profpermanentsGrade->datefin =$date_next_echelon;
                    $dateTest = explode("/", $_POST['dateAffectation']);
                    $date_string_bis=$dateTest[2].'-'.$dateTest[1].'-'.$dateTest[0];

                   
                    $profpermanentsGrades->save($profpermanentsGrade);
                    $profpermanentsDepartements->save($profpermanentsDepartement);

                   
                    $this->Flash->success(__('Ajout d\'un professeur est effectué avec succés'));
                    return $this->redirect(['action' => 'viewvacataire', $newLigne['id']]);
                } else {
                    $entity = $users->get($usrID);
                    $result = $users->delete($entity);
                    $this->Flash->error(__('Erreur , veuillez répétez l\'insertion'));
                    return $this->redirect(['action' => 'addvac']);
                }
            } else {
                $this->Flash->error(__('Compte Utilisateur non ajouté ! '));
                return $this->redirect(['action' => 'addvac']);
            }

            $users = $profpermanents->Users->find('list', ['limit' => 200]);
            $this->set(compact('profpermanent', 'users', 'activites', 'departements', 'disciplines', 'documents', 'grades'));
            $this->set('_serialize', ['profpermanent']);
            $this->set('profpermanent', $profpermanent);
        }
        $queryDeparts=$Departs->find('all');
        $j=1;
        foreach ($queryDeparts as $query2) {
            $tabNom[$j]=$query2->nom_departement;
            $j++;
        }
        $this->set('tabNom', $tabNom);
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
    public function exportVacataires($limit = 100)
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
        $vacatairegrades = TableRegistry::get('vacatairesGrades');
        
        $vacatairegrade = $vacatairegrades->find('all')->where(['vacataire_id' => $id])->first();
        
        $this->set('vacataire', $vacataire);
        $this->set('vacatairegrade', $vacatairegrade);
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

                return $this->redirect(['action' => 'listervV']);
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
            $this->Flash->success(__('Compte vacataire Supprimé.'));
        } else {
            $this->Flash->error(__('Echéc de suppression du compte vacataire'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function addfonc()
    {
        $fonctionnaires = TableRegistry::get('Fonctionnaires');
        $users = TableRegistry::get('users');
        $profpermanent= $fonctionnaires->newEntity();
        $user = $users->newEntity();
        $profpermanentsGrades=TableRegistry::get('FonctionnairesGrades');
        $profpermanentsGrade = $profpermanentsGrades->newEntity();
        if ($this->request->is('post')) {
            $user->username=$this->request->data['username'];
            $user->password=$this->request->data['password'];
            $user->role=$this->request->data['role'];
            $profpermanent->somme=$this->request->data('somme');
            $profpermanent->salaire=$this->request->data('salaire');
            $profpermanent->etat=$this->request->data('etat');
            $profpermanent->date_Recrut=$this->request->data('date_Recrut');
            $profpermanent->nom_fct=$this->request->data('nom_fct');
            $profpermanent->prenom_fct=$this->request->data('prenom_fct');
            $profpermanent->age=$this->request->data('age');
            $profpermanent->diplome=$this->request->data('diplome');
            $profpermanent->specialite=$this->request->data('specialite');
            $profpermanent->universite=$this->request->data('universite');
            $profpermanent->autresdiplomes=$this->request->data('autresdiplomes');
            $profpermanent->situation_Familiale=$this->request->data('situation');
            $profpermanent->dateNaissance=$this->request->data('dateNaissance');
            $profpermanent->lieuNaissance=$this->request->data('lieuNaissance');
            $profpermanent->CIN=$this->request->data('CIN');
            $profpermanent->email=$this->request->data('email');
            $profpermanent->phone=$this->request->data('phone');
            $profpermanent->photo=$_FILES['photo']['name'];
            $profpermanent->genre=$this->request->data('genre');
            $profpermanent->nbr_enfants=$this->request->data('nbr_enfants');
            
            if ($users->save($user)) {
                $userBis=$users->find('all')->select('id')->where(['username'=>$this->request->data['username']]);
                foreach ($userBis as $req) {
                    $ID=$req->id;
                }
                $profpermanent->user_id= $ID;
                $usrID = $ID;
                if ($fonctionnaires->save($profpermanent)) {
                    $photo = $_FILES['photo']['name'];
                    $phototempo = $_FILES['photo']['tmp_name'];
                    move_uploaded_file($phototempo, WWW_ROOT . DS.   '/img' . DS . $photo);

                    $profpermanentsGrade->echelon=$this->request->data('echelon')+1;
                    $dateTest = explode("/", $_POST['date_grade']);
                    $profpermanentsGrade->grade=$this->request->data('grade');
                    $date_string=$dateTest[2].'-'.$dateTest[1].'-'.$dateTest[0];
                    $date_echelon_rapide = date_create($date_string);
                    $date_echelon_moyen=date_create($date_string);
                    $date_echelon_normal=date_create($date_string);

                    $catgrie = $this->request->data('categorie');

                    if ($catgrie == 0 or $catgrie == 1 or $catgrie == 2 or $catgrie == 3) {
                        switch ($this->request->data('echelon')) {
                            case 1:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('12 months'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('12 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('12 months'));
                                break;
                            }
                            case 2:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('12 months'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('18 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('2 years'));
                                break;

                            }
                            case 3:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('3 years'));
                                break;

                            }
                            case 4:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('42 months'));
                                break;


                            }
                            case 5:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('42 months'));
                                break;


                            }
                            case 6:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('3 years'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('42 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('4 years'));
                                break;


                            }
                            case 7:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('3 years'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('42 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('4 years'));
                                break;


                            }
                            case 8:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('3 years'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('42 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('54 months'));
                                break;


                            }
                            case 9:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('4 years'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('54 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('66 months'));
                                break;
                            }
                        }
                    } //If categorie
                    elseif ($catgrie == 4 or $catgrie == 5) {
                        switch ($this->request->data('echelon')) {
                            case 1:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('12 months'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('12 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('12 months'));
                                break;
                            }
                            case 2:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('12 months'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('18 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('2 years'));
                                break;

                            }
                            case 3:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('3 years'));
                                break;

                            }
                            case 4:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('42 months'));
                                break;


                            }
                        }
                    } elseif ($catgrie == 7 or $catgrie == 6) {
                        # code...
                        switch ($this->request->data('echelon')) {
                            case 1:
                                {
                                    date_add($date_echelon_rapide, date_interval_create_from_date_string('24 months'));
                                    date_add($date_echelon_moyen, date_interval_create_from_date_string('30 months'));
                                    date_add($date_echelon_normal, date_interval_create_from_date_string('36 months'));
                                    break;
                            }
                            case 2:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('36 months'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('36 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('3 years'));
                                break;

                            }
                            case 3:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('36 months'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('48 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('4 years'));
                                break;

                            }
                            case 4:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('36 months'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('48 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('48 months'));
                                break;


                            }
                            case 5:
                            {
                                date_add($date_echelon_rapide, date_interval_create_from_date_string('36 months'));
                                date_add($date_echelon_moyen, date_interval_create_from_date_string('48 months'));
                                date_add($date_echelon_normal, date_interval_create_from_date_string('48 months'));
                                break;


                            }
                        }
                    }
                    $profpermanentsGrade->date_grade =$date_string;
                    $profpermanentsGrade->date_echelon_rapide =$date_echelon_rapide;
                    $profpermanentsGrade->date_echelon_normal =$date_echelon_normal;
                    $profpermanentsGrade->date_echelon_moyen =$date_echelon_moyen;


                    $req=$fonctionnaires->find('all')->select('id')->where(['nom_fct'=>$_POST['nom_fct'],'prenom_fct'=>$_POST['prenom_fct']]);
                    switch ($_POST['grade']) {
                        case 1:
                        {
                            $IDGRADE=4;
                            break;
                        }
                        case 2:
                        {
                            $IDGRADE=5;
                            break;
                        }
                        case 3:
                        {
                            $IDGRADE=6;
                            break;

                        }
                        case 4:
                        {
                            $IDGRADE=7;
                            break;
                        }
                        case 5:
                        {
                            $IDGRADE=8;
                            break;
                        }
                        case 6:
                        {
                            $IDGRADE=9;
                            break;
                        }
                        case 7:
                        {
                            $IDGRADE=10;
                            break;
                        }
                        case 8:
                        {
                            $IDGRADE=11;
                            break;
                        }
                    }


                    foreach ($req as $ligne) {
                        $ID=$ligne->id;
                    }

                    $profpermanentsGrade->fonctionnaire_id =$ID;
                    $profpermanentsGrade->grade_id =1;
                    $profpermanentsGrade->categorie=$_POST['categorie'];


                    if ($profpermanentsGrades->save($profpermanentsGrade)) {
                        $this->Flash->success(__('Prof bien enregistré'));

                        return $this->redirect(['action' => 'viewfonctionnaire', $ID]);
                    } else {
                        $this->Flash->error(__('Fonctionnaire et compte ajoutés, mais affectation Grade échouée'));
                    }
                } else {
                    $entity = $users->get($usrID);
                    $result = $users->delete($entity);
                    $this->Flash->error(__('Compte Fonctionnaire non ajouté ! '));

                    return $this->redirect(['action' => 'addfonc']);
                }
            } else {
                $this->Flash->error(__('Compte Utilisateur non ajouté ! '));
                return $this->redirect(['action' => 'addfonc']);
            }
        }
        $i=1;
        $queryProf=$fonctionnaires->find('all');
        foreach ($queryProf as $query1) {
            $tabNomProf[$i]=$query1->nom_fct;
            $tabPrenom[$i]=$query1->prenom_fct;
            $i++;
        }
        $j=1;
        $tabNom=['Aide technicien','Technicien','Aide administrateur','Administrateur','Ingenieur etat','Ingenieur application','Ingenieur application principal','Ingenieur etat principal', 'Ingenieur en chef'];
        $tabechelon=[1 => 1,2,3,4,5,6,7,8,9,10];
        $this->set('tabNomProf', $tabNomProf);
        $this->set('tabPrenomProf', $tabPrenom);
        $this->set('nomtab', $tabNom);
        $this->set('tabechelon', $tabechelon);
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
        $fonctionnairegrades = TableRegistry::get('FonctionnairesGrades');
        $fonctionnairegrade = $fonctionnairegrades->find()->where(['fonctionnaire_id' => $id])->first();

        $this->set('fonctionnaire', $fonctionnaire);
        $this->set('fonctionnairegrade', $fonctionnairegrade);
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
    public function exportFonctionnaire($limit = 100)
    {
        $cat=$_POST["cat"];
        $_SESSION['cat']=$cat;
        $fonctionnaires=TableRegistry::get('fonctionnaires')->find('all')->limit($limit)->where(['nom_fct like'=>'%'.$cat.'%']);
        $this->set(compact('fonctionnaires'));
        $this->set('_serialize', ['fonctionnaires']);
        $this->render('/Espaces/respopersonels/exportFonctionnaire');
    }

    

    public function statvacs()
    {
        $vacataires = TableRegistry::get('vacatairesGrades');
        $vacataire = $vacataires->newEntity();
        $vacataire = $vacataires->patchEntity($vacataire, $this->request->data);
        $vacdeps = TableRegistry::get('vacatairesDepartements');
        $vacdep = $vacdeps->newEntity();
        $vacdep = $vacdeps->patchEntity($vacdep, $this->request->data);

        //nbr les vacataires par grades
        $vacataire = $vacataires->find('all', [
            'fields' => [
            'grd' => 'Grades.nomGrade',
            'nbrGrades' => 'COUNT(vacatairesGrades.vacataire_id)'],
            'contain'=>['Grades'],'group' => ['vacatairesGrades.grade_id'],
        ]);

        $vacatairedep = $vacdeps->find('all', [
            'fields' => [
            'dep' => 'Departements.nom_departement',
            'nbrDep' => 'COUNT(vacatairesDepartements.vacataire_id)'],
            'contain'=>['Departements'],'group' => ['vacatairesDepartements.departement_id'],
        ]);

        
        $this->set(compact('vacataire', 'vacatairedep'));
        $this->set('_serialize', ['vacataire','vacatairedep']);
        //$this->render('/Espaces/respopersonels/home');
        $this->render('/Espaces/respopersonels/statvacs');
    }





    public function vacations()
    {
        $this->loadModel('Vacations');
        $this->loadModel('Vacataires');

        $quer = $this->Vacataires->find()
                    ->where(['user_id' => $this->Auth->user('id')]);
        // $vacataire = $this->Vacataires->get($this->Auth->user('id'));
        foreach ($quer as $row) {
            if ($row->id) {
                $vacataire=$row;
            }
        }

        $this->paginate = [
            'contain' => ['Vacataires']
        ];
        $query = $this->Vacations->find()

                  ->where(['vacataire_id' => $vacataire->id]);
        $vacations= $this->paginate($query);

        $this->set(compact('vacations'));
        $this->set('_serialize', ['vacations']);
        $this->render('/Espaces/respopersonels/vacations');
    }



    public function modifierVacation($id = null)
    {
        $this->loadModel('Vacations');
        $this->loadModel('Vacataires');

        $quer = $this->Vacataires->find()
                    ->where(['user_id' => $this->Auth->user('id')]);
        //  $vacataire = $this->Vacataires->get($this->Auth->user('id'));
        foreach ($quer as $row) {
            if ($row->id) {
                $vacataire=$row;
            }
        }
      
        if (($vacataire->somme!= "SANS")) {
            $max=20;
        } else {
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
            if ($row->id) {
                $vacataire=$row;
            }
        }
                
        if (($vacataire->somme!= "SANS")) {
            $max=20;
        } else {
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
                if ($row->id) {
                    $bol=true;
                }
            }
                        
                   
            if ($bol) {
                $this->Flash->error(__('ce mois deja remplis '));
            } elseif ($this->Vacations->save($vacation)) {
                $this->Flash->success(__('Demande effectuée.'));
                    
                return $this->redirect(['action' => 'vacations']);
            } else {
                $this->Flash->error(__('Demande non effectuée'));
            }
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






























    public function consultation($id = null)
    {
        $con = ConnectionManager::get('default');
        $books = $con->execute("SELECT vacataires.nom_vacataire,vacataires.prenom_vacataire,vacataires.CIN,vacataires.somme,vacataires.dateRecrut FROM vacataires where vacataires.id='".$id."'")->fetchAll('assoc');

    
        $this->set('books', $books);
        $this->render('/Espaces/respopersonels/consultation');
    }
   


    /*public function viewVacataire($id = null)
       {
           $vacataire = $this->Vacataires->get($id, [
               'contain' => ['Activites', 'Departements', 'Disciplines', 'Grades', 'Documents', 'Vacations']
           ]);

           $this->set('vacataire', $vacataire);
           $this->set('_serialize', ['vacataire']);
       }*/




    /*public function listerpardepartements(){

        $con=ConnectionManager::get('default');
            $books=$con->execute("SELECT vacataires.somme,vacataires.nom_vacataire,vacataires.prenom_vacataire,vacataires.dateAffectation from vacataires,vacataires_departements where departements.nom_departement  like '%" . $search . "%'
             ")->fetchAll('assoc');
             $this->set('books',$books);
              $this->render('/Espaces/respopersonels/listerpardepartements');

    }*/


    /*public function listerpardepartements(){


            $this->render('/Espaces/respopersonels/listerpardepartements');
        }*/

    public function affecteraundepartH()
    {
        $search = $this->request->data('search1');
        $search = $this->request->data('search2');

        $con = ConnectionManager::get('default');
        $books = $con->execute("INSERT into vacataires_departement2(vacataire_somme,departement_nom) values('" . $somme . "','" . $departement . "')")->fetchAll('assoc');

    
        $this->set('books', $books);
        $this->render('/Espaces/respopersonels/affecteraundepart');
    }
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
                if ($row->id) {
                    $bol =true;
                }
            }
            if ($bol) {
                $this->Flash->error(__('departement deja affecte'));
            } elseif ($this->VacatairesDepartements->save($vacatairesDepartement)) {
                $this->Flash->success(__('The {0} has been saved.', 'Vacataires Departement'));
                return $this->redirect(['action' => 'affecteraundepart']);
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
                if ($row->id) {
                    $bol =true;
                }
            }
            if ($bol) {
                $this->Flash->error(__('grade deja affecte'));
            } elseif ($this->VacatairesGrades->save($vacatairesGrade)) {
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

    //Les statistiques
    public function statistiquesvacataires()
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->newEntity();
        $concour = $concours->patchEntity($concour, $this->request->data);
        $concour = $concours->find('all', [
            'fields' => [
            'id' => 'Concours.id',
            'niv' => 'Niveaus.libile',
            'fil' => 'Filieres.libile',
            'nbrPreinscription' => 'COUNT(Preinscriptions.id)'],
            'join' => [
            'table' => 'Preinscriptions',
            'type' => 'LEFT',
            'conditions' => 'Preinscriptions.concour_id = Concours.id'],
            'conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres'],'group' => ['concours.id'],
        ]);

        $concour1 = $concours->find('all', [
            'fields' => [
            'id' => 'Concours.id',
            'niv' => 'Niveaus.libile',
            'fil' => 'Filieres.libile',
            'nbrPreinscription' => 'COUNT(Preinscriptions.id)'],
            'join' => [
            'table' => 'Preinscriptions',
            'type' => 'LEFT',
            'conditions' => 'Preinscriptions.concour_id = Concours.id and Preinscriptions.preselection = 1'],
            'conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres'],'group' => ['concours.id'],
        ]);

        $concour2 = $concours->find('all', [
            'fields' => [
            'id' => 'Concours.id',
            'niv' => 'Niveaus.libile',
            'fil' => 'Filieres.libile',
            'nbrPreinscription' => 'COUNT(Preinscriptions.id)'],
            'join' => [
            'table' => 'Preinscriptions',
            'type' => 'LEFT',
            'conditions' => 'Preinscriptions.concour_id = Concours.id and Preinscriptions.admis = 1'],
            'conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres'],'group' => ['concours.id'],
        ]);

        $concour3 = $concours->find('all', [
            'fields' => [
            'id' => 'Concours.id',
            'niv' => 'Niveaus.libile',
            'fil' => 'Filieres.libile',
            'nbrPreinscription' => 'COUNT(Preinscriptions.id)'],
            'join' => [
            'table' => 'Preinscriptions',
            'type' => 'LEFT',
            'conditions' => 'Preinscriptions.concour_id = Concours.id and Preinscriptions.listeAttente = 1'],
            'conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres'],'group' => ['concours.id'],
        ]);

        $this->set(compact('concour', 'concour1', 'concour2', 'concour3'));
        $this->set('_serialize', ['concour','concour1','concour2','concour3']);
        $this->render('/Espaces/resposcolarites/statistiquesPreinscriptions');
    }


    public function listerGrade()
    {
        $this->paginate = [
            'contain' => ['Profpermanents', 'Infosgradesprofs']
        ];
        $ProfpermanentsGrades=TableRegistry::get('ProfpermanentsGrades');


        if (isset($_POST['gradeCherch'])) {
            $indice=$_POST['gradeCherch'];
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades->find('all')->where(['OR'=>
                ['Grades.nomGrade like '=>'%'.$indice.'%',' profpermanents.nom_prof like'=>'%'.$indice.'%',
                    ' profpermanents.prenom_prof like'=>'%'.$indice.'%',' profpermanentsGrades.sous_grade like'=>'%'.$indice.'%',
                    ' profpermanentsGrades.echelon like'=>'%'.$indice.'%']]));
        } else {
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades);
        }

        

        $this->set(compact('profpermanentsGrades'));
        $this->set('_serialize', ['profpermanentsGrades']);
        $this->render('/Espaces/respopersonels/listerGrade');
    }


    public function listerGradeVac()
    {
        $this->paginate = [
            'contain' => ['Vacataires', 'Infosgradesprofs']
        ];
        $ProfpermanentsGrades=TableRegistry::get('VacatairesGrades');


        if (isset($_POST['gradeCherch'])) {
            $indice=$_POST['gradeCherch'];
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades->find('all')->where(['OR'=>
                ['Grades.nomGrade like '=>'%'.$indice.'%',' profpermanents.nom_prof like'=>'%'.$indice.'%',
                    ' profpermanents.prenom_prof like'=>'%'.$indice.'%',' profpermanentsGrades.sous_grade like'=>'%'.$indice.'%',
                    ' profpermanentsGrades.echelon like'=>'%'.$indice.'%']]));
        } else {
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades);
        }

        
        
        $this->set(compact('profpermanentsGrades'));
        $this->set('_serialize', ['profpermanentsGrades']);
        $this->render('/Espaces/respopersonels/listerGradeVac');
    }

    public function affecterGradeVac()
    {
        $grrades=TableRegistry::get('Grades');
        $infoGrades = TableRegistry::get('Infosgradesprofs');
        $Profs=TableRegistry::get('Vacataires');
        $profpermanentsGrades=TableRegistry::get('VacatairesGrades');
        $profpermanentsGrade = $profpermanentsGrades->newEntity();
 
        $cadre = $this->request->data('grade');
        $grade = $this->request->data('sousgrade');
        $echelon = $this->request->data('echelon');
        if ($this->request->is('post')) {
            $profEdit = $profpermanentsGrades->find('all')->where(['vacataire_id'=>$this->request->data['idProf']])->first();
            switch ($this->request->data['grade']) {
                case '0':
                    # code...
                    break;
                    
                case '1':
                    # code...
                    $profEdit->cadre = 'PES';
                    $id_grade = $infoGrades->find('all')->select('id')->where(['cadre'=>'PES', 'grade'=>$grade,'echelon'=>$echelon])->first()['id'];
                    break;
                    
                case '2':
                    # code...
                    $profEdit->cadre = 'H';
                    $id_grade = $infoGrades->find('all')->select('id')->where(['cadre'=>'H', 'grade'=>$grade,'echelon'=>$echelon])->first()['id'];
                    break;
                    
                case '3':
                    # code...
                    $profEdit->cadre = 'A';
                    $id_grade = $infoGrades->find('all')->select('id')->where(['cadre'=>'A', 'grade'=>$grade,'echelon'=>$echelon])->first()['id'];
                    break;
                
                default:
                    # code...
                    break;
            }

            $profEdit->sous_grade = $this->request->data['sousgrade'];
            $profEdit->echelon = $this->request->data['echelon'];
            $profEdit->grade_id = $id_grade;

            $dateTest = explode("/", $_POST['date_grade']);
            $date_string=$dateTest[2].'-'.$dateTest[1].'-'.$dateTest[0];
            $year_exep=$dateTest[2]+6;
            $year_normal=$dateTest[2]+8;
            $year_rapide=$dateTest[2]+7;
            $year_next=$dateTest[2]+2;
            
            $date_string_exep=$year_exep.'-'.$dateTest[1].'-'.$dateTest[0];
            $date_string_normal=$year_normal.'-'.$dateTest[1].'-'.$dateTest[0];
            $date_string_rapide=$year_rapide.'-'.$dateTest[1].'-'.$dateTest[0];
            $date_next_echelon=$year_next.'-'.$dateTest[1].'-'.$dateTest[0];
            
            $profEdit->date_next_echelon =$date_next_echelon;
            
            $profEdit->date_grade = $date_string;
            $profEdit->date_exep =$date_string_exep;
            $profEdit->date_normal =$date_string_normal;
            $profEdit->date_rapide =$date_string_rapide;
            $profEdit->date_next_echelon;

            if (!$profpermanentsGrades->save($profEdit)) {
                $this->Flash->error(__('Affectation Grade échouée'));
            } else {
                # code...
                $this->Flash->success(__('Affectation Grade avec succès'));
            }
        }



        $profpermanents = $profpermanentsGrades->vacataires->find('list', ['limit' => 200]);
        $grades = $profpermanentsGrades->Grades->find('list', ['limit' => 200]);
        $this->set(compact('profpermanentsGrade', 'profpermanents', 'grades'));
        $i=1;
        $queryProf=$Profs->find('all');
        
        $j=1;
        $queryGrades=$grrades->find('all');
        foreach ($queryGrades as $query2) {
            $tabNom[$j]=$query2->nomGrade;
            $j++;
        }
        $this->set('queryProf', $queryProf);
        //$this->set('nomtab', $tabNom);
        $this->set('_serialize', ['profpermanentsGrade']);
        $this->render('/Espaces/respopersonels/affecterGradeVac');
    }


    ////////////////////////////////////////////////////////////////////////////
    public function statistiqueprofdate()
    {
        $con=ConnectionManager::get('default');

        $date=$con->execute("SELECT  year(date_Recrut) as date, count(*) as nombre FROM profpermanents  GROUP BY date ORDER BY date ASC");
        $this->set('date', $date);
       

        $this->render('/Espaces/respopersonels/statistiqueprofdate');
    }

    public function statistiqueprofgrade()
    {
        $con=ConnectionManager::get('default');

        $grade=$con->execute("SELECT g.codeGrade grade , count(*) as nombre FROM grades g,profpermanents_grades p  WHERE g.id=p.grade_id GROUP BY p.grade_id ORDER BY grade ASC");
        $this->set('grade', $grade);
       

        $this->render('/Espaces/respopersonels/statistiqueprofgrade');
    }

    public function statistiqueprofdept()
    {
        $con=ConnectionManager::get('default');

        $dept=$con->execute("SELECT d.nom_departement dept , count(*) as nombre FROM departements d,profpermanents_departements p  WHERE d.id=p.departement_id GROUP BY p.departement_id ");
        $this->set('dept', $dept);
       

        $this->render('/Espaces/respopersonels/statistiqueprofdept');
    }

    public function statistiqueprofdiscipline()
    {
        $con=ConnectionManager::get('default');

        $discipline=$con->execute("SELECT d.nom_discipline discipline , count(*) as nombre FROM disciplines d,profpermanents_disciplines p  WHERE d.id=p.discipline_id GROUP BY p.discipline_id ");
        $this->set('discipline', $discipline);
       

        $this->render('/Espaces/respopersonels/statistiqueprofdiscipline');
    }

    public function statistiqueprofgenre()
    {
        $con=ConnectionManager::get('default');

        $genre=$con->execute("SELECT  genre as genre, count(*) as nombre FROM profpermanents  GROUP BY genre ORDER BY genre DESC");
        $this->set('genre', $genre);
       

        $this->render('/Espaces/respopersonels/statistiqueprofgenre');
    }

    public function statistiqueprofage()
    {
        $con=ConnectionManager::get('default');

        $age1=$con->execute("SELECT  count(*) as nombre FROM profpermanents WHERE age>=20 AND age<30 ");
        $age2=$con->execute("SELECT  count(*) as nombre FROM profpermanents WHERE age>=30 AND age<40 ");
        $age3=$con->execute("SELECT  count(*) as nombre FROM profpermanents WHERE age>=40 AND age<50 ");
        $age4=$con->execute("SELECT  count(*) as nombre FROM profpermanents WHERE age>=50 AND age<60 ");
        $this->set('age1', $age1);
        $this->set('age2', $age2);
        $this->set('age3', $age3);
        $this->set('age4', $age4);
       

        $this->render('/Espaces/respopersonels/statistiqueprofage');
    }

    public function statistiqueprofactivite()
    {
        $con=ConnectionManager::get('default');

        $activite=$con->execute("SELECT a.nomActivite activite , count(*) as nombre FROM activites a,profpermanents_activites p  WHERE a.id=p.activite_id GROUP BY p.activite_id ");
        $this->set('activite', $activite);
       

        $this->render('/Espaces/respopersonels/statistiqueprofactivite');
    }

    //////////////////////////////////////////////////////////////////////////

    public function statistiquefonctdate()
    {
        $con=ConnectionManager::get('default');

        $date=$con->execute("SELECT  year(date_Recrut) as date, count(*) as nombre FROM fonctionnaires  GROUP BY date ORDER BY date ASC");
        $this->set('date', $date);
       

        $this->render('/Espaces/respopersonels/statistiquefonctdate');
    }

    public function statistiquefonctgrade()
    {
        $con=ConnectionManager::get('default');

        $grade=$con->execute("SELECT g.codeGrade grade , count(*) as nombre FROM grades g,fonctionnaires_grades f  WHERE g.id=f.grade_id GROUP BY f.grade_id ORDER BY grade ASC");
        $this->set('grade', $grade);
       

        $this->render('/Espaces/respopersonels/statistiquefonctgrade');
    }

    public function statistiquefonctservice()
    {
        $con=ConnectionManager::get('default');

        $service=$con->execute("SELECT s.nom_service service , count(*) as nombre FROM services s,fonctionnaires_services f  WHERE s.id=f.service_id GROUP BY f.service_id ");
        $this->set('service', $service);
       

        $this->render('/Espaces/respopersonels/statistiquefonctservice');
    }


    public function statistiquefonctgenre()
    {
        $con=ConnectionManager::get('default');

        $genre=$con->execute("SELECT  genre as genre, count(*) as nombre FROM fonctionnaires  GROUP BY genre ORDER BY genre DESC");
        $this->set('genre', $genre);
       

        $this->render('/Espaces/respopersonels/statistiquefonctgenre');
    }

    public function statistiquefonctage()
    {
        $con=ConnectionManager::get('default');

        $age1=$con->execute("SELECT  count(*) as nombre FROM fonctionnaires WHERE age>=20 AND age<30 ");
        $age2=$con->execute("SELECT  count(*) as nombre FROM fonctionnaires WHERE age>=30 AND age<40 ");
        $age3=$con->execute("SELECT  count(*) as nombre FROM fonctionnaires WHERE age>=40 AND age<50 ");
        $age4=$con->execute("SELECT  count(*) as nombre FROM fonctionnaires WHERE age>=50 AND age<60 ");
        $this->set('age1', $age1);
        $this->set('age2', $age2);
        $this->set('age3', $age3);
        $this->set('age4', $age4);
       

        $this->render('/Espaces/respopersonels/statistiquefonctage');
    }

    public function statistiquefonctactivite()
    {
        $con=ConnectionManager::get('default');

        $activite=$con->execute("SELECT a.nomActivite activite , count(*) as nombre FROM activites a,fonctionnaires_activites f  WHERE a.id=f.activite_id GROUP BY f.activite_id ");
        $this->set('activite', $activite);
       

        $this->render('/Espaces/respopersonels/statistiquefonctactivite');
    }

    
public function printListegradefonct()
    {
        $this->paginate = ['contain' => ['Grades', 'Fonctionnaires']];
        $FonctionnairesGrades = TableRegistry::get('FonctionnairesGrades');

        $con = ConnectionManager::get('default');
        $nombre = array();
        if ($this->request->is('post')) {
            $fonctionnairesGrade = $this->paginate($FonctionnairesGrades->find('all', array(
                         "table" => "fonctionnaires",
                        "conditions" => array( "fonctionnaires_grades.fonctionnaire_id=fonctionnaire.id")
                    )));
            $fonctionnaireG = $con->execute("SELECT FG.fonctionnaire_id, F.nom_fct, F.prenom_fct, F.somme, 
             FG.grade,FG.categorie,FG.echelon, FG.date_grade,FG.date_echelon_rapide,FG.date_echelon_moyen,FG.date_echelon_normal FROM 
            fonctionnaires AS F,fonctionnaires_grades AS FG WHERE F.id = FG.fonctionnaire_id 
             and F.nom_fct = ? "
                [$this->request->data['somme']])->fetchAll('assoc');

       
        } else {
            $fonctionnaireG = $con->execute("SELECT FG.fonctionnaire_id, F.nom_fct, F.prenom_fct, F.somme, 
            FG.grade,FG.categorie, FG.echelon, FG.date_grade,FG.date_echelon_rapide,FG.date_echelon_moyen,FG.date_echelon_normal  FROM 
            fonctionnaires AS F,fonctionnaires_grades AS FG WHERE F.id = 
            FG.fonctionnaire_id  
             ORDER BY  FG.fonctionnaire_id ASC ")->fetchAll('assoc');

        }
        for ($k=0; $k<count($fonctionnaireG); $k++) {
            if ($k!=0 && $fonctionnaireG[$k]['fonctionnaire_id'] == $fonctionnaireG[$k-1]['fonctionnaire_id']) {
                $temp = $nombre[$fonctionnaireG[$k]['fonctionnaire_id']] ;
                $nombre[$fonctionnaireG[$k]['fonctionnaire_id']] = $temp +1;
            } else {
                $nombre[$fonctionnaireG[$k]['fonctionnaire_id']] = 1;
            }
        }
        $this->set('FonctionnairesGrades', $FonctionnairesGrades);
        $this->set('nombre', $nombre);
        $this->set('fonctionnaireG', $fonctionnaireG);
        return $this->render('/Espaces/respopersonels/printListegradefonct');
    }
 public function printListegradeVac()
    {
        $this->paginate = [
            'contain' => ['Vacataires', 'Infosgradesprofs']
        ];
        $ProfpermanentsGrades=TableRegistry::get('VacatairesGrades');


        if (isset($_POST['gradeCherch'])) {
            $indice=$_POST['gradeCherch'];
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades->find('all')->where(['OR'=>
                ['Grades.nomGrade like '=>'%'.$indice.'%',' profpermanents.nom_prof like'=>'%'.$indice.'%',
                    ' profpermanents.prenom_prof like'=>'%'.$indice.'%',' profpermanentsGrades.sous_grade like'=>'%'.$indice.'%',
                    ' profpermanentsGrades.echelon like'=>'%'.$indice.'%']]));
        } else {
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades);
        }

        
        
        $this->set(compact('profpermanentsGrades'));
        $this->set('_serialize', ['profpermanentsGrades']);
        $this->render('/Espaces/respopersonels/printListegradeVac');
    }

public function printListegradeperm()
    {          
         $this->paginate = [
            'contain' => ['Profpermanents', 'Infosgradesprofs']
        ];
        $ProfpermanentsGrades=TableRegistry::get('ProfpermanentsGrades');


        if (isset($_POST['gradeCherch'])) {
            $indice=$_POST['gradeCherch'];
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades->find('all')->where(['OR'=>
                ['Grades.nomGrade like '=>'%'.$indice.'%',' profpermanents.nom_prof like'=>'%'.$indice.'%',
                    ' profpermanents.prenom_prof like'=>'%'.$indice.'%',' profpermanentsGrades.sous_grade like'=>'%'.$indice.'%',
                    ' profpermanentsGrades.echelon like'=>'%'.$indice.'%']]));
        } else {
            $profpermanentsGrades = $this->paginate($ProfpermanentsGrades);
        }

        

        $this->set(compact('profpermanentsGrades'));
        $this->set('_serialize', ['profpermanentsGrades']);
        $this->render('/Espaces/respopersonels/listerGrade');
        $this->render('/Espaces/respopersonels/printListegradeperm');
    }

}
