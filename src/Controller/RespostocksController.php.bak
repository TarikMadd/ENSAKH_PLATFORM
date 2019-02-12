<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;


class respostocksController extends AppController {
    public function beforeFilter(Event $event)
    {
        // allow only login, forgotpassword
        $this->Auth->authorize = 'controller';
        $usrole = $this->Auth->user('role');
        if($usrole!='respostock' && $usrole!='admin')
        {

            $this->Flash->error(__('Vous ne pouvez pas acceder a ce lien'));
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'logout']
            );
        }
        $this->Auth->deny();

    }

    public function index() {

        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);

        ////////////////////////////////////////////////////


        $articles = $this->paginate(TableRegistry::get('Articles'));
        $commandes = $this->paginate(TableRegistry::get('Commandes'));
        $stockCategories = $this->paginate(TableRegistry::get('StockCategories')); // WORKING !!!!!!!
        /*  $articles = $this->paginate($this->Articles); */


        $this->set(compact('articles'));
        $this->set(compact('stockCategories'));
        $this->set(compact('commandes'));
        $this->set('_serialize', ['articles']);
        $this->set('_serialize', ['commandes']);
        $this->set('_serialize', ['stockCategories']);
        $this->render('/Espaces/respostocks/home');

        /*$date=$con->execute('SELECT titre,day(date) as jourDebut,month(date) as mois,YEAR(date) as year,day(fin) as jourFin,month(fin) as moisFin,YEAR(fin) as yearFin FROM calendriers')->fetchAll('assoc');
        $this->set('date',$date);
        $couleurs=array("#27ae60"=>0,"#2980b9"=>0,"#e74c3c"=>0,"#7f8c8d"=>0,"#16a085"=>0,"#8e44ad"=>0,"#1abc9c"=>0,"#34495e"=>0);
        $this->set('couleurs',$couleurs); */

    }



    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////// Article Controller    //////////////////////////////////////////////////////////////////////
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexArticles()
    {


        $this->paginate = [
            'contain' => ['StockCategories']
        ];

        $articles = $this->paginate(TableRegistry::get('Articles')); // WORKING !!!!!!!
        /*  $articles = $this->paginate($this->Articles); */

        $this->set(compact('articles'));
        $this->set('_serialize', ['articles']);
        $this->render('/Espaces/respostocks/index_articles');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewArticles($id = null)
    {
        $article = TableRegistry::get('Articles')->get($id, [
            'contain' => ['StockCategories', 'Commande_articles', 'Mouvements']
        ]);

        $this->set('article', $article);
        $this->set('_serialize', ['article']);
        $this->render('/Espaces/respostocks/view_articles');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addArticles()
    {
        $article = TableRegistry::get('Articles')->newEntity();
        if ($this->request->is('post')) {
            $article = TableRegistry::get('Articles')->patchEntity($article, $this->request->data);
            if (TableRegistry::get('Articles')->save($article)) {
                $this->Flash->success(__('The {0} has been saved.', 'Article'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Article'));
            }
        }
        $stockCategories = TableRegistry::get('Articles')->StockCategories->find('list', ['limit' => 200]);
        $this->set(compact('article', 'stockCategories'));
        $this->set('_serialize', ['article']);
        $this->render('/Espaces/respostocks/add_articles');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editArticles($id = null)
    {
        $connection = ConnectionManager::get('default');
        $article = TableRegistry::get('Articles')->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = TableRegistry::get('Articles')->patchEntity($article, $this->request->data);
            if (TableRegistry::get('Articles')->save($article)) {
                $connection->execute('delete  FROM commande_articles where article_id="'.$id.'"');
                $this->Flash->success(__('The {0} has been saved.', 'Article'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Article'));
            }
        }
        $stockCategories = TableRegistry::get('Articles')->StockCategories->find('list', ['limit' => 200]);
        $this->set(compact('article', 'stockCategories'));
        $this->set('_serialize', ['article']);
        $this->render('/Espaces/respostocks/edit_articles');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteArticles($id = null)
    {
        $connection = ConnectionManager::get('default');
        $this->request->allowMethod(['post', 'delete']);
        $article = TableRegistry::get('Articles')->get($id);
        if (TableRegistry::get('Articles')->delete($article)) {
            $connection->execute('delete  FROM commande_articles where article_id="'.$id.'"');

            $this->Flash->success(__('The {0} has been deleted.', 'Article'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Article'));
        }
        return $this->redirect(['action' => 'index_articles']);
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    public function exportArticles($limit=100)
    {
        $cat=$_POST['cat'];
        $articles=TableRegistry::get('Articles')->find('all')->limit($limit)->where(['label_article like'=>'%'.$cat.'%']);
        $this->set(compact('articles'));
        $this->render('/Espaces/respostocks/export_articles');

    }

    public function trierArticles()
    {
        $this->set(compact('articles'));
        $this->render('/Espaces/respostocks/trier_articles');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////// Commandes Controller    //////////////////////////////////////////////////////////////////////
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexCommandes()
    {
        $connection = ConnectionManager::get('default');
        $commande=$connection->execute('SELECT commandes.id, commandes.delai_limite, commandes.nom, stock_categories.label_cat FROM commandes JOIN stock_categories ON commandes.stock_categorie_id = stock_categories.id')->fetchAll('assoc');
        $this->set('commande',$commande);
        $this->render('/Espaces/respostocks/index_commandes');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * View method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewCommandes($id = null)
    {
        $connection = ConnectionManager::get('default');
        $Atest=TableRegistry::get('commandes');
        $atest = $connection->execute('SELECT commandes.id, commandes.delai_limite, commandes.nom, stock_categories.label_cat FROM commandes JOIN stock_categories ON commandes.stock_categorie_id = stock_categories.id WHERE commandes.id='.$id.' ')->fetchAll('assoc');
        $comm= $connection->execute('SELECT * FROM commande_articles where commande_id="'.$id.'"')->fetchAll('assoc');
        if (!empty($comm)){
            foreach ($comm as  $valeur)
            {
                $var[]=$connection->execute('SELECT label_article FROM articles where id="'.$valeur['article_id'].'"')->fetchAll('assoc');
            }
            $this->set('var', $var);
        }
        $this->set('atest', $atest);
        $this->set('comm', $comm);
        $this->set('_serialize', ['atest']);
        $this->render('/Espaces/respostocks/viewCom');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addCommandes()
    {
        $connection = ConnectionManager::get('default');
        $fournisseur = TableRegistry::get('Commandes')->newEntity();
        $fournisseur1 = TableRegistry::get('Commandes')->newEntity();
        if ($this->request->is('post')) {
            $fournisseur1->nom=$this->request->data['nom'];
            $x=$this->request->data['delai_limite'];
            $y=$x["year"]."-".$x["month"]."-".$x["day"];
            $fournisseur1->delai_limite=$y;
            $prete =  $connection->execute('SELECT id FROM stock_categories where label_cat="'.$this->request->data['stock_categorie'].'"')->fetchAll('assoc');
            $fournisseur1->stock_categorie_id=$prete[0]["id"];
            if (TableRegistry::get('Commandes')->save($fournisseur1)) {
                $this->Flash->success(__('The commande has been saved.', 'commande'));
                return $this->redirect(['action' => 'indexCommandes']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'commande'));
            }
        }
        $stockCategories = TableRegistry::get('Commandes')->StockCategories->find('list', ['limit' => 200]);
        $this->set(compact('commande', 'stockCategories'));
        $this->set('_serialize', ['commande']);
        $donne_prete =  $connection->execute('SELECT label_cat as cate FROM stock_categories ')->fetchAll('assoc');
        if (!empty($donne_prete)){
            foreach ($donne_prete as  $valeur) {
                foreach ($valeur as $key => $value) {
                    $donne[$value]=$value;
                }
            }
            $this->set('fournisseur',$fournisseur);
            $this->set('donne',$donne);
            $this->set('donne_prete',$donne_prete);
            $this->render('/Espaces/respostocks/add_commandes');

        }else{
            $this->Flash->error(__('La table stock categorie est vide '));
            return $this->redirect(['action' => 'indexCommandes']);
        }

        foreach ($donne_prete as  $valeur) {
            foreach ($valeur as $key => $value) {
                $donne[$value]=$value;
            }
        }
        $this->set('fournisseur',$fournisseur);
        $this->set('donne',$donne);
        $this->set('donne_prete',$donne_prete);
        $this->render('/Espaces/respostocks/add_commandes');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Edit method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editCommandes($id = null)
    {
        $connection = ConnectionManager::get('default');
        $Atest=TableRegistry::get('commandes');
        $atest = $Atest->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $atest = $Atest->patchEntity($atest, $this->request->data);

            if ($Atest->save($atest)) {
                $this->Flash->success(__('The {0} has been saved.', 'commande'));
                return $this->redirect(['action' => 'indexCommandes']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'commande'));
            }
        }
        $this->set(compact('atest', 'stockCategories'));
        $this->set('_serialize', ['atest']);
        $this->render('/Espaces/respostocks/editCom');

    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Delete method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteCommandes($id = null)
    {
        $connection = ConnectionManager::get('default');
        $Atest=TableRegistry::get('commandes');
        $connection->execute('delete  FROM commande_articles where commande_id="'.$id.'"');
        $this->request->allowMethod(['post', 'delete']);
        $atest = $Atest->get($id);

        if ($Atest->delete($atest)) {
            $this->Flash->success(__('The {0} has been deleted.', 'commande'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'commande'));
        }
        return $this->redirect(['action' => 'indexCommandes']);
    }


    public function comCom($id = null)
    {
        $connection = ConnectionManager::get('default');
        $Atest=TableRegistry::get('commandes');
        $prete =  $connection->execute('SELECT stock_categorie_id  FROM commandes where id="'.$id.'"')->fetchAll('assoc');
        $var= $connection->execute('SELECT nom_fournisseur , adresse FROM fournisseurs where stock_categorie_id="'.$prete[0]["stock_categorie_id"].'"')->fetchAll('assoc');
        $atest = $Atest->get($id, [
            'contain' => ['StockCategories']
        ]);
        $this->set('var', $var);
        $this->set('atest', $atest);
        $this->set('_serialize', ['atest']);
        if (!empty($var)){
            $this->render('/Espaces/respostocks/com');
        }else{
            $this->Flash->error(__('Ajouter un fournisseur compatible avec  le stock categorie choisi'));
            return $this->redirect(['action' => 'indexCommandes']);
        }
    }

    public function liste($id = null)
    {
        $connection = ConnectionManager::get('default');
        $prete =  $connection->execute('SELECT * FROM commande_articles where commande_id="'.$id.'"')->fetchAll('assoc');
        foreach ($prete as  $valeur)
        {
            $var[]=$connection->execute('SELECT label_article FROM articles where id="'.$valeur['article_id'].'"')->fetchAll('assoc');
        }
        if (!empty($var)){
            $this->set('prete', $prete);
            $this->set('var', $var);
            $this->render('/Espaces/respostocks/liste');
        }else{
            $this->Flash->error(__('la liste des articles commandes est vide veuillez ajouter un article '));
            return $this->redirect(['action' => 'indexCommandes']);
        }

        $this->set('_serialize', ['atest']);

    }
    /******************************************************************************************************************************************/
    // commander articles

    public function viewCA($id = null)
    {
        $connection = ConnectionManager::get('default');
        $comm=$connection->execute('SELECT * FROM commande_articles WHERE id='.$id)->fetchAll('assoc');

        $this->set('comm', $comm);
        $this->set('_serialize', ['comm']);
        $this->render('/Espaces/respostocks/viewCA');
    }
    public function deleteCA($id = null)
    {
        $connection = ConnectionManager::get('default');
        $Comm=TableRegistry::get('commande_articles');
        $this->request->allowMethod(['post', 'delete']);
        $comm = $Comm->get($id);
        $des=$connection->execute('SELECT commande_id  FROM commande_articles WHERE id='.$id)->fetchAll('assoc');
        if ($Comm->delete($comm)) {
            $this->Flash->success(__('The {0} has been deleted.', 'article'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'article'));
        }
        return $this->redirect(['action' => 'viewCommandes' , $des[0]["commande_id"]]);

    }
    public function addCA($id = null)
    {
        $Comm=TableRegistry::get('commande_articles');
        $comm = $Comm->newEntity();
        $connection = ConnectionManager::get('default');
        if ($this->request->is('post')) {
            $comm = $Comm->patchEntity($comm, $this->request->data);
            $comm->commande_id=$id;
            $prete =  $connection->execute('SELECT id FROM articles where label_article="'.$comm->article_.'"')->fetchAll('assoc');
            $comm->article_id=$prete[0]["id"];
            if ($Comm->save($comm)) {
                $this->Flash->success(__('The {0} has been saved.', 'article'));
                return $this->redirect(['action' => 'viewCommandes' , $id]);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'article'));
            }
        }
        $var =  $connection->execute('SELECT stock_categorie_id FROM commandes where id="'.$id.'"')->fetchAll('assoc');
        $varr =  $connection->execute('SELECT label_article FROM articles where stock_categorie_id="'.$var[0]["stock_categorie_id"].'"')->fetchAll('assoc');
        if (!empty($varr)){
            foreach ($varr as  $valeur) {
                foreach ($valeur as $key => $value) {
                    $don[$value]=$value;
                }
            }
            $this->set('don', $don);
            $this->set(compact('comm', 'articles'));
            $this->set('_serialize', ['comm']);
            $this->render('/Espaces/respostocks/addCA');
        }else{
            $this->Flash->error(__('Ajouter un article compatible avec  le stock categorie choisi'));
            return $this->redirect(['action' => 'indexCommandes']);
        }
        foreach ($varr as  $valeur) {
            foreach ($valeur as $key => $value) {
                $don[$value]=$value;
            }
        }
    }
    public function editCA($id = null)
    {
        $connection = ConnectionManager::get('default');
        $Comm=TableRegistry::get('commande_articles');
        $comm = $Comm->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comm = $Comm->patchEntity($comm, $this->request->data);
            $des=$connection->execute('SELECT commande_id  FROM commande_articles WHERE id='.$id)->fetchAll('assoc');
            if ($Comm->save($comm)) {
                $this->Flash->success(__('The {0} has been saved.', 'article'));
                return $this->redirect(['action' => 'viewCommandes' , $des[0]["commande_id"]]);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'article'));
            }
        }

        $this->set('comm', $comm);
        $this->set('_serialize', ['comm']);
        $this->render('/Espaces/respostocks/editCA');
    }

    public function envoieCom()
    {
        $Comm =TableRegistry::get('commandes');
        $comm = $Comm->newEntity();
        if ($this->request->is('post')) {
            //$x=dou;
            if(isset($_FILES) && (bool) $_FILES){

                //define allowed extensions

                $allowedExtensions = array("pdf","docx","doc","gif","jpeg","jpg","png","rtf","txt");
                $files=array();
                //loop through all the files
                foreach ($_FILES as $name => $file) {


                    // define some variables
                    $file_name = $file['name'];
                    $temp_name = $file['tmp_name'];
                    //check if this file type is allowed
                    $path_parts = pathinfo($file_name);
                    $ext = $path_parts['extension'];
                    if(!in_array($ext, $allowedExtensions)){
                        $this->Flash->error(__('extension not allowed ', 'mail '));
                        return $this->redirect(['action' => 'testt']);

                    }
                    //move this file to the server YOU HAVE TO DO THIS
                    $server_file = "C:\wamp64\www\uploads/$path_parts[basename]";
                    move_uploaded_file($temp_name, $server_file);
                    // add this file to the array of files
                    array_push($files, $server_file);
                }

                //define some mail variables
                $to = $this->request->data['email'];
                $from = "ensakhouribga2007@gmail.com";
                $subject = $this->request->data['subject'];
                $msg = $this->request->data['msg'];
                $headers = "From: $from";


                //define our boundary
                $semi_rand = md5(time());
                $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

                //tell the header about the boundary
                $headers .= "\nMIME-Version: 1.0\n";
                $headers .= "Content-Type: multipart/mixed;\n";
                $headers .= " boundary=\"{$mime_boundary}\"";

                //part1: define the plain text email
                $message ="\n\n--{$mime_boundary}\n";
                $message .="Content-Type: text/plain; charset=\"iso-8859-1\"\n";
                $message .="Content-Transfer-Encoding: 7bit\n\n" . $msg . "\n\n";
                $message .= "--{$mime_boundary}\n";

                //part2: loop and define mail attachments
                foreach ($files as $file) {
                    $aFile = fopen($file, "rb");
                    echo "string";
                    $data = fread($aFile, filesize($file));
                    fclose($aFile);
                    $data = chunk_split(base64_encode($data));
                    $message .="Content-Type: {\"application/octet-stream\"};\n";
                    $message .= "name=\"$file\"\n";
                    $message .= "Content-Disposition: attachment;\n";
                    $message .= " filename=\"$file\"\n";
                    $message .= "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                    $message .= "--{$mime_boundary}\n";
                }
                //send the mail
                $ok = mail($to, $subject, $message ,$headers);
                if ($ok) {
                    $this->Flash->success(__('the {0} is sent  .', 'mail '));
                    return $this->redirect(['action' => 'indexCommandes']);
                }else{
                    $this->Flash->error(__('{0}could not be sent! ', 'mail '));
                    return $this->redirect(['action' => 'indexCommandes']);
                }
                die();
            }
        }
        $this->set('Comm',$Comm);
        $this->render('/Espaces/respostocks/envoieCom');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////// Fournisseurs Controller    //////////////////////////////////////////////////////////////////////
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexFournisseurs()
    {
        $this->paginate = [
            'contain' => ['StockCategories']
        ];
        $fournisseurs = $this->paginate(TableRegistry::get('Fournisseurs'));

        $this->set(compact('fournisseurs'));
        $this->set('_serialize', ['fournisseurs']);
        $this->render('/Espaces/respostocks/index_fournisseurs');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * View method
     *
     * @param string|null $id Fournisseur id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewFournisseurs($id = null)
    {
        $fournisseur = TableRegistry::get('Fournisseurs')->get($id);

        $this->set('fournisseur', $fournisseur);
        $this->set('_serialize', ['fournisseur']);
        $this->render('/Espaces/respostocks/view_fournisseurs');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addFournisseurs()
    {
        $fournisseur = TableRegistry::get('Fournisseurs')->newEntity();
        if ($this->request->is('post')) {
            $fournisseur = TableRegistry::get('Fournisseurs')->patchEntity($fournisseur, $this->request->data);
            if (TableRegistry::get('Fournisseurs')->save($fournisseur)) {
                $this->Flash->success(__('The {0} has been saved.', 'Fournisseur'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fournisseur'));
            }
        }
        $stockCategories = TableRegistry::get('Fournisseurs')->StockCategories->find('list', ['limit' => 200]);
        $this->set(compact('fournisseur', 'stockCategories'));
        $this->set('_serialize', ['fournisseur']);
        $this->render('/Espaces/respostocks/add_fournisseurs');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Edit method
     *
     * @param string|null $id Fournisseur id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editFournisseurs($id = null)
    {
        $connection = ConnectionManager::get('default');
        $fournisseur = TableRegistry::get('Fournisseurs')->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fournisseur = TableRegistry::get('Fournisseurs')->patchEntity($fournisseur, $this->request->data);
            if (TableRegistry::get('Fournisseurs')->save($fournisseur)) {

                $this->Flash->success(__('The {0} has been saved.', 'Fournisseur'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fournisseur'));
            }
        }
        $stockCategories = TableRegistry::get('Fournisseurs')->StockCategories->find('list', ['limit' => 200]);
        $this->set(compact('fournisseur', 'stockCategories'));
        $this->set('_serialize', ['fournisseur']);
        $this->render('/Espaces/respostocks/edit_fournisseurs');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Delete method
     *
     * @param string|null $id Fournisseur id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteFournisseurs($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fournisseur = TableRegistry::get('Fournisseurs')->get($id);
        if (TableRegistry::get('Fournisseurs')->delete($fournisseur)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Fournisseur'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Fournisseur'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function exportFournisseurs($limit=100)
    {
        $cat=$_POST['cat'];
        $fournisseurs=TableRegistry::get('Fournisseurs')->find('all')->limit($limit)->where(['stock_categorie_id'=>$cat]);
        $this->set(compact('fournisseurs'));
        $this->render('/Espaces/respostocks/export_fournisseurs');
    }

    public function trierFournisseurs()
    {
        $this->set(compact('fournisseurs'));
        $this->render('/Espaces/respostocks/trier_fournisseurs');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////// Magasins Controller    //////////////////////////////////////////////////////////////////////
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexMagasins()
    {
        $magasins = $this->paginate(TableRegistry::get('Magasins'));

        $this->set(compact('magasins'));
        $this->set('_serialize', ['magasins']);
        $this->render('/Espaces/respostocks/index_magasins');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * View method
     *
     * @param string|null $id Magasin id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewMagasins($id = null)
    {
        $magasin = TableRegistry::get('Magasins')->get($id, [
            'contain' => ['Mouvements']
        ]);

        $this->set('magasin', $magasin);
        $this->set('_serialize', ['magasin']);
        $this->render('/Espaces/respostocks/view_magasins');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addMagasins()
    {
        $magasin = TableRegistry::get('Magasins')->newEntity();
        if ($this->request->is('post')) {
            $magasin = TableRegistry::get('Magasins')->patchEntity($magasin, $this->request->data);
            if (TableRegistry::get('Magasins')->save($magasin)) {
                $this->Flash->success(__('The magasin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The magasin could not be saved. Please, try again.'));
        }
        $this->set(compact('magasin'));
        $this->set('_serialize', ['magasin']);
        $this->render('/Espaces/respostocks/add_magasins');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Edit method
     *
     * @param string|null $id Magasin id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editMagasins($id = null)
    {
        $magasin =TableRegistry::get('Magasins')->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $magasin = TableRegistry::get('Magasins')->patchEntity($magasin, $this->request->data);
            if (TableRegistry::get('Magasins')->save($magasin)) {
                $this->Flash->success(__('The magasin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The magasin could not be saved. Please, try again.'));
        }
        $this->set(compact('magasin'));
        $this->set('_serialize', ['magasin']);
        $this->render('/Espaces/respostocks/edit_magasins');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Delete method
     *
     * @param string|null $id Magasin id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteMagasins($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $magasin = TableRegistry::get('Magasins')->get($id);
        if (TableRegistry::get('Magasins')->delete($magasin)) {
            $this->Flash->success(__('The magasin has been deleted.'));
        } else {
            $this->Flash->error(__('The magasin could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////// Mouvements Controller    //////////////////////////////////////////////////////////////////////
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexMouvements()
    {
        $this->paginate = [
            'contain' => ['Magasins', 'Articles']
        ];
        $mouvements = $this->paginate(TableRegistry::get('Mouvements'));

        $this->set(compact('mouvements'));
        $this->set('_serialize', ['mouvements']);
        $this->render('/Espaces/respostocks/index_mouvements');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * View method
     *
     * @param string|null $id Mouvement id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewMouvements($id = null)
    {
        $mouvement = TableRegistry::get('Mouvements')->get($id, [
            'contain' => []
        ]);

        $this->set('mouvement', $mouvement);
        $this->set('_serialize', ['mouvement']);
        $this->render('/Espaces/respostocks/view_mouvements');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addMouvements()
    {
        $articlesTable = TableRegistry::get('Articles');
        $mouvement = TableRegistry::get('Mouvements')->newEntity();
        if ($this->request->is('post')) {
            if($_POST['quantite_sortie']>0){
                $mouvement = TableRegistry::get('Mouvements')->patchEntity($mouvement, $this->request->data);
                if (TableRegistry::get('Mouvements')->save($mouvement) ) {
                    $article = $articlesTable->get($mouvement->article_id);
                    if( $mouvement->quantite_sortie < $article->quantite ){
                        $this->Flash->success(__('Le {0} est enregistré avec succée.', 'Mouvement'));
                    }elseif($mouvement->quantite_sortie > $article->quantite ){
                        $this->Flash->error(__('LE {0} n\'est pas enregitré ! Veulliez ressayer.', 'Mouvement'));
                        $idmou = $mouvement->id;
                        $mouv = TableRegistry::get('Mouvements')->get($idmou);
                        TableRegistry::get('Mouvements')->delete($mouv);
                        return $this->redirect(['action' => 'index_mouvements']);
                    }
                    $article->quantite = $article->quantite-$mouvement->quantite_sortie;
                    $articlesTable->save($article);
                }
                return $this->redirect(['action' => 'index_mouvements']);
            }else{$this->Flash->error(__('La quantite sortie ne doit pas etre negative! Veulliez ressayer.', 'Mouvement'));}
        }
        $magasins = TableRegistry::get('Mouvements')->Magasins->find('list', ['limit' => 200]);
        $articles = TableRegistry::get('Mouvements')->Articles->find('list', ['limit' => 200]);
        $this->set(compact('mouvement', 'magasins', 'articles'));
        $this->set('_serialize', ['mouvement']);
        $this->render('/Espaces/respostocks/add_mouvements');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Edit method
     *
     * @param string|null $id Mouvement id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editMouvements($id = null)
    {
        $mouvement = TableRegistry::get('Mouvements')->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            if( $mouvement->quantite_sortie > $_POST['quantite_entree'])
            {
                if($_POST['quantite_entree']>0){
                    $mouvement = TableRegistry::get('Mouvements')->patchEntity($mouvement, $this->request->data);
                    if (TableRegistry::get('Mouvements')->save($mouvement)) {
                        /////////////////////////////////////////////////////////////////////////////
                        $articlesTable = TableRegistry::get('Articles');
                        $article = $articlesTable->get($mouvement->article_id); // Return article with id 12
                        $article->quantite = $article->quantite+$mouvement->quantite_entree;
                        $articlesTable->save($article);
                        /////////////////////////////////////////////////////////////////////////////
                        $this->Flash->success(__('The {0} has been saved.', 'Mouvement'));
                        return $this->redirect(['action' => 'index_mouvements']);
                    } else {
                        $this->Flash->error(__('Le {0} n\'est pas enregistré. Veuillez ressayer.', 'Mouvement'));
                    }
                }else{
                    $this->Flash->error(__('quantité entrée ne doit pas etre negative. Veulliez ressayer.', 'Mouvement'));}
            }else {
                $this->Flash->error(__('quantité entrée ne doit pas depasser la quantité sortie. Veulliez ressayer.', 'Mouvement'));
            }

        }
        $magasins = TableRegistry::get('Mouvements')->Magasins->find('list', ['limit' => 200]);
        $articles = TableRegistry::get('Mouvements')->Articles->find('list', ['limit' => 200]);
        $this->set(compact('mouvement', 'magasins', 'articles'));
        $this->set('_serialize', ['mouvement']);
        $this->render('/Espaces/respostocks/edit_mouvements');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Delete method
     *
     * @param string|null $id Mouvement id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteMouvements($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mouvement = TableRegistry::get('Mouvements')->get($id);
        if (TableRegistry::get('Mouvements')->delete($mouvement)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Mouvement'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Mouvement'));
        }
        return $this->redirect(['action' => 'index_mouvements']);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////// StockCategories Controller    //////////////////////////////////////////////////////////////////////
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexStockCategories()
    {
        $stockCategories = $this->paginate(TableRegistry::get('StockCategories'));

        $this->set(compact('stockCategories'));
        $this->set('_serialize', ['stockCategories']);
        $this->render('/Espaces/respostocks/index_stockcategories');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * View method
     *
     * @param string|null $id Stock Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewStockCategories($id = null)
    {
        $stockCategory = TableRegistry::get('StockCategories')->get($id, [
            'contain' => []
        ]);

        $this->set('stockCategory', $stockCategory);
        $this->set('_serialize', ['stockCategory']);
        $this->render('/Espaces/respostocks/view_stockcategories');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addStockCategories()
    {
        $stockCategory = TableRegistry::get('StockCategories')->newEntity();
        if ($this->request->is('post')) {
            $stockCategory = TableRegistry::get('StockCategories')->patchEntity($stockCategory, $this->request->data);
            if (TableRegistry::get('StockCategories')->save($stockCategory)) {
                $this->Flash->success(__('The {0} has been saved.', 'Stock Category'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Stock Category'));
            }
        }
        $this->set(compact('stockCategory'));
        $this->set('_serialize', ['stockCategory']);
        $this->render('/Espaces/respostocks/add_stockcategories');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Edit method
     *
     * @param string|null $id Stock Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editStockCategories($id = null)
    {
        $stockCategory = TableRegistry::get('StockCategories')->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stockCategory = TableRegistry::get('StockCategories')->patchEntity($stockCategory, $this->request->data);

            if (TableRegistry::get('StockCategories')->save($stockCategory)) {
                $this->Flash->success(__('The {0} has been saved.', 'Stock Category'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Stock Category'));
            }
        }
        $this->set(compact('stockCategory'));
        $this->set('_serialize', ['stockCategory']);
        $this->render('/Espaces/respostocks/edit_stockcategories');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Delete method
     *
     * @param string|null $id Stock Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteStockCategories($id = null)
    {
        $connection = ConnectionManager::get('default');
        $this->request->allowMethod(['post', 'delete']);
        $stockCategory = TableRegistry::get('StockCategories')->get($id);

        $prete =  $connection->execute('SELECT id  FROM commandes  where stock_categorie_id="'.$id.'"')->fetchAll('assoc');
        foreach ($prete as  $valeur) {
            foreach ($valeur as $key => $value) {
                $connection->execute('delete  FROM commande_articles where commande_id="'.$value.'"');
            }
        }
        $connection->execute('delete  FROM commandes where  stock_categorie_id="'.$id.'"');
        if (TableRegistry::get('StockCategories')->delete($stockCategory)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Stock Category'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Stock Category'));
        }
        return $this->redirect(['action' => 'index']);
    }




    /****** Youness ******/


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

        $this->render('/Espaces/respostocks/demanderabsences');
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

                        return $this->redirect(['controller'=>'Respostocks','action' => 'index']);
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

                        return $this->redirect(['controller'=>'Respostocks','action' => 'index']);
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
        $this->render('/Espaces/respostocks/demanderDocFct');

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
        $this->render('/Espaces/respostocks/etatDemandeFct');

    }
    // FIN KAWTAR + IBTISSAM
	

	

}

?>