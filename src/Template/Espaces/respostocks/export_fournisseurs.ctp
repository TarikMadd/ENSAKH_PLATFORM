

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Fournisseurs
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add_fournisseurs'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('Liste des') ?> Fournisseurs</h3>
          <div class="box-tools">
            <form method="POST" action="export_fournisseurs">
              
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
               <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom_fournisseur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prenom_fournisseur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('label_fournisseur') ?></th>
            </tr>
            
<?php foreach ($fournisseurs as $fournisseur): ?>
            <tr>
                <td><?php echo $fournisseur['id']?></td>
				<td><?php echo $fournisseur['nom_fournisseur']?></td>
				<td><?php echo $fournisseur['prenom_fournisseur']?></td>
				<td><?php echo $fournisseur['label_fournisseur']?></td>
            </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.box-body -->
       
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->