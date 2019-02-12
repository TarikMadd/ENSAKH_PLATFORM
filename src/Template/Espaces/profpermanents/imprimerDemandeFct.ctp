<?php $this->layout = 'AdminLTE.print'; ?>


<!-- Main content -->
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i></i> Fiche de salaire
                <?php
                foreach($documentsFonctionnaires as $ligne)
                {
                    ?>
                    <small class="pull-right"><?= $ligne->date_demande ?></small>
                    <?php

                    $nom=$ligne->fonctionnaire->nom_prof;
                    $prenom=$ligne->fonctionnaire->prenom_prof;
                    $daterec=$ligne->fonctionnaire->date_Recrut;
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
            <br><br><br><br> Le Directeur de l’Ecole Nationale des Sciences Appliquées de Khouribga  atteste que Mr :<br><br><br>
            <strong>- NOM ET PRENOM :</strong><?= $nom.' '. $prenom ?><br><br><br>
            <strong>- N° de C.I.N :</strong> <?= $cin ?><br><br><br>
            <strong>- N° de  P.P.R :</strong> <?= $somme ?><br><br><br>
            <strong>- DATE DE RECRUTEMENT:</strong><?= $daterec ?><br><br><br>
            <strong>- LIEU DE TRAVAIL :</strong> Ecole nationale des sciences appliquées de Khouribga<br><br><br>
            La présente attestation est délivrée à l’intéressé pour servir et valoir ce que de droit.<br><br><br>

            <center> Khouribga le : ………………………………</center><br><br>

        </div>
        <!-- /.row -->



</section>
