<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Notes Controller
 *
 * @property \App\Model\Table\NotesTable $Notes
 *
 * @method \App\Model\Entity\Note[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Elements', 'Etudiers']
        ];
        $notes = $this->paginate($this->Notes);

        $this->set(compact('notes'));
    }

    /**
     * View method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => ['Elements', 'Etudiers', 'Pvupdate']
        ]);

        $this->set('note', $note);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $note = $this->Notes->newEntity();
        if ($this->request->is('post')) {
            $e = $this->request->data['e'];
            $m = $this->request->data['m'];
            $s = $this->request->data['s'];
            $n = $this->request->data['n'];
            $f = $this->request->data['f'];
            $note = $this->Notes->patchEntity($note, $this->request->getData());
            $the_note = $note->note;
            if ($the_note > 20 or $the_note < 0) {
                $this->Flash->error(__('Il faut respecter le barème!'));
                return $this->redirect($this->referer());
            } else {
                if ($this->Notes->save($note)) {
                    return $this->redirect([
                        'controller' => 'Notes',
                        'action' => 'saisie',
                        '?' => [
                            'f' => $f,
                            'n' => $n,
                            's' => $s,
                            'm' => $m,
                            'e' => $e
                        ]
                    ]);
                }
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $note = $this->Notes->patchEntity($note, $this->request->getData());
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The note could not be saved. Please, try again.'));
        }
        $elements = $this->Notes->Elements->find('list', ['limit' => 200]);
        $etudiers = $this->Notes->Etudiers->find('list', ['limit' => 200]);
        $this->set(compact('note', 'elements', 'etudiers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if ($this->request->is('get')) {
            $e = $this->request->query['e'];
            $m = $this->request->query['m'];
            $s = $this->request->query['s'];
            $n = $this->request->query['n'];
            $f = $this->request->query['f'];
            $id = $this->request->query['id'];
            $note = $this->Notes->get($id);
            if ($this->Notes->delete($note)) {
                //$this->Flash->success(__('The note has been deleted.'));
                return $this->redirect([
                    'controller' => 'Notes',
                    'action' => 'saisie',
                    '?' => [
                        'f' => $f,
                        'n' => $n,
                        's' => $s,
                        'm' => $m,
                        'e' => $e
                    ]
                ]);
            } else {
                $this->Flash->error(__('The note could not be deleted. Please, try again.'));
            }
        }
    }



















    public function preparationAffichage()
    {
        $filieres_labels = array();
        $niveaux_labels = array();
        $semestres_labels = array();
        $modules_labels = array();
        $elements_labels = array();
        $this->loadModel('Filieres');
        $all_filieres = $this->Filieres->find();
        foreach ($all_filieres as $f) {
            $filieres_labels[] = $f->libile;
        }
        $etape = 0;
        $this->set(compact('filieres_labels', 'etape'));
        if ($this->request->is('post')) {
            if (isset($this->request->data['filiere'])) {
                $f = $this->request->data['filiere'];
                $all_filieres_not_array = $this->Filieres->find();
                $all_filieres = array();
                foreach ($all_filieres_not_array as $a) {
                    $all_filieres[] = $a;
                }
                $filiere = $all_filieres[$f];
                $f = $filiere->id;
                $this->loadModel('Niveaus');
                $all_niveaux = $this->Niveaus->find();
                foreach ($all_niveaux as $n) {
                    $niveaux_labels[] = $n->libile;
                }
                $etape = 1;
                $this->set(compact(
                    'filieres_labels',
                    'niveaux_labels',
                    'f',
                    'etape'
                ));
            }
            if (isset($this->request->data['niveau'])) {
                $in = $this->request->data['niveau'];
                $f = $this->request->data['f'];
                $this->loadModel('Niveaus');
                $all_niveaux_not_array = $this->Niveaus->find();
                $all_niveaux = array();
                foreach ($all_niveaux_not_array as $a) {
                    $all_niveaux[] = $a;
                    $niveaux_labels[] = $a->libile;
                }
                $niveau = $all_niveaux[$in];
                $n = $niveau->id;
                $this->loadModel('Semestres');
                $all_semestres = $this->Semestres->find();
                foreach ($all_semestres as $s) {
                    if ($s->niveaus_id == $n) $semestres_labels[] = $s->libile;
                }
                $etape = 2;
                if (sizeof($semestres_labels) == 0) {
                    $this->Flash->error(__('Aucune semestre est enregistré pour cette filière dans ce niveau!'));
                    return $this->redirect(['action' => 'preparationAffichage']);
                }
                $this->set(compact(
                    'filieres_labels',
                    'niveaux_labels',
                    'semestres_labels',
                    'f',
                    'n',
                    'etape'
                ));
            }
            if (isset($this->request->data['semestre'])) {
                $f = $this->request->data['f'];
                $n = $this->request->data['n'];
                $this->loadModel('Semestres');
                $all_semestres = $this->Semestres->find();
                foreach ($all_semestres as $s) {
                    if ($s->niveaus_id == $n) {
                        $semestres[] = $s;
                        $semestres_labels[] = $s->libile;
                    }
                }
                $semestre = $semestres[$this->request->data['semestre']];
                $s = $semestre->id;
                $this->loadModel('Niveaus');
                $all_niveaux = $this->Niveaus->find();
                foreach ($all_niveaux as $a) {
                    $niveaux_labels[] = $a->libile;
                }
                $this->loadModel('Groupes');
                $groupes_ids = array();
                $all_groupes = $this->Groupes->find();
                foreach ($all_groupes as $a) {
                    if ($a->niveaus_id == $n && $a->filiere_id == $f) {
                        $groupes_ids[] = $a->id;
                    }
                }
                // debug($groupes_ids);
                // die();
                if (sizeof($groupes_ids) == 0) {
                    $this->Flash->error(__('Aucun module est enregistré pour ce choix!'));
                    return $this->redirect(['action' => 'preparationAffichage']);
                }
                $this->loadModel('Modules');
                $all_modules = $this->Modules->find();
                foreach ($all_modules as $a) {
                    if (in_array($a->groupe_id, $groupes_ids) && $a->semestre_id == $s) {
                        $modules_labels[] = $a->libile;
                    }
                }
                $etape = 3;
                if (sizeof($modules_labels) == 0) {
                    $this->Flash->error(__('Aucun module est enregistré pour ce choix!'));
                    return $this->redirect(['action' => 'preparationAffichage']);
                }
                $this->set(compact(
                    'filieres_labels',
                    'niveaux_labels',
                    'semestres_labels',
                    'modules_labels',
                    'f',
                    'n',
                    's',
                    'etape'
                ));
            }
            if (isset($this->request->data['module'])) {
                $n = $this->request->data['n'];
                $s = $this->request->data['s'];
                $f = $this->request->data['f'];
                $etape = 4;
                $this->loadModel('Groupes');
                $all_groupes = $this->Groupes->find();
                foreach ($all_groupes as $a) {
                    if ($a->niveaus_id == $n && $a->filiere_id == $f) {
                        $groupes_ids[] = $a->id;
                    }
                }
                $this->loadModel('Modules');
                $all_modules = $this->Modules->find();
                foreach ($all_modules as $a) {
                    if (in_array($a->groupe_id, $groupes_ids) && $a->semestre_id == $s) {
                        $modules[] = $a;
                        $modules_labels[] = $a->libile;
                    }
                }
                $module = $modules[$this->request->data['module']];
                $m = $module->id;
                $this->loadModel('Elements');
                $all_elements = $this->Elements->find();
                foreach ($all_elements as $a) {
                    if ($a->module_id == $m) $elements_labels[] = $a->libile;
                }
                $this->loadModel('Niveaus');
                $all_niveaux = $this->Niveaus->find();
                foreach ($all_niveaux as $a) {
                    $niveaux_labels[] = $a->libile;
                }
                $this->loadModel('Semestres');
                $all_semestres = $this->Semestres->find();
                foreach ($all_semestres as $s) {
                    if ($s->niveaus_id == $n) $semestres_labels[] = $s->libile;
                }
                $s = $this->request->data['s'];
                if (sizeof($elements_labels) == 0) {
                    $this->Flash->error(__('Aucun element est enregistré pour ce choix!'));
                    return $this->redirect(['action' => 'preparationAffichage']);
                }
                $this->set(compact(
                    'filieres_labels',
                    'niveaux_labels',
                    'semestres_labels',
                    'modules_labels',
                    'elements_labels',
                    'f',
                    'n',
                    's',
                    'm',
                    'etape'
                ));
            }
            if (isset($this->request->data['element'])) {
                $etape = 5;
                $n = $this->request->data['n'];
                $s = $this->request->data['s'];
                $f = $this->request->data['f'];
                $m = $this->request->data['m'];
                $this->loadModel('Elements');
                $this->loadModel('Modules');
                $this->loadModel('Semestres');
                $this->loadModel('Niveaus');
                $this->loadModel('Filieres');
                $modules = $this->Modules->find();
                $semestres = $this->Semestres->find();
                $niveaux = $this->Niveaus->find();
                $filieres = $this->Filieres->find();
                $all_elements = $this->Elements->find();
                foreach ($modules as $a) {
                    if ($a->id == $m) $m_l = $a->libile;
                }
                foreach ($semestres as $a) {
                    if ($a->id == $s) $s_l = $a->libile;
                }
                foreach ($niveaux as $a) {
                    if ($a->id == $n) $n_l = $a->libile;
                }
                foreach ($filieres as $a) {
                    if ($a->id == $f) $f_l = $a->libile;
                }
                foreach ($all_elements as $a) {
                    if ($a->module_id == $m) {
                        $elements_labels[] = $a->libile;
                        $es[] = $a;
                    }
                }
                $element = $es[$this->request->data['element']];
                $e = $element->id;
                $e_l = $element->libile;
                $this->set(compact(
                    'f_l',
                    'n_l',
                    's_l',
                    'm_l',
                    'e_l',
                    'f',
                    'n',
                    's',
                    'm',
                    'e',
                    'etape'
                ));
            }
        }
    }
















    public function affichage()
    {
        $filieres_labels = array();
        $niveaux_labels = array();
        $semestres_labels = array();
        $modules_labels = array();
        $elements_labels = array();
        if ($this->request->is('post')) {
            $e = $this->request->data['e'];
            $m = $this->request->data['m'];
            $notes = $this->Notes->find();
            $my_notes = array();
            foreach ($notes as $a) {
                if ($a->element_id == $e) {
                    $my_notes[] = $a;
                }
            }
            $this->loadModel('Modules');
            $this->loadModel('Elements');
            $this->loadModel('Etudiers');
            $this->loadModel('Etudiants');
            $all_etudiants = $this->Etudiants->find();
            $all_etudiers = $this->Etudiers->find();
            $all_modules = $this->Modules->find();
            $all_elements = $this->Elements->find();
            foreach ($all_modules as $a) {
                if ($a->id == $m) {
                    $module = $a;
                    break;
                }
            }
            foreach ($all_elements as $a) {
                if ($a->id == $e) {
                    $element = $a;
                    break;
                }
            }
            $my_etudiers = array();
            foreach ($all_etudiers as $a) {
                if ($a->element_id == $e) {
                    $my_etudiers[] = $a;
                }
            }
            if (sizeof($my_etudiers) == 0) {
                $this->Flash->error(__("Aucune note n'est saisie dans cet élement!"));
                return $this->redirect(['action' => 'preparationAffichage']);
            }
            foreach ($my_etudiers as $a) {
                $etudiants_ids[] = $a->etudiant_id;
            }
            foreach ($all_etudiants as $a) {
                if (in_array($a->id, $etudiants_ids)) {
                    $my_etudiants[] = $a;
                }
            }
            if (sizeof($my_notes) == 0) {
                $this->Flash->error(__('Aucune note est enregistrée pour ce choix!'));
                return $this->redirect(['action' => 'preparationAffichage']);
            }
            $max = $my_notes[0]->note;
            $min = $my_notes[0]->note;
            $somme = 0;
            $moy = $my_notes[0]->note;
            $ecart = 0;
            foreach ($my_notes as $aaa) {
                if ($aaa->note > $max) $max = $aaa->note;
                if ($aaa->note < $min) $min = $aaa->note;
                $somme += $aaa->note;
            }
            $moy = $somme / (sizeof($my_notes));
            //calcul de lecart type
            $somme_1 = 0;
            $notes = array();
            foreach ($my_notes as $bbb) {
                $notes[] = $bbb->note;
            }
            foreach ($notes as $aaa) {
                $somme_1 += ($aaa - $moy) * ($aaa - $moy);
            }
            $somme_1 = $somme_1 / sizeof($my_notes);
            $ecart = sqrt($somme_1);
            $this->set(compact(
                'my_notes',
                'element',
                'module',
                'my_etudiants',
                'max',
                'min',
                'moy',
                'ecart'
            ));
        } else {
            $this->redirect(['action' => 'preparationAffichage']);
        }
    }























    public function preparationSaisie()
    {
        $filieres_labels = array();
        $niveaux_labels = array();
        $semestres_labels = array();
        $modules_labels = array();
        $elements_labels = array();
        $this->loadModel('Filieres');
        $all_filieres = $this->Filieres->find();
        foreach ($all_filieres as $f) {
            $filieres_labels[] = $f->libile;
        }
        $etape = 0;
        $this->set(compact('filieres_labels', 'etape'));
        if ($this->request->is('post')) {
            if (isset($this->request->data['filiere'])) {
                $f = $this->request->data['filiere'];
                $all_filieres_not_array = $this->Filieres->find();
                $all_filieres = array();
                foreach ($all_filieres_not_array as $a) {
                    $all_filieres[] = $a;
                }
                $filiere = $all_filieres[$f];
                $f = $filiere->id;
                $this->loadModel('Niveaus');
                $all_niveaux = $this->Niveaus->find();
                foreach ($all_niveaux as $n) {
                    $niveaux_labels[] = $n->libile;
                }
                $etape = 1;
                $this->set(compact(
                    'filieres_labels',
                    'niveaux_labels',
                    'f',
                    'etape'
                ));
            }
            if (isset($this->request->data['niveau'])) {
                $n = $this->request->data['niveau'];
                $f = $this->request->data['f'];
                $this->loadModel('Niveaus');
                $all_niveaux_not_array = $this->Niveaus->find();
                $all_niveaux = array();
                foreach ($all_niveaux_not_array as $a) {
                    $all_niveaux[] = $a;
                    $niveaux_labels[] = $a->libile;
                }
                $niveau = $all_niveaux[$n];
                $n = $niveau->id;
                $this->loadModel('Semestres');
                $all_semestres = $this->Semestres->find();
                foreach ($all_semestres as $s) {
                    if ($s->niveaus_id == $n) $semestres_labels[] = $s->libile;
                }
                $etape = 2;
                if (sizeof($semestres_labels) == 0) {
                    $this->Flash->error(__('Aucune semestre est enregistré pour cette filière dans ce niveau!'));
                    return $this->redirect(['action' => 'preparationAffichage']);
                }
                $this->set(compact(
                    'filieres_labels',
                    'niveaux_labels',
                    'semestres_labels',
                    'f',
                    'n',
                    'etape'
                ));
            }
            if (isset($this->request->data['semestre'])) {
                $f = $this->request->data['f'];
                $n = $this->request->data['n'];
                $this->loadModel('Semestres');
                $all_semestres = $this->Semestres->find();
                foreach ($all_semestres as $s) {
                    if ($s->niveaus_id == $n) {
                        $semestres[] = $s;
                        $semestres_labels[] = $s->libile;
                    }
                }
                $semestre = $semestres[$this->request->data['semestre']];
                $s = $semestre->id;
                $this->loadModel('Niveaus');
                $all_niveaux = $this->Niveaus->find();
                foreach ($all_niveaux as $a) {
                    $niveaux_labels[] = $a->libile;
                }
                $groupes_ids = array();
                $this->loadModel('Groupes');
                $all_groupes = $this->Groupes->find();
                foreach ($all_groupes as $a) {
                    if ($a->niveaus_id == $n && $a->filiere_id == $f) {
                        $groupes_ids[] = $a->id;
                    }
                }
                if (sizeof($groupes_ids) == 0) {
                    $this->Flash->error(__('Aucun module est enregistré pour ce choix!'));
                    return $this->redirect(['action' => 'preparationAffichage']);
                }
                if ($groupes_ids == null) {
                    $this->Flash->error(__('Aucun module est enregistré pour ce choix!'));
                    return $this->redirect(['action' => 'preparationAffichage']);
                }
                $this->loadModel('Modules');
                $all_modules = $this->Modules->find();
                foreach ($all_modules as $a) {
                    if (in_array($a->groupe_id, $groupes_ids) && $a->semestre_id == $s) {
                        $modules_labels[] = $a->libile;
                    }
                }
                if ($modules_labels == null) {
                    $this->Flash->error(__('Aucun module est enregistré pour ce choix!'));
                    return $this->redirect(['action' => 'preparationAffichage']);
                }
                $etape = 3;

                $this->set(compact(
                    'filieres_labels',
                    'niveaux_labels',
                    'semestres_labels',
                    'modules_labels',
                    'f',
                    'n',
                    's',
                    'etape'
                ));
            }
            if (isset($this->request->data['module'])) {
                $n = $this->request->data['n'];
                $s = $this->request->data['s'];
                $f = $this->request->data['f'];
                $etape = 4;
                $this->loadModel('Groupes');
                $all_groupes = $this->Groupes->find();
                foreach ($all_groupes as $a) {
                    if ($a->niveaus_id == $n && $a->filiere_id == $f) {
                        $groupes_ids[] = $a->id;
                    }
                }
                $this->loadModel('Modules');
                $all_modules = $this->Modules->find();
                foreach ($all_modules as $a) {
                    if (in_array($a->groupe_id, $groupes_ids) && $a->semestre_id == $s) {
                        $modules[] = $a;
                        $modules_labels[] = $a->libile;
                    }
                }
                $module = $modules[$this->request->data['module']];
                $m = $module->id;
                $this->loadModel('Elements');
                $all_elements = $this->Elements->find();
                foreach ($all_elements as $a) {
                    if ($a->module_id == $m) $elements_labels[] = $a->libile;
                }
                $this->loadModel('Niveaus');
                $all_niveaux = $this->Niveaus->find();
                foreach ($all_niveaux as $a) {
                    $niveaux_labels[] = $a->libile;
                }
                $this->loadModel('Semestres');
                $all_semestres = $this->Semestres->find();
                foreach ($all_semestres as $s) {
                    if ($s->niveaus_id == $n) $semestres_labels[] = $s->libile;
                }
                $s = $this->request->data['s'];
                if (sizeof($elements_labels) == 0) {
                    $this->Flash->error(__('Aucun element est enregistré pour ce choix!'));
                    return $this->redirect(['action' => 'preparationAffichage']);
                }
                $this->set(compact(
                    'filieres_labels',
                    'niveaux_labels',
                    'semestres_labels',
                    'modules_labels',
                    'elements_labels',
                    'f',
                    'n',
                    's',
                    'm',
                    'etape'
                ));
            }
            if (isset($this->request->data['element'])) {
                $etape = 5;
                $n = $this->request->data['n'];
                $s = $this->request->data['s'];
                $f = $this->request->data['f'];
                $m = $this->request->data['m'];
                $this->loadModel('Elements');
                $this->loadModel('Modules');
                $this->loadModel('Semestres');
                $this->loadModel('Niveaus');
                $this->loadModel('Filieres');
                $modules = $this->Modules->find();
                $semestres = $this->Semestres->find();
                $niveaux = $this->Niveaus->find();
                $filieres = $this->Filieres->find();
                $all_elements = $this->Elements->find();
                foreach ($modules as $a) {
                    if ($a->id == $m) $m_l = $a->libile;
                }
                foreach ($semestres as $a) {
                    if ($a->id == $s) $s_l = $a->libile;
                }
                foreach ($niveaux as $a) {
                    if ($a->id == $n) $n_l = $a->libile;
                }
                foreach ($filieres as $a) {
                    if ($a->id == $f) $f_l = $a->libile;
                }
                foreach ($all_elements as $a) {
                    if ($a->module_id == $m) {
                        $elements_labels[] = $a->libile;
                        $es[] = $a;
                    }
                }
                $element = $es[$this->request->data['element']];
                $e = $element->id;
                $e_l = $element->libile;
                $this->set(compact(
                    'f_l',
                    'n_l',
                    's_l',
                    'm_l',
                    'e_l',
                    'f',
                    'n',
                    's',
                    'm',
                    'e',
                    'etape'
                ));
            }
        }
    }





















    public function saisie()
    {
        $filieres_labels = array();
        $niveaux_labels = array();
        $semestres_labels = array();
        $modules_labels = array();
        $elements_labels = array();
        if ($this->request->is('post')) {
            $e = $this->request->data['e'];
            $m = $this->request->data['m'];
            $s = $this->request->data['s'];
            $n = $this->request->data['n'];
            $f = $this->request->data['f'];
            $notes = $this->Notes->find();
            $my_notes = array();
            foreach ($notes as $a) {
                if ($a->element_id == $e) {
                    $my_notes[] = $a;
                }
            }
            $this->loadModel('Modules');
            $this->loadModel('Elements');
            $this->loadModel('Etudiers');
            $this->loadModel('Etudiants');
            $all_etudiants = $this->Etudiants->find();
            $all_etudiers = $this->Etudiers->find();
            $all_modules = $this->Modules->find();
            $all_elements = $this->Elements->find();
            foreach ($all_modules as $a) {
                if ($a->id == $m) {
                    $module = $a;
                    break;
                }
            }
            foreach ($all_elements as $a) {
                if ($a->id == $e) {
                    $element = $a;
                    break;
                }
            }
            $my_etudiers = array();
            foreach ($all_etudiers as $a) {
                if ($a->element_id == $e) {
                    $my_etudiers[] = $a;
                }
            }
            if (sizeof($my_etudiers) == 0) {
                $this->Flash->error(__('Aucune note est enregistrée pour ce choix!'));
                return $this->redirect(['action' => 'preparationSaisie']);
            }
            foreach ($my_etudiers as $a) {
                $etudiants_ids[] = $a->etudiant_id;
            }
            foreach ($all_etudiants as $a) {
                if (in_array($a->id, $etudiants_ids)) {
                    $my_etudiants[] = $a;
                }
            }
            if (sizeof($my_notes) == 0) {
                $this->set(compact(
                    'my_notes',
                    'element',
                    'module',
                    'my_etudiants',
                    'my_etudiers',
                    'f',
                    'n',
                    's',
                    'm',
                    'e'
                ));
            } else {
                $max = $my_notes[0]->note;
                $min = $my_notes[0]->note;
                $somme = 0;
                $moy = $my_notes[0]->note;
                $ecart = 0;
                foreach ($my_notes as $aaa) {
                    if ($aaa->note > $max) $max = $aaa->note;
                    if ($aaa->note < $min) $min = $aaa->note;
                    $somme += $aaa->note;
                }
                $moy = $somme / (sizeof($my_notes));
                $max = $my_notes[0]->note;
                $min = $my_notes[0]->note;
                $somme = 0;
                $moy = $my_notes[0]->note;
                $ecart = 0;
                foreach ($my_notes as $aaa) {
                    if ($aaa->note > $max) $max = $aaa->note;
                    if ($aaa->note < $min) $min = $aaa->note;
                    $somme += $aaa->note;
                }

                $moy = $somme / (sizeof($my_notes));
                //calcul de lecart type
                $somme_1 = 0;
                $notes = array();
                foreach ($my_notes as $bbb) {
                    $notes[] = $bbb->note;
                }
                foreach ($notes as $aaa) {
                    $somme_1 += ($aaa - $moy) * ($aaa - $moy);
                }
                $somme_1 = $somme_1 / sizeof($my_notes);
                $ecart = sqrt($somme_1);
                $this->set(compact(
                    'my_notes',
                    'element',
                    'module',
                    'my_etudiants',
                    'my_etudiers',
                    'f',
                    'n',
                    's',
                    'm',
                    'e',
                    'max',
                    'min',
                    'moy',
                    'ecart'
                ));
            }
        } else if ($this->request->is('get')) {
            $e = $this->request->query['e'];
            $m = $this->request->query['m'];
            $s = $this->request->query['s'];
            $n = $this->request->query['n'];
            $f = $this->request->query['f'];
            $notes = $this->Notes->find();
            $my_notes = array();
            foreach ($notes as $a) {
                if ($a->element_id == $e) {
                    $my_notes[] = $a;
                }
            }
            $this->loadModel('Modules');
            $this->loadModel('Elements');
            $this->loadModel('Etudiers');
            $this->loadModel('Etudiants');
            $all_etudiants = $this->Etudiants->find();
            $all_etudiers = $this->Etudiers->find();
            $all_modules = $this->Modules->find();
            $all_elements = $this->Elements->find();
            foreach ($all_modules as $a) {
                if ($a->id == $m) {
                    $module = $a;
                    break;
                }
            }
            foreach ($all_elements as $a) {
                if ($a->id == $e) {
                    $element = $a;
                    break;
                }
            }
            foreach ($all_etudiers as $a) {
                if ($a->element_id == $e) {
                    $my_etudiers[] = $a;
                }
            }
            foreach ($my_etudiers as $a) {
                $etudiants_ids[] = $a->etudiant_id;
            }
            foreach ($all_etudiants as $a) {
                if (in_array($a->id, $etudiants_ids)) {
                    $my_etudiants[] = $a;
                }
            }
            if (sizeof($my_notes) == 0) {
                $this->set(compact(
                    'my_notes',
                    'element',
                    'module',
                    'my_etudiants',
                    'my_etudiers',
                    'f',
                    'n',
                    's',
                    'm',
                    'e'
                ));
            } else {
                $max = $my_notes[0]->note;
                $min = $my_notes[0]->note;
                $somme = 0;
                $moy = $my_notes[0]->note;
                $ecart = 0;
                foreach ($my_notes as $aaa) {
                    if ($aaa->note > $max) $max = $aaa->note;
                    if ($aaa->note < $min) $min = $aaa->note;
                    $somme += $aaa->note;
                }
                $moy = $somme / (sizeof($my_notes));
                $max = $my_notes[0]->note;
                $min = $my_notes[0]->note;
                $somme = 0;
                $moy = $my_notes[0]->note;
                $ecart = 0;
                foreach ($my_notes as $aaa) {
                    if ($aaa->note > $max) $max = $aaa->note;
                    if ($aaa->note < $min) $min = $aaa->note;
                    $somme += $aaa->note;
                }

                $moy = $somme / (sizeof($my_notes));
                //calcul de lecart type
                $somme_1 = 0;
                $notes = array();
                foreach ($my_notes as $bbb) {
                    $notes[] = $bbb->note;
                }
                foreach ($notes as $aaa) {
                    $somme_1 += ($aaa - $moy) * ($aaa - $moy);
                }
                $somme_1 = $somme_1 / sizeof($my_notes);
                $ecart = sqrt($somme_1);
                $this->set(compact(
                    'my_notes',
                    'element',
                    'module',
                    'my_etudiants',
                    'my_etudiers',
                    'f',
                    'n',
                    's',
                    'm',
                    'e',
                    'max',
                    'min',
                    'moy',
                    'ecart'
                ));
            }
            
        } else {
            $this->redirect(['action' => 'preparationSaisie']);
        }
    }

    public function affichageEtudiant()
    {
    //    die(print_r($this->Auth->user('id')));
        if ($this->Auth->user('id') != null) {
            $idEtudiant = $this->Auth->user('id');
            //$idEtudiant = 1;
            $this->loadModel('Etudiants');
            $this->loadModel('Etudiers');
            $this->loadModel('Elements');
            $this->loadModel('Modules');
            $etudiants = $this->Etudiants->find();
            $elements = $this->Elements->find();
            $modules = $this->Modules->find();
            $etudiant = null;
            foreach ($etudiants as $a) {
                if ($a->id == $idEtudiant) $etudiant = $a;
            }
            $my_etudierss = $this->Etudiers->find()->where(['etudiant_id' => $idEtudiant]);
            $my_etudiers = array();
            $my_notes = array();
            $nom_modules = array();
            $nom_elements = array();
            foreach ($my_etudierss as $a) $my_etudiers[] = $a;
            $notes = $this->Notes->find();
            $elements_ids = array();
            foreach ($my_etudierss as $a) {
                foreach ($notes as $b) {
                    if($b->etudier_id == $a->id){
                        $my_notes[] = $b;
                        $elements_ids[] = $b->element_id;
                    }
                }
            }
            $modules_ids = array();
            for ($i=0; $i < sizeof($elements_ids); $i++) { 
                foreach ($elements as $e) {
                    if($e->id == $elements_ids[$i]){
                        $nom_elements[] = $e->libile;
                        $modules_ids[] = $e->module_id;
                    }
                }
            }
            for ($i=0; $i < sizeof($modules_ids); $i++) { 
                foreach ($modules as $m) {
                    if($m->id == $modules_ids[$i]){
                        $nom_modules[] = $m->libile;
                    }
                }
            }
  //die(print_r($my_etudierss));
            $this->set(compact('my_notes', 'my_etudiers', 'etudiant', 'nom_modules', 'nom_elements'));
        } else {
            $this->Flash->error(__('Non autorisé.'));
            return $this->redirect($this->referer());
        }
    
        $this->set('etudiant',$a);
        $this->render('/Espaces/Notes/affichage_etudiant');
        
    }

}
