<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class ProfvacatairesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        // allow only login, forgotpassword
        $this->Auth->authorize = 'controller';
        $usrole = $this->Auth->user('role');
        
        if ($usrole!='profvacataire') {
            $this->Flash->error(__('Vous ne pouvez pas acceder a ce lien'));
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'logout']
            );
        }
        $this->Auth->deny();
    }




   public function imprimerDocumentt($id1=null,$id2=null,$id3=null)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);

        $gradeAssoc=$con->execute('select vg.cadre,vg.sous_grade from vacataires_grades vg where vg.vacataire_id='.$id2);
        $count=count($gradeAssoc);
        $this->set('nbGrade',count($gradeAssoc));
        $this->set('tabGrade',$gradeAssoc);
        //debug (count($gradeAssoc));
         
        $this->paginate = [
            'contain' => ['Vacataires', 'Documents']
        ];
        $VacatairesDocuments=TableRegistry::get('VacatairesDocuments');
        $query=$VacatairesDocuments->find('all')->update()->set(['etatdemande' => 'Prete'])->where(['document_id' => $id1,'vacataire_id'=>$id2,'id'=>$id3]);
        $query->execute();
        $vacatairesDocuments = $this->paginate($VacatairesDocuments->find("all", array(
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

        switch($id1)
        {
            
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

    public function supprimerDocument($id = null)
    {
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);

        $p=$con->execute('delete from vacataires_documents  where vacataires_documents.id='.$id);

        return $this->redirect(['action' => 'etatDemandeFct']);
    }
    public function etatDemandeFct()
    {
        $idUser = $this->Auth->user('id');
        $Vacats = TableRegistry::get('Vacataires');
        $query = $Vacats->find('all')->select('id')->where(['user_id' => $idUser]);
        foreach ($query as $ligne) {
            $ide = $ligne->id;
            break;
        }
        $this->paginate = [
            'contain' => ['Vacataires', 'Documents']
        ];
        $VacatairesDocuments = TableRegistry::get('VacatairesDocuments');
        $VacatairesDocuments = $this->paginate($VacatairesDocuments->find(
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
                    'VacatairesDocuments.vacataire_id' => $ide)
            )
        ));
        $this->set(compact('VacatairesDocuments'));
        $this->set('_serialize', ['VacatairesDocuments']);
        $this->render('/Espaces/profvacataires/etatDemandeFct');
    }
   
    public function etatDemandee()
    {
        $idUser=$this->Auth->user('id');
        $Profs=TableRegistry::get('Vacataires');
        $query=$Profs->find('all')->select('id')->where(['user_id'=>$idUser]);

        foreach ($query as $ligne) {
            $ide=$ligne->id;
        }
        $this->paginate = [
            'contain' => ['Vacataires', 'Documents']
        ];
        $VacatairesDocuments = TableRegistry::get('VacatairesDocuments');
        $VacatairesDocuments = $this->paginate($VacatairesDocuments->find(
            "all",
            array(
                "joins" => array(
                    array(
                        "table" => "Vacataires",
                        "conditions" => array(
                            "VacatairesDocuments.vacataire_id = vacataire.id"
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
                    'VacatairesDocuments.vacataire_id' => $ide)
            )
        ));
        $this->set(compact('VacatairesDocuments'));
        $this->set('_serialize', ['VacatairesDocuments']);
        $this->render('/Espaces/respopersonels/etatDemandee');
    }
    public function index()
    {
        //$this->create_pdf();
        /*BADR SADIK*/
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $deppassement=$con->execute('SELECT * FROM users_books WHERE delai< NOW() AND user_id =?', [$this->Auth->user('id')])->fetchAll('assoc');
        if (count($deppassement)>0) {
            $this->Flash->error(__("vous avez dépassé le delai d'emprunt d'un ouvrage"));
        }
        /*FIN BADR SADIK*/
        //$this->isRattrapage(10);
        $prof_id = $this->getTeacherId()[0]['id'];
        $this->request->session()->write('prof_id', $prof_id);
        $usrole=$this->Auth->user('role');
        $this->set('role', $usrole);
        $this->set('data', $this->homeData($prof_id));
        $this->set('full_data', $this->students_dont_have_not_yet()[0]);
        $this->set('box_msg_note', $this->students_dont_have_not_yet()[1]);
        $this->render('/Espaces/profvacataires/home');
    }

    public function showClass()
    {
        $semestre = $this->generateSemester();
        $prof_id  = $this->request->session()->read('prof_id');
        $annee_scolaire = $this->generateSchoolYear();
        $rows = $this->getClasses($prof_id, $semestre, $annee_scolaire);
        $this->set("classes", $rows);
        $this->render('/Espaces/profvacataires/liste-classes');
    }

    private function generateSchoolYear()
    {
        $year = (int)date("Y");
        $month = (int)date("m");

        if ($month <= 6) {
            $y1 = $year-1;
            return $y1.'/'.$year;
        } else {
            $y1 = $year+1;
            return $year.'/'.$y1;
        }
    }

    public function generateSemester()
    {
        $month = (int)date("m");
        if ($month >= 9 || $month < 2) {
            return array('S1', 'S3', 'S5');
        } else {
            return array('S2', 'S4', 'S6');
        }
    }

    public function showModel($msg = null)
    {
        $class_id = $this->request->data('class_id');
        $prof_id =  $this->request->session()->read('prof_id');
        $_class_id = $this->request->session()->read('class_id');
        if ($class_id != null) {
            $this->request->session()->write('class_id', $class_id);
            $_class_id = $class_id;
        } elseif ($_class_id == null) {
            $this->request->session()->write('class_id', $class_id);
            $_class_id = $this->request->session()->read('class_id');
        }

        $rows = $this->get_all_modeles($prof_id, $_class_id);
        $this->set("modules", $rows);
        $this->set("message", $msg);
        $this->render('/Espaces/profvacataires/liste-modules');
    }

    public function checkKey()
    {
        $model_id  = $this->request->data('module_id');
        $class_id = $this->request->data('class_id');
        if ($class_id != null) {
            $this->request->session()->write('class_id', $class_id);
        }

        $this->set("module_id", $model_id);
        $this->render('/Espaces/profvacataires/check-key');
    }

    public function showElement()
    {
        $model_id  = $this->request->data('module_id');
        $action  = $this->request->data('action');
        $key = $this->request->data('key');
//        if (isset($model_id) && $model_id != null) {
//            $database_key = $this->getKey($model_id);
//        }else{
        $database_key = $this->getKey($this->request->session()->read('prof_id'));
//        }
//            echo '<pre>';
//            print_r($database_key);die();
        if (($database_key != null && sha1($key) === $database_key[0]['key_module'] && (date("Y-m-d H:i:s") < $database_key[0]['date_valide'])) || $action === "consulter") {
            $_model_id = $this->request->session()->read('module_id');
            //echo $model_id;die();
            $this->request->session()->write('access_type', $action);

            if ($model_id != null) {
                $this->request->session()->write('module_id', $model_id);
                $_model_id = $model_id;
            } elseif ($_model_id == null) {
                $this->request->session()->write('module_id', $model_id);
                $_model_id = $this->request->session()->read('module_id');
            }
            $prof_id =  $this->request->session()->read('prof_id');
            $rows = $this->get_all_elements($prof_id, $_model_id);
            $this->set("elements", $rows);
            if ($action !== "consulter") {
                $this->request->session()->write('for_ratt', $database_key[0]['for_ratt']);
                $this->request->session()->write('for_pv', $database_key[0]['pv']);
                $this->request->session()->write('key_pv_id', $database_key[0]['id']);
            }
            $this->render('/Espaces/profvacataires/liste-elemenents');
        } else {
            if (!empty($key)) {
                $this->set('msg', 'Votre key est incorrect ou la durée de validitée est expiré');
            }
            $this->set("module_id", $model_id);
            $this->render('/Espaces/profvacataires/check-key');
        }
    }

    // modifier_3/21/2017
    public function getStudentsMarksOrderBy($element_id, $order_key)
    {
        $conn = ConnectionManager::get('default');
        $classe_id =  $this->request->session()->read('class_id');
        $annee_scolaire_id = $this->getSchoolId();
        return $conn->execute(
            "SELECT n.* ,et.cne , et.nom_fr, et.prenom_fr, el.id as element_id, el.libile  "
            . "FROM notes n, elements el, etudiants et , etudiers e "
            . "WHERE el.id = $element_id AND "
            . "n.element_id = el.id AND "
            . "et.id = e.etudiant_id AND "
            . "e.id = n.etudier_id AND "
            . "e.groupe_id = $classe_id AND "
            . "e.annee_scolaire_id = $annee_scolaire_id"
            . " ORDER BY $order_key desc"
        );
    }


    // modifier_3/21/2017
    public function showStudents($message = null, $order_key = null)
    {
        $element_id  = $this->request->data('element_id');
        $classe_id =  $this->request->session()->read('class_id');
        $annee_scolaire_id = $this->getSchoolId();
        $conn = ConnectionManager::get('default');
        $stmt = null;
        $first_time = $this->isAdded($element_id);
        switch ($first_time) {
            case true:
                $stmt = $this->getStudentsMarks($element_id, $order_key);
                $note_data = $this->getAvgMaxMinNoteByElementId($element_id);
                $noteStatisitique = $note_data->fetchAll('assoc');
                $rest = $this->getRestASaisir($element_id);
                $restASaisir = $rest->fetchAll('assoc');
                $this->set('statisticNotes', $noteStatisitique);
                $this->set('restASaisir', $restASaisir);
                //echo '<pre>';
                //print_r($noteStatisitique);die();
                break;
            case false:
                $stmt = $conn->execute(
                    "SELECT et.*, el.id as element_id , e.id as etudier_id, element_id, el.libile "
                    . "FROM etudiers e, elements el, etudiants et "
                    . "WHERE el.id = $element_id AND "
                    . "e.element_id = el.id AND "
                    . "et.id = e.etudiant_id AND "
                    . "e.groupe_id = $classe_id AND "
                    . "e.annee_scolaire_id = $annee_scolaire_id"
                );
                break;
        }
        $rows = $stmt->fetchAll('assoc');
        $this->set('first_time', !$first_time);
        $this->set("etudiants", $rows);
        $this->set('message', $message);

        try {
            $for_pv = $this->request->session()->read('for_pv');
            $for_ratt = $this->request->session()->read('for_ratt');
        } catch (Exception $exc) {
            $for_pv = 0;
            $for_ratt = 0;
        }

        $this->set('for_pv', $for_pv);
        $this->set('for_ratt', $for_ratt);
        $this->set('anneeScolaire', $this->getAnneeScolaire($rows[0]['etudier_id']));
        $this->set('semestre', $this->getSemestre($rows[0]['etudier_id']));
        $this->set('access_type', $this->request->session()->read('access_type'));
        //echo $order_key;die();
        $this->render('/Espaces/profpermanents/liste-etudiants');
    }


    //modifier3/21/2017
    private function getRestASaisir($element_id)
    {
        $conn = ConnectionManager::get('default');
        $classe_id =  $this->request->session()->read('class_id');
        $annee_scolaire_id = $this->getSchoolId();
        return $conn->execute(
            "SELECT COUNT(n.id) non_saisie "
            . "FROM notes n, elements el, etudiants et , etudiers e "
            . "WHERE el.id = $element_id AND "
            . "n.element_id = el.id AND "
            . "et.id = e.etudiant_id AND "
            . "e.id = n.etudier_id AND "
            . "e.groupe_id = $classe_id AND "
            . "e.annee_scolaire_id = $annee_scolaire_id AND "
            . "n.note IS NULL"
        );
    }


    //modifier_3/21/2017
    private function getAvgMaxMinNoteByElementId($element_id)
    {
        $conn = ConnectionManager::get('default');
        $classe_id =  $this->request->session()->read('class_id');
        $annee_scolaire_id = $this->getSchoolId();
        return $conn->execute(
            "SELECT AVG(CASE WHEN n.ratt_confirmed = 1 AND n.note_ratt IS NOT NULL THEN n.note_ratt ELSE n.note END) AS avg_note, MIN(n.note) AS min_note, MAX(n.note) AS max_note "
            . "FROM notes n, elements el, etudiants et , etudiers e "
            . "WHERE el.id = $element_id AND "
            . "n.element_id = el.id AND "
            . "et.id = e.etudiant_id AND "
            . "e.id = n.etudier_id AND "
            . "e.groupe_id = $classe_id AND "
            . "e.annee_scolaire_id = $annee_scolaire_id"
        );
    }

    public function addNote()
    {
        $action = $this->request->data('action');
        $query  = $this->request->data('query');
        $lenght  = $this->request->data('lenght');
        $element_id = $this->request->data('element_id');
        $order_key = $this->request->data('orderBy');
        try {
            $for_pv = $this->request->session()->read('for_pv');
            $for_ratt = $this->request->session()->read('for_ratt');
        } catch (Exception $exc) {
            $for_pv = 0;
            $for_ratt = 0;
        }

        $inserted = array();
        $msg = null;
        if (isset($action) != null) {
            switch ($action) {
                case "confirme":
                    if ($query === "insert") {
                        for ($i = 0; $i < $lenght; $i++) {
                            $noteTable = TableRegistry::get('Notes');
                            $note = $noteTable->newEntity();
                            $note->note = $this->request->data('note_'.$i);
                            $note->element_id = $element_id;
                            $note->saved = 1;
                            $note->confirmed = 1;
                            $note->created_at = date("Y-m-d H:i:s");
                            $note->updated_at = date("Y-m-d H:i:s");
                            $note->etudier_id = $this->request->data('etudiant_'.$i);
                            if ($noteTable->save($note)) {
                                $inserted[] = $note->id;
                            }
                        }
                    } elseif ($query === "update") {
                        $updated_note_counter = 0;
                        for ($i = 0; $i < $lenght; $i++) {
                            $noteTable = TableRegistry::get('Notes');
                            $note = $noteTable->get($this->request->data('etudiant_'.$i)); // Return article with id 12
                            if ($note->confirmed !== 1 || ($for_pv && !$for_ratt)) {
                                $old_note = $note->note;
                                $note->note = $this->request->data('note_'.$i);
                                $new_note = $this->request->data('note_'.$i);
                                $note->saved = 1;
                                $note->confirmed = 1;
                                $note->updated_at = date("Y-m-d H:i:s");
                                $noteTable->save($note);
                            } elseif ($note->ratt_confirmed !== 1 || ($for_pv && $for_ratt)) {
                                $old_note = $note->note_ratt;
                                $note->note_ratt = $this->request->data('ratt_note_'.$i);
                                $new_note = $this->request->data('ratt_note_'.$i);
                                $note->ratt_saved = 1;
                                $note->updated_at = date("Y-m-d H:i:s");
                                $note->ratt_confirmed = 1;
                                $noteTable->save($note);
                            }
                            if ($for_pv) {
                                $this->add_pv($note->id, $old_note, $new_note, $updated_note_counter);
                            }
                        }
                    }
                    if ($updated_note_counter > 0) {
                        $this->desable_pv_key();
                        return $this->setAction('showModel', $msg);
                    }
                    break;
                case "save":
                    if ($query === "insert") {
                        for ($i = 0; $i < $lenght; $i++) {
                            $noteTable = TableRegistry::get('Notes');
                            $note = $noteTable->newEntity();
                            $note->note = $this->request->data('note_'.$i);
                            $note->element_id = $element_id;
                            $note->saved = 1;
                            $note->confirmed = 0;
                            $note->created_at = date("Y-m-d H:i:s");
                            $note->updated_at = date("Y-m-d H:i:s");
                            $note->etudier_id = $this->request->data('etudiant_'.$i);
                            if ($noteTable->save($note)) {
                                $inserted[] = $note->id;
                            }
                        }
                    } elseif ($query === "update") {
                        for ($i = 0; $i < $lenght; $i++) {
                            $noteTable = TableRegistry::get('Notes');
                            $note = $noteTable->get($this->request->data('etudiant_'.$i)); // Return article with id 12
                            if ($note->confirmed !== 1 || ($for_pv && !$for_ratt)) {
                                $note->note = $this->request->data('note_'.$i);
                                $note->saved = 1;
                                $note->updated_at = date("Y-m-d H:i:s");
                                if ($noteTable->save($note)) {
                                    $msg = "Vos changements sont effectuée avec success !";
                                } else {
                                    $msg = "Error somthing wrong !!!";
                                }
                            } elseif ($note->ratt_confirmed !== 1 || ($for_pv && $for_ratt)) {
                                $note-> note_ratt = $this->request->data('ratt_note_'.$i);
                                $note->ratt_saved = 1;
                                $note->updated_at = date("Y-m-d H:i:s");
                                if ($noteTable->save($note)) {
                                    $msg = "Vos changements sont effectuée avec success !";
                                } else {
                                    $msg = "Error somthing wrong !!!";
                                }
                            }
                        }
                    }

                    break;
                case "export":
                    $this->exportCsv($element_id);
                    $msg = "Votre document est bien exporter vérifié votre bureau";
                    break;
                case "order":
                    return $this->setAction('showStudents', null, $order_key);
                case "save_html":
                    $data = $action = $this->request->data('html_content');
                    $this->exportHtml($data);
                    $msg = "Votre document est bien exorter vérifié votre bureau";
                    break;
                case "insert_csv":
                    $msg = $this->insert_marks_from_csv();
                    try {
                        $pv = $this->request->session()->read('for_pv');
                    } catch (Exception $ex) {
                        $pv = 0;
                    }
                    if ($pv) {
                        $this->desable_pv_key();
                        return $this->setAction('showModel', $msg);
                    }
                    break;
                case "update_csv":
                    $msg = $this->update_marks_from_csv();
                    try {
                        $pv = $this->request->session()->read('for_pv');
                    } catch (Exception $ex) {
                        $pv = 0;
                    }
                    if ($pv) {
                        $this->desable_pv_key();
                        return $this->setAction('showModel', $msg);
                    }
                    break;
            }
        }
        $this->setAction('showStudents', $msg);
    }

    private function add_pv($note_id, $old_note, $new_note, &$change_counter)
    {
        //echo "NOTE OLD : $old_note vs $new_note NOTE NEW <br/>";
        if ((float)$old_note !== (float)$new_note) {
            $change_counter++;
            $pvTable = TableRegistry::get('Pvupdate');
            $pv = $pvTable->newEntity();
            $pv->profpermanent_id = $this->request->session()->read("prof_id");
            $pv->note_id = $note_id;
            $pv->note_old = $old_note;
            $pv->date_update = date("Y-m-d H:m:s");
            $pvTable->save($pv);
        }
    }
    private function desable_pv_key()
    {
        $key_pv = $this->request->session()->read('key_pv_id');
        $noteAuthTable = TableRegistry::get('NotesAuth');
        $noteAuth = $noteAuthTable->get($key_pv);
        if ($noteAuth != null) {
//            echo 1;die();
            $noteAuth->date_valide = date("Y-m-d H:m:s");
            $noteAuthTable->save($noteAuth);
            $this->request->session()->write('for_pv', 0);
            $this->request->session()->write('for_ratt', 0);
            //echo $for_pv;die();
//            try{
//                $this->Session->delete('key_pv_id');
//                $this->Session->delete('for_pv');
//            } catch (Exception $ex) {
//                echo $ex;die();
//            }
//            $this->request->session->read("key_pv_id")->destroy();
//            $this->request->session->read("for_pv")->destroy();
        }
//        echo 2;die();
    }

    public function exportHtml($data)
    {
        $name = "Note_".date("H-i-s");
        $path_tmp =  getenv("HOMEDRIVE").getenv("HOMEPATH")."\Desktop";
        $path = str_replace("\\", "/", $path_tmp);
        $data_final = str_replace("<textarea type=\"hidden\" name=\"html_content\" id=\"html_content_input\"></textarea>", "", $data);
        $data_final = str_replace("<button id=\"exporter\" style=\" margin-right: 10px; margin-bottom: 20px; \" value=\"export\" name=\"action\" type=\"submit\" class=\"btn btn-warning pull-right\">  Exporter CSV  </button>", "", $data_final);
        $data_final = str_replace("<button style=\" margin-right: 10px; margin-bottom: 20px; \" value=\"save_html\" name=\"action\" type=\"submit\" class=\"btn btn-warning pull-right\">  Exporter HTML </button>", "", $data_final);
        $data_final = str_replace("<button type=\"submit\" name=\"action\" value=\"order\" class=\"btn btn-info btn-flat\">Go!</button>", "", $data_final);
        $data_final = str_replace("<select name=\"orderBy\" class=\"form-control\" style=\" width: 25%; float: right; \">
                                  <option value=\"DEFAULT\">Filtrer Par : </option>
                                  <option value=\"cne\">CNE</option>
                                  <option value=\"nom_fr\">Nom</option>
                                  <option value=\"note\">Note</option>
                                  <option value=\"confirmed\">Confirmer</option>
                                    </select>", "", $data_final);
        $path = $path.'/'.$name.'.html';
        $fp = fopen($path, "w");
        fwrite($fp, $data_final);
        fclose($fp);
    }

    public function showStudentDetail()
    {
        $prf_id = $this->request->session()->read('prof_id');
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT DISTINCT etd.nom_fr, e.etudiant_id ,  etd.prenom_fr, f.libile
                        FROM etudiants etd, etudiers e, enseigners ens, elements elm, annee_scolaires a, semestres s, groupes c, vacataires p, filieres f
                        WHERE ens.vacataire_id = p.id AND
                        ens.semestre_id = s.id AND
                        ens.annee_scolaire_id = a.id AND 
                        e.etudiant_id = etd.id AND 
                        e.groupe_id = c.id AND
                        c.filiere_id = f.id AND
                        e.element_id IN (SELECT ens.element_id FROM enseigners ens WHERE ens.vacataire_id = $prf_id)
                        ORDER  BY etd.nom_fr"
        );
        //, e.element_id
        $rows =  $stmt->fetchAll('assoc');
        //echo '<pre>';
        //rint_r($rows);die();
        $this->set('etudiants', $rows);
        $this->render('/Espaces/profvacataires/etudiants_info');
    }

    public function addDemandeKey()
    {
        $module_id  = $this->request->data('module_id');
        $prof_id = $this->request->session()->read('prof_id');
        $classe_id = $this->request->session()->read('class_id');

        $demande_type = $this->request->data('key_type');
        if ($module_id == null) {
            $module_id = $this->request->session()->read('module_id');
        }
        try {
            $demande_actif = $this->request->session()->read("demande_actif");
        } catch (Exception $exc) {
            $demande_actif = false;
        }

        if ($demande_actif) {
            $this->set('msg', 'Vous avez deja efectué une demande !');
            $this->set("module_id", $module_id);
            return $this->render('/Espaces/profvacataires/check-key');
        } else {
            $pv = ($demande_type === "PV")? 1 : 0;
            $conn = ConnectionManager::get('default');
            $result = $conn->execute(
                "INSERT INTO `demande_auth`(`classe_id`, `vacataire_id`, `pv`, `state`) "
                . "VALUES ($classe_id,$prof_id, $pv, 1)"
            );
            $affectedRows = $result->rowCount();
            if ($affectedRows > 0) {
                $this->request->session()->write("demande_actif", true);
                $this->set('msgOk', 'Merci votre demande est en cours de traitement');
                $this->set("module_id", $module_id);
                $this->render('/Espaces/profvacataires/check-key');
            } else {
                $this->set('msg', 'Desolé votre demande n\' est pas envoyer. veuillez réessayer plus tard');
                $this->set("module_id", $module_id);
                $this->render('/Espaces/profvacataires/check-key');
            }
        }
    }

    // modifier_3/21/2017
    private function getStudentsMarks($element_id, $order_key)
    {
        $conn = ConnectionManager::get('default');
        $classe_id =  $this->request->session()->read('class_id');
        $annee_scolaire_id = $this->getSchoolId();
        if ($order_key == null || $order_key == "DEFAULT") {
            return $conn->execute(
                "SELECT n.* ,et.cne , et.nom_fr, et.prenom_fr, el.id as element_id, el.libile  "
                . "FROM notes n, elements el, etudiants et , etudiers e "
                . "WHERE el.id = $element_id AND "
                . "n.element_id = el.id AND "
                . "et.id = e.etudiant_id AND "
                . "e.id = n.etudier_id AND "
                . "e.groupe_id = $classe_id AND "
                . "e.annee_scolaire_id = $annee_scolaire_id"
            );
        } else {
            switch ($order_key) {
                case "cne":
                    return $this->getStudentsMarksOrderBy($element_id, $order_key);
                case "nom_fr":
                    return $this->getStudentsMarksOrderBy($element_id, $order_key);
                case "note":
                    return $this->getStudentsMarksOrderBy($element_id, $order_key);
                case "confirmed":
                    return $this->getStudentsMarksOrderBy($element_id, $order_key);
                default:
                    break;
            }
        }
    }

    private function insert_marks_from_csv()
    {
        $file = $this->request->data('csv_notes');
        $element_id = $this->request->data('element_id');
        $lenght  = $this->request->data('lenght');
        $filename = $file['tmp_name'];
        $inserted = array();
        if ($file['size'] > 0) {
            //update =======>

            for ($i = 0; $i < $lenght; $i++) {
                $op_file = fopen($filename, "r");
                $ijd = 0;
                $request_etudier_id = $this->request->data('etudiant_'.$i);
                $saved = 0;
                while (($emapData = fgetcsv($op_file, 10000, ',')) !== false) {
                    if ($ijd > 0) {
                        $cne = $emapData[0];
                        $note_csv = $emapData[3];
                        $etudier_id = $this->get_etudier_id($cne, $element_id);
                        //echo '<br/>'.$etudier_id.' -- '.$request_etudier_id.'<br/>';
                        if ($etudier_id == $request_etudier_id) {
                            $noteTable = TableRegistry::get('Notes');
                            $note = $noteTable->newEntity();
                            $note->note = $note_csv;
                            $note->element_id = $element_id;
                            $note->saved = 1;
                            $note->confirmed = 0;
                            $note->created_at = date("Y-m-d H:i:s");
                            $note->updated_at = date("Y-m-d H:i:s");
                            $note->etudier_id = $etudier_id;
                            if ($noteTable->save($note)) {
                                $inserted[] = $note->id;
                                $saved = 1;
                                echo $saved.'<br/>';
                            }
                        }
                    }
                    $ijd++;
                }
                if ($saved == 0) {
                    $noteTable = TableRegistry::get('Notes');
                    $note = $noteTable->newEntity();
                    $note->note = null;
                    $note->element_id = $element_id;
                    $note->saved = 1;
                    $note->confirmed = 0;
                    $note->created_at = date("Y-m-d H:i:s");
                    $note->updated_at = date("Y-m-d H:i:s");
                    $note->etudier_id = $request_etudier_id;
                    $noteTable->save($note);
                }
                fclose($op_file);
            }
            //==============>                        //$this->insert_marlk($element_id, $etudier_id, $note);
        }
        if (count($inserted) == $lenght) {
            return "Vous dennez ont bien inserer, Merci!";
        }
        return "Il se peut que certains notes n'ont pas etait bien enregestrez, prière de vérifier vos données !";
    }
//    private function insert_marks_from_csv() {
//        $file = $this->request->data('csv_notes');
//        $element_id = $this->request->data('element_id');
//        $filename = $file['tmp_name'];
//        if ($file['size'] > 0) {
//            $op_file = fopen($filename, "r");
//            $i = 0;
//            while (($emapData = fgetcsv($op_file, 10000, ',')) !== false){
//                if ($i > 0) {
//                    $cne = $emapData[0];
    ////                    $nom = $emapData[1];
    ////                    $prenom = $emapData[2];
//                    $note = $emapData[3];
//                    //$note_ratt = $emapData[5];
//                    $etudier_id = $this->get_etudier_id($cne, $element_id);
//                    $this->insert_marlk($element_id, $etudier_id, $note);
//                }
//                $i++;
//            }
//            fclose($op_file);
//        }
//        return "Vous dennez ont bien inserer, Merci!";
//    }

    private function update_marks_from_csv()
    {
        $file = $this->request->data('csv_notes');
        $element_id = $this->request->data('element_id');
        $filename = $file['tmp_name'];
        if ($file['size'] > 0) {
            $op_file = fopen($filename, "r");
            $i = 0;
            while (($emapData = fgetcsv($op_file, 10000, ',')) !== false) {
                if ($i > 0) {
                    $cne = $emapData[0];
//                    $nom = $emapData[1];
//                    $prenom = $emapData[2];
                    $note = $emapData[3];
                    $etudier_id = $this->get_etudier_id($cne, $element_id);

                    $this->update_marlk($element_id, $etudier_id, $note, $cne);
                }
                $i++;
            }
            fclose($op_file);
        }
    }

    private function update_marlk($element_id, $etudier_id, $mark, $cne)
    {
        $note_id = $this->get_note_id($element_id, $etudier_id, $cne);
        $for_pv = 0;
        $for_ratt = 0;

        try {
            $for_pv = $this->request->session()->read('for_pv');
            $for_ratt = $this->request->session()->read('for_ratt');
        } catch (Exception $ex) {
            echo "insert_marks_from_csv";
            die();
        }
        if ($note_id != -1) {
            if ($for_pv == 1) {
                if ($for_ratt == 1) {
                    $this->do_update_note($note_id, $mark, "RATTRAPAGE", 1);
                } else {
                    $this->do_update_note($note_id, $mark, "NORMAL", 1);
                }
            } else {
                if ($for_ratt == 1) {
                    $this->do_update_note($note_id, $mark, "RATTRAPAGE", 0);
                } else {
                    $this->do_update_note($note_id, $mark, "NORMAL", 0);
                }
            }
        }
    }

    private function do_update_note($note_id, $mark, $session, $isPv)
    {
        switch ($session) {
            case "NORMAL":
                if ($isPv) {
                    try {
                        $change_counter = 0;
                        $noteTable = TableRegistry::get('Notes');
                        $note = $noteTable->get($note_id);
                        $note->note = $mark;
                        $note->saved = 1;
                        $note->confirmed = 1;
                        $note->updated_at = date("Y-m-d H:i:s");
                        if ($mark <= 20) {
                            $noteTable->save($note);
                            $this->add_pv($note->id, $old_note, $mark, $change_counter);
                        }
                    } catch (Exception $exc) {
                        echo $exc->getTraceAsString();
                        die();
                    }
                } else {
                    try {
                        $noteTable = TableRegistry::get('Notes');
                        $note = $noteTable->get($note_id);
                        if (!$note->confirmed && $mark <= 20) {
                            $note->note = $mark;
                            $note->saved = 1;
                            $note->confirmed = 0;
                            $note->updated_at = date("Y-m-d H:i:s");
                            $noteTable->save($note);
                        }
                    } catch (Exception $exc) {
                        echo $exc->getTraceAsString();
                        die();
                    }
                }
                break;
            case "RATTRAPAGE":
                if ($isPv) {
                    try {
                        $change_counter = 0;
                        $noteTable = TableRegistry::get('Notes');
                        $note = $noteTable->get($note_id);
                        $note->note_ratt = $mark;
                        $note->ratt_saved = 1;
                        $note->ratt_confirmed = 1;
                        $note->updated_at = date("Y-m-d H:i:s");
                        if ($mark <= 12 && $note->note <= 12) {
                            $noteTable->save($note);
                            $this->add_pv($note->id, $old_note, $mark, $change_counter);
                        }
                    } catch (Exception $exc) {
                        echo $exc->getTraceAsString();
                        die();
                    }
                } else {
                    try {
                        $noteTable = TableRegistry::get('Notes');
                        $note = $noteTable->get($note_id);
                        if (!$note->ratt_confirmed && $mark <= 12 && $note->note < 12) {
                            $note->note_ratt = $mark;
                            $note->ratt_saved = 1;
                            $note->ratt_confirmed = 0;
                            $note->updated_at = date("Y-m-d H:i:s");
                            $noteTable->save($note);
                        }
                    } catch (Exception $exc) {
                        echo $exc->getTraceAsString();
                        die();
                    }
                }
                break;
        }
    }

    private function get_note_id($element_id, $etudier_id, $cne)
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT DISTINCT n.id
                FROM etudiers e, etudiants etd, notes n
                WHERE n.element_id = $element_id AND
                n.etudier_id = $etudier_id AND 
                e.etudiant_id = etd.id AND 
                etd.cne = $cne 
                GROUP BY n.id"
        );

        $rows = $stmt->fetchAll('assoc');

//                        echo $etudier_id.'<br/>'.$element_id.'<br/>'.$cne.'</br/>';
//            echo '<pre>';
//            print_r($stmt);
        if (!empty($rows)) {
            return $rows[0]['id'];
        }
        return -1;
    }

    private function insert_marlk($element_id, $etudier_id, $mark)
    {
//        $date_now = date("Y-m-d H:m:s");
//        $conn = ConnectionManager::get('default');
//        try {
//            $conn->execute(
//                "INSERT INTO `notes`(`element_id`, `etudier_id`,
//                                     `note`, `confirmed`,
//                                     `saved`,
//                                     `updated_at`)
//                              VALUES ($element_id, $etudier_id, $note, 0, 1, '$date_now')
//                "
//                );
//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//        }

        $noteTable = TableRegistry::get('Notes');
        $note = $noteTable->newEntity();
        if ($mark <= 20) {
            $note->note = $mark;
            $note->saved = 1;
            $note->element_id = $element_id;
            $note->etudier_id = $etudier_id;
            $note->confirmed = 0;
            $note->updated_at = date("Y-m-d H:i:s");
            $noteTable->save($note);
        }
    }

    private function get_etudier_id($cne, $element_id)
    {
        $class_id = $this->request->session()->read('class_id');

        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT e.id
                FROM etudiers e, etudiants etd
                WHERE e.groupe_id = $class_id AND
                e.etudiant_id = etd.id AND 
                etd.cne = $cne AND 
                e.element_id = $element_id
                "
        );
        $rows = $stmt->fetchAll('assoc');
        if (!empty($rows)) {
            return $rows[0]['id'];
        }
        return -1;
    }

    private function isAdded($element_id)
    {
        $anneeScolaire = $this->generateSchoolYear();
        $classe_id = $this->request->session()->read('class_id');
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT DISTINCT n.id as note_id 
                FROM notes n, elements el, etudiers e, groupes c, annee_scolaires a
                WHERE el.id = $element_id AND
                n.element_id = el.id AND 
                n.etudier_id = e.id AND 
                a.libile = '$anneeScolaire' AND
                e.annee_scolaire_id = a.id AND
                e.groupe_id = $classe_id
                GROUP BY n.id "
        );
        $rows = $stmt->fetchAll('assoc');
        return $rows == null ? false : true;
    }

    private function getTeacherId()
    {
        $user_id = $this->Auth->user('id');

        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT p.* from vacataires p, users users
                WHERE users.id = $user_id AND 
                p.user_id = users.id;"
        );
        return $rows = $stmt->fetchAll('assoc');
    }

    private function getKey($prof_id)
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT * "
            . "FROM notes_auth "
            . "WHERE vacataire_id = $prof_id  AND "
            . "date_valide > NOW()"
        );
        return $rows = $stmt->fetchAll('assoc');
    }

    private function homeData($prof_id)
    {
        $box = array();
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT *
                        FROM vacataires p 
                        WHERE p.id = $prof_id "
        );

        $box['PROF_DATA'] = $stmt->fetchAll('assoc');
        // GRADE
        $stmt =  $conn->execute(
            "SELECT *
                        FROM vacataires_grades g 
                        WHERE g.vacataire_id = $prof_id "
        );

        $box['PROF_GRADE'] = $stmt->fetchAll('assoc');
        //Students number
        $stmt = $conn->execute(
            "SELECT count(DISTINCT et.etudiant_id) AS student_nbr
                        FROM vacataires p, etudiers et, semestres s, annee_scolaires a, enseigners e, elements el
                        WHERE et.annee_scolaire_id = a.id AND 
                        e.vacataire_id = p.id AND
                        e.semestre_id = s.id AND 
                        et.element_id IN (SELECT enseigners.element_id FROM enseigners WHERE enseigners.vacataire_id = $prof_id)
                        ORDER by et.etudiant_id "
        );
        $box['STUDENT_NBR'] = $stmt->fetchAll('assoc');
        //Nobre des element enseigner par le prof
        $stmt = $conn->execute(
            "SELECT COUNT(DISTINCT e.element_id) AS elements_nbr
                        FROM enseigners e, vacataires p, annee_scolaires a, semestres s
                        WHERE e.semestre_id = s.id AND 
                        e.annee_scolaire_id = a.id AND
                        e.vacataire_id = p.id AND
                        p.id = $prof_id "
        );
        $box['ELEMENT_NBR'] = $stmt->fetchAll('assoc');
        //Nombre des classe enseigner par prof
        $box['CLASSES_NBR'] = $this->getClasses($prof_id, $this->generateSemester(), $this->generateSchoolYear());
        return $box;
    }

    private function getClasses($prof_id, $semestre, $annee_scolaire)
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT DISTINCT c.id as class_id , f.libile as feliere_lib , n.libile as nivaux_lib, e.id as enseigner_id 
                        FROM groupes c, filieres f, niveaus n, semestres s, annee_scolaires a, enseigners e, vacataires p 
                        WHERE e.semestre_id = s.id AND 
                        s.niveaus_id  = n.id AND 
                        c.niveaus_id  = n.id AND 
                        c.filiere_id = f.id AND 
                        e.vacataire_id = p.id AND 
                        e.annee_scolaire_id = a.id AND 
                        p.id = $prof_id AND
                        s.libile IN ('$semestre[0]', '$semestre[1]', '$semestre[2]') AND
                        a.libile =  '$annee_scolaire' "
            . "GROUP BY(class_id) "
        );

        return  $stmt->fetchAll('assoc');
    }

    private function getAnneeScolaire($etudier_id)
    {
        if ($etudier_id != null) {
            $conn = ConnectionManager::get('default');
            $stmt = $conn->execute(
                "SELECT a.* 
                            FROM etudiers e, annee_scolaires a
                            WHERE e.annee_scolaire_id = a.id AND
                            e.id = $etudier_id"
            );

            return $stmt->fetchAll('assoc');
        }
        return null;
    }

    private function getSemestre($etudier_id)
    {
        if ($etudier_id != null) {
            $conn = ConnectionManager::get('default');
            $stmt = $conn->execute(
                "SELECT s.libile as semestres_lib, n.libile as niveaus_lib, f.libile AS filieres_lib 
                            FROM etudiers e, groupes c, niveaus n, semestres s, filieres f 
                            WHERE e.groupe_id = c.id AND 
                            c.niveaus_id = n.id AND 
                            s.niveaus_id = n.id AND
                            c.filiere_id = f.id AND
                            e.id = $etudier_id"
            );
            return $stmt->fetchAll('assoc');
        }
        return null;
    }

    private function students_dont_have_not_yet()
    {
        $main_box = null;
        $box = null;
        $box_msg_note = null;
        $prof_id  = $this->request->session()->read('prof_id');
        $classes = $this->getClasses($prof_id, $this->generateSemester(), $this->generateSchoolYear());
        for ($i = 0; $i < count($classes); $i++) {
            if ($classes[$i] != null && !empty($classes[$i])) {
                $box[]['classes'] = $classes[$i];
                $classes_id = $classes[$i]['class_id'];
                $modeles = $this->getModels($prof_id, $classes_id);
                $box[$i]['classes']['modeles'] = $modeles;
                if ($modeles != null) {
                    for ($j = 0; $j < count($modeles); $j++) {
                        if ($modeles[$j] != null && !empty($classes[$j])) {
                            $modele_id = $modeles[$j]['id'];
                            $elements = $this->getElements($prof_id, $modele_id);
                            $box[$i]['classes']['modeles'][$j]['elements'] = $elements;
                            for ($h = 0; $h < count($elements); $h++) {
                                $element_id = $elements[$h]['id'];
                                if ($element_id != null) {
                                    $nbr_student_have_note = $this->count_students_have_note($element_id);
                                    $nbr_students_in_element = $this->count_students_in_element($classes_id, $element_id);
                                    $note_min_max_avg = $this->note_min_max_avg($element_id);

                                    $box[$i]['classes']['modeles'][$j]['elements'][$h]['nbr_note'] = $nbr_student_have_note;
                                    $box[$i]['classes']['modeles'][$j]['elements'][$h]['nbr'] = $nbr_students_in_element;
                                    $box[$i]['classes']['modeles'][$j]['elements'][$h]['nbr_mma'] = $note_min_max_avg;

                                    $rante =  $nbr_students_in_element[0]['nombre_etudiants'] - $nbr_student_have_note[0]['nbr_etudiant_note'] ;

                                    if ($rante > 0) {
                                        $box_msg_note[] = array(
                                            'nivaux'=> $classes[$i]['nivaux_lib'],
                                            'feliere' => $classes[$i]['feliere_lib'],
                                            'modele' => $modeles[$j]['libile'],
                                            'element' => $elements[$h]['libile'],
                                            'reste_saisir' => $rante
                                        );
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $main_box[] = $box;
        $main_box[] = $box_msg_note;
        return $main_box;
    }

    private function isRattrapage($element_id)
    {
        $annee_scolaire = $this->getSchoolId();
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT COUNT(n.ratt_confirmed) AS nbr_ratt
                        FROM notes n, etudiers e
                        WHERE n.ratt_confirmed = 1 AND
                        n.note_ratt IS NOT NULL AND 
                        n.element_id = $element_id AND
                        n.etudier_id = e.id AND 
                        e.annee_scolaire_id = $annee_scolaire;"
        );
        $ratt_confirmed = $stmt->fetchAll('assoc')[0]['nbr_ratt'];
        if ($ratt_confirmed > 0) {
            return true;
        } else {
            $stmt = $conn->execute(
                "SELECT COUNT(n.id) AS nbr_note
                        FROM notes n, etudiers e
                        WHERE n.confirmed = 1 AND
                        n.element_id = $element_id AND
                        n.note >= 12 AND
                        n.etudier_id = e.id AND 
                        e.annee_scolaire_id = $annee_scolaire;"
            );
            $nbr_note_confermed = $stmt->fetchAll('assoc')[0]['nbr_note'];
            $stmt = $conn->execute(
                "SELECT COUNT(n.id) AS nbr_note
                        FROM notes n, etudiers e
                        WHERE n.confirmed = 1 AND
                        n.note_ratt IS NOT NULL AND
                        n.element_id = 10 AND
                        n.etudier_id = e.id AND 
                        e.annee_scolaire_id = 1"
            );
            $nbr_note = $stmt->fetchAll('assoc')[0]['nbr_note'];
            return $nbr_note_confermed == $nbr_note;
        }
    }

    private function getSchoolId()
    {
        $annee_lib = $this->generateSchoolYear();
        $conn = ConnectionManager::get('default');
        $row = $conn->execute(
            "SELECT a.id FROM annee_scolaires a WHERE a.libile = '$annee_lib'"
        );
        return $row->fetchAll('assoc')[0]['id'];
    }

    private function getModels($prof_id, $classe_id)
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT DISTINCT m.* 
                        FROM modules m, elements e, enseigners ens
                        WHERE e.module_id = m.id AND 
                        e.id IN (SELECT ens.element_id FROM enseigners ens WHERE ens.vacataire_id = $prof_id)
                        AND m.groupe_id = $classe_id
                        GROUP BY(m.id)"
        );

        return  $stmt->fetchAll('assoc');
    }

    private function getElements($prof_id, $modele_id)
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT DISTINCT e.* 
                        FROM modules m, elements e, enseigners ens 
                        WHERE e.id IN (SELECT DISTINCT ens.element_id FROM enseigners ens WHERE ens.vacataire_id = $prof_id) AND 
                        m.id = $modele_id AND 
                        e.module_id = m.id 
                        GROUP BY(e.id)"
        );

        return  $stmt->fetchAll('assoc');
    }

    private function count_students_have_note($element_id)
    {
        $conn = ConnectionManager::get('default');
        if ($this->isRattrapage($element_id)) {
            $stmt = $conn->execute(
                "SELECT count(et.id) AS nbr_etudiant_note
                            FROM notes n, elements el, etudiants et , etudiers e 
                            WHERE el.id = $element_id AND 
                            n.element_id = el.id AND 
                            et.id = e.etudiant_id AND
                            e.id = n.etudier_id AND 
                            n.ratt_confirmed = 1"
            );

            return  $stmt->fetchAll('assoc');
        } else {
            $stmt = $conn->execute(
                "SELECT count(et.id) AS nbr_etudiant_note
                            FROM notes n, elements el, etudiants et , etudiers e 
                            WHERE el.id = $element_id AND 
                            n.element_id = el.id AND 
                            et.id = e.etudiant_id AND
                            e.id = n.etudier_id AND 
                            n.confirmed = 1"
            );

            return  $stmt->fetchAll('assoc');
        }
    }

    private function count_students_in_element($classe_id, $element_id)
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT count(et.id) AS nombre_etudiants
                        FROM etudiers e, elements el, etudiants et 
                        WHERE el.id = $element_id AND 
                        e.element_id = el.id AND 
                        et.id = e.etudiant_id AND 
                        e.groupe_id = $classe_id"
        );

        return  $stmt->fetchAll('assoc');
    }

    private function note_min_max_avg($element_id)
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT MAX(n.note) AS note_max, MIN(n.note) AS note_min, AVG(n.note) AS note_moyen
                        FROM notes n, elements el, etudiants et , etudiers e 
                        WHERE el.id = $element_id AND 
                        n.element_id = el.id AND 
                        et.id = e.etudiant_id AND
                        e.id = n.etudier_id AND 
                        n.confirmed = 1"
        );

        return  $stmt->fetchAll('assoc');
    }

    private function exportCsv($element_id)
    {
        $name = "Note_".date("H-i-s");
        $conn = ConnectionManager::get('default');
        $path_tmp =  getenv("HOMEDRIVE").getenv("HOMEPATH")."\Desktop";
        $path = str_replace("\\", "/", $path_tmp);
        if ($conn->execute(
            "SELECT 'CNE', 'Nom', 'Prenom', 'Element', 'Note', 'Note Rattrapage'
                UNION ALL
                SELECT et.cne , et.nom_fr, et.prenom_fr, el.libile, n.note, n.note_ratt
                FROM notes n, elements el, etudiants et , etudiers e 
                WHERE el.id = $element_id AND 
                n.element_id = el.id AND
                et.id = e.etudiant_id AND 
                e.id = n.etudier_id 
                INTO OUTFILE '$path/$name.csv'
                FIELDS TERMINATED BY ','
                ENCLOSED BY '\"'
                LINES TERMINATED BY '\n'"
        )) {
            return true;
        } else {
            return false;
        }
    }

    private function get_all_modeles($prof_id, $_class_id)
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT DISTINCT m.* "
            . "FROM modules m, elements e, enseigners ens "
            . "WHERE e.module_id = m.id AND "
            . "e.id IN (SELECT ens.element_id FROM enseigners ens WHERE ens.vacataire_id = $prof_id) "
            . "AND m.groupe_id = $_class_id "
            . "GROUP BY(m.id)"
        );
        return $stmt->fetchAll('assoc');
    }

    private function get_all_elements($prof_id, $_model_id)
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT DISTINCT e.* "
            . "FROM modules m, elements e, enseigners ens "
            . "WHERE e.id IN (SELECT DISTINCT ens.element_id FROM enseigners ens WHERE ens.vacataire_id = $prof_id) AND "
            . "m.id = $_model_id AND "
            . "e.module_id = m.id "
            . "GROUP BY(e.id)"
        );
        return $stmt->fetchAll('assoc');
    }


    /************ fin benchayda ********/


    /******* FADILI  ********/

    //******fadili****
    public function getDestinataire($typeD)
    {
        $usrole=$this->Auth->user('role');
        $this->set('role', $usrole);
        $cnx=ConnectionManager::get('default');
        $usrID=$this->Auth->user('id');
        $monIdDsMaTable = $cnx->execute("SELECT id FROM vacataires WHERE user_id = $usrID ")->fetchAll('assoc');
        $monIdDsMaTable = $monIdDsMaTable['0']['id'];
        $session = $this->request->session();
        if (strcmp($typeD, 'etudiantSpecifie') == 0) {
            $year = $this->genererAnneeScol();
            $semestre = $this->genererSemester();
            $typeDest = $cnx->execute("SELECT DISTINCT grp.id, f.libile as filiere, n.libile as niveau, s.libile as semestre
          FROM elements elt, modules m, semestres s, groupes grp,
          filieres f, niveaus n, vacataires p, enseigners ens, annee_scolaires a
          WHERE 
                p.id = $monIdDsMaTable  AND p.id = ens.vacataire_id AND elt.id = ens.element_id  AND m.id = elt.module_id
          AND   grp.id = m.groupe_id AND n.id = grp.niveaus_id and ens.semestre_id = s.id and (s.id like $semestre[0] OR s.id like $semestre[1]
          OR   s.id like $semestre[2]) and f.id = grp.filiere_id and ens.annee_scolaire_id = a.id and a.libile like '$year'
           
           ")->fetchAll('assoc');
            $session->write('typeDest', $typeDest);
            $this->set('filierID', -1);
        } //$typeDest = $cnx->execute("SELECT id, username FROM users WHERE role like 'respofinance' ")->fetchAll('assoc');
        if (strcmp($typeD, 'scolarite') == 0) {
            $typeDest = $cnx->execute("SELECT id, username FROM users WHERE role like 'resposcolarite' ")->fetchAll('assoc');
        }

        if (strcmp($typeD, 'etudiants') == 0) {
            $year = $this->genererAnneeScol();
            $semestre = $this->genererSemester();
            $typeDest = $cnx->execute("
                SELECT DISTINCT grp.id, f.libile as filiere, n.libile as niveau, s.libile as semestre
          FROM elements elt, modules m, semestres s, groupes grp,
          filieres f, niveaus n, vacataires p, enseigners ens, annee_scolaires a
          WHERE 
                p.id = $monIdDsMaTable  AND p.id = ens.vacataire_id AND elt.id = ens.element_id  AND m.id = elt.module_id
          AND   grp.id = m.groupe_id AND n.id = grp.niveaus_id and ens.semestre_id = s.id and (s.id like $semestre[0] OR s.id like $semestre[1]
          OR   s.id like $semestre[2]) and f.id = grp.filiere_id and ens.annee_scolaire_id = a.id 
          and a.libile like '$year'
               ")->fetchAll('assoc');
        }


        $this->set('typeDest', $typeDest);
        $this->set('selected', $typeD);
        $this->render('/Espaces/profvacataires/envoyerNvVac');
    }
    public function getEtudiantsParFiliere($grpID)
    {
        $session = $this->request->session();
        $cnx=ConnectionManager::get('default');
        $typeD = 'etudiantSpecifie';
        $listEtudiants = $cnx->execute("SELECT DISTINCT u.id, e.nom_fr as nom, e.prenom_fr as prenom
                  FROM etudiants e, etudiers etu, groupes grp, filieres f, niveaus n, users u
                  WHERE
                        u.id = e.user_id AND e.id = etu.etudiant_id AND etu.groupe_id =(SELECT id FROM groupes WHERE id = $grpID) ORDER BY nom

                   ")->fetchAll('assoc');


        $this->set('listE', $listEtudiants);
        $this->set('typeDest', $session->read('typeDest'));
        $this->set('selected', 'etudiantSpecifie');
        $this->set('filierID', $grpID);
        $usrole=$this->Auth->user('role');
        $this->set('role', $usrole);
        $this->render('/Espaces/profvacataires/envoyerNvPer');
    }

    public function boiteRecVac()
    {
        $cnx=ConnectionManager::get('default');
        $usrole=$this->Auth->user('role');
        $this->set('role', $usrole);
        $monid = $this->Auth->user('id');
        $monIdDsMaTable = $cnx->execute("SELECT id FROM vacataires WHERE user_id = $monid ")->fetchAll('assoc');
        $monIdDsMaTable = $monIdDsMaTable['0']['id'];
        Time::setToStringFormat('yyyy-MM-dd HH:mm:ss');
        $semestre = $this->genererSemester();
        $year = $this->genererAnneeScol();

        $mesMessages=$cnx->execute("
        SELECT u.username, role, m.sujet, m.contenu, TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date
        FROM users_messages umg, messages m, users u
        where umg.user_id = u.id and umg.message_id  = m.id and umg.user_idrecepteur = $monid and role like 'resposcolarite'
        and m.id NOT IN (SELECT DISTINCT message_id FROM asupprimer WHERE user_id = $monid)
        union
        SELECT CONCAT_WS(' ', e.nom_fr, e.prenom_fr) AS username, u.role, m.sujet, m.contenu, TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date
        FROM users_messages umg, messages m, users u, etudiants e
        where u.id = e.user_id and umg.user_id = u.id and umg.message_id  = m.id and umg.user_idrecepteur = $monid and e.user_id = u.id and role like 'etudiant'
        and m.id NOT IN (SELECT DISTINCT message_id FROM asupprimer WHERE user_id = $monid)
        UNION 
        SELECT  DISTINCT u.username, u.role, m.sujet, m.contenu, TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date
        FROM diffusions_messages dmg, messages m, users u
        where dmg.user_id = u.id and dmg.message_id  = m.id AND role like 'resposcolarite' and m.id NOT IN (SELECT DISTINCT message_id FROM asupprimer WHERE user_id = $monid) 
        and ((dmg.typerecepteur like 'profsParFiliere' AND 
        dmg.group_id IN (SELECT DISTINCT m.groupe_id FROM vacataires p, enseigners ens, elements as elt, modules m, annee_scolaires a
        WHERE  p.id = ens.vacataire_id and elt.id = ens.element_id and m.id = elt.module_id and p.id = $monIdDsMaTable 
        and a.id = ens.annee_scolaire_id and a.libile like '$year' 
        and ens.semestre_id in ($semestre[0], $semestre[1], $semestre[2])))
        OR (dmg.typerecepteur like 'profsParDept' AND 
               dmg.departement_id IN (SELECT DISTINCT dept.departement_id FROM vacataires_departements dept 
               WHERE  dept.vacataire_id = $monIdDsMaTable )) OR dmg.typerecepteur like 'profs' )
               ORDER BY inttervale
        ")->fetchAll('assoc');
        $this->set('mesMsgs', $mesMessages);

        $this->render('/Espaces/profvacataires/boiteRecVac');
    }

    public function envoyerNvVac()
    {
        $usrole=$this->Auth->user('role');
        $this->set('role', $usrole);
        $this->set('selected', "");
        $this->render('/Espaces/profvacataires/envoyerNvVac');
    }

    public function lireMsgVac($id = 0)
    {
        $cnx=ConnectionManager::get('default');
        $monID = $this->Auth->user('id');
        ;
        $test = explode(".", $id);
        if (strcmp($test[0], 'readSN') == 0 || strcmp($test[0], 'readSD') == 0) {
            $id = $test[1];
            if (strcmp($test[0], 'readSN') == 0) {
                $msg = $cnx->execute("
                SELECT m.id, m.sujet, m.contenu, m.piecejointe, um.date, u.username, role FROM messages m, users_messages um, users u 
                WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID and m.id = $id and role like 'resposcolarite'
              UNION 
                SELECT m.id, m.sujet, m.contenu, m.piecejointe, um.date, CONCAT_WS(' ', e.nom_fr, e.prenom_fr) AS username, u.role FROM messages m, users_messages um, users u, etudiants e
                WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID and m.id = $id AND e.user_id = u.id and role like 'etudiant'
            ")->fetchAll('assoc');
            } else {
                $msg = $cnx->execute("
            SELECT m.id, m.sujet, m.contenu, m.piecejointe, dm.date,CONCAT_WS(' ', n.libile, f.libile) AS username, role 
            FROM messages m, diffusions_messages dm, groupes grp, filieres f, niveaus n, users u
            WHERE u.id = $monID and m.id = dm.message_id and dm.user_id = $monID and typerecepteur like 'etudiantsParFiliere' and grp.id = dm.group_id and grp.filiere_id = f.id 
            and grp.niveaus_id = n.id and m.id = $id
            ")->fetchAll('assoc');
            }
            $this->set('me', 'me');
        } else {
            $this->set('me', '');
            $msg = $cnx->execute("
        SELECT u.username, role, m.sujet, m.contenu, m.piecejointe , TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
        FROM users_messages umg, messages m, users u
        where umg.user_id = u.id and umg.message_id  = m.id and m.id = $id and role like 'resposcolarite'
        UNION 
         SELECT CONCAT_WS(' ', e.nom_fr, e.prenom_fr) AS username, u.role, m.sujet, m.contenu, m.piecejointe , TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
        FROM users_messages umg, messages m, users u, etudiants e
        where umg.user_id = u.id and e.user_id = u.id and umg.message_id  = m.id and m.id = $id AND e.user_id = u.id and role like 'etudiant'
        ")->fetchAll('assoc');

            if ($msg == null) {
                $msg = $cnx->execute("
        SELECT  us.username, role, ms.sujet, ms.contenu, ms.piecejointe , TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,ms.id, date 
        FROM diffusions_messages dmg, messages ms, users us
        where dmg.user_id = us.id and dmg.message_id  = ms.id and ms.id = $id and role like 'resposcolarite'
        UNION 
        SELECT CONCAT_WS(' ', e.nom_fr, e.prenom_fr) AS username, us.role, ms.sujet, ms.contenu, ms.piecejointe , TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,ms.id, date 
        FROM diffusions_messages dmg, messages ms, users us, etudiants e
        where dmg.user_id = us.id and dmg.message_id  = ms.id and ms.id = $id AND e.user_id = us.id and role like 'etudiant'
        ")->fetchAll('assoc');
            }
        }
        $this->set('msgs', $msg);
        $usrole=$this->Auth->user('role');
        $this->set('role', $usrole);
        $this->render('/Espaces/profvacataires/lireMsgVac');
    }

    public function envoyermsg()
    {
        $cnx=ConnectionManager::get('default');
        $usrole=$this->Auth->user('role');
        $this->set('role', $usrole);

        $detinateur = $this->Auth->user('id');
        $sujet = $this->request->getData('sujet');
        $contenu = $this->request->getData('contenu');
        $msg=$cnx->execute("SELECT MAX(id) as id FROM messages ")->fetchAll('assoc');

        $nomFichier = $this->request->getData('attachment')["name"];
        $nomFichier = $this->suppAccent($nomFichier);
        if (strcmp($this->request->getData('attachment')["name"], '') != 0) {
            $attachementPath = "/ensaksite/webroot/messageriesFiles/" . $msg['0']['id'] . $nomFichier;
            move_uploaded_file($this->request->getData('attachment')["tmp_name"], 'messageriesFiles/'.$msg['0']['id'].$nomFichier);
        } else {
            $attachementPath = '';
        }

        $cnx->insert(
            'messages',
            [
                'sujet' => $sujet,
                'contenu' => $contenu,
                'piecejointe' => $attachementPath
            ]
        );

        $msg=$cnx->execute("SELECT MAX(id) as id FROM messages ")->fetchAll('assoc');
        Time::setToStringFormat('yyyy-MM-dd HH:mm:ss');
        $dest = explode("*", $this->request->getData('destinataire'));
        if (strcmp($dest[0], 'etudiants') == 0) {
            // recepteur => etudiants par filièreProf
            $typerecepteur = 'etudiantsParFiliere';

            $dest = $cnx->execute("SELECT DISTINCT grp.id FROM groupes grp, filieres f, niveaus n 
              WHERE grp.niveaus_id = (SELECT niv.id FROM niveaus niv WHERE niv.libile like '$dest[2]')
               AND grp.filiere_id = (SELECT fil.id FROM filieres fil WHERE fil.libile like '$dest[1]') ")->fetchAll('assoc');

            $groupID = $dest[0]['id'];
            $deptID = null;
            $cnx->insert(
                'diffusions_messages',
                [
                    'message_id' => $msg['0']['id'],
                    'user_id' => $detinateur,
                    'typerecepteur' => $typerecepteur,
                    'group_id' => $groupID,
                    'departement_id' => $deptID,
                    'date'=> Time::now()
                ]
            );
        } else {
            $session = $this->request->session();
            $session->delete('typeDest');
            // recepteur => respo scolarité
            $cnx->insert(
                'users_messages',
                [
                        'message_id' => $msg['0']['id'],
                        'user_id' => $detinateur,
                        'user_idrecepteur' => $this->request->getData('destinataire'),
                        'date' => Time::now()
                    ]
            );
        }
        $this->Flash->success('Votre message est envoyé');
        $this->boiteRecVac();
    }


    public function getMsgsEnvoye()
    {
        $cnx=ConnectionManager::get('default');
        $monID = $this->Auth->user('id');
        $mesMsgsN = $cnx->query("
            SELECT m.id, m.sujet, m.contenu, m.piecejointe, um.date, u.username, role FROM messages m, users_messages um, users u 
            WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID and role like 'resposcolarite'
            UNION 
            SELECT m.id, m.sujet, m.contenu, m.piecejointe, um.date, CONCAT_WS(' ', e.nom_fr, e.prenom_fr) AS username, u.role FROM messages m, users_messages um, users u, etudiants e
            WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID  AND e.user_id = u.id and role like 'etudiant' ORDER BY date
            
            ")->fetchAll('assoc');

        $mesMsgsDiff = $cnx->query("
            SELECT m.id, m.sujet, m.contenu, m.piecejointe, dm.date,CONCAT_WS(' ', n.libile, f.libile) AS username, role
            FROM messages m, diffusions_messages dm, groupes grp, filieres f, niveaus n, users u
            WHERE u.id = $monID and m.id = dm.message_id and dm.user_id = $monID and typerecepteur like 'etudiantsParFiliere' and grp.id = dm.group_id and grp.filiere_id = f.id
            and grp.niveaus_id = n.id ORDER BY date
            ")->fetchAll('assoc');
        $this->set('mesMsgsN', $mesMsgsN);
        $this->set('mesMsgsDiff', $mesMsgsDiff);
        $this->set('displaySent', "sent");
        $this->boiteRecVac();
    }

    public function supprimerMsg()
    {
        // debug($this->request->getData('msgChecked'));
        $deletTab = $this->request->getData('msgChecked');
        if (count($deletTab) > 0) {
            $cnx = ConnectionManager::get('default');
            foreach ($deletTab as $delM) {
                $cnx->insert(
                    'asupprimer',
                    [
                        'message_id' => $delM,
                        'user_id' => $this->Auth->user('id'),
                    ]
                );
            }
            $this->Flash->success('Supprimé avec succes');
        } else {
            $this->Flash->error('Veuillez séléctionner au moins un message!');
        }
        $this->boiteRecVac();
    }
    
    
    public function suppAccent($chaine)
    {
        $a = array("ä", "â", "à");
        $chaine = str_replace($a, "a", $chaine);


        $e = array("é", "è", "ê", "ë");
        $chaine = str_replace($e, "e", $chaine);

        $c = array("ç");
        $chaine = str_replace($c, "c", $chaine);

        return $chaine;
    }
    public function genererAnneeScol()
    {
        $year = (int)date("Y");
        $month = (int)date("m");
 
        if ($month <= 6) {
            $y1 = $year-1;
            return $y1.'/'.$year;
        } else {
            $y1 = $year+1;
            return $year.'/'.$y1;
        }
    }

    public function genererSemester()
    {
        $month = (int)date("m");
        if ($month >= 9 || $month < 2) {
            return array(1, 3, 5);
        } else {
            return array(2, 4, 6);
        }
    }

    //******fadili****
    /******* FIN FADILI  ********/


    /****** BADR   ********/

    public function hamdihajarselectreservation()
    {
        $usid=$this->Auth->user('id');
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $reservation = $con->execute('SELECT reservations.id as id,books.titre as titre,books.numInventaire as numInventaire,reservations.dateReservation as dateReservation,reservations.delai as delai, sous_categories.nom as categorie FROM books,reservations,sous_categories WHERE books.id=reservations.book_id AND Sous_Categories.id IN(SELECT sous_categorie_id FROM books WHERE books.id=reservations.book_id) AND reservations.user_id=?', [$usid])->fetchAll('assoc');
        $this->set('reservation', $reservation);
        $this->render('/Espaces/profvacataires/hamdihajarselectreservation');
    }
    public function hamdihajarannulerreservation($id = null)
    {
        $this->request->allowMethod(['post', 'Annuler']);
        $reservations = TableRegistry::get('Reservations');
        $reservation = $reservations->get($id);
        if ($reservations->delete($reservation)) {
            $this->Flash->success(__("la reservation a ete supprimer.", 'reservation'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'reservation'));
        }
        return $this->redirect(['action' => 'hamdihajarselectreservation']);
        $this->render('/Espaces/profpermanents/hamdihajarselectreservation');
    }

    public function listbook()
    {
        //ELAMMARI Soufiane
        $this->paginate = [
            'contain' => ['SousCategories'],
            'limit' => 1000
        ];

        $con = ConnectionManager::get('default');
        $choix = $con->execute("SELECT sous_categories.nom  FROM sous_categories")->fetchAll('assoc');
        ;// where id in (select sous_categorie_id from books)")
        $books = $con->execute("SELECT * FROM books WHERE id IN ( SELECT min(id) FROM books GROUP BY ISBN )")->fetchAll('assoc');
        ;// where id in (select sous_categorie_id from books)")
        $this->set('books', $books);
        $this->set('choix', $choix);
        $this->render('/Espaces/profvacataires/listbook');
    }

    public function listcategorie()
    {
        //ELAMMARI Soufiane

        $this->paginate = [
            'contain' => ['SousCategories'],
            'limit' => 1000
        ];
        $con = ConnectionManager::get('default');
        $books1 = $con->execute("SELECT * FROM books where sous_categorie_id in (select id from sous_categories where categorie_id =100) and id IN ( SELECT min(id) FROM books GROUP BY ISBN )")->fetchAll('assoc');
        $this->set('books1', $books1);
        $books2 = $con->execute("SELECT * FROM books where sous_categorie_id in (select id from sous_categories where categorie_id =200) and id IN ( SELECT min(id) FROM books GROUP BY ISBN )")->fetchAll('assoc');
        $this->set('books2', $books2);
        $books3 = $con->execute("SELECT * FROM books where sous_categorie_id in (select id from sous_categories where categorie_id =300) and id IN ( SELECT min(id) FROM books GROUP BY ISBN )")->fetchAll('assoc');
        $this->set('books3', $books3);
        $books4 = $con->execute("SELECT * FROM books where sous_categorie_id in (select id from sous_categories where categorie_id =400)and id IN ( SELECT min(id) FROM books GROUP BY ISBN )")->fetchAll('assoc');
        $this->set('books4', $books4);
        $books5 = $con->execute("SELECT * FROM books where sous_categorie_id in (select id from sous_categories where categorie_id =500) and id IN ( SELECT min(id) FROM books GROUP BY ISBN )")->fetchAll('assoc');
        $this->set('books5', $books5);
        $books6 = $con->execute("SELECT * FROM books where sous_categorie_id in (select id from sous_categories where categorie_id =600) and id IN ( SELECT min(id) FROM books GROUP BY ISBN )")->fetchAll('assoc');
        $this->set('books6', $books6);
        $this->render('/Espaces/profvacataires/listcategorie');
    }

    public function recherchebook()
    {
        //ELAMMARI Soufiane

        if ($this->request->is(['post'])) {
            $search = $this->request->data('search');
        }
        $con = ConnectionManager::get('default');
        $books = $con->execute("SELECT * FROM books where titre  like '%" . $search . "%'   and id IN ( SELECT min(id) FROM books GROUP BY ISBN )")->fetchAll('assoc');
        $this->set('books', $books);
        $this->Flash->success(__('Votre recherche a bien été effectué : '.count($books).' de éléments trouvés'));
        $this->render('/Espaces/profvacataires/recherchebook');
    }


    public function recherchecatbook()
    {
        //ELAMMARI Soufiane
        if ($this->request->is(['post'])) {
            $search = $this->request->data['choix'];
        }
        $con = ConnectionManager::get('default');
        $books = $con->execute("SELECT * FROM books where sous_categorie_id in (select id from sous_categories WHERE nom='" . $search . "' ) and id IN ( SELECT min(id) FROM books GROUP BY ISBN )")->fetchAll('assoc');
        $this->set('books', $books);
        $this->set('search', $search);
        $this->Flash->success(__('Votre recherche a bien été effectué : '.count($books).' de éléments trouvés'));
        $this->render('/Espaces/profvacataires/recherchebook');
    }


    public function proposerbook()
    {

        //ELAMMARI Soufiane
        $con = ConnectionManager::get('default');

        if ($this->request->is(['post'])) {
            $search = $this->request->data();
            $nomPhoto = $_FILES['fichier']['name'];
            $fichierTemporaire = $_FILES['fichier']['tmp_name'];
            move_uploaded_file($fichierTemporaire, "'../../img/books/$nomPhoto");
            $con->execute("INSERT INTO proposition (id, nom, prenom, code, role, email, resumer, fichier, jugement,id_user) VALUES 
          (NULL, '" . $search['nom'] . "', '" . $search['prenom'] . "', '" . $search['cne'] . "', '" .  $this->Auth->user('role') . "', '" . $search['email'] . "', '" . $search['champ'] . "','" . $nomPhoto . "','" . $search['choix'] . "',".$this->Auth->user('id'). ");");
            $this->Flash->success(__('Les données de votre proposition ont bien été transmises'));
        }
        $usrole = $this->Auth->user('id');
        $coord = $con->execute("SELECT users.id, vacataires.somme,vacataires.nom_vacataire as nom,vacataires.prenom_vacataire as prenom FROM users,vacataires where 
                users.id=vacataires.user_id and users.id =" . $usrole . "")->fetchAll('assoc');
        $this->set('coord', $coord);

        $this->render('/Espaces/profvacataires/proposerbook');
    }


    public function votebook()
    {
        $con = ConnectionManager::get('default');
        //ELAMMARI Soufiane
        if ($this->request->is(['post'])) {
            $vote = $this->request->data();
        }
        $test = $con->execute("SELECT COUNT(*) AS a  FROM vote_books where id_user=" .$this->Auth->user('id'). " and id_book =" .$_SESSION['detail']. " ")->fetchAll('assoc');
        $v=$test[0]['a'];
        if ($v==0) {
            $con->execute("INSERT INTO vote_books (id_user, id_book,vote) VALUES 
          ( '" . $this->Auth->user('id') . "', '" . $_SESSION['detail'] . "',0);");
        } else {
            $con->execute("update vote_books set vote=1 where id_user='".$this->Auth->user('id')."' and id_book =" .$_SESSION['detail']. ";");
        }
        $books = $con->execute("SELECT books.id ,books.titre,books.auteur,books.edition,books.resumer,books.image,books.ISBN,books.numInventaire,books.nbExemplaire ,sous_categories.nom FROM books ,sous_categories where books.sous_categorie_id=sous_categories.id and  books.id =" .$_SESSION['detail']. " ")->fetchAll('assoc');
        $_SESSION['book_vote']=$books;
        $vote = $con->execute("SELECT  vote FROM vote_books where id_user =" . $this->Auth->user('id') . "  and  id_book=".$_SESSION['detail']."")->fetchAll('assoc');
        $_SESSION['vote']=$vote;
        $reserve=$con->execute('SELECT count(*) as sum FROM reservations WHERE user_id=?', [$this->Auth->user('id')])->fetchAll('assoc');
        $role=$con->execute('SELECT role FROM users where id=?', [$this->Auth->user('id')])->fetchAll('assoc');
        switch ($role[0]['role']) {
            case 'etudiant':
                $condition = $con->execute('SELECT maxEtud AS max FROM parametres')->fetchAll('assoc');
                break;
            case 'vacataire':
                $condition = $con->execute('SELECT maxProfVac AS max FROM parametres')->fetchAll('assoc');
                break;
            case 'profpermanent':
                $condition = $con->execute('SELECT maxProfPer AS max FROM parametres')->fetchAll('assoc');
                break;
        }
        if ($reserve[0]['sum']<$condition[0]['max']) {
            $reserve[0]['sum']=0;
        } else {
            $reserve[0]['sum']=1;
        }
        $_SESSION['reserve']=$reserve;
        $this->set('reserve', $_SESSION['reserve']);

        $this->set('books', $_SESSION['book_vote']);
        $this->set('vote', $_SESSION['vote']);
        $nombrereserve1=$_SESSION['nombrereserve1'];
        $this->set('nombrereserve1', $nombrereserve1);


        $nombremprunte1=$_SESSION['nombremprunte1'];
        $this->set('nombremprunte1', $nombremprunte1);

        $this->Flash->success(__('vous avez  bien voté sur cet ouvrage '));
        $this->render('/Espaces/profvacataires/detailbook');
    }
    public function detailbook()
    {
        //ELAMMARI Soufiane
        $con = ConnectionManager::get('default');
        if ($this->request->is(['post'])) {
            $detail = $this->request->data['detail'];
            $_SESSION['detail']=$detail;
            $books = $con->execute("SELECT books.id ,books.titre,books.auteur,books.edition,books.resumer,books.image,books.ISBN,books.numInventaire,books.nbExemplaire ,sous_categories.nom FROM books ,sous_categories where books.sous_categorie_id=sous_categories.id and  books.id =" .$_SESSION['detail']. " ")->fetchAll('assoc');
            $this->set('books', $books);
        }
        $test = $con->execute("SELECT COUNT(*) AS a  FROM vote_books where id_user=" .$this->Auth->user('id'). " and id_book =" .$_SESSION['detail']. " ")->fetchAll('assoc');
        $v=$test[0]['a'];
        if ($v==0) {
            $con->execute("INSERT INTO vote_books (id_user, id_book,vote) VALUES 
          ( '" . $this->Auth->user('id') . "', '" . $_SESSION['detail'] . "',0);");
        }
        $vote = $con->execute("SELECT  vote FROM vote_books where id_user =" . $this->Auth->user('id') . "  and  id_book=".$_SESSION['detail']."")->fetchAll('assoc');
        $_SESSION['vote']=$vote;
        $nombrereserve = $con->execute("SELECT COUNT(*) AS a  FROM reservations where book_id =" .$_SESSION['detail']. " ")->fetchAll('assoc');
        $nombrereserve1=$nombrereserve[0]['a'];
        $_SESSION['nombrereserve1']= $nombrereserve1;
        $this->set('vote', $_SESSION['vote']);

        $reserve=$con->execute('SELECT count(*) as sum FROM reservations WHERE user_id=?', [$this->Auth->user('id')])->fetchAll('assoc');
        $role=$con->execute('SELECT role FROM users where id=?', [$this->Auth->user('id')])->fetchAll('assoc');
        switch ($role[0]['role']) {
            case 'etudiant':
                $condition = $con->execute('SELECT maxEtud AS max FROM parametres')->fetchAll('assoc');
                break;
            case 'vacataire':
                $condition = $con->execute('SELECT maxProfVac AS max FROM parametres')->fetchAll('assoc');
                break;
            case 'profpermanent':
                $condition = $con->execute('SELECT maxProfPer AS max FROM parametres')->fetchAll('assoc');
                break;
        }
        if ($reserve[0]['sum']<$condition[0]['max']) {
            $reserve[0]['sum']=0;
        } else {
            $reserve[0]['sum']=1;
        }
        $_SESSION['reserve']=$reserve;
        $this->set('reserve', $_SESSION['reserve']);






        $nombremprunte = $con->execute("SELECT COUNT(*) AS a  FROM users_books where book_id =" .$_SESSION['detail']. " ")->fetchAll('assoc');
        $nombremprunte1=$nombremprunte [0]['a'];

        $_SESSION['nombremprunte1']= $nombremprunte1;
        $this->set('nombremprunte1', $nombremprunte1);






        $this->set('nombrereserve1', $nombrereserve1);
        $this->render('/Espaces/profvacataires/detailbook');
    }



    public function reserverbook()
    {
        $con = ConnectionManager::get('default');
        if ($this->request->is(['post'])) {
            $reserve=$con->execute('SELECT * FROM reservations WHERE user_id=? AND book_id=?', [$this->Auth->user('id'),$_SESSION['detail']])->fetchAll('assoc');
            if (count($reserve)!=0) {
                $this->Flash->error(__("Ouvrage déja reserver"));
            } else {
                $getisbn=$con->execute('SELECT ISBN FROM books WHERE id=?', [$_SESSION['detail']])->fetchAll('assoc');
                $getID=$con->execute('SELECT id FROM books WHERE ISBN =?', [$getisbn[0]['ISBN']])->fetchAll('assoc');
                for ($i=0; $i<count($getID); $i++) {
                    $reserver=$con->execute('SELECT * FROM reservations WHERE book_id = ?', [$getID[$i]['id']])->fetchAll('assoc');
                    if (count($reserver)==0) {
                        $emprunt=$con->execute('SELECT * FROM users_books WHERE book_id = ?', [$getID[$i]['id']])->fetchAll('assoc');
                        if (count($emprunt)==0) {
                            $condition = $con->execute('SELECT dureeReservation AS delai FROM parametres')->fetchAll('assoc');
                            $date = date_create(date("Y-m-d H:i:s"));
                            $date1=date_add($date, date_interval_create_from_date_string($condition[0]['delai']." days"));
                            $date=date_format($date1, 'Y-m-d H:i:s');
                            $con->execute('INSERT INTO reservations (book_id,user_id,delai) VALUES (?,?,?)', [$getID[$i]['id'],$this->Auth->user('id'),$date]);
                            break;
                        }
                    }
                }
            }
        }
        return $this->redirect(['action' => 'hamdihajarselectreservation']);
        $this->render('/Espaces/profvacataires/detailbook');
    }
    /////// Version 2
    public function majdaselectempreinte()
    {
        $usid=$this->Auth->user('id');
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) {
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie', $categorie);
        if ($this->request->is('post')) {
            $empreinte = $con->execute('SELECT books.titre,books.auteur,books.ISBN,books.numInventaire,users_books.dateEmprunte,users_books.delai FROM books,users_books WHERE books.id=users_books.book_id AND users_books.user_id=? AND books.sous_categorie_id IN (SELECT id FROM sous_categories WHERE categorie_id IN (SELECT id FROM categories WHERE id=? ))', [$usid,$categorieId[$this->request->data['categorie']]])->fetchAll('assoc');
            $this->set('empreinte', $empreinte);
        } else {
            $empreinte = $con->execute('SELECT books.titre,books.auteur,books.ISBN,books.numInventaire,users_books.dateEmprunte,users_books.delai FROM books,users_books WHERE books.id=users_books.book_id AND users_books.user_id=?', [$usid])->fetchAll('assoc');
            $this->set('empreinte', $empreinte);
        }
        $this->render('/Espaces/profvacataires/majdaselectempreinte');
    }


    public function majdaselecteHistorique()
    {
        $usid=$this->Auth->user('id');
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) {
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie', $categorie);
        if ($this->request->is('post')) {
            $hempreinte = $con->execute('SELECT books.titre,books.auteur,books.ISBN,books.numInventaire,historiqueemprunte.dateEmprunte,historiqueemprunte.dateRetour FROM books,historiqueemprunte WHERE books.id=historiqueemprunte.book_id AND historiqueemprunte.user_id= ? AND books.sous_categorie_id IN (SELECT id FROM sous_categories WHERE categorie_id IN (SELECT id FROM categories WHERE id=? ))', [$usid,$categorieId[$this->request->data['categorie']]])->fetchAll('assoc');
            $this->set('hempreinte', $hempreinte);
        } else {
            $hempreinte = $con->execute('SELECT books.titre,books.auteur,books.ISBN,books.numInventaire,historiqueemprunte.dateEmprunte,historiqueemprunte.dateRetour FROM books,historiqueemprunte WHERE books.id=historiqueemprunte.book_id AND historiqueemprunte.user_id=?', [$usid])->fetchAll('assoc');
            $this->set('hempreinte', $hempreinte);
        }
        $this->render('/Espaces/profvacataires/majdaselecteHistorique');
    }
    ////// fin version 2

    /****** Fin Badr ********/


    /**** Omar *****/

    public function saisienbheures()
    {
        $this->loadModel('Vacations');
        $this->loadModel('Vacataires');
        $quer = $this->Vacataires->find()
            ->where(['user_id' => $this->Auth->user('id')]);
        foreach ($quer as $row) {
            if ($row->id) {
                $vacataire=$row; }}
        
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
                } }
            if ($bol) {
                $this->Flash->error(__('ce mois deja remplis '));
            } elseif ($this->Vacations->save($vacation)) {
                $this->Flash->success(__('The vacation has been saved.'));

                return $this->redirect(['action' => 'vacations']);
            } else {
                $this->Flash->error(__('The vacation could not be saved. Please, try again.'));
            }
        }
        $vacataires = $this->Vacations->Vacataires->find('list', ['limit' => 200]);
        $paimentvacs = $this->Vacations->Paimentvacs->find('list', ['limit' => 200]);
        $this->set(compact('vacation'));
        $this->set('_serialize', ['vacation']);

        $this->render('/Espaces/respopersonels/saisienbheures');
    }
    public function demandedocs()
    {
        $VacatairesDocuments=TableRegistry::get('VacatairesDocuments');
        $documentsprofesseur = $VacatairesDocuments->newEntity();
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
        //debug($usrid);

        if ($this->request->is('post')) {
            $documentsprofesseur->vacataire_id =$usrid;
            $documentsprofesseur->document_id =$this->request->data('nomDoc');
            //requete pour une demande déja effectué
            $requete = $VacatairesDocuments->find('all', array('conditions' => array('VacatairesDocuments.vacataire_id' => $usrid
            ,   'VacatairesDocuments.document_id' => $this->request->data('nomDoc'))));
            $nombre=0;
            foreach ($requete as $resultat) {
                if ($resultat->etatdemande=='Demande envoyé' or $resultat->etatdemande=='Prete' or $resultat->etatdemande=='En cours de traitement') {
                    $nombre++;
                }
            }
            //debug($nombre);
            $Vacataires=TableRegistry::get('Vacataires');
            $identifiantDoc=$this->request->data('nomDoc');

            switch ($identifiantDoc) {
                case 1:
                {
                    $nbtentativebis=$Vacataires->find('all')->select('etat_attestation')->where(['id'=>$usrid]);
                    foreach ($nbtentativebis as $value) {
                        $nombrebis=$value->etat_attestation;
                    }

                    if ($nombrebis>3) {
                        $this->Flash->error(__('Vous avez dépassé le nombre maximum des attestations , pour plus d\'infos veuillez nous conatcter au service'));
                        break;
                    } elseif ($nombre>=1) {
                        $this->Flash->error(__('Echéc d\'envoi ... Déja vous avez '.$nombre.' demande(s) dans le service, veuillez attender Svp'));
                        break;
                    } elseif ($VacatairesDocuments->save($documentsprofesseur)) {
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
                   // debug($usrid);
                    $nbtentativebis=$vacataires->find('all')->select('etat_fichesalaire')->where(['id'=>$usrid]);
                    foreach ($nbtentativebis as $value) {
                        $nombrebis=$value->etat_attestation;
                    }
                    $nombrebis=count($nbtentativebis);
                    if ($nombrebis>4) {
                        $this->Flash->error(__('Vous avez dépassé le nombre maximum des fiches de salaire, pour plus d\'infos veuillez nous conatcter au service'));
                        break;
                    } elseif ($nombre>=1) {
                        $this->Flash->error(__('Echec d\'envoi ... Déja vous avez '.$nombre.'  demande(s) dans le service , veuillez attender Svp'));
                    } elseif ($VacatairesDocuments->save($documentsprofesseur)) {
                        $nombrebis++;
                        $query=$vacataires->find('all')->update()->set(['etat_fichesalaire' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();
                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['action' => 'indexProf']);
                    } else {
                        $this->Flash->error(__('Demande échouée'));
                    }

                }
            }
        }

        $vacataires = $VacatairesDocuments->vacataires->find('list', ['limit' => 200]);
        $documents = $VacatairesDocuments->Documents->find('list', ['limit' => 200]);
        $this->set('doc', $documentbis);
        $this->set('prof', $profbis);
        $this->set(compact('documentsProfesseur', 'vacataires', 'documents'));
        $this->set('_serialize', ['documentsProfesseur']);
        $this->render('/Espaces/respopersonels/demandedocs');
    }
    public function demanderDocFct()
    {
        $ProfvacatairesDocuments=TableRegistry::get('VacatairesDocuments');
        $documentsProfesseur = $ProfvacatairesDocuments->newEntity();
        $documentbis=TableRegistry::get('Documents');
        $documentbis=$documentbis->find('all');
        $profbis=TableRegistry::get('Vacataires');
        $profbis=$profbis->find('all');
        $idUser=$this->Auth->user('id');
        $profvacataires=TableRegistry::get('Vacataires');
        $query=$profvacataires->find('all')->select('id')->where(['user_id'=>$idUser]);

        foreach ($query as $ligne) {
            $usrid=$ligne->id;
        }

        if ($this->request->is('post')) {
            $documentsProfesseur->vacataire_id =$usrid;
            $documentsProfesseur->document_id =$this->request->data('nomDoc');
            //requete pour une demande déja effectué
            $requete = $ProfvacatairesDocuments->find('all', array('conditions' => array('VacatairesDocuments.Vacataire_id' => $usrid
            ,   'VacatairesDocuments.document_id' => $this->request->data('nomDoc'))));
            $nombre=0;
            foreach ($requete as $resultat) {
                if ($resultat->etatdemande=='Demande envoyé' or $resultat->etatdemande=='Prete' or $resultat->etatdemande=='En cours de traitement') {
                    $nombre++;
                }
            }

            $Profvacataires=TableRegistry::get('Vacataires');
            $identifiantDoc=$this->request->data('nomDoc');

            switch ($identifiantDoc) {
                case 1:
                {
                    $nbtentativebis=$Profvacataires->find('all')->select('etat_attestation')->where(['id'=>$usrid]);
                    foreach ($nbtentativebis as $value) {
                        $nombrebis=$value->etat_attestation;
                    }
                   
                    if ($ProfvacatairesDocuments->save($documentsProfesseur)) {
                        $nombrebis++;
                        $query=$profvacataires->find('all')->update()->set(['etat_attestation' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();

                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['controller'=>'profvacataires','action' => 'index']);
                    } else {
                        $this->Flash->error(__('Demande échouée'));
                    }



                    break;
                }
                case 2:
                {
                    // debug($usrid);
                    $nbtentativebis=$profvacataires->find('all')->select('etat_fiche')->where(['id'=>$usrid]);
                    foreach ($nbtentativebis as $value) {
                        $nombrebis=$value->etat_attestation;
                    }
                    $nombrebis=count($nbtentativebis);
                    
                    if ($ProfvacatairesDocuments->save($documentsProfesseur)) {
                        $nombrebis++;
                        $query=$profvacataires->find('all')->update()->set(['etat_fiche' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();
                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['controller'=>'profvacataires','action' => 'index']);
                    } else {
                        $this->Flash->error(__('Demande echouée'));
                    }

                }
            }
        }

        $profvacataires = $ProfvacatairesDocuments->vacataires->find('list', ['limit' => 200]);
        $documents = $ProfvacatairesDocuments->Documents->find('list', ['limit' => 200]);
        $this->set('doc', $documentbis);
        $this->set('prof', $profbis);
        $this->set(compact('documentsProfesseur', 'profvacataires', 'documents'));
        $this->set('_serialize', ['documentsProfesseur']);
        $this->render('/Espaces/profvacataires/demanderDocFct');
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
    public function vacations()
    {
        $this->loadModel('Vacations');
        $this->loadModel('Vacataires');

        $quer = $this->Vacataires->find()
            ->where(['user_id' => $this->Auth->user('id')]);
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

    /***************/

    /***** mouna ****/

    public function viewmouna($id = null)
    {
        $this->loadModel('Vacataires');
        $usrole=$this->Auth->user('id');
        //debug($usrole);
        $modif = ConnectionManager::get('default');
        $id = $modif->execute("SELECT id FROM vacataires  WHERE user_id=".$usrole."")->fetchAll('assoc');
        //debug($id);

        $profpermanent = $this->Vacataires->get($id[0]['id'], [
            'contain' => []
        ]);
        $this->set('id', $usrole);
        $this->set('profpermanent', $profpermanent);
        $this->render('/Espaces/profvacataires/viewmouna');
    }

    public function editmouna()
    {
        $usrole=$this->Auth->user('id');
        $this->loadModel('Vacataires');
        $modif = ConnectionManager::get('default');
        $id = $modif->execute("SELECT id FROM vacataires  WHERE user_id=".$usrole."")->fetchAll('assoc');
        $id=$id[0]['id'];
        $Profpermanent = TableRegistry::get('vacatairesbis');
        $profpermanentOriginal = $this->Vacataires->get($id);
        $profpermanent = $this->Vacataires->get($id);
        //debug($profpermanent);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $profpermanent = $Profpermanent->newEntity();
            //$profpermanent= $Profpermanent->patchEntity($profpermanent, $this->request->data);
            //debug($profpermanent);
            $profpermanent->somme=$this->request->data('somme');
            $profpermanent->user_id=$profpermanentOriginal->user_id;
            $profpermanent->dateRecrut=$profpermanentOriginal->dateRecrut;
            $profpermanent->dateAffectation=$profpermanentOriginal->dateAffectation;
            $profpermanent->nom_vacataire=$this->request->data('nom_vacataire');
            $profpermanent->prenom_vacataire=$this->request->data('prenom_vacataire');
            $profpermanent->genre=$this->request->data('genre');
            $profpermanent->age=$this->request->data('age');
            $profpermanent->diplome=$this->request->data('diplome');
            $profpermanent->specialite=$this->request->data('specialite');
            $profpermanent->universite=$this->request->data('universite');
            $profpermanent->situationFamiliale=$this->request->data('situationFamiliale');
            $profpermanent->nbr_enfants=$this->request->data('nbr_enfants');
            $profpermanent->dateNaissance=$profpermanentOriginal->dateNaissance;
            $profpermanent->LieuNaissance=$this->request->data('LieuNaissance');
            $profpermanent->CIN=$this->request->data('CIN');
            $profpermanent->email=$this->request->data('email');
            $profpermanent->echelle=$profpermanentOriginal->echelle;
            $profpermanent->echelon=$profpermanentOriginal->echelon;
            $profpermanent->nb_heures=$profpermanentOriginal->nb_heures;
            $profpermanent->codeSituation=1;
            //$profpermanent->date_envoi=$profpermanentOriginal->date_envoi;
            //$profpermanent->isValid=$profpermanentOriginal->isValid;

            //dump($profpermanent);exit;

            if ($Profpermanent->save($profpermanent)) {
                $this->Flash->success(__('Votre demande de modification de données a été envoyée au responsable , veuillez attendre son traitement .
                '));

            //return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Profpermanent'));
            }
        }
        $this->set(compact('profpermanent'));
        $this->render('/Espaces/profvacataires/editmouna');
    }


public function demanderabsencesb()
    {
        $_SESSION['auto'] = "none";
        $user_id = $this->Auth->user('id');
        $con=ConnectionManager::get('default');

        $id = $con->execute("SELECT id FROM vacataires WHERE user_id = $user_id")->fetchAll('assoc');
        $prof_id = $id[0]['id'];

        $nbr = $con->execute("SELECT COUNT(*) as n FROM vacataires_absences WHERE vacataire_id  = $prof_id")->fetchAll('assoc');
        $duree = $con->execute("SELECT duree_ab FROM vacataires_absences WHERE vacataire_id  = $prof_id")->fetchAll('assoc');
        $d =0;
        for ($i=0; $i < $nbr[0]['n']; $i++)
        {
            $d += $duree[$i]['duree_ab'];
        }

        if(isset($_POST['submit']))
        {

            $duree_ab = $_POST['duree_ab'];
            $cause = $_POST['cause'];
            $date_ab = $_POST['date'];

            if (empty($_POST['time']))
            {
               // $time_ab = 08;

            }
            else
            {
                $time_ab = $_POST['time'];
            }

            if($d>'13')
            {
                $_SESSION['auto'] ="no";
            }
            else
            {
                $_SESSION['auto'] ="yes";
                $con->execute("INSERT INTO vacataires_absences (vacataire_id  ,duree_ab,cause,date_ab,time_ab) VALUES ($prof_id,$duree_ab,'$cause','$date_ab','$time_ab')");

            } }



        $this->render('/Espaces/profvacataires/demanderabsencesb');
    }

 public function Imprimer($id = null)
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

        $absences=$con->execute('SELECT * FROM vacataires_absences  where id='.$id);
        
        $this->set('absences', $absences);
        $this->render('/Espaces/profvacataires/imprimer');
    }

    public function listerAbsences()
    {
        $usrole=$this->Auth->user('role');
        $id=$this->Auth->user('id');
        $this->set('role',$usrole);
        $this->render('/Espaces/respopersonels/home');
        $con=ConnectionManager::get('default');

        $demandes = $con->execute("SELECT  vacataires_absences.id,vacataires_absences.duree_ab,vacataires_absences.cause,vacataires_absences.date_ab,vacataires_absences.time_ab,vacataires_absences.isvalid, vacataires.nom_vacataire, vacataires_absences.vacataire_id, vacataires.prenom_vacataire,vacataires_grades.sous_grade,vacataires_absences.duree_ab,vacataires_absences.date_ab,vacataires_absences.time_ab,vacataires_absences.cause FROM vacataires_absences,vacataires, vacataires_grades WHERE vacataires_grades.vacataire_id = vacataires.id  AND vacataires_absences.vacataire_id = vacataires.id AND vacataires.user_id=".$id)->fetchAll("assoc");
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
        $this->render('/Espaces/profvacataires/listerAbsences');
    }


}
