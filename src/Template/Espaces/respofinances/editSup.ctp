<?php
/**
 * @var \App\View\AppView $this
 */
?>

<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Modifier Heure sup') ?></h3>
                </div>

                <?= $this->Form->create($supheures, array('role' => 'form')) ?>
                <div class="box-body">
                    <?php
                    $months = array (1=>'Janvier',2=>'février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'juillet',8=>'aout',9=>'septembre',10=>'octobre',11=>'novembre',12=>'décembre');
                    echo $this->Form->input('mois',['options' => $months,'disabled']);
                    echo $this->Form->input('annee',['disabled']);
                    echo $this->Form->input('nbHeure',['max'=>20,'min'=>1]);
                    echo $this->Form->input('etat',['options' => ['non validé'=>'non validé','validé'=>'validé']]);
                    ?>
                </div>

                <div class="box-footer" style="text-align: center">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <button type="reset" class="btn btn-default">Réinitialiser</button>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>
