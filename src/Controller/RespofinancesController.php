<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;




class respofinancesController extends AppController
{

    public function beforeFilter(Event $event)
    {
        // allow only login, forgotpassword
        $this->Auth->authorize = 'controller';
        $usrole = $this->Auth->user('role');
        if ($usrole != 'respofinance' && $usrole != 'admin') {

            $this->Flash->error(__('Vous ne pouvez pas acceder a ce lien'));
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'logout']
            );
        }
        $this->Auth->deny();

    }


    /***** FADILI *****/


    public function boiteRecFinance()
    {

        $usrole = $this->Auth->user('role');
        $this->set('role', $usrole);
        $monid = $usrole = $this->Auth->user('id');

        Time::setToStringFormat('yyyy-MM-dd HH:mm:ss');
        $cnx = ConnectionManager::get('default');
        $mesMessages = $cnx->execute("SELECT u.username, m.sujet, m.contenu, TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date FROM users_messages umg, messages m, users u 
        where umg.user_id = u.id and umg.message_id  = m.id and user_idrecepteur = $monid ")->fetchAll('assoc');
        $this->set('mesMsgs', $mesMessages);
        $this->render('/Espaces/Respofinances/boiteRecFinance');
    }

    public function envoyerNvFinance()
    {

        $usrole = $this->Auth->user('role');
        $this->set('role', $usrole);
        $cnx = ConnectionManager::get('default');
        $professeurs = $cnx->execute("SELECT DISTINCT u.id, p.nom_prof, p.prenom_prof, p.poste FROM users u, profpermanents p
        where p.user_id = u.id ")->fetchAll('assoc');
        $this->set('professeur', $professeurs);
        $this->render('/Espaces/Respofinances/envoyerNvFinance');
    }

    public function lireMsgFinance($id = 0)
    {

        $cnx = ConnectionManager::get('default');
        $msg = $cnx->execute("SELECT u.username, m.sujet, m.contenu, m.piecejointe , TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date FROM users_messages umg, messages m, users u 
        where umg.user_id = u.id and umg.message_id  = m.id and m.id = $id ")->fetchAll('assoc');

        //$msg=$cnx->execute("SELECT * FROM messages m where $id = m.id ")->fetchAll('assoc');
        $this->set('msgs', $msg);
        $usrole = $this->Auth->user('role');
        $this->set('role', $usrole);
        $this->render('/Espaces/Respofinances/lireMsgFinance');
    }

    public function envoyermsg()
    {
        $usrole = $this->Auth->user('role');
        $this->set('role', $usrole);

        $detinateur = $this->Auth->user('id');
        $detinataire = $this->request->getData('destinataire');
        $sujet = $this->request->getData('sujet');
        $contenu = $this->request->getData('contenu');


        $cnx = ConnectionManager::get('default');
        $msg = $cnx->execute("SELECT MAX(id) as id FROM messages ")->fetchAll('assoc');
        // Upload file
        $extention = substr($this->request->getData('attachment')["type"], -3);
        $nomFichier = $this->request->getData('attachment')["name"];
        $attachementPath = "/Ensaksite/webroot/" . $nomFichier . $msg['0']['id'] . "." . $extention;
        // debug($this->request->getData());
        move_uploaded_file($this->request->getData('attachment')["tmp_name"], $nomFichier . $msg['0']['id'] . "." . $extention);

        $cnx->insert('messages',
            [
                'sujet' => $sujet,
                'contenu' => $contenu,
                'piecejointe' => $attachementPath
            ]
        );
        $msg = $cnx->execute("SELECT MAX(id) as id FROM messages ")->fetchAll('assoc');
        Time::setToStringFormat('yyyy-MM-dd HH:mm:ss');

        $cnx->insert('users_messages',
            [
                'message_id' => $msg['0']['id'],
                'user_id' => $detinateur,
                'user_idrecepteur' => $detinataire,
                'date' => Time::now()
            ]
        );
        $this->boiteRecFinance();
    }
    /**** FIN FADILI  ******/


    /**** AYOUB  *****/

     // yassir


    public function listArticles()
    {
        $this->paginate = [
            'contain' => ['Devisdemandes']
        ];
        $articleevents = $this->paginate('Articleevents');

        $this->set(compact('articleevents'));
        $this->set('_serialize', ['articleevents']);
        $this->render('/Espaces/respofinances/listArticles');

    }

    public function suivicommandes() {
        $Devisdemande = TableRegistry::get('devisdemandes');
        $devisdemandes = $this->paginate($Devisdemande);
        $this->set(compact('devisdemandes'));
        $this->set('_serialize', ['devisdemandes']);
        $this->render('/Espaces/respofinances/suivicommande');
    }

    public function addyassir()
    {
        $Articleevent = TableRegistry::get('articleevents');
        $Devisdemande = TableRegistry::get('devisdemandes');
        $article = $Articleevent->newEntity();
        $devis = $Devisdemande->newEntity();
        if ($this->request->is('post')) {
            $devis->nom_devis = $this->request->data['nom_devis'];
            $devis->nom_fournisseur = $this->request->data['nom_fournisseur'];
            $devis->adresse_fournisseur = $this->request->data['adresse_fournisseur'];
            $devis->intitule = $this->request->data['intitule'];
            $devis->etat = "Enregistrée";
            if ($result = $Devisdemande->save($devis)) {
                foreach($this->request->data["data"]["Bloc"] as $key => $value){
                    $article->desigantion = $value['desigantion'];
                    $article->quantite = $value['quantite'];
                    $article->devisdemande_id = $result->id;
                    $Articleevent->save($article);
                    $article=$Articleevent->newEntity();
                }
                $this->Flash->success(__('The {0} has been saved.', 'Articleevent'));
                return $this->redirect(['action' => 'suivicommandes']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Devisdemande'));
            }
        }
        $this->set(compact('article', 'devis'));
        $this->set('_serialize', ['article']);
        $this->set('_serialize', ['devis']);
        $this->render('/Espaces/respofinances/addyassir');
    }


    public function boncommande($id = null)
    {
        $this->loadModel('Articleevents');
        $this->loadModel('Devisdemandes');
        $this->loadModel('Boncommandes');
        $devisdemande = $this->Devisdemandes->get($id, [
            'contain' => ['Articleevents', 'Boncommandes']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if($this->request->data['bonbool']){

                $now = Time::now();
                $boncommande = $this->Boncommandes->newEntity();
                $boncommande->exercice = $now->year;
                $boncommande->prix_total = $this->request->data['total'];
                $boncommande->devisdemande_id = $this->request->data['id'];
                $devisdemande = $this->Devisdemandes->get($id, [
                    'contain' => []
                ]);
                $devisdemande->etat = "En cours de traitement";
                if ($this->Boncommandes->save($boncommande) && $this->Devisdemandes->save($devisdemande)) {
                    $this->Flash->success(__('The {0} has been saved.', 'Boncommande'));
                    return $this->redirect(['action' => 'imprimerboncommande', $id]);
                } else {
                    $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Boncommande'));
                }
            }else {
                $this->Flash->error(__('Compléter le remplissage des prix'));
            }
        }
        $this->set('devisdemande', $devisdemande);
        $this->set('_serialize', ['devisdemande']);
        $this->render('/Espaces/respofinances/boncommande');

    }

    public function imprimerdemandedevis($id=null){
        $this->loadModel('Articleevents');
        $this->loadModel('Devisdemandes');
        $this->loadModel('Boncommandes');
        $devisdemande = $this->Devisdemandes->get($id, [
            'contain' => ['Articleevents', 'Boncommandes']
        ]);
        $boncommande = $this->Boncommandes->find('all',array(
                'conditions'=>array(
                    'Boncommandes.devisdemande_id'=>$id
                )
            )
        );
        $boncommande->hydrate(false);
        $data = $boncommande->first();

        $this->set('data', $data);
        $this->set('devisdemande', $devisdemande);
        $this->set('_serialize', ['devisdemande']);
        $this->render('/Espaces/respofinances/imprimerdemandedevis');


    }

    public function attribuerprix($id = null)
    {
        $this->loadModel('Articleevents');
        $this->loadModel('Devisdemandes');
        $articleevent = $this->Articleevents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $articleevent = $this->Articleevents->patchEntity($articleevent, $this->request->data);
            if ($this->Articleevents->save($articleevent)) {
                $this->Flash->success(__('The {0} has been saved.', 'Articleevent'));
                return $this->redirect(['action' => 'boncommande', $articleevent['devisdemande_id']]);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Articleevent'));
            }
        }
        $query = $this->Devisdemandes->find('all', [
            'conditions' => ['Devisdemandes.id' => '49']
        ]);
        $devisdemandes = $query->first();
        $this->set(compact('articleevent', 'devisdemandes'));
        $this->set('_serialize', ['articleevent']);
        $this->render('/Espaces/respofinances/attribuerprix');
    }

    public function consultation($id=null){
        $this->loadModel('Devisdemandes');
        $devisdemande = $this->Devisdemandes->get($id, [
            'contain' => ['Articleevents', 'Boncommandes']
        ]);

        $this->set('devisdemande', $devisdemande);
        $this->set('_serialize', ['devisdemande']);
        $this->render('/Espaces/respofinances/consultation');
    }

    public function imprimerboncommande($id=null){
        $this->loadModel('Articleevents');
        $this->loadModel('Devisdemandes');
        $this->loadModel('Boncommandes');
        $devisdemande = $this->Devisdemandes->get($id, [
            'contain' => ['Articleevents', 'Boncommandes']
        ]);
        $boncommande = $this->Boncommandes->find('all',array(
                'conditions'=>array(
                    'Boncommandes.devisdemande_id'=>$id
                )
            )
        );
        $boncommande->hydrate(false);
        $data = $boncommande->first();

        $this->set('data', $data);
        $this->set('devisdemande', $devisdemande);
        $this->set('_serialize', ['devisdemande']);
        $this->render('/Espaces/respofinances/imprimerboncommande');


    }


    public function ordrepaiement($id = null)
    {
        $this->loadModel('Articleevents');
        $this->loadModel('Devisdemandes');
        $this->loadModel('Boncommandes');
        $this->loadModel('Ordrepaiements');
        $devisdemande = $this->Devisdemandes->get($id, [
            'contain' => ['Articleevents', 'Boncommandes']
        ]);
        $ordrepaiement2 = $this->Ordrepaiements->find('all',array(
                'conditions'=>array(
                    'Ordrepaiements.devisdemande_id'=>$id
                )
            )
        );
        $ordrepaiement2->hydrate(false);
        $ordrepaiement3 = $ordrepaiement2->first();
        if(isset($ordrepaiement3['id'])){
            $ordrepaiement = $this->Ordrepaiements->get($ordrepaiement3['id'], [
                'contain' => []
            ]);
        } else $ordrepaiement = $this->Ordrepaiements->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ordrepaiement = $this->Ordrepaiements->patchEntity($ordrepaiement, $this->request->data);
            $now = Time::now();
            $ordrepaiement->exercice = $now->year;
            $ordrepaiement->devisdemande_id = $id;
            $devisdemande->etat = "En cours de paiement";
            if ($this->Ordrepaiements->save($ordrepaiement) && $this->Devisdemandes->save($devisdemande)) {
                $this->Flash->success(__('Les informations ont été enregistrées', 'Ordrepaiement'));
                return $this->redirect(['action' => 'imprimerordrepaiement', $id]);
            } else {
                $this->Flash->error(__('Le {0} ne peut pas être sauvegarder', 'Ordrepaiement'));
            }
        }
        $this->set(compact('ordrepaiement', 'devisdemande'));
        $this->set('_serialize', ['ordrepaiement']);
        $this->render('/Espaces/respofinances/ordrepaiement');

    }


    public function imprimerordrepaiement($id = null)
    {
        $this->loadModel('Articleevents');
        $this->loadModel('Devisdemandes');
        $this->loadModel('Boncommandes');
        $this->loadModel('Ordrepaiements');

        $devisdemande = $this->Devisdemandes->get($id, [
            'contain' => ['Articleevents', 'Boncommandes']
        ]);
        $boncommande = $this->Boncommandes->find('all',array(
                'conditions'=>array(
                    'Boncommandes.devisdemande_id'=>$id
                )
            )
        );
        $boncommande->hydrate(false);
        $data = $boncommande->first();
        $ordrepaiement2 = $this->Ordrepaiements->find('all',array(
                'conditions'=>array(
                    'Ordrepaiements.devisdemande_id'=>$id
                )
            )
        );
        $ordrepaiement2->hydrate(false);
        $ordrepaiement = $ordrepaiement2->first();
        $this->set('boncommande', $data);
        $this->set('ordrepaiement', $ordrepaiement);
        $this->set('devisdemande', $devisdemande);
        $this->set('_serialize', ['devisdemande']);
        $this->render('/Espaces/respofinances/imprimerordrepaiement');

    }


    public function imprimerbonreception($id = null)
    {
        $this->loadModel('Articleevents');
        $this->loadModel('Devisdemandes');
        $this->loadModel('Boncommandes');
        $devisdemande = $this->Devisdemandes->get($id, [
            'contain' => ['Articleevents', 'Boncommandes']
        ]);
        $boncommande = $this->Boncommandes->find('all',array(
                'conditions'=>array(
                    'Boncommandes.devisdemande_id'=>$id
                )
            )
        );
        $boncommande->hydrate(false);
        $data = $boncommande->first();

        $this->set('data', $data);
        $this->set('devisdemande', $devisdemande);
        $this->set('_serialize', ['devisdemande']);
        $this->render('/Espaces/respofinances/imprimerbonreception');

    }


    public function imprimerordrevirement($id = null)
    {
        $this->loadModel('Articleevents');
        $this->loadModel('Devisdemandes');
        $this->loadModel('Boncommandes');
        $this->loadModel('Ordrepaiements');
        $devisdemande = $this->Devisdemandes->get($id, [
            'contain' => ['Articleevents', 'Boncommandes']
        ]);
        $boncommande = $this->Boncommandes->find('all',array(
                'conditions'=>array(
                    'Boncommandes.devisdemande_id'=>$id
                )
            )
        );
        $boncommande->hydrate(false);
        $data = $boncommande->first();
        $ordrepaiement2 = $this->Ordrepaiements->find('all',array(
                'conditions'=>array(
                    'Ordrepaiements.devisdemande_id'=>$id
                )
            )
        );
        $ordrepaiement2->hydrate(false);
        $ordrepaiement = $ordrepaiement2->first();
        $this->set('boncommande', $data);
        $this->set('ordrepaiement', $ordrepaiement);
        $this->set('devisdemande', $devisdemande);
        $this->set('_serialize', ['devisdemande']);
        $this->render('/Espaces/respofinances/imprimerordrevirement');

    }



    /****************************/


    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display(...$path)
    {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }

    public function index()
    {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);
        $usrole = $this->Auth->user('role');
        $this->set('role', $usrole);
        $username = $this->Auth->user('username');
        $this->set('username', $username);
        // $date = $con->execute('SELECT titre,day(date) as jourDebut,month(date) as mois,YEAR(date) as year,day(fin) as jourFin,month(fin) as moisFin,YEAR(fin) as yearFin FROM calendriers')->fetchAll('assoc');
        // $this->set('date', $date);
        $couleurs = array("#27ae60" => 0, "#2980b9" => 0, "#e74c3c" => 0, "#7f8c8d" => 0, "#16a085" => 0, "#8e44ad" => 0, "#1abc9c" => 0, "#34495e" => 0);
        $this->set('couleurs', $couleurs);
        $this->render('/Espaces/respofinances/home');
    }

    /*
     * Les vacations
     */
    public function vacations()
    {

        $moisInf = null;
        $moissup = null;
        $annee = null;
        if ($this->request->is('post')) {
            $moisInf = $this->request->data["moisD"];;
            $moissup = $this->request->data["moisP"];;
            $annee = $this->request->data["annee"];
        } else {
            $moisInf = date('m');
            $moissup = date('m');
            $annee = date('Y');
        }

        $this->loadModel('Vacations');
        $this->paginate = [
            'contain' => ['Vacataires', 'Paimentvacs']
        ];


        $query = $this->Vacations
            ->find()
            ->where(['mois <=' => $moissup])
            ->where(['mois >=' => $moisInf])
            ->where(['annee' => $annee]);

        $annes = $this->Vacations
            ->find()
            ->select(['annee'])
            ->distinct(['annee']);

        $moi = $this->Vacations
            ->find()
            ->select(['mois'])
            ->where(['mois <=' => $moissup])
            ->where(['mois >=' => $moisInf])
            ->where(['annee' => $annee])
            ->distinct(['mois']);

        foreach ($moi as $row) {
            $mois[] = $row->mois;
        }
        $annees = null;
        foreach ($annes as $row) {
            $annees[] = $row->annee;
        }
        $vacations = $this->paginate($query);

        $this->loadModel('Vacataires');


        $this->paginate = [
            'contain' => ['Vacations', 'Grades']
        ];
        $queryZ = $this->Vacataires->find();
        $queryZ
            ->distinct(['vacataires.id'])
            ->innerJoin(
                ['Vacations' => 'vacations'],
                [
                    'Vacations.annee' => $annee,
                    'Vacataires.id = Vacations.vacataire_id'
                ]
            );
        $vacataires = $this->paginate($queryZ);
        $anni = $annee;
        $this->set(compact('vacations', 'annees', 'mois', 'vacataires', 'moisInf', 'moissup', 'anni'));
        $this->render('/Espaces/respofinances/vacations');
    }

    public function Mesvacations()
    {
        $this->loadModel('Vacations');
        $this->paginate = [
            'contain' => ['Vacataires', 'Paimentvacs']
        ];

        $query = $this->Vacations
            ->find();


        $vacations = $this->paginate($query);

        $this->set(compact('vacations'));

        $this->set('_serialize', ['vacations']);
        $this->render('/Espaces/respofinances/mesvacations');
    }

    public function addVac()
    {
        $this->loadModel('Vacations');
        $this->loadModel('Vacataires');

        $vacation = $this->Vacations->newEntity();
        if ($this->request->is('post')) {
            $vacation = $this->Vacations->patchEntity($vacation, $this->request->data);
            $vacation->dateInsertion = date('Y-m-d H:i:s');
            $query = $this->Vacataires->find()
                ->where(['id' => $vacation->vacataire_id]);
            $bol = false;
            foreach ($query as $row) {

                if (($row->somme != "SANS") and ($vacation->nbHeure > 20)) {
                    $bol = true;
                }
            }
            if ($bol) {
                $this->Flash->error(__('Un  professeur    fonctionnaire  ne doit pas depasser  20 heures par mois '));
            } else {

                $quer = $this->Vacations->find()
                    ->where(['mois' => $vacation->mois])
                    ->where(['annee' => $vacation->annee])
                    ->where(['vacataire_id' => $vacation->vacataire_id]);
                $bol = false;
                foreach ($quer as $row) {

                    if ($row->id) {
                        $bol = true;
                    }
                }
                if ($bol) {
                    $this->Flash->error(__('ce mois deja remplis '));
                } else if ($this->Vacations->save($vacation)) {
                    $this->Flash->success(__(' vacation ajoutée avec succès'));
                    return $this->redirect(['action' => 'Mesvacations']);
                } else
                    $this->Flash->error(__('la vacation \'est pas ajoutée Essayer à nouveau'));
            }
        }

        $queryZ = $this->Vacataires->find();
        $vacatairees = $this->paginate($queryZ);
        $this->set(compact('vacation', 'vacataires', 'paimentvacs', 'vacatairees'));
        $this->set('_serialize', ['vacation']);
        $this->render('/Espaces/respofinances/addVac');
    }

    public function editVac($id = null)
    {
        $this->loadModel('Vacations');
        $this->loadModel('Vacataires');
        $vacation = $this->Vacations->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vacation = $this->Vacations->patchEntity($vacation, $this->request->data);
            if ($this->Vacations->save($vacation)) {
                $this->Flash->success(__('modification avec succés '));

                return $this->redirect(['action' => 'Mesvacations']);
            }
            $this->Flash->error(__('modification echouée essayé à nouvaux.'));
        }
        $query = $this->Vacataires->find()
            ->where(['id' => $vacation->vacataire_id]);
        $max = 30;
        foreach ($query as $row) {

            if (($row->somme != "SANS")) {
                $max = 20;
            }
        }

        $this->set(compact('vacation', 'max'));
        $this->set('_serialize', ['vacation']);
        $this->render('/Espaces/respofinances/editVac');
    }

    public function deletevacation($id = null)
    {
        $this->loadModel('Vacations');
        $this->request->allowMethod(['post', 'delete']);
        $vacation = $this->Vacations->get($id);
        if ($this->Vacations->delete($vacation)) {
            $this->Flash->success(__('The vacation has been deleted.'));
        } else {
            $this->Flash->error(__('The vacation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'mesvacations']);
    }

    /*
     * Les paiment VAcations
     */
    public function indexPaimentVac()
    {
        $this->loadModel('Paimentvacs');
        $this->loadModel('Vacataires');


        $this->paginate = [
            'contain' => ['Vacations']
        ];
        $paimentvacs = $this->paginate($this->Paimentvacs);
        $paimentvacss = null;
        foreach ($paimentvacs as $paimentvac) {
            if (isset($paimentvac->vacations[0]))

                $vacataire = $this->Vacataires->get($paimentvac->vacations[0]->vacataire_id);

            $paimentvac->vacataire = $vacataire;
            $paimentvacss[] = $paimentvac;
        }
        //debug($paimentvacss);
        $this->set(compact('paimentvacss'));
        $this->set('_serialize', ['paimentvacs']);
        $this->render('/Espaces/respofinances/indexPaimentVac');
    }

    public function addPaimentVac()
    {
        $this->loadModel('Vacataires');

        $queryZ = $this->Vacataires->find();
        $queryZ
            ->distinct(['Vacataires.id'])
            ->innerJoin(
                ['Vacations' => 'vacations'],
                [
                    'Vacations.etat' => "validé",
                    'Vacataires.id = Vacations.vacataire_id'
                ]
            );

        $vacataires = $this->paginate($queryZ);
        $this->set(compact('vacataires'));

        $this->render('/Espaces/respofinances/addPaimentVac');

    }

    public function addPaimentVac2()
    {
        $this->loadModel('Paimentvacs');
        $this->loadModel('Vacations');

        if ($this->request->is('post')) {

            $vacataire_id = $this->request->data['vacataire_id'];
            $this->loadModel('Vacations');

            $query = $this->Vacations
                ->find()
                ->where(['vacataire_id' => $vacataire_id])
                ->where(['etat <>' => "payé"]);
            $vacations = $this->paginate($query);


            $this->set(compact('vacations'));
            $this->render('/Espaces/respofinances/addPaimentVac2');
        }
    }

    public function addPaimentVac3()
    {
        $this->loadModel('Paimentvacs');
        $this->loadModel('Vacation');

        $paimentvac = $this->Paimentvacs->newEntity();

        if ($this->request->is('post')) {
            if (isset($this->request->data['vacations'])) {
                $paimentvac = $this->Paimentvacs->patchEntity($paimentvac, $this->request->data);

                function changedateformat($date)
                {
                    $date1 = explode("/", $date);
                    $s = $date1[1] . "/" . $date1[0] . "/" . $date1[2];
                    return $s;
                }

                $paimentvac->dateDebut = date_format(date_create(changedateformat($this->request->data['dateDebut'])), 'Y-m-d');
                $paimentvac->dateFin = date_format(date_create(changedateformat($this->request->data['dateFin'])), 'Y-m-d');
                if ($this->Paimentvacs->save($paimentvac)) {
                    $this->Flash->success(__(' Paiement ajouté avec succès.'));
                    $this->loadModel('Vacataires');
                    $vacations = TableRegistry::get('Vacations');
                    $vacation = $vacations->get($this->request->data['vacations'][0]);

                    $vacataire = $this->Vacataires->get($vacation->vacataire_id, [
                        'contain' => ['Grades']
                    ]);
                    $date = $vacataire->grades[0]['_joinData']['datedebut'];
                    $taux = $vacataire->grades[0]['taux'];

                    foreach ($vacataire->grades as $grade) {
                        if (($grade['_joinData']['datedebut'] < $date)) {
                            $taux = $grade->taux;
                            $date = $grade['_joinData']['datedebut'];
                        }
                    }
                    foreach ($vacataire->grades as $grade) {
                        if (($grade['_joinData']['datedebut'] > $date) and ($grade['_joinData']['datedebut']->format('Y-m-d') <= $paimentvac->dateDebut)) {
                            $taux = $grade->taux;
                            $date = $grade['_joinData']['datedebut'];
                        }
                    }
                    $nbHeures = 0;

                    foreach ($this->request->data['vacations'] as $vac) {
                        $vacations = TableRegistry::get('Vacations');
                        $vacation = $vacations->get($vac);
                        $vacation->paimentvac_id = $paimentvac->id;
                        $vacation->etat = "payé";
                        $vacations->save($vacation);
                        $nbHeures += $vacation->nbHeure;
                    }
                    $brut = ($nbHeures * $taux);
                    $impot = ($brut * 17 / 100);
                    $net = ($brut - $impot);
                    $paimentvac->montantBrut = $brut;
                    $paimentvac->Impot = $impot;
                    $paimentvac->MontantNet = $net;
                    $this->Paimentvacs->save($paimentvac);
                    return $this->redirect(['action' => 'indexPaimentVac']);
                }

                $this->Flash->error(__('Le paiement n\'est pas ajouté essayer à nouveau'));

                return $this->redirect(['action' => 'addPaimentVac']);
            } else {
                $this->Flash->error(__('vous n\'aves pas sélectioner des vacations '));
                return $this->redirect(['action' => 'addPaimentVac']);
            }
        }
    }

    public function viewpaimentvacss($id = null)
    {
        $this->loadModel('Paimentvacs');
        $this->loadModel('Vacation');
        $paimentvac = $this->Paimentvacs->get($id, [
            'contain' => ['Vacations']
        ]);
        $idvac = $paimentvac->vacations[0]->vacataire_id;

        $this->loadModel('Vacataires');
        $vacataire = $this->Vacataires->get($idvac);

        $this->set(compact('paimentvac', 'vacataire'));
        $this->set('paimentvac', $paimentvac);
        $this->render('/Espaces/respofinances/viewpaimentvacss');
    }

    public function editpaimentvacs($id = null)
    {
        $this->loadModel('Paimentvacs');
        $paimentvac = $this->Paimentvacs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paimentvac = $this->Paimentvacs->patchEntity($paimentvac, $this->request->data);
            function changedateformat($date)
            {
                $date1 = explode("/", $date);
                $s = $date1[1] . "/" . $date1[0] . "/" . $date1[2];
                return $s;
            }

            $paimentvac->dateFin = date_format(date_create(changedateformat($this->request->data['dateFin'])), 'Y-m-d');

            if ($this->Paimentvacs->save($paimentvac)) {
                $this->Flash->success(__('Paiement modifié  avec succès', 'Paimentvac'));
                return $this->redirect(['action' => 'indexPaimentVac']);
            } else {
                $this->Flash->error(__('Le Paiement n\'est pas modifié  essayez à nouveau.', 'Paimentvac'));
            }
        }

        $this->set(compact('paimentvac'));
        $this->set('_serialize', ['paimentvac']);
        $this->render('/Espaces/respofinances/editpaimentvacs');

    }

    public function deletepaimentvacs($id = null)
    {
        $this->loadModel('Paimentvacs');
        $this->request->allowMethod(['post', 'delete']);
        $paimentvac = $this->Paimentvacs->get($id, [
            'contain' => ['Vacations']
        ]);
        foreach ($paimentvac->vacations as $vacation) {
            $vacations = TableRegistry::get('Vacations');
            $vacation = $vacations->get($vacation->id);
            $vacation->etat = 'validé';
            $vacations->save($vacation);
        }
        if ($this->Paimentvacs->delete($paimentvac)) {
            $this->Flash->success(__('Paiement supprimé  avec succès.', 'Paimentvac'));
        } else {
            $this->Flash->error(__('Paiement n\'est pas supprimé  essayez à nouveau.', 'Paimentvac'));
        }
        return $this->redirect(['action' => 'indexPaimentVac']);
    }

    public function etatSommesVac($id = null)
    {
        $this->loadModel('Paimentvacs');
        $paimentvac = $this->Paimentvacs->get($id, [
            'contain' => ['Vacations']
        ]);
        $idvac = $paimentvac->vacations[0]->vacataire_id;

        $this->loadModel('Vacataires');

        $vacataire = $this->Vacataires->get($idvac, [
            'contain' => ['Grades']
        ]);
        $date = $vacataire->grades[0]['_joinData']['datedebut'];
        $taux = $vacataire->grades[0]['taux'];
        $categorie = $vacataire->grades[0]['categorie'];
        $gradenom = $vacataire->grades[0]['nomGrade'];
        foreach ($vacataire->grades as $grade) {
            if (($grade['_joinData']['datedebut'] < $date)) {
                $taux = $grade->taux;
                $date = $grade['_joinData']['datedebut'];
                $categorie = $grade->categorie;
                $gradenom = $grade->nomGrade;
            }
        }
        foreach ($vacataire->grades as $grade) {
            if (($grade['_joinData']['datedebut'] > $date) and ($grade['_joinData']['datedebut']->format('Y-m-d') <= $paimentvac->dateDebut->format('Y-m-d'))) {
                $taux = $grade->taux;
                $date = $grade['_joinData']['datedebut'];
                $categorie = $grade->categorie;
                $gradenom = $grade->nomGrade;
            }
        }

        $nbHeures = 0;
        foreach ($paimentvac->vacations as $vacation) {
            $nbHeures += $vacation->nbHeure;
        }
        $this->set(compact('paimentvac', 'vacataire', 'gradenom', 'categorie', 'taux', 'nbHeures'));
        $this->set('paimentvac', $paimentvac);
        $this->set('_serialize', ['paimentvac']);
        $this->render('/Espaces/respofinances/etatSommesVac');
    }

    public function opVac($id = null)
    {
        $this->loadModel('Paimentvacs');
        $paimentvac = $this->Paimentvacs->get($id, [
            'contain' => ['Vacations']
        ]);
        $idvac = $paimentvac->vacations[0]->vacataire_id;
        $this->loadModel('Vacataires');
        $vacataire = $this->Vacataires->get($idvac);
        $this->set(compact('paimentvac', 'vacataire'));
        $this->set('_serialize', ['paimentvac']);
        $this->render('/Espaces/respofinances/opVac');
    }

    public function opVacRap($id = null)
    {
        $this->loadModel('Paimentvacs');
        $paimentvac = $this->Paimentvacs->get($id, [
            'contain' => ['Vacations']
        ]);
        $idvac = $paimentvac->vacations[0]->vacataire_id;
        $this->loadModel('Vacataires');
        $vacataire = $this->Vacataires->get($idvac);
        $this->set(compact('paimentvac', 'vacataire'));
        $this->set('_serialize', ['paimentvac']);
        $this->render('/Espaces/respofinances/opVacRap');
    }


    /*
     *
     * Prélèvements
     *
     */

    public function indexPrelevements()
    {
        $this->loadModel('Prelevements');
        $this->paginate = [
            'contain' => ['Paimentvacs']
        ];
        $prelevements = $this->paginate($this->Prelevements);

        $prelevementss = null;
        foreach ($prelevements as $prelevement) {
            $totalImpot = 0;
            foreach ($prelevement->paimentvacs as $paimentvac) {
                $totalImpot = number_format((float)($totalImpot + $paimentvac->Impot), 2, '.', '');
            }
            $prelevement->totalImpot = $totalImpot;
            $prelevementss[] = $prelevement;

        }
        $this->set(compact('prelevements', 'prelevementss'));
        $this->set('_serialize', ['prelevementss']);

        $this->render('/Espaces/respofinances/indexPrelevements');
    }

    public function addPrelevement()
    {
        $this->loadModel('Prelevements');
        $prelevement = $this->Prelevements->newEntity();
        if ($this->request->is('post')) {
            if (isset($this->request->data['paimentvacs'])) {
                function changedateformat($date)
                {
                    $date1 = explode("/", $date);
                    $s = $date1[1] . "/" . $date1[0] . "/" . $date1[2];
                    return $s;
                }

                $prelevement->dateDebut = date_format(date_create(changedateformat($this->request->data['dateDebut'])), 'Y-m-d');
                $prelevement->dateFin = date_format(date_create(changedateformat($this->request->data['dateFin'])), 'Y-m-d');

                if ($this->Prelevements->save($prelevement)) {
                    $this->Flash->success(__(' Prélèvement ajoutée avec succès'));

                    foreach ($this->request->data['paimentvacs'] as $vac) {
                        $paimentvacs = TableRegistry::get('Paimentvacs');;
                        $paimentvac = $paimentvacs->get($vac);
                        $paimentvac->prelevement_id = $prelevement->id;
                        $paimentvacs->save($paimentvac);
                    }
                    return $this->redirect(['action' => 'indexPrelevements']);
                } else {
                    $this->Flash->error(__('Prélèvement n\'est pas ajouté essayez à nouveau.', 'Prelevement'));
                }
            } else {
                $this->Flash->error(__('veuillez sélectionner une paiement '));
            }
        }
        $this->loadModel('Paimentvacs');
        $this->loadModel('Vacataires');


        $this->paginate = [
            'contain' => ['Vacations']
        ];

        $queryZ = $this->Paimentvacs->find();
        $queryZ
            ->where(function ($exp, $q) {
                return $exp->isNull('prelevement_id');
            });
        $paimentvacs = $this->paginate($queryZ);
        $paimentvacss = null;
        foreach ($paimentvacs as $paimentvac) {
            if (isset($paimentvac->vacations[0]))

                $vacataire = $this->Vacataires->get($paimentvac->vacations[0]->vacataire_id);

            $paimentvac->vacataire = $vacataire;
            $paimentvacss[] = $paimentvac;
        }

        $this->set(compact('prelevement', 'paimentvacss'));
        $this->set('_serialize', ['prelevement']);
        $this->render('/Espaces/respofinances/addPrelevement');
    }

    public function viewPrelevement($id = null)
    {
        $this->loadModel('Prelevements');
        $prelevement = $this->Prelevements->get($id, [
            'contain' => ['Paimentvacs']
        ]);

        $this->set('prelevement', $prelevement);
        $this->set('_serialize', ['prelevement']);
        $this->render('/Espaces/respofinances/viewPrelevement');
    }

    public function deletePrelevement($id = null)
    {
        $this->loadModel('Prelevements');
        $this->request->allowMethod(['post', 'delete']);
        $prelevement = $this->Prelevements->get($id);
        if ($this->Prelevements->delete($prelevement)) {
            $this->Flash->success(__('Prélèvement supprimé avec succès.', 'Prelevement'));
        } else {
            $this->Flash->error(__('Le prélèvement n\'est pas supprimé essayer à nouveau.', 'Prelevement'));
        }
        return $this->redirect(['action' => 'indexPrelevements']);
    }

    public function editPrelevement($id = null)
    {
        $this->loadModel('Prelevements');
        $prelevement = $this->Prelevements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $prelevement = $this->Prelevements->patchEntity($prelevement, $this->request->data);
            function changedateformat($date)
            {
                $date1 = explode("/", $date);
                $s = $date1[1] . "/" . $date1[0] . "/" . $date1[2];
                return $s;
            }

            $prelevement->dateDebut = date_format(date_create(changedateformat($this->request->data['dateDebut'])), 'Y-m-d');
            $prelevement->dateFin = date_format(date_create(changedateformat($this->request->data['dateFin'])), 'Y-m-d');

            if ($this->Prelevements->save($prelevement)) {
                $this->Flash->success(__('Prélèvement modifié  avec succès.', 'Prelevement'));
                return $this->redirect(['action' => 'indexPrelevements']);
            } else {
                $this->Flash->error(__('le prélèvement n\'est pas modifié essayez à nouveau', 'Prelevement'));
            }
        }
        $this->set(compact('prelevement'));
        $this->set('_serialize', ['prelevement']);
        $this->render('/Espaces/respofinances/editprelevement');
    }

    /*
        *
        * Prélèvements files
        *
        */
    public function etatPrelevement($id = null)
    {

        $this->loadModel('Prelevements');
        $prelevement = $this->Prelevements->get($id, [
            'contain' => ['Paimentvacs']
        ]);

        $this->loadModel('Paimentvacs');
        $this->loadModel('Vacataires');


        $paimentvacss = null;
        foreach ($prelevement->paimentvacs as $paimentvac) {
            $paimentvace = $this->Paimentvacs->get($paimentvac->id, [
                'contain' => ['Vacations']
            ]);

            if (isset($paimentvace->vacations[0]))
                $vacataire = $this->Vacataires->get($paimentvace->vacations[0]->vacataire_id);

            $paimentvace->vacataire = $vacataire;
            $paimentvacss[] = $paimentvace;
        }


        $this->set(compact('prelevement', 'paimentvacss'));
        $this->set('prelevement', $prelevement);
        $this->set('_serialize', ['prelevements']);
        $this->render('/Espaces/respofinances/etatPrelevement');
    }

    public function opVacPre($id = null)
    {
        $this->loadModel('Prelevements');
        $prelevement = $this->Prelevements->get($id, [
            'contain' => ['Paimentvacs']
        ]);

        $totalImpot = 0;
        foreach ($prelevement->paimentvacs as $paimentvac) {
            $totalImpot = number_format((float)($totalImpot + $paimentvac->Impot), 2, '.', '');
        }


        $this->set(compact('prelevement', 'totalImpot'));
        $this->set('_serialize', ['prelevement']);
        $this->render('/Espaces/respofinances/opVacPre');
    }

    public function opVacRapPre($id = null)
    {
        $this->loadModel('Prelevements');
        $prelevement = $this->Prelevements->get($id, [
            'contain' => ['Paimentvacs']
        ]);

        $totalImpot = 0;
        foreach ($prelevement->paimentvacs as $paimentvac) {
            $totalImpot = number_format((float)($totalImpot + $paimentvac->Impot), 2, '.', '');
        }


        $this->set(compact('prelevement', 'totalImpot'));
        $this->set('_serialize', ['prelevement']);
        $this->render('/Espaces/respofinances/opVacRapPre');
    }


    /*
     *
     *
     * Imane
     */

    public function supheures()
    {

        $moisInf = null;
        $moissup = null;
        $annee = null;
        if ($this->request->is('post')) {
            $moisInf = $this->request->data["moisD"];;
            $moissup = $this->request->data["moisP"];;
            $annee = $this->request->data["annee"];
        } else {
            $moisInf = date('m');
            $moissup = date('m');
            $annee = date('Y');
        }


        $this->loadModel('SupHeures');
        $this->paginate = [
            'contain' => ['Profpermanents', 'Paimentsups']
        ];

        $query = $this->SupHeures
            ->find()
            ->where(['mois <=' => $moissup])
            ->where(['mois >=' => $moisInf])
            ->where(['annee' => $annee]);


        $annes = $this->SupHeures
            ->find()
            ->select(['annee'])
            ->distinct(['annee']);

        $moi = $this->SupHeures
            ->find()
            ->select(['mois'])
            ->where(['mois <=' => $moissup])
            ->where(['mois >=' => $moisInf])
            ->where(['annee' => $annee])
            ->distinct(['mois']);

        foreach ($moi as $row) {
            $mois[] = $row->mois;
        }
        $annees = null;
        foreach ($annes as $row) {
            $annees[] = $row->annee;
        }

        $sup_heures = $this->paginate($query);

        $this->loadModel('Profpermanents');


        $this->paginate = [
            'contain' => ['SupHeures', 'Grades']
        ];
        $queryZ = $this->Profpermanents->find();
        $queryZ
            ->distinct(['Profpermanents.id '])
            ->innerJoin(
                ['SupHeures' => 'sup_heures'],
                [
                    'SupHeures.annee' => $annee,
                    'Profpermanents.id = SupHeures.profpermanent_id '
                ]
            );

        $professeurs = $this->paginate($queryZ);

        $anni = $annee;
        $this->set(compact('sup_heures', 'annees', 'mois', 'professeurs', 'moisInf', 'moissup', 'anni'));

        $this->render('/Espaces/respofinances/supheure');
    }

    public function MesHeures()
    {
        $this->loadModel('SupHeures');
        $this->paginate = [
            'contain' => ['Profpermanents']
        ];

        $query = $this->SupHeures
            ->find();


        $supheures = $this->paginate($query);

        $this->set(compact('supheures'));

        $this->set('_serialize', ['supheures']);
        $this->render('/Espaces/respofinances/mesheures');
    }

    public function editSup($id = null)
    {

        $this->loadModel('SupHeures');
        $supheures = $this->SupHeures->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $supheures = $this->SupHeures->patchEntity($supheures, $this->request->data);
            if ($this->SupHeures->save($supheures)) {
                $this->Flash->success(__('Modification avec succés.'));

                return $this->redirect(['action' => 'MesHeures']);
            }
            $this->Flash->error(__('modification echoué.'));
        }

        $this->set(compact('supheures'));
        $this->set('_serialize', ['supheures']);
        $this->set('_serialize', ['professeurs']);
        $this->render('/Espaces/respofinances/editSup');
    }

    public function addSup()
    {
        $this->loadModel('Profpermanents');
        $this->loadModel('SupHeures');
        $supheure = $this->SupHeures->newEntity();
        if ($this->request->is('post')) {

            $supheure->mois = $this->request->data['mois'];
            $supheure->annee = $this->request->data['annee'];
            $supheure->etat = $this->request->data['etat'];
            $supheure->nbHeure = $this->request->data['nbHeure'];
            $supheure->dateInsertion = date('Y-m-d H:i:s');
            $supheure->profpermanent_id = $this->request->data['profpermanent_id'];
            $quer = $this->SupHeures->find()
                ->where(['mois' => $supheure->mois])
                ->where(['annee' => $supheure->annee])
                ->where(['profpermanent_id' => $supheure->profpermanent_id]);
            $bol = false;
            foreach ($quer as $row) {

                if ($row->id) {
                    $bol = true;
                }
            }
            if ($bol) {
                $this->Flash->error(__('ce mois deja remplis '));
            } else if ($this->SupHeures->save($supheure)) {
                $this->Flash->success(__(' Heure sup ajoutée avec succès'));
                return $this->redirect(['action' => 'MesHeures']);
            } else
                $this->Flash->error(__('Heure sup \'est pas ajoutée Essayer à nouveau'));

        }

        $queryZ = $this->Profpermanents->find();
        $professeurs = $this->paginate($queryZ);
        $this->set(compact('supheure', 'professeurs'));
        $this->set('_serialize', ['supheure']);
        $this->render('/Espaces/respofinances/addSup');

    }

    public function deleteSup($id = null)
    {
        $this->loadModel('SupHeures');
        $this->request->allowMethod(['post', 'delete']);
        $sup = $this->SupHeures->get($id);
        if ($this->SupHeures->delete($sup)) {
            $this->Flash->success(__('Heure sup supprimée.'));
        } else {
            $this->Flash->error(__('Heure sup non  supprimée non.'));
        }
        return $this->redirect(['action' => 'MesHeures']);
    }

    public function indexPaimentSup()
    {
        $this->loadModel('Paimentsups');
        $this->loadModel('Profpermanents');
        $this->paginate = [
            'contain' => ['SupHeures']
        ];

        $paimentsups = $this->paginate($this->Paimentsups);
        $paimentsupss = null;
        foreach ($paimentsups as $paimentsup) {
            if (isset($paimentsup->sup_heures[0])) {
                $prof = $this->Profpermanents->get($paimentsup->sup_heures[0]->profpermanent_id);
                $paimentsup->profpermanent = $prof;
            }
            $paimentsupss[] = $paimentsup;
        }
        $this->set(compact('paimentsupss'));
        $this->set('_serialize', ['paimentsupss']);
        $this->render('/Espaces/respofinances/indexPaimentSup');
    }

    public function viewPaimentSup($id = null)
    {
        $this->loadModel('Paimentsups');
        $this->loadModel('SupHeures');

        $paimentsup = $this->Paimentsups->get($id, [
            'contain' => ['SupHeures']
        ]);
        $idprof = $paimentsup->sup_heures[0]->profpermanent_id;

        $this->loadModel('Profpermanents');
        $professeur = $this->Profpermanents->get($idprof);

        $this->set(compact('paimentsup', 'professeur'));
        $this->set('paimentsup', $paimentsup);
        $this->render('/Espaces/respofinances/viewpaimentsup');
    }

    public function addPaimentSup()
    {

        $this->loadModel('Profpermanents');

        $queryZ = $this->Profpermanents->find();
        $queryZ
            ->distinct(['Profpermanents.id'])
            ->innerJoin(
                ['SupHeures' => 'sup_heures'],
                [
                    //'SupHeures.etat' => "validé",
                    'Profpermanents.id = SupHeures.profpermanent_id'
                ]
            );

        $profperm = $this->paginate($queryZ);
        $this->set(compact('profperm'));

        $this->render('/Espaces/respofinances/addPaimentSup');


    }

    public function addPaimentSup2()
    {

        $this->loadModel('Paimentsups');
        $this->loadModel('SupHeures');

        if ($this->request->is('post')) {

            $permanent_id = $this->request->data['profpermanent_id'];
            $this->loadModel('SupHeures');

            $query = $this->SupHeures
                ->find()
                ->where(['profpermanent_id <=' => $permanent_id])
                ->where(['etat <>' => "payé"]);
            $suppheures = $this->paginate($query);

            $this->set(compact('suppheures'));
            $this->set('_serialize', ['suppheures']);
            $this->render('/Espaces/respofinances/addPaimentSup2');
        }

    }

    public function AddPaimentsup3()
    {
        $this->loadModel('Paimentsups');
        $this->loadModel('SupHeures');

        $paimentsup = $this->Paimentsups->newEntity();

        if ($this->request->is('post')) {
            if (isset($this->request->data['supheures'])) {
                $paimentsup = $this->Paimentsups->patchEntity($paimentsup, $this->request->data);

                function changedateformat($date)
                {
                    $date1 = explode("/", $date);
                    $s = $date1[1] . "/" . $date1[0] . "/" . $date1[2];
                    return $s;
                }

                $paimentsup->dateDebut = date_format(date_create(changedateformat($this->request->data['dateDebut'])), 'Y-m-d');
                $paimentsup->dateFin = date_format(date_create(changedateformat($this->request->data['dateFin'])), 'Y-m-d');
                if ($this->Paimentsups->save($paimentsup)) {
                    $this->Flash->success(__(' Paiement ajouté avec succès.'));
                    $this->loadModel('Profpermanents');
                    $supheures = TableRegistry::get('SupHeures');
                    $supheure = $supheures->get($this->request->data['supheures'][0]);

                    $professeur = $this->Profpermanents->get($supheure->profpermanent_id, [
                        'contain' => ['Grades']
                    ]);
                    $date = $professeur->grades[0]['_joinData']['date_grade'];
                    $taux = $professeur->grades[0]['taux'];

                    foreach ($professeur->grades as $grade) {
                        if (($grade['_joinData']['date_grade'] < $date)) {
                            $taux = $grade->taux;
                            $date = $grade['_joinData']['date_grade'];
                        }
                    }
                    debug($date);
                    foreach ($professeur->grades as $grade) {
                        if (($grade['_joinData']['date_grade'] > $date) and ($grade['_joinData']['date_grade']->format('Y-m-d') <= $paimentsup->dateDebut)) {
                            $taux = $grade->taux;
                            $date = $grade['_joinData']['date_grade'];
                        }
                    }
                    $nbHeures = 0;

                    foreach ($this->request->data['supheures'] as $vac) {
                        $supheures = TableRegistry::get('SupHeures');
                        $supheure = $supheures->get($vac);
                        $supheure->paimentsup_id = $paimentsup->id;
                        $supheure->etat = "payé";
                        $supheures->save($supheure);
                        $nbHeures += $supheure->nbHeure;
                    }
                    $brut = ($nbHeures * $taux);
                    $impot = ($brut * 38 / 100);
                    $net = ($brut - $impot);
                    $paimentsup->montantBrut = $brut;
                    $paimentsup->Impot = $impot;
                    $paimentsup->MontantNet = $net;
                    $this->Paimentsups->save($paimentsup);
                    return $this->redirect(['action' => 'indexPaimentsup']);
                }

                $this->Flash->error(__('Le paiement n\'est pas ajouté essayer à nouveau'));

                return $this->redirect(['action' => 'addPaimentsup']);
            } else {
                $this->Flash->error(__('vous n\'aves pas sélectioner des vacations '));
                return $this->redirect(['action' => 'addPaimentsup']);
            }
        }
    }

    public function editPaimentsup($id = null)
    {
        $this->loadModel('Paimentsups');
        $paimentsup = $this->Paimentsups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paimentsup = $this->Paimentsups->patchEntity($paimentsup, $this->request->data);
            function changedateformat($date)
            {
                $date1 = explode("/", $date);
                $s = $date1[1] . "/" . $date1[0] . "/" . $date1[2];
                return $s;
            }

            $paimentsup->dateFin = date_format(date_create(changedateformat($this->request->data['dateFin'])), 'Y-m-d');

            if ($this->Paimentsups->save($paimentsup)) {
                $this->Flash->success(__('The paimentsup has been saved.'));

                return $this->redirect(['action' => 'indexPaimentsup']);
            }
            $this->Flash->error(__('The paimentsup could not be saved. Please, try again.'));
        }


        $this->set(compact('paimentsup'));
        $this->set('_serialize', ['paimentsup']);
        $this->render('/Espaces/respofinances/editpaimentsup');

    }

    public function deletepaimentsup($id = null)
    {
        $this->loadModel('Paimentsups');
        $this->request->allowMethod(['post', 'delete']);
        $paimentsup = $this->Paimentsups->get($id, [
            'contain' => ['SupHeures']
        ]);
        foreach ($paimentsup->sup_heures as $sup_heure) {
            $sup_heures = TableRegistry::get('SupHeures');
            $sup_heure = $sup_heures->get($sup_heure->id);
            $sup_heure->etat = 'validé';
            $sup_heures->save($sup_heure);
        }
        if ($this->Paimentsups->delete($paimentsup)) {
            $this->Flash->success(__('Paiement supprimé  avec succès.', 'Paimentvac'));
        } else {
            $this->Flash->error(__('Paiement n\'est pas supprimé  essayez à nouveau.', 'Paimentvac'));
        }
        return $this->redirect(['action' => 'indexPaimentsup']);
    }

    public function etatSommesSup($id = null)
    {
        $this->loadModel('Paimentsups');
        $paimentsup = $this->Paimentsups->get($id, [
            'contain' => ['SupHeures']
        ]);
        $idvac = $paimentsup->sup_heures[0]->profpermanent_id;

        $this->loadModel('Profpermanents');

        $professeur = $this->Profpermanents->get($idvac, [
            'contain' => ['Grades']
        ]);
        $date = $professeur->grades[0]['_joinData']['date_grade'];
        $taux = $professeur->grades[0]['taux'];
        $categorie = $professeur->grades[0]['categorie'];
        $gradenom = $professeur->grades[0]['nomGrade'];
        foreach ($professeur->grades as $grade) {
            if (($grade['_joinData']['date_grade'] < $date)) {
                $taux = $grade->taux;
                $date = $grade['_joinData']['date_grade'];
                $categorie = $grade->categorie;
                $gradenom = $grade->nomGrade;
            }
        }
        foreach ($professeur->grades as $grade) {
            if (($grade['_joinData']['date_grade'] > $date) and ($grade['_joinData']['date_grade']->format('Y-m-d') <= $paimentsup->dateDebut->format('Y-m-d'))) {
                $taux = $grade->taux;
                $date = $grade['_joinData']['date_grade'];
                $categorie = $grade->categorie;
                $gradenom = $grade->nomGrade;
            }
        }

        $nbHeures = 0;
        foreach ($paimentsup->sup_heures as $sup) {
            $nbHeures += $sup->nbHeure;
        }
        $this->set(compact('paimentsup', 'professeur', 'gradenom', 'categorie', 'taux', 'nbHeures'));
        $this->set('paimentsup', $paimentsup);
        $this->set('_serialize', ['paimentsup']);
        $this->render('/Espaces/respofinances/etatSommesSup');
    }

    public function opSup($id = null)
    {
        $this->loadModel('Paimentsups');
        $paimentsup = $this->Paimentsups->get($id, [
            'contain' => ['SupHeures']
        ]);
        $idvac = $paimentsup->sup_heures[0]->profpermanent_id;
        $this->loadModel('Profpermanents');
        $professeur = $this->Profpermanents->get($idvac);
        $this->set(compact('paimentsup', 'professeur'));
        $this->set('_serialize', ['paimentsup']);
        $this->render('/Espaces/respofinances/opSup');
    }

    public function opSupRap($id = null)
    {
        $this->loadModel('Paimentsups');
        $paimentsup = $this->Paimentsups->get($id, [
            'contain' => ['SupHeures']
        ]);
        $idvac = $paimentsup->sup_heures[0]->profpermanent_id;
        $this->loadModel('Profpermanents');
        $professeur = $this->Profpermanents->get($idvac);
        $this->set(compact('paimentsup', 'professeur'));
        $this->set('_serialize', ['paimentsup']);
        $this->render('/Espaces/respofinances/opSupRap');
    }

    /*
    * Prélèvements sup
    *
    */

    public function indexPrelevementsup()
    {
        $this->loadModel('Prelevementsups');
        $this->paginate = [
            'contain' => ['Paimentsups']
        ];
        $prelevements = $this->paginate($this->Prelevementsups);

        $prelevementss = null;
        foreach ($prelevements as $prelevement) {
            $totalImpot = 0;
            foreach ($prelevement->paimentsups as $paiment) {
                $totalImpot = number_format((float)($totalImpot + $paiment->Impot), 2, '.', '');
            }
            $prelevement->totalImpot = $totalImpot;
            $prelevementss[] = $prelevement;

        }
        $this->set(compact('prelevements', 'prelevementss'));
        $this->set('_serialize', ['prelevementss']);

        $this->render('/Espaces/respofinances/indexPrelevementsup');
    }

    public function addPrelevementsup()
    {
        $this->loadModel('Prelevementsups');
        $prelevement = $this->Prelevementsups->newEntity();
        if ($this->request->is('post')) {
            if (isset($this->request->data['paimentsups'])) {
                //         $prelevement = $this->Prelevements->patchEntity($prelevement, $this->request->data);
                function changedateformat($date)
                {
                    $date1 = explode("/", $date);
                    $s = $date1[1] . "/" . $date1[0] . "/" . $date1[2];
                    return $s;
                }

                $prelevement->dateDebut = date_format(date_create(changedateformat($this->request->data['dateDebut'])), 'Y-m-d');
                $prelevement->dateFin = date_format(date_create(changedateformat($this->request->data['dateFin'])), 'Y-m-d');

                if ($this->Prelevementsups->save($prelevement)) {
                    $this->Flash->success(__(' Prélèvement ajoutée avec succès'));

                    foreach ($this->request->data['paimentsups'] as $vac) {
                        $paimentsups = TableRegistry::get('Paimentsups');;
                        $paimentsup = $paimentsups->get($vac);
                        $paimentsup->prelevementsup_id = $prelevement->id;
                        $paimentsups->save($paimentsup);
                    }
                    return $this->redirect(['action' => 'indexPrelevementsup']);
                } else {
                    $this->Flash->error(__('Prélèvement n\'est pas ajouté essayez à nouveau.', 'Prelevement'));
                }
            } else {
                $this->Flash->error(__('veuillez sélectionner une paiement '));
            }
        }
        $this->loadModel('Paimentsups');
        $this->loadModel('Profpermanents');


        $this->paginate = [
            'contain' => ['SupHeures']
        ];

        $queryZ = $this->Paimentsups->find();
        $queryZ
            ->where(function ($exp, $q) {
                return $exp->isNull('prelevementsup_id');
            });
        $paimentsups = $this->paginate($queryZ);
        $paimentsupss = null;
        foreach ($paimentsups as $paimentsup) {
            if (isset($paimentsup->sup_heures[0]))

                $professeur = $this->Profpermanents->get($paimentsup->sup_heures[0]->profpermanent_id);

            $paimentsup->professeur = $professeur;
            $paimentsupss[] = $paimentsup;
        }

        $this->set(compact('prelevement', 'paimentsupss'));
        $this->set('_serialize', ['prelevement']);
        $this->render('/Espaces/respofinances/addPrelevementsup');
    }

    public function viewPrelevementsup($id = null)
    {
        $this->loadModel('Prelevementsups');
        $prelevement = $this->Prelevementsups->get($id, [
            'contain' => ['Paimentsups']
        ]);

        $this->set('prelevement', $prelevement);
        $this->set('_serialize', ['prelevement']);
        $this->render('/Espaces/respofinances/viewPrelevementsup');
    }

    public function deletePrelevementsup($id = null)
    {
        $this->loadModel('Prelevementsups');
        $this->request->allowMethod(['post', 'delete']);
        $prelevement = $this->Prelevementsups->get($id);
        if ($this->Prelevementsups->delete($prelevement)) {
            $this->Flash->success(__('Prélèvement supprimé avec succès.', 'Prelevement'));
        } else {
            $this->Flash->error(__('Le prélèvement n\'est pas supprimé essayer à nouveau.', 'Prelevement'));
        }
        return $this->redirect(['action' => 'indexPrelevementsup']);
    }

    public function editPrelevementsup($id = null)
    {
        $this->loadModel('Prelevementsups');
        $prelevement = $this->Prelevementsups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            function changedateformat($date)
            {
                $date1 = explode("/", $date);
                $s = $date1[1] . "/" . $date1[0] . "/" . $date1[2];
                return $s;
            }

            $prelevement->dateDebut = date_format(date_create(changedateformat($this->request->data['dateDebut'])), 'Y-m-d');
            $prelevement->dateFin = date_format(date_create(changedateformat($this->request->data['dateFin'])), 'Y-m-d');

            if ($this->Prelevementsups->save($prelevement)) {
                $this->Flash->success(__('Prélèvement modifié  avec succès.', 'Prelevement'));
                return $this->redirect(['action' => 'indexPrelevementsup']);
            } else {
                $this->Flash->error(__('le prélèvement n\'est pas modifié essayez à nouveau', 'Prelevement'));
            }
        }
        $this->set(compact('prelevement'));
        $this->set('_serialize', ['prelevement']);
        $this->render('/Espaces/respofinances/editprelevementsup');
    }

    /*
        *
        * Prélèvements files
        *
        */
    public function etatPrelevementsup($id = null)
    {

        $this->loadModel('Prelevementsups');
        $prelevement = $this->Prelevementsups->get($id, [
            'contain' => ['Paimentsups']
        ]);

        $this->loadModel('Paimentsups');
        $this->loadModel('Profpermanents');

        $paimentsupss = null;
        foreach ($prelevement->paimentsups as $paimentsup) {
            $paimentsupe = $this->Paimentsups->get($paimentsup->id, [
                'contain' => ['SupHeures']
            ]);

            if (isset($paimentsupe->sup_heures[0]))

                $pro = $this->Profpermanents->get($paimentsupe->sup_heures[0]->profpermanent_id);

            $paimentsupe->professeur = $pro;
            $paimentsupss[] = $paimentsupe;
        }

        $this->set(compact('prelevement', 'paimentsupss'));
        $this->set('prelevement', $prelevement);
        $this->set('_serialize', ['prelevements']);
        $this->render('/Espaces/respofinances/etatPrelevementsup');
    }

    public function opSupPre($id = null)
    {
        $this->loadModel('Prelevementsups');
        $prelevement = $this->Prelevementsups->get($id, [
            'contain' => ['Paimentsups']
        ]);

        $totalImpot = 0;
        foreach ($prelevement->paimentsups as $paimentsup) {
            $totalImpot = number_format((float)($totalImpot + $paimentsup->Impot), 2, '.', '');
        }


        $this->set(compact('prelevement', 'totalImpot'));
        $this->set('_serialize', ['prelevement']);
        $this->render('/Espaces/respofinances/opSupPre');
    }

    public function opSupRapPre($id = null)
    {
        $this->loadModel('Prelevementsups');
        $prelevement = $this->Prelevementsups->get($id, [
            'contain' => ['Paimentsups']
        ]);

        $totalImpot = 0;
        foreach ($prelevement->paimentsups as $paimentsup) {
            $totalImpot = number_format((float)($totalImpot + $paimentsup->Impot), 2, '.', '');
        }


        $this->set(compact('prelevement', 'totalImpot'));
        $this->set('_serialize', ['prelevement']);
        $this->render('/Espaces/respofinances/opSupRapPre');
    }


    /*
     * Mesouak
     */


    public function afficherMission()
    {
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Profpermanents', 'Villes']
        ];
        $missions = $this->paginate('Missions');

        $this->set(compact('missions'));
        $this->set('_serialize', ['missions']);
        $this->render('/Espaces/respofinances/afficherMission');

    }

    public function afficherProf()
    {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);


        $profpermanent = TableRegistry::get('profpermanents');
        $profpermanents = $profpermanent->find("all", array("fields" => array("somme", "id")))->toArray();

        $id = $this->request->data['search'];
        $resultat = $con->execute('SELECT * FROM missions WHERE missions.profpermanent_id=?', [$id])->fetchAll();
        $this->set(compact('resultat', 'profpermanents', 'id'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/afficherProf');

    }

    public function afficherFonc()
    {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $id = $this->request->data['search'];
        $resultat = $con->execute('SELECT * FROM missions WHERE missions.fonctionnaire_id=?', [$id])->fetchAll();
        $fonctionnaire = TableRegistry::get('fonctionnaires');
        $fonctionnaires = $fonctionnaire->find("all", array("fields" => array("somme", "id")))->toArray();

        $this->set(compact('resultat', 'fonctionnaires', 'id'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/afficherFonc');

    }

    public function afficherMissionProf()
    {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT * FROM missions WHERE missions.profpermanent_id <> "null"')->fetchAll();

        $profpermanent = TableRegistry::get('profpermanents');
        $profpermanents = $profpermanent->find("all", array("fields" => array("somme", "id")))->toArray();


        $this->set(compact('resultat', 'profpermanents'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/afficherMissionProf');

    }

    public function afficherMissionFonc()
    {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT * FROM missions WHERE missions.fonctionnaire_id <> "null"')->fetchAll();


        $fonctionnaire = TableRegistry::get('fonctionnaires');
        $fonctionnaires = $fonctionnaire->find("all", array("fields" => array("somme", "id")))->toArray();

        $this->set(compact('resultat', 'fonctionnaires'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/afficherMissionFonc');

    }

    public function ajouterMissionProf()
    {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);


        $missions = TableRegistry::get('missions');
        $mission = $missions->newEntity();
        $villes = TableRegistry::get('villes');
        $profpermanents = TableRegistry::get('profpermanents');

        $fonctionnaires = $missions->Fonctionnaires->find('list', ['limit' => 200]);
        $profpermanent = $profpermanents->find('all');
        $ville = $villes->find("all");

        if ($this->request->is('post')) {
            $mission = $missions->patchEntity($mission, $this->request->data);

            $mission->profpermanent_id = $this->request->data['Prof'];
            $mission->ville_id = $this->request->data['LaVille'];
            $mission->date_depart = $this->request->data['date_depart'];
            $mission->date_arrivee = $this->request->data['date_arrivee'];
            $mission->Motif = " ";

// calcule indemnite_kilometriquem

            $dist = $con->execute('SELECT distance FROM villes WHERE id =?', [$this->request->data['LaVille']])->fetchAll('assoc');

            $mission->indemnite_kilometrique = $dist[0]['distance'] * 2 * $this->request->data['Indemnité_appliquée_à_la_puissance_fiscale_de_la_voiture'];

            if ($this->request->data['mode_transport'] = 'voiture de service') {
                $mission->indemnite_kilometrique = 0;
            }

//calculer le taux

            $mission->taux = $this->request->data['nbr_nuit'] * 3 + 2;

// calcule de montant_indemnite appliquée

            $salaire = $con->execute('SELECT salaire FROM profpermanents WHERE id =?', [$this->request->data['Prof']])->fetchAll('assoc');
            if ($salaire[0]['salaire'] >= 5000) {
                $mission->indemnite_appliquee = 100;
            } elseif ($salaire[0]['salaire'] >= 3500) {
                $mission->indemnite_appliquee = 80;
            } elseif ($salaire[0]['salaire'] >= 2500) {
                $mission->indemnite_appliquee = 60;
            } elseif ($salaire[0]['salaire'] >= 2000) {
                $mission->indemnite_appliquee = 40;
            } else {
                $mission->indemnite_appliquee = 30;
            }
            $mission->montant_indemnite = $mission->indemnite_appliquee * $mission->taux;

// calcule du total
            $mission->total = $mission->indemnite_kilometrique + $mission->montant_indemnite;

// sauvgarde dans la base de données
            if ($missions->save($mission)) {
                $this->Flash->success(__('The {0} has been saved.', 'Mission'));
                return $this->redirect(['action' => 'afficherMissionProf']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Mission'));
            }
        }


        //debug($nomville); die();
        $this->set(compact('mission', 'fonctionnaires', 'profpermanent', 'ville'));
        $this->set('_serialize', ['mission']);
        $this->render('/Espaces/respofinances/ajouterMissionProf');

    }

    public function modifierMissionProf($id = null)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $villes = TableRegistry::get('villes');
        $profpermanents = TableRegistry::get('profpermanents');
        $fonctionnaires = TableRegistry::get('fonctionnaires');
        $Missions = TableRegistry::get('missions');

        $mission = $Missions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mission = $Missions->patchEntity($mission, $this->request->data);

            $mission->profpermanent_id = $this->request->data['Prof'];
            $mission->ville_id = $this->request->data['LaVille'];
            $mission->date_depart = $this->request->data['date_depart'];
            $mission->date_arrivee = $this->request->data['date_arrivee'];

// calcule indemnite_kilometrique

            $dist = $con->execute('SELECT distance FROM villes WHERE id =?', [$this->request->data['LaVille']])->fetchAll('assoc');

            $mission->indemnite_kilometrique = $dist[0]['distance'] * 2 * $this->request->data['Indemnité_appliquée_à_la_puissance_fiscale_de_la_voiture'];

            if ($this->request->data['mode_transport'] = 'voiture de service') {
                $mission->indemnite_kilometrique = 0;
            }

//calculer le taux

            $mission->taux = $this->request->data['nbr_nuit'] * 3 + 2;

// calcule de montant_indemnite appliquée

            $salaire = $con->execute('SELECT salaire FROM profpermanents WHERE id =?', [$this->request->data['Prof']])->fetchAll('assoc');
            if ($salaire[0]['salaire'] >= 5000) {
                $mission->indemnite_appliquee = 100;
            } elseif ($salaire[0]['salaire'] >= 3500) {
                $mission->indemnite_appliquee = 80;
            } elseif ($salaire[0]['salaire'] >= 2500) {
                $mission->indemnite_appliquee = 60;
            } elseif ($salaire[0]['salaire'] >= 2000) {
                $mission->indemnite_appliquee = 40;
            } else {
                $mission->indemnite_appliquee = 30;
            }
            $mission->montant_indemnite = $mission->indemnite_appliquee * $mission->taux;

// calcule du total
            $mission->total = $mission->indemnite_kilometrique + $mission->montant_indemnite;

// sauvgarde dans la base de données
            if ($Missions->save($mission)) {
                $this->Flash->success(__('The {0} has been saved.', 'Mission'));
                return $this->redirect(['action' => 'afficherMissionProf']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Mission'));
            }
        }
        $fonctionnaire = $fonctionnaires->find('all');
        $profpermanent = $profpermanents->find('all');
        $ville = $villes->find("all");
        $this->set(compact('mission', 'fonctionnaire', 'profpermanent', 'ville'));
        $this->set('_serialize', ['mission']);
        $this->render('/Espaces/respofinances/modifierMissionProf');

    }

    public function ajouterMissionFonc()
    {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);


        $missions = TableRegistry::get('missions');
        $mission = $missions->newEntity();
        $villes = TableRegistry::get('villes');
        $profpermanents = TableRegistry::get('profpermanents');
        $fonctionnaires = TableRegistry::get('fonctionnaires');


        if ($this->request->is('post')) {
            $mission = $missions->patchEntity($mission, $this->request->data);
            $mission->fonctionnaire_id = $this->request->data['Fonc'];
            $mission->ville_id = $this->request->data['LaVille'];
            $mission->date_depart = $this->request->data['date_depart'];
            $mission->date_arrivee = $this->request->data['date_arrivee'];
            $mission->Motif = " ";

// calcule indemnite_kilometrique

            $dist = $con->execute('SELECT distance FROM villes WHERE id =?', [$this->request->data['LaVille']])->fetchAll('assoc');

            $mission->indemnite_kilometrique = $dist[0]['distance'] * 2 * $this->request->data['Indemnité_appliquée_à_la_puissance_fiscale_de_la_voiture'];

            if ($this->request->data['mode_transport'] = 'voiture de service') {
                $mission->indemnite_kilometrique = 0;
            }
//calculer le taux

            $mission->taux = $this->request->data['nbr_nuit'] * 3 + 2;

// calcule de montant_indemnite appliquée

            $salaire = $con->execute('SELECT salaire FROM fonctionnaires WHERE id =?', [$this->request->data['Fonc']])->fetchAll('assoc');
            if ($salaire[0]['salaire'] >= 5000) {
                $mission->indemnite_appliquee = 100;
            } elseif ($salaire[0]['salaire'] >= 3500) {
                $mission->indemnite_appliquee = 80;
            } elseif ($salaire[0]['salaire'] >= 2500) {
                $mission->indemnite_appliquee = 60;
            } elseif ($salaire[0]['salaire'] >= 2000) {
                $mission->indemnite_appliquee = 40;
            } else {
                $mission->indemnite_appliquee = 30;
            }
            $mission->montant_indemnite = $mission->indemnite_appliquee * $mission->taux;

// calcule du total
            $mission->total = $mission->indemnite_kilometrique + $mission->montant_indemnite;

// sauvgarde dans la base de données
            if ($missions->save($mission)) {
                $this->Flash->success(__('The {0} has been saved.', 'Mission'));
                return $this->redirect(['action' => 'afficherMissionFonc']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Mission'));
            }
        }
        //$fonctionnaires = $missions->Fonctionnaires->find('list', ['limit' => 200]);
        //$profpermanents = $missions->Profpermanents->find('list', ['limit' => 200]);
        $fonctionnaire = $fonctionnaires->find('all');
        $profpermanent = $profpermanents->find('all');
        $ville = $villes->find("all");
        $this->set(compact('mission', 'fonctionnaire', 'profpermanent', 'ville'));
        $this->set('_serialize', ['mission']);
        $this->render('/Espaces/respofinances/ajouterMissionFonc');

    }

    public function modifierMissionFonc($id = null)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $villes = TableRegistry::get('villes');
        $profpermanents = TableRegistry::get('profpermanents');
        $fonctionnaires = TableRegistry::get('fonctionnaires');
        $Missions = TableRegistry::get('missions');

        $mission = $Missions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mission = $Missions->patchEntity($mission, $this->request->data);
            $mission->fonctionnaire_id = $this->request->data['Fonc'];
            $mission->ville_id = $this->request->data['LaVille'];
            $mission->date_depart = $this->request->data['date_depart'];
            $mission->date_arrivee = $this->request->data['date_arrivee'];

// calcule indemnite_kilometrique

            $dist = $con->execute('SELECT distance FROM villes WHERE id =?', [$this->request->data['LaVille']])->fetchAll('assoc');

            $mission->indemnite_kilometrique = $dist[0]['distance'] * 2 * $this->request->data['Indemnité_appliquée_à_la_puissance_fiscale_de_la_voiture'];

            if ($this->request->data['mode_transport'] = 'voiture de service') {
                $mission->indemnite_kilometrique = 0;
            }
//calculer le taux

            $mission->taux = $this->request->data['nbr_nuit'] * 3 + 2;

// calcule de montant_indemnite appliquée

            $salaire = $con->execute('SELECT salaire FROM fonctionnaires WHERE id =?', [$this->request->data['Fonc']])->fetchAll('assoc');
            if ($salaire[0]['salaire'] >= 5000) {
                $mission->indemnite_appliquee = 100;
            } elseif ($salaire[0]['salaire'] >= 3500) {
                $mission->indemnite_appliquee = 80;
            } elseif ($salaire[0]['salaire'] >= 2500) {
                $mission->indemnite_appliquee = 60;
            } elseif ($salaire[0]['salaire'] >= 2000) {
                $mission->indemnite_appliquee = 40;
            } else {
                $mission->indemnite_appliquee = 30;
            }
            $mission->montant_indemnite = $mission->indemnite_appliquee * $mission->taux;

// calcule du total
            $mission->total = $mission->indemnite_kilometrique + $mission->montant_indemnite;

// sauvgarde dans la base de données
            if ($Missions->save($mission)) {
                $this->Flash->success(__('The {0} has been saved.', 'Mission'));
                return $this->redirect(['action' => 'afficherMissionFonc']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Mission'));
            }
        }
        $fonctionnaire = $fonctionnaires->find('all');
        $profpermanent = $profpermanents->find('all');
        $ville = $villes->find("all");
        $this->set(compact('mission', 'fonctionnaire', 'profpermanent', 'ville'));
        $this->set('_serialize', ['mission']);
        $this->render('/Espaces/respofinances/modifierMissionFonc');

    }

    public function deleteProf($id = null)
    {
        $Missions = TableRegistry::get('missions');
        $this->request->allowMethod(['post', 'delete']);
        $mission = $Missions->get($id);
        if ($Missions->delete($mission)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Mission'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Mission'));
        }
        return $this->redirect(['action' => 'afficherMissionProf']);
    }

    public function deleteFonc($id = null)
    {
        $Missions = TableRegistry::get('missions');
        $this->request->allowMethod(['post', 'delete']);
        $mission = $Missions->get($id);
        if ($Missions->delete($mission)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Mission'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Mission'));
        }
        return $this->redirect(['action' => 'afficherMissionFonc']);
    }

    public function imprimerFiche1($id)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT villes.nom, missions.date_depart , missions.date_arrivee, missions.mode_transport, missions.taux, missions.indemnite_appliquee, missions.montant_indemnite FROM villes,missions WHERE missions.ville_id=villes.id and missions.profpermanent_id=?', [$id])->fetchAll();
        $total = $con->execute('SELECT SUM(montant_indemnite) FROM missions WHERE profpermanent_id=?', [$id])->fetch();
        $t = $total[0];

        $profpermanent = TableRegistry::get('profpermanents');
        $profpermanents = $profpermanent->find("all", array("conditions" => array('id' => $id)))->toArray();
        $prof = $profpermanents[0];

        // $prof=$con->execute('SELECT * from profpermanents WHERE id=?',[$id])->fetch();

        $this->set(compact('resultat', 't', 'prof'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/indAppPage');

    }

    public function imprimerFiche2($id)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT villes.nom, missions.date_depart , missions.date_arrivee, missions.mode_transport, missions.taux, missions.indemnite_appliquee, missions.montant_indemnite FROM villes,missions WHERE missions.ville_id=villes.id and missions.profpermanent_id=?', [$id])->fetchAll();
        $total = $con->execute('SELECT SUM(montant_indemnite) FROM missions WHERE profpermanent_id=?', [$id])->fetch();
        $t = $total[0];

        $profpermanent = TableRegistry::get('profpermanents');
        $profpermanents = $profpermanent->find("all", array("conditions" => array('id' => $id)))->toArray();
        $prof = $profpermanents[0];

        // $prof=$con->execute('SELECT * from profpermanents WHERE id=?',[$id])->fetch();

        $this->set(compact('resultat', 't', 'prof'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/indAppPage1');

    }

    public function imprimerFiche3($id)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT villes.nom, missions.date_depart , missions.date_arrivee, missions.mode_transport, missions.taux, missions.indemnite_appliquee, missions.montant_indemnite FROM villes,missions WHERE missions.ville_id=villes.id and missions.profpermanent_id=?', [$id])->fetchAll();
        $total = $con->execute('SELECT SUM(montant_indemnite) FROM missions WHERE profpermanent_id=?', [$id])->fetch();
        $t = $total[0];

        $profpermanent = TableRegistry::get('profpermanents');
        $profpermanents = $profpermanent->find("all", array("conditions" => array('id' => $id)))->toArray();
        $prof = $profpermanents[0];

        // $prof=$con->execute('SELECT * from profpermanents WHERE id=?',[$id])->fetch();

        $this->set(compact('resultat', 't', 'prof'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/indAppPage2');

    }

    public function imprimerFiche4($id)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT villes.nom, missions.date_depart , missions.date_arrivee, missions.mode_transport, missions.taux, missions.indemnite_appliquee, missions.montant_indemnite FROM villes,missions WHERE missions.ville_id=villes.id and missions.profpermanent_id=?', [$id])->fetchAll();
        $total = $con->execute('SELECT SUM(montant_indemnite) FROM missions WHERE profpermanent_id=?', [$id])->fetch();
        $t = $total[0];

        $profpermanent = TableRegistry::get('profpermanents');
        $profpermanents = $profpermanent->find("all", array("conditions" => array('id' => $id)))->toArray();
        $prof = $profpermanents[0];

        // $prof=$con->execute('SELECT * from profpermanents WHERE id=?',[$id])->fetch();

        $this->set(compact('resultat', 't', 'prof'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/indkillPage');

    }

    public function imprimerFiche5($id)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT  missions.date_depart , missions.date_arrivee, villes.nom,villes.distance, missions.indemnite_kilometrique FROM villes,missions WHERE missions.ville_id=villes.id and missions.mode_transport like "voiture personnelle" and missions.profpermanent_id=?', [$id])->fetchAll();
        $total = $con->execute('SELECT SUM(indemnite_kilometrique) FROM missions WHERE profpermanent_id=?', [$id])->fetch();
        $t = $total[0];

        $profpermanent = TableRegistry::get('profpermanents');
        $profpermanents = $profpermanent->find("all", array("conditions" => array('id' => $id)))->toArray();
        $prof = $profpermanents[0];

        // $prof=$con->execute('SELECT * from profpermanents WHERE id=?',[$id])->fetch();

        $this->set(compact('resultat', 't', 'prof'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/indkillPage1');

    }

    public function imprimerFiche6($id)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT villes.nom, missions.date_depart , missions.date_arrivee, missions.mode_transport, missions.taux, missions.indemnite_appliquee, missions.montant_indemnite FROM villes,missions WHERE missions.ville_id=villes.id and missions.mode_transport like "voiture personnelle" and  missions.profpermanent_id=?', [$id])->fetchAll();
        $total = $con->execute('SELECT SUM(montant_indemnite) FROM missions WHERE profpermanent_id=?', [$id])->fetch();
        $t = $total[0];

        $profpermanent = TableRegistry::get('profpermanents');
        $profpermanents = $profpermanent->find("all", array("conditions" => array('id' => $id)))->toArray();
        $prof = $profpermanents[0];

        // $prof=$con->execute('SELECT * from profpermanents WHERE id=?',[$id])->fetch();

        $this->set(compact('resultat', 't', 'prof'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/indkillPage2');

    }

    public function imprimerFiche7($id)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT villes.nom, missions.date_depart , missions.date_arrivee, missions.mode_transport, missions.taux, missions.indemnite_appliquee, missions.montant_indemnite FROM villes,missions WHERE missions.ville_id=villes.id and missions.mode_transport like "voiture personnelle" and missions.profpermanent_id=?', [$id])->fetchAll();
        $total = $con->execute('SELECT SUM(montant_indemnite) FROM missions WHERE profpermanent_id=?', [$id])->fetch();
        $t = $total[0];

        $profpermanent = TableRegistry::get('profpermanents');
        $profpermanents = $profpermanent->find("all", array("conditions" => array('id' => $id)))->toArray();
        $prof = $profpermanents[0];

        // $prof=$con->execute('SELECT * from profpermanents WHERE id=?',[$id])->fetch();

        $this->set(compact('resultat', 't', 'prof'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/indkillPage3');

    }

    public function imprimerFiche1Fonc($id)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT villes.nom, missions.date_depart , missions.date_arrivee, missions.mode_transport, missions.taux, missions.indemnite_appliquee, missions.montant_indemnite FROM villes,missions WHERE missions.ville_id=villes.id and missions.fonctionnaire_id=?', [$id])->fetchAll();
        $total = $con->execute('SELECT SUM(montant_indemnite) FROM missions WHERE fonctionnaire_id=?', [$id])->fetch();
        $t = $total[0];

        $fonctionnaire = TableRegistry::get('fonctionnaires');
        $fonctionnaires = $fonctionnaire->find("all", array("conditions" => array('id' => $id)))->toArray();
        $fonc = $fonctionnaires[0];

        // $prof=$con->execute('SELECT * from profpermanents WHERE id=?',[$id])->fetch();

        $this->set(compact('resultat', 't', 'fonc'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/indAppPageFonc');

    }

    public function imprimerFiche2Fonc($id)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT villes.nom, missions.date_depart , missions.date_arrivee, missions.mode_transport, missions.taux, missions.indemnite_appliquee, missions.montant_indemnite FROM villes,missions WHERE missions.ville_id=villes.id and missions.fonctionnaire_id=?', [$id])->fetchAll();
        $total = $con->execute('SELECT SUM(montant_indemnite) FROM missions WHERE fonctionnaire_id=?', [$id])->fetch();
        $t = $total[0];

        $fonctionnaire = TableRegistry::get('fonctionnaires');
        $fonctionnaires = $fonctionnaire->find("all", array("conditions" => array('id' => $id)))->toArray();
        $fonc = $fonctionnaires[0];

        // $prof=$con->execute('SELECT * from profpermanents WHERE id=?',[$id])->fetch();

        $this->set(compact('resultat', 't', 'fonc'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/indAppPage1Fonc');

    }

    public function imprimerFiche3Fonc($id)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT villes.nom, missions.date_depart , missions.date_arrivee, missions.mode_transport, missions.taux, missions.indemnite_appliquee, missions.montant_indemnite FROM villes,missions WHERE missions.ville_id=villes.id and missions.fonctionnaire_id=?', [$id])->fetchAll();
        $total = $con->execute('SELECT SUM(montant_indemnite) FROM missions WHERE fonctionnaire_id=?', [$id])->fetch();
        $t = $total[0];

        $fonctionnaire = TableRegistry::get('fonctionnaires');
        $fonctionnaires = $fonctionnaire->find("all", array("conditions" => array('id' => $id)))->toArray();
        $fonc = $fonctionnaires[0];

        // $prof=$con->execute('SELECT * from profpermanents WHERE id=?',[$id])->fetch();

        $this->set(compact('resultat', 't', 'fonc'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/indAppPage2Fonc');

    }

    public function imprimerFiche4Fonc($id)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT villes.nom, missions.date_depart , missions.date_arrivee, missions.mode_transport, missions.taux, missions.indemnite_appliquee, missions.montant_indemnite FROM villes,missions WHERE missions.ville_id=villes.id and missions.fonctionnaire_id=?', [$id])->fetchAll();
        $total = $con->execute('SELECT SUM(montant_indemnite) FROM missions WHERE fonctionnaire_id=?', [$id])->fetch();
        $t = $total[0];

        $fonctionnaire = TableRegistry::get('fonctionnaires');
        $fonctionnaires = $fonctionnaire->find("all", array("conditions" => array('id' => $id)))->toArray();
        $fonc = $fonctionnaires[0];

        // $prof=$con->execute('SELECT * from profpermanents WHERE id=?',[$id])->fetch();

        $this->set(compact('resultat', 't', 'fonc'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/indkillPageFonc');

    }

    public function imprimerFiche5Fonc($id)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT missions.date_depart , missions.date_arrivee, villes.nom,villes.distance, missions.indemnite_kilometrique FROM villes,missions WHERE missions.ville_id=villes.id and missions.mode_transport like "voiture personnelle" and missions.fonctionnaire_id=?', [$id])->fetchAll();
        $total = $con->execute('SELECT SUM(montant_indemnite) FROM missions WHERE fonctionnaire_id=?', [$id])->fetch();
        $t = $total[0];

        $fonctionnaire = TableRegistry::get('fonctionnaires');
        $fonctionnaires = $fonctionnaire->find("all", array("conditions" => array('id' => $id)))->toArray();
        $fonc = $fonctionnaires[0];

        // $prof=$con->execute('SELECT * from profpermanents WHERE id=?',[$id])->fetch();

        $this->set(compact('resultat', 't', 'fonc'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/indkillPage1Fonc');

    }

    public function imprimerFiche6Fonc($id)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT villes.nom, missions.date_depart , missions.date_arrivee, missions.mode_transport, missions.taux, missions.indemnite_appliquee, missions.montant_indemnite FROM villes,missions WHERE missions.ville_id=villes.id and missions.mode_transport like "voiture personnelle" and missions.fonctionnaire_id=?', [$id])->fetchAll();
        $total = $con->execute('SELECT SUM(montant_indemnite) FROM missions WHERE fonctionnaire_id=?', [$id])->fetch();
        $t = $total[0];

        $fonctionnaire = TableRegistry::get('fonctionnaires');
        $fonctionnaires = $fonctionnaire->find("all", array("conditions" => array('id' => $id)))->toArray();
        $fonc = $fonctionnaires[0];

        // $prof=$con->execute('SELECT * from profpermanents WHERE id=?',[$id])->fetch();

        $this->set(compact('resultat', 't', 'fonc'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/indkillPage2Fonc');

    }

    public function imprimerFiche7Fonc($id)
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con = ConnectionManager::get('default', ['url' => $dsn]);

        $resultat = $con->execute('SELECT villes.nom, missions.date_depart , missions.date_arrivee, missions.mode_transport, missions.taux, missions.indemnite_appliquee, missions.montant_indemnite FROM villes,missions WHERE missions.ville_id=villes.id and missions.fonctionnaire_id=?', [$id])->fetchAll();
        $total = $con->execute('SELECT SUM(montant_indemnite) FROM missions WHERE fonctionnaire_id=?', [$id])->fetch();
        $t = $total[0];

        $fonctionnaire = TableRegistry::get('fonctionnaires');
        $fonctionnaires = $fonctionnaire->find("all", array("conditions" => array('id' => $id)))->toArray();
        $fonc = $fonctionnaires[0];

        // $prof=$con->execute('SELECT * from profpermanents WHERE id=?',[$id])->fetch();

        $this->set(compact('resultat', 't', 'fonc'));
        $this->set('_serialize', ['resultat']);
        $this->render('/Espaces/respofinances/indkillPage3');


        /******** Fin Ayoub *********/


    }



    /****** Bouhsise *******/

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
                $time_ab = 0;

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

        $this->render('/Espaces/respofinances/demanderabsences');
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
        $usrid = 0;
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

                        return $this->redirect(['controller'=>'Respofinances','action' => 'index']);
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

                        return $this->redirect(['controller'=>'Respofinances','action' => 'index']);
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
        $this->render('/Espaces/respofinances/demanderDocFct');

    }
    public function etatDemandeFct()
    {
        $idUser = $this->Auth->user('id');
        $Foncts = TableRegistry::get('Fonctionnaires');
        $query = $Foncts->find('all')->select('id')->where(['user_id' => $idUser]);
        $ide = 0;
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
        $this->render('/Espaces/respofinances/etatDemandeFct');

    }
    // FIN KAWTAR + IBTISSAM
}
?>