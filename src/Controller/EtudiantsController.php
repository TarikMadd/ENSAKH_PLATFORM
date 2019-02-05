<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;


class EtudiantsController extends AppController {




    public function beforeFilter(Event $event)
    {
        // allow only login, forgotpassword
        $this->Auth->authorize = 'controller';
        $usrole = $this->Auth->user('role');
        if($usrole!='etudiant' || $usrole=='admin')
        {

            $this->Flash->error(__('Vous ne pouvez pas acceder a ce lien'));
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'logout']
            );
        }
        $this->Auth->deny();

    }

    /***** LAHLAOUTI ******/


    public function lahlaoutiprofil()
    {
        $usrole=$this->Auth->user('role');
        $id_user=$this->Auth->user('id');
        $con=ConnectionManager::get('default');
        $id = $con->execute("SELECT * FROM etudiants WHERE user_id = $id_user")->fetchAll('assoc');
        $this->set('id',$id);
        $this->set('role',$usrole);

        $this->render('/Espaces/etudiants/lahlaoutiprofil');
    }
    public function evenements()
    {
        $this->render('/Espaces/etudiants/evenements');
    }

    public function lahlaoutimesprofesseurs()
    {
        $id_user=$this->Auth->user('id');
        $con=ConnectionManager::get('default');
        $id = $con->execute("SELECT * FROM etudiants WHERE user_id = $id_user")->fetchAll('assoc');
        foreach($id as $value): ?>

            <tr>

                <td ><?php $id2=$value['id']; ?></td>
            </tr>


        <?php  endforeach;

        $con=ConnectionManager::get('default');
        $mesprofs=$con->execute("SELECT profpermanents.nom_prof,profpermanents.prenom_prof,profpermanents.email_prof from profpermanents,etudiants,etudiers,enseigners where etudiants.id=etudiers.etudiant_id and etudiers.element_id=enseigners.element_id and enseigners.profpermanent_id=profpermanents.id and etudiants.id=?", [$id2])->fetchAll('assoc');
        $this->set('mesprofs',$mesprofs);
        $this->render('/Espaces/etudiants/lahlaoutimesprofesseurs');
    }


    public function lahlaoutimesmodules()
    {
        $id_user=$this->Auth->user('id');
        $con=ConnectionManager::get('default');
        $id = $con->execute("SELECT * FROM etudiants WHERE user_id = $id_user")->fetchAll('assoc');
        foreach($id as $value): ?>

            <tr>

                <td ><?php $id2=$value['id']; ?></td>
            </tr>


        <?php  endforeach;
        $con1=ConnectionManager::get('default');
        $mesmodules=$con1->execute("SELECT modules.libile, elements.libile as libele  from modules,elements,etudiers,etudiants where modules.id=elements.module_id and elements.id=etudiers.element_id and etudiants.id=etudiers.etudiant_id and etudiants.id=?", [$id2])->fetchAll('assoc');
        $this->set('mesmodules',$mesmodules);
        $this->render('/Espaces/etudiants/lahlaoutimesmodules');
    }

    public function lahlaoutiemploi ()
    {
        $id_user=$this->Auth->user('id');
        $con=ConnectionManager::get('default');
        $id = $con->execute("SELECT * FROM etudiants WHERE user_id = $id_user")->fetchAll('assoc');
        foreach($id as $value): ?>

            <tr>

                <td ><?php $id2=$value['id']; ?></td>
            </tr>


        <?php  endforeach;

        $con2=ConnectionManager::get('default');
        $emploi=$con2->execute("SELECT Distinct groupes.photo_emploi  from groupes ,etudiers  ,etudiants  where etudiers.etudiant_id=etudiants.id and groupes.id=etudiers.groupe_id and etudiants.id=?", [$id2])->fetchAll('assoc');
        $this->set('emploi',$emploi);
        $this->render('/Espaces/etudiants/lahlaoutiemploi');
    }




    public function notesemestre1()
    {
        $id_user = $this->Auth->user('id');
        $con=ConnectionManager::get('default');
        $ids = $con->execute("SELECT etudiants.id as e,etudiers.id as t,etudiers.groupe_id,semestres.id as sem FROM users,etudiers,etudiants,semestres,groupes,niveaus WHERE etudiants.user_id = $id_user AND etudiants.id = etudiers.etudiant_id AND etudiants.user_id = users.id AND semestres.niveaus_id = niveaus.id AND niveaus.id = groupes.niveaus_id AND etudiers.groupe_id = groupes.id")->fetchAll('assoc');
        $id_groupe = $ids[0]['groupe_id'];
        $semestre = $ids[0]['sem'];
        $id_etudier = $ids[0]['t'];
        $_SESSION['autori'] = 'no';
        $_SESSION['dec'] = 'no';
        $notes= $con->execute("SELECT notes.note,elements.libile,modules.libile as l, niveaus.id FROM notes, etudiers, elements,modules,groupes,etudiants,niveaus,filieres WHERE modules.semestre_id = $semestre AND modules.id = elements.module_id AND elements.id = notes.element_id AND notes.etudier_id = $id_etudier AND etudiants.id = etudiers.etudiant_id AND groupes.id = etudiers.groupe_id AND niveaus.id = groupes.niveaus_id AND filieres.id = groupes.filiere_id AND notes.etudier_id = etudiers.id")->fetchAll('assoc');

        $isauto = $con->execute("SELECT isnormal, isratt FROM autorisations WHERE groupe_id = $id_groupe AND semestre_id = $semestre")->fetchAll('assoc');
        if($isauto[0]['isnormal']==1 && $isauto[0]['isratt']==0)
        {
            $_SESSION['autori'] = 'no';
            $_SESSION['dec'] = 'yes';

            //debug($notes); die;
        }
        else if($isauto[0]['isnormal']==1 && $isauto[0]['isratt']==1)
        {
            $_SESSION['autori'] = 'yes';
            $_SESSION['dec'] = 'yes';
            //$_SESSION['nor'] = 'yes';
            $notes= $con->execute("SELECT notes.note,notes.note_ratt,elements.libile,modules.libile as l,niveaus.id FROM notes, etudiers, elements,modules,groupes,etudiants,niveaus,filieres WHERE modules.semestre_id = $semestre AND modules.id = elements.module_id AND elements.id = notes.element_id AND notes.etudier_id = $id_etudier AND etudiants.id = etudiers.etudiant_id AND groupes.id = etudiers.groupe_id AND niveaus.id = groupes.niveaus_id AND filieres.id = groupes.filiere_id AND notes.etudier_id = etudiers.id")->fetchAll('assoc');
            for ($i=0; $i < sizeof($notes); $i++)
            {
                if($notes[$i]['note_ratt'] != null)
                    $notes[$i]['note'] = $notes[$i]['note_ratt'];
            }
            //debug($notes); die;

        }
        $_SESSION['notes'] = $notes;
        $this->render('/Espaces/etudiants/lahlaoutimesnotes');



    }
    public function notesemestre2()
    {
        $id_user = $this->Auth->user('id');
        $con=ConnectionManager::get('default');
        $ids = $con->execute("SELECT etudiants.id as e,etudiers.id as t,etudiers.groupe_id,semestres.id as sem FROM users,etudiers,etudiants,semestres,groupes,niveaus WHERE etudiants.user_id = $id_user AND etudiants.id = etudiers.etudiant_id AND etudiants.user_id = users.id AND semestres.niveaus_id = niveaus.id AND niveaus.id = groupes.niveaus_id AND etudiers.groupe_id = groupes.id")->fetchAll('assoc');
        $id_groupe = $ids[0]['groupe_id'];
        $semestre = $ids[1]['sem'];
        $id_etudier = $ids[0]['t'];
        $_SESSION['autori'] = 'no';
        $_SESSION['dec'] = 'no';
        $notes= $con->execute("SELECT notes.note,elements.libile,modules.libile as l, niveaus.id FROM notes, etudiers, elements,modules,groupes,etudiants,niveaus,filieres WHERE modules.semestre_id = $semestre AND modules.id = elements.module_id AND elements.id = notes.element_id AND notes.etudier_id = $id_etudier AND etudiants.id = etudiers.etudiant_id AND groupes.id = etudiers.groupe_id AND niveaus.id = groupes.niveaus_id AND filieres.id = groupes.filiere_id AND notes.etudier_id = etudiers.id")->fetchAll('assoc');

        $isauto = $con->execute("SELECT isnormal, isratt FROM autorisations WHERE groupe_id = $id_groupe AND semestre_id = $semestre")->fetchAll('assoc');
        //debug($isauto); die;
        if(!empty($isauto))
        {
            if($isauto[0]['isnormal']==1 && $isauto[0]['isratt']==0 || !isset($isauto))
            {
                $_SESSION['autori'] = 'no';
                $_SESSION['dec'] = 'yes';

                //debug($notes); die;
            }
            else if($isauto[0]['isnormal']==1 && $isauto[0]['isratt']==1)
            {
                $_SESSION['autori'] = 'yes';
                $_SESSION['dec'] = 'yes';
                //$_SESSION['nor'] = 'yes';
                $notes= $con->execute("SELECT notes.note,notes.note_ratt,elements.libile,modules.libile as l,niveaus.id FROM notes, etudiers, elements,modules,groupes,etudiants,niveaus,filieres WHERE modules.semestre_id = $semestre AND modules.id = elements.module_id AND elements.id = notes.element_id AND notes.etudier_id = $id_etudier AND etudiants.id = etudiers.etudiant_id AND groupes.id = etudiers.groupe_id AND niveaus.id = groupes.niveaus_id AND filieres.id = groupes.filiere_id AND notes.etudier_id = etudiers.id")->fetchAll('assoc');
                for ($i=0; $i < sizeof($notes); $i++)
                {
                    if($notes[$i]['note_ratt'] != null)
                        $notes[$i]['note'] = $notes[$i]['note_ratt'];
                }
                //debug($notes); die;

            }

        }
        else
        {
            $_SESSION['autori'] = 'no';
            $_SESSION['dec'] = 'no';
        }
        $_SESSION['notes'] = $notes;
        $this->render('/Espaces/etudiants/lahlaoutimesnotes');



    }



    /***** Fin Lahlaouti ****/

    /***** SADIK *****/

    /*hajar hamdi*/
    public function hamdihajarselectreservation() {
        $usid=$this->Auth->user('id');
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $reservation = $con->execute('SELECT reservations.id as id,books.titre as titre,books.numInventaire as numInventaire,reservations.dateReservation as dateReservation,reservations.delai as delai, sous_categories.nom as categorie FROM books,reservations,sous_categories WHERE books.id=reservations.book_id AND Sous_Categories.id IN(SELECT sous_categorie_id FROM books WHERE books.id=reservations.book_id) AND reservations.user_id=?',[$usid])->fetchAll('assoc');
        $this->set('reservation',$reservation);
        $this->render('/Espaces/etudiants/hamdihajarselectreservation');
    }
    public function hamdihajarannulerreservation($id = null) {
        $this->request->allowMethod(['post', 'Annuler']);
        $reservations = TableRegistry::get('Reservations');
        $reservation = $reservations->get($id);
        if ($reservations->delete($reservation)) {
            $this->Flash->success(__("la reservation a ete supprimer.", 'reservation'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'reservation'));
        }
        return $this->redirect(['action' => 'hamdihajarselectreservation']);
        $this->render('/Espaces/etudiants/hamdihajarselectreservation');
    }
    /* Fin Hajar hamdi*/
    
    /* Soufiane ELAMMARI*/
    public function listbook(){
        //ELAMMARI Soufiane
        $this->paginate = [
            'contain' => ['SousCategories'],
            'limit' => 1000
        ];

        $con = ConnectionManager::get('default');
        $choix = $con->execute("SELECT sous_categories.nom  FROM sous_categories")->fetchAll('assoc');;// where id in (select sous_categorie_id from books)")
        $books = $con->execute("SELECT * FROM books WHERE id IN ( SELECT min(id) FROM books GROUP BY ISBN )")->fetchAll('assoc');;// where id in (select sous_categorie_id from books)")
        $this->set('books', $books);
        $this->set('choix', $choix);
        $this->render('/Espaces/etudiants/listbook');
    }

    public function listcategorie() {
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
        $this->render('/Espaces/etudiants/listcategorie');
    }

    public function recherchebook() {
        //ELAMMARI Soufiane

        if ($this->request->is(['post'])) {
            $search = $this->request->data('search');
        }
        $con = ConnectionManager::get('default');
        $books = $con->execute("SELECT * FROM books where titre  like '%" . $search . "%'   and id IN ( SELECT min(id) FROM books GROUP BY ISBN )")->fetchAll('assoc');
        $this->set('books', $books);
        $this->Flash->success(__('Votre recherche a bien Ã©tÃ© effectuÃ© : '.count($books).' de Ã©lÃ©ments trouvÃ©s'));
        $this->render('/Espaces/etudiants/recherchebook');
    }


    public function recherchecatbook() {
        //ELAMMARI Soufiane
        if ($this->request->is(['post'])) {
            $search = $this->request->data['choix'];
        }
        $con = ConnectionManager::get('default');
        $books = $con->execute("SELECT * FROM books where sous_categorie_id in (select id from sous_categories WHERE nom='" . $search . "' ) and id IN ( SELECT min(id) FROM books GROUP BY ISBN )")->fetchAll('assoc');
        $this->set('books', $books);
        $this->set('search', $search);
        $this->Flash->success(__('Votre recherche a bien Ã©tÃ© effectuÃ© : '.count($books).' de Ã©lÃ©ments trouvÃ©s'));
        $this->render('/Espaces/etudiants/recherchebook');
    }


    public function proposerbook() {

        //ELAMMARI Soufiane
        $con = ConnectionManager::get('default');

        if ($this->request->is(['post'])) {
            $search = $this->request->data();
            $nomPhoto = $_FILES['fichier']['name'];
            $fichierTemporaire = $_FILES['fichier']['tmp_name'];
            move_uploaded_file($fichierTemporaire, "'../../img/books/$nomPhoto");
            $con->execute("INSERT INTO proposition (id, nom, prenom, code, role, email, resumer, fichier, jugement,id_user) VALUES 
          (NULL, '" . $search['nom'] . "', '" . $search['prenom'] . "', '" . $search['cne'] . "', '" .  $this->Auth->user('role') . "', '" . $search['email'] . "', '" . $search['champ'] . "','" . $nomPhoto . "','" . $search['choix'] . "',".$this->Auth->user('id'). ");");
            $this->Flash->success(__('Les donnÃ©es de votre proposition ont bien Ã©tÃ© transmises'));
        }
            $usrole = $this->Auth->user('id');
            $coord = $con->execute("SELECT users.id, etudiants.cne,etudiants.nom_fr ,etudiants.prenom_fr FROM users,etudiants where 
                users.id=etudiants.user_id and users.id =" . $usrole . "")->fetchAll('assoc');
            $this->set('coord', $coord);

            $this->render('/Espaces/etudiants/proposerbook');
    }


    public function votebook() {
        $con = ConnectionManager::get('default');
        //ELAMMARI Soufiane
        if ($this->request->is(['post'])) {
            $vote = $this->request->data();

        }
        $test = $con->execute("SELECT COUNT(*) AS a  FROM vote_books where id_user=" .$this->Auth->user('id'). " and id_book =" .$_SESSION['detail']. " ")->fetchAll('assoc');
        $v=$test[0]['a'];
        if($v==0) {
            $con->execute("INSERT INTO vote_books (id_user, id_book,vote) VALUES 
          ( '" . $this->Auth->user('id') . "', '" . $_SESSION['detail'] . "',0);");
        }else
        {
            $con->execute("update vote_books set vote=1 where id_user='".$this->Auth->user('id')."' and id_book =" .$_SESSION['detail']. ";" );
        }
        $books = $con->execute("SELECT books.id ,books.titre,books.auteur,books.edition,books.resumer,books.image,books.ISBN,books.numInventaire,books.nbExemplaire ,sous_categories.nom FROM books ,sous_categories where books.sous_categorie_id=sous_categories.id and  books.id =" .$_SESSION['detail']. " ")->fetchAll('assoc');
        $_SESSION['book_vote']=$books;
        $vote = $con->execute("SELECT  vote FROM vote_books where id_user =" . $this->Auth->user('id') . "  and  id_book=".$_SESSION['detail']."" )->fetchAll('assoc');
        $_SESSION['vote']=$vote;
        $reserve=$con->execute('SELECT count(*) as sum FROM reservations WHERE user_id=?',[$this->Auth->user('id')])->fetchAll('assoc');
        $role=$con->execute('SELECT role FROM users where id=?',[$this->Auth->user('id')])->fetchAll('assoc');
        switch ($role[0]['role']) {
            case 'etudiant':
                $condition = $con->execute('SELECT maxEtud AS max FROM parametres')->fetchAll('assoc');
                break;
            case 'profvacataire':
                $condition = $con->execute('SELECT maxProfVac AS max FROM parametres')->fetchAll('assoc');
                break;
            case 'profpermanent':
                $condition = $con->execute('SELECT maxProfPer AS max FROM parametres')->fetchAll('assoc');
                break;
        }
        if ($reserve[0]['sum']<$condition[0]['max']) {
            $reserve[0]['sum']=0;
        }
        else {
            $reserve[0]['sum']=1;
        }
        $_SESSION['reserve']=$reserve;
        $this->set('reserve',$_SESSION['reserve']);

        $this->set('books', $_SESSION['book_vote']);
        $this->set('vote', $_SESSION['vote']);
        $nombrereserve1=$_SESSION['nombrereserve1'];
        $this->set('nombrereserve1',  $nombrereserve1);


        $nombremprunte1=$_SESSION['nombremprunte1'];
        $this->set('nombremprunte1',  $nombremprunte1);

        $this->Flash->success(__('vous avez  bien voté sur cet ouvrage '));
        $this->render('/Espaces/etudiants/detailbook');
    }
    public function detailbook() {
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
        if($v==0) {
            $con->execute("INSERT INTO vote_books (id_user, id_book,vote) VALUES 
          ( '" . $this->Auth->user('id') . "', '" . $_SESSION['detail'] . "',0);");
        }
        $vote = $con->execute("SELECT  vote FROM vote_books where id_user =" . $this->Auth->user('id') . "  and  id_book=".$_SESSION['detail']."" )->fetchAll('assoc');
        $_SESSION['vote']=$vote;
        $nombrereserve = $con->execute("SELECT COUNT(*) AS a  FROM reservations where book_id =" .$_SESSION['detail']. " ")->fetchAll('assoc');
        $nombrereserve1=$nombrereserve[0]['a'];
        $_SESSION['nombrereserve1']= $nombrereserve1;
        $this->set('vote',  $_SESSION['vote']);

        $reserve=$con->execute('SELECT count(*) as sum FROM reservations WHERE user_id=?',[$this->Auth->user('id')])->fetchAll('assoc');
        $role=$con->execute('SELECT role FROM users where id=?',[$this->Auth->user('id')])->fetchAll('assoc');
        switch ($role[0]['role']) {
            case 'etudiant':
                $condition = $con->execute('SELECT maxEtud AS max FROM parametres')->fetchAll('assoc');
                break;
            case 'profvacataire':
                $condition = $con->execute('SELECT maxProfVac AS max FROM parametres')->fetchAll('assoc');
                break;
            case 'profpermanent':
                $condition = $con->execute('SELECT maxProfPer AS max FROM parametres')->fetchAll('assoc');
                break;
        }
        if ($reserve[0]['sum']<$condition[0]['max']) {
            $reserve[0]['sum']=0;
        }
        else {
            $reserve[0]['sum']=1;
        }
        $_SESSION['reserve']=$reserve;
        $this->set('reserve',$_SESSION['reserve']);






        $nombremprunte = $con->execute("SELECT COUNT(*) AS a  FROM users_books where book_id =" .$_SESSION['detail']. " ")->fetchAll('assoc');
        $nombremprunte1=$nombremprunte [0]['a'];

        $_SESSION['nombremprunte1']= $nombremprunte1;
        $this->set('nombremprunte1',  $nombremprunte1);






        $this->set('nombrereserve1',  $nombrereserve1);
        $this->render('/Espaces/etudiants/detailbook');
    }

    public function reserverbook() {
        $con = ConnectionManager::get('default');
        if ($this->request->is(['post'])) {
            $reserve=$con->execute('SELECT * FROM reservations WHERE user_id=? AND book_id=?',[$this->Auth->user('id'),$_SESSION['detail']])->fetchAll('assoc');
            if (count($reserve)!=0) {
                $this->Flash->error(__("Ouvrage déja reserver"));
            }
            else {
            $getisbn=$con->execute('SELECT ISBN FROM books WHERE id=?',[$_SESSION['detail']])->fetchAll('assoc');
            $getID=$con->execute('SELECT id FROM books WHERE ISBN =?',[$getisbn[0]['ISBN']])->fetchAll('assoc');
            for ($i=0;$i<count($getID);$i++) {
                $reserver=$con->execute('SELECT * FROM reservations WHERE book_id = ?',[$getID[$i]['id']])->fetchAll('assoc');
                if (count($reserver)==0) {
                    $emprunt=$con->execute('SELECT * FROM users_books WHERE book_id = ?',[$getID[$i]['id']])->fetchAll('assoc');
                    if (count($emprunt)==0) {
                            $condition = $con->execute('SELECT dureeReservation AS delai FROM parametres')->fetchAll('assoc');
                            $date = date_create(date("Y-m-d H:i:s"));
                            $date1=date_add($date,date_interval_create_from_date_string($condition[0]['delai']." days"));
                            $date=date_format($date1, 'Y-m-d H:i:s');
                            $con->execute('INSERT INTO reservations (book_id,user_id,delai) VALUES (?,?,?)',[$getID[$i]['id'],$this->Auth->user('id'),$date]);
                            break;
                        }
                    }
                }
            }
        }
        return $this->redirect(['action' => 'hamdihajarselectreservation']);
        $this->render('/Espaces/profvacataires/detailbook');
    }
    /* Fin Soufiane ELAMMARI*/

/////////// Majda
    public function majdaselectempreinte() {
        $usid=$this->Auth->user('id');
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) { 
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie',$categorie);
        if ($this->request->is('post')) {
            $empreinte = $con->execute('SELECT books.titre,books.auteur,books.ISBN,books.numInventaire,users_books.dateEmprunte,users_books.delai FROM books,users_books WHERE books.id=users_books.book_id AND users_books.user_id=? AND books.sous_categorie_id IN (SELECT id FROM sous_categories WHERE categorie_id IN (SELECT id FROM categories WHERE id=? ))',[$usid,$categorieId[$this->request->data['categorie']]])->fetchAll('assoc');
            $this->set('empreinte',$empreinte);
        }
        else {
       $empreinte = $con->execute('SELECT books.titre,books.auteur,books.ISBN,books.numInventaire,users_books.dateEmprunte,users_books.delai FROM books,users_books WHERE books.id=users_books.book_id AND users_books.user_id=?',[$usid])->fetchAll('assoc');
        $this->set('empreinte',$empreinte);
        }
        $this->render('/Espaces/etudiants/majdaselectempreinte');
    }
    public function majdaselecteHistorique() {
        $usid=$this->Auth->user('id');
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) { 
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie',$categorie);
        if ($this->request->is('post')) {
            $hempreinte = $con->execute('SELECT books.titre,books.auteur,books.ISBN,books.numInventaire,historiqueemprunte.dateEmprunte,historiqueemprunte.dateRetour FROM books,historiqueemprunte WHERE books.id=historiqueemprunte.book_id AND historiqueemprunte.user_id= ? AND books.sous_categorie_id IN (SELECT id FROM sous_categories WHERE categorie_id IN (SELECT id FROM categories WHERE id=? ))',[$usid,$categorieId[$this->request->data['categorie']]])->fetchAll('assoc');
            $this->set('hempreinte',$hempreinte);
        }
        else {
            $hempreinte = $con->execute('SELECT books.titre,books.auteur,books.ISBN,books.numInventaire,historiqueemprunte.dateEmprunte,historiqueemprunte.dateRetour FROM books,historiqueemprunte WHERE books.id=historiqueemprunte.book_id AND historiqueemprunte.user_id=?',[$usid])->fetchAll('assoc');
            $this->set('hempreinte',$hempreinte);
        }
        $this->render('/Espaces/etudiants/majdaselecteHistorique');
    }
////// fin version 2


    /***** fin SADIK ****/


    /***** Taha  ******/

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */



    public function index()
    {

        //$user = TableRegistry::get('users');
        $usid = $this->Auth->user('id');
        //$id = $user['id'];


        // Dans un controller ou dans une méthode table.
        $etudiants = $this->Etudiants->find('all', [
            'conditions' => ['Etudiants.user_id =' => $usid],
            'contain' => ['Users', 'Certificats', 'Etudiers']
        ]);
        foreach ($etudiants as $etudiant ) {
            if ($etudiant->validi==0) {

                $this->redirect(array('controller' => 'Etudiants', 'action' => 'edit',$etudiant->id));
                $this->Flash->error(__('Attention Il faut bien vérifier les données avant de valider, C\'est la seule modification possible.','Etudiants'));
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'etudiant'));
            }
        }

        //*BADR SADIK*/

        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $deppassement=$con->execute('SELECT * FROM users_books WHERE delai< NOW() AND user_id =?',[$this->Auth->user('id')])->fetchAll('assoc');
        if (count($deppassement)>0) {
            $this->Flash->error(__("vous avez dépassé le delai d'emprunt d'un ouvrage"));
        }
        /*FIN BADR SADIK*/


        $this->set('etudiants', $etudiants);
        $this->set('_serialize', ['etudiants']);
        $this->render('/Espaces/etudiants/index');
    }

    /**
     * View method
     *
     * @param string|null $id Etudiant id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $etudiant = $this->Etudiants->get($id, [
            'contain' => ['Users', 'Certificats', 'Etudiers']
        ]);

        $this->set('etudiant', $etudiant);
        $this->set('_serialize', ['etudiant']);
        $this->render('/Espaces/etudiants/view');
    }

    /**
     * Edit method
     *
     * @param string|null $id Etudiant id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $etudiant = $this->Etudiants->get($id, [
            'contain' => ['Certificats']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $etudiant = $this->Etudiants->patchEntity($etudiant, $this->request->data);
            if ($this->Etudiants->save($etudiant)) {
                $this->Flash->success(__('The {0} has been saved.', 'Etudiant'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Etudiant'));
            }
        }
        $users = $this->Etudiants->Users->find('list', ['limit' => 200]);
        $certificats = $this->Etudiants->Certificats->find('list', ['limit' => 200]);
        $this->set(compact('etudiant', 'users', 'certificats'));
        $this->set('_serialize', ['etudiant']);
        $this->render('/Espaces/etudiants/edit');
    }


    public function editPass()
    {
        $users = TableRegistry::get('users');
        $usid = $this->Auth->user('id');
        $user = $users->get($usid);
        if ($this->request->is(['post'])) {
            $user = $users->patchEntity($user, $this->request->data);
            if ($users->save($user)) {
                $this->Flash->success(__('Votre mot de pass a bien été mis à jour.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La modification du mot de pass a rencontré un problmème, veillez ressayer'));
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
        $this->render('/Espaces/etudiants/editPass');
    }

    /*** Fin Taha *****/

    /****** Ismail ****/

    public function indexCertificats()
    {
        $Certifs = TableRegistry::get('certificats');
        $CertificatsEtudiants = TableRegistry::get('certificats_etudiants');


        $this->paginate = [
            'contain' => ['Certificats', 'Etudiants']
        ];
        $usrole=$this->Auth->user('id');
        $certificatsEtudiants = $this->paginate($CertificatsEtudiants->find("all", array(
            "joins" => array(
                array(
                    "table" => "etudiants",
                    "conditions" => array(
                        "CertificatsEtudiants.etudiant_id = etudiants.id"
                    )
                ),
                array(
                    "table" => "certificats",
                    "conditions" => array(
                        "CertificatsEtudiants.certificat_id = certificats.id"
                    )
                )
            ),
            'conditions' => array(
                'etudiants.user_id' => $usrole,), 'order' =>'certificats_etudiants.modified DESC'
        )));
        $optionsCertificats = $Certifs->find("all")->toArray();
        $this->set('optionsCertificats',$optionsCertificats);
        $this->set('_serialize', ['optionCertificats']);
        $this->set(compact('certificatsEtudiants'));
        $this->set('_serialize', ['certificatsEtudiants']);

        $this->render('/Espaces/etudiants/CertificatsEtudiants/index');
    }


    public function deleteCertificats($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $CertificatsEtudiants = TableRegistry::get('certificats_etudiants');
        $certificatsEtudiant = $CertificatsEtudiants->get($id);
        if($certificatsEtudiant->etat == 'Demande envoyé'){
            if ($CertificatsEtudiants->delete($certificatsEtudiant)) {
                $this->Flash->success(__('Votre demande a été annuler avec succes.'));
            } else {
                $this->Flash->error(__('Erreur innatendue!! Essayer de nouveau.'));
            }
        }else{
            $this->Flash->error(__('Ton certificat est '. $certificatsEtudiant->etat ));
        }
        return $this->redirect(['action' => 'indexCertificats']);
    }

    public function viewCertificats($id = null)
    {

        $CertificatsEtudiants = TableRegistry::get('certificats_etudiants');

        $certificatsEtudiant = $CertificatsEtudiants->get($id, [
            'contain' => ['Certificats', 'Etudiants']
        ]);
        if($certificatsEtudiant->notif_etudiant == true){
            $certificatsEtudiant->notif_etudiant = false;
            $certificatsEtudiant->modified = $certificatsEtudiant->modified;
            if($CertificatsEtudiants->save($certificatsEtudiant)){

            }else{
                $this->Flash->error(_('Erreur innatendue!!'));
            }
        }
        $this->set('certificatsEtudiant', $certificatsEtudiant);
        $this->set('_serialize', ['certificatsEtudiant']);
        $this->render('/Espaces/etudiants/CertificatsEtudiants/view');
    }

    public function postCertificats(){
        if ($this->request->is('post')) {
            $Etudiants = TableRegistry::get('etudiants');
            $Certificats = TableRegistry::get('certificats');
            $CertificatsEtudiants = TableRegistry::get('certificats_etudiants');
            $choix = $this->request->data['demande_certif_choix'];
            $data = array("entreprise" => "","theme" => "","date_debut" => "","date_fin" => "","encadrant" => "0","raison" => "");
            if(isset($this->request->data['demande_certif_envoie'])){

                if(strstr($choix, "stage") && !isset($this->request->data['demande_certif_envoie2'])){
                    return $this->entrepriseStage();
                }elseif(strstr($choix, "Retrait") && !isset($this->request->data['demande_retrait'])){
                    return $this->raisonRetrait();
                }

                $et_query = $Etudiants->find('all',array('conditions' => array('etudiants.user_id' => $this->Auth->user('id')),'fields' =>'id'));
                $et_data = $et_query->toArray()[0]['id'];
                $list_choix = array('"Demande envoyé"','"En cours de traitement"','"Prête"');
                $test_nombre_max = $CertificatsEtudiants->find('all',array('conditions' => array('certificats_etudiants.certificat_id' => $choix
                , 'certificats_etudiants.etudiant_id' => $et_data,'certificats_etudiants.etat !=' => 'Rejeter')))->count();

                $test_nombre_sumultane = $CertificatsEtudiants->find('all',array('conditions' => array('(certificats_etudiants.etat IN ('.implode(',',$list_choix).'))',
                    'certificats_etudiants.certificat_id'=> $this->request->data['demande_certif_choix']
                , 'certificats_etudiants.etudiant_id' => $et_data)))->count();
                if($test_nombre_sumultane >= 1){
                    $this->Flash->error(__('Erreur, attendez que le certificats en cours de progression soit pret.'));
                    return $this->redirect(['action' => 'indexCertificats']);
                }
                $max = $Certificats->find('all',array('conditions' => array('Certificats.id' => $choix)))->toArray()[0]['nombre_max'];

                if($test_nombre_max > $max){
                    $this->Flash->error(__('Erreur, vous avez atteint le nombre maximal. Contacter le service responsable.'));
                    return $this->redirect(['action' => 'indexCertificats']);
                }
                return $this->envoieCertificats($this->request->data['demande_certif_choix'],$data,$et_data);

            }elseif(isset($this->request->data['demande_certif_stage'])){

                $et_query = $Etudiants->find('all',array('conditions' => array('etudiants.user_id' => $this->Auth->user('id')),'fields' =>'id'));
                $et_data = $et_query->toArray()[0]['id'];

                $test_nombre_max = $CertificatsEtudiants->find('all',array('conditions' => array('certificats_etudiants.certificat_id' => $choix
                , 'certificats_etudiants.etudiant_id' => $et_data,'certificats_etudiants.etat !=' => 'Rejeter')))->count();

                $max = $Certificats->find('all',array('conditions' => array('Certificats.id' => $choix)))->toArray()[0]['nombre_max'];

                if($test_nombre_max >= $max){
                    $this->Flash->error(__('Erreur, vous avez atteint le nombre maximal. Contacter le service responsable.'));
                    return $this->redirect(['action' => 'indexCertificats']);
                }
                $data['entreprise'] = $this->request->data["entreprise"];
                $data['theme'] = $this->request->data["theme"];
                $data['date_fin'] = date($this->request->data["date_fin"]);
                $data['date_debut'] = date($this->request->data["date_debut"]);
                $data['encadrant'] = $this->request->data["profEncadrant"];


                return $this->envoieCertificats($this->request->data['demande_certif_choix'],$data,$et_data);
            }elseif(isset($this->request->data['demande_retrait'])){

                $et_query = $Etudiants->find('all',array('conditions' => array('etudiants.user_id' => $this->Auth->user('id')),'fields' =>'id'));
                $et_data = $et_query->toArray()[0]['id'];
                $test_nombre_max = $CertificatsEtudiants->find('all',array('conditions' => array('certificats_etudiants.certificat_id' => $choix
                , 'certificats_etudiants.etudiant_id' => $et_data,'certificats_etudiants.etat !=' => 'Rejeter')))->count();

                $max = $Certificats->find('all',array('conditions' => array('Certificats.id' => $choix)))->toArray()[0]['nombre_max'];

                if($test_nombre_max >= $max){
                    $this->Flash->error(__('Erreur, vous avez atteint le nombre maximal. Contacter le service responsable.'));
                    return $this->redirect(['action' => 'indexCertificats']);
                }
                $data["raison"] = $this->request->data['raison'];

                return $this->envoieCertificats($this->request->data['demande_certif_choix'],$data,$et_data);
            }
        }
    }

    public function updateNotifications(){

        $connection = ConnectionManager::get('default');

        $usrole=$this->Auth->user('id');
        $test =  $connection->execute('SELECT certificats.type,certificats_etudiants.modified,certificats_etudiants.commentaire,certificats_etudiants.notif_etudiant, certificats_etudiants.etat
                                            ,certificats_etudiants.id 
                                                 FROM certificats_etudiants JOIN certificats ON certificats.id = certificats_etudiants.certificat_id 
                                                               JOIN etudiants ON etudiants.id = certificats_etudiants.etudiant_id
                                                               WHERE etudiants.user_id = :id AND certificats_etudiants.notif_etudiant = TRUE
                                                                ORDER BY certificats_etudiants.modified DESC',[":id"=>$usrole])->fetchAll('assoc');
        $notif_etudiant = array();
        for($i=0;$i<count($test);$i++){
            $notif_etudiant[$i]['id'] = $test[$i]['id'];
            $notif_etudiant[$i]['commentaire'] = $test[$i]['commentaire'];
            $notif_etudiant[$i]['principale'] = $test[$i]['etat'];
            $notif_etudiant[$i]['titre'] = $test[$i]['type'];
            $notif_etudiant[$i]['date'] = $test[$i]['modified'];
            $notif_etudiant[$i]['lien'] = 'viewCertificats';
            switch ($test[$i]['etat']){
                case 'Rejeter' :
                    $notif_etudiant[$i]['style']= "badge bg-red";
                    break;
                case 'En cours de traitement' :
                    $notif_etudiant[$i]['style']= "badge bg-yellow";
                    break;
                case 'Demande envoyé' :
                    $notif_etudiant[$i]['style']= "badge bg-light-blue";
                    break;
                case 'Prête' :
                    $notif_etudiant[$i]['style']= "badge bg-green";
                    break;
                case 'Délivré' :
                    $notif_etudiant[$i]['style']= "badge bg-navy";
                    break;
            }
        }
        $session = $this->request->session();
        $session->write('notifications', $notif_etudiant);
        $this->render('/Element/notification');
    }

    private function envoieCertificats($id_certif,$data,$id_etudiant)
    {
        $connection = ConnectionManager::get('default');
        $CertificatsEtudiants = TableRegistry::get('certificats_etudiants');

        $certificatsEtudiant = $CertificatsEtudiants->newEntity();
        $et_query = $CertificatsEtudiants->find('all',array(
            'order' => ['certificats_etudiants.id' => 'DESC'],'fields' =>'id'))->first();
        $et_data = $et_query->toArray();
        $certificatsEtudiant->id = $et_data['id'] + 1;
        $certificatsEtudiant->certificat_id = $id_certif;
        $certificatsEtudiant->etudiant_id = $id_etudiant;
        $certificatsEtudiant->entreprise = $data["entreprise"];
        $niveau=$connection->execute('SELECT niveaus.id, niveaus.libile FROM niveaus
          JOIN groupes ON niveaus.id= groupes.niveaus_id
          JOIN etudiers ON groupes.id = etudiers.groupe_id
          JOIN etudiants ON etudiers.etudiant_id= etudiants.id
          WHERE etudiants.id = :id',[':id'=>$id_etudiant])->fetchAll('assoc');

        $certificatsEtudiant->theme_stage = $data["theme"];
        $certificatsEtudiant->debut_stage = $data["date_debut"];
        $certificatsEtudiant->fin_stage = $data["date_fin"];
        $certificatsEtudiant->profpermanent_id = $data["encadrant"];
        $certificatsEtudiant->duree_stage = $this->secondsToTimeCertificats(abs(strtotime($data['date_fin']) - strtotime($data['date_debut'])));
        $certificatsEtudiant->raison_retrait = $data['raison'];
        $certificatsEtudiant->etat = 'Demande envoyé';
        if($niveau[0]["id"] != 2 && $niveau[0]["id"] != 1) {
            if ($CertificatsEtudiants->save($certificatsEtudiant)) {
                $this->Flash->success(__('La demande est envoyé avec succes.'));
                return $this->indexCertificats();
            } else {
                $this->Flash->error(__('Erreur, essayer de nouveau.'));
            }
        }else{
            $this->Flash->error(__('Vous n\'estes pas authorise'));
        }
        return $this->redirect(['action' => 'indexCertificats']);
        exit;
    }
    private function secondsToTimeCertificats($seconds) {
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    }
    private function entrepriseStage()
    {

        $Certifs = TableRegistry::get('certificats');
        $Prof = TableRegistry::get('profpermanents');
        $options = $Certifs->find("all",['conditions' => ['Certificats.type LIKE' => "%stage"]])->toArray();
        $encadrant = $Prof->find("all")->toArray();
        $this->set('optionsCertificats',$options);
        $this->set('_serialize', ['optionCertificats']);
        $this->set('encadrant',$encadrant);
        $this->set('_serialize', ['encadrant']);
        $this->render('/Espaces/etudiants/CertificatsEtudiants/entreprise');
    }
    private function raisonRetrait()
    {

        $Certifs = TableRegistry::get('certificats');
        $options = $Certifs->find("all",['conditions' => ['Certificats.type LIKE' => "Retrait%"]])->toArray();
        $this->set('optionsCertificats',$options);
        $this->set('_serialize', ['optionCertificats']);
        return $this->render('/Espaces/etudiants/CertificatsEtudiants/raison');

    }

    /**** Fin Ismail ****/
    
    
    /*** Mustafa ***/
    
    public function getDestinataire($typeD) {

        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $cnx=ConnectionManager::get('default');
        $usrID=$this->Auth->user('id');
        $monIdDsMaTable = $cnx->execute("SELECT id FROM etudiants WHERE user_id = $usrID ")->fetchAll('assoc');
        $monIdDsMaTable = $monIdDsMaTable['0']['id'];
        if (strcmp($typeD,'scolarite') == 0)
            $typeDest = $cnx->execute("SELECT id, username FROM users WHERE role like 'resposcolarite' ")->fetchAll('assoc');
        else {

            //PROF VACATAIRE ADDED
            $semestre = $this->genererSemester();
            $year = $this->genererAnneeScol();
            $typeDest = $cnx->execute("SELECT DISTINCT p.user_id as id, CONCAT_WS(' ', p.nom_prof, p.prenom_prof) as nom, m.libile as module
              FROM elements elt, modules m, semestres s, profpermanents p, enseigners ens, annee_scolaires a
              WHERE
                    p.id = ens.profpermanent_id AND elt.id = ens.element_id AND m.id = elt.module_id
              AND   elt.id IN ( SELECT et.id FROM annee_scolaires a, etudiants, etudiers et WHERE etudiants.id = et.etudiant_id and etudiants.id = $monIdDsMaTable and a.libile like '$year')
              AND   a.libile like '$year' and (s.libile like '$semestre[0]' OR s.libile like '$semestre[1]'
              OR   s.libile like '$semestre[2]')
            UNION 
              SELECT DISTINCT p.user_id as id, CONCAT_WS(' ', p.nom_vacataire, p.prenom_vacataire) as nom, m.libile as module
              FROM elements elt, modules m, semestres s, vacataires p, enseigners ens, annee_scolaires a
              WHERE
                    p.id = ens.vacataire_id AND elt.id = ens.element_id AND m.id = elt.module_id
              AND   elt.id IN ( SELECT et.id FROM annee_scolaires a, etudiants, etudiers et WHERE etudiants.id = et.etudiant_id and etudiants.id = $monIdDsMaTable and a.libile like '$year')
              AND   a.libile like '$year' and (s.libile like '$semestre[0]' OR s.libile like '$semestre[1]'
          OR   s.libile like '$semestre[2]') 
               ")->fetchAll('assoc');
        }

        $this->set('typeDest',$typeDest);
        $this->set('selected',$typeD);
        $this->render('/Espaces/etudiants/envoyerNvEtud');
    }

    public function boiteRecEtud() {

        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $monid = $this->Auth->user('id');

        Time::setToStringFormat('yyyy-MM-dd HH:mm:ss');

        $cnx=ConnectionManager::get('default');
        //PROF VACATAIRE ADDED
        $mesMessages=$cnx->execute("
            SELECT u.role, CONCAT_WS(' ', p.nom_prof, p.prenom_prof) AS username, m.sujet, m.contenu, TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
            FROM users_messages umg, messages m, users u, profpermanents p
            where m.id NOT IN (SELECT DISTINCT message_id FROM asupprimer WHERE user_id = $monid) and umg.user_id = u.id and umg.message_id  = m.id and user_idrecepteur = $monid and p.user_id = u.id and role like 'profpemanent'
        UNION 
            SELECT u.role, CONCAT_WS(' ', p.nom_vacataire, p.prenom_vacataire) AS username, m.sujet, m.contenu, TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
            FROM users_messages umg, messages m, users u, vacataires p
            where m.id NOT IN (SELECT DISTINCT message_id FROM asupprimer WHERE user_id = $monid) and umg.user_id = u.id and umg.message_id  = m.id and user_idrecepteur = $monid and p.user_id = u.id and role like 'profvacataire'
        UNION 
            SELECT u.username,u.role, m.sujet, m.contenu, TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
            FROM users_messages umg, messages m, users u
            where m.id NOT IN (SELECT DISTINCT message_id FROM asupprimer WHERE user_id = $monid) and umg.user_id = u.id and umg.message_id  = m.id and user_idrecepteur = $monid and role like 'resposcolarite'
        UNION 
              SELECT u.role, CONCAT_WS(' ', p.nom_prof, p.prenom_prof) AS username, m.sujet, m.contenu, TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
              FROM diffusions_messages dmg, messages m, users u, profpermanents p
              where m.id NOT IN (SELECT DISTINCT message_id FROM asupprimer WHERE user_id = $monid)  and p.user_id = u.id and role like 'profpermanent' and dmg.user_id = u.id and dmg.message_id  = m.id 
              and (dmg.typerecepteur like 'etudiantsParFiliere' OR dmg.typerecepteur like 'etudiantsParFiliereSco') and
              dmg.group_id = (SELECT etu.groupe_id FROM etudiants e, etudiers etu
              WHERE e.id = etu.etudiant_id AND e.id = (SELECT id FROM etudiants WHERE user_id = $monid))
        UNION 
              SELECT u.role, CONCAT_WS(' ', p.nom_vacataire, p.prenom_vacataire) AS username, m.sujet, m.contenu, TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
              FROM diffusions_messages dmg, messages m, users u, vacataires p
              where m.id NOT IN (SELECT DISTINCT message_id FROM asupprimer WHERE user_id = $monid)  and p.user_id = u.id and role like 'profvacataire' and dmg.user_id = u.id and dmg.message_id  = m.id 
              and (dmg.typerecepteur like 'etudiantsParFiliere' OR dmg.typerecepteur like 'etudiantsParFiliereSco') and
              dmg.group_id = (SELECT etu.groupe_id FROM etudiants e, etudiers etu
              WHERE e.id = etu.etudiant_id AND e.id = (SELECT id FROM etudiants WHERE user_id = $monid))
        UNION 
              SELECT u.username, u.role, m.sujet, m.contenu, TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
              FROM diffusions_messages dmg, messages m, users u
              where m.id NOT IN (SELECT DISTINCT message_id FROM asupprimer WHERE user_id = $monid)  and role like 'resposcolarite' and dmg.user_id = u.id and dmg.message_id  = m.id 
              and (((dmg.typerecepteur like 'etudiantsParFiliere' OR dmg.typerecepteur like 'etudiantsParFiliereSco') and
              dmg.group_id = (SELECT etu.groupe_id FROM etudiants e, etudiers etu
              WHERE e.id = etu.etudiant_id AND e.id = (SELECT id FROM etudiants WHERE user_id = $monid))) OR dmg.typerecepteur like 'etudiants') 
              ORDER BY inttervale
        ")->fetchAll('assoc');
        $this->set('mesMsgs',$mesMessages);

        $this->render('/Espaces/etudiants/boiteRecEtud');
    }

    public function envoyerNvEtud() {

        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $this->set('selected',"");
        $this->render('/Espaces/etudiants/envoyerNvEtud');
    }

    public function lireMsgEtud($id=0) {
        $cnx=ConnectionManager::get('default');
        $monID = $this->Auth->user('id');;
        $test = explode(".",$id);
        if (strcmp($test[0],'readSN')  == 0){
            $id = $test[1];
                $msg = $cnx->execute("
                   SELECT u.role, m.id, m.sujet, m.contenu, m.piecejointe, um.date, u.username FROM messages m, users_messages um, users u 
                   WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID and m.id = $id and role like 'resposcolarite'
                  UNION 
                   SELECT u.role, m.id, m.sujet, m.contenu, m.piecejointe, um.date, CONCAT_WS(' ', p.nom_prof, p.prenom_prof) AS username FROM messages m, users_messages um, users u, profpermanents p
                   WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID and m.id = $id and p.user_id = u.id and role like 'profpermanent'
                  UNION 
                   SELECT u.role, m.id, m.sujet, m.contenu, m.piecejointe, um.date, CONCAT_WS(' ', p.nom_vacataire, p.prenom_vacataire) AS username FROM messages m, users_messages um, users u, vacataires p
                   WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID and m.id = $id and p.user_id = u.id and role like 'profvacataire'
                   ")->fetchAll('assoc');

            $this->set('me','me');
        }
        else {
            $this->set('me', '');
            $msg = $cnx->execute("
        SELECT u.username, u.role, m.sujet, m.contenu, m.piecejointe , TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
        FROM users_messages umg, messages m, users u 
        where umg.user_id = u.id and umg.message_id  = m.id and m.id = $id and role like 'resposcolarite'
        UNION 
        SELECT u.role,CONCAT_WS(' ', p.nom_prof, p.prenom_prof) AS username, m.sujet, m.contenu, m.piecejointe , TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
        FROM users_messages umg, messages m, users u, profpermanents p
        where umg.user_id = u.id and umg.message_id  = m.id and m.id = $id and p.user_id = u.id and role like 'profpermanent'
        UNION 
        SELECT u.role, CONCAT_WS(' ', p.nom_vacataire, p.prenom_vacataire) AS username, m.sujet, m.contenu, m.piecejointe , TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,m.id, date 
        FROM users_messages umg, messages m, users u, vacataires p
        where umg.user_id = u.id and umg.message_id  = m.id and m.id = $id and p.user_id = u.id and role like 'profvacataire'
        
        
        ")->fetchAll('assoc');

            if ($msg == null) {
                $msg = $cnx->execute("
                SELECT  us.role, us.username, ms.sujet, ms.contenu, ms.piecejointe , TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,ms.id, date 
                FROM diffusions_messages dmg, messages ms, users us
                where dmg.user_id = us.id and dmg.message_id  = ms.id and ms.id = $id and role like 'resposcolarite'
              UNION 
                SELECT  us.role, CONCAT_WS(' ', p.nom_prof, p.prenom_prof) AS username, ms.sujet, ms.contenu, ms.piecejointe , TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,ms.id, date 
                FROM diffusions_messages dmg, messages ms, users us, profpermanents p
                where dmg.user_id = us.id and dmg.message_id  = ms.id and ms.id = $id and p.user_id = us.id and role like 'profpermanent'
              UNION 
                SELECT  us.role, CONCAT_WS(' ', p.nom_vacataire, p.prenom_vacataire) AS username, ms.sujet, ms.contenu, ms.piecejointe , TIME_TO_SEC(TIMEDIFF(now(), date)) as inttervale,ms.id, date 
                FROM diffusions_messages dmg, messages ms, users us, vacataires p
                where dmg.user_id = us.id and dmg.message_id  = ms.id and ms.id = $id and p.user_id = us.id and role like 'profvacataire'
        ")->fetchAll('assoc');
            }
        }
        //$msg=$cnx->execute("SELECT * FROM messages m where $id = m.id ")->fetchAll('assoc');
        $this->set('msgs',$msg);
        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $this->render('/Espaces/etudiants/lireMsgEtud');
    }

    public function envoyermsg() {
        $cnx=ConnectionManager::get('default');
        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $detinateur = $this->Auth->user('id');
        $detinataire = $this->request->getData('destinataire');

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

        $cnx->insert('users_messages',
            [
                'message_id' => $msg['0']['id'],
                'user_id' => $detinateur,
                'user_idrecepteur' => $detinataire,
                'date'=> Time::now()
            ]
        );
        $this->Flash->success('Votre message est envoyé');
        $this->boiteRecEtud();
    }

    public function getMsgsEnvoye()
    {
        $cnx=ConnectionManager::get('default');
        $monID = $this->Auth->user('id');
        $mesMsgsN = $cnx->query("
            SELECT m.id, m.sujet, m.contenu, m.piecejointe, um.date, u.username, u.role FROM messages m, users_messages um, users u 
            WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID and role like 'resposcolarite'
          UNION 
            SELECT m.id, m.sujet, m.contenu, m.piecejointe, um.date, CONCAT_WS(' ', p.nom_prof, p.prenom_prof) AS username, u.role FROM messages m, users_messages um, users u, profpermanents p
            WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID and p.user_id = u.id and role like 'profpermanent'
          UNION 
            SELECT m.id, m.sujet, m.contenu, m.piecejointe, um.date, CONCAT_WS(' ', p.nom_vacataire, p.prenom_vacataire) AS username, u.role FROM messages m, users_messages um, users u, vacataires p
            WHERE m.id = um.message_id and u.id= user_idrecepteur and um.user_id = $monID and p.user_id = u.id and role like 'profvacataire' ORDER by date
             ")->fetchAll('assoc');

        $this->set('mesMsgsN',$mesMsgsN);
        $this->set('displaySent',"sent");

        $this->boiteRecEtud();
    }

    public function supprimerMsg()
    {
        // debug($this->request->getData('msgChecked'));
        $deletTab = $this->request->getData('msgChecked');
        if (count($deletTab) > 0) {
            $cnx = ConnectionManager::get('default');
            foreach ($deletTab as $delM) {
                /* if ($test = $cnx->query("SELECT * FROM diffusions_messages WHERE message_id = $delM")->fetchAll('assoc') == null)
                     $cnx->query("DELETE FROM messages WHERE id = $delM ");
                 else */
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
        $this->boiteRecEtud();
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
    public function genererAnneeScol() {
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

    public function genererSemester() {
        $month = (int)date("M");
        if ($month >= 9 || $month < 2) {
            return array('S1', 'S3', 'S5');
        }
        else{
            return array('S2', 'S4', 'S6');
        }
    }
    
    /**** Fin Mustapha ****/




    /******* Zouhir *********/


    public function notesemestre1z()
    {
        $id_user = $this->Auth->user('id');
        $con=ConnectionManager::get('default');
        $ids = $con->execute("SELECT etudiants.id as e,etudiers.id as t,etudiers.groupe_id,semestres.id as sem FROM users,etudiers,etudiants,semestres,groupes,niveaus WHERE etudiants.user_id = $id_user AND etudiants.id = etudiers.etudiant_id AND etudiants.user_id = users.id AND semestres.niveaus_id = niveaus.id AND niveaus.id = groupes.niveaus_id AND etudiers.groupe_id = groupes.id")->fetchAll('assoc');
        $id_groupe = $ids[0]['groupe_id'];
        $semestre = $ids[0]['sem'];
        $id_etudier = $ids[0]['t'];
        $_SESSION['autori'] = 'no';
        $_SESSION['dec'] = 'no';
        $notes= $con->execute("SELECT notes.note,elements.libile,modules.libile as l, niveaus.id FROM notes, etudiers, elements,modules,groupes,etudiants,niveaus,filieres WHERE modules.semestre_id = $semestre AND modules.id = elements.module_id AND elements.id = notes.element_id AND notes.etudier_id = $id_etudier AND etudiants.id = etudiers.etudiant_id AND groupes.id = etudiers.groupe_id AND niveaus.id = groupes.niveaus_id AND filieres.id = groupes.filiere_id AND notes.etudier_id = etudiers.id")->fetchAll('assoc');

        $isauto = $con->execute("SELECT isnormal, isratt FROM autorisations WHERE groupe_id = $id_groupe AND semestre_id = $semestre")->fetchAll('assoc');
        if($isauto[0]['isnormal']==1 && $isauto[0]['isratt']==0)
        {
            $_SESSION['autori'] = 'no';
            $_SESSION['dec'] = 'yes';

            //debug($notes); die;
        }
        else if($isauto[0]['isnormal']==1 && $isauto[0]['isratt']==1)
        {
            $_SESSION['autori'] = 'yes';
            $_SESSION['dec'] = 'yes';
            //$_SESSION['nor'] = 'yes';
            $notes= $con->execute("SELECT notes.note,notes.note_ratt,elements.libile,modules.libile as l,niveaus.id FROM notes, etudiers, elements,modules,groupes,etudiants,niveaus,filieres WHERE modules.semestre_id = $semestre AND modules.id = elements.module_id AND elements.id = notes.element_id AND notes.etudier_id = $id_etudier AND etudiants.id = etudiers.etudiant_id AND groupes.id = etudiers.groupe_id AND niveaus.id = groupes.niveaus_id AND filieres.id = groupes.filiere_id AND notes.etudier_id = etudiers.id")->fetchAll('assoc');
            for ($i=0; $i < sizeof($notes); $i++)
            {
                if($notes[$i]['note_ratt'] != null)
                    $notes[$i]['note'] = $notes[$i]['note_ratt'];
            }
            //debug($notes); die;

        }
        $_SESSION['notes'] = $notes;
        $this->render('/Espaces/etudiants/viewnotes');



    }
    public function notesemestre2z()
    {
        $id_user = $this->Auth->user('id');
        $con=ConnectionManager::get('default');
        $ids = $con->execute("SELECT etudiants.id as e,etudiers.id as t,etudiers.groupe_id,semestres.id as sem FROM users,etudiers,etudiants,semestres,groupes,niveaus WHERE etudiants.user_id = $id_user AND etudiants.id = etudiers.etudiant_id AND etudiants.user_id = users.id AND semestres.niveaus_id = niveaus.id AND niveaus.id = groupes.niveaus_id AND etudiers.groupe_id = groupes.id")->fetchAll('assoc');
        $id_groupe = $ids[0]['groupe_id'];
        $semestre = $ids[1]['sem'];
        $id_etudier = $ids[0]['t'];
        $_SESSION['autori'] = 'no';
        $_SESSION['dec'] = 'no';
        $notes= $con->execute("SELECT notes.note,elements.libile,modules.libile as l, niveaus.id FROM notes, etudiers, elements,modules,groupes,etudiants,niveaus,filieres WHERE modules.semestre_id = $semestre AND modules.id = elements.module_id AND elements.id = notes.element_id AND notes.etudier_id = $id_etudier AND etudiants.id = etudiers.etudiant_id AND groupes.id = etudiers.groupe_id AND niveaus.id = groupes.niveaus_id AND filieres.id = groupes.filiere_id AND notes.etudier_id = etudiers.id")->fetchAll('assoc');

        $isauto = $con->execute("SELECT isnormal, isratt FROM autorisations WHERE groupe_id = $id_groupe AND semestre_id = $semestre")->fetchAll('assoc');
        //debug($isauto); die;
        if(!empty($isauto))
        {
            if($isauto[0]['isnormal']==1 && $isauto[0]['isratt']==0 || !isset($isauto))
            {
                $_SESSION['autori'] = 'no';
                $_SESSION['dec'] = 'yes';

                //debug($notes); die;
            }
            else if($isauto[0]['isnormal']==1 && $isauto[0]['isratt']==1)
            {
                $_SESSION['autori'] = 'yes';
                $_SESSION['dec'] = 'yes';
                //$_SESSION['nor'] = 'yes';
                $notes= $con->execute("SELECT notes.note,notes.note_ratt,elements.libile,modules.libile as l,niveaus.id FROM notes, etudiers, elements,modules,groupes,etudiants,niveaus,filieres WHERE modules.semestre_id = $semestre AND modules.id = elements.module_id AND elements.id = notes.element_id AND notes.etudier_id = $id_etudier AND etudiants.id = etudiers.etudiant_id AND groupes.id = etudiers.groupe_id AND niveaus.id = groupes.niveaus_id AND filieres.id = groupes.filiere_id AND notes.etudier_id = etudiers.id")->fetchAll('assoc');
                for ($i=0; $i < sizeof($notes); $i++)
                {
                    if($notes[$i]['note_ratt'] != null)
                        $notes[$i]['note'] = $notes[$i]['note_ratt'];
                }
                //debug($notes); die;

            }

        }
        else
        {
            $_SESSION['autori'] = 'no';
            $_SESSION['dec'] = 'no';
        }
        $_SESSION['notes'] = $notes;
        $this->render('/Espaces/etudiants/viewnotes');



    }




    /****** Fin Zouhir ******/
}

?>