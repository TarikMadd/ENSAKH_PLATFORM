<?php $this->layout = 'AdminLTE.print'; ?>


<!-- Main content -->
<section class="invoice">
    <!-- title row -->

    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i></i><center> ATTESTATION DE TRAVAIL</center>
                <?php
                foreach($profpermanentsDocuments as $ligne)
                {
                    ?>

                    <?php
                    $id=$ligne->fonctionnaire->id;
                    $nom=$ligne->fonctionnaire->nom_fct;
                    $prenom=$ligne->fonctionnaire->prenom_fct;
                    $daterec=$ligne->fonctionnaire->date_Recrut;
                    $somme=$ligne->fonctionnaire->somme;
                    $cin=$ligne->fonctionnaire->CIN;



                }
                $k=1;
                foreach($tabGrade as $Grade)
                {
                    if($k==$nbGrade)
                    {
                        $nomGrade=$Grade['nomGrade'];
                        break;
                    }
                    else
                    {
                        $k++;
                    }
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
            - NOM ET PRENOM :<?= $nom.' '. $prenom ?><br><br><br>
            - N° de C.I.N : <?= $cin ?><br><br><br>
            - N° de  P.P.R : <?= $somme ?><br><br><br>
            - GRADE : <?= $nomGrade ?> <br><br><br>
            - DATE DE RECRUTEMENT:<?= $daterec ?><br><br><br>
            - LIEU DE TRAVAIL : Ecole nationale des sciences appliquées de Khouribga<br><br><br>
            La présente attestation est délivrée à l’intéressé pour servir et valoir ce que de droit.<br><br><br>

            <center> Khouribga le : ………………………………</center><br><br><br>

        </div><br><br><br><br>
        <!-- /.row -->




</section>

<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Retour'), ['action' => 'consultationDemandeFct',$id], ['escape' => false]) ?>
    </li>
</ol>
