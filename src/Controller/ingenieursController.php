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
            $this->Flash->success(__('L\'{0} a été supprimé', 'Actualite'));
        } else {
            $this->Flash->error(__('L\' {0} n\'a pas pu être supprimé. Veuillez réessayer.', 'actualité'));
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
                $this->Flash->success(__('Enregistré avec succès'));
                return $this->redirect(['action' => 'afficherLaureats']);
            } else {
                $this->Flash->error(__('Erreur'));
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
                $this->Flash->success(__('Modifié avec succès'));
                return $this->redirect(['action' => 'afficherLaureats']);
            } else {
                $this->Flash->error(__('Erreur'));
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
            $this->Flash->success(__('La {0} a été supprimé.', 'statistique'));
        } else {
            $this->Flash->error(__('La {0} n\'a pas pu être supprimé. Veuillez réessayer.', 'statistique'));
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
         $donne_demande='';
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


}


?>
