<?php $this->layout = 'AdminLTE.print'; ?>


<!-- Main content -->
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-globe"></i> Fiche de salaire
        <?php
        foreach($documentsProfesseurs as $ligne)
        {
        ?>
        <small class="pull-right">Le <?= $ligne->date_demande ?></small>
        <?php

        $nom=$ligne->professeur->nom_prof;
         $prenom=$ligne->professeur->prenom_prof;
           $daterec=$ligne->professeur->date_Recrut;
            $somme=$ligne->professeur->somme;
           $cin=$ligne->professeur->CIN;



        }
        ?>
      </h2>
        </div>
    <!-- /.col -->
    </div>
    <!-- info row -->
    <div >
        <div  >
         <br><br><br><br> Le Directeur de l’Ecole Nationale des Sciences Appliquées de Khouribga  atteste que Mr :<br><br><br><br><br><br>
           - NOM ET PRENOM :<?= $nom.' '. $prenom ?><br><br><br><br>
           - N° de C.I.N : <?= $cin ?><br><br><br><br>
           - N° de  P.P.R : <?= $somme ?><br><br><br><br>
           - GRADE : 2 <br><br><br><br>
           - DATE DE RECRUTEMENT:<?= $daterec ?><br><br><br>
           - LIEU DE TRAVAIL : Ecole nationale des sciences appliquées de Khouribga<br><br><br>
           La présente attestation est délivrée à l’intéressé pour servir et valoir ce que de droit.<br><br><br>

           Khouribga le : ………………………………<br><br>

    </div>
    <!-- /.row -->



</section>
