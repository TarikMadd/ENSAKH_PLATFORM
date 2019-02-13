<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;
use App\Model\Entity\etudiant;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;



require_once(ROOT .DS. "Vendor" .DS . "setasign" .DS . "fpdf" . DS . "fpdf.php");
require_once(ROOT .DS. "Vendor" .DS . "setasign" .DS . "fpdi" . DS . "fpdi.php");








class resposcolaritesController extends AppController {



    public function beforeFilter(Event $event)
    {
        // allow only login, forgotpassword
        $this->Auth->authorize = 'controller';
        $usrole = $this->Auth->user('role');
        if($usrole!='resposcolarite' && $usrole!='admin')
        {

            //$this->Flash->error(__('Vous ne pouvez pas acceder a ce lien'));
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'logout']
            );
        }
        $this->Auth->deny();

    }


    public function index() {
        $usrole = $this->Auth->user('role');
        if($usrole=='resposcolarite') {
            if($usrole=='resposcolarite') {

                /****        Les statitiques des étudiants par classe             *****/
                $this->loadModel('Etudiers');
                $premiere_annee= $this->Etudiers->find('all', array(
                    'conditions' => array('Etudiers.groupe_id' => '1')
                ));
                $premiere_annee=$premiere_annee->count();

                $deuxiemme_annee= $this->Etudiers->find('all', array(
                    'conditions' => array('Etudiers.groupe_id' => '2')
                ));
                $deuxiemme_annee=$deuxiemme_annee->count();

                $TC= $this->Etudiers->find('all', array(
                    'conditions' => array('Etudiers.groupe_id' => '3')
                ));
                $TC=$TC->count();

                $_3GPE= $this->Etudiers->find('all', array(
                    'conditions' => array('Etudiers.groupe_id' => '4')
                ));
                $_3GPE=$_3GPE->count();

                $_4GPE= $this->Etudiers->find('all', array(
                    'conditions' => array('Etudiers.groupe_id' => '5')
                ));
                $_4GPE=$_4GPE->count();

                $_5GPE= $this->Etudiers->find('all', array(
                    'conditions' => array('Etudiers.groupe_id' => '6')
                ));
                $_5GPE=$_5GPE->count();

                $_4GI= $this->Etudiers->find('all', array(
                    'conditions' => array('Etudiers.groupe_id' => '7')
                ));
                $_4GI=$_4GI->count();

                $_5GI= $this->Etudiers->find('all', array(
                    'conditions' => array('Etudiers.groupe_id' => '8')
                ));
                $_5GI=$_5GI->count();

                $_4GE= $this->Etudiers->find('all', array(
                    'conditions' => array('Etudiers.groupe_id' => '9')
                ));
                $_4GE=$_4GE->count();

                $_5GE= $this->Etudiers->find('all', array(
                    'conditions' => array('Etudiers.groupe_id' => '10')
                ));
                $_5GE=$_5GE->count();

                $_4GRT= $this->Etudiers->find('all', array(
                    'conditions' => array('Etudiers.groupe_id' => '11')
                ));
                $_4GRT=$_4GRT->count();

                $_5GRT= $this->Etudiers->find('all', array(
                    'conditions' => array('Etudiers.groupe_id' => '12')
                ));
                $_5GRT=$_5GRT->count();

                /****        Les statitiques des mentions de notes  en école       *****/

                $res=array('premiere_annee'=>$premiere_annee,'deuxiemme_annee'=>$deuxiemme_annee,'TC'=>$TC,'_4GE'=>$_4GE,'_4GI'=>$_4GI,'_4GPE'=>$_4GPE,'_4GRT'=>$_4GRT,'_5GE'=>$_5GE,'_5GI'=>$_5GI,'_5GPE'=>$_5GPE,'_5GRT'=>$_5GRT,'_3GPE'=>$_3GPE);
                $this->set(compact('Groupe'));
                $this->set('_serialize', ['Groupe']);
                $this->set('res',$res);


            }



            $res['nbrE']=360;$res['nbrP']=40;$res['nbrC']=12;$res['nbrN']=5;



            $this->set('role', $usrole);
            $this->set('res', $res);


            $this->render('/Espaces/resposcolarites/home');
        }



    }

    /**** Zouhir ****/

    public function aitsaidAfficherClasse()
    {
        $_SESSION['yes'] = 0;
        if ($this->request->is('post'))
        {
            $_SESSION['yes'] = 1;
            $oh= $this->request->data['classe']+1;
            $this->set('res',$this->request->data['classe']);
            $con=ConnectionManager::get('default');
            $modules = $con->execute("SELECT * FROM modules WHERE groupe_id = $oh")->fetchAll('assoc');
            $elements = $con->execute("SELECT * FROM elements where module_id in (select id from modules where groupe_id = $oh )")->fetchAll('assoc');
            $sem = $con->execute("SELECT elements.id, modules.libile as m, elements.libile, semestres.libile as s,elements.CM,elements.TD,elements.TP,elements.AP,elements.Eval FROM elements,modules,semestres WHERE modules.groupe_id = $oh AND modules.id = elements.module_id AND modules.semestre_id = semestres.id")->fetchAll('assoc');

            $this->set('modules',$sem);


        }

        $con=ConnectionManager::get('default');
        $niveaus=$con->execute("SELECT niveaus.libile FROM niveaus
		    JOIN groupes
		        ON groupes.niveaus_id = niveaus.id
		    JOIN filieres
		        ON filieres.id = groupes.filiere_id")->fetchAll('assoc');
        $niveaus2=$con->execute("SELECT filieres.libile FROM niveaus
		    JOIN groupes
		        ON groupes.niveaus_id = niveaus.id
		    JOIN filieres
		        ON filieres.id = groupes.filiere_id")->fetchAll('assoc');

        $this->set('niveaus',$niveaus);
        $this->set('niveaus2',$niveaus2);
        /*$this->set(compact('niveaus'));
        $this->set('_serialize', ['niveaus']);*/
        $this->render('/Espaces/resposcolarites/affichageClasseb');

    }

    public function view($id = null)
    {
        $con=ConnectionManager::get('default');
        $elements=$con->execute("SELECT elements.libile as e, elements.CM, elements.TP,elements.TD,elements.AP,elements.Eval,semestres.libile as s,modules.libile as m,filieres.libile as f,niveaus.libile as n FROM elements,modules,semestres,groupes,niveaus,filieres WHERE elements.id = $id AND modules.id = elements.module_id AND modules.semestre_id = semestres.id AND groupes.id = modules.groupe_id AND groupes.niveaus_id= niveaus.id AND groupes.filiere_id = filieres.id")->fetchAll('assoc');
        $profp = $con->execute("SELECT profpermanents.nom_prof, profpermanents.prenom_prof
          FROM enseigners, profpermanents WHERE profpermanents.id = enseigners.profpermanent_id AND enseigners.element_id =$id")->fetchAll('assoc');
        $profv = $con->execute("SELECT vacataires.nom_vacataire, vacataires.prenom_vacataire
          FROM enseigners, vacataires WHERE vacataires.id = enseigners.profvacataire_id AND enseigners.element_id =$id")->fetchAll('assoc');

        if(!empty($profp))
        {
            $_SESSION['prof'] = $profp[0]['nom_prof'].' '.$profp[0]['prenom_prof'];
        }
        else if(!empty($profv))
        {
            $_SESSION['prof'] = $profv[0]['nom_vacataire'].' '.$profv[0]['prenom_vacataire'];
        }
        else
        {
            $_SESSION['prof'] = 'Aucun';
        }

        $this->set('element', $elements);
        $this->render('/Espaces/resposcolarites/viewb');
    }
    public function edit($id=null)
    {
        $_SESSION['is'] = 'no';
        $con=ConnectionManager::get('default');
        $elements=$con->execute("SELECT elements.libile as e,elements.CM, elements.TP,elements.TD,elements.AP,elements.Eval,semestres.libile as s,modules.libile as m,filieres.libile as f,niveaus.libile as n,elements.id as el,semestres.id as se FROM elements,modules,semestres,groupes,niveaus,filieres WHERE elements.id = $id AND modules.id = elements.module_id AND modules.semestre_id = semestres.id AND groupes.id = modules.groupe_id AND groupes.niveaus_id= niveaus.id AND groupes.filiere_id = filieres.id")->fetchAll('assoc');
        //debug($elements); die;
        $profperm = $con->execute("SELECT id,nom_prof,prenom_prof FROM profpermanents")->fetchAll('assoc');
        $profvac = $con->execute("SELECT id,nom_vacataire,prenom_vacataire FROM vacataires")->fetchAll('assoc');
        $_SESSION['profp'] = $profperm;
        $_SESSION['profvac'] = $profvac;

        $this->set('element', $elements);
        if(isset($_POST['code']))
        {
            $_SESSION['is'] = 'yes';
            $id_ele = $elements[0]['el'];
            $id_se = $elements[0]['se'];
            if(isset($this->request->data['profp']))
            {
                $id_pro = $this->request->data['profp'];
                $con->execute("INSERT INTO enseigners (profpermanent_id,element_id,semestre_id,annee_scolaire_id) VALUES ($id_pro, $id_ele, $id_se,1)");
            }

            if(isset($this->request->data['profv']))
            {
                $id_pro = $this->request->data['profv'];
                $con->execute("INSERT INTO enseigners (profvacataire_id,element_id,semestre_id,annee_scolaire_id) VALUES ($id_pro, $id_ele, $id_se,1)");
            }
        }
        $this->render('/Espaces/resposcolarites/edit');
    }

    public function affichagenote()
    {
        $con=ConnectionManager::get('default');
        $classes = $con->execute("SELECT groupes.id, filieres.libile as f,niveaus.libile as n,niveaus.id as id_n FROM niveaus,filieres,groupes WHERE groupes.niveaus_id = niveaus.id AND groupes.filiere_id = filieres.id")->fetchAll('assoc');
        $this->set('classes',$classes);
        if (isset($_POST['classe']))
        {
            $id_niveau = 0;
            $id_classe = $this->request->data['classe']+1;
            $_SESSION['id_groupe'] = $id_classe;
            $num_semestre = $this->request->data['semestre'];
            //echo $id_classe;

            switch ($id_classe)
            {
                case '1':
                    $id_niveau = 1;
                    break;
                case '2':
                    $id_niveau = 2;
                    break;
                case '3':
                case '4':
                    $id_niveau = 3;
                    break;
                case '5':
                case '6':
                case '7':
                case '8':
                    $id_niveau = 4;
                    break;
                case '9':
                case '10':
                case '11':
                case '12':
                    $id_niveau = 5;
                    break;


            }
            if ($num_semestre == 1)
            {
                $id_semestre = $id_niveau*2-1;
            }
            else
            {
                $id_semestre = $id_niveau*2;
            }

            $con=ConnectionManager::get('default');
            $modules = $con->execute("SELECT id,libile FROM modules WHERE groupe_id=$id_classe AND semestre_id = $id_semestre")->fetchAll('assoc');
            $nbr_module = $con->execute("SELECT COUNT(*) as n FROM modules WHERE groupe_id=$id_classe AND semestre_id = $id_semestre")->fetchAll('assoc');
            $lib_sem = $con->execute("SELECT libile FROM semestres WHERE id=$id_semestre")->fetchAll('assoc');
            $_SESSION['id_sem'] = $id_semestre;
            //$_SESSION['id_cla'] = $id_classe;
            $_SESSION['lib_sem'] = $lib_sem[0]['libile'];
            $this->set("modules",$modules);
            $this->set("nbr_module",$nbr_module);
            $this->set("sem",$id_semestre);
            $_SESSION['classe'] = $classes[$this->request->data['classe']]['n']." ".$classes[$this->request->data['classe']]['f'];
            $this->set("class",$id_classe);
            $_SESSION['modules'] = $modules;
            $_SESSION['nbr_mod'] = $nbr_module[0]['n'];
            // debug($modules[0]);die;

        }

        $this->render('/Espaces/resposcolarites/affichageNote');
    }

    public function listenote($id=null)
    {
        $con=ConnectionManager::get('default');
        $id_groupe = $_SESSION['id_groupe'];
        $etudiants = $con->execute("SELECT etudiers.id, etudiants.cne, etudiants.nom_fr,etudiants.prenom_fr FROM etudiants,etudiers WHERE etudiers.groupe_id = $id_groupe AND etudiers.etudiant_id = etudiants.id")->fetchAll('assoc');
        $_SESSION['etudiants'] = $etudiants;
        $_SESSION['is'] = 'meh';

        if (isset($_POST['session']) && $this->request->data['module'] !=0)
        {
            $_SESSION['tous'] = 1;
            $id_module = $this->request->data['module'];
            $_SESSION['mod'] = $id_module;
            $id_session = $this->request->data['session'];
            $_SESSION['sess'] = $id_session;
            $con=ConnectionManager::get('default');
            $nbr_ele = $con->execute("SELECT COUNT(*) as n FROM elements WHERE module_id = $id_module")->fetchAll('assoc');
            $_SESSION['nbr_ele'] = $nbr_ele;
            $nom_module = $con->execute("SELECT id,libile FROM modules WHERE id = $id_module")->fetchAll('assoc');
            $ele = $con->execute("SELECT id,libile FROM elements WHERE module_id = $id_module")->fetchAll('assoc');
            $groupe = $con->execute("SELECT groupe_id FROM modules WHERE id = $id_module")->fetchAll('assoc');

            $this->set('nom_module',$nom_module);
            $_SESSION['nom_mod'] = $nom_module[0]['libile'];
            $_SESSION['ele'] = $ele;
            $_SESSION['id_module'] = $id_module;

            if($_SESSION['sess']==1)
            {
                $notess = $this->notesavantratt($id_groupe,$_SESSION['id_sem'],$id_module);

            }

            else if($_SESSION['sess']==2)
            {
                $notess = $this->notesapresratt($id_groupe,$_SESSION['id_sem'],$id_module);
            }
            $_SESSION['notes'] = $notess;
            // debug($notess); die;
            $_SESSION['is_note'] = 'yes';
            for ($i=0; $i < sizeof($etudiants); $i++)
            {
                for ($j=0; $j <$nbr_ele[0]['n'] ; $j++)
                {
                    if(!isset($notess[$j][$i]))
                    {
                        $_SESSION['is_note'] = 'no';
                    }
                }
            }
            if($notess == null)
                $_SESSION['is_note'] = 'no';

        }
        else if(isset($_POST['session']) && $this->request->data['module'] ==0)
        {
            $tous = $this->request->data['module'];
            $_SESSION['tous'] = $tous;

            $id_session = $this->request->data['session'];
            $_SESSION['sess'] = $id_session;

            if($_SESSION['sess']==1)
            {
                $notess = $this->notesavantratt($id_groupe,$_SESSION['id_sem'],0);
            }

            else
            {
                $notess = $this->notesapresratt($id_groupe,$_SESSION['id_sem'],0);
            }

            $_SESSION['is_note'] = 'yes';
            for ($i=0; $i < sizeof($etudiants); $i++)
            {
                for ($j=0; $j <$_SESSION['nbr_mod'] ; $j++)
                {
                    if(!isset($notess[$j][$i]))
                    {
                        $_SESSION['is_note'] = 'no';
                    }
                }
            }
            if($notess == null)
                $_SESSION['is_note'] = 'no';
            $_SESSION['notes'] = $notess;

        }
        // echo $_SESSION['is_note'];


        if(isset($_POST['publier']))
        {
            $id_gr =$_SESSION['id_groupe'];
            $id_se = $_SESSION['id_sem'];
            if($_SESSION['sess']==1)
            {
                $is = $con->execute("SELECT * FROM autorisations WHERE groupe_id=$id_gr AND semestre_id=$id_se AND isnormal =1")->fetchAll('assoc');
                if(empty($is))
                {
                    $con->execute("INSERT INTO autorisations (groupe_id, annee_scolaire_id, semestre_id, isnormal) VALUES ($id_gr,1,$id_se,1)");
                    $_SESSION['is'] = "yes";
                }
                else
                {
                    $_SESSION['is'] = "no";

                }
            }
            else
            {
                $is = $con->execute("SELECT * FROM autorisations WHERE groupe_id=$id_gr AND semestre_id=$id_se AND isratt =1")->fetchAll('assoc');
                if(empty($is))
                {
                    $con->execute("UPDATE autorisations SET isratt = 1 WHERE groupe_id=$id_gr AND semestre_id=$id_se");
                    $_SESSION['is'] = "yes";
                }
                else
                {
                    $_SESSION['is'] = "no";

                }
            }
        }
        //debug($notess); die;
        $this->render('/Espaces/resposcolarites/listeNotes');

    }

    public function imprimerlistenote($id_module=null)
    {

        $this->render('/Espaces/resposcolarites/imprimerlistenote');
    }

    public function imprimerreleve()
    {

        $this->render('/Espaces/resposcolarites/imprimerreleve');
    }

    public function imprimerlisteadmis()
    {
        $this->render('/Espaces/resposcolarites/imprimerlisteadmis');
    }

    public function demanderabsencesb()
    {
        $_SESSION['auto'] = "none";
        $user_id = $this->Auth->user('id');
        $con=ConnectionManager::get('default');

        $id = $con->execute("SELECT id FROM fonctionnaires WHERE user_id = $user_id")->fetchAll('assoc');
        $fonct_id = $id[0]['id'];

        $nbr = $con->execute("SELECT COUNT(*) as n FROM absences WHERE fonctionnaire_id = $fonct_id")->fetchAll('assoc');
        $duree = $con->execute("SELECT duree_ab FROM absences WHERE fonctionnaire_id = $fonct_id")->fetchAll('assoc');
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
                $con->execute("INSERT INTO absences (fonctionnaire_id,duree_ab,cause,date_ab,time_ab) VALUES ($fonct_id,$duree_ab,'$cause','$date_ab','$time_ab')");

            } }



        $this->render('/Espaces/resposcolarites/demanderabsencesb');
    }

    public function listAdmis($id=null)
    {
        $con=ConnectionManager::get('default');

        $modules_par_groupe = $con->execute("SELECT libile,id FROM modules WHERE groupe_id = $id")->fetchAll('assoc');
        $etudiants_par_groupe = $con->execute("SELECT etudiers.id, etudiants.cne, etudiants.nom_fr,etudiants.prenom_fr FROM etudiants,etudiers WHERE etudiers.etudiant_id = etudiants.id AND etudiers.groupe_id = $id")->fetchAll('assoc');
        $classe = $con->execute("SELECT niveaus.id, filieres.libile as f, niveaus.libile as n FROM niveaus,filieres,groupes WHERE niveaus.id = groupes.niveaus_id AND filieres.id = groupes.filiere_id AND groupes.id = $id")->fetchAll('assoc');
        $_SESSION['etu'] = $classe;
        $_SESSION['etudiants'] = $etudiants_par_groupe;
        //debug($classe); die;

        for ($i=0; $i < sizeof($modules_par_groupe); $i++)
        {
            $id_module = $modules_par_groupe[$i]['id'];
            $element_par_module = $con->execute("SELECT id,libile FROM elements WHERE module_id = $id_module")->fetchAll('assoc');
            if(sizeof($element_par_module) == 1)
            {
                $notes[$i] = $con->execute("SELECT notes.note_ratt, notes.note FROM notes,etudiers,elements,etudiants WHERE notes.element_id = elements.id AND elements.module_id = $id_module AND notes.etudier_id = etudiers.id AND notes.confirmed=1 AND etudiers.groupe_id = $id AND etudiers.etudiant_id = etudiants.id")->fetchAll('assoc');
            }
            else
            {
                for ($j=0; $j <sizeof($element_par_module) ; $j++)
                {
                    $id_ele = $element_par_module[$j]['id'];

                    $notes2[$i][$j] = $con->execute("SELECT notes.note,notes.note_ratt FROM notes,etudiers,elements,etudiants WHERE notes.element_id = elements.id AND notes.element_id = $id_ele AND notes.etudier_id = etudiers.id AND notes.confirmed=1 AND etudiers.groupe_id = $id AND etudiers.etudiant_id = etudiants.id")->fetchAll('assoc');
                }

                for($k=0;$k<sizeof($etudiants_par_groupe);$k++)
                {
                    $somme = 0;

                    for ($j=0; $j < sizeof($element_par_module); $j++)
                    {

                        if($notes2[$i][$j][$k]['note_ratt'] == null)
                        {
                            $somme += $notes2[$i][$j][$k]['note'];
                        }
                        else
                        {
                            $somme += $notes2[$i][$j][$k]['note_ratt'];
                        }
                    }

                    $notes[$i][$k]['note'] = $somme/sizeof($element_par_module);
                    $notes[$i][$k]['note_ratt'] = null;

                }
            }
        }

        for ($i=0; $i <sizeof($modules_par_groupe) ; $i++)
        {
            for ($k=0; $k < sizeof($etudiants_par_groupe); $k++)
            {
                if($notes[$i][$k]['note_ratt'] == null)
                {
                    $notesFinal[$i][$k] = $notes[$i][$k]['note'];
                }
                else
                {
                    $notesFinal[$i][$k] = $notes[$i][$k]['note_ratt'];
                }
            }
        }

        for ($k=0; $k < sizeof($etudiants_par_groupe); $k++)
        {
            $somme = 0;
            for ($i=0; $i < sizeof($modules_par_groupe); $i++)
            {
                $somme += $notesFinal[$i][$k];
            }

            $moyenneGeneral[$k] = $somme/sizeof($modules_par_groupe);
        }

        //debug($moyenneGeneral); die;
        if (isset($notes))
        {
            $_SESSION['moyenneGeneral'] = $moyenneGeneral;
            $_SESSION['empty']='no';
        }
        else
        {

            $_SESSION['empty']='yes';
        }
        $this->render('/Espaces/resposcolarites/listeadmisb');

    }

    public function listeadmis()
    {
        $con=ConnectionManager::get('default');

        $isAdmis = $con->execute("SELECT * FROM access_admis")->fetchAll('assoc');
        $_SESSION['admis'] = $isAdmis;
        //debug($isAdmis); die;
        $this->render('/Espaces/resposcolarites/listadmis');

    }

    public function notesapresratt($id_groupe=null,$id_semestre=null,$id_module=null)
    {

        $con=ConnectionManager::get('default');
        $etudiants_par_groupe = $con->execute("SELECT etudiers.id, etudiants.cne, etudiants.nom_fr,etudiants.prenom_fr FROM etudiants,etudiers WHERE etudiers.etudiant_id = etudiants.id AND etudiers.groupe_id = $id_groupe")->fetchAll('assoc');
        $classe = $con->execute("SELECT niveaus.id, filieres.libile as f, niveaus.libile as n FROM niveaus,filieres,groupes WHERE niveaus.id = groupes.niveaus_id AND filieres.id = groupes.filiere_id AND groupes.id = $id_groupe")->fetchAll('assoc');

        $_SESSION['etu'] = $classe;
        $_SESSION['etudiants'] = $etudiants_par_groupe;
        if($id_module==0) //all modules
        {
            $modules_par_semestre = $con->execute("SELECT libile,id FROM modules WHERE groupe_id = $id_groupe AND semestre_id = $id_semestre")->fetchAll('assoc');

            for ($i=0; $i < sizeof($modules_par_semestre); $i++)
            {
                $id_module = $modules_par_semestre[$i]['id'];
                $element_par_module = $con->execute("SELECT id,libile FROM elements WHERE module_id = $id_module")->fetchAll('assoc');
                if(sizeof($element_par_module) == 1)
                {
                    $notes[$i] = $con->execute("SELECT notes.note_ratt, notes.note FROM notes,etudiers,elements,etudiants WHERE notes.element_id = elements.id AND elements.module_id = $id_module AND notes.etudier_id = etudiers.id AND notes.confirmed=1 AND etudiers.groupe_id = $id_groupe AND etudiers.etudiant_id = etudiants.id")->fetchAll('assoc');
                }
                else
                {
                    for ($j=0; $j <sizeof($element_par_module) ; $j++)
                    {
                        $id_ele = $element_par_module[$j]['id'];

                        $notes2[$i][$j] = $con->execute("SELECT notes.note,notes.note_ratt FROM notes,etudiers,elements,etudiants WHERE notes.element_id = elements.id AND notes.element_id = $id_ele AND notes.etudier_id = etudiers.id AND notes.confirmed=1 AND etudiers.groupe_id = $id_groupe AND etudiers.etudiant_id = etudiants.id")->fetchAll('assoc');

                    }

                    for($k=0;$k<sizeof($etudiants_par_groupe);$k++)
                    {
                        $somme = 0;

                        for ($j=0; $j < sizeof($element_par_module); $j++)
                        {
                            if($notes2[$i][$j][$k]['note_ratt'] == null)
                            {
                                $somme += $notes2[$i][$j][$k]['note'];
                            }
                            else
                            {
                                $somme += $notes2[$i][$j][$k]['note_ratt'];
                            }
                        }

                        $notes[$i][$k]['note'] = $somme/sizeof($element_par_module);
                        $notes[$i][$k]['note_ratt'] = null;


                    }
                }
            }

            for ($i=0; $i <sizeof($modules_par_semestre) ; $i++)
            {
                for ($k=0; $k < sizeof($etudiants_par_groupe); $k++)
                {
                    if(isset($notes[$i][$k]['note']))
                    {
                        if($notes[$i][$k]['note_ratt'] == null)
                        {
                            if(isset($notes[$i][$k]['note']))

                                $notesFinal[$i][$k] = $notes[$i][$k]['note'];
                        }
                        else
                        {
                            $notesFinal[$i][$k] = $notes[$i][$k]['note_ratt'];
                        }
                    }
                }
            }
        }
        else
        {
            $element_par_module = $con->execute("SELECT id,libile FROM elements WHERE module_id = $id_module")->fetchAll('assoc');
            for ($i=0; $i < sizeof($element_par_module); $i++)
            {
                $id_ele = $element_par_module[$i]['id'];
                $notes[$i] = $con->execute("SELECT notes.note,notes.note_ratt FROM notes,etudiers,elements,etudiants WHERE notes.element_id = elements.id AND notes.element_id = $id_ele AND notes.etudier_id = etudiers.id AND notes.confirmed=1 AND etudiers.groupe_id = $id_groupe AND etudiers.etudiant_id = etudiants.id")->fetchAll('assoc');
            }
            for ($i=0; $i <sizeof($element_par_module) ; $i++)
            {
                for ($k=0; $k < sizeof($etudiants_par_groupe); $k++)
                {
                    if(isset($notes[$i][$k]['note']))
                    {
                        if($notes[$i][$k]['note_ratt'] == null)
                        {

                            $notesFinal[$i][$k] = $notes[$i][$k]['note'];
                        }
                        else
                        {
                            $notesFinal[$i][$k] = $notes[$i][$k]['note_ratt'];
                        }
                    }
                }
            }
        }

        if(empty($notes[0]))
        {
            return null;
        }
        else
            return $notesFinal;

    }

    public function notesavantratt($id_groupe=null,$id_semestre=null,$id_module=null)
    {

        $con=ConnectionManager::get('default');
        $etudiants_par_groupe = $con->execute("SELECT etudiers.id, etudiants.cne, etudiants.nom_fr,etudiants.prenom_fr FROM etudiants,etudiers WHERE etudiers.etudiant_id = etudiants.id AND etudiers.groupe_id = $id_groupe")->fetchAll('assoc');
        $classe = $con->execute("SELECT niveaus.id, filieres.libile as f, niveaus.libile as n FROM niveaus,filieres,groupes WHERE niveaus.id = groupes.niveaus_id AND filieres.id = groupes.filiere_id AND groupes.id = $id_groupe")->fetchAll('assoc');

        $_SESSION['etu'] = $classe;
        $_SESSION['etudiants'] = $etudiants_par_groupe;
        if($id_module==0) //all modules
        {
            $modules_par_semestre = $con->execute("SELECT libile,id FROM modules WHERE groupe_id = $id_groupe AND semestre_id = $id_semestre")->fetchAll('assoc');

            for ($i=0; $i < sizeof($modules_par_semestre); $i++)
            {
                $id_module = $modules_par_semestre[$i]['id'];
                $element_par_module = $con->execute("SELECT id,libile FROM elements WHERE module_id = $id_module")->fetchAll('assoc');
                if(sizeof($element_par_module) == 1)
                {
                    $notes[$i] = $con->execute("SELECT notes.note FROM notes,etudiers,elements,etudiants WHERE notes.element_id = elements.id AND elements.module_id = $id_module AND notes.etudier_id = etudiers.id AND notes.confirmed=1 AND etudiers.groupe_id = $id_groupe AND etudiers.etudiant_id = etudiants.id")->fetchAll('assoc');
                }
                else
                {
                    for ($j=0; $j <sizeof($element_par_module) ; $j++)
                    {
                        $id_ele = $element_par_module[$j]['id'];

                        $notes2[$i][$j] = $con->execute("SELECT notes.note FROM notes,etudiers,elements,etudiants WHERE notes.element_id = elements.id AND notes.element_id = $id_ele AND notes.etudier_id = etudiers.id AND notes.confirmed=1 AND etudiers.groupe_id = $id_groupe AND etudiers.etudiant_id = etudiants.id")->fetchAll('assoc');

                    }

                    for($k=0;$k<sizeof($etudiants_par_groupe);$k++)
                    {
                        $somme = 0;

                        for ($j=0; $j < sizeof($element_par_module); $j++)
                        {
                            if(isset($notes2[$i][$j][$k]['note']))
                            {
                                $somme += $notes2[$i][$j][$k]['note'];
                            }
                        }

                        $notes[$i][$k]['note'] = $somme/sizeof($element_par_module);



                    }
                }
            }

            for ($i=0; $i <sizeof($modules_par_semestre) ; $i++)
            {
                for ($k=0; $k < sizeof($etudiants_par_groupe); $k++)
                {
                    if(isset($notes[$i][$k]['note']))

                        $notesFinal[$i][$k] = $notes[$i][$k]['note'];
                }
            }
        }
        else
        {
            $element_par_module = $con->execute("SELECT id,libile FROM elements WHERE module_id = $id_module")->fetchAll('assoc');
            for ($i=0; $i < sizeof($element_par_module); $i++)
            {
                $id_ele = $element_par_module[$i]['id'];
                $notes[$i] = $con->execute("SELECT notes.note FROM notes,etudiers,elements,etudiants WHERE notes.element_id = elements.id AND notes.element_id = $id_ele AND notes.etudier_id = etudiers.id AND notes.confirmed=1 AND etudiers.groupe_id = $id_groupe AND etudiers.etudiant_id = etudiants.id")->fetchAll('assoc');
            }
            for ($i=0; $i <sizeof($element_par_module) ; $i++)
            {
                for ($k=0; $k < sizeof($etudiants_par_groupe); $k++)
                {
                    if(isset($notes[$i][$k]['note']))

                        $notesFinal[$i][$k] = $notes[$i][$k]['note'];
                }
            }
        }
        if(empty($notes[0]))
        {
            return null;
        }
        else
            return $notesFinal;

    }

    public function generationcode()
    {
        $con=ConnectionManager::get('default');
        $_SESSION['prof'] = 'no';
        $_SESSION['is'] = 'no';

        if(isset($_POST['semestre']))
        {
            $_SESSION['semes'] = $this->request->data['semestre'];
            $_SESSION['sessi'] = $this->request->data['session'];

            if($this->request->data['semestre']==1)
            {
                $profperm = $con->execute("SELECT profpermanents.id, profpermanents.nom_prof,profpermanents.prenom_prof FROM profpermanents,enseigners,semestres WHERE enseigners.semestre_id%2=1 AND enseigners.profpermanent_id = profpermanents.id AND semestres.id = enseigners.semestre_id")->fetchAll("assoc");
                $profvac = $con->execute("SELECT vacataires.id,vacataires.nom_vacataire,vacataires.prenom_vacataire FROM vacataires,enseigners,semestres WHERE enseigners.semestre_id%2=1 AND enseigners.profvacataire_id = vacataires.id AND semestres.id = enseigners.semestre_id")->fetchAll("assoc");
            }
            else if($this->request->data['semestre']==2)
            {
                $profperm = $con->execute("SELECT profpermanents.nom_prof,profpermanents.prenom_prof FROM profpermanents,enseigners,semestres WHERE enseigners.semestre_id%2=0 AND enseigners.profpermanent_id = profpermanents.id AND semestres.id = enseigners.semestre_id")->fetchAll("assoc");
                $profvac = $con->execute("SELECT vacataires.nom_vacataire,vacataires.prenom_vacataire FROM vacataires,enseigners,semestres WHERE enseigners.semestre_id%2=0 AND enseigners.profvacataire_id = vacataires.id AND semestres.id = enseigners.semestre_id")->fetchAll("assoc");
            }
            $_SESSION['prof'] = 'yes';

            $prop = array_unique($profperm,SORT_REGULAR);
            $prov = array_unique($profvac,SORT_REGULAR);
            $_SESSION['prop'] = $prop;
            $_SESSION['prov'] = $prov;

        }
        if(isset($_POST['code']) && $_SESSION['sessi']==1)
        {
            $_SESSION['is'] = 'yes';
            $_SESSION['prof'] = 'yes';
           // debug($_SESSION['prop']);// die;


                foreach ($_SESSION['prop'] as $item) {


                $id = $item['id'];
                $rand = $this->createRandomPassword();
                $date = $_POST['date'];
                $insertprofperma = $con->execute("INSERT INTO notes_auth (profpermanent_id, date_valide, key_module, pv) VALUES ($id,'$date','$rand',0)");

            }


                foreach ($_SESSION['prov'] as $item) {
                $id = $item['id'];
                $rand = $this->createRandomPassword();
                $date = $_POST['date'];
                $insertprofperma = $con->execute("INSERT INTO notes_auth (profvacataire_id, date_valide, key_module, pv) VALUES ($id,'$date','$rand',0)");
            }

        }
        else if(isset($_POST['code']) && $_SESSION['sessi']==2)
        {
            $_SESSION['prof'] = 'yes';
            $_SESSION['is'] = 'yes';
            for ($i=0; $i <sizeof($_SESSION['prop']) ; $i++)
            {
                $id = $_SESSION['prop'][$i]['id'];
                $rand = $this->createRandomPassword();
                $date = $_POST['date'];
                $insertprofperma = $con->execute("UPDATE notes_auth SET date_valide ='$date', for_ratt = 1, key_module = '$rand' WHERE profpermanent_id = $id");

            }
            for ($i=0; $i <sizeof($_SESSION['prov']) ; $i++)
            {
                $id = $_SESSION['prov'][$i]['id'];
                $rand = $this->createRandomPassword();
                $date = $_POST['date'];
                $insertprofperma = $con->execute("UPDATE notes_auth SET date_valide ='$date', for_ratt = 1, key_module = '$rand' WHERE profvacataire_id = $id");
            }
        }
        else if(isset($_POST['code']) && $_SESSION['sessi']==3)
        {
            $_SESSION['prof'] = 'yes';
            $_SESSION['is'] = 'yes';
            $id = $this->request->data['prof'];
            $rand = $this->createRandomPassword();
            $date = $_POST['date'];
            $insertprofperma = $con->execute("UPDATE notes_auth SET date_valide ='$date', pv = 1, key_module = '$rand' WHERE profvacataire_id = $id OR profpermanent_id =$id");

        }
        $this->render('/Espaces/resposcolarites/generationcode');

    }

    public function createRandomPassword()
    {

        $chars = "abcdefghijkmnopqrstuvwxyz0123456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;

        while ($i <= 5) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }

        return $pass;

    }





    /******** fin zuhir********/

    public function aitsaidTableauDeBord()
    {
        $usrole = $this->Auth->user('role');
        if($usrole=='resposcolarite') {

         /****        Les statitiques des étudiants par classe             *****/
            $this->loadModel('Etudiers');
            $premiere_annee= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '1')
            ));
            $premiere_annee=$premiere_annee->count();

            $deuxiemme_annee= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '2')
            ));
            $deuxiemme_annee=$deuxiemme_annee->count();

            $TC= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '3')
            ));
            $TC=$TC->count();

            $_3GPE= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '4')
            ));
            $_3GPE=$_3GPE->count();

            $_4GPE= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '5')
            ));
            $_4GPE=$_4GPE->count();

            $_5GPE= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '6')
            ));
            $_5GPE=$_5GPE->count();

            $_4GI= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '7')
            ));
            $_4GI=$_4GI->count();

            $_5GI= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '8')
            ));
            $_5GI=$_5GI->count();

            $_4GE= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '9')
            ));
            $_4GE=$_4GE->count();

            $_5GE= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '10')
            ));
            $_5GE=$_5GE->count();

            $_4GRT= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '11')
            ));
            $_4GRT=$_4GRT->count();

            $_5GRT= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '12')
            ));
            $_5GRT=$_5GRT->count();

            /****        Les statitiques des mentions de notes  en école       *****/

            $res=array('premiere_annee'=>$premiere_annee,'deuxiemme_annee'=>$deuxiemme_annee,'TC'=>$TC,'_4GE'=>$_4GE,'_4GI'=>$_4GI,'_4GPE'=>$_4GPE,'_4GRT'=>$_4GRT,'_5GE'=>$_5GE,'_5GI'=>$_5GI,'_5GPE'=>$_5GPE,'_5GRT'=>$_5GRT,'_3GPE'=>$_3GPE);
            $this->set(compact('Groupe'));
            $this->set('_serialize', ['Groupe']);
            $this->set('res',$res);
            $this->set('role',$usrole);
            $this->render('/Espaces/resposcolarites/AitSaidTableauDeBord');
        }
    }

    public function classetableauDeBord()
    {
        $usrole = $this->Auth->user('role');
        if($usrole=='resposcolarite') {

            /****        Les statitiques des étudiants par classe             *****/
            $this->loadModel('Etudiers');
            $premiere_annee= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '1')
            ));
            $premiere_annee=$premiere_annee->count();

            $deuxiemme_annee= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '2')
            ));
            $deuxiemme_annee=$deuxiemme_annee->count();

            $TC= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '3')
            ));
            $TC=$TC->count();

            $_3GPE= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '4')
            ));
            $_3GPE=$_3GPE->count();

            $_4GPE= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '5')
            ));
            $_4GPE=$_4GPE->count();

            $_5GPE= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '6')
            ));
            $_5GPE=$_5GPE->count();

            $_4GI= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '7')
            ));
            $_4GI=$_4GI->count();

            $_5GI= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '8')
            ));
            $_5GI=$_5GI->count();

            $_4GE= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '9')
            ));
            $_4GE=$_4GE->count();

            $_5GE= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '10')
            ));
            $_5GE=$_5GE->count();

            $_4GRT= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '11')
            ));
            $_4GRT=$_4GRT->count();

            $_5GRT= $this->Etudiers->find('all', array(
                'conditions' => array('Etudiers.groupe_id' => '12')
            ));
            $_5GRT=$_5GRT->count();

            /****        Les statitiques des mentions de notes  en école       *****/

            $res=array('premiere_annee'=>$premiere_annee,'deuxiemme_annee'=>$deuxiemme_annee,'TC'=>$TC,'_4GE'=>$_4GE,'_4GI'=>$_4GI,'_4GPE'=>$_4GPE,'_4GRT'=>$_4GRT,'_5GE'=>$_5GE,'_5GI'=>$_5GI,'_5GPE'=>$_5GPE,'_5GRT'=>$_5GRT,'_3GPE'=>$_3GPE);
            $this->set(compact('Groupe'));
            $this->set('_serialize', ['Groupe']);
            $this->set('res',$res);
            $this->set('role',$usrole);

            $this->render('/Espaces/resposcolarites/classetableauDeBord');
        }
    }

    public function aitsaidAfficherClassebis()
    {
        /*$niveaus = $this->paginate('Niveaus');

     $this->set(compact('niveaus'));
     $this->set('_serialize', ['niveaus']);
     $usrole=$this->Auth->user('username');
     $this->set('role',$usrole);*/

        if ($this->request->is('post'))
        {
            $oh= $this->request->data['classe']+1;
            $this->set('res',$this->request->data['classe']);
            //dump($oh);
            //exit;
            $con=ConnectionManager::get('default');
            $modules = $con->execute("SELECT * FROM modules WHERE groupe_id =$oh" )->fetchAll('assoc');
            //dump($modules);
            //exit;
            $elements = $con->execute("SELECT * FROM elements where module_id in (select id from modules where groupe_id = $oh )")->fetchAll('assoc');
            //dump($elements);
            //exit;
            $sem = $con->execute("SELECT elements.id,elements.libile, semestres.libile as s,elements.CM,elements.TD,elements.TP,elements.AP,elements.Eval FROM elements,modules,semestres WHERE modules.groupe_id =$oh AND modules.id = elements.module_id AND modules.semestre_id = semestres.id")->fetchAll('assoc');
            /***** blm requetes ****/

            $this->set('modules',$sem);
        }

        $con=ConnectionManager::get('default');
        $niveaus=$con->execute("SELECT niveaus.libile FROM niveaus
		    JOIN groupes
		        ON groupes.niveaus_id = niveaus.id
		    JOIN filieres
		        ON filieres.id = groupes.filiere_id")->fetchAll('assoc');
        $niveaus2=$con->execute("SELECT filieres.libile FROM niveaus
		    JOIN groupes
		        ON groupes.niveaus_id = niveaus.id
		    JOIN filieres
		        ON filieres.id = groupes.filiere_id")->fetchAll('assoc');

        $this->set('niveaus',$niveaus);
        $this->set('niveaus2',$niveaus2);
        /*$this->set(compact('niveaus'));
        $this->set('_serialize', ['niveaus']);*/
        $this->render('/Espaces/resposcolarites/affichageClasse');

    }

    /*public function aitsaidAfficherClasse2()
    {
    	$niveaus = TableRegistry::get('Niveaus');
    	foreach ($niveaus->find() as $niveau)
    	{
    		$arr[] =$niveau->libile;
    	}
    	print_r($arr);
    	$this->set('arr',$arr);

    	$this->render('/Espaces/resposcolarites/affichageClasse');


    }*/
    public function viewb($id = null)
    {
        $con=ConnectionManager::get('default');
        $elements=$con->execute("SELECT elements.libile as e,elements.CM, elements.TP,elements.TD,elements.AP,elements.Eval,semestres.libile as s,modules.libile as m,filieres.libile as f,niveaus.libile as n FROM elements,modules,semestres,groupes,niveaus,filieres WHERE elements.id = $id AND modules.id = elements.module_id AND modules.semestre_id = semestres.id AND groupes.id = modules.groupe_id AND groupes.niveaus_id= niveaus.id AND groupes.filiere_id = filieres.id")->fetchAll('assoc');
        //debug($elements); die;

        $this->set('element', $elements);
        $this->render('/Espaces/resposcolarites/view');
    }

    /******* FADILI  *******/


   public function getDestinataire($typeD) {

        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $cnx=ConnectionManager::get('default');
        $usrID=$this->Auth->user('id');
        $destProfParDept =null;
        $session = $this->request->session();
        if (strcmp($typeD,'etudiants') == 0)
            $typeDest = $typeDest = $cnx->execute("

              SELECT DISTINCT f.libile as filiere, n.libile as niveau
              FROM filieres f, niveaus n ORDER BY filiere
             
               
               ")->fetchAll('assoc');
        if (strcmp($typeD,'professeur') == 0){

            // for check later

            $typeDest = $cnx->execute("
                SELECT DISTINCT f.libile as filiere, n.libile as niveau
              FROM filieres f, niveaus n ORDER BY filiere
   
               ")->fetchAll('assoc');

            $destProfParDept = $cnx->execute("
              SELECT DISTINCT d.id, d.nom_departement as nomDept
              FROM departements d ORDER BY nomDept
                    ")->fetchAll('assoc');
        }

        if (strcmp($typeD, 'etudiantSpecifie') == 0) {

            $typeDest = $cnx->execute("

              SELECT DISTINCT grp.id, f.libile as filiere, n.libile as niveau
              FROM groupes grp, filieres f, niveaus n
              WHERE f.id = grp.filiere_id AND   n.id = grp.niveaus_id ORDER BY filiere
           
           ")->fetchAll('assoc');
            $session->write('typeDest', $typeDest);
            $this->set('filierID',-1);
        }

        if (strcmp($typeD, 'profSpecifie') == 0) {

            $typeDest = $cnx->execute("SELECT DISTINCT id , nom_departement as nom FROM departements ORDER BY nom")->fetchAll('assoc');
            $session->write('typeDest', $typeDest);
            $this->set('deptID',-1);
        }


        $this->set('destProfDept',$destProfParDept);
        $this->set('typeDest',$typeDest);
        $this->set('selected',$typeD);
        $this->render('/Espaces/resposcolarites/envoyerNvSco');
    }

    public function getEtudiantsParFiliere($grpID)
    {
        $session = $this->request->session();
        $cnx=ConnectionManager::get('default');
        // $dest = explode("*",$this->request->getData('filiereEtudiant'));

        $typeD = 'etudiantSpecifie';
        $listEtudiants = $cnx->execute("SELECT DISTINCT u.id, e.nom_fr as nom, e.prenom_fr as prenom
                  FROM etudiants e, etudiers etu, groupes grp, filieres f, niveaus n, users u
                  WHERE
                        u.id = e.user_id AND e.id = etu.etudiant_id AND etu.groupe_id =(SELECT id FROM groupes WHERE id = $grpID) ORDER BY nom

                   ")->fetchAll('assoc');


        $this->set('listE',$listEtudiants);
        $this->set('typeDest',$session->read('typeDest'));
        $this->set('selected','etudiantSpecifie');
        $this->set('filierID',$grpID);
        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $this->render('/Espaces/resposcolarites/envoyerNvSco');
    }

    public function getProfParDept($deptID)
    {
        $session = $this->request->session();
        $cnx=ConnectionManager::get('default');
        // $dest = explode("*",$this->request->getData('filiereEtudiant'));

        $typeD = 'etudiantSpecifie';
        $listEtudiants = $cnx->execute("SELECT DISTINCT u.id, p.nom_prof as nom, p.prenom_prof as prenom
                  FROM profpermanents p, users u, profpermanents_departements profDept
                  WHERE
                        u.id = p.user_id AND p.id = profDept.profpermanent_id and 
                        profDept.departement_id = $deptID 
                  UNION 
                      SELECT DISTINCT u.id, p.nom_vacataire as nom, p.prenom_vacataire as prenom
                      FROM vacataires p, users u, vacataires_departements profDept
                      WHERE
                            u.id = p.user_id AND p.id = profDept.vacataire_id and 
                            profDept.departement_id = $deptID
                      ORDER BY nom

                   ")->fetchAll('assoc');


        $this->set('listD',$listEtudiants);
        $this->set('typeDest',$session->read('typeDest'));
        $this->set('selected','profSpecifie');
        $this->set('deptID',$deptID);
        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $this->render('/Espaces/resposcolarites/envoyerNvSco');
    }

    public function boiteRecSco() {

        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $monid = $usrole=$this->Auth->user('id');

        Time::setToStringFormat('yyyy-MM-dd HH:mm:ss');
        $cnx=ConnectionManager::get('default');
        $mesMessages=$cnx->execute("
        SELECT CONCAT_WS(' ', e.nom_fr, e.prenom_fr) AS username,role, m.sujet, m.contenu, TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
        FROM users_messages umg, messages m, users u, etudiants e
        where e.user_id = u.id and umg.user_id = u.id and umg.message_id  = m.id and user_idrecepteur = $monid and role like 'etudiant'
        and m.id NOT IN (SELECT DISTINCT message_id FROM asupprimer WHERE user_id = $monid)
      UNION 
        SELECT CONCAT_WS(' ', p.nom_prof, p.prenom_prof) AS username, role, m.sujet, m.contenu, TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
        FROM users_messages umg, messages m, users u, profpermanents p
        where p.user_id = u.id and umg.user_id = u.id and umg.message_id  = m.id and user_idrecepteur = $monid and role like 'profpermanent'
        and m.id NOT IN (SELECT DISTINCT message_id FROM asupprimer WHERE user_id = $monid)
      UNION 
        SELECT CONCAT_WS(' ', p.nom_vacataire, p.prenom_vacataire) AS username, role, m.sujet, m.contenu, TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
        FROM users_messages umg, messages m, users u, vacataires p
        where p.user_id = u.id and umg.user_id = u.id and umg.message_id  = m.id and user_idrecepteur = $monid and role like 'profvacataire'
        and m.id NOT IN (SELECT DISTINCT message_id FROM asupprimer WHERE user_id = $monid)
        ORDER BY inttervale
        ")->fetchAll('assoc');
        $this->set('mesMsgs',$mesMessages);
        $this->render('/Espaces/resposcolarites/boiteRecSco');
    }

    public function envoyerNvSco() {

        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $cnx=ConnectionManager::get('default');
        $professeurs=$cnx->execute("SELECT DISTINCT u.id, p.nom_prof, p.prenom_prof FROM users u, profpermanents p, enseigners e, annee_scolaires a 
        where p.user_id = u.id and e.annee_scolaire_id = a.id ")->fetchAll('assoc');
        $this->set('professeur',$professeurs);
        $this->set('selected',"");
        $this->render('/Espaces/resposcolarites/envoyerNvSco');
    }

    public function lireMsgSco($id=0) {

        $cnx=ConnectionManager::get('default');
        $monID = $this->Auth->user('id');;
        $test = explode(".",$id);
        if (strcmp($test[0],'readSN') == 0 || strcmp($test[0],'readSD') == 0){

            $id = $test[1];
            if (strcmp($test[0],'readSN') == 0)
            {
                $msg = $cnx->execute("
                SELECT m.id, m.sujet, m.contenu, m.piecejointe, um.date, CONCAT_WS(' ', e.nom_fr, e.prenom_fr) AS username,role
                FROM messages m, users_messages um, users u, etudiants e
                WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID and m.id = $id and e.user_id = u.id and role like 'etudiant'
              UNION 
                SELECT m.id, m.sujet, m.contenu, m.piecejointe, um.date, CONCAT_WS(' ', p.nom_prof, p.prenom_prof) AS username, role
                FROM messages m, users_messages um, users u, profpermanents p
                WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID and m.id = $id and p.user_id = u.id and role like 'profpermanent'
              UNION 
                SELECT m.id, m.sujet, m.contenu, m.piecejointe, um.date, CONCAT_WS(' ', p.nom_vacataire, p.prenom_vacataire) AS username, role
                FROM messages m, users_messages um, users u, vacataires p
                WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID and m.id = $id and p.user_id = u.id and role like 'profvacataire'
            ")->fetchAll('assoc');
            }
            else
            {
                if($test = $cnx->execute("SELECT * FROM diffusions_messages WHERE message_id = $id and typerecepteur like 'etudiantsParFiliereSco'")->fetchAll('assoc') != null){

                    $msg = $cnx->execute("
                        SELECT m.id, m.sujet, m.contenu, m.piecejointe, dm.date,CONCAT_WS(' ', n.libile, f.libile) AS username, 'etudiant' as role FROM messages m,
                        diffusions_messages dm, groupes grp, filieres f, niveaus n
                        WHERE m.id = dm.message_id and dm.user_id = $monID  and grp.id = dm.group_id 
                        and grp.filiere_id = f.id and grp.niveaus_id = n.id and m.id = $id  ")->fetchAll('assoc');
                }
                else if($test = $cnx->execute("SELECT * FROM diffusions_messages WHERE message_id = $id and typerecepteur like 'profsParFiliere' ")->fetchAll('assoc') != null){

                    $msg = $cnx->execute("
                        SELECT m.id, m.sujet, m.contenu, m.piecejointe, dm.date,CONCAT_WS(' ', n.libile, f.libile) AS username, 'prof' as role FROM messages m,
                        diffusions_messages dm, groupes grp, filieres f, niveaus n
                        WHERE m.id = dm.message_id and dm.user_id = $monID  and grp.id = dm.group_id 
                        and grp.filiere_id = f.id and grp.niveaus_id = n.id and m.id = $id  ")->fetchAll('assoc');
                }
                else if($test = $cnx->execute("SELECT * FROM diffusions_messages WHERE message_id = $id and typerecepteur like 'profsParDept' ")->fetchAll('assoc') != null){

                    $msg = $cnx->execute("
                    SELECT m.id, m.sujet, m.contenu, m.piecejointe, dm.date,dept.nom_departement username, 'prof' as role
                    FROM messages m, diffusions_messages dm, departements dept
                    WHERE m.id = dm.message_id and dm.user_id = $monID and
                    typerecepteur like 'profsParDept' and dept.id = departement_id and m.id = $id
                    ")->fetchAll('assoc');
                }
                else if($test = $cnx->execute("SELECT * FROM diffusions_messages WHERE message_id = $id and typerecepteur like 'etudiants' ")->fetchAll('assoc') != null)
                {
                    // tout role etudiant
                    $msg = $cnx->execute("
                    SELECT m.id, m.sujet, m.contenu, m.piecejointe, dm.date,'tout les etudiants de l école' as username, 'etudiant' as role
                    FROM messages m, diffusions_messages dm
                    WHERE m.id = dm.message_id and dm.user_id = $monID and
                    typerecepteur like 'etudiants' and m.id = $id
                    ")->fetchAll('assoc');
                }
                else{
                    // tout role etudiant
                    $msg = $cnx->execute("
                    SELECT m.id, m.sujet, m.contenu, m.piecejointe, dm.date,'tout les professeurs de l école' as username, 'prof' as role
                    FROM messages m, diffusions_messages dm
                    WHERE m.id = dm.message_id and dm.user_id = $monID and
                    typerecepteur like 'profs' and m.id = $id
                    ")->fetchAll('assoc');
                }
               

            }
            $this->set('me','me');
        }
        else {
            $this->set('me','');
            $msg = $cnx->execute("
            SELECT CONCAT_WS(' ', e.nom_fr, e.prenom_fr) AS username,role, m.sujet, m.contenu, m.piecejointe , TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
            FROM users_messages umg, messages m, users u, etudiants e
            where umg.user_id = u.id and umg.message_id  = m.id and m.id = $id and e.user_id = u.id and role like 'etudiant'
          UNION 
            SELECT CONCAT_WS(' ', p.nom_prof, p.prenom_prof) AS username, role, m.sujet, m.contenu, m.piecejointe , TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
            FROM users_messages umg, messages m, users u, profpermanents p
            where umg.user_id = u.id and umg.message_id  = m.id and m.id = $id and p.user_id = u.id and role like 'profpermanent'
          UNION 
            SELECT CONCAT_WS(' ', p.nom_vacataire, p.prenom_vacataire) AS username, role, m.sujet, m.contenu, m.piecejointe , TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
            FROM users_messages umg, messages m, users u, vacataires p
            where umg.user_id = u.id and umg.message_id  = m.id and m.id = $id and p.user_id = u.id and role like 'profvacataire'
            
            ")->fetchAll('assoc');
        }
        //$msg=$cnx->execute("SELECT * FROM messages m where $id = m.id ")->fetchAll('assoc');
        $this->set('msgs',$msg);
        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $this->render('/Espaces/resposcolarites/lireMsgSco');
    }

    public function envoyermsg() {
        $cnx=ConnectionManager::get('default');
        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $detinateur = $this->Auth->user('id');
        // $detinataire = $dest[0]['id'];
        $sujet = $this->request->getData('sujet');
        $contenu = $this->request->getData('contenu');



        $msg=$cnx->execute("SELECT MAX(id) as id FROM messages ")->fetchAll('assoc');
        // Upload file
        //$extention = substr($this->request->getData('attachment')["type"],-3);
        $nomFichier = $this->request->getData('attachment')["name"];
        $nomFichier = $this->suppAccent($nomFichier);
        if(strcmp($this->request->getData('attachment')["name"],'') != 0)
        {
            $attachementPath = "/Ensaksite/webroot/messageriesFiles/" . $msg['0']['id'] . $nomFichier;
            move_uploaded_file($this->request->getData('attachment')["tmp_name"], 'messageriesFiles/'.$msg['0']['id'].$nomFichier );
        }
        else
            $attachementPath = '';

        $cnx->insert('messages',
            [
                'sujet' => $sujet,
                'contenu' => $contenu,
                'piecejointe' => $attachementPath
            ]
        );
        $msg=$cnx->execute("SELECT MAX(id) as id FROM messages ")->fetchAll('assoc');
        Time::setToStringFormat('yyyy-MM-dd HH:mm:ss');
        $destStr = explode("*",$this->request->getData('destinataire'));
        //$typerecepteur = '';
        if(strcmp($destStr[0],"tout") == 0)
        {
            if(strcmp($destStr[1],"etudiants") == 0) {
                //destinataire => tout les etudiants de l ecole
                $typerecepteur = 'etudiants';
                $grpID = null;
                $deptID = null;
            }
            else {
                //destinataire => tout les profs de l ecole
                $typerecepteur = 'profs';
                $grpID = null;
                $deptID = null;
            }
        }
        if(strcmp($destStr[0],"etudiants") == 0) {
            //destinataire => etudiants par filière
            $typerecepteur = 'etudiantsParFiliereSco';
            $dest = $cnx->execute("SELECT DISTINCT grp.id FROM groupes grp, filieres f, niveaus n 
            WHERE grp.niveaus_id = (SELECT niv.id FROM niveaus niv WHERE niv.libile like '$destStr[1]')
            AND grp.filiere_id = (SELECT fil.id FROM filieres fil WHERE fil.libile like '$destStr[2]') ")->fetchAll('assoc');
            $grpID = $dest[0]['id'];
            $deptID = null;
        }
        if(strcmp($destStr[0],"professeurs") == 0)
        {
            if(strcmp($destStr[1],"parfiliere") == 0)
            {
                //destinataire => profs par filière
              $typerecepteur = 'profsParFiliere';
              $dest = $cnx->execute("SELECT DISTINCT grp.id FROM groupes grp, filieres f, niveaus n 
              WHERE grp.niveaus_id = (SELECT niv.id FROM niveaus niv WHERE niv.libile like '$destStr[2]')
              AND grp.filiere_id = (SELECT fil.id FROM filieres fil WHERE fil.libile like '$destStr[3]') ")->fetchAll('assoc');
              $grpID = $dest[0]['id'];
              $deptID = null;
            }
            else {
                //destinataire => profs par département
                $typerecepteur = 'profsParDept';
                $grpID = null;
                $deptID = $destStr[2];
            }
        }
        if(strcmp($destStr[0],"unique") == 0){
           // die($dest[0]);
            // -----use of user_message table
            $session = $this->request->session();
            $session->delete('typeDest');
            //

            $cnx->insert('users_messages',
                [
                    'message_id' => $msg['0']['id'],
                    'user_id' => $detinateur,
                    'user_idrecepteur' => $destStr[1],
                    'date' => Time::now()
                ]
            );
        }
        else
            {
            $cnx->insert('diffusions_messages',
                [
                    'message_id' => $msg['0']['id'],
                    'user_id' => $detinateur,
                    'typerecepteur' => $typerecepteur,
                    'group_id' => $grpID,
                    'departement_id' => $deptID,
                    'date' => Time::now()
                ]
            );
        }
        $this->Flash->success('Votre message est envoyé');
        $this->boiteRecSco();
    }

    public function getMsgsEnvoye()
    {
        $cnx=ConnectionManager::get('default');
        $monID = $this->Auth->user('id');
        $mesMsgsN = $cnx->query("
            SELECT m.id, m.sujet, m.contenu, m.piecejointe, um.date, CONCAT_WS(' ', e.nom_fr, e.prenom_fr) AS username,role
            FROM messages m, users_messages um, users u, etudiants e
            WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID and e.user_id = u.id and role like 'etudiant'
          UNION 
            SELECT m.id, m.sujet, m.contenu, m.piecejointe, um.date, CONCAT_WS(' ', p.nom_prof, p.prenom_prof) AS username,role
            FROM messages m, users_messages um, users u, profpermanents p
            WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID and p.user_id = u.id and role like 'profpermanent'
          UNION 
            SELECT m.id, m.sujet, m.contenu, m.piecejointe, um.date, CONCAT_WS(' ', p.nom_vacataire, p.prenom_vacataire) AS username,role
            FROM messages m, users_messages um, users u, vacataires p
            WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID and p.user_id = u.id and role like 'profvacataire'
            ORDER BY date
            ")->fetchAll('assoc');

        $mesMsgsDiff = $cnx->query("
            SELECT m.id, m.sujet, m.contenu, m.piecejointe, dm.date,CONCAT_WS(' ', n.libile, f.libile) AS username, role
            FROM messages m, diffusions_messages dm, groupes grp, filieres f, niveaus n, users u
            WHERE u.id = $monID and m.id = dm.message_id and dm.user_id = $monID and 
            typerecepteur like 'etudiantsParFiliereSco' and grp.id = dm.group_id and grp.filiere_id = f.id and grp.niveaus_id = n.id ORDER BY date
            ")->fetchAll('assoc');
        $mesMsgsDiffProfF = $cnx->query("
            SELECT m.id, m.sujet, m.contenu, m.piecejointe, dm.date,CONCAT_WS(' ', n.libile, f.libile) AS username, role 
            FROM messages m, diffusions_messages dm, groupes grp, filieres f, niveaus n, users u
            WHERE u.id = $monID and m.id = dm.message_id and dm.user_id = $monID and 
            typerecepteur like 'profsParFiliere' and grp.id = dm.group_id and grp.filiere_id = f.id and grp.niveaus_id = n.id ORDER BY date ")->fetchAll('assoc');
        $mesMsgsDiffProfD = $cnx->query("
            SELECT m.id, m.sujet, m.contenu, m.piecejointe, dm.date,dept.nom_departement username, role 
            FROM messages m, diffusions_messages dm, departements dept, users u
            WHERE u.id = $monID and m.id = dm.message_id and dm.user_id = $monID and 
            typerecepteur like 'profsParDept' and dept.id = departement_id ORDER BY date ")->fetchAll('assoc');
        $mesMsgsDiffTP = $cnx->query("
            SELECT m.id, m.sujet, m.contenu, m.piecejointe, dm.date,'tout les etudiants de l école' as username, role 
            FROM messages m, diffusions_messages dm, users u
            WHERE u.id = $monID and m.id = dm.message_id and dm.user_id = $monID and 
            typerecepteur like 'etudiants' ORDER BY date ")->fetchAll('assoc');
        $mesMsgsDiffTE = $cnx->query("
            SELECT m.id, m.sujet, m.contenu, m.piecejointe, dm.date,'tout les professeurs de l école' as username, role 
            FROM messages m, diffusions_messages dm, users u
            WHERE u.id = $monID and m.id = dm.message_id and dm.user_id = $monID and 
            typerecepteur like 'profs' ORDER BY date ")->fetchAll('assoc');

        $this->set('mesMsgsN',$mesMsgsN);
        $this->set('mesMsgsDiff',$mesMsgsDiff);
        $this->set('mesMsgsDiffProfF',$mesMsgsDiffProfF);
        $this->set('mesMsgsDiffProfD',$mesMsgsDiffProfD);
        $this->set('mesMsgsDiffTE',$mesMsgsDiffTP);
        $this->set('mesMsgsDiffTP',$mesMsgsDiffTE);

        $this->set('displaySent',"sent");
        $this->boiteRecSco();
    }

    public function supprimerMsg()
    {
        // debug($this->request->getData('msgChecked'));
        $deletTab = $this->request->getData('msgChecked');
        if (count($deletTab) > 0) {
            $cnx = ConnectionManager::get('default');
            foreach ($deletTab as $delM) {
                // $cnx->query("DELETE FROM messages WHERE id = $delM ");
                $cnx->insert('asupprimer',
                    [
                        'message_id' => $delM,
                        'user_id' => $this->Auth->user('id'),
                    ]
                );
            }
            $this->Flash->success('Supprimé avec succes');
        }
        else
            $this->Flash->error('Veuillez séléctionner au moins un message!');
        $this->boiteRecSco();
    }

    function suppAccent($chaine)
    {
        $a = array("ä", "â", "à");
        $chaine = str_replace($a, "a", $chaine);


        $e = array("é", "è", "ê", "ë");
        $chaine = str_replace($e, "e", $chaine);

        $c = array("ç");
        $chaine = str_replace($c, "c", $chaine);

        return $chaine;

    }

    /****** Fin FADILI ********/

    /**** Abdessamad et Taha *****/

    // fonctions etudiants////////////////////////////////////////


    public function addEtudiant()
    {


        $etudiants = TableRegistry::get('etudiants');

        if ($this->request->is('post')) {
            $etudiant = $etudiants->newEntity();
            $etudiant = $etudiants->patchEntity($etudiant, $this->request->data);
            if ($etudiants->save($etudiant)) {
                $this->Flash->success(__('The {0} has been saved.', 'etudiant'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'etudiant'));
            }
        }
        $users = $etudiants->Users->find('list');
        $certificats = $etudiants->Certificats->find('list');
        $this->set(compact('etudiant', 'users', 'certificats'));
        $this->set('_serialize', ['etudiant']);

        $this->render('/Espaces/resposcolarites/addEtudiant');

    }


    public function addUser()
    {
        $users = TableRegistry::get('users');
        $etudiants = TableRegistry::get('etudiants');
        $etudiers = TableRegistry::get('etudiers');
        $user = $users->newEntity();

        if ($this->request->is('post')) {
            $user = $users->patchEntity($user, $this->request->data);
            if ($users->save($user)) {
                $etudiant = $etudiants->newEntity([
                    'user_id' => $user->get('id'),'cne' => $user->get('username')]);
                $etudiants->save($etudiant);
                $anes=$this->anneeScolaireId()[0]['id'];
                $elements=$this->getElements();
                foreach ($elements as $element) {
                    //echo $anes."</br>"; die();
                    $etudier = $etudiers->newEntity([
                        'etudiant_id' => $etudiant->get('id'),'groupe_id' => 1, 'annee_scolaire_id' => $anes , 'element_id' => $element['id']
                    ]);
                    $etudiers->save($etudier);
                }


                $this->Flash->success(__('The {0} a été enregistré.', 'user'));
                return $this->redirect(['action' => 'etudiantListe']);
            } else {
                $this->Flash->error(__('l\'etudiant  {0} n\'a pas pu etre enregistré. Ressayer s\'il vous plait.', 'user'));
            }
        }
        $this->set(compact('user','etudiants'));
        $this->set('_serialize', ['user']);

        $this->render('/Espaces/resposcolarites/addUser');
    }


    public function etudiantListe()
    {
        $groupes = TableRegistry::get('groupes');
        $groupe = $groupes->newEntity();
        $groupe = $groupes->patchEntity($groupe, $this->request->data);
        $groupe = $groupes->find('all',['contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $groupes->Niveaus->find('list');
        $filieres = $groupes->Filieres->find('list');

        $etudiant = TableRegistry::get('etudiants')
        ;
        $etudiants = $this->paginate($etudiant,['contain' => ['Users','Etudiers' => ['Elements','Groupes'=>['Niveaus','Filieres']]]
        ]);
        $this->set(compact('etudiants','Users','Etudiers','Elements','groupe','Niveaus','Filieres'));
        $this->set('_serialize', ['etudiants','groupe']);
        $this->render('/Espaces/resposcolarites/etudiantListe');
    }
    public function viewEtudiant($id = null)
    {
        $etudiants = TableRegistry::get('etudiants');
        $etudiant = $etudiants->get($id, [
            'contain' => ['Users', 'Certificats', 'Etudiers' => ['Elements','Groupes'=>['Niveaus','Filieres']]]
        ]);

        $this->set(compact('etudiant','Users', 'Certificats', 'Etudiers','Elements','Groupes','Niveaus','Filieres'));
        $this->set('_serialize', ['etudiant']);
        $this->render('/Espaces/resposcolarites/viewEtudiant');

    }
    public function editEtudiant($id = null)
    {
        $etudiants = TableRegistry::get('etudiants');
        $etudiant = $etudiants->get($id, [
            'contain' => ['Certificats']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $etudiant = $etudiants->patchEntity($etudiant, $this->request->data);
            if ($etudiants->save($etudiant)) {
                $this->Flash->success(__('Les informations ont été enregistré avec success.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Les informations de l\'etudiant {0} n\'ont pas pu être enregistré. Réessayer s\'il vous plait.', 'Etudiant'));
            }
        }
        $users = $etudiants->Users->find('list');
        $certificats = $etudiants->Certificats->find('list');
        $this->set(compact('etudiant', 'users', 'certificats'));
        $this->set('_serialize', ['etudiant']);
        $this->render('/Espaces/resposcolarites/editEtudiant');
    }
    public function deleteEtudiant($id = null)
    {
        $etudiants = TableRegistry::get('etudiants');
        $this->request->allowMethod(['post', 'delete']);
        $etudiant = $etudiants->get($id);
        $users = TableRegistry::get('users');
        $user = $users
            ->find()
            ->where(['id' => $etudiant]);
        $us_id=$user->select(['id']);
        if ($users->delete($us_id) AND $etudiants->delete($etudiant)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Etudiant'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Etudiant'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function printEtudiant($id = null)
    {

        $etudiants = TableRegistry::get('etudiants');
        $etudiant = $etudiants->get($id, [
            'contain' => ['Users', 'Certificats', 'Etudiers' => ['Elements','Groupes'=>['Niveaus','Filieres']]]
        ]);

        $this->set(compact('etudiant','Users', 'Certificats', 'Etudiers','Elements','Groupes','Niveaus','Filieres'));
        $this->set('_serialize', ['etudiant']);
        $this->render('/Espaces/resposcolarites/printEtudiant');

    }
    public function printListeEtudiant()
    {
        $etudiant = TableRegistry::get('etudiants');
        $etudiants = $this->paginate($etudiant);
        $this->paginate = [
            'contain' => ['Users']
        ];


        $this->set(compact('etudiants'));
        $this->set('_serialize', ['etudiants']);
        $this->render('/Espaces/resposcolarites/printListeEtudiant');
    }
    public function printClasse($id=null)
    {

        $groupes = TableRegistry::get('groupes');
        $groupe = $groupes->newEntity();
        // echo "here";die();
        // $groupe = $groupes->patchEntity($groupe, $this->request->data);

        $groupe = $groupes->find('all',['contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $groupes->Niveaus->find('list');
        $filieres = $groupes->Filieres->find('list');

        $etudiant = TableRegistry::get('etudiants');
        //$etudiant = $etudiants->newEntity();
        $this->paginate($etudiant,['contain' => ['Users','Etudiers' => ['Elements','Groupes'=>['Niveaus','Filieres']]]
        ]);
        //$query = $etudiant->find('all')->where(['Etudiers.groupe_id' => $this->request->data['groupes']]);
        //$etudiants = $this->paginate($etudiant);




        $query = $etudiant->find('all',[
            'join' => [
                'table' => 'Etudiers',
                'type' => 'INNER',
                'conditions' => 'Etudiers.etudiant_id = Etudiants.id'],
            'conditions'=>['Etudiers.groupe_id' => $id,


            ]])->distinct();
        $etudiants =  $this->paginate($query);



        // $etudiants = $this->paginate($etudiant,['contain' => ['Users','Etudiers' => ['Elements','Groupes'=>['Niveaus','Filieres']]]
        // ]);

        // $this->set(compact('etudiants','Users','Elements','groupe','Groupes','Niveaus','Filieres'));
        // $this->set('_serialize', ['etudiants','groupe']);
        $this->set(compact('etudiants','groupe','Etudiers'));
        $this->set('_serialize', ['etudiants','groupe']);
        $this->render('/Espaces/resposcolarites/printClasse');
    }
    public function exportEtudiants($limit=9000)
    {
        $cat=$_POST["cat"];
        $_SESSION['cat']=$cat;
        switch ($_POST['filtre']) {
            case 'Rechercher un nom':
                $etudiants=TableRegistry::get('etudiants')->find('all',['contain' => ['Users','Etudiers' => ['Elements','Groupes'=>['Niveaus','Filieres']]]
                ])->limit($limit)->where(['nom_fr like'=>'%'.$cat.'%']);
                break;
            case 'Rechercher un CNE':
                $etudiants=TableRegistry::get('etudiants')->find('all',['contain' => ['Users','Etudiers' => ['Elements','Groupes'=>['Niveaus','Filieres']]]
                ])->limit($limit)->where(['CNE like'=>'%'.$cat.'%']);
                break;
            case 'Rechercher un CIN':
                $etudiants=TableRegistry::get('etudiants')->find('all',['contain' => ['Users','Etudiers' => ['Elements','Groupes'=>['Niveaus','Filieres']]]
                ])->limit($limit)->where(['cin like'=>'%'.$cat.'%']);
                break;
            case 'Rechercher un prenom':
                $etudiants=TableRegistry::get('etudiants')->find('all',['contain' => ['Users','Etudiers' => ['Elements','Groupes'=>['Niveaus','Filieres']]]
                ])->limit($limit)->where(['prenom_fr like'=>'%'.$cat.'%']);
                break;
            default : $etudiants=TableRegistry::get('etudiants')->find('all',['contain' => ['Users','Etudiers' => ['Elements','Groupes'=>['Niveaus','Filieres']]]
            ])->limit($limit)->where(['nom_fr like'=>'%'.$cat.'%']);
                break;
        }
        $this->set(compact('etudiants'));
        $this->set('_serialize', ['etudiants']);
        $this->render('/Espaces/resposcolarites/exportEtudiants');

    }
    public function printListeTri($limit=100)
    {

        $etudiant=TableRegistry::get('etudiants')->find('all')->limit($limit)->where(['nom_fr like'=>'%'.$_SESSION['cat'].'%']);;
        $etudiants = $this->paginate($etudiant);
        $this->paginate = [
            'contain' => ['Users']
        ];


        $this->set(compact('etudiants'));
        $this->set('_serialize', ['etudiants']);
        $this->render('/Espaces/resposcolarites/printListeTri');
    }
    public function trierEtudiants()
{
    $this->set(compact('etudiants'));
    $this->render('/Espaces/resposcolarites/trierEtudiants');
}
    public function Migrer($id = null)
    {
        $users = TableRegistry::get('users');
        $etudiants = TableRegistry::get('etudiants');
        $preinscriptions= TableRegistry::get('preinscriptions');
        $preinscri = $preinscriptions->get($id);
        $date1 = $preinscri->date_naissance;
        $new_date=$date1->format('dmY');
// nouveau champ user
        $user = $users->newEntity([
            'username' => $preinscri->get('cne'),'password' => $new_date, 'role' => 'etudiant']);

        if ($this->request->is('post')) {
            $user = $users->patchEntity($user, $this->request->data);
            if ($users->save($user)) {
                $etudiant = $etudiants->newEntity([
                    'user_id' => $user->get('id'),
                    'cne' => $user->get('username'),
                    'date_naissance' =>$preinscri->get('date_naissance'),
                    'nom_fr' =>$preinscri->get('nom_fr'),
                    'nom_ar' =>$preinscri->get('nom_ar'),
                    'prenom_fr' =>$preinscri->get('prenom_fr'),
                    'prenom_ar' =>$preinscri->get('prenom_ar'),
                    'cne' =>$preinscri->get('cne'),
                    'cin' =>$preinscri->get('cin'),
                    'code_ville_naissance' =>$preinscri->get('code_ville_naissance'),
                    'ville_naissance_fr' =>$preinscri->get('ville_naissance_fr'),
                    'ville_naissance_ar' =>$preinscri->get('ville_naissance_ar'),
                    'code_pays_naissance' =>$preinscri->get('code_pays_naissance'),
                    'pays_naissance_fr' =>$preinscri->get('pays_naissance_fr'),
                    'pays_naissance_ar' =>$preinscri->get('pays_naissance_ar'),
                    'code_sexe' =>$preinscri->get('code_sexe'),
                    'sexe_fr' =>$preinscri->get('sexe_fr'),
                    'sexe_ar' =>$preinscri->get('sexe_ar'),
                    'code_adresse_fix' =>$preinscri->get('code_adresse_fix'),
                    'adresse_fix_fr' =>$preinscri->get('adresse_fix_fr'),
                    'adresse_fix_ar' =>$preinscri->get('adresse_fix_ar'),
                    'adresse_annulle_fr' =>$preinscri->get('adresse_annulle_fr '),
                    'adresse_annulle_ar' =>$preinscri->get('adresse_annulle_ar '),
                    'annee_1er_inscription_universite' =>$preinscri->get('annee_1er_inscription_universite'),
                    'annee_1er_inscription_enseignement_superieur' =>$preinscri->get('annee_1er_inscription_enseignement_superieur'),
                    'annee_1er_inscription_universite_marocaine' =>$preinscri->get('annee_1er_inscription_universite_marocaine'),
                    'code_type_handicap' =>$preinscri->get('code_type_handicap'),
                    'type_handicap' =>$preinscri->get('type_handicap'),
                    'code_type_hebergement' =>$preinscri->get('code_type_hebergement'),
                    'type_hebergement' =>$preinscri->get('type_hebergement'),
                    'code_situation_familiale' =>$preinscri->get('code_situation_familiale'),
                    'situation_familiale' =>$preinscri->get('situation_familiale'),
                    'situation_militair' =>$preinscri->get('situation_militair'),
                    'categorie_socio_professionnelle' =>$preinscri->get('categorie_socio_professionnelle'),
                    'domaine_activite_professionnelle' =>$preinscri->get('domaine_activite_professionnelle'),
                    'quantite_Travaillee' =>$preinscri->get('quantite_Travaillee'),
                    'profession_pere_fr' =>$preinscri->get('profession_pere_fr'),
                    'profession_pere_ar' =>$preinscri->get('profession_pere_ar'),
                    'profession_mere_fr' =>$preinscri->get('profession_mere_fr'),
                    'profession_mere_ar' =>$preinscri->get('profession_mere_ar'),
                    'code_province_parents' =>$preinscri->get('code_province_parents'),
                    'province_parents_fr' =>$preinscri->get('province_parents_fr'),
                    'province_parents_ar' =>$preinscri->get('province_parents_ar'),
                    'email' =>$preinscri->get('email'),
                    'numero_tel' =>$preinscri->get('tel')
                ]);
                //rename('foo/test.php', 'bar/test.php');
                $etudiants->save($etudiant);

                $this->Flash->success(__('The {0} a été enregistré.', 'user'));
                return $this->redirect(['action' => 'etudiantListe']);
            } else {
                $this->Flash->error(__('l\'etudiant  {0} n\'a pas pu etre enregistré. Ressayer s\'il vous plait.', 'user'));
            }
        }
        $this->set(compact('user','etudiants','preinscriptions'));
        $this->set('_serialize', ['user']);
        return $this->redirect(['action' => 'etudiantListe']);


    }

    private function genererAnneeScolaire() {
        $year = (int)date("Y");
        $month = (int)date("M");

        if ($month <= 6) {
            $y1 = $year-1;
            return $y1.'/'.$year;
        }
        else{
            $y1 = $year+1;
            return $year.'/'.$y1;
        }
    }


    private function anneeScolaireId(){
        $annee_lib = $this->genererAnneeScolaire();
        $conn = ConnectionManager::get('default');
        $row = $conn->execute(
            "SELECT a.id FROM annee_scolaires a WHERE a.libile = '$annee_lib'"
        );
        return $row->fetchAll('assoc');
    }
    private function getElements(){
        $annee_lib = $this->genererAnneeScolaire();
        $conn = ConnectionManager::get('default');
        return $conn->execute("SELECT DISTINCT e.* 
        FROM elements e, modules m, groupes g
        WHERE m.groupe_id = g.id AND 
        g.id = 1 AND
        e.module_id IN (SELECT m.id FROM modules m WHERE m.groupe_id = 1)
        GROUP BY e.id");
    }
    public function sortClasse(){

        $groupes = TableRegistry::get('groupes');
        $groupe = $groupes->newEntity();

        $groupe = $groupes->find('all',['contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $groupes->Niveaus->find('list');
        $filieres = $groupes->Filieres->find('list');

        $etudiant = TableRegistry::get('etudiants');

        $query = $etudiant->find('all',[
            'join' => [
                'table' => 'Etudiers',
                'type' => 'INNER',
                'conditions' => 'Etudiers.etudiant_id = Etudiants.id'],
            'conditions'=>['Etudiers.groupe_id' => $this->request->data['groupes'],

            ]])->distinct();
        $etudiants =  $this->paginate($query,['contain' => ['Users','Etudiers' => ['Elements','Groupes'=>['Niveaus','Filieres']]]
        ]);

        $this->set(compact('etudiants','groupe','niveaus','filieres'));
        $this->set('_serialize', ['etudiants','groupe']);
        $this->render('/Espaces/resposcolarites/sortClasse');
    }

    public function droitModif($id = null)
    {

        $etudiants = TableRegistry::get('etudiants');
        $etudiant = $etudiants->get($id);
        $etudiant->validi = 0;
        $etudiant->valid_respo = 0;
        if($etudiants->save($etudiant)){
            $this->Flash->success(__('le {0} peut modifier ses informations', 'etudiant'));
        } else {
            $this->Flash->error(__('votre requete n\'a pas pu être etabli', 'etudiant'));
        }

        return $this->redirect(['action' => 'etudiantListe']);
    }

    public function validerInfos($id = null)
    {

        $etudiants = TableRegistry::get('etudiants');
        $etudiant = $etudiants->get($id);
        $etudiant->validi = 1;
        $etudiant->valid_respo = 1;
        if($etudiants->save($etudiant)){
            $this->Flash->success(__('les informations de l\'etudiant ont été validé', 'etudiant'));
        } else {
            $this->Flash->error(__('votre requete n\'a pas pu être etabli', 'etudiant'));
        }

        return $this->redirect(['action' => 'etudiantListe']);
    }

//////////////////////////////!TAHA/////////////////////////////////////////

//////////////////////////////ABDESSAMAD/////////////////////////////////////////
    //Liste des concours
    public function listeConcours()
    {
        $concour = TableRegistry::get('concours');
        $this->paginate = [
            'contain' => ['Niveaus', 'Filieres']
        ];
        $concours = $this->paginate($concour);
        $this->set(compact('concours'));
        $this->set('_serialize', ['concours']);
        $this->render('/Espaces/resposcolarites/listeConcours');
    }

    //Lancer un concours
    public function lancerConcours($id = null)
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->get($id, [
            'contain' => ['Niveaus', 'Filieres']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $concour = $concours->patchEntity($concour, $this->request->data);
            if ($concours->save($concour)) {
                $this->Flash->success(__('Le {0} été lancé.', 'concour'));
                return $this->redirect(['action' => 'listeConcours']);
            } else {
                $this->Flash->error(__('{0}', 'Erreur'));
            }
        }
        $niveaus = $concours->Niveaus->find('list');
        $filieres = $concours->Filieres->find('list');
        $this->set(compact('concour', 'niveaus', 'filieres'));
        $this->set('_serialize', ['concour']);
        $this->render('/Espaces/resposcolarites/lancerConcours');
    }

    //Fermer un concours
    public function fermer($id = null)
    {

        $concours = TableRegistry::get('concours');
        $concour = $concours->get($id);
        $concour->etat = 0;
        $concour->date_debut = null;
        $concour->date_fin = null;
        if($concours->save($concour)){
            $this->Flash->success(__('le {0} est bien fermé.', 'Concour'));
        } else {
            $this->Flash->error(__('le {0} ne peut pas etre fermer.', 'Concour'));
        }

        return $this->redirect(['action' => 'listeConcours']);
    }

    //Liste des Préinscris dans tous les concours
    public function listePreinscris()
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->newEntity();
        $concour = $concours->patchEntity($concour, $this->request->data);
        $concour = $concours->find('all',['conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $concours->Niveaus->find('list');
        $filieres = $concours->Filieres->find('list');

        $preinscription = TableRegistry::get('preinscriptions');
        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];

        $query = $preinscription->find('all')->where(['cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);

        $this->set(compact('preinscriptions','concour', 'niveaus', 'filieres'));
        $this->set('_serialize', ['preinscriptions','concour']);
        $this->render('/Espaces/resposcolarites/listePreinscris');
    }


    //Liste des preinscris dans chaque concours
    public function listePreinscrisConcours()
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->newEntity();
        $concour = $concours->patchEntity($concour, $this->request->data);
        $concour = $concours->find('all',['conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $concours->Niveaus->find('list');
        $filieres = $concours->Filieres->find('list');

        $preinscription = TableRegistry::get('preinscriptions');


        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['concour_id' => $this->request->data['Concours'],'cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);

        $this->set(compact('preinscriptions','concour', 'niveaus', 'filieres'));
        $this->set('_serialize', ['preinscriptions','concour']);
        $this->render('/Espaces/resposcolarites/listePreinscrisConcours');
    }

    //Liste des preinscris dans chaque concours par id concours
    public function listePreinscrisConcoursById($id = null )
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->newEntity();
        $concour = $concours->patchEntity($concour, $this->request->data);
        $concour = $concours->find('all',['conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $concours->Niveaus->find('list');
        $filieres = $concours->Filieres->find('list');

        $preinscription = TableRegistry::get('preinscriptions');


        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['concour_id' => $id,'cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);

        $this->set(compact('preinscriptions','concour', 'niveaus', 'filieres'));
        $this->set('_serialize', ['preinscriptions','concour']);
        $this->render('/Espaces/resposcolarites/listePreinscrisConcours');
    }


    //Presselecionné un candidats
    public function preselectione($id = null)
    {

        $preinscriptions = TableRegistry::get('preinscriptions');
        $preinscription = $preinscriptions->get($id);
        $preinscription->preselection = 1;
        if($preinscriptions->save($preinscription)){
            $this->Flash->success(__('le {0} est bien selectionné.', 'preinscription'));
        } else {
            $this->Flash->error(__('le {0} ne peut pas etre selectionné.', 'preinscription'));
        }

        return $this->redirect(['action' => 'listePreinscris']);
    }

    //Presselecionné les candidats selectionnés
    public function preselectioneGroupe()
    {
        $tabSelected = $this->request->data['ListPreselecione'];
        $preinscriptions = TableRegistry::get('preinscriptions');
        foreach ($tabSelected as $tbSelected) {
            if($tbSelected != 0){
                $preinscription = $preinscriptions->get($tbSelected);
                $preinscription->preselection = 1;
                $preinscriptions->save($preinscription);
            }

        }

        return $this->redirect(['action' => 'listePreinscris']);
    }


    //Liste des candidats préselecionnés
    public function listePreselectiones()
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->newEntity();
        $concour = $concours->patchEntity($concour, $this->request->data);
        $concour = $concours->find('all',['conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $concours->Niveaus->find('list');
        $filieres = $concours->Filieres->find('list');

        $preinscription = TableRegistry::get('preinscriptions');

        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['preselection' => 1,'cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);

        $this->set(compact('preinscriptions','concour', 'niveaus', 'filieres'));
        $this->set('_serialize', ['preinscriptions','concour']);
        $this->render('/Espaces/resposcolarites/listePreselectiones');
    }

    //Liste des candidats Préselectionnés par concours
    public function listePreselectionesConcours()
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->newEntity();
        $concour = $concours->patchEntity($concour, $this->request->data);
        $concour = $concours->find('all',['conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $concours->Niveaus->find('list');
        $filieres = $concours->Filieres->find('list');

        $preinscription = TableRegistry::get('preinscriptions');

        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['preselection' => 1,'concour_id' => $this->request->data['Concours'],'cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);

        $this->set(compact('preinscriptions','concour', 'niveaus', 'filieres'));
        $this->set('_serialize', ['preinscriptions','concour']);
        $this->render('/Espaces/resposcolarites/listePreselectionesConcours');
    }


    //candidat admis au concourslisteAttente
    public function admis($id = null)
    {


        $preinscriptions = TableRegistry::get('preinscriptions');
        $preinscription = $preinscriptions->get($id);
        $preinscription->admis = 1;
        if($preinscriptions->save($preinscription)){
            $this->Flash->success(__('le {0} est admis.', 'preinscription'));
        } else {
            $this->Flash->error(__('le {0} ne peut pas etre admis.', 'preinscription'));
        }

        return $this->redirect(['action' => 'listePreselectiones']);
    }

    //candidat en listeAttente au concours
    public function listeAttente($id = null)
    {


        $preinscriptions = TableRegistry::get('preinscriptions');
        $preinscription = $preinscriptions->get($id);
        $preinscription->listeAttente = 1;
        if($preinscriptions->save($preinscription)){
            $this->Flash->success(__('le {0} est admis.', 'preinscription'));
        } else {
            $this->Flash->error(__('le {0} ne peut pas etre admis.', 'preinscription'));
        }

        return $this->redirect(['action' => 'listePreselectiones']);
    }

    //les candidats selectionnés Admis
    public function admisGroupe()
    {
        $tabSelected = $this->request->data['ListAdmis'];
        $preinscriptions = TableRegistry::get('preinscriptions');
        $attente = $this->request->data['ListAttente'];
        if($attente){
            foreach ($tabSelected as $tbSelected) {
                if($tbSelected != 0){
                    $preinscription = $preinscriptions->get($tbSelected);
                    $preinscription->listeAttente = 1;
                    $preinscriptions->save($preinscription);
                }

            }
        }else{

            foreach ($tabSelected as $tbSelected) {
                if($tbSelected != 0){
                    $preinscription = $preinscriptions->get($tbSelected);
                    $preinscription->admis = 1;
                    $preinscriptions->save($preinscription);
                }

            }
        }

        return $this->redirect(['action' => 'listePreselectiones']);

    }


    //Liste des admis
    public function listeAdmisGeneral()
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->newEntity();
        $concour = $concours->patchEntity($concour, $this->request->data);
        $concour = $concours->find('all',['conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $concours->Niveaus->find('list');
        $filieres = $concours->Filieres->find('list');

        $preinscription = TableRegistry::get('preinscriptions');

        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['admis' => 1,'cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions','concour', 'niveaus', 'filieres'));
        $this->set('_serialize', ['preinscriptions','concour']);
        $this->render('/Espaces/resposcolarites/listeAdmisGeneral');
    }

    //Listes d'attentes
    public function listesAttentes()
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->newEntity();
        $concour = $concours->patchEntity($concour, $this->request->data);
        $concour = $concours->find('all',['conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $concours->Niveaus->find('list');
        $filieres = $concours->Filieres->find('list');

        $preinscription = TableRegistry::get('preinscriptions');

        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['listeAttente' => 1,'cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions','concour', 'niveaus', 'filieres'));
        $this->set('_serialize', ['preinscriptions','concour']);
        $this->render('/Espaces/resposcolarites/listesAttentes');
    }

    //Liste des admis par Concours
    public function listeAdmisConcours()
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->newEntity();
        $concour = $concours->patchEntity($concour, $this->request->data);
        $concour = $concours->find('all',['conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $concours->Niveaus->find('list');
        $filieres = $concours->Filieres->find('list');

        $preinscription = TableRegistry::get('preinscriptions');

        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['admis' => 1,'concour_id' => $this->request->data['Concours'],'cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions','concour', 'niveaus', 'filieres'));
        $this->set('_serialize', ['preinscriptions','concour']);
        $this->render('/Espaces/resposcolarites/listeAdmisConcours');
    }

    //Listes Attentes par Concours
    public function listeAttenteConcours()
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->newEntity();
        $concour = $concours->patchEntity($concour, $this->request->data);
        $concour = $concours->find('all',['conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $concours->Niveaus->find('list');
        $filieres = $concours->Filieres->find('list');

        $preinscription = TableRegistry::get('preinscriptions');

        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['listeAttente' => 1,'concour_id' => $this->request->data['Concours'],'cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions','concour', 'niveaus', 'filieres'));
        $this->set('_serialize', ['preinscriptions','concour']);
        $this->render('/Espaces/resposcolarites/listeAttenteConcours');
    }

    //Imprimer Liste des admis
    public function printListeAdmis()
    {
        $preinscription = TableRegistry::get('preinscriptions');

        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['admis' => 1,'cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions'));
        $this->set('_serialize', ['preinscriptions']);
        $this->render('/Espaces/resposcolarites/printListeAdmis');
    }

    //Imprimer Liste des admis par concours
    public function printListeAdmisConcours($id = null)
    {
        $preinscription = TableRegistry::get('preinscriptions');

        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['admis' => 1,'concour_id' => $id,'cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions'));
        $this->set('_serialize', ['preinscriptions']);
        $this->render('/Espaces/resposcolarites/printListeAdmisConcours');
    }

    //Imprimer Listes d'attente
    public function printListeAttente()
    {
        $preinscription = TableRegistry::get('preinscriptions');

        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['listeAttente' => 1,'cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions'));
        $this->set('_serialize', ['preinscriptions']);
        $this->render('/Espaces/resposcolarites/printListeAttente');
    }

    //Imprimer Listes d'attentes par concours
    public function printListeAttenteConcours($id = null)
    {
        $preinscription = TableRegistry::get('preinscriptions');

        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['listeAttente' => 1,'concour_id' => $id,'cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions'));
        $this->set('_serialize', ['preinscriptions']);
        $this->render('/Espaces/resposcolarites/printListeAttenteConcours');
    }

    //Imprimer Liste des Présselectionés
    public function printListePreselectiones()
    {
        $preinscription = TableRegistry::get('preinscriptions');

        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['preselection' => 1,'cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions'));
        $this->set('_serialize', ['preinscriptions']);
        $this->render('/Espaces/resposcolarites/printListePreselectiones');
    }

    //Imprimer Liste des Présselectionés par concours
    public function printListePreselectionesConcours($id = null)
    {
        $preinscription = TableRegistry::get('preinscriptions');

        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['preselection' => 1,'concour_id' => $id,'cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions'));
        $this->set('_serialize', ['preinscriptions']);
        $this->render('/Espaces/resposcolarites/printListePreselectionesConcours');
    }

    //Imprimer Liste des Préinscris
    public function printListePreinscription()
    {
        $preinscription = TableRegistry::get('preinscriptions');

        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions'));
        $this->set('_serialize', ['preinscriptions']);
        $this->render('/Espaces/resposcolarites/printListePreinscription');
    }

    //Imprimer Liste des Préinscris Par concours
    public function printListePreinscriptionConcours($id = null)
    {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->paginate = [
            'contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $query = $preinscription->find('all')->where(['concour_id' => $id,'cne !=' => 'NULL']);

        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions'));
        $this->set('_serialize', ['preinscriptions']);
        $this->render('/Espaces/resposcolarites/printListePreinscriptionConcours');
    }

    //AutoComplete recherche Prinscription par CNE
    public function getAllPreInscriptionsByCne() {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];
        $results = $preinscription->find('all', [
            'conditions' => [ 'cne LIKE' => $nom . '%']
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['cne'], 'value' => $result['cne']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Preselection par CNE
    public function getAllPreSelectionsByCne() {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];
        $results = $preinscription->find('all', [
            'conditions' => [ 'cne LIKE' => $nom . '%','preselection' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['cne'], 'value' => $result['cne']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Admis par CNE
    public function getAllAdmisByCne() {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];
        $results = $preinscription->find('all', [
            'conditions' => [ 'cne LIKE' => $nom . '%','admis' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['cne'], 'value' => $result['cne']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Attente par CNE
    public function getAllAttenteByCne() {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];
        $results = $preinscription->find('all', [
            'conditions' => [ 'cne LIKE' => $nom . '%','listeAttente' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['cne'], 'value' => $result['cne']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Preinscription par CNE et par concours
    public function getAllPreInscriptionsConcoursByCne($id = null) {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];

        $results = $preinscription->find('all', [
            'conditions' => [ 'cne LIKE' => $nom . '%','concour_id' => $id]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['cne'], 'value' => $result['cne']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Preselection par CNE et par concours
    public function getAllPreSelectionsConcoursByCne($id = null) {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];

        $results = $preinscription->find('all', [
            'conditions' => [ 'cne LIKE' => $nom . '%','concour_id' => $id,'preselection' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['cne'], 'value' => $result['cne']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Admis par CNE et par concours
    public function getAllAdmisConcoursByCne($id = null) {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];

        $results = $preinscription->find('all', [
            'conditions' => [ 'cne LIKE' => $nom . '%','concour_id' => $id,'admis' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['cne'], 'value' => $result['cne']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Attente par CNE et par concours
    public function getAllAttenteConcoursByCne($id = null) {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];

        $results = $preinscription->find('all', [
            'conditions' => [ 'cne LIKE' => $nom . '%','concour_id' => $id,'listeAttente' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['cne'], 'value' => $result['cne']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Preinscription par Nom
    public function getAllPreInscriptionsByNom() {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];
        $results = $preinscription->find('all', [
            'conditions' => [ 'nom_fr LIKE' => $nom . '%']
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['nom_fr'], 'value' => $result['nom_fr']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Preselection par Nom
    public function getAllPreSelectionsByNom() {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];
        $results = $preinscription->find('all', [
            'conditions' => [ 'nom_fr LIKE' => $nom . '%','preselection' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['nom_fr'], 'value' => $result['nom_fr']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Admis par Nom
    public function getAllAdmisByNom() {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];
        $results = $preinscription->find('all', [
            'conditions' => [ 'nom_fr LIKE' => $nom . '%','admis' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['nom_fr'], 'value' => $result['nom_fr']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Attente par Nom
    public function getAllAttenteByNom() {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];
        $results = $preinscription->find('all', [
            'conditions' => [ 'nom_fr LIKE' => $nom . '%','listeAttente' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['nom_fr'], 'value' => $result['nom_fr']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Preinscription par Nom et par concours
    public function getAllPreInscriptionsConcoursByNom($id = null) {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];

        $results = $preinscription->find('all', [
            'conditions' => [ 'nom_fr LIKE' => $nom . '%','concour_id' => $id]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['nom_fr'], 'value' => $result['nom_fr']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Preselection par Nom et par concours
    public function getAllPreSelectionsConcoursByNom($id = null) {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];

        $results = $preinscription->find('all', [
            'conditions' => [ 'nom_fr LIKE' => $nom . '%','concour_id' => $id,'preselection' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['nom_fr'], 'value' => $result['nom_fr']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Admis par Nom et par concours
    public function getAllAdmisConcoursByNom($id = null) {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];

        $results = $preinscription->find('all', [
            'conditions' => [ 'nom_fr LIKE' => $nom . '%','concour_id' => $id,'admis' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['nom_fr'], 'value' => $result['nom_fr']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Attente par Nom et par concours
    public function getAllAttenteConcoursByNom($id = null) {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];

        $results = $preinscription->find('all', [
            'conditions' => [ 'nom_fr LIKE' => $nom . '%','concour_id' => $id,'listeAttente' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['nom_fr'], 'value' => $result['nom_fr']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Preinscription par PreNom
    public function getAllPreInscriptionsByPrenom() {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];
        $results = $preinscription->find('all', [
            'conditions' => [ 'prenom_fr LIKE' => $nom . '%']
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['prenom_fr'], 'value' => $result['prenom_fr']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Preselection par Prenom
    public function getAllPreSelectionsByPrenom() {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];
        $results = $preinscription->find('all', [
            'conditions' => [ 'prenom_fr LIKE' => $nom . '%','preselection' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['prenom_fr'], 'value' => $result['prenom_fr']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Admis par Prenom
    public function getAllAdmisByPrenom() {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];
        $results = $preinscription->find('all', [
            'conditions' => [ 'prenom_fr LIKE' => $nom . '%','admis' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['prenom_fr'], 'value' => $result['prenom_fr']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Attente par Prenom
    public function getAllAttenteByPrenom() {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];
        $results = $preinscription->find('all', [
            'conditions' => [ 'prenom_fr LIKE' => $nom . '%','listeAttente' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['prenom_fr'], 'value' => $result['prenom_fr']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Preinscription par PreNom et par concours
    public function getAllPreInscriptionsConcoursByPrenom($id = null) {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];

        $results = $preinscription->find('all', [
            'conditions' => [ 'prenom_fr LIKE' => $nom . '%','concour_id' => $id]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['prenom_fr'], 'value' => $result['prenom_fr']];
        }
        echo json_encode($resultsArr);
    }


    //AutoComplete recherche Preselection par PreNom et par concours
    public function getAllPreSelectionsConcoursByPrenom($id = null) {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];

        $results = $preinscription->find('all', [
            'conditions' => [ 'prenom_fr LIKE' => $nom . '%','concour_id' => $id,'preselection' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['prenom_fr'], 'value' => $result['prenom_fr']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Admis par PreNom et par concours
    public function getAllAdmisConcoursByPrenom($id = null) {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];

        $results = $preinscription->find('all', [
            'conditions' => [ 'prenom_fr LIKE' => $nom . '%','concour_id' => $id,'admis' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['prenom_fr'], 'value' => $result['prenom_fr']];
        }
        echo json_encode($resultsArr);
    }

    //AutoComplete recherche Attente par PreNom et par concours
    public function getAllAttenteConcoursByPrenom($id = null) {
        $preinscription = TableRegistry::get('preinscriptions');
        $this->autoRender = false;
        $nom = $this->request->query['term'];

        $results = $preinscription->find('all', [
            'conditions' => [ 'prenom_fr LIKE' => $nom . '%','concour_id' => $id,'listeAttente' => 1]
        ]);
        $resultsArr = [];
        foreach ($results as $result) {
            $resultsArr[] =['label' => $result['prenom_fr'], 'value' => $result['prenom_fr']];
        }
        echo json_encode($resultsArr);
    }

    //Recherche Preinscription
    public function findPreinscriptions()
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->newEntity();
        $concour = $concours->patchEntity($concour, $this->request->data);
        $concour = $concours->find('all',['conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $concours->Niveaus->find('list');
        $filieres = $concours->Filieres->find('list');

        $preinscription = TableRegistry::get('preinscriptions');
        $this->paginate = ['contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $filtre = $this->request->data['filtre'];
        switch ($filtre) {
            case 'cne':
                $query = $preinscription->find('all')->where(['cne' => $this->request->data['motif']]);
                break;
            case 'nom':
                $query = $preinscription->find('all')->where(['nom_fr' => $this->request->data['motif']]);
                break;
            case 'prenom':
                $query = $preinscription->find('all')->where(['prenom_fr' => $this->request->data['motif']]);
                break;
            default:
                $query = $preinscription->find('all')->where(['cne' => $this->request->data['motif']]);
                break;
        }
        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions','concour', 'niveaus', 'filieres'));
        $this->set('_serialize', ['preinscriptions','concour']);
        $this->render('/Espaces/resposcolarites/findPreinscriptions');
    }


    //Recherche Preselection
    public function findPreselections()
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->newEntity();
        $concour = $concours->patchEntity($concour, $this->request->data);
        $concour = $concours->find('all',['conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $concours->Niveaus->find('list');
        $filieres = $concours->Filieres->find('list');

        $preinscription = TableRegistry::get('preinscriptions');
        $this->paginate = ['contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $filtre = $this->request->data['filtre'];
        switch ($filtre) {
            case 'cne':
                $query = $preinscription->find('all')->where(['cne' => $this->request->data['motif'],'preselection' => 1]);
                break;
            case 'nom':
                $query = $preinscription->find('all')->where(['nom_fr' => $this->request->data['motif'],'preselection' => 1]);
                break;
            case 'prenom':
                $query = $preinscription->find('all')->where(['prenom_fr' => $this->request->data['motif'],'preselection' => 1]);
                break;
            default:
                $query = $preinscription->find('all')->where(['cne' => $this->request->data['motif'],'preselection' => 1]);
                break;
        }
        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions','concour', 'niveaus', 'filieres'));
        $this->set('_serialize', ['preinscriptions','concour']);
        $this->render('/Espaces/resposcolarites/findPreselections');

    }

    //Recherche Admis
    public function findAdmis()
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->newEntity();
        $concour = $concours->patchEntity($concour, $this->request->data);
        $concour = $concours->find('all',['conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $concours->Niveaus->find('list');
        $filieres = $concours->Filieres->find('list');

        $preinscription = TableRegistry::get('preinscriptions');
        $this->paginate = ['contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $filtre = $this->request->data['filtre'];
        switch ($filtre) {
            case 'cne':
                $query = $preinscription->find('all')->where(['cne' => $this->request->data['motif'],'admis' => 1]);
                break;
            case 'nom':
                $query = $preinscription->find('all')->where(['nom_fr' => $this->request->data['motif'],'admis' => 1]);
                break;
            case 'prenom':
                $query = $preinscription->find('all')->where(['prenom_fr' => $this->request->data['motif'],'admis' => 1]);
                break;
            default:
                $query = $preinscription->find('all')->where(['cne' => $this->request->data['motif'],'admis' => 1]);
                break;
        }
        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions','concour', 'niveaus', 'filieres'));
        $this->set('_serialize', ['preinscriptions','concour']);
        $this->render('/Espaces/resposcolarites/findAdmis');

    }

    //Recherche Attente
    public function findAttente()
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->newEntity();
        $concour = $concours->patchEntity($concour, $this->request->data);
        $concour = $concours->find('all',['conditions'=>['Concours.etat =' => 1],
            'contain'=>['Niveaus', 'Filieres']
        ]);
        $niveaus = $concours->Niveaus->find('list');
        $filieres = $concours->Filieres->find('list');

        $preinscription = TableRegistry::get('preinscriptions');
        $this->paginate = ['contain' => ['Concours' => ['Niveaus', 'Filieres']]
        ];
        $filtre = $this->request->data['filtre'];
        switch ($filtre) {
            case 'cne':
                $query = $preinscription->find('all')->where(['cne' => $this->request->data['motif'],'listeAttente' => 1]);
                break;
            case 'nom':
                $query = $preinscription->find('all')->where(['nom_fr' => $this->request->data['motif'],'listeAttente' => 1]);
                break;
            case 'prenom':
                $query = $preinscription->find('all')->where(['prenom_fr' => $this->request->data['motif'],'listeAttente' => 1]);
                break;
            default:
                $query = $preinscription->find('all')->where(['cne' => $this->request->data['motif'],'listeAttente' => 1]);
                break;
        }
        $preinscriptions =  $this->paginate($query);
        $this->set(compact('preinscriptions','concour', 'niveaus', 'filieres'));
        $this->set('_serialize', ['preinscriptions','concour']);
        $this->render('/Espaces/resposcolarites/findAttente');

    }

    //Infos sur Preinscription
    public function viewPreinscription($id = null)
    {
        $preinscriptions = TableRegistry::get('preinscriptions');
        $preinscription = $preinscriptions->get($id, [
            'contain' => ['Concours'=> ['Niveaus', 'Filieres'],'Activitesdespreinscriptions', 'PreinscriptionsInfos'=> ['PreinscriptionsDiplomes', 'PreinscriptionsEtablissements','Semestres']],

        ]);


        $this->set(compact('preinscription','niveaus', 'filieres','preinscriptionsDiplomes','semestres'));
        $this->set('_serialize', ['preinscription']);
        $this->render('/Espaces/resposcolarites/viewPreinscription');
    }

    //Imprimer Infos sur Preinscription
    public function printViewPreinscription($id = null)
    {
        $preinscriptions = TableRegistry::get('preinscriptions');
        $preinscription = $preinscriptions->get($id, [
            'contain' => ['Concours'=> ['Niveaus', 'Filieres'],'Activitesdespreinscriptions', 'PreinscriptionsInfos'=> ['PreinscriptionsDiplomes', 'PreinscriptionsEtablissements','Semestres']],

        ]);


        $this->set(compact('preinscription','niveaus', 'filieres','preinscriptionsDiplomes','semestres'));
        $this->set('_serialize', ['preinscription']);
        $this->render('/Espaces/resposcolarites/printViewPreinscription');
    }

    //Les statistiques
    public function statistiquesPreinscriptions()
    {
        $concours = TableRegistry::get('concours');
        $concour = $concours->newEntity();
        $concour = $concours->patchEntity($concour, $this->request->data);
        $concour = $concours->find('all',[
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

        $concour1 = $concours->find('all',[
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

        $concour2 = $concours->find('all',[
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

        $concour3 = $concours->find('all',[
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

        $this->set(compact('concour','concour1','concour2','concour3'));
        $this->set('_serialize', ['concour','concour1','concour2','concour3']);
        $this->render('/Espaces/resposcolarites/statistiquesPreinscriptions');
    }

    ////////////////////////////////////////////!Abdessamad///////////////////////////

    /**** Fin Abdessamad et Taha *****/


/***** Ismail ****/
    
      /*---------------------------------------------------------------------------------------------------------------------*/
	  /*---------------------------------------------------------------------------------------------------------------------*/
	 /*---------------------------------------------------------------------------------------------------------------------*/
	/*------------------------------------------//gestion des certificats_etudiants----------------------------------------*/




    /*-----------------------------------------------------------------------------------------------------------------------*/
	/*-----------------------------------------------Index certificats_etudiants---------------------------------------------*/
    public function indexCertificatsEtudiants($f = NULL)
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





    /*-----------------------------------------------------------------------------------------------------------------------*/
    /*--------------------------------------------------Views certificats_etudiants-----------------------------------------*/

    public function viewCertificatsEtudiants($id = null)
    {
        $CertificatsEtudiants = TableRegistry::get("certificats_etudiants");
        $certificatsEtudiant = $CertificatsEtudiants->get($id, [
            'contain' => ['Certificats', 'Etudiants']
        ]);
        
        if($CertificatsEtudiants->save($certificatsEtudiant)){

            $Notifications_users = TableRegistry::get("notifications_users");
            $Notifications_users->deleteAll(['lien LIKE "viewCertificats%/'.$id.'"']);
            
            $Notifications_grp = TableRegistry::get("notifications_groupe");
            $Notifications_grp->deleteAll(['lien  LIKE "viewCertificats%/'.$id.'"']);

            $this->set('certificatsEtudiant', $certificatsEtudiant);
            $this->set('_serialize', ['certificatsEtudiant']);

            return $this->render('/Espaces/resposcolarites/CertificatsEtudiants/view');
        }else{
            return $this->Flash->error(_('Erreur innatendue !!'));
        }
    }





    /*-----------------------------------------------------------------------------------------------------------------------*/
    /*-----------------------------------------------Générer les certificats_etudiants--------------------------------------*/

    public function comCertificatsEtudiants($id = null)
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



    /*-----------------------------------------------------------------------------------------------------------------------*/
    /*--------------------------------------------------------Commenter-----------------------------------------------------*/

    public function cmntCertificatsEtudiants($id = null)
    {
        $CertificatsEtudiants = TableRegistry::get("certificats_etudiants");
        $certificatsEtudiant = $CertificatsEtudiants->get($id, [
            'contain' => ['Certificats','Etudiants']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
                            
            if (isset($this->request->data['Rejeter'])) {
                $this->set('test',$this->request->data);
                return $this->render('/Espaces/resposcolarites/CertificatsEtudiants/cmnt');
            }
            $certificatsEtudiant->commantaire = $this->request->data['commentaire'];
            $certificatsEtudiant->notif_etudiant = TRUE;
            if (isset($this->request->data['rejeterprince']) && $this->request->data['rejeterprince']) {
                $certificatsEtudiant->etat = "Rejeter";
            }
            if ($CertificatsEtudiants->save($certificatsEtudiant)) {
                
                $donne_notif['user_id']  = $certificatsEtudiant->etudiant->user_id;
                $donne_notif['principale'] = 'Un responsable a commenter votre demande: '.$certificatsEtudiant->certificat->type;
                $donne_notif['commentaire'] = $this->request->data['commentaire'];
                $donne_notif['lien'] = 'viewCertificats/'.$id;
                $donne_notif['titre'] = $certificatsEtudiant->etat;
                
                switch ($certificatsEtudiant->etat){
                    case 'Rejeter' : 
                        $donne_notif['style'] = "badge bg-red";
                    break;
                    case 'En cours de traitement' : 
                        $donne_notif['style'] = "badge bg-yellow" ;
                    break;
                    case 'Demande envoyé' : 
                        $donne_notif['style'] = "badge bg-light-blue";
                    break;
                    case 'Prête' : 
                        $donne_notif['style'] ="badge bg-green";
                    break;
                    case 'Délivré' : 
                        $donne_notif['style'] = "badge bg-navy";
                    break;
                }
                
                $this->preparerNotification($donne_notif,"indiv");

                $this->Flash->success(__('L\'opération est effectué avec succes.'));
                return $this->redirect(['action' => 'indexCertificatsEtudiants']);
            }
            $this->Flash->error(__('Erreur !!.'));
        }
        return $this->render('/Espaces/resposcolarites/CertificatsEtudiants/cmnt');

    }





    /*-----------------------------------------------------------------------------------------------------------------------*/
    /*-----------------------------------------------editer les certificats_etudiants---------------------------------------*/

    public function editCertificatsEtudiants($id = null)
    {
        $CertificatsEtudiants = TableRegistry::get('certificats_etudiants');
        $this->request->allowMethod(['post', 'Prête','Approuver','Rejeter','Délivré','Cmnt']);
        $certificatsEtudiant = $CertificatsEtudiants->get($id, [
            'contain' => ["Etudiants","Certificats"]
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

        }
        switch ($certificatsEtudiant->etat){
                case 'Rejeter' : 
                    $donne_notif['style'] = "badge bg-red";
                break;
                case 'En cours de traitement' : 
                    $donne_notif['style'] = "badge bg-yellow" ;
                break;
                case 'Demande envoyé' : 
                    $donne_notif['style'] = "badge bg-light-blue";
                break;
                case 'Prête' : 
                    $donne_notif['style'] ="badge bg-green";
                break;
                case 'Délivré' : 
                    $donne_notif['style'] = "badge bg-navy";
                break;
            }

        $query = $certificatsEtudiant->toArray();
        $donne_notif['user_id']  = $query['etudiant']['user_id'];
        $donne_notif['principale'] = 'Votre '.$query['certificat']['type'].' est declaré comme: '.$certificatsEtudiant->etat;
        $donne_notif['commentaire'] = $query['commentaire'];
        $donne_notif['lien'] = 'viewCertificats/'.$id;        
        $donne_notif['titre'] = $certificatsEtudiant->etat;

        if ($CertificatsEtudiants->save($certificatsEtudiant)) {
            
            $this->preparerNotification($donne_notif,"indiv");
            $this->Flash->success(__('Succes!!'));
            return $this->redirect(['action' => 'indexCertificatsEtudiants']);
        }
        $this->Flash->error(__('Erreur.'));

        return $this->redirect(['action' => 'indexCertificatsEtudiants']);
    }




    /*-----------------------------------------------------------------------------------------------------------------------*/
    /*-----------------------------------------------Reinitilisation des certificats_etudiants------------------------------*/


    public function reinitiliserCertificatsEtudiants(){


        $connection = ConnectionManager::get('default');

        $CertificatsEtudiants = TableRegistry::get("certificats_etudiants");
        $certificats_type =  $connection->execute('SELECT type, id FROM certificats WHERE certificats.type LIKE "%scolarité" ')->fetchAll('assoc');
        $this->set('certificats_type', $certificats_type);
        if ($this->request->is(['patch', 'post', 'put']) && !isset($this->request->data['Réinitialiser']))
        {
            $certif_id = array();
            foreach($this->request->data as $key => $value){
                if($key != "vider")
                    $certif_id[] = $key;
            }

            if(count($certif_id)!=0 &&  $CertificatsEtudiants->deleteAll(["certificat_id IN(".implode(',', $certif_id).")"])){
                $this->Flash->success(__('Réinitilisation avec success'));
            }else{
                $this->Flash->error(__('LA REINTILALISATION N\'EST PAS EFFECTUE'));
            }
            return $this->redirect(['action'=>'indexCertificatsEtudiants']);
        }
        $this->render('/Espaces/Resposcolarites/CertificatsEtudiants/choix');
    }


	
	
	/*-----------------------------------------------------------------------------------------------------------------------*/
    // /*--------------------------------------------STATISTIQUES des certificats_etudiants---------------------------------*/
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
        for($i=0;$i<count($filiere);$i++)
        {
          for($j=1;$j<13;$j++){
          $a=$filiere[$i]['id'];
          $envoyemois[$a][$j]=$this->nbreMois($a,$j);
        }
        }
      
        $this->set('envoyeStat',$envoyeStat);
        $this->set('enCoursStat',$enCoursStat);
        $this->set('preteStat',$preteStat);
        $this->set('delivreStat',$delivreStat);
        $this->set('rejeterStat',$rejeterStat);
         $this->set('envoyemois',$envoyemois);

        

       $this->set('filiere',$filiere);
       
   
      $this->render('/Espaces/resposcolarites/CertificatsEtudiants/statistiques'); 


    }
	
	
	/*-----------------------------------------------Nombre de certificats------------------------------------------------------*/
	 private function nbre($f = NULL,$a)
    {
       $connection = ConnectionManager::get('default');
      $suite = "";
        if($f != NULL){
            $suite = "AND filieres.id = :f ";
        }

        $donne_delivrer =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,certificats.id,
		etudiants.id, etudiants.nom_fr,etudiants.prenom_fr, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created,
		certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = '.$a.' AND certificats.type LIKE "%scolarité" '
															   .$suite,[':f'=>$f])->fetchAll('assoc');
        return count($donne_delivrer);

    }
	
	
	
	/*----------------------------------------Nombre de certificats par mois---------------------------------------------------*/
    private function nbreMois($f = NULL,$m)
    {
       $connection = ConnectionManager::get('default');
     $suite = "";
        if($f != NULL){
            $suite = "AND filieres.id = :f ";
        }
        $b=date("Y");
      

        $donne_delivrer =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,certificats.id,
		etudiants.id, etudiants.nom_fr,etudiants.prenom_fr, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created,
		certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.created between "'.$b.'-'.$m.'-01" and "'.$b.'-'.$m.'-31"
															   AND certificats.type LIKE "%scolarité" '.$suite,[':f'=>$f])->fetchAll('assoc');
        return count($donne_delivrer);

    }
	
	
	/*---------------------------------------------------------------------------------------------------------------------------*/
	/*------------------------------------------// notifications resposcolarites-------------------------------------------------*/
	

   public function updateNotifications(){

        $connection = ConnectionManager::get('default');

        $usrole=$this->Auth->user('id');
        $test =  $connection->execute('SELECT certificats_etudiants.id,etudiants.nom_fr,etudiants.prenom_fr, certificats_etudiants.etat, filieres.libile, 
                                        certificats.type, certificats_etudiants.modified FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE (certificats.type LIKE "%scolarité") AND (certificats_etudiants.notif_respo = TRUE)
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

	
	   /*---------------------------------------------------------------------------------------------------------------------*/
	  /*---------------------------------------------------------------------------------------------------------------------*/
	 /*---------------------------------------------------------------------------------------------------------------------*/
	/*------------------------------------------//gestion des certificats--------------------------------------------------*/
	
	
	
	/*---------------------------------------------// AFFICHAGE DES CERTIFICATS-------------------------------------------*/


   public function indexCertificats()
    {
      
        $Certificats = TableRegistry::get('certificats');
 
        $certificats = $this->paginate($Certificats->find('all',['conditions'=>['certificats.type LIKE'=>'%scolarité']]));
        $this->set(compact('certificats'));
        $this->set('_serialize', ['certificats']);
        $this->render('/Espaces/Resposcolarites/Certificats/index');
    }
	
	
	

	
/*---------------------------------------------------// RECHERCHE-----------------------------------------------*/


    public function searchCertificats()
    {
        
            $Certificats = TableRegistry::get("certificats");
            $certificat = $Certificats->get($this->request->data['search'], [
                'contain' => ['Etudiants']
            ]);
     
            $this->set('certificat', $certificat);
            $this->set('_serialize', ['certificat']);

            $this->render('/Espaces/Resposcolarites/Certificats/view');    
    }
	
	
	
	

/*-----------------------------------------------// AFFICHER LA CERTIFICAT----------------------------------------------*/
    
  
    public function viewCertificats($id = null)
    {
        $Certificats = TableRegistry::get("certificats");
        $certificats = $Certificats->get($id, [
            'contain' => ['Etudiants']
        ]);
 

        $this->set('certificat', $certificats);
        $this->set('_serialize', ['certificat']);

        return $this->render('/Espaces/Resposcolarites/Certificats/view');
    }

	
	
	
/*-----------------------------------------------// AJOUTER UNE CERTIFICAT----------------------------------------------*/
 
    public function addCertificats()
    {
      $Certificats = TableRegistry::get("certificats");
        $certificat = $Certificats->newEntity();
 
        if ($this->request->is('post')) {
            $certificat = $Certificats->patchEntity($certificat, $this->request->data);
            $certificat->type = $certificat->type.' - scolarité';
            if ($Certificats->save($certificat)) {
                $this->Flash->success(__('The {0} has been saved.', 'Certificat'));
                return $this->redirect(['action' => 'indexCertificats']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Certificat'));
            }
        }
        $this->set(compact('certificat', 'etudiants'));
        $this->set('_serialize', ['certificat']);
        $this->render('/Espaces/Resposcolarites/Certificats/add');
    }


    /*---------------------------------------------------------------------------------------------------------------------*/
    /*------------------------------------------//Graphes--------------------------------------------------*/
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


        $this->render('/Espaces/resposcolarites/CertificatsEtudiants/graphes');


    }
    /*---------------------------------------------------------------------------------------------------------------------*/
    /*------------------------------------------//generer un dossier--------------------------------------------------*/


    private function dossier()

    {     $a=date("Y-m-d");
        $path = WWW_ROOT.'certificats scolarite'. DS . $a;
        $folder = new Folder($path);

        if (is_null($folder->path)) {
            $dir = new Folder(WWW_ROOT.'certificats scolarite'.DS.$a, true, 0755);
        }


    }


    /*-----------------------------------------------// EDITER UNE CERTIFICAT ----------------------------------------------*/

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
        $this->render('/Espaces/Resposcolarites/Certificats/edit');
    }
	
	
	
/*-----------------------------------------------// SUPPRIMER UNE CERTIFICAT ----------------------------------------------*/

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
   /*****************************************************************************************************************************/
  /*****************************************************************************************************************************/
 /***************************************--------*---------Fin--------*---------***********************************************/
/*****************************************************************************************************************************/

    
    /*****Fin Ismail****/


    /***** Benchahydah *****/

    public function showClasses() {
        $this->set('clesses', $this->get_all_classes());
        $this->render('/Espaces/resposcolarites/classes_relever');
    }

    public function generateTranscript() {
        $class_id = 1212345353; //$this->request->data('class_id');
        $modules = $this->get_modele_by_classes($class_id);
        $this->create_pdf($modules, $class_id);
        $this->set('clesses', $this->get_all_classes());
        $this->render('/Espaces/resposcolarites/classes_relever');
    }

    private function get_all_classes(){
        $classes = TableRegistry::get('Groupes');
        return $query = $classes->find('all', ['contain' => ['Niveaus', 'Filieres']]);
    }

    private function get_modele_by_classes($class_id) {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT m.id AS modele_id, libile FROM modules m WHERE m.groupe_id = $class_id ORDER BY m.id"
        );
        return $stmt->fetchAll('assoc');
    }

    private function create_pdf($modeles, $class_id){
        $niveau_filiere_obj = $this->get_niveau_filiere($class_id);

        $niveau = $niveau_filiere_obj[0]['niveau_lib'];
        $filiere = $niveau_filiere_obj[0]['filiere_lib'];

        switch ($niveau.'_'.$filiere) {
            case "premiere annee_CP":

                break;
            case "deuxieme annee_CP":

                break;
            case "troisieme annee_TC":

                break;
            case "troisieme annee_GPE":

                break;
            case "cinquieme annee_GPE":

                break;
            case "cinquieme annee_GE":

                break;
            case "cinquieme annee_GI":
                $file_path = ROOT.'\\webroot\\RELEVER_MODELES\\2CIGI.pdf';
                $this->write_content_2CIGI($file_path, $modeles, $class_id);
                break;
            case "quatrieme annee_GI":
                $file_path = ROOT.'\\webroot\\RELEVER_MODELES\\2CIGI.pdf';
                $this->write_content_2CIGI($file_path, $modeles, $class_id);
                break;
            case "cinquieme annee_GRT":

                break;
        }

    }

    public function showPvNote(){
        $pvs = $this->get_all_pv();
        $this->set("pvs", $pvs);
        $this->render('/Espaces/resposcolarites/liste-pv-notes');
    }

    private function get_all_pv() {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(

            "SELECT n.id as note_id, pv.note_old, pv.date_update, CASE WHEN n.ratt_confirmed = 1 AND n.note_ratt IS NOT NULL THEN n.note_ratt ELSE n.note END AS note, etd.nom_fr, etd.prenom_fr, etd.cne, pf.nom_prof, f.libile AS lib_f, nv.libile AS lib_n
                FROM pvupdate pv
                INNER JOIN profpermanents pf
                        ON pv.profpermanent_id = pf.id
                INNER JOIN notes n
                        ON pv.note_id = n.id
                INNER JOIN etudiers e
                        ON e.id = n.etudier_id
                INNER JOIN etudiants etd
                        ON etd.id = e.etudiant_id
                INNER JOIN groupes c
                        ON c.id = e.groupe_id
                INNER JOIN filieres f
                        ON f.id = c.filiere_id
                INNER JOIN niveaus nv
                        ON nv.id = c.niveaus_id
                WHERE YEAR(pv.date_update) = YEAR(CURDATE()) AND 
                pv.profpermanent_id IS NOT NULL

                UNION

                SELECT n.id as note_id, pv.note_old, pv.date_update, CASE WHEN n.ratt_confirmed = 1 AND n.note_ratt IS NOT NULL THEN n.note_ratt ELSE n.note END AS note, etd.nom_fr, etd.prenom_fr, etd.cne, v.nom_vacataire, f.libile AS lib_f, nv.libile AS lib_n
                FROM pvupdate pv
                INNER JOIN vacataires v
                        ON pv.profvacataire_id = v.id
                INNER JOIN notes n
                        ON pv.note_id = n.id
                INNER JOIN etudiers e
                        ON e.id = n.etudier_id
                INNER JOIN etudiants etd
                        ON etd.id = e.etudiant_id
                INNER JOIN groupes c
                        ON c.id = e.groupe_id
                INNER JOIN filieres f
                        ON f.id = c.filiere_id
                INNER JOIN niveaus nv
                        ON nv.id = c.niveaus_id
                WHERE YEAR(pv.date_update) = YEAR(CURDATE()) AND 
                pv.profvacataire_id IS NOT NULL"
        );

        $rows = $stmt->fetchAll('assoc');
        if(!empty($rows))
            return $rows;
        return -1;
    }

    private function write_content_2CIGI($path, $modeles, $class_id) {
        $school_year = $this->get_school_year();
        $pdf = new \FPDI();
        $pdf->AliasNbPages();

        $pdf->SetFont('Arial', '', '13');
        $pdf->SetTextColor(0,0,0);

        $liste_ordred = $this->sort_by_avg($modeles, $class_id, $school_year);
        /*
         * ==========Liste des notes / module
         */

        //===========>  Les fonctions cles de l'Entreprise
        $ese = $modeles[0]['modele_id'];
        $note_ese = $this->get_notes_module($ese, $class_id, $school_year);
        //===========>  Programmation web 1
        $progweb = $modeles[3]['modele_id'];
        $note_progweb = $this->get_notes_module($progweb, $class_id, $school_year);
        //is->get_notes_module($reseau, $class_id, $school_year);
        //===========>
        //=====================================================================>
        //===========>  RO
        $ro = $modeles[5]['modele_id'];
        $note_ro = $this->get_notes_module($ro, $class_id, $school_year);
        //===========>  JAVA
        $java = $modeles[4]['modele_id'];
        $note_java = $this->get_notes_module($java, $class_id, $school_year);
        //===========>  R&P
        $reseau = $modeles[6]['modele_id'];
        $note_reseau = $this->get_notes_module($reseau, $class_id, $school_year);
        //===========>  UML
        $uml = $modeles[2]['modele_id'];
        $note_uml = $this->get_notes_module($uml, $class_id, $school_year);
        //===========>  SysExp
        $se = $modeles[1]['modele_id'];
        $note_se = $this->get_notes_module($se, $class_id, $school_year);
        //===========>  END


        for($i = 0 ; $i < count($note_java); $i++){
            $note_generale = 0;
            $pdf->AddPage();
            $pdf->setSourceFile($path);
            $tplIdx = $pdf->importPage(1);
            $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
            //Nom & Prenom
            $pdf->SetXY(62, 59);
            $pdf->Write(0, $note_java[$i]['nom_fr']);
            $pdf->SetXY(62+(strlen($note_java[$i]['nom_fr'])*3.5), 59);
            $pdf->Write(0, $note_java[$i]['prenom_fr']);
            //CNE
            $pdf->SetXY(62, 64);
            $pdf->Write(0, $note_java[$i]['cne']);
            //Annee
            $pdf->SetXY(62, 78);
            $pdf->Write(0, $school_year[0]['libile']);
            //Effectif
            $pdf->SetXY(62, 73);
            $pdf->Write(0, count($note_java));
            //Ro
            $pdf->SetXY(121, 104);
            $pdf->Write(0, number_format((float)$note_ro[$i]['note_finale'], 2, '.', '')); //<!-- changement ici -->
            $this->isValider($pdf, $note_ro[$i]['note_finale'], 147, 104);
            $note_generale += $note_ro[$i]['note_finale'];
            //Java
            $pdf->SetXY(121, 202);
            $pdf->Write(0, number_format((float)$note_java[$i]['note_finale'], 2, '.', ''));/////<!-- changement ici -->
            $this->isValider($pdf, $note_java[$i]['note_finale'], 147, 202);
            $note_generale += $note_java[$i]['note_finale'];
            //R&P
            $pdf->SetXY(121, 128);
            $pdf->Write(0, number_format((float)$note_reseau[$i]['note_finale'], 2, '.', ''));/////<!-- changement ici -->
            $this->isValider($pdf, $note_reseau[$i]['note_finale'], 147, 128);
            $note_generale += $note_reseau[$i]['note_finale'];
            //prog web
            $pdf->SetXY(121, 136);
            $pdf->Write(0, number_format((float)$note_progweb[$i]['note_finale'], 2, '.', ''));/////<!-- changement ici -->
            $this->isValider($pdf, $note_progweb[$i]['note_finale'], 147, 136);
            $note_generale += $note_progweb[$i]['note_finale'];
            //prog E/Se
            $pdf->SetXY(121, 144);
            $pdf->Write(0, number_format((float)$note_ese[$i]['note_finale'], 2, '.', ''));/////<!-- changement ici -->
            $this->isValider($pdf, $note_ese[$i]['note_finale'], 147, 144);
            $note_generale += $note_ese[$i]['note_finale'];
            //UML
            $pdf->SetXY(121, 120);
            $pdf->Write(0, number_format((float)$note_uml[$i]['note_finale'], 2, '.', ''));/////<!-- changement ici -->
            $this->isValider($pdf, $note_uml[$i]['note_finale'], 147, 120);
            $note_generale += $note_uml[$i]['note_finale'];
            //SysExp
            $pdf->SetXY(121, 112);
            $pdf->Write(0, number_format((float)$note_se[$i]['note_finale'], 2, '.', ''));/////<!-- changement ici -->
            $this->isValider($pdf, $note_se[$i]['note_finale'], 147, 112);
            $note_generale += $note_se[$i]['note_finale'];
            //Moyen generale
            $pdf->SetXY(178, 160);
            $pdf->Write(0, number_format((float)$note_generale/count($modeles), 2, '.', ''));
            $this->isAdmit($pdf, $note_generale/count($modeles), 178, 220);
            //Mention
            $this->putMention($pdf, $note_generale/count($modeles), 178, 230);
            //Classement
            $pdf->SetXY(100, 220);
            $pdf->Write(0, $liste_ordred[$note_java[$i]['cne']]);
            //===================== OUT PUT ====================
        }
        $pdf->Output('gift_generated.pdf', 'D');

    }

    private function sort_by_avg($modeles, $class_id, $school_year){
        $note_modeles = array();
        foreach($modeles as $modele){
            $modele_id = $modele['modele_id'];
            $note_modeles[] = $this->get_notes_module($modele_id, $class_id, $school_year);
        }

        $avg_note = array();

        $ctr = count($note_modeles[0]);
        $jd = 0;
//                    echo '<pre>';
//            print_r($note_modeles[0][1]);die();
        while ($ctr > $jd) {
            $avg_note[$note_modeles[0][$jd]['cne']] = 0;
            $jd++;
        }

        foreach($note_modeles as $note_modele){
            $counter = count($note_modele);
//            echo '<pre>';
//            print_r($note_modele);die();
            for($i = 0 ; $i < $counter ; $i++){
                $avg_note[$note_modele[$i]['cne']] += $note_modele[$i]['note_finale'];
//                echo 'Modele '.$i.'<br/>';
//                $j = 0;
//                while ($counter > $j) {
//                    $avg_note[$i] += $note_modele[$i]['note_finale'];
////                    $j++;
//                    echo '---------------'.'<br/>';
//                    echo "j = ".$j.'<br/>';
//                    echo "Note = ".$note_modele[$i]['note_finale'].'<br/>';
//                    $j++;
//                }
            }
        }
//        echo '<pre>';
//        print_r($avg_note);
        //sort($avg_note);
        arsort($avg_note);
        //$liste_ordred = array_reverse($avg_note, true);
        $q = 1;
        foreach ($avg_note as $key => $row)
        {
            $avg_note[$key] = $q;
            $q++;
        }
//        foreach ($avg_note as $key => $row)
//        {
//            echo $key.' = '.$row.'<br/>';
//        }
        //array_multisort($note, SORT_DESC, $avg_note);
//        echo '<pre>';
//        print_r($avg_note);
        return $avg_note;
    }

    private function putMention(&$pdf, $note,  $x, $y){
        if ($note >= 16) {
            $pdf->SetXY($x-6, $y);
            $pdf->Write(0, "Tres bien");
        }
        else if($note >= 14){
            $pdf->SetXY($x-5, $y);
            $pdf->Write(0, "Bien");
        }
        else if($note >= 12){
            $pdf->SetXY($x-5, $y);
            $pdf->Write(0, "Assez-bien");
        }
        else{
            $pdf->SetXY($x-5, $y);
            $pdf->Write(0, "good luck :)");
        }
    }

    private function isValider(&$pdf, $note,  $x, $y){
        if ($note >= 12) {
            $pdf->SetXY($x, $y);
            $pdf->Write(0, "Valider");
        }
        else {
            $pdf->SetXY($x-5, $y);
            $pdf->Write(0, "NON Valider");
        }
    }

    private function isAdmit(&$pdf, $note,  $x, $y){
        if ($note >= 12) {
            $pdf->SetXY($x, $y);
            $pdf->Write(0, "Admit");
        }
        else {
            $pdf->SetXY($x-5, $y);
            $pdf->Write(0, "NON Admit");
        }
    }

    private function get_notes_module($module_id, $class_id, $school_year) {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT AVG(CASE WHEN n.ratt_confirmed = 1 AND n.note_ratt IS NOT NULL THEN n.note_ratt ELSE n.note END) as note_finale, e.nom_fr, e.prenom_fr, e.cne, elm.id AS element_id , e.id
                FROM notes n
                    INNER JOIN etudiers etd
                        ON n.etudier_id = etd.id
                    INNER JOIN annee_scolaires a
                        ON a.id = etd.annee_scolaire_id
                    INNER JOIN groupes c
                        ON c.id = etd.groupe_id
                    INNER JOIN elements elm
                        ON elm.id = n.element_id
                    INNER JOIN etudiants e
                        ON e.id = etd.etudiant_id
                WHERE 
                    a.id =".$school_year[0]['id']." AND
                    elm.module_id = $module_id AND
                    c.id = $class_id 
                GROUP BY etd.etudiant_id 
                ORDER BY e.id"

        );
        return $stmt->fetchAll('assoc');
    }

    private function get_school_year() {
        $label = $this->generateSchoolYear();
        //echo $label;die();
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT id, libile FROM annee_scolaires a WHERE a.libile = '$label'"
        );
        return $stmt->fetchAll('assoc');
    }

    private function generateSchoolYear() {
        $year = (int)date("Y");
        $month = (int)date("M");

        if ($month <= 6) {
            $y1 = $year-1;
            return $y1.'/'.$year;
        }
        else{
            $y1 = $year+1;
            return $year.'/'.$y1;
        }
    }

    private function get_niveau_filiere($class_id){
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT n.libile AS niveau_lib, f.libile AS filiere_lib
                FROM groupes g
                    INNER JOIN niveaus n
                        ON n.id = g.niveaus_id
                    INNER JOIN filieres f
                        ON f.id = g.filiere_id
                    WHERE g.id = $class_id"
        );
        return $stmt->fetchAll('assoc');
    }
    /*
     * ============================== BEN CHAHYDAH : END =============================
     */



//        define('APP_DIR', 'app');
//        define('DS', DIRECTORY_SEPARATOR);
//        define('ROOT', dirname(__FILE__));
//        define('WEBROOT_DIR', 'webroot');
//        define('WWW_ROOT', ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS);
//
//    SELECT AVG(CASE WHEN n.ratt_confirmed = 1 THEN n.note_ratt ELSE n.note END) as note_finale, e.nom_fr, elm.id AS element_id
//FROM notes n
//	INNER JOIN etudiers etd
//		ON n.etudier_id = etd.id
//    INNER JOIN annee_scolaires a
//    	ON a.id = etd.annee_scolaire_id
//    INNER JOIN groupes c
//    	ON c.id = etd.groupe_id
//    INNER JOIN elements elm
//		ON elm.id = n.element_id
//    INNER JOIN etudiants e
//		ON e.id = etd.etudiant_id
//WHERE
//	a.id = 1 AND
//    elm.module_id = 70 AND
//    c.id = 1212345353
//GROUP BY etd.etudiant_id


    /***** Fin benchaid *****/


     /******* debut youness ****/


    //DEBUT IBTISSAM +kawtar
    public function demanderabsences()
    {
        $_SESSION['auto'] = "none";
        $user_id = $this->Auth->user('id');
        $con=ConnectionManager::get('default');

        $id = $con->execute("SELECT id FROM fonctionnaires WHERE user_id = $user_id")->fetchAll('assoc');
        //debug($id); die;
        $fonct_id = $id[0]['id'];

        $nbr = $con->execute("SELECT COUNT(*) as n FROM absences WHERE fonctionnaire_id = $fonct_id")->fetchAll('assoc');
        $duree = $con->execute("SELECT duree_ab FROM absences WHERE fonctionnaire_id = $fonct_id")->fetchAll('assoc');
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
                $time_ab =0 ;

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
                $con->execute("INSERT INTO absences (fonctionnaire_id,duree_ab,cause,date_ab,time_ab) VALUES ($fonct_id,$duree_ab,'$cause','$date_ab','$time_ab')");

            } }

        $this->render('/Espaces/resposcolarites/demanderabsences');
    }
    public function demanderDocFct()
    {
        $ProfpermanentsDocuments=TableRegistry::get('FonctionnairesDocuments');
        $documentsProfesseur = $ProfpermanentsDocuments->newEntity();
        $documentbis=TableRegistry::get('Documents');
        $documentbis=$documentbis->find('all');
        $profbis=TableRegistry::get('Fonctionnaires');
        $profbis=$profbis->find('all');
        $idUser=$this->Auth->user('id');
        $profpermanents=TableRegistry::get('Fonctionnaires');
        $query=$profpermanents->find('all')->select('id')->where(['user_id'=>$idUser]);

        foreach($query as $ligne)
        {
            $usrid=$ligne->id;
        }

        if ($this->request->is('post')){

            $documentsProfesseur->fonctionnaire_id =$usrid;
            $documentsProfesseur->document_id =$this->request->data('nomDoc');
            //requete pour une demande déja effectué
            $requete = $ProfpermanentsDocuments->find('all',array('conditions' => array('FonctionnairesDocuments.fonctionnaire_id' => $usrid
            ,   'FonctionnairesDocuments.document_id' => $this->request->data('nomDoc'))));
            $nombre=0;
            foreach($requete as $resultat)
            {
                if($resultat->etatdemande=='Demande envoyé' or $resultat->etatdemande=='Prete' or $resultat->etatdemande=='En cours de traitement')
                {
                    $nombre++;
                }
            }

            $Profpermanents=TableRegistry::get('Fonctionnaires');
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

                        return $this->redirect(['controller'=>'Resposcolarites','action' => 'index']);
                    }
                    else{
                        $this->Flash->error(__('Demande échouée'));

                    }



                    break;
                }
                case 2:
                {
                    // debug($usrid);
                    $nbtentativebis=$profpermanents->find('all')->select('etat_fiche')->where(['id'=>$usrid]);
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
                        $query=$profpermanents->find('all')->update()->set(['etat_fiche' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();
                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['controller'=>'Resposcolarites','action' => 'index']);
                    }
                    else{
                        $this->Flash->error(__('Demande echouée'));

                    }

                }
            }


        }

        $profpermanents = $ProfpermanentsDocuments->fonctionnaires->find('list', ['limit' => 200]);
        $documents = $ProfpermanentsDocuments->Documents->find('list', ['limit' => 200]);
        $this->set('doc',$documentbis);
        $this->set('prof',$profbis);
        $this->set(compact('documentsProfesseur', 'profpermanents', 'documents'));
        $this->set('_serialize', ['documentsProfesseur']);
        $this->render('/Espaces/resposcolarites/demanderDocFct');

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
        $FonctionnairesDocuments = $this->paginate($FonctionnairesDocuments->find("all", array(
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
        $this->render('/Espaces/resposcolarites/etatDemandeFct');

    }
    // FIN KAWTAR + IBTISSAM



}

?>
