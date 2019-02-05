<?php $this->layout = 'AdminLTE.print'; ?>


<!-- Main content -->
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i></i> <center><strong><br><br>AUTORISATION DE QUITTER LE TERRITOIRE</strong></center>
                <?php
                foreach($fonctionnairesDocuments as $ligne)
                {
                    ?>
                    <small class="pull-right"><?= $ligne->date_demande ?></small>
                    <?php

                    $nom=$ligne->fonctionnaire->nom_fct;
                    $prenom=$ligne->fonctionnaire->prenom_fct;
                    $specialite=$ligne->fonctionnaire->specialite;
                    $somme=$ligne->fonctionnaire->somme;
                    $cin=$ligne->fonctionnaire->CIN;



                }
                ?>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div >
        <div  >
            <br><br><br><br> Le Directeur de l’Ecole Nationale des Sciences Appliquées de Khouribga  autorise Mr :<br><br><br>
            <strong>- NOM ET PRENOM :</strong><?= $nom.' '. $prenom ?><br><br><br>
            <strong>- N° de C.I.N :</strong> <?= $cin ?><br><br><br>
            <strong>- N P.P.R :</strong> <?= $somme ?><br><br><br>
            <strong>- FONCTION:</strong><?= $specialite ?><br><br><br>
            A quitter le Territoire National <br><br><br>
            Pour motif: Mission Pédagogique<br><br><br>
            Il (Elle) devra reprendre son service le :<?=?><br><br><br>

            <center> Khouribga le : ………………………………</center><br><br>

        </div>
        <!-- /.row -->



</section>
