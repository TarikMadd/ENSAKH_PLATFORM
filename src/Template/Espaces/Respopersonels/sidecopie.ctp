<?php
$file = $theme['folder'] . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'aside' . DS . 'sidebar-menu.ctp';
$us= $this->request->session()->read('Auth.User');
//print_r($us);
//exit;

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<ul class="sidebar-menu">


    <!---       SCOLARITE       -->
    <?php
    if ($us['role']=='resposcolarite')
    {
        ?>
        <li class="header">Espace Scolarité</li>

        <!-- Abdesamad -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Gestion de concours</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><li><?php echo $this->Html->link('Afficher les elements', array('controller' => 'Resposcolarites','action' => 'aitsaidAfficherElement')); ?>"></li></li>
                <li><a href="<?php echo $this->Url->build('/pages/home2'); ?>"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
            </ul>
             <li><?php echo $this->Html->link('Demander une absence ',array('controller' => 'Resposcolarites','action' => 'demanderabsences')); ?>"></li>

        </li>


        <!-- Fin Abdessamad -->

        <!-- Zouhir -->

        <li class="treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Gestion des Elements</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build('/'); ?>"><i class="fa fa-circle-o"></i> inscription</a></li>
                <li><a href="<?php echo $this->Url->build('/pages/home2'); ?>"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
            </ul>
        </li>


        <li class="treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Gestion des Classes</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><?php echo $this->Html->link('Afficher Classes', array('controller' => 'Resposcolarites','action' => 'aitsaidAfficherClasse')); ?>"></li>
                <li><a href="<?php echo $this->Url->build('/pages/home2'); ?>"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
            </ul>
        </li>

        <!-- Fin Zouhir -->

        <!-- Hamdi -->
        <li><a href="<?php echo $this->Url->build('/'); ?>"><i class="fa fa-circle-o"></i> Certificats Etudiants </a></li>
        <!-- Fin Hamdi -->
        <li><a href="<?php echo $this->Url->build('/'); ?>"><i class="fa fa-circle-o"></i> Demande Documents </a></li>
        <!-- MOuaad -->
        <li class="treeview">
            <?php echo $this->Html->link('Tableau de Bord', array('controller' => 'Resposcolarites','action' => 'aitsaidTableauDeBord')); ?>">
        </li>
        <!-- Fin Mouaad -->

        <?php
    }
    elseif($us['role']=='profvacataire' || $us['role']=='profpermanent')
    {
        ?>

        <!---       Proffesseur  :      -->

        <li class="header">Espace Proffesseur</li>

        <!-- role prof vacataire et permanant -->


        <!-- BECHHAYDA -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>notes</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build('/'); ?>"><i class="fa fa-circle-o"></i> Ajouter les notes</a></li>
                <li><a href="<?php echo $this->Url->build('/pages/home2'); ?>"><i class="fa fa-circle-o"></i> Afficher les notes</a></li>
            </ul>
        </li>
        <li><a href="<?php echo $this->Url->build('/pages/home2'); ?>"><i class="fa fa-circle-o"></i> Mes classes </a></li>
        <!-- Fin BENCHHAYDA -->

        <!-- BADR  -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Bibliothèques</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build('/'); ?>"><i class="fa fa-circle-o"></i> Ajouter les notes</a></li>
                <li><a href="<?php echo $this->Url->build('/pages/home2'); ?>"><i class="fa fa-circle-o"></i> Afficher les notes</a></li>
            </ul>
        </li>

        <!-- Fin BADR -->

        <!-- Bouhsie -->


        <!--  jellouli -->
         <li><a href="<?= $this->Url->build( array( 'controller' => 'Profpermanents',
                                                'action'=>'view',
                                                $prof));
                        ?>"><i class="fa fa-circle-o"></i> Validation données </a></li>-->
                         <!-- fin jellouli -->
        <?php if($us['role']=='profvacataire'){?>
        <li><a href="<?= $this->Url->build( array( 'controller' => 'Vacataires', 'action'=>'view', ));?>"><i class="fa fa-circle-o"></i> Validation données </a></li>

        <li><a href="<?php echo $this->Url->build('/'); ?>"><i class="fa fa-circle-o"></i> Saisir heures de travail </a></li>
    <?php }  ?>
        <li class="treeview">
            <a href="<?php echo $this->Url->build('/'); ?>"><i class="fa fa-edit"></i> Demande Document</a>
        </li>
        <li><a href="<?php echo $this->Url->build('/'); ?>"><i class="fa fa-circle-o"></i> S'authentifier </a></li>
        <!-- Fin Bouhsise -->
        <?php
    }
    elseif($us['role']=='etudiant')
    {
        ?>

        <!---      Etudiant  :      -->

        <li class="header">Espace Etudiant</li>

        <!-- role Etudiant -->


        <!-- LAHLAOUTI -->
        <li class="treeview">
            <a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-edit"></i> Tableau de Bord</a>
        </li>

        <li class="treeview">
            <a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-edit"></i> Mes Proffesseurs</a>
        </li>
        <li class="treeview">
            <a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-edit"></i> Mes modules</a>
        </li>
        <!-- Fin LAHLAOUTI -->

        <!-- BADR -->
        <li class="treeview">
            <a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-edit"></i> Bibliothèques</a>
        </li>
        <!-- FIN BADR -->
        <!-- LAHLAOUTI -->
        <li class="treeview">
            <a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-edit"></i> Evenements</a>
        </li>
        <li class="treeview">
            <a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-edit"></i> Notes</a>
        </li>
        <li class="treeview">
            <a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-edit"></i> Vacances</a>
        </li>
        <!-- FIN LAHLAOUTI -->
        <!-- Bouhsise -->
        <li class="treeview">
            <a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-edit"></i> Demande document</a>
        </li>
        <!-- Fin Bouhsise -->
        <!-- LAHLAOUTI -->
        <li class="treeview">
            <a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-edit"></i> Horaires examens</a>
        </li>
        <li class="treeview">
            <a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-edit"></i> Emlpoi</a>
        </li>
        <!-- FIN LAHLAOUTI -->
        <!-- HAMDI -->
        <li class="treeview">
            <a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-edit"></i> Demander Certificats</a>
        </li>

        <!-- Fin HAMDI -->

        <!---      Finance  :      -->

        <?php
    }
    elseif($us['role']=='respofinance')
    {
        ?>

        <li class="header">Espace Finance</li>

        <!-- role Finance -->

        <!-- DEBUT samsam -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-table"></i> <span>Finance</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="<?php echo $this->Url->build('/pages/tables/data'); ?>"><i class="fa fa-circle-o"></i> Data tables</a></li>
            </ul>
        </li>
        <!--FIN  samsam -->
        <!-- Bouhsise -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Gestion des demandes</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">

                <li><li><?php echo $this->Html->link('Déposer une demande ', array('controller' => 'Respopersonels','action' => 'demanderDocFct')); ?>"></li></li>
                <li><li><?php echo $this->Html->link('Liste des documents déposés ', array('controller' => 'Respopersonels','action' => 'etatDemandeFct  ')); ?>"></li></li>
            </ul>
        </li>
        <!-- Fin Bouhsise -->
        <?php
    }
    elseif($us['role']=='respostock')
    {
        ?>

        <!---      Stock  :      -->

        <li class="header">Espace Stock</li>

        <!-- role Stock -->

        <!--DEBUT  JELAIDI -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-table"></i> <span>Gestion de Stock</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="<?php echo $this->Url->build('/pages/tables/data'); ?>"><i class="fa fa-circle-o"></i> Data tables</a></li>
                <li><?php echo $this->Html->link('Demander une absence ',array('controller' => 'Respostocks','action' => 'demanderabsences')); ?>"></li>

            </ul>
        </li>
        <!--FIN  JELAIDI -->
        <!--DEBUT  Bouhsise -->
       <li class="treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Gestion des demandes</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">

                <li><li><?php echo $this->Html->link('Déposer une demande ', array('controller' => 'Respopersonels','action' => 'demanderDocFct')); ?>"></li></li>
                <li><li><?php echo $this->Html->link('Liste des documents déposés ', array('controller' => 'Respopersonels','action' => 'etatDemandeFct  ')); ?>"></li></li>
            </ul>
        </li>
        <!-- Bouhsise -->

        <?php
    }
    elseif($us['role']=='respobiblio')
    {
        ?>
        <!---      Bibliothèques  :      -->

        <li class="header">Espace Bibliothèques</li>

        <!-- role Bibliothèques -->

        <!--DEBUT  BADR -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-table"></i> <span>Bibliothèque</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-circle-o"></i> Consulter ouvrage</a></li>
                <li><a href="<?php echo $this->Url->build('/pages/tables/data'); ?>"><i class="fa fa-circle-o"></i> Ajouter Ouvrage</a></li>
                <li><a href="<?php echo $this->Url->build('/pages/tables/data'); ?>"><i class="fa fa-circle-o"></i> Ajouter Ouvrage</a></li>
                <li><?php echo $this->Html->link('Demander une absence ',array('controller' => 'Respobiblios','action' => 'demanderabsences')); ?>"></li>
            </ul>
        </li>
        <!--FIN  BADR -->
        <!-- Bouhsise -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Gestion des demandes</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">

                <li><li><?php echo $this->Html->link('Déposer une demande ', array('controller' => 'Respopersonels','action' => 'demanderDocFct')); ?>"></li></li>
                <li><li><?php echo $this->Html->link('Liste des documents déposés ', array('controller' => 'Respopersonels','action' => 'etatDemandeFct  ')); ?>"></li></li>
            </ul>
        </li>
        <!-- Fin Bouhsise -->
        <?php
    }
    elseif($us['role']=='respobureauordre')
    {
        ?>
        <!---     Bureau d'ordre  :      -->

        <li class="header">Espace Bureau d'ordre  :</li>

        <!-- role Bureau d'ordre  : -->


        <!--DEBUT  Ibtihal -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-table"></i> <span>Bureau d'ordre</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-circle-o"></i> Courier envoyés</a></li>
                <li><a href="<?php echo $this->Url->build('/pages/tables/data'); ?>"><i class="fa fa-circle-o"></i>  courier recus</a></li>
                <li><a href="<?php echo $this->Url->build('/pages/tables/data'); ?>"><i class="fa fa-circle-o"></i> xxxxxxxxxx</a></li>
                <li><a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-circle-o"></i> Courier envoyés</a></li>
                <li><a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-circle-o"></i> Courier envoyés</a></li>
             <li><?php echo $this->Html->link('Demander une absence ',array('controller' => 'Respobureauordres','action' => 'demanderabsences')); ?>"></li>
            </ul>
        </li>
        <!--FIN  Ibtihal -->
        <!-- Bouhsise -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Gestion des demandes</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">

                <li><li><?php echo $this->Html->link('Déposer une demande ', array('controller' => 'Respopersonels','action' => 'demanderDocFct')); ?>"></li></li>
                <li><li><?php echo $this->Html->link('Liste des documents déposés ', array('controller' => 'Respopersonels','action' => 'etatDemandeFct  ')); ?>"></li></li>
            </ul>
        </li>
        <!-- Fin Bouhsise -->
        <?php
    }
    elseif($us['role']=='respostage')
    {
        ?>

        <!---     Stage:      -->

        <li class="header">Espacee stage  :</li>

        <!-- role respostage  : -->

        <!-- Hamdi -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-table"></i> <span>Stages</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">

                <li><a href="<?php echo $this->Url->build('/pages/tables/data'); ?>"><i class="fa fa-circle-o"></i> xxxxxxxxxx</a></li>
                <li><a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-circle-o"></i> Courier envoyés</a></li>
                <li><a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-circle-o"></i> Courier envoyés</a></li>
            </ul>
        </li>
        <!-- Fin hamdi -->
        <!--DEBUT  Bouhsise -->
        <li class="treeview">
            <a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-edit"></i> Demande Document</a>
        </li>
        <!-- Bouhsise -->
        <?php
    }
    elseif($us['role']=='ingenieur')
    {
        ?>
        <li class="header">Espace Ingénieur</li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Gestion des demandes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

        <li><li><?php echo $this->Html->link('Déposer une demande ', array('controller' => 'Respopersonels','action' => 'demanderDocFct')); ?>"></li></li>
        <li><li><?php echo $this->Html->link('Liste des documents déposés ', array('controller' => 'Respopersonels','action' => 'etatDemandeFct  ')); ?>"></li></li>
        </ul>
        </li>
        <?php }
    elseif($us['role']=='respopersonel')
    {
        ?>

        <li class="header">Espace Personnel</li>
        <!-- role prof vacataire et permanant -->


        <!-- BOUHSISE -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Professeurs Permanenttts</span> <i class="fa fa-angle-left pull-right"></i>
                <ul class="treeview-menu">
                           <li><li><?php echo $this->Html->link('Acceuil', array('controller' => 'Respopersonels','action' => ' index')); ?>"></li></li>

                            <li><li><?php echo $this->Html->link('Départements', array('controller' => 'Respopersonels','action' => ' listerProfsParDepar')); ?>"></li></li>
                            <li><li><?php echo $this->Html->link('Grades', array('controller' => 'Respopersonels','action' => ' listerGrade')); ?>"></li></li>
                            <li><li><?php echo $this->Html->link('Activités ', array('controller' => 'Respopersonels','action' => 'afficherEvent')); ?>"></li></li>
                            <li><li><?php echo $this->Html->link('Consultation Document ', array('controller' => 'Respopersonels','action' => 'voirDocument')); ?>"></li></li>
                            <li><li><?php echo $this->Html->link('ChercherProfesseur ', array('controller' => 'Respopersonels','action' => 'rechercher')); ?>"></li></li>
                            <li><li><?php echo $this->Html->link('Lister Disciplines ', array('controller' => 'Respopersonels','action' => 'listerDisciplines')); ?>"></li></li>

                <li><?php echo $this->Html->link('les demandes de modification des données',array('controller' => 'Respopersonels','action' => 'voirDemandes')); ?>"></li>
            </a>
            <ul class="treeview-menu">
            <!-- SARIH debut-->
                <li class="treeview">
                    <a href="#">
                       <i class="glyphicon glyphicon-wrench"></i> <span>gestion de compte</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><?php echo $this->Html->link('créer un compte ',array('controller' => 'Respopersonels','action' => 'addper')); ?>"></li>
                        <li><?php echo $this->Html->link('Liste Professeurs Permanents',array('controller' => 'Respopersonels','action' => 'permanentsliste')); ?>"></li>
                    </ul>
                </li>
                <!-- SARIH fin-->


            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Professeurs Vacataires</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
            <!-- SARIH debut-->
                <li class="treeview">
                    <a href="#">
                    </a>
                    <ul class="treeview-menu">
                        <li><?php echo $this->Html->link('créer un compte ',array('controller' => 'Respopersonels','action' => 'addvac')); ?>"></li>
                        <li><?php echo $this->Html->link('Liste Professeurs Vacataires',array('controller' => 'Respopersonels','action' => 'vacatairesliste')); ?>"></li>
                        <li><?php echo $this->Html->link('les demandes de modification des données',array('controller' => 'Respopersonels','action' => 'voirDemandesVac')); ?>"></li>
                    </ul>
                </li>
                <!-- SARIH fin-->
                <li><?php echo $this->Html->link('Afficher Departement',array('controller' => 'Respopersonels','action' => 'listerProfsParDepar')); ?>"></li>
                <li><?php echo $this->Html->link('Listes Par Disciplines',array('controller' => 'Respopersonels','action' => 'younessAfficherProfsDisciplines')); ?>"></li>
                <li><?php echo $this->Url->build('/pages/home2'); ?>"><i class="fa fa-circle-o"></i>par discipline</a></li>

            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Fonctionnaires</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
            <!-- SARIH debut-->
                <li class="treeview">
                    <a href="#">
                       <i class="glyphicon glyphicon-wrench"></i> <span>gestion de compte</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><?php echo $this->Html->link('créer un compte ',array('controller' => 'Respopersonels','action' => 'addfonc')); ?>"></li>
                        <li><?php echo $this->Html->link('Liste des fonctionnaires',array('controller' => 'Respopersonels','action' => 'fonctionnairesliste')); ?>"></li>

                    </ul>
                </li>
                <!-- SARIH fin-->
                 <!-- Ibtissam Debut-->
                <li><?php echo $this->Html->link('Les fonctionnaires par Service ',array('controller' => 'Respopersonels','action' => 'mouvementService')); ?>"></li>
                <li><?php echo $this->Html->link('Les activités des fonctionnaires ',array('controller' => 'Respopersonels','action' => 'listerActivites')); ?>"></li>
                <li><?php echo $this->Html->link('Groupement des événements ',array('controller' => 'Respopersonels','action' => 'afficherFonctEvent')); ?>"></li>
                <li><li><?php echo $this->Html->link('Mouvement des fonctionnaires ', array('controller' => 'Respopersonels','action' => 'listerMouvement')); ?>"></li></li>
                <li><li><?php echo $this->Html->link('Rechercher un fonctionnaire ', array('controller' => 'Respopersonels','action' => 'fetch')); ?>"></li></li>
                <li><li><?php echo $this->Html->link('Consultation des Documents ', array('controller' => 'Respopersonels','action' => 'voirDocumentFct')); ?>"></li></li>
                <li><li><?php echo $this->Html->link('Les fonctionnaires par Grade ', array('controller' => 'Respopersonels','action' => 'listerFonctGrade')); ?>"></li></li>
                <li><?php echo $this->Html->link('Visualiser les Grades ',array('controller' => 'Respopersonels','action' => 'evolutionGrades')); ?>"></li>

                  <!-- Ibtissam Fin-->


            </ul>
            <li><?php echo $this->Html->link('Traiter une absence ',array('controller' => 'Respopersonels','action' => 'gestionabsences')); ?>"></li>

        </li>


        <!-- Fin BOUHSISE -->

    <?php }} ?>
