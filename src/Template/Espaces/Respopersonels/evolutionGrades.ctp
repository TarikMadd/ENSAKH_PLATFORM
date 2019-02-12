<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Les grades des fonctionnaires
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?>  Les grades de ce fonctionnaire</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                </span>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('Num Somme') ?></th>
              <th><?= $this->Paginator->sort('Nom Fonctionnaire') ?></th>
              <th><?= $this->Paginator->sort('Code Grade') ?></th>
			  <th><?= $this->Paginator->sort('date de reprise') ?></th>
			  <th><?= $this->Paginator->sort('Id Fct') ?></th>
			  <th><?= $this->Paginator->sort('Id Grade') ?></th>
			  
			 


              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($FonctionnairesGrades as $FonctionnairesGrade): ?>
              <tr>
                <td><?= $this->Number->format($FonctionnairesGrade->id) ?></td>
                <td><?= h($FonctionnairesGrade->fonctionnaire->somme)?></td>
                <td><?= h($FonctionnairesGrade->fonctionnaire->nom_fct)?></td>
                 <td><?= h($FonctionnairesGrade->grade->codeGrade)?></td>
				   <td><?= h($FonctionnairesGrade->grade->dateDebut)?></td>
				  <td><?= $FonctionnairesGrade->has('fonctionnaire') ? $this->Html->link($FonctionnairesGrade->fonctionnaire->id, ['controller' => 'Respopersonels', 'action' => 'view', $FonctionnairesGrade->fonctionnaire->id]) : '' ?></td>
                <td><?= $FonctionnairesGrade->has('grade') ? $this->Html->link($FonctionnairesGrade->grade->id, ['controller' => 'Grades', 'action' => 'view', $FonctionnairesGrade->grade->id]) : '' ?></td>

                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'viewFctnGrade', $FonctionnairesGrade->fonctionnaire->id, $FonctionnairesGrade->grade->id,$FonctionnairesGrade->id], ['class'=>'btn btn-info btn-xs']) ?>
            
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'deleteFctnGrade', $FonctionnairesGrade->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <?php echo $this->Paginator->numbers(); ?>
          </ul>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
