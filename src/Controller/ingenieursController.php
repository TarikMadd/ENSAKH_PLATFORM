<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;




class ingenieursController extends AppController {

  public function index()
  {

      $this->render('/Espaces/ingenieurs/index');
  }
  public function viewActualites($id = null)
    {
    	$Actualites=TableRegistry::get('Actualites');
        $actualite = $Actualites->get($id, [
            'contain' => []
        ]);

        $this->set('actualite', $actualite);
        $this->set('_serialize', ['actualite']);
        $this->render('/Espaces/ingenieurs/viewActualites');
    }
  public function afficherActualites()
    {
    	$Actualites=TableRegistry::get('Actualites');
        $actualites = $this->paginate($Actualites);

        $this->set(compact('actualites'));
        $this->set('_serialize', ['actualites']);
        $this->render('/Espaces/ingenieurs/afficherActualites');
    }
  public function ajouterActualites()
    {   $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $Actualites=TableRegistry::get('Actualites');
        $actualite = $Actualites->newEntity();
        if ($this->request->is('post')) {
            $actualite = $Actualites->patchEntity($actualite, $this->request->data);
            if ($Actualites->save($actualite)) {
                // pour photo
                $extension=pathinfo($this->request->data['photo']['name'] , PATHINFO_EXTENSION);
                if (!empty($this->request->data['photo']['tmp_name']) &&
                    in_array($extension, array('jpg','jpeg','png'))) {
                    move_uploaded_file($this->request->data['photo']['tmp_name'],  WWW_ROOT . 'img\imagesSite\actualite' . DS . $actualite->id. '.'. $extension);
                    $con->execute('UPDATE actualites SET photo = ? WHERE id = ?',[$actualite->id.'.'.$extension,$actualite->id]);
                }
                else if (!empty($this->request->data['photo']['tmp_name'])) {
                    $con->execute('UPDATE actualites SET photo = ? WHERE id = ?',['default.jpg',$actualite->id]);
                }
                // pour fichier
                $extension=pathinfo($this->request->data['file']['name'] , PATHINFO_EXTENSION);
                if (!empty($this->request->data['file']['tmp_name']) &&
                    in_array($extension, array('pdf','docx','rar'))) {
                    move_uploaded_file($this->request->data['file']['tmp_name'],  WWW_ROOT . 'img\documentsSite\actualite' . DS . $this->request->data['file']['name']);
                    $con->execute('INSERT INTO sitedocuments VALUES(?,?,?,?) ',[NULL,$actualite->titre,$this->request->data['file']['name'],$actualite->id]);
                }
                /* else if (empty($this->request->data['photo']['tmp_name'])) {
                     $con->execute('UPDATE actualites SET photo = ? WHERE titre = ?',['default.jpg',$this->request->data['titre']]);
                 }*/


                $this->Flash->success(__('Enregistré avec succès'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur'));
            }
            $Sitedocuments=TableRegistry::get('Sitedocuments');



        }
        $this->set(compact('actualite'));
        $this->set('_serialize', ['actualite']);
        $this->render('/Espaces/ingenieurs/ajouterActualites');
    }
    public function modifierActualites($id = null)
    {   $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);

        $Actualites=TableRegistry::get('Actualites');
        $actualite = $Actualites->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $actualite = $Actualites->patchEntity($actualite, $this->request->data);
            $image= $con->execute('SELECT photo from actualites where id=?',[$id])->fetchAll('assoc');
            if ($Actualites->save($actualite)) {


                $extension=pathinfo($this->request->data['photo']['name'] , PATHINFO_EXTENSION);
                if (!empty($this->request->data['photo']['tmp_name']) &&
                    in_array($extension, array('jpg','jpeg','png'))) {
                    move_uploaded_file($this->request->data['photo']['tmp_name'],  WWW_ROOT . 'img\imagesSite\actualite' . DS . $this->request->data['titre']. '.'. $extension);
                    $con->execute('UPDATE actualites SET photo = ? WHERE titre = ?',[$this->request->data['titre'].'.'.$extension,$this->request->data['titre']]);
                }
                else if (empty($this->request->data['photo']['tmp_name'])) {
                    $con->execute('UPDATE actualites SET photo = ? WHERE id = ?',[$image[0]['photo'],$id]);
                }


                $this->Flash->success(__('Modifié avec succès'));
                return $this->redirect(['action' => 'afficherActualites']);
            } else {
                $this->Flash->error(__('Erreur'));
            }
        }
        $this->set(compact('actualite'));
        $this->set('_serialize', ['actualite']);
        $this->render('/Espaces/ingenieurs/modifierActualites');
    }
    public function supprimerActualites($id = null)
    {
    	$Actualites=TableRegistry::get('Actualites');
        $this->request->allowMethod(['post', 'delete']);
        $actualite = $Actualites->get($id);
        if ($Actualites->delete($actualite)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Actualite'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Actualite'));
        }
        return $this->redirect(['action' => 'afficherActualites']);
        $this->render('/Espaces/ingenieurs/supprimerActualites');
    }

    public function afficherEvenements()
    {
    	 $Evenements=TableRegistry::get('Evenements');
        $evenements = $this->paginate($Evenements);

        $this->set(compact('evenements'));
        $this->set('_serialize', ['evenements']);

       
        $this->render('/Espaces/ingenieurs/afficherEvenements');
    }

     public function ajouterEvenements()
    {   $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);

        $Evenements=TableRegistry::get('Evenements');
        $evenement = $Evenements->newEntity();

        if ($this->request->is('post')) {
            $evenement = $Evenements->patchEntity($evenement, $this->request->data);

            if ($Evenements->save($evenement)) {

                $extension=pathinfo($this->request->data['photo']['name'] , PATHINFO_EXTENSION);
                if (!empty($this->request->data['photo']['tmp_name']) &&
                    in_array($extension, array('jpg','jpeg','png'))) {
                    move_uploaded_file($this->request->data['photo']['tmp_name'],  WWW_ROOT . 'img\imagesSite\evenements' . DS . $evenement->id. '.'. $extension);
                    $con->execute('UPDATE evenements SET photo = ? WHERE id = ?',[$evenement->id.'.'.$extension,$evenement->id]);
                }
                else if (!empty($this->request->data['photo']['tmp_name'])) {
                    $con->execute('UPDATE evenements SET photo = ? WHERE id = ?',['default.jpg',$evenement->id]);
                }

                $this->Flash->success(__('Enregistré avec succès'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur'));
            }
        }
        $this->set(compact('evenement'));
        $this->set('_serialize', ['evenement']);
        $this->render('/Espaces/ingenieurs/ajouterEvenements');
    }

    public function modifierEvenements($id = null)
    {   $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);

        $Evenements=TableRegistry::get('Evenements');
        $evenement = $Evenements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $evenement = $Evenements->patchEntity($evenement, $this->request->data);
            $image= $con->execute('SELECT photo from evenements where id=?',[$id])->fetchAll('assoc');
            if ($Evenements->save($evenement)) {


                $extension=pathinfo($this->request->data['photo']['name'] , PATHINFO_EXTENSION);
                if (!empty($this->request->data['photo']['tmp_name']) &&
                    in_array($extension, array('jpg','jpeg','png'))) {
                    move_uploaded_file($this->request->data['photo']['tmp_name'],  WWW_ROOT . 'img\imagesSite\evenements' . DS . $evenement->id. '.'. $extension);
                    $con->execute('UPDATE evenements SET photo = ? WHERE id = ?',[$evenement->id.'.'.$extension,$evenement->id]);
                }
                else if (empty($this->request->data['photo']['tmp_name'])) {
                    $con->execute('UPDATE evenements SET photo = ? WHERE id = ?',[$image[0]['photo'],$id]);
                }

                $this->Flash->success(__('Modifié avec succès'));
                return $this->redirect(['action' => 'afficherEvenements']);
            } else {
                $this->Flash->error(__('Erreur'));
            }
        }
        $this->set(compact('evenement'));
        $this->set('_serialize', ['evenement']);
        $this->render('/Espaces/ingenieurs/modifierEvenements');
    }

    public function supprimerEvenements($id = null)
    {
        $Evenements=TableRegistry::get('Evenements');
        $this->request->allowMethod(['post', 'delete']);
        $evenement = $Evenements->get($id);
        if ($Evenements->delete($evenement)) {
            $this->Flash->success(__('L\'{0} a été supprimé', 'événement'));
        } else {
            $this->Flash->error(__('L\' {0} n\'a pas pu être supprimé. Veuillez réessayer.', 'événement'));
        }
        return $this->redirect(['action' => 'afficherEvenements']);
    }

    public function viewEvenements($id = null)
    {
        $Evenements=TableRegistry::get('Evenements');
        $evenement = $Evenements->get($id, [
            'contain' => []
        ]);

        $this->set('evenement', $evenement);
        $this->set('_serialize', ['evenement']);
        $this->render('/Espaces/ingenieurs/viewEvenements');
    }


    /* VERSION 2 */
    public function liste()
    {
        $this->render('/Espaces/ingenieurs/liste2');
    }

    public function viewLaureats($id = null)
    {
        $Laureats=TableRegistry::get('Laureats');
        $laureat = $Laureats->get($id, [
            'contain' => []
        ]);

        $this->set('laureat', $laureat);
        $this->set('_serialize', ['laureat']);
        $this->render('/Espaces/ingenieurs/viewLaureats');
    }
       public function ajouterLaureats()
    {
        $Laureats=TableRegistry::get('Laureats');
        $laureat = $Laureats->newEntity();
        if ($this->request->is('post')) {
            $laureat = $Laureats->patchEntity($laureat, $this->request->data);
            if ($Laureats->save($laureat)) {
                $this->Flash->success(__('The {0} has been saved.', 'Laureat'));
                return $this->redirect(['action' => 'afficherLaureats']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Laureat'));
            }
        }
        $this->set(compact('laureat'));
        $this->set('_serialize', ['laureat']);
        $this->render('/Espaces/ingenieurs/ajouterLaureats');

    }

      public function modifierLaureats($id = null)
    {
        $Laureats=TableRegistry::get('Laureats');
        $laureat = $Laureats->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $laureat = $Laureats->patchEntity($laureat, $this->request->data);
            if ($Laureats->save($laureat)) {
                $this->Flash->success(__('The {0} has been saved.', 'Laureat'));
                return $this->redirect(['action' => 'afficherLaureats']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Laureat'));
            }
        }
        $this->set(compact('laureat'));
        $this->set('_serialize', ['laureat']);
         $this->render('/Espaces/ingenieurs/modifierLaureats');
    }
     public function supprimerLaureats($id = null)
    {
        $Laureats=TableRegistry::get('Laureats');
        $this->request->allowMethod(['post', 'delete']);
        $laureat = $Laureats->get($id);
        if ($Laureats->delete($laureat)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Laureat'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Laureat'));
        }
        return $this->redirect(['action' => 'afficherLaureats']);
    }

     public function afficherLaureats()
    {
        $Laureats=TableRegistry::get('Laureats');
        $laureats = $this->paginate($Laureats);

        $this->set(compact('laureats'));
        $this->set('_serialize', ['laureats']);
        $this->render('/Espaces/ingenieurs/afficherLaureats');

    }


   public function ajouterActualiteClubs()
    {   // pour definir le club


        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $Actualiteclubs=TableRegistry::get('Actualiteclubs');
        $actualiteclub = $Actualiteclubs->newEntity();
        if ($this->request->is('post')) {


            $actualiteclub = $Actualiteclubs->patchEntity($actualiteclub, $this->request->data);
            if ($Actualiteclubs->save($actualiteclub)) {

                $extension=pathinfo($this->request->data['photo']['name'] , PATHINFO_EXTENSION);
                if (!empty($this->request->data['photo']['tmp_name']) &&
                    in_array($extension, array('jpg','jpeg','png'))) {
                    move_uploaded_file($this->request->data['photo']['tmp_name'],  WWW_ROOT . 'img\imagesSite\actualiteClubs' . DS . $actualiteclub->id. '.'. $extension);
                    $con->execute('UPDATE actualiteClubs SET image = ? WHERE id = ?',[$actualiteclub->id.'.'.$extension,$actualiteclub->id]);
                }
                else if (!empty($this->request->data['photo']['tmp_name'])) {
                    $con->execute('UPDATE actualiteClubs SET image = ? WHERE id = ?',[$actualiteclub->id.'.'.$extension,$actualiteclub->id]);
                }
                // pour les fichiers:
                $extension=pathinfo($this->request->data['fichier']['name'] , PATHINFO_EXTENSION);
                if (!empty($this->request->data['fichier']['tmp_name']) &&
                    in_array($extension, array('pdf','docx','ppt','pps','pptx','ppsx','rar','zip','txt'))) {
                    move_uploaded_file($this->request->data['fichier']['tmp_name'],  WWW_ROOT . 'img\documentsSite\actualiteClubs' . DS . $actualiteclub->id. '.'. $extension);
                    $con->execute('UPDATE actualiteClubs SET fichier = ? WHERE id = ?',[$actualiteclub->id.'.'.$extension,$actualiteclub->id]);
                }
                else if (!empty($this->request->data['fichier']['tmp_name'])) {
                    $con->execute('UPDATE actualiteClubs SET fichier = ? WHERE id = ?',['default.docx',$actualiteclub->id]);
                }



                $this->Flash->success(__('Enregistré avec succès'));
                return $this->redirect(['action' => 'ajouterActualiteClubs']);
            } else {
                $this->Flash->error(__('Erreur'));
            }
        }

        $clubs = $Actualiteclubs->Clubs->find('list', ['limit' => 200]);
        $Clubs = TableRegistry::get('clubs');
        $dest = $Clubs->find("all", array(
            "joins" => array(
                array(

                    "table" => "clubs",
                    "conditions" => array(
                        "actualiteclub.id_club = clubs.id"
                    )
                )
            ),
            "fields" =>"clubs.nom"
        ));
        $donne_demande =  $con->execute('SELECT clubs.nom, clubs.id FROM clubs ')->fetchAll('assoc');


        $this->set('donne_demande',$donne_demande);

        $clubs=$dest->toArray();
        $Clubs=array();
        for ($i=0;$i<count($clubs);$i++) {
            $Clubs[]=$clubs[$i]['nom'];
        }


        $this->set(compact('actualiteclub'));
        $this->set('_serialize', ['actualiteclub']);
        $this->render('/Espaces/ingenieurs/ajouterActualiteClubs');
    }
    public function afficherActualiteClubs()
    {   $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);

        $Actualiteclubs=TableRegistry::get('Actualiteclubs');
        $actualiteclubq = $this->paginate($Actualiteclubs);

        $Clubs = TableRegistry::get('clubs');
        $nom = array();
        $actualiteclubs=null;
        foreach ($actualiteclubq as $actualiteclub) {
            $donne_demande =  $con->execute('SELECT clubs.nom FROM clubs WHERE clubs.id=?',[$actualiteclub->id_club])->fetchAll('assoc');
            $actualiteclub->nom = $donne_demande[0]['nom'];
            $actualiteclubs[]=$actualiteclub;
        }

        $this->set('donne_demande',$donne_demande);


        $this->set(compact('actualiteclubs'));
        $this->set('_serialize', ['actualiteclubs']);
        $this->render('/Espaces/ingenieurs/afficherActualiteClubs');
    }
    public function viewActualiteClubs($id = null)
    {   $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);

        $Actualiteclubs=TableRegistry::get('Actualiteclubs');
        $actualiteclubq = $Actualiteclubs->get($id, [
            'contain' => []
        ]);

        $Clubs = TableRegistry::get('clubs');
        $nom = array();
        $actualiteclub=null;
        // foreach ($actualiteclubq as $actualiteclu) {
        $donne_demande =  $con->execute('SELECT clubs.nom FROM clubs WHERE clubs.id=?',[$actualiteclubq->id_club])->fetchAll('assoc');
        $actualiteclubq->nom = $donne_demande[0]['nom'];
        $actualiteclub=$actualiteclubq;
        // }

        $this->set('actualiteclub', $actualiteclub);
        $this->set('_serialize', ['actualiteclub']);
        $this->render('/Espaces/ingenieurs/viewActualiteClubs');
    }
    function liste2()
    {
        $this->render("/Espaces/ingenieurs/liste2");
    }
    public function modifierActualiteClubs($id = null)
    {   $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);

        $Actualiteclubs=TableRegistry::get('Actualiteclubs');
        $actualiteclub = $Actualiteclubs->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $actualiteclub = $Actualiteclubs->patchEntity($actualiteclub, $this->request->data);
            $image= $con->execute('SELECT image from actualiteclubs where id=?',[$id])->fetchAll('assoc');
            $fichier=$con->execute('SELECT fichier from actualiteclubs where id=?',[$id])->fetchAll('assoc');
            if ($Actualiteclubs->save($actualiteclub)) {
                // partie photo
                $extension=pathinfo($this->request->data['photo']['name'] , PATHINFO_EXTENSION);
                if (!empty($this->request->data['photo']['tmp_name']) &&
                    in_array($extension, array('jpg','jpeg','png'))) {
                    move_uploaded_file($this->request->data['photo']['tmp_name'],  WWW_ROOT . 'img\imagesSite\actualiteClubs' . DS . $actualiteclub->id. '.'. $extension);
                    $con->execute('UPDATE actualiteclubs SET image = ? WHERE id = ?',[$actualiteclub->id.'.'.$extension,$actualiteclub->id]);
                }
                else if (empty($this->request->data['photo']['tmp_name'])) {
                    $con->execute('UPDATE actualiteclubs SET image = ? WHERE id = ?',[$image[0]['image'],$id]);
                }
                // partie fichier
                $extension=pathinfo($this->request->data['fichier']['name'] , PATHINFO_EXTENSION);
                if (!empty($this->request->data['fichier']['tmp_name']) &&
                    in_array($extension, array('pdf','docx','ppt','pps','pptx','ppsx','rar','zip','txt'))) {
                    move_uploaded_file($this->request->data['fichier']['tmp_name'],  WWW_ROOT . 'img\documentsSite\actualiteClubs' . DS . $actualiteclub->id. '.'. $extension);
                    $con->execute('UPDATE actualiteclubs SET fichier = ? WHERE id = ?',[$actualiteclub->id.'.'.$extension,$actualiteclub->id]);
                }
                else if (empty($this->request->data['fichier']['tmp_name'])) {
                    $con->execute('UPDATE actualiteclubs SET fichier = ? WHERE id = ?',[$fichier[0]['fichier'],$id]);
                }

                $this->Flash->success(__('Modifié avec succès'));
                return $this->redirect(['action' => 'afficherActualiteClubs']);
            } else {
                $this->Flash->error(__('Erreur'));
            }
        }

        $clubs = $Actualiteclubs->Clubs->find('list', ['limit' => 200]);
        $Clubs = TableRegistry::get('clubs');
        $dest = $Clubs->find("all", array(
            "joins" => array(
                array(

                    "table" => "clubs",
                    "conditions" => array(
                        "actualiteclub.id_club = clubs.id"
                    )
                )
            ),
            "fields" =>"clubs.nom"
        ));
        $donne_demande =  $con->execute('SELECT clubs.nom, clubs.id FROM clubs ')->fetchAll('assoc');


        $this->set('donne_demande',$donne_demande);

        $clubs=$dest->toArray();
        $Clubs=array();
        for ($i=0;$i<count($clubs);$i++) {
            $Clubs[]=$clubs[$i]['nom'];
        }

        $this->set(compact('actualiteclub'));
        $this->set('_serialize', ['actualiteclub']);
        $this->render('/Espaces/ingenieurs/modifierActualiteClubs');
    }
public function supprimerActualiteClubs($id = null)
    {
        $Actualiteclubs=TableRegistry::get('Actualiteclubs');
        $this->request->allowMethod(['post', 'delete']);
        $actualiteclub = $Actualiteclubs->get($id);
        if ($Actualiteclubs->delete($actualiteclub)) {
            $this->Flash->success(__('L\' {0} a été supprimé.', 'actualité'));
        } else {
            $this->Flash->error(__('L\' {0} n\'a pas pu être supprimé. Veuillez réessayer.', 'actualité'));
        }
        return $this->redirect(['action' => 'afficherActualiteClubs']);
    }

    public function ajouterImages()
    {

        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $Images=TableRegistry::get('Images');
        $image = $Images->newEntity();

        if ($this->request->is('post'))
        {

            $extension=pathinfo($this->request->data['lien']['name'] , PATHINFO_EXTENSION);
            if (!empty($this->request->data['lien']['tmp_name']) &&
                in_array($extension, array('jpg','jpeg','png'))) {
                move_uploaded_file($this->request->data['lien']['tmp_name'],WWW_ROOT .  'img\imagesSite\gallery' . DS . $this->request->data['lien']['name']);}
            $this->request->data['lien']=$this->request->data['lien']['name'];
            $image = $Images->patchEntity($image, $this->request->data);
            $con->execute('INSERT INTO images (lien,commentaire) VALUES (?,?)',[$this->request->data['lien'],$this->request->data['commentaire']]);

            $this->Flash->success(__('Enregistré avec succès'));

            return $this->redirect(['action' => 'ajouterImages']);
        }
        else
        {

        }
        $this->set('image',$image);
        $this->set(compact('Image'));
        $this->set('_serialize', ['Image']);
        $this->render('/Espaces/ingenieurs/ajouterImages');
    }
    public function afficherImages()
    {
        $Images=TableRegistry::get('Images');
        $images = $this->paginate($Images);

        $this->set(compact('images'));
        $this->set('_serialize', ['images']);
        $this->render('/Espaces/ingenieurs/afficherImages');
    }
    public function viewImages($id = null)
    {
        $Images=TableRegistry::get('Images');
        $image = $Images->get($id, [
            'contain' => []
        ]);

        $this->set('image', $image);
        $this->set('_serialize', ['image']);
        $this->render('/Espaces/ingenieurs/viewImages');
    }
    /* public function modifierImages($id = null)
     {   $dsn = 'mysql://root@localhost/ensaksite';
         $con=ConnectionManager::get('default', ['url' => $dsn]);

         $Images=TableRegistry::get('Images');
         $image = $Images->get($id, [
             'contain' => []
         ]);
         if ($this->request->is(['patch', 'post', 'put'])) {
             $image = $Images->patchEntity($image, $this->request->data);
             $image= $con->execute('SELECT lien from images where id=?',[$id])->fetchAll('assoc');
             if ($Images->save($image)) {

                 if (!empty($this->request->data['lien']['tmp_name']) &&
                     in_array($extension, array('jpg','jpeg','png'))) {
                       //  move_uploaded_file($this->request->data['lien']['tmp_name'],WWW_ROOT .  'img\imagesSite\gallery' . DS . $this->request->data['lien']['name']);

                 }
                 else if (empty($this->request->data['lien']['tmp_name'])) {
                         $con->execute('UPDATE images SET lien = ? WHERE id = ?',[$image[0]['lien'],$id]);
                 }

                 $this->Flash->success(__('The {0} has been saved.', 'modification'));
                 return $this->redirect(['action' => 'afficherImages']);
             } else {
                 $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'modification'));
             }
         }
         $this->set(compact('image'));
         $this->set('_serialize', ['image']);
         $this->render('/Espaces/ingenieurs/modifierImages');
     } */
    public function supprimerImages($id = null)
    {
        $Images=TableRegistry::get('Images');
        $this->request->allowMethod(['post', 'delete']);
        $image = $Images->get($id);
        if ($Images->delete($image)) {
            $this->Flash->success(__('L\' {0} a été supprimé.', 'image'));
        } else {
            $this->Flash->error(__('L\' {0} n\'a pas pu être supprimé. Veuillez réessayer.', 'image'));
        }
        return $this->redirect(['action' => 'afficherImages']);
    }

    public function ajouterVideos()
    {
        $Videos=TableRegistry::get('Videos');
        $video = $Videos->newEntity();
        if ($this->request->is('post')) {
            $video = $Videos->patchEntity($video, $this->request->data);
            if ($Videos->save($video)) {
                $this->Flash->success(__('Enregistré avec succès'));
                return $this->redirect(['action' => 'ajouterVideos']);
            } else {
                $this->Flash->error(__('Erreur'));
            }
        }
        $this->set(compact('video'));
        $this->set('_serialize', ['video']);
        $this->render('/Espaces/ingenieurs/ajouterVideos');
    }
    public function afficherVideos()
    {
        $Videos=TableRegistry::get('Videos');
        $videos = $this->paginate($Videos);

        $this->set(compact('videos'));
        $this->set('_serialize', ['videos']);
        $this->render('/Espaces/ingenieurs/afficherVideos');
    }
    public function viewVideos($id = null)
    {
        $Videos=TableRegistry::get('Videos');
        $video = $Videos->get($id, ['contain' => []]);

        $this->set('video', $video);
        $this->set('_serialize', ['video']);
        $this->render('/Espaces/ingenieurs/viewVideos');
    }
    public function modifierVideos($id = null)
    {
        $Videos=TableRegistry::get('Videos');
        $video = $Videos->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $video = $Videos->patchEntity($video, $this->request->data);
            if ($Videos->save($video)) {
                $this->Flash->success(__('Modifié avec succès'));
                return $this->redirect(['action' => 'afficherVideos']);
            } else {
                $this->Flash->error(__('Erreur'));
            }
        }
        $this->set(compact('video'));
        $this->set('_serialize', ['video']);
        $this->render('/Espaces/ingenieurs/modifierVideos');
    }
    public function supprimerVideos($id = null)
    {
        $Videos=TableRegistry::get('Videos');
        $this->request->allowMethod(['post', 'delete']);
        $video = $Videos->get($id);
        if ($Videos->delete($video)) {
            $this->Flash->success(__('La {0} a été supprimé.', 'vidéo'));
        } else {
            $this->Flash->error(__('Le {0} n\'a pas pu être supprimé. Veuillez réessayer.', 'vidéo'));
        }
        return $this->redirect(['action' => 'afficherVideos']);
    }

	public function ajouterClubs()
    {   $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);
        $Clubs=TableRegistry::get('Clubs');
        $club = $Clubs->newEntity();
        if ($this->request->is('post')) {
            $club = $Clubs->patchEntity($club, $this->request->data);
            if ($Clubs->save($club)) {

                $extension=pathinfo($this->request->data['logo']['name'] , PATHINFO_EXTENSION);
                if (!empty($this->request->data['logo']['tmp_name']) &&
                    in_array($extension, array('jpg','jpeg','png'))) {
                    move_uploaded_file($this->request->data['logo']['tmp_name'], WWW_ROOT . 'img\imagesSite\clubs' . DS . $club->id. '.'. $extension);
                    $con->execute('UPDATE clubs SET logo = ? WHERE id = ?',[$club->id.'.'.$extension,$club->id]);
                }
                else if (!empty($this->request->data['logo']['tmp_name'])) {
                    $con->execute('UPDATE clubs SET logo = ? WHERE id = ?',['default.jpg',$club->id]);
                }


                $this->Flash->success(__('Enregistré avec succès'));
                return $this->redirect(['action' => 'ajouterClubs']);
            } else {
                $this->Flash->error(__('Erreur'));
            }
        }
        $this->set(compact('club'));
        $this->set('_serialize', ['club']);
        $this->render('/Espaces/ingenieurs/ajouterClubs');
    }
    public function afficherClubs()
    {
        $Clubs=TableRegistry::get('Clubs');
        $clubs = $this->paginate($Clubs);

        $this->set(compact('clubs'));
        $this->set('_serialize', ['clubs']);
        $this->render('/Espaces/ingenieurs/afficherClubs');
    }
    public function viewClubs($id = null)
    {
        $Clubs=TableRegistry::get('Clubs');
        $club = $Clubs->get($id, ['contain' => []]);

        $this->set('club', $club);
        $this->set('_serialize', ['club']);
        $this->render('/Espaces/ingenieurs/viewClubs');
    }
    public function modifierClubs($id = null)
    {
        $dsn = 'mysql://root@localhost/ensaksite';
        $con=ConnectionManager::get('default', ['url' => $dsn]);

        $Clubs=TableRegistry::get('Clubs');
        $club = $Clubs->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $club = $Clubs->patchEntity($club, $this->request->data);
            $image= $con->execute('SELECT logo from clubs where id=?',[$id])->fetchAll('assoc');
            if ($Clubs->save($club)) {

                $extension=pathinfo($this->request->data['logo']['name'] , PATHINFO_EXTENSION);
                if (!empty($this->request->data['logo']['tmp_name']) &&
                    in_array($extension, array('jpg','jpeg','png'))) {
                    move_uploaded_file($this->request->data['logo']['tmp_name'],  WWW_ROOT . 'img\imagesSite\clubs' . DS . $club->id. '.'. $extension);
                    $con->execute('UPDATE clubs SET logo = ? WHERE id = ?',[$club->id.'.'.$extension,$club->id]);
                }
                else if (empty($this->request->data['logo']['tmp_name'])) {
                    $con->execute('UPDATE clubs SET logo = ? WHERE id = ?',[$image[0]['logo'],$id]);
                }

                $this->Flash->success(__('Modifié avec succès'));
                return $this->redirect(['action' => 'afficherClubs']);
            } else {
                $this->Flash->error(__('Erreur'));
            }
        }
        $this->set(compact('club'));
        $this->set('_serialize', ['club']);
        $this->render('/Espaces/ingenieurs/modifierClubs');
    }
    public function supprimerClubs($id = null)
    {
        $Clubs=TableRegistry::get('Clubs');
        $this->request->allowMethod(['post', 'delete']);
        $club = $Clubs->get($id);
        if ($Clubs->delete($club)) {
            $this->Flash->success(__('Le {0} a été supprimé.', 'Club'));
        } else {
            $this->Flash->error(__('Le {0} n\'a pas pu être supprimé. Veuillez réessayer.', 'club'));
        }
        return $this->redirect(['action' => 'afficherClubs']);
    }


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

        $this->render('/Espaces/ingenieurs/demanderabsences');
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

                    // if($nombrebis>3)
                    // {
                    //     $this->Flash->error(__('Vous avez dépassé le nombre maximum des attestations , pour plus d\'infos veuillez nous conatcter au service'));
                    //     break;
                    // }

                    // else
                    if($nombre>=1)
                    {
                        $this->Flash->error(__('Echéc d\'envoi ... Déja vous avez '.$nombre.' demande(s) dans le service, veuillez attender Svp'));
                        break;
                    }
                    elseif($ProfpermanentsDocuments->save($documentsProfesseur)) {
                        $nombrebis++;
                        $query=$profpermanents->find('all')->update()->set(['etat_attestation' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();

                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['controller'=>'ingenieurs','action' => 'index']);
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

                        return $this->redirect(['controller'=>'ingenieurs','action' => 'index']);
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
        $this->render('/Espaces/ingenieurs/demanderDocFct');

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
        $this->render('/Espaces/ingenieurs/etatDemandeFct');

    }

    //Validation de donnees

    public function viewmouna($id = null)
    {
        $this->loadModel('Fonctionnaires');
        $usrole=$this->Auth->user('id');
        $role=$this->Auth->user('role');

        $modif = ConnectionManager::get('default');
        $id = $modif->execute("SELECT id FROM fonctionnaires  WHERE user_id=".$usrole."")->fetchAll('assoc');
        //debug($id);

        $profpermanent = $this->Fonctionnaires->get($id[0]['id'], [
            'contain' => []
        ]);

        $this->set('id',$usrole);
        $this->set('role',$role);
        $this->set('profpermanent', $profpermanent);
        $this->render('/Espaces/fonctionnaires/viewmouna');
    }

    public function editmouna()
    {
        $this->loadModel('Fonctionnaires');
        $usrole=$this->Auth->user('id');

        $modif = ConnectionManager::get('default');
        $id = $modif->execute("SELECT id FROM fonctionnaires  WHERE user_id=".$usrole."")->fetchAll('assoc');
        $id=$id[0]['id'];
        $Profpermanent = TableRegistry::get('fonctionnairesbis');
        $profpermanentOriginal = $this->Fonctionnaires->get($id);
        $profpermanent = $this->Fonctionnaires->get($id);
        //debug($profpermanent);

        if ($this->request->is(['patch', 'post', 'put'])) {

            //debug($profpermanentOriginal);
            $profpermanent = $Profpermanent->newEntity();
            //$profpermanent= $Profpermanent->patchEntity($profpermanent, $this->request->data);

            $profpermanent->somme=$this->request->data('somme');
            $profpermanent->user_id=$profpermanentOriginal->user_id;
            $profpermanent->salaire=$profpermanentOriginal->salaire;
            $profpermanent->etat=$this->request->data('etat');
            //debug($this->request->data('date_Recrut'));
            if($profpermanentOriginal->date_Recrut)
               $profpermanent->date_Recrut=$profpermanentOriginal->date_Recrut;
            $profpermanent->nom_fct=$this->request->data('nom_fct');
            $profpermanent->prenom_fct=$this->request->data('prenom_fct');
            $profpermanent->age=$this->request->data('age');
            $profpermanent->specialite=$this->request->data('specialite');
            $profpermanent->situation_Familiale=$this->request->data('situation_Familiale');
            if($profpermanentOriginal->dateNaissance)
             $profpermanent->dateNaissance=$profpermanentOriginal->dateNaissance;
             $profpermanent->etat_attestation=$profpermanentOriginal->etat_attestation;
             $profpermanent->photo=$profpermanentOriginal->photo;
             $profpermanent->etat_fiche=$profpermanentOriginal->etat_fiche;
            $profpermanent->lieuNaissance=$this->request->data('lieuNaissance');
            $profpermanent->CIN=$this->request->data('CIN');
            $profpermanent->email=$this->request->data('email');
            $profpermanent->phone=$this->request->data('phone');
            $profpermanent->genre=$this->request->data('genre');
            $profpermanent->nbr_enfants=$this->request->data('nbr_enfants');
            $profpermanent->isPassExam=$this->request->data('isPassExam');
            //debug($profpermanent);

            //dump($profpermanent);exit;

            if ($Profpermanent->save($profpermanent)) {
                $this->Flash->success(__('Votre demande de modification de données a été envoyée au responsable , veuillez attendre son traitement .
                '));

                //return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fonctionnaire'));
            }
        }
        $this->set(compact('profpermanent'));
        $this->render('/Espaces/fonctionnaires/editmouna');

    }

}


?>
