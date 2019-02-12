<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Behavior;


class respobibliosController extends AppController {


    public function beforeFilter(Event $event)
    {
        // allow only login, forgotpassword
        $this->Auth->authorize = 'controller';
        $usrole = $this->Auth->user('role');
        if($usrole!='respobiblio' && $usrole!='admin')
        {

            $this->Flash->error(__('Vous ne pouvez pas acceder a ce lien'));
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'logout']
            );
        }
        $this->Auth->deny();

    }

 /**** Badr *******/
    public function index() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $username=$this->Auth->user('username');
        $this->set('username',$username);
        $premierCadre = $con->execute('SELECT count(*) as sum FROM books')->fetchAll('assoc');
        $this->set('premierCadre',$premierCadre);
        $deuxiemeCadre = $con->execute('SELECT count(*) as sum FROM reservations')->fetchAll('assoc');
        $this->set('deuxiemeCadre',$deuxiemeCadre);
        $troisiemeCadre = $con->execute('SELECT count(*) as sum FROM users_books')->fetchAll('assoc');
        $this->set('troisiemeCadre',$troisiemeCadre);
        $quatriemeCadre = $con->execute('SELECT COUNT(*) as sum FROM users_books WHERE delai<NOW()')->fetchAll('assoc');
        $this->set('quatriemeCadre',$quatriemeCadre);
        $proposition=$con->execute('SELECT * FROM proposition')->fetchAll('assoc');
        $this->set('proposition',$proposition);
        $date=$con->execute('SELECT titre,day(date) as jourDebut,month(date) as mois,YEAR(date) as year,day(fin) as jourFin,month(fin) as moisFin,YEAR(fin) as yearFin FROM calendriers')->fetchAll('assoc');
        $this->set('date',$date);
        $couleurs=array("#27ae60"=>0,"#2980b9"=>0,"#e74c3c"=>0,"#7f8c8d"=>0,"#16a085"=>0,"#8e44ad"=>0,"#1abc9c"=>0,"#34495e"=>0);
        $this->set('couleurs',$couleurs);
        $this->render('/Espaces/respobiblios/home');
    }
    public function badrconsulterOuvrages() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        if ($this->request->is('post')) {
            $book = $con->execute('SELECT * FROM books WHERE numInventaire = ? ',[$this->request->data['numInventaire']])->fetchAll('assoc');
            $this->set('book',$book);
        }
        else {
            $book = $con->execute('SELECT * FROM books')->fetchAll('assoc');
            $this->set('book',$book);
        }
        $empreintes = $con->execute('SELECT book_id FROM users_books')->fetchAll('assoc');
        if (count($empreintes)>0) {
            for ($i=0; $i < count($empreintes); $i++) { 
            $empreinte[$i]=$empreintes[$i]['book_id'];
            }
            $this->set('empreinte',$empreinte);
        }
        else $this->set('empreinte',$empreintes);
        $reservations = $con->execute('SELECT book_id FROM Reservations')->fetchAll('assoc');
        if (count($reservations)>0) {
            for ($i=0; $i < count($reservations); $i++) { 
            $reservation[$i]=$reservations[$i]['book_id'];
            }
            $this->set('reservation',$reservation);
        }
        else $this->set('reservation',$reservations);
    	$this->render('/Espaces/respobiblios/badrconsulterOuvrages');
    }
    public function badrconsulterOuvragessimple() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) { 
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie',$categorie);
        $this->set('categorieId',$categorieId);
        if (isset($this->request->data['categorie']) && $this->request->data['categorie'] != 'inf') {
            $book = $con->execute('SELECT DISTINCT ISBN,titre,auteur,edition,resumer,nbExemplaire  FROM books WHERE sous_categorie_id IN (SELECT id FROM sous_categories WHERE categorie_id IN (SELECT id FROM categories WHERE id=? ))',[$this->request->data['categorie']])->fetchAll('assoc');
            $this->set('book',$book);
            $selection=$this->request->data['categorie'];
            $this->set('selection',$selection);
            $souscategories = $con->execute('SELECT id,nom FROM sous_categories WHERE categorie_id = ?',[$selection])->fetchAll('assoc');
            for ($i=0; $i < count($souscategories); $i++) { 
                $souscategorie[$i]=$souscategories[$i]['nom'];
                $souscategorieId[$i]=$souscategories[$i]['id'];
            }
            $this->set('souscategorie',$souscategorie);
            $this->set('souscategorieId',$souscategorieId);
            if (isset($this->request->data['souscategorie']) && $this->request->data['souscategorie'] != 'inf1') {
                $book = $con->execute('SELECT DISTINCT ISBN,titre,auteur,edition,resumer,nbExemplaire  FROM books WHERE sous_categorie_id = ?',[$this->request->data['souscategorie']])->fetchAll('assoc');
                $this->set('book',$book);
                $selection1=$this->request->data['souscategorie'];
                $this->set('selection1',$selection1);
            }
        }
        else {
            $book = $con->execute('SELECT DISTINCT ISBN,titre,auteur,edition,resumer,nbExemplaire  FROM books')->fetchAll('assoc');
            $this->set('book',$book);
        }
        $this->render('/Espaces/respobiblios/badrconsulterOuvragessimple');
    }
    public function badrajouterOuvrages() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $books = TableRegistry::get('Books');
        $book = $books->newEntity();
        if ($this->request->is('post')) {
            $categorieId=$_SESSION['categorieId'];
            $souscategories = $con->execute('SELECT id,nom FROM sous_categories WHERE categorie_id=?',[$categorieId[$this->request->data['categorie']]])->fetchAll('assoc');
            for ($i=0; $i < count($souscategories); $i++) {
                $souscategorie[$i]=$souscategories[$i]['nom'];
                $souscategorieId[$i]=$souscategories[$i]['id'];
            }
            if (isset($this->request->data['sous_categorie_id'])) {
                $this->request->data['sous_categorie_id']=$souscategorieId[$this->request->data['sous_categorie_id']];
                $extension=strtolower(pathinfo($this->request->data['image']['name'] , PATHINFO_EXTENSION));
                if (!empty($this->request->data['image']['tmp_name']) && in_array($extension, array('jpg','jpeg','png'))) {
                    move_uploaded_file($this->request->data['image']['tmp_name'], WWW_ROOT . 'img/books/' . DS . $this->request->data['ISBN']. '.'. $extension);
                    $this->request->data['image']=$this->request->data['ISBN'].'.'.$extension;
                    //redimentionner l'image
                    $save = WWW_ROOT . 'img/books/' . DS . $this->request->data['ISBN']. '.'. $extension;
                    list($width, $height) = getimagesize(WWW_ROOT . 'img/books/' . DS . $this->request->data['ISBN']. '.'. $extension);
                    $modwidth = 400;
                    $modheight = 250;

                    $tn = imagecreatetruecolor($modwidth, $modheight) ;
                    if ($extension=='png') {
                        $image = imagecreatefrompng($save) ;
                    }
                    else {
                        $image = imagecreatefromjpeg($save) ;
                    }
                    imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
                    imagejpeg($tn, $save, 100) ;

                    $book = $books->patchEntity($book, $this->request->data);
                    $_SESSION['book']=$book;
                    return $this->redirect(['action' => 'badrnumInventaire']);
                }
                else if (!empty($this->request->data['image']['tmp_name'])) {
                    $this->Flash->error(__("La forme de l'image n'est pas valide"));
                }
            }
        }
        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) {
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie',$categorie);
        $_SESSION['categorieId']=$categorieId;
        if (isset($this->request->data['categorie']) && $this->request->data['categorie'] != 'inf') {
            $selection=$this->request->data['categorie'];
            $this->set('selection',$selection);
        }
        $users = $books->Users->find('list', ['limit' => 200]);
        $this->set(compact('book' , 'souscategorie','users'));
        $this->set('_serialize', ['book']);
        $this->render('/Espaces/respobiblios/badrajouterOuvrages');
    }
    public function badrnumInventaire() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $book=$_SESSION['book'];
        if ($this->request->is('post')) {
            $j=0;
            for ($i=0; $i < $_SESSION['book']['nbExemplaire']; $i++) { 
                $test=$con->execute('SELECT count(*) as sum FROM books WHERE numInventaire = ?',[$this->request->data['numInventaire'.$i]])->fetchAll('assoc');
                if ($test[0]['sum']==0) {
                    $j++;
                }
            }
            if ($j==$_SESSION['book']['nbExemplaire']) {
                for ($i=0; $i < $_SESSION['book']['nbExemplaire']; $i++) { 
                    $con->execute('INSERT INTO books (titre, auteur, edition, resumer, image, ISBN, numInventaire, nbExemplaire, sous_categorie_id) VALUES (?,?,?,?,?,?,?,?,?)',[$book['titre'],$book['auteur'],$book['edition'],$book['resumer'],$book['image'],$book['ISBN'],$this->request->data['numInventaire'.$i],$book['nbExemplaire'],$book['sous_categorie_id']]);}
                $this->Flash->success(__("L'ouvrage est sauvegarder."));
                return $this->redirect(['action' => 'badrconsulterOuvrages']);
            }
            else
                $this->Flash->error(__("une erreur s'est produite lors de l'enregistrement des ouvrages"));
        }
        
        $this->render('/Espaces/respobiblios/badrnumInventaire');
    }
    public function badrmodifier($id = null) {
        $books = TableRegistry::get('Books');
        $book = $books->get($id, [
            'contain' => ['Users']
        ]);
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sousCategorie = $con->execute('SELECT id FROM sous_categories')->fetchAll('assoc');
            $this->request->data['sous_categorie_id']=$sousCategorie[$this->request->data['sous_categorie_id']]['id'];
            $book = $books->patchEntity($book, $this->request->data);
            if ($books->save($book)) {
                $this->Flash->success(__('Modification enregistrer dans la base de donnée'));
                return $this->redirect(['action' => 'badrconsulterOuvrages']);
            } else {
                $this->Flash->error(__('Modification non enregistrer'));
            }
        }
        $sousCategories=TableRegistry::get('sous_categories');
        $sc=$sousCategories->find("all",array(
            "joins" => array(
                array(
                    "table" => "sous_categories",
                    "conditions" => array(
                        "books.sous_categorie_id = sous_categories.id" 
                        )
                    )
                ),
            "fields" => "nom"
            ));
        $sousCategorie=$sc->toArray();
        $sousCategories=array();
        for ($i=0; $i < count($sousCategorie); $i++) { 
            $sousCategories[$i]=$sousCategorie[$i]['nom'];
        }
        $users = $books->Users->find('list', ['limit' => 200]);
        $this->set(compact('book', 'sousCategories', 'users'));
        $this->set('_serialize', ['book']);
        $this->render('/Espaces/respobiblios/badrmodifier');
    }
    public function badrsupprimer($id = null) {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $this->request->allowMethod(['post', 'delete']);
        $books = TableRegistry::get('Books');
        $book = $books->get($id, [
            'contain' => ['Users']
        ]);
        if ($books->delete($book)) {
            $con->execute('UPDATE books SET nbExemplaire = nbExemplaire-1 WHERE ISBN = ?',[$book['ISBN']]);
            $this->Flash->success(__("L'ouvrage a ete supprimer.", 'Book'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Book'));
        }
        return $this->redirect(['action' => 'badrconsulterOuvrages']);
        $this->render('/Espaces/respobiblios/badrsupprimer');
    }
    public function badrparametres($id = 1) {
        $parametres = TableRegistry::get('Parametres');
        $parametre = $parametres->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $parametre = $parametres->patchEntity($parametre, $this->request->data);
            if ($parametres->save($parametre)) {
                $this->Flash->success(__('les nouveaux paramÃ¨tres ont été sauvegarder.', 'Parametre'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Parametre'));
            }
        }
        $this->set(compact('parametre'));
        $this->set('_serialize', ['parametre']);
    	$this->render('/Espaces/respobiblios/badrparametres');
    }
    public function majdaajouteremprunte() {
        $UsersBooks = TableRegistry::get('UsersBooks');
        $usersBook = $UsersBooks->newEntity();
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        if ($this->request->is('post')) {
            $ouvrage=$con->execute('SELECT id FROM books WHERE numInventaire =?',[$this->request->data["numerodInventaire"]])->fetchAll('assoc');
            if(count($ouvrage) != 0) {
                $user = $con->execute('SELECT id,role FROM users WHERE username =?',[$this->request->data['identifiant_utilisateur']])->fetchAll('assoc');
                if (count($user) != 0) {
                    switch ($user[0]['role']) {
                    case 'etudiant':
                        $condition = $con->execute('SELECT maxEtud AS max,dureeEmprunteEtud AS delai FROM parametres')->fetchAll('assoc');
                        break;
                    case 'profvacataire':
                        $condition = $con->execute('SELECT maxProfVac AS max,dureeEmprunteProf AS delai FROM parametres')->fetchAll('assoc');
                        break;
                    case 'profpermanent':
                        $condition = $con->execute('SELECT maxProfPer AS max,dureeEmprunteProf AS delai FROM parametres')->fetchAll('assoc');
                        break;
                    }
                    $dejaEmprunter=$con->execute('SELECT user_id FROM users_books WHERE user_id=?',[$user[0]['id']]);
                    if ($condition[0]['max']>count($dejaEmprunter)) {
                        $ouvrageEmprunt=$con->execute('SELECT count(*) as num FROM users_books WHERE book_id = ?',[$ouvrage[0]['id']])->fetchAll('assoc');
                        if ($ouvrageEmprunt[0]['num']==0) {
                            $dejaReserver=$con->execute('SELECT user_id FROM reservations WHERE book_id = ?',[$ouvrage[0]['id']])->fetchAll('assoc');
                            if (count($dejaReserver)==0 || $dejaReserver[0]['user_id']==$user[0]['id']) {
                                $con->execute('DELETE FROM reservations WHERE book_id =?',[$ouvrage[0]['id']]);
                                $date = date_create(date("Y-m-d H:i:s"));
                                $date1=date_add($date,date_interval_create_from_date_string($condition[0]['delai']." days"));
                                $date=date_format($date1, 'Y-m-d H:i:s');
                                if ($con->execute('INSERT INTO users_books (user_id,book_id,dateEmprunte,delai) VALUES (?,?,NOW(),?)',[$user[0]['id'],$ouvrage[0]['id'],$date])) {
                                    $this->Flash->success(__("enregistrer avec succÃ¨s"));
                                }
                            }
                            else
                                $this->Flash->error(__("Ouvrage déja reserver par un autre utilisateur"));  
                        }
                        else
                            $this->Flash->error(__("Ouvrage déja emprunté"));
                    }
                    else
                    $this->Flash->error(__("L'utilisateur a depasser le nombre maximal d'emprunt"));
                }
                else
                    $this->Flash->error(__("L'identifiant de l'utilisateur est introuvable"));
            }
            else
                $this->Flash->error(__("cet ouvrage ne se trouve pas dans l'Inventaire"));
        }
        $this->set(compact('usersBook', 'users', 'books'));
        $this->set('_serialize', ['usersBook']);
        $this->render('/Espaces/respobiblios/majdaajouteremprunte');
    }
    public function majdaannuleremprunte() {
        if ($this->request->is('post')) {
            $dsn = 'mysql://root@localhost/ensaksite';
            $con=ConnectionManager::get('default', ['url' => $dsn]);
            $idusers=$con->execute('SELECT * FROM users_books WHERE book_id IN (SELECT id FROM books WHERE numInventaire =?)',[$this->request->data["numerodInventaire"]])->fetchAll('assoc');
            if (count($idusers)!=0) {
                $historiqueempruntes = TableRegistry::get('historiqueemprunte');
                $historiqueemprunte = $historiqueempruntes->newEntity();
                $usersbooks=TableRegistry::get('UsersBooks');
                $usersbook = $usersbooks->get($idusers[0]['id']);
                $historiqueemprunte->user_id = $usersbook->user_id;
                $historiqueemprunte->book_id = $usersbook->book_id;
                $historiqueemprunte->dateEmprunte = $usersbook->dateEmprunte;
                if ($usersbooks->delete($usersbook) && $historiqueempruntes->save($historiqueemprunte)) {
                    $this->Flash->success("supprimer avec succes");
                } else {
                    $this->Flash->error(__("une erreur s'est produite lors de la suppression"));
                }
            }
            else
                $this->Flash->error(__("une erreur s'est produite lors de la suppression"));
        }
        $this->render('/Espaces/respobiblios/majdaannuleremprunte');
    }
    public function majdaemprunte() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $deppassement=$con->execute('SELECT id FROM users_books WHERE delai< NOW()')->fetchAll('assoc');
        if (count($deppassement)>0) {
            for ($i=0; $i < count($deppassement); $i++) { 
            $deppassement[$i]=$deppassement[$i]['id'];
            }
            $this->set('deppassement',$deppassement);
        }
        else $this->set('deppassement',$deppassement);

        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) { 
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie',$categorie);
        if ($this->request->is('post')) {
            $empreinter = $con->execute('SELECT users.role,users_books.id as id,users.username,books.titre,books.numInventaire,users_books.dateEmprunte,users_books.delai FROM users,books,users_books WHERE users_books.user_id=users.id AND users_books.book_id = books.id AND books.sous_categorie_id IN (SELECT id FROM sous_categories WHERE categorie_id IN (SELECT id FROM categories WHERE id=? ))',[$categorieId[$this->request->data['categorie']]])->fetchAll('assoc');
            $this->set('empreinter',$empreinter);
        }
        else {
            $empreinter = $con->execute('SELECT users.role ,users_books.id as id,users.username,books.titre,books.numInventaire,users_books.dateEmprunte,users_books.delai FROM users,books,users_books WHERE users_books.user_id=users.id AND users_books.book_id = books.id ')->fetchAll('assoc');
            $this->set('empreinter',$empreinter);
        }
        $this->render('/Espaces/respobiblios/majdaemprunte');   
    }
    public function majdasupprimerEmprunte($id = null){
        if ($this->request->is('post', 'delete')) {
            $historiqueempruntes = TableRegistry::get('historiqueemprunte');
            $historiqueemprunte = $historiqueempruntes->newEntity();
            $usersbooks=TableRegistry::get('UsersBooks');
            $usersbook = $usersbooks->get($id);
            $historiqueemprunte->user_id = $usersbook->user_id;
            $historiqueemprunte->book_id = $usersbook->book_id;
            $historiqueemprunte->dateEmprunte = $usersbook->dateEmprunte;
            if ($usersbooks->delete($usersbook) && $historiqueempruntes->save($historiqueemprunte)) {
                $this->Flash->success("supprimer avec succes");
            } else {
                $this->Flash->error(__("une erreur s'est produite lors de la suppression"));
            }

            return $this->redirect(['action' => 'majdaemprunte']);
            $this->render('/Espaces/respobiblios/majdasupprimerEmprunte');
        }
    }
    public function hajarreservation() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) { 
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie',$categorie);
        if ($this->request->is('post')) {
            $reservation = $con->execute('SELECT users.role,reservations.id as id,users.username,books.titre,books.numInventaire,reservations.dateReservation,reservations.delai FROM users,books,reservations WHERE reservations.user_id=users.id AND reservations.book_id = books.id AND books.sous_categorie_id IN (SELECT id FROM sous_categories WHERE categorie_id IN (SELECT id FROM categories WHERE id=? ))',[$categorieId[$this->request->data['categorie']]])->fetchAll('assoc');
            $this->set('reservation',$reservation);
        }
        else {
            $reservation = $con->execute('SELECT users.role,reservations.id as id,users.username,books.titre,books.numInventaire,reservations.dateReservation,reservations.delai FROM users,books,reservations WHERE reservations.user_id=users.id AND reservations.book_id = books.id ')->fetchAll('assoc');
            $this->set('reservation',$reservation);
        }

        $this->render('/Espaces/respobiblios/hajarreservation');
    }
    public function hajarreservationProfVacataire() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) { 
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie',$categorie);
        if ($this->request->is('post')) {
            $reservation = $con->execute('SELECT reservations.user_id as id,users.username,books.titre,books.numInventaire,reservations.dateReservation,reservations.delai FROM users,books,reservations WHERE reservations.user_id=users.id AND reservations.book_id = books.id AND users.role="profvacataire" AND books.sous_categorie_id IN (SELECT id FROM sous_categories WHERE categorie_id IN (SELECT id FROM categories WHERE id=? ))',[$categorieId[$this->request->data['categorie']]])->fetchAll('assoc');
            for ($i=0; $i < count($reservation); $i++) { 
                $somme=$con->execute('SELECT somme FROM vacataires WHERE user_id=?',[$reservation[$i]['id']])->fetchAll('assoc');
                if (count($somme)>0) {
                    $reservation[$i]['username']=$somme[0]['somme'];
                }
                else
                    $reservation[$i]['username']='';

            }
            $this->set('reservation',$reservation);
        }
        else {
            $reservation = $con->execute('SELECT reservations.user_id as id,users.username,books.titre,books.numInventaire,reservations.dateReservation,reservations.delai FROM users,books,reservations WHERE reservations.user_id=users.id AND reservations.book_id = books.id AND users.role="profvacataire"')->fetchAll('assoc');
            for ($i=0; $i < count($reservation); $i++) { 
                $somme=$con->execute('SELECT somme FROM vacataires WHERE user_id=?',[$reservation[$i]['id']])->fetchAll('assoc');
                if (count($somme)>0) {
                    $reservation[$i]['username']=$somme[0]['somme'];
                }
                else
                    $reservation[$i]['username']='';

            }
            $this->set('reservation',$reservation);
        }
        $this->render('/Espaces/respobiblios/hajarreservationProfVacataire');   
    }
    public function hajarreservationProfPermanent() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) { 
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie',$categorie);
        if ($this->request->is('post')) {
            $reservation = $con->execute('SELECT reservations.user_id as id,users.username,books.titre,books.numInventaire,reservations.dateReservation,reservations.delai FROM users,books,reservations WHERE reservations.user_id=users.id AND reservations.book_id = books.id AND users.role="profpermanent" AND books.sous_categorie_id IN (SELECT id FROM sous_categories WHERE categorie_id IN (SELECT id FROM categories WHERE id=? ))',[$categorieId[$this->request->data['categorie']]])->fetchAll('assoc');
            for ($i=0; $i < count($reservation); $i++) { 
                $somme=$con->execute('SELECT somme FROM profpermanents WHERE user_id=?',[$reservation[$i]['id']])->fetchAll('assoc');
                if (count($somme)>0) {
                    $reservation[$i]['username']=$somme[0]['somme'];
                }
                else
                    $reservation[$i]['username']='';

            }
            $this->set('reservation',$reservation);
        }
        else {
            $reservation = $con->execute('SELECT reservations.user_id as id,users.username,books.titre,books.numInventaire,reservations.dateReservation,reservations.delai FROM users,books,reservations WHERE reservations.user_id=users.id AND reservations.book_id = books.id AND users.role="profpermanent"')->fetchAll('assoc');
            for ($i=0; $i < count($reservation); $i++) { 
                $somme=$con->execute('SELECT somme FROM profpermanents WHERE user_id=?',[$reservation[$i]['id']])->fetchAll('assoc');
                if (count($somme)>0) {
                    $reservation[$i]['username']=$somme[0]['somme'];
                }
                else
                    $reservation[$i]['username']='';
            }
        $this->set('reservation',$reservation);
        }
        $this->render('/Espaces/respobiblios/hajarreservationProfPermanent');   
    }
    public function hajarreservationEtudiant() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) { 
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie',$categorie);
        if ($this->request->is('post')) {
            $reservation = $con->execute('SELECT reservations.user_id as id,users.username,books.titre,books.numInventaire,reservations.dateReservation,reservations.delai FROM users,books,reservations WHERE reservations.user_id=users.id AND reservations.book_id = books.id AND users.role="etudiant" AND books.sous_categorie_id IN (SELECT id FROM sous_categories WHERE categorie_id IN (SELECT id FROM categories WHERE id=? ))',[$categorieId[$this->request->data['categorie']]])->fetchAll('assoc');
            for ($i=0; $i < count($reservation); $i++) { 
                $somme=$con->execute('SELECT apogee FROM etudiants WHERE user_id=?',[$reservation[$i]['id']])->fetchAll('assoc');
                if (count($somme)>0) {
                    $reservation[$i]['username']=$somme[0]['apogee'];
                }
                else
                    $reservation[$i]['username']='';

            }
            $this->set('reservation',$reservation);
        }
        else {
            $reservation = $con->execute('SELECT reservations.user_id as id,users.username,books.titre,books.numInventaire,reservations.dateReservation,reservations.delai FROM users,books,reservations WHERE reservations.user_id=users.id AND reservations.book_id = books.id AND users.role="etudiant"')->fetchAll('assoc');
            for ($i=0; $i < count($reservation); $i++) { 
                $somme=$con->execute('SELECT apogee FROM etudiants WHERE user_id=?',[$reservation[$i]['id']])->fetchAll('assoc');
                if (count($somme)>0) {
                    $reservation[$i]['username']=$somme[0]['apogee'];
                }
                else
                    $reservation[$i]['username']='';

            }
            $this->set('reservation',$reservation);
        }
        $this->render('/Espaces/respobiblios/hajarreservationEtudiant');   
    }
    public function badrhistoriqueCategorie() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) { 
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie',$categorie);
        $this->set('categorieId',$categorieId);
        if (isset($this->request->data['categorie']) && $this->request->data['categorie'] != 'inf') {
            $emprunt = $con->execute('SELECT books.titre,books.numInventaire,users.id,users.username,users.role,historiqueemprunte.dateEmprunte,historiqueemprunte.dateRetour FROM books,historiqueemprunte,users WHERE books.id=historiqueemprunte.book_id AND users.id=historiqueemprunte.user_id AND books.sous_categorie_id IN (SELECT id FROM sous_categories WHERE categorie_id IN (SELECT id FROM categories WHERE id=? ))',[$this->request->data['categorie']])->fetchAll('assoc');
            $selection=$this->request->data['categorie'];
            $this->set('selection',$selection);
            $souscategories = $con->execute('SELECT id,nom FROM sous_categories WHERE categorie_id = ?',[$selection])->fetchAll('assoc');
            for ($i=0; $i < count($souscategories); $i++) { 
                $souscategorie[$i]=$souscategories[$i]['nom'];
                $souscategorieId[$i]=$souscategories[$i]['id'];
            }
            $this->set('souscategorie',$souscategorie);
            $this->set('souscategorieId',$souscategorieId);
            if (isset($this->request->data['souscategorie']) && $this->request->data['souscategorie'] != 'inf1') {
                $emprunt = $con->execute('SELECT books.titre,books.numInventaire,users.id,users.username,users.role,historiqueemprunte.dateEmprunte,historiqueemprunte.dateRetour FROM books,historiqueemprunte,users WHERE books.id=historiqueemprunte.book_id AND users.id=historiqueemprunte.user_id AND books.sous_categorie_id =?',[$this->request->data['souscategorie']])->fetchAll('assoc');                $selection1=$this->request->data['souscategorie'];
                $this->set('selection1',$selection1);
            }
            else {
                $emprunt = $con->execute('SELECT books.titre,books.numInventaire,users.id,users.username,users.role,historiqueemprunte.dateEmprunte,historiqueemprunte.dateRetour FROM books,historiqueemprunte,users WHERE books.id=historiqueemprunte.book_id AND users.id=historiqueemprunte.user_id AND books.sous_categorie_id IN (SELECT id FROM sous_categories WHERE categorie_id IN (SELECT id FROM categories WHERE id=? ))',[$this->request->data['categorie']])->fetchAll('assoc');
            }
        }
        else 
            $emprunt=$con->execute('SELECT books.titre,books.numInventaire,users.id,users.username,users.role,historiqueemprunte.dateEmprunte,historiqueemprunte.dateRetour FROM books,historiqueemprunte,users WHERE books.id=historiqueemprunte.book_id AND users.id=historiqueemprunte.user_id')->fetchAll('assoc');

        for ($i=0; $i < count($emprunt); $i++) { 
                if(isset($emprunt[$i]['role'])) {
                    if ($emprunt[$i]['role']=='etudiant') {
                        $nom=$con->execute('SELECT nom_fr,prenom_fr,apogee FROM etudiants WHERE user_id=?',[$emprunt[$i]['id']])->fetchAll('assoc');
                        $emprunt[$i]['username']=$nom[0]['nom_fr'].' '.$nom[0]['prenom_fr'];
                        $emprunt[$i]['id']=$nom[0]['apogee'];
                    }
                    if ($emprunt[$i]['role']=='profpermanent') {
                        $nom=$con->execute('SELECT nom_prof,prenom_prof,somme FROM profpermanents WHERE user_id=?',[$emprunt[$i]['id']])->fetchAll('assoc');
                        $emprunt[$i]['username']=$nom[0]['nom_prof'].' '.$nom[0]['prenom_prof'];
                        $emprunt[$i]['id']=$nom[0]['somme'];
                    }
                    if ($emprunt[$i]['role']=='profvacataire') {
                        $nom=$con->execute('SELECT nom_vacataire,prenom_vacataire,somme FROM vacataires WHERE user_id=?',[$emprunt[$i]['id']])->fetchAll('assoc');
                        $emprunt[$i]['username']=$nom[0]['nom_vacataire'].' '.$nom[0]['prenom_vacataire'];
                        $emprunt[$i]['id']=$nom[0]['somme'];
                    }
                }
            }
        $this->set('emprunt',$emprunt);
        $this->render('/Espaces/respobiblios/badrhistoriqueCategorie');
    }
    public function badrhistorique() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        if ($this->request->is('post')) {
            $emprunt = $con->execute('SELECT books.titre,books.numInventaire,users.id,users.username,users.role,historiqueemprunte.dateEmprunte,historiqueemprunte.dateRetour FROM books,historiqueemprunte,users WHERE books.id=historiqueemprunte.book_id AND users.id=historiqueemprunte.user_id AND books.numInventaire=? ORDER BY dateRetour asc',[$this->request->data['search']])->fetchAll('assoc');
            for ($i=0; $i < count($emprunt); $i++) { 
                if(isset($emprunt[$i]['role'])) {
                    if ($emprunt[$i]['role']=='etudiant') {
                        $nom=$con->execute('SELECT nom_fr,prenom_fr,apogee FROM etudiants WHERE user_id=?',[$emprunt[$i]['id']])->fetchAll('assoc');
                        $emprunt[$i]['username']=$nom[0]['nom_fr'].' '.$nom[0]['prenom_fr'];
                        $emprunt[$i]['id']=$nom[0]['apogee'];
                    }
                    if ($emprunt[$i]['role']=='profpermanent') {
                        $nom=$con->execute('SELECT nom_prof,prenom_prof,somme FROM profpermanents WHERE user_id=?',[$emprunt[$i]['id']])->fetchAll('assoc');
                        $emprunt[$i]['username']=$nom[0]['nom_prof'].' '.$nom[0]['prenom_prof'];
                        $emprunt[$i]['id']=$nom[0]['somme'];
                    }
                    if ($emprunt[$i]['role']=='profvacataire') {
                        $nom=$con->execute('SELECT nom_vacataire,prenom_vacataire,somme FROM vacataires WHERE user_id=?',[$emprunt[$i]['id']])->fetchAll('assoc');
                        $emprunt[$i]['username']=$nom[0]['nom_vacataire'].' '.$nom[0]['prenom_vacataire'];
                        $emprunt[$i]['id']=$nom[0]['somme'];
                    }
                }
            }  
            $this->set('emprunt',$emprunt);
        }
        $this->render('/Espaces/respobiblios/badrhistorique');
    }
    public function badrehistoriqueutilisateur() {
        $usid=$this->Auth->user('id');
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        if ($this->request->is('post')) {
            if ($this->request->data['utilisateur']=='etudiant') {
                $emprunt = $con->execute('SELECT etudiants.apogee,etudiants.nom_fr as nom,etudiants.prenom_fr as prenom,books.titre,books.numInventaire,historiqueemprunte.dateEmprunte,historiqueemprunte.dateRetour FROM books,historiqueemprunte,users,etudiants WHERE books.id=historiqueemprunte.book_id AND users.id=historiqueemprunte.user_id AND etudiants.user_id=historiqueemprunte.user_id AND etudiants.apogee=? ORDER BY dateRetour asc',[$this->request->data['search']])->fetchAll('assoc'); 
                $this->set('emprunt',$emprunt);   
            }
            else if($this->request->data['utilisateur']=='profpermanant'){
                $emprunt = $con->execute('SELECT profpermanents.somme as apogee,profpermanents.nom_prof as nom,profpermanents.prenom_prof as prenom,books.titre,books.numInventaire,historiqueemprunte.dateEmprunte,historiqueemprunte.dateRetour FROM books,historiqueemprunte,users,profpermanents WHERE books.id=historiqueemprunte.book_id AND users.id=historiqueemprunte.user_id AND profpermanents.user_id=historiqueemprunte.user_id AND profpermanents.somme=? ORDER BY dateRetour asc',[$this->request->data['search']])->fetchAll('assoc'); 
                $this->set('emprunt',$emprunt);
            }
            else {
                $emprunt = $con->execute('SELECT vacataires.somme as apogee,vacataires.nom_vacataire as nom,vacataires.prenom_vacataire as prenom,books.titre,books.numInventaire,historiqueemprunte.dateEmprunte,historiqueemprunte.dateRetour FROM books,historiqueemprunte,users,vacataires WHERE books.id=historiqueemprunte.book_id AND users.id=historiqueemprunte.user_id AND vacataires.user_id=historiqueemprunte.user_id AND vacataires.somme=? ORDER BY dateRetour asc',[$this->request->data['search']])->fetchAll('assoc'); 
                $this->set('emprunt',$emprunt);
            }
        }
        $this->render('/Espaces/respobiblios/badrehistoriqueutilisateur');
    }
    public function badrStatistique() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $username=$this->Auth->user('username');
        $this->set('username',$username);
        $deppassement=$con->execute('SELECT users.username,users.role,books.numInventaire FROM users,books,users_books WHERE users.id=users_books.user_id AND books.id= users_books.book_id AND users_books.delai< NOW()')->fetchAll('assoc');
        $this->set('deppassement',$deppassement);
        $con->execute('DELETE FROM reservations WHERE delai<NOW()');
        $quatrecadre=$con->execute('SELECT COUNT(*) as sum FROM users_books WHERE delai<NOW()')->fetchAll('assoc');
        $this->set('quatrecadre',$quatrecadre);
        $books = TableRegistry::get('Books');
        $numbooks = $books->find('all');
        $numberbooks=$numbooks->count();
        $this->set('numberbooks',$numberbooks);
        $Reservations = TableRegistry::get('Reservations');
        $numreservations = $Reservations->find('all');
        $numberreservations=$numreservations->count();
        $this->set('numberreservations',$numberreservations);
        $users_books = TableRegistry::get('Users_Books');
        $numempreintes = $users_books->find('all');
        $numberempreintes=$numempreintes->count();
        $this->set('numberempreintes',$numberempreintes);
        $demande = $con->execute('SELECT count(book_id) AS num,book_id FROM historiqueemprunte GROUP BY book_id ORDER BY count(book_id) desc')->fetchAll('assoc');
        $this->set('demande',$demande);
        $demandetitre=array();
        for ($i=0; $i < count($demande); $i++) { 
            $ouvrageDemande=$con->execute('SELECT titre FROM books WHERE id=?',[$demande[$i]['book_id']])->fetchAll('assoc');
            $demandetitre[$i]=$ouvrageDemande[0]['titre'];
        }
        $this->set('demandetitre',$demandetitre);
        $totaleEmprunte = $con->execute('SELECT count(book_id) AS num FROM historiqueemprunte')->fetchAll('assoc');
        $this->set('totaleEmprunte',$totaleEmprunte);
        $book = $con->execute('SELECT DISTINCT ISBN,titre,auteur,nbExemplaire,edition FROM books')->fetchAll('assoc');
        $this->set('book',$book);
        $reserver = $con->execute('SELECT titre,numInventaire FROM books WHERE id IN (SELECT book_id FROM reservations)')->fetchAll('assoc');
        $this->set('reserver',$reserver);
        $empreinter = $con->execute('SELECT titre,numInventaire FROM books WHERE id IN (SELECT book_id FROM users_books)')->fetchAll('assoc');
        $this->set('empreinter',$empreinter);
        $pique= $con->execute('SELECT count(*) as somme,MONTH(dateEmprunte) as mois FROM historiqueemprunte GROUP BY MONTH(dateEmprunte)')->fetchAll('assoc');
        $sommeMois=array(0,0,0,0,0,0,0,0,0,0,0,0);
        for ($i=0; $i < count($pique); $i++) { 
            switch ($pique[$i]['mois']) {
                case 1:
                    $sommeMois[0]=$pique[$i]['somme'];
                    break;
                case 2:
                    $sommeMois[1]=$pique[$i]['somme'];
                    break;
                case 3:
                    $sommeMois[2]=$pique[$i]['somme'];
                    break;
                case 4:
                    $sommeMois[3]=$pique[$i]['somme'];
                    break;
                case 5:
                    $sommeMois[4]=$pique[$i]['somme'];
                    break;
                case 6:
                    $sommeMois[5]=$pique[$i]['somme'];
                    break;
                case 7:
                    $sommeMois[6]=$pique[$i]['somme'];
                    break;
                case 8:
                    $sommeMois[7]=$pique[$i]['somme'];
                    break;
                case 9:
                    $sommeMois[8]=$pique[$i]['somme'];
                    break;
                case 10:
                    $sommeMois[9]=$pique[$i]['somme'];
                    break;
                case 11:
                    $sommeMois[10]=$pique[$i]['somme'];
                    break;
                case 12:
                    $sommeMois[11]=$pique[$i]['somme'];
                    break;
            }
        }
        $this->set('sommeMois',$sommeMois);
        $this->render('/Espaces/respobiblios/badrStatistique');
    }
    public function badrDepassementDelai() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) { 
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie',$categorie);
        $this->set('categorieId',$categorieId);
        if (isset($this->request->data['categorie']) && $this->request->data['categorie'] != 'inf') {
            $depasser=$con->execute('SELECT users.username,users.role,books.titre,books.numInventaire,users_books.dateEmprunte,users_books.delai FROM users,books,users_books WHERE users_books.user_id=users.id AND books.id=users_books.book_id AND users_books.delai<NOW() AND books.sous_categorie_id IN (SELECT id FROM sous_categories where categorie_id =?)',[$this->request->data['categorie']])->fetchAll('assoc');
            $selection=$this->request->data['categorie'];
            $this->set('selection',$selection);
        }
        else 
            $depasser=$con->execute('SELECT users.username,users.role,books.titre,books.numInventaire,users_books.dateEmprunte,users_books.delai FROM users,books,users_books WHERE users_books.user_id=users.id AND books.id=users_books.book_id AND users_books.delai<NOW()')->fetchAll('assoc');
        $this->set('depasser',$depasser);
        $this->render('/Espaces/respobiblios/badrDepassementDelai');
    }
    public  function listproposition() {
        $con = ConnectionManager::get('default');
        $propositions = $con->execute("SELECT * FROM proposition  ")->fetchAll('assoc');
        $this->set('propositions', $propositions);
        $this->render('/Espaces/respobiblios/listproposition');
    }
    public  function etatproposition() {
        $con = ConnectionManager::get('default');
        if ($this->request->is(['post'])) {
            $search = $this->request->data();
            $etat=$search['etat'];
            $id=$search['id'];
            $con->execute("update proposition set proposition.etat='".$etat."' where proposition.id='".$id."'");
            $this->Flash->success(__('La modification  de l \'état sur la liste des proposition a bien été transmises'));
            $propositions = $con->execute("SELECT * FROM proposition  ")->fetchAll('assoc');
            $this->set('propositions', $propositions);
            $this->render('/Espaces/respobiblios/listproposition');
        }
    }
    public  function etatproposition2() {
        $con = ConnectionManager::get('default');
        if ($this->request->is(['post'])) {
            $search = $this->request->data();
            $etat=$search['etat'];
            $id=$search['id'];
            $con->execute("update proposition set proposition.etat='".$etat."' where proposition.id='".$id."'");
            $this->Flash->success(__('La modification  de l \'état sur la liste des proposition a bien été transmises'));
            $detail = $con->execute("SELECT * FROM proposition where id=3  ")->fetchAll('assoc');
            $this->set('detail', $detail);
            $this->render('/Espaces/respobiblios/detailproposition');
        }
    }
    public function detailproposition() {
        $con = ConnectionManager::get('default');

        if ($this->request->is(['post'])) {
            $search = $this->request->data();
            $id=$search['id'];
            $detail = $con->execute("SELECT * FROM proposition where id=".$id."")->fetchAll('assoc');
            $this->set('detail', $detail);
            $this->render('/Espaces/respobiblios/detailproposition');
        }
    }
    public function majdaemprunteProfVacataire() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $deppassement=$con->execute('SELECT id FROM users_books WHERE delai< NOW()')->fetchAll('assoc');
        if (count($deppassement)>0) {
            for ($i=0; $i < count($deppassement); $i++) {
                $deppassement[$i]=$deppassement[$i]['id'];
            }
            $this->set('deppassement',$deppassement);
        }
        else $this->set('deppassement',$deppassement);

        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) {
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie',$categorie);
        if ($this->request->is('post')) {
            $empreinter = $con->execute('SELECT users_books.user_id as Id,users_books.id as id,users.username,books.titre,books.numInventaire,users_books.dateEmprunte,users_books.delai FROM users,books,users_books WHERE users_books.user_id=users.id AND users_books.book_id = books.id AND users.role="profvacataire" AND books.sous_categorie_id IN (SELECT id FROM sous_categories WHERE categorie_id IN (SELECT id FROM categories WHERE id=? ))',[$categorieId[$this->request->data['categorie']]])->fetchAll('assoc');
            for ($i=0; $i < count($empreinter); $i++) {
                $somme=$con->execute('SELECT somme FROM vacataires WHERE user_id=?',[$empreinter[$i]['Id']])->fetchAll('assoc');
                if (count($somme)>0) {
                    $empreinter[$i]['username']=$somme[0]['somme'];
                }
                else
                    $empreinter[$i]['username']='';

            }
            $this->set('empreinter',$empreinter);
        }
        else {
            $empreinter = $con->execute('SELECT users_books.user_id as Id,users_books.id as id,users.username,books.titre,books.numInventaire,users_books.dateEmprunte,users_books.delai FROM users,books,users_books WHERE users_books.user_id=users.id AND users_books.book_id = books.id AND users.role="profvacataire"')->fetchAll('assoc');
            for ($i=0; $i < count($empreinter); $i++) {
                $somme=$con->execute('SELECT somme FROM vacataires WHERE user_id=?',[$empreinter[$i]['Id']])->fetchAll('assoc');
                if (count($somme)>0) {
                    $empreinter[$i]['username']=$somme[0]['somme'];
                }
                else {
                    $empreinter[$i]['username']='';
                }

            }
            $this->set('empreinter',$empreinter);
        }
        $this->render('/Espaces/respobiblios/majdaemprunteProfVacataire');
    }
    public function majdaemprunteProfPermanent() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $deppassement=$con->execute('SELECT id FROM users_books WHERE delai< NOW()')->fetchAll('assoc');
        if (count($deppassement)>0) {
            for ($i=0; $i < count($deppassement); $i++) {
                $deppassement[$i]=$deppassement[$i]['id'];
            }
            $this->set('deppassement',$deppassement);
        }
        else $this->set('deppassement',$deppassement);

        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) {
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie',$categorie);
        if ($this->request->is('post')) {
            $empreinter = $con->execute('SELECT users_books.user_id as Id,users_books.id as id,users.username,books.titre,books.numInventaire,users_books.dateEmprunte,users_books.delai FROM users,books,users_books WHERE users_books.user_id=users.id AND users_books.book_id = books.id AND users.role="profpermanent" AND books.sous_categorie_id IN (SELECT id FROM sous_categories WHERE categorie_id IN (SELECT id FROM categories WHERE id=? ))',[$categorieId[$this->request->data['categorie']]])->fetchAll('assoc');
            for ($i=0; $i < count($empreinter); $i++) {
                $somme=$con->execute('SELECT somme FROM profpermanents WHERE user_id=?',[$empreinter[$i]['Id']])->fetchAll('assoc');
                if (count($somme)>0) {
                    $empreinter[$i]['username']=$somme[0]['somme'];
                }
                else
                    $empreinter[$i]['username']='';

            }
            $this->set('empreinter',$empreinter);
        }
        else {
            $empreinter = $con->execute('SELECT users_books.user_id as Id,users_books.id as id,users.username,books.titre,books.numInventaire,users_books.dateEmprunte,users_books.delai FROM users,books,users_books WHERE users_books.user_id=users.id AND users_books.book_id = books.id AND users.role="profpermanent"')->fetchAll('assoc');
            for ($i=0; $i < count($empreinter); $i++) {
                $somme=$con->execute('SELECT somme FROM profpermanents WHERE user_id=?',[$empreinter[$i]['Id']])->fetchAll('assoc');
                if (count($somme)>0) {
                    $empreinter[$i]['username']=$somme[0]['somme'];
                }
                else
                    $empreinter[$i]['username']='';

            }
            $this->set('empreinter',$empreinter);
        }
        $this->render('/Espaces/respobiblios/majdaemprunteProfPermanent');
    }
    public function majdaemprunteEtudiant() {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $deppassement=$con->execute('SELECT id FROM users_books WHERE delai< NOW()')->fetchAll('assoc');
        if (count($deppassement)>0) {
            for ($i=0; $i < count($deppassement); $i++) {
                $deppassement[$i]=$deppassement[$i]['id'];
            }
            $this->set('deppassement',$deppassement);
        }
        else $this->set('deppassement',$deppassement);

        $categories = $con->execute('SELECT id,nom FROM categories')->fetchAll('assoc');
        for ($i=0; $i < count($categories); $i++) {
            $categorie[$i]=$categories[$i]['nom'];
            $categorieId[$i]=$categories[$i]['id'];
        }
        $this->set('categorie',$categorie);
        if ($this->request->is('post')) {
            $empreinter = $con->execute('SELECT users_books.user_id as Id,users_books.id as id,users.username,books.titre,books.numInventaire,users_books.dateEmprunte,users_books.delai FROM users,books,users_books WHERE users_books.user_id=users.id AND users_books.book_id = books.id AND users.role="etudiant" AND books.sous_categorie_id IN (SELECT id FROM sous_categories WHERE categorie_id IN (SELECT id FROM categories WHERE id=? ))',[$categorieId[$this->request->data['categorie']]])->fetchAll('assoc');
            for ($i=0; $i < count($empreinter); $i++) {
                $somme=$con->execute('SELECT apogee FROM etudiants WHERE user_id=?',[$empreinter[$i]['Id']])->fetchAll('assoc');
                if (count($somme)>0) {
                    $empreinter[$i]['username']=$somme[0]['apogee'];
                }
                else
                    $empreinter[$i]['username']='';

            }
            $this->set('empreinter',$empreinter);
        }
        else {
            $empreinter = $con->execute('SELECT users_books.user_id as Id,users_books.id as id,users.username,books.titre,books.numInventaire,users_books.dateEmprunte,users_books.delai FROM users,books,users_books WHERE users_books.user_id=users.id AND users_books.book_id = books.id AND users.role="etudiant"')->fetchAll('assoc');
            for ($i=0; $i < count($empreinter); $i++) {
                $somme=$con->execute('SELECT apogee FROM etudiants WHERE user_id=?',[$empreinter[$i]['Id']])->fetchAll('assoc');
                if (count($somme)>0) {
                    $empreinter[$i]['username']=$somme[0]['apogee'];
                }
                else
                    $empreinter[$i]['username']='';

            }
            $this->set('empreinter',$empreinter);
        }
        $this->render('/Espaces/respobiblios/majdaemprunteEtudiant');
    }

    /********* Bouhis *********/
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

        $this->render('/Espaces/respobiblios/demanderabsences');
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

                        return $this->redirect(['controller'=>'Respobiblios','action' => 'index']);
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

                        return $this->redirect(['controller'=>'Respobiblios','action' => 'index']);
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
        $this->render('/Espaces/respobiblios/demanderDocFct');

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
        $this->render('/Espaces/respobiblios/etatDemandeFct');

    }

    /*****************/

}

?>