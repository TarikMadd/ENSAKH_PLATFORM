<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="fonctionnaires index large-9 medium-8 columns content">
    <h3>L'activité choisie est:</h3>
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom_activite') ?></th>
                <
            </tr>
            <?php foreach ($activites as $activites): ?>
                <tr>
                    <td>  <?php echo $activites['id']; ?> </td>
                    <td> <?php echo $activites['nomActivite'];?> </td>


                </tr>
            <?php endforeach; ?>
        </table>
        <div>
            <br>
            <button type="button" class="btn btn-info"><a href="listerActivites">Retour</a></button>
        </div>
    </div>
</div>






